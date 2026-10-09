{{-- 
  B-YOUTH: TOPBAR / NAVBAR SISWA COMPONENT
  File: resources/views/Siswa/components/navbar.blade.php
--}}
<header class="topbar">
  <div class="topbar-left">
    <button type="button" class="menu-toggle-btn" id="menuToggle" aria-label="Buka Menu Sidebar">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>
    <h1 class="topbar-title">{{ $pageTitle ?? 'Beranda' }}</h1>
  </div>

  <div class="topbar-right">
    <!-- Date pill -->
    <div class="topbar-date-pill">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
    </div>

    <!-- User profile preview box -->
    <div class="topbar-user" title="Profil Siswa">
      <div class="user-text">
        <div class="user-name-small">Ahmad Rizky Pratama</div>
        <div class="user-role-small">Siswa SMA</div>
      </div>
      <div class="avatar-box">
        AR
      </div>
    </div>
  </div>
</header>
