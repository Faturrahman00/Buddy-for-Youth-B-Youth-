{{-- 
  B-YOUTH: MODALS SISWA COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/modals.blade.php
--}}

<!-- 1. Modal Mulai Asesmen -->
<div class="modal-overlay hidden" id="modalAsesmen" tabindex="-1" aria-hidden="true">
  <div class="modal-box">
    <div class="modal-header">
      <h4 class="modal-title">Asesmen Minat & Bakat B-Youth</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" data-modal-hide="modalAsesmen" aria-label="Tutup Modal">&times;</button>
    </div>
    <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
      <div style="background:var(--c-amber-subtle); border:1px solid var(--c-amber-light); padding:16px; border-radius:var(--radius-md); display:flex; gap:12px;">
        <div style="font-size:14px; color:#714600;">
          <strong>Petunjuk Pengerjaan:</strong>
          <ul style="margin-top:6px; padding-left:18px; line-height:1.5;">
            <li>Durasi tes: <strong>45 Menit</strong> tanpa jeda.</li>
            <li>Terdiri dari 42 pertanyaan pilihan ganda adaptif.</li>
            <li>Jawablah secara jujur sesuai preferensi diri Anda sendiri.</li>
            <li>Hasil rekomendasi akan langsung dikalkulasikan setelah selesai.</li>
          </ul>
        </div>
      </div>
      <p style="font-size:14px; color:var(--c-text-muted);">
        Pastikan koneksi internet stabil dan cari tempat yang tenang sebelum menekan tombol mulai.
      </p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger" data-modal-hide="modalAsesmen">Nanti Saja</button>
      <button type="button" class="btn-step-action btn-primary-action" onclick="alert('Memulai sesi Asesmen B-Youth...'); location.reload();" style="padding:10px 20px;">Mulai Tes Sekarang</button>
    </div>
  </div>
</div>

<!-- 3. Modal Konfirmasi Keluar -->
<div class="modal-overlay hidden" id="modalLogout" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:420px;">
    <div class="modal-header" style="background:#FEF3F2;">
      <h4 class="modal-title" style="color:#B42318;">Konfirmasi Keluar</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" data-modal-hide="modalLogout" aria-label="Tutup Modal">&times;</button>
    </div>
    <div class="modal-body" style="font-size:15px; color:var(--c-text-body);">
      Apakah Anda yakin ingin keluar dari akun <strong>{{ Auth::check() ? Auth::user()->name : 'Siswa' }}</strong>?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger" data-modal-hide="modalLogout">Batal</button>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-step-action" style="background:#B42318; color:#fff; padding:9px 18px; border-radius:var(--radius-sm); font-weight:700; border:none; cursor:pointer;">Ya, Keluar</button>
      </form>
    </div>
  </div>
</div>

<!-- 4. Modal Tambah / Masukkan Nilai Rapor -->
<div class="modal-overlay hidden" id="modalTambahNilai" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:520px;">
    <div class="modal-header">
      <h4 class="modal-title">Masukkan Nilai Rapor</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal">&times;</button>
    </div>
    <form id="formTambahNilai">
      <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
        <div style="background:rgba(48,97,140,0.06); border:1px solid rgba(48,97,140,0.18); border-radius:var(--radius-sm); padding:10px 14px; font-size:12.5px; color:var(--c-primary);">
          Siswa hanya dapat memasukkan atau memperbarui nilai untuk 4 mata pelajaran penentu yang disediakan admin sekolah.
        </div>

        <div>
          <label class="form-label">Mata Pelajaran</label>
          <select class="form-select" id="tambahMapelNama" required>
            <option value="IPAS">IPAS (Ilmu Pengetahuan Alam &amp; Sosial)</option>
            <option value="MTK">MTK (Matematika)</option>
            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
            <option value="Bahasa Inggris">Bahasa Inggris</option>
          </select>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
          <div>
            <label class="form-label">Semester</label>
            <select class="form-select" id="tambahSemester" required>
              <option value="Semester 5" selected>Semester 5 (Kelas XII Ganjil)</option>
              <option value="Semester 4">Semester 4 (Kelas XI Genap)</option>
              <option value="Semester 3">Semester 3 (Kelas XI Ganjil)</option>
              <option value="Semester 2">Semester 2 (Kelas X Genap)</option>
              <option value="Semester 1">Semester 1 (Kelas X Ganjil)</option>
            </select>
          </div>
          <div>
            <label class="form-label">KKM Sekolah</label>
            <input type="number" class="form-input" id="tambahKkm" value="75" min="50" max="100" readonly style="background:#F8FAFC;">
          </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
          <div>
            <label class="form-label">Nilai Pengetahuan (0-100)</label>
            <input type="number" class="form-input" id="tambahNilaiPengetahuan" placeholder="Contoh: 88" min="0" max="100" required>
          </div>
          <div>
            <label class="form-label">Nilai Keterampilan (0-100)</label>
            <input type="number" class="form-input" id="tambahNilaiKeterampilan" placeholder="Contoh: 90" min="0" max="100" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Batal</button>
        <button type="submit" class="btn-primary-action" style="padding:9px 18px;">Simpan Nilai</button>
      </div>
    </form>
  </div>
