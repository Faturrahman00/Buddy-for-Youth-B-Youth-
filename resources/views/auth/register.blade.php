<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun — B-Youth | Buddy for Youth</title>
  <meta name="description" content="Daftarkan akun B-Youth sekarang untuk mengenal bakat minatmu dan mendapatkan bimbingan karier terpadu.">

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
          Kenali potensi dirimu <span class="highlight">sejak dini.</span>
        </h1>
        <p class="hero-description">
          Dapatkan gambaran jelas mengenai minat, bakat, serta pilihan program studi yang tepat melalui analisis cerdas dan bimbingan psikolog.
        </p>

        <!-- Feature Pills (Glassmorphism with Glowing Indicator Dot) -->
        <div class="hero-feature-list">
          <!-- 1. Rekomendasi Program Studi -->
          <div class="hero-feature-pill">
            <div class="pill-icon-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path>
              </svg>
            </div>
            <div class="pill-text">
              <span class="pill-title">Rekomendasi Program Studi</span>
              <span class="pill-subtitle">Analisis minat bakat untuk pemilihan program studi</span>
            </div>
            <span class="pill-dot"></span>
          </div>

          <!-- 2. Pendampingan Profesional -->
          <div class="hero-feature-pill">
            <div class="pill-icon-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
            <div class="pill-text">
              <span class="pill-title">Pendampingan Profesional</span>
              <span class="pill-subtitle">Bimbingan terarah bersama psikolog</span>
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
    <div class="auth-form-card" style="max-width: 520px;">
      
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
        <h2 class="form-main-title">Buat Akun</h2>
        <p class="form-sub-title">Lengkapi formulir di bawah untuk mendaftar akun baru.</p>
      </div>

      <!-- Register Form -->
      <form action="{{ route('register.post') }}" method="POST" class="modern-auth-form" id="registerForm">
        @csrf

        <!-- Nama Lengkap -->
        <div class="input-field-group">
          <label class="input-label" for="regName">Nama Lengkap</label>
          <div class="input-with-icon">
            <span class="input-icon-start">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <input 
              type="text" 
              id="regName" 
              name="name" 
              class="modern-input" 
              placeholder="Masukkan Nama Anda" 
              required 
              autocomplete="name"
              autofocus
            >
          </div>
        </div>

        <!-- Email -->
        <div class="input-field-group">
          <label class="input-label" for="regEmail">Email</label>
          <div class="input-with-icon">
            <span class="input-icon-start">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
              </svg>
            </span>
            <input 
              type="email" 
              id="regEmail" 
              name="email" 
              class="modern-input" 
              placeholder="Masukkan Email Anda" 
              required 
              autocomplete="email"
            >
          </div>
        </div>

        <!-- Grid 2: Asal Sekolah & Kelas -->
        <div class="field-grid-2">
          <div class="input-field-group">
            <label class="input-label" for="regSekolah">Asal Sekolah</label>
            <div class="input-with-icon">
              <span class="input-icon-start">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 21h18"></path>
                  <path d="M5 21V7l7-4 7 4v14"></path>
                  <path d="M9 10h1"></path>
                  <path d="M9 14h1"></path>
                  <path d="M14 10h1"></path>
                  <path d="M14 14h1"></path>
                </svg>
              </span>
              <input 
                type="text" 
                id="regSekolah" 
                name="asal_sekolah" 
                class="modern-input" 
                placeholder="SMA / SMK / MA" 
                required
              >
            </div>
          </div>

          <div class="input-field-group">
            <label class="input-label" for="regKelas">Kelas</label>
            <div class="input-with-icon">
              <span class="input-icon-start">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                  <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                </svg>
              </span>
              <select id="regKelas" name="kelas" class="modern-input" required>
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="10">Kelas 10</option>
                <option value="11">Kelas 11</option>
                <option value="12">Kelas 12</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Grid 2: Kata Sandi & Konfirmasi Kata Sandi -->
        <div class="field-grid-2">
          <div class="input-field-group">
            <label class="input-label" for="regPassword">Kata Sandi</label>
            <div class="input-with-icon">
              <span class="input-icon-start">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
              </span>
              <input 
                type="password" 
                id="regPassword" 
                name="password" 
                class="modern-input has-right-toggle" 
                placeholder="Min. 8 karakter" 
                required 
                minlength="8"
                autocomplete="new-password"
              >
              <button type="button" class="btn-eye-toggle" onclick="togglePasswordVisibility('regPassword', this)" aria-label="Lihat kata sandi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>

          <div class="input-field-group">
            <label class="input-label" for="regPasswordConfirm">Konfirmasi Sandi</label>
            <div class="input-with-icon">
              <span class="input-icon-start">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
              </span>
              <input 
                type="password" 
                id="regPasswordConfirm" 
                name="password_confirmation" 
                class="modern-input has-right-toggle" 
                placeholder="Ulangi kata sandi" 
                required 
                minlength="8"
                autocomplete="new-password"
              >
              <button type="button" class="btn-eye-toggle" onclick="togglePasswordVisibility('regPasswordConfirm', this)" aria-label="Lihat konfirmasi kata sandi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-modern-primary" id="btnSubmitRegister">
          Daftar Akun
        </button>
      </form>

      <!-- Bottom Switch -->
      <div class="auth-bottom-switch">
        Sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a>
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

  // Dynamic Select placeholder color handler
  const selectKelas = document.getElementById('regKelas');
  if (selectKelas) {
    function updateSelectColor() {
      if (!selectKelas.value) {
        selectKelas.style.color = '#94A3B8';
      } else {
        selectKelas.style.color = '#0F172A';
      }
    }
    selectKelas.addEventListener('change', updateSelectColor);
    updateSelectColor();
  }

  // Password confirmation check
  document.getElementById('registerForm')?.addEventListener('submit', function(e) {
    const pwd = document.getElementById('regPassword');
    const pwdConfirm = document.getElementById('regPasswordConfirm');
    if (pwd && pwdConfirm && pwd.value !== pwdConfirm.value) {
      e.preventDefault();
      alert('Konfirmasi Kata Sandi tidak sama dengan Kata Sandi.');
      pwdConfirm.focus();
    }
  });
</script>

</body>
</html>
