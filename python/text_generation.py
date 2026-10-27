#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MODUL RULE-BASED TEXT GENERATION (text_generation.py)
=============================================================================
Modul pembangkit narasi dan penjelasan otomatis (Natural Language Generation)
berbasis aturan (Rule-Based NLG).

Menghasilkan deskripsi transparan, kontekstual, dan mudah dipahami siswa SMA.

Prinsip Kejujuran Data (Data Integrity):
- HANYA menyebutkan dukungan nilai akademik jika data rapor benar-benar tersedia
  dan disertakan oleh siswa.
- Jika nilai akademik tidak ada, TIDAK BOLEH mengklaim kesiapan akademik.
- Selalu menyertakan klausul disclaimer edukatif bahwa rekomendasi adalah
  bahan pertimbangan, bukan takdir atau keputusan mutlak.
=============================================================================
"""

from typing import Dict, Any, List


DISCLAIMER_TEXT = (
    "Sebagai catatan, rekomendasi ini merupakan bahan pertimbangan dan panduan awal eksplorasi "
    "minat karier, bukan keputusan mutlak mengenai masa depan Anda. Selalu diskusikan rencana studi "
    "Anda bersama guru BK, orang tua, dan profesional pendidikan."
)


def format_riasec_explanation(top_types: List[str], holland_code: str) -> str:
    """
    Menyusun penjelasan singkat kombinasi tipe Holland dominan.
    """
    type_descriptions = {
        'R': 'praktikal-teknis (Realistic)',
        'I': 'daya analitis-investigatif (Investigative)',
        'A': 'ekspresi kreatif-estetik (Artistic)',
        'S': 'pelayanan sosial-empatik (Social)',
        'E': 'inisiatif kepemimpinan-wirausaha (Enterprising)',
        'C': 'keteraturan prosedural-data (Conventional)'
    }
    traits = [type_descriptions.get(t, t) for t in top_types[:2]]
    joined_traits = ' serta '.join(traits)
    return f"Karakteristik dominan Anda [{holland_code}] yang menonjolkan {joined_traits}"


def generate_recommendation_explanation(
    ranked_item: Dict[str, Any],
    student_facts: Dict[str, Any]
) -> str:
    """
    Menghasilkan narasi rekomendasi yang lengkap, objektif, dan transparan.

    Parameter:
    - ranked_item: Data program studi hasil perankingan SAW
    - student_facts: Data profil siswa (top_types, holland_code, academic_grades, has_academic_data, dll.)

    Return:
    - String narasi penjelasan berbahasa Indonesia ramah siswa SMA.
    """
    prodi_info = ranked_item.get('prodi_info', {})
    nama_prodi = prodi_info.get('nama_prodi') or ranked_item.get('nama_prodi', 'Program Studi')
    final_score = ranked_item.get('final_score', 0.0)
    rank = ranked_item.get('rank', 1)

    top_types = student_facts.get('top_types', [])
    holland_code = student_facts.get('holland_code', '-'.join(top_types))
    has_riasec_data = student_facts.get('has_riasec_data', True)
    has_academic_data = student_facts.get('has_academic_data', False)
    academic_score = student_facts.get('academic_scores', {}).get(ranked_item.get('kode_prodi'), {})

    fired_rules = student_facts.get('prodi_fired_rules', {}).get(ranked_item.get('kode_prodi'), [])

    # 1. Paragraf Pembuka: Skor Akhir & Keselarasan Minat Holland
    rank_phrase = f"peringkat ke-{rank}" if rank > 1 else "peringkat rekomendasi utama"

    if has_riasec_data and top_types:
        riasec_intro = format_riasec_explanation(top_types, holland_code)
        intro_p = (
            f"Program studi {nama_prodi} menempati {rank_phrase} dengan skor kecocokan terpadu sebesar {final_score}%. "
            f"{riasec_intro} memiliki keselarasan orientasi yang tinggi dengan iklim belajar program studi ini."
        )
    else:
        intro_p = (
            f"Program studi {nama_prodi} ditampilkan sebagai alternatif eksplorasi dengan skor kelayakan dasar {final_score}%. "
            f"Asesmen minat belum diisi secara lengkap sehingga analisis minat belum dapat dikalkulasikan secara spesifik."
        )

    # 2. Paragraf Akademik (Menjaga Integritas Data)
    if has_academic_data and academic_score and academic_score.get('is_available'):
        highlight_text = academic_score.get('highlight_text', '')
        score_val = academic_score.get('score', 0.0)
        academic_p = (
            f"Dari sisi kesiapan studi, capaian akademik Anda pada mata pelajaran relevan: {highlight_text} "
            f"menghasilkan skor keselarasan akademik sebesar {score_val}%. "
            f"Hal ini menunjukkan bahwa fondasi dasar mata pelajaran sekolah Anda siap menunjang kurikulum perkuliahan di bidang ini."
        )
    else:
        academic_p = (
            "Pada analisis ini, evaluasi dilakukan murni berdasarkan pemetaan minat dan kecenderungan aktivitas, "
            "karena data nilai rapor tidak diikutsertakan. Sistem tidak mengasumsikan maupun mengklaim keunggulan akademik tertentu."
        )

    # 3. Paragraf Aturan Pakar (Forward Chaining)
    if fired_rules:
        # Ambil alasan dari aturan pertama yang relevan
        primary_rule = fired_rules[0]
        rule_reason = primary_rule.get('reason', '')
        rule_p = f"Analisis sistem pakar mencatat: {rule_reason}"
    else:
        rule_p = (
            f"Program studi ini tetap memenuhi kriteria kelayakan eksplorasi karier sesuai preferensi kerja yang Anda sukai."
        )

    # 4. Paragraf Peluang Karier (Jika tersedia di metadata prodi)
    prospek = prodi_info.get('prospek_karier', '')
    if prospek:
        career_p = f"Prospek karier yang relevan bagi lulusan bidang ini antara lain: {prospek}."
    else:
        career_p = ""

    # Gabungkan seluruh paragraf dengan format rapi
    paragraphs = [intro_p, academic_p, rule_p]
    if career_p:
        paragraphs.append(career_p)
    paragraphs.append(DISCLAIMER_TEXT)

    return " ".join(paragraphs)
