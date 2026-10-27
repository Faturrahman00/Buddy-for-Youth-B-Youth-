<?php

namespace App\Services;

use App\Models\ProgramStudi;

class AsesmenAIService
{
    /**
     * Pemetaan 42 item soal ke 6 tipe Holland RIASEC.
     * Masing-masing tipe terdiri dari tepat 7 soal.
     */
    public const RIASEC_MAP = [
        'R' => [1, 7, 14, 22, 30, 32, 37],
        'I' => [2, 11, 18, 21, 26, 33, 39],
        'A' => [3, 8, 17, 23, 27, 31, 41],
        'S' => [4, 12, 13, 20, 28, 34, 40],
        'E' => [5, 10, 16, 19, 29, 36, 42],
        'C' => [6, 9, 15, 24, 25, 35, 38],
    ];

    /**
     * Definisi lengkap 6 tipe RIASEC sesuai standar psikometri dan petunjuk asesmen.
     */
    public const RIASEC_INFO = [
        'R' => [
            'code' => 'R',
            'name' => 'Realistic',
            'headline' => 'Praktis, teknis, dan suka bekerja langsung',
            'badge_color' => '#2E7D32',
            'badge_bg' => '#E8F5E9',
            'description' => 'Anda cenderung tertarik pada aktivitas yang melibatkan praktik, penggunaan alat, pengoperasian mesin, atau penyelesaian masalah secara langsung. Anda mungkin lebih menikmati belajar melalui praktik daripada hanya membaca teori. Aktivitas yang menghasilkan sesuatu yang konkret juga bisa terasa memuaskan bagi Anda.',
            'jurusan' => [
                'Teknik Mesin',
                'Teknik Elektro',
                'Teknik Sipil',
                'Teknik Otomotif',
                'Teknologi Pertanian',
                'Teknik Lingkungan',
                'Pendidikan Jasmani dan Olahraga',
            ],
            'karier' => [
                'Teknisi atau teknisi laboratorium',
                'Insinyur',
                'Mekanik',
                'Operator peralatan teknis',
                'Ahli konstruksi',
                'Teknisi jaringan',
                'Praktisi bidang pertanian atau lingkungan',
            ],
            'lingkungan' => 'kegiatan praktik, kerja lapangan, penggunaan teknologi atau peralatan, serta tugas dengan hasil yang konkret.',
        ],
        'I' => [
            'code' => 'I',
            'name' => 'Investigative',
            'headline' => 'Analitis, ingin tahu, dan suka mencari jawaban',
            'badge_color' => '#1565C0',
            'badge_bg' => '#E3F2FD',
            'description' => 'Anda cenderung tertarik memahami bagaimana sesuatu bekerja, mencari penyebab suatu masalah, menganalisis informasi, dan menemukan solusi berdasarkan bukti. Anda mungkin menikmati aktivitas yang menantang pemikiran, membutuhkan rasa ingin tahu, atau mengharuskan Anda mempelajari sesuatu secara mendalam.',
            'jurusan' => [
                'Psikologi',
                'Statistika',
                'Matematika',
                'Informatika atau Ilmu Komputer',
                'Kedokteran',
                'Biologi',
                'Kimia',
                'Ilmu Data',
            ],
            'karier' => [
                'Peneliti',
                'Data analyst atau data scientist',
                'Programmer atau software developer',
                'Analis laboratorium',
                'Psikolog, setelah memenuhi pendidikan dan persyaratan profesi',
                'Dokter, setelah memenuhi pendidikan dan persyaratan profesi',
                'Analis bisnis',
                'Analis riset',
            ],
            'lingkungan' => 'kegiatan analisis, pemecahan masalah, eksperimen, riset, dan pekerjaan yang memberi ruang untuk terus belajar.',
        ],
        'A' => [
            'code' => 'A',
            'name' => 'Artistic',
            'headline' => 'Kreatif, ekspresif, dan suka mengeksplorasi ide',
            'badge_color' => '#7B1FA2',
            'badge_bg' => '#F3E5F5',
            'description' => 'Anda cenderung tertarik pada aktivitas yang memberi ruang untuk berkreasi, mengekspresikan gagasan, dan mencoba pendekatan yang berbeda. Anda mungkin menikmati proses merancang sesuatu, menghasilkan karya, atau menyampaikan pesan melalui tulisan, gambar, musik, dan media lainnya.',
            'jurusan' => [
                'Desain Komunikasi Visual',
                'Desain Produk',
                'Seni Rupa',
                'Film dan Televisi',
                'Musik',
                'Sastra atau Penulisan Kreatif',
                'Desain Interior',
                'Ilmu Komunikasi',
            ],
            'karier' => [
                'Desainer grafis',
                'Ilustrator',
                'Penulis atau editor',
                'Fotografer atau videografer',
                'Seniman atau musisi',
                'Content creator',
                'Desainer produk',
                'Art director',
            ],
            'lingkungan' => 'pekerjaan yang fleksibel, proses kreatif, eksplorasi ide, serta kesempatan untuk mengembangkan gaya dan perspektif pribadi.',
        ],
        'S' => [
            'code' => 'S',
            'name' => 'Social',
            'headline' => 'Peduli, komunikatif, dan senang membantu orang lain',
            'badge_color' => '#00897B',
            'badge_bg' => '#E0F2F1',
            'description' => 'Anda cenderung tertarik pada aktivitas yang melibatkan interaksi, pendampingan, pengajaran, atau dukungan terhadap orang lain. Anda mungkin merasa berarti ketika dapat membantu seseorang memahami sesuatu, mengatasi kesulitan, atau mengembangkan kemampuannya.',
            'jurusan' => [
                'Psikologi',
                'Pendidikan',
                'Bimbingan dan Konseling',
                'Kesejahteraan Sosial',
                'Keperawatan',
                'Kesehatan Masyarakat',
                'Sosiologi',
                'Ilmu Komunikasi',
            ],
            'karier' => [
                'Guru atau pendidik',
                'Konselor, sesuai kualifikasi profesi',
                'Psikolog, setelah memenuhi pendidikan dan persyaratan profesi',
                'Pekerja sosial',
                'Perawat',
                'Fasilitator pelatihan',
                'Pendamping komunitas',
                'Staf pengembangan sumber daya manusia',
            ],
            'lingkungan' => 'kerja tim, interaksi dengan banyak orang, kegiatan pelayanan, pendidikan, dan program yang memberikan manfaat bagi orang lain.',
        ],
        'E' => [
            'code' => 'E',
            'name' => 'Enterprising',
            'headline' => 'Persuasif, berinisiatif, dan suka menggerakkan orang',
            'badge_color' => '#E65100',
            'badge_bg' => '#FFF3E0',
            'description' => 'Anda cenderung tertarik pada aktivitas yang melibatkan kepemimpinan, komunikasi persuasif, pengambilan keputusan, atau pengembangan peluang. Anda mungkin menikmati tantangan untuk mencapai target, membangun jaringan, mengelola proyek, atau mengajak orang lain bergerak menuju tujuan bersama.',
            'jurusan' => [
                'Manajemen',
                'Administrasi Bisnis',
                'Bisnis Digital',
                'Kewirausahaan',
                'Ilmu Komunikasi',
                'Pemasaran',
                'Hubungan Internasional',
                'Administrasi Publik',
            ],
            'karier' => [
                'Wirausahawan',
                'Manajer proyek',
                'Business development',
                'Staf pemasaran atau sales',
                'Public relations',
                'Konsultan bisnis',
                'Pengelola program',
                'Pemimpin tim atau organisasi',
            ],
            'lingkungan' => 'pekerjaan yang dinamis, kesempatan mengambil inisiatif, membangun relasi, mengembangkan gagasan, dan mengoordinasikan orang atau sumber daya.',
        ],
        'C' => [
            'code' => 'C',
            'name' => 'Conventional',
            'headline' => 'Terstruktur, teliti, dan menyukai keteraturan',
            'badge_color' => '#455A64',
            'badge_bg' => '#ECEFF1',
            'description' => 'Anda cenderung tertarik pada aktivitas yang membutuhkan ketelitian, pengorganisasian informasi, pengelolaan data, dan penerapan prosedur yang jelas. Anda mungkin menikmati pekerjaan yang sistematis, memiliki alur kerja teratur, serta membutuhkan konsistensi dan perhatian terhadap detail.',
            'jurusan' => [
                'Akuntansi',
                'Manajemen',
                'Administrasi Bisnis',
                'Administrasi Perkantoran',
                'Sistem Informasi',
                'Manajemen Informatika',
                'Perpajakan',
                'Statistika',
            ],
            'karier' => [
                'Akuntan',
                'Staf administrasi',
                'Analis keuangan',
                'Auditor',
                'Pengelola data',
                'Staf operasional',
                'Analis sistem',
                'Staf pengelolaan dokumen',
            ],
            'lingkungan' => 'pekerjaan dengan sistem yang jelas, prosedur terstruktur, pengelolaan informasi, serta tugas yang membutuhkan ketelitian dan konsistensi.',
        ],
    ];

