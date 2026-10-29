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
      position: 'bottom-end',
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

  /* ==========================================================================
     GLOBAL B-YOUTH GLASS PRELOADER & LOADING CONTROLLER
     ========================================================================== */

  let hideLoadingTimeout = null;

  window.showGlassLoading = function (message = 'Memproses data...', duration = 0, callback = null) {
    if (hideLoadingTimeout) {
      clearTimeout(hideLoadingTimeout);
      hideLoadingTimeout = null;
    }

    const overlay = document.getElementById('glassLoadingOverlay');
    const textEl = document.getElementById('glassLoadingText');

    if (!overlay) {
      if (callback && typeof callback === 'function') setTimeout(callback, duration || 0);
      return;
    }

    if (textEl && message) {
      textEl.textContent = message;
    }

    overlay.classList.remove('fade-out', 'hidden-overlay');
    overlay.classList.add('active');
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    if (duration > 0) {
      setTimeout(() => {
        window.hideGlassLoading();
        if (typeof callback === 'function') {
          callback();
        }
      }, duration);
    }
  };

  window.hideGlassLoading = function () {
    const overlay = document.getElementById('glassLoadingOverlay');
    if (!overlay || overlay.classList.contains('hidden-overlay')) return;

    overlay.classList.add('fade-out');
    overlay.classList.remove('active');

    if (hideLoadingTimeout) clearTimeout(hideLoadingTimeout);
    hideLoadingTimeout = setTimeout(() => {
      overlay.classList.add('hidden-overlay');
      overlay.style.display = 'none';
      document.body.style.overflow = '';
      hideLoadingTimeout = null;
    }, 350);
  };

  // 1. Dismiss preloader when page finishes loading (images, scripts, styles ready)
  window.addEventListener('load', function () {
    const overlay = document.getElementById('glassLoadingOverlay');
    if (overlay) {
      // Small buffer (250ms) ensures complete visual paint and smooth fade
      setTimeout(function () {
        window.hideGlassLoading();
      }, 250);
    }
  });

  // 2. Dismiss preloader when navigated from browser bfcache (Back/Forward)
  window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
      window.hideGlassLoading();
    }
  });

  // 3. Fallback safety timer: in case external CDN hangs, unlock page after 3.5s
  setTimeout(function () {
    const overlay = document.getElementById('glassLoadingOverlay');
    if (overlay && !overlay.classList.contains('hidden-overlay')) {
      window.hideGlassLoading();
    }
  }, 3500);

  // 4. Form submission transition: show loader when submitting forms
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {
      form.addEventListener('submit', function () {
        if (!form.hasAttribute('data-no-loader') && !form.classList.contains('no-loader')) {
          const actionText = form.getAttribute('data-loading-text') || 'Memproses data...';
          window.showGlassLoading(actionText, 0);
        }
      });
    });
  });
})();
