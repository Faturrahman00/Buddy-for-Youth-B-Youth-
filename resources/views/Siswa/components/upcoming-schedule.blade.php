{{-- 
  B-YOUTH: UPCOMING SCHEDULE COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/upcoming-schedule.blade.php
--}}
<div class="upcoming-container">
  <h2 class="upcoming-title">Jadwal Mendatang</h2>

  @if(!empty($upcomingKonsultasi))
    @php
      $tgl = \Carbon\Carbon::parse($upcomingKonsultasi->tanggal_konsultasi);
      $diffDays = now()->startOfDay()->diffInDays($tgl->startOfDay(), false);
      if ($diffDays === 0) {
          $ribbonText = 'Hari Ini';
      } elseif ($diffDays === 1) {
          $ribbonText = 'Besok';
      } elseif ($diffDays > 1) {
          $ribbonText = $diffDays . ' Hari Lagi';
      } else {
          $ribbonText = 'Jadwal Hari Ini';
      }
      $psikologNama = $upcomingKonsultasi->psikolog->nama ?? 'Psikolog B-Youth';
      $initialsPsikolog = strtoupper(substr($psikologNama, 0, 2));
    @endphp

    <div class="upcoming-card-box">
      <span class="upcoming-tag-ribbon">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        {{ $ribbonText }}
      </span>

      <div class="counselor-profile">
        <div class="counselor-avatar">
          {{ $initialsPsikolog }}
        </div>
        <div class="counselor-info">
          <span class="counselor-name">{{ $psikologNama }}</span>
          <span class="counselor-role">{{ $upcomingKonsultasi->psikolog->spesialisasi ?? 'Psikolog Pendidikan' }}</span>
        </div>
      </div>

      <div class="upcoming-meta-list">
        <div class="meta-row">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span><strong>{{ $tgl->translatedFormat('l, d F Y') }}</strong></span>
        </div>
        <div class="meta-row">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>{{ substr($upcomingKonsultasi->waktu_mulai, 0, 5) }} - {{ substr($upcomingKonsultasi->waktu_selesai, 0, 5) }} WIB</span>
        </div>
        <div class="meta-row">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 10l5-5-5-5v3H9a6 6 0 0 0-6 6v3h3v-3a3 3 0 0 1 3-3h6v3z"/>
          </svg>
          <span>Status: <strong>{{ ucfirst($upcomingKonsultasi->status_booking) }}</strong> {{ $upcomingKonsultasi->catatan ? '• ' . Str::limit($upcomingKonsultasi->catatan, 45) : '' }}</span>
        </div>
      </div>

      <div style="margin-top: 14px; padding-top: 12px; border-top: 1px dashed var(--c-border-light); display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('siswa.riwayat_konsultasi') }}" style="font-size: 12.5px; font-weight: 700; color: var(--c-primary); text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
          <span>Lihat Detail &amp; Catatan Lengkap</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </a>
        @if(!empty($upcomingKonsultasi->link_zoom) && $upcomingKonsultasi->status_booking === 'disetujui')
          <a href="{{ $upcomingKonsultasi->link_zoom }}" target="_blank" style="font-size: 12px; font-weight: 700; color: #175CD3; background: #EFF8FF; border: 1px solid #B2DDFF; padding: 4px 10px; border-radius: 6px; text-decoration: none;">
            Buka Zoom
          </a>
        @endif
      </div>
    </div>
  @else
    <div class="upcoming-card-box" style="text-align: center; padding: 28px 20px;">
      <div style="width: 48px; height: 48px; background: rgba(48,97,140,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; color: var(--c-primary);">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
      </div>
      <h4 style="margin: 0 0 6px; font-size: 15px; font-weight: 700; color: var(--c-text-heading);">Belum Ada Jadwal Aktif</h4>
      <p style="margin: 0 0 18px; font-size: 13px; color: var(--c-text-muted);">Jadwalkan sesi bimbingan 1-on-1 dengan psikolog pendidikan pilihanmu sekarang.</p>
    </div>
  @endif

  <!-- Primary Action: Langsung ke Halaman Konsultasi -->
  <a href="{{ route('siswa.konsultasi') }}" class="btn-booking-new">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <line x1="12" y1="5" x2="12" y2="19"></line>
      <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
    <span>Jadwalkan Konsultasi Baru</span>
  </a>
</div>
