@extends('errors.layout')

@section('title', '403 — Akses Ditolak')
@section('code', '403')
@section('badge', 'Status 403 • Akses Terbatas & Ditolak')

@section('extra-styles')
<style>
  :root {
    --theme-color: #E11D48;
    --theme-subtle: #FFF1F2;
    --theme-border: rgba(225, 29, 72, 0.25);
    --theme-glow: rgba(225, 29, 72, 0.35);
    --theme-code-top: #FECDD3;
    --theme-code-bot: #FDA4AF;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit Ring / Security Ring -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#E11D48" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#F2B705" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow403)" opacity="0.55"/>

  <!-- Shield Base Background -->
  <path d="M120 48L158 64V98C158 124 142 144 120 152C98 144 82 124 82 98V64L120 48Z" 
        fill="#FFFFFF" stroke="#E11D48" stroke-width="3.5" stroke-linejoin="round"/>
  
  <path d="M120 54L152 68V98C152 120 138 138 120 145C102 138 88 120 88 98V68L120 54Z" 
        fill="#FFF1F2" opacity="0.9"/>

  <!-- Golden Padlock -->
  <!-- Padlock Shackle -->
  <path d="M107 92V82C107 74.8 112.8 69 120 69C127.2 69 133 74.8 133 82V92" 
        stroke="#1E4A6E" stroke-width="4" stroke-linecap="round"/>
  
  <!-- Padlock Body -->
  <rect x="101" y="90" width="38" height="30" rx="7" fill="#F2B705" stroke="#DF9F00" stroke-width="2"/>
  
  <!-- Padlock Keyhole -->
  <circle cx="120" cy="102" r="3.5" fill="#1E4A6E"/>
  <path d="M118.5 104L117 112H123L121.5 104H118.5Z" fill="#1E4A6E"/>

  <!-- Small Warning Badge on Shield -->
  <circle cx="152" cy="70" r="11" fill="#E11D48" stroke="#FFFFFF" stroke-width="2.5"/>
  <text x="152" y="74" text-anchor="middle" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#FFFFFF">!</text>

  <!-- Floating Sparkles & Dots -->
  <circle cx="50" cy="65" r="3.5" fill="#E11D48" opacity="0.8"/>
  <circle cx="190" cy="60" r="4" fill="#F2B705"/>
  <circle cx="185" cy="125" r="3" fill="#E11D48" opacity="0.6"/>
  <circle cx="55" cy="120" r="4" fill="#30618C" opacity="0.7"/>

  <!-- Sparkle Icons -->
  <path d="M68 40L69.5 44.5L74 46L69.5 47.5L68 52L66.5 47.5L62 46L66.5 44.5L68 40Z" fill="#E11D48"/>
  <path d="M172 38L173.5 42.5L178 44L173.5 45.5L172 50L170.5 45.5L166 44L170.5 42.5L172 38Z" fill="#F2B705"/>

  <defs>
    <radialGradient id="glow403" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#E11D48" stop-opacity="0.45"/>
      <stop offset="100%" stop-color="#E11D48" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Akses Halaman Ditolak')

@section('message')
  Mohon maaf, Anda tidak memiliki izin atau wewenang untuk membuka halaman ini. Halaman ini mungkin khusus untuk peran tertentu seperti Siswa terdaftar, Konselor Psikolog, atau Administrator.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Mengapa akses ditolak?</div>
    <div class="error-callout-text">
      <ul>
        <li>Akun yang saat ini masuk tidak memiliki izin peran (role) yang dipersyaratkan.</li>
        <li>Jika Anda memiliki akun dengan peran lain, silakan beralih akun melalui halaman login.</li>
        <li>Jika Anda merasa ini adalah sebuah kekeliruan sistem, silakan hubungi tim administrator.</li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('actions')
  <a href="{{ url('/dashboard') }}" class="btn-action-primary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
    </svg>
    Buka Dashboard Saya
  </a>

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
    Ganti Akun
  </a>
@endsection
