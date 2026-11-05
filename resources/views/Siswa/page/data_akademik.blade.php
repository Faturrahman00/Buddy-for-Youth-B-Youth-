@extends('Siswa.layouts.app', [
    'title' => 'Data Akademik — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Data Akademik',
    'active' => 'akademik'
])

@push('styles')
<style>
  /* ── Ringkasan Esensial 2 Kolom ── */
  .stats-summary-grid-compact {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
    margin-bottom: 24px;
  }
  @media (max-width: 640px) {
    .stats-summary-grid-compact {
      grid-template-columns: 1fr;
    }
  }

  /* ── Kartu Visualisasi Grafik 4 Mapel ── */
  .chart-academic-wrapper {
    background: #FFFFFF;
    border-radius: 16px;
    border: 1.5px solid #D0DCE8;
    padding: 24px 28px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(48, 97, 140, 0.06);
  }

  .chart-academic-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 22px;
    flex-wrap: wrap;
    gap: 12px;
  }

  .chart-academic-title h3 {
    font-size: 17px;
    font-weight: 800;
    color: #1A2535;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
  }

  .chart-academic-title p {
    font-size: 13px;
    color: #60748A;
    margin: 3px 0 0;
  }

  .chart-curriculum-badge {
    font-size: 12px;
    font-weight: 700;
    color: #30618C;
    background: rgba(48, 97, 140, 0.09);
    padding: 6px 14px;
    border-radius: 20px;
    border: 1px solid rgba(48, 97, 140, 0.15);
  }

  /* Grid 4 Baris Horizontal Bar Modern */
  .academic-metric-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
  }
  @media (max-width: 768px) {
    .academic-metric-grid {
      grid-template-columns: 1fr;
    }
  }

  .metric-bar-card {
    background: #F8FAFD;
    border: 1.5px solid #E2E8F0;
    border-radius: 14px;
    padding: 16px 20px;
    transition: all 0.25s ease;
  }
  .metric-bar-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(48, 97, 140, 0.08);
    border-color: #B9D0E4;
  }

  .metric-bar-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 12px;
  }

  .metric-name-wrap h4 {
    font-size: 15px;
    font-weight: 800;
    color: #1A2535;
    margin: 0;
  }

  .metric-name-wrap span {
    font-size: 12px;
    color: #60748A;
    display: block;
    margin-top: 2px;
  }

  .metric-score-wrap {
    text-align: right;
  }

  .metric-score-val {
    font-size: 22px;
    font-weight: 900;
    line-height: 1;
    color: #1A2535;
  }

  .metric-grade-tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 6px;
    margin-top: 4px;
  }

  .metric-track {
    width: 100%;
    height: 12px;
    background: #E2E8F0;
    border-radius: 100px;
    overflow: hidden;
    position: relative;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.06);
  }

  .metric-fill {
    height: 100%;
    border-radius: 100px;
    transition: width 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  /* Warna Tiap Mapel */
  .fill-ipas { background: linear-gradient(90deg, #10B981, #059669); }
  .score-ipas { color: #059669; }
  .badge-ipas { background: #ECFDF3; color: #027A48; border: 1px solid #A6F4C5; }

  .fill-mtk { background: linear-gradient(90deg, #30618C, #1D4363); }
  .score-mtk { color: #30618C; }
  .badge-mtk { background: #EFF8FF; color: #175CD3; border: 1px solid #B2DDFF; }

  .fill-indo { background: linear-gradient(90deg, #F2B705, #D49A00); }
  .score-indo { color: #D49A00; }
  .badge-indo { background: #FEF0C7; color: #B54708; border: 1px solid #FEDF89; }

  .fill-ing { background: linear-gradient(90deg, #4A88C0, #296091); }
  .score-ing { color: #296091; }
  .badge-ing { background: #F0F9FF; color: #026AA2; border: 1px solid #B9E6FE; }

  .metric-bar-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 11px;
    color: #94A3B8;
    margin-top: 8px;
    font-weight: 600;
  }

  /* ── Optimalisasi Tabel Daftar Nilai Rapor Siswa ── */
  .academic-table-card {
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(48, 97, 140, 0.05);
    overflow: hidden;
    margin-bottom: 24px;
  }

  /* Toolbar Tabel Rapi 1 Baris Sejajar */
  .academic-table-card .table-integrated-toolbar {
    padding: 18px 22px;
    background: #FFFFFF;
    border-bottom: 1.5px solid #EDF2F7;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: nowrap;
  }

  .academic-table-card .table-toolbar-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
    flex: 1 1 auto;
    min-width: 0;
  }

  .academic-table-card .table-toolbar-header-row {
    display: flex;
    align-items: center;
    gap: 10px;
    width: auto;
  }

  .academic-table-card .data-card-title {
    font-size: 16px;
    font-weight: 800;
    color: var(--c-text-heading, #1A2535);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    margin: 0;
  }

  .academic-table-card .data-count-badge {
    font-size: 11.5px;
    padding: 3px 9px;
    background: #EFF6FF;
    color: var(--c-primary, #30618C);
    border: 1px solid #BFDBFE;
    border-radius: 999px;
    font-weight: 700;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    height: 24px;
    flex-shrink: 0;
  }

  .academic-table-card .table-toolbar-desc {
    font-size: 12px;
    color: #64748B;
    line-height: 1.35;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
  }

  .academic-table-card .table-toolbar-actions {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 8px;
    flex: 0 0 auto;
    justify-content: flex-end;
  }

  .academic-table-card .table-search-box {
    width: 185px;
    position: relative;
    flex: 0 0 auto;
  }

  .academic-table-card .table-search-input {
    width: 100%;
    height: 38px;
    padding: 0 12px 0 34px;
    font-size: 13px;
    background: #F8FAFC;
    border: 1.5px solid #CBD5E1;
    border-radius: 9px;
    outline: none;
    color: #1E293B;
    box-sizing: border-box;
    transition: all 0.2s ease;
  }

  .academic-table-card .table-search-input:focus {
    background: #FFFFFF;
    border-color: #30618C;
    box-shadow: 0 0 0 3px rgba(48, 97, 140, 0.12);
  }

  .academic-table-card .table-filter-group {
    display: flex;
    align-items: center;
    flex: 0 0 auto;
  }

  .academic-table-card .table-filter-select {
    height: 38px;
    padding: 0 28px 0 10px;
    font-size: 12.5px;
    font-weight: 600;
    color: #334155;
    background: #F8FAFC url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B8299' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") no-repeat right 9px center;
    border: 1.5px solid #CBD5E1;
    border-radius: 9px;
    outline: none;
    cursor: pointer;
    box-sizing: border-box;
    transition: all 0.2s ease;
  }

  .academic-table-card .table-filter-select:focus {
    background-color: #FFFFFF;
    border-color: #30618C;
    box-shadow: 0 0 0 3px rgba(48, 97, 140, 0.12);
  }

  /* ── Tabel Presisi: 100% Fit Tanpa Terpotong ── */
  #tableAkademik {
    width: 100% !important;
    border-collapse: collapse !important;
    table-layout: fixed !important;
  }

  #tableAkademik th {
    background: #F8FAFC;
    color: #475569;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 10.5px;
    letter-spacing: 0.05em;
    padding: 12px 8px;
    border-bottom: 1.5px solid #E2E8F0;
    white-space: nowrap;
    vertical-align: middle;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  #tableAkademik td {
    padding: 11px 8px;
    border-bottom: 1px solid #EDF2F7;
    vertical-align: middle;
    color: var(--c-text-body, #334155);
    font-size: 13px;
    overflow: hidden;
  }

  #tableAkademik tbody tr {
    transition: background-color 0.18s ease;
  }

  #tableAkademik tbody tr:hover {
    background-color: #F8FAFD;
  }

  /* Kolom-kolom Proporsional Persentase Pas 100% */
  #tableAkademik .col-no {
    width: 6%;
    min-width: 34px;
    max-width: 44px;
    text-align: center;
    font-weight: 700;
    color: var(--c-text-muted, #64748B);
    padding-left: 6px;
    padding-right: 2px;
  }

  #tableAkademik .col-mapel {
    width: 34%;
    text-align: left;
    padding-left: 8px;
  }

  #tableAkademik .col-sem {
    width: 15%;
    text-align: left;
  }

  #tableAkademik .col-num {
    width: 11%;
    text-align: center;
  }

  #tableAkademik .col-akhir {
    width: 11%;
    text-align: center;
  }

  #tableAkademik .col-aksi {
    width: 12%;
    text-align: right;
    padding-right: 12px;
  }

  /* Tipografi Mata Pelajaran */
  .row-mapel-name {
    font-size: 13.5px;
    font-weight: 800;
    color: var(--c-text-heading, #1A2535);
    line-height: 1.3;
    white-space: nowrap !important;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .row-mapel-sub {
    font-size: 11px;
    color: var(--c-text-muted, #64748B);
    line-height: 1.3;
    margin-top: 1px;
    white-space: nowrap !important;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Pill Semester */
  .row-semester-pill {
    display: inline-flex;
    align-items: center;
    font-size: 11px;
    font-weight: 600;
    color: #334155;
    background: #F1F5F9;
    border: 1px solid #CBD5E1;
    padding: 2.5px 8px;
    border-radius: 6px;
    white-space: nowrap !important;
  }

  /* Chip Nilai Rapor */
  .row-score-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 26px;
    padding: 0 6px;
    font-size: 12.5px;
    font-weight: 700;
    border-radius: 6px;
    box-sizing: border-box;
  }

  .row-score-chip.zero {
    color: #94A3B8;
    background: #F8FAFC;
    border: 1px dashed #CBD5E1;
  }

  .row-score-chip.filled {
    color: #0F172A;
    background: #F1F5F9;
    border: 1px solid #CBD5E1;
  }

  /* Chip Nilai Akhir */
  .row-final-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 26px;
    padding: 0 8px;
    font-size: 13px;
    font-weight: 800;
    border-radius: 6px;
    box-sizing: border-box;
  }

  .row-final-chip.zero {
    color: #94A3B8;
    background: #F8FAFC;
    border: 1px dashed #CBD5E1;
  }

  .row-final-chip.filled {
    color: var(--c-primary, #30618C);
    background: #EBF3FA;
    border: 1px solid #BFDBFE;
  }

  .row-final-chip.high {
    color: #047857;
    background: #ECFDF5;
    border: 1px solid #A7F3D0;
  }

  /* Tombol Aksi */
  .btn-action-akademik {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 10px;
    font-size: 11.5px;
    font-weight: 700;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
    white-space: nowrap !important;
    border: 1px solid transparent;
    text-decoration: none;
  }

  .btn-action-akademik.primary {
    background: #30618C;
    color: #FFFFFF;
    border-color: #30618C;
    box-shadow: 0 1px 3px rgba(48, 97, 140, 0.2);
  }

  .btn-action-akademik.primary:hover {
    background: #23486A;
    border-color: #23486A;
    box-shadow: 0 3px 8px rgba(48, 97, 140, 0.3);
    transform: translateY(-1px);
  }

  .btn-action-akademik.outline {
    background: #FFFFFF;
    color: #1E293B;
    border-color: #CBD5E1;
  }

  .btn-action-akademik.outline:hover {
    background: #F8FAFD;
    border-color: #30618C;
    color: #30618C;
    transform: translateY(-1px);
  }

  /* Responsive Mobile (< 640px) */
  @media (max-width: 639px) {
    .academic-table-card .table-integrated-toolbar {
      flex-direction: column !important;
      align-items: stretch !important;
      gap: 10px !important;
      padding: 14px 16px !important;
    }
    .academic-table-card .table-toolbar-desc {
      white-space: normal !important;
    }
    .academic-table-card .table-toolbar-actions {
      width: 100% !important;
      justify-content: stretch !important;
    }
    .academic-table-card .table-search-box {
      flex: 1 1 auto !important;
      width: auto !important;
    }
    .academic-table-card .table-filter-group {
      flex: 0 0 auto !important;
    }
  }
</style>
@endpush



@section('content')
  <!-- Summary Mini Badges -->
  <div class="stats-summary-grid-compact">
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
        <div class="stat-val" id="statRataRataNilai">{{ $rataRata !== null ? number_format($rataRata, 1) : 'Belum diisi' }}</div>
        <div class="stat-label">Rata-Rata Nilai Rapor (4 Mata Pelajaran)</div>
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
        <div class="stat-val" id="statMapelTertinggi">{{ $highestMapel }}</div>
        <div class="stat-label">Capaian Mata Pelajaran Tertinggi</div>
      </div>
    </div>
  </div>

  <!-- Grafik Visualisasi Nilai 4 Mata Pelajaran Pokok -->
  <div class="chart-academic-wrapper">
    <div class="chart-academic-header">
      <div class="chart-academic-title">
        <h3>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"></line>
            <line x1="12" y1="20" x2="12" y2="4"></line>
            <line x1="6" y1="20" x2="6" y2="14"></line>
          </svg>
          Grafik Nilai 4 Mata Pelajaran Pokok
        </h3>
        <p>Visualisasi akumulasi rata-rata nilai dari seluruh semester yang diisi untuk penyesuaian kecocokan program studi.</p>
      </div>
      <div class="chart-curriculum-badge">
        Kurikulum Merdeka • Skala 0 - 100
      </div>
    </div>

    <div class="academic-metric-grid">
      @foreach($mapelStats as $key => $meta)
        @php
          $score = (float) $meta['score'];
          $hasData = $meta['has_data'];
          $percent = $meta['percent'];
          $predikat = $meta['predikat'];
          $kId = strtolower(str_replace([' ', '(', ')'], '', $key));
          $filledCount = $meta['filled_count'];
        @endphp
        <div class="metric-bar-card">
          <div class="metric-bar-top">
            <div class="metric-name-wrap">
              <h4>{{ $meta['alias'] }}</h4>
              <span>{{ $meta['sub'] }}</span>
            </div>
            <div class="metric-score-wrap">
              <div class="metric-score-val {{ $meta['scoreClass'] }}" id="chartScore{{ ucfirst($kId) }}">
                {{ $hasData ? number_format($score, 1) : '-' }}
              </div>
              <span class="metric-grade-tag {{ $meta['badgeClass'] }}" id="chartGrade{{ ucfirst($kId) }}">
                {{ $hasData ? 'Predikat ' . $predikat : 'Belum Diisi' }}
              </span>
            </div>
          </div>
          <div class="metric-track">
            <div class="metric-fill {{ $meta['fillClass'] }}" id="pillar{{ ucfirst($kId) }}" style="width: {{ $percent }}%;"></div>
          </div>
          <div class="metric-bar-footer">
            <span id="chartDetail{{ ucfirst($kId) }}">{{ $filledCount > 0 ? $filledCount . ' Semester Terisi' : 'Belum Ada Nilai' }}</span>
            <span id="chartPercent{{ ucfirst($kId) }}">{{ $hasData ? $percent . '% Tercapai' : '0% Tercapai' }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Table Container with Integrated Search & Filter -->
  <div class="data-card academic-table-card">
    <div class="table-integrated-toolbar">
      <div class="table-toolbar-info">
        <div class="table-toolbar-header-row">
          <div class="data-card-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
            </svg>
            <span>Daftar Nilai Rapor Siswa</span>
          </div>
          <span class="data-count-badge" data-count-for="akademikTableBody">{{ count($sortedRecords) }} Nilai Rapor</span>
        </div>
        <div class="table-toolbar-desc">Setiap semester memiliki 4 mata pelajaran pokok dengan nilai default 0</div>
      </div>

      <div class="table-toolbar-actions">
        <!-- Integrated Search Box -->
        <div class="search-box table-search-box">
          <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="searchMapel" class="search-input table-search-input" placeholder="Cari mata pelajaran...">
        </div>

        <!-- Integrated Filter Controls -->
        <div class="filter-controls-group table-filter-group">
          <select id="filterSemester" class="filter-select table-filter-select" data-filter-key="semester">
            <option value="all" selected>Semua Semester</option>
            <option value="Semester 1">Semester 1 (Kelas X Ganjil)</option>
            <option value="Semester 2">Semester 2 (Kelas X Genap)</option>
            <option value="Semester 3">Semester 3 (Kelas XI Ganjil)</option>
            <option value="Semester 4">Semester 4 (Kelas XI Genap)</option>
            <option value="Semester 5">Semester 5 (Kelas XII Ganjil)</option>
          </select>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableAkademik">
        <thead>
          <tr>
            <th class="col-no">No</th>
            <th class="col-mapel">Mata Pelajaran</th>
            <th class="col-sem">Semester</th>
            <th class="col-num">Pengetahuan</th>
            <th class="col-num">Keterampilan</th>
            <th class="col-akhir">Nilai Akhir</th>
            <th class="col-aksi">Aksi</th>
          </tr>
        </thead>
        <tbody id="akademikTableBody">
          @php $no = 1; @endphp
          @foreach($sortedRecords as $r)
            @php
              $p = (float) $r->pengetahuan;
              $k = (float) $r->keterampilan;
              $akhir = (float) $r->rata_rata_nilai;
              $sem = $r->mapel_semester;
              $mapelKey = $r->mata_pelajaran;
              if (stripos($mapelKey, 'Matematika') !== false) {
                  $mapelKey = 'MTK';
              }
              $meta = $mapelStats[$mapelKey] ?? [
                  'sub' => $mapelKey,
                  'alias' => $r->mata_pelajaran,
              ];
              $isFilled = $akhir > 0 || $p > 0 || $k > 0;
            @endphp
            <tr data-searchable="{{ $r->mata_pelajaran }} {{ $meta['sub'] }} {{ $sem }}" 
                data-semester="{{ $sem }}" 
                data-mapel="{{ $mapelKey }}" 
                data-pengetahuan="{{ $p }}" 
                data-keterampilan="{{ $k }}">
              <td class="col-no row-number">{{ $no++ }}</td>
              <td class="col-mapel">
                <div class="row-mapel-name">{{ $meta['alias'] ?? $r->mata_pelajaran }}</div>
                <div class="row-mapel-sub">{{ $meta['sub'] }}</div>
              </td>
              <td class="col-sem">
                <span class="row-semester-pill row-semester-val">{{ $sem }}</span>
              </td>
              <td class="col-num">
                <span class="row-pengetahuan-val row-score-chip {{ $p > 0 ? 'filled' : 'zero' }}">{{ number_format($p, 0) }}</span>
              </td>
              <td class="col-num">
                <span class="row-keterampilan-val row-score-chip {{ $k > 0 ? 'filled' : 'zero' }}">{{ number_format($k, 0) }}</span>
              </td>
              <td class="col-akhir">
                <span class="row-akhir-val row-final-chip {{ $akhir >= 85 ? 'high' : ($akhir > 0 ? 'filled' : 'zero') }}">{{ number_format($akhir, 1) }}</span>
              </td>
              <td class="col-aksi">
                <div class="action-btn-group" style="justify-content: flex-end; gap: 6px;">
                  <button type="button" class="btn-action-akademik btn-edit-row {{ $isFilled ? 'outline' : 'primary' }}" title="{{ $isFilled ? 'Ubah nilai rapor ini' : 'Isi nilai rapor ini' }}">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <span>{{ $isFilled ? 'Ubah' : 'Isi Nilai' }}</span>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div style="padding:14px 20px; border-top:1px solid var(--c-border-light, #E2E8F0); background:#FAFCFE; font-size:12.5px; color:var(--c-text-muted); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
      <div style="display:flex; align-items:center; gap:8px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
        <span>Setiap semester memiliki 4 mata pelajaran pokok (default nilai 0). Klik <strong>Isi Nilai</strong> atau <strong>Ubah</strong> untuk memperbarui.</span>
      </div>
      <div style="font-weight:700; color:var(--c-primary); display:flex; align-items:center; gap:6px;">
        <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#10B981;"></span>
        <span>5 Semester Tersedia</span>
      </div>
    </div>
  </div>
@endsection
