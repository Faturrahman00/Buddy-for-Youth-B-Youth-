<!-- Modal 1: Catatan Lengkap Konseling -->
<div class="modal-overlay-custom" id="modalCatatanLengkap" role="dialog" aria-modal="true" aria-labelledby="modalCatatanTitle">
  <div class="modal-dialog-box" style="max-width: 680px; max-height: 90vh; display: flex; flex-direction: column;">
    <div class="modal-header-custom" style="background: linear-gradient(135deg, #172C40, #30618C); color: #fff; padding: 18px 24px;">
      <div style="display:flex; align-items:center; gap:10px;">
        <div style="width:38px; height:38px; border-radius:8px; background:rgba(255,255,255,0.15); color:#fff; display:flex; align-items:center; justify-content:center;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
          </svg>
        </div>
        <div>
          <h3 id="modalCatatanTitle" style="color: #fff; margin: 0; font-size: 17px;">Catatan Lengkap Sesi Konseling</h3>
          <p style="font-size:12px; color:#B9D0E4; margin: 2px 0 0;">Dokumen Resmi Konsultasi Psikologi B-Youth</p>
        </div>
      </div>
      <button type="button" class="modal-close-btn" data-close-modal="modalCatatanLengkap" aria-label="Tutup Modal" style="color: #fff; background: rgba(255,255,255,0.15); border: none; border-radius: 6px; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>

    <div class="modal-body-custom" style="overflow-y: auto; padding: 22px 24px; display: flex; flex-direction: column; gap: 16px;">
      <!-- Info Header Box -->
      <div style="background:#F5F8FC; border:1px solid #D5E2EE; border-radius:10px; padding:16px; display:grid; grid-template-columns:1fr 1fr; gap:14px; font-size:13px;">
        <div>
          <span style="font-size:11px; font-weight:800; color:#6B8299; text-transform:uppercase;">Identitas Siswa</span>
          <div style="font-weight:800; color:#172C40; font-size:15px; margin-top: 2px;" id="modalSiswaNama">-</div>
          <div style="font-size:12px; color:#3E5469;" id="modalSiswaSekolah">-</div>
          <div style="font-size:12px; color:var(--c-primary); font-weight: 600; margin-top: 2px;" id="modalSiswaKontak">WA: -</div>
        </div>
        <div style="text-align: right;">
          <div id="modalCatatanStatusBadge" style="margin-bottom: 6px;">
            <span class="status-tag" style="background:#EBFDF2; color:#027A48;">Selesai</span>
          </div>
          <div style="font-weight:700; color:#172C40; font-size: 13.5px;" id="modalSesiTanggal">-</div>
          <div style="font-size:12px; color:var(--c-primary); font-weight:700;" id="modalSesiDurasi">-</div>
        </div>
      </div>

      <!-- Topik Konsultasi / Pengajuan Siswa -->
      <div>
        <label style="font-size:11.5px; font-weight:800; color:#172C40; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:5px;">Topik Bimbingan / Pengajuan Siswa</label>
        <div style="background:#FFF; border:1.5px solid #E2E8F0; border-radius:8px; padding:12px 14px; font-weight:600; color:#172C40; font-size:13.5px; line-height: 1.5;" id="modalTopikKonseling">-</div>
      </div>

      <!-- Tautan Zoom (Jika Terjadwal) -->
      <div id="modalCatatanZoomWrap" style="display:none; background:#EFF8FF; border:1px solid #B2DDFF; border-radius:8px; padding:12px 14px;">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:10px;">
          <div style="font-size:12.5px; color:#175CD3; font-weight:700;">
            Link Zoom: <a href="#" id="modalCatatanZoomLink" target="_blank" style="color:#175CD3; text-decoration:underline;">Buka Sesi Zoom</a>
          </div>
          <button type="button" class="btn-secondary-link" id="modalBtnCopyZoomPsikolog" style="padding:4px 10px; font-size:11.5px;">Salin Link</button>
        </div>
      </div>

      <!-- Catatan Klinis / Evaluasi Psikolog -->
      <div>
        <label style="font-size:11.5px; font-weight:800; color:#172C40; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:5px;">Catatan Observasi, Evaluasi Klinis &amp; Rekomendasi</label>
        <div style="background:#F6FEF9; border:1.5px solid #A6F4C5; border-radius:8px; padding:16px; color:#172C40; font-size:14px; line-height:1.65; white-space: pre-line;" id="modalCatatanPsikolog">-</div>
      </div>

      <!-- Alasan Tolak (jika ditolak) -->
      <div id="modalAlasanTolakWrap" style="display:none;">
        <label style="font-size:11.5px; font-weight:800; color:#B42318; text-transform:uppercase; letter-spacing:0.04em; display:block; margin-bottom:5px;">Alasan Penolakan</label>
        <div style="background:#FEF3F2; border:1.5px solid #FECDCA; border-radius:8px; padding:14px; color:#B42318; font-size:13px; line-height:1.5;" id="modalAlasanTolak">-</div>
      </div>
    </div>

    <div class="modal-footer-custom" style="padding: 14px 24px; border-top: 1.5px solid var(--c-border-light); display: flex; justify-content: flex-end; align-items: center;">
      <button type="button" class="btn-primary-action" data-close-modal="modalCatatanLengkap">
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- Modal 1B: Form Selesaikan Konsultasi & Tulis Catatan -->
<div class="modal-overlay-custom" id="modalSelesaiKonsultasi" role="dialog" aria-modal="true" aria-labelledby="modalSelesaiTitle">
  <div class="modal-dialog-box" style="max-width: 600px;">
    <div class="modal-header-custom" style="background: linear-gradient(135deg, #172C40, #027A48); color: #fff; padding: 18px 24px;">
      <div style="display:flex; align-items:center; gap:10px;">
        <div style="width:36px; height:36px; border-radius:8px; background:rgba(255,255,255,0.2); color:#fff; display:flex; align-items:center; justify-content:center;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <div>
          <h3 id="modalSelesaiTitle" style="color:#fff; margin:0; font-size:17px;">Selesaikan Sesi Konsultasi</h3>
          <p style="font-size:12px; color:#A6F4C5; margin:2px 0 0;">Simpan catatan observasi bimbingan dan rekomendasi prodi</p>
        </div>
      </div>
      <button type="button" class="modal-close-btn" data-close-modal="modalSelesaiKonsultasi" aria-label="Tutup Modal" style="color: #fff; background: rgba(255,255,255,0.15); border: none; border-radius: 6px; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>

    <form id="formSelesaiKonsultasi" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-body-custom" style="padding: 20px 24px; display: flex; flex-direction: column; gap: 14px;">
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 14px;">
          <div style="font-size: 11px; font-weight: 800; color: #64748B; text-transform: uppercase;">Informasi Sesi Siswa</div>
          <div style="font-weight: 800; color: var(--c-text-heading); font-size: 14.5px;" id="modalSelesaiSiswaNama">-</div>
          <div style="font-size: 12px; color: var(--c-text-muted);" id="modalSelesaiMeta">-</div>
        </div>

        <div>
          <label style="font-size: 12.5px; font-weight: 800; color: var(--c-text-heading); display: block; margin-bottom: 6px;">
            Catatan Observasi, Evaluasi Klinis, &amp; Rekomendasi Program Studi
          </label>
          <textarea name="catatan" id="modalSelesaiInputCatatan" rows="5" required
            placeholder="Tuliskan hasil evaluasi bimbingan, rekomendasi program studi tervalidasi, serta arahan tindak lanjut akademik untuk siswa..."
            style="width: 100%; padding: 12px 14px; border: 1.5px solid var(--c-border); border-radius: 8px; font-size: 13.5px; line-height: 1.5; font-family: inherit; resize: vertical; box-sizing: border-box;"></textarea>
          <div style="font-size: 11.5px; color: var(--c-text-muted); margin-top: 4px;">
            Catatan ini akan tersimpan permanen di arsip riwayat dan dapat ditinjau oleh siswa di portal mereka.
          </div>
        </div>
      </div>

      <div class="modal-footer-custom" style="padding: 14px 24px; border-top: 1.5px solid var(--c-border-light); display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" class="btn-secondary-link" data-close-modal="modalSelesaiKonsultasi">Batal</button>
        <button type="submit" class="btn-primary-action" style="background: #027A48; border-color: #027A48; padding: 9px 18px; font-weight: 700;">
          Simpan &amp; Tandai Selesai
        </button>
      </div>
    </form>
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
      <p style="font-size:13px; color:#6B8299;">Sesi login Anda sebagai {{ Auth::check() ? Auth::user()->name : 'Psikolog Dra. Maya Indriani, M.Psi.' }} akan diakhiri.</p>
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
