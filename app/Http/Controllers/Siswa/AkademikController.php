<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\DataAkademik;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkademikController extends Controller
{
    protected function currentSiswa(): ?Siswa
    {
        return Auth::guard('siswa')->user() ?? Auth::user();
    }

    public function index()
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        $daftarMapelStandar = [
            'IPAS' => [
                'nama' => 'IPAS',
                'alias' => 'IPAS',
                'sub' => 'Ilmu Pengetahuan Alam & Sosial',
                'kkm' => 75,
                'fillClass' => 'fill-ipas',
                'scoreClass' => 'score-ipas',
                'badgeClass' => 'badge-ipas'
            ],
            'MTK' => [
                'nama' => 'MTK',
                'alias' => 'Matematika (MTK)',
                'sub' => 'Logika & Kuantitatif',
                'kkm' => 75,
                'fillClass' => 'fill-mtk',
                'scoreClass' => 'score-mtk',
                'badgeClass' => 'badge-mtk'
            ],
            'Bahasa Indonesia' => [
                'nama' => 'Bahasa Indonesia',
                'alias' => 'Bahasa Indonesia',
                'sub' => 'Komunikasi & Literasi',
                'kkm' => 75,
                'fillClass' => 'fill-indo',
                'scoreClass' => 'score-indo',
                'badgeClass' => 'badge-indo'
            ],
            'Bahasa Inggris' => [
                'nama' => 'Bahasa Inggris',
                'alias' => 'Bahasa Inggris',
                'sub' => 'Bahasa Internasional',
                'kkm' => 75,
                'fillClass' => 'fill-ing',
                'scoreClass' => 'score-ing',
                'badgeClass' => 'badge-ing'
            ],
        ];

        // Ambil semua data akademik siswa
        $records = DataAkademik::where('id_siswa', $siswaId)->get();
        $mapelData = [];
        foreach ($records as $r) {
            // Normalisasi key mapel (contoh Matematika -> MTK)
            $key = $r->mata_pelajaran;
            if (stripos($key, 'Matematika') !== false) {
                $key = 'MTK';
            }
            $mapelData[$key] = $r;
        }

        // Kalkulasi Rata-Rata & Nilai Tertinggi
        $validScores = [];
        $highestScore = 0;
        $highestMapel = '-';

        foreach ($daftarMapelStandar as $key => $meta) {
            if (isset($mapelData[$key])) {
                $score = (float) $mapelData[$key]->rata_rata_nilai;
                $validScores[] = $score;
                if ($score > $highestScore) {
                    $highestScore = $score;
                    $highestMapel = $score . ' (' . $key . ')';
                }
            }
        }

        $rataRata = count($validScores) > 0 ? round(array_sum($validScores) / count($validScores), 1) : null;

        return view('Siswa.page.data_akademik', compact(
            'siswa',
            'daftarMapelStandar',
            'mapelData',
            'rataRata',
            'highestMapel',
            'records'
        ));
    }

    public function store(Request $request)
    {
        $siswa = $this->currentSiswa();
        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir. Silakan login kembali.'], 401);
        }

        $siswaId = $siswa->id_siswa ?? $siswa->getKey() ?? $siswa->id;

        $validated = $request->validate([
            'mata_pelajaran' => 'required|string|max:100',
            'mapel_semester' => 'required|string|max:50',
            'pengetahuan' => 'required|numeric|min:0|max:100',
            'keterampilan' => 'required|numeric|min:0|max:100',
        ], [
            'mata_pelajaran.required' => 'Mata pelajaran wajib dipilih.',
            'mapel_semester.required' => 'Semester wajib dipilih.',
            'pengetahuan.required' => 'Nilai pengetahuan wajib diisi.',
            'pengetahuan.min' => 'Nilai minimal 0.',
            'pengetahuan.max' => 'Nilai maksimal 100.',
            'keterampilan.required' => 'Nilai keterampilan wajib diisi.',
            'keterampilan.min' => 'Nilai minimal 0.',
            'keterampilan.max' => 'Nilai maksimal 100.',
        ]);

        $pengetahuan = (float) $validated['pengetahuan'];
        $keterampilan = (float) $validated['keterampilan'];
        $rataRata = round(($pengetahuan + $keterampilan) / 2, 2);

        $mapelName = $validated['mata_pelajaran'];
        $searchMapels = [$mapelName];
        if ($mapelName === 'MTK') {
            $searchMapels[] = 'Matematika';
        } elseif ($mapelName === 'Matematika') {
            $searchMapels[] = 'MTK';
        }

        $existing = DataAkademik::where('id_siswa', $siswaId)
            ->whereIn('mata_pelajaran', $searchMapels)
            ->where('mapel_semester', $validated['mapel_semester'])
            ->first();

        if ($existing) {
            $existing->update([
                'mata_pelajaran' => $mapelName,
                'pengetahuan' => $pengetahuan,
                'keterampilan' => $keterampilan,
                'rata_rata_nilai' => $rataRata,
            ]);
            $akademik = $existing;
        } else {
            $akademik = DataAkademik::create([
                'id_siswa' => $siswaId,
                'mata_pelajaran' => $mapelName,
                'mapel_semester' => $validated['mapel_semester'],
                'pengetahuan' => $pengetahuan,
                'keterampilan' => $keterampilan,
                'rata_rata_nilai' => $rataRata,
            ]);
        }

        // Ambil data keseluruhan untuk menghitung ulang rata-rata global siswa
        $allRecords = DataAkademik::where('id_siswa', $siswaId)->get();
        $globalAvg = round($allRecords->avg('rata_rata_nilai'), 1);
        $highestRecord = $allRecords->sortByDesc('rata_rata_nilai')->first();
        $highestMapelStr = $highestRecord ? $highestRecord->rata_rata_nilai . ' (' . $highestRecord->mata_pelajaran . ')' : '-';

        return response()->json([
            'success' => true,
            'message' => 'Nilai rapor mata pelajaran ' . $validated['mata_pelajaran'] . ' berhasil disimpan ke database.',
            'data' => [
                'id_akademik' => $akademik->id_akademik,
                'mata_pelajaran' => $akademik->mata_pelajaran,
                'mapel_semester' => $akademik->mapel_semester,
                'pengetahuan' => $akademik->pengetahuan,
                'keterampilan' => $akademik->keterampilan,
                'rata_rata_nilai' => $akademik->rata_rata_nilai,
                'predikat' => $akademik->predikat,
                'global_avg' => $globalAvg,
                'highest_mapel' => $highestMapelStr,
            ]
        ]);
    }
}
