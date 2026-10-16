<header class="topbar">
  <div class="topbar-left">
    <button type="button" class="menu-toggle-btn" id="menuToggle" aria-label="Buka Menu Sidebar">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>
    <div style="display:flex; align-items:center; gap:10px;">
      <a href="{{ route('admin.dashboard') }}" style="display:inline-flex; align-items:center; text-decoration:none;" title="Buddy For Youth Admin">
        <img src="{{ asset('foto/logo.png') }}" alt="Logo B-Youth" style="width:30px; height:30px; object-fit:contain;">
      </a>
      <h1 class="topbar-title">{{ $pageTitle ?? 'Beranda' }}</h1>
    </div>
  </div>

  <div class="topbar-right">
    <!-- User profile preview box -->
    <div class="topbar-user" title="Profil Admin">
      <div class="user-text">
        <div class="user-name-small">{{ Auth::check() ? Auth::user()->name : 'Admin: Super' }}</div>
        <div class="user-role-small">{{ Auth::check() ? ucfirst(Auth::user()->role) : 'Administrator' }}</div>
      </div>
      <div class="avatar-box">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </div>
    </div>
  </div>
</header>
