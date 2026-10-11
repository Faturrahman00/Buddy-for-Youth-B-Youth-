@extends('Psikolog.layout.app', [
    'title' => 'Riwayat Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Konsultasi',
    'specTitle' => 'Spesifikasi: Tabel Riwayat Konseling (Tanggal, Siswa, Sekolah, Durasi, Topik, Status)',
    'active' => 'riwayat'
])

@section('content')

<!-- =========================================================================
     TOP TOOLBAR: SEARCH & FILTER
     ========================================================================= -->
<div class="filter-search-bar">
  <!-- Search Input -->
  <div class="search-input-wrap">
    <div class="search-icon">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </div>
    <input type="text" id="inputSearchRiwayat" placeholder="Cari nama siswa, sekolah, atau topik konseling...">
  </div>

  <!-- Filter Status -->
  <select class="select-filter-custom" id="selectFilterStatusRiwayat">
    <option value="all">Semua Status</option>
    <option value="selesai">Selesai</option>
    <option value="ditolak">Ditolak / Dibatalkan</option>
  </select>

  <!-- Filter Bulan -->
  <select class="select-filter-custom" id="selectFilterBulanRiwayat">
    <option value="all">Semua Periode</option>
    <option value="sep">September 2026</option>
    <option value="okt">Oktober 2026</option>
  </select>

  <!-- Button Unduh Laporan -->
  <button type="button" class="btn-secondary-link" onclick="window.print()" style="margin-left:auto;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
    <span>Ekspor Laporan (PDF)</span>
  </button>
</div>

<!-- =========================================================================
     TABLE RIWAYAT KONSELING
     Matching Wireframe 3 Table Specifications
     ========================================================================= -->
