/**
 * B-YOUTH: INTERACTIVE SCRIPTS FOR SISWA PAGES
 * File: public/js/Siswa/pages-siswa.js
 */

document.addEventListener('DOMContentLoaded', () => {
  // --------------------------------------------------------------------------
  // 1. GENERIC CLIENT-SIDE TABLE SEARCH & FILTERING
  // --------------------------------------------------------------------------
  function setupTableFiltering(searchInputId, filterSelectIds, tableBodyId, resetBtnId) {
    const searchInput = document.getElementById(searchInputId);
    const tableBody = document.getElementById(tableBodyId);
    const resetBtn = document.getElementById(resetBtnId);

    if (!tableBody) return;

    const filterSelects = filterSelectIds.map(id => document.getElementById(id)).filter(Boolean);

    function runFilter() {
      const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
      const rows = tableBody.querySelectorAll('tr[data-searchable]');
      let visibleCount = 0;

      rows.forEach(row => {
        const text = (row.getAttribute('data-searchable') || '').toLowerCase();
        let matchesQuery = query === '' || text.includes(query);

        // Check each select filter
        let matchesFilters = true;
        filterSelects.forEach(sel => {
          const filterKey = sel.getAttribute('data-filter-key');
          const selVal = sel.value;
          if (filterKey && selVal && selVal !== 'all') {
            const rowVal = row.getAttribute(`data-${filterKey}`);
            if (rowVal && rowVal.toLowerCase() !== selVal.toLowerCase()) {
              matchesFilters = false;
            }
          }
        });

        if (matchesQuery && matchesFilters) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Update counter badge if available
      const countBadge = document.querySelector(`[data-count-for="${tableBodyId}"]`);
      if (countBadge) {
        countBadge.textContent = `${visibleCount} Data`;
      }
    }

    if (searchInput) {
      searchInput.addEventListener('input', runFilter);
    }

    filterSelects.forEach(sel => {
      sel.addEventListener('change', runFilter);
    });

    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';
        filterSelects.forEach(sel => { sel.value = 'all'; });
        runFilter();
      });
    }
  }

  // Setup filters for Data Akademik
  setupTableFiltering('searchMapel', ['filterSemester', 'filterKelompok'], 'akademikTableBody', 'btnResetAkademik');

  // Setup filters for Riwayat Asesmen
  setupTableFiltering('searchRiwayatAsesmen', ['filterStatusAsesmen', 'filterPeriodeAsesmen'], 'riwayatAsesmenTableBody', 'btnResetRiwayatAsesmen');

  // Setup filters for Riwayat Konsultasi
  setupTableFiltering('searchRiwayatKonsultasi', ['filterStatusKonsul', 'filterPsikologKonsul'], 'riwayatKonsulTableBody', 'btnResetRiwayatKonsul');


  // --------------------------------------------------------------------------
  // 2. MBTI LIKERT ASSESSMENT PROGRESS & INTERACTION
  // --------------------------------------------------------------------------
  const questionCards = document.querySelectorAll('.mbti-question-card');
  const progressBarFill = document.getElementById('assessmentProgressFill');
  const progressText = document.getElementById('assessmentProgressText');
  const answeredCountEl = document.getElementById('answeredCount');
  const totalQuestions = questionCards.length;

  function updateAssessmentProgress() {
    let answered = 0;
    const answeredQuestions = new Set();

    const checkedRadios = document.querySelectorAll('.likert-radio-input:checked');
    checkedRadios.forEach(radio => {
      answeredQuestions.add(radio.name);
    });
    answered = answeredQuestions.size;

    const percentage = totalQuestions > 0 ? Math.round((answered / totalQuestions) * 100) : 0;

    if (progressBarFill) {
      progressBarFill.style.width = `${percentage}%`;
    }
    if (progressText) {
      progressText.textContent = `${percentage}% Selesai`;
    }
    if (answeredCountEl) {
      answeredCountEl.textContent = `${answered} / ${totalQuestions}`;
    }
  }

  // Listen to any changes in the likert options
  document.querySelectorAll('.likert-radio-input').forEach(input => {
    input.addEventListener('change', () => {
      updateAssessmentProgress();
    });
  });

  // Filter assessment questions by category dimension
  const filterDimensi = document.getElementById('filterDimensi');
  const searchPertanyaan = document.getElementById('searchPertanyaan');

  function filterQuestions() {
    const query = (searchPertanyaan ? searchPertanyaan.value : '').toLowerCase().trim();
    const selDimensi = filterDimensi ? filterDimensi.value : 'all';

    questionCards.forEach(card => {
      const cardText = (card.getAttribute('data-question-text') || '').toLowerCase();
      const cardDimensi = card.getAttribute('data-dimensi') || '';

      const matchQuery = query === '' || cardText.includes(query);
      const matchDimensi = selDimensi === 'all' || cardDimensi === selDimensi;

      if (matchQuery && matchDimensi) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }

  if (filterDimensi) {
    filterDimensi.addEventListener('change', filterQuestions);
  }
  if (searchPertanyaan) {
    searchPertanyaan.addEventListener('input', filterQuestions);
  }

  // --------------------------------------------------------------------------
  // 3. CONSULTATION CALENDAR & TIME SLOTS INTERACTION
  // --------------------------------------------------------------------------
  const dayCells = document.querySelectorAll('.cal-day-cell:not(.disabled)');
  const slotButtons = document.querySelectorAll('.slot-item-btn:not(.booked)');
  const selectedDateSummary = document.getElementById('selectedDateSummary');
  const selectedSlotSummary = document.getElementById('selectedSlotSummary');

  dayCells.forEach(cell => {
    cell.addEventListener('click', () => {
      dayCells.forEach(c => c.classList.remove('active'));
      cell.classList.add('active');
      const dateVal = cell.getAttribute('data-date-str');
      if (selectedDateSummary && dateVal) {
        selectedDateSummary.textContent = dateVal;
      }
    });
  });

  slotButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      slotButtons.forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      const timeVal = btn.getAttribute('data-slot-time');
      if (selectedSlotSummary && timeVal) {
        selectedSlotSummary.textContent = timeVal;
      }
    });
  });

  // Filter counselor
  const filterKonselor = document.getElementById('filterKonselor');
  const searchKonselor = document.getElementById('searchKonselor');
  if (filterKonselor || searchKonselor) {
    const runKonselorFilter = () => {
      const q = (searchKonselor ? searchKonselor.value : '').toLowerCase().trim();
      const sp = filterKonselor ? filterKonselor.value : 'all';
      const counselorCards = document.querySelectorAll('.counselor-preview-item');
      counselorCards.forEach(card => {
        const text = (card.getAttribute('data-name') || '').toLowerCase();
        const spec = card.getAttribute('data-spec') || '';
        const matchQ = q === '' || text.includes(q);
        const matchSp = sp === 'all' || spec === sp;
        card.style.display = (matchQ && matchSp) ? '' : 'none';
      });
    };
    if (filterKonselor) filterKonselor.addEventListener('change', runKonselorFilter);
    if (searchKonselor) searchKonselor.addEventListener('input', runKonselorFilter);
  }

  // --------------------------------------------------------------------------
  // 4. ACTION MODAL TRIGGERS
  // --------------------------------------------------------------------------
  // Modal Tambah Nilai
  const modalTambahNilai = document.getElementById('modalTambahNilai');
  const btnOpenTambahNilai = document.querySelectorAll('.btn-open-tambah-nilai');
  btnOpenTambahNilai.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      if (modalTambahNilai) {
        modalTambahNilai.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  // Generic modal triggers with data-modal-target
  document.querySelectorAll('[data-open-modal]').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = trigger.getAttribute('data-open-modal');
      const targetModal = document.getElementById(targetId);
      if (targetModal) {
        targetModal.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });
});
