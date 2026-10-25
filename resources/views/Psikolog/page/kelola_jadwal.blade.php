@extends('Psikolog.layout.app', [
    'title' => 'Kelola Jadwal Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Kelola Jadwal Konsultasi',
    'active' => 'jadwal'
])

@section('content')

@if(session('success'))
  <div style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
    {{ session('success') }}
  </div>
@endif

<!-- =========================================================================
     SUBTABS NAVIGATION
     ========================================================================= -->
<div class="subtabs-bar">
  <button type="button" class="tab-btn active" data-tab-target="tabPanelKelolaJadwal">
    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
      <line x1="16" y1="2" x2="16" y2="6"></line>
      <line x1="8" y1="2" x2="8" y2="6"></line>
      <line x1="3" y1="10" x2="21" y2="10"></line>
    </svg>
    <span>Daftar Slot Jadwal ({{ $totalSlot ?? 0 }})</span>
  </button>

  <button type="button" class="tab-btn" data-tab-target="tabPanelPengajuan">
    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
      <polyline points="14 2 14 8 20 8"></polyline>
      <line x1="12" y1="18" x2="12" y2="12"></line>
      <line x1="9" y1="15" x2="15" y2="15"></line>
    </svg>
    <span>Pengajuan Booking Siswa</span>
    @if(($totalMenunggu ?? 0) > 0)
      <span class="tab-badge" style="background:#F04438; color:#fff;" title="{{ $totalMenunggu }} Permintaan Menunggu">{{ $totalMenunggu }}</span>
    @endif
  </button>
</div>

<!-- =========================================================================
     TAB PANEL 1: KELOLA JADWAL
     ========================================================================= -->
