@extends('Siswa.layouts.app', [
    'title' => 'Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Konsultasi',
    'active' => 'konsultasi'
])

@section('content')
  @if(session('success'))
    <div style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600; display:flex; align-items:center; gap:8px;">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if(session('error'))
    <div style="background:#FEF3F2; color:#B42318; border:1px solid #FECDCA; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600; display:flex; align-items:center; gap:8px;">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
      <span>{{ session('error') }}</span>
    </div>
  @endif

  <!-- =========================================================================
       1. TOP BANNER "DISETUJUI" WITH "MASUK ZOOM" (Jika Ada Sesi Terkonfirmasi)
       ========================================================================= -->
  @if(!empty($activeSession))
    @php
      $counselorNama = $activeSession->psikolog->nama ?? 'Psikolog B-Youth';
      $initialsCounselor = strtoupper(substr($counselorNama, 0, 2));
    @endphp
    <div class="confirmed-zoom-banner" style="margin-bottom: 24px;">
      <div class="banner-left-info">
        <div class="banner-avatar">{{ $initialsCounselor }}</div>
        <div class="banner-details">
          <span class="banner-status-badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            Sesi Disetujui
          </span>
          <h3>Konseling Bersama: {{ $counselorNama }}</h3>
          <p>
            <span><strong>Hari:</strong> {{ \Carbon\Carbon::parse($activeSession->tanggal_konsultasi)->translatedFormat('l, d F Y') }}</span>
            <span><strong>Waktu:</strong> {{ substr($activeSession->waktu_mulai, 0, 5) }} - {{ substr($activeSession->waktu_selesai, 0, 5) }} WIB</span>
            <span><strong>Topik:</strong> {{ $activeSession->catatan ?? 'Validasi Pilihan Program Studi & Kesiapan Akademik' }}</span>
          </p>
        </div>
      </div>

      <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('siswa.riwayat_konsultasi') }}" class="btn-step-action btn-outline-action" style="padding:10px 16px; font-weight:700; text-decoration:none; background:rgba(255,255,255,0.95); border-radius:10px; color:var(--c-primary); display:inline-flex; align-items:center; gap:6px;" title="Lihat Detail & Catatan Lengkap Sesi Konsultasi">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
          <span>Detail &amp; Catatan</span>
        </a>
        @if(!empty($activeSession->link_zoom))
          <a href="{{ $activeSession->link_zoom }}" target="_blank" class="btn-zoom-action" style="text-decoration:none;">
            <span class="zoom-pulse-dot"></span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M23 7l-7 5 7 5V7z"></path>
              <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
            </svg>
            <span>Masuk Zoom</span>
          </a>
        @endif
      </div>
    </div>
  @endif

  <!-- =========================================================================
       2. GRID BOOKING: KALENDER (LEFT) & JAM/PENGAJUAN (RIGHT)
       ========================================================================= -->
  <div class="consultation-booking-grid">
    
    <!-- LEFT COLUMN: KALENDER INTERAKTIF -->
    <div class="booking-card">
      <div class="booking-card-header">
        <div class="booking-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span>Pilih Tanggal Konsultasi</span>
        </div>
        <span style="font-size:12.5px; color:var(--c-text-muted); font-weight:600;">Kalender Interaktif</span>
      </div>

      <!-- Month Navigation Bar -->
      <div class="calendar-month-bar">
        <button type="button" class="cal-nav-btn" id="btnCalPrev" title="Bulan Sebelumnya">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <span class="cal-month-name" id="calMonthLabel">-</span>
        <button type="button" class="cal-nav-btn" id="btnCalNext" title="Bulan Berikutnya">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
      </div>

      <!-- Calendar Weekday Headers -->
      <div class="calendar-weekdays-row">
        <span>Sen</span>
        <span>Sel</span>
        <span>Rab</span>
        <span>Kam</span>
        <span>Jum</span>
        <span>Sab</span>
        <span>Min</span>
      </div>

      <!-- Calendar Days Grid (Populated dynamically) -->
      <div class="calendar-days-grid" id="calendarDaysGrid"></div>

      <!-- Calendar Legend & Quick Controls -->
      <div style="margin-top:16px; padding-top:14px; border-top:1px dashed var(--c-border-light); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; font-size:12px; color:var(--c-text-muted);">
        <div style="display:flex; align-items:center; gap:16px;">
          <span style="display:inline-flex; align-items:center; gap:6px;">
            <span style="width:8px; height:8px; background:#10B981; border-radius:50%;"></span>
            Slot Terbuka Psikolog
          </span>
          <span style="display:inline-flex; align-items:center; gap:6px;">
            <span style="width:8px; height:8px; background:var(--c-primary); border-radius:50%;"></span>
            Tanggal Terpilih
          </span>
        </div>
        <button type="button" class="btn-step-action btn-outline-action" id="btnCalToday" style="padding:4px 10px; font-size:11.5px; border-radius:6px;">
          Hari Ini
        </button>
      </div>

      <!-- Dynamic Section: Slot Terbuka pada Tanggal Terpilih -->
      <div id="dateSpecificSlotsSection" style="margin-top:18px;"></div>
    </div>

    <!-- RIGHT COLUMN: PILIHAN JAM, PSIKOLOG & FORM PENGAJUAN -->
    <div class="booking-card">
      <div class="booking-card-header">
        <div class="booking-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>Pilihan Jam &amp; Psikolog</span>
        </div>
        <span style="font-size:12.5px; color:var(--c-text-muted); font-weight:600;">Sesi 1-on-1</span>
      </div>

      <form id="formBookingKonsultasi" action="{{ route('siswa.konsultasi.booking') }}" method="POST" style="display:flex; flex-direction:column; gap:16px;">
        @csrf
        <!-- Hidden Inputs for dynamic booking -->
        <input type="hidden" name="tanggal_konsultasi" id="bookingTanggalKonsultasi" value="{{ date('Y-m-d') }}" required>
        <input type="hidden" name="waktu_mulai" id="bookingWaktuMulai" value="13:30:00" required>
        <input type="hidden" name="id_konsultasi" id="bookingIdKonsultasi" value="">
        <input type="hidden" name="id_psikolog" id="bookingIdPsikolog" value="{{ $psikologs->first()->id_psikolog ?? '' }}" required>

        <!-- 1. PILIH PSIKOLOG -->
        <div>
          <label class="form-label" style="font-weight:700; font-size:13px; display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
            <span style="color:var(--c-text-heading);">Pilih Psikolog Pembimbing:</span>
            <span style="font-size:11.5px; color:#10B981; font-weight:700; display:inline-flex; align-items:center; gap:4px;">
              <span style="width:6px; height:6px; border-radius:50%; background:#10B981;"></span>
              Tersertifikasi HIMPSI
            </span>
          </label>
          
          <div class="psikolog-selector-list" style="display:flex; flex-direction:column; gap:8px;">
            @forelse($psikologs as $psk)
              @php
                $ini = strtoupper(substr($psk->nama, 0, 2));
                $isFirst = $loop->first;
              @endphp
              <div class="psikolog-choice-card {{ $isFirst ? 'selected' : '' }}" 
                   id="pskChoice_{{ $psk->id_psikolog }}"
                   data-id="{{ $psk->id_psikolog }}" 
                   data-nama="{{ $psk->nama }}"
                   onclick="choosePsikolog('{{ $psk->id_psikolog }}', '{{ addslashes($psk->nama) }}')"
                   style="border:1.5px solid {{ $isFirst ? 'var(--c-primary)' : 'var(--c-border)' }}; border-radius:12px; padding:10px 14px; background:{{ $isFirst ? '#F0F7FD' : '#FFFFFF' }}; display:flex; align-items:center; justify-content:space-between; cursor:pointer; transition:all 0.2s ease;">
                <div style="display:flex; align-items:center; gap:12px;">
                  <div style="width:38px; height:38px; border-radius:10px; background:linear-gradient(135deg, #30618C 0%, #1D4363 100%); color:#fff; font-weight:800; font-size:13.5px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    {{ $ini }}
                  </div>
                  <div>
                    <div style="font-size:13.5px; font-weight:700; color:var(--c-text-heading);">{{ $psk->nama }}</div>
                    <div style="font-size:12px; color:var(--c-text-muted);">{{ $psk->spesialisasi ?? 'Psikolog Pendidikan' }}</div>
                  </div>
                </div>
                <div class="radio-indicator" style="width:18px; height:18px; border-radius:50%; border:2px solid {{ $isFirst ? 'var(--c-primary)' : '#CBD5E1' }}; display:flex; align-items:center; justify-content:center;">
                  <div class="radio-dot" style="width:8px; height:8px; border-radius:50%; background:var(--c-primary); display:{{ $isFirst ? 'block' : 'none' }};"></div>
                </div>
              </div>
            @empty
              <div style="font-size:13px; color:var(--c-text-muted); padding:10px; text-align:center;">
                Belum ada psikolog aktif di sistem.
              </div>
            @endforelse
          </div>
        </div>

        <!-- 2. PILIHAN JAM SESI -->
        <div>
          <label class="form-label" style="font-weight:700; font-size:13px; color:var(--c-text-heading); display:block; margin-bottom:8px;">
            Pilihan Jam Konseling:
          </label>

          <div class="time-slots-list" style="margin-bottom:0;">
            <button type="button" class="slot-item-btn" data-time="09:00:00" data-label="09:00 - 10:00 WIB" onclick="selectTimeSlot(this, '09:00:00', '09:00 - 10:00 WIB')">
              <div style="display:flex; align-items:center; gap:10px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span class="slot-time">09:00 - 10:00 WIB</span>
              </div>
              <span class="slot-status-badge available">Tersedia</span>
            </button>

            <button type="button" class="slot-item-btn" data-time="10:30:00" data-label="10:30 - 11:30 WIB" onclick="selectTimeSlot(this, '10:30:00', '10:30 - 11:30 WIB')">
              <div style="display:flex; align-items:center; gap:10px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span class="slot-time">10:30 - 11:30 WIB</span>
              </div>
              <span class="slot-status-badge available">Tersedia</span>
            </button>

            <button type="button" class="slot-item-btn selected" data-time="13:30:00" data-label="13:30 - 14:30 WIB" onclick="selectTimeSlot(this, '13:30:00', '13:30 - 14:30 WIB')">
              <div style="display:flex; align-items:center; gap:10px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span class="slot-time">13:30 - 14:30 WIB</span>
              </div>
              <span class="slot-status-badge available">Tersedia (Dipilih)</span>
            </button>

            <button type="button" class="slot-item-btn" data-time="15:00:00" data-label="15:00 - 16:00 WIB" onclick="selectTimeSlot(this, '15:00:00', '15:00 - 16:00 WIB')">
              <div style="display:flex; align-items:center; gap:10px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span class="slot-time">15:00 - 16:00 WIB</span>
              </div>
              <span class="slot-status-badge available">Tersedia</span>
            </button>

            <button type="button" class="slot-item-btn" data-time="16:30:00" data-label="16:30 - 17:30 WIB" onclick="selectTimeSlot(this, '16:30:00', '16:30 - 17:30 WIB')">
              <div style="display:flex; align-items:center; gap:10px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span class="slot-time">16:30 - 17:30 WIB</span>
              </div>
              <span class="slot-status-badge available">Tersedia</span>
            </button>
          </div>
        </div>

        <!-- 3. TOPIK / CATATAN -->
        <div>
          <label class="form-label" style="font-weight:700; font-size:13px; color:var(--c-text-heading); display:block; margin-bottom:6px;">
            Topik Bimbingan / Catatan Pertanyaan:
          </label>
          <textarea name="catatan" rows="3" class="form-input" placeholder="Contoh: Ingin memvalidasi pilihan jurusan SNBP/SNBT berdasarkan nilai rapor semester 1-5 dan minat bakat..." style="width:100%; padding:10px 14px; border:1.5px solid var(--c-border); border-radius:10px; font-family:inherit; font-size:13px;"></textarea>
        </div>

        <!-- 4. RINGKASAN PENGAJUAN -->
        <div class="booking-confirm-box" style="margin-bottom:6px;">
          <div style="display:flex; justify-content:space-between; margin-bottom:4px; font-size:13px;">
            <span><strong>Tanggal:</strong></span>
            <span id="selectedDateSummary" style="font-weight:700; color:var(--c-primary);">-</span>
          </div>
          <div style="display:flex; justify-content:space-between; margin-bottom:4px; font-size:13px;">
            <span><strong>Sesi Waktu:</strong></span>
            <span id="selectedSlotSummary" style="font-weight:700; color:var(--c-text-heading);">13:30 - 14:30 WIB</span>
          </div>
          <div style="display:flex; justify-content:space-between; font-size:13px;">
            <span><strong>Psikolog:</strong></span>
            <span id="selectedPsikologSummary" style="font-weight:700; color:var(--c-text-heading);">{{ $psikologs->first()->nama ?? 'Psikolog Pembimbing' }}</span>
          </div>
        </div>

        <!-- 5. TOMBOL SUBMIT -->
        <button type="submit" class="btn-primary-action" style="width:100%; justify-content:center; padding:12px; font-size:14px; font-weight:700; border-radius:10px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>Konfirmasi &amp; Ajukan Konsultasi</span>
        </button>
      </form>
    </div>

  </div>
