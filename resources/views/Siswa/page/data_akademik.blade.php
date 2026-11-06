@extends('Siswa.layouts.app', [
    'title' => 'Data Akademik — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Data Akademik',
    'active' => 'akademik'
])

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/Siswa/data-akademik.css') }}">
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

@push('scripts')
  <script src="{{ asset('js/Siswa/data-akademik.js') }}"></script>
@endpush
