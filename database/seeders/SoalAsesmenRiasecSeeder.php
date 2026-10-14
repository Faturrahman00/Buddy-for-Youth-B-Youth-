<?php

namespace Database\Seeders;

use App\Models\SoalAsesmen;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class SoalAsesmenRiasecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['label' => 'A', 'teks' => 'Sangat tidak setuju', 'bobot' => 1],
            ['label' => 'B', 'teks' => 'Tidak setuju', 'bobot' => 2],
            ['label' => 'C', 'teks' => 'Agak setuju', 'bobot' => 3],
            ['label' => 'D', 'teks' => 'Setuju', 'bobot' => 4],
            ['label' => 'E', 'teks' => 'Sangat setuju', 'bobot' => 5],
        ];

        // 42 Soal RIASEC
        $questions = [
            [1, 'R', 'Saya suka mengotak-atik mobil'],
            [2, 'I', 'Saya suka bermain puzzle'],
            [3, 'A', 'Saya suka bekerja sendiri'],
            [4, 'S', 'Saya suka bekerja dalam tim'],
            [5, 'E', 'Saya adalah orang yang ambisius'],
            [6, 'C', 'Saya suka menyusun dan mengatur barang-barang'],
            [7, 'R', 'Saya suka membangun sesuatu'],
            [8, 'A', 'Saya suka membaca tentang seni dan music'],
            [9, 'C', 'Saya lebih suka memiliki instruksi yang jelas untuk diikuti dalam bekerja'],
            [10, 'E', 'Saya suka memengaruhi dan mempersuasi orang'],
            [11, 'I', 'Saya suka melakukan eksperimen'],
            [12, 'S', 'Saya suka mengajar atau melatih orang lain'],
            [13, 'S', 'Saya suka membantu dan memecahkan masalah yang dialami orang lain'],
            [14, 'R', 'Saya suka merawat Binatang'],
            [15, 'C', 'Saya tidak keberatan bekerja \'9-to-5\' di kantor'],
            [16, 'E', 'Saya suka menjual sesuatu'],
            [17, 'A', 'Saya suka menulis'],
            [18, 'I', 'Saya menikmati membaca topik tentang science dan penelitian'],
            [19, 'E', 'Saya cepat dalam mengambil tanggung jawab baru'],
            [20, 'S', 'Saya tertarik untuk menyembuhkan penyakit yang dialami orang lain'],
            [21, 'I', 'Saya suka mencari tahu mengapa sebuah benda bisa bekerja'],
            [22, 'R', 'Saya suka menyusun dan merakit sesuatu'],
            [23, 'A', 'Saya adalah orang yang kreatif'],
            [24, 'C', 'Saya memberi perhatian terhadap detail'],
            [25, 'C', 'Saya suka mengetik'],
            [26, 'I', 'Saya suka menganalisis sesuatu (masalah/situasi)'],
            [27, 'A', 'Saya suka memainkan instrumen (atau bernyanyi)'],
            [28, 'S', 'Saya suka mempelajari budaya yang berbeda'],
            [29, 'E', 'Saya ingin memulai bisnis saya sendiri'],
            [30, 'R', 'Saya suka memasak'],
            [31, 'A', 'Saya suka bermain peran'],
            [32, 'R', 'Saya adalah orang yang praktikal'],
            [33, 'I', 'Saya suka bermain-main dengan angka dan diagram'],
            [34, 'S', 'Saya suka mendiskusikan berbagai isu'],
            [35, 'C', 'Saya suka mendokumentasikan pekerjaan saya dengan baik (menyimpan file, menyusun file, dsb.)'],
            [36, 'E', 'Saya suka menjadi pemimpin'],
            [37, 'R', 'Saya suka bekerja di tempat outdoor'],
            [38, 'C', 'Saya suka bekerja di kantor'],
            [39, 'I', 'Saya hebat dalam matematika'],
            [40, 'S', 'Saya suka menolong orang'],
            [41, 'A', 'Saya suka menggambar'],
            [42, 'E', 'Saya suka berpidato'],
        ];

        $kategoriFull = [
            'R' => 'REALISTIC',
            'I' => 'INVESTIGATIVE',
            'A' => 'ARTISTIC',
            'S' => 'SOCIAL',
            'E' => 'ENTERPRISING',
            'C' => 'CONVENTIONAL',
        ];

        foreach ($questions as [$no, $type, $text]) {
            SoalAsesmen::updateOrCreate(
                ['nomor_urut' => $no],
                [
                    'kategori' => $kategoriFull[$type] ?? $type,
                    'tipe_riasec' => $type,
                    'pertanyaan' => $text,
                    'pilihan_jawaban' => $options,
                    'is_aktif' => true,
                ]
            );
        }

        // Program Studi Katalog Lengkap RIASEC
        $prodis = [
            [
                'kode_prodi' => 'PRODI-TI',
                'nama_prodi' => 'Teknik Informatika / Ilmu Komputer',
                'tipe_riasec' => 'I,R,C',
                'jenjang' => 'S1',
                'fakultas' => 'Ilmu Komputer & Rekayasa',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari rekayasa perangkat lunak, arsitektur komputasi, algoritma logika, kecerdasan buatan, dan pengembangan sistem skala besar.',
                'prospek_karier' => 'Software Engineer, Data Scientist, AI Specialist, Cloud Architect, Sistem Analis',
                'kampus_rekomendasi' => 'ITB, UI, ITS, UGM, Binus University',
            ],
            [
                'kode_prodi' => 'PRODI-SI',
                'nama_prodi' => 'Sistem Informasi',
                'tipe_riasec' => 'C,I,E',
                'jenjang' => 'S1',
                'fakultas' => 'Ilmu Komputer & Sistem Informasi',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Menjembatani keahlian teknologi informasi dengan proses bisnis organisasi, tata kelola data terstruktur, dan inovasi enterprise.',
                'prospek_karier' => 'Product Manager, IT Consultant, Business Analyst, Enterprise Systems Specialist',
                'kampus_rekomendasi' => 'UI, ITS, Telkom University, Binus University',
            ],
            [
                'kode_prodi' => 'PRODI-PSI',
                'nama_prodi' => 'Psikologi',
                'tipe_riasec' => 'S,I,A',
                'jenjang' => 'S1',
                'fakultas' => 'Psikologi',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari perilaku manusia, proses mental analitis, asesmen psikologis kognitif, serta dinamika kesehatan mental individu dan kelompok.',
                'prospek_karier' => 'Psikolog (lanjut profesi), Konselor Pendidikan, HR Specialist, People Development, UX Researcher',
                'kampus_rekomendasi' => 'UI, UGM, Unpad, Unair, Undip',
            ],
            [
                'kode_prodi' => 'PRODI-DKV',
                'nama_prodi' => 'Desain Komunikasi Visual (DKV)',
                'tipe_riasec' => 'A,E,R',
                'jenjang' => 'S1',
                'fakultas' => 'Seni Rupa & Desain',
                'akreditasi' => 'A',
                'deskripsi' => 'Mengeksplorasi perancangan komunikasi visual melalui media cetak, interaktif digital, ilustrasi, branding, animasi, dan storytelling estetis.',
                'prospek_karier' => 'Art Director, UI/UX Designer, Creative Director, Motion Graphic Artist, Content Creator',
                'kampus_rekomendasi' => 'ITB (FSRD), ISI Yogyakarta, UMN, Telkom University',
            ],
            [
                'kode_prodi' => 'PRODI-MBD',
                'nama_prodi' => 'Manajemen Bisnis Digital & Kewirausahaan',
                'tipe_riasec' => 'E,C,S',
                'jenjang' => 'S1',
                'fakultas' => 'Ekonomi & Bisnis',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari strategi kepemimpinan korporat, model rintisan bisnis (startup), pemasaran digital, negosiasi kemitraan, dan pengembangan organisasi.',
                'prospek_karier' => 'Wirausahawan / Startup Founder, Business Development, Project Manager, Digital Marketer',
                'kampus_rekomendasi' => 'ITB (SBM), UI, UGM, Unpad, Prasetiya Mulya',
            ],
            [
                'kode_prodi' => 'PRODI-TM',
                'nama_prodi' => 'Teknik Mesin & Otomotif',
                'tipe_riasec' => 'R,I,C',
                'jenjang' => 'S1',
                'fakultas' => 'Teknik & Rekayasa',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari konversi energi, perancangan mekanikal alat berat dan otomotif, manufaktur presisi, serta perawatan mesin industri.',
                'prospek_karier' => 'Mechanical Engineer, Insinyur Otomotif, Maintenance Engineer, Operator Pabrik Manufaktur',
                'kampus_rekomendasi' => 'ITB, ITS, Undip, UGM, Polinema',
            ],
            [
                'kode_prodi' => 'PRODI-TS',
                'nama_prodi' => 'Teknik Sipil & Konstruksi',
                'tipe_riasec' => 'R,I,C',
                'jenjang' => 'S1',
                'fakultas' => 'Teknik Sipil & Perencanaan',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari perancangan struktur bangunan tahan gempa, jembatan, jalan raya, manajemen proyek konstruksi, dan infrastruktur fisik.',
                'prospek_karier' => 'Civil Engineer, Ahli Konstruksi, Project Engineer, Surveyor Lapangan, Konsultan Struktur',
                'kampus_rekomendasi' => 'ITB, UI, UGM, ITS, Undip',
            ],
            [
                'kode_prodi' => 'PRODI-STAT',
                'nama_prodi' => 'Statistika & Sains Data',
                'tipe_riasec' => 'I,C,R',
                'jenjang' => 'S1',
                'fakultas' => 'Matematika & Ilmu Pengetahuan Alam',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari pemodelan matematika probabilitas, analisis big data, machine learning kuantitatif, dan penarikan kesimpulan berbasis data bukti.',
                'prospek_karier' => 'Data Analyst, Data Scientist, Aktuaris, Peneliti Kuantitatif, Analis Risiko Finansial',
                'kampus_rekomendasi' => 'IPB, ITS, UGM, Unpad, UI',
            ],
            [
                'kode_prodi' => 'PRODI-KED',
                'nama_prodi' => 'Kedokteran & Profesi Dokter',
                'tipe_riasec' => 'I,S,R',
                'jenjang' => 'S1',
                'fakultas' => 'Kedokteran',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari ilmu biomedis, patologi klinis, diagnosis penyakit, dan penanganan terapeutik untuk penyembuhan dan kesehatan manusia.',
                'prospek_karier' => 'Dokter Umum/Spesialis, Peneliti Klinis Medis, Konsultan Kesehatan Masyarakat',
                'kampus_rekomendasi' => 'UI, UGM, Unair, Unpad, Undip',
            ],
            [
                'kode_prodi' => 'PRODI-AKT',
                'nama_prodi' => 'Akuntansi & Perpajakan',
                'tipe_riasec' => 'C,E,I',
                'jenjang' => 'S1',
                'fakultas' => 'Ekonomi & Bisnis',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari pencatatan keuangan sistematis, audit kepatuhan regulasi, pelaporan akuntansi korporat, dan perencanaan perpajakan terstruktur.',
                'prospek_karier' => 'Akuntan Publik, Auditor Keuangan, Tax Consultant, Analis Finansial, Financial Controller',
                'kampus_rekomendasi' => 'UI, UGM, Unair, Undip, STAN',
            ],
            [
                'kode_prodi' => 'PRODI-BK',
                'nama_prodi' => 'Bimbingan dan Konseling / Pendidikan',
                'tipe_riasec' => 'S,A,E',
                'jenjang' => 'S1',
                'fakultas' => 'Ilmu Pendidikan',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari teknik pendampingan konseling remaja, pedagogi pengajaran, pengembangan potensi peserta didik, dan fasilitasi komunitas.',
                'prospek_karier' => 'Guru Konselor (BK), Pendidik / Fasilitator Pelatihan, Pekerja Sosial, Konsultan Karir',
                'kampus_rekomendasi' => 'UPI Bandung, UNY Yogyakarta, UM Malang, UNJ Jakarta',
            ],
            [
                'kode_prodi' => 'PRODI-ILKOM',
                'nama_prodi' => 'Ilmu Komunikasi & Hubungan Masyarakat (PR)',
                'tipe_riasec' => 'E,S,A',
                'jenjang' => 'S1',
                'fakultas' => 'Ilmu Sosial & Ilmu Politik',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari komunikasi strategis publik, public relations, jurnalistik, negosiasi persuasif, dan media penyiaran.',
                'prospek_karier' => 'Public Relations Specialist, Brand Spokesperson, Media Specialist, Jurnalis, Corporate Communications',
                'kampus_rekomendasi' => 'UI, UGM, Unpad, Undip, UPN Veteran',
            ],
        ];

        foreach ($prodis as $item) {
            ProgramStudi::updateOrCreate(
                ['kode_prodi' => $item['kode_prodi']],
                $item
            );
        }
    }
}