</div>

<!-- 5. Modal Detail Hasil Asesmen (Card Detail Hasil Asesmen) -->
<div class="modal-overlay hidden" id="modalDetailAsesmen" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width: 680px; width: 95%; max-height: 92vh; display: flex; flex-direction: column; border-radius: 18px; overflow: hidden; box-shadow: 0 20px 50px rgba(15,23,42,0.25);">
    
    <!-- Modal Header -->
    <div class="modal-header" style="background: linear-gradient(135deg, #172C40, #30618C); padding: 18px 24px; color: #fff; border-bottom: none; display: flex; align-items: center; justify-content: space-between;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <div>
          <h4 style="margin: 0; font-size: 17px; font-weight: 800; color: #FFFFFF;">Detail Hasil Asesmen Siswa</h4>
          <span style="font-size: 12px; color: #B9D0E4;" id="modalAsesmenTanggal">15 Oktober 2026</span>
        </div>
      </div>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal" style="background: rgba(255,255,255,0.15); color: #fff; border: none; cursor: pointer;">&times;</button>
    </div>

    <!-- Modal Body (Scrollable Card Content) -->
    <div class="modal-body" style="padding: 24px; overflow-y: auto; display: flex; flex-direction: column; gap: 18px; background: #FAFBFD;">
      
      <!-- Sesi & Holland Code Hero Row -->
      <div style="display: flex; justify-content: space-between; align-items: center; background: #FFFFFF; padding: 16px 20px; border-radius: 14px; border: 1.5px solid #E2E8F0; box-shadow: 0 2px 8px rgba(0,0,0,0.03); flex-wrap: wrap; gap: 10px;">
        <div>
          <span style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Nomor Sesi Asesmen</span>
          <div style="font-size: 16px; font-weight: 800; color: #0F172A;" id="modalAsesmenSesiId">#ASY-01</div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
          <span class="status-pill success" id="modalAsesmenStatus" style="font-size: 12px; padding: 4px 12px;">Analisis Selesai</span>
          <span style="font-size: 12.5px; font-weight: 800; background: #EBF3FA; color: var(--c-primary, #30618C); padding: 5px 14px; border-radius: 100px; border: 1px solid #C2D9EE;" id="modalAsesmenHollandBadge">
            Kode: I–R–C
          </span>
        </div>
      </div>

      <!-- Ringkasan Profil Narasi -->
      <div style="background: #FFFFFF; padding: 16px 20px; border-radius: 14px; border: 1.5px solid #E2E8F0;">
        <h5 style="margin: 0 0 6px 0; font-size: 13.5px; font-weight: 800; color: #1E293B; display: flex; align-items: center; gap: 7px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary, #30618C)" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Ringkasan Karakteristik &amp; Minat Dominan
        </h5>
        <p style="margin: 0; font-size: 13px; color: #475569; line-height: 1.6;" id="modalAsesmenRingkasan">
          Profil asesmen Holland RIASEC menunjukkan minat dominan pada pemecahan masalah analitis dan penerapan teknologi praktikal.
        </p>
      </div>

      <!-- Distribusi 3 Dimensi Dominan RIASEC -->
      <div style="background: #FFFFFF; padding: 18px 20px; border-radius: 14px; border: 1.5px solid #E2E8F0;">
        <h5 style="margin: 0 0 12px 0; font-size: 13.5px; font-weight: 800; color: #1E293B; display: flex; align-items: center; gap: 7px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary, #30618C)" stroke-width="2.2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          Distribusi Dimensi Dominan (Holland RIASEC)
        </h5>
        <div style="display: flex; flex-direction: column; gap: 10px;" id="modalAsesmenBarsContainer">
          <!-- Diisi otomatis oleh JavaScript -->
        </div>
      </div>

      <!-- Rekomendasi Program Studi Section -->
      <div style="background: #FFFFFF; padding: 18px 20px; border-radius: 14px; border: 1.5px solid #E2E8F0;">
        <h5 style="margin: 0 0 12px 0; font-size: 13.5px; font-weight: 800; color: #1E293B; display: flex; align-items: center; gap: 7px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary, #30618C)" stroke-width="2.2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          Rekomendasi Program Studi Terbaik
        </h5>
        <div id="modalAsesmenRecList" style="display: flex; flex-direction: column; gap: 10px;">
          <!-- Diisi otomatis oleh JavaScript -->
        </div>
      </div>

      <!-- Catatan Kebijakan Program Studi Antarkampus -->
      <div style="padding: 14px 18px; background: #F8FAFC; border: 1.5px solid #E2E8F0; border-left: 4px solid var(--c-primary, #30618C); border-radius: 12px; display: flex; gap: 12px; align-items: flex-start;">
        <div style="color: var(--c-primary, #30618C); margin-top: 1px; flex-shrink: 0;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div style="font-size: 12.5px; color: #334155; line-height: 1.55;">
          <strong style="color: #0F172A; font-weight: 700;">Catatan Penting:</strong> Kebijakan penamaan jurusan, peminatan program studi, kurikulum, dan daya tampung dapat berbeda-beda pada setiap perguruan tinggi / kampus.
        </div>
      </div>

    </div>

    <!-- Modal Footer -->
    <div class="modal-footer" style="padding: 16px 24px; background: #FFFFFF; border-top: 1.5px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; gap: 12px;">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger" style="padding: 9px 20px; font-weight: 700;">
        Tutup Rincian
      </button>
      <a href="{{ route('siswa.konsultasi') }}" class="btn-step-action btn-primary-action" style="padding: 9px 20px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 7px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        <span>Konsultasi dengan Psikolog</span>
      </a>
    </div>

  </div>
