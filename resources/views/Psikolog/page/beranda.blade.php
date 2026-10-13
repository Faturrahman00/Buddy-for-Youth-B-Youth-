@extends('Psikolog.layout.app', [
    'title' => 'Beranda Psikolog — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Beranda',
    'active' => 'beranda'
])

@section('content')

<!-- =========================================================================
     TOP 3 METRIC CARDS
     Wireframe Spec: 3 Card Metrics (Booking Baru, Sesi Mendatang, Sesi Selesai)
     Created to be ultra-creative, informative, and visually stunning.
     ========================================================================= -->
<div class="metrics-grid-3">

  <!-- Card 1: PERMINTAAN BOOKING BARU -->
  <div class="metric-card-box amber">
    <div>
      <div class="metric-header">
        <h3 class="metric-title">Permintaan Booking Baru</h3>
        <div class="metric-icon-bubble amber" title="Pengajuan Menunggu">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </div>
      </div>
      <div class="metric-value-wrap">
        <div class="metric-number">1</div>
        <span class="metric-tag-chip amber">Perlu Verifikasi</span>
      </div>
      <p class="metric-subtext">Menunggu verifikasi Anda</p>
    </div>

    <div class="metric-footer-note">
      <span>Dari: Siti Sarah R. (SMAN 3)</span>
      <a href="{{ route('psikolog.jadwal') }}" class="metric-action-link">
        Tinjau Sekarang
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </a>
    </div>
  </div>

  <!-- Card 2: SESI KONSULTASI MENDATANG -->
  <div class="metric-card-box primary">
    <div>
      <div class="metric-header">
        <h3 class="metric-title">Sesi Konsultasi Mendatang</h3>
        <div class="metric-icon-bubble primary" title="Jadwal Zoom Siap">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M23 7l-7 5 7 5V7z"></path>
            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
          </svg>
        </div>
      </div>
      <div class="metric-value-wrap">
        <div class="metric-number">1</div>
        <span class="metric-tag-chip primary">Zoom Terkonfirmasi</span>
      </div>
      <p class="metric-subtext">Jadwal Zoom terkonfirmasi</p>
    </div>

    <div class="metric-footer-note">
      <span>Hari ini • 14:00 WIB (Dimas W.)</span>
      <a href="https://zoom.us/j/98765432199" target="_blank" class="metric-action-link">
        Buka Zoom
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
      </a>
    </div>
  </div>

  <!-- Card 3: SESI SELESAI -->
  <div class="metric-card-box emerald">
    <div>
      <div class="metric-header">
        <h3 class="metric-title">Sesi Selesai</h3>
        <div class="metric-icon-bubble emerald" title="Sesi Selesai">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>
      </div>
      <div class="metric-value-wrap">
        <div class="metric-number">3</div>
        <span class="metric-tag-chip emerald">100% Tuntas</span>
      </div>
      <p class="metric-subtext">Total sesi konseling tuntas</p>
    </div>

    <div class="metric-footer-note">
      <span>3 Rekomendasi Terbit</span>
      <a href="{{ route('psikolog.riwayat') }}" class="metric-action-link">
        Lihat Riwayat
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </a>
    </div>
  </div>

</div>

<!-- =========================================================================
     SPLIT GRID: JADWAL MENDATANG (Kiri) & RINGKASAN BULAN INI (Kanan)
     Matches Wireframe 1 Split Layout
     ========================================================================= -->
