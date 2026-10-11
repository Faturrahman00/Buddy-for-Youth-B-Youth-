<header class="topbar">
  <div class="topbar-left">
    <!-- Hamburger button for mobile -->
    <button type="button" class="menu-toggle-btn" id="menuToggle" aria-label="Buka Menu Sidebar">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>

    <div class="topbar-title-group">
      <h1 class="topbar-title">{{ $pageTitle ?? 'Beranda' }}</h1>
      @if(!empty($specTitle))
        <span class="topbar-spec-badge" title="{{ $specTitle }}">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
          {{ $specTitle }}
        </span>
      @endif
    </div>
  </div>

  <div class="topbar-right">
    <!-- User profile box matching Wireframe (Psikolog: Maya) -->
    <a href="{{ route('psikolog.profil') }}" class="topbar-user" title="Lihat Profil Psikolog Maya">
      <div class="user-text">
        <div class="user-name-small">Psikolog: Maya</div>
        <div class="user-role-small">Konselor Pendidikan</div>
      </div>
      <div class="avatar-box">
        MI
        <span class="avatar-status-dot" title="Online"></span>
      </div>
    </a>
  </div>
</header>