<div class="tab-content-panel" id="tabPanelKelolaJadwal">
  <div class="jadwal-two-columns" style="grid-template-columns: 460px 1fr; align-items: start; gap: 24px;">

    <!-- LEFT COLUMN: KALENDER INTERAKTIF & FORM BUKA SLOT -->
    <div style="display:flex; flex-direction:column; gap:20px;">

      <!-- KALENDER INTERAKTIF JADWAL (UKURAN LEBIH BESAR, KONSISTEN) -->
      <div class="psikolog-card">
        <div class="card-header-wrap" style="display:flex; justify-content:space-between; align-items:center;">
          <div class="card-title-group">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="card-title-text" id="calMonthTitle" style="font-size:16px; font-weight:800; color:var(--c-text-heading); text-transform:none; letter-spacing:normal;">-</span>
          </div>
          <div class="calendar-nav-arrows" style="display:flex; gap:6px; align-items:center;">
            <button type="button" class="btn-arrow-calendar" id="btnCalPrev" title="Bulan Sebelumnya" aria-label="Bulan Sebelumnya">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button type="button" class="btn-arrow-calendar" id="btnCalToday" title="Lompat ke Hari Ini" style="width:auto; height:34px; padding:0 12px; font-size:12px; font-weight:700;">
              Hari Ini
            </button>
            <button type="button" class="btn-arrow-calendar" id="btnCalNext" title="Bulan Berikutnya" aria-label="Bulan Berikutnya">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
          </div>
        </div>

        <div class="card-body-content">
          <!-- Weekdays Header Row -->
          <div class="calendar-grid-table" style="margin-bottom:6px;">
            <div class="cal-day-header">Sen</div>
            <div class="cal-day-header">Sel</div>
            <div class="cal-day-header">Rab</div>
            <div class="cal-day-header">Kam</div>
            <div class="cal-day-header">Jum</div>
            <div class="cal-day-header">Sab</div>
            <div class="cal-day-header">Min</div>
          </div>

          <!-- Dynamic Days Grid -->
          <div class="calendar-grid-table" id="calendarDaysGrid">
            <!-- Dinamis di-render via JavaScript -->
          </div>

          <!-- Legend Bar (Tanpa "Lihat Semua Jadwal" link) -->
          <div class="calendar-legend-bar" style="margin-top:16px; padding-top:14px; border-top:1px solid var(--c-border-light); display:flex; align-items:center; justify-content:center; gap:20px; font-size:12px; color:var(--c-text-muted);">
            <span class="legend-item" style="display:inline-flex; align-items:center; gap:6px;">
              <span class="cal-dot available"></span> Tersedia
            </span>
            <span class="legend-item" style="display:inline-flex; align-items:center; gap:6px;">
              <span class="cal-dot approved"></span> Disetujui
            </span>
            <span class="legend-item" style="display:inline-flex; align-items:center; gap:6px;">
              <span class="cal-dot pending"></span> Menunggu
            </span>
          </div>
        </div>
      </div>

      <!-- FORM BUAT SLOT BARU -->
      <div class="psikolog-card">
        <div class="card-header-wrap">
          <div class="card-title-group">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span class="card-title-text">Buka Slot Konsultasi Baru</span>
          </div>
        </div>

        <div class="card-body-content">
          <form action="{{ route('psikolog.jadwal.store') }}" method="POST" id="formBukaSlot" style="display:flex; flex-direction:column; gap:14px;">
            @csrf
            <div>
              <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;">
                <label class="form-label" style="font-weight:700; font-size:12.5px; margin:0;">Tanggal Konsultasi</label>
                <span id="labelSinkronKalender" style="font-size:11px; color:var(--c-primary); font-weight:600;">(Sinkron kalender)</span>
              </div>
              <input type="date" id="inputTanggalKonsultasi" name="tanggal_konsultasi" class="form-input" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
              <div>
                <label class="form-label" style="font-weight:700; font-size:12.5px; display:block; margin-bottom:5px;">Waktu Mulai</label>
                <input type="time" id="inputWaktuMulai" name="waktu_mulai" class="form-input" value="09:00" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
              </div>
              <div>
                <label class="form-label" style="font-weight:700; font-size:12.5px; display:block; margin-bottom:5px;">Waktu Selesai</label>
                <input type="time" id="inputWaktuSelesai" name="waktu_selesai" class="form-input" value="10:00" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
              </div>
            </div>

            <div>
              <label class="form-label" style="font-weight:700; font-size:12.5px; display:block; margin-bottom:5px;">Tautan Zoom Sesi (Opsional)</label>
              <input type="url" name="link_zoom" class="form-input" placeholder="https://zoom.us/j/..." style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
              <div style="font-size:11px; color:var(--c-text-muted); margin-top:3px;">Jika dikosongkan, tautan Zoom akan di-generate otomatis.</div>
            </div>

            <button type="submit" class="btn-primary-action" style="width:100%; justify-content:center; padding:11px; font-weight:700; margin-top:6px;">
              + Publikasikan Slot
            </button>
          </form>
        </div>
      </div>

    </div>

    <!-- RIGHT COLUMN: LIST SLOT AKTIF -->
    <div class="psikolog-card">
      <div class="card-header-wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div class="card-title-group">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
          </svg>
          <span class="card-title-text">Slot Jadwal Terpublikasi</span>
          <span class="tab-badge" id="totalSlotCountBadge" style="background:#F1F5F9; color:var(--c-text-body); font-size:12px; font-weight:700;">{{ $totalSlot ?? 0 }} Slot</span>
          
          <!-- Indikator Filter Tanggal Kalender (Klik untuk batalkan filter tanggal) -->
          <span id="activeFilterBadge" style="display:none; background:#EFF8FF; color:#175CD3; border:1px solid #B2DDFF; border-radius:6px; padding:3px 8px; font-size:11.5px; font-weight:700; align-items:center; gap:4px; cursor:pointer;" title="Klik untuk menghapus filter tanggal kalender">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <span id="filterDateLabel">Semua</span>
            <span style="font-size:12px; font-weight:bold; margin-left:2px;">&times;</span>
          </span>
        </div>

        <!-- Search & Filter Controls (Disatukan pada card slot, tanpa tombol reset, murni JS) -->
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
          <div class="search-input-wrap" style="width:200px; margin:0;">
            <div class="search-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </div>
            <input type="text" id="inputSearchSlot" placeholder="Cari jam / siswa..." style="padding-left:34px; height:36px; font-size:12.5px;">
          </div>

          <select class="select-filter-custom" id="selectFilterStatusSlot" style="height:36px; font-size:12.5px; padding:0 30px 0 12px;">
            <option value="all">Semua Status</option>
            <option value="tersedia">Tersedia</option>
            <option value="disetujui">Disetujui</option>
            <option value="menunggu">Menunggu</option>
            <option value="selesai">Selesai</option>
          </select>
        </div>
      </div>

      <div class="card-body-content">
        <!-- Empty state when calendar date has no slots -->
        <div id="noSlotsForDate" style="display:none; text-align:center; padding:36px 16px; background:#F8FAFC; border:1.5px dashed #CBD5E1; border-radius:12px; margin-bottom:12px;">
          <div style="width:44px; height:44px; border-radius:50%; background:#E0F2FE; color:#0284C7; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          </div>
          <div style="font-size:14.5px; font-weight:700; color:var(--c-text-heading); margin-bottom:4px;">Tidak Ada Jadwal pada Tanggal Ini</div>
          <p style="font-size:13px; color:var(--c-text-muted); margin:0 0 14px;">Belum ada slot konsultasi pada <span id="emptyDateLabel" style="font-weight:700; color:var(--c-primary);">-</span>.</p>
          <button type="button" class="btn-primary-action" id="btnQuickAddSlot" style="padding:8px 16px; font-size:12.5px; margin:0 auto;">
            + Buka Slot pada Tanggal Ini
          </button>
        </div>

        <!-- Empty state when search or status filter has no match -->
        <div id="noSlotsFiltered" style="display:none; text-align:center; padding:36px 16px; background:#F8FAFC; border:1.5px dashed #CBD5E1; border-radius:12px; margin-bottom:12px;">
          <div style="font-size:14.5px; font-weight:700; color:var(--c-text-heading); margin-bottom:4px;">Tidak Ada Slot yang Cocok</div>
          <p style="font-size:13px; color:var(--c-text-muted); margin:0;">Tidak ditemukan slot jadwal konsultasi yang sesuai dengan pencarian atau filter status terpilih.</p>
        </div>

        <div class="slot-items-list" id="slotItemsContainer">
          @forelse($allSlots as $slot)
            @php
              $tgl = \Carbon\Carbon::parse($slot->tanggal_konsultasi);
              $status = $slot->status_booking;
            @endphp
            <div class="slot-card-item" data-tanggal="{{ $tgl->format('Y-m-d') }}" data-slot-status="{{ $status }}" data-searchable="{{ $tgl->format('Y-m-d') }} {{ substr($slot->waktu_mulai, 0, 5) }} {{ substr($slot->waktu_selesai, 0, 5) }} {{ $slot->siswa->nama ?? '' }} {{ $slot->siswa->sekolah ?? '' }} {{ $slot->link_zoom ?? '' }} {{ $status }}" style="display:flex; justify-content:space-between; align-items:center; padding:16px; border:1px solid var(--c-border-light); border-radius:10px; margin-bottom:12px; background:#fff; width:100%; box-sizing:border-box;">
              <div class="slot-left-info" style="display:flex; align-items:center; gap:14px;">
                <div class="slot-date-badge" style="background:#F1F5F9; border-radius:8px; padding:8px 12px; text-align:center;">
                  <span class="day-txt" style="display:block; font-size:11px; font-weight:700; color:var(--c-text-muted);">{{ $tgl->translatedFormat('D') }}</span>
                  <span class="date-txt" style="display:block; font-size:14px; font-weight:800; color:var(--c-text-heading);">{{ $tgl->format('d M') }}</span>
                </div>
                <div class="slot-detail-meta">
                  <h5 style="margin:0 0 4px; font-size:14px; font-weight:700;">
                    {{ substr($slot->waktu_mulai, 0, 5) }} - {{ substr($slot->waktu_selesai, 0, 5) }} WIB
                    @if($status === 'tersedia')
                      <span class="status-tag tersedia" style="background:#EBFDF2; color:#027A48; font-size:11px; padding:2px 7px; border-radius:4px; margin-left:6px;">Tersedia</span>
                    @elseif($status === 'disetujui')
                      <span class="status-tag disetujui" style="background:#EFF8FF; color:#175CD3; font-size:11px; padding:2px 7px; border-radius:4px; margin-left:6px;">Disetujui</span>
                    @elseif($status === 'menunggu')
                      <span class="status-tag pending" style="background:#FFF9E6; color:#7A5400; font-size:11px; padding:2px 7px; border-radius:4px; margin-left:6px;">Menunggu Siswa</span>
                    @elseif($status === 'selesai')
                      <span class="status-tag" style="background:#F1F5F9; color:#475467; font-size:11px; padding:2px 7px; border-radius:4px; margin-left:6px;">Selesai</span>
                    @else
                      <span class="status-tag">{{ ucfirst($status) }}</span>
                    @endif
                  </h5>
                  @if($slot->siswa)
                    <p style="margin:0; font-size:12px; color:var(--c-primary); font-weight:600;">
                      Siswa: {{ $slot->siswa->nama }} ({{ $slot->siswa->sekolah ?? 'Sekolah' }})
                    </p>
                  @else
                    <p style="margin:0; font-size:12px; color:var(--c-text-muted);">
                      Link: {{ $slot->link_zoom ?? 'Belum ada link' }}
                    </p>
                  @endif
                </div>
              </div>

              <div class="slot-actions-group" style="display:flex; gap:6px; align-items:center;">
                @if($slot->siswa)
                  @php
                    $slotPayload = [
                        'id' => '#KNS-' . str_pad($slot->id_konsultasi, 2, '0', STR_PAD_LEFT),
                        'tanggal' => $tgl->translatedFormat('l, d F Y'),
                        'waktu' => substr($slot->waktu_mulai, 0, 5) . ' - ' . substr($slot->waktu_selesai, 0, 5) . ' WIB',
                        'durasi' => '60 Menit',
                        'siswa_nama' => $slot->siswa->nama ?? 'Siswa',
                        'siswa_sekolah' => $slot->siswa->sekolah ?? 'Sekolah Tidak Terdata',
                        'siswa_kelas' => $slot->siswa->kelas ?? 'Kelas Siswa',
                        'siswa_telepon' => $slot->siswa->no_telepon ?? 'Belum ada kontak WA',
                        'status' => $status,
                        'link_zoom' => $slot->link_zoom ?? '',
                        'catatan' => $slot->catatan ?? '',
                        'alasan_tolak' => $slot->alasan_tolak ?? '',
                    ];
                  @endphp
                  <button type="button" class="btn-secondary-link btn-open-detail-psikolog"
                    data-detail="{{ json_encode($slotPayload) }}"
                    style="padding:5px 10px; font-size:12px; display:inline-flex; align-items:center; gap:4px;"
                    title="Lihat Detail & Catatan Sesi">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    Detail
                  </button>
                @endif

                @if($slot->link_zoom)
                  <button type="button" class="btn-secondary-link" onclick="navigator.clipboard.writeText('{{ $slot->link_zoom }}'); alert('Tautan Zoom berhasil disalin!');" title="Salin Tautan Zoom" style="padding:5px 10px; font-size:12px;">
                    Salin Zoom
                  </button>
                @endif

                @if($status === 'disetujui')
                  <button type="button" class="btn-secondary-link btn-trigger-selesai"
                    data-id="{{ $slot->id_konsultasi }}"
                    data-siswa="{{ $slot->siswa->nama ?? 'Siswa' }}"
                    data-meta="{{ $tgl->translatedFormat('l, d F Y') }} • {{ substr($slot->waktu_mulai, 0, 5) }} - {{ substr($slot->waktu_selesai, 0, 5) }} WIB"
                    data-catatan="{{ $slot->catatan ?? '' }}"
                    style="color:#027A48; border-color:#A6F4C5; padding:5px 10px; font-size:12px; font-weight:700;">
                    Tandai Selesai
                  </button>
                @endif

                @if($status === 'tersedia')
                  <form action="{{ route('psikolog.jadwal.destroy', $slot->id_konsultasi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slot ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary-link" style="color:#c53030; padding:5px 10px; font-size:12px;">
                      Hapus
                    </button>
                  </form>
                @endif
              </div>
            </div>
          @empty
            <div style="text-align:center; padding:36px 16px; color:var(--c-text-muted);">
              <div style="font-size:14px; font-weight:700; color:var(--c-text-heading); margin-bottom:4px;">Belum Ada Slot Terbuka</div>
              <p style="font-size:13px; margin:0;">Gunakan formulir di sebelah kiri untuk mempublikasikan slot konsultasi pertama Anda.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>

  </div>
