@extends('Psikolog.layout.app', [
    'title' => 'Kelola Jadwal Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Kelola Jadwal Konsultasi',
    'active' => 'jadwal'
])

@section('content')

<!-- =========================================================================
     SUBTABS NAVIGATION (Matches Wireframe 2: Kelola Jadwal & Pengajuan [1])
     ========================================================================= -->
<div class="subtabs-bar">
  <button type="button" class="tab-btn active" data-tab-target="tabPanelKelolaJadwal">
    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
      <line x1="16" y1="2" x2="16" y2="6"></line>
      <line x1="8" y1="2" x2="8" y2="6"></line>
      <line x1="3" y1="10" x2="21" y2="10"></line>
    </svg>
    <span>Kelola Jadwal</span>
  </button>

  <button type="button" class="tab-btn" data-tab-target="tabPanelPengajuan">
    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
      <polyline points="14 2 14 8 20 8"></polyline>
      <line x1="12" y1="18" x2="12" y2="12"></line>
      <line x1="9" y1="15" x2="15" y2="15"></line>
    </svg>
    <span>Pengajuan Booking Siswa</span>
    <span class="tab-badge" title="1 Permintaan Booking Perlu Verifikasi">1</span>
  </button>
</div>

<!-- =========================================================================
     TAB PANEL 1: KELOLA JADWAL (Default)
     ========================================================================= -->
