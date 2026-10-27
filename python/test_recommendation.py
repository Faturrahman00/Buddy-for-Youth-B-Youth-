#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: SUITE PENGUJIAN UNIT & INTEGRASI (test_recommendation.py)
=============================================================================
Memvalidasi seluruh persyaratan sistem rekomendasi B-Youth:
1. Validasi kebenaran Cosine Similarity & penanganan zero-vector (aman tanpa pembagian nol).
2. Validasi Forward Chaining (hanya mengaktifkan aturan yang kondisinya terpenuhi).
3. Validasi perhitungan kriteria aturan pakar (terukur berskala 0-100).
4. Validasi normalisasi SAW (Benefit formula r_ij = x_ij / max(x_j)).
5. Validasi total bobot kriteria (selalu tepat 1.0 baik saat lengkap maupun re-weighting).
6. Validasi konsistensi skor preferensi akhir SAW dan pemeringkatan descending.
7. Validasi penanganan data nilai akademik yang tidak tersedia (tanpa penalti 0).
8. Validasi kejujuran text generation (tidak membuat klaim akademik tanpa data).
9. Validasi ketahanan pipeline terhadap nilai NaN, nol, atau format input abnormal.
=============================================================================
"""

import math
import os
import sys

# Nonaktifkan pembuatan file cache bytecode (.pyc / __pycache__)
sys.dont_write_bytecode = True

import unittest
from typing import Dict, Any

# Pastikan direktori modul lokal dapat diimpor terlepas dari direktori kerja eksekusi
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from riasec import calculate_riasec_scores, RIASEC_KEYS
from cosine_similarity import (
    calculate_cosine_similarity,
    cosine_to_percentage_score,
    build_prodi_vector
)
from forward_chaining import ForwardChainingEngine, Rule
from academic_scoring import calculate_academic_score
from saw import SAWEngine, Criterion, DEFAULT_CRITERIA_CONFIG
from text_generation import generate_recommendation_explanation
from recommendation_engine import BYouthRecommendationEngine
from data_catalog import get_default_catalog


class TestCosineSimilarity(unittest.TestCase):
    """Pengujian modul Content-Based Filtering Cosine Similarity."""

    def test_identical_vectors(self):
        """Dua vektor identik harus menghasilkan cosine similarity = 1.0 (skor 100%)."""
        vec = [10.0, 20.0, 30.0, 40.0, 50.0, 60.0]
        sim = calculate_cosine_similarity(vec, vec)
        self.assertAlmostEqual(sim, 1.0, places=5)
        self.assertAlmostEqual(cosine_to_percentage_score(sim), 100.0, places=1)

    def test_orthogonal_vectors(self):
        """Dua vektor orthogonal (tegak lurus) harus menghasilkan similarity = 0.0."""
        vec_a = [10.0, 0.0, 0.0, 0.0, 0.0, 0.0]
        vec_b = [0.0, 10.0, 0.0, 0.0, 0.0, 0.0]
        sim = calculate_cosine_similarity(vec_a, vec_b)
        self.assertAlmostEqual(sim, 0.0, places=5)

    def test_zero_vector_safety(self):
        """Vektor nol tidak boleh memicu ZeroDivisionError dan harus menghasilkan 0.0."""
        zero_vec = [0.0, 0.0, 0.0, 0.0, 0.0, 0.0]
        normal_vec = [10.0, 20.0, 30.0, 40.0, 50.0, 60.0]

        sim_1 = calculate_cosine_similarity(zero_vec, normal_vec)
        sim_2 = calculate_cosine_similarity(normal_vec, zero_vec)
        sim_3 = calculate_cosine_similarity(zero_vec, zero_vec)

        self.assertEqual(sim_1, 0.0)
        self.assertEqual(sim_2, 0.0)
        self.assertEqual(sim_3, 0.0)
        self.assertFalse(math.isnan(sim_1))

    def test_known_cosine_calculation(self):
        """Verifikasi matematis: A=[3, 4], B=[4, 3] -> dot=24, |A|=5, |B|=5 -> 24/25 = 0.96."""
        a = [3.0, 4.0, 0.0, 0.0, 0.0, 0.0]
        b = [4.0, 3.0, 0.0, 0.0, 0.0, 0.0]
        sim = calculate_cosine_similarity(a, b)
        self.assertAlmostEqual(sim, 0.96, places=4)
        self.assertAlmostEqual(cosine_to_percentage_score(sim), 96.0, places=1)


class TestForwardChaining(unittest.TestCase):
    """Pengujian modul Forward Chaining sistem pakar."""

    def setUp(self):
        self.engine = ForwardChainingEngine()

    def test_rule_triggers_when_conditions_met(self):
        """Aturan R01_KOMPUTASI harus terpicu jika tipe dominan mencakup I dan (R atau C)."""
        facts = {
            'top_types': ['I', 'R', 'C'],
            'raw_scores': {'I': 30, 'R': 28, 'C': 25, 'A': 10, 'S': 10, 'E': 10},
            'has_academic_data': False
        }
        result = self.engine.infer(facts)
        fired_ids = [r['rule_id'] for r in result['fired_rules']]

        self.assertIn('R01_KOMPUTASI_REKAYASA', fired_ids)
        self.assertNotIn('R02_KESEHATAN_KLINIS', fired_ids)  # 'S' tidak ada di top_types

    def test_rule_not_triggered_when_conditions_fail(self):
        """Aturan medis R02 tidak boleh terpicu jika minat Sosial (S) tidak dominan."""
        facts = {
            'top_types': ['A', 'E', 'R'],
            'raw_scores': {'A': 30, 'E': 28, 'R': 25, 'I': 10, 'S': 10, 'C': 10},
            'has_academic_data': False
        }
        result = self.engine.infer(facts)
        fired_ids = [r['rule_id'] for r in result['fired_rules']]

        self.assertNotIn('R02_KESEHATAN_KLINIS', fired_ids)
        self.assertIn('R04_KREATIF_VISUAL', fired_ids)

    def test_academic_synergy_rule_requires_data(self):
        """Aturan sinergi rapor R08_SINERGI_MATEMATIKA hanya aktif jika nilai Matematika >= 85."""
        facts_without_acad = {
            'top_types': ['I', 'R', 'C'],
            'raw_scores': {'I': 30, 'R': 28, 'C': 25, 'A': 10, 'S': 10, 'E': 10},
            'has_academic_data': False,
            'academic_grades': {}
        }
        res_1 = self.engine.infer(facts_without_acad)
        self.assertNotIn('R08_SINERGI_MATEMATIKA', [r['rule_id'] for r in res_1['fired_rules']])

        facts_with_acad_high = {
            'top_types': ['I', 'R', 'C'],
            'raw_scores': {'I': 30, 'R': 28, 'C': 25, 'A': 10, 'S': 10, 'E': 10},
            'has_academic_data': True,
            'academic_grades': {'Matematika': 92.0}
        }
        res_2 = self.engine.infer(facts_with_acad_high)
        self.assertIn('R08_SINERGI_MATEMATIKA', [r['rule_id'] for r in res_2['fired_rules']])

    def test_rule_score_is_bounded_and_consistent(self):
        """Skor kecocokan aturan harus berada pada rentang [0.0, 100.0]."""
        facts = {
            'top_types': ['I', 'R', 'C'],
            'raw_scores': {'I': 35, 'R': 35, 'C': 35, 'A': 7, 'S': 7, 'E': 7},
            'has_academic_data': True,
            'academic_grades': {'Matematika': 95.0, 'IPAS': 90.0}
        }
        res = self.engine.infer(facts)
        score_ti = self.engine.calculate_rule_match_score('PRODI-TI', res['supported_prodi_rules'])
        score_unrelated = self.engine.calculate_rule_match_score('PRODI-DKV', res['supported_prodi_rules'])

        self.assertGreaterEqual(score_ti, 75.0)
        self.assertLessEqual(score_ti, 100.0)
        self.assertEqual(score_unrelated, 40.0)  # Nilai netral dasar


class TestSimpleAdditiveWeighting(unittest.TestCase):
    """Pengujian metode MCDA Simple Additive Weighting (SAW)."""

    def setUp(self):
        self.saw = SAWEngine()

    def test_total_base_weights_equals_one(self):
        """Total bobot dasar kriteria harus sama dengan 1.0 (100%)."""
        total = sum(c.weight for c in self.saw.criteria)
        self.assertAlmostEqual(total, 1.0, places=4)

    def test_dynamic_reweighting_when_criterion_missing(self):
        """Jika kriteria akademik tidak aktif, bobot kriteria aktif dinormalisasi hingga sum = 1.0."""
        # Kriteria C1 (0.50) dan C3 (0.15) aktif; C2 (0.35) non-aktif
        active_codes = ['C1_RIASEC', 'C3_ATURAN']
        eff_weights = self.saw.calculate_effective_weights(active_codes)

        self.assertEqual(len(eff_weights), 2)
        self.assertAlmostEqual(sum(eff_weights.values()), 1.0, places=5)
        # 0.50 / 0.65 = 0.76923
        self.assertAlmostEqual(eff_weights['C1_RIASEC'], 0.50 / 0.65, places=4)
        # 0.15 / 0.65 = 0.23077
        self.assertAlmostEqual(eff_weights['C3_ATURAN'], 0.15 / 0.65, places=4)

    def test_benefit_normalization_formula(self):
        """Normalisasi benefit r_ij = x_ij / max(x_j). Nilai tertinggi harus ternormalisasi = 1.0."""
        alternatives = [
            {'kode_prodi': 'A1', 'nama_prodi': 'Prodi 1'},
            {'kode_prodi': 'A2', 'nama_prodi': 'Prodi 2'},
        ]
        criteria_matrix = {
            'A1': {'C1_RIASEC': 80.0, 'C3_ATURAN': 50.0},
            'A2': {'C1_RIASEC': 100.0, 'C3_ATURAN': 100.0},
        }
        res = self.saw.rank_alternatives(
            alternatives=alternatives,
            criteria_matrix=criteria_matrix,
            active_criterion_codes=['C1_RIASEC', 'C3_ATURAN']
        )
        norm = res['normalized_matrix']

        # Max C1 = 100, Max C3 = 100
        self.assertAlmostEqual(norm['A2']['C1_RIASEC'], 1.0, places=4)
        self.assertAlmostEqual(norm['A1']['C1_RIASEC'], 0.8, places=4)
        self.assertAlmostEqual(norm['A2']['C3_ATURAN'], 1.0, places=4)
        self.assertAlmostEqual(norm['A1']['C3_ATURAN'], 0.5, places=4)

    def test_ranking_order_descending(self):
        """Alternatif harus terurut dari skor akhir SAW tertinggi ke terendah."""
        alternatives = [
            {'kode_prodi': 'LOW', 'nama_prodi': 'Pilihan Rendah'},
            {'kode_prodi': 'HIGH', 'nama_prodi': 'Pilihan Tinggi'},
        ]
        criteria_matrix = {
            'LOW': {'C1_RIASEC': 40.0, 'C3_ATURAN': 40.0},
            'HIGH': {'C1_RIASEC': 95.0, 'C3_ATURAN': 90.0},
        }
        res = self.saw.rank_alternatives(
            alternatives=alternatives,
            criteria_matrix=criteria_matrix,
            active_criterion_codes=['C1_RIASEC', 'C3_ATURAN']
        )
        ranked = res['ranked_results']

        self.assertEqual(ranked[0]['kode_prodi'], 'HIGH')
        self.assertEqual(ranked[1]['kode_prodi'], 'LOW')
        self.assertGreater(ranked[0]['final_score'], ranked[1]['final_score'])


class TestTextGenerationAndIntegrity(unittest.TestCase):
    """Pengujian integritas penjelasan otomatis dan pencegahan klaim tanpa data."""

    def test_no_academic_claim_when_grades_missing(self):
        """Jika data rapor tidak ada, teks tidak boleh mengklaim fondasi nilai akademik."""
        ranked_item = {
            'rank': 1,
            'kode_prodi': 'PRODI-TI',
            'nama_prodi': 'Teknik Informatika',
            'final_score': 85.0,
            'prodi_info': {'nama_prodi': 'Teknik Informatika', 'prospek_karier': 'Software Engineer'}
        }
        student_facts = {
            'top_types': ['I', 'R', 'C'],
            'holland_code': 'I-R-C',
            'has_riasec_data': True,
            'has_academic_data': False,  # Nilai tidak ada
            'academic_scores': {},
            'prodi_fired_rules': {}
        }
        explanation = generate_recommendation_explanation(ranked_item, student_facts)

        self.assertIn('Teknik Informatika', explanation)
        self.assertIn('85.0%', explanation)
        # Harus menjelaskan ketiadaan data nilai secara transparan
        self.assertIn('data nilai rapor tidak diikutsertakan', explanation)
        self.assertIn('tidak mengasumsikan maupun mengklaim keunggulan akademik', explanation)
        # Harus memuat disclaimer edukatif
        self.assertIn('bukan keputusan mutlak', explanation)

    def test_academic_claim_present_when_grades_available(self):
        """Jika nilai rapor tersedia, teks harus mencantumkan rincian mata pelajaran yang relevan."""
        ranked_item = {
            'rank': 1,
            'kode_prodi': 'PRODI-TI',
            'nama_prodi': 'Teknik Informatika',
            'final_score': 92.5,
            'prodi_info': {'nama_prodi': 'Teknik Informatika', 'prospek_karier': 'Software Engineer'}
        }
        student_facts = {
            'top_types': ['I', 'R', 'C'],
            'holland_code': 'I-R-C',
            'has_riasec_data': True,
            'has_academic_data': True,
            'academic_scores': {
                'PRODI-TI': {
                    'is_available': True,
                    'score': 91.0,
                    'highlight_text': 'Matematika (95.0), IPAS (88.0)'
                }
            },
            'prodi_fired_rules': {}
        }
        explanation = generate_recommendation_explanation(ranked_item, student_facts)

        self.assertIn('Matematika (95.0)', explanation)
        self.assertIn('91.0%', explanation)


class TestEndToEndPipeline(unittest.TestCase):
    """Pengujian menyeluruh pipa rekomendasi (Recommendation Engine)."""

    def setUp(self):
        self.engine = BYouthRecommendationEngine()
        self.catalog = get_default_catalog()

    def test_full_pipeline_with_stem_student(self):
        """Siswa minat STEM kuat dengan nilai rapor tinggi harus menempatkan prodi teknologi di Top-3."""
        # Berikan jawaban 5 untuk soal I dan R
        answers = {i: 5 for i in [2, 11, 18, 21, 26, 33, 39]}  # I
        answers.update({i: 5 for i in [1, 7, 14, 22, 30, 32, 37]})  # R
        answers.update({i: 4 for i in [6, 9, 15, 24, 25, 35, 38]})  # C

        grades = {
            'Matematika': 95.0,
            'IPAS': 90.0,
            'Bahasa Inggris': 88.0,
            'Bahasa Indonesia': 85.0
        }

        result = self.engine.recommend(answers, grades, self.catalog)

        self.assertTrue(result['success'])
        self.assertEqual(len(result['recommendations']), 3)

        top_codes = [r['kode_prodi'] for r in result['recommendations']]
        # Harapannya prodi rekayasa teknologi/STEM berada di puncak
        stem_codes = ['PRODI-TI', 'PRODI-STAT', 'PRODI-TM', 'PRODI-TS', 'PRODI-TE', 'PRODI-AGRO', 'PRODI-TK']
        self.assertTrue(
            any(code in top_codes for code in stem_codes)
        )

        # Verifikasi bahwa tidak ada NaN pada skor mana pun
        for rec in result['recommendations']:
            self.assertFalse(math.isnan(rec['skor']))
            self.assertFalse(math.isnan(rec['saw_preference_v']))
            self.assertGreater(rec['skor'], 0.0)

    def test_pipeline_with_empty_answers_safe(self):
        """Pipeline harus menangani input kosong tanpa melempar exception atau NaN."""
        result = self.engine.recommend(answers={}, academic_grades=None, catalog=self.catalog)

        self.assertTrue(result['success'])
        self.assertEqual(len(result['recommendations']), 3)
        for rec in result['recommendations']:
            self.assertFalse(math.isnan(rec['skor']))
            self.assertGreaterEqual(rec['skor'], 0.0)


if __name__ == '__main__':
    unittest.main()
