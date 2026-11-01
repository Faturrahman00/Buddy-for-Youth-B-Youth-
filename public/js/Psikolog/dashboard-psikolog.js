/**
 * B-YOUTH: INTERACTIVE SCRIPTS FOR PSIKOLOG PORTAL
 * File: public/js/Psikolog/dashboard-psikolog.js
 */

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

  // Close sidebar & modals on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeSidebar();
      closeAllModals();
    }
  });

  // 2. Generic Modal Management
  function openModalById(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeModalById(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  function closeAllModals() {
    document.querySelectorAll('.modal-overlay-custom').forEach(modal => {
      modal.classList.remove('active');
    });
    document.body.style.overflow = '';
  }

  // Trigger buttons with data-open-modal
  document.querySelectorAll('[data-open-modal]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const modalId = btn.getAttribute('data-open-modal');
      openModalById(modalId);
    });
  });

  // Close buttons with data-close-modal
  document.querySelectorAll('[data-close-modal]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const modalId = btn.getAttribute('data-close-modal');
      closeModalById(modalId);
    });
  });

  // Close when clicking overlay backdrop
  document.querySelectorAll('.modal-overlay-custom').forEach(modal => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  });

  // Global Toast Notification Helper
  window.showToast = function(message, duration = 3000) {
    let toast = document.getElementById('toastNotice');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'toastNotice';
      toast.className = 'toast-notice';
      document.body.appendChild(toast);
    }
    toast.innerHTML = `
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>${message}</span>
    `;
    toast.classList.add('show');
    setTimeout(() => {
      toast.classList.remove('show');
    }, duration);
  };
});
