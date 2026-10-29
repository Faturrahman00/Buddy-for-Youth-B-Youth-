# DESIGN SYSTEM & UI SPECIFICATION (design.md)
**Project:** Buddy For Youth (B-Youth)  
**Platform:** Web Application (Responsive Desktop 1440px / Tablet / Mobile)  
**Target Audience:** Siswa SMA/SMK (Gen-Z), Konselor/Psikolog Pendidikan, dan Administrator  
**Domain:** Rekomendasi Program Studi Perguruan Tinggi (Holland RIASEC + AI Synergy) & Konseling Psikologi Pendidikan

---

## 1. Design Philosophy & Brand Identity

- **Aesthetic Vibe:** Clean, modern, trustworthy, friendly, and academic yet approachable (EdTech SaaS).
- **Core Principles:**
  - **Clarity over Complexity:** Antarmuka intuitif dengan visual hierarchy yang tegas agar siswa tidak terintimidasi saat mengisi asesmen.
  - **Empowering & Warm:** Warna biru samudra yang menenangkan dipadukan dengan aksen kuning hangat untuk memberikan rasa optimisme dan dukungan masa depan.
  - **Component-Driven:** Desain modular berbasis card, rounded corners halus, dan subtle shadow bertingkat.

---

## 2. Design Tokens & Visual Hierarchy

### 2.1 Color Palette

| Token Name | Hex Code | RGB / Variable | Usage Description |
| :--- | :--- | :--- | :--- |
| **Primary Navy** | `#30618C` | `var(--c-primary)` | Warna utama brand, sidebar aktif, primary buttons, header accents |
| **Primary Dark** | `#23486A` | `var(--c-primary-dark)` | Hover state tombol utama, active text header |
| **Primary Light** | `#4278A8` | `var(--c-primary-light)` | Secondary elements, gradient highlights |
| **Primary Subtle** | `#EAF2F8` | `var(--c-primary-subtle)` | Background pill badge aktif, container icon |
| **Accent Yellow/Gold** | `#F2B705` | `var(--c-accent)` | High-impact CTA, rating bintang, notifikasi highlight, tombol pendaftaran |
| **Accent Hover** | `#D9A304` | `var(--c-accent-hover)` | Hover state accent button |
| **Amber Light** | `#FAE08F` | `var(--c-amber-light)` | Soft badge alert, secondary accent |
| **Sage / Olive Soft** | `#D6D494` | `var(--c-sage)` | Badge kategori, visualizer Holland code |
| **Sky Soft** | `#B9D0E4` | `var(--c-sky-soft)` | Border hover, soft illustration tints |
| **Background (Canvas)** | `#F5F8FC` | `var(--c-bg)` | Background utama seluruh halaman dashboard |
| **Surface (Card)** | `#FFFFFF` | `var(--c-surface)` | Card surface, modal body, dropdown menu |
| **Border Default** | `#D5E2EE` | `var(--c-border)` | Border card, divider, stroke input form |
| **Border Light** | `#E7EEF5` | `var(--c-border-light)` | Subtle separator garis tipis |
| **Text Heading** | `#172C40` | `var(--c-text-heading)` | Judul utama (H1, H2, H3), penekanan angka data |
| **Text Body** | `#3E5469` | `var(--c-text-body)` | Paragraf reguler, deskripsi soal, label input |
| **Text Muted** | `#6B8299` | `var(--c-text-muted)` | Subtext, breadcrumb, label waktu, placeholder |

### 2.2 Typography Scale

- **Primary Font Family:** `'Plus Jakarta Sans', sans-serif`
- **Secondary / Body:** `'Inter', sans-serif`
- **Display / Heading Alternatif:** `'Outfit', sans-serif`

| Role | Font Size | Font Weight | Line Height | Usage |
| :--- | :--- | :--- | :--- | :--- |
| **Display / H1** | `32px (2rem)` | 800 (Bold / Extra Bold) | 1.25 | Welcome Banner, Hero Section Title |
| **Page Title / H2** | `24px (1.5rem)` | 700 (Bold) | 1.3 | Topbar Page Title, Section Major Heading |
| **Card Title / H3** | `18px (1.125rem)` | 600 - 700 (SemiBold) | 1.4 | Judul Card Komponen, Modal Header |
| **Subheading / H4** | `15px (0.9375rem)` | 600 (SemiBold) | 1.4 | Stat Label, Step Wizard, Card Header |
| **Body Regular** | `14px (0.875rem)` | 400 - 500 (Medium) | 1.5 | Deskripsi konten, opsi soal, tabel teks |
| **Caption / Badge** | `12px (0.75rem)` | 600 (SemiBold) | 1.4 | Status chip, meta tags, counter pill |
| **Micro / Footnote** | `11px (0.6875rem)` | 500 | 1.3 | Form helper text, timestamp |

