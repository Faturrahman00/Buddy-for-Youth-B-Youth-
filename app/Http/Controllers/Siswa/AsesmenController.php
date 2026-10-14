<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\Models\HasilAsesmen;
use App\Models\Rekomendasi;
use App\Models\SoalAsesmen;
use App\Models\DataAkademik;
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
     * Tampilan utama halaman asesmen dan rekomendasi siswa.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil 42 bank soal asesmen aktif
        $soals = SoalAsesmen::where('is_aktif', true)
            ->orderBy('nomor_urut')
            ->get();

        // Ambil data akademik / nilai rapor siswa terkini (jika ada)
        $dataAkademik = DataAkademik::where('user_id', $user->id)
            ->latest()
            ->first();

        // Parse detail nilai rapor jika ada
        $raportGrades = [];
        if ($dataAkademik && !empty($dataAkademik->detail_nilai)) {
            $decoded = is_string($dataAkademik->detail_nilai) 
                ? json_decode($dataAkademik->detail_nilai, true) 
                : $dataAkademik->detail_nilai;
            if (is_array($decoded)) {
                $raportGrades = $decoded;
            }
        }

        // Ambil asesmen terakhir siswa (jika pernah mengerjakan)
        $latestAsesmen = Asesmen::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->with(['hasilAsesmen.rekomendasi.programStudi'])
            ->latest('tanggal')
            ->first();

        return view('Siswa.page.asesmen_rekomendasi', [
            'soals' => $soals,
            'dataAkademik' => $dataAkademik,
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

        $user = Auth::user();
        $answers = $request->input('jawaban', []);
        $useRaport = filter_var($request->input('use_raport', false), FILTER_VALIDATE_BOOLEAN);
        $raportGrades = $request->input('raport_grades', []);

        // 1. Jalankan AI Engine (Python Forward Chaining & Collaborative Filtering dengan Fallback PHP)
        $aiResult = $this->aiService->processAssessment($answers, $raportGrades, $useRaport);
        $riasecResult = $aiResult['riasec_result'];
        $recommendations = $aiResult['recommendations'];
        $topTypesInfo = $aiResult['top_types_info'] ?? [];
        $inferenceTrace = $aiResult['inference_trace'] ?? [];
        $aiEngineName = $aiResult['ai_engine'] ?? 'Python Forward Chaining & Collaborative Filtering';

        // 2. Jika user memasukkan / mengaktifkan nilai rapor dan ingin menyimpannya ke profil
        if ($useRaport && !empty($raportGrades) && is_array($raportGrades)) {
            // Hitung rata-rata nilai rapor
            $validGrades = array_filter($raportGrades, fn($v) => is_numeric($v));
            $avgScore = !empty($validGrades) ? (array_sum($validGrades) / count($validGrades)) : null;

            DataAkademik::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'sekolah' => $user->sekolah ?? 'SMA / Sederajat',
                    'kelas' => $user->kelas ?? 'Kelas XII',
                    'nilai' => $avgScore ? round($avgScore, 2) : null,
                    'detail_nilai' => json_encode($raportGrades),
                ]
            );
        }

        // 3. Susun deskripsi teks minat, bakat, potensi
        $topTypesNames = [];
        foreach ($riasecResult['top_types'] as $type) {
            if (isset(AsesmenAIService::RIASEC_INFO[$type])) {
                $info = AsesmenAIService::RIASEC_INFO[$type];
                $topTypesNames[] = $info['name'] . ' (' . $type . ')';
            }
        }

        $minatText = 'Dominasi minat pada tipe ' . implode(', ', $topTypesNames) . '. Profil kepribadian minat responden mengarah pada kombinasi kode ' . $riasecResult['holland_code'] . '.';
        $bakatText = 'Kekuatan pada ' . implode('; ', array_map(fn($t) => $t['headline'], $topTypesInfo)) . '.';
        $potensiText = 'Berpotensi unggul dalam karier seperti ' . implode(', ', array_slice($topTypesInfo[0]['karier'] ?? [], 0, 4)) . '.';

        // 4. Simpan transaksi Asesmen ke Database
        DB::beginTransaction();
        try {
            $asesmen = Asesmen::create([
                'user_id' => $user->id,
                'tanggal' => now(),
                'status' => 'selesai',
            ]);

            $hasil = HasilAsesmen::create([
                'asesmen_id' => $asesmen->id,
                'holland_code' => $riasecResult['holland_code'],
                'tipe_tertinggi' => $riasecResult['top_types'],
                'minat' => $minatText,
                'bakat' => $bakatText,
                'potensi' => $potensiText,
                'detail_skor' => [
                    'ai_engine' => $aiEngineName,
                    'raw_scores' => $riasecResult['raw_scores'],
                    'percent_scores' => $riasecResult['percent_scores'],
                    'sorted_list' => $riasecResult['sorted_list'],
                    'inference_trace' => $inferenceTrace,
                ],
                'nilai_raport_digunakan' => $useRaport,
                'data_raport' => $useRaport ? $raportGrades : null,
            ]);

            // Simpan top 3 rekomendasi program studi ke tabel rekomendasi
            $savedRecs = array_slice($recommendations, 0, 3);
            foreach ($savedRecs as $rec) {
                Rekomendasi::create([
                    'hasil_id' => $hasil->id,
                    'prodi_id' => $rec['prodi_id'],
                    'skor' => $rec['skor'],
                    'alasan' => $rec['alasan'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'ai_engine' => $aiEngineName,
                'message' => 'Asesmen berhasil diselesaikan.',
                'asesmen_id' => $asesmen->id,
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
                'message' => 'Terjadi kesalahan saat memproses hasil asesmen: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Tampilan Riwayat Asesmen Siswa.
     */
    public function riwayat()
    {
        $user = Auth::user();

        $riwayats = Asesmen::where('user_id', $user->id)
            ->with(['hasilAsesmen.rekomendasi.programStudi'])
            ->latest('tanggal')
            ->paginate(8);

        $totalSesi = Asesmen::where('user_id', $user->id)->count();
        $totalSelesai = Asesmen::where('user_id', $user->id)->where('status', 'selesai')->count();

        // Cari rekomendasi prodi yang paling sering muncul
        $mostFrequentProdi = 'Belum Ada';
        $topProdi = Rekomendasi::whereHas('hasilAsesmen.asesmen', fn($q) => $q->where('user_id', $user->id))
            ->with('programStudi')
            ->select('prodi_id', DB::raw('count(*) as total'))
            ->groupBy('prodi_id')
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
