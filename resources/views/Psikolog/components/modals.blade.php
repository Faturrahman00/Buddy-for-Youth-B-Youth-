<!-- Modal 1: Catatan Lengkap Konseling -->
<div class="modal-overlay-custom" id="modalCatatanLengkap" role="dialog" aria-modal="true" aria-labelledby="modalCatatanTitle">
  <div class="modal-dialog-box" style="max-width: 680px;">
    <div class="modal-header-custom">
      <div style="display:flex; align-items:center; gap:10px;">
        <div style="width:36px; height:36px; border-radius:8px; background:#EAF2F8; color:var(--c-primary); display:flex; align-items:center; justify-content:center;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
          </svg>
        </div>
        <div>
          <h3 id="modalCatatanTitle">Catatan Lengkap Sesi Konseling</h3>
          <p style="font-size:12px; color:var(--c-text-muted);">Dokumen Resmi Konsultasi Psikologi B-Youth</p>
        </div>
      </div>
      <button type="button" class="modal-close-btn" data-close-modal="modalCatatanLengkap" aria-label="Tutup Modal">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>

    <div class="modal-body-custom">
      <!-- Info Header Box -->
      <div style="background:#F5F8FC; border:1px solid #D5E2EE; border-radius:10px; padding:16px; margin-bottom:18px; display:grid; grid-template-columns:1fr 1fr; gap:12px; font-size:13px;">
        <div>
          <span style="font-size:11px; font-weight:800; color:#6B8299; text-transform:uppercase;">Nama Siswa</span>
          <div style="font-weight:800; color:#172C40; font-size:14.5px;" id="modalSiswaNama">-</div>
          <div style="font-size:12px; color:#3E5469;" id="modalSiswaSekolah">-</div>
        </div>
        <div>
          <span style="font-size:11px; font-weight:800; color:#6B8299; text-transform:uppercase;">Tanggal &amp; Durasi</span>
          <div style="font-weight:700; color:#172C40;" id="modalSesiTanggal">-</div>
          <div style="font-size:12px; color:#10B981; font-weight:700;" id="modalSesiDurasi">-</div>
        </div>
      </div>

      <!-- Topik Konsultasi -->
      <div style="margin-bottom:16px;">
        <label style="font-size:12px; font-weight:800; color:#172C40; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:4px;">Topik Bimbingan</label>
        <div style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:12px 14px; font-weight:700; color:#172C40; font-size:14px;" id="modalTopikKonseling">-</div>
      </div>

      <!-- Catatan Klinis / Evaluasi Psikolog -->
      <div style="margin-bottom:16px;">
        <label style="font-size:12px; font-weight:800; color:#172C40; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:4px;">Catatan Observasi &amp; Diagnosis Psikolog</label>
        <div style="background:#FFF; border:1px solid #E2E8F0; border-radius:8px; padding:14px; color:#3E5469; font-size:13.5px; line-height:1.6;" id="modalCatatanPsikolog">-</div>
      </div>

      <!-- Rekomendasi Program Studi Final -->
      <div style="margin-bottom:16px;">
        <label style="font-size:12px; font-weight:800; color:#172C40; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:4px;">Rekomendasi Program Studi Tervalidasi</label>
        <div style="background:#FFF9E6; border:1px solid #FCE49E; border-radius:8px; padding:14px; color:#7A5400; font-size:13.5px; font-weight:600; line-height:1.5;" id="modalRekomendasiProdi">-</div>
      </div>

      <!-- Tindak Lanjut Siswa -->
      <div>
        <label style="font-size:12px; font-weight:800; color:#172C40; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:4px;">Rencana Tindak Lanjut Siswa</label>
        <div style="background:#F0F6FB; border:1px solid #B9D0E4; border-radius:8px; padding:12px 14px; color:#30618C; font-size:13px;" id="modalRencanaAksi">-</div>
      </div>
    </div>

    <div class="modal-footer-custom">
      <button type="button" class="btn-secondary-link" onclick="window.print()">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
        Cetak PDF
      </button>
      <button type="button" class="btn-primary-action" data-close-modal="modalCatatanLengkap">
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- Modal 2: Konfirmasi Logout -->
<div class="modal-overlay-custom" id="modalLogout" role="dialog" aria-modal="true" aria-labelledby="modalLogoutTitle">
  <div class="modal-dialog-box" style="max-width: 440px;">
    <div class="modal-header-custom">
      <h3 id="modalLogoutTitle">Konfirmasi Keluar</h3>
      <button type="button" class="modal-close-btn" data-close-modal="modalLogout" aria-label="Tutup">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>
    <div class="modal-body-custom" style="text-align:center; padding:28px 24px;">
      <div style="width:54px; height:54px; border-radius:50%; background:#FFF5F5; color:#E53E3E; display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px; border:2px solid #FED7D7;">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
      </div>
      <h4 style="font-size:17px; font-weight:800; color:#172C40; margin-bottom:6px;">Apakah Anda yakin ingin keluar?</h4>
      <p style="font-size:13px; color:#6B8299;">Sesi login Anda sebagai Psikolog Dra. Maya Indriani, M.Psi. akan diakhiri.</p>
    </div>
    <div class="modal-footer-custom" style="justify-content:center;">
      <button type="button" class="btn-secondary-link" data-close-modal="modalLogout">Batal</button>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-publish-slot" style="margin-top:0; padding:10px 22px; background:#E53E3E; font-size:13px;">Ya, Keluar</button>
      </form>
    </div>
  </div>
</div>
