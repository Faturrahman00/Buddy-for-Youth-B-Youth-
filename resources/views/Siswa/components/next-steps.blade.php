{{-- 
  B-YOUTH: NEXT STEPS ROADMAP COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/next-steps.blade.php
--}}
@php
  $step1Done = ($totalNilai ?? 0) >= 4;
  $step2Done = !empty($asesmen);
  $step3Done = !empty($topRekomendasi);
  $step4Done = ($totalKonsultasiSelesai ?? 0) > 0 || !empty($upcomingKonsultasi);

  $selesaiCount = ($step1Done ? 1 : 0) + ($step2Done ? 1 : 0) + ($step3Done ? 1 : 0) + ($step4Done ? 1 : 0);
  $percent = $selesaiCount * 25;
@endphp

<div class="steps-card-container">
  <div class="section-title-wrap">
    <h2 class="section-title">Selesaikan Langkah Selanjutnya</h2>
    <span class="progress-counter-badge">Tahap {{ $selesaiCount }} dari 4 Selesai ({{ $percent }}%)</span>
  </div>

  <div class="steps-list">
    <!-- Step 1: Lengkapi Data Akademik -->
    <div class="step-item {{ $step1Done ? 'completed' : 'in-progress' }}">
      <div class="step-item-left">
        <div class="step-badge-num">1</div>
        <div class="step-text-content">
          <div class="step-name">
            Lengkapi Biodata & Rapor Akademik
            @if($step1Done)
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#027A48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            @endif
          </div>
          <p class="step-desc">
            @if($step1Done)
              Nilai rapor 4 mata pelajaran pokok (IPAS, MTK, B. Indo, B. Inggris) sudah lengkap terisi.
            @elseif(($totalNilai ?? 0) > 0)
              Baru {{ $totalNilai }} dari 4 mata pelajaran yang terisi. Lengkapi untuk hasil rekomendasi yang akurat.
            @else
              Isi nilai rapor 4 mata pelajaran pokok untuk menentukan akurasi rekomendasi program studi.
            @endif
          </p>
        </div>
      </div>
      <div class="step-item-right">
        @if($step1Done)
          <span class="step-status-tag tag-success">Selesai</span>
        @else
          <span class="step-status-tag tag-warning">Belum Lengkap</span>
        @endif
        <a href="{{ route('siswa.akademik') }}" class="btn-step-action btn-outline-action">{{ $step1Done ? 'Buka Data' : 'Isi Nilai' }}</a>
      </div>
    </div>

    <!-- Step 2: Ambil Asesmen Minat Bakat -->
    <div class="step-item {{ $step2Done ? 'completed' : ($step1Done ? 'in-progress' : '') }}">
      <div class="step-item-left">
        <div class="step-badge-num">2</div>
        <div class="step-text-content">
          <div class="step-name">
            Ambil Asesmen Holland RIASEC (B-Youth Test)
            @if($step2Done)
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#027A48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            @endif
          </div>
          <p class="step-desc">Tes psikometri 42 soal untuk memetakan kecocokan tipe Holland RIASEC & arah program studi perguruan tinggi.</p>
        </div>
      </div>
      <div class="step-item-right">
        @if($step2Done)
          <span class="step-status-tag tag-success">Selesai</span>
          <a href="{{ route('siswa.riwayat_asesmen') }}" class="btn-step-action btn-outline-action">Lihat Skor</a>
        @else
          <span class="step-status-tag tag-warning">Belum Selesai</span>
          <a href="{{ route('siswa.asesmen') }}" class="btn-step-action btn-accent-action">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="5 3 19 12 5 21 5 3"></polygon>
            </svg>
            Mulai Tes
          </a>
        @endif
      </div>
    </div>

    <!-- Step 3: Lihat Hasil Rekomendasi Program Studi -->
    <div class="step-item {{ $step3Done ? 'completed' : '' }}">
      <div class="step-item-left">
        <div class="step-badge-num">3</div>
        <div class="step-text-content">
          <div class="step-name">
            Eksplorasi Rekomendasi Program Studi Terarah
            @if($step3Done)
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#027A48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            @endif
          </div>
          <p class="step-desc">Rekomendasi program studi terbaik dan pemetaan peluang lolos di PTN favorit sesuai bakat dan nilai.</p>
        </div>
      </div>
      <div class="step-item-right">
        @if($step3Done)
          <span class="step-status-tag tag-success">Tersedia</span>
          <a href="{{ route('siswa.asesmen') }}#kartuRekomendasiSection" class="btn-step-action btn-outline-action">Lihat Hasil</a>
        @else
          <span class="step-status-tag tag-ready">Menunggu Tes</span>
          <a href="{{ route('siswa.asesmen') }}" class="btn-step-action btn-outline-action">Buka Asesmen</a>
        @endif
      </div>
    </div>

    <!-- Step 4: Konsultasi dengan Psikolog -->
    <div class="step-item {{ $step4Done ? 'completed' : '' }}">
      <div class="step-item-left">
        <div class="step-badge-num">4</div>
        <div class="step-text-content">
          <div class="step-name">
            Konsultasi Terarah dengan Psikolog Pendidikan
            @if($step4Done)
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#027A48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            @endif
          </div>
          <p class="step-desc">Sesi konseling personal untuk validasi minat, aspirasi orang tua, dan rencana studi perguruan tinggi.</p>
        </div>
      </div>
      <div class="step-item-right">
        @if(!empty($upcomingKonsultasi))
          <span class="step-status-tag tag-success">Terjadwal</span>
          <a href="{{ route('siswa.konsultasi') }}" class="btn-step-action btn-outline-action">Lihat Jadwal</a>
        @else
          <span class="step-status-tag tag-ready">Siap Dijadwalkan</span>
          <a href="{{ route('siswa.konsultasi') }}" class="btn-step-action btn-primary-action">Pilih Jadwal</a>
        @endif
      </div>
    </div>
  </div>
</div>
