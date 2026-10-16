<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Psikolog;
use App\Models\Siswa;
use App\Models\DataAkademik;
use App\Models\ProgramStudi;
use App\Models\Konsultasi;
use App\Models\Asesmen;
use App\Models\HasilAsesmen;
use App\Models\Rekomendasi;
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
        $psikolog = Psikolog::firstOrCreate(
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

        // 5. Soal Asesmen (42 Soal RIASEC) & Katalog Program Studi
        $this->call(SoalAsesmenRiasecSeeder::class);

        // 6. Konsultasi Terpadu (1 Tabel Konsultasi)
        // Sesi 1: Slot lowong dibuka oleh psikolog
        Konsultasi::firstOrCreate(
            [
                'id_psikolog' => $psikolog->id_psikolog,
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

        // Sesi 2: Sesi bimbingan yang telah disetujui bersama Siswa 1
        Konsultasi::firstOrCreate(
            [
                'id_psikolog' => $psikolog->id_psikolog,
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

        // 7. Asesmen & Rekomendasi Terpadu (Holland RIASEC)
        $asesmen = Asesmen::firstOrCreate(
            [
                'id_siswa' => $siswa1->id_siswa,
                'status' => 'selesai',
            ],
            [
                'tanggal' => now()->subDays(1),
                'pertanyaan' => 'Tinggi pada bidang komputasi, analitik logika, dan rekayasa perangkat lunak.',
                'tipe_riasec' => 'ISR',
            ]
        );

        $prodiTI = ProgramStudi::where('kode_prodi', 'PRODI-TI')->orWhere('kode_prodi', 'PRODI-01')->first();
        $prodiSI = ProgramStudi::where('kode_prodi', 'PRODI-SI')->orWhere('kode_prodi', 'PRODI-04')->first();

        if ($prodiTI) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen->id_asesmen,
                    'id_prodi' => $prodiTI->id_prodi,
                ],
                [
                    'skor' => 95.00,
                    'alasan' => 'Profil kemampuan logika dan nilai matematika sangat cocok dengan kurikulum Teknik Informatika.',
                    'kampus_rekomendasi' => 'ITB, UI, ITS, UGM, Binus University',
                    'prospek_karier' => 'Software Engineer, Data Scientist, AI Specialist',
                ]
            );
        }

        if ($prodiSI) {
            Rekomendasi::firstOrCreate(
                [
                    'id_asesmen' => $asesmen->id_asesmen,
                    'id_prodi' => $prodiSI->id_prodi,
                ],
                [
                    'skor' => 91.00,
                    'alasan' => 'Memiliki potensi menjembatani analitik bisnis dan arsitektur sistem informasi enterprise.',
                    'kampus_rekomendasi' => 'UI, ITS, Telkom University',
                    'prospek_karier' => 'Product Manager, IT Consultant, Business Analyst',
                ]
            );
        }
    }
}
