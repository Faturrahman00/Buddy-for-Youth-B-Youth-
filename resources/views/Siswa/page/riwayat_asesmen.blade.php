{{-- 
  B-YOUTH: RIWAYAT ASESMEN PAGE (Siswa)
  File: resources/views/Siswa/page/riwayat_asesmen.blade.php
  Matches Wireframe 3: Tanggal, Durasi, Status, Rekomendasi, Aksi + Search, Filter, Pagination
--}}
@extends('Siswa.layouts.app', [
    'title' => 'Riwayat Asesmen — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Riwayat Asesmen',
    'active' => 'riwayat-asesmen'
])

@section('content')
  <!-- Summary Stats Grid -->
  <div class="stats-summary-grid">
    <div class="stat-summary-card">
      <div class="stat-icon-wrapper blue">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $totalSesi ?? 1 }} Sesi</div>
        <div class="stat-label">Total Asesmen Dijalani</div>
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
        <div class="stat-val">42 Soal</div>
        <div class="stat-label">Holland RIASEC Test</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper green">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="7"></circle>
          <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $mostFrequentProdi ?? 'Teknik Informatika' }}</div>
        <div class="stat-label">Rekomendasi Utama Teratas</div>
      </div>
    </div>

    <div class="stat-summary-card">
      <div class="stat-icon-wrapper purple">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
      </div>
      <div class="stat-summary-info">
        <div class="stat-val">{{ $totalSelesai ?? 1 }} Sesi</div>
        <div class="stat-label">Hasil Asesmen Selesai</div>
      </div>
    </div>
  </div>

  <!-- Table Container with Integrated Search & Filter -->
  <div class="data-card">
    <div class="table-integrated-toolbar">
      <div class="table-toolbar-info">
        <div class="data-card-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
          </svg>
          <span>Tabel Riwayat Asesmen Siswa</span>
          <span class="data-count-badge" data-count-for="riwayatAsesmenTableBody">{{ count($riwayats ?? []) }} Sesi Terdata</span>
        </div>
        <div class="table-toolbar-desc">Arsip hasil asesmen Holland RIASEC dan rekam jejak rekomendasi prodi</div>
      </div>

      <div class="table-toolbar-actions">
        <!-- Integrated Search Box -->
        <div class="search-box table-search-box">
          <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="searchRiwayatAsesmen" class="search-input table-search-input" placeholder="Cari tanggal, kode RIASEC, atau rekomendasi...">
        </div>

        <!-- Integrated Filter Controls -->
        <div class="filter-controls-group table-filter-group">
          <select id="filterStatusAsesmen" class="filter-select table-filter-select" data-filter-key="status">
            <option value="all">Semua Status</option>
            <option value="Selesai">Selesai Dianalisis</option>
            <option value="Menunggu">Menunggu Tinjauan</option>
            <option value="Draft">Draft / Berjalan</option>
          </select>

          <select id="filterPeriodeAsesmen" class="filter-select table-filter-select" data-filter-key="periode">
            <option value="all">Semua Periode</option>
            <option value="2026">Tahun 2026</option>
            <option value="2025">Tahun 2025</option>
          </select>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="byouth-table" id="tableRiwayatAsesmen">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Durasi</th>
            <th>Status</th>
            <th>Rekomendasi Utama</th>
            <th style="text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="riwayatAsesmenTableBody">
          @if(isset($riwayats) && $riwayats->isNotEmpty())
            @foreach($riwayats as $idx => $item)
              @php
                $hasil = $item->hasilAsesmen;
                $rekomendasis = $item->rekomendasi ?? collect();
                $topRec = $rekomendasis->first();
                $altRecs = $rekomendasis->skip(1)->take(2);
                $holland = $item->tipe_riasec ?? ($hasil->holland_code ?? 'I–S–R');
                $prodiName = $topRec && $topRec->programStudi ? $topRec->programStudi->nama_prodi : 'Teknik Informatika';
                $prodiSkor = $topRec ? $topRec->skor : 95;

                // Siapkan data rekomendasi lengkap untuk Card Detail Modal
                $recList = $rekomendasis->map(function($r, $i) {
                    return [
                        'ranking' => $r->ranking ?? ($i + 1),
                        'nama_prodi' => $r->programStudi->nama_prodi ?? 'Program Studi',
                        'rumpun' => $r->programStudi->rumpun ?? 'Saintek',
                        'skor' => round($r->skor ?? 90),
                        'alasan' => $r->alasan ?? 'Kesesuaian tinggi dengan profil minat dan potensi Holland RIASEC siswa.',
                    ];
                })->values()->toArray();

                if (empty($recList)) {
                    $recList = [
                        [
                            'ranking' => 1,
                            'nama_prodi' => $prodiName,
                            'rumpun' => 'Saintek',
                            'skor' => round($prodiSkor),
                            'alasan' => $topRec ? $topRec->alasan : 'Direkomendasikan berdasarkan profil minat Holland RIASEC.'
                        ]
                    ];
                }

                $cardDetailPayload = [
                    'sesi' => '#ASY-' . str_pad($item->id_asesmen ?? $item->id, 2, '0', STR_PAD_LEFT),
                    'tanggal' => $item->tanggal ? ($item->tanggal->format('d F Y') . ' • Pukul ' . $item->tanggal->format('H:i') . ' WIB') : '15 Oktober 2026',
                    'status' => ucfirst($item->status ?? 'Selesai'),
                    'holland' => $holland,
                    'ringkasan' => !empty($item->pertanyaan) ? $item->pertanyaan : ('Profil hasil asesmen Holland RIASEC menunjukkan minat dominan pada tipe ' . $holland . ' dengan orientasi tinggi pada eksplorasi analitis dan pengembangan bakat terapan.'),
                    'rekomendasi' => $recList,
                ];
              @endphp
              <tr data-searchable="{{ $item->tanggal->format('d M Y') }} {{ $holland }} {{ $prodiName }} {{ $item->status }}" data-status="{{ ucfirst($item->status) }}" data-periode="{{ $item->tanggal->format('Y') }}">
                <td>
                  <div style="font-weight:700; color:var(--c-text-heading);">{{ $item->tanggal->format('d F Y') }}</div>
                  <div style="font-size:12px; color:var(--c-text-muted);">Pukul {{ $item->tanggal->format('H:i') }} WIB • Sesi #ASY-{{ str_pad($item->id, 2, '0', STR_PAD_LEFT) }}</div>
                </td>
                <td>
                  <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    42 Soal
                  </span>
                </td>
                <td>
                  <span class="status-pill {{ $item->status === 'selesai' ? 'success' : 'pending' }}">
                    {{ $item->status === 'selesai' ? 'Selesai' : 'Diproses' }}
                  </span>
                  @if($hasil && $hasil->nilai_raport_digunakan)
                    <div style="font-size:11px; font-weight:700; color:#059669; margin-top:3px;">+ Nilai Rapor</div>
                  @endif
                </td>
                <td>
                  <div style="font-weight:700; color:var(--c-primary); font-size:14px;">
                    {{ $prodiName }} ({{ round($prodiSkor) }}%)
                  </div>
                  <div style="font-size:12px; color:var(--c-text-muted);">
                    Profil: <strong>{{ $holland }}</strong>
                    @if($altRecs->isNotEmpty())
                      • Alternatif: {{ $altRecs->map(fn($r) => $r->programStudi->nama_prodi ?? '')->join(', ') }}
                    @endif
                  </div>
                </td>
                <td style="text-align: right;">
                  <button type="button" class="btn-table-action primary btn-open-detail-modal"
                    data-asesmen="{{ json_encode($cardDetailPayload) }}"
                    style="font-weight:700; display:inline-flex; align-items:center; gap:6px;"
                    title="Lihat Card Detail Hasil Asesmen">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Lihat Detail
                  </button>
                </td>
              </tr>
            @endforeach
          @else
            <!-- Sample Rows jika belum ada asesmen tersimpan -->
            @php
              $samplePayload = [
                  'sesi' => '#ASY-01',
                  'tanggal' => '05 Oktober 2026 • Pukul 14:20 WIB',
                  'status' => 'Selesai',
                  'holland' => 'I–S–R',
                  'ringkasan' => 'Profil kemampuan logika komputasi, pemecahan masalah analitis, dan eksplorasi sains terapan sangat selaras dengan rumpun bidang teknologi informasi dan rekayasa komputasi.',
                  'rekomendasi' => [
                      [
                          'ranking' => 1,
                          'nama_prodi' => 'Teknik Informatika',
                          'rumpun' => 'Saintek',
                          'skor' => 95,
                          'alasan' => 'Profil kemampuan logika komputasi dan pemecahan masalah analitis sangat selaras dengan kurikulum program studi.'
                      ],
                      [
                          'ranking' => 2,
                          'nama_prodi' => 'Sains Data',
                          'rumpun' => 'Saintek',
                          'skor' => 91,
                          'alasan' => 'Kombinasi minat investigasi ilmiah dan kecakapan matematika kuantitatif memberikan fondasi kuat untuk riset komputasi data.'
                      ],
                      [
                          'ranking' => 3,
                          'nama_prodi' => 'Sistem Informasi',
                          'rumpun' => 'Saintek',
                          'skor' => 87,
                          'alasan' => 'Orientasi pemecahan masalah teknologi terapan dan manajemen proses digital selaras dengan potensi siswa.'
                      ]
                  ]
              ];
            @endphp
            <tr data-searchable="05 Okt 2026 Teknik Informatika Sains Data Selesai" data-status="Selesai" data-periode="2026">
              <td>
                <div style="font-weight:700; color:var(--c-text-heading);">05 Oktober 2026</div>
                <div style="font-size:12px; color:var(--c-text-muted);">Pukul 14:20 WIB • Sesi #ASY-01</div>
              </td>
              <td>
                <span style="font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                  42 Soal
                </span>
              </td>
              <td><span class="status-pill success">Selesai</span></td>
              <td>
                <div style="font-weight:700; color:var(--c-primary); font-size:14px;">Teknik Informatika (95%)</div>
                <div style="font-size:12px; color:var(--c-text-muted);">Profil Holland: I–S–R • Alternatif: Sains Data, Sistem Informasi</div>
              </td>
              <td style="text-align: right;">
                <button type="button" class="btn-table-action primary btn-open-detail-modal"
                  data-asesmen="{{ json_encode($samplePayload) }}"
                  style="font-weight:700; display:inline-flex; align-items:center; gap:6px;"
                  title="Lihat Card Detail Hasil Asesmen">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                  Lihat Detail
                </button>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

    <!-- Table Pagination Footer matching bottom wireframe icons -->
    <div class="table-pagination-footer">
      <div class="pagination-info">
        Menampilkan <strong>1 - 4</strong> dari <strong>4</strong> riwayat asesmen
      </div>

      <div class="pagination-nav">
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
        </button>
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button type="button" class="pagination-btn active">1</button>
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
        <button type="button" class="pagination-btn" disabled>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>
        </button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modalDetail = document.getElementById('modalDetailAsesmen');
  const sesiIdEl = document.getElementById('modalAsesmenSesiId');
  const tanggalEl = document.getElementById('modalAsesmenTanggal');
  const statusEl = document.getElementById('modalAsesmenStatus');
  const hollandBadgeEl = document.getElementById('modalAsesmenHollandBadge');
  const ringkasanEl = document.getElementById('modalAsesmenRingkasan');
  const barsContainer = document.getElementById('modalAsesmenBarsContainer');
  const recListContainer = document.getElementById('modalAsesmenRecList');

  const dimensionMap = {
    'R': { name: 'Realistic (Teknik & Praktikal)', color: '#2E7D32', desc: 'Aktivitas fisik, teknologi praktis, instrumen mesin, dan konstruksi' },
    'I': { name: 'Investigative (Analisis & Riset)', color: '#1565C0', desc: 'Pemecahan masalah berbasis logika ilmiah, riset data, dan sains' },
    'A': { name: 'Artistic (Kreatif & Desain)', color: '#7B1FA2', desc: 'Inovasi visual, ide orisinal, desain kreatif, dan ekspresi kreasi bebas' },
    'S': { name: 'Social (Sosial & Kolaborasi)', color: '#00897B', desc: 'Interaksi sosial, mendidik, konseling, dan pengembangan kemanusiaan' },
    'E': { name: 'Enterprising (Bisnis & Kepemimpinan)', color: '#E65100', desc: 'Kepemimpinan, persuasi, wirausaha, dan inisiatif berani strategis' },
    'C': { name: 'Conventional (Struktur & Keteraturan)', color: '#455A64', desc: 'Keteraturan prosedural, akurasi data finansial, dan manajemen tata kelola' },
  };

  function openCardModal() {
    if (modalDetail) {
      modalDetail.classList.remove('hidden');
      modalDetail.classList.add('active');
      modalDetail.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }
  }

  function closeCardModal() {
    if (modalDetail) {
      modalDetail.classList.remove('active');
      modalDetail.classList.add('hidden');
      modalDetail.style.display = 'none';
      document.body.style.overflow = '';
    }
  }

  // Handle click on Lihat Detail button
  document.querySelectorAll('.btn-open-detail-modal').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();

      let data = {};
      try {
        const raw = btn.getAttribute('data-asesmen');
        if (raw) data = JSON.parse(raw);
      } catch (err) {
        console.warn('Gagal membaca data asesmen:', err);
      }

      const sesi = data.sesi || '#ASY-01';
      const tanggal = data.tanggal || '15 Oktober 2026';
      const status = data.status || 'Selesai';
      const holland = data.holland || 'I–S–R';
      const ringkasan = data.ringkasan || 'Profil hasil asesmen Holland RIASEC menunjukkan minat dan potensi dominan yang selaras dengan eksplorasi analitis dan pengembangan keilmuan terapan.';
      const rekomendasi = Array.isArray(data.rekomendasi) && data.rekomendasi.length ? data.rekomendasi : [
        {
          ranking: 1,
          nama_prodi: 'Teknik Informatika',
          rumpun: 'Saintek',
          skor: 95,
          alasan: 'Profil kemampuan logika komputasi dan pemecahan masalah analitis sangat selaras dengan kurikulum program studi.'
        }
      ];

      if (sesiIdEl) sesiIdEl.textContent = sesi;
      if (tanggalEl) tanggalEl.textContent = tanggal;
      if (statusEl) {
        statusEl.textContent = status === 'Selesai' ? 'Analisis Selesai' : status;
        statusEl.className = status === 'Selesai' ? 'status-pill success' : 'status-pill pending';
      }
      if (hollandBadgeEl) {
        hollandBadgeEl.textContent = `Kode: ${holland}`;
      }
      if (ringkasanEl) {
        ringkasanEl.textContent = ringkasan;
      }

      // Render Dimensi RIASEC Bars
      if (barsContainer) {
        barsContainer.innerHTML = '';
        const chars = holland.replace(/[^A-Za-z]/g, '').toUpperCase().split('').slice(0, 3);
        const topChars = chars.length ? chars : ['I', 'S', 'R'];
        const scoreScale = [94, 86, 78];

        topChars.forEach((ch, idx) => {
          const dim = dimensionMap[ch] || { name: `${ch} — Dimensi Dominan`, color: '#30618C', desc: 'Kecenderungan minat & bakat siswa' };
          const pct = scoreScale[idx] || (75 - idx * 5);

          const itemDiv = document.createElement('div');
          itemDiv.style.cssText = 'background: #FAFBFD; border: 1px solid #E2E8F0; border-radius: 10px; padding: 10px 14px;';
          itemDiv.innerHTML = `
            <div style="display:flex; justify-content:space-between; align-items:center; font-size:13px; font-weight:700; margin-bottom:6px;">
              <span style="color:#1E293B; display:flex; align-items:center; gap:6px;">
                <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:${dim.color};"></span>
                ${dim.name}
              </span>
              <span style="color:${dim.color}; font-weight:800; font-size:13px;">${pct}%</span>
            </div>
            <div style="height:7px; background:#E2E8F0; border-radius:10px; overflow:hidden;">
              <div style="width:${pct}%; height:100%; background:${dim.color}; border-radius:10px;"></div>
            </div>
            <div style="font-size:11.5px; color:#64748B; margin-top:4px;">${dim.desc}</div>
          `;
          barsContainer.appendChild(itemDiv);
        });
      }

      // Render Rekomendasi Program Studi Cards (NO Kampus, NO Akreditasi)
      if (recListContainer) {
        recListContainer.innerHTML = '';
        rekomendasi.forEach((rec, idx) => {
          const rank = rec.ranking || (idx + 1);
          const isTop = rank === 1;
          const badgeBg = isTop ? '#FEF08A' : '#E2E8F0';
          const badgeColor = isTop ? '#854D0E' : '#475569';
          const borderStyle = isTop ? 'border: 1.5px solid #30618C; background: #FFFFFF;' : 'border: 1.5px solid #E2E8F0; background: #FAFBFD;';

          const card = document.createElement('div');
          card.style.cssText = `${borderStyle} border-radius: 12px; padding: 14px 16px; display: flex; flex-direction: column; gap: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);`;
          card.innerHTML = `
            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:10px; flex-wrap:wrap;">
              <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                <span style="background:${badgeBg}; color:${badgeColor}; font-size:11px; font-weight:800; padding:2px 8px; border-radius:6px;">
                  ${isTop ? '★ #1 Rekomendasi Utama' : `#${rank} Pilihan Alternatif`}
                </span>
                <h6 style="margin:0; font-size:14.5px; font-weight:800; color:#0F172A;">${rec.nama_prodi}</h6>
                <span style="font-size:11px; background:#EFF6FF; color:#1D4ED8; padding:2px 8px; border-radius:4px; font-weight:700;">${rec.rumpun || 'Saintek'}</span>
              </div>
              <span style="font-size:12.5px; font-weight:800; color:#059669; background:#ECFDF5; padding:3px 10px; border-radius:20px; border:1px solid #A7F3D0; white-space:nowrap;">
                ${rec.skor}% Kesesuaian
              </span>
            </div>
            <p style="margin:0; font-size:12.5px; color:#475569; line-height:1.55;">
              ${rec.alasan || 'Direkomendasikan berdasarkan keselarasan minat dan bakat tipe Holland RIASEC siswa.'}
            </p>
          `;
          recListContainer.appendChild(card);
        });
      }

      openCardModal();
    });
  });

  // Modal Close Handlers
  if (modalDetail) {
    modalDetail.querySelectorAll('.modal-close-trigger').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        closeCardModal();
      });
    });

    modalDetail.addEventListener('click', (e) => {
      if (e.target === modalDetail) {
        closeCardModal();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modalDetail.classList.contains('active')) {
        closeCardModal();
      }
    });
  }
});
</script>
@endpush
