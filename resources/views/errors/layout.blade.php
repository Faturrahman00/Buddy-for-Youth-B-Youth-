<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title', 'Terjadi Kesalahan') — B-Youth</title>
  
  <link rel="icon" type="image/png" href="{{ asset('foto/logo.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* ================================================================
       RESET & ROOT VARIABLES — B-YOUTH DESIGN SYSTEM
       ================================================================ */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --c-primary:       #30618C;
      --c-primary-dark:  #1E4A6E;
      --c-primary-deep:  #0F253B;
      --c-primary-light: #4A88C0;
      --c-primary-subtle:#EBF3FA;
      --c-accent:        #F2B705;
      --c-accent-hover:  #D9A300;
      --c-accent-subtle: #FEF9E7;
      
      --c-text-dark:     #0F172A;
      --c-text-body:     #334155;
      --c-text-muted:    #64748B;
      --c-text-light:    #94A3B8;

      --c-border:        #E2E8F0;
      --c-border-light:  #F1F5F9;
      --c-bg-page:       #F8FAFC;
      --c-card-bg:       rgba(255, 255, 255, 0.94);

      /* Semantic status colors */
      --c-status-404:    #30618C;
      --c-status-403:    #E11D48;
      --c-status-419:    #D97706;
      --c-status-500:    #DC2626;
      --c-status-503:    #6366F1;
      --c-status-429:    #EA580C;

      --font-heading:    'Outfit', 'Plus Jakarta Sans', system-ui, sans-serif;
      --font-body:       'Plus Jakarta Sans', 'Inter', system-ui, sans-serif;
      --radius-sm:       10px;
      --radius-md:       16px;
      --radius-lg:       24px;
      --radius-xl:       32px;
      --radius-full:     9999px;

      --shadow-sm:       0 2px 8px rgba(15, 37, 59, 0.04);
      --shadow-card:     0 20px 50px -12px rgba(15, 37, 59, 0.10), 0 0 1px rgba(15, 37, 59, 0.08);
      --shadow-btn:      0 8px 20px -4px rgba(48, 97, 140, 0.35);
      --transition:      0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    html, body {
      min-height: 100vh;
      width: 100%;
      font-family: var(--font-body);
      background-color: var(--c-bg-page);
      color: var(--c-text-body);
      -webkit-font-smoothing: antialiased;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow-x: hidden;
    }

    /* Ambient Glowing Orbs Background */
    .ambient-glow-wrapper {
      position: fixed;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
    }

    .ambient-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(100px);
      opacity: 0.55;
      animation: orbFloat 14s ease-in-out infinite alternate;
    }

    .ambient-orb-1 {
      width: 520px;
      height: 520px;
      top: -120px;
      left: -100px;
      background: radial-gradient(circle, rgba(74, 136, 192, 0.28) 0%, rgba(48, 97, 140, 0.08) 60%, transparent 80%);
    }

    .ambient-orb-2 {
      width: 480px;
      height: 480px;
      bottom: -80px;
      right: -80px;
      background: radial-gradient(circle, rgba(242, 183, 5, 0.22) 0%, rgba(242, 183, 5, 0.05) 60%, transparent 80%);
      animation-delay: -5s;
    }

    .ambient-orb-3 {
      width: 360px;
      height: 360px;
      top: 40%;
      right: 15%;
      background: radial-gradient(circle, rgba(99, 102, 241, 0.14) 0%, transparent 70%);
      animation-delay: -9s;
    }

    @keyframes orbFloat {
      0% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(25px, -30px) scale(1.06); }
      100% { transform: translate(-20px, 20px) scale(0.96); }
    }

    /* Background Grid Pattern */
    .bg-grid-overlay {
      position: fixed;
      inset: 0;
      background-image: 
        radial-gradient(rgba(48, 97, 140, 0.08) 1px, transparent 1px);
      background-size: 28px 28px;
      pointer-events: none;
      z-index: 0;
      opacity: 0.6;
    }

    /* ================================================================
       TOP BAR
       ================================================================ */
    .error-header {
      position: relative;
      z-index: 10;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 24px 6%;
      max-width: 1300px;
      width: 100%;
      margin: 0 auto;
    }

    .brand-link {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      transition: transform var(--transition);
    }

    .brand-link:hover {
      transform: translateY(-1px);
    }

    .brand-logo-box {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: #FFFFFF;
      box-shadow: 0 4px 14px rgba(48, 97, 140, 0.12), 0 0 0 1px rgba(48, 97, 140, 0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 6px;
    }

    .brand-logo-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .brand-text {
      display: flex;
      flex-direction: column;
    }

    .brand-name {
      font-family: var(--font-heading);
      font-size: 20px;
      font-weight: 800;
      color: var(--c-primary-deep);
      line-height: 1.1;
      letter-spacing: -0.02em;
    }

    .brand-name span {
      color: var(--c-accent);
    }

    .brand-subtitle {
      font-size: 11px;
      font-weight: 600;
      color: var(--c-text-muted);
      letter-spacing: 0.02em;
      text-transform: uppercase;
    }

    .header-nav {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .header-nav-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--c-primary);
      background: rgba(255, 255, 255, 0.85);
      border: 1px solid rgba(48, 97, 140, 0.15);
      border-radius: var(--radius-full);
      padding: 8px 18px;
      text-decoration: none;
      backdrop-filter: blur(10px);
      transition: all var(--transition);
    }

    .header-nav-btn:hover {
      background: #FFFFFF;
      border-color: var(--c-primary);
      color: var(--c-primary-dark);
      box-shadow: 0 4px 12px rgba(48, 97, 140, 0.10);
      transform: translateY(-1px);
    }

    .header-nav-btn svg {
      width: 16px;
      height: 16px;
    }

    /* ================================================================
       MAIN ERROR STAGE
       ================================================================ */
    .error-main-stage {
      position: relative;
      z-index: 10;
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px 24px 60px;
      max-width: 980px;
      margin: 0 auto;
      width: 100%;
    }

    .error-card {
      width: 100%;
      background: var(--c-card-bg);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(255, 255, 255, 0.9);
      border-radius: var(--radius-xl);
      box-shadow: var(--shadow-card);
      padding: 56px 48px;
      text-align: center;
      position: relative;
      overflow: hidden;
      animation: cardEnter 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .error-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 10%;
      right: 10%;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--theme-color, var(--c-primary)), transparent);
      border-radius: 3px;
    }

    @keyframes cardEnter {
      from {
        opacity: 0;
        transform: translateY(24px) scale(0.98);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Badge Pill */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--theme-subtle, var(--c-primary-subtle));
      border: 1px solid var(--theme-border, rgba(48, 97, 140, 0.2));
      color: var(--theme-color, var(--c-primary));
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.03em;
      padding: 6px 16px;
      border-radius: var(--radius-full);
      margin-bottom: 24px;
    }

    .status-badge-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: var(--theme-color, var(--c-primary));
      box-shadow: 0 0 0 3px var(--theme-glow, rgba(48, 97, 140, 0.25));
      animation: pulseGlow 2s infinite;
    }

    @keyframes pulseGlow {
      0%, 100% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.2);
        opacity: 0.7;
      }
    }

    /* Hero Illustration & Big Code */
    .error-visual-container {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 8px auto 28px;
      max-width: 420px;
      height: 190px;
    }

    .error-giant-code {
      position: absolute;
      font-family: var(--font-heading);
      font-size: clamp(96px, 16vw, 150px);
      font-weight: 900;
      line-height: 1;
      letter-spacing: -0.04em;
      color: transparent;
      background: linear-gradient(180deg, var(--theme-code-top, #E2E8F0) 0%, var(--theme-code-bot, #CBD5E1) 100%);
      -webkit-background-clip: text;
      background-clip: text;
      user-select: none;
      z-index: 1;
      opacity: 0.45;
      text-shadow: 0 10px 20px rgba(15, 37, 59, 0.05);
    }

    .error-svg-art {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 220px;
      height: auto;
      filter: drop-shadow(0 14px 24px rgba(15, 37, 59, 0.12));
      animation: artHover 4.5s ease-in-out infinite;
    }

    @keyframes artHover {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    /* Titles & Message */
    .error-title {
      font-family: var(--font-heading);
      font-size: clamp(26px, 4vw, 36px);
      font-weight: 800;
      color: var(--c-primary-deep);
      line-height: 1.2;
      letter-spacing: -0.02em;
      margin-bottom: 14px;
    }

    .error-desc {
      font-size: clamp(15px, 2vw, 16.5px);
      color: var(--c-text-body);
      line-height: 1.65;
      max-width: 620px;
      margin: 0 auto 28px;
    }

    /* Helpful Callout / Suggestion Box */
    .error-callout {
      background: #FFFFFF;
      border: 1px solid var(--c-border);
      border-radius: var(--radius-md);
      padding: 18px 24px;
      max-width: 660px;
      margin: 0 auto 36px;
      text-align: left;
      display: flex;
      align-items: flex-start;
      gap: 14px;
      box-shadow: var(--shadow-sm);
    }

    .error-callout-icon {
      flex-shrink: 0;
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: var(--theme-subtle, var(--c-primary-subtle));
      color: var(--theme-color, var(--c-primary));
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .error-callout-icon svg {
      width: 20px;
      height: 20px;
    }

    .error-callout-content {
      flex: 1;
    }

    .error-callout-title {
      font-size: 14px;
      font-weight: 700;
      color: var(--c-text-dark);
      margin-bottom: 4px;
    }

    .error-callout-text {
      font-size: 13px;
      color: var(--c-text-muted);
      line-height: 1.5;
    }

    .error-callout-text ul {
      margin-top: 6px;
      padding-left: 18px;
    }

    .error-callout-text li {
      margin-bottom: 3px;
    }

    /* Actions CTA */
    .error-actions {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 36px;
    }

    .btn-action-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
      color: #FFFFFF;
      font-size: 15px;
      font-weight: 700;
      padding: 14px 28px;
      border-radius: var(--radius-md);
      text-decoration: none;
      box-shadow: var(--shadow-btn);
      border: 1px solid rgba(255, 255, 255, 0.15);
      cursor: pointer;
      transition: all var(--transition);
    }

    .btn-action-primary:hover {
      background: linear-gradient(135deg, var(--c-primary-light) 0%, var(--c-primary) 100%);
      transform: translateY(-2px);
      box-shadow: 0 12px 24px -4px rgba(48, 97, 140, 0.45);
      color: #FFFFFF;
    }

    .btn-action-primary svg {
      width: 18px;
      height: 18px;
    }

    .btn-action-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: #FFFFFF;
      color: var(--c-text-dark);
      font-size: 15px;
      font-weight: 600;
      padding: 14px 26px;
      border-radius: var(--radius-md);
      text-decoration: none;
      border: 1px solid var(--c-border);
      box-shadow: var(--shadow-sm);
      cursor: pointer;
      transition: all var(--transition);
    }

    .btn-action-secondary:hover {
      background: #F8FAFC;
      border-color: var(--c-primary-light);
      color: var(--c-primary);
      transform: translateY(-2px);
    }

    .btn-action-secondary svg {
      width: 18px;
      height: 18px;
    }

    /* Shortcut Nav Chips */
    .error-shortcuts {
      border-top: 1px solid var(--c-border);
      padding-top: 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
    }

    .shortcuts-label {
      font-size: 12.5px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--c-text-light);
    }

    .shortcuts-list {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .shortcut-chip {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      font-weight: 600;
      color: var(--c-text-muted);
      background: rgba(241, 245, 249, 0.7);
      padding: 6px 14px;
      border-radius: var(--radius-full);
      text-decoration: none;
      border: 1px solid transparent;
      transition: all var(--transition);
    }

    .shortcut-chip:hover {
      background: var(--c-primary-subtle);
      color: var(--c-primary);
      border-color: rgba(48, 97, 140, 0.18);
      transform: translateY(-1px);
    }

    .shortcut-chip svg {
      width: 14px;
      height: 14px;
      opacity: 0.7;
    }

    /* Developer Debug Panel (if APP_DEBUG is true) */
    .dev-debug-panel {
      margin-top: 28px;
      text-align: left;
      background: #0F172A;
      color: #F8FAFC;
      border-radius: var(--radius-md);
      padding: 16px 20px;
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
      font-size: 12px;
      line-height: 1.5;
      overflow-x: auto;
      border: 1px solid #334155;
    }

    .dev-debug-panel summary {
      cursor: pointer;
      font-weight: 700;
      color: var(--c-accent);
      user-select: none;
      outline: none;
    }

    .dev-debug-panel pre {
      margin-top: 10px;
      white-space: pre-wrap;
      word-break: break-all;
      color: #94A3B8;
    }

    /* ================================================================
       FOOTER
       ================================================================ */
    .error-footer {
      position: relative;
      z-index: 10;
      padding: 24px;
      text-align: center;
      font-size: 13px;
      color: var(--c-text-muted);
      border-top: 1px solid rgba(226, 232, 240, 0.7);
      background: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(10px);
    }

    .error-footer a {
      color: var(--c-primary);
      text-decoration: none;
      font-weight: 600;
    }

    .error-footer a:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .error-card {
        padding: 40px 24px;
        border-radius: var(--radius-lg);
      }
      .error-header {
        padding: 18px 20px;
      }
      .header-nav {
        display: none;
      }
      .error-visual-container {
        height: 160px;
        margin-bottom: 20px;
      }
      .error-actions {
        flex-direction: column;
        width: 100%;
      }
      .btn-action-primary,
      .btn-action-secondary {
        width: 100%;
      }
      .error-callout {
        padding: 14px 18px;
      }
    }
  </style>
  @yield('extra-styles')
</head>
<body>

  <!-- Ambient Glowing Background Decor -->
  <div class="ambient-glow-wrapper" aria-hidden="true">
    <div class="ambient-orb ambient-orb-1"></div>
    <div class="ambient-orb ambient-orb-2"></div>
    <div class="ambient-orb ambient-orb-3"></div>
  </div>
  <div class="bg-grid-overlay" aria-hidden="true"></div>

  <!-- Header -->
  <header class="error-header">
    <a href="{{ url('/') }}" class="brand-link" title="Beranda B-Youth">
      <div class="brand-logo-box">
        <img src="{{ asset('foto/logo.png') }}" alt="Logo B-Youth">
      </div>
      <div class="brand-text">
        <div class="brand-name">B-<span>Youth</span></div>
        <div class="brand-subtitle">Buddy for Youth</div>
      </div>
    </a>

    <nav class="header-nav">
      <a href="{{ url('/') }}" class="header-nav-btn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span>Ke Beranda</span>
      </a>
      <a href="{{ route('login') }}" class="header-nav-btn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        <span>Masuk Akun</span>
      </a>
    </nav>
  </header>

  <!-- Main Error Card -->
  <main class="error-main-stage" role="main">
    <div class="error-card">
      
      <!-- Status Badge -->
      <div class="status-badge">
        <span class="status-badge-dot" aria-hidden="true"></span>
        <span>@yield('badge', 'Status Kesalahan')</span>
      </div>

      <!-- Hero Visual & Code -->
      <div class="error-visual-container">
        <div class="error-giant-code">@yield('code', 'Error')</div>
        <div class="error-svg-art">
          @yield('illustration')
        </div>
      </div>

      <!-- Headings -->
      <h1 class="error-title">@yield('heading', 'Terjadi Kesalahan')</h1>
      <p class="error-desc">
        @yield('message', 'Mohon maaf, halaman yang Anda tuju sedang mengalami kendala atau tidak dapat diakses saat ini.')
      </p>

      <!-- Troubleshooting / Guidance Callout -->
      @yield('callout')

      <!-- Action Buttons -->
      <div class="error-actions">
        @yield('actions')
      </div>

      <!-- Quick Shortcuts -->
      <div class="error-shortcuts">
        <div class="shortcuts-label">Tautan Cepat yang Mungkin Membantu</div>
        <div class="shortcuts-list">
          <a href="{{ url('/') }}" class="shortcut-chip">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10h14V10"/></svg>
            Beranda Utama
          </a>
          <a href="{{ url('/dashboard') }}" class="shortcut-chip">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Dashboard
          </a>
          <a href="{{ route('login') }}" class="shortcut-chip">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Masuk / Login
          </a>
          <a href="{{ route('register') }}" class="shortcut-chip">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Registrasi Akun
          </a>
        </div>
      </div>

      <!-- Developer Debug Panel (Hanya muncul jika debug mode aktif & ada pesan teknis) -->
      @if(config('app.debug') && isset($exception) && $exception->getMessage())
        <details class="dev-debug-panel">
          <summary>Informasi Teknis Developer (Debug Mode)</summary>
          <pre>{{ $exception->getMessage() }}</pre>
          @if(method_exists($exception, 'getFile'))
            <div style="margin-top: 6px; color: #64748B;">File: {{ $exception->getFile() }}:{{ $exception->getLine() }}</div>
          @endif
        </details>
      @endif

    </div>
  </main>

  <!-- Footer -->
  <footer class="error-footer">
    <p>&copy; {{ date('Y') }} <strong>B-Youth</strong> (Buddy for Youth) &mdash; Rekomendasi Program Studi &amp; Konseling Siswa. Hak Cipta Dilindungi.</p>
  </footer>

</body>
</html>
