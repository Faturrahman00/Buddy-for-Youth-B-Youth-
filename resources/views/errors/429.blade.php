@extends('errors.layout')

@section('title', '429 — Terlalu Banyak Permintaan')
@section('code', '429')
@section('badge', 'Status 429 • Terlalu Banyak Permintaan')

@section('extra-styles')
<style>
  :root {
    --theme-color: #EA580C;
    --theme-subtle: #FFF7ED;
    --theme-border: rgba(234, 88, 12, 0.25);
    --theme-glow: rgba(234, 88, 12, 0.35);
    --theme-code-top: #FED7AA;
    --theme-code-bot: #FDBA74;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit Ring -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#EA580C" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#F2B705" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow429)" opacity="0.6"/>

  <!-- Speedometer Semi-circle Base -->
  <path d="M78 115A52 52 0 1 1 162 115" stroke="#E2E8F0" stroke-width="10" stroke-linecap="round"/>
  <!-- Active Arc (Red/Orange zone) -->
  <path d="M120 48A52 52 0 0 1 162 115" stroke="#EA580C" stroke-width="10" stroke-linecap="round"/>

  <!-- Speedometer Center Hub -->
  <circle cx="120" cy="115" r="8" fill="#1E4A6E"/>
  <!-- Needle pointing to the right (overlimit) -->
  <line x1="120" y1="115" x2="150" y2="75" stroke="#EA580C" stroke-width="4" stroke-linecap="round"/>

  <!-- Floating Hourglass / Timer -->
  <circle cx="65" cy="70" r="14" fill="#FFF7ED" stroke="#EA580C" stroke-width="2.5"/>
  <path d="M60 64H70M60 76H70M60 64L70 76M70 64L60 76" stroke="#EA580C" stroke-width="2" stroke-linecap="round"/>

  <!-- Warning Badge -->
  <circle cx="165" cy="65" r="11" fill="#EA580C" stroke="#FFFFFF" stroke-width="2"/>
  <text x="165" y="69" text-anchor="middle" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#FFFFFF">!</text>

  <!-- Floating Sparkles & Dots -->
  <circle cx="50" cy="120" r="3.5" fill="#EA580C" opacity="0.8"/>
  <circle cx="190" cy="115" r="4" fill="#F2B705"/>
  <circle cx="180" cy="40" r="3" fill="#EA580C" opacity="0.8"/>

  <!-- Sparkle Icons -->
  <path d="M70 38L71.5 42.5L76 44L71.5 45.5L70 50L68.5 45.5L64 44L68.5 42.5L70 38Z" fill="#F2B705"/>
  <path d="M172 135L173.5 139.5L178 141L173.5 142.5L172 147L170.5 142.5L166 141L170.5 139.5L172 135Z" fill="#EA580C"/>

  <defs>
    <radialGradient id="glow429" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#FB923C" stop-opacity="0.5"/>
      <stop offset="100%" stop-color="#EA580C" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Aktivitas Terlalu Cepat')

@section('message')
  Sistem mendeteksi terlalu banyak permintaan dari perangkat Anda dalam waktu yang sangat singkat. Akses dibatasi sejenak demi menjaga stabilitas dan kenyamanan seluruh pengguna.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Apa yang perlu dilakukan?</div>
    <div class="error-callout-text">
      <ul>
        <li>Harap tunggu sekitar 1 hingga 2 menit tanpa melakukan refresh berulang kali.</li>
        <li>Setelah jeda waktu, silakan klik tombol "Coba Lagi" di bawah ini.</li>
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
    Coba Lagi
  </button>

  <a href="{{ url('/') }}" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Kembali ke Beranda
  </a>
@endsection
