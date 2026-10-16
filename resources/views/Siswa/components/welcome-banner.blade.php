{{-- 
  B-YOUTH: WELCOME BANNER COMPONENT
  File: resources/views/Siswa/components/welcome-banner.blade.php
--}}
<section class="welcome-banner">
  <div class="welcome-details">
    <p class="welcome-lead">Selamat datang kembali,</p>
    <h2 class="welcome-name">
      {{ Auth::check() ? (Auth::user()->nama ?? Auth::user()->name) : 'Ahmad Rizky Pratama' }}
    </h2>
    <p class="welcome-school">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--c-primary);">
        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
      </svg>
      <span class="school-tag">{{ Auth::check() ? (Auth::user()->sekolah ?? 'SMAN 1 Jakarta') : 'SMAN 1 Jakarta' }}</span> &bull; 
      <span>{{ Auth::check() ? (Auth::user()->kelas ?? 'Kelas XII') : 'Kelas XII' }}</span>
    </p>
  </div>

  <div class="welcome-meta">
    <div class="meta-label">Bergabung Sejak</div>
    <div class="meta-value">{{ Auth::check() && Auth::user()->created_at ? Auth::user()->created_at->translatedFormat('d F Y') : '14 Juli 2024' }}</div>
    <div class="meta-status">
      <span class="meta-status-dot"></span>
      Status: Siswa {{ Auth::check() ? (Auth::user()->status ?? 'Aktif') : 'Aktif' }}
    </div>
  </div>
</section>
