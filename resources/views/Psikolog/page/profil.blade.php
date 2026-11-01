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
     TOP CARD: PROFIL HEADER (UNIFIED DESIGN WITH SISWA)
     ========================================================================= -->
<div class="profil-header-card">
  <div class="profil-header-left">
    <div class="profil-avatar-wrap">
      <div class="profil-avatar">{{ $initials }}</div>
      <span class="profil-avatar-status" title="Akun Aktif & Terverifikasi"></span>
    </div>
    <div class="profil-header-info">
      <h3 class="profil-header-name" id="headerNamaDisplay">{{ $psikolog->nama ?? '-' }}</h3>
      <p class="profil-header-email" id="headerEmailDisplay">{{ $psikolog->email ?? '-' }}</p>
      <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <span class="profil-header-badge">Psikolog Konselor</span>
        @if(!empty($psikolog->no_sip))
          <span class="profil-header-badge" id="headerSipBadge" style="background:rgba(255,255,255,0.18); border-color:rgba(255,255,255,0.35); color:#fff;">
            SIP: {{ $psikolog->no_sip }}
          </span>
        @endif
        <span class="profil-status-active" style="color:#A6F4C5; font-size:12px; font-weight:700;">
          <span class="profil-status-dot" style="background:#A6F4C5;"></span>
          Aktif
        </span>
      </div>
    </div>
  </div>

  <div class="profil-header-actions">
    <button type="button" class="btn-profil-edit" id="btnEditProfil" onclick="window.enterEditProfil()">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
      </svg>
      <span>Ubah Profil</span>
    </button>
  </div>
</div>

<!-- =========================================================================
     BOTTOM CARD: INFORMASI PENGGUNA & KREDENSIAL PRAKTIK
     ========================================================================= -->
