@php
    $active = $active ?? 'beranda';
@endphp

<aside class="sidebar" id="sidebar" aria-label="Sidebar Admin">
  <div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="brand-link" style="display:flex; align-items:center; gap:10px; text-decoration:none; flex:1; min-width:0;">
      <div class="brand-logo-img" style="width:36px; height:36px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
        <img src="{{ asset('foto/logo.png') }}" alt="Buddy For Youth Logo" style="width:100%; height:100%; object-fit:contain;">
      </div>
      <div class="brand-info" style="display:flex; flex-direction:column; min-width:0; overflow:hidden; flex-shrink:0;">
        <div class="brand-title" style="display:flex; align-items:center; gap:6px; white-space:nowrap; flex-shrink:0;">
          <span class="brand-name" style="white-space:nowrap !important; font-weight:800; color:var(--c-primary); flex-shrink:0;">B&#8209;Youth</span>
          <span class="brand-badge" style="white-space:nowrap !important; flex-shrink:0;">Admin</span>
        </div>
        <span class="brand-subtitle" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-size:11px; color:var(--c-text-muted); line-height:1.2; margin-top:2px;">Buddy For Youth Portal</span>
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
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ $active === 'beranda' ? 'active' : '' }}" title="Beranda Dashboard">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
        <polyline points="9 22 9 12 15 12 15 22"></polyline>
      </svg>
      <span>Beranda</span>
      @if($active === 'beranda')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 2. Kelola Akun Pengguna -->
    <a href="{{ route('admin.pengguna') }}" class="nav-item {{ $active === 'kelola-pengguna' ? 'active' : '' }}" title="Kelola Akun Pengguna">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
        <circle cx="9" cy="7" r="4"></circle>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      </svg>
      <span>Kelola Akun Pengguna</span>
      @if($active === 'kelola-pengguna')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 3. Kelola Program Studi -->
    <a href="{{ route('admin.prodi') }}" class="nav-item {{ $active === 'kelola-prodi' ? 'active' : '' }}" title="Kelola Program Studi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
        <line x1="8" y1="6" x2="16" y2="6"></line>
        <line x1="8" y1="10" x2="16" y2="10"></line>
      </svg>
      <span>Kelola Program Studi</span>
      @if($active === 'kelola-prodi')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 4. Kelola Asesmen -->
    <a href="{{ route('admin.asesmen') }}" class="nav-item {{ $active === 'kelola-asesmen' ? 'active' : '' }}" title="Kelola Asesmen">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
      </svg>
      <span>Kelola Asesmen</span>
      @if($active === 'kelola-asesmen')
        <span class="nav-indicator-dot" title="Halaman Aktif"></span>
      @endif
    </a>

    <!-- 5. Profil -->
    <a href="{{ route('admin.profil') }}" class="nav-item {{ $active === 'profil' ? 'active' : '' }}" title="Profil Admin">
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

  <!-- Sidebar Footer: Keluar -->
  <div class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">
        @csrf
    </form>
    <button type="button" class="logout-btn" title="Keluar dari akun" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <div class="logout-label-group">
        <span>Keluar</span>
      </div>
      <svg class="logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
    </button>
  </div>
</aside>
