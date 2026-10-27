#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
=============================================================================
B-YOUTH: MODUL FORWARD CHAINING (forward_chaining.py)
=============================================================================
Modul Sistem Pakar (Expert System) berbasis penalaran maju (Forward Chaining).
Mengevaluasi basis aturan (Rule Base) IF-THEN dari fakta yang diketahui
(profil minat dominan, skor RIASEC, dan kesiapan mata pelajaran) menuju
konklusi inferensi rumpun ilmu serta dukungan rekomendasi program studi.

Prinsip Penting:
1. Struktur aturan bersifat deklaratif dan mudah ditambah/diubah.
2. Hasil Forward Chaining tidak menambahkan bonus acak di luar SAW.
3. Tingkat dukungan aturan diubah menjadi kriteria terukur berskala 0-100
   yang konsisten untuk diproses dalam matriks keputusan SAW.
=============================================================================
"""

from typing import List, Dict, Any, Callable, Optional


class Rule:
    """
    Representasi sebuah aturan inferensi pakar IF-THEN.
    """
    def __init__(
        self,
        rule_id: str,
        name: str,
        condition: Callable[[Dict[str, Any]], bool],
        supported_prodis: List[str],
        cluster: str,
        reason: str,
        rule_type: str = 'domain_cluster',
        weight: float = 30.0
    ):
        """
        Inisialisasi aturan:
        - rule_id: Kode unik aturan (misal 'R01_KOMPUTASI')
        - name: Nama deskriptif aturan
        - condition: Fungsi lambda / callable yang menerima facts -> bool
        - supported_prodis: List kode prodi yang didukung aturan ini
        - cluster: Rumpun ilmu terkait
        - reason: Penjelasan inferensi pakar
        - rule_type: 'domain_cluster' (minat dasar) atau 'academic_synergy' (sinergi akademik)
        - weight: Nilai kontribusi ke kriteria aturan (skala poin)
        """
        self.rule_id = rule_id
        self.name = name
        self.condition = condition
        self.supported_prodis = supported_prodis
        self.cluster = cluster
        self.reason = reason
        self.rule_type = rule_type
        self.weight = weight

    def to_dict(self) -> Dict[str, Any]:
        return {
            'rule_id': self.rule_id,
            'name': self.name,
            'cluster': self.cluster,
            'supported_prodis': self.supported_prodis,
            'reason': self.reason,
            'rule_type': self.rule_type,
            'weight': self.weight
        }


class ForwardChainingEngine:
    """
    Mesin inferensi Forward Chaining untuk B-Youth.
    Mengevaluasi fakta awal terhadap basis aturan hingga menghasilkan
    himpunan aturan yang terpenuhi (fired rules) dan skor keselarasan aturan
    untuk masing-masing alternatif program studi.
    """

    def __init__(self, rules: Optional[List[Rule]] = None):
        """
        Inisialisasi mesin inferensi. Jika rules tidak diberikan,
        akan memuat basis aturan standar B-Youth.
        """
        self.rules: List[Rule] = rules if rules is not None else self._get_default_rules()

    def add_rule(self, rule: Rule) -> None:
        """Menambahkan aturan baru ke dalam basis aturan."""
        self.rules.append(rule)

    @staticmethod
    def _get_default_rules() -> List[Rule]:
        """
        Mendefinisikan basis aturan standar B-Youth.
        Aturan ini mencakup:
        1. Aturan klaster rumpun keilmuan berbasis kombinasi tipe dominan Holland.
        2. Aturan sinergi mata pelajaran pendukung (apabila data akademik tersedia).
        """
        return [
            # ── 1. Rumpun Teknologi, Sains & Komputasi ──
            Rule(
                rule_id='R01_KOMPUTASI_REKAYASA',
                name='Inferensi Rumpun Teknologi & Komputasi',
                condition=lambda f: 'I' in f.get('top_types', []) and (
                    'R' in f.get('top_types', []) or 'C' in f.get('top_types', [])
                ),
                supported_prodis=['PRODI-TI', 'PRODI-SI', 'PRODI-STAT'],
                cluster='Sains Komputasi & Rekayasa Perangkat Lunak',
                reason=(
                    "Kombinasi minat Investigatif (I) dengan daya teknikal (R) atau prosedural (C) "
                    "mengindikasikan kecakapan tinggi pada rekayasa logika, algoritma, dan arsitektur sistem."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 2. Rumpun Kedokteran & Kesehatan Hayati ──
            Rule(
                rule_id='R02_KESEHATAN_KLINIS',
                name='Inferensi Rumpun Medis & Hayati',
                condition=lambda f: 'I' in f.get('top_types', []) and 'S' in f.get('top_types', []),
                supported_prodis=['PRODI-KED', 'PRODI-PSI', 'PRODI-FARM'],
                cluster='Kedokteran & Ilmu Kesehatan Perilaku',
                reason=(
                    "Paduan rasa ingin tahu ilmiah (I) dan kepedulian menolong sesama (S) "
                    "merupakan fondasi ideal untuk profesi rumpun medis, farmasi, dan kesehatan mental."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 3. Rumpun Teknik Industri, Mesin & Konstruksi ──
            Rule(
                rule_id='R03_REKAYASA_FISIK',
                name='Inferensi Rumpun Rekayasa Fisik & Manufaktur',
                condition=lambda f: 'R' in f.get('top_types', []) and (
                    'I' in f.get('top_types', []) or 'C' in f.get('top_types', [])
                ),
                supported_prodis=['PRODI-TM', 'PRODI-TS', 'PRODI-TE'],
                cluster='Teknik Industri, Mesin & Rekayasa Infrastruktur',
                reason=(
                    "Ketertarikan kuat pada objek fisik nyata (R) disertai analisis penalaran teknis "
                    "memprediksi keberhasilan di bidang rekayasa mekanika, sipil, dan manufaktur."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 4. Rumpun Desain Kreatif & Multimedia Visual ──
            Rule(
                rule_id='R04_KREATIF_VISUAL',
                name='Inferensi Rumpun Desain & Seni Visual',
                condition=lambda f: 'A' in f.get('top_types', []) and (
                    'E' in f.get('top_types', []) or 'R' in f.get('top_types', [])
                ),
                supported_prodis=['PRODI-DKV', 'PRODI-ARS'],
                cluster='Industri Kreatif & Komunikasi Visual',
                reason=(
                    "Sensibilitas estetika artistik (A) yang dipadukan inisiatif komunikasi (E) "
                    "atau keterampilan material (R) sangat selaras dengan desain grafis, multimedia, dan arsitektur."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 5. Rumpun Bisnis, Manajemen & Komunikasi Korporat ──
            Rule(
                rule_id='R05_BISNIS_MANAJERIAL',
                name='Inferensi Rumpun Bisnis & Kepemimpinan',
                condition=lambda f: 'E' in f.get('top_types', []) and (
                    'C' in f.get('top_types', []) or 'S' in f.get('top_types', [])
                ),
                supported_prodis=['PRODI-MBD', 'PRODI-ILKOM'],
                cluster='Manajemen Bisnis Digital & Komunikasi Korporat',
                reason=(
                    "Inisiatif kepemimpinan dan persuasi (E) yang didukung tata kelola teratur (C) "
                    "atau relasi sosial (S) menjadi pilar utama dalam pengembangan bisnis dan komunikasi publik."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 6. Rumpun Tata Kelola Data & Akuntansi Finansial ──
            Rule(
                rule_id='R06_SISTEMATIS_KEUANGAN',
                name='Inferensi Rumpun Akuntansi & Tata Kelola Prosedural',
                condition=lambda f: 'C' in f.get('top_types', []) and (
                    'E' in f.get('top_types', []) or 'I' in f.get('top_types', [])
                ),
                supported_prodis=['PRODI-AKT', 'PRODI-SI'],
                cluster='Akuntansi, Perpajakan & Sistem Informasi Finansial',
                reason=(
                    "Ketelitian tinggi pada keteraturan data prosedural (C) membentuk kecakapan "
                    "unggul di bidang akuntansi, audit keuangan, dan sistem informasi manajemen."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 7. Rumpun Bimbingan Konseling & Pendidikan Sosial ──
            Rule(
                rule_id='R07_HUMANIORA_PENDIDIKAN',
                name='Inferensi Rumpun Pendidikan & Konseling Sosial',
                condition=lambda f: 'S' in f.get('top_types', []) and (
                    'A' in f.get('top_types', []) or 'E' in f.get('top_types', [])
                ),
                supported_prodis=['PRODI-BK', 'PRODI-ILKOM', 'PRODI-PSI'],
                cluster='Bimbingan Konseling, Layanan Publik & Pendidikan',
                reason=(
                    "Hasrat mendampingi orang lain (S) menjadi fondasi ideal dalam layanan "
                    "bimbingan konseling, pendidikan karakter, dan advokasi sosial kemasyarakatan."
                ),
                rule_type='domain_cluster',
                weight=35.0
            ),

            # ── 8. Sinergi Akademik: Logika Matematika Tinggi ──
            Rule(
                rule_id='R08_SINERGI_MATEMATIKA',
                name='Sinergi Akademik Logika & Penalaran Kuantitatif',
                condition=lambda f: f.get('has_academic_data', False) and (
                    f.get('academic_grades', {}).get('Matematika', 0) >= 85
                ),
                supported_prodis=['PRODI-TI', 'PRODI-STAT', 'PRODI-TM', 'PRODI-AKT'],
                cluster='Penguatan Kognitif Kuantitatif',
                reason=(
                    "Capaian nilai Matematika >= 85 membuktikan kesiapan kognitif tinggi "
                    "untuk kalkulus, pemodelan analitis, dan pemrograman algoritmik."
                ),
                rule_type='academic_synergy',
                weight=25.0
            ),

            # ── 9. Sinergi Akademik: Sains Alam / IPAS Tinggi ──
            Rule(
                rule_id='R09_SINERGI_SAINS_ALAM',
                name='Sinergi Akademik Sains Alam & Hayati',
                condition=lambda f: f.get('has_academic_data', False) and (
                    f.get('academic_grades', {}).get('IPAS', 0) >= 85 or
                    f.get('academic_grades', {}).get('Biologi', 0) >= 85 or
                    f.get('academic_grades', {}).get('Kimia', 0) >= 85
                ),
                supported_prodis=['PRODI-KED', 'PRODI-FARM', 'PRODI-TS'],
                cluster='Penguatan Sains Alam Eksperimental',
                reason=(
                    "Capaian nilai rumpun Sains Alam >= 85 memberikan dasar kokoh "
                    "untuk pemahaman mekanisme biologis, kimiawi, maupun sains rekayasa."
                ),
                rule_type='academic_synergy',
                weight=25.0
            ),

            # ── 10. Sinergi Akademik: Literasi & Bahasa Tinggi ──
            Rule(
                rule_id='R10_SINERGI_LITERASI_BAHASA',
                name='Sinergi Akademik Bahasa & Komunikasi Global',
                condition=lambda f: f.get('has_academic_data', False) and (
                    f.get('academic_grades', {}).get('Bahasa Inggris', 0) >= 85 or
                    f.get('academic_grades', {}).get('Bahasa Indonesia', 0) >= 85
                ),
                supported_prodis=['PRODI-ILKOM', 'PRODI-MBD', 'PRODI-DKV'],
                cluster='Penguatan Literasi & Komunikasi Global',
                reason=(
                    "Kecakapan literasi bahasa yang tinggi memperkuat daya saing "
                    "dalam penyusunan strategi komunikasi korporat dan industri kreatif."
                ),
                rule_type='academic_synergy',
                weight=25.0
            )
        ]

    def infer(self, facts: Dict[str, Any]) -> Dict[str, Any]:
        """
        Menjalankan penalaran Forward Chaining berdasarkan fakta yang diberikan.

        Parameter:
        - facts: Dictionary berisi:
            'top_types': list 3 tipe dominan (contoh: ['I', 'R', 'C'])
            'percent_scores': dict skor RIASEC {dimensi: persentase}
            'academic_grades': dict nilai mapel {mapel: skor}
            'has_academic_data': bool status ketersediaan nilai rapor

        Return:
        - Dict berisi:
            'fired_rules': daftar rule yang terpicu beserta detail alasannya
            'supported_prodi_rules': pemetaan kode_prodi -> list rule yang mendukungnya
        """
        has_riasec_interest = (
            any(v > 0 for v in facts.get('raw_scores', {}).values()) or
            any(v > 0 for v in facts.get('percent_scores', {}).values())
        )

        fired_rules: List[Dict[str, Any]] = []
        supported_prodi_rules: Dict[str, List[Dict[str, Any]]] = {}

        for rule in self.rules:
            try:
                # Jika aturan berbasis minat tetapi tidak ada skor minat positif, abaikan
                if rule.rule_type == 'domain_cluster' and not has_riasec_interest:
                    continue

                # Evaluasi kondisi aturan IF
                if rule.condition(facts):
                    rule_info = rule.to_dict()
                    fired_rules.append(rule_info)

                    # Petakan ke masing-masing prodi yang didukung
                    for prodi_code in rule.supported_prodis:
                        if prodi_code not in supported_prodi_rules:
                            supported_prodi_rules[prodi_code] = []
                        supported_prodi_rules[prodi_code].append(rule_info)
            except Exception:
                # Menjaga ketahanan eksekusi jika ada kondisi yang gagal dievaluasi
                continue

        return {
            'fired_rules': fired_rules,
            'supported_prodi_rules': supported_prodi_rules
        }

    def calculate_rule_match_score(
        self,
        prodi_code: str,
        supported_prodi_rules: Dict[str, List[Dict[str, Any]]]
    ) -> float:
        """
        Mengubah hasil Forward Chaining menjadi kriteria terukur berskala 0.0 - 100.0.

        Kebijakan Skoring Terukur (Konsisten & Bounded):
        - Skor dasar keselarasan netral tanpa aturan spesifik = 40.0
          (semua program studi yang ditawarkan memiliki kelayakan dasar yang adil).
        - Setiap aturan klaster minat (domain_cluster) yang terpenuhi menambah bobotnya (+35.0).
        - Setiap aturan sinergi akademik (academic_synergy) yang terpenuhi menambah bobotnya (+25.0).
        - Skor dibatasi (clamped) pada batas maksimal 100.0.

        Formula:
            Score = min(100.0, 40.0 + sum(rule_weight))

        Dengan formula ini:
        - Prodi tanpa aturan spesifik: 40.0
        - Prodi dengan 1 aturan klaster: 40.0 + 35.0 = 75.0
        - Prodi dengan klaster + sinergi: 40.0 + 35.0 + 25.0 = 100.0
        Seluruh nilai berada di rentang 0-100 dan siap menjadi kriteria benefit dalam SAW.
        """
        matched_rules = supported_prodi_rules.get(prodi_code, [])
        if not matched_rules:
            return 40.0

        additional_points = sum(float(r.get('weight', 20.0)) for r in matched_rules)
        total_score = 40.0 + additional_points

        return round(min(100.0, max(0.0, total_score)), 2)
