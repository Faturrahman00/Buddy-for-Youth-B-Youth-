<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>{{ $title ?? 'Dashboard Admin — Buddy For Youth (B-Youth)' }}</title>
  <meta name="description" content="Dashboard Admin Portal B-Youth">
  <meta name="theme-color" content="#30618C">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('foto/logo.png') }}">

  <!-- Google Fonts: Inter, Outfit, Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Flowbite CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <!-- Separated Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/Admin/dashboard-admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Admin/pages-admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/byouth-dialog.css') }}">

  @stack('styles')
</head>
<body>

<div class="app-layout">
  <!-- Mobile Sidebar Backdrop Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar Component -->
  @include('Admin.components.sidebar', ['active' => $active ?? 'beranda'])

  <!-- Main Content Wrapper -->
  <div class="main-wrapper">
    <!-- Topbar / Navbar Component -->
    @include('Admin.components.navbar', ['pageTitle' => $pageTitle ?? 'Beranda'])

    <!-- Page Content Container -->
    <main class="content-container">
      @yield('content')
    </main>
  </div>
</div>

<!-- Modals Component (To be added later as requested) -->

<!-- SweetAlert2 & B-Youth Dialog -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/byouth-dialog.js') }}"></script>

<!-- Flowbite JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<!-- Dashboard Interaction Script -->
<script src="{{ asset('js/Admin/dashboard-admin.js') }}"></script>
<script src="{{ asset('js/Admin/pages-admin.js') }}"></script>

@stack('scripts')

{{-- Flash Messages → Bottom-Right Toast --}}
@if(session('success') || session('error') || session('warning') || session('info') || $errors->any())
<script>
document.addEventListener('DOMContentLoaded', function() {
  @if(session('success'))
    window.byouthToast({ type: 'success', message: @json(session('success')) });
  @endif
  @if(session('error'))
    window.byouthToast({ type: 'error', message: @json(session('error')) });
  @endif
  @if(session('warning'))
    window.byouthToast({ type: 'warning', message: @json(session('warning')) });
  @endif
  @if(session('info'))
    window.byouthToast({ type: 'info', message: @json(session('info')) });
  @endif
  @if($errors->any())
    window.byouthToast({ type: 'error', message: 'Terdapat kesalahan pada input. Silakan periksa kembali.', duration: 5000 });
  @endif
});
</script>
@endif
</body>
</html>
