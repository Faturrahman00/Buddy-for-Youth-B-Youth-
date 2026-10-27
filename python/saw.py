#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MODUL SIMPLE ADDITIVE WEIGHTING (saw.py)
=============================================================================
Implementasi metode pengambilan keputusan multi-kriteria (MCDA / Multi-Criteria
Decision Analysis) Simple Additive Weighting (SAW).

Metode ini menentukan preferensi alternatif program studi dengan langkah:
1. Pembentukan Matriks Keputusan (X) berukuran m x n (m alternatif, n kriteria).
2. Normalisasi Matriks Keputusan (R) berdasarkan tipe kriteria (Benefit).
3. Penyesuaian Bobot Dinamis (Re-weighting) jika ada kriteria yang tidak aktif
   (misalnya nilai akademik siswa tidak tersedia), sehingga total bobot SELALU = 1.0.
4. Perhitungan Nilai Preferensi Akhir (V) melalui perkalian terbobot:
       V_i = sum(w_j * r_ij) untuk semua kriteria aktif j.
5. Pemeringkatan alternatif dari nilai preferensi tertinggi ke terendah.

Prinsip Ketat:
- Semua kriteria terdefinisi secara transparan dengan rentang nilai [0.0, 100.0].
- Tidak ada penambahan bonus atau manipulasi skor di luar formulasi formal SAW.
=============================================================================
"""

from typing import List, Dict, Any, Optional, Tuple


class Criterion:
    """
    Definisi sebuah kriteria dalam MCDA SAW.
    """
    def __init__(
        self,
        code: str,
        name: str,
        weight: float,
        is_benefit: bool = True,
        description: str = ""
    ):
        self.code = code
        self.name = name
        self.weight = weight
        self.is_benefit = is_benefit
        self.description = description

    def to_dict(self) -> Dict[str, Any]:
        return {
            'code': self.code,
            'name': self.name,
            'base_weight': self.weight,
            'is_benefit': self.is_benefit,
            'description': self.description
        }


# Konfigurasi bobot awal standar B-Youth (dapat disesuaikan)
DEFAULT_CRITERIA_CONFIG: List[Criterion] = [
    Criterion(
        code='C1_RIASEC',
        name='Kecocokan Minat RIASEC',
        weight=0.50,
        is_benefit=True,
        description='Skor kecocokan profil Holland RIASEC berbasis Cosine Similarity (0-100).'
    ),
    Criterion(
        code='C2_AKADEMIK',
        name='Kesiapan Nilai Akademik',
        weight=0.35,
        is_benefit=True,
        description='Skor rata-rata terbobot mata pelajaran relevan rapor siswa (0-100).'
    ),
    Criterion(
        code='C3_ATURAN',
        name='Kesesuaian Aturan Pakar',
        weight=0.15,
        is_benefit=True,
        description='Skor kepatuhan aturan inferensi Forward Chaining sistem pakar (0-100).'
    )
]


class SAWEngine:
    """
    Mesin perhitungan Simple Additive Weighting (SAW).
    """

    def __init__(self, criteria: Optional[List[Criterion]] = None):
        """
        Inisialisasi mesin SAW dengan konfigurasi kriteria.
        """
        self.criteria: List[Criterion] = (
            criteria if criteria is not None else DEFAULT_CRITERIA_CONFIG
        )
        self._validate_base_weights()

    def _validate_base_weights(self) -> None:
        """Memverifikasi bahwa total bobot dasar kriteria sama dengan 1.0."""
        total_w = sum(c.weight for c in self.criteria)
        if not (0.999 <= total_w <= 1.001):
            raise ValueError(
                f"Total bobot kriteria harus berjumlah 1.0 (100%), saat ini: {round(total_w, 4)}"
            )

    def calculate_effective_weights(
        self,
        active_criterion_codes: List[str]
    ) -> Dict[str, float]:
        """
        Menyesuaikan bobot secara dinamis (Re-weighting Policy).
        Jika satu kriteria (misal nilai akademik) tidak tersedia, bobot kriteria
        yang aktif akan dinormalisasi ulang sehingga total bobot tetap tepat 1.0.

        Rumus:
            w'_j = w_j / sum(w_k) untuk semua k yang aktif
        """
        active_criteria = [c for c in self.criteria if c.code in active_criterion_codes]
        if not active_criteria:
            raise ValueError("Minimal harus ada satu kriteria aktif dalam evaluasi SAW.")

        total_active_weight = sum(c.weight for c in active_criteria)
        if total_active_weight <= 0:
            raise ValueError("Jumlah bobot kriteria aktif harus lebih besar dari 0.")

        effective_weights: Dict[str, float] = {}
        for c in active_criteria:
            effective_weights[c.code] = c.weight / total_active_weight

        # Verifikasi jumlah bobot efektif = 1.0
        sum_effective = sum(effective_weights.values())
        assert 0.9999 <= sum_effective <= 1.0001, "Normalisasi bobot gagal mencapai 1.0"

        return effective_weights

    def rank_alternatives(
        self,
        alternatives: List[Dict[str, Any]],
        criteria_matrix: Dict[str, Dict[str, float]],
        active_criterion_codes: Optional[List[str]] = None
    ) -> Dict[str, Any]:
        """
        Menjalankan alur lengkap metode SAW:
        1. Menentukan kriteria aktif dan bobot efektif.
        2. Mencari nilai ekstrem (Max untuk benefit) per kolom kriteria.
        3. Menghitung Matriks Ternormalisasi R.
        4. Menghitung Nilai Preferensi V_i.
        5. Mengurutkan alternatif secara descending.

        Parameter:
        - alternatives: List program studi (setidaknya memiliki key 'kode_prodi' atau 'nama_prodi')
        - criteria_matrix: Dict {kode_alternatif: {kode_kriteria: nilai_raw_x_ij}}
        - active_criterion_codes: List kode kriteria yang diikutsertakan

        Return:
        - Dict berisi hasil perankingan, matriks keputusan, matriks ternormalisasi, dan bobot.
        """
        if not alternatives:
            return {
                'ranked_results': [],
                'decision_matrix': {},
                'normalized_matrix': {},
                'effective_weights': {}
            }

        # Jika active_criterion_codes tidak ditentukan, aktifkan semua kriteria
        if active_criterion_codes is None:
            active_criterion_codes = [c.code for c in self.criteria]

        active_criteria = [c for c in self.criteria if c.code in active_criterion_codes]
        effective_weights = self.calculate_effective_weights(active_criterion_codes)

        alt_keys = [
            alt.get('kode_prodi') or alt.get('id_prodi') or alt.get('nama_prodi')
            for alt in alternatives
        ]

        # 1. Matriks Keputusan (X)
        decision_matrix: Dict[str, Dict[str, float]] = {}
        for key in alt_keys:
            decision_matrix[key] = {}
            for c in active_criteria:
                val = criteria_matrix.get(key, {}).get(c.code, 0.0)
                # Pastikan nilai adalah numerik non-negatif
                decision_matrix[key][c.code] = max(0.0, float(val))

        # 2. Nilai Ekstrem Kolom (Max untuk kriteria Benefit)
        column_max: Dict[str, float] = {}
        column_min: Dict[str, float] = {}
        for c in active_criteria:
            col_values = [decision_matrix[k][c.code] for k in alt_keys]
            column_max[c.code] = max(col_values) if col_values else 0.0
            column_min[c.code] = min(col_values) if col_values else 0.0

        # 3. Matriks Ternormalisasi (R)
        # Rumus Benefit: r_ij = x_ij / max_k(x_kj)
        # Tangani kasus max_k == 0 secara aman (r_ij = 0.0)
        normalized_matrix: Dict[str, Dict[str, float]] = {}
        for key in alt_keys:
            normalized_matrix[key] = {}
            for c in active_criteria:
                x_val = decision_matrix[key][c.code]
                c_max = column_max[c.code]

                if c.is_benefit:
                    if c_max > 0:
                        r_val = x_val / c_max
                    else:
                        r_val = 0.0
                else:
                    # Rumus Cost (jika ada): r_ij = min_k(x_kj) / x_ij
                    c_min = column_min[c.code]
                    if x_val > 0:
                        r_val = c_min / x_val
                    else:
                        r_val = 0.0

                normalized_matrix[key][c.code] = round(r_val, 4)

        # 4. Perhitungan Nilai Preferensi SAW (V_i)
        # V_i = sum(w'_j * r_ij)
        scored_alternatives: List[Dict[str, Any]] = []
        for alt in alternatives:
            key = alt.get('kode_prodi') or alt.get('id_prodi') or alt.get('nama_prodi')

            saw_preference = 0.0
            criteria_breakdown: Dict[str, Dict[str, Any]] = {}

            for c in active_criteria:
                r_ij = normalized_matrix[key][c.code]
                w_j = effective_weights[c.code]
                weighted_contribution = w_j * r_ij
                saw_preference += weighted_contribution

                criteria_breakdown[c.code] = {
                    'criterion_name': c.name,
                    'raw_value': round(decision_matrix[key][c.code], 2),
                    'normalized_value': r_ij,
                    'effective_weight': round(w_j, 4),
                    'weighted_score': round(weighted_contribution * 100.0, 2)
                }

            # Skor preferensi V_i berada pada rentang [0.0, 1.0]
            # Skor persentase skala 0-100: V_i * 100
            percentage_score = round(saw_preference * 100.0, 2)

            scored_item = {
                'prodi_info': alt,
                'prodi_key': key,
                'kode_prodi': alt.get('kode_prodi'),
                'nama_prodi': alt.get('nama_prodi'),
                'saw_preference_v': round(saw_preference, 4),
                'final_score': percentage_score,
                'criteria_breakdown': criteria_breakdown
            }
            scored_alternatives.append(scored_item)

        # 5. Pemeringkatan Alternatif (Descending)
        scored_alternatives.sort(key=lambda item: item['saw_preference_v'], reverse=True)

        # Berikan nomor peringkat (Rank 1, 2, 3, ...)
        for rank_idx, item in enumerate(scored_alternatives, start=1):
            item['rank'] = rank_idx

        return {
            'ranked_results': scored_alternatives,
            'decision_matrix': decision_matrix,
            'normalized_matrix': normalized_matrix,
            'effective_weights': {k: round(v, 4) for k, v in effective_weights.items()},
            'active_criteria': [c.to_dict() for c in active_criteria],
            'column_extremes': {
                'max': column_max,
                'min': column_min
            }
        }
