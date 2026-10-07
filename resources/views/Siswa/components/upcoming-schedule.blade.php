{{-- 
  B-YOUTH: UPCOMING SCHEDULE COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/upcoming-schedule.blade.php
--}}
<div class="upcoming-container">
  <h2 class="upcoming-title">Jadwal Mendatang</h2>

  <div class="upcoming-card-box">
    <span class="upcoming-tag-ribbon">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
      3 Hari Lagi
    </span>

    <div class="counselor-profile">
      <div class="counselor-avatar">
        SA
      </div>
      <div class="counselor-info">
        <span class="counselor-name">Dra. Sarah Amelia, M.Psi</span>
        <span class="counselor-role">Psikolog Pendidikan & Karir Remaja</span>
      </div>
    </div>

    <div class="upcoming-meta-list">
      <div class="meta-row">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        <span><strong>Kamis, 15 Oktober 2026</strong></span>
      </div>
      <div class="meta-row">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <span>14.00 - 15.00 WIB (60 Menit)</span>
      </div>
      <div class="meta-row">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 10l5-5-5-5v3H9a6 6 0 0 0-6 6v3h3v-3a3 3 0 0 1 3-3h6v3z"/>
        </svg>
        <span>Topik: Validasi Jurusan Teknik vs Kedokteran</span>
      </div>
    </div>
  </div>

  <!-- Primary Button: + Booking konsultasi baru -->
  <button type="button" class="btn-booking-new btn-trigger-booking" data-modal-target="modalBooking" data-modal-toggle="modalBooking">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <line x1="12" y1="5" x2="12" y2="19"></line>
      <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
    + Booking konsultasi baru
  </button>
</div>
