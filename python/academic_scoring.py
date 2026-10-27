#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MODUL PENILAIAN AKADEMIK (academic_scoring.py)
=============================================================================
Modul untuk menghitung skor keselarasan akademik siswa berdasarkan nilai rapor
dan mata pelajaran yang relevan dengan masing-masing program studi.

Prinsip Perhitungan & Penanganan Data:
1. Setiap program studi memiliki konfigurasi mata pelajaran relevan dan bobotnya.
2. Jika siswa tidak menyertakan nilai rapor (nilai tidak tersedia), skor akademik
   TIDAK diisi angka 0, melainkan ditandai sebagai `is_available = False` (None).
3. Jika siswa menyertakan sebagian mata pelajaran, bobot mata pelajaran yang ada
   akan dinormalisasi ulang secara proporsional sehingga pembagian tetap adil.
=============================================================================
"""

from typing import Dict, Any, Optional, Tuple

# Pemetaan default bobot mata pelajaran relevan berdasarkan klaster/rumpun program studi
DEFAULT_SUBJECT_WEIGHTS: Dict[str, Dict[str, float]] = {
    'teknologi_rekayasa': {
        'Matematika': 0.45,
        'IPAS': 0.35,
        'Bahasa Inggris': 0.20
    },
    'medis_hayati': {
        'IPAS': 0.50,
        'Matematika': 0.25,
        'Bahasa Inggris': 0.25
    },
    'ekonomi_bisnis': {
        'Matematika': 0.40,
        'Bahasa Inggris': 0.30,
        'Bahasa Indonesia': 0.30
    },
    'desain_kreatif': {
        'Bahasa Indonesia': 0.35,
        'Bahasa Inggris': 0.35,
        'Matematika': 0.15,
        'IPAS': 0.15
    },
    'sosial_humaniora': {
        'Bahasa Indonesia': 0.40,
        'Bahasa Inggris': 0.30,
        'IPAS': 0.30
    }
}


def determine_prodi_cluster(nama_prodi: str) -> str:
    """
    Menentukan klaster rumpun keilmuan berdasarkan kata kunci pada nama prodi.
    """
    name_lower = (nama_prodi or '').lower()

    if any(k in name_lower for k in ['informatika', 'komputer', 'sistem informasi', 'mesin', 'sipil', 'elektro', 'teknik']):
        return 'teknologi_rekayasa'
    elif any(k in name_lower for k in ['kedokteran', 'kesehatan', 'keperawatan', 'farmasi', 'biologi']):
        return 'medis_hayati'
    elif any(k in name_lower for k in ['akuntansi', 'manajemen', 'bisnis', 'ekonomi', 'perpajakan', 'statistika']):
        return 'ekonomi_bisnis'
    elif any(k in name_lower for k in ['desain', 'dkv', 'seni', 'arsitektur', 'animasi', 'film']):
        return 'desain_kreatif'
    else:
        return 'sosial_humaniora'


def get_relevant_subject_weights(prodi_data: Dict[str, Any]) -> Dict[str, float]:
    """
    Mengambil bobot mata pelajaran relevan untuk sebuah program studi.
    Memeriksa konfigurasi eksplisit di 'relevant_subjects' terlebih dahulu;
    jika tidak ada, mengambil dari klaster rumpun keilmuan.
    """
    if 'relevant_subjects' in prodi_data and isinstance(prodi_data['relevant_subjects'], dict):
        return prodi_data['relevant_subjects']

    cluster = determine_prodi_cluster(prodi_data.get('nama_prodi', ''))
    return DEFAULT_SUBJECT_WEIGHTS.get(cluster, DEFAULT_SUBJECT_WEIGHTS['sosial_humaniora'])


def calculate_academic_score(
    academic_grades: Optional[Dict[str, Any]],
    prodi_data: Dict[str, Any]
) -> Dict[str, Any]:
    """
    Menghitung skor akademik terbobot untuk program studi tertentu.

    Parameter:
    - academic_grades: Dict {nama_mapel: nilai (0-100)}, contoh:
      {'Matematika': 90, 'IPAS': 88, 'Bahasa Inggris': 85}
    - prodi_data: Dict informasi program studi

    Return:
    - Dict berisi:
        'score': float skor terbobot 0-100 (atau None jika tidak tersedia)
        'is_available': bool apakah data akademik valid dan tersedia
        'details': rincian kontribusi nilai per mata pelajaran
        'highlight_text': ringkasan singkat nilai relevan untuk narasi
    """
    if not academic_grades or not isinstance(academic_grades, dict):
        return {
            'score': None,
            'is_available': False,
            'details': {},
            'highlight_text': "Data nilai akademik rapor tidak disertakan"
        }

    # Filter nilai yang valid (skalar numerik 0-100)
    valid_grades: Dict[str, float] = {}
    for mapel, val in academic_grades.items():
        try:
            numeric_val = float(val)
            if 0.0 <= numeric_val <= 100.0:
                valid_grades[mapel] = numeric_val
        except (ValueError, TypeError):
            continue

    if not valid_grades:
        return {
            'score': None,
            'is_available': False,
            'details': {},
            'highlight_text': "Data nilai akademik tidak memiliki angka valid"
        }

    # Ambil konfigurasi mata pelajaran yang relevan untuk prodi ini
    subject_weights = get_relevant_subject_weights(prodi_data)

    # Identifikasi mata pelajaran yang ada dalam input siswa
    matched_subjects: Dict[str, Tuple[float, float]] = {}  # mapel -> (nilai, bobot_asli)

    for sub_name, raw_weight in subject_weights.items():
        if sub_name in valid_grades:
            matched_subjects[sub_name] = (valid_grades[sub_name], raw_weight)
        else:
            # Toleransi variasi nama mata pelajaran (misal: 'Biologi' cocok ke 'IPAS' jika 'IPAS' tidak ada)
            alt_candidates = []
            if sub_name == 'IPAS':
                alt_candidates = ['Biologi', 'Fisika', 'Kimia', 'IPA']
            elif sub_name == 'Bahasa Inggris':
                alt_candidates = ['B. Inggris', 'Inggris', 'English']
            elif sub_name == 'Bahasa Indonesia':
                alt_candidates = ['B. Indonesia', 'Indonesia']
            elif sub_name == 'Matematika':
                alt_candidates = ['Matematika Peminatan', 'Matematika Wajib', 'MTK']

            for alt in alt_candidates:
                if alt in valid_grades:
                    matched_subjects[sub_name] = (valid_grades[alt], raw_weight)
                    break

    # Jika tidak ada satu pun mata pelajaran relevan yang cocok,
    # gunakan rata-rata seluruh nilai valid yang tersedia sebagai estimasi adil
    if not matched_subjects:
        avg_all = sum(valid_grades.values()) / len(valid_grades)
        return {
            'score': round(avg_all, 2),
            'is_available': True,
            'details': {m: {'grade': g, 'effective_weight': round(1.0 / len(valid_grades), 3)} for m, g in valid_grades.items()},
            'highlight_text': f"Rata-rata umum rapor ({round(avg_all, 1)})"
        }

    # Normalisasi ulang bobot mata pelajaran yang cocok sehingga jumlah bobot = 1.0
    total_matched_weight = sum(weight for _, weight in matched_subjects.values())
    if total_matched_weight <= 0:
        total_matched_weight = 1.0

    weighted_sum = 0.0
    details: Dict[str, Any] = {}
    highlight_parts = []

    for sub_name, (grade, raw_weight) in matched_subjects.items():
        effective_weight = raw_weight / total_matched_weight
        weighted_sum += grade * effective_weight
        details[sub_name] = {
            'grade': grade,
            'raw_weight': raw_weight,
            'effective_weight': round(effective_weight, 4),
            'weighted_contribution': round(grade * effective_weight, 2)
        }
        highlight_parts.append(f"{sub_name} ({round(grade, 1)})")

    final_academic_score = round(min(100.0, max(0.0, weighted_sum)), 2)
    highlight_text = ', '.join(highlight_parts)

    return {
        'score': final_academic_score,
        'is_available': True,
        'details': details,
        'highlight_text': highlight_text
    }
