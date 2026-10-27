#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: KATALOG DATA PROGRAM STUDI SIMULASI (data_catalog.py)
=============================================================================
Dataset program studi untuk pengujian dan demonstrasi sistem rekomendasi.

PERINGATAN RESMI:
Dataset ini merupakan data simulasi edukatif untuk keperluan pemodelan
dan demonstrasi prototipe B-Youth (Buddy For Youth), bukan data resmi,
bukan peringkat resmi perguruan tinggi, dan bukan akreditasi institusi tertentu.
=============================================================================
"""

from typing import List, Dict, Any

SIMULATION_DISCLAIMER: str = (
    "Data simulasi edukatif internal prototipe B-Youth. "
    "Mencakup 36 pilihan program studi komprehensif dari rumpun Saintek, Soshum, Medis, Teknik, dan Seni."
)

SAMPLE_PROGRAM_STUDI: List[Dict[str, Any]] = [
    # ── 1. RUMPUN REKOMENDASI DIMENSI REALISTIC (R) ──
    {
        'id_prodi': 1,
        'kode_prodi': 'PRODI-TM',
        'nama_prodi': 'Teknik Mesin & Otomotif',
        'tipe_riasec': 'R, I, C',
        'riasec_vector': [95.0, 75.0, 20.0, 20.0, 30.0, 60.0],
        'relevant_subjects': {'Matematika': 0.45, 'IPAS': 0.40, 'Bahasa Inggris': 0.15},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari konversi energi, kinematika mesin, manufaktur presisi, otomotif modern, dan perancangan alat berat industri.',
        'prospek_karier': 'Mechanical Engineer, Automotive Specialist, Maintenance Engineer, Quality Control Lead'
    },
    {
        'id_prodi': 2,
        'kode_prodi': 'PRODI-TS',
        'nama_prodi': 'Teknik Sipil & Konstruksi',
        'tipe_riasec': 'R, I, C',
        'riasec_vector': [90.0, 70.0, 30.0, 20.0, 35.0, 65.0],
        'relevant_subjects': {'Matematika': 0.45, 'IPAS': 0.40, 'Bahasa Inggris': 0.15},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari perancangan infrastruktur fisik, konstruksi gedung tahan gempa, jembatan, jalan raya, serta manajemen proyek sipil.',
        'prospek_karier': 'Civil Engineer, Construction Project Manager, Structural Engineer, Surveyor Lapangan'
    },
    {
        'id_prodi': 3,
        'kode_prodi': 'PRODI-TE',
        'nama_prodi': 'Teknik Elektro & Mekatronika',
        'tipe_riasec': 'R, I, C',
        'riasec_vector': [90.0, 85.0, 20.0, 20.0, 30.0, 65.0],
        'relevant_subjects': {'Matematika': 0.50, 'IPAS': 0.35, 'Bahasa Inggris': 0.15},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari rekayasa kelistrikan tegangan tinggi/rendah, mikroelektronika, otomasi robotika industri, dan sistem kendali mekatronika.',
        'prospek_karier': 'Electrical Engineer, Automation & Robotics Engineer, Embedded System Developer, Control Specialist'
    },
    {
        'id_prodi': 4,
        'kode_prodi': 'PRODI-TL',
        'nama_prodi': 'Teknik Lingkungan & Rekayasa Sanitasi',
        'tipe_riasec': 'R, I, S',
        'riasec_vector': [85.0, 80.0, 20.0, 60.0, 25.0, 45.0],
        'relevant_subjects': {'IPAS': 0.45, 'Matematika': 0.35, 'Bahasa Inggris': 0.20},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari mitigasi pencemaran lingkungan, pengolahan air bersih dan limbah industri, AMDAL, serta keberlanjutan ekosistem.',
        'prospek_karier': 'Environmental Engineer, HSE Officer, Water Treatment Specialist, Konsultan AMDAL'
    },
    {
        'id_prodi': 5,
        'kode_prodi': 'PRODI-TG',
        'nama_prodi': 'Teknik Pertambangan & Geologi',
        'tipe_riasec': 'R, I, C',
        'riasec_vector': [95.0, 75.0, 15.0, 20.0, 30.0, 60.0],
        'relevant_subjects': {'IPAS': 0.45, 'Matematika': 0.40, 'Bahasa Inggris': 0.15},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari eksplorasi sumber daya mineral dan batubara, mekanika batuan, struktur geologi bumi, serta teknologi penambangan ramah lingkungan.',
        'prospek_karier': 'Mining Engineer, Exploration Geologist, Geotechnical Engineer, Mine Planning Engineer'
    },
    {
        'id_prodi': 6,
        'kode_prodi': 'PRODI-AGRO',
        'nama_prodi': 'Agroteknologi & Pertanian Berkelanjutan',
        'tipe_riasec': 'R, I, C',
        'riasec_vector': [85.0, 80.0, 20.0, 35.0, 30.0, 60.0],
        'relevant_subjects': {'IPAS': 0.50, 'Matematika': 0.30, 'Bahasa Inggris': 0.20},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari bioteknologi tanaman, budidaya pertanian presisi modern, perlindungan tanaman, dan efisiensi rantai pasok agribisnis.',
        'prospek_karier': 'Agronomist, Smart Farming Specialist, Pengelola Perkebunan, Peneliti Tanaman'
    },

    # ── 2. RUMPUN REKOMENDASI DIMENSI INVESTIGATIVE (I) ──
    {
        'id_prodi': 7,
        'kode_prodi': 'PRODI-TI',
        'nama_prodi': 'Teknik Informatika / Ilmu Komputer',
        'tipe_riasec': 'I, R, C',
        'riasec_vector': [40.0, 95.0, 25.0, 20.0, 30.0, 75.0],
        'relevant_subjects': {'Matematika': 0.50, 'IPAS': 0.30, 'Bahasa Inggris': 0.20},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari rekayasa perangkat lunak, algoritma pemrograman tingkat lanjut, kecerdasan buatan, keamanan siber, dan arsitektur komputasi awan.',
        'prospek_karier': 'Software Engineer, Data Scientist, AI Specialist, Cloud Solutions Architect'
    },
    {
        'id_prodi': 8,
        'kode_prodi': 'PRODI-STAT',
        'nama_prodi': 'Statistika & Sains Data',
        'tipe_riasec': 'I, C, R',
        'riasec_vector': [30.0, 95.0, 20.0, 20.0, 40.0, 90.0],
        'relevant_subjects': {'Matematika': 0.55, 'IPAS': 0.25, 'Bahasa Inggris': 0.20},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Fokus pada pemodelan peluang stokastik, machine learning inferensial, analisis kuantitatif big data, dan visualisasi data bukti.',
        'prospek_karier': 'Data Analyst, Machine Learning Engineer, Actuarial Specialist, Quantitative Researcher'
    },
    {
        'id_prodi': 9,
        'kode_prodi': 'PRODI-KED',
        'nama_prodi': 'Kedokteran & Profesi Dokter',
        'tipe_riasec': 'I, S, R',
        'riasec_vector': [35.0, 95.0, 20.0, 85.0, 30.0, 50.0],
        'relevant_subjects': {'IPAS': 0.50, 'Matematika': 0.25, 'Bahasa Inggris': 0.25},
        'cluster': 'medis_hayati',
        'deskripsi_prodi': 'Mempelajari ilmu biomedis, patologi penyakit manusia, diagnosis klinis, farmakoterapi, serta tindakan pencegahan dan kuratif kesehatan.',
        'prospek_karier': 'Dokter Umum (pasca profesi & koas), Peneliti Biomedis Klinis, Konsultan Layanan Kesehatan'
    },
    {
        'id_prodi': 10,
        'kode_prodi': 'PRODI-FARM',
        'nama_prodi': 'Farmasi Klinis & Sains Obat',
        'tipe_riasec': 'I, S, C',
        'riasec_vector': [25.0, 95.0, 20.0, 70.0, 30.0, 65.0],
        'relevant_subjects': {'IPAS': 0.50, 'Matematika': 0.30, 'Bahasa Inggris': 0.20},
        'cluster': 'medis_hayati',
        'deskripsi_prodi': 'Mempelajari formulasi senyawa obat, interaksi kimiawi farmakologi dalam tubuh, pengawasan mutu sediaan obat, dan pelayanan resep klinis.',
        'prospek_karier': 'Apoteker, Quality Assurance Farmasi, Formulator Produk Obat, Peneliti R&D Medis'
    },
    {
        'id_prodi': 11,
        'kode_prodi': 'PRODI-BIO',
        'nama_prodi': 'Bioteknologi & Ilmu Hayati',
        'tipe_riasec': 'I, R, C',
        'riasec_vector': [35.0, 95.0, 25.0, 30.0, 30.0, 65.0],
        'relevant_subjects': {'IPAS': 0.50, 'Matematika': 0.30, 'Bahasa Inggris': 0.20},
        'cluster': 'medis_hayati',
        'deskripsi_prodi': 'Mempelajari rekayasa genetika, mikrobiologi terapan, kultur jaringan, bioinformatika, dan teknologi fermentasi pangan serta biofuel.',
        'prospek_karier': 'Biotechnologist, Mikrobiolog Industri, Peneliti Lab Genetika, Food Technologist'
    },
    {
        'id_prodi': 12,
        'kode_prodi': 'PRODI-TK',
        'nama_prodi': 'Teknik Kimia & Proses Industri',
        'tipe_riasec': 'I, R, C',
        'riasec_vector': [65.0, 90.0, 20.0, 20.0, 30.0, 65.0],
        'relevant_subjects': {'Matematika': 0.45, 'IPAS': 0.40, 'Bahasa Inggris': 0.15},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Mempelajari transformasi bahan mentah menjadi produk bernilai tinggi melalui reaksi kimiawi, termodinamika fase, dan rancang bangun pabrik.',
        'prospek_karier': 'Chemical Process Engineer, Plant Operations Specialist, R&D Material Engineer, Petrochemical Analyst'
    },

    # ── 3. RUMPUN REKOMENDASI DIMENSI ARTISTIC (A) ──
    {
        'id_prodi': 13,
        'kode_prodi': 'PRODI-DKV',
        'nama_prodi': 'Desain Komunikasi Visual & Multimedia',
        'tipe_riasec': 'A, E, R',
        'riasec_vector': [45.0, 25.0, 95.0, 30.0, 70.0, 25.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.35, 'Bahasa Inggris': 0.35, 'IPAS': 0.15, 'Matematika': 0.15},
        'cluster': 'desain_kreatif',
        'deskripsi_prodi': 'Mengembangkan konsep komunikasi visual melalui tipografi, ilustrasi digital, branding identitas korporat, dan rancang antarmuka interaktif.',
        'prospek_karier': 'Art Director, Graphic Designer, UI/UX Designer, Motion Graphic Artist'
    },
    {
        'id_prodi': 14,
        'kode_prodi': 'PRODI-ARS',
        'nama_prodi': 'Arsitektur & Perancangan Kota',
        'tipe_riasec': 'A, R, I',
        'riasec_vector': [65.0, 60.0, 95.0, 25.0, 35.0, 40.0],
        'relevant_subjects': {'Matematika': 0.30, 'IPAS': 0.30, 'Bahasa Indonesia': 0.20, 'Bahasa Inggris': 0.20},
        'cluster': 'desain_kreatif',
        'deskripsi_prodi': 'Memadukan estetika seni ruang dengan kekuatan rekayasa struktural dan fungsi tata ruang kota yang humanis serta ramah iklim.',
        'prospek_karier': 'Architect, Urban Planner, Spatial Designer, 3D Architectural Visualizer'
    },
    {
        'id_prodi': 15,
        'kode_prodi': 'PRODI-DES',
        'nama_prodi': 'Desain Produk & Tata Ruang Interior',
        'tipe_riasec': 'A, R, E',
        'riasec_vector': [60.0, 30.0, 95.0, 30.0, 65.0, 35.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.35, 'Bahasa Inggris': 0.35, 'Matematika': 0.15, 'IPAS': 0.15},
        'cluster': 'desain_kreatif',
        'deskripsi_prodi': 'Mempelajari ergonomi perlengkapan produk inovatif, material interior, estetika tata cahaya furnitur, dan kebutuhan fungsional ruang huni.',
        'prospek_karier': 'Product Designer, Interior Designer, Exhibition Stager, Furniture Developer'
    },
    {
        'id_prodi': 16,
        'kode_prodi': 'PRODI-FILM',
        'nama_prodi': 'Film, Televisi & Animasi Digital',
        'tipe_riasec': 'A, E, S',
        'riasec_vector': [35.0, 25.0, 95.0, 55.0, 75.0, 25.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.40, 'Bahasa Inggris': 0.35, 'IPAS': 0.15, 'Matematika': 0.10},
        'cluster': 'desain_kreatif',
        'deskripsi_prodi': 'Mendalami seni penulisan naskah sinematik, penyutradaraan, tata kamera, efek visual CGI, dan pemodelan animasi 2D/3D interaktif.',
        'prospek_karier': 'Film Director, Video Editor, 3D Animator, Scriptwriter, Creative Producer'
    },
    {
        'id_prodi': 17,
        'kode_prodi': 'PRODI-SAST',
        'nama_prodi': 'Sastra & Bahasa Inggris Terapan',
        'tipe_riasec': 'A, S, E',
        'riasec_vector': [15.0, 35.0, 90.0, 75.0, 65.0, 35.0],
        'relevant_subjects': {'Bahasa Inggris': 0.50, 'Bahasa Indonesia': 0.35, 'IPAS': 0.15},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Mengkaji kekayaan literatur global, linguistik komparatif, teknik penulisan kreatif jurnalistik, dan penerjemahan tersumpah profesional.',
        'prospek_karier': 'Translator & Interpreter, Content Strategist, Copywriter, Editor Buku, Diplomatic Staff'
    },
    {
        'id_prodi': 18,
        'kode_prodi': 'PRODI-MUSIK',
        'nama_prodi': 'Seni Musik & Rekayasa Audio Kreatif',
        'tipe_riasec': 'A, R, E',
        'riasec_vector': [60.0, 25.0, 95.0, 40.0, 65.0, 30.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.35, 'Bahasa Inggris': 0.35, 'IPAS': 0.15, 'Matematika': 0.15},
        'cluster': 'desain_kreatif',
        'deskripsi_prodi': 'Mempelajari harmoni komposisi melodi musik, aransemen instrumen, perekaman multi-track digital studio, dan tata suara panggung siaran.',
        'prospek_karier': 'Music Producer, Sound Engineer, Audio Post-Production Specialist, Komponis'
    },

    # ── 4. RUMPUN REKOMENDASI DIMENSI SOCIAL (S) ──
    {
        'id_prodi': 19,
        'kode_prodi': 'PRODI-PSI',
        'nama_prodi': 'Psikologi',
        'tipe_riasec': 'S, I, A',
        'riasec_vector': [20.0, 85.0, 50.0, 95.0, 40.0, 35.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.40, 'Bahasa Inggris': 0.30, 'IPAS': 0.30},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Menganalisis mekanisme kognitif manusia, dinamika emosi perilaku, instrumen asesmen mental, serta penanganan konseling perkembangan.',
        'prospek_karier': 'Staff HR & People Development, Konselor Remaja, UX Researcher, Psikolog (pasca magister profesi)'
    },
    {
        'id_prodi': 20,
        'kode_prodi': 'PRODI-BK',
        'nama_prodi': 'Bimbingan dan Konseling / Pendidikan',
        'tipe_riasec': 'S, A, E',
        'riasec_vector': [15.0, 35.0, 65.0, 95.0, 65.0, 35.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.40, 'Bahasa Inggris': 0.30, 'IPAS': 0.30},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Fokus pada teknik pendampingan konseling individual dan kelompok bagi siswa sekolah, pemetaan minat bakat, dan pembinaan karakter remaja.',
        'prospek_karier': 'Guru Bimbingan Konseling (BK), Career Counselor, Fasilitator Pelatihan Remaja, Konsultan Edukasi'
    },
    {
        'id_prodi': 21,
        'kode_prodi': 'PRODI-KEP',
        'nama_prodi': 'Keperawatan & Layanan Terapi Medis',
        'tipe_riasec': 'S, I, R',
        'riasec_vector': [45.0, 75.0, 20.0, 95.0, 30.0, 45.0],
        'relevant_subjects': {'IPAS': 0.45, 'Bahasa Indonesia': 0.30, 'Bahasa Inggris': 0.15, 'Matematika': 0.10},
        'cluster': 'medis_hayati',
        'deskripsi_prodi': 'Mempelajari asuhan keperawatan holistik, manajemen kegawatdaruratan medis, pemantauan tanda vital pasien, dan perawatan rehabilitasi.',
        'prospek_karier': 'Perawat Klinis Rumah Sakit, Emergency Care Specialist, Care Coordinator, Home Health Practitioner'
    },
    {
        'id_prodi': 22,
        'kode_prodi': 'PRODI-GIZI',
        'nama_prodi': 'Ilmu Gizi & Kesehatan Masyarakat',
        'tipe_riasec': 'S, I, C',
        'riasec_vector': [25.0, 80.0, 20.0, 95.0, 35.0, 65.0],
        'relevant_subjects': {'IPAS': 0.45, 'Bahasa Indonesia': 0.30, 'Matematika': 0.15, 'Bahasa Inggris': 0.10},
        'cluster': 'medis_hayati',
        'deskripsi_prodi': 'Mempelajari metabolisme makro/mikronutrien tubuh, penyusunan diet terapi pasien klinis, manajemen gizi institusi, dan intervensi stunting.',
        'prospek_karier': 'Nutrisionis Klinis, Dietisien Rumah Sakit, Quality Control Pangan, Konsultan Kesehatan Masyarakat'
    },
    {
        'id_prodi': 23,
        'kode_prodi': 'PRODI-PGSD',
        'nama_prodi': 'Pendidikan Guru Sekolah Dasar (PGSD)',
        'tipe_riasec': 'S, A, C',
        'riasec_vector': [25.0, 40.0, 60.0, 95.0, 45.0, 60.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.35, 'Matematika': 0.25, 'IPAS': 0.25, 'Bahasa Inggris': 0.15},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Mempersiapkan pendidik generasi dasar dengan penguasaan pedagogi ramah anak, metode pembelajaran interaktif tematik, dan manajemen kelas.',
        'prospek_karier': 'Guru Sekolah Dasar (PNS/Swasta), Pengembang Kurikulum Edukasi Anak, Penulis Modul Belajar'
    },
    {
        'id_prodi': 24,
        'kode_prodi': 'PRODI-KESOS',
        'nama_prodi': 'Ilmu Kesejahteraan Sosial & Advokasi',
        'tipe_riasec': 'S, E, A',
        'riasec_vector': [15.0, 35.0, 60.0, 95.0, 70.0, 35.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.40, 'Bahasa Inggris': 0.30, 'IPAS': 0.30},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Mempelajari penanganan disfungsi sosial, advokasi kelompok rentan, tata kelola lembaga nirlaba (LSM), dan perancangan program CSR pemberdayaan.',
        'prospek_karier': 'Social Worker, Program Officer LSM / NGO, Corporate Social Responsibility (CSR) Specialist, Advokat Sosial'
    },

    # ── 5. RUMPUN REKOMENDASI DIMENSI ENTERPRISING (E) ──
    {
        'id_prodi': 25,
        'kode_prodi': 'PRODI-MBD',
        'nama_prodi': 'Manajemen Bisnis Digital & Kewirausahaan',
        'tipe_riasec': 'E, C, S',
        'riasec_vector': [20.0, 40.0, 30.0, 60.0, 95.0, 75.0],
        'relevant_subjects': {'Matematika': 0.35, 'Bahasa Inggris': 0.35, 'Bahasa Indonesia': 0.30},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari strategi inkubasi rintisan usaha (startup), pembiayaan modal ventura, manajemen operasional inovatif, dan kepemimpinan adaptif.',
        'prospek_karier': 'Startup Founder, Business Development Specialist, Strategic Operations Lead, Venture Analyst'
    },
    {
        'id_prodi': 26,
        'kode_prodi': 'PRODI-ILKOM',
        'nama_prodi': 'Ilmu Komunikasi & Hubungan Masyarakat (PR)',
        'tipe_riasec': 'E, S, A',
        'riasec_vector': [20.0, 30.0, 75.0, 85.0, 90.0, 30.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.40, 'Bahasa Inggris': 0.35, 'IPAS': 0.25},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Mendalami dinamika penyampaian pesan media massa, manajemen reputasi korporasi (PR), negosiasi persuasif, dan strategi hubungan publik.',
        'prospek_karier': 'Public Relations Officer, Corporate Spokesperson, Media Specialist, Strategic Communications Officer'
    },
    {
        'id_prodi': 27,
        'kode_prodi': 'PRODI-HUKUM',
        'nama_prodi': 'Ilmu Hukum & Advokasi Kebijakan',
        'tipe_riasec': 'E, S, C',
        'riasec_vector': [15.0, 55.0, 30.0, 75.0, 95.0, 65.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.45, 'Bahasa Inggris': 0.35, 'Matematika': 0.20},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Mempelajari konstruksi perundang-undangan hukum tata negara, hukum perdata dagang, legal drafting kontrak bisnis, dan teknik litigasi peradilan.',
        'prospek_karier': 'Corporate Legal Counsel, Advokat / Pengacara, Jaksa / Hakim (pasca seleksi), Compliance Officer'
    },
    {
        'id_prodi': 28,
        'kode_prodi': 'PRODI-PAR',
        'nama_prodi': 'Manajemen Pariwisata & Perhotelan Global',
        'tipe_riasec': 'E, S, A',
        'riasec_vector': [25.0, 25.0, 65.0, 80.0, 95.0, 40.0],
        'relevant_subjects': {'Bahasa Inggris': 0.45, 'Bahasa Indonesia': 0.35, 'Matematika': 0.20},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari hospitalitas layanan hotel bintang lima internasional, manajemen destinasi wisata ramah lingkungan, serta industri MICE.',
        'prospek_karier': 'Hotel General Manager, Tourism Destination Strategist, MICE Event Director, International Tour Operator'
    },
    {
        'id_prodi': 29,
        'kode_prodi': 'PRODI-HI',
        'nama_prodi': 'Hubungan Internasional & Diplomasi',
        'tipe_riasec': 'E, S, I',
        'riasec_vector': [15.0, 65.0, 40.0, 80.0, 95.0, 35.0],
        'relevant_subjects': {'Bahasa Inggris': 0.50, 'Bahasa Indonesia': 0.30, 'IPAS': 0.20},
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': 'Menganalisis perpolitikan geopolitik global, diplomasi bilateral perdagangan, hukum perjanjian internasional, dan resolusi konflik kawasan.',
        'prospek_karier': 'Diplomat (Kemenlu), International Organization Officer (PBB/ASEAN), Geopolitical Analyst, Export-Import Specialist'
    },
    {
        'id_prodi': 30,
        'kode_prodi': 'PRODI-MARKET',
        'nama_prodi': 'Pemasaran Digital & Manajemen Ritel',
        'tipe_riasec': 'E, C, A',
        'riasec_vector': [20.0, 35.0, 60.0, 50.0, 95.0, 75.0],
        'relevant_subjects': {'Matematika': 0.35, 'Bahasa Inggris': 0.35, 'Bahasa Indonesia': 0.30},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari funnel konversi iklan daring (digital ads), strategi penetapan harga pasar, optimasi SEO/SEM, dan manajemen rantai ritel omnichannel.',
        'prospek_karier': 'Digital Marketing Lead, Brand Manager, E-Commerce Specialist, Performance Marketer'
    },

    # ── 6. RUMPUN REKOMENDASI DIMENSI CONVENTIONAL (C) ──
    {
        'id_prodi': 31,
        'kode_prodi': 'PRODI-SI',
        'nama_prodi': 'Sistem Informasi & Tata Kelola IT',
        'tipe_riasec': 'C, I, E',
        'riasec_vector': [25.0, 70.0, 20.0, 35.0, 80.0, 90.0],
        'relevant_subjects': {'Matematika': 0.40, 'Bahasa Inggris': 0.35, 'Bahasa Indonesia': 0.25},
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': 'Menjembatani kapabilitas rekayasa software dengan tata kelola kebutuhan proses bisnis perusahaan melalui basis data terstruktur dan arsitektur ERP.',
        'prospek_karier': 'Business Analyst, IT Auditor, Systems Architect, Enterprise ERP Consultant'
    },
    {
        'id_prodi': 32,
        'kode_prodi': 'PRODI-AKT',
        'nama_prodi': 'Akuntansi & Perpajakan',
        'tipe_riasec': 'C, E, I',
        'riasec_vector': [20.0, 60.0, 20.0, 30.0, 70.0, 95.0],
        'relevant_subjects': {'Matematika': 0.45, 'Bahasa Inggris': 0.30, 'Bahasa Indonesia': 0.25},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari audit forensik laporan keuangan, standar kepatuhan IFRS/PSAK, pelaporan pajak korporat terstruktur, dan akuntansi manajemen biaya.',
        'prospek_karier': 'Auditor Kantor Akuntan Publik (KAP), Tax Consultant, Financial Controller, Budgeting Analyst'
    },
    {
        'id_prodi': 33,
        'kode_prodi': 'PRODI-ADM',
        'nama_prodi': 'Administrasi Publik & Kebijakan Tata Kelola',
        'tipe_riasec': 'C, E, S',
        'riasec_vector': [15.0, 35.0, 20.0, 65.0, 80.0, 95.0],
        'relevant_subjects': {'Bahasa Indonesia': 0.40, 'Bahasa Inggris': 0.30, 'Matematika': 0.30},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari tata kelola birokrasi pemerintahan yang efisien, standar operasional prosedur instansi publik, dan evaluasi implementasi regulasi.',
        'prospek_karier': 'Aparatur Sipil Negara (ASN), Policy Analyst, Public Sector Consultant, Operations Administrator'
    },
    {
        'id_prodi': 34,
        'kode_prodi': 'PRODI-LOG',
        'nama_prodi': 'Manajemen Logistik & Rantai Pasok',
        'tipe_riasec': 'C, R, E',
        'riasec_vector': [65.0, 45.0, 15.0, 25.0, 75.0, 95.0],
        'relevant_subjects': {'Matematika': 0.45, 'Bahasa Inggris': 0.30, 'IPAS': 0.25},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari optimasi rute distribusi armada barang, tata letak pergudangan cerdas (smart warehouse), dan kepabeanan jalur ekspor impor internasional.',
        'prospek_karier': 'Supply Chain Specialist, Logistics Operations Manager, Freight Forwarding Officer, Procurement Analyst'
    },
    {
        'id_prodi': 35,
        'kode_prodi': 'PRODI-AKTU',
        'nama_prodi': 'Sains Aktuaria & Analisis Risiko Finansial',
        'tipe_riasec': 'C, I, R',
        'riasec_vector': [30.0, 90.0, 15.0, 20.0, 45.0, 95.0],
        'relevant_subjects': {'Matematika': 0.60, 'Bahasa Inggris': 0.25, 'IPAS': 0.15},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Menerapkan matematika aktuaria, teori peluang risiko masa depan, perhitungan premi proteksi asuransi, dan simulasi pendanaan dana pensiun.',
        'prospek_karier': 'Aktuaris Profesional, Risk Management Officer, Underwriter Asuransi, Financial Modeler'
    },
    {
        'id_prodi': 36,
        'kode_prodi': 'PRODI-BANK',
        'nama_prodi': 'Perbankan Syariah & Keuangan Digital',
        'tipe_riasec': 'C, E, S',
        'riasec_vector': [15.0, 40.0, 20.0, 60.0, 75.0, 95.0],
        'relevant_subjects': {'Matematika': 0.45, 'Bahasa Inggris': 0.30, 'Bahasa Indonesia': 0.25},
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': 'Mempelajari akad perbankan berlandaskan prinsip syariah, ekosistem teknologi finansial (Fintech), manajemen kredit, dan kepatuhan regulasi moneter.',
        'prospek_karier': 'Credit Analyst, Sharia Compliance Officer, Fintech Operations Lead, Islamic Banking Specialist'
    }
]


def get_default_catalog() -> List[Dict[str, Any]]:
    """Mengembalikan salinan dataset katalog program studi simulasi."""
    return [dict(p) for p in SAMPLE_PROGRAM_STUDI]
