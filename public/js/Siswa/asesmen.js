/**
 * asesmen.js — Logic for single-question-at-a-time assessment
 * B-Youth Color Palette: #30618C | #F2B705 | #FAE08F | #D6D494 | #B9D0E4
 */

(function () {
  'use strict';

  // ── All questions data ──────────────────────────────────────────────────
  const questions = [
    {
      id: 1,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Logika & Komputasi',
      text: 'Saya merasa tertantang dan bersemangat saat memecahkan teka-teki logika, menyelesaikan persoalan matematika, atau menganalisis pola masalah yang rumit.'
    },
    {
      id: 2,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Teknologi & Rekayasa',
      text: 'Ketika mendengar perkembangan teknologi baru (seperti Artificial Intelligence atau komputasi awan), saya penasaran untuk mempelajari cara kerja teknis di baliknya.'
    },
    {
      id: 3,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Kreativitas & Desain',
      text: 'Saya senang memperhatikan desain antarmuka aplikasi, estetika visual, kombinasi warna, dan tipografi saat menggunakan produk digital.'
    },
    {
      id: 4,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Manajemen & Bisnis',
      text: 'Saya tertarik memahami bagaimana teknologi dan sistem informasi dapat membantu strategi pertumbuhan bisnis dan efisiensi organisasi.'
    },
    {
      id: 5,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Komunikasi',
      text: 'Saya lebih suka mendengarkan kebutuhan teman atau klien serta memfasilitasi komunikasi tim daripada bekerja sendirian tanpa interaksi.'
    },
    {
      id: 6,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Analisis Data',
      text: 'Saya menikmati membaca data statistik, membuat grafik analitik, dan mengambil keputusan penting berbasis fakta angka yang akurat.'
    }
  ];

  const likertOptions = [
    { value: 1, label: 'Sangat\nTidak', size: 'lc-1' },
    { value: 2, label: 'Tidak',       size: 'lc-2' },
    { value: 3, label: 'Netral',      size: 'lc-3' },
    { value: 4, label: 'Setuju',      size: 'lc-4' },
    { value: 5, label: 'Sangat\nSetuju', size: 'lc-5' }
  ];

  // ── State ───────────────────────────────────────────────────────────────
  let currentIndex = 0;
  const answers = {}; // { questionId: value }

  // ── DOM Refs ────────────────────────────────────────────────────────────
  const wrapper       = document.getElementById('asesmenQuestionWrapper');
  const progressFill  = document.getElementById('asesmenProgressFill');
  const progressText  = document.getElementById('asesmenProgressText');
  const progressBadge = document.getElementById('asesmenProgressBadge');
  const stepDots      = document.getElementById('asesmenStepDots');
  const btnPrev       = document.getElementById('btnAsesmenPrev');
  const btnNext       = document.getElementById('btnAsesmenNext');
  const hintText      = document.getElementById('asesmenHint');
  const completePanel = document.getElementById('asesmenCompletePanel');
  const recSection    = document.getElementById('recSection');
  const btnShowRec    = document.getElementById('btnShowRec');

  // ── Build step dots ─────────────────────────────────────────────────────
  function buildStepDots() {
    stepDots.innerHTML = '';
    questions.forEach((_, i) => {
      const dot = document.createElement('div');
      dot.className = 'asesmen-step-dot';
      dot.id = `dot-${i}`;
      stepDots.appendChild(dot);
    });
  }

  // ── Render a question card ──────────────────────────────────────────────
  function renderCard(q, animate) {
    const card = document.createElement('div');
    card.className = `asesmen-question-card dim-${q.dimensi}`;
    card.id = `qcard-${q.id}`;

    // Meta row
    const meta = document.createElement('div');
    meta.className = 'asesmen-q-meta';

    const badge = document.createElement('span');
    badge.className = `asesmen-q-badge ${q.badgeClass}`;
    badge.textContent = q.badgeText;

    const num = document.createElement('span');
    num.className = 'asesmen-q-num';
    num.textContent = `Pertanyaan ${q.id} dari ${questions.length}`;

    meta.appendChild(badge);
    meta.appendChild(num);

    // Question text
    const qtext = document.createElement('p');
    qtext.className = 'asesmen-q-text';
    qtext.textContent = `"${q.text}"`;

    // Likert scale
    const scaleArea = document.createElement('div');
    scaleArea.className = 'likert-scale-area';

    const labelsRow = document.createElement('div');
    labelsRow.className = 'likert-labels';
    const lblLeft = document.createElement('span'); lblLeft.textContent = 'Tidak Setuju';
    const lblRight = document.createElement('span'); lblRight.textContent = 'Sangat Setuju';
    labelsRow.appendChild(lblLeft);
    labelsRow.appendChild(lblRight);

    const circlesRow = document.createElement('div');
    circlesRow.className = 'likert-circles-row';

    likertOptions.forEach(opt => {
      const wrapper = document.createElement('label');
      wrapper.className = 'likert-option';
      wrapper.title = opt.label.replace('\n', ' ');

      const radio = document.createElement('input');
      radio.type = 'radio';
      radio.name = `q${q.id}`;
      radio.value = opt.value;
      if (answers[q.id] === opt.value) wrapper.classList.add('selected');

      radio.addEventListener('change', () => {
        // Deselect all
        card.querySelectorAll('.likert-option').forEach(el => el.classList.remove('selected'));
        wrapper.classList.add('selected');
        answers[q.id] = opt.value;
        updateProgress();
        updateNavButtons();

        // Auto-advance after short delay if not last question
        if (currentIndex < questions.length - 1) {
          setTimeout(() => goToQuestion(currentIndex + 1, 'next'), 420);
        } else {
          updateNavButtons();
        }
      });

      const circle = document.createElement('span');
      circle.className = `likert-circle-btn ${opt.size}`;

      // Add checkmark to size-5
      if (opt.size === 'lc-5') {
        circle.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.5"><polyline points="20 6 9 17 4 12"/></svg>`;
      }

      const caption = document.createElement('span');
      caption.className = 'likert-caption';
      caption.innerHTML = opt.label.replace('\n', '<br>');

      wrapper.appendChild(radio);
      wrapper.appendChild(circle);
      wrapper.appendChild(caption);
      circlesRow.appendChild(wrapper);
    });

    scaleArea.appendChild(labelsRow);
    scaleArea.appendChild(circlesRow);

    card.appendChild(meta);
    card.appendChild(qtext);
    card.appendChild(scaleArea);

    return card;
  }

  // ── Show a question ─────────────────────────────────────────────────────
  function goToQuestion(index, direction) {
    if (index < 0 || index >= questions.length) return;

    const oldCard = wrapper.querySelector('.asesmen-question-card.active');
    if (oldCard) {
      oldCard.classList.remove('active');
      oldCard.classList.add(direction === 'next' ? 'exit-left' : 'exit-right');
      setTimeout(() => oldCard.remove(), 500);
    }

    currentIndex = index;
    const q = questions[currentIndex];
    const card = renderCard(q, true);

    // Animate from right if next, from left if prev
    if (direction === 'next') {
      card.style.transform = 'translateX(60px) scale(0.97)';
      card.style.opacity = '0';
    } else {
      card.style.transform = 'translateX(-60px) scale(0.97)';
      card.style.opacity = '0';
    }

    wrapper.appendChild(card);

    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        card.classList.add('active');
      });
    });

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
      if (answers[q.id] !== undefined) dot.classList.add('done');
      if (i === currentIndex) dot.classList.add('current');
    });
  }

  // ── Update progress bar ─────────────────────────────────────────────────
  function updateProgress() {
    const answered = Object.keys(answers).length;
    const total = questions.length;
    const pct = Math.round((answered / total) * 100);

    progressFill.style.width = `${pct}%`;
    progressText.textContent = `${answered} / ${total} Pertanyaan`;
    progressBadge.textContent = `${pct}% Selesai`;
  }

  // ── Update nav buttons ──────────────────────────────────────────────────
  function updateNavButtons() {
    btnPrev.style.display = currentIndex === 0 ? 'none' : 'inline-flex';
    const allAnswered = Object.keys(answers).length === questions.length;
    const isLast = currentIndex === questions.length - 1;

    if (isLast) {
      btnNext.style.display = 'none';
      document.getElementById('btnAsesmenFinish').style.display = allAnswered ? 'inline-flex' : 'none';
    } else {
      btnNext.style.display = 'inline-flex';
      btnNext.disabled = answers[questions[currentIndex].id] === undefined;
      document.getElementById('btnAsesmenFinish').style.display = 'none';
    }

    if (hintText) {
      hintText.textContent = answers[questions[currentIndex].id] === undefined
        ? 'Pilih jawaban untuk melanjutkan ke pertanyaan berikutnya.'
        : 'Jawaban terpilih. Klik Lanjut atau jawaban lain untuk mengubah.';
    }
  }

  // ── Finish assessment ───────────────────────────────────────────────────
  function finishAssessment() {
    wrapper.style.display = 'none';
    document.getElementById('asesmenNavRow').style.display = 'none';
    completePanel.classList.add('visible');
    updateStepDots();
  }

  // ── Show recommendations ────────────────────────────────────────────────
  function showRecommendations() {
    completePanel.style.display = 'none';
    recSection.style.display = 'block';
    recSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // ── Init ────────────────────────────────────────────────────────────────
  function init() {
    buildStepDots();
    goToQuestion(0, 'next');

    btnPrev.addEventListener('click', () => goToQuestion(currentIndex - 1, 'prev'));
    btnNext.addEventListener('click', () => goToQuestion(currentIndex + 1, 'next'));

    document.getElementById('btnAsesmenFinish').addEventListener('click', finishAssessment);
    if (btnShowRec) btnShowRec.addEventListener('click', showRecommendations);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
