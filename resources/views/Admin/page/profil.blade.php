@extends('Admin.layout.app')

@section('content')
@php
    $pageTitle = 'Profil';
    $active = 'profil';
@endphp

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/Admin/profil-admin.css') }}">
@endpush

<div class="page-top-action-bar">
  <div class="page-title-wrap">
    <h2>
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
      Profil
    </h2>
    <p>Data identitas dan informasi akun admin kamu di B-Youth.</p>
  </div>
</div>

{{-- ── PROFILE HEADER CARD ── --}}
<div class="profil-header-card">
  <div class="profil-header-left">
    <div class="profil-avatar-wrap">
      <div class="profil-avatar">AD</div>
      <span class="profil-avatar-status" title="Akun Aktif"></span>
    </div>
    <div class="profil-header-info">
      <h3 class="profil-header-name">Super Admin B-Youth</h3>
      <p class="profil-header-email">admin@byouth.id</p>
      <span class="profil-header-badge" style="background: var(--c-amber-light); color: #7a5400;">Admin (Akses Penuh)</span>
    </div>
  </div>
  <div class="profil-header-actions">
    <button type="button" class="btn-profil-edit" id="btnEditProfil"
      onclick="document.querySelector('.profil-info-card form').querySelector('input:not([readonly])').focus()">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
      </svg>
      Edit Profil
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

  <form onsubmit="event.preventDefault(); showProfilSaved();">
    <div class="profil-info-grid">

      <div class="profil-field-group">
        <label class="profil-field-label">Nama Lengkap</label>
        <div class="profil-field-value" id="displayNama">Super Admin B-Youth</div>
        <input type="text" class="profil-field-input" id="inputNama" value="Super Admin B-Youth" style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Email</label>
        <div class="profil-field-value" id="displayEmail">admin@byouth.id</div>
        <input type="email" class="profil-field-input" id="inputEmail" value="admin@byouth.id" style="display:none;">
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Role</label>
        <div class="profil-field-value">
          <span style="font-weight: 700; color: var(--c-text-heading);">Admin (Akses Penuh)</span>
        </div>
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Jenis Kelamin</label>
        <div class="profil-field-value">-</div>
      </div>

      <div class="profil-field-group">
        <label class="profil-field-label">Bergabung Sejak</label>
        <div class="profil-field-value">
          <span style="font-weight: 700; color: var(--c-text-heading);">01 Januari 2026</span>
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
  <script src="{{ asset('js/Admin/profil-admin.js') }}"></script>
@endpush
