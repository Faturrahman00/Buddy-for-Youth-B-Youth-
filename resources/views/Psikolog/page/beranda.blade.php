@extends('Psikolog.layout.app', [
    'title' => 'Beranda Psikolog — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Beranda',
    'active' => 'beranda'
])

@section('content')

<!-- =========================================================================
     TOP 3 METRIC CARDS
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
        <div class="metric-number">{{ $bookingBaruCount ?? 0 }}</div>
        <span class="metric-tag-chip amber">{{ ($bookingBaruCount ?? 0) > 0 ? 'Perlu Verifikasi' : 'Tidak Ada Antrean' }}</span>
      </div>
      <p class="metric-subtext">{{ ($bookingBaruCount ?? 0) > 0 ? 'Menunggu verifikasi Anda' : 'Semua pengajuan telah diproses' }}</p>
    </div>

    <div class="metric-footer-note">
      @if(!empty($bookingBaruSample))
        <span>Dari: {{ $bookingBaruSample->siswa->nama ?? 'Siswa' }} ({{ $bookingBaruSample->siswa->sekolah ?? 'Sekolah' }})</span>
      @else
        <span>Belum ada pengajuan baru</span>
      @endif
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
        <div class="metric-number">{{ $sesiMendatangCount ?? 0 }}</div>
        <span class="metric-tag-chip primary">Zoom Terkonfirmasi</span>
      </div>
      <p class="metric-subtext">Jadwal konsultasi terkonfirmasi</p>
    </div>

    <div class="metric-footer-note">
      @if(!empty($nextSession))
        <span>{{ \Carbon\Carbon::parse($nextSession->tanggal_konsultasi)->translatedFormat('d M') }} • {{ substr($nextSession->waktu_mulai, 0, 5) }} WIB ({{ $nextSession->siswa->nama ?? 'Siswa' }})</span>
        @if(!empty($nextSession->link_zoom))
          <a href="{{ $nextSession->link_zoom }}" target="_blank" class="metric-action-link">
            Buka Zoom
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
          </a>
        @endif
      @else
        <span>Belum ada jadwal sesi mendatang</span>
        <a href="{{ route('psikolog.jadwal') }}" class="metric-action-link">
          + Buka Slot
        </a>
      @endif
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
        <div class="metric-number">{{ $sesiSelesaiCount ?? 0 }}</div>
        <span class="metric-tag-chip emerald">100% Tuntas</span>
      </div>
      <p class="metric-subtext">Total sesi konseling tuntas</p>
    </div>

    <div class="metric-footer-note">
      <span>{{ $sesiSelesaiCount ?? 0 }} Rekomendasi Terbit</span>
      <a href="{{ route('psikolog.riwayat') }}" class="metric-action-link">
        Lihat Riwayat
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </a>
    </div>
  </div>

</div>

