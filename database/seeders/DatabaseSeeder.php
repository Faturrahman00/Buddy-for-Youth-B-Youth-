<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DataAkademik;
use App\Models\ProgramStudi;
use App\Models\JadwalKonsultasi;
use App\Models\BookingKonsultasi;
use App\Models\Konsultasi;
use App\Models\SoalAsesmen;
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
        // 1. Seed Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@byouth.id'],
            [
                'name' => 'Super Admin B-Youth',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'Aktif',
                'no_telepon' => '081234567890',
            ]
        );

        $psikolog = User::firstOrCreate(
            ['email' => 'maya.indriani@byouth.id'],
            [
                'name' => 'Dra. Maya Indriani, M.Psi.',
                'password' => Hash::make('password'),
                'role' => 'psikolog',
                'status' => 'Aktif',
                'no_telepon' => '081298765432',
                'spesialisasi' => 'Psikologi Pendidikan & Minat Bakat Remaja',
            ]
        );

        $siswa1 = User::firstOrCreate(
            ['email' => 'dimas.w@sma1.sch.id'],
            [
                'name' => 'Dimas Wicaksono',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'Aktif',
                'no_telepon' => '085712345678',
            ]
        );

        $siswa2 = User::firstOrCreate(
            ['email' => 'siti.sarah@sma3.sch.id'],
            [
                'name' => 'Siti Sarah Rahmawati',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'Aktif',
                'no_telepon' => '085812345678',
            ]
        );

        // 2. Data Akademik
        DataAkademik::firstOrCreate(
            ['user_id' => $siswa1->id],
            [
                'sekolah' => 'SMA Negeri 1 Malang',
                'kelas' => 'XII MIPA 2',
                'nilai' => 88.50,
                'detail_nilai' => json_encode([
                    'Matematika' => 92,
                    'Fisika' => 88,
                    'Bahasa Inggris' => 90,
                ]),
            ]
        );

        DataAkademik::firstOrCreate(
            ['user_id' => $siswa2->id],
            [
                'sekolah' => 'SMA Negeri 3 Surabaya',
                'kelas' => 'XII IPS 1',
                'nilai' => 91.20,
                'detail_nilai' => json_encode([
                    'Sosiologi' => 94,
                    'Ekonomi' => 90,
                    'Bahasa Indonesia' => 92,
                ]),
            ]
        );

        // 3. Program Studi
        $prodis = [
            [
                'kode_prodi' => 'PRODI-01',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'S1',
                'fakultas' => 'Ilmu Komputer',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Mempelajari rekayasa perangkat lunak, arsitektur komputasi, kecerdasan buatan, dan pengembangan sistem skala besar.',
                'prospek_karier' => 'Software Engineer, AI Engineer, Fullstack Developer, Cloud Architect, Data Scientist',
            ],
            [
                'kode_prodi' => 'PRODI-02',
                'nama_prodi' => 'Psikologi',
                'jenjang' => 'S1',
                'fakultas' => 'Psikologi',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari perilaku manusia, proses mental, asesmen psikologis, serta dinamika kesehatan mental individu dan kelompok.',
                'prospek_karier' => 'Konselor Pendidikan, HR Specialist, Psikolog Klinis (lanjut profesi), UX Researcher',
            ],
            [
                'kode_prodi' => 'PRODI-03',
                'nama_prodi' => 'Desain Komunikasi Visual',
                'jenjang' => 'S1',
                'fakultas' => 'Seni Rupa & Desain',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari perancangan komunikasi visual melalui media cetak, interaktif digital, ilustrasi, branding, dan animasi.',
                'prospek_karier' => 'Creative Director, UI/UX Designer, Motion Graphic Artist, Brand Strategist',
            ],
            [
                'kode_prodi' => 'PRODI-04',
                'nama_prodi' => 'Sistem Informasi',
                'jenjang' => 'S1',
                'fakultas' => 'Ilmu Komputer',
                'akreditasi' => 'Unggul',
                'deskripsi' => 'Menjembatani keahlian teknologi informasi dengan proses bisnis organisasi, tata kelola data, dan analitik enterprise.',
                'prospek_karier' => 'Product Manager, IT Consultant, Business Analyst, Enterprise Systems Specialist',
            ],
            [
                'kode_prodi' => 'PRODI-05',
                'nama_prodi' => 'Manajemen Bisnis Digital',
                'jenjang' => 'S1',
                'fakultas' => 'Ekonomi & Bisnis',
                'akreditasi' => 'A',
                'deskripsi' => 'Mempelajari manajemen operasional modern, digital marketing, inovasi model bisnis rintisan (startup), dan e-commerce.',
                'prospek_karier' => 'Digital Marketing Manager, Startup Founder, Business Development, Growth Marketer',
            ],
        ];

        foreach ($prodis as $item) {
            ProgramStudi::updateOrCreate(
                ['kode_prodi' => $item['kode_prodi']],
                $item
            );
        }

        // 4. Soal Asesmen (42 Soal RIASEC Holland Code) & Katalog Program Studi
        $this->call(SoalAsesmenRiasecSeeder::class);

        // 5. Jadwal Konsultasi
        $jadwal1 = JadwalKonsultasi::firstOrCreate(
            [
                'user_id' => $psikolog->id,
                'tanggal' => now()->addDays(2)->format('Y-m-d'),
                'waktu_mulai' => '09:00:00',
            ],
            [
                'waktu_selesai' => '10:00:00',
                'status_jadwal' => 'tersedia',
            ]
        );

        $jadwal2 = JadwalKonsultasi::firstOrCreate(
            [
                'user_id' => $psikolog->id,
                'tanggal' => now()->addDays(3)->format('Y-m-d'),
                'waktu_mulai' => '13:30:00',
            ],
            [
                'waktu_selesai' => '14:30:00',
                'status_jadwal' => 'dipesan',
            ]
        );

        // 6. Booking Konsultasi
        $booking = BookingKonsultasi::firstOrCreate(
            [
                'user_id' => $siswa1->id,
                'jadwal_id' => $jadwal2->id,
            ],
            [
                'tanggal_booking' => now(),
                'status_booking' => 'disetujui',
                'catatan_siswa' => 'Ingin berkonsultasi mengenai pertimbangan memilih prodi Teknik Informatika vs Sistem Informasi.',
            ]
        );

        // 7. Konsultasi
        Konsultasi::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'tanggal' => now()->addDays(3)->format('Y-m-d'),
                'link_zoom' => 'https://zoom.us/j/89123456789?pwd=byouthsession',
                'catatan' => 'Siswa dipersilakan mempersiapkan rapor semester 1-5.',
                'status_konsultasi' => 'menjadwalkan',
            ]
        );

        // 8. Asesmen, Hasil Asesmen & Rekomendasi
        $asesmen = Asesmen::firstOrCreate(
            [
                'user_id' => $siswa1->id,
                'status' => 'selesai',
            ],
            [
                'tanggal' => now()->subDays(1),
            ]
        );

        $hasil = HasilAsesmen::firstOrCreate(
            ['asesmen_id' => $asesmen->id],
            [
                'minat' => 'Tinggi pada bidang komputasi, analitik logika, dan rekayasa perangkat lunak.',
                'bakat' => 'Kemampuan penalaran numerik dan problem-solving berbasis sistem digital.',
                'potensi' => 'Rumpun Sains & Teknologi serta Interdisipliner Komputer-Manajemen.',
                'detail_skor' => [
                    'skor_logika' => 92,
                    'skor_sosial' => 70,
                    'skor_kreatif' => 78,
                ],
            ]
        );

        $prodiTI = ProgramStudi::where('kode_prodi', 'PRODI-01')->first();
        $prodiSI = ProgramStudi::where('kode_prodi', 'PRODI-04')->first();

        if ($prodiTI) {
            Rekomendasi::firstOrCreate(
                [
                    'hasil_id' => $hasil->id,
                    'prodi_id' => $prodiTI->id,
                ],
                [
                    'skor' => 95.00,
                    'alasan' => 'Profil kemampuan logika dan nilai matematika sangat cocok dengan kurikulum Teknik Informatika.',
                ]
            );
        }

        if ($prodiSI) {
            Rekomendasi::firstOrCreate(
                [
                    'hasil_id' => $hasil->id,
                    'prodi_id' => $prodiSI->id,
                ],
                [
                    'skor' => 91.00,
                    'alasan' => 'Memiliki potensi menjembatani analitik bisnis dan arsitektur sistem informasi enterprise.',
                ]
            );
        }
    }
}
