{{-- 
  B-YOUTH: DASHBOARD SISWA PAGE
  File: resources/views/Siswa/page/dashboard_siswa.blade.php
--}}
@extends('Siswa.layouts.app', [
    'title' => 'Dashboard Siswa — Buddy For Youth (B-Youth)',
    'active' => 'beranda'
])

@section('content')
  <!-- 1. Welcome Banner Card -->
  @include('Siswa.components.welcome-banner')

  <!-- 2. 4 Summary Cards Row -->
  @include('Siswa.components.summary-cards')

  <!-- 3. Lower Section: Roadmap Next Steps + Upcoming Schedule -->
  <section class="dashboard-lower-grid">
    <!-- Left Column: Selesaikan Langkah Selanjutnya -->
    @include('Siswa.components.next-steps')

    <!-- Right Column: Jadwal Mendatang & Booking Konsultasi -->
    @include('Siswa.components.upcoming-schedule')
  </section>
@endsection