    /**
     * Hitung skor RIASEC dari jawaban 42 soal.
     * 
     * @param array $answers [nomor_urut => nilai_1_sd_5]
     * @return array
     */
    public function calculateRiasecScores(array $answers): array
    {
        $rawScores = [
            'R' => 0,
            'I' => 0,
            'A' => 0,
            'S' => 0,
            'E' => 0,
            'C' => 0,
        ];

        // Konversi nilai Likert: A/1=1, B/2=2, C/3=3, D/4=4, E/5=5
        foreach (self::RIASEC_MAP as $type => $itemNumbers) {
            foreach ($itemNumbers as $num) {
                $val = $answers[$num] ?? $answers[(string)$num] ?? 3;
                if (is_string($val)) {
                    $valUpper = strtoupper(trim($val));
                    $mapChar = ['A' => 1, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 5];
                    $val = $mapChar[$valUpper] ?? (int)$val;
                }
                $val = max(1, min(5, (int)$val));
                $rawScores[$type] += $val;
            }
        }

        // Hitung persentase ketercapaian (skala 7 s/d 35 poin)
        $percentScores = [];
        foreach ($rawScores as $type => $score) {
            $percent = round(($score / 35) * 100, 1);
            $percentScores[$type] = $percent;
        }

        // Urutkan tipe dari skor tertinggi ke terendah
        $sortedList = [];
        foreach ($rawScores as $type => $score) {
            $sortedList[] = [
                'type' => $type,
                'score' => $score,
                'percent' => $percentScores[$type],
                'info' => self::RIASEC_INFO[$type],
            ];
        }

        $canonicalOrder = ['R' => 1, 'I' => 2, 'A' => 3, 'S' => 4, 'E' => 5, 'C' => 6];
        usort($sortedList, function ($a, $b) use ($canonicalOrder) {
            if ($b['score'] === $a['score']) {
                return ($canonicalOrder[$a['type']] ?? 9) <=> ($canonicalOrder[$b['type']] ?? 9);
            }
            return $b['score'] <=> $a['score'];
        });

        // Tentukan 3 tipe tertinggi dengan penanganan seri (Tie-Break Rule):
        // Jika ada skor sama pada batas peringkat ketiga, tampilkan semua tipe dengan skor seri tersebut.
        $topTypes = [];
        if (count($sortedList) >= 3) {
            $cutoffScore = $sortedList[2]['score'];
            foreach ($sortedList as $item) {
                if ($item['score'] >= $cutoffScore || count($topTypes) < 3) {
                    $topTypes[] = $item['type'];
                }
            }
        } else {
            $topTypes = array_column($sortedList, 'type');
        }

        $hollandCode = implode('–', $topTypes);

        return [
            'raw_scores' => $rawScores,
            'percent_scores' => $percentScores,
            'sorted_list' => $sortedList,
            'top_types' => $topTypes,
            'holland_code' => $hollandCode,
        ];
    }