<div class="psikolog-card">
  <div class="table-responsive-box">
    <table class="table-riwayat">
      <thead>
        <tr>
          <th style="width: 120px;">Tanggal</th>
          <th style="width: 190px;">Nama Siswa</th>
          <th style="width: 170px;">Sekolah</th>
          <th style="width: 100px;">Durasi</th>
          <th>Topik &amp; Catatan Konseling</th>
          <th style="width: 110px;">Status</th>
          <th style="width: 140px; text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableRiwayatBody">

        <!-- Row 1: Dimas Wicaksono (Selesai) -->
        <tr data-searchable="dimas wicaksono sma negeri 1 jakarta komputasi rekayasa sistem teknik informatika" data-status="selesai">
          <td style="font-weight: 700; color: var(--c-text-heading); white-space: nowrap;">
            2026-09-22
          </td>
          <td>
            <div class="badge-student-cell">
              <div class="student-initial-pill">DW</div>
              <div>
                <strong style="color: var(--c-text-heading); font-size: 14px;">Dimas Wicaksono</strong>
                <div style="font-size: 11.5px; color: var(--c-text-muted);">Kelas XII MIPA 2</div>
              </div>
            </div>
          </td>
          <td style="color: var(--c-text-body); font-weight: 500;">
            SMA Negeri 1 Jakarta
          </td>
          <td>
            <span style="font-weight: 700; color: var(--c-primary); background: var(--c-primary-subtle); padding: 3px 8px; border-radius: 4px; font-size: 12px;">
              60 Menit
            </span>
          </td>
          <td>
            <div style="font-weight: 700; color: var(--c-text-heading); margin-bottom: 2px;">
              Eksplorasi Minat Komputasi vs Rekayasa Sistem
            </div>
            <p style="font-size: 12.5px; color: var(--c-text-muted); line-height: 1.4;">
              Siswa menunjukkan ketertarikan kuat di algoritma komputasi dan siap memilih Teknik Informatika pilihan 1 SNBP...
            </p>
          </td>
          <td>
            <span class="status-tag" style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5;">
              Selesai
            </span>
          </td>
          <td style="text-align: center;">
            <button type="button" class="btn-catatan-action" onclick="window.showCatatanModal({
              nama: 'Dimas Wicaksono (Kelas XII MIPA)',
              sekolah: 'SMA Negeri 1 Jakarta',
              tanggal: '22 September 2026 (14:00 - 15:00 WIB)',
              durasi: '60 Menit (Tuntas)',
              topik: 'Eksplorasi Minat Komputasi vs Rekayasa Sistem & Validasi Pilihan SNBP',
              catatan: 'Siswa memiliki daya nalar logika analitis yang sangat tinggi (skor asesmen potensi kuantitatif 91%). Sempat ragu antara Teknik Informatika dan Sistem Informasi. Setelah simulasi kurikulum dan profil karir software engineering, siswa yakin mengambil Teknik Informatika pilihan 1 dan Sistem Informasi pilihan 2.',
              rekomendasi: '1. S1 Teknik Informatika (Institut Teknologi Bandung / Universitas Indonesia)\n2. S1 Sistem Informasi (Universitas Indonesia)',
              rencana: 'Fokus mempertahankan rata-rata rapor semester 5 dan mulai menyusun portofolio proyek coding mini untuk seleksi talenta berprestasi.'
            })">
              Catatan Lengkap
            </button>
          </td>
        </tr>

        <!-- Row 2: Siti Sarah Rahmawati (Selesai) -->
        <tr data-searchable="siti sarah rahmawati sma negeri 3 bandung desain grafis dkv fsrd" data-status="selesai">
          <td style="font-weight: 700; color: var(--c-text-heading); white-space: nowrap;">
            2026-09-18
          </td>
          <td>
            <div class="badge-student-cell">
              <div class="student-initial-pill" style="background:#FFF9E6; color:#B48200;">SR</div>
              <div>
                <strong style="color: var(--c-text-heading); font-size: 14px;">Siti Sarah Rahmawati</strong>
                <div style="font-size: 11.5px; color: var(--c-text-muted);">Kelas XII IPA 1</div>
              </div>
            </div>
          </td>
          <td style="color: var(--c-text-body); font-weight: 500;">
            SMA Negeri 3 Bandung
          </td>
          <td>
            <span style="font-weight: 700; color: var(--c-primary); background: var(--c-primary-subtle); padding: 3px 8px; border-radius: 4px; font-size: 12px;">
              60 Menit
            </span>
          </td>
          <td>
            <div style="font-weight: 700; color: var(--c-text-heading); margin-bottom: 2px;">
              Konseling Portofolio Desain Grafis &amp; DKV
            </div>
            <p style="font-size: 12.5px; color: var(--c-text-muted); line-height: 1.4;">
              Membahas persiapan portofolio gambar dan potensi masuk Fakultas Seni Rupa dan Desain (FSRD)...
            </p>
          </td>
          <td>
            <span class="status-tag" style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5;">
              Selesai
            </span>
          </td>
          <td style="text-align: center;">
            <button type="button" class="btn-catatan-action" onclick="window.showCatatanModal({
              nama: 'Siti Sarah Rahmawati (Kelas XII IPA 1)',
              sekolah: 'SMA Negeri 3 Bandung',
              tanggal: '18 September 2026 (10:00 - 11:00 WIB)',
              durasi: '60 Menit (Tuntas)',
              topik: 'Konseling Portofolio Desain Grafis & DKV FSRD',
              catatan: 'Siswa memiliki bakat visual spasial kuat (kategori Artistik pada tes RIASEC B-Youth). Memerlukan bimbingan standardisasi karya portofolio gambar bentuk dan narasi konsep desain untuk SNBP FSRD ITB.',
              rekomendasi: '1. S1 Desain Komunikasi Visual (FSRD ITB)\n2. S1 Desain Grafis (ISI Yogyakarta)',
              rencana: 'Menuntaskan 3 karya mandiri portofolio dan melakukan kurasi ulang bersama guru BK sekolah.'
            })">
              Catatan Lengkap
            </button>
          </td>
        </tr>

        <!-- Row 3: Fajar Pratama (Ditolak / Dibatalkan) -->
        <tr data-searchable="fajar pratama smk negeri 2 depok pembatalan bentrok ujian sekolah" data-status="ditolak">
          <td style="font-weight: 700; color: var(--c-text-heading); white-space: nowrap;">
            2026-09-15
          </td>
          <td>
            <div class="badge-student-cell">
              <div class="student-initial-pill" style="background:#FEE2E2; color:#DC2626;">FP</div>
              <div>
                <strong style="color: var(--c-text-heading); font-size: 14px;">Fajar Pratama</strong>
                <div style="font-size: 11.5px; color: var(--c-text-muted);">Kelas XII Rekayasa Perangkat Lunak</div>
              </div>
            </div>
          </td>
          <td style="color: var(--c-text-body); font-weight: 500;">
            SMK Negeri 2 Depok
          </td>
          <td>
            <span style="color: var(--c-text-muted); font-size: 13px;">-</span>
          </td>
          <td>
            <div style="font-weight: 700; color: var(--c-text-heading); margin-bottom: 2px;">
              Pembatalan karena bentrok jadwal sekolah
            </div>
            <p style="font-size: 12.5px; color: var(--c-text-muted); line-height: 1.4;">
              Slot dibatalkan oleh siswa H-2 sesi konseling dikarenakan ada ujian praktik kejuruan mendadak...
            </p>
          </td>
          <td>
            <span class="status-tag" style="background:#FFF1F2; color:#E11D48; border:1px solid #FECDD3;">
              Ditolak
            </span>
          </td>
          <td style="text-align: center;">
            <button type="button" class="btn-catatan-action" onclick="window.showCatatanModal({
              nama: 'Fajar Pratama (Kelas XII RPL)',
              sekolah: 'SMK Negeri 2 Depok',
              tanggal: '15 September 2026',
              durasi: '- (Sesi Dibatalkan)',
              topik: 'Pembatalan Sesi karena Jadwal Ujian Praktik Sekolah',
              catatan: 'Permintaan konseling dibatalkan oleh siswa sebelum pelaksanaan karena jadwal ujian kompetensi keahlian di sekolah. Psikolog telah menyarankan siswa untuk mengajukan slot baru di minggu depan.',
              rekomendasi: 'Slot dibuka kembali untuk siswa lain.',
              rencana: 'Siswa diminta memesan ulang slot konsultasi pada jadwal lowong.'
            })">
              Catatan Lengkap
            </button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

  <!-- Table Pagination & Footer Summary (Matches Wireframe 3 bottom bar) -->
  <div class="pagination-footer-bar">
    <span id="riwayatCounterLabel">Menampilkan 3 dari 3 riwayat sesi konseling</span>

    <div class="pagination-nav-group">
      <button type="button" class="btn-page-step" title="Sebelumnya" disabled style="opacity: 0.5;">
        &lt;
      </button>
      <button type="button" class="btn-page-step active">
        1
      </button>
      <button type="button" class="btn-page-step" title="Berikutnya" disabled style="opacity: 0.5;">
        &gt;
      </button>
    </div>
  </div>
</div>

@endsection
