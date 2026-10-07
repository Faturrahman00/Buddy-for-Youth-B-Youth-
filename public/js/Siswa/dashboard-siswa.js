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
      const submitBtn = bookingForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'Memproses Jadwal...';

      setTimeout(() => {
        alert('Jadwal konsultasi berhasil diajukan! Anda akan menerima konfirmasi via WhatsApp & Notifikasi Portal.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        closeModal(modalBooking);
      }, 800);
    });
  }

  console.log('B-Youth Student Dashboard loaded successfully.');
});