    /**
     * Jalankan Python AI Engine (Forward Chaining Expert System + Vector Similarity).
     * Jika Python tidak tersedia atau gagal, otomatis fallback ke engine PHP tanpa error.
     */
    public function runPythonEngine(array $answers, ?array $raportGrades = null, bool $useRaport = false): ?array
    {
        $scriptPath = base_path('python/ai_engine.py');
        if (!file_exists($scriptPath)) {
            return null;
        }

        $catalog = ProgramStudi::all()->toArray();

        $payload = [
            'jawaban' => $answers,
            'katalog_prodi' => $catalog,
            'use_raport' => $useRaport,
            'raport_grades' => $raportGrades,
        ];

        try {
            $tmpFile = tempnam(sys_get_temp_dir(), 'byouth_ai_') . '.json';
            file_put_contents($tmpFile, json_encode($payload, JSON_UNESCAPED_UNICODE));

            // Jalankan via Symfony Process tanpa menulis bytecode (.pyc)
            $processEnv = array_merge($_ENV, $_SERVER, ['PYTHONDONTWRITEBYTECODE' => '1']);
            $process = new \Symfony\Component\Process\Process(['python', '-B', $scriptPath, $tmpFile], null, $processEnv);
            $process->setTimeout(15);
            $process->run();

            if (!$process->isSuccessful()) {
                // Fallback ke py command jika alias python belum di-PATH
                $process = new \Symfony\Component\Process\Process(['py', '-B', $scriptPath, $tmpFile], null, $processEnv);
                $process->setTimeout(15);
                $process->run();
            }

            @unlink($tmpFile);

            if ($process->isSuccessful()) {
                $rawOut = trim($process->getOutput());
                $data = json_decode($rawOut, true);
                if (is_array($data) && !empty($data['success'])) {
                    return $data;
                }
            }
        } catch (\Throwable $e) {
            // Abaikan dan gunakan fallback PHP
        }

        return null;
    }

