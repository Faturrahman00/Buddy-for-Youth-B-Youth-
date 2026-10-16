@extends('Psikolog.layout.app', [
    'title' => 'Riwayat Konsultasi — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Konsultasi',
    'active' => 'riwayat'
])

@section('content')

<!-- =========================================================================
     TOP TOOLBAR: SEARCH & FILTER
     ========================================================================= -->
<div class="filter-search-bar" style="margin-bottom: 20px;">
  <!-- Search Input -->
  <div class="search-input-wrap">
    <div class="search-icon">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </div>
    <input type="text" id="inputSearchRiwayat" placeholder="Cari nama siswa, sekolah, atau topik konseling...">
  </div>

  <!-- Filter Status -->
  <select class="select-filter-custom" id="selectFilterStatusRiwayat">
    <option value="all">Semua Status</option>
    <option value="selesai">Selesai</option>
    <option value="ditolak">Ditolak / Dibatalkan</option>
  </select>

  <!-- Button Unduh Laporan -->
  <button type="button" class="btn-secondary-link" onclick="window.print()" style="margin-left:auto;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
    <span>Ekspor Laporan (PDF)</span>
  </button>
</div>

<!-- =========================================================================
     TABLE RIWAYAT KONSELING
     ========================================================================= -->
<div class="psikolog-card">
  <div class="table-responsive-box">
    <table class="table-riwayat">
      <thead>
        <tr>
          <th style="width: 120px;">Tanggal</th>
          <th style="width: 220px;">Nama Siswa</th>
          <th style="width: 180px;">Sekolah &amp; Kontak</th>
          <th style="width: 130px;">Waktu</th>
          <th>Topik &amp; Catatan Konseling</th>
          <th style="width: 110px;">Status</th>
        </tr>
      </thead>
      <tbody id="tableRiwayatBody">
        @forelse($riwayatList as $item)
          @php
            $tgl = \Carbon\Carbon::parse($item->tanggal_konsultasi);
            $siswaNama = $item->siswa->nama ?? 'Siswa';
            $ini = strtoupper(substr($siswaNama, 0, 2));
            $status = $item->status_booking;
          @endphp
          <tr data-searchable="{{ $tgl->format('Y-m-d') }} {{ $siswaNama }} {{ $item->siswa->sekolah ?? '' }} {{ $item->catatan }}" data-status="{{ $status }}">
            <td style="font-weight: 700; color: var(--c-text-heading); white-space: nowrap;">
              {{ $tgl->format('Y-m-d') }}
            </td>
            <td>
              <div class="badge-student-cell" style="display:flex; align-items:center; gap:10px;">
                <div class="student-initial-pill" style="width:34px; height:34px; border-radius:50%; background:#30618C; color:#fff; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center;">
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
            <td>
              <span style="font-weight: 700; color: var(--c-primary); background: var(--c-primary-subtle); padding: 3px 8px; border-radius: 4px; font-size: 12px;">
                {{ substr($item->waktu_mulai, 0, 5) }} - {{ substr($item->waktu_selesai, 0, 5) }} WIB
              </span>
            </td>
            <td>
              <div style="font-weight: 700; color: var(--c-text-heading); margin-bottom: 2px;">
                {{ $item->catatan ? Str::limit($item->catatan, 80) : 'Sesi Konsultasi Terlaksana' }}
              </div>
              @if($item->alasan_tolak)
                <div style="font-size:12px; color:#B42318;">Alasan penolakan: {{ $item->alasan_tolak }}</div>
              @endif
            </td>
            <td>
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
      </tbody>
    </table>
  </div>
</div>

@endsection

@push('scripts')
<script>
  // Simple table search filter
  const searchInput = document.getElementById('inputSearchRiwayat');
  const statusSelect = document.getElementById('selectFilterStatusRiwayat');
  const rows = document.querySelectorAll('#tableRiwayatBody tr[data-searchable]');

  function filterRiwayat() {
    const q = (searchInput?.value || '').toLowerCase();
    const st = statusSelect?.value || 'all';

    rows.forEach(r => {
      const text = r.getAttribute('data-searchable').toLowerCase();
      const rowStatus = r.getAttribute('data-status');
      const matchText = text.includes(q);
      const matchStatus = st === 'all' || rowStatus === st;
      r.style.display = (matchText && matchStatus) ? '' : 'none';
    });
  }

  if (searchInput) searchInput.addEventListener('input', filterRiwayat);
  if (statusSelect) statusSelect.addEventListener('change', filterRiwayat);
</script>
@endpush
