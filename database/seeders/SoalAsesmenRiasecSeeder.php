<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use App\Models\SoalAsesmen;
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

        $kategoriMap = [
            'R' => 'R - Realistic',
            'I' => 'I - Investigative',
            'A' => 'A - Artistic',
            'S' => 'S - Social',
            'E' => 'E - Enterprising',
            'C' => 'C - Conventional',
        ];

        foreach ($questions as [$no, $type, $text]) {
            SoalAsesmen::updateOrCreate(
                ['id_asesmen' => $no],
                [
                    'id_siswa' => null, // Master bank soal asesmen
                    'tipe_riasec' => $kategoriMap[$type] ?? $type,
                    'pertanyaan' => $text,
                    'status' => 'aktif',
                    'tanggal' => now(),
                ]
            );
        }

        // Program Studi Katalog Lengkap 36 Pilihan RIASEC
        $prodis = [
            // ── 1. Rumpun Realistic (R) ──
            [
                'kode_prodi' => 'PRODI-TM',
                'nama_prodi' => 'Teknik Mesin & Otomotif',
                'tipe_riasec' => 'R,I,C',
                'deskripsi_prodi' => 'Mempelajari konversi energi, perancangan mekanikal alat berat dan otomotif modern, manufaktur presisi, serta perawatan mesin industri.',
                'prospek_karier' => 'Mechanical Engineer, Automotive Specialist, Maintenance Engineer, Quality Control Lead',
            ],
            [
                'kode_prodi' => 'PRODI-TS',
                'nama_prodi' => 'Teknik Sipil & Konstruksi',
                'tipe_riasec' => 'R,I,C',
                'deskripsi_prodi' => 'Mempelajari perancangan struktur bangunan tahan gempa, jembatan, jalan raya, manajemen proyek konstruksi, dan infrastruktur fisik.',
                'prospek_karier' => 'Civil Engineer, Construction Project Manager, Structural Engineer, Surveyor Lapangan',
            ],
            [
                'kode_prodi' => 'PRODI-TE',
                'nama_prodi' => 'Teknik Elektro & Mekatronika',
                'tipe_riasec' => 'R,I,C',
                'deskripsi_prodi' => 'Mempelajari rekayasa kelistrikan tegangan tinggi/rendah, mikroelektronika, otomasi robotika industri, dan sistem kendali mekatronika.',
                'prospek_karier' => 'Electrical Engineer, Automation & Robotics Engineer, Embedded System Developer, Control Specialist',
            ],
            [
                'kode_prodi' => 'PRODI-TL',
                'nama_prodi' => 'Teknik Lingkungan & Rekayasa Sanitasi',
                'tipe_riasec' => 'R,I,S',
                'deskripsi_prodi' => 'Mempelajari mitigasi pencemaran lingkungan, pengolahan air bersih dan limbah industri, AMDAL, serta keberlanjutan ekosistem.',
                'prospek_karier' => 'Environmental Engineer, HSE Officer, Water Treatment Specialist, Konsultan AMDAL',
            ],
            [
                'kode_prodi' => 'PRODI-TG',
                'nama_prodi' => 'Teknik Pertambangan & Geologi',
                'tipe_riasec' => 'R,I,C',
                'deskripsi_prodi' => 'Mempelajari eksplorasi sumber daya mineral dan batubara, mekanika batuan, struktur geologi bumi, serta teknologi penambangan ramah lingkungan.',
                'prospek_karier' => 'Mining Engineer, Exploration Geologist, Geotechnical Engineer, Mine Planning Engineer',
            ],
            [
                'kode_prodi' => 'PRODI-AGRO',
                'nama_prodi' => 'Agroteknologi & Pertanian Berkelanjutan',
                'tipe_riasec' => 'R,I,C',
                'deskripsi_prodi' => 'Mempelajari bioteknologi tanaman, budidaya pertanian presisi modern, perlindungan tanaman, dan efisiensi rantai pasok agribisnis.',
                'prospek_karier' => 'Agronomist, Smart Farming Specialist, Pengelola Perkebunan, Peneliti Tanaman',
            ],

            // ── 2. Rumpun Investigative (I) ──
            [
                'kode_prodi' => 'PRODI-TI',
                'nama_prodi' => 'Teknik Informatika / Ilmu Komputer',
                'tipe_riasec' => 'I,R,C',
                'deskripsi_prodi' => 'Mempelajari rekayasa perangkat lunak, arsitektur komputasi, algoritma logika, kecerdasan buatan, dan pengembangan sistem skala besar.',
                'prospek_karier' => 'Software Engineer, Data Scientist, AI Specialist, Cloud Solutions Architect',
            ],
            [
                'kode_prodi' => 'PRODI-STAT',
                'nama_prodi' => 'Statistika & Sains Data',
                'tipe_riasec' => 'I,C,R',
                'deskripsi_prodi' => 'Mempelajari pemodelan matematika probabilitas, analisis big data, machine learning kuantitatif, dan penarikan kesimpulan berbasis bukti data.',
                'prospek_karier' => 'Data Analyst, Machine Learning Engineer, Actuarial Specialist, Quantitative Researcher',
            ],
            [
                'kode_prodi' => 'PRODI-KED',
                'nama_prodi' => 'Kedokteran & Profesi Dokter',
                'tipe_riasec' => 'I,S,R',
                'deskripsi_prodi' => 'Mempelajari ilmu biomedis, patologi klinis penyakit, diagnosis kesehatan, farmakoterapi, serta tindakan pencegahan dan kuratif manusia.',
                'prospek_karier' => 'Dokter Umum (pasca profesi & koas), Peneliti Biomedis Klinis, Konsultan Layanan Kesehatan',
            ],
            [
                'kode_prodi' => 'PRODI-FARM',
                'nama_prodi' => 'Farmasi Klinis & Sains Obat',
                'tipe_riasec' => 'I,S,C',
                'deskripsi_prodi' => 'Mempelajari formulasi senyawa obat, interaksi kimiawi farmakologi dalam tubuh, pengawasan mutu sediaan obat, dan pelayanan resep klinis.',
                'prospek_karier' => 'Apoteker, Quality Assurance Farmasi, Formulator Produk Obat, Peneliti R&D Medis',
            ],
            [
                'kode_prodi' => 'PRODI-BIO',
                'nama_prodi' => 'Bioteknologi & Ilmu Hayati',
                'tipe_riasec' => 'I,R,C',
                'deskripsi_prodi' => 'Mempelajari rekayasa genetika molekuler, mikrobiologi terapan, bioinformatika, dan teknologi fermentasi pangan serta bioproduk.',
                'prospek_karier' => 'Biotechnologist, Mikrobiolog Industri, Peneliti Lab Genetika, Food Technologist',
            ],
            [
                'kode_prodi' => 'PRODI-TK',
                'nama_prodi' => 'Teknik Kimia & Proses Industri',
                'tipe_riasec' => 'I,R,C',
                'deskripsi_prodi' => 'Mempelajari transformasi bahan mentah menjadi produk bernilai tinggi melalui reaksi kimiawi, termodinamika fase, dan rancang bangun pabrik.',
                'prospek_karier' => 'Chemical Process Engineer, Plant Operations Specialist, R&D Material Engineer, Petrochemical Analyst',
            ],

            // ── 3. Rumpun Artistic (A) ──
            [
                'kode_prodi' => 'PRODI-DKV',
                'nama_prodi' => 'Desain Komunikasi Visual (DKV)',
                'tipe_riasec' => 'A,E,R',
                'deskripsi_prodi' => 'Mengeksplorasi perancangan komunikasi visual melalui media cetak, interaktif digital, ilustrasi, branding, animasi, dan storytelling estetis.',
                'prospek_karier' => 'Art Director, UI/UX Designer, Creative Director, Motion Graphic Artist, Content Creator',
            ],
            [
                'kode_prodi' => 'PRODI-ARS',
                'nama_prodi' => 'Arsitektur & Perancangan Kota',
                'tipe_riasec' => 'A,R,I',
                'deskripsi_prodi' => 'Memadukan estetika seni ruang dengan kekuatan rekayasa struktural dan fungsi tata ruang kota yang humanis serta ramah iklim.',
                'prospek_karier' => 'Architect, Urban Planner, Spatial Designer, 3D Architectural Visualizer',
            ],
            [
                'kode_prodi' => 'PRODI-DES',
                'nama_prodi' => 'Desain Produk & Tata Ruang Interior',
                'tipe_riasec' => 'A,R,E',
                'deskripsi_prodi' => 'Mempelajari ergonomi perlengkapan produk inovatif, material interior, estetika tata cahaya furnitur, dan kebutuhan fungsional ruang huni.',
                'prospek_karier' => 'Product Designer, Interior Designer, Exhibition Stager, Furniture Developer',
            ],
            [
                'kode_prodi' => 'PRODI-FILM',
                'nama_prodi' => 'Film, Televisi & Animasi Digital',
                'tipe_riasec' => 'A,E,S',
                'deskripsi_prodi' => 'Mendalami seni penulisan naskah sinematik, penyutradaraan, tata kamera, efek visual CGI, dan pemodelan animasi 2D/3D interaktif.',
                'prospek_karier' => 'Film Director, Video Editor, 3D Animator, Scriptwriter, Creative Producer',
            ],
            [
                'kode_prodi' => 'PRODI-SAST',
                'nama_prodi' => 'Sastra & Bahasa Inggris Terapan',
                'tipe_riasec' => 'A,S,E',
                'deskripsi_prodi' => 'Mengkaji kekayaan literatur global, linguistik komparatif, teknik penulisan kreatif jurnalistik, dan penerjemahan tersumpah profesional.',
                'prospek_karier' => 'Translator & Interpreter, Content Strategist, Copywriter, Editor Buku, Diplomatic Staff',
            ],
            [
                'kode_prodi' => 'PRODI-MUSIK',
                'nama_prodi' => 'Seni Musik & Rekayasa Audio Kreatif',
                'tipe_riasec' => 'A,R,E',
                'deskripsi_prodi' => 'Mempelajari harmoni komposisi melodi musik, aransemen instrumen, perekaman multi-track digital studio, dan tata suara panggung siaran.',
                'prospek_karier' => 'Music Producer, Sound Engineer, Audio Post-Production Specialist, Komponis',
            ],

            // ── 4. Rumpun Social (S) ──
            [
                'kode_prodi' => 'PRODI-PSI',
                'nama_prodi' => 'Psikologi',
                'tipe_riasec' => 'S,I,A',
                'deskripsi_prodi' => 'Mempelajari perilaku manusia, proses mental analitis, asesmen psikologis kognitif, serta dinamika kesehatan mental individu dan kelompok.',
                'prospek_karier' => 'Psikolog (lanjut profesi), Konselor Pendidikan, HR Specialist, People Development, UX Researcher',
            ],
            [
                'kode_prodi' => 'PRODI-BK',
                'nama_prodi' => 'Bimbingan dan Konseling / Pendidikan',
                'tipe_riasec' => 'S,A,E',
                'deskripsi_prodi' => 'Mempelajari teknik pendampingan konseling remaja, pedagogi pengajaran, pengembangan potensi peserta didik, dan fasilitasi komunitas.',
                'prospek_karier' => 'Guru Konselor (BK), Pendidik / Fasilitator Pelatihan, Pekerja Sosial, Konsultan Karir',
            ],
            [
                'kode_prodi' => 'PRODI-KEP',
                'nama_prodi' => 'Keperawatan & Layanan Terapi Medis',
                'tipe_riasec' => 'S,I,R',
                'deskripsi_prodi' => 'Mempelajari asuhan keperawatan holistik, manajemen kegawatdaruratan medis, pemantauan tanda vital pasien, dan perawatan rehabilitasi.',
                'prospek_karier' => 'Perawat Klinis Rumah Sakit, Emergency Care Specialist, Care Coordinator, Home Health Practitioner',
            ],
            [
                'kode_prodi' => 'PRODI-GIZI',
                'nama_prodi' => 'Ilmu Gizi & Kesehatan Masyarakat',
                'tipe_riasec' => 'S,I,C',
                'deskripsi_prodi' => 'Mempelajari metabolisme nutrisi tubuh, penyusunan diet terapi pasien klinis, manajemen gizi institusi, dan pencegahan masalah kesehatan masyarakat.',
                'prospek_karier' => 'Nutrisionis Klinis, Dietisien Rumah Sakit, Quality Control Pangan, Konsultan Kesehatan Masyarakat',
            ],
            [
                'kode_prodi' => 'PRODI-PGSD',
                'nama_prodi' => 'Pendidikan Guru Sekolah Dasar (PGSD)',
                'tipe_riasec' => 'S,A,C',
                'deskripsi_prodi' => 'Mempersiapkan pendidik generasi dasar dengan penguasaan pedagogi ramah anak, metode pembelajaran interaktif tematik, dan manajemen kelas.',
                'prospek_karier' => 'Guru Sekolah Dasar (PNS/Swasta), Pengembang Kurikulum Edukasi Anak, Penulis Modul Belajar',
            ],
            [
                'kode_prodi' => 'PRODI-KESOS',
                'nama_prodi' => 'Ilmu Kesejahteraan Sosial & Advokasi',
                'tipe_riasec' => 'S,E,A',
                'deskripsi_prodi' => 'Mempelajari penanganan disfungsi sosial, advokasi kelompok rentan, tata kelola lembaga nirlaba (LSM), dan perancangan program CSR pemberdayaan.',
                'prospek_karier' => 'Social Worker, Program Officer LSM / NGO, Corporate Social Responsibility (CSR) Specialist, Advokat Sosial',
            ],

            // ── 5. Rumpun Enterprising (E) ──
            [
                'kode_prodi' => 'PRODI-MBD',
                'nama_prodi' => 'Manajemen Bisnis Digital & Kewirausahaan',
                'tipe_riasec' => 'E,C,S',
                'deskripsi_prodi' => 'Mempelajari strategi kepemimpinan korporat, model rintisan bisnis (startup), pemasaran digital, negosiasi kemitraan, dan pengembangan organisasi.',
                'prospek_karier' => 'Wirausahawan / Startup Founder, Business Development, Project Manager, Digital Marketer',
            ],
            [
                'kode_prodi' => 'PRODI-ILKOM',
                'nama_prodi' => 'Ilmu Komunikasi & Hubungan Masyarakat (PR)',
                'tipe_riasec' => 'E,S,A',
                'deskripsi_prodi' => 'Mempelajari komunikasi strategis publik, public relations, jurnalistik, negosiasi persuasif, dan media penyiaran.',
                'prospek_karier' => 'Public Relations Specialist, Brand Spokesperson, Media Specialist, Jurnalis, Corporate Communications',
            ],
            [
                'kode_prodi' => 'PRODI-HUKUM',
                'nama_prodi' => 'Ilmu Hukum & Advokasi Kebijakan',
                'tipe_riasec' => 'E,S,C',
                'deskripsi_prodi' => 'Mempelajari konstruksi perundang-undangan hukum tata negara, hukum perdata dagang, legal drafting kontrak bisnis, dan teknik litigasi peradilan.',
                'prospek_karier' => 'Corporate Legal Counsel, Advokat / Pengacara, Jaksa / Hakim (pasca seleksi), Compliance Officer',
            ],
            [
                'kode_prodi' => 'PRODI-PAR',
                'nama_prodi' => 'Manajemen Pariwisata & Perhotelan Global',
                'tipe_riasec' => 'E,S,A',
                'deskripsi_prodi' => 'Mempelajari hospitalitas layanan hotel bintang lima internasional, manajemen destinasi wisata ramah lingkungan, serta industri MICE.',
                'prospek_karier' => 'Hotel General Manager, Tourism Destination Strategist, MICE Event Director, International Tour Operator',
            ],
            [
                'kode_prodi' => 'PRODI-HI',
                'nama_prodi' => 'Hubungan Internasional & Diplomasi',
                'tipe_riasec' => 'E,S,I',
                'deskripsi_prodi' => 'Menganalisis perpolitikan geopolitik global, diplomasi bilateral perdagangan, hukum perjanjian internasional, dan resolusi konflik kawasan.',
                'prospek_karier' => 'Diplomat (Kemenlu), International Organization Officer (PBB/ASEAN), Geopolitical Analyst, Export-Import Specialist',
            ],
            [
                'kode_prodi' => 'PRODI-MARKET',
                'nama_prodi' => 'Pemasaran Digital & Manajemen Ritel',
                'tipe_riasec' => 'E,C,A',
                'deskripsi_prodi' => 'Mempelajari funnel konversi iklan daring (digital ads), strategi penetapan harga pasar, optimasi SEO/SEM, dan manajemen rantai ritel omnichannel.',
                'prospek_karier' => 'Digital Marketing Lead, Brand Manager, E-Commerce Specialist, Performance Marketer',
            ],

            // ── 6. Rumpun Conventional (C) ──
            [
                'kode_prodi' => 'PRODI-SI',
                'nama_prodi' => 'Sistem Informasi & Tata Kelola IT',
                'tipe_riasec' => 'C,I,E',
                'deskripsi_prodi' => 'Menjembatani keahlian teknologi informasi dengan proses bisnis organisasi, tata kelola data terstruktur, arsitektur ERP, dan inovasi enterprise.',
                'prospek_karier' => 'Product Manager, IT Consultant, Business Analyst, Enterprise Systems Specialist',
            ],
            [
                'kode_prodi' => 'PRODI-AKT',
                'nama_prodi' => 'Akuntansi & Perpajakan',
                'tipe_riasec' => 'C,E,I',
                'deskripsi_prodi' => 'Mempelajari pencatatan keuangan sistematis, audit kepatuhan regulasi, pelaporan akuntansi korporat, dan perencanaan perpajakan terstruktur.',
                'prospek_karier' => 'Akuntan Publik, Auditor Keuangan, Tax Consultant, Analis Finansial, Financial Controller',
            ],
            [
                'kode_prodi' => 'PRODI-ADM',
                'nama_prodi' => 'Administrasi Publik & Kebijakan Tata Kelola',
                'tipe_riasec' => 'C,E,S',
                'deskripsi_prodi' => 'Mempelajari tata kelola birokrasi pemerintahan yang efisien, standar operasional prosedur instansi publik, dan evaluasi implementasi regulasi.',
                'prospek_karier' => 'Aparatur Sipil Negara (ASN), Policy Analyst, Public Sector Consultant, Operations Administrator',
            ],
            [
                'kode_prodi' => 'PRODI-LOG',
                'nama_prodi' => 'Manajemen Logistik & Rantai Pasok',
                'tipe_riasec' => 'C,R,E',
                'deskripsi_prodi' => 'Mempelajari optimasi rute distribusi armada barang, tata letak pergudangan cerdas (smart warehouse), dan kepabeanan jalur ekspor impor internasional.',
                'prospek_karier' => 'Supply Chain Specialist, Logistics Operations Manager, Freight Forwarding Officer, Procurement Analyst',
            ],
            [
                'kode_prodi' => 'PRODI-AKTU',
                'nama_prodi' => 'Sains Aktuaria & Analisis Risiko Finansial',
                'tipe_riasec' => 'C,I,R',
                'deskripsi_prodi' => 'Menerapkan matematika aktuaria, teori peluang risiko masa depan, perhitungan premi proteksi asuransi, dan simulasi pendanaan dana pensiun.',
                'prospek_karier' => 'Aktuaris Profesional, Risk Management Officer, Underwriter Asuransi, Financial Modeler',
            ],
            [
                'kode_prodi' => 'PRODI-BANK',
                'nama_prodi' => 'Perbankan Syariah & Keuangan Digital',
                'tipe_riasec' => 'C,E,S',
                'deskripsi_prodi' => 'Mempelajari akad perbankan berlandaskan prinsip syariah, ekosistem teknologi finansial (Fintech), manajemen kredit, dan kepatuhan regulasi moneter.',
                'prospek_karier' => 'Credit Analyst, Sharia Compliance Officer, Fintech Operations Lead, Islamic Banking Specialist',
            ],
        ];

        foreach ($prodis as $item) {
            $item['deskripsi'] = $item['deskripsi_prodi'];
            ProgramStudi::updateOrCreate(
                ['kode_prodi' => $item['kode_prodi']],
                $item
            );
        }
    }
}