    /**
     * Eksekusi keseluruhan alur asesmen AI (Python dengan Fallback PHP).
     */
    public function processAssessment(array $answers, ?array $raportGrades = null, bool $useRaport = false): array
    {
        // 1. Coba jalankan via Python AI Engine (Forward Chaining + Collaborative Filtering)
        $pyResult = $this->runPythonEngine($answers, $raportGrades, $useRaport);
        if ($pyResult && !empty($pyResult['success'])) {
            if (!empty($pyResult['recommendations'])) {
                $pyResult['recommendations'] = array_slice($pyResult['recommendations'], 0, 3);
            }
            return $pyResult;
        }

        // 2. Fallback: Eksekusi Native PHP
        $riasecResult = $this->calculateRiasecScores($answers);
        $recommendations = $this->generateRecommendations($riasecResult, $raportGrades, $useRaport);

        $topTypesInfo = [];
        foreach ($riasecResult['top_types'] as $type) {
            if (isset(self::RIASEC_INFO[$type])) {
                $topTypesInfo[] = self::RIASEC_INFO[$type];
            }
        }

        return [
            'success' => true,
            'ai_engine' => 'PHP Native (Multi-Criteria Holland RIASEC Engine)',
            'riasec_result' => $riasecResult,
            'top_types_info' => $topTypesInfo,
            'recommendations' => $recommendations,
            'inference_trace' => [],
            'use_raport' => $useRaport,
            'raport_grades' => $useRaport ? $raportGrades : null,
        ];
    }

