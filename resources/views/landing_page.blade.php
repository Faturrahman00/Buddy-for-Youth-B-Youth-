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
  <link rel="stylesheet" href="{{ asset('css/byouth-dialog.css') }}">

  <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
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
      <li><a href="#prodi">Program Studi</a></li>
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
      <div class="hero-slide active" style="background-image: url('{{ asset('foto/landingpage1.jpeg') }}?v=2')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage2.jpeg') }}?v=2')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage3.jpeg') }}?v=2')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage4.jpeg') }}?v=2')"></div>
      <div class="hero-slide" style="background-image: url('{{ asset('foto/landingpage5.jpeg') }}?v=2')"></div>
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
       KATALOG PROGRAM STUDI — 36 Pilihan Program Studi (8 Card per Halaman)
       ================================================================ -->
  @php
    $prodiList = $prodiList ?? \App\Models\ProgramStudi::orderBy('nama_prodi', 'asc')->get();
  @endphp
  <section class="lp-section prodi-section" id="prodi" aria-labelledby="prodiHeading">
    <div class="prodi-section-header">
      <div class="section-eyebrow"><span class="section-eyebrow-bar"></span> Katalog Program Studi</div>
      <h2 class="section-heading" id="prodiHeading">Eksplorasi Pilihan Program Studi</h2>
      <p class="section-desc">Temukan pilihan program studi unggulan masa depanmu, lengkap dengan gambaran bidang keilmuan dan prospek karier lulusan.</p>
    </div>

    <!-- Toolbar: Search Input + Top Pagination Controls -->
    <div class="prodi-toolbar">
      <div class="prodi-search-wrap">
        <svg class="prodi-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="prodiSearchInput" class="prodi-search-input" placeholder="Cari nama program studi atau profesi... (contoh: Informatika, Dokter, Desain)" autocomplete="off">
        <button type="button" id="prodiSearchClear" class="prodi-search-clear" aria-label="Hapus pencarian" style="display:none;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
      </div>

      <div class="prodi-top-pagination">
        <span class="prodi-page-counter">
          Halaman <strong id="topCurrentPage">1</strong> / <span id="topTotalPages">5</span>
        </span>
        <div class="prodi-nav-arrows">
          <button type="button" class="btn-page-arrow btn-prev-page" id="topBtnPrev" aria-label="Halaman Sebelumnya" title="Halaman Sebelumnya">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
          </button>
          <button type="button" class="btn-page-arrow btn-next-page" id="topBtnNext" aria-label="Halaman Berikutnya" title="Halaman Berikutnya">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Prodi Cards Grid (Pajang 8 card per halaman) -->
    <div class="prodi-grid" id="prodiGrid">
      @forelse($prodiList as $prodi)
        @php
          $careers = array_filter(array_map('trim', explode(',', $prodi->prospek_karier ?? '')));
        @endphp
        <div class="prodi-card" 
             data-name="{{ strtolower($prodi->nama_prodi) }}" 
             data-careers="{{ strtolower($prodi->prospek_karier ?? '') }}"
             data-desc="{{ strtolower($prodi->deskripsi_prodi ?? '') }}">
          
          <div class="prodi-card-header">
            <div class="prodi-icon-badge">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                <path d="M6 6h10"></path>
                <path d="M6 10h10"></path>
              </svg>
            </div>
            <span class="prodi-tag">Program Studi</span>
          </div>

          <h3 class="prodi-card-title">{{ $prodi->nama_prodi }}</h3>

          <p class="prodi-card-desc">
            {{ Str::limit($prodi->deskripsi_prodi, 120, '...') }}
          </p>

          <div class="prodi-card-careers">
            <div class="prodi-careers-label">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
              </svg>
              Prospek Karier:
            </div>
            <div class="prodi-career-tags">
              @foreach(array_slice($careers, 0, 3) as $career)
                <span class="career-tag">{{ $career }}</span>
              @endforeach
              @if(count($careers) > 3)
                <span class="career-tag-more">+{{ count($careers) - 3 }} lainnya</span>
              @endif
            </div>
          </div>

          <div class="prodi-card-footer">
            <button type="button" class="btn-prodi-detail" 
                    onclick='openProdiModal(@json($prodi))' 
                    aria-label="Lihat detail {{ $prodi->nama_prodi }}">
              <span>Detail Lengkap</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </button>
            <a href="{{ route('register') }}" class="btn-prodi-consult" title="Konsultasikan pilihan prodi ini di B-Youth">
              Cek Kecocokan
            </a>
          </div>

        </div>
      @empty
        <div class="prodi-empty-server">
          <p>Belum ada data program studi yang tersedia saat ini.</p>
        </div>
      @endforelse
    </div>

    <!-- Empty State for Search Filter -->
    <div class="prodi-empty-state" id="prodiEmptyState" style="display: none;">
      <div class="empty-icon-wrap">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </div>
      <h3>Tidak Ada Program Studi Ditemukan</h3>
      <p>Tidak ada program studi yang cocok dengan pencarian "<span id="emptyQueryText"></span>". Silakan coba kata kunci lain.</p>
      <button type="button" class="btn-reset-filter" id="btnResetProdiFilter">Reset Pencarian</button>
    </div>

    <!-- Bottom Pagination with page numbers and prev/next -->
    <div class="prodi-bottom-pagination" id="prodiBottomPagination">
      <div class="prodi-pagination-controls">
        <button type="button" class="btn-page-step btn-prev-page" id="bottomBtnPrev" aria-label="Halaman Sebelumnya">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
          <span>Sebelumnya</span>
        </button>

        <div class="prodi-page-numbers" id="prodiPageNumbers">
          <!-- Populated by JS: [1] [2] [3] [4] [5] -->
        </div>

        <button type="button" class="btn-page-step btn-next-page" id="bottomBtnNext" aria-label="Halaman Berikutnya">
          <span>Berikutnya</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
      </div>

      <div class="prodi-showing-info">
        Menampilkan <strong id="showingRangeText">1 - 8</strong> dari <strong id="totalCardsText">{{ count($prodiList) }}</strong> program studi
      </div>
    </div>

    <!-- Section Bottom CTA Callout -->
    <div class="prodi-section-callout">
      <div class="callout-content">
        <div class="callout-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F2B705" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
          </svg>
        </div>
        <div>
          <h4>Bingung menentukan prodi yang paling tepat untuk masa depanmu?</h4>
          <p>Ikuti asesmen minat bakat terpadu berstandar psikometri di B-Youth untuk mendapatkan rekomendasi program studi terbaik secara otomatis.</p>
        </div>
      </div>
      <a href="{{ route('register') }}" class="btn-callout-action">
        Mulai Asesmen Minat Bakat
      </a>
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

  <!-- ================================================================
       MODAL DETAIL PROGRAM STUDI
       ================================================================ -->
  <div class="prodi-modal-overlay" id="prodiModalOverlay" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="prodi-modal-card">
      <button type="button" class="prodi-modal-close" id="prodiModalClose" aria-label="Tutup modal">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>

      <div class="prodi-modal-header">
        <div class="prodi-modal-badge-row">
          <span class="prodi-modal-type-tag">Informasi Program Studi</span>
        </div>
        <h3 class="prodi-modal-title" id="modalProdiTitle"></h3>
      </div>

      <div class="prodi-modal-body">
        <div class="modal-section-block">
          <h5 class="modal-block-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path><path d="M6 6h10"></path><path d="M6 10h10"></path></svg>
            Gambaran Bidang Keilmuan
          </h5>
          <p class="modal-prodi-desc" id="modalProdiDesc"></p>
        </div>

        <div class="modal-section-block">
          <h5 class="modal-block-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            Peluang &amp; Prospek Karier Lulusan
          </h5>
          <div class="modal-careers-list" id="modalCareersList"></div>
        </div>
      </div>

      <div class="prodi-modal-footer">
        <button type="button" class="btn-modal-cancel" id="btnModalCancel">Tutup</button>
        <a href="{{ route('register') }}" class="btn-modal-primary">
          <span>Ikuti Asesmen &amp; Cek Kecocokan</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
        </a>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/landing_page.js') }}"></script>
  <script src="{{ asset('js/byouth-dialog.js') }}"></script>
</body>
</html>