<div class="profil-info-card">
  <div class="profil-info-header">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--c-primary)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
      <circle cx="12" cy="7" r="4"></circle>
    </svg>
    <span>Informasi Pengguna &amp; Kredensial Praktik Psikolog</span>
  </div>

  <form id="formProfilPsikolog" action="{{ route('psikolog.profil.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="profil-info-grid">

      <!-- Nama Lengkap -->
      <div class="profil-field-group">
        <label class="profil-field-label">Nama Lengkap &amp; Gelar</label>
        <div class="profil-field-value" id="displayNama">{{ $psikolog->nama ?? '-' }}</div>
        <input type="text" name="nama" class="profil-field-input" id="inputNama" value="{{ $psikolog->nama ?? '' }}" required style="display:none;">
      </div>

      <!-- Email Resmi -->
      <div class="profil-field-group">
        <label class="profil-field-label">Email Resmi</label>
        <div class="profil-field-value" id="displayEmail">{{ $psikolog->email ?? '-' }}</div>
        <input type="email" name="email" class="profil-field-input" id="inputEmail" value="{{ $psikolog->email ?? '' }}" required style="display:none;">
      </div>

      <!-- Role Akun -->
      <div class="profil-field-group">
        <label class="profil-field-label">Peran</label>
        <div class="profil-field-value">
          <span class="profil-role-tag">Psikolog Pendidikan &amp; Karier</span>
        </div>
      </div>

      <!-- Nomor SIP -->
      <div class="profil-field-group">
        <label class="profil-field-label">Nomor SIP Psikolog</label>
        <div class="profil-field-value" id="displaySip">{{ $psikolog->no_sip ?? '-' }}</div>
        <input type="text" name="no_sip" class="profil-field-input" id="inputSip" value="{{ $psikolog->no_sip ?? '' }}" placeholder="Contoh: 8829/PSI/2020" style="display:none;">
      </div>

      <!-- Jenis Kelamin -->
      <div class="profil-field-group">
        <label class="profil-field-label">Jenis Kelamin</label>
        <div class="profil-field-value" id="displayJK">{{ $psikolog->jenis_kelamin ?? 'Belum diatur' }}</div>
        <select name="jenis_kelamin" class="profil-field-input" id="inputJK" style="display:none;">
          <option value="" {{ empty($psikolog->jenis_kelamin) ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
          <option value="Laki-laki" {{ ($psikolog->jenis_kelamin === 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ ($psikolog->jenis_kelamin === 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <!-- Kontak Telepon / WhatsApp -->
      <div class="profil-field-group">
        <label class="profil-field-label">Nomor Kontak WhatsApp</label>
        <div class="profil-field-value" id="displayTelepon">{{ $psikolog->no_telepon ?? 'Belum diatur' }}</div>
        <input type="tel" name="no_telepon" class="profil-field-input" id="inputTelepon" value="{{ $psikolog->no_telepon ?? '' }}" placeholder="Contoh: 081298765432" style="display:none;">
      </div>

      <!-- Pendidikan Terakhir -->
      <div class="profil-field-group">
        <label class="profil-field-label">Pendidikan Terakhir</label>
        <div class="profil-field-value" id="displayPendidikan">{{ $psikolog->pendidikan_terakhir ?? '-' }}</div>
        <input type="text" name="pendidikan_terakhir" class="profil-field-input" id="inputPendidikan" value="{{ $psikolog->pendidikan_terakhir ?? '' }}" placeholder="Contoh: Magister Psikologi Profesi — Universitas Indonesia" style="display:none;">
      </div>

      <!-- Tanggal Bergabung -->
      <div class="profil-field-group">
        <label class="profil-field-label">Bergabung Sejak</label>
        <div class="profil-field-value">{{ $psikolog->created_at ? $psikolog->created_at->translatedFormat('d F Y') : '-' }}</div>
      </div>

      <!-- Status Akun -->
      <div class="profil-field-group">
        <label class="profil-field-label">Status Praktik</label>
        <div class="profil-field-value">
          <span class="profil-status-active">
            <span class="profil-status-dot"></span>
            {{ $psikolog->status ?? 'Aktif' }}
          </span>
        </div>
      </div>

      <!-- Fokus Keahlian & Spesialisasi (Full Width) -->
      <div class="profil-field-group full-width">
        <label class="profil-field-label">Fokus Keahlian &amp; Bio Profesional</label>
        <div class="profil-field-value" id="displaySpesialisasi" style="font-weight: 500; color: var(--c-text-body); line-height: 1.6;">
          {{ $psikolog->spesialisasi ?? 'Asesmen Minat Bakat Remaja, Penjurusan Perguruan Tinggi SNBP/SNBT, Validasi Kesiapan Mental Akademik, dan Pemetaan Potensi Karier.' }}
        </div>
        <textarea name="spesialisasi" class="profil-field-input" id="inputSpesialisasi" rows="3" placeholder="Tuliskan fokus keahlian psikologis atau bidang spesialisasi bimbingan Anda..." style="display:none;">{{ $psikolog->spesialisasi ?? '' }}</textarea>
      </div>

    </div>

    <!-- Edit Mode Actions Bar -->
    <div class="profil-edit-actions" id="profilEditActions" style="display:none;">
      <button type="submit" class="btn-primary-action" style="font-size:13px; padding:9px 22px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        Simpan Perubahan
      </button>
      <button type="button" class="btn-profil-secondary" onclick="window.cancelEditProfil()">Batal</button>
    </div>
  </form>
</div>

@endsection

@push('scripts')
<script>
  const editableFields = ['Nama', 'Email', 'Sip', 'JK', 'Telepon', 'Pendidikan', 'Spesialisasi'];
  const btnEdit = document.getElementById('btnEditProfil');
  const editActions = document.getElementById('profilEditActions');
  const formProfil = document.getElementById('formProfilPsikolog');

  window.enterEditProfil = function() {
    editableFields.forEach(f => {
      const disp = document.getElementById('display' + f);
      const inp  = document.getElementById('input' + f);
      if (disp && inp) {
        disp.style.display = 'none';
        inp.style.display = 'block';
      }
    });
    if (editActions) editActions.style.display = 'flex';
    if (btnEdit) btnEdit.style.display = 'none';
  };

  window.cancelEditProfil = function() {
    editableFields.forEach(f => {
      const disp = document.getElementById('display' + f);
      const inp  = document.getElementById('input' + f);
      if (disp && inp) {
        disp.style.display = '';
        inp.style.display = 'none';
      }
    });
    if (editActions) editActions.style.display = 'none';
    if (btnEdit) btnEdit.style.display = 'inline-flex';
  };

  if (formProfil) {
    formProfil.addEventListener('submit', function(e) {
      e.preventDefault();

      const nama = document.getElementById('inputNama')?.value.trim();
      const email = document.getElementById('inputEmail')?.value.trim();
      const no_sip = document.getElementById('inputSip')?.value.trim();
      const jenis_kelamin = document.getElementById('inputJK')?.value;
      const no_telepon = document.getElementById('inputTelepon')?.value.trim();
      const pendidikan_terakhir = document.getElementById('inputPendidikan')?.value.trim();
      const spesialisasi = document.getElementById('inputSpesialisasi')?.value.trim();

      const csrfToken = document.querySelector('input[name="_token"]')?.value;

      fetch('{{ route("psikolog.profil.update") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          _method: 'PUT',
          nama: nama,
          email: email,
          no_sip: no_sip,
          jenis_kelamin: jenis_kelamin,
          no_telepon: no_telepon,
          pendidikan_terakhir: pendidikan_terakhir,
          spesialisasi: spesialisasi,
        })
      })
      .then(async response => {
        const data = await response.json();
        if (!response.ok) {
          throw new Error(data.message || 'Gagal menyimpan profil.');
        }
        return data;
      })
      .then(res => {
        // Update display text values
        if (document.getElementById('displayNama')) document.getElementById('displayNama').textContent = res.data.nama;
        if (document.getElementById('displayEmail')) document.getElementById('displayEmail').textContent = res.data.email;
        if (document.getElementById('displaySip')) document.getElementById('displaySip').textContent = res.data.no_sip || '-';
        if (document.getElementById('displayJK')) document.getElementById('displayJK').textContent = res.data.jenis_kelamin || 'Belum diatur';
        if (document.getElementById('displayTelepon')) document.getElementById('displayTelepon').textContent = res.data.no_telepon || 'Belum diatur';
        if (document.getElementById('displayPendidikan')) document.getElementById('displayPendidikan').textContent = res.data.pendidikan_terakhir || '-';
        if (document.getElementById('displaySpesialisasi')) document.getElementById('displaySpesialisasi').textContent = res.data.spesialisasi || 'Asesmen Minat Bakat Remaja, Penjurusan Perguruan Tinggi SNBP/SNBT, Validasi Kesiapan Mental Akademik, dan Pemetaan Potensi Karier.';

        // Update header card
        if (document.getElementById('headerNamaDisplay')) document.getElementById('headerNamaDisplay').textContent = res.data.nama;
        if (document.getElementById('headerEmailDisplay')) document.getElementById('headerEmailDisplay').textContent = res.data.email;
        
        const sipBadge = document.getElementById('headerSipBadge');
        if (sipBadge) {
          if (res.data.no_sip) {
            sipBadge.textContent = 'SIP: ' + res.data.no_sip;
            sipBadge.style.display = 'inline-block';
          } else {
            sipBadge.style.display = 'none';
          }
        }

        // Close edit mode
        window.cancelEditProfil();

        if (window.showAppToast) {
          window.showAppToast('Profil psikolog berhasil diperbarui!', 'success');
        } else {
          alert('Profil psikolog berhasil diperbarui!');
        }
      })
      .catch(err => {
        alert(err.message || 'Terjadi kesalahan saat menyimpan profil.');
      });
    });
  }
</script>
@endpush