    /**
     * Hitung rekomendasi program studi dengan AI Matching Engine.
     * Mengaitkan profil minat RIASEC dengan nilai raport (jika ada/opsional).
     *
     * @param array $riasecResult
     * @param array|null $raportGrades [ 'Matematika' => 90, 'IPAS' => 88, 'Bahasa Indonesia' => 86, 'Bahasa Inggris' => 90 ]
     * @param bool $useRaport
     * @return array
     */
    public function generateRecommendations(array $riasecResult, ?array $raportGrades = null, bool $useRaport = false): array
    {
        $topTypes = $riasecResult['top_types'];
        $rawScores = $riasecResult['raw_scores'];
        $percentScores = $riasecResult['percent_scores'];
        $hollandCode = $riasecResult['holland_code'];

        $hasValidRaport = $useRaport && !empty($raportGrades) && is_array($raportGrades);

        // Ambil seluruh program studi dari database
        $prodis = ProgramStudi::all();
        if ($prodis->isEmpty()) {
            return [];
        }

        $recommendations = [];

        foreach ($prodis as $prodi) {
            // Analisis kecocokan RIASEC
            $prodiRiasecTags = array_map('trim', explode(',', strtoupper($prodi->tipe_riasec ?? '')));
            
            $riasecMatchScore = $this->calculateProdiRiasecAffinity($prodiRiasecTags, $topTypes, $percentScores);

            $academicScore = 0;
            $academicDetails = [];
            $alasanAI = '';

            if ($hasValidRaport) {
                // Hitung keselarasan nilai raport akademik terhadap rumpun prodi
                $academicCalc = $this->calculateAcademicAffinity($prodi, $raportGrades);
                $academicScore = $academicCalc['score'];
                $academicDetails = $academicCalc['details'];

                // Formula Pembobotan Hibrida AI: 65% Minat RIASEC + 35% Keselarasan Akademik
                $finalScore = round((0.65 * $riasecMatchScore) + (0.35 * $academicScore), 1);

                // Buat narasi AI Sinergis (Minat + Raport)
                $alasanAI = $this->generateSynergyNarrative(
                    $prodi, 
                    $hollandCode, 
                    $academicDetails
                );
            } else {
                // Murni berbasis RIASEC tanpa pengurangan apapun
                $finalScore = round($riasecMatchScore, 1);
                $alasanAI = $this->generatePureMinatNarrative(
                    $prodi, 
                    $hollandCode
                );
            }

            // Cap batas 99% agar realistis
            $finalScore = min(99.0, max(50.0, $finalScore));

            $recommendations[] = [
                'prodi_id' => $prodi->id_prodi ?? $prodi->id,
                'prodi' => $prodi,
                'nama_prodi' => $prodi->nama_prodi,
                'kode_prodi' => $prodi->kode_prodi,
                'deskripsi' => $prodi->deskripsi,
                'prospek_karier' => $prodi->prospek_karier,
                'skor' => $finalScore,
                'skor_minat' => round($riasecMatchScore, 1),
                'skor_akademik' => $hasValidRaport ? round($academicScore, 1) : null,
                'alasan' => $alasanAI,
                'tipe_riasec' => $prodi->tipe_riasec,
            ];
        }

        // Urutkan rekomendasi berdasarkan skor kecocokan tertinggi dan ambil 3 terbaik
        usort($recommendations, fn($a, $b) => $b['skor'] <=> $a['skor']);

        return array_slice($recommendations, 0, 3);
    }

    /**
     * Hitung keselarasan RIASEC prodi dengan profil siswa.
     */
    protected function calculateProdiRiasecAffinity(array $prodiTags, array $topTypes, array $percentScores): float
    {
        if (empty($prodiTags) || empty($prodiTags[0])) {
            return 75.0;
        }

        $scoreSum = 0;
        $weightSum = 0;

        // Bobot prioritas: tag pertama prodi bobot 1.0, kedua 0.7, ketiga 0.5
        $tagWeights = [1.0, 0.7, 0.5];

        foreach ($prodiTags as $idx => $tag) {
            $w = $tagWeights[$idx] ?? 0.4;
            $typePercent = $percentScores[$tag] ?? 50.0;

            // Beri bonus jika tag merupakan top rank siswa
            $rankBonus = 0;
            if (in_array($tag, $topTypes, true)) {
                $pos = array_search($tag, $topTypes, true);
                $rankBonus = (3 - min(2, $pos)) * 4.0; // Bonus hingga +12 poin
            }

            $scoreSum += ($typePercent + $rankBonus) * $w;
            $weightSum += $w;
        }

        $base = $weightSum > 0 ? ($scoreSum / $weightSum) : 75.0;
        return min(98.5, max(55.0, $base));
    }

