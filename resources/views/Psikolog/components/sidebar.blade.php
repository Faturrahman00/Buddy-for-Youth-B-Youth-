@php
    $active = $active ?? 'beranda';
    $pendingCount = 0;
    try {
        $currentPsikologId = Auth::guard('psikolog')->id() ?? Auth::id();
        if ($currentPsikologId) {
            $pendingCount = \App\Models\Konsultasi::where('id_psikolog', $currentPsikologId)->where('status_booking', 'menunggu')->count();
        }
    } catch (\Throwable $e) {}
@endphp

<aside class="sidebar" id="sidebar" aria-label="Sidebar Psikolog">
  <div class="sidebar-brand">
    <a href="{{ route('psikolog.dashboard') }}" class="brand-link" style="display:flex; align-items:center; gap:10px; text-decoration:none; flex:1; min-width:0;">
      <div class="brand-logo-img" style="width:36px; height:36px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
        <img src="{{ asset('foto/logo.png') }}" alt="Buddy For Youth Logo" style="width:100%; height:100%; object-fit:contain;">
      </div>
      <div class="brand-info" style="display:flex; flex-direction:column; min-width:0; overflow:hidden; flex-shrink:0;">
        <div class="brand-title" style="display:flex; align-items:center; gap:6px; white-space:nowrap; flex-shrink:0;">
          <span class="brand-name" style="white-space:nowrap !important; font-weight:800; color:var(--c-primary); flex-shrink:0;">B&#8209;Youth</span>
          <span class="brand-badge" style="white-space:nowrap !important; flex-shrink:0;">Psikolog</span>
        </div>
        <span class="brand-subtitle" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-size:11px; color:var(--c-text-muted); line-height:1.2; margin-top:2px;" title="Konseling & Validasi Karier">Konseling &amp; Validasi Karier</span>
      </div>
    </a>
    <!-- Tombol Tutup Sidebar untuk Layar HP / Kecil -->
    <button type="button" class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Tutup menu sidebar" title="Tutup menu">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <!-- Navigation Menu List -->
  <nav class="sidebar-nav">
    <!-- 1. Beranda -->
    <a href="{{ route('psikolog.dashboard') }}" class="nav-item {{ $active === 'beranda' ? 'active' : '' }}" title="Beranda Psikolog">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
        <polyline points="9 22 9 12 15 12 15 22"></polyline>
      </svg>
      <span>Beranda</span>
      @if($active === 'beranda')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 2. Kelola Jadwal Konsultasi -->
    <a href="{{ route('psikolog.jadwal') }}" class="nav-item {{ $active === 'jadwal' ? 'active' : '' }}" title="Kelola Jadwal Konsultasi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      <span>Kelola Jadwal Konsultasi</span>
      @if($pendingCount > 0)
        <span class="nav-badge-count" title="{{ $pendingCount }} Pengajuan Menunggu">{{ $pendingCount }}</span>
      @elseif($active === 'jadwal')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 3. Riwayat Konsultasi -->
    <a href="{{ route('psikolog.riwayat') }}" class="nav-item {{ $active === 'riwayat' ? 'active' : '' }}" title="Riwayat Konsultasi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
        <polyline points="10 9 9 9 8 9"></polyline>
      </svg>
      <span>Riwayat Konsultasi</span>
      @if($active === 'riwayat')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 4. Profil -->
    <a href="{{ route('psikolog.profil') }}" class="nav-item {{ $active === 'profil' ? 'active' : '' }}" title="Profil Psikolog">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
      <span>Profil</span>
      @if($active === 'profil')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>
  </nav>

  <!-- Sidebar Footer: Keluar (Matches Wireframe [KELUAR]) -->
  <div class="sidebar-footer">
    <button type="button" class="logout-btn" title="Keluar dari akun Psikolog" data-open-modal="modalLogout">
      <span>Keluar</span>
      <svg class="logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
    </button>
  </div>
</aside>
