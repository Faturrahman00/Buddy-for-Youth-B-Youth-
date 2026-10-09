<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>B-Youth — Buddy for Youth | Rekomendasi Program Studi &amp; Konseling Siswa</title>
  <meta name="description" content="B-Youth adalah platform rekomendasi program studi dan layanan konseling psikologi pendidikan terpadu untuk siswa SMA/SMK.">
  <meta name="keywords" content="B-Youth, Buddy for Youth, rekomendasi program studi, bimbingan konseling siswa, asesmen minat bakat">
  <meta property="og:title" content="B-Youth — Platform Rekomendasi Program Studi &amp; Konseling">
  <meta property="og:description" content="Temukan program studi yang paling sesuai bersama B-Youth">

  <link rel="icon" type="image/png" href="{{ asset('foto/logo.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

  <style>
    /* ================================================================
       GLOBAL RESET & VARS
       ================================================================ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --c-primary:       #30618C;
      --c-primary-dark:  #1E4A6E;
      --c-primary-light: #4A88C0;
      --c-accent:        #F2B705;
      --c-white:         #FFFFFF;
      --c-bg:            #F6F8FB;
      --c-text:          #1A2535;
      --c-text-muted:    #64748B;
      --c-border:        #E2E8F0;
      --radius-sm:       8px;
      --radius-md:       14px;
      --radius-lg:       22px;
      --font:            'Outfit', 'Plus Jakarta Sans', system-ui, sans-serif;
      --transition:      0.3s cubic-bezier(.4,0,.2,1);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: var(--font);
      background: var(--c-bg);
      color: var(--c-text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ================================================================
       NAVBAR
       ================================================================ */
    .lp-navbar {
      position: fixed;
      top: 0;
      left: 0; right: 0;
      z-index: 1000;
      background: rgba(13, 31, 53, 0.70);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.10);
      padding: 0 5%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 68px;
      transition: background var(--transition);
    }

    .lp-navbar.scrolled {
      background: rgba(255,255,255,0.94);
      border-bottom-color: rgba(48,97,140,0.12);
      box-shadow: 0 2px 24px rgba(48,97,140,0.10);
    }

    .lp-navbar.scrolled .lp-brand-name { color: var(--c-primary); }
    .lp-navbar.scrolled .lp-nav-links a { color: var(--c-text-muted); }
    .lp-navbar.scrolled .lp-nav-links a:hover { color: var(--c-primary); }
    .lp-navbar.scrolled .btn-nav-login { border-color: var(--c-primary); color: var(--c-primary); }
    .lp-navbar.scrolled .btn-nav-login:hover { background: var(--c-primary); color: #fff; }

    .lp-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .lp-brand-logo {
      width: 38px; height: 38px;
      background: linear-gradient(135deg, var(--c-primary), var(--c-primary-light));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 12px rgba(48,97,140,0.35);
    }

    .lp-brand-name {
      font-size: 22px;
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.03em;
    }

    .lp-brand-name span { color: var(--c-accent); }

    .lp-nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
    }

    .lp-nav-links a {
      text-decoration: none;
      color: rgba(255,255,255,0.80);
      font-size: 14.5px;
      font-weight: 500;
      padding: 7px 14px;
      border-radius: var(--radius-sm);
      transition: var(--transition);
    }

    .lp-nav-links a:hover { color: #fff; background: rgba(255,255,255,0.12); }

    .lp-nav-actions { display: flex; align-items: center; gap: 10px; }

    .btn-nav-login {
      padding: 8px 20px;
      border: 1.5px solid rgba(255,255,255,0.60);
      color: rgba(255,255,255,0.90);
      background: transparent;
      font-size: 14px; font-weight: 600;
      border-radius: var(--radius-sm);
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
      font-family: var(--font);
    }

    .btn-nav-login:hover { background: rgba(255,255,255,0.15); border-color: #fff; color: #fff; }

    .btn-nav-register {
      padding: 8px 22px;
      background: linear-gradient(135deg, var(--c-accent), #d49f00);
      color: #1A2535;
      border: none;
      font-size: 14px; font-weight: 700;
      border-radius: var(--radius-sm);
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
      font-family: var(--font);
      box-shadow: 0 4px 14px rgba(242,183,5,0.35);
    }

    .btn-nav-register:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(242,183,5,0.48); }

    /* ================================================================
       HERO SECTION — Full-screen slideshow
       ================================================================ */
    .lp-hero {
      position: relative;
      height: 100vh;
      min-height: 600px;
      display: flex;
      align-items: center;
      overflow: hidden;
    }

    /* Slideshow background */
    .hero-slides {
      position: absolute;
      inset: 0;
      z-index: 0;
    }

    .hero-slide {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1.2s ease-in-out;
    }

    .hero-slide.active { opacity: 1; }

    /* Dark overlay gradient on every slide */
    .hero-slide::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(
        105deg,
        rgba(13,31,53,0.82) 0%,
        rgba(13,31,53,0.55) 55%,
        rgba(13,31,53,0.25) 100%
      );
    }

    /* Slide dot indicators */
    .hero-slide-dots {
      position: absolute;
      bottom: 36px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      display: flex;
      gap: 10px;
    }

    .hero-slide-dot {
      width: 8px; height: 8px;
      border-radius: 50%;
      background: rgba(255,255,255,0.40);
      border: none;
      cursor: pointer;
      transition: all 0.35s ease;
      padding: 0;
    }

    .hero-slide-dot.active {
      width: 28px;
      border-radius: 4px;
      background: var(--c-accent);
    }

    /* Slide progress bar */
    .hero-progress {
      position: absolute;
      bottom: 0; left: 0;
      height: 3px;
      background: var(--c-accent);
      z-index: 10;
      width: 0%;
      transition: width linear;
    }

    /* Hero content */
    .lp-hero-content {
      position: relative;
      z-index: 5;
      padding: 0 5%;
      max-width: 720px;
    }

    .lp-hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(242,183,5,0.18);
      border: 1px solid rgba(242,183,5,0.35);
      color: var(--c-accent);
      font-size: 13px; font-weight: 600;
      border-radius: 100px;
      padding: 6px 16px;
      margin-bottom: 24px;
      letter-spacing: 0.03em;
    }

    .lp-hero-badge-dot {
      width: 8px; height: 8px;
      background: var(--c-accent);
      border-radius: 50%;
      animation: heroPulse 2s ease-in-out infinite;
    }

    @keyframes heroPulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.5); opacity: 0.6; }
    }

    .lp-hero h1 {
      font-size: clamp(38px, 5.5vw, 72px);
      font-weight: 900;
      line-height: 1.06;
      letter-spacing: -0.04em;
      color: #fff;
      margin-bottom: 22px;
    }

    .hero-highlight {
      background: linear-gradient(135deg, var(--c-accent), #ffcc30);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .lp-hero-desc {
      font-size: 17px;
      line-height: 1.72;
      color: rgba(255,255,255,0.75);
      margin-bottom: 38px;
      max-width: 500px;
    }

    .lp-hero-cta {
      display: flex;
      align-items: center;
      gap: 14px;
      flex-wrap: wrap;
    }

    .btn-hero-primary {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 15px 34px;
      background: linear-gradient(135deg, var(--c-accent), #d49f00);
      color: #1A2535;
      font-size: 16px; font-weight: 800;
      border-radius: var(--radius-md);
      text-decoration: none;
      box-shadow: 0 8px 28px rgba(242,183,5,0.40);
      transition: var(--transition);
      font-family: var(--font);
    }

    .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(242,183,5,0.55); }

    .btn-hero-secondary {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 15px 30px;
      background: rgba(255,255,255,0.12);
      color: #fff;
      font-size: 16px; font-weight: 600;
      border-radius: var(--radius-md);
      border: 2px solid rgba(255,255,255,0.30);
      text-decoration: none;
      transition: var(--transition);
      font-family: var(--font);
      backdrop-filter: blur(8px);
    }

    .btn-hero-secondary:hover { background: rgba(255,255,255,0.22); border-color: rgba(255,255,255,0.55); }

    .lp-hero-stats {
      display: flex;
      align-items: center;
      gap: 28px;
      margin-top: 52px;
      flex-wrap: wrap;
    }

    .hero-stat { text-align: left; }
    .hero-stat-num { font-size: 26px; font-weight: 900; color: var(--c-accent); letter-spacing: -0.03em; }
    .hero-stat-label { font-size: 13px; color: rgba(255,255,255,0.60); font-weight: 500; margin-top: 2px; }
    .hero-stat-divider { width: 1px; height: 38px; background: rgba(255,255,255,0.20); }

    /* ================================================================
       SECTION GENERIC
       ================================================================ */
    .lp-section { padding: 88px 5%; }
    .lp-section-white { background: #fff; }

    .section-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      color: var(--c-primary);
      font-size: 12.5px; font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.09em;
      margin-bottom: 14px;
    }

    .section-eyebrow-bar {
      display: inline-block;
      width: 22px; height: 3px;
      background: var(--c-accent);
      border-radius: 2px;
    }

    .section-heading {
      font-size: clamp(26px, 3.5vw, 42px);
      font-weight: 800;
      color: var(--c-text);
      letter-spacing: -0.03em;
      line-height: 1.18;
      margin-bottom: 14px;
    }

    .section-desc {
      font-size: 16px;
      color: var(--c-text-muted);
      max-width: 520px;
      line-height: 1.72;
      margin-bottom: 52px;
    }

    /* ================================================================
       LATAR BELAKANG — Glassmorphism Single-Card Carousel
       ================================================================ */
    .latar-section {
      padding: 88px 5%;
      background: linear-gradient(160deg, #0D1F35 0%, #1E3F5C 60%, #0D2A45 100%);
      position: relative;
      overflow: hidden;
    }

    .latar-section::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 55% 60% at 80% 30%, rgba(242,183,5,0.10) 0%, transparent 65%),
        radial-gradient(ellipse 50% 50% at 10% 80%, rgba(48,97,140,0.25) 0%, transparent 65%);
      pointer-events: none;
    }

    .latar-section .section-eyebrow { color: var(--c-accent); }
    .latar-section .section-heading { color: #fff; }
    .latar-section .section-desc { color: rgba(255,255,255,0.58); margin-bottom: 44px; }

    /* Single card wrapper */
    .latar-card-stage {
      position: relative;
      width: 100%;
      max-width: 680px;
      margin: 0 auto;
    }

    /* Cards stack */
    .latar-card-list {
      position: relative;
      height: 340px;
    }

    .latar-card {
      position: absolute;
      inset: 0;
      /* Glassmorphism */
      background: rgba(255,255,255,0.08);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255,255,255,0.18);
      border-radius: var(--radius-lg);
      padding: 44px 48px;
      box-shadow:
        0 8px 40px rgba(0,0,0,0.30),
        inset 0 1px 0 rgba(255,255,255,0.12);
      opacity: 0;
      transform: translateX(60px) scale(0.97);
      transition: opacity 0.55s cubic-bezier(.4,0,.2,1), transform 0.55s cubic-bezier(.4,0,.2,1);
      pointer-events: none;
    }

    .latar-card.active {
      opacity: 1;
      transform: translateX(0) scale(1);
      pointer-events: auto;
    }

    .latar-card.exit {
      opacity: 0;
      transform: translateX(-60px) scale(0.97);
    }

    /* Accent top bar on each card */
    .latar-card::before {
      content: '';
      position: absolute;
      top: 0; left: 48px; right: 48px;
      height: 3px;
      border-radius: 0 0 3px 3px;
    }

    .latar-card-1::before { background: linear-gradient(90deg, var(--c-accent), #ffcc30); }
    .latar-card-2::before { background: linear-gradient(90deg, #22D3C5, #0E8A7F); }
    .latar-card-3::before { background: linear-gradient(90deg, #A78BFA, #7C3AED); }
    .latar-card-4::before { background: linear-gradient(90deg, #FB7185, #E11D48); }
    .latar-card-5::before { background: linear-gradient(90deg, var(--c-primary-light), var(--c-primary)); }

    .latar-card-number {
      font-size: 12px; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.10em;
      margin-bottom: 18px;
    }

    .latar-card-1 .latar-card-number { color: var(--c-accent); }
    .latar-card-2 .latar-card-number { color: #22D3C5; }
    .latar-card-3 .latar-card-number { color: #A78BFA; }
    .latar-card-4 .latar-card-number { color: #FB7185; }
    .latar-card-5 .latar-card-number { color: var(--c-primary-light); }

    .latar-card h4 {
      font-size: 22px; font-weight: 800;
      color: #fff;
      letter-spacing: -0.025em;
      line-height: 1.28;
      margin-bottom: 16px;
    }

    .latar-card p {
      font-size: 15px; line-height: 1.76;
      color: rgba(255,255,255,0.68);
    }

    /* Card controls */
    .latar-controls {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 32px;
      max-width: 680px;
      margin-left: auto;
      margin-right: auto;
    }

    .latar-dots {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .latar-dot {
      width: 8px; height: 8px;
      border-radius: 50%;
      background: rgba(255,255,255,0.25);
      cursor: pointer;
      transition: all 0.35s ease;
      border: none;
      padding: 0;
    }

    .latar-dot.active {
      width: 26px;
      border-radius: 4px;
      background: var(--c-accent);
    }

    .latar-nav-btns { display: flex; gap: 10px; }

    .latar-nav-btn {
      width: 46px; height: 46px;
      border-radius: 50%;
      border: 1.5px solid rgba(255,255,255,0.22);
      background: rgba(255,255,255,0.08);
      color: #fff;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: var(--transition);
      backdrop-filter: blur(8px);
    }

    .latar-nav-btn:hover {
      background: rgba(242,183,5,0.25);
      border-color: var(--c-accent);
      color: var(--c-accent);
    }

    .latar-card-counter {
      font-size: 13px; font-weight: 600;
      color: rgba(255,255,255,0.45);
      letter-spacing: 0.05em;
    }

    /* ================================================================
       FITUR UTAMA
       ================================================================ */
    .fitur-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    @media (max-width: 900px) { .fitur-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 560px) { .fitur-grid { grid-template-columns: 1fr; } }

    .fitur-card {
      background: #fff;
      border-radius: var(--radius-lg);
      padding: 34px 30px;
      box-shadow: 0 4px 24px rgba(48,97,140,0.08);
      border: 1.5px solid var(--c-border);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .fitur-card::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--c-primary), var(--c-primary-light));
      opacity: 0;
      transition: var(--transition);
    }

    .fitur-card:hover { transform: translateY(-6px); box-shadow: 0 16px 44px rgba(48,97,140,0.14); }
    .fitur-card:hover::after { opacity: 1; }

    .fitur-card-icon {
      width: 56px; height: 56px;
      border-radius: var(--radius-md);
      background: linear-gradient(135deg, rgba(48,97,140,0.12), rgba(74,136,192,0.08));
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 22px;
      box-shadow: 0 4px 14px rgba(48,97,140,0.14);
    }

    .fitur-card-icon.accent-yellow { background: linear-gradient(135deg, rgba(242,183,5,0.15), rgba(242,183,5,0.08)); }
    .fitur-card-icon.accent-teal   { background: linear-gradient(135deg, rgba(14,138,127,0.15), rgba(34,211,197,0.08)); }

    .fitur-card h4 {
      font-size: 18px; font-weight: 800;
      color: var(--c-text); letter-spacing: -0.02em;
      margin-bottom: 10px;
    }

    .fitur-card p {
      font-size: 14px; line-height: 1.70;
      color: var(--c-text-muted);
    }

    /* ================================================================
       CARA KERJA
       ================================================================ */
    .cara-kerja-section {
      padding: 88px 5%;
      background: linear-gradient(180deg, var(--c-bg) 0%, #EEF4FA 100%);
    }

    .cara-kerja-steps {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      position: relative;
    }

    @media (max-width: 900px) { .cara-kerja-steps { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 540px) { .cara-kerja-steps { grid-template-columns: 1fr; } }

    .cara-kerja-steps::before {
      content: '';
      position: absolute;
      top: 36px;
      left: calc(12.5% + 24px);
      right: calc(12.5% + 24px);
      height: 2px;
      background: linear-gradient(90deg, var(--c-border), var(--c-primary-light), var(--c-border));
    }

    @media (max-width: 900px) { .cara-kerja-steps::before { display: none; } }

    .cara-step {
      text-align: center;
      padding: 28px 20px 24px;
      background: #fff;
      border-radius: var(--radius-lg);
      border: 1.5px solid var(--c-border);
      box-shadow: 0 3px 14px rgba(48,97,140,0.06);
      transition: var(--transition);
      position: relative;
    }

    .cara-step:hover { transform: translateY(-5px); box-shadow: 0 12px 36px rgba(48,97,140,0.14); }

    .cara-step-num {
      width: 52px; height: 52px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--c-primary), var(--c-primary-light));
      color: #fff;
      font-size: 18px; font-weight: 900;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 6px 18px rgba(48,97,140,0.28);
      position: relative;
      z-index: 1;
    }

    .cara-step h4 { font-size: 15px; font-weight: 700; color: var(--c-text); margin-bottom: 8px; }
    .cara-step p  { font-size: 13px; color: var(--c-text-muted); line-height: 1.65; }

    /* ================================================================
       TESTIMONI / STATS BAND
       ================================================================ */
    .stats-band {
      padding: 64px 5%;
      background: linear-gradient(135deg, var(--c-primary) 0%, #1E4A6E 100%);
    }

    .stats-band-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 0;
    }

    @media (max-width: 700px) { .stats-band-grid { grid-template-columns: 1fr 1fr; } }

    .stat-item {
      text-align: center;
      padding: 20px;
      border-right: 1px solid rgba(255,255,255,0.12);
    }

    .stat-item:last-child { border-right: none; }

    .stat-num { font-size: 36px; font-weight: 900; color: var(--c-accent); letter-spacing: -0.04em; }
    .stat-label { font-size: 14px; color: rgba(255,255,255,0.68); margin-top: 6px; font-weight: 500; }

    /* ================================================================
       CTA SECTION
       ================================================================ */
    .lp-cta-section {
      padding: 96px 5%;
      background: #fff;
      text-align: center;
    }

    .lp-cta-inner {
      max-width: 600px;
      margin: 0 auto;
    }

    .lp-cta-inner .section-heading { margin-bottom: 16px; }
    .lp-cta-inner .section-desc { margin: 0 auto 40px; text-align: center; }

    .btn-cta-big {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      padding: 17px 42px;
      background: linear-gradient(135deg, var(--c-primary), var(--c-primary-light));
      color: #fff;
      font-size: 17px; font-weight: 800;
      border-radius: var(--radius-md);
      text-decoration: none;
      box-shadow: 0 10px 32px rgba(48,97,140,0.32);
      transition: var(--transition);
      font-family: var(--font);
    }

    .btn-cta-big:hover { transform: translateY(-3px); box-shadow: 0 16px 44px rgba(48,97,140,0.44); }

    .lp-cta-sub { margin-top: 16px; font-size: 13.5px; color: var(--c-text-muted); }

    /* ================================================================
       FOOTER
       ================================================================ */
    .lp-footer {
      background: #0D1F35;
      color: rgba(255,255,255,0.65);
      padding: 64px 5% 32px;
    }

    .lp-footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      gap: 48px;
      margin-bottom: 52px;
    }

    @media (max-width: 800px) { .lp-footer-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 480px) { .lp-footer-grid { grid-template-columns: 1fr; } }

    .footer-brand-name { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 12px; }
    .footer-brand-name span { color: var(--c-accent); }

    .footer-desc {
      font-size: 14px; line-height: 1.72;
      color: rgba(255,255,255,0.48);
      margin-bottom: 22px; max-width: 270px;
    }

    .footer-social { display: flex; gap: 10px; }

    .footer-social a {
      width: 36px; height: 36px;
      border-radius: var(--radius-sm);
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.12);
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,0.65);
      text-decoration: none;
      transition: var(--transition);
    }

    .footer-social a:hover { background: var(--c-primary); border-color: var(--c-primary); color: #fff; }

    .footer-col-title {
      font-size: 13px; font-weight: 700;
      color: #fff; text-transform: uppercase;
      letter-spacing: 0.08em; margin-bottom: 18px;
    }

    .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }

    .footer-links a {
      text-decoration: none;
      color: rgba(255,255,255,0.55);
      font-size: 14px;
      transition: color var(--transition);
    }

    .footer-links a:hover { color: #fff; }

    .lp-footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.08);
      padding-top: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }

    .footer-copy { font-size: 13px; color: rgba(255,255,255,0.35); }

    /* ================================================================
       RESPONSIVE NAV
       ================================================================ */
    .lp-menu-toggle {
      display: none;
      background: none; border: none;
      color: #fff; cursor: pointer;
      padding: 4px;
    }

    @media (max-width: 820px) {
      .lp-nav-links { display: none; }
      .lp-menu-toggle { display: block; }
      .lp-hero h1 { font-size: clamp(32px, 7vw, 52px); }
      .lp-hero-stats { gap: 18px; margin-top: 36px; }
    }

    @media (max-width: 580px) {
      .lp-hero-cta { flex-direction: column; align-items: flex-start; }
      .lp-section, .latar-section, .cara-kerja-section, .lp-cta-section { padding: 60px 5%; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="lp-navbar" id="lpNavbar" role="navigation" aria-label="Navigasi utama">
    <a href="{{ route('home') }}" class="lp-brand" aria-label="B-Youth Beranda">
      <div class="lp-brand-logo" style="background:transparent; box-shadow:none;">
        <img src="{{ asset('foto/logo.png') }}" alt="B-Youth Logo" style="width:38px; height:38px; object-fit:contain;">
      </div>
      <span class="lp-brand-name">B-<span>Youth</span></span>
    </a>

    <ul class="lp-nav-links" role="list">
      <li><a href="#fitur">Fitur</a></li>
      <li><a href="#latar-belakang">Tentang</a></li>
      <li><a href="#cara-kerja">Cara Kerja</a></li>
    </ul>

    <div class="lp-nav-actions">
      <a href="{{ route('login') }}" class="btn-nav-login" id="navLoginBtn">Masuk</a>
      <a href="{{ route('register') }}" class="btn-nav-register" id="navRegisterBtn">Daftar</a>
    </div>
    <button class="lp-menu-toggle" id="menuToggle" aria-label="Buka menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
  </nav>

  <!-- ================================================================
       HERO — Full-Screen Slideshow
       ================================================================ -->
  <section class="lp-hero" id="beranda" aria-label="Hero utama">

    <div class="hero-slides" aria-hidden="true">
      <div class="hero-slide active" style="background-image: url('{{ asset('foto/landingpage1.jpeg') }}')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage2.jpeg') }}')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage3.jpeg') }}')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage4.jpeg') }}')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage5.jpeg') }}')"></div>
    </div>

    <div class="lp-hero-content">
      <h1>
        Temukan Pilihan<br>
        <span class="hero-highlight">Program Studi</span>
      </h1>

      <p class="lp-hero-desc">
        B-Youth mendampingi siswa SMA/SMK mengenali minat dan bakat untuk menemukan pilihan program studi yang sesuai, dilengkapi bimbingan konseling bersama psikolog.
      </p>

      <div class="lp-hero-cta">
        <a href="{{ route('register') }}" class="btn-hero-primary" id="heroBtnDaftar">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
          Daftar Akun
        </a>
        <a href="{{ route('login') }}" class="btn-hero-secondary" id="heroBtnMasuk">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          Sudah Punya Akun
        </a>
      </div>
    </div>

    <!-- Slide Dots -->
    <div class="hero-slide-dots" role="tablist" aria-label="Navigasi slide">
      <button class="hero-slide-dot active" role="tab" aria-selected="true" aria-label="Slide 1" data-slide="0"></button>
      <button class="hero-slide-dot" role="tab" aria-selected="false" aria-label="Slide 2" data-slide="1"></button>
      <button class="hero-slide-dot" role="tab" aria-selected="false" aria-label="Slide 3" data-slide="2"></button>
      <button class="hero-slide-dot" role="tab" aria-selected="false" aria-label="Slide 4" data-slide="3"></button>
      <button class="hero-slide-dot" role="tab" aria-selected="false" aria-label="Slide 5" data-slide="4"></button>
    </div>

    <!-- Progress bar -->
    <div class="hero-progress" id="heroProgress" aria-hidden="true"></div>
  </section>

  <!-- ================================================================
       FITUR UTAMA
       ================================================================ -->
  <section class="lp-section lp-section-white" id="fitur" aria-labelledby="fiturHeading">
    <div class="section-eyebrow"><span class="section-eyebrow-bar"></span> Fitur Utama</div>
    <h2 class="section-heading" id="fiturHeading">Bimbingan &amp; Pemetaan Minat Terpadu</h2>
    <p class="section-desc">Dari asesmen minat bakat hingga konsultasi langsung — B-Youth hadir untuk mendampingi pemilihan program studi yang tepat.</p>

    <div class="fitur-grid">
      <div class="fitur-card">
        <div class="fitur-card-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#30618C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
        </div>
        <h4>Rekomendasi AI</h4>
        <p>Sistem kecerdasan buatan kami menganalisis profil, minat, dan nilai akademikmu untuk memberikan rekomendasi program studi yang paling sesuai.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-card-icon accent-yellow">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#9A7000" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h4>Asesmen Minat Bakat</h4>
        <p>Ikuti tes psikometri berbasis MBTI dan Holland Code untuk mengenali kekuatan, minat, dan potensi terbesarmu secara mendalam.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-card-icon accent-teal">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0E8A7F" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h4>Konseling Profesional</h4>
        <p>Jadwalkan sesi konsultasi langsung dengan psikolog untuk mendapat panduan pemilihan program studi yang terarah.</p>
      </div>
    </div>
  </section>

  <!-- ================================================================
       LATAR BELAKANG B-YOUTH — Glassmorphism Single Card
       ================================================================ -->
  <section class="latar-section" id="latar-belakang" aria-labelledby="latarHeading">
    <div class="section-eyebrow"><span class="section-eyebrow-bar" style="background:var(--c-accent)"></span> Latar Belakang</div>
    <h2 class="section-heading" id="latarHeading">Tantangan Pemilihan Program Studi</h2>
    <p class="section-desc">Kami percaya setiap siswa berhak mendapat pendampingan pemilihan program studi yang tepat dan terarah.</p>

    <div class="latar-card-stage">
      <div class="latar-card-list" id="latarCardList" role="region" aria-label="Kartu latar belakang B-Youth" aria-live="polite">

        <div class="latar-card latar-card-1 active" role="article" aria-label="Latar belakang 1 dari 5">
          <div class="latar-card-number">01 / 05</div>
          <h4>Tantangan Menentukan Program Studi</h4>
          <p>Banyak siswa merasa ragu menentukan pilihan program studi di perguruan tinggi. Kurangnya pemetaan minat dan informasi terstruktur menjadi faktor utama yang dihadapi siswa.</p>
        </div>

        <div class="latar-card latar-card-2" role="article" aria-label="Latar belakang 2 dari 5">
          <div class="latar-card-number">02 / 05</div>
          <h4>Kebutuhan Bimbingan yang Tepat</h4>
          <p>Rasio konselor bimbingan di berbagai sekolah yang terbatas membuat banyak siswa memerlukan sarana pendukung tambahan untuk mengeksplorasi potensi diri secara mandiri.</p>
        </div>

        <div class="latar-card latar-card-3" role="article" aria-label="Latar belakang 3 dari 5">
          <div class="latar-card-number">03 / 05</div>
          <h4>Pemanfaatan Teknologi untuk Pemetaan Minat</h4>
          <p>B-Youth memanfaatkan teknologi analisis untuk mengolah data minat dan potensi belajar guna memberikan rekomendasi program studi yang terstruktur dan terukur.</p>
        </div>

        <div class="latar-card latar-card-4" role="article" aria-label="Latar belakang 4 dari 5">
          <div class="latar-card-number">04 / 05</div>
          <h4>Misi Kami: Akses Bimbingan Program Studi Merata</h4>
          <p>B-Youth hadir untuk memastikan setiap siswa dapat mengakses layanan pemetaan program studi dan konseling pendidikan yang terarah.</p>
        </div>

        <div class="latar-card latar-card-5" role="article" aria-label="Latar belakang 5 dari 5">
          <div class="latar-card-number">05 / 05</div>
          <h4>Visi Jangka Panjang B-Youth</h4>
          <p>Mendukung generasi muda Indonesia menemukan program studi yang tepat guna mempersiapkan langkah pendidikan masa depan mereka.</p>
        </div>

      </div>
    </div>

    <div class="latar-controls">
      <div class="latar-dots" id="latarDots" role="tablist" aria-label="Navigasi kartu">
        <button class="latar-dot active" role="tab" aria-selected="true" aria-label="Kartu 1" data-latar="0"></button>
        <button class="latar-dot" role="tab" aria-selected="false" aria-label="Kartu 2" data-latar="1"></button>
        <button class="latar-dot" role="tab" aria-selected="false" aria-label="Kartu 3" data-latar="2"></button>
        <button class="latar-dot" role="tab" aria-selected="false" aria-label="Kartu 4" data-latar="3"></button>
        <button class="latar-dot" role="tab" aria-selected="false" aria-label="Kartu 5" data-latar="4"></button>
      </div>

      <span class="latar-card-counter" id="latarCounter" aria-live="polite">1 / 5</span>

      <div class="latar-nav-btns">
        <button class="latar-nav-btn" id="latarPrev" aria-label="Kartu sebelumnya">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button class="latar-nav-btn" id="latarNext" aria-label="Kartu berikutnya">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </div>
  </section>

  <!-- ================================================================
       CARA KERJA
       ================================================================ -->
  <section class="cara-kerja-section" id="cara-kerja" aria-labelledby="caraKerjaHeading">
    <div class="section-eyebrow"><span class="section-eyebrow-bar"></span> Cara Kerja</div>
    <h2 class="section-heading" id="caraKerjaHeading">Mulai dalam 4 Langkah</h2>
    <p class="section-desc">Proses terstruktur untuk membantumu menemukan program studi yang tepat.</p>

    <div class="cara-kerja-steps">
      <div class="cara-step">
        <div class="cara-step-num">1</div>
        <h4>Daftar Akun</h4>
        <p>Buat akun siswa dengan mengisi data diri dan informasi asal sekolahmu.</p>
      </div>
      <div class="cara-step">
        <div class="cara-step-num">2</div>
        <h4>Ikuti Asesmen</h4>
        <p>Jawab pertanyaan asesmen minat bakat untuk memetakan potensi belajarmu.</p>
      </div>
      <div class="cara-step">
        <div class="cara-step-num">3</div>
        <h4>Dapatkan Rekomendasi</h4>
        <p>Sistem memproses hasil asesmen dan memberikan rekomendasi program studi yang sesuai.</p>
      </div>
      <div class="cara-step">
        <div class="cara-step-num">4</div>
        <h4>Konsultasi Langsung</h4>
        <p>Jadwalkan sesi konseling dengan psikolog untuk mendiskusikan rencana program studi secara mendalam.</p>
      </div>
    </div>
  </section>

  <!-- ================================================================
       CTA SECTION
       ================================================================ -->
  <section class="lp-cta-section" aria-labelledby="ctaHeading">
    <div class="lp-cta-inner">
      <div class="section-eyebrow" style="justify-content:center"><span class="section-eyebrow-bar"></span> Mulai Sekarang</div>
      <h2 class="section-heading" id="ctaHeading" style="text-align:center">Siap Menentukan Program Studi Pilihanmu?</h2>
      <p class="section-desc" style="text-align:center">Mulai asesmen minat bakat untuk mengetahui pilihan program studi yang paling sesuai dengan potensimu.</p>
      <a href="{{ route('register') }}" class="btn-cta-big" id="ctaBtnDaftar">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        Daftar Akun Sekarang
      </a>
      <p class="lp-cta-sub">Daftar dan mulai eksplorasi program studi pilihanmu.</p>
    </div>
  </section>

  <!-- ================================================================
       FOOTER
       ================================================================ -->
  <footer class="lp-footer" role="contentinfo">
    <div class="lp-footer-grid">
      <div>
        <div class="footer-brand-name" style="display:flex; align-items:center; gap:8px;">
          <img src="{{ asset('foto/logo.png') }}" alt="B-Youth Logo" style="width:28px; height:28px; object-fit:contain; background:#fff; border-radius:6px; padding:2px;">
          B-<span>Youth</span>
        </div>
        <p class="footer-desc">Platform rekomendasi program studi dan konseling psikologi pendidikan untuk siswa.</p>
        <div class="footer-social">
          <a href="#" aria-label="Instagram B-Youth">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" aria-label="Twitter B-Youth">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
          </a>
          <a href="#" aria-label="YouTube B-Youth">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
          </a>
        </div>
      </div>

      <div>
        <div class="footer-col-title">Platform</div>
        <ul class="footer-links">
          <li><a href="#fitur">Fitur</a></li>
          <li><a href="#cara-kerja">Cara Kerja</a></li>
          <li><a href="#latar-belakang">Tentang Kami</a></li>
          <li><a href="{{ route('register') }}">Daftar Siswa</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">Layanan</div>
        <ul class="footer-links">
          <li><a href="#">Asesmen Minat Bakat</a></li>
          <li><a href="#">Rekomendasi AI</a></li>
          <li><a href="#">Konseling Online</a></li>
          <li><a href="#">Data Akademik</a></li>
        </ul>
      </div>
    </div>

    <div class="lp-footer-bottom">
      <span class="footer-copy">&copy; {{ date('Y') }} B-Youth (Buddy for Youth). Semua hak dilindungi.</span>
      <div style="display:flex; gap:20px;">
        <a href="#" style="font-size:13px; color:rgba(255,255,255,0.35); text-decoration:none;">Kebijakan Privasi</a>
        <a href="#" style="font-size:13px; color:rgba(255,255,255,0.35); text-decoration:none;">Syarat &amp; Ketentuan</a>
      </div>
    </div>
  </footer>

  <script>
    /* ================================================================
       NAVBAR — Scroll effect
       ================================================================ */
    const navbar = document.getElementById('lpNavbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });

    /* ================================================================
       HERO — Auto-slideshow with progress bar
       ================================================================ */
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroSlidesDots = document.querySelectorAll('.hero-slide-dot');
    const heroProgress = document.getElementById('heroProgress');
    let heroCurrentSlide = 0;
    let heroTimer = null;
    const HERO_INTERVAL = 5500; // ms per slide

    function goToHeroSlide(index) {
      heroSlides[heroCurrentSlide].classList.remove('active');
      heroSlidesDots[heroCurrentSlide].classList.remove('active');
      heroSlidesDots[heroCurrentSlide].setAttribute('aria-selected', 'false');
      heroCurrentSlide = (index + heroSlides.length) % heroSlides.length;
      heroSlides[heroCurrentSlide].classList.add('active');
      heroSlidesDots[heroCurrentSlide].classList.add('active');
      heroSlidesDots[heroCurrentSlide].setAttribute('aria-selected', 'true');
      startHeroProgress();
    }

    function startHeroProgress() {
      heroProgress.style.transition = 'none';
      heroProgress.style.width = '0%';
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          heroProgress.style.transition = `width ${HERO_INTERVAL}ms linear`;
          heroProgress.style.width = '100%';
        });
      });
    }

    function startHeroAuto() {
      if (heroTimer) clearInterval(heroTimer);
      heroTimer = setInterval(() => {
        goToHeroSlide(heroCurrentSlide + 1);
      }, HERO_INTERVAL);
    }

    heroSlidesDots.forEach(dot => {
      dot.addEventListener('click', () => {
        const idx = parseInt(dot.dataset.slide);
        goToHeroSlide(idx);
        startHeroAuto();
      });
    });

    startHeroProgress();
    startHeroAuto();

    /* ================================================================
       LATAR BELAKANG — Single-card glassmorphism carousel
       ================================================================ */
    const latarCards = document.querySelectorAll('.latar-card');
    const latarDots  = document.querySelectorAll('.latar-dot');
    const latarCounter = document.getElementById('latarCounter');
    let latarCurrent = 0;
    let latarTimer = null;

    function goToLatar(next, direction) {
      const prev = latarCurrent;
      latarCards[prev].classList.remove('active');
      latarCards[prev].classList.add(direction === 'next' ? 'exit' : 'exit-right');
      latarDots[prev].classList.remove('active');
      latarDots[prev].setAttribute('aria-selected', 'false');

      setTimeout(() => { latarCards[prev].classList.remove('exit', 'exit-right'); }, 600);

      latarCurrent = (next + latarCards.length) % latarCards.length;
      latarCards[latarCurrent].classList.add('active');
      latarDots[latarCurrent].classList.add('active');
      latarDots[latarCurrent].setAttribute('aria-selected', 'true');
      latarCounter.textContent = `${latarCurrent + 1} / ${latarCards.length}`;
    }

    document.getElementById('latarNext').addEventListener('click', () => {
      goToLatar(latarCurrent + 1, 'next');
      if (latarTimer) { clearInterval(latarTimer); startLatarAuto(); }
    });

    document.getElementById('latarPrev').addEventListener('click', () => {
      goToLatar(latarCurrent - 1, 'prev');
      if (latarTimer) { clearInterval(latarTimer); startLatarAuto(); }
    });

    latarDots.forEach(dot => {
      dot.addEventListener('click', () => {
        const idx = parseInt(dot.dataset.latar);
        goToLatar(idx, idx > latarCurrent ? 'next' : 'prev');
        if (latarTimer) { clearInterval(latarTimer); startLatarAuto(); }
      });
    });

    // Keyboard navigation for latar carousel
    document.getElementById('latarCardList').addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') { goToLatar(latarCurrent + 1, 'next'); }
      if (e.key === 'ArrowLeft')  { goToLatar(latarCurrent - 1, 'prev'); }
    });

    function startLatarAuto() {
      latarTimer = setInterval(() => { goToLatar(latarCurrent + 1, 'next'); }, 6000);
    }

    startLatarAuto();

    /* ================================================================
       SCROLL REVEAL — subtle fade-in on scroll
       ================================================================ */
    const revealEls = document.querySelectorAll('.fitur-card, .cara-step, .latar-card-stage');
    const revealObs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.12 });

    revealEls.forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(28px)';
      el.style.transition = 'opacity 0.60s ease, transform 0.60s ease';
      revealObs.observe(el);
    });
  </script>
</body>
</html>