    /**
     * Hitung keselarasan nilai raport akademik.
     */
    protected function calculateAcademicAffinity(ProgramStudi $prodi, array $raportGrades): array
    {
        // Normalisasi key mata pelajaran
        $grades = [];
        foreach ($raportGrades as $key => $val) {
            $cleanedKey = strtolower(str_replace([' ', '_', '-'], '', $key));
            $grades[$cleanedKey] = (float)$val;
        }

        $mtk = $grades['matematika'] ?? $grades['mtk'] ?? 78.0;
        $ipas = $grades['ipas'] ?? $grades['ipa'] ?? $grades['fisika'] ?? 78.0;
        $indo = $grades['bahasaindonesia'] ?? $grades['indonesia'] ?? 78.0;
        $ing = $grades['bahasainggris'] ?? $grades['inggris'] ?? 78.0;

        $prodiName = strtolower($prodi->nama_prodi);

        // Tentukan bobot mata pelajaran berdasarkan disiplin ilmu
        if (str_contains($prodiName, 'komputer') || str_contains($prodiName, 'informatika') || str_contains($prodiName, 'mesin') || str_contains($prodiName, 'sipil') || str_contains($prodiName, 'teknik') || str_contains($prodiName, 'elektro') || str_contains($prodiName, 'mekatronika') || str_contains($prodiName, 'pertanian') || str_contains($prodiName, 'agroteknologi') || str_contains($prodiName, 'lingkungan') || str_contains($prodiName, 'tambang') || str_contains($prodiName, 'geologi')) {
            $academicScore = (0.45 * $mtk) + (0.35 * $ipas) + (0.20 * $ing);
            $keyMapels = ['Matematika' => $mtk, 'IPAS' => $ipas];
        } elseif (str_contains($prodiName, 'kedokteran') || str_contains($prodiName, 'kesehatan') || str_contains($prodiName, 'biologi') || str_contains($prodiName, 'bioteknologi') || str_contains($prodiName, 'farmasi') || str_contains($prodiName, 'keperawatan') || str_contains($prodiName, 'gizi')) {
            $academicScore = (0.50 * $ipas) + (0.30 * $mtk) + (0.20 * $ing);
            $keyMapels = ['IPAS/Biologi' => $ipas, 'Matematika' => $mtk];
        } elseif (str_contains($prodiName, 'akuntansi') || str_contains($prodiName, 'manajemen') || str_contains($prodiName, 'bisnis') || str_contains($prodiName, 'statistika') || str_contains($prodiName, 'aktuaria') || str_contains($prodiName, 'logistik') || str_contains($prodiName, 'perbankan') || str_contains($prodiName, 'pemasaran')) {
            $academicScore = (0.45 * $mtk) + (0.30 * $ing) + (0.25 * $indo);
            $keyMapels = ['Matematika' => $mtk, 'Bahasa Inggris' => $ing];
        } elseif (str_contains($prodiName, 'desain') || str_contains($prodiName, 'seni') || str_contains($prodiName, 'dkv') || str_contains($prodiName, 'arsitektur') || str_contains($prodiName, 'film') || str_contains($prodiName, 'musik') || str_contains($prodiName, 'interior')) {
            $academicScore = (0.35 * $indo) + (0.35 * $ing) + (0.15 * $mtk) + (0.15 * $ipas);
            $keyMapels = ['Bahasa Indonesia' => $indo, 'Bahasa Inggris' => $ing];
        } else {
            // Sosial, Humaniora, Psikologi, Komunikasi, Hukum, Hubungan Internasional, Sastra, BK, PGSD, Kesos
            $academicScore = (0.40 * $indo) + (0.30 * $ing) + (0.30 * $ipas);
            $keyMapels = ['Bahasa Indonesia' => $indo, 'IPAS/Sosial' => $ipas];
        }

        return [
            'score' => $academicScore,
            'details' => $keyMapels,
        ];
    }

    /**
     * Buat narasi AI sinergi kecocokan (Minat RIASEC + Nilai Raport).
     */
    protected function generateSynergyNarrative(
        ProgramStudi $prodi, 
        string $hollandCode, 
        array $academicDetails
    ): string {
        $mapelHighlights = [];
        foreach ($academicDetails as $mapel => $nilai) {
            $mapelHighlights[] = "{$mapel} ({$nilai})";
        }
        $mapelStr = implode(' dan ', $mapelHighlights);

        return "Kombinasi minat dominan Anda [{$hollandCode}] berpadu selaras dengan pencapaian belajar pada mata pelajaran {$mapelStr}. Hal ini menunjukkan potensi besar dan motivasi kuat untuk berkembang optimal di program studi {$prodi->nama_prodi}.";
    }

    /**
     * Buat narasi kecocokan minat murni (tanpa nilai raport).
     */
    protected function generatePureMinatNarrative(
        ProgramStudi $prodi, 
        string $hollandCode
    ): string {
        return "Berdasarkan hasil asesmen minat [{$hollandCode}], program studi {$prodi->nama_prodi} sangat sesuai dengan cara berpikir, kegiatan yang Anda sukai, serta lingkungan belajar yang nyaman bagi Anda.";
    }
}
