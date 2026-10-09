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
            <li>Terdiri dari 60 pertanyaan pilihan ganda adaptif.</li>
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
      Apakah Anda yakin ingin keluar dari akun <strong>Ahmad Rizky Pratama</strong>?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger" data-modal-hide="modalLogout">Batal</button>
      <a href="{{ url('/') }}" class="btn-step-action" style="background:#B42318; color:#fff; padding:9px 18px; border-radius:var(--radius-sm); font-weight:700;">Ya, Keluar</a>
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

<!-- 5. Modal Detail Hasil Asesmen (Wireframe 3) -->
<div class="modal-overlay hidden" id="modalDetailAsesmen" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:620px;">
    <div class="modal-header">
      <h4 class="modal-title">Detail Hasil Asesmen B-Youth</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal">&times;</button>
    </div>
    <div class="modal-body" style="display:flex; flex-direction:column; gap:18px;">
      <div style="display:flex; justify-content:space-between; align-items:center; background:#F8FAFC; padding:14px; border-radius:var(--radius-md); border:1px solid var(--c-border-light);">
        <div>
          <div style="font-size:12px; color:var(--c-text-muted);">Nomor Sesi Asesmen</div>
          <div style="font-weight:800; color:var(--c-text-heading); font-size:15px;">#ASY-2026-X12-08</div>
        </div>
        <span class="status-pill success">Analisis Selesai</span>
      </div>

      <div>
        <h5 style="font-size:14px; font-weight:700; margin-bottom:10px; color:var(--c-text-heading);">Distribusi Profil Minat & Bakat (Holland RIASEC / MBTI):</h5>
        <div style="display:flex; flex-direction:column; gap:8px;">
          <div>
            <div style="display:flex; justify-content:space-between; font-size:12.5px; font-weight:600; margin-bottom:4px;">
              <span>Investigative (Analisis & Sains)</span>
              <span style="color:var(--c-primary); font-weight:800;">94%</span>
            </div>
            <div style="height:7px; background:#E2E8F0; border-radius:10px; overflow:hidden;">
              <div style="width:94%; height:100%; background:var(--c-primary);"></div>
            </div>
          </div>
          <div>
            <div style="display:flex; justify-content:space-between; font-size:12.5px; font-weight:600; margin-bottom:4px;">
              <span>Realistic (Teknik & Komputasi)</span>
              <span style="color:#027A48; font-weight:800;">88%</span>
            </div>
            <div style="height:7px; background:#E2E8F0; border-radius:10px; overflow:hidden;">
              <div style="width:88%; height:100%; background:#10B981;"></div>
            </div>
          </div>
          <div>
            <div style="display:flex; justify-content:space-between; font-size:12.5px; font-weight:600; margin-bottom:4px;">
              <span>Conventional (Struktur & Ketelitian)</span>
              <span style="color:#B54708; font-weight:800;">82%</span>
            </div>
            <div style="height:7px; background:#E2E8F0; border-radius:10px; overflow:hidden;">
              <div style="width:82%; height:100%; background:#F59E0B;"></div>
            </div>
          </div>
        </div>
      </div>

      <div style="background:#EFF8FF; border:1px solid #B2DDFF; border-radius:var(--radius-md); padding:14px;">
        <div style="font-size:13px; font-weight:700; color:#175CD3; margin-bottom:4px;">Rekomendasi Utama Sistem:</div>
        <p style="font-size:13px; color:#1E40AF; line-height:1.5;">
          <strong>Teknik Informatika & Sains Data (Kesesuaian 95%)</strong>. Disarankan memperkuat nilai Matematika Peminatan dan mulai menyusun portofolio olimpiade/coding untuk jalur SNBP/SNBT.
        </p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Tutup Rincian</button>
    </div>
  </div>
</div>

<!-- 6. Modal Catatan Konseling (Wireframe 5) -->
<div class="modal-overlay hidden" id="modalCatatanKonseling" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:600px;">
    <div class="modal-header">
      <h4 class="modal-title">Catatan Sesi Konseling Psikologi</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal">&times;</button>
    </div>
    <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
      <div style="display:flex; align-items:center; gap:14px; padding-bottom:12px; border-bottom:1px solid var(--c-border-light);">
        <div style="width:48px; height:48px; border-radius:50%; background:#FAE08F; color:#172C40; font-weight:800; display:flex; align-items:center; justify-content:center;">MS</div>
        <div>
          <div style="font-size:15px; font-weight:800; color:var(--c-text-heading);">Dr. Maya Sartika, M.Psi., Psikolog</div>
          <div style="font-size:12.5px; color:var(--c-text-muted);">Sesi 02 Okt 2026 • Durasi 60 Menit • Selesai</div>
        </div>
      </div>

      <div>
        <h5 style="font-size:13.5px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Topik Pembahasan:</h5>
        <div style="font-size:13.5px; color:var(--c-text-body); background:#FAFCFE; padding:10px 14px; border-radius:var(--radius-sm); border:1px solid var(--c-border-light);">
          Pemilihan Program Studi &amp; Analisis Potensi Bakat Saintek vs Soshum
        </div>
      </div>

      <div>
        <h5 style="font-size:13.5px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Catatan &amp; Rekomendasi Psikolog:</h5>
        <p style="font-size:13.5px; color:var(--c-text-body); line-height:1.55;">
          Siswa menunjukkan minat kuat dan ketertarikan tinggi pada logika pemrograman dan analisis data kuantitatif. Kemampuan pemecahan masalah sangat menonjol. Perlu pendampingan untuk menjaga ketenangan saat menghadapi persiapan ujian. Dianjurkan membuat target mingguan belajar terarah.
        </p>
      </div>

      <div style="background:#ECFDF3; border:1px solid #A6F4C5; border-radius:var(--radius-md); padding:12px;">
        <span style="font-size:12.5px; font-weight:700; color:#027A48;">Tindak Lanjut yang Disepakati:</span>
        <div style="font-size:12.5px; color:#05603A; margin-top:4px;">
          Jadwal konsultasi lanjutan disepakati tanggal 10 Oktober 2026 untuk peninjauan pilihan program studi di perguruan tinggi.
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Tutup Catatan</button>
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
