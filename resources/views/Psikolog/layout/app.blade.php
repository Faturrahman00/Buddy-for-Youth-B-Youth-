<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>{{ $title ?? 'Portal Psikolog — Buddy For Youth (B-Youth)' }}</title>
  <meta name="description" content="Portal Konselor Psikolog B-Youth: Kelola Kuota Jadwal Konsultasi, Verifikasi Booking Siswa, dan Riwayat Evaluasi Rekomendasi Program Studi.">
  <meta name="theme-color" content="#30618C">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('foto/logo.png') }}">

  <!-- Google Fonts: Inter, Outfit, Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Flowbite CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <!-- Psikolog Portal Stylesheets -->
  <link rel="stylesheet" href="{{ asset('css/Psikolog/dashboard-psikolog.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Psikolog/pages-psikolog.css') }}">

  @stack('styles')
</head>
<body>

<div class="app-layout">
  <!-- Mobile Sidebar Backdrop Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar Component -->
  @include('Psikolog.components.sidebar', ['active' => $active ?? 'beranda'])

  <!-- Main Content Shell -->
  <div class="main-wrapper">
    <!-- Topbar Component -->
    @include('Psikolog.components.navbar', [
      'pageTitle' => $pageTitle ?? 'Beranda',
      'specTitle' => $specTitle ?? ''
    ])

    <!-- Page Content Container -->
    <main class="content-container">
      @yield('content')
    </main>
  </div>
</div>

<!-- Modals Component -->
@include('Psikolog.components.modals')

<!-- ApexCharts CDN for Analytics Charts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Flowbite JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<!-- Interaction Scripts -->
<script src="{{ asset('js/Psikolog/dashboard-psikolog.js') }}"></script>
<script src="{{ asset('js/Psikolog/pages-psikolog.js') }}"></script>

@stack('scripts')
</body>
</html>
