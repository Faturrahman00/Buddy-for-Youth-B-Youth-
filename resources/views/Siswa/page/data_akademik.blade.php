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
  .fill-ipas {
    background: linear-gradient(90deg, #10B981, #059669);
  }
  .score-ipas { color: #059669; }
  .badge-ipas { background: #ECFDF3; color: #027A48; border: 1px solid #A6F4C5; }

  .fill-mtk {
    background: linear-gradient(90deg, #30618C, #1D4363);
  }
  .score-mtk { color: #30618C; }
  .badge-mtk { background: #EFF8FF; color: #175CD3; border: 1px solid #B2DDFF; }

  .fill-indo {
    background: linear-gradient(90deg, #F2B705, #D49A00);
  }
  .score-indo { color: #D49A00; }
  .badge-indo { background: #FEF0C7; color: #B54708; border: 1px solid #FEDF89; }

  .fill-ing {
    background: linear-gradient(90deg, #4A88C0, #296091);
  }
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
</style>
@endpush

@section('content')
  <!-- Top Action Header -->
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
      <p>Kelola nilai rapor 4 mata pelajaran pokok untuk menentukan akurasi rekomendasi program studi.</p>
    </div>
  </div>

  <!-- Summary Mini Badges (Card Esensial yang Berguna Saja) -->
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
        <div class="stat-val" id="statRataRataNilai">89.3</div>
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
        <div class="stat-val" id="statMapelTertinggi">92.0 (MTK)</div>
        <div class="stat-label">Capaian Mata Pelajaran Tertinggi</div>
      </div>
    </div>
  </div>

  <!-- Grafik Visualisasi Nilai 4 Mata Pelajaran Pokok (Modern, Rapih & Kokoh) -->
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
        <p>Visualisasi capaian kompetensi untuk penyesuaian kecocokan program studi.</p>
      </div>
      <div class="chart-curriculum-badge">
        Kurikulum Merdeka • Skala 0 - 100
      </div>
    </div>

    <div class="academic-metric-grid">
      <!-- 1. IPAS -->
      <div class="metric-bar-card">
        <div class="metric-bar-top">
          <div class="metric-name-wrap">
            <h4>IPAS</h4>
            <span>Ilmu Pengetahuan Alam &amp; Sosial</span>
          </div>
          <div class="metric-score-wrap">
            <div class="metric-score-val score-ipas" id="chartScoreIpas">88.0</div>
            <span class="metric-grade-tag badge-ipas" id="chartGradeIpas">Predikat A</span>
          </div>
        </div>
        <div class="metric-track">
          <div class="metric-fill fill-ipas" id="pillarIpas" style="width: 88%;"></div>
        </div>
        <div class="metric-bar-footer">
          <span>KKM: 75</span>
          <span id="chartPercentIpas">88% Tercapai</span>
        </div>
      </div>

      <!-- 2. MTK -->
      <div class="metric-bar-card">
        <div class="metric-bar-top">
          <div class="metric-name-wrap">
            <h4>Matematika (MTK)</h4>
            <span>Logika &amp; Kuantitatif</span>
          </div>
          <div class="metric-score-wrap">
            <div class="metric-score-val score-mtk" id="chartScoreMtk">92.0</div>
            <span class="metric-grade-tag badge-mtk" id="chartGradeMtk">Predikat A</span>
          </div>
        </div>
        <div class="metric-track">
          <div class="metric-fill fill-mtk" id="pillarMtk" style="width: 92%;"></div>
        </div>
        <div class="metric-bar-footer">
          <span>KKM: 75</span>
          <span id="chartPercentMtk">92% Tercapai</span>
        </div>
      </div>

      <!-- 3. Bahasa Indonesia -->
      <div class="metric-bar-card">
        <div class="metric-bar-top">
          <div class="metric-name-wrap">
            <h4>Bahasa Indonesia</h4>
            <span>Komunikasi &amp; Literasi</span>
          </div>
          <div class="metric-score-wrap">
            <div class="metric-score-val score-indo" id="chartScoreIndo">87.0</div>
            <span class="metric-grade-tag badge-indo" id="chartGradeIndo">Predikat A</span>
          </div>
        </div>
        <div class="metric-track">
          <div class="metric-fill fill-indo" id="pillarIndo" style="width: 87%;"></div>
        </div>
        <div class="metric-bar-footer">
          <span>KKM: 75</span>
          <span id="chartPercentIndo">87% Tercapai</span>
        </div>
      </div>

      <!-- 4. Bahasa Inggris -->
      <div class="metric-bar-card">
        <div class="metric-bar-top">
          <div class="metric-name-wrap">
            <h4>Bahasa Inggris</h4>
            <span>Bahasa Internasional</span>
          </div>
          <div class="metric-score-wrap">
            <div class="metric-score-val score-ing" id="chartScoreIng">90.0</div>
            <span class="metric-grade-tag badge-ing" id="chartGradeIng">Predikat A</span>
          </div>
        </div>
        <div class="metric-track">
          <div class="metric-fill fill-ing" id="pillarIng" style="width: 90%;"></div>
        </div>
        <div class="metric-bar-footer">
          <span>KKM: 75</span>
          <span id="chartPercentIng">90% Tercapai</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Search & Filter Card (Tanpa Tombol Reset) -->
  <div class="filter-card">
    <div class="filter-row">
      <!-- Search Input -->
      <div class="search-box">
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="searchMapel" class="search-input" placeholder="Cari mata pelajaran...">
      </div>

      <!-- Filters Group -->
      <div class="filter-controls-group">
        <!-- Filter Semester -->
        <select id="filterSemester" class="filter-select" data-filter-key="semester">
          <option value="all">Semua Semester</option>
          <option value="Semester 5" selected>Semester 5 (Kelas XII Ganjil)</option>
          <option value="Semester 4">Semester 4 (Kelas XI Genap)</option>
          <option value="Semester 3">Semester 3 (Kelas XI Ganjil)</option>
          <option value="Semester 2">Semester 2 (Kelas X Genap)</option>
          <option value="Semester 1">Semester 1 (Kelas X Ganjil)</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Table Container (4 Mata Pelajaran Disediakan Admin) -->
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">
        <span>Daftar Nilai Rapor</span>
        <span class="data-count-badge" data-count-for="akademikTableBody">4 Mata Pelajaran</span>
      </div>
      <div style="font-size:12.5px; color:var(--c-text-muted);">
        4 Mata Pelajaran Penentu Kurikulum
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableAkademik">
        <thead>
          <tr>
            <th style="width: 50px;">No</th>
            <th>Mata Pelajaran</th>
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
          <!-- 1. IPAS -->
          <tr data-searchable="IPAS Ilmu Pengetahuan Alam dan Sosial Semester 5 A" data-semester="Semester 5" data-mapel="IPAS" data-kkm="75" data-pengetahuan="88" data-keterampilan="88">
            <td class="row-number" style="font-weight:700; color:var(--c-text-muted);">1</td>
            <td>
              <div class="row-mapel-name" style="font-weight:700; color:var(--c-text-heading);">IPAS</div>
              <div class="row-mapel-sub" style="font-size:12px; color:var(--c-text-muted);">Ilmu Pengetahuan Alam &amp; Sosial • KKM: <span class="row-kkm-val">75</span></div>
            </td>
            <td><span class="row-semester-val" style="font-weight:600;">Semester 5</span></td>
            <td class="row-pengetahuan-val" style="text-align: center; font-weight:700;">88</td>
            <td class="row-keterampilan-val" style="text-align: center; font-weight:700;">88</td>
            <td class="row-akhir-val" style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">88.0</td>
            <td class="row-predikat-val" style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end; gap: 6px;">
                <button type="button" class="btn-table-action outline btn-edit-row">Masukkan / Ubah Nilai</button>
              </div>
            </td>
          </tr>

          <!-- 2. MTK -->
          <tr data-searchable="MTK Matematika Semester 5 A" data-semester="Semester 5" data-mapel="MTK" data-kkm="75" data-pengetahuan="92" data-keterampilan="92">
            <td class="row-number" style="font-weight:700; color:var(--c-text-muted);">2</td>
            <td>
              <div class="row-mapel-name" style="font-weight:700; color:var(--c-text-heading);">MTK</div>
              <div class="row-mapel-sub" style="font-size:12px; color:var(--c-text-muted);">Matematika • KKM: <span class="row-kkm-val">75</span></div>
            </td>
            <td><span class="row-semester-val" style="font-weight:600;">Semester 5</span></td>
            <td class="row-pengetahuan-val" style="text-align: center; font-weight:700;">92</td>
            <td class="row-keterampilan-val" style="text-align: center; font-weight:700;">92</td>
            <td class="row-akhir-val" style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">92.0</td>
            <td class="row-predikat-val" style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end; gap: 6px;">
                <button type="button" class="btn-table-action outline btn-edit-row">Masukkan / Ubah Nilai</button>
              </div>
            </td>
          </tr>

          <!-- 3. Bahasa Indonesia -->
          <tr data-searchable="Bahasa Indonesia Semester 5 A" data-semester="Semester 5" data-mapel="Bahasa Indonesia" data-kkm="75" data-pengetahuan="86" data-keterampilan="88">
            <td class="row-number" style="font-weight:700; color:var(--c-text-muted);">3</td>
            <td>
              <div class="row-mapel-name" style="font-weight:700; color:var(--c-text-heading);">Bahasa Indonesia</div>
              <div class="row-mapel-sub" style="font-size:12px; color:var(--c-text-muted);">Bahasa Indonesia • KKM: <span class="row-kkm-val">75</span></div>
            </td>
            <td><span class="row-semester-val" style="font-weight:600;">Semester 5</span></td>
            <td class="row-pengetahuan-val" style="text-align: center; font-weight:700;">86</td>
            <td class="row-keterampilan-val" style="text-align: center; font-weight:700;">88</td>
            <td class="row-akhir-val" style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">87.0</td>
            <td class="row-predikat-val" style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end; gap: 6px;">
                <button type="button" class="btn-table-action outline btn-edit-row">Masukkan / Ubah Nilai</button>
              </div>
            </td>
          </tr>

          <!-- 4. Bahasa Inggris -->
          <tr data-searchable="Bahasa Inggris Semester 5 A" data-semester="Semester 5" data-mapel="Bahasa Inggris" data-kkm="75" data-pengetahuan="90" data-keterampilan="90">
            <td class="row-number" style="font-weight:700; color:var(--c-text-muted);">4</td>
            <td>
              <div class="row-mapel-name" style="font-weight:700; color:var(--c-text-heading);">Bahasa Inggris</div>
              <div class="row-mapel-sub" style="font-size:12px; color:var(--c-text-muted);">Bahasa Inggris • KKM: <span class="row-kkm-val">75</span></div>
            </td>
            <td><span class="row-semester-val" style="font-weight:600;">Semester 5</span></td>
            <td class="row-pengetahuan-val" style="text-align: center; font-weight:700;">90</td>
            <td class="row-keterampilan-val" style="text-align: center; font-weight:700;">90</td>
            <td class="row-akhir-val" style="text-align: center; font-weight:800; color:var(--c-primary); font-size:15px;">90.0</td>
            <td class="row-predikat-val" style="text-align: center;"><span class="grade-badge a">A</span></td>
            <td><span class="status-pill success">Terverifikasi</span></td>
            <td style="text-align: right;">
              <div class="action-btn-group" style="justify-content: flex-end; gap: 6px;">
                <button type="button" class="btn-table-action outline btn-edit-row">Masukkan / Ubah Nilai</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Table Footer Note -->
    <div style="padding:16px 20px; border-top:1px solid var(--c-border-light); font-size:13px; color:var(--c-text-muted); display:flex; justify-content:space-between; align-items:center;">
      <div>Hanya 4 mata pelajaran pokok ini yang disediakan oleh pihak sekolah/admin untuk kalkulasi program studi.</div>
      <div style="font-weight:700; color:var(--c-primary);">Total 4 Mata Pelajaran</div>
    </div>
  </div>
@endsection
