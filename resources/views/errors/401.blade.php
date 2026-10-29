@extends('errors.layout')

@section('title', '401 — Autentikasi Diperlukan')
@section('code', '401')
@section('badge', 'Status 401 • Autentikasi Diperlukan')

@section('extra-styles')
<style>
  :root {
    --theme-color: #7C3AED;
    --theme-subtle: #F5F3FF;
    --theme-border: rgba(124, 58, 237, 0.25);
    --theme-glow: rgba(124, 58, 237, 0.35);
    --theme-code-top: #DDD6FE;
    --theme-code-bot: #C4B5FD;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit Ring -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#7C3AED" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#F2B705" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow401)" opacity="0.6"/>

  <!-- ID Badge Card Base -->
  <rect x="85" y="48" width="70" height="92" rx="12" fill="#FFFFFF" stroke="#7C3AED" stroke-width="3"/>
  <rect x="95" y="56" width="50" height="4" rx="2" fill="#DDD6FE"/>

  <!-- User Avatar Circle -->
  <circle cx="120" cy="80" r="16" fill="#F5F3FF" stroke="#7C3AED" stroke-width="2"/>
  <circle cx="120" cy="76" r="6" fill="#7C3AED"/>
  <path d="M110 92C110 87 114 84 120 84C126 84 130 87 130 92" fill="#7C3AED"/>

  <!-- Key Overlay Badge -->
  <circle cx="145" cy="120" r="14" fill="#F2B705" stroke="#FFFFFF" stroke-width="2.5"/>
  <!-- Small Key Inside -->
  <circle cx="141" cy="118" r="3.5" fill="#1E4A6E"/>
  <line x1="144" y1="118" x2="150" y2="118" stroke="#1E4A6E" stroke-width="2" stroke-linecap="round"/>
  <line x1="148" y1="118" x2="148" y2="122" stroke="#1E4A6E" stroke-width="2" stroke-linecap="round"/>

  <!-- Floating Sparkles & Dots -->
  <circle cx="50" cy="65" r="3.5" fill="#7C3AED" opacity="0.8"/>
  <circle cx="190" cy="75" r="4" fill="#F2B705"/>
  <circle cx="180" cy="125" r="3" fill="#7C3AED" opacity="0.8"/>

  <!-- Sparkle Icons -->
  <path d="M68 40L69.5 44.5L74 46L69.5 47.5L68 52L66.5 47.5L62 46L66.5 44.5L68 40Z" fill="#F2B705"/>
  <path d="M172 38L173.5 42.5L178 44L173.5 45.5L172 50L170.5 45.5L166 44L170.5 42.5L172 38Z" fill="#7C3AED"/>

  <defs>
    <radialGradient id="glow401" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#A78BFA" stop-opacity="0.5"/>
      <stop offset="100%" stop-color="#7C3AED" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Silakan Masuk ke Akun Anda')

@section('message')
  Anda perlu masuk ke akun B-Youth untuk dapat mengakses halaman atau fitur ini. Silakan masuk menggunakan akun yang telah terdaftar.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Sudah memiliki akun B-Youth?</div>
    <div class="error-callout-text">
      <ul>
        <li>Klik tombol <strong>"Masuk Akun"</strong> untuk login dengan email dan kata sandi Anda.</li>
        <li>Belum punya akun? Klik <strong>"Daftar Sekarang"</strong> untuk membuat akun siswa baru secara gratis.</li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('actions')
  <a href="{{ route('login') }}" class="btn-action-primary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
    </svg>
    Masuk Akun Sekarang
  </a>

  <a href="{{ route('register') }}" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
    </svg>
    Daftar Akun Baru
  </a>

  <a href="{{ url('/') }}" class="btn-action-secondary">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Ke Beranda
  </a>
@endsection
