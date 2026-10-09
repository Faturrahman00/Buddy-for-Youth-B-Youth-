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
  // 4. DATA AKADEMIK CRUD & PAGINATION INTERACTIVITY
  // --------------------------------------------------------------------------
  const modalTambahNilai = document.getElementById('modalTambahNilai');
  const modalEditNilai = document.getElementById('modalEditNilai');
  const formTambahNilai = document.getElementById('formTambahNilai');
  const formEditNilai = document.getElementById('formEditNilai');
  const tableBodyAkademik = document.getElementById('akademikTableBody');
  const btnOpenTambahNilai = document.querySelectorAll('.btn-open-tambah-nilai');

  let editingRowElement = null;

  // Open Modal Tambah Nilai
  btnOpenTambahNilai.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      if (modalTambahNilai) {
        modalTambahNilai.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  // Calculate grade & predicate helper
  function calculateGrade(p, k) {
    const akhir = ((parseFloat(p) + parseFloat(k)) / 2).toFixed(1);
    let predikat = 'C';
    let badgeClass = 'c';
    if (akhir >= 88) {
      predikat = 'A';
      badgeClass = 'a';
    } else if (akhir >= 78) {
      predikat = 'B+';
      badgeClass = 'b';
    } else if (akhir >= 70) {
      predikat = 'B';
      badgeClass = 'b';
    }
    return { akhir, predikat, badgeClass };
  }

  // Recalculate summary stats (Rata-rata, mapel tertinggi, serta update grafik 4 pilar)
  function updateAkademikStats() {
    if (!tableBodyAkademik) return;
    const allRows = tableBodyAkademik.querySelectorAll('tr');
    let totalScore = 0;
    let count = 0;
    let maxScore = -1;
    let maxMapel = '-';

    const scoresMap = {
      'IPAS': 0,
      'MTK': 0,
      'Bahasa Indonesia': 0,
      'Bahasa Inggris': 0
    };

    allRows.forEach((row, idx) => {
      const numCell = row.querySelector('.row-number');
      if (numCell) numCell.textContent = idx + 1;

      const mapelName = row.getAttribute('data-mapel') || '';
      const p = parseFloat(row.getAttribute('data-pengetahuan') || 0);
      const k = parseFloat(row.getAttribute('data-keterampilan') || 0);
      const akhir = (p + k) / 2;

      totalScore += akhir;
      count++;

      if (akhir > maxScore) {
        maxScore = akhir;
        maxMapel = `${akhir.toFixed(1)} (${mapelName})`;
      }

      if (mapelName.includes('IPAS')) scoresMap['IPAS'] = akhir;
      else if (mapelName.includes('MTK')) scoresMap['MTK'] = akhir;
      else if (mapelName.includes('Bahasa Indonesia')) scoresMap['Bahasa Indonesia'] = akhir;
      else if (mapelName.includes('Bahasa Inggris')) scoresMap['Bahasa Inggris'] = akhir;
    });

    // Update stat card rata-rata
    const statAvgEl = document.getElementById('statRataRataNilai');
    if (statAvgEl && count > 0) {
      statAvgEl.textContent = (totalScore / count).toFixed(1);
    }

    // Update mapel tertinggi
    const statMaxEl = document.getElementById('statMapelTertinggi');
    if (statMaxEl && maxScore >= 0) {
      statMaxEl.textContent = maxMapel;
    }

    // Update 4 Grafik Bar Metrik
    function updateChartMetric(fillId, scoreId, gradeId, percentId, score) {
      const fillEl = document.getElementById(fillId);
      const scoreEl = document.getElementById(scoreId);
      const gradeEl = document.getElementById(gradeId);
      const percentEl = document.getElementById(percentId);

      const s = Math.max(0, Math.min(100, score));
      if (fillEl) fillEl.style.width = `${s}%`;
      if (scoreEl) scoreEl.textContent = s.toFixed(1);
      if (percentEl) percentEl.textContent = `${Math.round(s)}% Tercapai`;
      if (gradeEl) {
        let p = 'Predikat C';
        if (s >= 88) p = 'Predikat A';
        else if (s >= 78) p = 'Predikat B+';
        else if (s >= 70) p = 'Predikat B';
        gradeEl.textContent = p;
      }
    }

    if (scoresMap['IPAS']) updateChartMetric('pillarIpas', 'chartScoreIpas', 'chartGradeIpas', 'chartPercentIpas', scoresMap['IPAS']);
    if (scoresMap['MTK']) updateChartMetric('pillarMtk', 'chartScoreMtk', 'chartGradeMtk', 'chartPercentMtk', scoresMap['MTK']);
    if (scoresMap['Bahasa Indonesia']) updateChartMetric('pillarIndo', 'chartScoreIndo', 'chartGradeIndo', 'chartPercentIndo', scoresMap['Bahasa Indonesia']);
    if (scoresMap['Bahasa Inggris']) updateChartMetric('pillarIng', 'chartScoreIng', 'chartGradeIng', 'chartPercentIng', scoresMap['Bahasa Inggris']);
  }

  // Handle Form Tambah Nilai Submit (Input Nilai untuk 4 Mapel)
  if (formTambahNilai) {
    formTambahNilai.addEventListener('submit', (e) => {
      e.preventDefault();
      const sem = document.getElementById('tambahSemester').value;
      const mapel = document.getElementById('tambahMapelNama').value.trim();
      const kkm = document.getElementById('tambahKkm').value || '75';
      const pRaw = document.getElementById('tambahNilaiPengetahuan').value;
      const kRaw = document.getElementById('tambahNilaiKeterampilan').value;

      const p = parseFloat(pRaw);
      const k = parseFloat(kRaw);

      // Validasi Nilai Berhasil & Gagal
      if (isNaN(p) || isNaN(k) || p < 0 || p > 100 || k < 0 || k > 100) {
        if (window.showToastError) {
          window.showToastError('Gagal Menyimpan Nilai', 'Nilai Pengetahuan dan Keterampilan harus diisi antara rentang 0 hingga 100!');
        } else {
          alert('Gagal: Nilai harus diisi dengan angka antara 0 hingga 100.');
        }
        return;
      }

      const { akhir, predikat, badgeClass } = calculateGrade(p, k);

      // Close modal
      if (modalTambahNilai) modalTambahNilai.classList.remove('active');
      document.body.style.overflow = '';

      // Tampilkan animasi glassmorphism loading
      if (window.showGlassLoading) {
        window.showGlassLoading('Menyimpan nilai rapor...', 600, () => {
          // Cari apakah mapel ini sudah ada di tabel
          let targetRow = null;
          if (tableBodyAkademik) {
            tableBodyAkademik.querySelectorAll('tr').forEach(r => {
              if (r.getAttribute('data-mapel') === mapel) {
                targetRow = r;
              }
            });
          }

          if (targetRow) {
            targetRow.setAttribute('data-searchable', `${mapel} ${sem} ${predikat}`);
            targetRow.setAttribute('data-semester', sem);
            targetRow.setAttribute('data-pengetahuan', p);
            targetRow.setAttribute('data-keterampilan', k);

            const semEl = targetRow.querySelector('.row-semester-val');
            if (semEl) semEl.textContent = sem;

            const pEl = targetRow.querySelector('.row-pengetahuan-val');
            if (pEl) pEl.textContent = p;

            const kEl = targetRow.querySelector('.row-keterampilan-val');
            if (kEl) kEl.textContent = k;

            const akhirEl = targetRow.querySelector('.row-akhir-val');
            if (akhirEl) akhirEl.textContent = akhir;

            const predikatEl = targetRow.querySelector('.row-predikat-val');
            if (predikatEl) {
              predikatEl.innerHTML = `<span class="grade-badge ${badgeClass}">${predikat}</span>`;
            }
          }

          formTambahNilai.reset();
          updateAkademikStats();

          // Tampilkan Notifikasi Berhasil
          if (window.showToastSuccess) {
            window.showToastSuccess('Berhasil Disimpan', `Nilai rapor ${mapel} berhasil disimpan dan diperbarui.`);
          }
        });
      }
    });
  }

  // Attach click events to rows (Edit Nilai)
  function attachRowEvents(row) {
    const editBtn = row.querySelector('.btn-edit-row');

    if (editBtn) {
      editBtn.addEventListener('click', () => {
        editingRowElement = row;
        const mapel = row.getAttribute('data-mapel') || 'IPAS';
        const kkm = row.getAttribute('data-kkm') || '75';
        const p = row.getAttribute('data-pengetahuan') || '85';
        const k = row.getAttribute('data-keterampilan') || '85';
        const sem = row.getAttribute('data-semester') || 'Semester 5';

        const mapelSelect = document.getElementById('editMapelNama');
        if (mapelSelect) mapelSelect.value = mapel;

        const kkmInput = document.getElementById('editKkm');
        if (kkmInput) kkmInput.value = kkm;

        const pInput = document.getElementById('editNilaiPengetahuan');
        if (pInput) pInput.value = p;

        const kInput = document.getElementById('editNilaiKeterampilan');
        if (kInput) kInput.value = k;

        const semSelect = document.getElementById('editSemester');
        if (semSelect) semSelect.value = sem;

        if (modalEditNilai) {
          modalEditNilai.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      });
    }
  }

  // Attach to existing rows
  if (tableBodyAkademik) {
    tableBodyAkademik.querySelectorAll('tr').forEach(attachRowEvents);
    updateAkademikStats();
  }

  // Handle Form Edit Nilai Submit
  if (formEditNilai) {
    formEditNilai.addEventListener('submit', (e) => {
      e.preventDefault();
      if (!editingRowElement) return;

      const sem = document.getElementById('editSemester').value;
      const mapel = document.getElementById('editMapelNama').value.trim();
      const kkm = document.getElementById('editKkm').value || '75';
      const pRaw = document.getElementById('editNilaiPengetahuan').value;
      const kRaw = document.getElementById('editNilaiKeterampilan').value;

      const p = parseFloat(pRaw);
      const k = parseFloat(kRaw);

      // Validasi Nilai Berhasil & Gagal
      if (isNaN(p) || isNaN(k) || p < 0 || p > 100 || k < 0 || k > 100) {
        if (window.showToastError) {
          window.showToastError('Gagal Menyimpan Nilai', 'Nilai Pengetahuan dan Keterampilan harus diisi antara rentang 0 hingga 100!');
        } else {
          alert('Gagal: Nilai harus diisi dengan angka antara 0 hingga 100.');
        }
        return;
      }

      const { akhir, predikat, badgeClass } = calculateGrade(p, k);

      if (modalEditNilai) modalEditNilai.classList.remove('active');
      document.body.style.overflow = '';

      if (window.showGlassLoading) {
        window.showGlassLoading('Memperbarui nilai rapor...', 600, () => {
          editingRowElement.setAttribute('data-searchable', `${mapel} ${sem} ${predikat}`);
          editingRowElement.setAttribute('data-semester', sem);
          editingRowElement.setAttribute('data-mapel', mapel);
          editingRowElement.setAttribute('data-kkm', kkm);
          editingRowElement.setAttribute('data-pengetahuan', p);
          editingRowElement.setAttribute('data-keterampilan', k);

          const semEl = editingRowElement.querySelector('.row-semester-val');
          if (semEl) semEl.textContent = sem;

          const pEl = editingRowElement.querySelector('.row-pengetahuan-val');
          if (pEl) pEl.textContent = p;

          const kEl = editingRowElement.querySelector('.row-keterampilan-val');
          if (kEl) kEl.textContent = k;

          const akhirEl = editingRowElement.querySelector('.row-akhir-val');
          if (akhirEl) akhirEl.textContent = akhir;

          const predikatEl = editingRowElement.querySelector('.row-predikat-val');
          if (predikatEl) {
            predikatEl.innerHTML = `<span class="grade-badge ${badgeClass}">${predikat}</span>`;
          }

          updateAkademikStats();
          editingRowElement = null;

          // Tampilkan Notifikasi Berhasil
          if (window.showToastSuccess) {
            window.showToastSuccess('Berhasil Diperbarui', `Nilai rapor ${mapel} berhasil diperbarui.`);
          }
        });
      }
    });
  }

  // --------------------------------------------------------------------------
  // 5. GENERIC MODAL TRIGGERS
  // --------------------------------------------------------------------------
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

