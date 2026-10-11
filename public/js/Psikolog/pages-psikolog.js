/**
 * B-YOUTH: INTERACTIVE SCRIPTS FOR PSIKOLOG PAGES
 * File: public/js/Psikolog/pages-psikolog.js
 */

document.addEventListener('DOMContentLoaded', () => {

  // 1. One-Click Copy Zoom Link
  window.copyZoomLink = function(url) {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(url).then(() => {
        window.showToast('Tautan Zoom berhasil disalin ke clipboard!');
      }).catch(() => {
        fallbackCopy(url);
      });
    } else {
      fallbackCopy(url);
    }
  };

  function fallbackCopy(text) {
    const tempInput = document.createElement('input');
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    window.showToast('Tautan Zoom berhasil disalin!');
  }

  // 2. Tabs Switcher for Kelola Jadwal (Kelola Jadwal vs Pengajuan)
  const tabBtns = document.querySelectorAll('.subtabs-bar .tab-btn');
  const tabPanels = document.querySelectorAll('.tab-content-panel');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-tab-target');
      tabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      tabPanels.forEach(panel => {
        if (panel.id === targetId) {
          panel.style.display = 'block';
        } else {
          panel.style.display = 'none';
        }
      });
    });
  });

  // 3. Interactive Calendar Date Selection
  const calCells = document.querySelectorAll('.cal-day-cell:not(.other-month)');
  const filterSelectedDateDisplay = document.getElementById('selectedDateLabel');

  calCells.forEach(cell => {
    cell.addEventListener('click', () => {
      calCells.forEach(c => c.classList.remove('selected'));
      cell.classList.add('selected');
      const dateVal = cell.getAttribute('data-date');
      if (filterSelectedDateDisplay && dateVal) {
        filterSelectedDateDisplay.textContent = dateVal;
      }
      filterSlotsByDate(dateVal);
    });
  });

  function filterSlotsByDate(date) {
    if (!date) return;
    const slotItems = document.querySelectorAll('.slot-card-item');
    slotItems.forEach(item => {
      const itemDate = item.getAttribute('data-slot-date');
      if (!itemDate || itemDate === date || date === 'all') {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  }

  // 4. Slot Status Chip Filtering
  const slotChips = document.querySelectorAll('.slot-chip-filter');
  slotChips.forEach(chip => {
    chip.addEventListener('click', () => {
      slotChips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      const status = chip.getAttribute('data-status-filter');
      const slotItems = document.querySelectorAll('.slot-card-item');

      slotItems.forEach(item => {
        const itemStatus = item.getAttribute('data-slot-status');
        if (status === 'all' || itemStatus === status) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  // 5. Publish New Slot Form Submission Simulator
  const formTambahSlot = document.getElementById('formTambahSlot');
  if (formTambahSlot) {
    formTambahSlot.addEventListener('submit', (e) => {
      e.preventDefault();
      const tanggal = document.getElementById('inputSlotTanggal').value;
      const jamMulai = document.getElementById('inputSlotJamMulai').value;
      const jamSelesai = document.getElementById('inputSlotJamSelesai').value;
      const zoomUrl = document.getElementById('inputSlotZoom').value;

      if (!tanggal || !jamMulai || !jamSelesai) {
        alert('Mohon lengkapi tanggal dan jam konsultasi.');
        return;
      }

      window.showToast(`Slot baru berhasil dipublikasikan untuk ${tanggal} (${jamMulai} - ${jamSelesai} WIB)!`);
      
      // Prepend newly added slot card dynamically
      const slotContainer = document.getElementById('slotItemsContainer');
      if (slotContainer) {
        const newSlot = document.createElement('div');
        newSlot.className = 'slot-card-item';
        newSlot.setAttribute('data-slot-date', tanggal);
        newSlot.setAttribute('data-slot-status', 'tersedia');
        newSlot.innerHTML = `
          <div class="slot-left-info">
            <div class="slot-date-badge">
              <span class="day-txt">BARU</span>
              <span class="date-txt">${tanggal}</span>
            </div>
            <div class="slot-detail-meta">
              <h5>
                ${jamMulai} - ${jamSelesai} WIB
                <span class="status-tag tersedia">Tersedia</span>
              </h5>
              <p>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 7l-7 5 7 5V7z"></path><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                <span>${zoomUrl || 'https://zoom.us/j/98765432199'}</span>
              </p>
            </div>
          </div>
          <div class="slot-actions-group">
            <button type="button" class="btn-secondary-link" onclick="window.copyZoomLink('${zoomUrl || 'https://zoom.us/j/98765432199'}')">Salin Link</button>
            <button type="button" class="btn-secondary-link" style="color:#c53030;" onclick="this.closest('.slot-card-item').remove(); window.showToast('Slot berhasil dihapus.');">Hapus</button>
          </div>
        `;
        slotContainer.prepend(newSlot);
      }
    });
  }

  // 6. Approve / Reject Booking Interactive Simulator
  window.approveBooking = function(btn, studentName, slotTime) {
    if (confirm(`Setujui booking konsultasi dari ${studentName} pada ${slotTime}?`)) {
      const card = btn.closest('.booking-request-card');
      if (card) {
        card.innerHTML = `
          <div style="padding:18px; background:#EBFDF2; border:1px solid #A6F4C5; border-radius:12px; display:flex; align-items:center; justify-content:space-between;">
            <div>
              <span style="color:#027A48; font-weight:800; font-size:13px;">✓ DISETUJUI</span>
              <h5 style="font-weight:800; color:#172C40; margin-top:4px;">Booking ${studentName} telah dikonfirmasi</h5>
              <p style="font-size:12px; color:#3E5469;">Notifikasi link Zoom telah terkirim otomatis ke email dan dashboard siswa.</p>
            </div>
            <button type="button" class="btn-zoom-primary" onclick="window.open('https://zoom.us/j/98765432199', '_blank')">Buka Zoom</button>
          </div>
        `;
        window.showToast(`Booking ${studentName} berhasil disetujui!`);
        // Update badge counter
        const countBadge = document.querySelector('.tab-badge');
        if (countBadge) countBadge.textContent = '0';
      }
    }
  };

  window.rejectBooking = function(btn, studentName) {
    const alasan = prompt(`Masukkan alasan penjadwalan ulang / penolakan untuk ${studentName}:`, 'Jadwal bertabrakan dengan agenda evaluasi klinis');
    if (alasan) {
      const card = btn.closest('.booking-request-card');
      if (card) {
        card.remove();
        window.showToast(`Booking ${studentName} telah ditolak dengan catatan: "${alasan}".`);
        const countBadge = document.querySelector('.tab-badge');
        if (countBadge) countBadge.textContent = '0';
      }
    }
  };

  // 7. Interactive Catatan Lengkap Modal
  window.showCatatanModal = function(data) {
    const modal = document.getElementById('modalCatatanLengkap');
    if (!modal) return;

    document.getElementById('modalSiswaNama').textContent = data.nama || '-';
    document.getElementById('modalSiswaSekolah').textContent = data.sekolah || '-';
    document.getElementById('modalSesiTanggal').textContent = data.tanggal || '-';
    document.getElementById('modalSesiDurasi').textContent = data.durasi || '-';
    document.getElementById('modalTopikKonseling').textContent = data.topik || '-';
    document.getElementById('modalCatatanPsikolog').textContent = data.catatan || '-';
    document.getElementById('modalRekomendasiProdi').textContent = data.rekomendasi || '-';
    document.getElementById('modalRencanaAksi').textContent = data.rencana || '-';

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  // 8. Riwayat Table Search & Filter
  const inputSearchRiwayat = document.getElementById('inputSearchRiwayat');
  const selectFilterStatusRiwayat = document.getElementById('selectFilterStatusRiwayat');

  function filterRiwayatRows() {
    const query = (inputSearchRiwayat ? inputSearchRiwayat.value : '').toLowerCase().trim();
    const statusVal = selectFilterStatusRiwayat ? selectFilterStatusRiwayat.value : 'all';
    const rows = document.querySelectorAll('#tableRiwayatBody tr[data-searchable]');

    let count = 0;
    rows.forEach(row => {
      const rowText = (row.getAttribute('data-searchable') || '').toLowerCase();
      const rowStatus = row.getAttribute('data-status') || '';

      const matchText = !query || rowText.includes(query);
      const matchStatus = statusVal === 'all' || rowStatus === statusVal;

      if (matchText && matchStatus) {
        row.style.display = '';
        count++;
      } else {
        row.style.display = 'none';
      }
    });

    const summaryCounter = document.getElementById('riwayatCounterLabel');
    if (summaryCounter) {
      summaryCounter.textContent = `Menampilkan ${count} dari ${rows.length} riwayat sesi konseling`;
    }
  }

  if (inputSearchRiwayat) inputSearchRiwayat.addEventListener('input', filterRiwayatRows);
  if (selectFilterStatusRiwayat) selectFilterStatusRiwayat.addEventListener('change', filterRiwayatRows);

  // 9. Profile Edit Toggle Mode
  window.toggleEditProfil = function() {
    const viewGroup = document.getElementById('profilDisplayGroup');
    const editGroup = document.getElementById('profilEditForm');
    const btnToggle = document.getElementById('btnToggleEditProfil');

    if (viewGroup && editGroup) {
      const isEditing = editGroup.style.display === 'block';
      if (isEditing) {
        editGroup.style.display = 'none';
        viewGroup.style.display = 'grid';
        if (btnToggle) btnToggle.innerHTML = `
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
          Edit Profil
        `;
      } else {
        editGroup.style.display = 'block';
        viewGroup.style.display = 'none';
        if (btnToggle) btnToggle.innerHTML = `
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          Batal
        `;
      }
    }
  };

  window.simpanProfil = function(e) {
    if (e) e.preventDefault();
    const nama = document.getElementById('editNama').value;
    const email = document.getElementById('editEmail').value;
    const sip = document.getElementById('editSip').value;

    if (document.getElementById('displayNamaHeader')) document.getElementById('displayNamaHeader').textContent = nama;
    if (document.getElementById('displayEmailHeader')) document.getElementById('displayEmailHeader').textContent = email;
    if (document.getElementById('displaySipHeader')) document.getElementById('displaySipHeader').textContent = `SIP: ${sip}`;
    if (document.getElementById('valNamaLengkap')) document.getElementById('valNamaLengkap').textContent = nama;
    if (document.getElementById('valEmail')) document.getElementById('valEmail').textContent = email;
    if (document.getElementById('valSip')) document.getElementById('valSip').textContent = sip;

    toggleEditProfil();
    window.showToast('Data profil berhasil diperbarui!');
  };

  // 10. ApexCharts Render for Beranda (Ringkasan Bulan Ini)
  const chartEl = document.querySelector("#chart-konseling-bulanan");
  if (chartEl && typeof ApexCharts !== 'undefined') {
    const options = {
      series: [{
        name: 'Sesi Konseling',
        data: [1, 2, 1, 2]
      }],
      chart: {
        height: 180,
        type: 'area',
        toolbar: { show: false },
        sparkline: { enabled: false },
        fontFamily: 'Plus Jakarta Sans, sans-serif'
      },
      colors: ['#30618C'],
      dataLabels: { enabled: false },
      stroke: { curve: 'smooth', width: 2.5 },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.45,
          opacityTo: 0.05,
          stops: [0, 95, 100]
        }
      },
      xaxis: {
        categories: ['Mgg 1', 'Mgg 2', 'Mgg 3', 'Mgg 4'],
        labels: {
          style: { fontSize: '11px', colors: '#6B8299' }
        }
      },
      yaxis: {
        labels: {
          style: { fontSize: '11px', colors: '#6B8299' }
        }
      },
      grid: {
        borderColor: '#E7EEF5',
        strokeDashArray: 4
      },
      tooltip: {
        theme: 'light',
        y: {
          formatter: function(val) {
            return val + " Sesi Konsultasi";
          }
        }
      }
    };
    const chart = new ApexCharts(chartEl, options);
    chart.render();
  }

});
