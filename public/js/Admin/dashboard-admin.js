document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Sidebar Toggle (Open, Close, Overlay & Touch Swipe)
  const menuToggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');

  function openSidebar() {
    if (sidebar) {
      sidebar.classList.add('open', 'active', 'mobile-open');
      if (sidebarOverlay) {
        sidebarOverlay.classList.add('active', 'open');
      }
      document.body.style.overflow = 'hidden';
    }
  }

  function closeSidebar() {
    if (sidebar) {
      sidebar.classList.remove('open', 'active', 'mobile-open');
      if (sidebarOverlay) {
        sidebarOverlay.classList.remove('active', 'open');
      }
      document.body.style.overflow = '';
    }
  }

  if (menuToggle) {
    menuToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      openSidebar();
    });
  }

  if (sidebarCloseBtn) {
    sidebarCloseBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      closeSidebar();
    });
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', closeSidebar);
  }

  // Touch Swipe to close on mobile
  let touchStartX = 0;
  let touchEndX = 0;
  if (sidebar) {
    sidebar.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    sidebar.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      if (touchStartX - touchEndX > 50) {
        closeSidebar();
      }
    }, { passive: true });
  }

  // Close sidebar on mobile when navigating via nav item
  document.querySelectorAll('.sidebar-nav .nav-item').forEach(item => {
    item.addEventListener('click', () => {
      if (window.innerWidth <= 900) {
        closeSidebar();
      }
    });
  });

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
      const submitBtn = bookingForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'Memproses Jadwal...';

      setTimeout(() => {
        window.byouthAlert({
          title: 'Pengajuan Berhasil',
          text: 'Jadwal konsultasi berhasil diajukan! Konfirmasi akan dikirim via WhatsApp & Notifikasi Portal.',
          icon: 'success',
          confirmText: 'Selesai'
        });
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        closeModal(modalBooking);
      }, 800);
    });
  }

  console.log('B-Youth Student Dashboard loaded successfully.');
});
