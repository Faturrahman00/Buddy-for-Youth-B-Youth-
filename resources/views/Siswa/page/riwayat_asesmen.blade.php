{{-- 
  B-YOUTH: RIWAYAT ASESMEN PAGE (Siswa)
  File: resources/views/Siswa/page/riwayat_asesmen.blade.php
  Matches Wireframe 3: Tanggal, Durasi, Status, Rekomendasi, Aksi + Search, Filter, Pagination
--}}
@extends('Siswa.layouts.app', [
    'title' => 'Riwayat Asesmen — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Asesmen',
    'active' => 'riwayat-asesmen'
])

@section('content')
  <!-- Top Action Header -->
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <h2>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        Riwayat Asesmen
      </h2>
      <p>Arsip hasil tes psikometrik, preferensi karier, dan perkembangan rekomendasi prodi dari waktu ke waktu.</p>
    </div>

    <a href="{{ route('siswa.asesmen') }}" class="btn-primary-action">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
      </svg>
      <span>Mulai Asesmen Baru</span>
    </a>
  </div>

  <!-- Summary Stats Grid -->
  <div class="stats-summary-grid">
    <div class="stat-summary-card">
      <div class="stat-icon-wrapper blue">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">4 Sesi</div>
        <div class="stat-label">Total Asesmen Dijalani</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper amber">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">28 Menit</div>
        <div class="stat-label">Rata-Rata Durasi Pengerjaan</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper green">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="7"></circle>
          <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">Teknik Informatika</div>
        <div class="stat-label">Rekomendasi Utama Konsisten</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper purple">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">3 Sesi</div>
        <div class="stat-label">Hasil Asesmen Selesai</div>
      </div>
    </div>
  </div>

  <!-- Search & Filter Card (User Request: Search & Filter di setiap halaman) -->
  <div class="filter-card">
    <div class="filter-row">
      <!-- Search Input -->
      <div class="search-box">
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="searchRiwayatAsesmen" class="search-input" placeholder="Cari berdasarkan tanggal, hasil rekomendasi, atau catatan...">
      </div>

      <!-- Filters Group -->
      <div class="filter-controls-group">
        <!-- Filter Status -->
        <select id="filterStatusAsesmen" class="filter-select" data-filter-key="status">
          <option value="all">Semua Status</option>
          <option value="Selesai">Selesai Dianalisis</option>
          <option value="Menunggu">Menunggu Tinjauan</option>
          <option value="Draft">Draft / Berjalan</option>
        </select>

        <!-- Filter Periode -->
        <select id="filterPeriodeAsesmen" class="filter-select" data-filter-key="periode">
          <option value="all">Semua Periode</option>
          <option value="2026">Tahun 2026</option>
          <option value="2025">Tahun 2025</option>
        </select>

      </div>
    </div>
  </div>

  <!-- Table Container matching Wireframe 3 -->
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">
        <span>Tabel Riwayat Asesmen Siswa</span>
        <span class="data-count-badge" data-count-for="riwayatAsesmenTableBody">4 Sesi Terdata</span>
      </div>
      <div style="font-size:12.5px; color:var(--c-text-muted);">
        Tercatat dalam Portofolio Siswa B-Youth
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableRiwayatAsesmen">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Durasi</th>
            <th>Status</th>
            <th>Rekomendasi Utama</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="riwayatAsesmenTableBody">
          <!-- Row 1 -->
          <tr data-searchable="05 Okt 2026 Teknik Informatika Sains Data Selesai 28 Menit" data-status="Selesai" data-periode="2026">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">05 Oktober 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Pukul 14:20 WIB • Sesi #ASY-08</div>
            </td>
            <td>
              <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                28 Menit
              </span>
            </td>
            <td>
              <span class="status-pill success">Selesai</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-primary); font-size:14px;">
                Teknik Informatika (95%)
              </div>
              <div style="font-size:12px; color:var(--c-text-muted);">
                Alternatif: Sains Data (91%), Sistem Informasi (88%)
              </div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalDetailAsesmen">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  Rincian
                </button>
              </div>
            </td>
          </tr>

          <!-- Row 2 -->
          <tr data-searchable="18 Sep 2026 Sistem Informasi Bisnis Digital Selesai 32 Menit" data-status="Selesai" data-periode="2026">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">18 September 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Pukul 10:15 WIB • Sesi #ASY-07</div>
            </td>
            <td>
              <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                32 Menit
              </span>
            </td>
            <td>
              <span class="status-pill success">Selesai</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-primary); font-size:14px;">
                Sistem Informasi & Bisnis (90%)
              </div>
              <div style="font-size:12px; color:var(--c-text-muted);">
                Alternatif: Manajemen Informatika (86%), Teknik Elektro (82%)
              </div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalDetailAsesmen">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  Rincian
                </button>
              </div>
            </td>
          </tr>

          <!-- Row 3 -->
          <tr data-searchable="02 Agu 2026 Desain Komunikasi Visual DKV UI/UX Selesai 25 Menit" data-status="Selesai" data-periode="2026">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">02 Agustus 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Pukul 16:00 WIB • Sesi #ASY-06</div>
            </td>
            <td>
              <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                25 Menit
              </span>
            </td>
            <td>
              <span class="status-pill success">Selesai</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-primary); font-size:14px;">
                Desain Komunikasi Visual (86%)
              </div>
              <div style="font-size:12px; color:var(--c-text-muted);">
                Alternatif: Arsitektur (82%), Desain Produk (79%)
              </div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalDetailAsesmen">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  Rincian
                </button>
              </div>
            </td>
          </tr>

          <!-- Row 4 -->
          <tr data-searchable="15 Des 2025 Tes Minat Awal Kelas XI Menunggu Verifikasi 30 Menit" data-status="Menunggu" data-periode="2025">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">15 Desember 2025</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Pukul 09:00 WIB • Sesi #ASY-01</div>
            </td>
            <td>
              <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                30 Menit
              </span>
            </td>
            <td>
              <span class="status-pill pending">Menunggu Verifikasi</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading); font-size:14px;">
                Teknik Komputer & Jaringan (84%)
              </div>
              <div style="font-size:12px; color:var(--c-text-muted);">
                Tinjauan Portofolio Semester 3
              </div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalDetailAsesmen">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  Rincian
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Table Pagination Footer matching bottom wireframe icons -->
    <div class="table-pagination-footer">
      <div class="pagination-info">
        Menampilkan <strong>1 - 4</strong> dari <strong>4</strong> riwayat asesmen
      </div>

      <div class="pagination-nav">
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
        </button>
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button type="button" class="pagination-btn active">1</button>
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>
        </button>
      </div>
    </div>
  </div>
@endsection
