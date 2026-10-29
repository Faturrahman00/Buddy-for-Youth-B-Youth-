@extends('errors.layout')

@section('title', '500 — Kesalahan Server Internal')
@section('code', '500')
@section('badge', 'Status 500 • Terjadi Gangguan Server')

@section('extra-styles')
<style>
  :root {
    --theme-color: #DC2626;
    --theme-subtle: #FEF2F2;
    --theme-border: rgba(220, 38, 38, 0.25);
    --theme-glow: rgba(220, 38, 38, 0.35);
    --theme-code-top: #FECACA;
    --theme-code-bot: #F87171;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit & Circuit Lines -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#DC2626" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#F2B705" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow500)" opacity="0.6"/>

  <!-- Server Tower Silhouette -->
  <!-- Top Unit -->
  <rect x="85" y="52" width="70" height="22" rx="6" fill="#FFFFFF" stroke="#DC2626" stroke-width="2.5"/>
  <circle cx="95" cy="63" r="3" fill="#10B981"/>
  <circle cx="104" cy="63" r="3" fill="#DC2626"/>
  <line x1="116" y1="63" x2="145" y2="63" stroke="#CBD5E1" stroke-width="2.5" stroke-linecap="round"/>

  <!-- Middle Unit -->
  <rect x="85" y="79" width="70" height="22" rx="6" fill="#FFFFFF" stroke="#1E4A6E" stroke-width="2.5"/>
  <circle cx="95" cy="90" r="3" fill="#F2B705"/>
  <circle cx="104" cy="90" r="3" fill="#30618C"/>
  <line x1="116" y1="90" x2="145" y2="90" stroke="#CBD5E1" stroke-width="2.5" stroke-linecap="round"/>

  <!-- Bottom Unit -->
  <rect x="85" y="106" width="70" height="22" rx="6" fill="#FFFFFF" stroke="#DC2626" stroke-width="2.5"/>
  <circle cx="95" cy="117" r="3" fill="#DC2626"/>
  <circle cx="104" cy="117" r="3" fill="#CBD5E1"/>
  <line x1="116" y1="117" x2="145" y2="117" stroke="#CBD5E1" stroke-width="2.5" stroke-linecap="round"/>

  <!-- Floating Gear Tool -->
  <circle cx="165" cy="65" r="14" fill="#F2B705" opacity="0.9"/>
  <circle cx="165" cy="65" r="6" fill="#FFFFFF"/>
  <path d="M165 48V53M165 77V82M148 65H153M177 65H182" stroke="#F2B705" stroke-width="3" stroke-linecap="round"/>

  <!-- Small Warning Alert Beacon -->
  <circle cx="75" cy="62" r="11" fill="#DC2626" stroke="#FFFFFF" stroke-width="2"/>
  <text x="75" y="66" text-anchor="middle" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#FFFFFF">!</text>

  <!-- Floating Sparkles & Dots -->
  <circle cx="48" cy="110" r="3.5" fill="#DC2626" opacity="0.8"/>
  <circle cx="195" cy="115" r="4" fill="#30618C"/>
  <circle cx="180" cy="40" r="3" fill="#F2B705" opacity="0.8"/>

  <!-- Sparkle Icons -->
  <path d="M65 38L66.5 42.5L71 44L66.5 45.5L65 50L63.5 45.5L59 44L63.5 42.5L65 38Z" fill="#DC2626"/>
  <path d="M180 135L181.5 139.5L186 141L181.5 142.5L180 147L178.5 142.5L174 141L178.5 139.5L180 135Z" fill="#F2B705"/>

  <defs>
    <radialGradient id="glow500" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#DC2626" stop-opacity="0.45"/>
      <stop offset="100%" stop-color="#DC2626" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Terjadi Kesalahan pada Server')

@section('message')
  Mohon maaf, sistem kami sedang mengalami kendala internal tak terduga saat memproses data Anda. Tim teknis B-Youth telah menerima laporan otomatis mengenai kendala ini.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Apa yang dapat Anda lakukan?</div>
    <div class="error-callout-text">
      <ul>
        <li>Klik tombol <strong>"Muat Ulang Halaman"</strong> di bawah, kendala ini biasanya bersifat sementara.</li>
        <li>Jika Anda baru saja mengirim formulir atau asesmen, periksa riwayat Anda di dashboard setelah memuat ulang.</li>
        <li>Data akun Anda tetap aman dan terlindungi di server kami.</li>
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
    Muat Ulang Halaman
  </button>

  <a href="{{ url('/') }}" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Kembali ke Beranda
  </a>

  <button type="button" onclick="history.back()" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    Halaman Sebelumnya
  </button>
@endsection
