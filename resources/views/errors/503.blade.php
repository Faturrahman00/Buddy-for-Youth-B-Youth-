@extends('errors.layout')

@section('title', '503 — Pemeliharaan Sistem')
@section('code', '503')
@section('badge', 'Status 503 • Sistem Dalam Pemeliharaan')

@section('extra-styles')
<style>
  :root {
    --theme-color: #6366F1;
    --theme-subtle: #EEF2FF;
    --theme-border: rgba(99, 102, 241, 0.25);
    --theme-glow: rgba(99, 102, 241, 0.35);
    --theme-code-top: #C7D2FE;
    --theme-code-bot: #A5B4FC;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit Ring -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#6366F1" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#F2B705" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow503)" opacity="0.6"/>

  <!-- Maintenance Cone / Rocket Upgrade Base -->
  <path d="M120 45L145 125H95L120 45Z" fill="#F2B705" stroke="#DF9F00" stroke-width="2"/>
  <path d="M112 70L128 70L135 92L105 92L112 70Z" fill="#FFFFFF"/>
  <path d="M107 102L133 102L139 120L101 120L107 102Z" fill="#FFFFFF"/>

  <!-- Base Platform -->
  <rect x="85" y="125" width="70" height="10" rx="4" fill="#1E4A6E"/>

  <!-- Floating Cog Tools -->
  <circle cx="65" cy="75" r="16" fill="#EEF2FF" stroke="#6366F1" stroke-width="3"/>
  <circle cx="65" cy="75" r="5" fill="#6366F1"/>
  <path d="M65 55V60M65 90V95M45 75H50M80 75H85" stroke="#6366F1" stroke-width="3" stroke-linecap="round"/>

  <!-- Floating Wrench / Screwdriver -->
  <circle cx="175" cy="80" r="15" fill="#EEF2FF" stroke="#30618C" stroke-width="2.5"/>
  <path d="M170 75L180 85M170 85L180 75" stroke="#30618C" stroke-width="3" stroke-linecap="round"/>

  <!-- Pulse Status Radar -->
  <circle cx="120" cy="45" r="7" fill="#6366F1"/>
  <circle cx="120" cy="45" r="12" stroke="#6366F1" stroke-width="1.5" opacity="0.6"/>

  <!-- Floating Sparkles & Dots -->
  <circle cx="48" cy="120" r="3.5" fill="#6366F1" opacity="0.8"/>
  <circle cx="195" cy="120" r="4" fill="#F2B705"/>
  <circle cx="185" cy="45" r="3" fill="#6366F1" opacity="0.8"/>

  <!-- Sparkle Icons -->
  <path d="M72 38L73.5 42.5L78 44L73.5 45.5L72 50L70.5 45.5L66 44L70.5 42.5L72 38Z" fill="#F2B705"/>
  <path d="M168 135L169.5 139.5L174 141L169.5 142.5L168 147L166.5 142.5L162 141L166.5 139.5L168 135Z" fill="#6366F1"/>

  <defs>
    <radialGradient id="glow503" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#818CF8" stop-opacity="0.5"/>
      <stop offset="100%" stop-color="#6366F1" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Layanan Sedang Ditingkatkan')

@section('message')
  Kami sedang melakukan pemeliharaan rutin dan peningkatan performa sistem di platform B-Youth agar pengalaman belajar, asesmen, dan konseling Anda semakin lancar dan optimal.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Informasi Pemeliharaan:</div>
    <div class="error-callout-text">
      <ul>
        <li>Peningkatan server dan pembaruan keamanan sedang berlangsung.</li>
        <li>Proses ini diperkirakan memakan waktu beberapa saat saja.</li>
        <li>Anda dapat mencoba menekan tombol segarkan di bawah untuk memeriksa kesiapan layanan.</li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('actions')
  <button type="button" onclick="window.location.reload()" class="btn-action-primary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
    </svg>
    Segarkan Halaman
  </button>

  <a href="{{ url('/') }}" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Kembali ke Beranda
  </a>
@endsection