<!-- =========================================================================
     SPLIT GRID: JADWAL MENDATANG (Kiri) & RINGKASAN AKTIVITAS (Kanan)
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
        <span class="card-title-text">Sesi Konsultasi Terjadwal</span>
      </div>

      <a href="{{ route('psikolog.jadwal') }}" class="btn-secondary-link" style="padding: 6px 12px; font-size: 12px; text-decoration:none;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
        <span>Kelola Jadwal</span>
      </a>
    </div>

    <div class="card-body-content">
      <p style="font-size: 13px; color: var(--c-text-muted); margin-bottom: 16px;">
        Daftar pertemuan Zoom bersama siswa yang telah disetujui.
      </p>

      @if(!empty($nextSession))
        @php
          $siswaNama = $nextSession->siswa->nama ?? 'Siswa';
          $iniSiswa = strtoupper(substr($siswaNama, 0, 2));
        @endphp
        <!-- Featured Next Active Session -->
        <div class="featured-session-card">
          <div class="session-top-meta">
            <div class="session-badge-status">
              <span class="pulse-dot"></span>
              <span>Sesi Terkonfirmasi</span>
            </div>
            <div class="session-time-pill">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              <span>{{ \Carbon\Carbon::parse($nextSession->tanggal_konsultasi)->translatedFormat('d M Y') }} • {{ substr($nextSession->waktu_mulai, 0, 5) }} - {{ substr($nextSession->waktu_selesai, 0, 5) }} WIB</span>
            </div>
          </div>

          <div class="student-identity-row">
            <div class="student-avatar-circle">{{ $iniSiswa }}</div>
            <div class="student-info">
              <h4>{{ $siswaNama }}</h4>
              <p>{{ $nextSession->siswa->sekolah ?? 'Sekolah Siswa' }} • {{ $nextSession->siswa->kelas ?? 'Kelas Siswa' }}</p>
            </div>
          </div>

          <div class="session-topic-box">
            <div class="session-topic-label">Topik Konseling &amp; Validasi</div>
            <div class="session-topic-title">{{ $nextSession->catatan ?? 'Bimbingan Minat Bakat & Jurusan Perguruan Tinggi' }}</div>
          </div>

          <div class="session-actions-bar">
            @if(!empty($nextSession->link_zoom))
              <a href="{{ $nextSession->link_zoom }}" target="_blank" class="btn-zoom-primary" style="text-decoration:none;">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M23 7l-7 5 7 5V7z"></path>
                  <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
                <span>Masuk Zoom Sesi</span>
              </a>
              <button type="button" class="btn-secondary-link" onclick="navigator.clipboard.writeText('{{ $nextSession->link_zoom }}'); alert('Link Zoom berhasil disalin!');">
                Salin Link Zoom
              </button>
              <a href="{{ route('psikolog.jadwal') }}" class="btn-secondary-link" style="text-decoration:none;">
                Detail Sesi
              </a>
            @else
              <a href="{{ route('psikolog.jadwal') }}" class="btn-secondary-link" style="text-decoration:none;">
                Detail Sesi
              </a>
            @endif
          </div>
        </div>
      @else
        <div style="text-align: center; padding: 36px 16px; background: #FAFCFE; border: 1px dashed var(--c-border); border-radius: 12px;">
          <div style="width: 44px; height: 44px; background: rgba(48,97,140,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: var(--c-primary);">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
          </div>
          <h4 style="margin: 0 0 4px; font-size: 14.5px; font-weight: 700; color: var(--c-text-heading);">Tidak Ada Sesi Terjadwal</h4>
          <p style="margin: 0 0 14px; font-size: 13px; color: var(--c-text-muted);">Buka slot jadwal baru agar siswa dapat mengajukan sesi konsultasi.</p>
          <a href="{{ route('psikolog.jadwal') }}" class="btn-primary-action" style="display: inline-flex; padding: 8px 16px; text-decoration: none;">
            + Buka Slot Baru
          </a>
        </div>
      @endif

      <!-- Helper Notice -->
      <div style="background: #FAFCFE; border: 1px dashed var(--c-border); border-radius: 8px; padding: 12px 14px; margin-top: 14px; display: flex; align-items: center; justify-content: space-between; font-size: 12.5px; color: var(--c-text-muted);">
        <span>Ingin menambah kuota slot konsultasi untuk siswa lain?</span>
        <a href="{{ route('psikolog.jadwal') }}" style="color: var(--c-primary); font-weight: 700; text-decoration:none;">+ Buka Slot Baru</a>
      </div>
    </div>
  </div>

  <!-- ======================== RIGHT: RINGKASAN AKTIVITAS ======================== -->
  <div class="psikolog-card">
    <div class="card-header-wrap">
      <div class="card-title-group">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-accent)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="20" x2="18" y2="10"></line>
          <line x1="12" y1="20" x2="12" y2="4"></line>
          <line x1="6" y1="20" x2="6" y2="14"></line>
        </svg>
        <span class="card-title-text">Ringkasan Aktivitas</span>
      </div>

      <span style="font-size: 12px; font-weight: 700; color: var(--c-text-muted); background: var(--c-bg); padding: 3px 8px; border-radius: 4px;">
        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
      </span>
    </div>

    <div class="card-body-content">
      <p style="font-size: 13px; color: var(--c-text-muted); margin-bottom: 16px;">
        Statistik ringkasan bimbingan dan layanan psikologi siswa.
      </p>

      <div class="stat-summary-vbox">
        <!-- 1. Permintaan Menunggu -->
        <div class="mini-stat-card">
          <div class="mini-stat-label-wrap">
            <div class="mini-stat-icon" style="background:#FFF9E6; color:#B48200;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
              <div class="mini-stat-name">Pengajuan Menunggu</div>
              <div style="font-size:11px; color:var(--c-text-muted);">Memerlukan persetujuan Anda</div>
            </div>
          </div>
          <div class="mini-stat-value">{{ $bookingBaruCount ?? 0 }} Sesi</div>
        </div>

        <!-- 2. Sesi Terjadwal -->
        <div class="mini-stat-card">
          <div class="mini-stat-label-wrap">
            <div class="mini-stat-icon" style="background:#EAF2F8; color:var(--c-primary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
            </div>
            <div>
              <div class="mini-stat-name">Sesi Terkonfirmasi</div>
              <div style="font-size:11px; color:#10B981; font-weight:700;">Jadwal Zoom Siap</div>
            </div>
          </div>
          <div class="mini-stat-value">{{ $sesiMendatangCount ?? 0 }} Sesi</div>
        </div>

        <!-- 3. Sesi Selesai -->
        <div class="mini-stat-card">
          <div class="mini-stat-label-wrap">
            <div class="mini-stat-icon" style="background:#EBFDF2; color:#027A48;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
              <div class="mini-stat-name">Konseling Tuntas</div>
              <div style="font-size:11px; color:var(--c-primary); font-weight:700;">Riwayat Evaluasi</div>
            </div>
          </div>
          <div class="mini-stat-value">{{ $sesiSelesaiCount ?? 0 }} Sesi</div>
        </div>
      </div>

      <!-- Quick Actions Grid -->
      <div class="quick-tools-grid" style="margin-top: 20px;">
        <a href="{{ route('psikolog.jadwal') }}" class="quick-tool-btn" style="text-decoration:none;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          Buka Slot Baru
        </a>
        <a href="{{ route('psikolog.riwayat') }}" class="quick-tool-btn" style="text-decoration:none;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
          Rekap Riwayat
        </a>
      </div>

    </div>
  </div>

</div>

@endsection
