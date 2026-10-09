{{-- 
  B-YOUTH: RIWAYAT KONSULTASI PAGE (Siswa)
  File: resources/views/Siswa/page/riwayat_konsultasi.blade.php
  Matches Wireframe 5: Tanggal, Nama Psikolog, Durasi, Topik, Aksi + Search, Filter, Pagination
--}}
@extends('Siswa.layouts.app', [
    'title' => 'Riwayat Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Konsultasi',
    'active' => 'riwayat-konsultasi'
])

@section('content')
  <!-- Top Action Header -->
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <h2>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
          <path d="M9 16l2 2 4-4"></path>
        </svg>
        Riwayat Konsultasi
      </h2>
      <p>Rekapitulasi catatan bimbingan konseling, rekomendasi psikolog, dan rencana tindak lanjut akademis.</p>
    </div>

    <a href="{{ route('siswa.konsultasi') }}" class="btn-primary-action">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span>Jadwalkan Sesi Baru</span>
    </a>
  </div>

  <!-- Summary Stats Grid -->
  <div class="stats-summary-grid">
    <div class="stat-summary-card">
      <div class="stat-icon-wrapper blue">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">3 Sesi Selesai</div>
        <div class="stat-label">Total Konseling Terlaksana</div>
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
        <div class="stat-val">165 Menit</div>
        <div class="stat-label">Total Waktu Bimbingan</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper green">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">2 Psikolog</div>
        <div class="stat-label">Pembimbing Profesional</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper purple">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 11l3 3L22 4"></path>
          <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">3 Catatan</div>
        <div class="stat-label">Rekomendasi Tindak Lanjut</div>
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
        <input type="text" id="searchRiwayatKonsultasi" class="search-input" placeholder="Cari nama psikolog, topik diskusi, atau catatan...">
      </div>

      <!-- Filters Group -->
      <div class="filter-controls-group">
        <!-- Filter Status -->
        <select id="filterStatusKonsul" class="filter-select" data-filter-key="status">
          <option value="all">Semua Status</option>
          <option value="Selesai">Selesai</option>
          <option value="Terjadwal">Terjadwal (Mendatang)</option>
        </select>

        <!-- Filter Psikolog -->
        <select id="filterPsikologKonsul" class="filter-select" data-filter-key="psikolog">
          <option value="all">Semua Psikolog</option>
          <option value="Maya">Dr. Maya Sartika, M.Psi.</option>
          <option value="Bambang">Bambang Wicaksono, M.A.</option>
        </select>

      </div>
    </div>
  </div>

  <!-- Table Container matching Wireframe 5 -->
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">
        <span>Daftar Sesi Konsultasi Psikologi</span>
        <span class="data-count-badge" data-count-for="riwayatKonsulTableBody">4 Sesi Terdata</span>
      </div>
      <div style="font-size:12.5px; color:var(--c-text-muted);">
        Kerahasiaan data bimbingan konseling terenkripsi aman
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableRiwayatKonsultasi">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama Psikolog</th>
            <th>Durasi</th>
            <th>Topik</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="riwayatKonsulTableBody">
          <!-- Row 1 (Mendatang / Terjadwal) -->
          <tr data-searchable="10 Okt 2026 Maya Sartika Validasi Pilihan Program Studi Teknik Terjadwal 60 Menit" data-status="Terjadwal" data-psikolog="Maya">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">10 Oktober 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">14:00 - 15:00 WIB (Mendatang)</div>
            </td>
            <td>
              <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:34px; height:34px; border-radius:50%; background:#FAE08F; color:#172C40; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center;">MS</div>
                <div>
                  <div style="font-weight:700; color:var(--c-text-heading);">Dr. Maya Sartika, M.Psi., Psikolog</div>
                  <div style="font-size:11.5px; color:var(--c-text-muted);">SIPA: 19820412-201001-2-004</div>
                </div>
              </div>
            </td>
            <td>
              <span style="font-weight:600;">60 Menit</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-primary);">Validasi Program Studi Teknik Informatika & Kesiapan PTN</div>
              <div><span class="status-pill success" style="font-size:11px; padding:2px 8px;">Disetujui • Via Zoom</span></div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalZoom">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                  Masuk Zoom
                </button>
              </div>
            </td>
          </tr>

          <!-- Row 2 (Selesai) -->
          <tr data-searchable="02 Okt 2026 Maya Sartika Pemilihan Program Studi Analisis Potensi Bakat Saintek Selesai 60 Menit" data-status="Selesai" data-psikolog="Maya">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">02 Oktober 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">15:30 - 16:30 WIB</div>
            </td>
            <td>
              <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:34px; height:34px; border-radius:50%; background:#FAE08F; color:#172C40; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center;">MS</div>
                <div>
                  <div style="font-weight:700; color:var(--c-text-heading);">Dr. Maya Sartika, M.Psi., Psikolog</div>
                  <div style="font-size:11.5px; color:var(--c-text-muted);">Psikolog Pendidikan</div>
                </div>
              </div>
            </td>
            <td>
              <span style="font-weight:600;">60 Menit</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Pemilihan Program Studi & Analisis Potensi Bakat Saintek</div>
              <div><span class="status-pill success" style="font-size:11px; padding:2px 8px;">Selesai Dilaksanakan</span></div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalCatatanKonseling">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                  Catatan
                </button>
              </div>
            </td>
          </tr>

          <!-- Row 3 (Selesai) -->
          <tr data-searchable="20 Sep 2026 Bambang Wicaksono Manajemen Stress & Kecemasan Tryout SNBT Selesai 45 Menit" data-status="Selesai" data-psikolog="Bambang">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">20 September 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">10:00 - 10:45 WIB</div>
            </td>
            <td>
              <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:34px; height:34px; border-radius:50%; background:#B9D0E4; color:#172C40; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center;">BW</div>
                <div>
                  <div style="font-weight:700; color:var(--c-text-heading);">Bambang Wicaksono, M.A.</div>
                  <div style="font-size:11.5px; color:var(--c-text-muted);">Konselor Karier Remaja</div>
                </div>
              </div>
            </td>
            <td>
              <span style="font-weight:600;">45 Menit</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Strategi Mengatasi Kecemasan & Manajemen Jadwal Belajar</div>
              <div><span class="status-pill success" style="font-size:11px; padding:2px 8px;">Selesai Dilaksanakan</span></div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalCatatanKonseling">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                  Catatan
                </button>
              </div>
            </td>
          </tr>

          <!-- Row 4 (Selesai) -->
          <tr data-searchable="05 Sep 2026 Maya Sartika Penyelarasan Harapan Orang Tua & Pilihan Karier Selesai 60 Menit" data-status="Selesai" data-psikolog="Maya">
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">05 September 2026</div>
              <div style="font-size:12px; color:var(--c-text-muted);">13:30 - 14:30 WIB</div>
            </td>
            <td>
              <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:34px; height:34px; border-radius:50%; background:#FAE08F; color:#172C40; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center;">MS</div>
                <div>
                  <div style="font-weight:700; color:var(--c-text-heading);">Dr. Maya Sartika, M.Psi., Psikolog</div>
                  <div style="font-size:11.5px; color:var(--c-text-muted);">Psikolog Pendidikan</div>
                </div>
              </div>
            </td>
            <td>
              <span style="font-weight:600;">60 Menit</span>
            </td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Penyelarasan Aspirasi Orang Tua & Eksplorasi Minat Siswa</div>
              <div><span class="status-pill success" style="font-size:11px; padding:2px 8px;">Selesai Dilaksanakan</span></div>
            </td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action primary" data-open-modal="modalCatatanKonseling">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                  Catatan
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
        Menampilkan <strong>1 - 4</strong> dari <strong>4</strong> riwayat konsultasi
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
