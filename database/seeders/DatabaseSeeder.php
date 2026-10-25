<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\DataAkademik;
use App\Models\Konsultasi;
use App\Models\ProgramStudi;
use App\Models\Psikolog;
use App\Models\Rekomendasi;
use App\Models\Siswa;
use App\Models\SoalAsesmen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@byouth.id'],
            [
                'nama' => 'Super Admin B-Youth',
                'kata_sandi' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
            ]
        );

        // 2. Seed Psikolog
        $psikolog1 = Psikolog::firstOrCreate(
            ['email' => 'maya.indriani@byouth.id'],
            [
                'nama' => 'Dra. Maya Indriani, M.Psi.',
                'kata_sandi' => Hash::make('password'),
                'jenis_kelamin' => 'Perempuan',
                'no_sip' => '8829/PSI/2020',
                'pendidikan_terakhir' => 'Magister Psikologi Profesi — Universitas Indonesia',
                'status' => 'Aktif',
                'no_telepon' => '081298765432',
                'spesialisasi' => 'Psikologi Pendidikan & Minat Bakat Remaja',
            ]
        );

        $psikolog2 = Psikolog::firstOrCreate(
            ['email' => 'hendra.gunawan@byouth.id'],
            [
                'nama' => 'Hendra Gunawan, S.Psi., M.Psi.',
                'kata_sandi' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-laki',
                'no_sip' => '7192/PSI/2021',
                'pendidikan_terakhir' => 'Magister Psikologi Klinis & Pendidikan — Universitas Gadjah Mada',
                'status' => 'Aktif',
                'no_telepon' => '081377889900',
                'spesialisasi' => 'Eksplorasi Karier & Konseling Perguruan Tinggi',
            ]
        );

        // 3. Seed Siswa
        $siswa1 = Siswa::firstOrCreate(
            ['email' => 'dimas.w@sma1.sch.id'],
            [
                'nama' => 'Dimas Wicaksono',
                'kata_sandi' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-laki',
                'sekolah' => 'SMA Negeri 1 Malang',
                'kelas' => 'XII MIPA 2',
                'semester' => 'Semester 5',
                'status' => 'Aktif',
                'no_telepon' => '085712345678',
            ]
        );

        $siswa2 = Siswa::firstOrCreate(
            ['email' => 'siti.sarah@sma3.sch.id'],
            [
                'nama' => 'Siti Sarah Rahmawati',
                'kata_sandi' => Hash::make('password'),
                'jenis_kelamin' => 'Perempuan',
                'sekolah' => 'SMA Negeri 3 Surabaya',
                'kelas' => 'XII IPS 1',
                'semester' => 'Semester 5',
                'status' => 'Aktif',
                'no_telepon' => '085812345678',
            ]
        );

        $siswa3 = Siswa::firstOrCreate(
            ['email' => 'rizky.r@smk2.sch.id'],
            [
                'nama' => 'Rizky Ramadhan',
                'kata_sandi' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-laki',
                'sekolah' => 'SMK Negeri 2 Bandung',
                'kelas' => 'XII TKJ 1',
                'semester' => 'Semester 5',
                'status' => 'Aktif',
                'no_telepon' => '085912345678',
            ]
        );

        // 4. Data Akademik Granular (Siswa 1: Dimas Wicaksono)
        $mapelsSiswa1 = [
            ['mata_pelajaran' => 'IPAS', 'pengetahuan' => 88.00, 'keterampilan' => 88.00, 'rata_rata_nilai' => 88.00],
            ['mata_pelajaran' => 'Matematika', 'pengetahuan' => 92.00, 'keterampilan' => 92.00, 'rata_rata_nilai' => 92.00],
            ['mata_pelajaran' => 'Bahasa Indonesia', 'pengetahuan' => 86.00, 'keterampilan' => 88.00, 'rata_rata_nilai' => 87.00],
            ['mata_pelajaran' => 'Bahasa Inggris', 'pengetahuan' => 90.00, 'keterampilan' => 90.00, 'rata_rata_nilai' => 90.00],
        ];

        foreach ($mapelsSiswa1 as $m) {
            DataAkademik::firstOrCreate(
                [
                    'id_siswa' => $siswa1->id_siswa,
                    'mapel_semester' => 'Semester 5',
                    'mata_pelajaran' => $m['mata_pelajaran'],
                ],
                [
                    'pengetahuan' => $m['pengetahuan'],
                    'keterampilan' => $m['keterampilan'],
                    'rata_rata_nilai' => $m['rata_rata_nilai'],
                ]
            );
        }

        // Data Akademik Granular (Siswa 2: Siti Sarah Rahmawati)
        $mapelsSiswa2 = [
            ['mata_pelajaran' => 'IPAS', 'pengetahuan' => 86.00, 'keterampilan' => 86.00, 'rata_rata_nilai' => 86.00],
            ['mata_pelajaran' => 'Matematika', 'pengetahuan' => 90.00, 'keterampilan' => 90.00, 'rata_rata_nilai' => 90.00],
            ['mata_pelajaran' => 'Bahasa Indonesia', 'pengetahuan' => 92.00, 'keterampilan' => 92.00, 'rata_rata_nilai' => 92.00],
            ['mata_pelajaran' => 'Bahasa Inggris', 'pengetahuan' => 91.00, 'keterampilan' => 91.00, 'rata_rata_nilai' => 91.00],
        ];

        foreach ($mapelsSiswa2 as $m) {
            DataAkademik::firstOrCreate(
                [
                    'id_siswa' => $siswa2->id_siswa,
                    'mapel_semester' => 'Semester 5',
                    'mata_pelajaran' => $m['mata_pelajaran'],
                ],
                [
                    'pengetahuan' => $m['pengetahuan'],
                    'keterampilan' => $m['keterampilan'],
                    'rata_rata_nilai' => $m['rata_rata_nilai'],
                ]
            );
        }

        // Data Akademik Granular (Siswa 3: Rizky Ramadhan)
        $mapelsSiswa3 = [
            ['mata_pelajaran' => 'IPAS', 'pengetahuan' => 85.00, 'keterampilan' => 85.00, 'rata_rata_nilai' => 85.00],
            ['mata_pelajaran' => 'Matematika', 'pengetahuan' => 88.00, 'keterampilan' => 88.00, 'rata_rata_nilai' => 88.00],
            ['mata_pelajaran' => 'Bahasa Indonesia', 'pengetahuan' => 87.00, 'keterampilan' => 87.00, 'rata_rata_nilai' => 87.00],
            ['mata_pelajaran' => 'Bahasa Inggris', 'pengetahuan' => 89.00, 'keterampilan' => 89.00, 'rata_rata_nilai' => 89.00],
        ];

        foreach ($mapelsSiswa3 as $m) {
            DataAkademik::firstOrCreate(
                [
                    'id_siswa' => $siswa3->id_siswa,
                    'mapel_semester' => 'Semester 5',
                    'mata_pelajaran' => $m['mata_pelajaran'],
                ],
                [
                    'pengetahuan' => $m['pengetahuan'],
                    'keterampilan' => $m['keterampilan'],
                    'rata_rata_nilai' => $m['rata_rata_nilai'],
                ]
            );
        }

        // 5. Soal Asesmen (42 Soal RIASEC) & Katalog Program Studi
        $this->call(SoalAsesmenRiasecSeeder::class);

        // 6. Konsultasi Terpadu (1 Tabel Konsultasi Sesuai ERD)
        // Sesi 1: Slot terbuka dibuka Psikolog Maya
        Konsultasi::firstOrCreate(
            [
                'id_psikolog' => $psikolog1->id_psikolog,
                'tanggal_konsultasi' => now()->addDays(2)->format('Y-m-d'),
                'waktu_mulai' => '09:00:00',
            ],
            [
                'id_siswa' => null,
                'waktu_selesai' => '10:00:00',
                'status_booking' => 'tersedia',
                'link_zoom' => 'https://zoom.us/j/98765432199',
            ]
        );

        // Sesi 2: Sesi bimbingan yang telah disetujui bersama Dimas Wicaksono
        Konsultasi::firstOrCreate(
            [
                'id_psikolog' => $psikolog1->id_psikolog,
                'tanggal_konsultasi' => now()->addDays(3)->format('Y-m-d'),
                'waktu_mulai' => '13:30:00',
            ],
            [
                'id_siswa' => $siswa1->id_siswa,
                'tanggal_pengajuan' => now(),
                'waktu_selesai' => '14:30:00',
                'status_booking' => 'disetujui',
                'catatan' => 'Ingin berkonsultasi mengenai pertimbangan memilih prodi Teknik Informatika vs Sistem Informasi.',
                'link_zoom' => 'https://zoom.us/j/89123456789?pwd=byouthsession',
            ]
        );

        // Sesi 3: Sesi lampau yang telah selesai bersama Dimas Wicaksono
        Konsultasi::firstOrCreate(
            [
                'id_psikolog' => $psikolog1->id_psikolog,
                'id_siswa' => $siswa1->id_siswa,
                'tanggal_konsultasi' => now()->subDays(5)->format('Y-m-d'),
                'waktu_mulai' => '10:00:00',
            ],
            [
                'tanggal_pengajuan' => now()->subDays(7),
                'waktu_selesai' => '11:00:00',
                'status_booking' => 'selesai',
                'catatan' => 'Siswa memiliki potensi penalaran kuantitatif dan logika komputasi yang sangat kuat. Direkomendasikan mengambil prodi Teknik Informatika sebagai opsi utama.',
                'link_zoom' => 'https://zoom.us/j/89123456789',
            ]
        );

        // Sesi 4: Pengajuan konsultasi menunggu konfirmasi (Siti Sarah Rahmawati)
        Konsultasi::firstOrCreate(
            [
                'id_psikolog' => $psikolog2->id_psikolog,
                'tanggal_konsultasi' => now()->addDays(4)->format('Y-m-d'),
                'waktu_mulai' => '14:00:00',
            ],
            [
                'id_siswa' => $siswa2->id_siswa,
                'tanggal_pengajuan' => now(),
                'waktu_selesai' => '15:00:00',
                'status_booking' => 'menunggu',
                'catatan' => 'Ingin menanyakan peluang karier lulusan Psikologi vs Manajemen Bisnis di era digital.',
                'link_zoom' => 'https://zoom.us/j/77112233445',
            ]
        );

        // 7. Asesmen & Rekomendasi Terpadu (Holland RIASEC Sesuai ERD)
        // Sesi Asesmen 1: Dimas Wicaksono (I–R–C)
        $asesmen1 = SoalAsesmen::firstOrCreate(
            [
                'id_siswa' => $siswa1->id_siswa,
                'status' => 'selesai',
            ],
            [
                'tanggal' => now()->subDays(1),
                'pertanyaan' => 'Profil asesmen Holland RIASEC menunjukkan dominasi pada tipe Investigative (I), Realistic (R), dan Conventional (C) (I–R–C). Karakteristik utama berfokus pada berpikir analitis, pemecahan masalah sistematis, dan implementasi teknologi konkret.',
                'tipe_riasec' => 'I–R–C',
            ]
        );

        $prodiTI = ProgramStudi::where('kode_prodi', 'PRODI-TI')->first();
        $prodiSI = ProgramStudi::where('kode_prodi', 'PRODI-SI')->first();
        $prodiTM = ProgramStudi::where('kode_prodi', 'PRODI-TM')->first();

        if ($prodiTI) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen1->id_asesmen,
                    'id_prodi' => $prodiTI->id_prodi,
                ],
                [
                    'skor' => 95.00,
                    'alasan' => 'Profil kemampuan logika komputasi dan pencapaian akademik Matematika (92.0) sangat selaras dengan kurikulum Teknik Informatika.',
                    'prospek_karier' => 'Software Engineer, Data Scientist, AI Specialist, Cloud Architect',
                ]
            );
        }

        if ($prodiSI) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen1->id_asesmen,
                    'id_prodi' => $prodiSI->id_prodi,
                ],
                [
                    'skor' => 91.00,
                    'alasan' => 'Memiliki potensi sinergi antara tata kelola data sistem informasi, analisis terstruktur, dan pemahaman proses bisnis modern.',
                    'prospek_karier' => 'Product Manager, IT Consultant, Business Analyst',
                ]
            );
        }

        if ($prodiTM) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen1->id_asesmen,
                    'id_prodi' => $prodiTM->id_prodi,
                ],
                [
                    'skor' => 87.50,
                    'alasan' => 'Karakteristik kepribadian Realistic mendukung penguasaan rekayasa fisik, manufaktur presisi, dan otomasi industri.',
                    'prospek_karier' => 'Mechanical Engineer, Insinyur Otomotif, Maintenance Engineer',
                ]
            );
        }

        // Sesi Asesmen 2: Siti Sarah Rahmawati (S–E–A)
        $asesmen2 = SoalAsesmen::firstOrCreate(
            [
                'id_siswa' => $siswa2->id_siswa,
                'status' => 'selesai',
            ],
            [
                'tanggal' => now()->subDays(2),
                'pertanyaan' => 'Profil asesmen Holland RIASEC menunjukkan dominasi pada tipe Social (S), Enterprising (E), dan Artistic (A) (S–E–A). Karakteristik utama berfokus pada komunikasi persuasif, kepedulian sosial, serta kemampuan membangun relasi antarpribadi yang kuat.',
                'tipe_riasec' => 'S–E–A',
            ]
        );

        $prodiPSI = ProgramStudi::where('kode_prodi', 'PRODI-PSI')->first();
        $prodiMBD = ProgramStudi::where('kode_prodi', 'PRODI-MBD')->first();
        $prodiILKOM = ProgramStudi::where('kode_prodi', 'PRODI-ILKOM')->first();

        if ($prodiPSI) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen2->id_asesmen,
                    'id_prodi' => $prodiPSI->id_prodi,
                ],
                [
                    'skor' => 96.00,
                    'alasan' => 'Kemampuan interpersonal yang hangat berpadu serasi dengan pencapaian Bahasa Indonesia (92.0) dan IPAS/Sosial (86.0), sangat ideal untuk studi Psikologi.',
                    'prospek_karier' => 'Psikolog, Konselor Pendidikan, HR Specialist, People Development',
                ]
            );
        }

        if ($prodiMBD) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen2->id_asesmen,
                    'id_prodi' => $prodiMBD->id_prodi,
                ],
                [
                    'skor' => 92.50,
                    'alasan' => 'Tipe Enterprising yang tinggi memberikan daya dorong kewirausahaan, negosiasi kemitraan, dan inovasi bisnis digital.',
                    'prospek_karier' => 'Wirausahawan / Startup Founder, Business Development, Project Manager',
                ]
            );
        }

        if ($prodiILKOM) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen2->id_asesmen,
                    'id_prodi' => $prodiILKOM->id_prodi,
                ],
                [
                    'skor' => 89.00,
                    'alasan' => 'Dukungan bakat Artistic dan Social memperkuat kapasitas dalam manajemen reputasi, public relations, dan komunikasi publik kreatif.',
                    'prospek_karier' => 'Public Relations Specialist, Brand Spokesperson, Media Specialist',
                ]
            );
        }
    }
}
