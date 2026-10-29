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

    public static function daftarMapelStandar(): array
    {
        return [
            'IPAS' => [
                'nama' => 'IPAS',
                'alias' => 'IPAS',
                'sub' => 'Ilmu Pengetahuan Alam & Sosial',
                'fillClass' => 'fill-ipas',
                'scoreClass' => 'score-ipas',
                'badgeClass' => 'badge-ipas'
            ],
            'MTK' => [
                'nama' => 'MTK',
                'alias' => 'Matematika (MTK)',
                'sub' => 'Logika & Kuantitatif',
                'fillClass' => 'fill-mtk',
                'scoreClass' => 'score-mtk',
                'badgeClass' => 'badge-mtk'
            ],
            'Bahasa Indonesia' => [
                'nama' => 'Bahasa Indonesia',
                'alias' => 'Bahasa Indonesia',
                'sub' => 'Komunikasi & Literasi',
                'fillClass' => 'fill-indo',
                'scoreClass' => 'score-indo',
                'badgeClass' => 'badge-indo'
            ],
            'Bahasa Inggris' => [
                'nama' => 'Bahasa Inggris',
                'alias' => 'Bahasa Inggris',
                'sub' => 'Bahasa Internasional',
                'fillClass' => 'fill-ing',
                'scoreClass' => 'score-ing',
                'badgeClass' => 'badge-ing'
            ],
        ];
    }

    public static function daftarSemester(): array
    {
        return [
            'Semester 1',
            'Semester 2',
            'Semester 3',
            'Semester 4',
            'Semester 5',
        ];
    }

    /**
     * Memastikan setiap siswa memiliki data nilai untuk semua semester (1-5) dengan default 0.
     */
    protected function ensureSemestersInitialized(int $siswaId): void
    {
        $semesters = self::daftarSemester();
        $mapels = ['IPAS', 'MTK', 'Bahasa Indonesia', 'Bahasa Inggris'];

        $existing = DataAkademik::where('id_siswa', $siswaId)->get();

        foreach ($semesters as $sem) {
            foreach ($mapels as $mapel) {
                $hasRecord = $existing->contains(function ($r) use ($sem, $mapel) {
                    if ($r->mapel_semester !== $sem) return false;
                    if ($mapel === 'MTK') {
                        return $r->mata_pelajaran === 'MTK' || stripos($r->mata_pelajaran, 'Matematika') !== false;
                    }
                    return $r->mata_pelajaran === $mapel;
                });

                if (!$hasRecord) {
                    $newRec = DataAkademik::create([
                        'id_siswa' => $siswaId,
                        'mapel_semester' => $sem,
                        'mata_pelajaran' => $mapel,
                        'pengetahuan' => 0.00,
                        'keterampilan' => 0.00,
                        'rata_rata_nilai' => 0.00,
                    ]);
                    $existing->push($newRec);
                }
            }
        }
    }

    /**
     * Menghitung rata-rata kumulatif 4 mapel pokok dari semester yang diisi siswa.
     */
    public static function calculateAverages($records): array
    {
        $daftarMapel = self::daftarMapelStandar();
        $mapelStats = [];
        $validMapelScores = [];
        $highestScore = 0;
        $highestMapel = '-';

        foreach ($daftarMapel as $key => $meta) {
            // Ambil semua nilai untuk mata pelajaran ini di seluruh semester
            $subRecords = $records->filter(function ($r) use ($key) {
                if ($key === 'MTK') {
                    return $r->mata_pelajaran === 'MTK' || stripos($r->mata_pelajaran, 'Matematika') !== false;
                }
                return $r->mata_pelajaran === $key;
            });

            // Semester yang sudah diisi oleh siswa (rata_rata_nilai > 0 atau pengetahuan/keterampilan > 0)
            $filled = $subRecords->filter(function ($r) {
                return (float)$r->rata_rata_nilai > 0 || (float)$r->pengetahuan > 0 || (float)$r->keterampilan > 0;
            });

            if ($filled->count() > 0) {
                $avg = round($filled->avg('rata_rata_nilai'), 1);
                $filledCount = $filled->count();
                $hasData = true;
                $validMapelScores[] = $avg;

                if ($avg > $highestScore) {
                    $highestScore = $avg;
                    $highestMapel = number_format($avg, 1) . ' (' . $key . ')';
                }
            } else {
                $avg = 0;
                $filledCount = 0;
                $hasData = false;
            }

            // Hitung predikat
            $predikat = '-';
            if ($hasData) {
                if ($avg >= 88) $predikat = 'A';
                elseif ($avg >= 78) $predikat = 'B+';
                elseif ($avg >= 70) $predikat = 'B';
                else $predikat = 'C';
            }

            $mapelStats[$key] = array_merge($meta, [
                'score' => $avg,
                'percent' => min(100, round($avg)),
                'predikat' => $predikat,
                'filled_count' => $filledCount,
                'has_data' => $hasData,
            ]);
        }

        $globalAvg = count($validMapelScores) > 0 ? round(array_sum($validMapelScores) / count($validMapelScores), 1) : null;

        return [
            'mapelStats' => $mapelStats,
            'globalAvg' => $globalAvg,
            'highestMapel' => $highestMapel,
        ];
    }

    public function index()
    {
        $siswa = $this->currentSiswa();
        $siswaId = $siswa->id_siswa ?? $siswa->id;

        // Pastikan setiap semester (1-5) memiliki 4 mata pelajaran default 0
        $this->ensureSemestersInitialized($siswaId);

        // Ambil semua records siswa
        $records = DataAkademik::where('id_siswa', $siswaId)->get();

        // Urutkan records berdasarkan semester (1 -> 5) dan urutan mapel standar
        $semOrder = [
            'Semester 1' => 1,
            'Semester 2' => 2,
            'Semester 3' => 3,
            'Semester 4' => 4,
            'Semester 5' => 5,
        ];
        $mapelOrder = [
            'IPAS' => 1,
            'MTK' => 2,
            'Matematika' => 2,
            'Bahasa Indonesia' => 3,
            'Bahasa Inggris' => 4,
        ];

        $sortedRecords = $records->sortBy(function ($r) use ($semOrder, $mapelOrder) {
            $s = $semOrder[$r->mapel_semester] ?? 99;
            $m = $mapelOrder[$r->mata_pelajaran] ?? 99;
            return $s * 10 + $m;
        })->values();

        // Hitung rata-rata kumulatif 4 mapel pokok dari semester yang diisi
        $calc = self::calculateAverages($records);
        $mapelStats = $calc['mapelStats'];
        $rataRata = $calc['globalAvg'];
        $highestMapel = $calc['highestMapel'];

        return view('Siswa.page.data_akademik', compact(
            'siswa',
            'mapelStats',
            'rataRata',
            'highestMapel',
            'sortedRecords'
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

        // Ambil data keseluruhan untuk menghitung ulang rata-rata kumulatif 4 mapel
        $allRecords = DataAkademik::where('id_siswa', $siswaId)->get();
        $calc = self::calculateAverages($allRecords);

        return response()->json([
            'success' => true,
            'message' => 'Nilai rapor ' . $validated['mata_pelajaran'] . ' (' . $validated['mapel_semester'] . ') berhasil disimpan.',
            'data' => [
                'id_akademik' => $akademik->id_akademik,
                'mata_pelajaran' => $akademik->mata_pelajaran,
                'mapel_semester' => $akademik->mapel_semester,
                'pengetahuan' => $akademik->pengetahuan,
                'keterampilan' => $akademik->keterampilan,
                'rata_rata_nilai' => $akademik->rata_rata_nilai,
                'predikat' => $akademik->predikat,
                'global_avg' => $calc['globalAvg'],
                'highest_mapel' => $calc['highestMapel'],
                'chart_stats' => $calc['mapelStats'],
            ]
        ]);
    }
}
