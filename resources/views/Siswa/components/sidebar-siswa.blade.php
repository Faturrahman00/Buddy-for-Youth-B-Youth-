{{-- 
  B-YOUTH: SIDEBAR SISWA COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/sidebar-siswa.blade.php
--}}
@php
    $active = $active ?? 'beranda';
@endphp

<aside class="sidebar" id="sidebar" aria-label="Sidebar Siswa">
  <!-- Brand / Logo Area -->
  <div class="sidebar-brand">
    <div class="brand-icon-box" title="Buddy For Youth Logo">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
        <path d="M2 17l10 5 10-5"></path>
        <path d="M2 12l10 5 10-5"></path>
      </svg>
    </div>
    <div class="brand-info">
      <div class="brand-title">
        B-Youth <span class="brand-badge">Siswa</span>
      </div>
      <span class="brand-subtitle">Buddy For Youth Portal</span>
    </div>
  </div>

  <!-- Navigation Menu List -->
  <nav class="sidebar-nav">
    <!-- 1. Beranda -->
    <a href="{{ route('dashboard_siswa') }}" class="nav-item {{ $active === 'beranda' ? 'active' : '' }}" title="Beranda Dashboard">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
        <polyline points="9 22 9 12 15 12 15 22"></polyline>
      </svg>
      <span>Beranda</span>
    </a>

    <!-- 2. Data Akademik -->
    <a href="{{ route('siswa.akademik') }}" class="nav-item {{ $active === 'akademik' ? 'active' : '' }}" title="Data Akademik">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
        <line x1="8" y1="6" x2="16" y2="6"></line>
        <line x1="8" y1="10" x2="16" y2="10"></line>
      </svg>
      <span>Data Akademik</span>
    </a>

    <!-- 3. Asesmen & Rekomendasi -->
    <a href="{{ route('siswa.asesmen') }}" class="nav-item {{ $active === 'asesmen' ? 'active' : '' }}" title="Asesmen & Rekomendasi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
      </svg>
      <span>Asesmen & Rekomendasi</span>
    </a>

    <!-- 4. Riwayat Asesmen -->
    <a href="{{ route('siswa.riwayat_asesmen') }}" class="nav-item {{ $active === 'riwayat-asesmen' ? 'active' : '' }}" title="Riwayat Asesmen">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
      <span>Riwayat Asesmen</span>
    </a>

    <!-- 5. Konsultasi -->
    <a href="{{ route('siswa.konsultasi') }}" class="nav-item {{ $active === 'konsultasi' ? 'active' : '' }}" title="Konsultasi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
      </svg>
      <span>Konsultasi</span>
    </a>

    <!-- 6. Riwayat Konsultasi -->
    <a href="{{ route('siswa.riwayat_konsultasi') }}" class="nav-item {{ $active === 'riwayat-konsultasi' ? 'active' : '' }}" title="Riwayat Konsultasi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
        <path d="M9 16l2 2 4-4"></path>
      </svg>
      <span>Riwayat Konsultasi</span>
    </a>

    <!-- 7. Profil -->
    <a href="{{ route('siswa.profil') }}" class="nav-item {{ $active === 'profil' ? 'active' : '' }}" title="Profil Siswa">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <!-- Sidebar Footer: Keluar -->
  <div class="sidebar-footer">
    <button type="button" class="logout-btn" id="btnLogoutTrigger" data-modal-target="modalLogout" data-modal-toggle="modalLogout" title="Keluar dari akun">
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
