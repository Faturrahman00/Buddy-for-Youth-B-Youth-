@extends('Psikolog.layout.app', [
    'title' => 'Riwayat Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Konsultasi',
    'active' => 'riwayat'
])

@php
  $totalSelesai = $riwayatList->where('status_booking', 'selesai')->count();
  $totalDitolak = $riwayatList->where('status_booking', 'ditolak')->count();
  $totalSiswa = $riwayatList->pluck('id_siswa')->unique()->count();
  $totalCatatan = $riwayatList->where('status_booking', 'selesai')->filter(fn($i) => !empty($i->catatan))->count();
@endphp

@section('content')

<!-- =========================================================================
     SUMMARY STATS GRID (KONSISTEN DENGAN TAMPILAN SISWA)
     ========================================================================= -->
<div class="stats-summary-grid">
  <div class="stat-summary-card">
    <div class="stat-icon-wrapper blue">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
      </svg>
    </div>
    <div class="stat-summary-info">
      <div class="stat-val">{{ $totalSelesai }} Sesi</div>
      <div class="stat-label">Sesi Selesai</div>
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
      <div class="stat-val">{{ $totalSiswa }} Siswa</div>
      <div class="stat-label">Siswa Dibimbing</div>
    </div>
  </div>

  <div class="stat-summary-card">
    <div class="stat-icon-wrapper purple">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
      </svg>
    </div>
    <div class="stat-summary-info">
      <div class="stat-val">{{ $totalCatatan }} Catatan</div>
      <div class="stat-label">Catatan Terbit</div>
    </div>
  </div>

  <div class="stat-summary-card">
    <div class="stat-icon-wrapper amber">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
    </div>
    <div class="stat-summary-info">
      <div class="stat-val">{{ $totalDitolak }} Sesi</div>
      <div class="stat-label">Ditolak / Batal</div>
    </div>
  </div>
</div>

<!-- =========================================================================
     TABLE RIWAYAT KONSELING (DENGAN DATA-CARD & INTEGRATED TOOLBAR)
     ========================================================================= -->