</div>

<!-- 6. Modal Catatan & Detail Konsultasi Siswa -->
<div class="modal-overlay hidden" id="modalCatatanKonseling" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width: 660px; width: 95%; max-height: 92vh; display: flex; flex-direction: column; border-radius: 18px; overflow: hidden; box-shadow: 0 20px 50px rgba(15,23,42,0.25);">
    
    <!-- Modal Header -->
    <div class="modal-header" style="background: linear-gradient(135deg, #172C40, #30618C); padding: 18px 24px; color: #fff; border-bottom: none; display: flex; align-items: center; justify-content: space-between;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
        </div>
        <div>
          <h4 class="modal-title" style="margin: 0; font-size: 17px; font-weight: 800; color: #FFFFFF;">Detail &amp; Catatan Sesi Konsultasi</h4>
          <span style="font-size: 12px; color: #B9D0E4;">Dokumen Resmi Bimbingan &amp; Konseling Akademik Siswa</span>
        </div>
      </div>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal" style="background: rgba(255,255,255,0.15); color: #fff; border: none; cursor: pointer; border-radius: 8px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 20px;">&times;</button>
    </div>

    <!-- Modal Body (Scrollable) -->
    <div class="modal-body" style="padding: 22px 24px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px; background: #FAFBFD;">

      <!-- Meta Bar: ID, Jadwal, & Status Badge -->
      <div style="display: flex; justify-content: space-between; align-items: center; background: #FFFFFF; padding: 14px 18px; border-radius: 12px; border: 1.5px solid #E2E8F0; flex-wrap: wrap; gap: 10px;">
        <div>
          <span style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Nomor Registrasi Konsultasi</span>
          <div style="font-size: 15px; font-weight: 800; color: #0F172A;" id="modalKonsulId">#KNS-01</div>
          <div style="font-size: 12px; color: var(--c-text-muted);" id="modalKonsulPengajuanWrap">Diajukan: <span id="modalKonsulPengajuan">-</span></div>
        </div>
        <div style="text-align: right;">
          <div id="modalKonsulStatusBadge">
            <span class="status-pill success" style="font-size: 12px; padding: 4px 12px;">Selesai</span>
          </div>
          <div style="font-size: 12px; font-weight: 700; color: var(--c-primary); margin-top: 4px;" id="modalKonsulWaktuPill">-</div>
        </div>
      </div>

      <!-- Profil Psikolog Konselor -->
      <div style="background: #FFFFFF; padding: 16px 18px; border-radius: 12px; border: 1.5px solid #E2E8F0; display: flex; align-items: center; gap: 14px;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #FAE08F; color: #172C40; font-weight: 800; font-size: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;" id="modalKonsulPsikologInisial">
          MS
        </div>
        <div style="flex: 1; min-width: 0;">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase;">Psikolog Pembimbing</div>
          <div style="font-size: 15px; font-weight: 800; color: var(--c-text-heading);" id="modalKonsulPsikologNama">-</div>
          <div style="font-size: 12px; color: var(--c-text-muted); display: flex; gap: 10px; flex-wrap: wrap; margin-top: 2px;">
            <span id="modalKonsulPsikologSpesialisasi">Psikolog Pendidikan</span>
            <span>•</span>
            <span id="modalKonsulPsikologSip">SIP: -</span>
          </div>
        </div>
      </div>

      <!-- Jadwal Pelaksanaan -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
        <div style="background: #FFFFFF; padding: 12px 16px; border-radius: 10px; border: 1.5px solid #E2E8F0;">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 2px;">Tanggal Konsultasi</div>
          <div style="font-size: 13.5px; font-weight: 800; color: var(--c-text-heading);" id="modalKonsulTanggal">-</div>
        </div>
        <div style="background: #FFFFFF; padding: 12px 16px; border-radius: 10px; border: 1.5px solid #E2E8F0;">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 2px;">Waktu Konseling</div>
          <div style="font-size: 13.5px; font-weight: 800; color: var(--c-primary);" id="modalKonsulJam">-</div>
        </div>
      </div>

      <!-- Tautan Zoom Sesi (Jika Ada & Disetujui) -->
      <div id="modalKonsulZoomWrap" style="display:none; background: #EFF8FF; border: 1.5px solid #B2DDFF; border-radius: 12px; padding: 14px 18px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <div style="width: 34px; height: 34px; border-radius: 8px; background: #2D8CFF; color: #fff; display: flex; align-items: center; justify-content: center;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
            </div>
            <div>
              <div style="font-size: 13px; font-weight: 800; color: #175CD3;">Tautan Ruang Zoom Sesi</div>
              <div style="font-size: 11.5px; color: #3538CD;" id="modalKonsulZoomLinkText">https://zoom.us/...</div>
            </div>
          </div>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-step-action btn-outline-action" id="modalKonsulBtnCopyZoom" style="padding: 6px 12px; font-size: 12px;">Salin Link</button>
            <a href="#" target="_blank" id="modalKonsulBtnBukaZoom" class="btn-step-action btn-primary-action" style="padding: 6px 14px; font-size: 12px; text-decoration: none;">Masuk Zoom</a>
          </div>
        </div>
      </div>

      <!-- Topik / Pertanyaan Pengajuan Siswa -->
      <div style="background: #FFFFFF; padding: 14px 18px; border-radius: 12px; border: 1.5px solid #E2E8F0;">
        <h5 style="margin: 0 0 6px 0; font-size: 13px; font-weight: 800; color: #1E293B; display: flex; align-items: center; gap: 6px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          Topik Pembahasan / Pertanyaan yang Diajukan
        </h5>
        <div style="font-size: 13px; color: #334155; line-height: 1.6; background: #F8FAFC; padding: 10px 14px; border-radius: 8px; border: 1px solid #E2E8F0;" id="modalKonsulTopik">
          -
        </div>
      </div>

      <!-- Catatan Evaluasi & Rekomendasi Psikolog -->
      <div style="background: #FFFFFF; padding: 16px 18px; border-radius: 12px; border: 1.5px solid #E2E8F0;" id="modalKonsulCatatanBox">
        <h5 style="margin: 0 0 8px 0; font-size: 13.5px; font-weight: 800; color: #1E293B; display: flex; align-items: center; gap: 6px;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#027A48" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
          Catatan Observasi &amp; Rekomendasi Lengkap Psikolog
        </h5>
        <div style="font-size: 13.5px; color: #1E293B; line-height: 1.65; white-space: pre-line; background: #F6FEF9; border: 1px solid #A6F4C5; padding: 14px 16px; border-radius: 8px;" id="modalKonsulCatatan">
          Belum ada catatan evaluasi tertulis dari psikolog.
        </div>
      </div>

      <!-- Alasan Penolakan (Jika Ada & Ditolak) -->
      <div id="modalKonsulTolakWrap" style="display:none; background: #FEF3F2; border: 1.5px solid #FECDCA; border-radius: 12px; padding: 14px 18px;">
        <h5 style="margin: 0 0 6px 0; font-size: 13px; font-weight: 800; color: #B42318; display: flex; align-items: center; gap: 6px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#B42318" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
          Alasan Penolakan Pengajuan
        </h5>
        <div style="font-size: 13px; color: #B42318; line-height: 1.5;" id="modalKonsulTolakAlasan">-</div>
      </div>

    </div>

    <!-- Modal Footer -->
    <div class="modal-footer" style="padding: 14px 24px; background: #FFFFFF; border-top: 1.5px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; gap: 12px;">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger" style="padding: 8px 18px; font-weight: 700;">Tutup Rincian</button>
      <div style="display: flex; gap: 10px;">
        <a href="#" target="_blank" id="modalKonsulBtnZoomDirect" class="btn-step-action btn-primary-action" style="padding: 8px 18px; font-weight: 700; text-decoration: none; display: none; align-items: center; gap: 6px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
          <span>Buka Ruang Zoom</span>
        </a>
      </div>
    </div>

  </div>
