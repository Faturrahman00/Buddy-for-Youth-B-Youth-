<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk — B-Youth | Buddy for Youth</title>
  <meta name="description" content="Masuk ke portal B-Youth untuk mengakses bimbingan karier AI, asesmen minat bakat, dan konseling psikologi.">

  <!-- Favicon -->
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%2330618C'/%3E%3Cpolygon points='16,7 26,12 16,17 6,12' fill='%23F2B705'/%3E%3Cpath d='M9 14.5v5c0 2 3.1 3.5 7 3.5s7-1.5 7-3.5v-5' fill='none' stroke='%23FFFFFF' stroke-width='2'/%3E%3C/svg%3E">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-split-wrapper">
  
  <!-- LEFT HERO SIDE (BRAND GRADIENT & FEATURE PILLS) -->
  <div class="auth-hero-side">
    <!-- Glowing Ambient Orbs -->
    <div class="hero-glow-orb hero-orb-1"></div>
    <div class="hero-glow-orb hero-orb-2"></div>
    <div class="hero-glow-orb hero-orb-3"></div>

    <div class="hero-content">
      <!-- Top Brand -->
      <a href="{{ route('home') }}" class="hero-brand" title="B-Youth Beranda">
        <div class="hero-brand-logo" style="background:transparent; box-shadow:none;">
          <img src="{{ asset('foto/logo.png') }}" alt="Logo B-Youth" style="width:38px; height:38px; object-fit:contain;">
        </div>
        <span class="hero-brand-name">B-<span>Youth</span></span>
      </a>

      <!-- Headline & Description -->
      <div class="hero-body">
        <h1 class="hero-headline">
          Temukan program studi <span class="highlight">yang tepat.</span>
        </h1>
        <p class="hero-description">
          Platform bimbingan dan konseling untuk membantu menentukan pilihan program studi masa depanmu.
        </p>

        <!-- Feature Pills (Glassmorphism with Glowing Indicator Dot) -->
        <div class="hero-feature-list">
          <!-- 1. Kecocokan Program Studi -->
          <div class="hero-feature-pill">
            <div class="pill-icon-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="12" r="6"></circle>
                <circle cx="12" cy="12" r="2"></circle>
              </svg>
            </div>
            <div class="pill-text">
              <span class="pill-title">Kecocokan Program Studi</span>
              <span class="pill-subtitle">Pencocokan program studi sesuai minat &amp; potensi</span>
            </div>
            <span class="pill-dot"></span>
          </div>

          <!-- 2. Asesmen -->
          <div class="hero-feature-pill">
            <div class="pill-icon-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3L22 4"></path>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
              </svg>
            </div>
            <div class="pill-text">
              <span class="pill-title">Asesmen Minat Bakat</span>
              <span class="pill-subtitle">Pemetaan potensi dan gaya belajar</span>
            </div>
            <span class="pill-dot"></span>
          </div>

          <!-- 3. Konseling -->
          <div class="hero-feature-pill">
            <div class="pill-icon-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                <path d="M12 7v6"></path>
                <path d="M9 10h6"></path>
              </svg>
            </div>
            <div class="pill-text">
              <span class="pill-title">Layanan Konseling</span>
              <span class="pill-subtitle">Bimbingan langsung dengan psikolog</span>
            </div>
            <span class="pill-dot"></span>
          </div>
        </div>
      </div>

      <div class="hero-footer-note">
        Buddy for Youth &bull; Platform Bimbingan & Rekomendasi Program Studi
      </div>
    </div>
  </div>

  <!-- RIGHT FORM SIDE -->
  <div class="auth-form-side">
    <div class="auth-form-card">
      
      <!-- Back to Home -->
      <a href="{{ route('home') }}" class="form-back-btn" title="Kembali ke Beranda">
        <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Beranda
      </a>

      <!-- Form Header -->
      <div class="form-header-box">
        <h2 class="form-main-title">Selamat Datang</h2>
        <p class="form-sub-title">Masukkan akun untuk memulai bimbingan & konseling.</p>
      </div>

      <!-- Login Form -->
      <form action="{{ route('login.post') }}" method="POST" class="modern-auth-form" id="loginForm">
        @csrf

        <!-- Email -->
        <div class="input-field-group">
          <label class="input-label" for="loginEmail">Email</label>
          <div class="input-with-icon">
            <span class="input-icon-start">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
              </svg>
            </span>
            <input 
              type="email" 
              id="loginEmail" 
              name="email" 
              class="modern-input" 
              placeholder="Masukkan email Anda" 
              required 
              autocomplete="email"
              autofocus
            >
          </div>
        </div>

        <!-- Kata Sandi -->
        <div class="input-field-group">
          <label class="input-label" for="loginPassword">Kata Sandi</label>
          <div class="input-with-icon">
            <span class="input-icon-start">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
            </span>
            <input 
              type="password" 
              id="loginPassword" 
              name="password" 
              class="modern-input has-right-toggle" 
              placeholder="Masukkan kata sandi" 
              required 
              autocomplete="current-password"
            >
            <button type="button" class="btn-eye-toggle" onclick="togglePasswordVisibility('loginPassword', this)" aria-label="Lihat kata sandi">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
        </div>

        <!-- Options: Remember Me & Forgot Password -->
        <div class="form-options-row">
          <label class="remember-checkbox">
            <input type="checkbox" name="remember" id="rememberMe">
            <span>Ingat saya</span>
          </label>
          <a href="#" class="forgot-password-link" onclick="event.preventDefault(); alert('Silakan hubungi admin sekolah untuk pengaturan ulang kata sandi.');">
            Lupa kata sandi?
          </a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-modern-primary" id="btnSubmitLogin">
          Masuk ke Dashboard
        </button>
      </form>

      <!-- Bottom Switch -->
      <div class="auth-bottom-switch">
        Belum memiliki akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
      </div>

    </div>
  </div>

</div>

<script>
  function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';

    if (isPassword) {
      btn.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
          <line x1="1" y1="1" x2="23" y2="23"></line>
        </svg>
      `;
    } else {
      btn.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
          <circle cx="12" cy="12" r="3"></circle>
        </svg>
      `;
    }
  }
</script>

</body>
</html>