<div class="data-card">
  <div class="table-integrated-toolbar">
    <div class="table-toolbar-info">
      <div class="table-toolbar-header-row">
        <div class="data-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
          </svg>
          <span>Daftar Riwayat Bimbingan Konseling Siswa</span>
        </div>
        <span class="data-count-badge" id="badgeRiwayatCount">{{ count($riwayatList) }} Sesi Terdata</span>
      </div>
      <div class="table-toolbar-desc">Arsip dokumentasi bimbingan, catatan evaluasi, dan rekomendasi hasil konseling</div>
    </div>

    <div class="table-toolbar-actions">
      <!-- Integrated Search Box -->
      <div class="search-box table-search-box">
        <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="inputSearchRiwayat" class="search-input table-search-input" placeholder="Cari nama siswa, sekolah, topik...">
      </div>

      <!-- Integrated Filter Select -->
      <div class="filter-controls-group table-filter-group">
        <select id="selectFilterStatusRiwayat" class="filter-select table-filter-select">
          <option value="all">Semua Status</option>
          <option value="selesai">Selesai Terlaksana</option>
          <option value="ditolak">Ditolak / Dibatalkan</option>
        </select>
      </div>
    </div>
  </div>

  <div class="table-responsive-box" style="overflow-x: auto;">
    <table class="table-riwayat">
      <thead>
        <tr>
          <th style="width: 140px; white-space: nowrap;">Tanggal</th>
          <th style="width: 220px;">Nama Siswa</th>
          <th style="width: 190px;">Sekolah &amp; Kontak</th>
          <th style="width: 155px; white-space: nowrap;">Waktu</th>
          <th>Topik &amp; Catatan Konseling</th>
          <th style="width: 110px; text-align: center; white-space: nowrap;">Status</th>
          <th style="width: 90px; text-align: right; white-space: nowrap;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableRiwayatBody">
        @forelse($riwayatList as $item)
          @php
            $tgl = \Carbon\Carbon::parse($item->tanggal_konsultasi);
            $siswaNama = $item->siswa->nama ?? 'Siswa';
            $ini = strtoupper(substr($siswaNama, 0, 2));
            $status = $item->status_booking;

            $detailPayload = [
                'id' => '#KNS-' . str_pad($item->id_konsultasi, 2, '0', STR_PAD_LEFT),
                'tanggal' => $tgl->translatedFormat('l, d F Y'),
                'waktu' => substr($item->waktu_mulai, 0, 5) . ' - ' . substr($item->waktu_selesai, 0, 5) . ' WIB',
                'durasi' => '60 Menit',
                'siswa_nama' => $siswaNama,
                'siswa_sekolah' => $item->siswa->sekolah ?? 'Sekolah Tidak Terdata',
                'siswa_kelas' => $item->siswa->kelas ?? 'Kelas Siswa',
                'siswa_telepon' => $item->siswa->no_telepon ?? 'Belum ada kontak WA',
                'status' => $status,
                'link_zoom' => $item->link_zoom ?? '',
                'catatan' => $item->catatan ?? '',
                'alasan_tolak' => $item->alasan_tolak ?? '',
            ];
          @endphp
          <tr data-searchable="{{ $tgl->format('Y-m-d') }} {{ $tgl->translatedFormat('d F Y') }} {{ $siswaNama }} {{ $item->siswa->sekolah ?? '' }} {{ $item->catatan }}" data-status="{{ $status }}">
            <td style="white-space: nowrap;">
              <div style="font-weight: 700; color: var(--c-text-heading);">{{ $tgl->translatedFormat('d F Y') }}</div>
              <div style="font-size: 11.5px; color: var(--c-text-muted);">{{ $tgl->translatedFormat('l') }}</div>
            </td>
            <td>
              <div class="badge-student-cell">
                <div class="student-initial-pill" style="width:36px; height:36px; border-radius:50%; background:#30618C; color:#fff; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center; flex-shrink: 0; box-shadow: 0 2px 6px rgba(48,97,140,0.2);">
                  {{ $ini }}
                </div>
                <div>
                  <strong style="color: var(--c-text-heading); font-size: 14px; display:block;">{{ $siswaNama }}</strong>
                  <div style="font-size: 11.5px; color: var(--c-text-muted);">{{ $item->siswa->kelas ?? 'Siswa' }}</div>
                </div>
              </div>
            </td>
            <td>
              <div style="font-weight: 600; color: var(--c-text-body); font-size: 13px;">{{ $item->siswa->sekolah ?? '-' }}</div>
              <div style="font-size: 11.5px; color: var(--c-text-muted); display:flex; align-items:center; gap:4px; margin-top:2px;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <span>{{ $item->siswa->no_telepon ?? '-' }}</span>
              </div>
            </td>
            <td style="white-space: nowrap;">
              <span style="display: inline-flex; align-items: center; white-space: nowrap; font-weight: 700; color: var(--c-primary); background: var(--c-primary-subtle); padding: 4px 10px; border-radius: 6px; font-size: 12px; letter-spacing: 0.02em;">
                {{ substr($item->waktu_mulai, 0, 5) }} - {{ substr($item->waktu_selesai, 0, 5) }} WIB
              </span>
            </td>
            <td>
              <div style="font-weight: 700; color: var(--c-text-heading); margin-bottom: 2px; cursor: pointer;" class="btn-open-detail-psikolog" data-detail="{{ json_encode($detailPayload) }}" title="Klik untuk membuka catatan lengkap">
                {{ $item->catatan ? Str::limit($item->catatan, 75) : 'Sesi Konsultasi Terlaksana' }}
              </div>
              @if($item->catatan && strlen($item->catatan) > 75)
                <a href="javascript:void(0)" class="btn-open-detail-psikolog" data-detail="{{ json_encode($detailPayload) }}" style="font-size: 11.5px; font-weight: 700; color: var(--c-primary); text-decoration: none; display: inline-block; margin-top: 2px;">
                  Lihat catatan lengkap &rarr;
                </a>
              @endif
              @if($item->alasan_tolak)
                <div style="font-size:12px; color:#B42318; margin-top: 2px;">Alasan: {{ $item->alasan_tolak }}</div>
              @endif
            </td>
            <td style="text-align: center; white-space: nowrap;">
              @if($status === 'selesai')
                <span class="status-tag" style="background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">
                  Selesai
                </span>
              @elseif($status === 'ditolak')
                <span class="status-tag" style="background:#FEF3F2; color:#B42318; border:1px solid #FECDCA; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">
                  Ditolak
                </span>
              @else
                <span class="status-tag" style="padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">
                  {{ ucfirst($status) }}
                </span>
              @endif
            </td>
            <td style="text-align: right; white-space: nowrap;">
              <button type="button" class="btn-table-action primary btn-open-detail-psikolog" data-detail="{{ json_encode($detailPayload) }}" title="Lihat detail bimbingan">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                <span>Detail</span>
              </button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 36px 16px; color: var(--c-text-muted);">
              <div style="font-size: 14.5px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 4px;">Belum Ada Riwayat Konsultasi</div>
              <p style="font-size: 13px; margin: 0;">Sesi bimbingan yang selesai atau ditolak akan tersimpan secara otomatis di sini.</p>
            </td>
          </tr>
        @endforelse
        <tr id="rowNoSearchResult" style="display:none;">
          <td colspan="7" style="text-align: center; padding: 36px 16px; color: var(--c-text-muted);">
            <div style="font-size: 14.5px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 4px;">Tidak Ada Data yang Sesuai</div>
            <p style="font-size: 13px; margin: 0;">Tidak ditemukan riwayat bimbingan yang cocok dengan kata kunci atau filter status terpilih.</p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection

