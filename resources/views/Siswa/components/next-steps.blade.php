{{-- 
  B-YOUTH: NEXT STEPS ROADMAP COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/next-steps.blade.php
--}}
<div class="steps-card-container">
  <div class="section-title-wrap">
    <h2 class="section-title">Selesaikan Langkah Selanjutnya</h2>
    <span class="progress-counter-badge">Tahap 1 dari 4 Selesai (25%)</span>
  </div>

  <div class="steps-list">
    <!-- Step 1: Lengkapi Data Akademik -->
    <div class="step-item completed">
      <div class="step-item-left">
        <div class="step-badge-num">1</div>
        <div class="step-text-content">
          <div class="step-name">
            Lengkapi Biodata & Rapor Akademik
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#027A48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
          </div>
          <p class="step-desc">Nilai semester 1–5 dan mata pelajaran sains unggulan sudah terverifikasi.</p>
        </div>
      </div>
      <div class="step-item-right">
        <span class="step-status-tag tag-success">Selesai</span>
        <a href="{{ route('siswa.akademik') }}" class="btn-step-action btn-outline-action">Buka Data</a>
      </div>
    </div>

    <!-- Step 2: Ambil Asesmen Minat Bakat (Active / In Progress) -->
    <div class="step-item in-progress">
      <div class="step-item-left">
        <div class="step-badge-num">2</div>
        <div class="step-text-content">
          <div class="step-name">
            Ambil Asesmen Minat, Bakat & Kepribadian (B-Youth Test)
          </div>
          <p class="step-desc">Tes psikometri 45 menit untuk memetakan kecocokan tipe Holland RIASEC & gaya belajar.</p>
        </div>
      </div>
      <div class="step-item-right">
        <span class="step-status-tag tag-warning">Belum Selesai</span>
        <a href="{{ route('siswa.asesmen') }}" class="btn-step-action btn-accent-action">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="5 3 19 12 5 21 5 3"></polygon>
          </svg>
          Mulai Tes
        </a>
      </div>
    </div>

    <!-- Step 3: Lihat Hasil Rekomendasi Program Studi -->
    <div class="step-item">
      <div class="step-item-left">
        <div class="step-badge-num">3</div>
        <div class="step-text-content">
          <div class="step-name">
            Eksplorasi Rekomendasi Program Studi & Karir Berbasis AI
          </div>
          <p class="step-desc">Rekomendasi 5 program studi terbaik dan pemetaan peluang lolos di PTN favorit.</p>
        </div>
      </div>
      <div class="step-item-right">
        <span class="step-status-tag tag-ready">Tersedia</span>
        <a href="{{ route('siswa.asesmen') }}#kartuRekomendasiSection" class="btn-step-action btn-outline-action">
          Lihat Hasil
        </a>
      </div>
    </div>

    <!-- Step 4: Konsultasi 1-on-1 dengan Psikolog -->
    <div class="step-item">
      <div class="step-item-left">
        <div class="step-badge-num">4</div>
        <div class="step-text-content">
          <div class="step-name">
            Konsultasi 1-on-1 dengan Psikolog Pendidikan
          </div>
          <p class="step-desc">Sesi konseling personal untuk validasi minat, aspirasi orang tua, dan roadmap studi.</p>
        </div>
      </div>
      <div class="step-item-right">
        <span class="step-status-tag tag-ready">Siap Dijadwalkan</span>
        <a href="{{ route('siswa.konsultasi') }}" class="btn-step-action btn-primary-action">
          Pilih Jadwal
        </a>
      </div>
    </div>
  </div>
</div>