### 2.3 Elevation & Shadows
Setiap shadow menggunakan rona dasar navy `rgba(48, 97, 140, ...)` untuk memberikan kesan organic dan terintegrasi dengan brand:
- **Shadow XS:** `0 1px 3px rgba(48, 97, 140, 0.05)` (Input borders, small badges)
- **Shadow SM:** `0 2px 8px rgba(48, 97, 140, 0.08)` (Card default surface)
- **Shadow MD:** `0 6px 18px rgba(48, 97, 140, 0.09)` (Card hover, active dropdown)
- **Shadow LG:** `0 12px 30px rgba(48, 97, 140, 0.12)` (Floating Modals, Dialogs)
- **Shadow Accent:** `0 4px 14px rgba(242, 183, 5, 0.35)` (Tombol CTA Emas)

### 2.4 Corner Radius
- **SM (8px):** Input field, button kecil, badge chips.
- **MD (12px):** Card konten utama, selector opsi asesmen, banner mini.
- **LG (16px):** Large widget, container modal, welcome banner.
- **XL (20px):** Hero container, floating action sheet.
- **Full (9999px):** Avatar, pill badge, circular step indicators.

---

## 3. Layout Architecture & App Shell

```
+-----------------------------------------------------------------------------------+
|  [Sidebar: 260px Fixed]  |  [Topbar Header: 74px Sticky]                          |
|  - Brand Logo (B-Youth)  |  - Breadcrumb / Page Title                             |
|  - User Identity Pill    |  - Notification Bell + Quick Actions + Profile Avatar  |
|  - Navigation Items:     +--------------------------------------------------------+
|    * Beranda             |  [Main Canvas Container: max-w 1440px / p-8]           |
|    * Asesmen & Rekom     |                                                        |
|    * Data Akademik       |  - Welcome Banner / Header Notification                |
|    * Konsultasi          |  - 4-Column Stat Summary Cards                         |
|    * Riwayat             |  - 2-Column Split: Dynamic Main (8 col) / Side (4 col) |
|    * Pengaturan Akun     |                                                        |
|  - Logout Button         |                                                        |
+-----------------------------------------------------------------------------------+
```

- **Sidebar Width:** Fixed `260px` di desktop, collapsible drawer di mobile screen (`< 992px`).
- **Topbar Height:** Fixed `74px`, backdrop-filter blur `8px`, border bottom tipis `1px solid var(--c-border-light)`.
- **Main Canvas:** Padding `24px` sampai `32px`, max-width `1440px`, latar belakang `var(--c-bg)`.

---

## 4. Master Component Library

### 4.1 Welcome Banner
- **Container:** Background gradient halus dari `#30618C` ke `#23486A` atau clean white card dengan accent wave.
- **Content:**
  - Greeting text: *"Selamat datang kembali,"* (Medium 14px, soft tint)
  - Student Name: Bold 24px-28px.
  - Metadata badge: Tag Sekolah (SMAN 1 Jakarta) & Tingkat Kelas (XII MIPA).
  - Quick action: Tombol pintas ke tes RIASEC berikutnya.

### 4.2 Summary Stat Cards (4-Column Bento Row)
- **Layout:** Grid 4 kolom setara (`repeat(4, 1fr)`).
- **Elemen Tiap Card:**
  1. Icon container (44x44px, background `var(--c-primary-subtle)`, rounded-xl).
  2. Sub-label teks abu-abu (`var(--c-text-muted)` 13px).
  3. Metric Value angka besar (`24px - 28px` bold `var(--c-text-heading)`).
  4. Context Pill: misal *"Holland Code: RIA"*, *"Terverifikasi"*, atau status prodi impian.

### 4.3 Holland RIASEC Assessment Module
- **Step Flow:**
  - Slide 0: Petunjuk Pengerjaan + Switch Opsional Nilai Rapor.
  - Slide 1 - 42: Pengerjaan Soal 1 per 1 (Single Question Focus).
  - Skala Likert 5 Pilihan (Pill Card A - E):
    - **A:** Sangat Tidak Suka / Tidak Sesuai
    - **B:** Tidak Suka
    - **C:** Ragu-ragu / Netral
    - **D:** Suka
    - **E:** Sangat Suka / Sangat Sesuai
  - Progress Bar: Sticky di bagian atas kartu soal dengan counter `Pertanyaan X dari 42`.
  - Slide Hasil:
    - Holland Code Badge (3 huruf teratas, misal **I-R-A**).
    - Radar / Spider Chart visualisasi 6 dimensi: *Realistic, Investigative, Artistic, Social, Enterprising, Conventional*.
    - Kartu Rekomendasi Program Studi dengan persentase kecocokan (e.g., *Teknik Informatika - 96% Match*).

