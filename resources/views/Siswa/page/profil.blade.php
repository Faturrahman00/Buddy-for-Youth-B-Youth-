{{--
  B-YOUTH: PROFIL SISWA PAGE
  File: resources/views/Siswa/page/profil.blade.php
  Wireframe: Avatar card + Informasi Pengguna table
--}}
@extends('Siswa.layouts.app', [
    'title'     => 'Profil — Buddy For Youth (B-Youth)',
    'pageTitle' => 'Profil',
    'active'    => 'profil'
])

@php
  $siswa = $siswa ?? (Auth::guard('siswa')->user() ?? Auth::user());
  $initials = strtoupper(substr($siswa->nama ?? 'Siswa', 0, 2));
@endphp

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/Siswa/profil.css') }}">
@endpush

@section('content')
<div class="page-top-action-bar">
  <div class="page-title-wrap">
    <p style="margin:0;">Data identitas dan informasi akun kamu di B-Youth.</p>
  </div>
</div>

{{-- ── PROFILE HEADER CARD ── --}}
<div class="profil-header-card">
  <div class="profil-header-left">
    <div class="profil-avatar-wrap">
      <div class="profil-avatar">{{ $initials }}</div>
      <span class="profil-avatar-status" title="Akun Aktif"></span>
    </div>
    <div class="profil-header-info">
      <h3 class="profil-header-name">{{ $siswa->nama ?? '-' }}</h3>
      <p class="profil-header-email">{{ $siswa->email ?? '-' }}</p>
      <span class="profil-header-badge">{{ ucfirst($siswa->role ?? 'Siswa') }}</span>
    </div>
  </div>
  <div class="profil-header-actions">
    <button type="button" class="btn-profil-edit" id="btnEditProfil">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
      </svg>
      Ubah Profil
    </button>
  </div>
</div>

{{-- ── INFORMASI PENGGUNA CARD ── --}}
<div class="profil-info-card">
  <div class="profil-info-header">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="12" r="10"></circle>
      <line x1="12" y1="16" x2="12" y2="12"></line>
      <line x1="12" y1="8" x2="12.01" y2="8"></line>
    </svg>
    <span>Informasi Pengguna</span>
  </div>

  <form id="formProfil" onsubmit="event.preventDefault(); showProfilSaved();">
    @csrf
    @method('PUT')
    <div class="profil-info-grid">

      <div class="profil-field-group">
        <label class="profil-field-label">Nama Lengkap</label>
        <div class="profil-field-value" id="displayNama">{{ $siswa->nama ?? '-' }}</div>
        <input type="text" class="profil-field-input" id="inputNama" value="{{ $siswa->nama ?? '' }}" required style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Email</label>
        <div class="profil-field-value" id="displayEmail">{{ $siswa->email ?? '-' }}</div>
        <input type="email" class="profil-field-input" id="inputEmail" value="{{ $siswa->email ?? '' }}" required style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Peran</label>
        <div class="profil-field-value">
          <span class="profil-role-tag">{{ ucfirst($siswa->role ?? 'Siswa') }}</span>
        </div>
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Jenis Kelamin</label>
        <div class="profil-field-value" id="displayJK">{{ $siswa->jenis_kelamin ?? 'Belum diatur' }}</div>
        <select class="profil-field-input" id="inputJK" style="display:none;">
          <option value="" {{ empty($siswa->jenis_kelamin) ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
          <option value="Laki-laki" {{ ($siswa->jenis_kelamin === 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ ($siswa->jenis_kelamin === 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Asal Sekolah</label>
        <div class="profil-field-value" id="displaySekolah">{{ $siswa->sekolah ?? '-' }}</div>
        <input type="text" class="profil-field-input" id="inputSekolah" value="{{ $siswa->sekolah ?? '' }}" required style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Kelas</label>
        <div class="profil-field-value" id="displayKelas">{{ $siswa->kelas ?? '-' }}</div>
        <input type="text" class="profil-field-input" id="inputKelas" value="{{ $siswa->kelas ?? '' }}" required style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Nomor Telepon / WhatsApp</label>
        <div class="profil-field-value" id="displayTelepon">{{ $siswa->no_telepon ?? 'Belum diatur' }}</div>
        <input type="tel" class="profil-field-input" id="inputTelepon" value="{{ $siswa->no_telepon ?? '' }}" placeholder="Contoh: 08123456789" style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Bergabung Sejak</label>
        <div class="profil-field-value">{{ $siswa->created_at ? $siswa->created_at->translatedFormat('d F Y') : '-' }}</div>
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Status Akun</label>
        <div class="profil-field-value">
          <span class="profil-status-active">
            <span class="profil-status-dot"></span>
            {{ $siswa->status ?? 'Aktif' }}
          </span>
        </div>
      </div>

    </div>

    {{-- Edit mode save/cancel buttons (hidden by default) --}}
    <div class="profil-edit-actions" id="profilEditActions" style="display:none;">
      <button type="submit" class="btn-primary-action" style="font-size:13px; padding:9px 22px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        Simpan Perubahan
      </button>
      <button type="button" class="btn-profil-secondary" onclick="cancelEditProfil()">Batal</button>
    </div>
  </form>
</div>

{{-- ── SAVED TOAST ── --}}
<div id="profilToast" class="profil-toast" style="display:none;">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
  Profil berhasil disimpan!
</div>

@endsection

@push('scripts')
  <script src="{{ asset('js/Siswa/profil.js') }}"></script>
@endpush
