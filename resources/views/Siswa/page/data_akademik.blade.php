{{-- 
  B-YOUTH: DATA AKADEMIK PAGE (Siswa)
  File: resources/views/Siswa/page/data_akademik.blade.php
  Matches Wireframe 1: Data Akademik, Nilai Rapor, + Tambah Nilai, Search, Filter, Pagination
--}}
@extends('Siswa.layouts.app', [
    'title' => 'Data Akademik — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Data Akademik',
    'active' => 'akademik'
])

@section('content')
  <!-- Top Action Header matching Wireframe 1 -->
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <h2>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
          <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
          <line x1="8" y1="6" x2="16" y2="6"></line>
          <line x1="8" y1="10" x2="16" y2="10"></line>
        </svg>
        Data Akademik
      </h2>
      <p>Kelola riwayat nilai rapor semester untuk mendukung akurasi rekomendasi program studi AI.</p>
    </div>

    <!-- + Tambah Nilai button from Wireframe 1 -->
    <button type="button" class="btn-primary-action btn-open-tambah-nilai" id="btnTambahNilai">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span>Tambah Nilai</span>
    </button>
  </div>

  <!-- Summary Mini Badges -->
  <div class="stats-summary-grid">
    <div class="stat-summary-card">
      <div class="stat-icon-wrapper blue">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">88.4</div>
        <div class="stat-label">Rata-Rata Nilai Rapor</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper green">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
          <polyline points="17 6 23 6 23 12"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">95 (A)</div>
        <div class="stat-label">Mapel Tertinggi (Informatika)</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper amber">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">12 Mapel</div>
        <div class="stat-label">Total Mapel Terdata</div>
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
        <div class="stat-val">5 / 5 Sem</div>
        <div class="stat-label">Kelengkapan Rapor</div>
      </div>
    </div>
  </div>

  <!-- Search & Filter Card (User Request: Pencarian & Filter di setiap halaman) -->
  <div class="filter-card">
    <div class="filter-row">
      <!-- Search Input -->
      <div class="search-box">
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="searchMapel" class="search-input" placeholder="Cari mata pelajaran atau catatan...">
      </div>

      <!-- Filters Group -->
      <div class="filter-controls-group">
        <!-- Filter Semester -->
        <select id="filterSemester" class="filter-select" data-filter-key="semester">
          <option value="all">Semua Semester</option>
          <option value="Semester 5" selected>Semester 5 (Kls XII Ganjil)</option>
          <option value="Semester 4">Semester 4 (Kls XI Genap)</option>
          <option value="Semester 3">Semester 3 (Kls XI Ganjil)</option>
          <option value="Semester 2">Semester 2 (Kls X Genap)</option>
          <option value="Semester 1">Semester 1 (Kls X Ganjil)</option>
        </select>

        <!-- Filter Kelompok Mapel -->
        <select id="filterKelompok" class="filter-select" data-filter-key="kelompok">
          <option value="all">Semua Kelompok</option>
          <option value="Peminatan Saintek">Peminatan Saintek</option>
          <option value="Wajib Umum">Wajib Umum</option>
          <option value="Muatan Lokal">Muatan Lokal</option>
        </select>

        <!-- Reset Button -->
        <button type="button" id="btnResetAkademik" class="btn-filter-reset" title="Reset filter">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="1 4 1 10 7 10"></polyline>
            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
          </svg>
          Reset
        </button>
      </div>
    </div>
  </div>

  <!-- Table Container (Nilai Rapor matching Wireframe 1) -->
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">
        <span>Nilai Rapor</span>
        <span class="data-count-badge" data-count-for="akademikTableBody">8 Data Ditampilkan</span>
      </div>
      <div style="font-size:12.5px; color:var(--c-text-muted);">
        Kurikulum Merdeka • SMAN 1 Batam
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableAkademik">
        <thead>
          <tr>
            <th style="width: 50px;">No</th>
            <th>Mata Pelajaran</th>
            <th>Kelompok</th>
            <th>Semester</th>
            <th style="text-align: center;">Pengetahuan</th>
            <th style="text-align: center;">Keterampilan</th>
            <th style="text-align: center;">Nilai Akhir</th>
            <th style="text-align: center;">Predikat</th>
            <th>Status</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="akademikTableBody">
          <!-- Row 1 -->
          <tr data-searchable="Informatika & Pemrograman Peminatan Saintek Semester 5 A" data-semester="Semester 5" data-kelompok="Peminatan Saintek">
            <td style="font-weight:700; color:var(--c-text-muted);">1</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Informatika & Pemrograman</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: INF-301 • KKM: 75</div>
            </td>
            <td><span class="status-pill primary">Peminatan Saintek</span></td>
            <td><span style="font-weight:600;">Semester 5</span></td>
            <td style="text-align: center; font-weight:700;">96</td>
            <td style="text-align: center; font-weight:700;">94</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">95.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai Informatika...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 2 -->
          <tr data-searchable="Matematika Tingkat Lanjut Peminatan Saintek Semester 5 A" data-semester="Semester 5" data-kelompok="Peminatan Saintek">
            <td style="font-weight:700; color:var(--c-text-muted);">2</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Matematika Tingkat Lanjut</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: MAT-302 • KKM: 75</div>
            </td>
            <td><span class="status-pill primary">Peminatan Saintek</span></td>
            <td><span style="font-weight:600;">Semester 5</span></td>
            <td style="text-align: center; font-weight:700;">92</td>
            <td style="text-align: center; font-weight:700;">90</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">91.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai Matematika...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 3 -->
          <tr data-searchable="Fisika Modern Peminatan Saintek Semester 5 A" data-semester="Semester 5" data-kelompok="Peminatan Saintek">
            <td style="font-weight:700; color:var(--c-text-muted);">3</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Fisika Modern</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: FIS-301 • KKM: 75</div>
            </td>
            <td><span class="status-pill primary">Peminatan Saintek</span></td>
            <td><span style="font-weight:600;">Semester 5</span></td>
            <td style="text-align: center; font-weight:700;">88</td>
            <td style="text-align: center; font-weight:700;">90</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">89.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai Fisika...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 4 -->
          <tr data-searchable="Bahasa Inggris Lanjutan Wajib Umum Semester 5 A" data-semester="Semester 5" data-kelompok="Wajib Umum">
            <td style="font-weight:700; color:var(--c-text-muted);">4</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Bahasa Inggris Lanjutan</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: ENG-301 • KKM: 75</div>
            </td>
            <td><span class="status-pill pending">Wajib Umum</span></td>
            <td><span style="font-weight:600;">Semester 5</span></td>
            <td style="text-align: center; font-weight:700;">89</td>
            <td style="text-align: center; font-weight:700;">91</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">90.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 5 -->
          <tr data-searchable="Kimia Organik & Polimer Peminatan Saintek Semester 5 B+" data-semester="Semester 5" data-kelompok="Peminatan Saintek">
            <td style="font-weight:700; color:var(--c-text-muted);">5</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Kimia Terapan</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: KIM-301 • KKM: 75</div>
            </td>
            <td><span class="status-pill primary">Peminatan Saintek</span></td>
            <td><span style="font-weight:600;">Semester 5</span></td>
            <td style="text-align: center; font-weight:700;">84</td>
            <td style="text-align: center; font-weight:700;">86</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">85.0</td>
            <td style="text-align: center;"><span class="grade-badge b">B+</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 6 -->
          <tr data-searchable="Bahasa Indonesia Wajib Umum Semester 5 A" data-semester="Semester 5" data-kelompok="Wajib Umum">
            <td style="font-weight:700; color:var(--c-text-muted);">6</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Bahasa Indonesia</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: IND-301 • KKM: 75</div>
            </td>
            <td><span class="status-pill pending">Wajib Umum</span></td>
            <td><span style="font-weight:600;">Semester 5</span></td>
            <td style="text-align: center; font-weight:700;">86</td>
            <td style="text-align: center; font-weight:700;">88</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">87.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 7 -->
          <tr data-searchable="Pendidikan Pancasila Wajib Umum Semester 4 A" data-semester="Semester 4" data-kelompok="Wajib Umum">
            <td style="font-weight:700; color:var(--c-text-muted);">7</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Pendidikan Pancasila</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: PPK-202 • KKM: 75</div>
            </td>
            <td><span class="status-pill pending">Wajib Umum</span></td>
            <td><span style="font-weight:600;">Semester 4</span></td>
            <td style="text-align: center; font-weight:700;">90</td>
            <td style="text-align: center; font-weight:700;">92</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">91.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai...');">Edit</button>
              </div>
            </td>
          </tr>

          <!-- Row 8 -->
          <tr data-searchable="Muatan Lokal Budaya Melayu Riau Muatan Lokal Semester 4 A" data-semester="Semester 4" data-kelompok="Muatan Lokal">
            <td style="font-weight:700; color:var(--c-text-muted);">8</td>
            <td>
              <div style="font-weight:700; color:var(--c-text-heading);">Muatan Lokal Budaya Melayu</div>
              <div style="font-size:12px; color:var(--c-text-muted);">Kode: BMR-202 • KKM: 75</div>
            </td>
            <td><span class="status-pill primary" style="background:#F4EBFF; color:#6941C6; border-color:#E9D7FE;">Muatan Lokal</span></td>
            <td><span style="font-weight:600;">Semester 4</span></td>
            <td style="text-align: center; font-weight:700;">88</td>
            <td style="text-align: center; font-weight:700;">90</td>
            <td style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">89.0</td>
            <td style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end;">
                <button type="button" class="btn-table-action outline" onclick="alert('Membuka edit nilai...');">Edit</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Table Pagination Footer (matching bottom wireframe pagination icons) -->
    <div class="table-pagination-footer">
      <div class="pagination-info">
        Menampilkan <strong>1 - 8</strong> dari <strong>12</strong> data rapor
      </div>

      <div class="pagination-nav">
        <!-- First Page -->
        <button type="button" class="pagination-btn" title="Halaman Pertama" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="11 17 6 12 11 7"></polyline>
            <polyline points="18 17 13 12 18 7"></polyline>
          </svg>
        </button>

        <!-- Previous Page -->
        <button type="button" class="pagination-btn" title="Sebelumnya" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <!-- Page Numbers -->
        <button type="button" class="pagination-btn active">1</button>
        <button type="button" class="pagination-btn" onclick="alert('Halaman 2');">2</button>

        <!-- Next Page -->
        <button type="button" class="pagination-btn" title="Berikutnya" onclick="alert('Halaman 2');">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>

        <!-- Last Page -->
        <button type="button" class="pagination-btn" title="Halaman Terakhir" onclick="alert('Halaman Terakhir');">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="13 17 18 12 13 7"></polyline>
            <polyline points="6 17 11 12 6 7"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </div>
@endsection
