#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH AI ENGINE: HOLLAND RIASEC ASSESSMENT & RECOMMENDATION
=============================================================================
Metode AI & Sistem Rekomendasi yang Digunakan:
1. Content-Based Filtering (Cosine Similarity Vector Matching):
   - Memetakan profil minat siswa (vektor 6 dimensi RIASEC) dan mencocokkannya
     dengan vektor representasi atribut program studi menggunakan Cosine Similarity.
2. Forward Chaining (Sistem Pakar / Expert Inference Engine):
   - Menggunakan basis aturan (Rule Base) IF-THEN untuk menurunkan inferensi
     kecocokan rumpun ilmu dan memberikan skor dorongan (Rule Boost).
3. Hybrid Synergy Integration:
   - Menggabungkan keselarasan minat RIASEC, dorongan aturan pakar, dan nilai rapor
     (opsional) secara proporsional.


tambahan: 
4. multicriteria decision analysis /AHP misalkan (MCDA) dan technique for order of preference by similarity to ideal solution (TOPSIS)
=============================================================================
"""

import json
import math
import os
import sys

# ── KONSTANTA & DEFINISI RIASEC ─────────────────────────────────────────────
RIASEC_KEYS = ('R', 'I', 'A', 'S', 'E', 'C')

CHAR_MAP = {'A': 1, 'B': 2, 'C': 3, 'D': 4, 'E': 5}

CANONICAL_ORDER = {'R': 1, 'I': 2, 'A': 3, 'S': 4, 'E': 5, 'C': 6}

RIASEC_MAP = {
    'R': [1, 7, 14, 22, 30, 32, 37],
    'I': [2, 11, 18, 21, 26, 33, 39],
    'A': [3, 8, 17, 23, 27, 31, 41],
    'S': [4, 12, 13, 20, 28, 34, 40],
    'E': [5, 10, 16, 19, 29, 36, 42],
    'C': [6, 9, 15, 24, 25, 35, 38],
}

RIASEC_INFO = {
    'R': {
        'code': 'R',
        'name': 'Realistic',
        'headline': 'Praktis, teknis, dan suka bekerja langsung',
        'badge_color': '#2E7D32',
        'badge_bg': '#E8F5E9',
        'description': (
            'Anda cenderung tertarik pada aktivitas yang melibatkan praktik, penggunaan alat, '
            'pengoperasian mesin, atau penyelesaian masalah secara langsung. Anda mungkin lebih '
            'menikmati belajar melalui praktik daripada hanya membaca teori. Aktivitas yang menghasilkan '
            'sesuatu yang konkret juga bisa terasa memuaskan bagi Anda.'
        ),
        'jurusan': [
            'Teknik Mesin', 'Teknik Elektro', 'Teknik Sipil', 'Teknik Otomotif',
            'Teknologi Pertanian', 'Teknik Lingkungan', 'Pendidikan Jasmani dan Olahraga'
        ],
        'karier': [
            'Teknisi atau teknisi laboratorium', 'Insinyur', 'Mekanik',
            'Operator peralatan teknis', 'Ahli konstruksi', 'Teknisi jaringan',
            'Praktisi bidang pertanian atau lingkungan'
        ],
        'lingkungan': 'kegiatan praktik, kerja lapangan, penggunaan teknologi atau peralatan, serta tugas dengan hasil yang konkret.'
    },
    'I': {
        'code': 'I',
        'name': 'Investigative',
        'headline': 'Analitis, ingin tahu, dan suka mencari jawaban',
        'badge_color': '#1565C0',
        'badge_bg': '#E3F2FD',
        'description': (
            'Anda cenderung tertarik memahami bagaimana sesuatu bekerja, mencari penyebab suatu masalah, '
            'menganalisis informasi, dan menemukan solusi berdasarkan bukti. Anda mungkin menikmati '
            'aktivitas yang menantang pemikiran, membutuhkan rasa ingin tahu, atau mengharuskan Anda '
            'mempelajari sesuatu secara mendalam.'
        ),
        'jurusan': [
            'Psikologi', 'Statistika', 'Matematika', 'Informatika atau Ilmu Komputer',
            'Kedokteran', 'Biologi', 'Kimia', 'Ilmu Data'
        ],
        'karier': [
            'Peneliti', 'Data analyst atau data scientist', 'Programmer atau software developer',
            'Analis laboratorium', 'Psikolog, setelah memenuhi pendidikan dan persyaratan profesi',
            'Dokter, setelah memenuhi pendidikan dan persyaratan profesi', 'Analis bisnis', 'Analis riset'
        ],
        'lingkungan': 'kegiatan analisis, pemecahan masalah, eksperimen, riset, dan pekerjaan yang memberi ruang untuk terus belajar.'
    },
    'A': {
        'code': 'A',
        'name': 'Artistic',
        'headline': 'Kreatif, ekspresif, dan suka mengeksplorasi ide',
        'badge_color': '#7B1FA2',
        'badge_bg': '#F3E5F5',
        'description': (
            'Anda cenderung tertarik pada aktivitas yang memberi ruang untuk berkreasi, mengekspresikan '
            'gagasan, dan mencoba pendekatan yang berbeda. Anda mungkin menikmati proses merancang sesuatu, '
            'menghasilkan karya, atau menyampaikan pesan melalui tulisan, gambar, musik, dan media lainnya.'
        ),
        'jurusan': [
            'Desain Komunikasi Visual', 'Desain Produk', 'Seni Rupa', 'Film dan Televisi',
            'Musik', 'Sastra atau Penulisan Kreatif', 'Desain Interior', 'Ilmu Komunikasi'
        ],
        'karier': [
            'Desainer grafis', 'Ilustrator', 'Penulis atau editor', 'Fotografer atau videografer',
            'Seniman atau musisi', 'Content creator', 'Desainer produk', 'Art director'
        ],
        'lingkungan': 'pekerjaan yang fleksibel, proses kreatif, eksplorasi ide, serta kesempatan untuk mengembangkan gaya dan perspektif pribadi.'
    },
    'S': {
        'code': 'S',
        'name': 'Social',
        'headline': 'Peduli, komunikatif, dan senang membantu orang lain',
        'badge_color': '#00897B',
        'badge_bg': '#E0F2F1',
        'description': (
            'Anda cenderung tertarik pada aktivitas yang melibatkan interaksi, pendampingan, pengajaran, '
            'atau dukungan terhadap orang lain. Anda mungkin merasa berarti ketika dapat membantu seseorang '
            'memahami sesuatu, mengatasi kesulitan, atau mengembangkan kemampuannya.'
        ),
        'jurusan': [
            'Psikologi', 'Pendidikan', 'Bimbingan dan Konseling', 'Kesejahteraan Sosial',
            'Keperawatan', 'Kesehatan Masyarakat', 'Sosiologi', 'Ilmu Komunikasi'
        ],
        'karier': [
            'Guru atau pendidik', 'Konselor, sesuai kualifikasi profesi',
            'Psikolog, setelah memenuhi pendidikan dan persyaratan profesi', 'Pekerja sosial',
            'Perawat', 'Fasilitator pelatihan', 'Pendamping komunitas',
            'Staf pengembangan sumber daya manusia'
        ],
        'lingkungan': 'kerja tim, interaksi dengan banyak orang, kegiatan pelayanan, pendidikan, dan program yang memberikan manfaat bagi orang lain.'
    },
    'E': {
        'code': 'E',
        'name': 'Enterprising',
        'headline': 'Persuasif, berinisiatif, dan suka menggerakkan orang',
        'badge_color': '#E65100',
        'badge_bg': '#FFF3E0',
        'description': (
            'Anda cenderung tertarik pada aktivitas yang melibatkan kepemimpinan, komunikasi persuasif, '
            'pengambilan keputusan, atau pengembangan peluang. Anda mungkin menikmati tantangan untuk mencapai '
            'target, membangun jaringan, mengelola proyek, atau mengajak orang lain bergerak menuju tujuan bersama.'
        ),
        'jurusan': [
            'Manajemen', 'Administrasi Bisnis', 'Bisnis Digital', 'Kewirausahaan',
            'Ilmu Komunikasi', 'Pemasaran', 'Hubungan Internasional', 'Administrasi Publik'
        ],
        'karier': [
            'Wirausahawan', 'Manajer proyek', 'Business development', 'Staf pemasaran atau sales',
            'Public relations', 'Konsultan bisnis', 'Pengelola program', 'Pemimpin tim atau organisasi'
        ],
        'lingkungan': 'pekerjaan yang dinamis, kesempatan mengambil inisiatif, membangun relasi, mengembangkan gagasan, dan mengoordinasikan orang atau sumber daya.'
    },
    'C': {
        'code': 'C',
        'name': 'Conventional',
        'headline': 'Terstruktur, teliti, dan menyukai keteraturan',
        'badge_color': '#455A64',
        'badge_bg': '#ECEFF1',
        'description': (
            'Anda cenderung tertarik pada aktivitas yang membutuhkan ketelitian, pengorganisasian informasi, '
            'pengelolaan data, dan penerapan prosedur yang jelas. Anda mungkin menikmati pekerjaan yang '
            'sistematis, memiliki alur kerja teratur, serta membutuhkan konsistensi dan perhatian terhadap detail.'
        ),
        'jurusan': [
            'Akuntansi', 'Manajemen', 'Administrasi Bisnis', 'Administrasi Perkantoran',
            'Sistem Informasi', 'Manajemen Informatika', 'Perpajakan', 'Statistika'
        ],
        'karier': [
            'Akuntan', 'Staf administrasi', 'Analis keuangan', 'Auditor',
            'Pengelola data', 'Staf operasional', 'Analis sistem', 'Staf pengelolaan dokumen'
        ],
        'lingkungan': 'pekerjaan dengan sistem yang jelas, prosedur terstruktur, pengelolaan informasi, serta tugas yang membutuhkan ketelitian dan konsistensi.'
    }
}


# ── 1. SKORING RIASEC & TIE-BREAKING ───────────────────────────────────────
def calculate_riasec_scores(answers: dict) -> dict:
    """
    Menghitung skor mentah 6 tipe RIASEC (skala 7-35) dan persentase ketercapaian.
    Menerapkan pemeringkatan dengan aturan Tie-Breaking jika skor sama.
    """
    raw_scores = {k: 0 for k in RIASEC_KEYS}

    for dimension, item_numbers in RIASEC_MAP.items():
        for num in item_numbers:
            val = answers.get(num, answers.get(str(num), 3))
            if isinstance(val, str) and val.upper() in CHAR_MAP:
                val = CHAR_MAP[val.upper()]
            try:
                val = max(1, min(5, int(val)))
            except (ValueError, TypeError):
                val = 3
            raw_scores[dimension] += val

    percent_scores = {k: round((score / 35.0) * 100.0, 1) for k, score in raw_scores.items()}

    # Pengurutan: skor tertinggi dahulu, jika seri dipecahkan urutan R-I-A-S-E-C
    sorted_types = sorted(
        raw_scores.keys(),
        key=lambda t: (-raw_scores[t], CANONICAL_ORDER.get(t, 9))
    )

    # Ambil 3 skor teratas dengan toleransi nilai seri (tie-break)
    top_types = []
    if len(sorted_types) >= 3:
        cutoff = raw_scores[sorted_types[2]]
        for t in sorted_types:
            if raw_scores[t] >= cutoff or len(top_types) < 3:
                top_types.append(t)
    else:
        top_types = sorted_types

    holland_code = '–'.join(top_types)

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
        'sorted_list': sorted_list,
        'top_types': top_types,
        'holland_code': holland_code
    }


# ── 2. SISTEM PAKAR FORWARD CHAINING ───────────────────────────────────────
class ForwardChainingEngine:
    """
    Inference Engine berbasis Forward Chaining.
    Bekerja dari fakta profil minat dan nilai rapor menuju konklusi rekomendasi prodi.
    """
    def __init__(self):
        self.rules = self._init_rules()

    @staticmethod
    def _init_rules() -> list:
        return [
            {
                'id': 'R01_KOMPUTASI',
                'name': 'Inferensi Rumpun Teknologi & Komputasi',
                'condition': lambda f: 'I' in f['top_types'] and ('R' in f['top_types'] or 'C' in f['top_types']),
                'action': lambda f: {
                    'cluster': 'Sains Komputasi & Rekayasa Perangkat Lunak',
                    'prodis': ['PRODI-TI', 'PRODI-SI', 'PRODI-STAT'],
                    'boost': 8.0,
                    'reason': f"Aturan R01 Terpicu: Kombinasi minat Investigatif (I) dan praktikal/sistematis ({'R' if 'R' in f['top_types'] else 'C'}) mengindikasikan kecocokan tinggi pada rekayasa logika dan arsitektur data."
                }
            },
            {
                'id': 'R02_KESEHATAN',
                'name': 'Inferensi Rumpun Medis & Hayati',
                'condition': lambda f: 'I' in f['top_types'] and 'S' in f['top_types'],
                'action': lambda _: {
                    'cluster': 'Kedokteran & Ilmu Kesehatan Perilaku',
                    'prodis': ['PRODI-KED', 'PRODI-PSI'],
                    'boost': 7.5,
                    'reason': "Aturan R02 Terpicu: Paduan daya analitis ilmiah (I) dan kepedulian menolong sesama (S) merupakan indikator ideal untuk rumpun klinis kedokteran dan psikologi."
                }
            },
            {
                'id': 'R03_REKAYASA_FISIK',
                'name': 'Inferensi Rumpun Teknik & Manufaktur',
                'condition': lambda f: 'R' in f['top_types'] and ('I' in f['top_types'] or 'C' in f['top_types']),
                'action': lambda _: {
                    'cluster': 'Teknik Industri, Mesin & Konstruksi',
                    'prodis': ['PRODI-TM', 'PRODI-TS'],
                    'boost': 7.0,
                    'reason': "Aturan R03 Terpicu: Minat kuat pada objek konkret dan mekanika (R) disertai penalaran teknis memprediksi keberhasilan di bidang rekayasa fisik."
                }
            },
            {
                'id': 'R04_KREATIF_VISUAL',
                'name': 'Inferensi Rumpun Desain & Seni Digital',
                'condition': lambda f: 'A' in f['top_types'] and ('E' in f['top_types'] or 'R' in f['top_types']),
                'action': lambda _: {
                    'cluster': 'Industri Kreatif & Komunikasi Visual',
                    'prodis': ['PRODI-DKV'],
                    'boost': 8.5,
                    'reason': "Aturan R04 Terpicu: Kepekaan ekspresi estetika (A) yang dipadukan orientasi inisiatif (E) atau pengerjaan karya nyata (R) sangat selaras dengan DKV & perancangan media."
                }
            },
            {
                'id': 'R05_BISNIS_MANAGERIAL',
                'name': 'Inferensi Rumpun Bisnis & Kewirausahaan',
                'condition': lambda f: 'E' in f['top_types'] and ('C' in f['top_types'] or 'S' in f['top_types']),
                'action': lambda _: {
                    'cluster': 'Manajemen Bisnis Digital & Komunikasi Korporat',
                    'prodis': ['PRODI-MBD', 'PRODI-ILKOM'],
                    'boost': 7.5,
                    'reason': "Aturan R05 Terpicu: Jiwa kepemimpinan dan persuasi (E) yang didukung keteraturan administratif (C) atau relasi interpersonal (S) unggul di bidang bisnis digital."
                }
            },
            {
                'id': 'R06_SISTEMATIS_KEUANGAN',
                'name': 'Inferensi Rumpun Akuntansi & Tata Kelola',
                'condition': lambda f: 'C' in f['top_types'] and ('E' in f['top_types'] or 'I' in f['top_types']),
                'action': lambda _: {
                    'cluster': 'Akuntansi, Perpajakan & Sistem Korporat',
                    'prodis': ['PRODI-AKT', 'PRODI-SI'],
                    'boost': 8.0,
                    'reason': "Aturan R06 Terpicu: Ketelitian tinggi terhadap detail data prosedural (C) membentuk kompetensi unggul di bidang akuntansi, audit, dan tata kelola sistem informasi."
                }
            },
            {
                'id': 'R07_HUMANIORA_PENDIDIKAN',
                'name': 'Inferensi Rumpun Pendidikan & Sosial Humaniora',
                'condition': lambda f: 'S' in f['top_types'] and ('A' in f['top_types'] or 'E' in f['top_types']),
                'action': lambda _: {
                    'cluster': 'Bimbingan Konseling & Layanan Publik',
                    'prodis': ['PRODI-BK', 'PRODI-ILKOM'],
                    'boost': 7.0,
                    'reason': "Aturan R07 Terpicu: Minat membimbing dan mengajar orang lain (S) menjadi fondasi utama dalam layanan konseling, pendidikan, dan interaksi publik."
                }
            },
            # ── Sinergi Nilai Rapor (Opsional) ──
            {
                'id': 'R_RAPOR_STEM',
                'name': 'Sinergi Rapor Logika Kuantitatif',
                'condition': lambda f: f.get('use_raport') and f.get('raport', {}).get('Matematika', 0) >= 85,
                'action': lambda f: {
                    'cluster': 'Kesiapan Kognitif Kuantitatif Tinggi',
                    'prodis': ['PRODI-TI', 'PRODI-STAT', 'PRODI-TM'],
                    'boost': 4.5,
                    'reason': f"Aturan Pakar Sinergi Rapor: Nilai Matematika ({f.get('raport', {}).get('Matematika')}) di atas 85 membuktikan kesiapan kognitif tinggi untuk kalkulus dan pemodelan analitik."
                }
            },
            {
                'id': 'R_RAPOR_BIOMEDIS',
                'name': 'Sinergi Rapor Sains Alam & Hayati',
                'condition': lambda f: f.get('use_raport') and f.get('raport', {}).get('IPAS', 0) >= 85,
                'action': lambda f: {
                    'cluster': 'Kesiapan Sains Alam & Hayati',
                    'prodis': ['PRODI-KED', 'PRODI-TS'],
                    'boost': 4.5,
                    'reason': f"Aturan Pakar Sinergi Rapor: Nilai IPAS ({f.get('raport', {}).get('IPAS')}) di atas 85 memberikan fondasi kuat untuk studi kedokteran dan sains eksperimental."
                }
            },
            {
                'id': 'R_RAPOR_KOMUNIKASI',
                'name': 'Sinergi Rapor Literasi Bahasa',
                'condition': lambda f: f.get('use_raport') and (
                    f.get('raport', {}).get('Bahasa Inggris', 0) >= 85 or
                    f.get('raport', {}).get('Bahasa Indonesia', 0) >= 85
                ),
                'action': lambda _: {
                    'cluster': 'Kesiapan Literasi & Komunikasi Global',
                    'prodis': ['PRODI-ILKOM', 'PRODI-MBD', 'PRODI-DKV'],
                    'boost': 4.0,
                    'reason': "Aturan Pakar Sinergi Rapor: Kemampuan literasi dan bahasa yang tinggi memperkuat daya saing komunikasi korporat dan industri kreatif internasional."
                }
            }
        ]

    def infer(self, facts: dict) -> dict:
        """
        Menjalankan proses inferensi maju (Forward Chaining).
        Mengembalikan daftar aturan yang terpicu dan dorongan skor prodi.
        """
        fired_rules = []
        prodi_boosts = {}

        for rule in self.rules:
            try:
                if rule['condition'](facts):
                    result = rule['action'](facts)
                    fired_rules.append({
                        'rule_id': rule['id'],
                        'rule_name': rule['name'],
                        'reason': result['reason'],
                        'cluster': result['cluster'],
                        'prodis': result['prodis']
                    })
                    for p in result['prodis']:
                        prodi_boosts[p] = prodi_boosts.get(p, 0.0) + result['boost']
            except Exception:
                continue

        return {
            'fired_rules': fired_rules,
            'prodi_boosts': prodi_boosts
        }


# ── 3. CONTENT-BASED FILTERING (COSINE SIMILARITY) ─────────────────────────
def calculate_cosine_similarity(vec_a: list, vec_b: list) -> float:
    """
    Menghitung Cosine Similarity antara dua vektor:
    cos(theta) = (A . B) / (||A|| * ||B||)
    """
    dot_product = sum(a * b for a, b in zip(vec_a, vec_b))
    norm_a = math.sqrt(sum(a * a for a in vec_a))
    norm_b = math.sqrt(sum(b * b for b in vec_b))
    if norm_a == 0 or norm_b == 0:
        return 0.0
    return dot_product / (norm_a * norm_b)


# ── 4. EVALUASI AKADEMIK & NARASI (HELPER) ──────────────────────────────────
def _calculate_academic_score(raport: dict, prodi_name: str) -> tuple:
    """
    Menghitung skor keselarasan akademik raport berdasarkan rumpun program studi.
    """
    mtk = float(raport.get('Matematika', 78))
    ipas = float(raport.get('IPAS', 78))
    indo = float(raport.get('Bahasa Indonesia', 78))
    ing = float(raport.get('Bahasa Inggris', 78))

    name_lower = prodi_name.lower()
    if any(k in name_lower for k in ['komputer', 'informatika', 'mesin', 'sipil', 'teknik']):
        score = (0.45 * mtk) + (0.35 * ipas) + (0.20 * ing)
        details = {'Matematika': mtk, 'IPAS': ipas}
    elif any(k in name_lower for k in ['kedokteran', 'kesehatan', 'biologi', 'farmasi']):
        score = (0.50 * ipas) + (0.30 * mtk) + (0.20 * ing)
        details = {'IPAS/Biologi': ipas, 'Matematika': mtk}
    elif any(k in name_lower for k in ['akuntansi', 'manajemen', 'bisnis', 'statistika']):
        score = (0.45 * mtk) + (0.30 * ing) + (0.25 * indo)
        details = {'Matematika': mtk, 'Bahasa Inggris': ing}
    elif any(k in name_lower for k in ['desain', 'seni', 'dkv']):
        score = (0.35 * indo) + (0.35 * ing) + (0.15 * mtk) + (0.15 * ipas)
        details = {'Bahasa Indonesia': indo, 'Bahasa Inggris': ing}
    else:
        score = (0.40 * indo) + (0.30 * ing) + (0.30 * ipas)
        details = {'Bahasa Indonesia': indo, 'IPAS/Sosial': ipas}

    return score, details


# ── 5. HYBRID RECOMMENDATION GENERATOR ────────────────────────────────────
def generate_recommendations(
    riasec_result: dict,
    catalog: list,
    raport_grades: dict = None,
    use_raport: bool = False
) -> dict:
    """
    Menggabungkan Content-Based Filtering (Cosine Similarity) dengan Forward Chaining.
    """
    top_types = riasec_result['top_types']
    percent_scores = riasec_result['percent_scores']
    holland_code = riasec_result['holland_code']

    facts = {
        'top_types': top_types,
        'raw_scores': riasec_result['raw_scores'],
        'percent_scores': percent_scores,
        'holland_code': holland_code,
        'use_raport': use_raport and bool(raport_grades),
        'raport': raport_grades or {}
    }

    # Jalankan inferensi pakar
    fc_engine = ForwardChainingEngine()
    fc_result = fc_engine.infer(facts)
    fired_rules = fc_result['fired_rules']
    prodi_boosts = fc_result['prodi_boosts']

    # Vektor siswa [R, I, A, S, E, C]
    student_vector = [percent_scores.get(k, 50.0) for k in RIASEC_KEYS]

    recommendations = []
    tag_weights = [100.0, 80.0, 60.0]

    for item in catalog:
        code = item.get('kode_prodi') or ''
        raw_tags = item.get('tipe_riasec') or ''
        tags = [t.strip().upper() for t in raw_tags.split(',') if t.strip()]

        # Vektor atribut ideal program studi
        prodi_vector = [20.0] * 6
        for idx, tag in enumerate(tags[:3]):
            if tag in RIASEC_KEYS:
                pos = RIASEC_KEYS.index(tag)
                prodi_vector[pos] = tag_weights[idx]

        # Content-Based Filtering: Cosine Similarity
        similarity = calculate_cosine_similarity(student_vector, prodi_vector)
        base_match = similarity * 100.0

        # Skor dorongan pakar (Rule Boost)
        rule_boost = prodi_boosts.get(code, 0.0)

        prodi_full_name = item.get('nama_prodi', '')

        if facts['use_raport']:
            academic_score, academic_details = _calculate_academic_score(facts['raport'], prodi_full_name)
            # Formula Hibrida: 65% Minat RIASEC + 35% Nilai Rapor + Bonus Aturan Pakar
            final_score = (0.65 * base_match) + (0.35 * academic_score) + (rule_boost * 0.5)
            highlight_str = ' dan '.join(f"{k} ({v})" for k, v in academic_details.items())
            alasan_ai = (
                f"Kombinasi minat dominan Anda [{holland_code}] berpadu selaras dengan pencapaian belajar pada mata pelajaran {highlight_str}. "
                f"Hal ini menunjukkan potensi besar, pemahaman logika yang kuat, serta motivasi tinggi untuk berhasil di program studi {item.get('nama_prodi')}."
            )
        else:
            academic_score = None
            final_score = base_match + (rule_boost * 0.5)
            alasan_ai = (
                f"Berdasarkan hasil asesmen minat [{holland_code}], program studi {item.get('nama_prodi')} sangat sesuai "
                f"dengan cara berpikir, preferensi kegiatan sehari-hari, serta lingkungan belajar yang paling Anda sukai."
            )

        # Normalisasi batas realistis 55% s/d 98.8%
        final_score = round(min(98.8, max(55.0, final_score)), 1)

        recommendations.append({
            'prodi_id': item.get('id_prodi') or item.get('id'),
            'kode_prodi': code,
            'nama_prodi': item.get('nama_prodi'),
            'deskripsi': item.get('deskripsi', ''),
            'prospek_karier': item.get('prospek_karier', ''),
            'skor': final_score,
            'skor_minat': round(base_match, 1),
            'skor_akademik': round(academic_score, 1) if academic_score is not None else None,
            'alasan': alasan_ai,
            'tipe_riasec': item.get('tipe_riasec'),
        })

    # Urutkan berdasarkan skor tertinggi dan pilih 3 prodi terbaik
    recommendations.sort(key=lambda x: x['skor'], reverse=True)

    return {
        'recommendations': recommendations[:3],
        'inference_trace': fired_rules,
    }


# ── 6. MAIN CLI ENTRY POINT ────────────────────────────────────────────────
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
        print(json.dumps({'error': f"Gagal membaca input JSON: {str(exc)}"}))
        sys.exit(1)

    answers = payload.get('jawaban', {})
    catalog = payload.get('katalog_prodi', [])
    raport_grades = payload.get('raport_grades', None)
    use_raport = bool(payload.get('use_raport', False))

    riasec_result = calculate_riasec_scores(answers)
    rec_result = generate_recommendations(riasec_result, catalog, raport_grades, use_raport)

    top_types_info = [
        RIASEC_INFO[t] for t in riasec_result['top_types'] if t in RIASEC_INFO
    ]

    output = {
        'success': True,
        'ai_engine': 'Analisis Rekomendasi Minat & Karier',
        'riasec_result': riasec_result,
        'top_types_info': top_types_info,
        'recommendations': rec_result['recommendations'],
        'inference_trace': rec_result['inference_trace'],
        'use_raport': use_raport,
        'raport_grades': raport_grades if use_raport else None
    }

    try:
        sys.stdout.reconfigure(encoding='utf-8')
    except Exception:
        pass

    print(json.dumps(output, ensure_ascii=True))


if __name__ == '__main__':
    main()
