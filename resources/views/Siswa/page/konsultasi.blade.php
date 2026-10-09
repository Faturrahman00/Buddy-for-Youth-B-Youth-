{{-- 
  B-YOUTH: KONSULTASI PAGE (Siswa)
  File: resources/views/Siswa/page/konsultasi.blade.php
  Matches Wireframe 4: Banner Disetujui + Masuk Zoom, Kalender (Kiri), Jam (Kanan), Search & Filter
--}}
@extends('Siswa.layouts.app', [
    'title' => 'Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Konsultasi',
    'active' => 'konsultasi'
])

@section('content')
  <!-- Top Action Header -->
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <h2>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
        </svg>
        Konsultasi Psikologi & Minat Karier
      </h2>
      <p>Jadwalkan sesi bimbingan 1-on-1 bersama psikolog pendidikan tersertifikasi untuk memvalidasi pilihan masa depanmu.</p>
    </div>

    <a href="{{ route('siswa.riwayat_konsultasi') }}" class="btn-step-action btn-outline-action" style="padding:10px 18px;">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      <span>Lihat Riwayat Konsultasi</span>
    </a>
  </div>

  <!-- =========================================================================
       1. TOP BANNER "DISETUJUI" WITH "MASUK ZOOM" (From Wireframe 4)
       ========================================================================= -->
  <div class="confirmed-zoom-banner">
    <div class="banner-left-info">
      <div class="banner-avatar">MS</div>
      <div class="banner-details">
        <span class="banner-status-badge">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Sesi Disetujui
        </span>
        <h3>Konseling Bersama: Dr. Maya Sartika, M.Psi., Psikolog</h3>
        <p>
          <span><strong>Hari:</strong> Jumat, 10 Oktober 2026</span>
          <span><strong>Waktu:</strong> 14:00 - 15:00 WIB</span>
          <span><strong>Topik:</strong> Validasi Pilihan Program Studi Teknik & Kesiapan SNBP/SNBT</span>
        </p>
      </div>
    </div>

    <!-- Wireframe 4 CTA: Masuk Zoom -->
    <button type="button" class="btn-zoom-action" data-open-modal="modalZoom" id="btnMasukZoom">
      <span class="zoom-pulse-dot"></span>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M23 7l-7 5 7 5V7z"></path>
        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
      </svg>
      <span>Masuk Zoom</span>
    </button>
  </div>

  <!-- Search & Filter Card (User Request: Search & Filter di setiap halaman) -->
  <div class="filter-card">
    <div class="filter-row">
      <!-- Search Input -->
      <div class="search-box">
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="searchKonselor" class="search-input" placeholder="Cari nama psikolog atau keahlian bimbingan...">
      </div>

      <!-- Filters Group -->
      <div class="filter-controls-group">
        <select id="filterKonselor" class="filter-select">
          <option value="all">Semua Spesialisasi Konselor</option>
          <option value="STEM">Psikolog Pendidikan & STEM (Saintek)</option>
          <option value="Soshum">Konselor Karier Soshum & Humaniora</option>
          <option value="Portofolio">Konselor Pemetaan Portofolio Siswa</option>
        </select>

        <button type="button" class="btn-filter-reset" onclick="document.getElementById('searchKonselor').value=''; document.getElementById('filterKonselor').value='all'; document.getElementById('filterKonselor').dispatchEvent(new Event('change'));">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="1 4 1 10 7 10"></polyline>
            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
          </svg>
          Reset
        </button>
      </div>
    </div>
  </div>

  <!-- =========================================================================
       2. TWO-COLUMN SPLIT GRID (From Wireframe 4: KALENDER [Left] & JAM [Right])
       ========================================================================= -->
  <div class="consultation-booking-grid">

    <!-- LEFT COLUMN: KALENDER (Matching Wireframe 4) -->
    <div class="booking-card">
      <div class="booking-card-header">
        <div class="booking-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span>Kalender Sesi Konsultasi</span>
        </div>
        <span style="font-size:12.5px; color:var(--c-text-muted); font-weight:600;">Pilih Tanggal</span>
      </div>

      <!-- Month Navigation Bar -->
      <div class="calendar-month-bar">
        <span class="cal-month-name">Oktober 2026</span>
        <div style="display:flex; gap:6px;">
          <button type="button" class="cal-nav-btn" title="Bulan Sebelumnya" onclick="alert('Bulan September 2026');">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
          </button>
          <button type="button" class="cal-nav-btn" title="Bulan Berikutnya" onclick="alert('Bulan November 2026');">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </button>
        </div>
      </div>

      <!-- Weekday Headers -->
      <div class="calendar-weekdays-row">
        <span>Sen</span>
        <span>Sel</span>
        <span>Rab</span>
        <span>Kam</span>
        <span>Jum</span>
        <span>Sab</span>
        <span>Min</span>
      </div>

      <!-- Days Grid -->
      <div class="calendar-days-grid">
        <!-- Week 1 -->
        <div class="cal-day-cell disabled">28</div>
        <div class="cal-day-cell disabled">29</div>
        <div class="cal-day-cell disabled">30</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Kamis, 01 Okt 2026">1</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Jumat, 02 Okt 2026">2</div>
        <div class="cal-day-cell disabled">3</div>
        <div class="cal-day-cell disabled">4</div>

        <!-- Week 2 -->
        <div class="cal-day-cell has-available-slot" data-date-str="Senin, 05 Okt 2026">5</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Selasa, 06 Okt 2026">6</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Rabu, 07 Okt 2026">7</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Kamis, 08 Okt 2026">8</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Jumat, 09 Okt 2026">9</div>
        <div class="cal-day-cell disabled">10</div>
        <div class="cal-day-cell disabled">11</div>

        <!-- Week 3 (Selected active date) -->
        <div class="cal-day-cell has-available-slot" data-date-str="Senin, 12 Okt 2026">12</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Selasa, 13 Okt 2026">13</div>
        <div class="cal-day-cell active has-available-slot" data-date-str="Rabu, 14 Okt 2026">14</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Kamis, 15 Okt 2026">15</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Jumat, 16 Okt 2026">16</div>
        <div class="cal-day-cell disabled">17</div>
        <div class="cal-day-cell disabled">18</div>

        <!-- Week 4 -->
        <div class="cal-day-cell has-available-slot" data-date-str="Senin, 19 Okt 2026">19</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Selasa, 20 Okt 2026">20</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Rabu, 21 Okt 2026">21</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Kamis, 22 Okt 2026">22</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Jumat, 23 Okt 2026">23</div>
        <div class="cal-day-cell disabled">24</div>
        <div class="cal-day-cell disabled">25</div>

        <!-- Week 5 -->
        <div class="cal-day-cell has-available-slot" data-date-str="Senin, 26 Okt 2026">26</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Selasa, 27 Okt 2026">27</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Rabu, 28 Okt 2026">28</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Kamis, 29 Okt 2026">29</div>
        <div class="cal-day-cell has-available-slot" data-date-str="Jumat, 30 Okt 2026">30</div>
        <div class="cal-day-cell disabled">31</div>
        <div class="cal-day-cell disabled">1</div>
      </div>

      <div style="margin-top:18px; display:flex; align-items:center; gap:16px; font-size:12px; color:var(--c-text-muted);">
        <span style="display:inline-flex; align-items:center; gap:5px;">
          <span style="width:8px; height:8px; background:#10B981; border-radius:50%;"></span> Slot Tersedia
        </span>
        <span style="display:inline-flex; align-items:center; gap:5px;">
          <span style="width:8px; height:8px; background:var(--c-primary); border-radius:50%;"></span> Tanggal Terpilih
        </span>
      </div>
    </div>

    <!-- RIGHT COLUMN: JAM (Matching Wireframe 4) -->
    <div class="booking-card">
      <div class="booking-card-header">
        <div class="booking-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>Pilihan Jam Sesi</span>
        </div>
        <span style="font-size:12.5px; color:var(--c-text-muted); font-weight:600;">Waktu Konseling</span>
      </div>

      <p style="font-size:13px; color:var(--c-text-muted); margin-bottom:14px;">
        Pilih sesi waktu konsultasi yang masih tersedia untuk tanggal yang dipilih:
      </p>

      <!-- Time Slots List -->
      <div class="time-slots-list">
        <!-- Slot 1 -->
        <button type="button" class="slot-item-btn" data-slot-time="09:00 - 10:00 WIB">
          <div style="display:flex; align-items:center; gap:10px;">
            <span class="slot-time">09:00 - 10:00 WIB</span>
          </div>
          <span class="slot-status-badge available">Tersedia</span>
        </button>

        <!-- Slot 2 -->
        <button type="button" class="slot-item-btn booked" data-slot-time="10:30 - 11:30 WIB" disabled>
          <div style="display:flex; align-items:center; gap:10px;">
            <span class="slot-time" style="color:#94A3B8;">10:30 - 11:30 WIB</span>
          </div>
          <span class="slot-status-badge booked">Sudah Terisi</span>
        </button>

        <!-- Slot 3 (Selected) -->
        <button type="button" class="slot-item-btn selected" data-slot-time="13:30 - 14:30 WIB">
          <div style="display:flex; align-items:center; gap:10px;">
            <span class="slot-time">13:30 - 14:30 WIB</span>
          </div>
          <span class="slot-status-badge available">Tersedia (Dipilih)</span>
        </button>

        <!-- Slot 4 -->
        <button type="button" class="slot-item-btn" data-slot-time="15:00 - 16:00 WIB">
          <div style="display:flex; align-items:center; gap:10px;">
            <span class="slot-time">15:00 - 16:00 WIB</span>
          </div>
          <span class="slot-status-badge available">Tersedia</span>
        </button>

        <!-- Slot 5 -->
        <button type="button" class="slot-item-btn" data-slot-time="16:30 - 17:30 WIB">
          <div style="display:flex; align-items:center; gap:10px;">
            <span class="slot-time">16:30 - 17:30 WIB</span>
          </div>
          <span class="slot-status-badge available">Tersedia</span>
        </button>
      </div>

      <!-- Selected summary & Booking Action -->
      <div class="booking-confirm-box">
        <div><strong>Tanggal:</strong> <span id="selectedDateSummary">Rabu, 14 Okt 2026</span></div>
        <div style="margin-top:3px;"><strong>Sesi Waktu:</strong> <span id="selectedSlotSummary">13:30 - 14:30 WIB</span></div>
        <div style="margin-top:3px;"><strong>Psikolog:</strong> <span>Dr. Maya Sartika, M.Psi., Psikolog</span></div>
      </div>

      <div style="margin-top:auto;">
        <button type="button" class="btn-primary-action" style="width:100%; justify-content:center; padding:12px;" onclick="if(window.showGlassLoading){ window.showGlassLoading('Mengirim pengajuan jadwal konsultasi...', 850, function(){ if(window.showToastSuccess){ window.showToastSuccess('Konsultasi Berhasil Diajukan', 'Pengajuan jadwal konsultasi Anda telah berhasil dikirim ke psikolog.'); } else { alert('Pengajuan jadwal konsultasi berhasil dikirim!'); } }); } else { if(window.showToastSuccess){ window.showToastSuccess('Konsultasi Berhasil Diajukan', 'Pengajuan konsultasi berhasil dikirim.'); } }">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>Konfirmasi Pengajuan Konsultasi</span>
        </button>
      </div>
    </div>

  </div>
@endsection
