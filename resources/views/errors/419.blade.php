@extends('errors.layout')

@section('title', '419 — Sesi Kedaluwarsa')
@section('code', '419')
@section('badge', 'Status 419 • Sesi Token Kedaluwarsa')

@section('extra-styles')
<style>
  :root {
    --theme-color: #D97706;
    --theme-subtle: #FFFBEB;
    --theme-border: rgba(217, 119, 6, 0.25);
    --theme-glow: rgba(217, 119, 6, 0.35);
    --theme-code-top: #FDE68A;
    --theme-code-bot: #FCD34D;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit & Refresh Arrows -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#D97706" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#30618C" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow419)" opacity="0.6"/>

  <!-- Hourglass / Clock Base -->
  <circle cx="120" cy="90" r="44" fill="#FFFFFF" stroke="#D97706" stroke-width="3.5"/>
  <circle cx="120" cy="90" r="37" fill="#FFFBEB"/>

  <!-- Clock Ticks & Hands -->
  <circle cx="120" cy="90" r="3" fill="#1E4A6E"/>
  <line x1="120" y1="90" x2="120" y2="68" stroke="#1E4A6E" stroke-width="3.5" stroke-linecap="round"/>
  <line x1="120" y1="90" x2="136" y2="90" stroke="#D97706" stroke-width="3" stroke-linecap="round"/>

  <!-- Rotating Refresh Loop Indicator -->
  <path d="M152 70C158 78 160 88 158 98C155 110 146 120 134 125" 
        stroke="#30618C" stroke-width="3" stroke-linecap="round" stroke-dasharray="6 4"/>
  <polygon points="132,120 126,128 136,132" fill="#30618C"/>

  <path d="M88 110C82 102 80 92 82 82C85 70 94 60 106 55" 
        stroke="#F2B705" stroke-width="3" stroke-linecap="round" stroke-dasharray="6 4"/>
  <polygon points="108,60 114,52 104,48" fill="#F2B705"/>

  <!-- Small Exclamation Alert Bubble -->
  <circle cx="152" cy="62" r="10" fill="#D97706" stroke="#FFFFFF" stroke-width="2"/>
  <text x="152" y="66" text-anchor="middle" font-family="'Outfit', sans-serif" font-size="11" font-weight="900" fill="#FFFFFF">!</text>

  <!-- Floating Sparkles & Dots -->
  <circle cx="48" cy="65" r="3.5" fill="#D97706" opacity="0.8"/>
  <circle cx="192" cy="70" r="4" fill="#30618C"/>
  <circle cx="180" cy="120" r="3" fill="#F2B705" opacity="0.8"/>
  <circle cx="58" cy="122" r="4" fill="#D97706" opacity="0.6"/>

  <!-- Sparkle Icons -->
  <path d="M72 40L73.5 44.5L78 46L73.5 47.5L72 52L70.5 47.5L66 46L70.5 44.5L72 40Z" fill="#F2B705"/>
  <path d="M174 42L175.5 46.5L180 48L175.5 49.5L174 54L172.5 49.5L168 48L172.5 46.5L174 42Z" fill="#30618C"/>

  <defs>
    <radialGradient id="glow419" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#F2B705" stop-opacity="0.5"/>
      <stop offset="100%" stop-color="#D97706" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Sesi Halaman Telah Kedaluwarsa')

@section('message')
  Halaman ini telah tidak aktif dalam waktu yang cukup lama sehingga token keamanan (CSRF Token) telah kedaluwarsa demi melindungi keamanan data akun Anda.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Cara mudah mengatasinya:</div>
    <div class="error-callout-text">
      <ul>
        <li>Klik tombol <strong>"Muat Ulang Halaman"</strong> di bawah untuk memperbarui sesi keamanan Anda.</li>
        <li>Setelah halaman dimuat ulang, Anda dapat langsung mengulangi pengiriman formulir.</li>
        <li>Jika Anda baru saja membuka halaman formulir setelah ditinggal lama, silakan masuk kembali ke akun Anda.</li>
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

  <a href="{{ route('login') }}" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
    </svg>
    Masuk Kembali
  </a>
@endsection
