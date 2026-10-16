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
  <div style="display:grid; grid-template-columns: 360px 1fr; gap: 24px; align-items: start;">

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
        <form action="{{ route('psikolog.jadwal.store') }}" method="POST" style="display:flex; flex-direction:column; gap:14px;">
          @csrf
          <div>
            <label class="form-label" style="font-weight:700; font-size:12.5px; display:block; margin-bottom:5px;">Tanggal Konsultasi</label>
            <input type="date" name="tanggal_konsultasi" class="form-input" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
            <div>
              <label class="form-label" style="font-weight:700; font-size:12.5px; display:block; margin-bottom:5px;">Waktu Mulai</label>
              <input type="time" name="waktu_mulai" class="form-input" value="09:00" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
            </div>
            <div>
              <label class="form-label" style="font-weight:700; font-size:12.5px; display:block; margin-bottom:5px;">Waktu Selesai</label>
              <input type="time" name="waktu_selesai" class="form-input" value="10:00" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
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

    <!-- LIST SLOT AKTIF -->
    <div class="psikolog-card">
      <div class="card-header-wrap">
        <div class="card-title-group">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
          </svg>
          <span class="card-title-text">Slot Jadwal Terpublikasi</span>
        </div>
      </div>

      <div class="card-body-content">
        <div class="slot-items-list" id="slotItemsContainer">
          @forelse($allSlots as $slot)
            @php
              $tgl = \Carbon\Carbon::parse($slot->tanggal_konsultasi);
              $status = $slot->status_booking;
            @endphp
            <div class="slot-card-item" data-slot-status="{{ $status }}" style="display:flex; justify-content:space-between; align-items:center; padding:14px; border:1px solid var(--c-border-light); border-radius:10px; margin-bottom:12px; background:#fff;">
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

              <div class="slot-actions-group" style="display:flex; gap:6px;">
                @if($slot->link_zoom)
                  <button type="button" class="btn-secondary-link" onclick="navigator.clipboard.writeText('{{ $slot->link_zoom }}'); alert('Tautan Zoom berhasil disalin!');" title="Salin Tautan Zoom" style="padding:5px 10px; font-size:12px;">
                    Salin Zoom
                  </button>
                @endif

                @if($status === 'disetujui')
                  <form action="{{ route('psikolog.jadwal.selesai', $slot->id_konsultasi) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-secondary-link" style="color:#027A48; border-color:#A6F4C5; padding:5px 10px; font-size:12px;" onclick="return confirm('Tandai sesi konsultasi ini telah selesai?');">
                      Tandai Selesai
                    </button>
                  </form>
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
</script>
@endpush
