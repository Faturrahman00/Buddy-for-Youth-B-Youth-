@extends('errors.layout')

@section('title', '404 — Halaman Tidak Ditemukan')
@section('code', '404')
@section('badge', 'Status 404 • Halaman Tidak Ditemukan')

@section('extra-styles')
<style>
  :root {
    --theme-color: #30618C;
    --theme-subtle: #EBF3FA;
    --theme-border: rgba(48, 97, 140, 0.25);
    --theme-glow: rgba(48, 97, 140, 0.35);
    --theme-code-top: #CBD5E1;
    --theme-code-bot: #94A3B8;
  }
</style>
@endsection

@section('illustration')
<svg viewBox="0 0 240 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
  <!-- Orbit Ring / Planet Backdrop -->
  <ellipse cx="120" cy="95" rx="85" ry="32" stroke="#30618C" stroke-width="2" stroke-dasharray="4 6" opacity="0.35"/>
  <ellipse cx="120" cy="95" rx="105" ry="40" stroke="#F2B705" stroke-width="1.5" stroke-dasharray="3 7" opacity="0.4"/>

  <!-- Glowing Glow Base -->
  <circle cx="120" cy="90" r="50" fill="url(#glow404)" opacity="0.6"/>

  <!-- Compass / Telescope / Planet Center -->
  <circle cx="120" cy="90" r="42" fill="white" stroke="#30618C" stroke-width="3"/>
  <circle cx="120" cy="90" r="35" fill="#EBF3FA"/>
  
  <!-- Magnifying Glass Elements -->
  <circle cx="112" cy="82" r="22" stroke="#30618C" stroke-width="3.5" fill="rgba(255,255,255,0.7)"/>
  <line x1="128" y1="98" x2="148" y2="118" stroke="#1E4A6E" stroke-width="5" stroke-linecap="round"/>
  <line x1="140" y1="110" x2="152" y2="122" stroke="#F2B705" stroke-width="3" stroke-linecap="round"/>

  <!-- Floating Sparkles & Dots -->
  <circle cx="45" cy="55" r="4" fill="#F2B705"/>
  <circle cx="195" cy="65" r="3" fill="#30618C"/>
  <circle cx="180" cy="125" r="5" fill="#F2B705" opacity="0.8"/>
  <circle cx="55" cy="125" r="3" fill="#4A88C0"/>

  <!-- Sparkle Icons -->
  <path d="M70 40L72 46L78 48L72 50L70 56L68 50L62 48L68 46L70 40Z" fill="#F2B705"/>
  <path d="M170 35L171.5 39.5L176 41L171.5 42.5L170 47L168.5 42.5L164 41L168.5 39.5L170 35Z" fill="#30618C"/>

  <!-- Subtle Floating Question Mark -->
  <text x="106" y="89" font-family="'Outfit', sans-serif" font-size="20" font-weight="800" fill="#30618C">?</text>

  <defs>
    <radialGradient id="glow404" cx="0.5" cy="0.5" r="0.5" fx="0.5" fy="0.5">
      <stop offset="0%" stop-color="#4A88C0" stop-opacity="0.5"/>
      <stop offset="100%" stop-color="#30618C" stop-opacity="0"/>
    </radialGradient>
  </defs>
</svg>
@endsection

@section('heading', 'Halaman Tidak Ditemukan')

@section('message')
  Oops! Halaman yang Anda cari tampaknya tidak ada, telah dipindahkan, atau alamat tautan yang Anda tuju kurang tepat.
@endsection

@section('callout')
<div class="error-callout">
  <div class="error-callout-icon" aria-hidden="true">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
  </div>
  <div class="error-callout-content">
    <div class="error-callout-title">Saran untuk Anda:</div>
    <div class="error-callout-text">
      <ul>
        <li>Periksa kembali ejaan alamat URL yang Anda ketikkan di peramban.</li>
        <li>Jika Anda mengeklik tautan lama, halaman mungkin telah diperbarui ke struktur baru.</li>
        <li>Gunakan tombol di bawah untuk kembali ke halaman utama B-Youth atau dashboard Anda.</li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('actions')
  <a href="{{ url('/') }}" class="btn-action-primary">
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