</div>

<!-- 7. Modal Masuk Zoom (Wireframe 4) -->
<div class="modal-overlay hidden" id="modalZoom" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:520px; text-align:center;">
    <div class="modal-header" style="background:#EFF8FF;">
      <h4 class="modal-title" style="color:#175CD3; width:100%; text-align:center;">Sesi Zoom Konsultasi B-Youth</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal">&times;</button>
    </div>
    <div class="modal-body" style="padding:28px 24px;">
      <div style="width:68px; height:68px; border-radius:50%; background:#2D8CFF; color:#fff; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; box-shadow:0 6px 18px rgba(45,140,255,0.35);">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M23 7l-7 5 7 5V7z"></path>
          <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
        </svg>
      </div>
      <h4 style="font-size:18px; font-weight:800; color:var(--c-text-heading); margin-bottom:6px;">Konsultasi Daring Terjadwal</h4>
      <p style="font-size:14px; color:var(--c-text-muted); margin-bottom:18px;">
        Bersama <strong>Dr. Maya Sartika, M.Psi., Psikolog</strong><br>
        Ruang pertemuan sudah dibuka. Silakan klik tombol di bawah untuk bergabung.
      </p>
      <div style="background:#F8FAFC; border:1px solid var(--c-border); border-radius:var(--radius-md); padding:12px; margin-bottom:20px; font-size:13px; text-align:left;">
        <div><strong>ID Pertemuan:</strong> 892 3841 9920</div>
        <div><strong>Kode Masuk:</strong> BYOUTH2026</div>
      </div>
      <div style="display:flex; justify-content:center; gap:12px;">
        <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Nanti Saja</button>
        <a href="https://zoom.us" target="_blank" class="btn-zoom-action" style="padding:10px 24px; font-size:14px;">Buka Ruang Zoom</a>
      </div>
    </div>
  </div>
