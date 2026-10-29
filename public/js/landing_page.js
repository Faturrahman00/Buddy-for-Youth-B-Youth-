    /* ================================================================
       NAVBAR — Scroll effect
       ================================================================ */
    const navbar = document.getElementById('lpNavbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });

    /* ================================================================
       HERO — Auto-slideshow with progress bar
       ================================================================ */
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroSlidesDots = document.querySelectorAll('.hero-slide-dot');
    const heroProgress = document.getElementById('heroProgress');
    let heroCurrentSlide = 0;
    let heroTimer = null;
    const HERO_INTERVAL = 5500; // ms per slide

    function goToHeroSlide(index) {
      heroSlides[heroCurrentSlide].classList.remove('active');
      heroSlidesDots[heroCurrentSlide].classList.remove('active');
      heroSlidesDots[heroCurrentSlide].setAttribute('aria-selected', 'false');
      heroCurrentSlide = (index + heroSlides.length) % heroSlides.length;
      heroSlides[heroCurrentSlide].classList.add('active');
      heroSlidesDots[heroCurrentSlide].classList.add('active');
      heroSlidesDots[heroCurrentSlide].setAttribute('aria-selected', 'true');
      startHeroProgress();
    }

    function startHeroProgress() {
      heroProgress.style.transition = 'none';
      heroProgress.style.width = '0%';
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          heroProgress.style.transition = `width ${HERO_INTERVAL}ms linear`;
          heroProgress.style.width = '100%';
        });
      });
    }

    function startHeroAuto() {
      if (heroTimer) clearInterval(heroTimer);
      heroTimer = setInterval(() => {
        goToHeroSlide(heroCurrentSlide + 1);
      }, HERO_INTERVAL);
    }

    heroSlidesDots.forEach(dot => {
      dot.addEventListener('click', () => {
        const idx = parseInt(dot.dataset.slide);
        goToHeroSlide(idx);
        startHeroAuto();
      });
    });

    startHeroProgress();
    startHeroAuto();

    /* ================================================================
       LATAR BELAKANG — Single-card glassmorphism carousel
       ================================================================ */
    const latarCards = document.querySelectorAll('.latar-card');
    const latarDots  = document.querySelectorAll('.latar-dot');
    const latarCounter = document.getElementById('latarCounter');
    let latarCurrent = 0;
    let latarTimer = null;

    function goToLatar(next, direction) {
      const prev = latarCurrent;
      latarCards[prev].classList.remove('active');
      latarCards[prev].classList.add(direction === 'next' ? 'exit' : 'exit-right');
      latarDots[prev].classList.remove('active');
      latarDots[prev].setAttribute('aria-selected', 'false');

      setTimeout(() => { latarCards[prev].classList.remove('exit', 'exit-right'); }, 600);

      latarCurrent = (next + latarCards.length) % latarCards.length;
      latarCards[latarCurrent].classList.add('active');
      latarDots[latarCurrent].classList.add('active');
      latarDots[latarCurrent].setAttribute('aria-selected', 'true');
      latarCounter.textContent = `${latarCurrent + 1} / ${latarCards.length}`;
    }

    document.getElementById('latarNext').addEventListener('click', () => {
      goToLatar(latarCurrent + 1, 'next');
      if (latarTimer) { clearInterval(latarTimer); startLatarAuto(); }
    });

    document.getElementById('latarPrev').addEventListener('click', () => {
      goToLatar(latarCurrent - 1, 'prev');
      if (latarTimer) { clearInterval(latarTimer); startLatarAuto(); }
    });

    latarDots.forEach(dot => {
      dot.addEventListener('click', () => {
        const idx = parseInt(dot.dataset.latar);
        goToLatar(idx, idx > latarCurrent ? 'next' : 'prev');
        if (latarTimer) { clearInterval(latarTimer); startLatarAuto(); }
      });
    });

    // Keyboard navigation for latar carousel
    document.getElementById('latarCardList').addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') { goToLatar(latarCurrent + 1, 'next'); }
      if (e.key === 'ArrowLeft')  { goToLatar(latarCurrent - 1, 'prev'); }
    });

    function startLatarAuto() {
      latarTimer = setInterval(() => { goToLatar(latarCurrent + 1, 'next'); }, 6000);
    }

    startLatarAuto();

    /* ================================================================
       SCROLL REVEAL — subtle fade-in on scroll
       ================================================================ */
    const revealEls = document.querySelectorAll('.fitur-card, .cara-step, .latar-card-stage');
    const revealObs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.12 });

    revealEls.forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(28px)';
      el.style.transition = 'opacity 0.60s ease, transform 0.60s ease';
      revealObs.observe(el);
    });

    /* ================================================================
       PRODI SECTION — PAGINASI 8 CARD, LIVE SEARCH & MODAL (NO RIASEC)
       ================================================================ */
    const prodiGrid = document.getElementById('prodiGrid');
    const prodiCards = Array.from(document.querySelectorAll('.prodi-card'));
    const prodiSearchInput = document.getElementById('prodiSearchInput');
    const prodiSearchClear = document.getElementById('prodiSearchClear');
    const prodiEmptyState  = document.getElementById('prodiEmptyState');
    const emptyQueryText   = document.getElementById('emptyQueryText');
    const btnResetFilter   = document.getElementById('btnResetProdiFilter');
    
    // Pagination elements
    const topCurrentPage = document.getElementById('topCurrentPage');
    const topTotalPages  = document.getElementById('topTotalPages');
    const topBtnPrev     = document.getElementById('topBtnPrev');
    const topBtnNext     = document.getElementById('topBtnNext');
    const bottomBtnPrev  = document.getElementById('bottomBtnPrev');
    const bottomBtnNext  = document.getElementById('bottomBtnNext');
    const prodiPageNumbers = document.getElementById('prodiPageNumbers');
    const showingRangeText = document.getElementById('showingRangeText');
    const totalCardsText   = document.getElementById('totalCardsText');

    const CARDS_PER_PAGE = 8;
    let currentPage = 1;
    let currentQuery = '';
    let filteredCards = [...prodiCards];

    function updatePagination() {
      // Filter cards by search query
      if (!currentQuery) {
        filteredCards = [...prodiCards];
      } else {
        filteredCards = prodiCards.filter(card => {
          const name = card.dataset.name || '';
          const careers = card.dataset.careers || '';
          const desc = card.dataset.desc || '';
          return name.includes(currentQuery) || careers.includes(currentQuery) || desc.includes(currentQuery);
        });
      }

      const totalItems = filteredCards.length;
      const totalPages = Math.max(1, Math.ceil(totalItems / CARDS_PER_PAGE));

      if (currentPage > totalPages) currentPage = totalPages;
      if (currentPage < 1) currentPage = 1;

      // Handle Empty State
      if (totalItems === 0) {
        prodiCards.forEach(c => c.classList.add('hidden'));
        if (prodiEmptyState) prodiEmptyState.style.display = 'block';
        if (emptyQueryText) emptyQueryText.textContent = currentQuery;
        if (topCurrentPage) topCurrentPage.textContent = '0';
        if (topTotalPages) topTotalPages.textContent = '0';
        if (topBtnPrev) topBtnPrev.disabled = true;
        if (topBtnNext) topBtnNext.disabled = true;
        if (bottomBtnPrev) bottomBtnPrev.disabled = true;
        if (bottomBtnNext) bottomBtnNext.disabled = true;
        if (prodiPageNumbers) prodiPageNumbers.innerHTML = '';
        if (showingRangeText) showingRangeText.textContent = '0';
        if (totalCardsText) totalCardsText.textContent = '0';
        return;
      } else {
        if (prodiEmptyState) prodiEmptyState.style.display = 'none';
      }

      // Hide all, then show only the 8 cards for currentPage
      const startIndex = (currentPage - 1) * CARDS_PER_PAGE;
      const endIndex = Math.min(startIndex + CARDS_PER_PAGE, totalItems);

      prodiCards.forEach(c => c.classList.add('hidden'));
      for (let i = startIndex; i < endIndex; i++) {
        if (filteredCards[i]) {
          filteredCards[i].classList.remove('hidden');
        }
      }

      // Update counters & ranges
      if (topCurrentPage) topCurrentPage.textContent = currentPage;
      if (topTotalPages) topTotalPages.textContent = totalPages;
      if (showingRangeText) showingRangeText.textContent = `${startIndex + 1} - ${endIndex}`;
      if (totalCardsText) totalCardsText.textContent = totalItems;

      // Update button disabled states
      const isFirst = (currentPage === 1);
      const isLast = (currentPage === totalPages);

      if (topBtnPrev) topBtnPrev.disabled = isFirst;
      if (bottomBtnPrev) bottomBtnPrev.disabled = isFirst;
      if (topBtnNext) topBtnNext.disabled = isLast;
      if (bottomBtnNext) bottomBtnNext.disabled = isLast;

      // Render page numbers
      if (prodiPageNumbers) {
        prodiPageNumbers.innerHTML = '';
        for (let p = 1; p <= totalPages; p++) {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = `btn-page-num ${p === currentPage ? 'active' : ''}`;
          btn.textContent = p;
          btn.setAttribute('aria-label', `Halaman ${p}`);
          btn.addEventListener('click', () => {
            if (p !== currentPage) {
              changePage(p, p > currentPage ? 'next' : 'prev');
            }
          });
          prodiPageNumbers.appendChild(btn);
        }
      }
    }

    function changePage(newPage, direction) {
      if (!prodiGrid) {
        currentPage = newPage;
        updatePagination();
        return;
      }

      // Add sliding animation
      prodiGrid.classList.remove('slide-next', 'slide-prev');
      void prodiGrid.offsetWidth; // trigger reflow
      prodiGrid.classList.add(direction === 'next' ? 'slide-next' : 'slide-prev');

      currentPage = newPage;
      updatePagination();

      setTimeout(() => {
        prodiGrid.classList.remove('slide-next', 'slide-prev');
      }, 350);
    }

    // Previous & Next button events
    function prevPage() {
      if (currentPage > 1) {
        changePage(currentPage - 1, 'prev');
      }
    }

    function nextPage() {
      const totalPages = Math.ceil(filteredCards.length / CARDS_PER_PAGE);
      if (currentPage < totalPages) {
        changePage(currentPage + 1, 'next');
      }
    }

    if (topBtnPrev) topBtnPrev.addEventListener('click', prevPage);
    if (bottomBtnPrev) {
      bottomBtnPrev.addEventListener('click', () => {
        prevPage();
        const section = document.getElementById('prodi');
        if (section) section.scrollIntoView({ behavior: 'smooth' });
      });
    }

    if (topBtnNext) topBtnNext.addEventListener('click', nextPage);
    if (bottomBtnNext) {
      bottomBtnNext.addEventListener('click', () => {
        nextPage();
        const section = document.getElementById('prodi');
        if (section) section.scrollIntoView({ behavior: 'smooth' });
      });
    }

    // Touch Swipe support for sliding cards on mobile/tablet
    let touchStartX = 0;
    let touchEndX = 0;
    if (prodiGrid) {
      prodiGrid.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      prodiGrid.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 45) {
          if (diff > 0) {
            nextPage(); // Swiped left -> next
          } else {
            prevPage(); // Swiped right -> prev
          }
        }
      }, { passive: true });
    }

    // Search events
    if (prodiSearchInput) {
      prodiSearchInput.addEventListener('input', (e) => {
        currentQuery = e.target.value.trim().toLowerCase();
        if (prodiSearchClear) {
          prodiSearchClear.style.display = currentQuery ? 'flex' : 'none';
        }
        currentPage = 1;
        updatePagination();
      });
    }

    if (prodiSearchClear) {
      prodiSearchClear.addEventListener('click', () => {
        prodiSearchInput.value = '';
        currentQuery = '';
        prodiSearchClear.style.display = 'none';
        prodiSearchInput.focus();
        currentPage = 1;
        updatePagination();
      });
    }

    // Reset button in empty state
    if (btnResetFilter) {
      btnResetFilter.addEventListener('click', () => {
        if (prodiSearchInput) prodiSearchInput.value = '';
        currentQuery = '';
        if (prodiSearchClear) prodiSearchClear.style.display = 'none';
        currentPage = 1;
        updatePagination();
      });
    }

    // Mobile nav toggle
    const menuToggle = document.getElementById('menuToggle');
    const lpNavLinks = document.querySelector('.lp-nav-links');
    if (menuToggle && lpNavLinks) {
      menuToggle.addEventListener('click', () => {
        lpNavLinks.classList.toggle('mobile-open');
      });
    }

    // Modal detail prodi logic (No RIASEC, No Kode Prodi)
    window.openProdiModal = function(prodi) {
      const modal = document.getElementById('prodiModalOverlay');
      if (!modal) return;

      const titleEl = document.getElementById('modalProdiTitle');
      const descEl = document.getElementById('modalProdiDesc');
      const careersListEl = document.getElementById('modalCareersList');

      if (titleEl) titleEl.textContent = prodi.nama_prodi || '';
      if (descEl) descEl.textContent = prodi.deskripsi_prodi || prodi.deskripsi || 'Deskripsi belum tersedia.';

      // Careers list
      if (careersListEl) {
        careersListEl.innerHTML = '';
        const careerItems = (prodi.prospek_karier || '').split(',').map(c => c.trim()).filter(Boolean);
        if (careerItems.length > 0) {
          careerItems.forEach(c => {
            const chip = document.createElement('span');
            chip.className = 'modal-career-chip';
            chip.textContent = c;
            careersListEl.appendChild(chip);
          });
        } else {
          careersListEl.innerHTML = '<span class="modal-career-chip">Peluang karier luas di berbagai bidang</span>';
        }
      }

      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    };

    function closeProdiModal() {
      const modal = document.getElementById('prodiModalOverlay');
      if (!modal) return;
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    const modalCloseBtn = document.getElementById('prodiModalClose');
    const btnModalCancel = document.getElementById('btnModalCancel');
    const modalOverlay = document.getElementById('prodiModalOverlay');

    if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeProdiModal);
    if (btnModalCancel) btnModalCancel.addEventListener('click', closeProdiModal);
    if (modalOverlay) {
      modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) closeProdiModal();
      });
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeProdiModal();
    });

    // Run initial pagination to show first 8 cards
    updatePagination();
