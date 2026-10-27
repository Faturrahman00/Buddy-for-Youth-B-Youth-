#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: AI ENGINE BRIDGE FOR LARAVEL & CLI (ai_engine.py)
=============================================================================
Skrip antarmuka integrasi (Bridge/Facade) antara aplikasi web Laravel
(App\\Services\\AsesmenAIService) dan mesin rekomendasi B-Youth berbasis Python.

Menyediakan kompatibilitas penuh:
1. Menerima payload JSON dari argumen baris perintah atau STDIN.
2. Menjalankan modul rekomendasi terpadu:
   - Content-Based Filtering (Cosine Similarity)
   - Forward Chaining Expert Rule System
   - Simple Additive Weighting (SAW) MCDA Formal
   - Rule-Based Text Generation
3. Mengembalikan response JSON standar yang siap dikonsumsi Laravel maupun API.
=============================================================================
"""

import json
import os
import sys

# Nonaktifkan pembuatan file cache bytecode (.pyc / __pycache__)
sys.dont_write_bytecode = True

from typing import Dict, Any

# Pastikan path modul lokal terdaftar
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from recommendation_engine import BYouthRecommendationEngine
from data_catalog import get_default_catalog


def run_engine_payload(payload: Dict[str, Any]) -> Dict[str, Any]:
    """
    Mengeksekusi engine rekomendasi berdasarkan dictionary payload.
    """
    answers = payload.get('jawaban', {})
    catalog = payload.get('katalog_prodi', [])
    raport_grades = payload.get('raport_grades', None)
    use_raport = bool(payload.get('use_raport', False))

    # Jika katalog kosong dari DB, fallback ke katalog simulasi
    if not catalog:
        catalog = get_default_catalog()

    engine = BYouthRecommendationEngine()
    result = engine.recommend(
        answers=answers,
        academic_grades=raport_grades if use_raport else None,
        catalog=catalog
    )

    # Susun format response yang kompatibel dengan AsesmenAIService Laravel
    formatted_recs = []
    for rec in result['recommendations']:
        formatted_recs.append({
            'prodi_id': rec.get('prodi_id'),
            'id': rec.get('prodi_id'),
            'kode_prodi': rec.get('kode_prodi'),
            'nama_prodi': rec.get('nama_prodi'),
            'skor': rec.get('skor'),
            'saw_preference_v': rec.get('saw_preference_v'),
            'skor_minat': rec.get('skor_cosine_similarity'),
            'skor_cosine': rec.get('skor_cosine_similarity'),
            'skor_akademik': rec.get('skor_akademik'),
            'skor_aturan': rec.get('skor_aturan_pakar'),
            'alasan': rec.get('alasan'),
            'deskripsi': rec.get('deskripsi_prodi', ''),
            'prospek_karier': rec.get('prospek_karier', ''),
            'tipe_riasec': rec.get('tipe_riasec', ''),
            'criteria_breakdown': rec.get('criteria_breakdown', {})
        })

    profile = result['student_profile']

    return {
        'success': True,
        'ai_engine': 'Sistem Rekomendasi Terpadu B-Youth (SAW + Cosine Similarity + Forward Chaining)',
        'academic_policy': result['academic_policy'],
        'simulation_disclaimer': result['simulation_disclaimer'],
        'riasec_result': {
            'raw_scores': profile['raw_scores'],
            'percent_scores': profile['percent_scores'],
            'student_vector': profile['student_vector'],
            'sorted_types': profile['top_types'],
            'top_types': profile['top_types'],
            'holland_code': profile['holland_code']
        },
        'top_types_info': profile['top_types_info'],
        'recommendations': formatted_recs,
        'inference_trace': result['forward_chaining_trace']['fired_rules'],
        'saw_audit': result['saw_audit'],
        'use_raport': use_raport and bool(raport_grades),
        'raport_grades': raport_grades if use_raport else None
    }


def main():
    raw_input = ""
    try:
        if len(sys.argv) > 1:
            arg = sys.argv[1].strip()
            if os.path.isfile(arg):
                with open(arg, 'r', encoding='utf-8') as f:
                    raw_input = f.read()
            else:
                raw_input = arg
        elif not sys.stdin.isatty():
            raw_input = sys.stdin.read().strip()

        payload = json.loads(raw_input or "{}")
    except Exception as exc:
        print(json.dumps({'success': False, 'error': f"Gagal membaca input JSON: {str(exc)}"}))
        sys.exit(1)

    try:
        output = run_engine_payload(payload)
    except Exception as exc:
        print(json.dumps({'success': False, 'error': f"Kesalahan internal mesin rekomendasi: {str(exc)}"}))
        sys.exit(1)

    try:
        if hasattr(sys.stdout, 'reconfigure'):
            sys.stdout.reconfigure(encoding='utf-8')
    except Exception:
        pass

    print(json.dumps(output, ensure_ascii=True))


if __name__ == '__main__':
    main()