@endsection

@push('scripts')
<script>
  // --------------------------------------------------------------------------
  // INTERACTIVE CALENDAR & BOOKING LOGIC
  // --------------------------------------------------------------------------
  const openSlotsData = @json($availableSlots);
  const indonesianMonths = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  const indonesianDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

  // Parse today and initial selected date
  const now = new Date();
  let currentYear = now.getFullYear();
  let currentMonth = now.getMonth(); // 0 - 11
  
  // Format helpers
  function padZero(num) {
    return String(num).padStart(2, '0');
  }

  function toISODate(y, m, d) {
    return `${y}-${padZero(m + 1)}-${padZero(d)}`;
  }

  function formatDisplayDate(isoStr) {
    const parts = isoStr.split('-');
    if (parts.length !== 3) return isoStr;
    const dObj = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
    const dayName = indonesianDays[dObj.getDay()];
    const dayNum = dObj.getDate();
    const monthName = indonesianMonths[dObj.getMonth()];
    const yr = dObj.getFullYear();
    return `${dayName}, ${dayNum} ${monthName} ${yr}`;
  }

  let selectedDateStr = toISODate(currentYear, currentMonth, now.getDate());

  // Render the calendar grid
  function renderCalendar(year, month) {
    const grid = document.getElementById('calendarDaysGrid');
    const label = document.getElementById('calMonthLabel');
    if (!grid || !label) return;

    label.textContent = `${indonesianMonths[month]} ${year}`;
    grid.innerHTML = '';

    // First day of month (0 = Sun, 1 = Mon ... 6 = Sat)
    const firstDayIndex = new Date(year, month, 1).getDay();
    // In Indonesian layout: Monday is index 0, Sunday is index 6
    const startOffset = (firstDayIndex === 0) ? 6 : firstDayIndex - 1;

    // Total days in current month
    const totalDays = new Date(year, month + 1, 0).getDate();

    // Previous month total days for padding
    const prevMonthDays = new Date(year, month, 0).getDate();

    const todayDate = new Date();
    todayDate.setHours(0, 0, 0, 0);

    // 1. Previous month padding cells
    for (let i = startOffset - 1; i >= 0; i--) {
      const dayNum = prevMonthDays - i;
      const cell = document.createElement('div');
      cell.className = 'cal-day-cell disabled other-month';
      cell.textContent = dayNum;
      grid.appendChild(cell);
    }

    // 2. Current month days
    for (let d = 1; d <= totalDays; d++) {
      const cell = document.createElement('div');
      const isoStr = toISODate(year, month, d);
      const cellDate = new Date(year, month, d);
      cellDate.setHours(0, 0, 0, 0);

      const isPast = cellDate < todayDate;
      const isToday = cellDate.getTime() === todayDate.getTime();
      const isSelected = (isoStr === selectedDateStr);

      // Check if this date has available slots from psychologists
      const hasSlot = openSlotsData.some(slot => {
        const slotDate = slot.tanggal_konsultasi ? slot.tanggal_konsultasi.substring(0, 10) : '';
        return slotDate === isoStr;
      });

      let classes = ['cal-day-cell'];
      if (isPast) {
        classes.push('disabled');
      } else {
        if (isSelected) classes.push('active');
        if (isToday) classes.push('is-today');
        if (hasSlot) classes.push('has-available-slot');
      }

      cell.className = classes.join(' ');
      cell.textContent = d;
      cell.setAttribute('data-date', isoStr);

      if (!isPast) {
        cell.addEventListener('click', () => {
          handleDateClick(isoStr, cell);
        });
      }

      grid.appendChild(cell);
    }

    // 3. Next month padding cells to complete rows of 7
    const currentTotalCells = startOffset + totalDays;
    const remaining = (7 - (currentTotalCells % 7)) % 7;
    for (let n = 1; n <= remaining; n++) {
      const cell = document.createElement('div');
      cell.className = 'cal-day-cell disabled other-month';
      cell.textContent = n;
      grid.appendChild(cell);
    }

    // Update dynamic date-specific slots panel
    updateSelectedDateSlots(selectedDateStr);
  }

  // Handle click on a date cell
  function handleDateClick(isoStr, cellElement) {
    selectedDateStr = isoStr;

    // Update active cell
    document.querySelectorAll('#calendarDaysGrid .cal-day-cell').forEach(c => c.classList.remove('active'));
    if (cellElement) cellElement.classList.add('active');

    // Update form hidden input & summary
    const hiddenDate = document.getElementById('bookingTanggalKonsultasi');
    if (hiddenDate) hiddenDate.value = isoStr;

    const summaryDate = document.getElementById('selectedDateSummary');
    if (summaryDate) summaryDate.textContent = formatDisplayDate(isoStr);

    // Update dynamic open slots panel
    updateSelectedDateSlots(isoStr);
  }

  // Render open slots card for the selected date
  function updateSelectedDateSlots(isoStr) {
    const container = document.getElementById('dateSpecificSlotsSection');
    if (!container) return;

    const matchedSlots = openSlotsData.filter(slot => {
      const sDate = slot.tanggal_konsultasi ? slot.tanggal_konsultasi.substring(0, 10) : '';
      return sDate === isoStr;
    });

    if (matchedSlots.length > 0) {
      let html = `
        <div style="background:#F0FDF4; border:1.5px solid #86EFAC; border-radius:12px; padding:14px 16px; box-shadow:0 2px 8px rgba(16,185,129,0.08);">
          <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
            <div style="display:flex; align-items:center; gap:8px; font-weight:800; font-size:13.5px; color:#166534;">
              <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#10B981; box-shadow:0 0 0 3px rgba(16,185,129,0.2);"></span>
              Slot Siap Pakai dari Psikolog:
            </div>
            <span style="font-size:11.5px; font-weight:700; color:#15803D; background:#DCFCE7; padding:2px 8px; border-radius:99px;">
              ${matchedSlots.length} Slot Terbuka
            </span>
          </div>
          <div style="display:flex; flex-direction:column; gap:8px;">
      `;

      matchedSlots.forEach(s => {
        const pNama = (s.psikolog && s.psikolog.nama) ? s.psikolog.nama : 'Psikolog B-Youth';
        const start = s.waktu_mulai ? s.waktu_mulai.substring(0, 5) : '09:00';
        const end = s.waktu_selesai ? s.waktu_selesai.substring(0, 5) : '10:00';
        const timeLabel = `${start} - ${end} WIB`;

        html += `
          <div style="display:flex; align-items:center; justify-content:space-between; background:#FFFFFF; border:1px solid #BBF7D0; border-radius:10px; padding:10px 12px; gap:10px;">
            <div>
              <div style="font-weight:700; font-size:13px; color:#1F2937;">${timeLabel}</div>
              <div style="font-size:12px; color:#059669; font-weight:600;">Oleh: ${pNama}</div>
            </div>
            <button type="button" class="btn-step-action btn-primary-action" style="padding:6px 14px; font-size:12px; border-radius:8px;" 
                    onclick="claimSlot('${s.id_konsultasi}', '${s.id_psikolog}', '${pNama.replace(/'/g, "\\'")}', '${s.waktu_mulai}', '${timeLabel}')">
              Gunakan Slot Ini
            </button>
          </div>
        `;
      });

      html += `
          </div>
        </div>
      `;
      container.innerHTML = html;
    } else {
      container.innerHTML = `
        <div style="background:#F8FAFC; border:1px dashed #CBD5E1; border-radius:12px; padding:12px 14px; display:flex; align-items:center; gap:10px; font-size:12.5px; color:var(--c-text-muted);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
          <span>Tanggal terpilih: <strong style="color:var(--c-text-heading);">${formatDisplayDate(isoStr)}</strong>. Anda dapat mengajukan sesi mandiri dengan memilih jam dan psikolog di formulir sebelah kanan.</span>
        </div>
      `;
    }
  }

  // Claim a direct slot created by a psychologist
  function claimSlot(idKonsultasi, idPsikolog, pNama, waktuMulai, timeLabel) {
    document.getElementById('bookingIdKonsultasi').value = idKonsultasi;
    choosePsikolog(idPsikolog, pNama);

    document.getElementById('bookingWaktuMulai').value = waktuMulai;
    document.getElementById('selectedSlotSummary').textContent = `${timeLabel} (Slot Khusus)`;

    // Deselect standard time slots buttons
    document.querySelectorAll('.time-slots-list .slot-item-btn').forEach(btn => {
      btn.classList.remove('selected');
      const badge = btn.querySelector('.slot-status-badge');
      if (badge) badge.textContent = 'Tersedia';
    });

    if (window.showToastSuccess) {
      window.showToastSuccess('Slot Dipilih', `Slot ${timeLabel} bersama ${pNama} telah dipilih.`);
    }
  }

  // Choose Psychologist
  function choosePsikolog(id, nama) {
    document.getElementById('bookingIdPsikolog').value = id;
    document.getElementById('selectedPsikologSummary').textContent = nama;

    document.querySelectorAll('.psikolog-choice-card').forEach(card => {
      card.classList.remove('selected');
      card.style.borderColor = 'var(--c-border)';
      card.style.background = '#FFFFFF';
      const dot = card.querySelector('.radio-dot');
      if (dot) dot.style.display = 'none';
      const ind = card.querySelector('.radio-indicator');
      if (ind) ind.style.borderColor = '#CBD5E1';
    });

    const activeCard = document.getElementById('pskChoice_' + id);
    if (activeCard) {
      activeCard.classList.add('selected');
      activeCard.style.borderColor = 'var(--c-primary)';
      activeCard.style.background = '#F0F7FD';
      const dot = activeCard.querySelector('.radio-dot');
      if (dot) dot.style.display = 'block';
      const ind = activeCard.querySelector('.radio-indicator');
      if (ind) ind.style.borderColor = 'var(--c-primary)';
    }
  }

  // Choose Standard Time Slot
  function selectTimeSlot(btn, timeValue, timeLabel) {
    // Reset any direct slot ID
    document.getElementById('bookingIdKonsultasi').value = '';

    document.getElementById('bookingWaktuMulai').value = timeValue;
    document.getElementById('selectedSlotSummary').textContent = timeLabel;

    document.querySelectorAll('.time-slots-list .slot-item-btn').forEach(b => {
      b.classList.remove('selected');
      const badge = b.querySelector('.slot-status-badge');
      if (badge) badge.textContent = 'Tersedia';
    });

    btn.classList.add('selected');
    const curBadge = btn.querySelector('.slot-status-badge');
    if (curBadge) curBadge.textContent = 'Tersedia (Dipilih)';
  }

  // Initialize events
  document.addEventListener('DOMContentLoaded', () => {
    // Navigation listeners
    document.getElementById('btnCalPrev').addEventListener('click', () => {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      renderCalendar(currentYear, currentMonth);
    });

    document.getElementById('btnCalNext').addEventListener('click', () => {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      renderCalendar(currentYear, currentMonth);
    });

    document.getElementById('btnCalToday').addEventListener('click', () => {
      const curNow = new Date();
      currentYear = curNow.getFullYear();
      currentMonth = curNow.getMonth();
      selectedDateStr = toISODate(currentYear, currentMonth, curNow.getDate());
      renderCalendar(currentYear, currentMonth);
      const summaryDate = document.getElementById('selectedDateSummary');
      if (summaryDate) summaryDate.textContent = formatDisplayDate(selectedDateStr);
      const hiddenDate = document.getElementById('bookingTanggalKonsultasi');
      if (hiddenDate) hiddenDate.value = selectedDateStr;
    });

    // Set initial display date
    const summaryDate = document.getElementById('selectedDateSummary');
    if (summaryDate) summaryDate.textContent = formatDisplayDate(selectedDateStr);

    // Initial render
    renderCalendar(currentYear, currentMonth);
  });
</script>
@endpush