<div class="tab-content-panel" id="tabPanelKelolaJadwal">
  <div class="jadwal-two-columns">

    <!-- ==================== LEFT COLUMN: KALENDER & SLOT AKTIF ==================== -->
    <div style="display: flex; flex-direction: column; gap: 20px;">

      <!-- Card 1: Slot Manager / Kalender Jadwal -->
      <div class="psikolog-card">
        <div class="card-header-wrap">
          <div class="card-title-group">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="card-title-text">Slot Manager / Kalender Jadwal</span>
          </div>
          <span style="font-size: 12px; font-weight: 700; color: var(--c-primary); background: var(--c-sky-subtle); padding: 4px 10px; border-radius: var(--radius-sm); border: 1px solid var(--c-sky-soft);">
            Kalender Slot Konseling
          </span>
        </div>

        <div class="card-body-content">
          <p style="font-size: 13px; color: var(--c-text-muted); margin-bottom: 14px;">
            Kalender tampilan bulanan. Pilih tanggal untuk melihat dan menyaring ketersediaan slot konseling.
          </p>

          <!-- Interactive Calendar Widget -->
          <div class="calendar-widget-box">
            <div class="calendar-top-nav">
              <div class="calendar-month-title">
                <span>Oktober 2026</span>
              </div>
              <div class="calendar-nav-arrows">
                <button type="button" class="btn-arrow-calendar" title="Bulan Sebelumnya">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button type="button" class="btn-arrow-calendar" title="Bulan Berikutnya">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
              </div>
            </div>

            <!-- Calendar Days Grid -->
            <div class="calendar-grid-table">
              <div class="cal-day-header">Sen</div>
              <div class="cal-day-header">Sel</div>
              <div class="cal-day-header">Rab</div>
              <div class="cal-day-header">Kam</div>
              <div class="cal-day-header">Jum</div>
              <div class="cal-day-header">Sab</div>
              <div class="cal-day-header">Min</div>

              <!-- Week 1 -->
              <div class="cal-day-cell other-month">28</div>
              <div class="cal-day-cell other-month">29</div>
              <div class="cal-day-cell other-month">30</div>
              <div class="cal-day-cell" data-date="2026-10-01">1</div>
              <div class="cal-day-cell" data-date="2026-10-02">2</div>
              <div class="cal-day-cell" data-date="2026-10-03">3</div>
              <div class="cal-day-cell" data-date="2026-10-04">4</div>

              <!-- Week 2 (Contains Slot 5 & 6) -->
              <div class="cal-day-cell selected" data-date="2026-10-05">
                <span>5</span>
                <div class="cal-dots-row">
                  <span class="cal-dot available" title="Slot Tersedia"></span>
                  <span class="cal-dot approved" title="Slot Disetujui"></span>
                </div>
              </div>
              <div class="cal-day-cell" data-date="2026-10-06">
                <span>6</span>
                <div class="cal-dots-row">
                  <span class="cal-dot pending" title="Menunggu Verifikasi"></span>
                </div>
              </div>
              <div class="cal-day-cell" data-date="2026-10-07">
                <span>7</span>
                <div class="cal-dots-row">
                  <span class="cal-dot available" title="Slot Tersedia"></span>
                </div>
              </div>
              <div class="cal-day-cell" data-date="2026-10-08">8</div>
              <div class="cal-day-cell" data-date="2026-10-09">9</div>
              <div class="cal-day-cell" data-date="2026-10-10">10</div>
              <div class="cal-day-cell today" data-date="2026-10-11">
                <span>11</span>
                <div class="cal-dots-row">
                  <span class="cal-dot approved"></span>
                </div>
              </div>

              <!-- Week 3 -->
              <div class="cal-day-cell" data-date="2026-10-12">12</div>
              <div class="cal-day-cell" data-date="2026-10-13">13</div>
              <div class="cal-day-cell" data-date="2026-10-14">14</div>
              <div class="cal-day-cell" data-date="2026-10-15">15</div>
              <div class="cal-day-cell" data-date="2026-10-16">16</div>
              <div class="cal-day-cell" data-date="2026-10-17">17</div>
              <div class="cal-day-cell" data-date="2026-10-18">18</div>

              <!-- Week 4 -->
              <div class="cal-day-cell" data-date="2026-10-19">19</div>
              <div class="cal-day-cell" data-date="2026-10-20">20</div>
              <div class="cal-day-cell" data-date="2026-10-21">21</div>
              <div class="cal-day-cell" data-date="2026-10-22">22</div>
              <div class="cal-day-cell" data-date="2026-10-23">23</div>
              <div class="cal-day-cell" data-date="2026-10-24">24</div>
              <div class="cal-day-cell" data-date="2026-10-25">25</div>

              <!-- Week 5 -->
              <div class="cal-day-cell" data-date="2026-10-26">26</div>
              <div class="cal-day-cell" data-date="2026-10-27">27</div>
              <div class="cal-day-cell" data-date="2026-10-28">28</div>
              <div class="cal-day-cell" data-date="2026-10-29">29</div>
              <div class="cal-day-cell" data-date="2026-10-30">30</div>
              <div class="cal-day-cell" data-date="2026-10-31">31</div>
              <div class="cal-day-cell other-month">1</div>
            </div>

            <!-- Legend Pills -->
            <div class="calendar-legend-bar">
              <div class="legend-item">
                <span class="cal-dot available"></span>
                <span>Tersedia (Kuota Buka)</span>
              </div>
              <div class="legend-item">
                <span class="cal-dot approved"></span>
                <span>Disetujui (Zoom Siap)</span>
              </div>
              <div class="legend-item">
                <span class="cal-dot pending"></span>
                <span>Menunggu Verifikasi</span>
              </div>
              <button type="button" class="btn-secondary-link" style="margin-left: auto; padding: 3px 8px; font-size: 11.5px;" onclick="document.querySelectorAll('.slot-card-item').forEach(e => e.style.display='flex');">
                Tampilkan Semua Tanggal
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2: Slot Aktif Terpublikasi (Matching Wireframe 2 bottom list) -->
      <div class="psikolog-card">
        <div class="card-header-wrap">
          <div class="card-title-group">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
              <polyline points="9 11 12 14 22 4"></polyline>
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <span class="card-title-text">Slot Aktif Terpublikasi</span>
          </div>

          <!-- Filter Status Chips -->
          <div style="display: flex; gap: 6px; flex-wrap: wrap;">
            <button type="button" class="slot-chip-filter active" data-status-filter="all" style="padding: 4px 10px; font-size: 12px; font-weight: 700; border-radius: var(--radius-sm); border: 1px solid var(--c-border); background: var(--c-white); cursor: pointer;">Semua (4)</button>
            <button type="button" class="slot-chip-filter" data-status-filter="tersedia" style="padding: 4px 10px; font-size: 12px; font-weight: 700; border-radius: var(--radius-sm); border: 1px solid #A6F4C5; background: #EBFDF2; color: #027A48; cursor: pointer;">Tersedia (2)</button>
            <button type="button" class="slot-chip-filter" data-status-filter="disetujui" style="padding: 4px 10px; font-size: 12px; font-weight: 700; border-radius: var(--radius-sm); border: 1px solid #B9D0E4; background: #EAF2F8; color: var(--c-primary); cursor: pointer;">Disetujui (1)</button>
            <button type="button" class="slot-chip-filter" data-status-filter="menunggu" style="padding: 4px 10px; font-size: 12px; font-weight: 700; border-radius: var(--radius-sm); border: 1px solid #FCE49E; background: #FFF9E6; color: #7A5400; cursor: pointer;">Menunggu (1)</button>
          </div>
        </div>

        <div class="card-body-content">
          <div class="slot-items-list" id="slotItemsContainer">

            <!-- Slot 1: 2026-10-05 09:00 - 10:00 WIB (Tersedia) -->
            <div class="slot-card-item" data-slot-date="2026-10-05" data-slot-status="tersedia">
              <div class="slot-left-info">
                <div class="slot-date-badge">
                  <span class="day-txt">Senin</span>
                  <span class="date-txt">2026-10-05</span>
                </div>
                <div class="slot-detail-meta">
                  <h5>
                    09:00 - 10:00 WIB
                    <span class="status-tag tersedia">Tersedia</span>
                  </h5>
                  <p>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                    <span>https://zoom.us/j/98765432199</span>
                  </p>
                </div>
              </div>

              <div class="slot-actions-group">
                <button type="button" class="btn-secondary-link" onclick="window.copyZoomLink('https://zoom.us/j/98765432199')" title="Salin Tautan Zoom">
                  Salin Link
                </button>
                <button type="button" class="btn-secondary-link" style="color: #c53030;" onclick="if(confirm('Hapus slot kuota ini?')) { this.closest('.slot-card-item').remove(); window.showToast('Slot berhasil dihapus.'); }" title="Hapus Slot">
                  Hapus
                </button>
              </div>
            </div>

            <!-- Slot 2: 2026-10-05 13:00 - 14:00 WIB (Disetujui) -->
            <div class="slot-card-item" data-slot-date="2026-10-05" data-slot-status="disetujui">
              <div class="slot-left-info">
                <div class="slot-date-badge">
                  <span class="day-txt">Senin</span>
                  <span class="date-txt">2026-10-05</span>
                </div>
                <div class="slot-detail-meta">
                  <h5>
                    13:00 - 14:00 WIB
                    <span class="status-tag disetujui">Disetujui</span>
                  </h5>
                  <p>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Siswa: Dimas Wicaksono (SMA Negeri 1 Jakarta)</span>
                  </p>
                </div>
              </div>

              <div class="slot-actions-group">
                <a href="https://zoom.us/j/98765432199" target="_blank" class="btn-zoom-primary" style="padding: 7px 14px; font-size: 12px;">
                  Masuk Zoom
                </a>
                <button type="button" class="btn-secondary-link" onclick="window.copyZoomLink('https://zoom.us/j/98765432199')">
                  Salin Link
                </button>
              </div>
            </div>

            <!-- Slot 3: 2026-10-06 10:00 - 11:00 WIB (Menunggu Verifikasi) -->
            <div class="slot-card-item" data-slot-date="2026-10-06" data-slot-status="menunggu">
              <div class="slot-left-info">
                <div class="slot-date-badge">
                  <span class="day-txt">Selasa</span>
                  <span class="date-txt">2026-10-06</span>
                </div>
                <div class="slot-detail-meta">
                  <h5>
                    10:00 - 11:00 WIB
                    <span class="status-tag menunggu">Menunggu Verifikasi</span>
                  </h5>
                  <p>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>Booking oleh: Siti Sarah Rahmawati (SMA Negeri 3 Bandung)</span>
                  </p>
                </div>
              </div>

              <div class="slot-actions-group">
                <button type="button" class="btn-primary-action" style="padding: 7px 14px; font-size: 12px; background: #10B981;" onclick="window.approveBooking(this, 'Siti Sarah Rahmawati', '2026-10-06 10:00 WIB')">
                  ✓ Setujui
                </button>
                <button type="button" class="btn-secondary-link" style="color: #c53030;" onclick="window.rejectBooking(this, 'Siti Sarah Rahmawati')">
                  Tolak
                </button>
              </div>
            </div>

            <!-- Slot 4: 2026-10-07 15:00 - 16:00 WIB (Tersedia) -->
            <div class="slot-card-item" data-slot-date="2026-10-07" data-slot-status="tersedia">
              <div class="slot-left-info">
                <div class="slot-date-badge">
                  <span class="day-txt">Rabu</span>
                  <span class="date-txt">2026-10-07</span>
                </div>
                <div class="slot-detail-meta">
                  <h5>
                    15:00 - 16:00 WIB
                    <span class="status-tag tersedia">Tersedia</span>
                  </h5>
                  <p>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                    <span>https://zoom.us/j/98765432199</span>
                  </p>
                </div>
              </div>

              <div class="slot-actions-group">
                <button type="button" class="btn-secondary-link" onclick="window.copyZoomLink('https://zoom.us/j/98765432199')">
                  Salin Link
                </button>
                <button type="button" class="btn-secondary-link" style="color: #c53030;" onclick="if(confirm('Hapus slot ini?')) { this.closest('.slot-card-item').remove(); window.showToast('Slot berhasil dihapus.'); }">
                  Hapus
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>

    <!-- ==================== RIGHT COLUMN: FORM TAMBAH SLOT JADWAL ==================== -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
      
      <div class="psikolog-card" style="border-top: 4px solid var(--c-primary);">
        <div class="card-header-wrap">
          <div class="card-title-group">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <div>
              <span class="card-title-text" style="display: block;">Tambah Slot Jadwal</span>
              <span style="font-size: 11.5px; color: var(--c-text-muted); font-weight: 500;">Buka kuota konsultasi baru untuk siswa</span>
            </div>
          </div>
        </div>

        <div class="card-body-content">
          <form id="formTambahSlot">
            <!-- 1. Tanggal -->
            <div class="form-input-group">
              <label class="form-label-custom" for="inputSlotTanggal">Tanggal Konsultasi</label>
              <input type="date" id="inputSlotTanggal" class="form-control-custom" value="2026-10-12" required>
            </div>

            <!-- 2. Jam Mulai & Jam Selesai -->
            <div class="form-input-group">
              <div class="time-row-split">
                <div>
                  <label class="form-label-custom" for="inputSlotJamMulai">Jam Mulai</label>
                  <input type="time" id="inputSlotJamMulai" class="form-control-custom" value="10:00" required>
                </div>
                <div>
                  <label class="form-label-custom" for="inputSlotJamSelesai">Jam Selesai</label>
                  <input type="time" id="inputSlotJamSelesai" class="form-control-custom" value="11:00" required>
                </div>
              </div>
              <span style="font-size: 11.5px; color: var(--c-text-muted); margin-top: 4px; display: block;">Durasi rekomendasi sesi standar: 60 Menit</span>
            </div>

            <!-- 3. URL / Tautan Zoom Sesi -->
            <div class="form-input-group">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                <label class="form-label-custom" for="inputSlotZoom" style="margin-bottom: 0;">URL / Tautan Zoom Sesi</label>
                <button type="button" style="font-size: 11px; font-weight: 700; color: var(--c-primary);" onclick="document.getElementById('inputSlotZoom').value='https://zoom.us/j/' + Math.floor(10000000000 + Math.random() * 90000000000); window.showToast('Tautan Zoom acak berhasil dibuat!');">
                  + Generate Link Otomatis
                </button>
              </div>
              <div style="position: relative;">
                <input type="url" id="inputSlotZoom" class="form-control-custom" value="https://zoom.us/j/98765432199" placeholder="https://zoom.us/j/..." required>
              </div>
              <span style="font-size: 11.5px; color: var(--c-text-muted); margin-top: 4px; display: block;">Tautan ini otomatis dikirim ke siswa ketika booking terverifikasi.</span>
            </div>

            <!-- Submit Button (Wireframe: [PUBLIKASIKAN JADWAL]) -->
            <button type="submit" class="btn-publish-slot" id="btnPublishSlot">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <span>Publikasikan Jadwal</span>
            </button>
          </form>
        </div>
      </div>

      <!-- Panduan Psikolog Box -->
      <div style="background: #FFF9E6; border: 1px solid #FCE49E; border-radius: var(--radius-md); padding: 18px; font-size: 13px;">
        <div style="font-weight: 800; color: #7A5400; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
          Tips Pengelolaan Kuota Konseling
        </div>
        <p style="color: #634700; line-height: 1.5;">
          Berikan jeda minimal <strong>15 menit antar sesi</strong> untuk menyiapkan form evaluasi rekomendasi minat bakat siswa agar pengisian catatan klinis tetap akurat dan komprehensif.
        </p>
      </div>

    </div>

  </div>
