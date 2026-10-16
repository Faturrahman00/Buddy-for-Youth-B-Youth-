/**
 * byouth-dialog.js
 * Modern SweetAlert2 wrapper & helper for B-Youth application.
 * Replaces ugly browser native prompt(), confirm(), and alert() with gorgeous dialogs.
 */

(function () {
  'use strict';

  // Ensure Swal is loaded
  function getSwal() {
    if (typeof Swal !== 'undefined') {
      return Swal;
    }
    console.warn('SweetAlert2 is not loaded yet.');
    return null;
  }

  /**
   * Show a beautiful alert dialog
   */
  window.byouthAlert = function (options) {
    const swal = getSwal();
    if (!swal) {
      return Promise.resolve();
    }

    const opts = typeof options === 'string' ? { text: options } : (options || {});

    return swal.fire({
      title: opts.title || 'Pemberitahuan',
      html: opts.html || opts.text || '',
      icon: opts.icon || 'info',
      confirmButtonText: opts.confirmText || 'Mengerti',
      buttonsStyling: false,
      customClass: {
        popup: 'byouth-swal-popup',
        title: 'byouth-swal-title',
        htmlContainer: 'byouth-swal-html',
        confirmButton: 'byouth-swal-btn-confirm',
        actions: 'byouth-swal-actions'
      }
    });
  };

  /**
   * Show a beautiful confirm dialog (returns Promise<boolean>)
   */
  window.byouthConfirm = function (options) {
    const swal = getSwal();
    if (!swal) {
      return Promise.resolve(false);
    }

    const opts = typeof options === 'string' ? { text: options } : (options || {});
    const isDanger = Boolean(opts.isDanger);

    return swal.fire({
      title: opts.title || 'Konfirmasi Tindakan',
      html: opts.html || opts.text || '',
      icon: opts.icon || (isDanger ? 'warning' : 'question'),
      showCancelButton: true,
      confirmButtonText: opts.confirmText || (isDanger ? 'Ya, Hapus' : 'Ya, Lanjutkan'),
      cancelButtonText: opts.cancelText || 'Batal',
      reverseButtons: true,
      buttonsStyling: false,
      customClass: {
        popup: 'byouth-swal-popup',
        title: 'byouth-swal-title',
        htmlContainer: 'byouth-swal-html',
        confirmButton: isDanger ? 'byouth-swal-btn-danger' : 'byouth-swal-btn-confirm',
        cancelButton: 'byouth-swal-btn-cancel',
        actions: 'byouth-swal-actions'
      }
    }).then((result) => result.isConfirmed);
  };

  /**
   * Show a beautiful prompt dialog with an input field (returns Promise<string|null>)
   */
  window.byouthPrompt = function (options) {
    const swal = getSwal();
    if (!swal) {
      return Promise.resolve(null);
    }

    const opts = typeof options === 'string' ? { title: options } : (options || {});
    const isDanger = Boolean(opts.isDanger);

    return swal.fire({
      title: opts.title || 'Masukkan Informasi',
      text: opts.text || '',
      input: 'textarea',
      inputPlaceholder: opts.placeholder || 'Tuliskan catatan di sini...',
      inputValue: opts.defaultValue || '',
      showCancelButton: true,
      confirmButtonText: opts.confirmText || 'Kirim',
      cancelButtonText: opts.cancelText || 'Batal',
      reverseButtons: true,
      buttonsStyling: false,
      inputAttributes: {
        rows: 3
      },
      inputValidator: (value) => {
        if (opts.required !== false && (!value || !value.trim())) {
          return 'Alasan atau catatan tidak boleh kosong!';
        }
        return null;
      },
      customClass: {
        popup: 'byouth-swal-popup',
        title: 'byouth-swal-title',
        htmlContainer: 'byouth-swal-html',
        input: 'byouth-swal-input',
        confirmButton: isDanger ? 'byouth-swal-btn-danger' : 'byouth-swal-btn-confirm',
        cancelButton: 'byouth-swal-btn-cancel',
        actions: 'byouth-swal-actions'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        return result.value;
      }
      return null;
    });
  };

  /**
   * Show modern top-end Toast notification
   */
  window.byouthToast = function (options) {
    const swal = getSwal();
    if (!swal) return;

    let icon = 'success';
    let title = '';

    if (typeof options === 'string') {
      title = options;
    } else if (options) {
      icon = options.type || options.icon || 'success';
      title = options.message || options.title || '';
    }

    const Toast = swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: (options && options.duration) ? options.duration : 3200,
      timerProgressBar: true,
      customClass: {
        popup: 'byouth-toast-popup'
      },
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer);
        toast.addEventListener('mouseleave', swal.resumeTimer);
      }
    });

    Toast.fire({
      icon: icon,
      title: title
    });
  };

  // Modernize legacy showToast wrappers if they exist
  window.showToast = function (msg, duration) {
    window.byouthToast({ type: 'success', message: msg, duration: duration });
  };
  window.showToastSuccess = function (title, message) {
    window.byouthToast({ type: 'success', message: `${title ? title + ': ' : ''}${message || ''}` });
  };
  window.showToastError = function (title, message) {
    window.byouthToast({ type: 'error', message: `${title ? title + ': ' : ''}${message || ''}` });
  };

  // Safe fallback for window.alert
  window.alert = function (message) {
    window.byouthAlert({
      title: 'Pemberitahuan',
      text: String(message),
      icon: 'info'
    });
  };

  // Auto-intercept forms with delete confirmation
  function setupConfirmForms() {
    document.querySelectorAll('form').forEach(function (form) {
      const onsubmitAttr = form.getAttribute('onsubmit');
      if (onsubmitAttr && onsubmitAttr.includes('confirm(')) {
        const match = onsubmitAttr.match(/confirm\(['"](.*?)['"]\)/);
        const confirmMessage = match ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';

        form.removeAttribute('onsubmit');
        form.setAttribute('data-byouth-confirm', confirmMessage);
      }
    });
  }

  // Intercept submit clicks at capture phase
  document.addEventListener('click', async function (e) {
    const btn = e.target.closest('button[type="submit"], input[type="submit"]');
    if (!btn) return;
    const form = btn.closest('form');
    if (!form) return;

    let confirmMsg = form.getAttribute('data-byouth-confirm');
    const onsubmitAttr = form.getAttribute('onsubmit');

    if (!confirmMsg && onsubmitAttr && onsubmitAttr.includes('confirm(')) {
      const match = onsubmitAttr.match(/confirm\(['"](.*?)['"]\)/);
      confirmMsg = match ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';
      form.removeAttribute('onsubmit');
    }

    if (confirmMsg) {
      e.preventDefault();
      e.stopImmediatePropagation();

      const confirmed = await window.byouthConfirm({
        title: 'Konfirmasi Penghapusan',
        text: confirmMsg,
        confirmText: 'Ya, Hapus',
        cancelText: 'Batal',
        icon: 'warning',
        isDanger: true
      });

      if (confirmed) {
        form.removeAttribute('data-byouth-confirm');
        form.submit();
      }
    }
  }, true);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupConfirmForms);
  } else {
    setupConfirmForms();
  }
})();
