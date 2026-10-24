<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\Models\DataAkademik;
use App\Models\ProgramStudi;
use App\Models\Rekomendasi;
use App\Models\SoalAsesmen;
use App\Services\AsesmenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsesmenController extends Controller
{
    protected AsesmenAIService $aiService;

    public function __construct(AsesmenAIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Dapatkan siswa yang sedang login.
     */
    protected function currentSiswa()
    {
        return Auth::guard('siswa')->user() ?? Auth::user();
    }

    /**
     * Tampilan utama halaman asesmen dan rekomendasi siswa.
     */
    public function index(Request $request)
    {
        $user = $this->currentSiswa();
        $siswaId = $user->id_siswa ?? $user->id;

        // Ambil 42 bank soal asesmen aktif
        $soals = SoalAsesmen::where('status', 'aktif')
            ->orderBy('id_asesmen')
            ->get();

        // Ambil data akademik / nilai rapor siswa terkini
        $dataAkademikList = DataAkademik::where('id_siswa', $siswaId)->get();
        $raportGrades = [];
        foreach ($dataAkademikList as $da) {
            $raportGrades[$da->mata_pelajaran] = (float) $da->rata_rata_nilai;
        }

        // Ambil asesmen spesifik berdasarkan id (jika diminta) atau asesmen terakhir yang selesai
        $targetAsesmen = null;
        if ($request->filled('id')) {
            $targetAsesmen = Asesmen::where('id_siswa', $siswaId)
                ->where('id_asesmen', $request->query('id'))
                ->with(['rekomendasi.programStudi'])
                ->first();
        }

        $latestAsesmen = $targetAsesmen ?? Asesmen::where('id_siswa', $siswaId)
            ->where('status', 'selesai')
            ->with(['rekomendasi.programStudi'])
            ->latest('tanggal')
            ->first();

        return view('Siswa.page.asesmen_rekomendasi', [
            'soals' => $soals,
            'dataAkademik' => $dataAkademikList->first(),
            'raportGrades' => $raportGrades,
            'latestAsesmen' => $latestAsesmen,
            'riasecInfo' => AsesmenAIService::RIASEC_INFO,
            'title' => 'Asesmen & Rekomendasi Program Studi — Buddy For Youth (B-Youth)',
            'pageTitle' => 'Asesmen Minat & Rekomendasi Prodi',
            'active' => 'asesmen',
        ]);
    }

    /**
     * Submit jawaban 42 soal, proses AI matching RIASEC, dan simpan rekomendasi.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array|min:1',
            'use_raport' => 'nullable|boolean',
            'raport_grades' => 'nullable|array',
        ]);

        $user = $this->currentSiswa();
        $siswaId = $user->id_siswa ?? $user->id;
        $answers = $request->input('jawaban', []);
        $useRaport = filter_var($request->input('use_raport', false), FILTER_VALIDATE_BOOLEAN);
        $raportGrades = $request->input('raport_grades', []);

        // 1. Jalankan AI Engine
        $aiResult = $this->aiService->processAssessment($answers, $raportGrades, $useRaport);
        $riasecResult = $aiResult['riasec_result'];
        $recommendations = $aiResult['recommendations'];
        $topTypesInfo = $aiResult['top_types_info'] ?? [];
        $inferenceTrace = $aiResult['inference_trace'] ?? [];
        $aiEngineName = $aiResult['ai_engine'] ?? 'Python Forward Chaining & Collaborative Filtering';

        // 2. Jika user menyertakan nilai rapor, simpan ke tabel data_akademik granular
        if ($useRaport && ! empty($raportGrades) && is_array($raportGrades)) {
            foreach ($raportGrades as $mapel => $nilai) {
                if (is_numeric($nilai)) {
                    $scoreVal = (float) $nilai;
                    DataAkademik::updateOrCreate(
                        [
                            'id_siswa' => $siswaId,
                            'mapel_semester' => 'Semester 5',
                            'mata_pelajaran' => $mapel,
                        ],
                        [
                            'pengetahuan' => $scoreVal,
                            'keterampilan' => $scoreVal,
                            'rata_rata_nilai' => $scoreVal,
                        ]
                    );
                }
            }
        }

        // 3. Susun narasi profil asesmen
        $topTypesNames = [];
        foreach ($riasecResult['top_types'] as $type) {
            if (isset(AsesmenAIService::RIASEC_INFO[$type])) {
                $info = AsesmenAIService::RIASEC_INFO[$type];
                $topTypesNames[] = $info['name'].' ('.$type.')';
            }
        }

        $ringkasanProfilAsesmen = 'Profil asesmen Holland RIASEC menunjukkan dominasi pada tipe '.implode(', ', $topTypesNames).' ('.$riasecResult['holland_code'].'). Karakteristik utama berfokus pada '.implode('; ', array_map(fn ($t) => $t['headline'], $topTypesInfo)).', dengan arah prospek karier potensial seperti '.implode(', ', array_slice($topTypesInfo[0]['karier'] ?? [], 0, 4)).'.';
        $karakteristikText = 'Karakteristik kepribadian & cara kerja: '.implode('; ', array_map(fn ($t) => $t['headline'], $topTypesInfo)).'.';
        $prospekText = 'Arah karier yang relevan: '.implode(', ', array_slice($topTypesInfo[0]['karier'] ?? [], 0, 4)).'.';

        // 4. Simpan transaksi Asesmen ke Database
        DB::beginTransaction();
        try {
            $asesmen = Asesmen::create([
                'id_siswa' => $siswaId,
                'tanggal' => now(),
                'status' => 'selesai',
                'pertanyaan' => $ringkasanProfilAsesmen,
                'tipe_riasec' => $riasecResult['holland_code'],
            ]);

            // Simpan top 3 rekomendasi program studi ke tabel rekomendasi
            $savedRecs = array_slice($recommendations, 0, 3);
            foreach ($savedRecs as $rec) {
                $prodiId = $rec['prodi_id'] ?? $rec['id_prodi'] ?? null;
                if (! $prodiId && ! empty($rec['kode_prodi'])) {
                    $prodiId = ProgramStudi::where('kode_prodi', $rec['kode_prodi'])->value('id_prodi');
                }
                if (! $prodiId && ! empty($rec['nama_prodi'])) {
                    $prodiId = ProgramStudi::where('nama_prodi', $rec['nama_prodi'])->value('id_prodi');
                }
                if (! $prodiId) {
                    $firstProdi = ProgramStudi::first();
                    $prodiId = $firstProdi ? $firstProdi->id_prodi : 1;
                }

                Rekomendasi::create([
                    'id_asesmen' => $asesmen->id_asesmen,
                    'id_prodi' => $prodiId,
                    'skor' => $rec['skor'],
                    'alasan' => $rec['alasan'],
                    'prospek_karier' => $rec['prospek_karier'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'ai_engine' => $aiEngineName,
                'message' => 'Asesmen berhasil diselesaikan.',
                'asesmen_id' => $asesmen->id_asesmen,
                'riasec_result' => $riasecResult,
                'top_types_info' => $topTypesInfo,
                'recommendations' => array_slice($recommendations, 0, 3),
                'inference_trace' => $inferenceTrace,
                'use_raport' => $useRaport,
                'raport_grades' => $useRaport ? $raportGrades : null,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses hasil asesmen: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Tampilan Riwayat Asesmen Siswa.
     */
    public function riwayat()
    {
        $user = $this->currentSiswa();
        $siswaId = $user->id_siswa ?? $user->id;

        $riwayats = Asesmen::where('id_siswa', $siswaId)
            ->with(['rekomendasi.programStudi'])
            ->latest('tanggal')
            ->paginate(8);

        $totalSesi = Asesmen::where('id_siswa', $siswaId)->count();
        $totalSelesai = Asesmen::where('id_siswa', $siswaId)->where('status', 'selesai')->count();

        // Cari rekomendasi prodi yang paling sering muncul
        $mostFrequentProdi = 'Belum Ada';
        $topProdi = Rekomendasi::whereHas('asesmen', fn ($q) => $q->where('id_siswa', $siswaId))
            ->with('programStudi')
            ->select('id_prodi', DB::raw('count(*) as total'))
            ->groupBy('id_prodi')
            ->orderByDesc('total')
            ->first();

        if ($topProdi && $topProdi->programStudi) {
            $mostFrequentProdi = $topProdi->programStudi->nama_prodi;
        }

        return view('Siswa.page.riwayat_asesmen', [
            'riwayats' => $riwayats,
            'totalSesi' => $totalSesi,
            'totalSelesai' => $totalSelesai,
            'mostFrequentProdi' => $mostFrequentProdi,
            'riasecInfo' => AsesmenAIService::RIASEC_INFO,
            'title' => 'Riwayat Asesmen — Buddy For Youth (B-Youth)',
            'pageTitle' => 'Riwayat Asesmen Siswa',
            'active' => 'riwayat-asesmen',
        ]);
    }
}