<div class="beranda-split-grid">

  <!-- ======================== LEFT: JADWAL MENDATANG ======================== -->
  <div class="psikolog-card">
    <div class="card-header-wrap">
      <div class="card-title-group">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        <span class="card-title-text">Jadwal Mendatang</span>
      </div>

      <a href="{{ route('psikolog.jadwal') }}" class="btn-secondary-link" style="padding: 6px 12px; font-size: 12px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
        <span>Kalender Sesi</span>
      </a>
    </div>

    <div class="card-body-content">
      <p style="font-size: 13px; color: var(--c-text-muted); margin-bottom: 16px;">
        Daftar pertemuan Zoom terdekat bersama siswa yang telah disetujui.
      </p>

      <!-- 1. Featured Next Active Session (Hari Ini) -->
      <div class="featured-session-card">
        <div class="session-top-meta">
          <div class="session-badge-status">
            <span class="pulse-dot"></span>
            <span>Sesi Hari Ini • Terkonfirmasi</span>
          </div>
          <div class="session-time-pill">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span>14:00 - 15:00 WIB (60 Menit)</span>
          </div>
        </div>

        <div class="student-identity-row">
          <div class="student-avatar-circle">DW</div>
          <div class="student-info">
            <h4>Dimas Wicaksono</h4>
            <p>SMA Negeri 1 Jakarta • Kelas XII MIPA 2</p>
          </div>
        </div>

        <div class="session-topic-box">
          <div class="session-topic-label">Topik Konseling &amp; Validasi</div>
          <div class="session-topic-title">Eksplorasi Minat Komputasi vs Rekayasa Sistem &amp; Validasi Pilihan SNBP</div>
          <div class="session-topic-desc">Siswa bimbang memilih antara Teknik Informatika vs Sistem Informasi pada pilihan 1 &amp; 2 SNBP.</div>
          <div style="margin-top: 8px; display: inline-flex; align-items: center; gap: 6px; background: #EEF5FB; padding: 3px 8px; border-radius: 4px; font-size: 11.5px; font-weight: 700; color: var(--c-primary);">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            Hasil Asesmen B-Youth: Kecocokan Rumpun Teknik 88%
          </div>
        </div>

        <div class="session-actions-bar">
          <a href="https://zoom.us/j/98765432199" target="_blank" class="btn-zoom-primary" id="btnZoomNow">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M23 7l-7 5 7 5V7z"></path>
              <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
            </svg>
            <span>Masuk Zoom Sesi</span>
          </a>

          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-secondary-link" onclick="window.copyZoomLink('https://zoom.us/j/98765432199')">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
              Salin Link Zoom
            </button>
            <button type="button" class="btn-secondary-link" onclick="window.showToast('Membuka rekap data akademik & asesmen siswa...')">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
              Detail Siswa
            </button>
          </div>
        </div>
      </div>

      <!-- 2. Upcoming Sesi 2 (Minggu Depan) -->
      <div class="upcoming-item-compact">
        <div class="compact-left">
          <div class="compact-avatar">SR</div>
          <div class="compact-details">
            <h5>Siti Sarah Rahmawati</h5>
            <p>SMA Negeri 3 Bandung • Kamis, 15 Okt 2026, 10:00 - 11:00 WIB</p>
          </div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
          <span class="status-tag disetujui" style="font-size: 11.5px; padding: 3px 8px;">Disetujui</span>
          <button type="button" class="btn-secondary-link" style="padding: 5px 10px; font-size: 12px;" onclick="window.copyZoomLink('https://zoom.us/j/98765432199')">
            Link Zoom
          </button>
        </div>
      </div>

      <!-- Helper Notice -->
      <div style="background: #FAFCFE; border: 1px dashed var(--c-border); border-radius: 8px; padding: 12px 14px; margin-top: 14px; display: flex; align-items: center; justify-content: space-between; font-size: 12.5px; color: var(--c-text-muted);">
        <span>Ingin menambah kuota slot konsultasi untuk siswa lain?</span>
        <a href="{{ route('psikolog.jadwal') }}" style="color: var(--c-primary); font-weight: 700;">+ Buka Slot Baru</a>
      </div>
    </div>
  </div>

  <!-- ======================== RIGHT: RINGKASAN BULAN INI ======================== -->
  <div class="psikolog-card">
    <div class="card-header-wrap">
      <div class="card-title-group">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-accent)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="20" x2="18" y2="10"></line>
          <line x1="12" y1="20" x2="12" y2="4"></line>
          <line x1="6" y1="20" x2="6" y2="14"></line>
        </svg>
        <span class="card-title-text">Ringkasan Bulan Ini</span>
      </div>

      <span style="font-size: 12px; font-weight: 700; color: var(--c-text-muted); background: var(--c-bg); padding: 3px 8px; border-radius: 4px;">
        Oktober 2026
      </span>
    </div>

    <div class="card-body-content">
      <p style="font-size: 13px; color: var(--c-text-muted); margin-bottom: 16px;">
        Statistik jam konseling &amp; evaluasi rekomendasi program studi.
      </p>

      <!-- Mini Stats Stack -->
      <div class="stat-summary-vbox">
        <!-- 1. Total Jam Konseling -->
        <div class="mini-stat-card">
          <div class="mini-stat-label-wrap">
            <div class="mini-stat-icon" style="background:#EAF2F8; color:var(--c-primary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
              <div class="mini-stat-name">Total Jam Konseling</div>
              <div style="font-size:11px; color:#10B981; font-weight:700;">65% dari target 10 jam</div>
            </div>
          </div>
          <div class="mini-stat-value">6.5 Jam</div>
        </div>

        <!-- 2. Siswa Didampingi -->
        <div class="mini-stat-card">
          <div class="mini-stat-label-wrap">
            <div class="mini-stat-icon" style="background:#FFF9E6; color:#B48200;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div>
              <div class="mini-stat-name">Siswa Didampingi</div>
              <div style="font-size:11px; color:var(--c-text-muted);">Kepuasan: 4.9 / 5 ★</div>
            </div>
          </div>
          <div class="mini-stat-value">5 Siswa</div>
        </div>

        <!-- 3. Rekomendasi Terkirim -->
        <div class="mini-stat-card">
          <div class="mini-stat-label-wrap">
            <div class="mini-stat-icon" style="background:#EBFDF2; color:#027A48;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
              <div class="mini-stat-name">Rekomendasi Terkirim</div>
              <div style="font-size:11px; color:var(--c-primary); font-weight:700;">Tervalidasi Psikolog</div>
            </div>
          </div>
          <div class="mini-stat-value">4 Berkas</div>
        </div>
      </div>

      <!-- ApexChart Area: Tren Sesi Bulanan -->
      <div class="chart-container-widget">
        <div class="chart-header-title">
          <span>Aktivitas Sesi Per Minggu</span>
          <span style="font-size: 11px; color: var(--c-text-muted); font-weight: 600;">Oktober 2026</span>
        </div>
        <div id="chart-konseling-bulanan" style="min-height: 180px;"></div>
      </div>

      <!-- Quick Actions Grid -->
      <div class="quick-tools-grid">
        <a href="{{ route('psikolog.jadwal') }}" class="quick-tool-btn">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          Buka Slot Baru
        </a>
        <a href="{{ route('psikolog.riwayat') }}" class="quick-tool-btn">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
          Rekap Riwayat
        </a>
      </div>

    </div>
  </div>

</div>

@endsection
