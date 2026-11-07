/**
 * B-YOUTH: DATA AKADEMIK SISWA SCRIPT
 * File: public/js/Siswa/data-akademik.js
 * Deskripsi: Mengelola pencarian, filter, modal input/ubah nilai rapor,
 *            kalkulasi akumulasi nilai 4 mapel, serta sinkronisasi grafik realtime.
 */

document.addEventListener('DOMContentLoaded', () => {
  // ── Elemen DOM Utama ──
  const searchInput = document.getElementById('searchMapel');
  const filterSemester = document.getElementById('filterSemester');
  const tableBodyAkademik = document.getElementById('akademikTableBody');
  const modalEditNilai = document.getElementById('modalEditNilai');
  const formEditNilai = document.getElementById('formEditNilai');

  let editingRowElement = null;

  // --------------------------------------------------------------------------
  // 1. PENCARIAN & FILTER TABEL DAFTAR NILAI RAPOR
  // --------------------------------------------------------------------------
  function runTableFilter() {
    if (!tableBodyAkademik) return;

    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    const selectedSem = (filterSemester ? filterSemester.value : 'all').toLowerCase();
    const rows = tableBodyAkademik.querySelectorAll('tr[data-searchable]');
    let visibleCount = 0;

    rows.forEach(row => {
      const searchData = (row.getAttribute('data-searchable') || '').toLowerCase();
      const rowSem = (row.getAttribute('data-semester') || '').toLowerCase();

      const matchesQuery = query === '' || searchData.includes(query);
      const matchesSemester = selectedSem === 'all' || rowSem === selectedSem;

      if (matchesQuery && matchesSemester) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    // Perbarui badge jumlah data rapor yang tampil
    const countBadge = document.querySelector('[data-count-for="akademikTableBody"]');
    if (countBadge) {
      countBadge.textContent = `${visibleCount} Nilai Rapor`;
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', runTableFilter);
  }

  if (filterSemester) {
    filterSemester.addEventListener('change', runTableFilter);
  }

  // --------------------------------------------------------------------------
  // 2. HELPER KALKULASI PREDIKAT & NILAI AKHIR
  // --------------------------------------------------------------------------
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

  // --------------------------------------------------------------------------
  // 3. STATISTIK AKUMULASI NILAI & PEMBARUAN GRAFIK 4 MAPEL
  // --------------------------------------------------------------------------
  function updateAkademikStats() {
    if (!tableBodyAkademik) return;
    const allRows = tableBodyAkademik.querySelectorAll('tr');

    const mapels = {
      'IPAS': [],
      'MTK': [],
      'Bahasa Indonesia': [],
      'Bahasa Inggris': []
    };

    allRows.forEach((row, idx) => {
      const numCell = row.querySelector('.row-number');
      if (numCell) numCell.textContent = idx + 1;

      const mapelAttr = (row.getAttribute('data-mapel') || '').trim();
      const p = parseFloat(row.getAttribute('data-pengetahuan') || 0);
      const k = parseFloat(row.getAttribute('data-keterampilan') || 0);
      const akhir = (p + k) / 2;

      let targetKey = null;
      if (mapelAttr.includes('IPAS')) targetKey = 'IPAS';
      else if (mapelAttr.includes('MTK') || mapelAttr.toLowerCase().includes('matematika')) targetKey = 'MTK';
      else if (mapelAttr.includes('Bahasa Indonesia')) targetKey = 'Bahasa Indonesia';
      else if (mapelAttr.includes('Bahasa Inggris')) targetKey = 'Bahasa Inggris';

      if (targetKey) {
        // Hanya hitung semester yang sudah diisi siswa (nilai > 0)
        if (akhir > 0 || p > 0 || k > 0) {
          mapels[targetKey].push(akhir);
        }
      }
    });

    const scoresMap = {};
    const filledCounts = {};
    let totalSubjectAverages = 0;
    let filledSubjectCount = 0;
    let maxScore = -1;
    let maxMapel = '-';

    for (const [key, scoresList] of Object.entries(mapels)) {
      if (scoresList.length > 0) {
        const sum = scoresList.reduce((acc, curr) => acc + curr, 0);
        const avg = sum / scoresList.length;
        scoresMap[key] = avg;
        filledCounts[key] = scoresList.length;
        totalSubjectAverages += avg;
        filledSubjectCount++;

        if (avg > maxScore) {
          maxScore = avg;
          maxMapel = `${avg.toFixed(1)} (${key})`;
        }
      } else {
        scoresMap[key] = 0;
        filledCounts[key] = 0;
      }
    }

    // Perbarui kartu stat ringkasan atas
    const statAvgEl = document.getElementById('statRataRataNilai');
    if (statAvgEl) {
      statAvgEl.textContent = filledSubjectCount > 0 ? (totalSubjectAverages / filledSubjectCount).toFixed(1) : 'Belum diisi';
    }

    const statMaxEl = document.getElementById('statMapelTertinggi');
    if (statMaxEl) {
      statMaxEl.textContent = maxScore >= 0 ? maxMapel : '-';
    }

    // Fungsi perbarui grafik metrik individual
    function updateChartMetric(fillId, scoreId, gradeId, percentId, detailId, score, count) {
      const fillEl = document.getElementById(fillId);
      const scoreEl = document.getElementById(scoreId);
      const gradeEl = document.getElementById(gradeId);
      const percentEl = document.getElementById(percentId);
      const detailEl = document.getElementById(detailId);

      const hasData = count > 0;
      const s = Math.max(0, Math.min(100, score));

      if (fillEl) fillEl.style.width = `${hasData ? s : 0}%`;
      if (scoreEl) scoreEl.textContent = hasData ? s.toFixed(1) : '-';
      if (percentEl) percentEl.textContent = hasData ? `${Math.round(s)}% Tercapai` : '0% Tercapai';
      if (detailEl) detailEl.textContent = hasData ? `${count} Semester Terisi` : 'Belum Ada Nilai';

      if (gradeEl) {
        if (!hasData) {
          gradeEl.textContent = 'Belum Diisi';
        } else {
          let p = 'Predikat C';
          if (s >= 88) p = 'Predikat A';
          else if (s >= 78) p = 'Predikat B+';
          else if (s >= 70) p = 'Predikat B';
          gradeEl.textContent = p;
        }
      }
    }

    updateChartMetric('pillarIpas', 'chartScoreIpas', 'chartGradeIpas', 'chartPercentIpas', 'chartDetailIpas', scoresMap['IPAS'], filledCounts['IPAS']);
    updateChartMetric('pillarMtk', 'chartScoreMtk', 'chartGradeMtk', 'chartPercentMtk', 'chartDetailMtk', scoresMap['MTK'], filledCounts['MTK']);
    updateChartMetric('pillarIndo', 'chartScoreIndo', 'chartGradeIndo', 'chartPercentIndo', 'chartDetailIndo', scoresMap['Bahasa Indonesia'], filledCounts['Bahasa Indonesia']);
    updateChartMetric('pillarIng', 'chartScoreIng', 'chartGradeIng', 'chartPercentIng', 'chartDetailIng', scoresMap['Bahasa Inggris'], filledCounts['Bahasa Inggris']);
  }

  // --------------------------------------------------------------------------
  // 4. AJAX SIMPAN / PERBARUI NILAI RAPOR (POST /siswa/akademik)
  // --------------------------------------------------------------------------
  function saveNilaiAkademik({ mapel, sem, p, k, formEl, modalEl }) {
    const { akhir, predikat } = calculateGrade(p, k);

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
      || document.querySelector('input[name="_token"]')?.value;

    if (modalEl) modalEl.classList.remove('active');
    document.body.style.overflow = '';

    const executeSave = () => {
      fetch('/siswa/akademik', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          mata_pelajaran: mapel,
          mapel_semester: sem,
          pengetahuan: p,
          keterampilan: k,
        })
      })
      .then(async response => {
        const res = await response.json();
        if (!response.ok) {
          throw new Error(res.message || 'Gagal menyimpan nilai.');
        }
        return res;
      })
      .then(res => {
        // Temukan baris tabel yang bersangkutan
        let targetRow = editingRowElement;
        if (!targetRow && tableBodyAkademik) {
          tableBodyAkademik.querySelectorAll('tr').forEach(r => {
            const rowMapel = r.getAttribute('data-mapel') || '';
            const rowSem = r.getAttribute('data-semester') || '';
            const isMapelMatch = rowMapel === mapel || (mapel === 'MTK' && rowMapel.includes('Matematika')) || (mapel === 'Matematika' && rowMapel === 'MTK');
            if (isMapelMatch && rowSem === sem) {
              targetRow = r;
            }
          });
        }

        if (targetRow) {
          targetRow.setAttribute('data-searchable', `${mapel} ${sem} ${predikat}`);
          targetRow.setAttribute('data-semester', sem);
          targetRow.setAttribute('data-mapel', mapel);
          targetRow.setAttribute('data-pengetahuan', p);
          targetRow.setAttribute('data-keterampilan', k);

          const semEl = targetRow.querySelector('.row-semester-val');
          if (semEl) semEl.textContent = sem;

          const pEl = targetRow.querySelector('.row-pengetahuan-val');
          if (pEl) {
            pEl.textContent = Math.round(p);
            pEl.className = 'row-pengetahuan-val row-score-chip ' + (p > 0 ? 'filled' : 'zero');
          }

          const kEl = targetRow.querySelector('.row-keterampilan-val');
          if (kEl) {
            kEl.textContent = Math.round(k);
            kEl.className = 'row-keterampilan-val row-score-chip ' + (k > 0 ? 'filled' : 'zero');
          }

          const akhirEl = targetRow.querySelector('.row-akhir-val');
          if (akhirEl) {
            akhirEl.textContent = parseFloat(akhir).toFixed(1);
            akhirEl.className = 'row-akhir-val row-final-chip ' + (akhir >= 85 ? 'high' : (akhir > 0 ? 'filled' : 'zero'));
          }

          const btnAction = targetRow.querySelector('.btn-edit-row');
          if (btnAction) {
            btnAction.className = 'btn-action-akademik btn-edit-row outline';
            btnAction.setAttribute('title', 'Ubah nilai rapor ini');
            btnAction.innerHTML = `
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
              <span>Ubah</span>
            `;
          }
        }

        // Perbarui kartu stat ringkasan
        const statAvg = document.getElementById('statRataRataNilai');
        if (statAvg && res.data && res.data.global_avg !== undefined) {
          statAvg.textContent = res.data.global_avg !== null ? parseFloat(res.data.global_avg).toFixed(1) : 'Belum diisi';
        }

        const statTop = document.getElementById('statMapelTertinggi');
        if (statTop && res.data && res.data.highest_mapel) {
          statTop.textContent = res.data.highest_mapel;
        }

        if (formEl) formEl.reset();
        editingRowElement = null;
        updateAkademikStats();

        if (typeof window.byouthToast === 'function') {
          window.byouthToast({
            type: 'success',
            message: res.message || `Nilai rapor ${mapel} (${sem}) berhasil disimpan.`
          });
        } else if (window.showToastSuccess) {
          window.showToastSuccess('Berhasil Disimpan', res.message || `Nilai rapor ${mapel} (${sem}) berhasil disimpan.`);
        }
      })
      .catch(err => {
        if (window.byouthAlert) {
          window.byouthAlert({
            title: 'Gagal Menyimpan',
            text: err.message || 'Terjadi kesalahan saat menyimpan data ke database.',
            icon: 'error'
          });
        } else {
          alert(err.message || 'Gagal menyimpan nilai.');
        }
      });
    };

    if (window.showGlassLoading) {
      window.showGlassLoading('Menyimpan nilai ke database...', 500, executeSave);
    } else {
      executeSave();
    }
  }

  // --------------------------------------------------------------------------
  // 5. EVENT MODAL UBAH / ISI NILAI RAPOR
  // --------------------------------------------------------------------------
  function attachRowEvents(row) {
    const editBtn = row.querySelector('.btn-edit-row');

    if (editBtn) {
      editBtn.addEventListener('click', () => {
        editingRowElement = row;
        const mapel = row.getAttribute('data-mapel') || 'IPAS';
        const pAttr = row.getAttribute('data-pengetahuan');
        const kAttr = row.getAttribute('data-keterampilan');
        const sem = row.getAttribute('data-semester') || 'Semester 1';

        const mapelSelect = document.getElementById('editMapelNama');
        if (mapelSelect) mapelSelect.value = mapel;

        const pInput = document.getElementById('editNilaiPengetahuan');
        if (pInput) pInput.value = (pAttr !== null && pAttr !== '' && !isNaN(pAttr)) ? parseFloat(pAttr) : '0';

        const kInput = document.getElementById('editNilaiKeterampilan');
        if (kInput) kInput.value = (kAttr !== null && kAttr !== '' && !isNaN(kAttr)) ? parseFloat(kAttr) : '0';

        const semSelect = document.getElementById('editSemester');
        if (semSelect) semSelect.value = sem;

        if (modalEditNilai) {
          modalEditNilai.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      });
    }
  }

  // Pasang event click ke seluruh baris tabel
  if (tableBodyAkademik) {
    tableBodyAkademik.querySelectorAll('tr').forEach(attachRowEvents);
    updateAkademikStats();
  }

  // Handle Form Submit Nilai
  if (formEditNilai) {
    formEditNilai.addEventListener('submit', (e) => {
      e.preventDefault();

      const sem = document.getElementById('editSemester').value;
      const mapel = document.getElementById('editMapelNama').value.trim();
      const pRaw = document.getElementById('editNilaiPengetahuan').value;
      const kRaw = document.getElementById('editNilaiKeterampilan').value;

      const p = parseFloat(pRaw);
      const k = parseFloat(kRaw);

      if (isNaN(p) || isNaN(k) || p < 0 || p > 100 || k < 0 || k > 100) {
        if (window.byouthAlert) {
          window.byouthAlert({
            title: 'Gagal Menyimpan Nilai',
            text: 'Nilai Pengetahuan dan Keterampilan harus diisi antara rentang 0 hingga 100!',
            icon: 'warning'
          });
        }
        return;
      }

      saveNilaiAkademik({
        mapel,
        sem,
        p,
        k,
        formEl: formEditNilai,
        modalEl: modalEditNilai
      });
    });
  }

  // Close modal when clicking close buttons or outside modal box
  if (modalEditNilai) {
    modalEditNilai.querySelectorAll('.modal-close-trigger').forEach(btn => {
      btn.addEventListener('click', () => {
        modalEditNilai.classList.remove('active');
        document.body.style.overflow = '';
      });
    });

    modalEditNilai.addEventListener('click', (e) => {
      if (e.target === modalEditNilai) {
        modalEditNilai.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  }
});

