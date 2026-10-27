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
    "Bukan representasi resmi dari program studi perguruan tinggi mana pun."
)

SAMPLE_PROGRAM_STUDI: List[Dict[str, Any]] = [
    {
        'id_prodi': 1,
        'kode_prodi': 'PRODI-TI',
        'nama_prodi': 'Teknik Informatika',
        'tipe_riasec': 'I, R, C',
        'riasec_vector': [40.0, 95.0, 25.0, 20.0, 30.0, 75.0],
        'relevant_subjects': {
            'Matematika': 0.50,
            'IPAS': 0.30,
            'Bahasa Inggris': 0.20
        },
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': (
            'Mempelajari rekayasa perangkat lunak, algoritma pemrograman, kecerdasan buatan, '
            'dan arsitektur komputasi modern untuk memecahkan masalah komputasional.'
        ),
        'prospek_karier': 'Software Engineer, Data Scientist, Web Developer, AI Specialist'
    },
    {
        'id_prodi': 2,
        'kode_prodi': 'PRODI-SI',
        'nama_prodi': 'Sistem Informasi',
        'tipe_riasec': 'C, E, I',
        'riasec_vector': [25.0, 70.0, 20.0, 35.0, 80.0, 90.0],
        'relevant_subjects': {
            'Matematika': 0.40,
            'Bahasa Inggris': 0.35,
            'Bahasa Indonesia': 0.25
        },
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': (
            'Mengintegrasikan solusi teknologi informasi dengan proses bisnis organisasi '
            'untuk mengoptimalkan tata kelola data dan efisiensi operasional perusahaan.'
        ),
        'prospek_karier': 'Business Analyst, System Analyst, IT Project Manager, Data Architect'
    },
    {
        'id_prodi': 3,
        'kode_prodi': 'PRODI-KED',
        'nama_prodi': 'Kedokteran',
        'tipe_riasec': 'I, S, R',
        'riasec_vector': [35.0, 95.0, 20.0, 85.0, 30.0, 50.0],
        'relevant_subjects': {
            'IPAS': 0.50,
            'Matematika': 0.25,
            'Bahasa Inggris': 0.25
        },
        'cluster': 'medis_hayati',
        'deskripsi_prodi': (
            'Mempelajari ilmu kedokteran medis, pemeliharaan kesehatan, diagnosis patologi, '
            'serta tindakan promotif, preventif, kuratif, dan rehabilitatif pada manusia.'
        ),
        'prospek_karier': 'Dokter Umum (setelah koas & uji kompetensi), Peneliti Klinis, Konsultan Kesehatan'
    },
    {
        'id_prodi': 4,
        'kode_prodi': 'PRODI-DKV',
        'nama_prodi': 'Desain Komunikasi Visual',
        'tipe_riasec': 'A, E, R',
        'riasec_vector': [45.0, 25.0, 95.0, 30.0, 70.0, 25.0],
        'relevant_subjects': {
            'Bahasa Indonesia': 0.35,
            'Bahasa Inggris': 0.35,
            'IPAS': 0.15,
            'Matematika': 0.15
        },
        'cluster': 'desain_kreatif',
        'deskripsi_prodi': (
            'Mengembangkan konsep komunikasi kreatif melalui medium visual seperti grafis, '
            'animasi, tipografi, ilustrasi digital, dan desain antarmuka interaktif.'
        ),
        'prospek_karier': 'Graphic Designer, UI/UX Designer, Motion Animator, Creative Director'
    },
    {
        'id_prodi': 5,
        'kode_prodi': 'PRODI-MBD',
        'nama_prodi': 'Manajemen Bisnis Digital',
        'tipe_riasec': 'E, C, S',
        'riasec_vector': [20.0, 40.0, 30.0, 60.0, 95.0, 75.0],
        'relevant_subjects': {
            'Matematika': 0.35,
            'Bahasa Inggris': 0.35,
            'Bahasa Indonesia': 0.30
        },
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': (
            'Fokus pada strategi pengembangan wirausaha modern, analisis pasar digital, '
            'manajemen operasional, dan kepemimpinan bisnis berbasis ekosistem daring.'
        ),
        'prospek_karier': 'Digital Strategist, Startup Founder, E-Commerce Manager, Operations Lead'
    },
    {
        'id_prodi': 6,
        'kode_prodi': 'PRODI-AKT',
        'nama_prodi': 'Akuntansi',
        'tipe_riasec': 'C, E, I',
        'riasec_vector': [20.0, 60.0, 20.0, 30.0, 70.0, 95.0],
        'relevant_subjects': {
            'Matematika': 0.45,
            'Bahasa Inggris': 0.30,
            'Bahasa Indonesia': 0.25
        },
        'cluster': 'ekonomi_bisnis',
        'deskripsi_prodi': (
            'Mempelajari pencatatan sistematis, audit forensik, pelaporan keuangan korporat, '
            'dan perencanaan perpajakan sesuai standar akuntansi internasional.'
        ),
        'prospek_karier': 'Auditor, Financial Analyst, Akuntan Publik, Tax Consultant'
    },
    {
        'id_prodi': 7,
        'kode_prodi': 'PRODI-PSI',
        'nama_prodi': 'Psikologi',
        'tipe_riasec': 'S, I, A',
        'riasec_vector': [20.0, 85.0, 50.0, 95.0, 40.0, 35.0],
        'relevant_subjects': {
            'Bahasa Indonesia': 0.40,
            'Bahasa Inggris': 0.30,
            'IPAS': 0.30
        },
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': (
            'Menganalisis perilaku manusia, fungsi kognitif mental, dinamika interaksi sosial, '
            'serta teknik asesmen psikologis untuk perkembangan individu dan kelompok.'
        ),
        'prospek_karier': 'Staff HRD / Talent Acquisition, Konselor Remaja, Peneliti Perilaku Konsumen'
    },
    {
        'id_prodi': 8,
        'kode_prodi': 'PRODI-TM',
        'nama_prodi': 'Teknik Mesin',
        'tipe_riasec': 'R, I, C',
        'riasec_vector': [95.0, 75.0, 20.0, 20.0, 30.0, 60.0],
        'relevant_subjects': {
            'Matematika': 0.45,
            'IPAS': 0.40,
            'Bahasa Inggris': 0.15
        },
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': (
            'Mempelajari prinsip fisika mekanika, termodinamika fluida, kinematika mesin, '
            'dan perancangan sistem manufaktur serta konversi energi industri.'
        ),
        'prospek_karier': 'Mechanical Engineer, Maintenance Engineer, Quality Control Engineer'
    },
    {
        'id_prodi': 9,
        'kode_prodi': 'PRODI-ILKOM',
        'nama_prodi': 'Ilmu Komunikasi',
        'tipe_riasec': 'E, S, A',
        'riasec_vector': [20.0, 30.0, 75.0, 85.0, 90.0, 30.0],
        'relevant_subjects': {
            'Bahasa Indonesia': 0.40,
            'Bahasa Inggris': 0.35,
            'IPAS': 0.25
        },
        'cluster': 'sosial_humaniora',
        'deskripsi_prodi': (
            'Mendalami dinamika penyampaian pesan lintas media, jurnalistik digital, '
            'manajemen reputasi publik (Public Relations), dan strategi periklanan.'
        ),
        'prospek_karier': 'Public Relations Officer, Corporate Communications, Jurnalis, Social Media Specialist'
    },
    {
        'id_prodi': 10,
        'kode_prodi': 'PRODI-STAT',
        'nama_prodi': 'Statistika & Sains Data',
        'tipe_riasec': 'I, C, R',
        'riasec_vector': [30.0, 95.0, 20.0, 20.0, 40.0, 90.0],
        'relevant_subjects': {
            'Matematika': 0.55,
            'IPAS': 0.25,
            'Bahasa Inggris': 0.20
        },
        'cluster': 'teknologi_rekayasa',
        'deskripsi_prodi': (
            'Fokus pada eksplorasi pemodelan peluang stokastik, machine learning inferensial, '
            'dan visualisasi data besar (Big Data) untuk pengambilan keputusan berbasis bukti.'
        ),
        'prospek_karier': 'Data Analyst, Actuarial Specialist, Market Researcher, Quantitative Analyst'
    }
]


def get_default_catalog() -> List[Dict[str, Any]]:
    """Mengembalikan salinan dataset katalog program studi simulasi."""
    return [dict(p) for p in SAMPLE_PROGRAM_STUDI]
