#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: RECOMMENDATION ENGINE ORCHESTRATOR (recommendation_engine.py)
=============================================================================
Modul orkestrator utama sistem rekomendasi B-Youth (Buddy For Youth).
Mengoordinasikan keseluruhan alur kerja rekomendasi secara modular,
dapat dijelaskan (explainable AI), transparan, dan terstruktur.

Alur Kerja 12 Langkah:
1. Menerima jawaban asesmen RIASEC dan nilai akademik siswa.
2. Menghitung skor RIASEC dari jawaban asesmen (riasec.py).
3. Membentuk profil vektor RIASEC siswa 6 dimensi (riasec.py).
4. Menghitung Cosine Similarity terhadap profil setiap prodi (cosine_similarity.py).
5. Menjalankan Forward Chaining untuk inferensi aturan pakar (forward_chaining.py).
6. Menghitung skor akademik per prodi berdasarkan mapel relevan (academic_scoring.py).
7. Menyusun nilai kriteria untuk seluruh alternatif program studi.
8. Menormalisasi kriteria dan menghitung nilai preferensi SAW (saw.py).
9. Mengurutkan program studi berdasarkan skor akhir SAW tertinggi.
10. Mengambil tiga program studi dengan peringkat tertinggi (Top-3).
11. Membuat deskripsi otomatis yang jujur dan transparan (text_generation.py).
12. Mengembalikan struktur data lengkap siap pakai untuk API backend atau CLI.
=============================================================================
"""

from typing import Dict, List, Any, Optional

from riasec import calculate_riasec_scores, RIASEC_KEYS, RIASEC_INFO
from cosine_similarity import (
    calculate_cosine_similarity,
    cosine_to_percentage_score,
    build_prodi_vector
)
from forward_chaining import ForwardChainingEngine
from academic_scoring import calculate_academic_score
from saw import SAWEngine, Criterion, DEFAULT_CRITERIA_CONFIG
from text_generation import generate_recommendation_explanation
from data_catalog import get_default_catalog, SIMULATION_DISCLAIMER


class BYouthRecommendationEngine:
    """
    Sistem Rekomendasi Terpadu B-Youth.
    Menggabungkan Content-Based Filtering (Cosine Similarity), Forward Chaining,
    dan Simple Additive Weighting (SAW) sebagai metode MCDA formal.
    """

    def __init__(
        self,
        criteria_config: Optional[List[Criterion]] = None,
        fc_engine: Optional[ForwardChainingEngine] = None,
        saw_engine: Optional[SAWEngine] = None
    ):
        """
        Inisialisasi engine dengan konfigurasi bobot dan mesin inferensi yang dapat disesuaikan.
        """
        self.criteria_config = criteria_config or DEFAULT_CRITERIA_CONFIG
        self.fc_engine = fc_engine or ForwardChainingEngine()
        self.saw_engine = saw_engine or SAWEngine(criteria=self.criteria_config)

    def recommend(
        self,
        answers: Dict[Any, Any],
        academic_grades: Optional[Dict[str, Any]] = None,
        catalog: Optional[List[Dict[str, Any]]] = None
    ) -> Dict[str, Any]:
        """
        Mengeksekusi alur lengkap sistem rekomendasi program studi.

        Parameter:
        - answers: Dict jawaban asesmen RIASEC (butir 1-42)
        - academic_grades: Dict nilai rapor mata pelajaran (opsional)
        - catalog: List dataset program studi (jika None, menggunakan katalog default)

        Return:
        - Dict terstruktur berisi hasil asesmen, matriks SAW, Top-3 rekomendasi,
          dan jejak audit transparansi keputusan.
        """
        # Gunakan katalog simulasi jika tidak disediakan
        prodi_list = catalog if catalog is not None else get_default_catalog()

        # ── LANGKAH 1, 2 & 3: Evaluasi RIASEC & Pembentukan Vektor Siswa ──
        riasec_result = calculate_riasec_scores(answers)
        student_vector = riasec_result['student_vector']
        top_types = riasec_result['top_types']
        holland_code = riasec_result['holland_code']

        # Status ketersediaan nilai akademik
        has_academic_data = bool(academic_grades and len(academic_grades) > 0)

        # ── LANGKAH 5: Forward Chaining (Inferensi Pakar) ──
        facts = {
            'top_types': top_types,
            'percent_scores': riasec_result['percent_scores'],
            'raw_scores': riasec_result['raw_scores'],
            'holland_code': holland_code,
            'academic_grades': academic_grades or {},
            'has_academic_data': has_academic_data
        }
        fc_result = self.fc_engine.infer(facts)
        fired_rules = fc_result['fired_rules']
        supported_prodi_rules = fc_result['supported_prodi_rules']

        # ── LANGKAH 4, 6 & 7: Perhitungan Kriteria untuk Tiap Alternatif Prodi ──
        # Kriteria:
        # C1_RIASEC: Cosine Similarity x 100 [0-100]
        # C2_AKADEMIK: Nilai Rapor Terbobot [0-100] (jika tersedia)
        # C3_ATURAN: Skor Kecocokan Aturan Pakar [0-100]
        criteria_matrix: Dict[str, Dict[str, float]] = {}
        academic_evaluations: Dict[str, Dict[str, Any]] = {}
        cosine_evaluations: Dict[str, float] = {}
        rule_evaluations: Dict[str, float] = {}

        for prodi in prodi_list:
            code = prodi.get('kode_prodi') or str(prodi.get('id_prodi'))

            # Langkah 4: Cosine Similarity
            prodi_vec = build_prodi_vector(prodi, keys=RIASEC_KEYS)
            similarity = calculate_cosine_similarity(student_vector, prodi_vec)
            c1_score = cosine_to_percentage_score(similarity)
            cosine_evaluations[code] = c1_score

            # Langkah 6: Skor Akademik
            acad_eval = calculate_academic_score(academic_grades, prodi)
            academic_evaluations[code] = acad_eval
            c2_score = acad_eval['score'] if acad_eval['is_available'] else 0.0

            # Forward Chaining Rule Match Score (terukur 0-100)
            c3_score = self.fc_engine.calculate_rule_match_score(code, supported_prodi_rules)
            rule_evaluations[code] = c3_score

            # Langkah 7: Matriks Keputusan untuk Prodi ini
            criteria_matrix[code] = {
                'C1_RIASEC': c1_score,
                'C2_AKADEMIK': c2_score,
                'C3_ATURAN': c3_score
            }

        # Tentukan kriteria aktif untuk MCDA SAW:
        # Jika nilai akademik tidak ada, deaktifkan C2_AKADEMIK dan lakukan re-weighting
        active_codes = ['C1_RIASEC', 'C3_ATURAN']
        if has_academic_data:
            # Periksa apakah setidaknya ada skor akademik valid
            any_valid_academic = any(a['is_available'] for a in academic_evaluations.values())
            if any_valid_academic:
                active_codes.insert(1, 'C2_AKADEMIK')

        # ── LANGKAH 8 & 9: Normalisasi & Perhitungan Skor SAW, serta Pemeringkatan ──
        saw_result = self.saw_engine.rank_alternatives(
            alternatives=prodi_list,
            criteria_matrix=criteria_matrix,
            active_criterion_codes=active_codes
        )
        ranked_results = saw_result['ranked_results']

        # ── LANGKAH 10: Mengambil Tiga Program Studi Teratas (Top-3) ──
        top_3_items = ranked_results[:3]

        # ── LANGKAH 11: Rule-Based Text Generation untuk Top Rekomendasi ──
        has_riasec_data = any(v > 0 for v in riasec_result['percent_scores'].values())
        student_facts_for_text = {
            'top_types': top_types,
            'holland_code': holland_code,
            'has_riasec_data': has_riasec_data,
            'has_academic_data': has_academic_data and ('C2_AKADEMIK' in active_codes),
            'academic_scores': academic_evaluations,
            'prodi_fired_rules': supported_prodi_rules
        }

        recommendations_output = []
        for item in top_3_items:
            code = item['kode_prodi']
            explanation = generate_recommendation_explanation(item, student_facts_for_text)

            prodi_meta = item['prodi_info']
            recommendations_output.append({
                'rank': item['rank'],
                'prodi_id': prodi_meta.get('id_prodi'),
                'kode_prodi': code,
                'nama_prodi': prodi_meta.get('nama_prodi'),
                'skor': item['final_score'],  # Skor akhir SAW (skala 0-100)
                'saw_preference_v': item['saw_preference_v'],
                'skor_cosine_similarity': cosine_evaluations.get(code, 0.0),
                'skor_akademik': (
                    academic_evaluations[code]['score']
                    if academic_evaluations[code]['is_available']
                    else None
                ),
                'skor_aturan_pakar': rule_evaluations.get(code, 40.0),
                'aturan_terpenuhi': [
                    r['name'] for r in supported_prodi_rules.get(code, [])
                ],
                'alasan': explanation,
                'prospek_karier': prodi_meta.get('prospek_karier', ''),
                'deskripsi_prodi': prodi_meta.get('deskripsi_prodi', ''),
                'tipe_riasec': prodi_meta.get('tipe_riasec', ''),
                'criteria_breakdown': item['criteria_breakdown']
            })

        # ── LANGKAH 12: Mengembalikan Struktur Data Lengkap ──
        top_types_info = [
            RIASEC_INFO[t] for t in top_types if t in RIASEC_INFO
        ]

        return {
            'success': True,
            'system_name': 'B-Youth Hybrid Recommendation Engine (SAW + Cosine + Forward Chaining)',
            'simulation_disclaimer': SIMULATION_DISCLAIMER,
            'academic_policy': (
                "Data akademik diikutsertakan dengan bobot proporsional."
                if ('C2_AKADEMIK' in active_codes)
                else "Data akademik tidak tersedia; sistem menerapkan re-weighting otomatis pada kriteria minat dan aturan tanpa penalti nilai 0."
            ),
            'student_profile': {
                'raw_scores': riasec_result['raw_scores'],
                'percent_scores': riasec_result['percent_scores'],
                'student_vector': student_vector,
                'top_types': top_types,
                'holland_code': holland_code,
                'top_types_info': top_types_info
            },
            'forward_chaining_trace': {
                'total_fired_rules': len(fired_rules),
                'fired_rules': fired_rules
            },
            'saw_audit': {
                'active_criteria': saw_result['active_criteria'],
                'effective_weights': saw_result['effective_weights'],
                'decision_matrix': saw_result['decision_matrix'],
                'normalized_matrix': saw_result['normalized_matrix'],
                'column_max': saw_result['column_extremes']['max']
            },
            'all_ranked_prodis': [
                {
                    'rank': item['rank'],
                    'kode_prodi': item['kode_prodi'],
                    'nama_prodi': item['nama_prodi'],
                    'final_score': item['final_score'],
                    'saw_preference_v': item['saw_preference_v']
                }
                for item in ranked_results
            ],
            'recommendations': recommendations_output
        }
