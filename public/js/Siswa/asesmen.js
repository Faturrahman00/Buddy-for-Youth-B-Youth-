/**
 * asesmen.js — Holland RIASEC Assessment & AI Synergy Recommendation Engine
 * Buddy For Youth (B-Youth)
 */

(function () {
  'use strict';

  // ── Fallback 42 Questions in case server array is empty ─────────────────
  const fallbackQuestions = [
    { id: 1, nomor_urut: 1, tipe_riasec: 'R', pertanyaan: 'Saya suka mengotak-atik mobil' },
    { id: 2, nomor_urut: 2, tipe_riasec: 'I', pertanyaan: 'Saya suka bermain puzzle' },
    { id: 3, nomor_urut: 3, tipe_riasec: 'A', pertanyaan: 'Saya suka bekerja sendiri' },
    { id: 4, nomor_urut: 4, tipe_riasec: 'S', pertanyaan: 'Saya suka bekerja dalam tim' },
    { id: 5, nomor_urut: 5, tipe_riasec: 'E', pertanyaan: 'Saya adalah orang yang ambisius' },
    { id: 6, nomor_urut: 6, tipe_riasec: 'C', pertanyaan: 'Saya suka menyusun dan mengatur barang-barang' },
    { id: 7, nomor_urut: 7, tipe_riasec: 'R', pertanyaan: 'Saya suka membangun sesuatu' },
    { id: 8, nomor_urut: 8, tipe_riasec: 'A', pertanyaan: 'Saya suka membaca tentang seni dan music' },
    { id: 9, nomor_urut: 9, tipe_riasec: 'C', pertanyaan: 'Saya lebih suka memiliki instruksi yang jelas untuk diikuti dalam bekerja' },
    { id: 10, nomor_urut: 10, tipe_riasec: 'E', pertanyaan: 'Saya suka memengaruhi dan mempersuasi orang' },
    { id: 11, nomor_urut: 11, tipe_riasec: 'I', pertanyaan: 'Saya suka melakukan eksperimen' },
    { id: 12, nomor_urut: 12, tipe_riasec: 'S', pertanyaan: 'Saya suka mengajar atau melatih orang lain' },
    { id: 13, nomor_urut: 13, tipe_riasec: 'S', pertanyaan: 'Saya suka membantu dan memecahkan masalah yang dialami orang lain' },
    { id: 14, nomor_urut: 14, tipe_riasec: 'R', pertanyaan: 'Saya suka merawat Binatang' },
    { id: 15, nomor_urut: 15, tipe_riasec: 'C', pertanyaan: 'Saya tidak keberatan bekerja \'9-to-5\' di kantor' },
    { id: 16, nomor_urut: 16, tipe_riasec: 'E', pertanyaan: 'Saya suka menjual sesuatu' },
    { id: 17, nomor_urut: 17, tipe_riasec: 'A', pertanyaan: 'Saya suka menulis' },
    { id: 18, nomor_urut: 18, tipe_riasec: 'I', pertanyaan: 'Saya menikmati membaca topik tentang science dan penelitian' },
    { id: 19, nomor_urut: 19, tipe_riasec: 'E', pertanyaan: 'Saya cepat dalam mengambil tanggung jawab baru' },
    { id: 20, nomor_urut: 20, tipe_riasec: 'S', pertanyaan: 'Saya tertarik untuk menyembuhkan penyakit yang dialami orang lain' },
    { id: 21, nomor_urut: 21, tipe_riasec: 'I', pertanyaan: 'Saya suka mencari tahu mengapa sebuah benda bisa bekerja' },
    { id: 22, nomor_urut: 22, tipe_riasec: 'R', pertanyaan: 'Saya suka menyusun dan merakit sesuatu' },
    { id: 23, nomor_urut: 23, tipe_riasec: 'A', pertanyaan: 'Saya adalah orang yang kreatif' },
    { id: 24, nomor_urut: 24, tipe_riasec: 'C', pertanyaan: 'Saya memberi perhatian terhadap detail' },
    { id: 25, nomor_urut: 25, tipe_riasec: 'C', pertanyaan: 'Saya suka mengetik' },
    { id: 26, nomor_urut: 26, tipe_riasec: 'I', pertanyaan: 'Saya suka menganalisis sesuatu (masalah/situasi)' },
    { id: 27, nomor_urut: 27, tipe_riasec: 'A', pertanyaan: 'Saya suka memainkan instrumen (atau bernyanyi)' },
    { id: 28, nomor_urut: 28, tipe_riasec: 'S', pertanyaan: 'Saya suka mempelajari budaya yang berbeda' },
    { id: 29, nomor_urut: 29, tipe_riasec: 'E', pertanyaan: 'Saya ingin memulai bisnis saya sendiri' },
    { id: 30, nomor_urut: 30, tipe_riasec: 'R', pertanyaan: 'Saya suka memasak' },
    { id: 31, nomor_urut: 31, tipe_riasec: 'A', pertanyaan: 'Saya suka bermain peran' },
    { id: 32, nomor_urut: 32, tipe_riasec: 'R', pertanyaan: 'Saya adalah orang yang praktikal' },
    { id: 33, nomor_urut: 33, tipe_riasec: 'I', pertanyaan: 'Saya suka bermain-main dengan angka dan diagram' },
    { id: 34, nomor_urut: 34, tipe_riasec: 'S', pertanyaan: 'Saya suka mendiskusikan berbagai isu' },
    { id: 35, nomor_urut: 35, tipe_riasec: 'C', pertanyaan: 'Saya suka mendokumentasikan pekerjaan saya dengan baik (menyimpan file, menyusun file, dsb.)' },
    { id: 36, nomor_urut: 36, tipe_riasec: 'E', pertanyaan: 'Saya suka menjadi pemimpin' },
    { id: 37, nomor_urut: 37, tipe_riasec: 'R', pertanyaan: 'Saya suka bekerja di tempat outdoor' },
    { id: 38, nomor_urut: 38, tipe_riasec: 'C', pertanyaan: 'Saya suka bekerja di kantor' },
    { id: 39, nomor_urut: 39, tipe_riasec: 'I', pertanyaan: 'Saya hebat dalam matematika' },
    { id: 40, nomor_urut: 40, tipe_riasec: 'S', pertanyaan: 'Saya suka menolong orang' },
    { id: 41, nomor_urut: 41, tipe_riasec: 'A', pertanyaan: 'Saya suka menggambar' },
    { id: 42, nomor_urut: 42, tipe_riasec: 'E', pertanyaan: 'Saya suka berpidato' },
  ];

  const questions = (window.BYOUTH_SOALS && window.BYOUTH_SOALS.length > 0)
    ? window.BYOUTH_SOALS
    : fallbackQuestions;

  // 5 Skala Likert
  const likertOptions = [
    { label: 'A', text: 'Sangat tidak setuju', value: 1, class: 'opt-sts', size: 'sz-lg' },
    { label: 'B', text: 'Tidak setuju', value: 2, class: 'opt-ts', size: 'sz-md' },
    { label: 'C', text: 'Agak setuju', value: 3, class: 'opt-ag', size: 'sz-sm' },
    { label: 'D', text: 'Setuju', value: 4, class: 'opt-s', size: 'sz-md' },
    { label: 'E', text: 'Sangat setuju', value: 5, class: 'opt-ss', size: 'sz-lg' },
  ];

  const typeColorMap = {
    'R': { name: 'Realistic', color: '#2E7D32', bg: '#E8F5E9' },
    'I': { name: 'Investigative', color: '#1565C0', bg: '#E3F2FD' },
    'A': { name: 'Artistic', color: '#7B1FA2', bg: '#F3E5F5' },
    'S': { name: 'Social', color: '#00897B', bg: '#E0F2F1' },
    'E': { name: 'Enterprising', color: '#E65100', bg: '#FFF3E0' },
    'C': { name: 'Conventional', color: '#455A64', bg: '#ECEFF1' },
  };

  // ── State ───────────────────────────────────────────────────────────────
  let currentIndex = 0;
  let answers = {};
  let autoAdvanceTimer = null;

  // ── DOM Elements ────────────────────────────────────────────────────────
  const slideIntro = document.getElementById('slideIntro');
  const slideQuestions = document.getElementById('slideQuestionsContainer');
  const slideDisclaimer = document.getElementById('slideDisclaimer');
  const slideResults = document.getElementById('slideResults');

  const btnStartAsesmen = document.getElementById('btnStartAsesmen');
  const btnPrev = document.getElementById('btnAsesmenPrev');
  const btnNext = document.getElementById('btnAsesmenNext');
  const btnFinish = document.getElementById('btnAsesmenFinish');
  const btnProceedToResults = document.getElementById('btnProceedToResults');
  const btnRetakeAsesmen = document.getElementById('btnRetakeAsesmen');
  const btnViewLatestHistory = document.getElementById('btnViewLatestHistory');

  const progressFill = document.getElementById('asesmenProgressFill');
  const progressText = document.getElementById('asesmenProgressText');
  const progressBadge = document.getElementById('asesmenProgressBadge');
  const stepDotsContainer = document.getElementById('asesmenStepDots');
  const targetContent = document.getElementById('asesmenCardContent');
  const hintText = document.getElementById('asesmenHint');

  // Raport Elements
  const chkUseRaport = document.getElementById('chkUseRaport');
  const raportInputsGrid = document.getElementById('raportInputsGrid');
  const raportOptionBox = document.getElementById('raportOptionBox');

  // ── Build 42 Step Dots ──────────────────────────────────────────────────
  function buildStepDots() {
    if (!stepDotsContainer) return;
    stepDotsContainer.innerHTML = '';
    questions.forEach((q, i) => {
      const dot = document.createElement('div');
      dot.className = 'asesmen-step-dot';
      dot.id = `dot-${i}`;
      dot.title = `Soal ${i + 1}`;
      dot.addEventListener('click', () => {
        goToQuestion(i);
      });
      stepDotsContainer.appendChild(dot);
    });
  }

  // ── Render 1 Question Card ──────────────────────────────────────────────
  function renderQuestionCard(q, qIdx) {
    const card = document.createElement('div');
    card.className = 'asesmen-card-body';

    const tInfo = typeColorMap[q.tipe_riasec] || { name: 'Asesmen', color: '#30618C', bg: '#EBF3FA' };

    card.innerHTML = `
      <div class="asesmen-q-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; flex-wrap:wrap; gap:8px;">
        <span class="dimensi-badge" style="background:${tInfo.bg}; color:${tInfo.color}; font-weight:800; font-size:12px; padding:5px 14px; border-radius:100px; border:1px solid ${tInfo.color}33;">
          ${q.tipe_riasec ? `${q.tipe_riasec} — ${tInfo.name}` : 'Pertanyaan Minat'}
        </span>
        <span class="q-number-pill" style="font-size:13px; font-weight:700; color:#64748B;">
          Pertanyaan <strong>${qIdx + 1}</strong> dari <strong>${questions.length}</strong>
        </span>
      </div>

      <div class="asesmen-q-text" style="font-size:20px; font-weight:800; color:#1E293B; line-height:1.45; margin-bottom:34px; text-align:center; max-width:760px; margin-left:auto; margin-right:auto;">
        ${q.pertanyaan}
      </div>

      <div class="likert-circles-row" id="likertRow-${q.id}">
        ${likertOptions.map(opt => `
          <label class="likert-option ${opt.class} ${answers[q.nomor_urut || q.id] === opt.value ? 'selected' : ''}" data-value="${opt.value}">
            <input type="radio" name="jawaban_${q.id}" value="${opt.value}" ${answers[q.nomor_urut || q.id] === opt.value ? 'checked' : ''}>
            <div class="likert-circle-btn ${opt.class} ${opt.size}"></div>
            <span class="likert-caption">${opt.text}</span>
          </label>
        `).join('')}
      </div>
    `;

    // Pasang listener pada pilihan Likert
    card.querySelectorAll('.likert-option').forEach(optEl => {
      optEl.addEventListener('click', (e) => {
        const val = parseInt(optEl.getAttribute('data-value'), 10);
        selectAnswer(q, val);
      });
    });

    return card;
  }

  // ── Select Answer ───────────────────────────────────────────────────────
  function selectAnswer(q, val) {
    const qKey = q.nomor_urut || q.id;
    answers[qKey] = val;

    // Update styling opsi terpilih
    const row = document.getElementById(`likertRow-${q.id}`);
    if (row) {
      row.querySelectorAll('.likert-option').forEach(el => {
        const itemVal = parseInt(el.getAttribute('data-value'), 10);
        if (itemVal === val) {
          el.classList.add('selected');
        } else {
          el.classList.remove('selected');
        }
      });
    }

    updateStepDots();
    updateProgress();
    updateNavButtons();

    // Auto-advance ke nomor berikutnya dengan delay mulus jika bukan nomor terakhir
    if (autoAdvanceTimer) clearTimeout(autoAdvanceTimer);
    if (currentIndex < questions.length - 1) {
      autoAdvanceTimer = setTimeout(() => {
        goToQuestion(currentIndex + 1);
      }, 320);
    }
  }

  // ── Go to Question ──────────────────────────────────────────────────────
  function goToQuestion(index) {
    if (index < 0 || index >= questions.length) return;
    currentIndex = index;

    const q = questions[currentIndex];
    if (targetContent) {
      targetContent.innerHTML = '';
      targetContent.appendChild(renderQuestionCard(q, currentIndex));
    }

    updateStepDots();
    updateProgress();
    updateNavButtons();
  }

  // ── Update step dots ────────────────────────────────────────────────────
  function updateStepDots() {
    questions.forEach((q, i) => {
      const dot = document.getElementById(`dot-${i}`);
      if (!dot) return;
      dot.className = 'asesmen-step-dot';
      const qKey = q.nomor_urut || q.id;
      if (answers[qKey] !== undefined) dot.classList.add('done');
      if (i === currentIndex) dot.classList.add('current');
    });
  }

  // ── Update progress bar ─────────────────────────────────────────────────
  function updateProgress() {
    const answered = Object.keys(answers).length;
    const total = questions.length;
    const pct = Math.round((answered / total) * 100);

    if (progressFill) progressFill.style.width = `${pct}%`;
    if (progressText) progressText.textContent = `${answered} / ${total} Pertanyaan`;
    if (progressBadge) progressBadge.textContent = `${pct}% Selesai`;
  }

  // ── Update Nav Buttons ──────────────────────────────────────────────────
  function updateNavButtons() {
    if (!btnPrev || !btnNext || !btnFinish) return;

    btnPrev.style.display = currentIndex === 0 ? 'none' : 'inline-flex';

    const currentKey = questions[currentIndex].nomor_urut || questions[currentIndex].id;
    const isAnswered = answers[currentKey] !== undefined;
    const allAnswered = Object.keys(answers).length === questions.length;
    const isLast = currentIndex === questions.length - 1;

    if (isLast) {
      btnNext.style.display = 'none';
      btnFinish.style.display = 'inline-flex';
      btnFinish.disabled = !allAnswered;
      if (!allAnswered) {
        btnFinish.title = 'Selesaikan semua 42 pertanyaan untuk melanjutkan.';
      } else {
        btnFinish.removeAttribute('title');
      }
    } else {
      btnNext.style.display = 'inline-flex';
      btnNext.disabled = !isAnswered;
      btnFinish.style.display = 'none';
    }

    if (hintText) {
      hintText.textContent = isAnswered
        ? 'Jawaban tersimpan. Klik Selanjutnya atau pilih nomor lain pada progress bar.'
        : 'Pilih salah satu skala jawaban untuk melanjutkan.';
    }
  }

  // ── Ambil Nilai Rapor dari Input Form ────────────────────────────────────
  function getRaportPayload() {
    const useRaport = chkUseRaport ? chkUseRaport.checked : false;
    let grades = {};

    if (useRaport) {
      const mtk = document.getElementById('inputMtk')?.value;
      const ipas = document.getElementById('inputIpas')?.value;
      const indo = document.getElementById('inputIndo')?.value;
      const ing = document.getElementById('inputIng')?.value;

      grades = {
        'Matematika': mtk !== '' ? parseFloat(mtk) : 85,
        'IPAS': ipas !== '' ? parseFloat(ipas) : 85,
        'Bahasa Indonesia': indo !== '' ? parseFloat(indo) : 85,
        'Bahasa Inggris': ing !== '' ? parseFloat(ing) : 85,
      };
    }

    return { useRaport, grades };
  }

  // ── Render Tampilan Hasil (Slide 44) ─────────────────────────────────────
  function renderResultsData(data) {
    const riasecRes = data.riasec_result;
    const topInfo = data.top_types_info || [];
    const recs = data.recommendations || [];
    const useRaport = data.use_raport;

    // 1. Holland Hero
    const codeEl = document.getElementById('resHollandCodeText');
    if (codeEl) codeEl.textContent = riasecRes.holland_code;

    const raportBadge = document.getElementById('resRaportBadge');
    if (raportBadge) {
      if (useRaport) {
        raportBadge.textContent = 'Analisis Sinergi: Minat RIASEC + Nilai Rapor';
        raportBadge.style.background = '#10B981';
      } else {
        raportBadge.textContent = 'Analisis Murni: Minat RIASEC (Tanpa Rapor)';
        raportBadge.style.background = 'rgba(255,255,255,0.25)';
      }
    }

    const recSubNote = document.getElementById('recSubRaportNote');
    if (recSubNote) {
      recSubNote.textContent = useRaport ? 'dan pencapaian rapor akademik Anda' : 'secara objektif';
    }

    // 2. Bar Distribusi 6 Tipe RIASEC
    const barsGrid = document.getElementById('riasecBarsGrid');
    if (barsGrid) {
      barsGrid.innerHTML = '';
      const order = ['R', 'I', 'A', 'S', 'E', 'C'];
      order.forEach(code => {
        const info = (window.BYOUTH_RIASEC_INFO && window.BYOUTH_RIASEC_INFO[code]) || typeColorMap[code];
        const raw = riasecRes.raw_scores[code] || 0;
        const pct = riasecRes.percent_scores[code] || 0;
        const isTop = (riasecRes.top_types || []).includes(code);

        const barCard = document.createElement('div');
        barCard.className = 'riasec-bar-item';
        barCard.style.borderColor = isTop ? (info.badge_color || info.color) : '#E2E8F0';
        if (isTop) {
          barCard.style.background = '#FFFFFF';
          barCard.style.boxShadow = '0 4px 14px rgba(48,97,140,0.08)';
        }

        barCard.innerHTML = `
          <div class="riasec-bar-header">
            <div class="riasec-bar-name">
              <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:${info.badge_color || info.color};"></span>
              <strong>${code} — ${info.name}</strong>
              ${isTop ? `<span style="font-size:10.5px; font-weight:800; background:#EBF3FA; color:var(--c-primary); padding:2px 8px; border-radius:100px;">Top Rank</span>` : ''}
            </div>
            <div class="riasec-bar-score" style="color:${info.badge_color || info.color}">
              ${raw} Poin <span style="font-size:11.5px; font-weight:600; color:#64748B;">(${pct}%)</span>
            </div>
          </div>
          <div class="riasec-bar-track">
            <div class="riasec-bar-fill" style="width:${pct}%; background:${info.badge_color || info.color};"></div>
          </div>
        `;
        barsGrid.appendChild(barCard);
      });
    }

    // 3. Penjelasan Detail 3 Tipe Tertinggi (atau seri)
    const topListContainer = document.getElementById('topTypesCardsList');
    if (topListContainer) {
      topListContainer.innerHTML = '';
      topInfo.forEach((type, idx) => {
        const card = document.createElement('div');
        card.className = `type-detail-card ${idx === 0 ? 'primary-rank' : ''}`;
        card.style.setProperty('--type-accent', type.badge_color || '#30618C');

        const jurusanHtml = (type.jurusan || []).map(j => `<li>${j}</li>`).join('');
        const karierHtml = (type.karier || []).map(k => `<li>${k}</li>`).join('');

        card.innerHTML = `
          <div class="type-detail-header">
            <div class="type-title-group">
              <h4>${idx + 1}. ${type.code} — ${type.name}</h4>
              <div class="type-headline-badge" style="color:${type.badge_color || '#30618C'};">
                ${type.headline}
              </div>
            </div>
            <span class="type-rank-tag">
              Peringkat ${idx + 1} Minat Dominan
            </span>
          </div>

          <p class="type-description-text">
            ${type.description}
          </p>

          <div class="type-columns-grid">
            <div>
              <div class="type-col-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                Contoh Jurusan yang Relevan:
              </div>
              <ul class="type-bullet-list">
                ${jurusanHtml}
              </ul>
            </div>

            <div>
              <div class="type-col-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                Contoh Karier yang Relevan:
              </div>
              <ul class="type-bullet-list">
                ${karierHtml}
              </ul>
            </div>
          </div>

          <div class="type-environment-box">
            <strong>Lingkungan yang mungkin Anda sukai:</strong> ${type.lingkungan}
          </div>
        `;

        topListContainer.appendChild(card);
      });
    }

    // 4. Kartu Rekomendasi Program Studi AI
    const recGrid = document.getElementById('recCardsGrid');
    if (recGrid) {
      recGrid.innerHTML = '';
      recs.forEach((rec, idx) => {
        const isPrimary = idx === 0;
        const card = document.createElement('div');
        card.className = `rec-card ${isPrimary ? 'primary-rec' : ''}`;

        const karierList = rec.prospek_karier
          ? rec.prospek_karier.split(',').map(s => s.trim())
          : ['Profesional Bidang Terkait'];

        card.innerHTML = `
          ${isPrimary ? `<span class="rec-top-badge">Rekomendasi Utama AI</span>` : ''}
          <div class="rec-cluster">${rec.fakultas || 'Program Studi Pilihan'}</div>

          <div style="display:flex; justify-content:space-between; align-items:center; margin-top:2px;">
            <span class="rec-match ${rec.skor >= 90 ? 'high' : ''}">
              ${rec.skor}% Kecocokan
            </span>
            ${useRaport && rec.skor_akademik ? `<span style="font-size:11px; font-weight:700; color:#059669; background:#D1FAE5; padding:2px 8px; border-radius:100px;">Rapor: ${rec.skor_akademik}</span>` : ''}
          </div>

          <h4 class="rec-title">${rec.nama_prodi}</h4>
          
          <div class="rec-ai-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Rekomendasi Pilihan
          </div>

          <p class="rec-desc">${rec.alasan || rec.deskripsi}</p>

          <div class="rec-karier-label">Prospek Karier Terkait:</div>
          <div class="rec-tags">
            ${karierList.slice(0, 4).map(k => `<span class="rec-tag">${k}</span>`).join('')}
          </div>

          <div class="rec-kampus">
            <strong>Kampus Terakreditasi PDDikti:</strong> ${rec.kampus_rekomendasi}
          </div>

          <div class="rec-action-row">
            <a href="${rec.pddikti_url || ('https://pddikti.kemdiktisaintek.go.id/pencarian/' + encodeURIComponent(rec.nama_prodi))}" target="_blank" rel="noopener noreferrer" class="btn-pddikti-badge" title="Cek akreditasi dan kampus se-Indonesia di portal resmi PDDikti">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
              Cek PDDikti Resmi
            </a>

            <a href="/siswa/konsultasi" class="btn-rec-cta ${isPrimary ? 'btn-rec-primary' : 'btn-rec-secondary'}" style="flex:1;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
              Konsultasi
            </a>
          </div>
        `;

        recGrid.appendChild(card);
      });
    }
  }

  // ── Submit Asesmen ke Backend AJAX ───────────────────────────────────────
  async function submitAssessmentToBackend() {
    const { useRaport, grades } = getRaportPayload();
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const showSpinner = (msg) => {
      if (window.showGlassLoading) {
        window.showGlassLoading(msg, 0);
      }
    };

    const hideSpinner = () => {
      if (window.hideGlassLoading) {
        window.hideGlassLoading();
      }
    };

    showSpinner('Sedang memproses hasil asesmen dan menyusun rekomendasi program studi terbaik...');

    try {
      const response = await fetch(window.BYOUTH_SUBMIT_URL || '/siswa/asesmen', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': token || '',
        },
        body: JSON.stringify({
          jawaban: answers,
          use_raport: useRaport,
          raport_grades: grades,
        }),
      });

      const data = await response.json();
      hideSpinner();

      if (data.success) {
        // Pindah ke slide hasil
        if (slideDisclaimer) slideDisclaimer.style.display = 'none';
        if (slideQuestions) slideQuestions.style.display = 'none';
        if (slideIntro) slideIntro.style.display = 'none';
        if (slideResults) {
          slideResults.style.display = 'flex';
          renderResultsData(data);
          slideResults.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      } else {
        alert(data.message || 'Gagal memproses asesmen. Silakan coba kembali.');
      }
    } catch (err) {
      hideSpinner();
      console.error(err);
      alert('Terjadi kendala koneksi saat mengirim jawaban asesmen. Pastikan jaringan internet stabil.');
    }
  }

  // ── Init Event Listeners ────────────────────────────────────────────────
  function init() {
    buildStepDots();

    // Toggle Rapor Box
    if (chkUseRaport && raportInputsGrid && raportOptionBox) {
      chkUseRaport.addEventListener('change', () => {
        if (chkUseRaport.checked) {
          raportInputsGrid.style.display = 'grid';
          raportOptionBox.classList.add('active');
        } else {
          raportInputsGrid.style.display = 'none';
          raportOptionBox.classList.remove('active');
        }
      });
    }

    // Mulai Asesmen dari Slide 0
    if (btnStartAsesmen) {
      btnStartAsesmen.addEventListener('click', () => {
        if (slideIntro) slideIntro.style.display = 'none';
        if (slideQuestions) {
          slideQuestions.style.display = 'block';
          goToQuestion(0);
          slideQuestions.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }

    // Navigasi Soal
    if (btnPrev) {
      btnPrev.addEventListener('click', () => {
        if (currentIndex > 0) goToQuestion(currentIndex - 1);
      });
    }

    if (btnNext) {
      btnNext.addEventListener('click', () => {
        if (currentIndex < questions.length - 1) goToQuestion(currentIndex + 1);
      });
    }

    // Tombol Selesai Menjawab -> Ke Slide 43 (Disclaimer)
    if (btnFinish) {
      btnFinish.addEventListener('click', () => {
        const totalAnswered = Object.keys(answers).length;
        if (totalAnswered < questions.length) {
          alert(`Anda baru menjawab ${totalAnswered} dari ${questions.length} pertanyaan. Silakan lengkapi seluruh pertanyaan terlebih dahulu.`);
          return;
        }

        if (slideQuestions) slideQuestions.style.display = 'none';
        if (slideDisclaimer) {
          slideDisclaimer.style.display = 'block';
          slideDisclaimer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }

    // Tombol Slide 43 (Disclaimer) -> Submit & Tampilkan Hasil
    if (btnProceedToResults) {
      btnProceedToResults.addEventListener('click', () => {
        submitAssessmentToBackend();
      });
    }

    // Tombol Ulangi Asesmen
    if (btnRetakeAsesmen) {
      btnRetakeAsesmen.addEventListener('click', () => {
        if (!confirm('Apakah Anda yakin ingin mengulang asesmen dari awal? Jawaban saat ini akan direset.')) {
          return;
        }
        answers = {};
        currentIndex = 0;
        if (slideResults) slideResults.style.display = 'none';
        if (slideDisclaimer) slideDisclaimer.style.display = 'none';
        if (slideIntro) {
          slideIntro.style.display = 'block';
          slideIntro.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }

    // Tombol Lihat Hasil Terakhir
    if (btnViewLatestHistory && window.BYOUTH_LATEST_ASESMEN) {
      btnViewLatestHistory.addEventListener('click', () => {
        const latest = window.BYOUTH_LATEST_ASESMEN;
        const hasil = latest.hasil_asesmen;
        if (!hasil) return;

        // Siapkan struktur data kompatibel
        const topCodes = hasil.tipe_tertinggi || (hasil.holland_code ? hasil.holland_code.split('–') : ['I']);
        const topInfo = topCodes.map(c => (window.BYOUTH_RIASEC_INFO && window.BYOUTH_RIASEC_INFO[c]) || typeColorMap[c] || { code: c, name: c, headline: '', description: '', jurusan: [], karier: [], lingkungan: '' });

        const formattedRecs = (hasil.rekomendasi || []).map(r => ({
          prodi_id: r.prodi_id,
          nama_prodi: r.program_studi?.nama_prodi || 'Program Studi',
          kode_prodi: r.program_studi?.kode_prodi || '',
          fakultas: r.program_studi?.fakultas || '',
          deskripsi: r.program_studi?.deskripsi || '',
          prospek_karier: r.program_studi?.prospek_karier || '',
          kampus_rekomendasi: r.program_studi?.kampus_rekomendasi || 'Universitas Mitra Terakreditasi',
          skor: r.skor || 90,
          alasan: r.alasan || '',
        }));

        const mockData = {
          riasec_result: {
            holland_code: hasil.holland_code || 'I–S–R',
            top_types: topCodes,
            raw_scores: hasil.detail_skor?.raw_scores || { 'R': 25, 'I': 30, 'A': 22, 'S': 28, 'E': 19, 'C': 25 },
            percent_scores: hasil.detail_skor?.percent_scores || { 'R': 71, 'I': 85, 'A': 62, 'S': 80, 'E': 54, 'C': 71 },
          },
          top_types_info: topInfo,
          recommendations: formattedRecs,
          use_raport: hasil.nilai_raport_digunakan || false,
        };

        if (slideIntro) slideIntro.style.display = 'none';
        if (slideQuestions) slideQuestions.style.display = 'none';
        if (slideDisclaimer) slideDisclaimer.style.display = 'none';
        if (slideResults) {
          slideResults.style.display = 'flex';
          renderResultsData(mockData);
          slideResults.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
