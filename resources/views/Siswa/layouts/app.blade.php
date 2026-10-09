<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>{{ $title ?? 'Dashboard Siswa — Buddy For Youth (B-Youth)' }}</title>
  <meta name="description" content="Dashboard Siswa Portal B-Youth: Rekomendasi Program Studi & Konseling Psikologi Pendidikan">
  <meta name="theme-color" content="#30618C">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('foto/logo.png') }}">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Flowbite CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <!-- Separated Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/Siswa/dashboard-siswa.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Siswa/pages-siswa.css') }}">

  @stack('styles')
</head>
<body>

<div class="app-layout">
  <!-- Mobile Sidebar Backdrop Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar Component -->
  @include('Siswa.components.sidebar-siswa', ['active' => $active ?? 'beranda'])

  <!-- Main Content Wrapper -->
  <div class="main-wrapper">
    <!-- Topbar / Navbar Component -->
    @include('Siswa.components.navbar', ['pageTitle' => $pageTitle ?? 'Beranda'])

    <!-- Page Content Container -->
    <main class="content-container">
      @yield('content')
    </main>
  </div>
</div>

<!-- Modals Component -->
@include('Siswa.components.modals')

<!-- Flowbite JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<!-- Dashboard Interaction Script -->
<script src="{{ asset('js/Siswa/dashboard-siswa.js') }}"></script>
<script src="{{ asset('js/Siswa/pages-siswa.js') }}"></script>

<!-- Glassmorphism Clean Loading Overlay -->
<div class="glass-loading-overlay" id="glassLoadingOverlay" aria-hidden="true">
  <div class="glass-loading-card">
    <div class="glass-spinner">
      <div class="spinner-ring outer"></div>
      <div class="spinner-ring inner"></div>
      <div class="spinner-core"></div>
    </div>
    <div class="glass-loading-text" id="glassLoadingText">Memproses data...</div>
    <div class="glass-loading-sub" id="glassLoadingSub">Mohon tunggu sebentar</div>
  </div>
</div>

<!-- Glassmorphism Toast Notification Container (Berhasil & Gagal) -->
<div class="app-toast-container" id="appToastContainer" aria-live="polite"></div>

@stack('scripts')
</body>
</html>
