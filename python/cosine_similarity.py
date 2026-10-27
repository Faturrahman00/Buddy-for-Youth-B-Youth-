#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MODUL COSINE SIMILARITY (cosine_similarity.py)
=============================================================================
Modul Content-Based Filtering menggunakan Cosine Similarity.
Menghitung tingkat kemiripan orientasi antara:
- Vektor profil RIASEC siswa (6 dimensi)
- Vektor karakteristik program studi (6 dimensi)

Rumus Matematika:
    cos(theta) = (u . v) / (||u|| * ||v||)
               = sum(u_i * v_i) / (sqrt(sum(u_i^2)) * sqrt(sum(v_i^2)))

Fitur Keselamatan Komputasi:
- Menangani vektor bernilai nol (zero vector) tanpa ZeroDivisionError.
- Membatasi hasil pada rentang matematis [-1.0, 1.0] dan mengonversi ke skor [0.0, 100.0].
=============================================================================
"""

import math
from typing import List, Sequence, Union, Dict, Any

try:
    import numpy as np
    HAS_NUMPY = True
except ImportError:
    HAS_NUMPY = False

from riasec import RIASEC_KEYS


def calculate_cosine_similarity(
    vec_a: Sequence[Union[int, float]],
    vec_b: Sequence[Union[int, float]]
) -> float:
    """
    Menghitung Cosine Similarity antara dua vektor numerik berdimensi sama.

    Parameter:
    - vec_a: Vektor pertama (misal vektor RIASEC siswa)
    - vec_b: Vektor kedua (misal vektor RIASEC program studi)

    Return:
    - Nilai kesamaan kosinus dalam rentang [0.0, 1.0] (untuk vektor non-negatif).
      Mengembalikan 0.0 jika salah satu atau kedua vektor memiliki magnitudo nol.
    """
    if len(vec_a) != len(vec_b):
        raise ValueError(
            f"Dimensi kedua vektor harus sama: len(vec_a)={len(vec_a)} != len(vec_b)={len(vec_b)}"
        )

    if HAS_NUMPY:
        a = np.asarray(vec_a, dtype=np.float64)
        b = np.asarray(vec_b, dtype=np.float64)
        norm_a = float(np.linalg.norm(a))
        norm_b = float(np.linalg.norm(b))

        # Penanganan pembagian dengan nol jika ada vektor dengan panjang nol
        if norm_a == 0.0 or norm_b == 0.0 or math.isnan(norm_a) or math.isnan(norm_b):
            return 0.0

        dot = float(np.dot(a, b))
        similarity = dot / (norm_a * norm_b)
    else:
        # Implementasi pure Python fallback
        dot = sum(float(a) * float(b) for a, b in zip(vec_a, vec_b))
        norm_a = math.sqrt(sum(float(a) * float(a) for a in vec_a))
        norm_b = math.sqrt(sum(float(b) * float(b) for b in vec_b))

        if norm_a == 0.0 or norm_b == 0.0:
            return 0.0

        similarity = dot / (norm_a * norm_b)

    # Menjaga stabilitas numerik floating point (clipping ke [-1.0, 1.0])
    similarity = max(-1.0, min(1.0, similarity))

    # Karena skor RIASEC bersifat non-negatif, kemiripan kosinus dibatasi minimal 0.0
    return max(0.0, similarity)


def cosine_to_percentage_score(similarity: float) -> float:
    """
    Mengonversi nilai Cosine Similarity [0.0, 1.0] menjadi skor kecocokan 0-100.
    """
    clamped = max(0.0, min(1.0, similarity))
    return round(clamped * 100.0, 2)


def build_prodi_vector(
    prodi_data: Dict[str, Any],
    keys: Sequence[str] = RIASEC_KEYS
) -> List[float]:
    """
    Membangun vektor RIASEC 6 dimensi untuk sebuah program studi.
    Mendukung dua bentuk data:
    1. Vektor eksplisit di field 'riasec_vector' (misal: [20, 100, 40, 20, 20, 60])
    2. Tag tipe RIASEC (misal 'I,R,C') yang dipetakan dengan bobot prioritas:
       - Tipe primer: 100.0
       - Tipe sekunder: 75.0
       - Tipe tersier: 50.0
       - Tipe dasar lainnya: 15.0

    Return:
    - List float berukuran 6 sesuai urutan RIASEC_KEYS
    """
    # Jika vektor 6D sudah disediakan secara eksplisit
    if 'riasec_vector' in prodi_data and isinstance(prodi_data['riasec_vector'], (list, tuple)):
        raw_vec = prodi_data['riasec_vector']
        if len(raw_vec) == len(keys):
            return [float(x) for x in raw_vec]

    # Ekstraksi dari string tipe_riasec (contoh: "I, R, C")
    raw_tag_str = prodi_data.get('tipe_riasec') or prodi_data.get('holland_code') or ''
    tags = [t.strip().upper() for t in raw_tag_str.replace('–', '-').replace('-', ',').split(',') if t.strip()]

    # Bobot diferensiasi Holland: tipe ke-1 paling dominan, diikuti ke-2 dan ke-3
    priority_weights = [100.0, 75.0, 50.0]
    base_weight = 15.0  # Bobot dasar untuk dimensi non-fokus

    vector_map: Dict[str, float] = {k: base_weight for k in keys}

    for idx, tag in enumerate(tags[:3]):
        if tag in vector_map:
            vector_map[tag] = priority_weights[idx]

    return [vector_map[k] for k in keys]