</div>

<!-- =========================================================================
     TAB PANEL 2: PENGAJUAN BOOKING SISWA (Subtab: Pengajuan [1])
     ========================================================================= -->
<div class="tab-content-panel" id="tabPanelPengajuan" style="display: none;">
  <div class="psikolog-card">
    <div class="card-header-wrap">
      <div class="card-title-group">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-accent)" stroke-width="2.2">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <span class="card-title-text">Daftar Pengajuan Konsultasi Menunggu Verifikasi</span>
      </div>
      <span class="status-tag menunggu" style="font-size: 12px;">1 Pengajuan Baru</span>
    </div>

    <div class="card-body-content">
      <p style="font-size: 13.5px; color: var(--c-text-muted); margin-bottom: 20px;">
        Berikut adalah permohonan bimbingan 1-on-1 dari siswa yang membutuhkan konfirmasi jadwal dan validasi tautan Zoom dari Anda.
      </p>

      <!-- Booking Request Card 1 -->
      <div class="booking-request-card" style="background:#FCFDFE; border:1.5px solid var(--c-border); border-radius:var(--radius-md); padding:20px; transition:all var(--transition-fast);">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; flex-wrap:wrap; margin-bottom:14px;">
          <div style="display:flex; align-items:center; gap:14px;">
            <div class="student-avatar-circle" style="width:48px; height:48px; font-size:16px;">SR</div>
            <div>
              <h4 style="font-size:16px; font-weight:800; color:var(--c-text-heading);">Siti Sarah Rahmawati</h4>
              <p style="font-size:13px; color:var(--c-text-muted);">SMA Negeri 3 Bandung • Kelas XII IPA 1</p>
              <span style="font-size:12px; color:var(--c-primary); font-weight:700;">Email: siti.sarah@sma3.sch.id</span>
            </div>
          </div>

          <div style="text-align:right;">
            <span class="status-tag menunggu" style="font-size:12px; margin-bottom:4px; display:inline-block;">Menunggu Verifikasi Anda</span>
            <div style="font-size:12px; color:var(--c-text-muted);">Diajukan: 10 Okt 2026, 09:15 WIB</div>
          </div>
        </div>

        <!-- Detail Permintaan Slot -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; background:var(--c-white); border:1px solid var(--c-border-light); border-radius:var(--radius-sm); padding:14px; margin-bottom:16px; font-size:13px;">
          <div>
            <span style="font-size:11px; font-weight:800; color:var(--c-text-muted); text-transform:uppercase;">Pilihan Slot Jadwal</span>
            <div style="font-weight:700; color:var(--c-text-heading); font-size:14px; margin-top:2px;">Selasa, 06 Oktober 2026 • 10:00 - 11:00 WIB</div>
          </div>
          <div>
            <span style="font-size:11px; font-weight:800; color:var(--c-text-muted); text-transform:uppercase;">Topik Konseling Siswa</span>
            <div style="font-weight:700; color:var(--c-text-heading); font-size:14px; margin-top:2px;">Konseling Portofolio Desain Grafis &amp; DKV FSRD</div>
          </div>
        </div>

        <div style="background:#F5F8FC; border-left:3px solid var(--c-primary); padding:12px 14px; border-radius:0 var(--radius-sm) var(--radius-sm) 0; font-size:13px; color:var(--c-text-body); margin-bottom:18px;">
          <strong>Pesan dari Siswa:</strong> "Selamat pagi Ibu Maya, saya ingin berkonsultasi mengenai persiapan berkas portofolio gambar untuk seleksi SNBP dan SNBT prodi DKV ITB &amp; ISI, serta ingin validasi apakah gaya minat saya cocok di industri kreatif."
        </div>

        <!-- Action Buttons -->
        <div style="display:flex; align-items:center; justify-content:flex-end; gap:10px;">
          <button type="button" class="btn-secondary-link" style="color:#c53030;" onclick="window.rejectBooking(this, 'Siti Sarah Rahmawati')">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            Tolak / Reschedule
          </button>
          <button type="button" class="btn-primary-action" style="background:#10B981;" onclick="window.approveBooking(this, 'Siti Sarah Rahmawati', 'Selasa, 06 Oktober 2026 10:00 WIB')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            Setujui Booking &amp; Konfirmasi Zoom
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
