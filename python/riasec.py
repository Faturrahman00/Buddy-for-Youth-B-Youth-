#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MODUL RIASEC (riasec.py)
=============================================================================
Modul untuk menghitung skor dimensi minat John Holland (RIASEC):
- Realistic (R)
- Investigative (I)
- Artistic (A)
- Social (S)
- Enterprising (E)
- Conventional (C)

Menyediakan:
1. Pemetaan 42 butir asesmen minat ke 6 dimensi RIASEC.
2. Perhitungan skor mentah (skala 7-35) dan persentase (0-100%).
3. Penentuan tipe dominan dan Holland Code dengan aturan Tie-Breaking.
4. Pembentukan vektor RIASEC siswa 6 dimensi yang ternormalisasi.
=============================================================================
"""

from typing import Dict, List, Any, Tuple, Union

# Urutan baku dimensi RIASEC
RIASEC_KEYS: Tuple[str, ...] = ('R', 'I', 'A', 'S', 'E', 'C')

# Prioritas tie-breaking jika skor sama (canonical order)
CANONICAL_ORDER: Dict[str, int] = {
    'R': 1,
    'I': 2,
    'A': 3,
    'S': 4,
    'E': 5,
    'C': 6
}

# Pemetaan pilihan huruf (A-E) ke skor likert 1-5
CHAR_MAP: Dict[str, int] = {
    'A': 1,
    'B': 2,
    'C': 3,
    'D': 4,
    'E': 5
}

# Pemetaan butir soal asesmen (nomor 1-42) ke 6 dimensi RIASEC
# Setiap dimensi terdiri dari 7 butir soal
RIASEC_MAP: Dict[str, List[int]] = {
    'R': [1, 7, 14, 22, 30, 32, 37],
    'I': [2, 11, 18, 21, 26, 33, 39],
    'A': [3, 8, 17, 23, 27, 31, 41],
    'S': [4, 12, 13, 20, 28, 34, 40],
    'E': [5, 10, 16, 19, 29, 36, 42],
    'C': [6, 9, 15, 24, 25, 35, 38],
}

# Metadata edukatif karakteristik masing-masing dimensi RIASEC
RIASEC_INFO: Dict[str, Dict[str, Any]] = {
    'R': {
        'code': 'R',
        'name': 'Realistic',
        'headline': 'Praktis, teknis, dan suka bekerja langsung dengan objek nyata',
        'badge_color': '#2E7D32',
        'badge_bg': '#E8F5E9',
        'description': (
            'Individu dengan tipe Realistic menyukai aktivitas fisik, penggunaan alat mesin, '
            'perbaikan perangkat keras, dan kerja di lapangan dengan hasil nyata dan terukur.'
        ),
        'typical_fields': ['Teknik Mesin', 'Teknik Elektro', 'Teknik Sipil', 'Teknologi Informasi'],
    },
    'I': {
        'code': 'I',
        'name': 'Investigative',
        'headline': 'Analitis, ingin tahu, dan suka memecahkan masalah kompleks',
        'badge_color': '#1565C0',
        'badge_bg': '#E3F2FD',
        'description': (
            'Individu dengan tipe Investigative senang mengamati, menganalisis data, meneliti '
            'fenomena ilmiah, dan memecahkan teka-teki logika serta konsep matematis abstrak.'
        ),
        'typical_fields': ['Informatika / Ilmu Komputer', 'Kedokteran', 'Statistika / Sains Data', 'Farmasi'],
    },
    'A': {
        'code': 'A',
        'name': 'Artistic',
        'headline': 'Kreatif, ekspresif, intuitif, dan inovatif',
        'badge_color': '#7B1FA2',
        'badge_bg': '#F3E5F5',
        'description': (
            'Individu dengan tipe Artistic menikmati eksplorasi ide orisinal, penciptaan media visual, '
            'desain grafis, penulisan naratif, serta lingkungan kerja yang bebas dan fleksibel.'
        ),
        'typical_fields': ['Desain Komunikasi Visual (DKV)', 'Arsitektur', 'Film & Animasi', 'Sastra'],
    },
    'S': {
        'code': 'S',
        'name': 'Social',
        'headline': 'Komunikatif, empatik, suka membantu dan mengembangkan sesama',
        'badge_color': '#00897B',
        'badge_bg': '#E0F2F1',
        'description': (
            'Individu dengan tipe Social memiliki kepedulian tinggi, senang berinteraksi sosial, '
            'mengajar, membimbing, memberi konsultasi, serta merawat kesejahteraan orang lain.'
        ),
        'typical_fields': ['Psikologi', 'Bimbingan Konseling', 'Pendidikan', 'Keperawatan & Kesehatan Masyarakat'],
    },
    'E': {
        'code': 'E',
        'name': 'Enterprising',
        'headline': 'Persuasif, berjiwa pemimpin, ambisius, dan berorientasi peluang',
        'badge_color': '#E65100',
        'badge_bg': '#FFF3E0',
        'description': (
            'Individu dengan tipe Enterprising pandai mempengaruhi orang lain, berani mengambil risiko, '
            'memimpin proyek, bernegosiasi bisnis, serta memotivasi kelompok mencapai target.'
        ),
        'typical_fields': ['Manajemen Bisnis', 'Ilmu Komunikasi / PR', 'Bisnis Digital', 'Hubungan Internasional'],
    },
    'C': {
        'code': 'C',
        'name': 'Conventional',
        'headline': 'Terstruktur, teliti, menyukai prosedur jelas dan pengorganisasian data',
        'badge_color': '#455A64',
        'badge_bg': '#ECEFF1',
        'description': (
            'Individu dengan tipe Conventional teliti dalam mencatat transaksi, mengelola basis data, '
            'mengikuti standar operasional yang terstruktur, dan menjamin keakuratan sistematis.'
        ),
        'typical_fields': ['Akuntansi', 'Sistem Informasi', 'Administrasi Publik', 'Perpajakan'],
    }
}


def parse_likert_value(val: Any) -> int:
    """
    Mengonversi input jawaban (bisa berupa integer 1-5 atau string 'A'-'E')
    menjadi skala integer 1 sampai 5 yang aman.
    """
    if val is None:
        return 3  # Nilai netral default jika kosong
    if isinstance(val, str):
        val_upper = val.strip().upper()
        if val_upper in CHAR_MAP:
            return CHAR_MAP[val_upper]
    try:
        num = int(float(val))
        return max(1, min(5, num))
    except (ValueError, TypeError):
        return 3


def calculate_riasec_scores(answers: Dict[Union[int, str], Any]) -> Dict[str, Any]:
    """
    Menghitung skor mentah (7-35), persentase ketercapaian (0-100%),
    pemeringkatan dengan tie-breaking canonical order, serta pembentukan
    vektor 6 dimensi RIASEC siswa.

    Parameter:
    - answers: Dictionary {nomor_soal: skor_atau_pilihan}

    Return:
    - Dict hasil evaluasi RIASEC lengkap dengan vektor siswa.
    """
    raw_scores: Dict[str, int] = {k: 0 for k in RIASEC_KEYS}

    # Jika answers kosong atau tidak ada, hitung dengan nilai 0
    if not answers:
        percent_scores = {k: 0.0 for k in RIASEC_KEYS}
        student_vector = [0.0 for _ in RIASEC_KEYS]
        sorted_types = list(RIASEC_KEYS)
        return {
            'raw_scores': raw_scores,
            'percent_scores': percent_scores,
            'student_vector': student_vector,
            'sorted_types': sorted_types,
            'top_types': sorted_types[:3],
            'holland_code': '-'.join(sorted_types[:3]),
            'sorted_list': [
                {
                    'type': t,
                    'score': 0,
                    'percent': 0.0,
                    'info': RIASEC_INFO[t]
                }
                for t in sorted_types
            ]
        }

    # Akumulasi nilai per dimensi berdasarkan RIASEC_MAP
    for dimension, item_numbers in RIASEC_MAP.items():
        for num in item_numbers:
            # Dukung key dalam bentuk integer (1) maupun string ('1')
            val = answers.get(num, answers.get(str(num), 3))
            raw_scores[dimension] += parse_likert_value(val)

    # Konversi skor mentah (maksimal 7 x 5 = 35) ke persentase 0-100%
    # Rumus: (skor_mentah / 35.0) * 100.0
    percent_scores: Dict[str, float] = {
        k: round((raw_scores[k] / 35.0) * 100.0, 2)
        for k in RIASEC_KEYS
    }

    # Vektor siswa 6 dimensi dalam urutan [R, I, A, S, E, C]
    student_vector: List[float] = [percent_scores[k] for k in RIASEC_KEYS]

    # Pemeringkatan tipe RIASEC:
    # 1. Skor persentase tertinggi
    # 2. Tie-breaking menggunakan canonical order R-I-A-S-E-C
    sorted_types = sorted(
        list(RIASEC_KEYS),
        key=lambda t: (-percent_scores[t], CANONICAL_ORDER.get(t, 99))
    )

    top_types = sorted_types[:3]
    holland_code = '-'.join(top_types)

    sorted_list = [
        {
            'type': t,
            'score': raw_scores[t],
            'percent': percent_scores[t],
            'info': RIASEC_INFO[t]
        }
        for t in sorted_types
    ]

    return {
        'raw_scores': raw_scores,
        'percent_scores': percent_scores,
        'student_vector': student_vector,
        'sorted_types': sorted_types,
        'top_types': top_types,
        'holland_code': holland_code,
        'sorted_list': sorted_list
    }
