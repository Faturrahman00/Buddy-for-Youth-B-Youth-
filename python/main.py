#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MAIN ENTRY POINT & DEMONSTRATION RUNNER (main.py)
=============================================================================
Skrip demonstrasi eksekusi menyeluruh (End-to-End) sistem rekomendasi B-Youth.

Menjalankan tiga skenario pengujian:
1. Skenario 1: Siswa Lengkap (Minat RIASEC + Nilai Rapor Akademik).
2. Skenario 2: Siswa Tanpa Nilai Rapor (Uji Kebijakan Dynamic Re-Weighting SAW).
3. Skenario 3: Edge Case (Jawaban Asesmen Kosong / Vektor Nol, Uji Keamanan Numerik).

Sertakan visualisasi tabel konsol transparan:
- Profil RIASEC & Holland Code
- Inferensi Aturan Forward Chaining
- Matriks Keputusan & Normalisasi SAW
- Bobot Kriteria Efektif
- Peringkat Top-3 Rekomendasi & Deskripsi Otomatis
=============================================================================
"""

import json
import os
import sys
from typing import Dict, Any

try:
    if hasattr(sys.stdout, 'reconfigure'):
        sys.stdout.reconfigure(encoding='utf-8')
except Exception:
    pass

sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from recommendation_engine import BYouthRecommendationEngine
from data_catalog import get_default_catalog


def print_separator(title: str = "", char: str = "=", width: int = 80) -> None:
    if title:
        line_len = max(0, width - len(title) - 4)
        left = line_len // 2
        right = line_len - left
        print(f"\n{char * left} [ {title} ] {char * right}")
    else:
        print(char * width)


def display_recommendation_results(result: Dict[str, Any], scenario_name: str) -> None:
    """Menampilkan output terstruktur ke terminal dengan format yang rapi dan mudah dipahami."""
    print_separator(f"HASIL REKOMENDASI: {scenario_name}", char="=")

    print(f"Sistem            : {result.get('system_name')}")
    print(f"Kebijakan Akademik: {result.get('academic_policy')}")
    print(f"Catatan Legal     : {result.get('simulation_disclaimer')}")

    # 1. Profil Minat Siswa
    print_separator("1. PROFIL MINAT SISWA (HOLLAND RIASEC)", char="-")
    profile = result['student_profile']
    print(f"Holland Code Dominan : {profile['holland_code']}")
    print(f"Tipe Teratas (Top-3) : {', '.join(profile['top_types'])}")
    print("\nPersentase Skor Dimensi RIASEC:")
    for dim, pct in profile['percent_scores'].items():
        bar = "#" * int(pct // 5)
        print(f"  [{dim}] {dim:13s} : {pct:5.1f}% | {bar}")

    # 2. Forward Chaining Trace
    print_separator("2. INFERENSI FORWARD CHAINING (SISTEM PAKAR)", char="-")
    fc_trace = result['forward_chaining_trace']
    print(f"Total Aturan Terpicu : {fc_trace['total_fired_rules']}")
    for idx, rule in enumerate(fc_trace['fired_rules'], start=1):
        print(f"  {idx}. [{rule['rule_id']}] {rule['name']}")
        print(f"     Klaster   : {rule['cluster']}")
        print(f"     Mendukung : {', '.join(rule['supported_prodis'])}")
        print(f"     Alasan    : {rule['reason']}")

    # 3. Audit Perhitungan SAW
    print_separator("3. AUDIT MULTI-CRITERIA DECISION ANALYSIS (SAW)", char="-")
    saw_audit = result['saw_audit']
    print("Bobot Kriteria Efektif:")
    total_w = sum(saw_audit['effective_weights'].values())
    for code, w in saw_audit['effective_weights'].items():
        print(f"  - {code:12s} : {w * 100:5.2f}% (bobot: {w:.4f})")
    print(f"  Total Bobot  : {total_w * 100:.1f}% (Valid = 1.0)")

    print("\nMatriks Keputusan (X) & Matriks Normalisasi (R) untuk Seluruh Program Studi:")
    print(f"  {'Kode Prodi':12s} | {'C1 Raw':7s} {'C1 Norm':7s} | {'C2 Raw':7s} {'C2 Norm':7s} | {'C3 Raw':7s} {'C3 Norm':7s} | {'Skor SAW':8s}")
    print("  " + "-" * 75)

    for item in result['all_ranked_prodis']:
        code = item['kode_prodi']
        x_row = saw_audit['decision_matrix'][code]
        r_row = saw_audit['normalized_matrix'][code]

        c1_x = f"{x_row.get('C1_RIASEC', 0.0):.1f}"
        c1_r = f"{r_row.get('C1_RIASEC', 0.0):.3f}"

        c2_x = f"{x_row.get('C2_AKADEMIK', 0.0):.1f}" if 'C2_AKADEMIK' in x_row else "N/A"
        c2_r = f"{r_row.get('C2_AKADEMIK', 0.0):.3f}" if 'C2_AKADEMIK' in r_row else "N/A"

        c3_x = f"{x_row.get('C3_ATURAN', 0.0):.1f}"
        c3_r = f"{r_row.get('C3_ATURAN', 0.0):.3f}"

        print(f"  {code:12s} | {c1_x:7s} {c1_r:7s} | {c2_x:7s} {c2_r:7s} | {c3_x:7s} {c3_r:7s} | {item['final_score']:6.2f}%")

    # 4. Tiga Rekomendasi Teratas
    print_separator("4. TIGA PROGRAM STUDI TERATAS (TOP-3 RECOMMENDATIONS)", char="-")
    for rec in result['recommendations']:
        print(f"\n>>> PERINGKAT #{rec['rank']}: {rec['nama_prodi']} ({rec['kode_prodi']}) <<<")
        print(f"    Skor Akhir SAW       : {rec['skor']}% (Preferensi V: {rec['saw_preference_v']})")
        print(f"    Cosine Similarity    : {rec['skor_cosine_similarity']}%")
        print(f"    Nilai Rapor Terbobot : {rec['skor_akademik'] if rec['skor_akademik'] is not None else 'Tidak disertakan'}")
        print(f"    Skor Kepatuhan Aturan: {rec['skor_aturan_pakar']}%")
        print(f"    Aturan Terpenuhi     : {', '.join(rec['aturan_terpenuhi']) if rec['aturan_terpenuhi'] else 'Kelayakan umum'}")
        print("\n    Deskripsi Otomatis:")
        # Format narasi dengan indentasi rapi
        words = rec['alasan'].split()
        line = "      "
        for w in words:
            if len(line) + len(w) + 1 > 78:
                print(line)
                line = "      " + w
            else:
                line += (" " if line.strip() else "") + w
        if line.strip():
            print(line)

    print_separator(char="=")


def main():
    """Menjalankan tiga demonstrasi penggunaan sistem rekomendasi."""
    engine = BYouthRecommendationEngine()
    catalog = get_default_catalog()

    # ── SKENARIO 1: Siswa Minat STEM dengan Nilai Rapor Lengkap ──
    # Profil dominan Investigative (I) dan Realistic (R)
    # Butir soal:
    # R: 1, 7, 14, 22, 30, 32, 37 -> diberi nilai 5
    # I: 2, 11, 18, 21, 26, 33, 39 -> diberi nilai 5
    # C: 6, 9, 15, 24, 25, 35, 38 -> diberi nilai 4
    # Sisanya: nilai 2
    answers_scenario_1 = {}
    for i in range(1, 43):
        if i in [1, 7, 14, 22, 30, 32, 37]:
            answers_scenario_1[i] = 5  # R
        elif i in [2, 11, 18, 21, 26, 33, 39]:
            answers_scenario_1[i] = 5  # I
        elif i in [6, 9, 15, 24, 25, 35, 38]:
            answers_scenario_1[i] = 4  # C
        else:
            answers_scenario_1[i] = 2

    grades_scenario_1 = {
        'Matematika': 92.0,
        'IPAS': 88.0,
        'Bahasa Indonesia': 86.0,
        'Bahasa Inggris': 90.0
    }

    result_1 = engine.recommend(
        answers=answers_scenario_1,
        academic_grades=grades_scenario_1,
        catalog=catalog
    )
    display_recommendation_results(result_1, "Skenario 1 (Asesmen Lengkap + Rapor STEM)")

    # ── SKENARIO 2: Siswa Minat Seni-Kreatif Tanpa Nilai Rapor ──
    # Membuktikan Dynamic Re-weighting SAW tanpa penalti nilai nol
    # Profil dominan Artistic (A) dan Enterprising (E)
    answers_scenario_2 = {}
    for i in range(1, 43):
        if i in [3, 8, 17, 23, 27, 31, 41]:
            answers_scenario_2[i] = 5  # A
        elif i in [5, 10, 16, 19, 29, 36, 42]:
            answers_scenario_2[i] = 5  # E
        elif i in [4, 12, 13, 20, 28, 34, 40]:
            answers_scenario_2[i] = 3  # S
        else:
            answers_scenario_2[i] = 2

    result_2 = engine.recommend(
        answers=answers_scenario_2,
        academic_grades=None,  # Rapor tidak disertakan
        catalog=catalog
    )
    display_recommendation_results(result_2, "Skenario 2 (Minat Kreatif Tanpa Rapor - Re-weighting SAW)")

    # ── SKENARIO 3: Edge Case (Jawaban Asesmen Kosong / Vektor Nol) ──
    result_3 = engine.recommend(
        answers={},
        academic_grades={},
        catalog=catalog
    )
    display_recommendation_results(result_3, "Skenario 3 (Edge Case: Vektor Nol & Data Kosong)")


if __name__ == '__main__':
    main()
