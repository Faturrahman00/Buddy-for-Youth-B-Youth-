/**
 * profil.js — Inline edit mode for profil siswa page with Backend API integration
 */
(function () {
  'use strict';

  const editableFields = ['Nama', 'Email', 'JK', 'Sekolah', 'Kelas', 'Telepon'];

  const btnEdit = document.getElementById('btnEditProfil');
  const editActions = document.getElementById('profilEditActions');

  if (!btnEdit) return;

  btnEdit.addEventListener('click', enterEditMode);

  function enterEditMode() {
    editableFields.forEach(f => {
      const disp = document.getElementById('display' + f);
      const inp  = document.getElementById('input' + f);
      if (disp && inp) { disp.style.display = 'none'; inp.style.display = 'block'; }
    });
    if (editActions) editActions.style.display = 'flex';
    btnEdit.style.display = 'none';
  }

  window.cancelEditProfil = function () {
    editableFields.forEach(f => {
      const disp = document.getElementById('display' + f);
      const inp  = document.getElementById('input' + f);
      if (disp && inp) { disp.style.display = 'block'; inp.style.display = 'none'; }
    });
    if (editActions) editActions.style.display = 'none';
    btnEdit.style.display = 'inline-flex';
  };

  window.showProfilSaved = function () {
    const nama = document.getElementById('inputNama')?.value.trim();
    const email = document.getElementById('inputEmail')?.value.trim();
    const jk = document.getElementById('inputJK')?.value;
    const sekolah = document.getElementById('inputSekolah')?.value.trim();
    const kelas = document.getElementById('inputKelas')?.value.trim();
    const telepon = document.getElementById('inputTelepon')?.value.trim();

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
      || document.querySelector('input[name="_token"]')?.value;

    const doSave = () => {
      fetch('/siswa/profil', {
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
          jenis_kelamin: jk,
          sekolah: sekolah,
          kelas: kelas,
          no_telepon: telepon,
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
        // Perbarui teks tampilan di profil
        if (document.getElementById('displayNama')) document.getElementById('displayNama').textContent = res.data.nama;
        if (document.getElementById('displayEmail')) document.getElementById('displayEmail').textContent = res.data.email;
        if (document.getElementById('displayJK')) document.getElementById('displayJK').textContent = res.data.jenis_kelamin || 'Belum diatur';
        if (document.getElementById('displaySekolah')) document.getElementById('displaySekolah').textContent = res.data.sekolah;
        if (document.getElementById('displayKelas')) document.getElementById('displayKelas').textContent = res.data.kelas;
        if (document.getElementById('displayTelepon')) document.getElementById('displayTelepon').textContent = res.data.no_telepon || 'Belum diatur';

        // Perbarui header card profil
        const headerName = document.querySelector('.profil-header-name');
        if (headerName) headerName.textContent = res.data.nama;
        const headerEmail = document.querySelector('.profil-header-email');
        if (headerEmail) headerEmail.textContent = res.data.email;
        const avatarEl = document.querySelector('.profil-avatar');
        if (avatarEl) avatarEl.textContent = res.data.initials;

        // Perbarui topbar navbar (jika ada)
        const topbarName = document.querySelector('.user-name-small');
        if (topbarName) topbarName.textContent = res.data.nama;
        const topbarRole = document.querySelector('.user-role-small');
        if (topbarRole) topbarRole.textContent = res.data.kelas;
        const topbarAvatar = document.querySelector('.avatar-box');
        if (topbarAvatar) topbarAvatar.textContent = res.data.initials;

        // Keluar dari edit mode
        editableFields.forEach(f => {
          const disp = document.getElementById('display' + f);
          const inp  = document.getElementById('input' + f);
          if (disp && inp) { disp.style.display = 'block'; inp.style.display = 'none'; }
        });

        if (editActions) editActions.style.display = 'none';
        btnEdit.style.display = 'inline-flex';

        // Tampilkan notifikasi berhasil
        if (window.showToastSuccess) {
          window.showToastSuccess('Profil Diperbarui', 'Data profil Anda berhasil disimpan ke database.');
        } else {
          const toast = document.getElementById('profilToast');
          if (toast) {
            toast.style.display = 'flex';
            toast.style.opacity = '1';
            setTimeout(() => { toast.style.opacity = '0'; }, 2500);
            setTimeout(() => { toast.style.display = 'none'; toast.style.opacity = '1'; }, 3000);
          }
        }
      })
      .catch(err => {
        if (window.byouthAlert) {
          window.byouthAlert({
            title: 'Gagal Menyimpan',
            text: err.message || 'Terjadi kesalahan saat menyimpan profil ke server.',
            icon: 'error'
          });
        } else {
          alert(err.message || 'Terjadi kesalahan saat menyimpan profil.');
        }
      });
    };

    if (window.showGlassLoading) {
      window.showGlassLoading('Menyimpan perubahan profil...', 500, doSave);
    } else {
      doSave();
    }
  };
})();
