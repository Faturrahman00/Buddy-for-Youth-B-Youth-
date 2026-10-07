{{-- 
  B-YOUTH: SUMMARY CARDS ROW COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/summary-cards.blade.php
--}}
<section class="summary-grid" aria-label="Ringkasan Status">
  <!-- Card 1: Status Asesmen -->
  <div class="card-summary">
    <div>
      <div class="summary-header">
        <span class="summary-title">Status Asesmen</span>
        <div class="summary-icon-mini" title="Status Asesmen">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
        </div>
      </div>
      <div class="status-pill pending">
        Belum Dikerjakan
      </div>
    </div>
    <a href="{{ route('siswa.asesmen') }}" class="btn-card-action">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="5 3 19 12 5 21 5 3"></polygon>
      </svg>
      Mulai Asesmen
    </a>
  </div>

  <!-- Card 2: Rekomendasi Prodi -->
  <div class="card-summary">
    <div>
      <div class="summary-header">
        <span class="summary-title">Rekomendasi Prodi</span>
        <div class="summary-icon-mini" title="Rekomendasi Prodi">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
          </svg>
        </div>
      </div>
      <div class="dash-value" style="font-size:16px; font-weight:800; color:var(--c-primary); margin:8px 0 4px;">Teknik Informatika (96%)</div>
    </div>
    <a href="{{ route('siswa.asesmen') }}#kartuRekomendasiSection" class="link-action">
      <span>Lihat Rekomendasi AI</span>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
    </a>
  </div>

  <!-- Card 3: Jadwal Konsultasi -->
  <div class="card-summary">
    <div>
      <div class="summary-header">
        <span class="summary-title">Jadwal Konsultasi</span>
        <div class="summary-icon-mini" title="Jadwal Konsultasi">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
        </div>
      </div>
      <div class="schedule-date">Jumat, 10 Okt 2026</div>
      <div class="schedule-expert">14.00 WIB &bull; Dr. Maya Sartika, M.Psi</div>
    </div>
    <div>
      <a href="{{ route('siswa.konsultasi') }}" class="badge-tag-zoom" style="text-decoration:none; display:inline-flex;">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
          <path d="M4 4h10a2 2 0 0 1 2 2v3.34l4.5-2.25A1 1 0 0 1 22 8v8a1 1 0 0 1-1.5.86L16 14.66V18a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
        </svg>
        Buka Ruang Zoom
      </a>
    </div>
  </div>

  <!-- Card 4: Riwayat Konsultasi -->
  <div class="card-summary">
    <div>
      <div class="summary-header">
        <span class="summary-title">Riwayat Konsultasi</span>
        <div class="summary-icon-mini" title="Riwayat Konsultasi">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
      </div>
      <div class="history-meta">3 Sesi Telah Selesai</div>
      <div class="history-desc">Terakhir: 02 Okt 2026 (Analisis Bakat Saintek)</div>
    </div>
    <a href="{{ route('siswa.riwayat_konsultasi') }}" class="link-action">
      <span>Lihat Catatan Konselor</span>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
    </a>
  </div>
</section>
