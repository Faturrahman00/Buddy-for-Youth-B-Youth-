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

              $detailPayload = [
                  'id' => '#KNS-' . str_pad($item->id_konsultasi, 2, '0', STR_PAD_LEFT),
                  'tanggal' => $tgl->translatedFormat('l, d F Y'),
                  'hari' => $tgl->translatedFormat('l'),
                  'jam' => substr($item->waktu_mulai, 0, 5) . ' - ' . substr($item->waktu_selesai, 0, 5) . ' WIB',
                  'tanggal_pengajuan' => $item->tanggal_pengajuan ? \Carbon\Carbon::parse($item->tanggal_pengajuan)->translatedFormat('d F Y, H:i') . ' WIB' : 'Terjadwal Otomatis',
                  'psikolog_nama' => $psikologNama,
                  'psikolog_spesialisasi' => $item->psikolog->spesialisasi ?? 'Psikolog Pendidikan & Eksplorasi Karier',
                  'psikolog_sip' => $item->psikolog->no_sip ?? 'SIP: Terverifikasi',
                  'psikolog_inisial' => $initials,
                  'status' => $status,
                  'link_zoom' => $item->link_zoom ?? '',
                  'catatan' => $item->catatan ?? '',
                  'alasan_tolak' => $item->alasan_tolak ?? '',
              ];
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
            <td style="white-space: nowrap;">
              <span style="font-weight: 600; font-size: 13px; color: var(--c-text-heading); white-space: nowrap;">
                {{ substr($item->waktu_mulai, 0, 5) }} - {{ substr($item->waktu_selesai, 0, 5) }} WIB
              </span>
            </td>
              <td>
                <div style="font-weight:700; color:var(--c-primary); margin-bottom:2px; cursor:pointer;" class="btn-open-detail-konsul" data-konsultasi="{{ json_encode($detailPayload) }}" title="Klik untuk melihat catatan lengkap">
                  {{ $item->catatan ? Str::limit($item->catatan, 70) : 'Konsultasi Bimbingan Minat Bakat' }}
                </div>
                @if($item->catatan && strlen($item->catatan) > 70)
                  <a href="javascript:void(0)" class="btn-open-detail-konsul" data-konsultasi="{{ json_encode($detailPayload) }}" style="font-size:11.5px; color:var(--c-primary); font-weight:700; text-decoration:none; display:inline-block; margin-top:2px;">
                    Lihat catatan lengkap &rarr;
                  </a>
                @endif
                @if($item->alasan_tolak)
                  <div style="font-size:12px; color:#B42318; margin-top:2px;">Alasan penolakan: {{ $item->alasan_tolak }}</div>
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
                <div class="action-btn-group" style="justify-content: flex-end; gap:6px; flex-wrap: wrap;">
                  <button type="button" class="btn-table-action primary btn-open-detail-konsul"
                    data-konsultasi="{{ json_encode($detailPayload) }}"
                    style="font-weight:700; display:inline-flex; align-items:center; gap:5px;"
                    title="Lihat Detail & Catatan Lengkap Sesi Konsultasi">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    <span>Detail</span>
                  </button>

                  @if($status === 'disetujui' && !empty($item->link_zoom))
                    <a href="{{ $item->link_zoom }}" target="_blank" class="btn-table-action outline" style="color:var(--c-primary); border-color:var(--c-primary); text-decoration:none;" title="Masuk Zoom Pertemuan">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                      Zoom
                    </a>
                  @elseif($status === 'menunggu')
                    <form action="{{ route('siswa.konsultasi.batal', $item->id_konsultasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan konsultasi ini?');" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-table-action outline" style="color:#B42318; border-color:#FECDCA;" title="Batalkan Pengajuan">
                        Batal
                      </button>
                    </form>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modalCatatanKonseling');
  if (!modal) return;

  const elId = document.getElementById('modalKonsulId');
  const elPengajuan = document.getElementById('modalKonsulPengajuan');
  const elStatusBadge = document.getElementById('modalKonsulStatusBadge');
  const elWaktuPill = document.getElementById('modalKonsulWaktuPill');
  const elInisial = document.getElementById('modalKonsulPsikologInisial');
  const elNama = document.getElementById('modalKonsulPsikologNama');
  const elSpesialisasi = document.getElementById('modalKonsulPsikologSpesialisasi');
  const elSip = document.getElementById('modalKonsulPsikologSip');
  const elTanggal = document.getElementById('modalKonsulTanggal');
  const elJam = document.getElementById('modalKonsulJam');
  const elTopik = document.getElementById('modalKonsulTopik');
  const elCatatan = document.getElementById('modalKonsulCatatan');
  const elZoomWrap = document.getElementById('modalKonsulZoomWrap');
  const elZoomLinkText = document.getElementById('modalKonsulZoomLinkText');
  const elBtnBukaZoom = document.getElementById('modalKonsulBtnBukaZoom');
  const elBtnCopyZoom = document.getElementById('modalKonsulBtnCopyZoom');
  const elBtnZoomDirect = document.getElementById('modalKonsulBtnZoomDirect');
  const elTolakWrap = document.getElementById('modalKonsulTolakWrap');
  const elTolakAlasan = document.getElementById('modalKonsulTolakAlasan');

  let currentZoomLink = '';

  document.querySelectorAll('.btn-open-detail-konsul').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      let data = {};
      try {
        const raw = btn.getAttribute('data-konsultasi');
        if (raw) data = JSON.parse(raw);
      } catch (err) {
        console.warn('Gagal parse data konsultasi:', err);
      }

      const id = data.id || '#KNS-01';
      const status = data.status || 'menunggu';
      const tgl = data.tanggal || '-';
      const jam = data.jam || '-';
      const psikologNama = data.psikolog_nama || 'Psikolog B-Youth';
      const spesialisasi = data.psikolog_spesialisasi || 'Psikolog Pendidikan';
      const sip = data.psikolog_sip || 'SIP: Terverifikasi';
      const inisial = data.psikolog_inisial || 'PS';
      const pengajuan = data.tanggal_pengajuan || '-';
      const catatan = data.catatan || '';
      const tolak = data.alasan_tolak || '';
      currentZoomLink = data.link_zoom || '';

      if (elId) elId.textContent = id;
      if (elPengajuan) elPengajuan.textContent = pengajuan;
      if (elWaktuPill) elWaktuPill.textContent = jam;
      if (elInisial) elInisial.textContent = inisial;
      if (elNama) elNama.textContent = psikologNama;
      if (elSpesialisasi) elSpesialisasi.textContent = spesialisasi;
      if (elSip) elSip.textContent = sip.startsWith('SIP:') ? sip : `SIP: ${sip}`;
      if (elTanggal) elTanggal.textContent = tgl;
      if (elJam) elJam.textContent = jam;

      // Status pill rendering
      if (elStatusBadge) {
        if (status === 'selesai') {
          elStatusBadge.innerHTML = '<span class="status-pill success" style="font-size:12px; padding:4px 12px; background:#EFF8FF; color:#175CD3; border:1px solid #B2DDFF;">Selesai Terlaksana</span>';
        } else if (status === 'disetujui') {
          elStatusBadge.innerHTML = '<span class="status-pill success" style="font-size:12px; padding:4px 12px; background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5;">Disetujui (Terjadwal)</span>';
        } else if (status === 'menunggu') {
          elStatusBadge.innerHTML = '<span class="status-pill pending" style="font-size:12px; padding:4px 12px; background:#FFF9E6; color:#7A5400; border:1px solid #FCE49E;">Menunggu Verifikasi</span>';
        } else if (status === 'ditolak') {
          elStatusBadge.innerHTML = '<span class="status-pill danger" style="font-size:12px; padding:4px 12px; background:#FEF3F2; color:#B42318; border:1px solid #FECDCA;">Ditolak</span>';
        } else {
          elStatusBadge.innerHTML = `<span class="status-pill" style="font-size:12px; padding:4px 12px;">${status}</span>`;
        }
      }

      // Topik pengajuan
      if (elTopik) {
        elTopik.textContent = catatan ? catatan : 'Pengajuan sesi bimbingan minat bakat dan arah program studi.';
      }

      // Catatan & Rekomendasi psikolog
      if (elCatatan) {
        if (status === 'selesai' && catatan) {
          elCatatan.textContent = catatan;
          elCatatan.style.fontStyle = 'normal';
          elCatatan.style.color = '#1E293B';
        } else if (status === 'selesai') {
          elCatatan.textContent = 'Sesi telah selesai dilaksanakan. Psikolog telah memvalidasi rekomendasi dan arah minat studi siswa.';
          elCatatan.style.fontStyle = 'italic';
          elCatatan.style.color = '#475467';
        } else {
          elCatatan.textContent = 'Sesi konsultasi belum selesai dilaksanakan. Catatan evaluasi komprehensif dan arahan tindak lanjut akademis akan diisi oleh psikolog setelah pertemuan berakhir.';
          elCatatan.style.fontStyle = 'italic';
          elCatatan.style.color = '#64748B';
        }
      }

      // Zoom wrap
      if (elZoomWrap) {
        if (status === 'disetujui' && currentZoomLink) {
          elZoomWrap.style.display = 'block';
          if (elZoomLinkText) elZoomLinkText.textContent = currentZoomLink;
          if (elBtnBukaZoom) elBtnBukaZoom.href = currentZoomLink;
          if (elBtnZoomDirect) {
            elBtnZoomDirect.style.display = 'inline-flex';
            elBtnZoomDirect.href = currentZoomLink;
          }
        } else {
          elZoomWrap.style.display = 'none';
          if (elBtnZoomDirect) elBtnZoomDirect.style.display = 'none';
        }
      }

      // Tolak wrap
      if (elTolakWrap) {
        if (status === 'ditolak' && tolak) {
          elTolakWrap.style.display = 'block';
          if (elTolakAlasan) elTolakAlasan.textContent = tolak;
        } else {
          elTolakWrap.style.display = 'none';
        }
      }

      // Buka modal
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

  if (elBtnCopyZoom) {
    elBtnCopyZoom.addEventListener('click', () => {
      if (currentZoomLink) {
        navigator.clipboard.writeText(currentZoomLink);
        alert('Tautan Zoom berhasil disalin ke clipboard!');
      }
    });
  }
});
</script>
@endpush
