{{--
  B-YOUTH: ASESMEN & REKOMENDASI PAGE
  - 1 pertanyaan per tampilan, berganti setelah dijawab
  - Likert scale: Sangat Tidak Setuju s/d Sangat Setuju (bulatan)
  - Color palette: #30618C #F2B705 #FAE08F #D6D494 #B9D0E4 #FFFFFF
--}}
@extends('Siswa.layouts.app', [
    'title'     => 'Asesmen & Rekomendasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Asesmen & Rekomendasi',
    'active'    => 'asesmen'
])

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/Siswa/asesmen.css') }}">
@endpush

@section('content')

  {{-- ── Page Header ── --}}
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <h2>
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
        </svg>
        Asesmen Minat &amp; Bakat
      </h2>
      <p>Jawab setiap pertanyaan secara jujur untuk mendapatkan rekomendasi jurusan yang paling sesuai denganmu.</p>
    </div>
  </div>

  {{-- ── Progress Card ── --}}
  <div class="asesmen-progress-card">
    <div class="asesmen-progress-header">
      <div class="asesmen-progress-label">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>Progress: <strong id="asesmenProgressText">0 / 6 Pertanyaan</strong></span>
      </div>
      <span class="asesmen-progress-badge" id="asesmenProgressBadge">0% Selesai</span>
    </div>
    <div class="asesmen-progress-track">
      <div class="asesmen-progress-fill" id="asesmenProgressFill" style="width:0%"></div>
    </div>
    <div class="asesmen-step-dots" id="asesmenStepDots"></div>
  </div>

  {{-- ── Single Question Wrapper (JS renders here) ── --}}
  <div class="asesmen-question-wrapper" id="asesmenQuestionWrapper"></div>

  {{-- ── Navigation Row ── --}}
  <div class="asesmen-nav-row" id="asesmenNavRow">
    <button type="button" class="btn-asesmen-prev" id="btnAsesmenPrev" style="display:none">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      Sebelumnya
    </button>

    <span class="asesmen-hint" id="asesmenHint">Pilih jawaban untuk melanjutkan ke pertanyaan berikutnya.</span>

    <div style="display:flex; gap:10px;">
      <button type="button" class="btn-asesmen-next" id="btnAsesmenNext" disabled>
        Lanjut
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </button>
      <button type="button" class="btn-asesmen-finish" id="btnAsesmenFinish" style="display:none">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        Selesai &amp; Analisis
      </button>
    </div>
  </div>

  {{-- ── Completion Panel ── --}}
  <div class="asesmen-complete-panel" id="asesmenCompletePanel">
    <div class="asesmen-complete-icon">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F2B705" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <h3>Asesmen Selesai!</h3>
    <p>Semua pertanyaan telah dijawab. Sistem AI B-Youth sedang menganalisis profilmu dan menyiapkan rekomendasi jurusan terbaik.</p>
    <button type="button" class="btn-lihat-rekomendasi" id="btnShowRec">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Lihat Rekomendasi Jurusan
    </button>
  </div>

  {{-- ── Recommendation Cards (hidden until asesmen done) ── --}}
  <section class="rec-section" id="recSection" style="display:none">
    <div class="rec-section-title">Kartu Rekomendasi Program Studi</div>
    <p class="rec-section-sub">Berdasarkan profil minat bakat, nilai akademik, dan jawaban asesmen kamu.</p>

    <div class="rec-cards-grid">

      {{-- Card 1 --}}
      <div class="rec-card">
        <div class="rec-cluster">Rumpun Interdisipliner</div>
        <span class="rec-match">91% Kecocokan</span>
        <h4 class="rec-title">Sistem Informasi &amp; Manajemen Bisnis Digital</h4>
        <p class="rec-desc">Menjembatani keahlian teknologi dengan manajemen strategis organisasi dan inovasi startup modern.</p>
        <div class="rec-karier-label">Peluang Karier:</div>
        <div class="rec-tags">
          <span class="rec-tag">Product Manager</span>
          <span class="rec-tag">IT Consultant</span>
          <span class="rec-tag">Business Analyst</span>
        </div>
        <div class="rec-kampus"><strong>Kampus:</strong> UI, ITS, Binus, Telkom University</div>
        <a href="{{ route('siswa.konsultasi') }}" class="btn-rec-cta btn-rec-secondary">Konsultasikan Jurusan</a>
      </div>

      {{-- Card 2 - Primary --}}
      <div class="rec-card primary-rec">
        <span class="rec-top-badge">Terbaik untukmu</span>
        <div class="rec-cluster">Sains &amp; Rekayasa Teknologi</div>
        <span class="rec-match high">96% Kesesuaian</span>
        <h4 class="rec-title">Teknik Informatika &amp; Rekayasa AI</h4>
        <p class="rec-desc">Sangat selaras dengan skor logika tinggimu dan ketertarikan pada problem solving algoritmik serta teknologi mutakhir.</p>
        <div class="rec-karier-label">Peluang Karier:</div>
        <div class="rec-tags">
          <span class="rec-tag">AI/ML Engineer</span>
          <span class="rec-tag">Software Architect</span>
          <span class="rec-tag">Data Scientist</span>
        </div>
        <div class="rec-kampus"><strong>Kampus:</strong> ITB, UI, UGM, ITS, Polibatam</div>
        <a href="{{ route('siswa.konsultasi') }}" class="btn-rec-cta btn-rec-primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          Konsultasi Psikolog
        </a>
      </div>

      {{-- Card 3 --}}
      <div class="rec-card">
        <div class="rec-cluster">Industri Kreatif &amp; Media</div>
        <span class="rec-match">86% Kecocokan</span>
        <h4 class="rec-title">Desain Komunikasi Visual &amp; UI/UX</h4>
        <p class="rec-desc">Menggabungkan kepekaan estetika desain visual dengan psikologi interaksi pengguna dalam produk digital.</p>
        <div class="rec-karier-label">Peluang Karier:</div>
        <div class="rec-tags">
          <span class="rec-tag">UI/UX Designer</span>
          <span class="rec-tag">Creative Director</span>
          <span class="rec-tag">Interaction Designer</span>
        </div>
        <div class="rec-kampus"><strong>Kampus:</strong> ITB (FSRD), ISI Yogyakarta, UMN, Telkom</div>
        <a href="{{ route('siswa.konsultasi') }}" class="btn-rec-cta btn-rec-secondary">Konsultasikan Jurusan</a>
      </div>

    </div>
  </section>

@endsection

@push('scripts')
  <script src="{{ asset('js/Siswa/asesmen.js') }}"></script>
@endpush
