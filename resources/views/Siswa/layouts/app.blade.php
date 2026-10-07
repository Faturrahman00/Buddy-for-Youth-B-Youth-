<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>{{ $title ?? 'Dashboard Siswa — Buddy For Youth (B-Youth)' }}</title>
  <meta name="description" content="Dashboard Siswa Portal B-Youth: Rekomendasi Program Studi Berbasis AI & Konseling Psikologi Pendidikan">
  <meta name="theme-color" content="#30618C">

  <!-- Favicon -->
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%2330618C'/%3E%3Cpolygon points='16,7 26,12 16,17 6,12' fill='%23F2B705'/%3E%3Cpath d='M9 14.5v5c0 2 3.1 3.5 7 3.5s7-1.5 7-3.5v-5' fill='none' stroke='%23FFFFFF' stroke-width='2'/%3E%3C/svg%3E">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Flowbite CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <!-- Separated Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/Siswa/dashboard-siswa.css') }}">

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
    @include('Siswa.components.navbar')

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

@stack('scripts')
</body>
</html>
