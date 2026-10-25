@extends('Psikolog.layout.app', [
    'title' => 'Riwayat Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Konsultasi',
    'active' => 'riwayat'
])

@section('content')

<!-- =========================================================================
     TABLE RIWAYAT KONSELING (PENCARIAN & FILTER DISATUKAN PADA HEADER TABEL)
     ========================================================================= -->
<div class="psikolog-card">
  <div class="card-header-wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
    <div class="card-title-group">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
      </svg>
      <span class="card-title-text">Riwayat Konsultasi Siswa</span>
      <span class="tab-badge" id="badgeRiwayatCount" style="background:#F1F5F9; color:var(--c-text-body); font-size:12px; font-weight:700;">{{ count($riwayatList) }} Data</span>
    </div>

    <!-- Search & Filter Controls (Disatukan dalam card tabel, tanpa tombol reset, murni JS) -->
    <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
      <div class="search-input-wrap" style="width:280px; margin:0;">
        <div class="search-icon">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
        <input type="text" id="inputSearchRiwayat" placeholder="Cari nama siswa, sekolah, topik..." style="padding-left:38px; height:38px; font-size:13px;">
      </div>

      <select class="select-filter-custom" id="selectFilterStatusRiwayat" style="height:38px; font-size:13px; padding:0 34px 0 14px;">
        <option value="all">Semua Status</option>
        <option value="selesai">Selesai</option>
        <option value="ditolak">Ditolak / Dibatalkan</option>
      </select>
    </div>
  </div>

  <div class="table-responsive-box">
    <table class="table-riwayat">
      <thead>
        <tr>
          <th style="width: 120px; white-space: nowrap;">Tanggal</th>
          <th style="width: 220px;">Nama Siswa</th>
          <th style="width: 190px;">Sekolah &amp; Kontak</th>
          <th style="width: 155px; white-space: nowrap;">Waktu</th>
          <th>Topik &amp; Catatan Konseling</th>
          <th style="width: 110px; text-align: center; white-space: nowrap;">Status</th>
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
          <tr data-searchable="{{ $tgl->format('Y-m-d') }} {{ $siswaNama }} {{ $item->siswa->sekolah ?? '' }} {{ $item->catatan }}" data-status="{{ $status }}">
            <td style="font-weight: 700; color: var(--c-text-heading); white-space: nowrap;">
              {{ $tgl->format('Y-m-d') }}
            </td>
            <td>
              <div class="badge-student-cell" style="display:flex; align-items:center; gap:10px;">
                <div class="student-initial-pill" style="width:34px; height:34px; border-radius:50%; background:#30618C; color:#fff; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center; flex-shrink: 0;">
                  {{ $ini }}
                </div>
                <div>
                  <strong style="color: var(--c-text-heading); font-size: 14px;">{{ $siswaNama }}</strong>
                  <div style="font-size: 11.5px; color: var(--c-text-muted);">{{ $item->siswa->kelas ?? 'Siswa' }}</div>
                </div>
              </div>
            </td>
            <td style="color: var(--c-text-body); font-weight: 500;">
              <div>{{ $item->siswa->sekolah ?? '-' }}</div>
              <div style="font-size: 11.5px; color: var(--c-text-muted);">WA: {{ $item->siswa->no_telepon ?? '-' }}</div>
            </td>
            <td style="white-space: nowrap;">
              <span style="display: inline-flex; align-items: center; white-space: nowrap; font-weight: 700; color: var(--c-primary); background: var(--c-primary-subtle); padding: 4px 10px; border-radius: 6px; font-size: 12px; letter-spacing: 0.02em;">
                {{ substr($item->waktu_mulai, 0, 5) }} - {{ substr($item->waktu_selesai, 0, 5) }} WIB
              </span>
            </td>
            <td>
              <div style="font-weight: 700; color: var(--c-text-heading); margin-bottom: 2px; cursor: pointer;" class="btn-open-detail-psikolog" data-detail="{{ json_encode($detailPayload) }}" title="Klik untuk membuka catatan lengkap">
                {{ $item->catatan ? Str::limit($item->catatan, 80) : 'Sesi Konsultasi Terlaksana' }}
              </div>
              @if($item->catatan && strlen($item->catatan) > 80)
                <a href="javascript:void(0)" class="btn-open-detail-psikolog" data-detail="{{ json_encode($detailPayload) }}" style="font-size: 11.5px; font-weight: 700; color: var(--c-primary); text-decoration: none; display: inline-block; margin-top: 2px;">
                  Lihat catatan lengkap &rarr;
                </a>
              @endif
              @if($item->alasan_tolak)
                <div style="font-size:12px; color:#B42318; margin-top: 2px;">Alasan penolakan: {{ $item->alasan_tolak }}</div>
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
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 36px 16px; color: var(--c-text-muted);">
              <div style="font-size: 14.5px; font-weight: 700; color: var(--c-text-heading); margin-bottom: 4px;">Belum Ada Riwayat Konsultasi</div>
              <p style="font-size: 13px; margin: 0;">Sesi bimbingan yang selesai atau ditolak akan tersimpan secara otomatis di sini.</p>
            </td>
          </tr>
        @endforelse
        <tr id="rowNoSearchResult" style="display:none;">
          <td colspan="6" style="text-align: center; padding: 36px 16px; color: var(--c-text-muted);">
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
      badgeCount.textContent = `${matchCount} Data`;
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
