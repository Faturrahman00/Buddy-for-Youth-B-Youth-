document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Sidebar Toggle
  const menuToggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');
  const sidebarOverlay = document.getElementById('sidebarOverlay');

  function openSidebar() {
    if (sidebar && sidebarOverlay) {
      sidebar.classList.add('open');
      sidebarOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeSidebar() {
    if (sidebar && sidebarOverlay) {
      sidebar.classList.remove('open');
      sidebarOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  if (menuToggle) {
    menuToggle.addEventListener('click', openSidebar);
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', closeSidebar);
  }

  // Close sidebar on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeSidebar();
      closeAllModals();
    }
  });

  // 2. Modal Management
  const modalBooking = document.getElementById('modalBooking');
  const modalAsesmen = document.getElementById('modalAsesmen');
  const modalLogout = document.getElementById('modalLogout');

  function openModal(modal) {
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeModal(modal) {
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  function closeAllModals() {
    document.querySelectorAll('.modal-overlay').forEach(modal => {
      closeModal(modal);
    });
  }

  // Booking buttons trigger
  const btnBooking = document.querySelectorAll('.btn-trigger-booking');
  btnBooking.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(modalBooking);
    });
  });

  // Asesmen buttons trigger
  const btnAsesmen = document.querySelectorAll('.btn-trigger-asesmen');
  btnAsesmen.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(modalAsesmen);
    });
  });

  // Logout button trigger
  const btnLogout = document.getElementById('btnLogoutTrigger');
  if (btnLogout) {
    btnLogout.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(modalLogout);
    });
  }

  // Close button in all modals
  document.querySelectorAll('.modal-close-trigger').forEach(btn => {
    btn.addEventListener('click', () => {
      const modal = btn.closest('.modal-overlay');
      closeModal(modal);
    });
  });

  // Close modal when clicking outside box
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        closeModal(overlay);
      }
    });
  });

  // 3. Simple Form submission simulations
  const bookingForm = document.getElementById('bookingConsultationForm');
  if (bookingForm) {
    bookingForm.addEventListener('submit', (e) => {
      e.preventDefault();
      closeModal(modalBooking);

      window.showGlassLoading('Menjadwalkan Konsultasi...', 850, () => {
        alert('Jadwal konsultasi berhasil diajukan! Anda akan menerima konfirmasi via WhatsApp.');
      });
    });
  }

  console.log('B-Youth Student Dashboard loaded successfully.');
});

// Global Glassmorphism Loading Helper
window.showGlassLoading = function(message = 'Memproses data...', duration = 800, callback = null) {
  const overlay = document.getElementById('glassLoadingOverlay');
  const textEl = document.getElementById('glassLoadingText');

  if (!overlay) {
    if (callback) setTimeout(callback, duration);
    return;
  }

  if (textEl && message) {
    textEl.textContent = message;
  }

  overlay.classList.add('active');
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

window.hideGlassLoading = function() {
  const overlay = document.getElementById('glassLoadingOverlay');
  if (overlay) {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  }
};

// Global Glassmorphism Toast Helpers (Berhasil & Gagal)
window.showToast = function(type, title, message, duration = 3500) {
  const container = document.getElementById('appToastContainer');
  if (!container) return;

  const isSuccess = type === 'success';
  const toast = document.createElement('div');
  toast.className = `app-toast toast-${type}`;

  const iconSvg = isSuccess
    ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>`
    : `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`;

  toast.innerHTML = `
    <div class="app-toast-icon">${iconSvg}</div>
    <div class="app-toast-content">
      <div class="app-toast-title">${title}</div>
      <div class="app-toast-message">${message}</div>
    </div>
    <button type="button" class="app-toast-close" aria-label="Tutup notifikasi">&times;</button>
  `;

  const closeBtn = toast.querySelector('.app-toast-close');
  const removeToast = () => {
    toast.classList.remove('active');
    setTimeout(() => toast.remove(), 350);
  };

  closeBtn.addEventListener('click', removeToast);

  container.appendChild(toast);
  requestAnimationFrame(() => toast.classList.add('active'));

  if (duration > 0) {
    setTimeout(removeToast, duration);
  }
};

window.showToastSuccess = function(title = 'Berhasil!', message = 'Operasi berhasil dilakukan.') {
  window.showToast('success', title, message);
};

window.showToastError = function(title = 'Gagal!', message = 'Terjadi kesalahan pada input data.') {
  window.showToast('error', title, message);
};


