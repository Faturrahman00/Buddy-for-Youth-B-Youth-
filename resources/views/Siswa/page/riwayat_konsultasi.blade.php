@extends('Siswa.layouts.app', [
    'title' => 'Riwayat Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Konsultasi',
    'active' => 'riwayat-konsultasi'
])

@php
  $totalSelesai = $riwayatList->where('status_booking', 'selesai')->count();
  $totalTerjadwal = $riwayatList->whereIn('status_booking', ['disetujui', 'menunggu'])->count();
  $totalPsikolog = $riwayatList->pluck('id_psikolog')->unique()->count();
  $totalCatatan = $riwayatList->whereNotNull('catatan')->count();
@endphp

@section('content')
  <!-- Top Action Header -->
  <div class="page-top-action-bar">
    <div class="page-title-wrap">
      <p style="margin:0;">Rekapitulasi catatan bimbingan konseling, rekomendasi psikolog, dan rencana tindak lanjut akademis.</p>
    </div>

    <a href="{{ route('siswa.konsultasi') }}" class="btn-primary-action">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span>Jadwalkan Sesi Baru</span>
    </a>
  </div>

  @if(session('success'))
    <div style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
      {{ session('success') }}
    </div>
  @endif

  <!-- Summary Stats Grid -->
  <div class="stats-summary-grid">
    <div class="stat-summary-card">
      <div class="stat-icon-wrapper blue">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $totalSelesai }} Sesi Selesai</div>
        <div class="stat-label">Total Konseling Terlaksana</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper amber">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $totalTerjadwal }} Sesi</div>
        <div class="stat-label">Menunggu / Disetujui</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper green">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $totalPsikolog }} Psikolog</div>
        <div class="stat-label">Pembimbing Terhubung</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper purple">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 11l3 3L22 4"></path>
          <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $totalCatatan }} Catatan</div>
        <div class="stat-label">Evaluasi & Rekomendasi</div>
      </div>
    </div>
  </div>

  <!-- Table Container with Integrated Search & Filter -->
  <div class="data-card">
    <div class="table-integrated-toolbar">
      <div class="table-toolbar-info">
        <div class="data-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span>Daftar Sesi Konsultasi Psikologi</span>
          <span class="data-count-badge" data-count-for="riwayatKonsulTableBody">{{ $riwayatList->count() }} Sesi Terdata</span>
        </div>
        <div class="table-toolbar-desc">Kerahasiaan data bimbingan konseling terenkripsi aman</div>
      </div>

      <div class="table-toolbar-actions">
        <!-- Integrated Search Box -->
        <div class="search-box table-search-box">
          <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="searchRiwayatKonsultasi" class="search-input table-search-input" placeholder="Cari nama psikolog, topik, atau catatan...">
        </div>

        <!-- Integrated Filter Controls -->
        <div class="filter-controls-group table-filter-group">
          <select id="filterStatusKonsul" class="filter-select table-filter-select" data-filter-key="status">
            <option value="all">Semua Status</option>
            <option value="disetujui">Disetujui (Terjadwal)</option>
            <option value="menunggu">Menunggu Verifikasi</option>
            <option value="selesai">Selesai</option>
            <option value="ditolak">Ditolak</option>
          </select>

          <button type="button" class="btn-filter-reset" id="btnResetRiwayatKonsul" title="Reset filter">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
            <span>Reset</span>
          </button>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableRiwayatKonsultasi">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama Psikolog</th>
            <th>Waktu</th>
            <th>Topik &amp; Catatan</th>
            <th>Status</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="riwayatKonsulTableBody">
          @forelse($riwayatList as $item)
            @php
              $tgl = \Carbon\Carbon::parse($item->tanggal_konsultasi);
              $psikologNama = $item->psikolog->nama ?? 'Psikolog B-Youth';
              $initials = strtoupper(substr($psikologNama, 0, 2));
              $status = $item->status_booking;
            @endphp
            <tr data-searchable="{{ $tgl->translatedFormat('d M Y') }} {{ $psikologNama }} {{ $item->catatan }} {{ $status }}" data-status="{{ $status }}">
              <td>
                <div style="font-weight:700; color:var(--c-text-heading);">{{ $tgl->translatedFormat('d F Y') }}</div>
                <div style="font-size:12px; color:var(--c-text-muted);">{{ $tgl->translatedFormat('l') }}</div>
              </td>
              <td>
                <div style="display:flex; align-items:center; gap:10px;">
                  <div style="width:34px; height:34px; border-radius:50%; background:#FAE08F; color:#172C40; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center;">
                    {{ $initials }}
                  </div>
                  <div>
                    <div style="font-weight:700; color:var(--c-text-heading);">{{ $psikologNama }}</div>
                    <div style="font-size:11.5px; color:var(--c-text-muted);">{{ $item->psikolog->spesialisasi ?? 'Psikolog Pendidikan' }}</div>
                  </div>
                </div>
              </td>
              <td>
                <span style="font-weight:600; font-size:13px; color:var(--c-text-heading);">
                  {{ substr($item->waktu_mulai, 0, 5) }} - {{ substr($item->waktu_selesai, 0, 5) }} WIB
                </span>
              </td>
              <td>
                <div style="font-weight:700; color:var(--c-primary); margin-bottom:2px;">
                  {{ $item->catatan ? Str::limit($item->catatan, 70) : 'Konsultasi Bimbingan Minat Bakat' }}
                </div>
                @if($item->alasan_tolak)
                  <div style="font-size:12px; color:#B42318;">Alasan penolakan: {{ $item->alasan_tolak }}</div>
                @endif
              </td>
              <td>
                @if($status === 'disetujui')
                  <span class="status-pill success" style="font-size:11px; padding:3px 8px; background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5;">Disetujui</span>
                @elseif($status === 'menunggu')
                  <span class="status-pill pending" style="font-size:11px; padding:3px 8px; background:#FFF9E6; color:#7A5400; border:1px solid #FCE49E;">Menunggu Verifikasi</span>
                @elseif($status === 'selesai')
                  <span class="status-pill success" style="font-size:11px; padding:3px 8px; background:#EFF8FF; color:#175CD3; border:1px solid #B2DDFF;">Selesai</span>
                @elseif($status === 'ditolak')
                  <span class="status-pill danger" style="font-size:11px; padding:3px 8px; background:#FEF3F2; color:#B42318; border:1px solid #FECDCA;">Ditolak</span>
                @else
                  <span class="status-pill">{{ ucfirst($status) }}</span>
                @endif
              </td>
              <td style="text-align: right;">
                <div class="action-btn-group" style="justify-content: flex-end; gap:6px;">
                  @if($status === 'disetujui' && !empty($item->link_zoom))
                    <a href="{{ $item->link_zoom }}" target="_blank" class="btn-table-action primary" style="text-decoration:none;">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                      Masuk Zoom
                    </a>
                  @elseif($status === 'menunggu')
                    <form action="{{ route('siswa.konsultasi.batal', $item->id_konsultasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan konsultasi ini?');" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-table-action outline" style="color:#B42318; border-color:#FECDCA;">
                        Batalkan
                      </button>
                    </form>
                  @else
                    <span style="font-size:12px; color:var(--c-text-muted);">-</span>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:36px 20px;">
                <div style="font-size:15px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Belum Ada Riwayat Konsultasi</div>
                <p style="font-size:13px; color:var(--c-text-muted); margin-bottom:16px;">Kamu belum pernah melakukan konsultasi atau mengajukan bimbingan dengan psikolog.</p>
                <a href="{{ route('siswa.konsultasi') }}" class="btn-primary-action" style="display:inline-flex; padding:8px 18px;">
                  Jadwalkan Konsultasi Sekarang
                </a>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
