/**
 * profil.js — Inline edit mode for profil siswa page
 */
(function () {
  'use strict';

  const editableFields = ['Nama', 'Email', 'JK', 'Sekolah', 'Kelas'];

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
    const doSave = () => {
      editableFields.forEach(f => {
        const disp = document.getElementById('display' + f);
        const inp  = document.getElementById('input' + f);
        if (disp && inp) {
          disp.textContent = inp.tagName === 'SELECT'
            ? inp.options[inp.selectedIndex].text
            : inp.value;
          disp.style.display = 'block';
          inp.style.display = 'none';
        }
      });

      // Update avatar initials & header name
      const namaVal = document.getElementById('inputNama')?.value.trim();
      if (namaVal) {
        const headerName = document.querySelector('.profil-header-name');
        if (headerName) headerName.textContent = namaVal;
        const initials = namaVal.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        const avatarEl = document.querySelector('.profil-avatar');
        if (avatarEl) avatarEl.textContent = initials;
      }

      if (editActions) editActions.style.display = 'none';
      btnEdit.style.display = 'inline-flex';

      // Notifikasi Toast Global Berhasil
      if (window.showToastSuccess) {
        window.showToastSuccess('Profil Diperbarui', 'Informasi identitas profil Anda berhasil disimpan.');
      }

      const toast = document.getElementById('profilToast');
      if (toast) {
        toast.style.display = 'flex';
        toast.style.opacity = '1';
        setTimeout(() => { toast.style.opacity = '0'; }, 2500);
        setTimeout(() => { toast.style.display = 'none'; toast.style.opacity = '1'; }, 3000);
      }
    };

    if (window.showGlassLoading) {
      window.showGlassLoading('Menyimpan perubahan profil...', 650, doSave);
    } else {
      doSave();
    }
  };
})();
