@extends('Psikolog.layout.app', [
    'title' => 'Profil Psikolog — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Profil',
    'active' => 'profil'
])

@section('content')

<!-- =========================================================================
     TOP CARD: PROFIL HEADER (Matches Wireframe 4 Top Box)
     ========================================================================= -->
<div class="profil-header-box">
  <div class="profil-left-meta">
    <!-- Photo Avatar Box (Wireframe: [X] Avatar photo) -->
    <div class="profil-photo-square" title="Foto Profil Psikolog Dra. Maya Indriani, M.Psi.">
      <span>MI</span>
    </div>

    <!-- Identity & Badges -->
    <div class="profil-meta-details">
      <h3 id="displayNamaHeader">Dra. Maya Indriani, M.Psi.</h3>
      <p class="email-txt" id="displayEmailHeader">maya.indriani@byouth.id</p>
      
      <div class="profil-badges-row">
        <!-- Badge 1: PSIKOLOG KONSELOR -->
        <span class="badge-role-psikolog">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          Psikolog Konselor
        </span>

        <!-- Badge 2: SIP: 8829/PSI/2020 -->
        <span class="badge-sip" id="displaySipHeader">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
          SIP: 8829/PSI/2020
        </span>

        <!-- Status Terverifikasi HIMPSI -->
        <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 10px; background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; border-radius:var(--radius-sm); font-size:12px; font-weight:800;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
          Terverifikasi HIMPSI
        </span>
      </div>
    </div>
  </div>

  <!-- Action: Edit Profil Button -->
  <div>
    <button type="button" class="btn-secondary-link" id="btnToggleEditProfil" onclick="window.toggleEditProfil()" style="padding: 10px 18px; font-size: 13.5px; border-color: var(--c-primary); color: var(--c-primary);">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
      Edit Profil
    </button>
  </div>
</div>

<!-- =========================================================================
     BOTTOM CARD: INFORMASI PENGGUNA (Matches Wireframe 4 Bottom Card)
     ========================================================================= -->
<div class="profil-info-details-box">
  <div class="info-details-title-bar">
    Informasi Pengguna &amp; Kredensial Praktik
  </div>

  <!-- VIEW MODE (Default Grid Display) -->
  <div class="info-grid-two-cols" id="profilDisplayGroup">
    
    <!-- Field 1: Nama Lengkap -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Nama Lengkap</span>
      <span class="profil-field-val" id="valNamaLengkap">Dra. Maya Indriani, M.Psi., Psikolog</span>
    </div>

    <!-- Field 2: Email -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Email</span>
      <span class="profil-field-val" id="valEmail">maya.indriani@byouth.id</span>
    </div>

    <!-- Field 3: Role -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Role</span>
      <span class="profil-field-val" style="color: var(--c-primary);">Psikolog Pendidikan &amp; Karir</span>
    </div>

    <!-- Field 4: Jenis Kelamin -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Jenis Kelamin</span>
      <span class="profil-field-val">Perempuan</span>
    </div>

    <!-- Field 5: Bergabung Sejak -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Bergabung Sejak</span>
      <span class="profil-field-val">15 Januari 2026</span>
    </div>

    <!-- Field 6: Status Akun -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Status Akun</span>
      <span class="profil-field-val" style="color: #027A48; display:flex; align-items:center; gap:6px;">
        <span class="pulse-dot"></span>
        Aktif &amp; Terverifikasi Himpunan Psikologi
      </span>
    </div>

    <!-- Field 7: Surat Izin Praktik Psikologi (SIP) -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Nomor SIP Psikolog</span>
      <span class="profil-field-val" id="valSip">8829/PSI/2020</span>
    </div>

    <!-- Field 8: Almamater & Pendidikan -->
    <div class="profil-field-unit">
      <span class="profil-field-title">Pendidikan Terakhir</span>
      <span class="profil-field-val">Magister Psikologi Profesi — Universitas Indonesia</span>
    </div>

    <!-- Field 9: Fokus Keahlian Konseling -->
    <div class="profil-field-unit" style="grid-column: 1 / -1;">
      <span class="profil-field-title">Fokus Keahlian Bimbingan</span>
      <span class="profil-field-val" style="font-weight: 500; color: var(--c-text-body); line-height: 1.5;">
        Asesmen Minat Bakat Remaja, Penjurusan Perguruan Tinggi SNBP/SNBT, Validasi Kesiapan Mental Akademik, dan Pemetaan Potensi Karier Era Digital.
      </span>
    </div>

  </div>

  <!-- EDIT MODE FORM (Hidden by default, toggled via JavaScript) -->
  <form id="profilEditForm" style="display: none;" onsubmit="window.simpanProfil(event)">
    <div class="info-grid-two-cols" style="gap: 16px;">
      
      <div class="form-input-group">
        <label class="form-label-custom">Nama Lengkap &amp; Gelar</label>
        <input type="text" id="editNama" class="form-control-custom" value="Dra. Maya Indriani, M.Psi., Psikolog" required>
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">Email Resmi</label>
        <input type="email" id="editEmail" class="form-control-custom" value="maya.indriani@byouth.id" required>
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">Nomor SIP</label>
        <input type="text" id="editSip" class="form-control-custom" value="8829/PSI/2020" required>
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">No. Kontak WhatsApp Bimbingan</label>
        <input type="text" id="editWhatsapp" class="form-control-custom" value="+62 812-3456-7890">
      </div>

      <div class="form-input-group" style="grid-column: 1 / -1;">
        <label class="form-label-custom">Deskripsi Singkat / Bio Profesional</label>
        <textarea id="editBio" class="form-control-custom" rows="3">Berpengalaman lebih dari 8 tahun mendampingi ratusan siswa SMA/SMK dalam menemukan potensi terbaik dan memilih program studi perguruan tinggi yang presisi.</textarea>
      </div>

    </div>

    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--c-border-light);">
      <button type="button" class="btn-secondary-link" onclick="window.toggleEditProfil()">Batal</button>
      <button type="submit" class="btn-primary-action">Simpan Perubahan</button>
    </div>
  </form>

</div>

@endsection
