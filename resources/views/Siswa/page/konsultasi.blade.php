@extends('Siswa.layouts.app', [
    'title' => 'Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Konsultasi',
    'active' => 'konsultasi'
])

@section('content')
  <!-- Top Action Header -->
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <div style="display:flex; align-items:center; gap:12px; margin-bottom:4px;">
        <img src="{{ asset('foto/logo.png') }}" alt="Logo B-Youth" style="width:34px; height:34px; object-fit:contain;">
        <h2 style="margin:0;">Konsultasi Psikologi &amp; Karier</h2>
      </div>
      <p>Jadwalkan sesi bimbingan 1-on-1 bersama psikolog pendidikan tersertifikasi untuk memvalidasi pilihan masa depanmu.</p>
    </div>

    <a href="{{ route('siswa.riwayat_konsultasi') }}" class="btn-step-action btn-outline-action" style="padding:10px 18px; text-decoration:none;">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      <span>Lihat Riwayat Konsultasi</span>
    </a>
  </div>

  @if(session('success'))
    <div style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
      {{ session('success') }}
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
  @endif

  <!-- =========================================================================
       2. GRID BOOKING & DAFTAR PSIKOLOG
       ========================================================================= -->
  <div class="consultation-booking-grid">
    
    <!-- LEFT COLUMN: PILIH PSIKOLOG & PENGAJUAN -->
    <div class="booking-card">
      <div class="booking-card-header">
        <div class="booking-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <span>Daftar Psikolog Pendidikan</span>
        </div>
        <span style="font-size:12.5px; color:var(--c-text-muted); font-weight:600;">Tersertifikasi</span>
      </div>

      <div style="display:flex; flex-direction:column; gap:14px; margin-top:10px;">
        @forelse($psikologs as $psk)
          @php $ini = strtoupper(substr($psk->nama, 0, 2)); @endphp
          <div style="border:1.5px solid var(--c-border-light); border-radius:12px; padding:14px; background:#F8FAFD; display:flex; justify-content:space-between; align-items:center; gap:12px;">
            <div style="display:flex; align-items:center; gap:12px;">
              <div style="width:40px; height:40px; border-radius:50%; background:#30618C; color:#fff; font-weight:800; font-size:14px; display:flex; align-items:center; justify-content:center;">
                {{ $ini }}
              </div>
              <div>
                <h4 style="margin:0 0 2px; font-size:14.5px; font-weight:700; color:var(--c-text-heading);">{{ $psk->nama }}</h4>
                <div style="font-size:12px; color:var(--c-primary); font-weight:600;">{{ $psk->spesialisasi ?? 'Psikolog Pendidikan' }}</div>
                <div style="font-size:11px; color:var(--c-text-muted);">SIP: {{ $psk->no_sip ?? 'Terverifikasi HIMPSI' }}</div>
              </div>
            </div>
            <button type="button" class="btn-step-action btn-outline-action" style="font-size:12px; padding:6px 12px;" onclick="document.getElementById('bookingIdPsikolog').value = '{{ $psk->id_psikolog }}'; document.getElementById('selectedPsikologName').textContent = '{{ $psk->nama }}';">
              Pilih
            </button>
          </div>
        @empty
          <div style="text-align:center; padding:24px; color:var(--c-text-muted); font-size:13px;">
            Belum ada psikolog aktif terdaftar di sistem.
          </div>
        @endforelse
      </div>

      @if($availableSlots->isNotEmpty())
        <div style="margin-top:24px; border-top:1px solid var(--c-border-light); padding-top:16px;">
          <h4 style="font-size:14px; font-weight:800; color:var(--c-text-heading); margin-bottom:10px;">Slot Terbuka yang Disediakan Psikolog:</h4>
          <div style="display:flex; flex-direction:column; gap:8px;">
            @foreach($availableSlots as $slot)
              <form action="{{ route('siswa.konsultasi.booking') }}" method="POST" style="display:flex; align-items:center; justify-content:space-between; background:#fff; border:1px solid #D0DCE8; border-radius:8px; padding:10px 14px;">
                @csrf
                <input type="hidden" name="id_konsultasi" value="{{ $slot->id_konsultasi }}">
                <div>
                  <div style="font-weight:700; font-size:13px; color:var(--c-text-heading);">
                    {{ \Carbon\Carbon::parse($slot->tanggal_konsultasi)->translatedFormat('l, d M Y') }}
                  </div>
                  <div style="font-size:12px; color:var(--c-text-muted);">
                    {{ substr($slot->waktu_mulai, 0, 5) }} - {{ substr($slot->waktu_selesai, 0, 5) }} WIB • {{ $slot->psikolog->nama ?? 'Psikolog' }}
                  </div>
                </div>
                <button type="submit" class="btn-primary-action" style="padding:6px 14px; font-size:12px;">
                  Ambil Slot
                </button>
              </form>
            @endforeach
          </div>
        </div>
      @endif
    </div>

    <!-- RIGHT COLUMN: FORM PENGAJUAN JADWAL -->
    <div class="booking-card">
      <div class="booking-card-header">
        <div class="booking-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span>Formulir Pengajuan Bimbingan</span>
        </div>
        <span style="font-size:12.5px; color:var(--c-text-muted); font-weight:600;">Sesi 1-on-1</span>
      </div>

      <form action="{{ route('siswa.konsultasi.booking') }}" method="POST" style="display:flex; flex-direction:column; gap:16px; margin-top:10px;">
        @csrf
        <div>
          <label class="form-label" style="font-weight:700; font-size:13px; display:block; margin-bottom:6px;">Psikolog Pembimbing Terpilih:</label>
          <div style="background:#F1F5F9; border:1px solid #CBD5E1; padding:10px 14px; border-radius:8px; font-weight:700; font-size:14px; color:var(--c-primary);" id="selectedPsikologName">
            {{ $psikologs->first() ? $psikologs->first()->nama : 'Pilih Psikolog dari daftar sebelah kiri' }}
          </div>
          <input type="hidden" name="id_psikolog" id="bookingIdPsikolog" value="{{ $psikologs->first() ? $psikologs->first()->id_psikolog : '' }}" required>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
          <div>
            <label class="form-label" style="font-weight:700; font-size:13px; display:block; margin-bottom:6px;">Tanggal Konsultasi</label>
            <input type="date" name="tanggal_konsultasi" class="form-input" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
          </div>
          <div>
            <label class="form-label" style="font-weight:700; font-size:13px; display:block; margin-bottom:6px;">Waktu Sesi Mulai</label>
            <select name="waktu_mulai" class="form-select" required style="width:100%; padding:9px 12px; border:1.5px solid var(--c-border); border-radius:8px;">
              <option value="09:00:00">09:00 WIB</option>
              <option value="10:30:00">10:30 WIB</option>
              <option value="13:30:00" selected>13:30 WIB</option>
              <option value="15:00:00">15:00 WIB</option>
              <option value="16:30:00">16:30 WIB</option>
            </select>
          </div>
        </div>

        <div>
          <label class="form-label" style="font-weight:700; font-size:13px; display:block; margin-bottom:6px;">Topik Bimbingan / Catatan Pertanyaan</label>
          <textarea name="catatan" rows="4" class="form-input" placeholder="Contoh: Ingin memvalidasi pilihan jurusan Teknik Informatika vs Sistem Informasi berdasarkan hasil nilai rapor dan tes RIASEC..." style="width:100%; padding:10px 12px; border:1.5px solid var(--c-border); border-radius:8px; font-family:inherit;"></textarea>
        </div>

        <button type="submit" class="btn-primary-action" style="width:100%; justify-content:center; padding:12px; font-size:14px; font-weight:700;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>Kirim Pengajuan Konsultasi</span>
        </button>
      </form>
    </div>

  </div>
@endsection
