{{-- 
  B-YOUTH: MODALS SISWA COMPONENT (Flowbite Compatible)
  File: resources/views/Siswa/components/modals.blade.php
--}}

<!-- 1. Modal Booking Konsultasi Baru -->
<div class="modal-overlay hidden" id="modalBooking" tabindex="-1" aria-hidden="true">
  <div class="modal-box">
    <div class="modal-header">
      <h4 class="modal-title">Booking Konsultasi Baru</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" data-modal-hide="modalBooking" aria-label="Tutup Modal">&times;</button>
    </div>
    <form id="bookingConsultationForm">
      <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
        <div>
          <label style="display:block; font-size:14px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Pilih Topik Konseling</label>
          <select style="width:100%; padding:10px 12px; border:1.5px solid var(--c-border); border-radius:var(--radius-sm); font-family:inherit; font-size:14px; outline:none;" required>
            <option value="">-- Pilih Topik Diskusi --</option>
            <option value="1">Penentuan Jurusan SNBP / SNBT</option>
            <option value="2">Eksplorasi Minat, Bakat & Kepribadian</option>
            <option value="3">Diskusi Penyelarasan Aspirasi Orang Tua</option>
            <option value="4">Peluang Karir & Industri Masa Depan</option>
          </select>
        </div>

        <div>
          <label style="display:block; font-size:14px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Pilih Psikolog / Konselor</label>
          <select style="width:100%; padding:10px 12px; border:1.5px solid var(--c-border); border-radius:var(--radius-sm); font-family:inherit; font-size:14px; outline:none;" required>
            <option value="">-- Pilih Psikolog Tersertifikasi --</option>
            <option value="1">Dra. Sarah Amelia, M.Psi (Spesialis Karir Remaja)</option>
            <option value="2">Bambang Wicaksono, M.Psi (Spesialis Saintek & STEM)</option>
            <option value="3">Nadia Salsabila, S.Psi, M.Ed (Spesialis Soshum & Desain)</option>
          </select>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
          <div>
            <label style="display:block; font-size:14px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Pilih Tanggal</label>
            <input type="date" style="width:100%; padding:10px 12px; border:1.5px solid var(--c-border); border-radius:var(--radius-sm); font-family:inherit; font-size:14px; outline:none;" required value="{{ date('Y-m-d', strtotime('+3 days')) }}">
          </div>
          <div>
            <label style="display:block; font-size:14px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Pilih Sesi Jam</label>
            <select style="width:100%; padding:10px 12px; border:1.5px solid var(--c-border); border-radius:var(--radius-sm); font-family:inherit; font-size:14px; outline:none;" required>
              <option value="10:00">10:00 - 11:00 WIB</option>
              <option value="14:00" selected>14:00 - 15:00 WIB</option>
              <option value="16:00">16:00 - 17:00 WIB</option>
              <option value="19:30">19:30 - 20:30 WIB</option>
            </select>
          </div>
        </div>

        <div>
          <label style="display:block; font-size:14px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Catatan Tambahan untuk Konselor</label>
          <textarea rows="3" placeholder="Tuliskan kendala atau pertanyaan utama yang ingin dibahas..." style="width:100%; padding:10px 12px; border:1.5px solid var(--c-border); border-radius:var(--radius-sm); font-family:inherit; font-size:14px; outline:none; resize:vertical;"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-step-action btn-outline-action modal-close-trigger" data-modal-hide="modalBooking">Batal</button>
        <button type="submit" class="btn-step-action btn-accent-action" style="padding:10px 20px;">Konfirmasi Booking</button>
      </div>
    </form>
  </div>
</div>

<!-- 2. Modal Mulai Asesmen -->
<div class="modal-overlay hidden" id="modalAsesmen" tabindex="-1" aria-hidden="true">
  <div class="modal-box">
    <div class="modal-header">
      <h4 class="modal-title">Asesmen Minat & Bakat B-Youth</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" data-modal-hide="modalAsesmen" aria-label="Tutup Modal">&times;</button>
    </div>
    <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
      <div style="background:var(--c-amber-subtle); border:1px solid var(--c-amber-light); padding:16px; border-radius:var(--radius-md); display:flex; gap:12px;">
        <span style="font-size:24px;">⏱️</span>
        <div style="font-size:14px; color:#714600;">
          <strong>Petunjuk Pengerjaan:</strong>
          <ul style="margin-top:6px; padding-left:18px; line-height:1.5;">
            <li>Durasi tes: <strong>45 Menit</strong> tanpa jeda.</li>
            <li>Terdiri dari 60 pertanyaan pilihan ganda adaptif.</li>
            <li>Jawablah secara jujur sesuai preferensi diri Anda sendiri.</li>
            <li>Hasil AI akan langsung dikalkulasikan setelah selesai.</li>
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

