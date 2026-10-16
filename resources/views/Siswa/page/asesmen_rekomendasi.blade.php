{{--
  B-YOUTH: ASESMEN MINAT & REKOMENDASI PROGRAM STUDI (HOLLAND RIASEC + AI SYNERGY)
  - 42 Soal RIASEC dengan skala Likert 5 pilihan (A-E)
  - Slider 0: Petunjuk Pengerjaan & Nilai Rapor (Opsional)
  - Slider 1-42: Pengerjaan Soal Asesmen 1 per 1
  - Slider 43: Catatan Penting tentang Hasil Tes Anda (Disclaimer & Rekomendasi Psikolog)
  - Slider 44: Tampilan Hasil (Holland Code, 3 Tipe Tertinggi/Seri, Rekomendasi AI)
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

  {{-- ── Meta CSRF untuk AJAX ── --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- ── Page Top Action Bar ── --}}
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <div style="display:flex; align-items:center; gap:12px; margin-bottom:4px;">
        <img src="{{ asset('foto/logo.png') }}" alt="Logo B-Youth" style="width:34px; height:34px; object-fit:contain;">
        <h2 style="margin:0;">Asesmen &amp; Rekomendasi Program Studi</h2>
      </div>
      <p>Petakan profil tipe kepribadian dan rekomendasi program studi terbaik melalui 42 butir soal asesmen Holland RIASEC berbasis kecerdasan AI.</p>
    </div>

    @if(isset($latestAsesmen) && $latestAsesmen)
      <div style="display:flex; gap:10px; align-items:center;">
        <button type="button" class="btn-table-action outline" id="btnViewLatestHistory" style="padding:8px 16px; font-weight:700;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Lihat Hasil Terakhir ({{ $latestAsesmen->hasilAsesmen->holland_code ?? 'Tersimpan' }})
        </button>
      </div>
    @endif
  </div>

  {{-- ════════════════════════════════════════════════════════════════════════
       SLIDE 0: INFORMASI DAN PETUNJUK PENGERJAAN & NILAI RAPOR (OPSIONAL)
       ════════════════════════════════════════════════════════════════════════ --}}
  <div id="slideIntro" class="asesmen-intro-card">
    <div class="intro-badge-pill">
      <img src="{{ asset('foto/logo.png') }}" alt="Logo B-Youth" style="width:18px; height:18px; object-fit:contain; margin-right:4px;">
      INFORMASI DAN PETUNJUK PENGERJAAN
    </div>

    <h3 class="intro-title">Mulai Asesmen Holland RIASEC</h3>

    <div class="intro-body-text">
      Melalui 42 pertanyaan terstruktur, kamu akan dapat mengevaluasi kecocokan diri dan rekomendasi program studi perguruan tinggi yang paling selaras dengan kepribadian dan potensi belajarmu.<br><br>
      Luangkan waktu untuk menjawab setiap pertanyaan dengan jujur dan cermat sesuai kondisi diri Anda. Tidak ada jawaban benar atau salah dalam tes ini. Hasil asesmen ini menyajikan profil terpadu Holland RIASEC Anda beserta rekomendasi program studi terbaik.
    </div>

    <div class="intro-callout">
      <strong>Catatan Penting:</strong> Hasil ini tidak dapat dijadikan satu-satunya dasar atau panduan yang pasti dalam menentukan jurusan pendidikan maupun karier di masa depan.<br>
      <em>Selamat mengerjakan, dan semoga sukses!</em>
    </div>

    {{-- ── Box Nilai Rapor (Opsional) ── --}}
    <div class="raport-optional-box {{ !empty($raportGrades) ? 'active' : '' }}" id="raportOptionBox">
      <div class="raport-header-toggle" id="raportToggleHeader">
        <div class="raport-toggle-title">
          <div class="raport-icon-circle">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </div>
          <div>
            <div style="display:flex; align-items:center;">
              <h4>Kaitkan Nilai Rapor dengan Rekomendasi AI</h4>
              <span class="raport-badge-optional">Opsional</span>
            </div>
            <p>Tingkatkan akurasi rekomendasi program studi dengan menyelaraskan minat dan performa akademik.</p>
          </div>
        </div>

        <div style="display:flex; align-items:center; gap:10px;">
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-weight:700; font-size:13.5px; color:var(--c-primary);">
            <input type="checkbox" id="chkUseRaport" {{ !empty($raportGrades) ? 'checked' : '' }} style="width:18px; height:18px; accent-color:var(--c-primary); cursor:pointer;">
            Sertakan Nilai Rapor
          </label>
        </div>
      </div>

      <div class="raport-inputs-grid" id="raportInputsGrid" style="{{ !empty($raportGrades) ? '' : 'display:none;' }}">
        <div class="raport-input-item">
          <label for="inputMtk">Matematika (MTK)</label>
          <input type="number" id="inputMtk" class="raport-input-field" min="0" max="100" placeholder="Contoh: 90" value="{{ $raportGrades['Matematika'] ?? $raportGrades['mtk'] ?? 88 }}">
        </div>

        <div class="raport-input-item">
          <label for="inputIpas">IPAS / IPA (Fisika/Kimia/Bio)</label>
          <input type="number" id="inputIpas" class="raport-input-field" min="0" max="100" placeholder="Contoh: 88" value="{{ $raportGrades['IPAS'] ?? $raportGrades['ipas'] ?? $raportGrades['Fisika'] ?? 86 }}">
        </div>

        <div class="raport-input-item">
          <label for="inputIndo">Bahasa Indonesia</label>
          <input type="number" id="inputIndo" class="raport-input-field" min="0" max="100" placeholder="Contoh: 87" value="{{ $raportGrades['Bahasa Indonesia'] ?? $raportGrades['bahasaindonesia'] ?? 87 }}">
        </div>

        <div class="raport-input-item">
          <label for="inputIng">Bahasa Inggris</label>
          <input type="number" id="inputIng" class="raport-input-field" min="0" max="100" placeholder="Contoh: 90" value="{{ $raportGrades['Bahasa Inggris'] ?? $raportGrades['bahasainggris'] ?? 90 }}">
        </div>
      </div>

      <div class="raport-note">
        💡 <strong>Catatan:</strong> Nilai rapor ini <em>bersifat opsional</em>. Jika dinonaktifkan atau tidak diisi, hasil asesmen minat Anda tetap dihitung <strong>100% akurat</strong> tanpa mengurangi atau mendistorsi skor rekomendasi.
      </div>
    </div>

    {{-- CTA Mulai --}}
    <div style="display:flex; justify-content:flex-end;">
      <button type="button" class="btn-start-asesmen" id="btnStartAsesmen">
        <span>Mulai Pengerjaan Asesmen</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
    </div>
  </div>

  {{-- ════════════════════════════════════════════════════════════════════════
       SLIDE 1-42: PENGERJAAN SOAL ASESMEN (1 PER TAMPILAN)
       ════════════════════════════════════════════════════════════════════════ --}}
  <div id="slideQuestionsContainer" style="display:none;">

    {{-- Progress Card --}}
    <div class="asesmen-progress-card">
      <div class="asesmen-progress-header">
        <div class="asesmen-progress-label">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>Progress: <strong id="asesmenProgressText">0 / 42 Pertanyaan</strong></span>
        </div>
        <span class="asesmen-progress-badge" id="asesmenProgressBadge">0% Selesai</span>
      </div>
      <div class="asesmen-progress-track">
        <div class="asesmen-progress-fill" id="asesmenProgressFill" style="width:0%"></div>
      </div>
      <div class="asesmen-step-dots" id="asesmenStepDots"></div>
    </div>

    {{-- Single Question Card --}}
    <div class="asesmen-question-card" id="asesmenQuestionCard">
      <div id="asesmenCardContent"></div>

      {{-- Navigation Row inside Card --}}
      <div class="asesmen-card-nav" id="asesmenNavRow">
        <button type="button" class="btn-asesmen-prev" id="btnAsesmenPrev" style="display:none">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
          Sebelumnya
        </button>

        <span class="asesmen-hint" id="asesmenHint">Pilih salah satu skala jawaban untuk melanjutkan.</span>

        <div class="asesmen-card-nav-right">
          <button type="button" class="btn-asesmen-next" id="btnAsesmenNext" disabled>
            Selanjutnya
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
          </button>
          <button type="button" class="btn-asesmen-finish" id="btnAsesmenFinish" style="display:none">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            Selesai Menjawab
          </button>
        </div>
      </div>
    </div>

  </div>

  {{-- ════════════════════════════════════════════════════════════════════════
       SLIDE 43: CATATAN PENTING TENTANG HASIL TES ANDA (DISCLAIMER & PSIKOLOG)
       ════════════════════════════════════════════════════════════════════════ --}}
  <div id="slideDisclaimer" class="disclaimer-card" style="display:none;">
    <div class="disclaimer-top-header">
      <div class="disclaimer-icon-wrap">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      </div>
      <div>
        <h3>Catatan Penting tentang Hasil Tes Anda</h3>
        <p>Harap membaca refleksi awal berikut sebelum meninjau hasil profil minat dan rekomendasi program studi.</p>
      </div>
    </div>

    <div class="disclaimer-paragraphs">
      <p>
        Hasil tes ini merupakan gambaran awal mengenai sebagian minat Anda, bukan gambaran utuh tentang siapa diri Anda. Anda memiliki berbagai kemampuan, nilai hidup, pengalaman, kepribadian, dan potensi yang tidak seluruhnya dapat ditangkap melalui tes singkat ini.
      </p>
      <p>
        Hasil ini juga tidak dapat dijadikan satu-satunya dasar atau panduan yang pasti dalam menentukan jurusan pendidikan maupun karier di masa depan. Pilihan tersebut sebaiknya turut mempertimbangkan kemampuan, nilai dan tujuan pribadi, pengalaman, kondisi, serta peluang pendidikan dan pekerjaan yang tersedia.
      </p>
      <p>
        Gunakan hasil ini sebagai bahan refleksi dan eksplorasi untuk mengenal berbagai kemungkinan yang dapat Anda pertimbangkan.
      </p>
    </div>

    <div class="consultation-cta-box">
      <div class="consultation-cta-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
      </div>
      <div class="consultation-cta-text">
        <h4>Ingin mengenal potensi diri dengan lebih mendalam?</h4>
        <p>
          Untuk memperoleh pemahaman yang lebih komprehensif, Anda dapat berkonsultasi dengan psikolog yang tersedia di platform kami atau mengunjungi psikolog terdekat di kota Anda untuk menjalani asesmen psikologi yang sesuai dengan kebutuhan Anda.
        </p>
      </div>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px;">
      <a href="{{ route('siswa.konsultasi') }}" class="btn-table-action outline" style="padding:12px 20px; font-weight:700;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        Jadwalkan Konsultasi Psikolog
      </a>

      <button type="button" class="btn-proceed-results" id="btnProceedToResults">
        <span>Ya, saya mengerti. Tampilkan Hasil Tes</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
    </div>
  </div>

  {{-- ════════════════════════════════════════════════════════════════════════
       SLIDE 44: TAMPILAN HASIL (HOLLAND RIASEC & REKOMENDASI AI PROGRAM STUDI)
       ════════════════════════════════════════════════════════════════════════ --}}
  <div id="slideResults" class="results-dashboard-wrapper" style="display:none;">

    {{-- Hero Card Holland Code --}}
    <div class="holland-hero-card">
      <div class="holland-code-badge-large">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        PROFIL HOLLAND RIASEC: <span id="resHollandCodeText">I–S–R</span>
      </div>
      <h2 class="holland-hero-title" id="resHeroTitle">Hasil Profil Asesmen Holland RIASEC</h2>
      <p class="holland-hero-sub" id="resHeroSub">
        Hasil asesmen ini memetakan tipe kepribadian dan potensi vokasional Anda untuk mengenali aktivitas, bidang studi, dan lingkungan akademik yang paling selaras.
      </p>

      <div style="margin-top:16px; display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
        <span class="rec-match" id="resRaportBadge" style="background:#EBF3FA; color:var(--c-primary); font-weight:700;">
          Asesmen Terverifikasi
        </span>
        <span style="font-size:13px; color:var(--c-text-muted);" id="resCompletedAtText">
          Selesai pada {{ now()->format('d M Y, H:i') }} WIB
        </span>
      </div>
    </div>

    {{-- Grafik 6 Tipe RIASEC Bar --}}
    <div class="riasec-bars-container">
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
        <div>
          <h4 style="font-size:17px; font-weight:800; color:var(--c-text-heading); margin:0;">Skor Distribusi 6 Dimensi Holland RIASEC</h4>
          <p style="font-size:13px; color:var(--c-text-muted); margin:2px 0 0;">Kalkulasi skor total dari 42 pertanyaan (skala 7 hingga 35 poin per tipe).</p>
        </div>
        <span style="font-size:12px; font-weight:700; color:var(--c-primary); background:#EBF3FA; padding:4px 12px; border-radius:100px;">
          Holland Occupational Themes
        </span>
      </div>

      <div class="riasec-bars-grid" id="riasecBarsGrid">
        {{-- Diisi secara dinamis oleh JS --}}
      </div>
    </div>

    {{-- Penjelasan Detail 3 Tipe Tertinggi (atau seri) --}}
    <div>
      <div style="margin-bottom:14px;">
        <h3 style="font-size:20px; font-weight:800; color:var(--c-text-heading); margin:0;">Profil Dimensi Dominan Hasil Asesmen</h3>
        <p style="font-size:13.5px; color:var(--c-text-muted); margin:4px 0 0;">
          Berikut rincian karakteristik, contoh program studi, peluang karier, dan lingkungan kerja yang relevan dengan tipe teratas Anda:
        </p>
      </div>

      <div class="top-types-cards-list" id="topTypesCardsList">
        {{-- Diisi secara dinamis oleh JS --}}
      </div>
    </div>

    {{-- Kartu Rekomendasi Program Studi AI --}}
    <section class="rec-section" id="recSection">
      <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:18px; flex-wrap:wrap; gap:12px;">
        <div>
          <div class="rec-section-title">Top 3 Rekomendasi Program Studi</div>
          <p class="rec-section-sub" style="margin:0;">
            Program studi pilihan terbaik yang paling sesuai dengan minat dan potensi Anda <span id="recSubRaportNote"></span>.
          </p>
        </div>

        <div style="display:flex; gap:10px;">
          <a href="{{ route('siswa.riwayat_asesmen') }}" class="btn-table-action outline" style="font-weight:700;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Buka Riwayat
          </a>
          <button type="button" class="btn-table-action outline" onclick="window.print()" style="font-weight:700;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Cetak Hasil
          </button>
        </div>
      </div>

      <div class="rec-cards-grid" id="recCardsGrid">
        {{-- Diisi secara dinamis oleh JS --}}
      </div>
    </section>

    {{-- Footer Actions --}}
    <div style="display:flex; justify-content:center; gap:16px; margin-top:20px; padding:24px; border-top:1px solid #E2E8F0;">
      <button type="button" class="btn-asesmen-prev" id="btnRetakeAsesmen" style="padding:10px 24px; font-size:14px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
        Ulangi Pengerjaan Asesmen
      </button>

      <a href="{{ route('siswa.konsultasi') }}" class="btn-rec-cta btn-rec-primary" style="margin:0; padding:10px 28px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        Konsultasikan Hasil dengan Psikolog
      </a>
    </div>

  </div>

@endsection

@push('scripts')
  {{-- Kirim data bank soal & riasec info dari server ke client JS --}}
  <script>
    window.BYOUTH_SOALS = @json($soals);
    window.BYOUTH_RIASEC_INFO = @json($riasecInfo);
    window.BYOUTH_LATEST_ASESMEN = @json($latestAsesmen);
    window.BYOUTH_SUBMIT_URL = "{{ route('siswa.asesmen.submit') }}";
  </script>
  <script src="{{ asset('js/Siswa/asesmen.js') }}"></script>
@endpush