### 4.4 Jadwal Konsultasi & Konseling Card
- **Header:** Nama psikolog/konselor, foto avatar 48px, spesialisasi.
- **Data Status Chip:**
  - `Menunggu`: Background Amber Soft (`#FFF9E6`), text `#B45309`.
  - `Disetujui`: Background Emerald Soft (`#ECFDF5`), text `#047857`.
  - `Selesai`: Background Sky Soft (`#EEF5FB`), text `#1D4ED8`.
- **Action Buttons:** Link Google Meet / Zoom meeting, tombol reschedule, tombol unduh ringkasan hasil konseling.

### 4.5 Buttons & Form Controls
- **Primary Button:** Background `var(--c-primary)` (`#30618C`), text `#FFFFFF`, rounded-lg (`10px`), font-weight 600, padding `10px 20px`, smooth transform on hover `translateY(-1px)`.
- **Accent Button:** Background `var(--c-accent)` (`#F2B705`), text `#172C40` (high contrast), shadow accent.
- **Secondary / Ghost Button:** Transparent background, border `1.5px solid var(--c-border)`, text `var(--c-text-body)`.
- **Input Fields:** Height 44px, border `1.5px solid var(--c-border)`, background `#FFFFFF`, focus ring `0 0 0 3px rgba(48, 97, 140, 0.15)`, rounded `10px`.

---

## 5. Screen Specifications

### Screen 1: Dashboard Siswa (`/siswa/dashboard`)
1. **Header:** Sapaan siswa & statistik pengerjaan tes.
2. **Top Metrics Row:**
   - Asesmen Diselesaikan (Status / Skor).
   - Tipe Dominan RIASEC.
   - Rekomendasi Utama Prodi.
   - Sesi Konsultasi Mendatang.
3. **Left Column (8 cols):**
   - Kartu "Langkah Selanjutnya": Roadmap persiapan studi mandiri.
   - Grafik Radar RIASEC / Riwayat Skor.
4. **Right Column (4 cols):**
   - Agenda Konsultasi Terjadwal.
   - Bantuan Cepat / Hubungi Guru BK & Psikolog.

### Screen 2: Halaman Asesmen Interaktif (`/siswa/asesmen`)
1. **Focus Mode Layout:** Navbar diringkas, sidebar diminimalkan untuk fokus penuh pengerjaan.
2. **Central Test Card:**
   - Header: Kategori dimensi (misal: *Investigative / Meneliti*).
   - Pertanyaan besar dan jelas (20px medium).
   - Pilihan vertikal atau horizontal 5 pill radio buttons dengan hover effect interaktif.
   - Bottom Bar: Tombol "Sebelumnya", nomor urut soal, tombol "Selanjutnya".

### Screen 3: Hasil Rekomendasi AI (`/siswa/rekomendasi`)
1. **Holland Score Breakdown:** Skor tiap dimensi dari skala 0-100.
2. **AI Synergy Recommendation List:**
   - Card Program Studi #1 (Top Match): Akreditasi, prospek karier, kesesuaian nilai rapor.
   - Card Program Studi #2 & #3 (Alternative Match).
3. **Direct Action:** Tombol "Konsultasikan Hasil dengan Psikolog".

---

## 6. Prompt Injection untuk Google Stitch AI

Gunakan format prompt di bawah ini saat bekerja di **Google Stitch AI** dengan merujuk pada `design.md`:

```text
Follow the exact design specifications from design.md:
- Brand: B-Youth (Buddy For Youth) Education & Career Portal
- Palette: Primary #30618C, Accent #F2B705, Background #F5F8FC, Surface #FFFFFF, Text #172C40
- Typography: Plus Jakarta Sans / Inter, standard 8pt grid
- Viewport: Desktop 1440px wide responsive layout
- Target Screen: [Sebutkan nama halaman, misal: Dashboard Siswa / Asesmen RIASEC]
- Structure: 260px fixed sidebar, 74px header, clean rounded cards (12px-16px radius), subtle navy-tinted shadows.
- Components needed: [Daftar komponen yang ingin direkonstruksi sesuai section 4]
Render high-fidelity, polished, clean modern EdTech UI.
```