</div>

<!-- 8. Modal Ubah Nilai Rapor -->
<div class="modal-overlay hidden" id="modalEditNilai" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:520px;">
    <div class="modal-header">
      <h4 class="modal-title">Masukkan / Ubah Nilai Rapor</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal">&times;</button>
    </div>
    <form id="formEditNilai">
      <input type="hidden" id="editRowIndex" value="">
      <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
        <div>
          <label class="form-label">Mata Pelajaran (Disediakan Admin)</label>
          <select class="form-select" id="editMapelNama" required>
            <option value="IPAS">IPAS (Ilmu Pengetahuan Alam &amp; Sosial)</option>
            <option value="MTK">MTK (Matematika)</option>
            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
            <option value="Bahasa Inggris">Bahasa Inggris</option>
          </select>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
          <div>
            <label class="form-label">Semester</label>
            <select class="form-select" id="editSemester" required>
              <option value="Semester 5" selected>Semester 5 (Kelas XII Ganjil)</option>
              <option value="Semester 4">Semester 4 (Kelas XI Genap)</option>
              <option value="Semester 3">Semester 3 (Kelas XI Ganjil)</option>
              <option value="Semester 2">Semester 2 (Kelas X Genap)</option>
              <option value="Semester 1">Semester 1 (Kelas X Ganjil)</option>
            </select>
          </div>
          <div>
            <label class="form-label">KKM Sekolah</label>
            <input type="number" class="form-input" id="editKkm" value="75" min="50" max="100" readonly style="background:#F8FAFC;">
          </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
          <div>
            <label class="form-label">Nilai Pengetahuan (0-100)</label>
            <input type="number" class="form-input" id="editNilaiPengetahuan" min="0" max="100" required>
          </div>
          <div>
            <label class="form-label">Nilai Keterampilan (0-100)</label>
            <input type="number" class="form-input" id="editNilaiKeterampilan" min="0" max="100" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Batal</button>
        <button type="submit" class="btn-primary-action" style="padding:9px 18px;">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