@push('scripts')
<script>
  // Real-time instant JS table search & status filter (tanpa reload, tanpa tombol reset)
  const searchInput = document.getElementById('inputSearchRiwayat');
  const statusSelect = document.getElementById('selectFilterStatusRiwayat');
  const rows = document.querySelectorAll('#tableRiwayatBody tr[data-searchable]');
  const badgeCount = document.getElementById('badgeRiwayatCount');
  const rowNoMatch = document.getElementById('rowNoSearchResult');

  function filterRiwayat() {
    const q = (searchInput?.value || '').toLowerCase().trim();
    const st = statusSelect?.value || 'all';
    let matchCount = 0;

    rows.forEach(r => {
      const text = (r.getAttribute('data-searchable') || '').toLowerCase();
      const rowStatus = r.getAttribute('data-status') || '';
      const matchText = !q || text.includes(q);
      const matchStatus = st === 'all' || rowStatus === st;

      if (matchText && matchStatus) {
        r.style.display = '';
        matchCount++;
      } else {
        r.style.display = 'none';
      }
    });

    if (rowNoMatch) {
      rowNoMatch.style.display = (matchCount === 0 && rows.length > 0) ? '' : 'none';
    }

    if (badgeCount) {
      badgeCount.textContent = `${matchCount} Sesi Terdata`;
    }
  }

  if (searchInput) searchInput.addEventListener('input', filterRiwayat);
  if (statusSelect) statusSelect.addEventListener('change', filterRiwayat);

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
        } else if (status === 'ditolak') {
          elStatusBadge.innerHTML = '<span class="status-tag" style="background:#FEF3F2; color:#B42318; border:1px solid #FECDCA; padding:3px 8px; border-radius:4px; font-size:12px; font-weight:700;">Ditolak / Dibatalkan</span>';
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
          elCatatan.textContent = 'Sesi bimbingan belum tuntas. Catatan klinis akan tercatat setelah sesi ditandai selesai.';
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
