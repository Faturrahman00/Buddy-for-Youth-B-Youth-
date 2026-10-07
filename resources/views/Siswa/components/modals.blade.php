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
      <a href="{{ url('/') }}" class="btn-step-action" style="background:#B42318; color:#fff; padding:9px 18px;">Ya, Keluar</a>
    </div>
  </div>
</div>
