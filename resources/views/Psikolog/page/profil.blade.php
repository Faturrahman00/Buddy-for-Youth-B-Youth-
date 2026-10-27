@extends('Psikolog.layout.app', [
    'title' => 'Profil Psikolog — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Profil',
    'active' => 'profil'
])

@php
  $psikolog = $psikolog ?? (Auth::guard('psikolog')->user() ?? Auth::user());
  $initials = strtoupper(substr($psikolog->nama ?? 'PS', 0, 2));
@endphp

@section('content')


<!-- =========================================================================
     TOP CARD: PROFIL HEADER
     ========================================================================= -->
<div class="profil-header-box">
  <div class="profil-left-meta">
    <div class="profil-photo-square" title="Foto Profil Psikolog">
      <span>{{ $initials }}</span>
    </div>

    <div class="profil-meta-details">
      <h3 id="displayNamaHeader">{{ $psikolog->nama ?? '-' }}</h3>
      <p class="email-txt" id="displayEmailHeader">{{ $psikolog->email ?? '-' }}</p>
      
      <div class="profil-badges-row">
        <span class="badge-role-psikolog">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          Psikolog Konselor
        </span>

        @if(!empty($psikolog->no_sip))
          <span class="badge-sip" id="displaySipHeader">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            SIP: {{ $psikolog->no_sip }}
          </span>
        @endif

        <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 10px; background:#EBFDF2; color:#027A48; border:1px solid #A6F4C5; border-radius:var(--radius-sm); font-size:12px; font-weight:800;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
          Status: {{ $psikolog->status ?? 'Aktif' }}
        </span>
      </div>
    </div>
  </div>

  <div>
    <button type="button" class="btn-secondary-link" id="btnToggleEditProfil" onclick="window.toggleEditProfil()" style="padding: 10px 18px; font-size: 13.5px; border-color: var(--c-primary); color: var(--c-primary);">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
      Edit Profil
    </button>
  </div>
</div>

<!-- =========================================================================
     BOTTOM CARD: INFORMASI PENGGUNA
     ========================================================================= -->
<div class="profil-info-details-box">
  <div class="info-details-title-bar">
    Informasi Pengguna &amp; Kredensial Praktik
  </div>

  <!-- VIEW MODE (Default Grid Display) -->
  <div class="info-grid-two-cols" id="profilDisplayGroup">
    
    <div class="profil-field-unit">
      <span class="profil-field-title">Nama Lengkap &amp; Gelar</span>
      <span class="profil-field-val" id="valNamaLengkap">{{ $psikolog->nama ?? '-' }}</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Email Resmi</span>
      <span class="profil-field-val" id="valEmail">{{ $psikolog->email ?? '-' }}</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Role</span>
      <span class="profil-field-val" style="color: var(--c-primary);">Psikolog Pendidikan &amp; Karir</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Jenis Kelamin</span>
      <span class="profil-field-val">{{ $psikolog->jenis_kelamin ?? 'Belum diatur' }}</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Nomor SIP Psikolog</span>
      <span class="profil-field-val" id="valSip">{{ $psikolog->no_sip ?? '-' }}</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Nomor WhatsApp / Telepon</span>
      <span class="profil-field-val">{{ $psikolog->no_telepon ?? '-' }}</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Pendidikan Terakhir</span>
      <span class="profil-field-val">{{ $psikolog->pendidikan_terakhir ?? '-' }}</span>
    </div>

    <div class="profil-field-unit">
      <span class="profil-field-title">Bergabung Sejak</span>
      <span class="profil-field-val">{{ $psikolog->created_at ? $psikolog->created_at->translatedFormat('d F Y') : '-' }}</span>
    </div>

    <div class="profil-field-unit" style="grid-column: 1 / -1;">
      <span class="profil-field-title">Fokus Keahlian Bimbingan &amp; Spesialisasi</span>
      <span class="profil-field-val" style="font-weight: 500; color: var(--c-text-body); line-height: 1.5;">
        {{ $psikolog->spesialisasi ?? 'Asesmen Minat Bakat Remaja, Penjurusan Perguruan Tinggi SNBP/SNBT, Validasi Kesiapan Mental Akademik, dan Pemetaan Potensi Karier.' }}
      </span>
    </div>

  </div>

  <!-- EDIT MODE FORM -->
  <form id="profilEditForm" action="{{ route('psikolog.profil.update') }}" method="POST" style="display: none;">
    @csrf
    @method('PUT')
    <div class="info-grid-two-cols" style="gap: 16px;">
      
      <div class="form-input-group">
        <label class="form-label-custom">Nama Lengkap &amp; Gelar</label>
        <input type="text" name="nama" class="form-control-custom" value="{{ $psikolog->nama ?? '' }}" required>
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">Email Resmi</label>
        <input type="email" name="email" class="form-control-custom" value="{{ $psikolog->email ?? '' }}" required>
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">Nomor SIP</label>
        <input type="text" name="no_sip" class="form-control-custom" value="{{ $psikolog->no_sip ?? '' }}" placeholder="Contoh: 8829/PSI/2020">
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">No. Kontak WhatsApp Bimbingan</label>
        <input type="text" name="no_telepon" class="form-control-custom" value="{{ $psikolog->no_telepon ?? '' }}" placeholder="Contoh: 081298765432">
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">Pendidikan Terakhir</label>
        <input type="text" name="pendidikan_terakhir" class="form-control-custom" value="{{ $psikolog->pendidikan_terakhir ?? '' }}" placeholder="Contoh: Magister Psikologi Profesi — Universitas Indonesia">
      </div>

      <div class="form-input-group">
        <label class="form-label-custom">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control-custom">
          <option value="">Pilih Jenis Kelamin</option>
          <option value="Laki-laki" {{ ($psikolog->jenis_kelamin === 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ ($psikolog->jenis_kelamin === 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="form-input-group" style="grid-column: 1 / -1;">
        <label class="form-label-custom">Fokus Keahlian / Bio Profesional</label>
        <textarea name="spesialisasi" class="form-control-custom" rows="3">{{ $psikolog->spesialisasi ?? '' }}</textarea>
      </div>

    </div>

    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--c-border-light);">
      <button type="button" class="btn-secondary-link" onclick="window.toggleEditProfil()">Batal</button>
      <button type="submit" class="btn-primary-action">Simpan Perubahan</button>
    </div>
  </form>

</div>

@endsection

@push('scripts')
<script>
  window.toggleEditProfil = function() {
    const disp = document.getElementById('profilDisplayGroup');
    const form = document.getElementById('profilEditForm');
    const btn = document.getElementById('btnToggleEditProfil');

    if (form.style.display === 'none') {
      disp.style.display = 'none';
      form.style.display = 'block';
      if (btn) btn.style.display = 'none';
    } else {
      disp.style.display = 'grid';
      form.style.display = 'none';
      if (btn) btn.style.display = 'inline-flex';
    }
  };
</script>
@endpush
