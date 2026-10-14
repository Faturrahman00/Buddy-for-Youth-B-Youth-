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
        <div class="stat-val">{{ $totalSesi ?? 1 }} Sesi</div>
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
        <div class="stat-val">42 Soal</div>
        <div class="stat-label">Holland RIASEC Test</div>
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
        <div class="stat-val">{{ $mostFrequentProdi ?? 'Teknik Informatika' }}</div>
        <div class="stat-label">Rekomendasi Utama Teratas</div>
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
        <div class="stat-val">{{ $totalSelesai ?? 1 }} Sesi</div>
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
          @if(isset($riwayats) && $riwayats->isNotEmpty())
            @foreach($riwayats as $idx => $item)
              @php
                $hasil = $item->hasilAsesmen;
                $topRec = $hasil ? $hasil->rekomendasi->first() : null;
                $altRecs = $hasil ? $hasil->rekomendasi->skip(1)->take(2) : collect();
                $holland = $hasil->holland_code ?? 'Holland RIASEC';
                $prodiName = $topRec && $topRec->programStudi ? $topRec->programStudi->nama_prodi : 'Teknik Informatika';
                $prodiSkor = $topRec ? $topRec->skor : 95;
              @endphp
              <tr data-searchable="{{ $item->tanggal->format('d M Y') }} {{ $holland }} {{ $prodiName }} {{ $item->status }}" data-status="{{ ucfirst($item->status) }}" data-periode="{{ $item->tanggal->format('Y') }}">
                <td>
                  <div style="font-weight:700; color:var(--c-text-heading);">{{ $item->tanggal->format('d F Y') }}</div>
                  <div style="font-size:12px; color:var(--c-text-muted);">Pukul {{ $item->tanggal->format('H:i') }} WIB • Sesi #ASY-{{ str_pad($item->id, 2, '0', STR_PAD_LEFT) }}</div>
                </td>
                <td>
                  <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    42 Soal
                  </span>
                </td>
                <td>
                  <span class="status-pill {{ $item->status === 'selesai' ? 'success' : 'pending' }}">
                    {{ $item->status === 'selesai' ? 'Selesai' : 'Diproses' }}
                  </span>
                  @if($hasil && $hasil->nilai_raport_digunakan)
                    <div style="font-size:11px; font-weight:700; color:#059669; margin-top:3px;">+ Nilai Rapor</div>
                  @endif
                </td>
                <td>
                  <div style="font-weight:700; color:var(--c-primary); font-size:14px;">
                    {{ $prodiName }} ({{ round($prodiSkor) }}%)
                  </div>
                  <div style="font-size:12px; color:var(--c-text-muted);">
                    Profil: <strong>{{ $holland }}</strong>
                    @if($altRecs->isNotEmpty())
                      • Alternatif: {{ $altRecs->map(fn($r) => $r->programStudi->nama_prodi ?? '')->join(', ') }}
                    @endif
                  </div>
                </td>
                <td style="text-align: right;">
                  <div class="action-btn-group" style="justify-content: flex-end;">
                    <a href="{{ route('siswa.asesmen') }}" class="btn-table-action primary" style="text-decoration:none;">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                      Lihat Hasil
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <!-- Sample Rows jika belum ada asesmen tersimpan -->
            <tr data-searchable="05 Okt 2026 Teknik Informatika Sains Data Selesai" data-status="Selesai" data-periode="2026">
              <td>
                <div style="font-weight:700; color:var(--c-text-heading);">05 Oktober 2026</div>
                <div style="font-size:12px; color:var(--c-text-muted);">Pukul 14:20 WIB • Sesi #ASY-01</div>
              </td>
              <td>
                <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                  42 Soal
                </span>
              </td>
              <td><span class="status-pill success">Selesai</span></td>
              <td>
                <div style="font-weight:700; color:var(--c-primary); font-size:14px;">Teknik Informatika (95%)</div>
                <div style="font-size:12px; color:var(--c-text-muted);">Profil Holland: I–S–R</div>
              </td>
              <td style="text-align: right;">
                <div class="action-btn-group" style="justify-content: flex-end;">
                  <a href="{{ route('siswa.asesmen') }}" class="btn-table-action primary" style="text-decoration:none;">Lihat Hasil</a>
                </div>
              </td>
            </tr>
          @endif
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