</div>

<!-- =========================================================================
     TAB PANEL 2: PENGAJUAN BOOKING SISWA
     ========================================================================= -->
<div class="tab-content-panel" id="tabPanelPengajuan" style="display:none;">
  <div class="psikolog-card">
    <div class="card-header-wrap">
      <div class="card-title-group">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
        <span class="card-title-text">Daftar Pengajuan Bimbingan Siswa (Menunggu Verifikasi)</span>
      </div>
    </div>

    <div class="card-body-content">
      @forelse($pengajuanList as $pengajuan)
        @php
          $siswaNama = $pengajuan->siswa->nama ?? 'Siswa';
          $ini = strtoupper(substr($siswaNama, 0, 2));
        @endphp
        <div style="border:1.5px solid #FCE49E; background:#FFFDF5; border-radius:12px; padding:18px; margin-bottom:16px;">
          <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; flex-wrap:wrap;">
            <div style="display:flex; align-items:center; gap:12px;">
              <div style="width:44px; height:44px; border-radius:50%; background:#30618C; color:#fff; font-weight:800; font-size:15px; display:flex; align-items:center; justify-content:center;">
                {{ $ini }}
              </div>
              <div>
                <h4 style="margin:0 0 3px; font-size:15px; font-weight:800; color:var(--c-text-heading);">{{ $siswaNama }}</h4>
                <div style="font-size:12.5px; color:var(--c-text-muted);">
                  {{ $pengajuan->siswa->sekolah ?? 'Sekolah' }} • {{ $pengajuan->siswa->kelas ?? 'Kelas' }} • WA: {{ $pengajuan->siswa->no_telepon ?? 'Belum ada' }}
                </div>
              </div>
            </div>

            <div style="text-align:right;">
              <div style="font-weight:700; font-size:13.5px; color:var(--c-primary);">
                {{ \Carbon\Carbon::parse($pengajuan->tanggal_konsultasi)->translatedFormat('l, d F Y') }}
              </div>
              <div style="font-size:12px; color:var(--c-text-muted);">
                {{ substr($pengajuan->waktu_mulai, 0, 5) }} - {{ substr($pengajuan->waktu_selesai, 0, 5) }} WIB
              </div>
            </div>
          </div>

          <div style="background:#fff; border:1px solid #E2E8F0; border-radius:8px; padding:12px 14px; margin:14px 0;">
            <div style="font-size:11px; font-weight:700; text-transform:uppercase; color:var(--c-text-muted); margin-bottom:3px;">Catatan Pertanyaan / Topik Siswa:</div>
            <div style="font-size:13px; color:var(--c-text-body); line-height:1.4;">{{ $pengajuan->catatan ?? 'Siswa ingin berkonsultasi mengenai pertimbangan pemilihan program studi.' }}</div>
          </div>

          <div style="display:flex; justify-content:flex-end; gap:10px;">
            <!-- Form Tolak -->
            <form action="{{ route('psikolog.jadwal.tolak', $pengajuan->id_konsultasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pengajuan bimbingan ini?');">
              @csrf
              @method('PUT')
              <input type="hidden" name="alasan_tolak" value="Jadwal berhalangan atau kuota telah penuh.">
              <button type="submit" class="btn-secondary-link" style="color:#B42318; border-color:#FECDCA; padding:8px 16px;">
                Tolak
              </button>
            </form>

            <!-- Form Setujui -->
            <form action="{{ route('psikolog.jadwal.setujui', $pengajuan->id_konsultasi) }}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn-primary-action" style="padding:8px 18px; font-weight:700;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Setujui Jadwal &amp; Siapkan Zoom
              </button>
            </form>
          </div>
        </div>
      @empty
        <div style="text-align:center; padding:36px; color:var(--c-text-muted);">
          <div style="font-size:14.5px; font-weight:700; color:var(--c-text-heading); margin-bottom:4px;">Tidak Ada Pengajuan Menunggu</div>
          <p style="font-size:13px; margin:0;">Semua pengajuan booking dari siswa telah diverifikasi.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  // Tab Switcher
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.tab-content-panel').forEach(p => p.style.display = 'none');

      btn.classList.add('active');
      const target = document.getElementById(btn.getAttribute('data-tab-target'));
      if (target) target.style.display = 'block';
    });
  });

  // =========================================================================
  // INTERACTIVE CALENDAR & SCHEDULE FILTER SYSTEM
  // =========================================================================
  const allSlotsData = @json($allSlots);

  const monthNamesIndo = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  const dayNamesIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

  // Map slots by date YYYY-MM-DD
  const slotsMap = {};
  allSlotsData.forEach(slot => {
    if (!slot.tanggal_konsultasi) return;
    const dateStr = slot.tanggal_konsultasi.substring(0, 10);
    if (!slotsMap[dateStr]) {
      slotsMap[dateStr] = [];
    }
    slotsMap[dateStr].push(slot);
  });

  // Calendar State
  const today = new Date();
  const todayYear = today.getFullYear();
  const todayMonth = today.getMonth(); // 0-indexed
  const todayDate = today.getDate();
  const todayIsoStr = `${todayYear}-${String(todayMonth + 1).padStart(2, '0')}-${String(todayDate).padStart(2, '0')}`;

  let viewYear = todayYear;
  let viewMonth = todayMonth;
  let selectedDate = null; // null = show all slots

  function formatIsoDate(d) {
    const y = d.getFullYear();
    const m = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${y}-${m}-${day}`;
  }

  function formatIndoDate(isoStr) {
    if (!isoStr) return '';
    const parts = isoStr.split('-');
    const y = parseInt(parts[0], 10);
    const m = parseInt(parts[1], 10) - 1;
    const d = parseInt(parts[2], 10);
    const dateObj = new Date(y, m, d);
    const dayName = dayNamesIndo[dateObj.getDay()];
    const monthName = monthNamesIndo[m];
    return `${dayName}, ${d} ${monthName} ${y}`;
  }

  function renderCalendar(year, month) {
    const monthTitle = document.getElementById('calMonthTitle');
    const daysGrid = document.getElementById('calendarDaysGrid');
    if (!daysGrid) return;

    if (monthTitle) {
      monthTitle.textContent = `${monthNamesIndo[month]} ${year}`;
    }

    daysGrid.innerHTML = '';

    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const prevMonthDays = new Date(year, month, 0).getDate();
    const firstDayIndex = new Date(year, month, 1).getDay(); // 0 = Sunday
    // Monday-first offset
    const startOffset = (firstDayIndex + 6) % 7;

    // 1. Previous month padding cells
    for (let p = startOffset - 1; p >= 0; p--) {
      const pDay = prevMonthDays - p;
      const pDate = new Date(year, month - 1, pDay);
      const iso = formatIsoDate(pDate);
      const cell = createDayCell(pDay, iso, true);
      daysGrid.appendChild(cell);
    }

    // 2. Current month days
    for (let d = 1; d <= daysInMonth; d++) {
      const cDate = new Date(year, month, d);
      const iso = formatIsoDate(cDate);
      const cell = createDayCell(d, iso, false);
      daysGrid.appendChild(cell);
    }

    // 3. Next month padding cells
    const totalRendered = startOffset + daysInMonth;
    const remaining = (7 - (totalRendered % 7)) % 7;
    for (let n = 1; n <= remaining; n++) {
      const nDate = new Date(year, month + 1, n);
      const iso = formatIsoDate(nDate);
      const cell = createDayCell(n, iso, true);
      daysGrid.appendChild(cell);
    }
  }

  function createDayCell(dayNum, isoStr, isOtherMonth) {
    const cell = document.createElement('div');
    cell.className = 'cal-day-cell';
    cell.setAttribute('data-date', isoStr);

    if (isOtherMonth) {
      cell.classList.add('other-month');
    }
    if (isoStr === todayIsoStr) {
      cell.classList.add('today');
    }
    if (selectedDate && isoStr === selectedDate) {
      cell.classList.add('selected');
    }

    const numSpan = document.createElement('span');
    numSpan.textContent = dayNum;
    cell.appendChild(numSpan);

    const dateSlots = slotsMap[isoStr] || [];
    if (dateSlots.length > 0) {
      cell.classList.add('has-slots');
      const dotsRow = document.createElement('div');
      dotsRow.className = 'cal-dots-row';

      const hasAvailable = dateSlots.some(s => s.status_booking === 'tersedia');
      const hasApproved  = dateSlots.some(s => s.status_booking === 'disetujui');
      const hasPending   = dateSlots.some(s => s.status_booking === 'menunggu');
      const hasCompleted = dateSlots.some(s => s.status_booking === 'selesai');

      if (hasAvailable) {
        const dot = document.createElement('span');
        dot.className = 'cal-dot available';
        dot.title = 'Ada slot tersedia';
        dotsRow.appendChild(dot);
      }
      if (hasApproved) {
        const dot = document.createElement('span');
        dot.className = 'cal-dot approved';
        dot.title = 'Ada sesi disetujui';
        dotsRow.appendChild(dot);
      }
      if (hasPending) {
        const dot = document.createElement('span');
        dot.className = 'cal-dot pending';
        dot.title = 'Ada pengajuan menunggu';
        dotsRow.appendChild(dot);
      }
      if (hasCompleted && !hasAvailable && !hasApproved && !hasPending) {
        const dot = document.createElement('span');
        dot.className = 'cal-dot completed';
        dot.title = 'Sesi telah selesai';
        dotsRow.appendChild(dot);
      }

      cell.appendChild(dotsRow);

      const desc = [];
      if (hasAvailable) desc.push('Tersedia');
      if (hasApproved) desc.push('Disetujui');
      if (hasPending) desc.push('Menunggu');
      if (hasCompleted) desc.push('Selesai');
      cell.title = `${formatIndoDate(isoStr)}: ${dateSlots.length} jadwal (${desc.join(', ')})`;
    } else {
      cell.title = formatIndoDate(isoStr);
    }

    cell.addEventListener('click', () => {
      const parts = isoStr.split('-');
      const targetYear = parseInt(parts[0], 10);
      const targetMonth = parseInt(parts[1], 10) - 1;

      if (targetYear !== viewYear || targetMonth !== viewMonth) {
        viewYear = targetYear;
        viewMonth = targetMonth;
        renderCalendar(viewYear, viewMonth);
      }

      // Jika tanggal yang sama diklik lagi, toggle/batalkan seleksi tanggal
      if (selectedDate === isoStr) {
        resetDateFilter();
        return;
      }

      handleDateSelect(isoStr);
    });

    return cell;
  }

  function handleDateSelect(isoStr) {
    selectedDate = isoStr;

    // Highlight active cell
    document.querySelectorAll('#calendarDaysGrid .cal-day-cell').forEach(c => {
      if (c.getAttribute('data-date') === isoStr) {
        c.classList.add('selected');
      } else {
        c.classList.remove('selected');
      }
    });

    // Sync "Buka Slot Baru" date input if >= today
    const inputDate = document.getElementById('inputTanggalKonsultasi');
    if (inputDate && isoStr >= todayIsoStr) {
      inputDate.value = isoStr;
    }

    // Filter slots on the right column
    filterSlotsUnified();
  }

  function filterSlotsUnified() {
    const slotCards = document.querySelectorAll('.slot-card-item');
    const noSlotsBox = document.getElementById('noSlotsForDate');
    const noSlotsFiltered = document.getElementById('noSlotsFiltered');
    const filterBadge = document.getElementById('activeFilterBadge');
    const filterDateLabel = document.getElementById('filterDateLabel');
    const emptyDateLabel = document.getElementById('emptyDateLabel');
    const totalSlotCountBadge = document.getElementById('totalSlotCountBadge');

    const searchVal = (document.getElementById('inputSearchSlot')?.value || '').toLowerCase().trim();
    const statusVal = document.getElementById('selectFilterStatusSlot')?.value || 'all';

    let matchCount = 0;
    let dateTotalCount = 0;

    slotCards.forEach(card => {
      const cardDate = card.getAttribute('data-tanggal');
      const cardStatus = card.getAttribute('data-slot-status');
      const cardSearchable = (card.getAttribute('data-searchable') || '').toLowerCase();

      const matchDate = !selectedDate || (cardDate === selectedDate);
      if (selectedDate && cardDate === selectedDate) {
        dateTotalCount++;
      }

      const matchStatus = (statusVal === 'all') || (cardStatus === statusVal);
      const matchSearch = !searchVal || cardSearchable.includes(searchVal);

      if (matchDate && matchStatus && matchSearch) {
        card.classList.remove('filter-hidden');
        card.style.removeProperty('display');
        card.style.setProperty('display', 'flex', 'important');
        matchCount++;
      } else {
        card.classList.add('filter-hidden');
        card.style.setProperty('display', 'none', 'important');
      }
    });

    if (totalSlotCountBadge) {
      totalSlotCountBadge.textContent = `${matchCount} Slot`;
    }

    if (selectedDate) {
      const formattedDate = formatIndoDate(selectedDate);
      if (filterBadge && filterDateLabel) {
        filterDateLabel.textContent = `${formattedDate} (${dateTotalCount} Slot)`;
        filterBadge.style.display = 'inline-flex';
      }
      if (emptyDateLabel) emptyDateLabel.textContent = formattedDate;

      if (dateTotalCount === 0) {
        if (noSlotsBox) noSlotsBox.style.display = 'block';
        if (noSlotsFiltered) noSlotsFiltered.style.display = 'none';
      } else if (matchCount === 0) {
        if (noSlotsBox) noSlotsBox.style.display = 'none';
        if (noSlotsFiltered) noSlotsFiltered.style.display = 'block';
      } else {
        if (noSlotsBox) noSlotsBox.style.display = 'none';
        if (noSlotsFiltered) noSlotsFiltered.style.display = 'none';
      }
    } else {
      if (filterBadge) filterBadge.style.display = 'none';
      if (noSlotsBox) noSlotsBox.style.display = 'none';

      if (matchCount === 0 && slotCards.length > 0) {
        if (noSlotsFiltered) noSlotsFiltered.style.display = 'block';
      } else {
        if (noSlotsFiltered) noSlotsFiltered.style.display = 'none';
      }
    }
  }

  function resetDateFilter() {
    selectedDate = null;
    document.querySelectorAll('#calendarDaysGrid .cal-day-cell').forEach(c => c.classList.remove('selected'));
    filterSlotsUnified();
  }

  // Search & Status Filter Listeners (Real-time JS)
  document.getElementById('inputSearchSlot')?.addEventListener('input', filterSlotsUnified);
  document.getElementById('selectFilterStatusSlot')?.addEventListener('change', filterSlotsUnified);
  document.getElementById('activeFilterBadge')?.addEventListener('click', resetDateFilter);

  // Calendar Navigation Listeners
  document.getElementById('btnCalPrev')?.addEventListener('click', () => {
    viewMonth--;
    if (viewMonth < 0) {
      viewMonth = 11;
      viewYear--;
    }
    renderCalendar(viewYear, viewMonth);
  });

  document.getElementById('btnCalNext')?.addEventListener('click', () => {
    viewMonth++;
    if (viewMonth > 11) {
      viewMonth = 0;
      viewYear++;
    }
    renderCalendar(viewYear, viewMonth);
  });

  document.getElementById('btnCalToday')?.addEventListener('click', () => {
    viewYear = todayYear;
    viewMonth = todayMonth;
    renderCalendar(viewYear, viewMonth);
    handleDateSelect(todayIsoStr);
  });

  document.getElementById('btnQuickAddSlot')?.addEventListener('click', () => {
    const inputDate = document.getElementById('inputTanggalKonsultasi');
    const inputStart = document.getElementById('inputWaktuMulai');
    if (selectedDate && inputDate && selectedDate >= todayIsoStr) {
      inputDate.value = selectedDate;
    }
    if (inputStart) {
      inputStart.focus();
      inputStart.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // Sync date input change back to calendar
  document.getElementById('inputTanggalKonsultasi')?.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val) {
      const parts = val.split('-');
      viewYear = parseInt(parts[0], 10);
      viewMonth = parseInt(parts[1], 10) - 1;
      renderCalendar(viewYear, viewMonth);
      handleDateSelect(val);
    }
  });

  // Initial render
  renderCalendar(viewYear, viewMonth);

  // Modal Selesai Konsultasi Trigger
  const modalSelesai = document.getElementById('modalSelesaiKonsultasi');
  const formSelesai = document.getElementById('formSelesaiKonsultasi');
  const elSelesaiNama = document.getElementById('modalSelesaiSiswaNama');
  const elSelesaiMeta = document.getElementById('modalSelesaiMeta');
  const elSelesaiCatatan = document.getElementById('modalSelesaiInputCatatan');

  document.querySelectorAll('.btn-trigger-selesai').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const id = btn.getAttribute('data-id');
      const siswa = btn.getAttribute('data-siswa') || 'Siswa';
      const meta = btn.getAttribute('data-meta') || '-';
      const catatan = btn.getAttribute('data-catatan') || '';

      if (formSelesai) {
        formSelesai.action = `{{ url('/psikolog/jadwal') }}/${id}/selesai`;
      }
      if (elSelesaiNama) elSelesaiNama.textContent = siswa;
      if (elSelesaiMeta) elSelesaiMeta.textContent = meta;
      if (elSelesaiCatatan) elSelesaiCatatan.value = catatan;

      if (modalSelesai) {
        modalSelesai.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  // Modal Detail & Catatan Lengkap Handler
  const modalDetail = document.getElementById('modalCatatanLengkap');
  const elSiswaNama = document.getElementById('modalSiswaNama');
  const elSiswaSekolah = document.getElementById('modalSiswaSekolah');
  const elSiswaKontak = document.getElementById('modalSiswaKontak');
  const elStatusBadge = document.getElementById('modalCatatanStatusBadge');
  const elSesiTanggal = document.getElementById('modalSesiTanggal');
  const elSesiDurasi = document.getElementById('modalSesiDurasi');
  const elTopik = document.getElementById('modalTopikKonseling');
  const elCatatan = document.getElementById('modalCatatanPsikolog');
  const elZoomWrap = document.getElementById('modalCatatanZoomWrap');
  const elZoomLink = document.getElementById('modalCatatanZoomLink');
  const elBtnCopyZoom = document.getElementById('modalBtnCopyZoomPsikolog');
  const elTolakWrap = document.getElementById('modalAlasanTolakWrap');
  const elTolak = document.getElementById('modalAlasanTolak');

  let currentZoom = '';

  document.querySelectorAll('.btn-open-detail-psikolog').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      let data = {};
      try {
        const raw = btn.getAttribute('data-detail');
        if (raw) data = JSON.parse(raw);
      } catch (err) {
        console.warn('Gagal membaca detail:', err);
      }

      const nama = data.siswa_nama || 'Siswa';
      const sekolah = `${data.siswa_sekolah || '-'} • ${data.siswa_kelas || '-'}`;
      const kontak = `WA: ${data.siswa_telepon || '-'}`;
      const tgl = data.tanggal || '-';
      const durasi = `${data.waktu || '-'} (${data.durasi || '60 Menit'})`;
      const status = data.status || 'selesai';
      const catatan = data.catatan || '';
      const tolak = data.alasan_tolak || '';
      currentZoom = data.link_zoom || '';

      if (elSiswaNama) elSiswaNama.textContent = nama;
      if (elSiswaSekolah) elSiswaSekolah.textContent = sekolah;
      if (elSiswaKontak) elSiswaKontak.textContent = kontak;
      if (elSesiTanggal) elSesiTanggal.textContent = tgl;
      if (elSesiDurasi) elSesiDurasi.textContent = durasi;

      if (elStatusBadge) {
        if (status === 'selesai') {
          elStatusBadge.innerHTML = '<span class="status-tag" style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">Selesai Terlaksana</span>';
        } else if (status === 'disetujui') {
          elStatusBadge.innerHTML = '<span class="status-tag" style="background:#EFF8FF; color:#175CD3; border:1px solid #B2DDFF; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">Disetujui</span>';
        } else if (status === 'menunggu') {
          elStatusBadge.innerHTML = '<span class="status-tag" style="background:#FFF9E6; color:#7A5400; border:1px solid #FCE49E; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">Menunggu Verifikasi</span>';
        } else if (status === 'ditolak') {
          elStatusBadge.innerHTML = '<span class="status-tag" style="background:#FEF3F2; color:#B42318; border:1px solid #FECDCA; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">Ditolak</span>';
        } else {
          elStatusBadge.innerHTML = `<span class="status-tag" style="padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">${status}</span>`;
        }
      }

      if (elTopik) {
        elTopik.textContent = catatan ? catatan : 'Bimbingan minat bakat dan rekomendasi program studi akademik.';
      }

      if (elCatatan) {
        if (status === 'selesai' && catatan) {
          elCatatan.textContent = catatan;
          elCatatan.style.fontStyle = 'normal';
          elCatatan.style.color = '#172C40';
        } else if (status === 'selesai') {
          elCatatan.textContent = 'Sesi telah diselesaikan. Psikolog belum mencatat narasi evaluasi rinci.';
          elCatatan.style.fontStyle = 'italic';
          elCatatan.style.color = '#6B8299';
        } else {
          elCatatan.textContent = 'Sesi bimbingan belum tuntas. Catatan evaluasi dan rekomendasi akan disimpan saat menandai selesai.';
          elCatatan.style.fontStyle = 'italic';
          elCatatan.style.color = '#6B8299';
        }
      }

      if (elZoomWrap) {
        if (currentZoom) {
          elZoomWrap.style.display = 'block';
          if (elZoomLink) {
            elZoomLink.href = currentZoom;
            elZoomLink.textContent = currentZoom;
          }
        } else {
          elZoomWrap.style.display = 'none';
        }
      }

      if (elTolakWrap) {
        if (status === 'ditolak' && tolak) {
          elTolakWrap.style.display = 'block';
          if (elTolak) elTolak.textContent = tolak;
        } else {
          elTolakWrap.style.display = 'none';
        }
      }

      if (modalDetail) {
        modalDetail.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  if (elBtnCopyZoom) {
    elBtnCopyZoom.addEventListener('click', () => {
      if (currentZoom) {
        navigator.clipboard.writeText(currentZoom);
        alert('Tautan Zoom berhasil disalin!');
      }
    });
  }
</script>
@endpush