<!-- 4. Modal Tambah Nilai Rapor (Wireframe 1) -->
<div class="modal-overlay hidden" id="modalTambahNilai" tabindex="-1" aria-hidden="true">
  <div class="modal-box" style="max-width:550px;">
    <div class="modal-header">
      <h4 class="modal-title">Input Nilai Rapor Baru</h4>
      <button type="button" class="modal-close-btn modal-close-trigger" aria-label="Tutup Modal">&times;</button>
    </div>
    <form onsubmit="event.preventDefault(); alert('Nilai berhasil disimpan ke sistem data akademik!'); document.getElementById('modalTambahNilai').classList.remove('active'); document.body.style.overflow='';">
      <div class="modal-body" style="display:flex; flex-direction:column; gap:16px;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
          <div>
            <label class="form-label">Semester</label>
            <select class="form-select" required>
              <option value="Semester 1">Semester 1 (Ganjil Kls X)</option>
              <option value="Semester 2">Semester 2 (Genap Kls X)</option>
              <option value="Semester 3">Semester 3 (Ganjil Kls XI)</option>
              <option value="Semester 4">Semester 4 (Genap Kls XI)</option>
              <option value="Semester 5" selected>Semester 5 (Ganjil Kls XII)</option>
            </select>
          </div>
          <div>
            <label class="form-label">Kelompok Mapel</label>
            <select class="form-select" required>
              <option value="Wajib Umum">Wajib Umum (A)</option>
              <option value="Peminatan Saintek" selected>Peminatan Saintek (B)</option>
              <option value="Peminatan Soshum">Peminatan Soshum (C)</option>
              <option value="Muatan Lokal">Muatan Lokal</option>
            </select>
          </div>
        </div>

        <div>
          <label class="form-label">Nama Mata Pelajaran</label>
          <input type="text" class="form-input" placeholder="Contoh: Matematika Peminatan / Fisika" required value="">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
          <div>
            <label class="form-label">KKM Sekolah</label>
            <input type="number" class="form-input" value="75" min="50" max="100" required>
          </div>
          <div>
            <label class="form-label">Nilai Pengetahuan</label>
            <input type="number" class="form-input" placeholder="0-100" min="0" max="100" required>
          </div>
          <div>
            <label class="form-label">Nilai Keterampilan</label>
            <input type="number" class="form-input" placeholder="0-100" min="0" max="100" required>
          </div>
        </div>

        <div>
          <label class="form-label">Catatan Guru / Rapor (Opsional)</label>
          <textarea class="form-textarea" rows="2" placeholder="Catatan capaian kompetensi siswa..."></textarea>
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
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Tutup</button>
      <button type="button" class="btn-primary-action" onclick="alert('Laporan PDF Hasil Asesmen sedang diunduh...');" style="padding:9px 18px;">Unduh Laporan PDF</button>
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
          Pemilihan Jurusan & Analisis Potensi Bakat Saintek vs Soshum
        </div>
      </div>

      <div>
        <h5 style="font-size:13.5px; font-weight:700; color:var(--c-text-heading); margin-bottom:6px;">Catatan & Rekomendasi Psikolog:</h5>
        <p style="font-size:13.5px; color:var(--c-text-body); line-height:1.55;">
          Siswa menunjukkan minat kuat dan ketertarikan tinggi pada logika pemrograman dan analisis data kuantitatif. Kemampuan problem-solving sangat menonjol. Perlu pendampingan untuk meminimalisasi overthinking saat menghadapi tryout SNBT. Dianjurkan membuat target mingguan belajar mandiri.
        </p>
      </div>

      <div style="background:#ECFDF3; border:1px solid #A6F4C5; border-radius:var(--radius-md); padding:12px;">
        <span style="font-size:12.5px; font-weight:700; color:#027A48;">Tindak Lanjut yang Disepakati:</span>
        <div style="font-size:12.5px; color:#05603A; margin-top:4px;">
          Jadwal konsultasi lanjutan disepakati tanggal 10 Oktober 2026 untuk review pemilihan prodi PTN.
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Tutup</button>
      <button type="button" class="btn-primary-action" onclick="alert('Membuka resume resmi...');" style="padding:9px 18px;">Unduh Resume</button>
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
      <h4 style="font-size:18px; font-weight:800; color:var(--c-text-heading); margin-bottom:6px;">Konsultasi Online Terjadwal</h4>
      <p style="font-size:14px; color:var(--c-text-muted); margin-bottom:18px;">
        Bersama <strong>Dr. Maya Sartika, M.Psi., Psikolog</strong><br>
        Ruang Zoom sudah dibuka. Silakan klik tombol di bawah untuk bergabung.
      </p>
      <div style="background:#F8FAFC; border:1px solid var(--c-border); border-radius:var(--radius-md); padding:12px; margin-bottom:20px; font-size:13px; text-align:left;">
        <div><strong>Meeting ID:</strong> 892 3841 9920</div>
        <div><strong>Passcode:</strong> BYOUTH2026</div>
      </div>
      <div style="display:flex; justify-content:center; gap:12px;">
        <button type="button" class="btn-step-action btn-outline-action modal-close-trigger">Nanti Saja</button>
        <a href="https://zoom.us" target="_blank" class="btn-zoom-action" style="padding:10px 24px; font-size:14px;">Buka Aplikasi Zoom</a>
      </div>
    </div>
  </div>
</div>
