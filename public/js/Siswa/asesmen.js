/**
 * asesmen.js — Logic for 60 Questions Assessment (Pemetaan Minat Program Studi)
 * B-Youth Color Palette: #30618C | #F2B705 | #FAE08F | #D6D494 | #B9D0E4
 */

(function () {
  'use strict';

  // ── 60 Questions Data across 6 Academic Clusters ────────────────────────
  const questions = [
    // ── Cluster 1: Sains, Data & Komputasi (1-10) ──
    {
      id: 1,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya merasa tertantang dan bersemangat saat memecahkan teka-teki logika, menyelesaikan persoalan matematika, atau menganalisis pola masalah yang kompleks.'
    },
    {
      id: 2,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya tertarik mempelajari cara kerja logika pemrograman, kecerdasan buatan, atau pengembangan perangkat lunak.'
    },
    {
      id: 3,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya menikmati membaca data statistik, membuat grafik analitik, dan mengambil kesimpulan berbasis fakta angka yang akurat.'
    },
    {
      id: 4,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya suka meneliti fenomena alam dan prinsip-prinsip sains murni (seperti fisika teoretis atau kimia dasar) secara mendalam.'
    },
    {
      id: 5,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya senang merancang skema perhitungan atau mengotomatisasi pekerjaan menggunakan rumus dan teknologi komputasi.'
    },
    {
      id: 6,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya lebih nyaman dengan penjelasan atau teori yang didukung oleh bukti kuantitatif dan penalaran matematis yang jelas.'
    },
    {
      id: 7,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya tertarik memahami cara kerja sistem keamanan data dan arsitektur jaringan informasi digital.'
    },
    {
      id: 8,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya betah menghabiskan waktu menelaah tabel angka atau kode program untuk menemukan dan memperbaiki letak kekeliruan (troubleshooting).'
    },
    {
      id: 9,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya ingin mengembangkan aplikasi atau sistem digital yang mampu mengolah data dalam skala besar untuk membantu pengambilan keputusan.'
    },
    {
      id: 10,
      dimensi: 'logika',
      badgeClass: 'badge-logika',
      badgeText: 'Sains & Komputasi',
      text: 'Saya antusias mengikuti perkembangan artikel riset sains, penemuan algoritma baru, atau inovasi teknologi mutakhir.'
    },

    // ── Cluster 2: Teknik & Rekayasa Sistem (11-20) ──
    {
      id: 11,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya penasaran membongkar dan merakit kembali komponen alat elektronik atau mekanik untuk mengetahui mekanisme kerjanya.'
    },
    {
      id: 12,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya tertarik mempelajari rancang bangun konstruksi fisik, seperti gedung tahan gempa, jembatan, atau infrastruktur tata kota.'
    },
    {
      id: 13,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya senang mengamati cara kerja mesin otomotif, sistem hidrolik, atau dinamika fluida pada pesawat dan kapal.'
    },
    {
      id: 14,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya menikmati proses merakit sirkuit elektronika, sensor otomatisasi, atau sistem robotika sederhana.'
    },
    {
      id: 15,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya lebih menikmati praktikum langsung di bengkel kerja atau laboratorium daripada sekadar mempelajari teori di kelas.'
    },
    {
      id: 16,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya tertarik mempelajari optimasi jalur produksi pabrik, efisiensi rantai pasok industri, dan ergonomi kerja operasional.'
    },
    {
      id: 17,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya merasa tertantang merancang model prototipe fisik menggunakan perangkat lunak gambar teknik (CAD atau 3D modeling).'
    },
    {
      id: 18,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya cepat tanggap dalam mencari solusi mekanis ketika terjadi malfungsi pada peralatan fisik di rumah atau sekolah.'
    },
    {
      id: 19,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya tertarik mempelajari pemanfaatan energi terbarukan, sistem kelistrikan tenaga surya, dan teknologi ramah lingkungan.'
    },
    {
      id: 20,
      dimensi: 'teknik',
      badgeClass: 'badge-logika',
      badgeText: 'Teknik & Rekayasa',
      text: 'Saya teliti dalam menghitung kekuatan material dan aspek keselamatan kerja sebelum merealisasikan sebuah rancangan fisik.'
    },

    // ── Cluster 3: Kesehatan, Hayati & Lingkungan (21-30) ──
    {
      id: 21,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya tertarik mempelajari struktur anatomi tubuh manusia, mekanisme faal organ, dan respons imun terhadap penyakit.'
    },
    {
      id: 22,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya ingin memahami kandungan senyawa obat-obatan, formulasi farmasi, dan interaksinya di dalam tubuh manusia.'
    },
    {
      id: 23,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya peduli terhadap kesehatan masyarakat, pencegahan wabah penyakit menular, dan standar sanitasi lingkungan.'
    },
    {
      id: 24,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya senang mengamati ekosistem alam, konservasi flora dan fauna, serta keanekaragaman hayati lingkungan tropis.'
    },
    {
      id: 25,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya memiliki empati dan kesabaran tinggi untuk merawat dan mendampingi pemulihan orang yang sedang sakit.'
    },
    {
      id: 26,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya tertarik pada penerapan bioteknologi modern dalam pemuliaan tanaman, rekayasa genetika, atau keamanan pangan.'
    },
    {
      id: 27,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya menyukai pengamatan spesimen mikroskopis di laboratorium biologi untuk meneliti bakteri, virus, atau jaringan sel.'
    },
    {
      id: 28,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya tertarik mempelajari pola gizi seimbang, ilmu dietetik, dan hubungannya dengan kebugaran serta pencegahan penyakit kronis.'
    },
    {
      id: 29,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya peduli terhadap penanggulangan limbah berbahaya, pengolahan air bersih, dan pemulihan lahan terdampak polusi.'
    },
    {
      id: 30,
      dimensi: 'kesehatan',
      badgeClass: 'badge-sosial',
      badgeText: 'Kesehatan & Hayati',
      text: 'Saya tertarik pada kesehatan hewan, peternakan berkelanjutan, atau perlindungan satwa langka.'
    },

    // ── Cluster 4: Ekonomi, Bisnis & Manajemen (31-40) ──
    {
      id: 31,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya tertarik mempelajari pergerakan pasar modal, instrumen investasi keuangan, dan perbankan.'
    },
    {
      id: 32,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya senang menganalisis strategi pemasaran sebuah produk agar mampu menjangkau target pasar secara efektif.'
    },
    {
      id: 33,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya rapi dalam menyusun anggaran keuangan pribadi/kegiatan, mencatat penerimaan pengeluaran, serta menganalisis laporan akuntansi.'
    },
    {
      id: 34,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya suka mempelajari kiat sukses para pendiri usaha dalam mengelola modal, mengatasi risiko, dan mengembangkan perusahaan.'
    },
    {
      id: 35,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya memiliki inisiatif memimpin tim kerja, membagi tanggung jawab, dan memantau pencapaian target kerja bersama.'
    },
    {
      id: 36,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya senang menganalisis alasan di balik keputusan konsumen ketika memilih suatu merek produk di era digital.'
    },
    {
      id: 37,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya percaya diri dalam bernegosiasi dan meyakinkan pihak lain untuk mencapai kesepakatan kerjasama yang saling menguntungkan.'
    },
    {
      id: 38,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya tertarik mengamati pengaruh kebijakan suku bunga, perdagangan internasional, dan inflasi terhadap daya beli masyarakat.'
    },
    {
      id: 39,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya antusias menemukan peluang usaha baru berdasarkan permasalahan yang sering dihadapi masyarakat sekitar.'
    },
    {
      id: 40,
      dimensi: 'bisnis',
      badgeClass: 'badge-bisnis',
      badgeText: 'Ekonomi & Bisnis',
      text: 'Saya menyukai pengelolaan operasional dan tata kelola organisasi agar berjalan teratur, efektif, dan minim pemborosan.'
    },

    // ── Cluster 5: Sosial, Humaniora & Pendidikan (41-50) ──
    {
      id: 41,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya tertarik mempelajari faktor kejiwaan dan psikologis yang melandasi perilaku dan emosi individu.'
    },
    {
      id: 42,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya tertarik menelaah aturan hukum, perundang-undangan negara, dan penegakan keadilan dalam masyarakat.'
    },
    {
      id: 43,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya pendengar yang baik dan sering menjadi tempat teman berkonsultasi mengenai persoalan pribadi atau belajar.'
    },
    {
      id: 44,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya senang menjelaskan materi pelajaran kepada teman sebaya hingga mereka dapat memahami topik tersebut dengan baik.'
    },
    {
      id: 45,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya tertarik pada isu hubungan internasional, diplomasi antarnegara, dan penyelesaian konflik geopolitik.'
    },
    {
      id: 46,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya senang membaca telaah sejarah, dinamika kebudayaan antropologis, dan transformasi sosial kemasyarakatan.'
    },
    {
      id: 47,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya memiliki minat terlibat dalam kegiatan advokasi sosial, komunitas relawan, atau pelayanan bimbingan konseling.'
    },
    {
      id: 48,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya terampil menyusun narasi tulisan ilmiah atau berpidato secara terstruktur dalam forum diskusi publik.'
    },
    {
      id: 49,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya tertarik mempelajari kebahasaan, analisis linguistik, kajian sastra, dan komunikasi lintas latar belakang budaya.'
    },
    {
      id: 50,
      dimensi: 'sosial',
      badgeClass: 'badge-sosial',
      badgeText: 'Sosial & Humaniora',
      text: 'Saya bersikap terbuka menghargai perbedaan pandangan nilai budaya dan mengutamakan jalan musyawarah dalam kelompok.'
    },

    // ── Cluster 6: Seni, Desain & Industri Kreatif (51-60) ──
    {
      id: 51,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya senang mengekspresikan gagasan dan imajinasi melalui karya visual (seperti menggambar, fotografi, atau sketsa desain).'
    },
    {
      id: 52,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya peka terhadap estetika komposisi warna, tata letak grafis, dan pemilihan tipografi pada media cetak maupun antarmuka aplikasi.'
    },
    {
      id: 53,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya menyukai penataan tata ruang interior, pencahayaan ruang, atau estetika struktur arsitektur yang harmonis.'
    },
    {
      id: 54,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya tertarik merancang papan cerita (storyboard), animasi karakter visual, atau pembuatan konten videografi yang memikat.'
    },
    {
      id: 55,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya suka mendesain bentuk produk yang fungsional, ergonomis, sekaligus memiliki nilai seni yang tinggi.'
    },
    {
      id: 56,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya menikmati proses mengedit audio-visual, pembuatan efek digital, dan eksplorasi aplikasi multimedia kreatif.'
    },
    {
      id: 57,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya suka memodifikasi barang bekas atau benda di sekitar menjadi karya kerajinan tangan yang memiliki daya tarik artistik.'
    },
    {
      id: 58,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya antusias mengamati perkembangan tren desain kontemporer, pameran galeri seni, atau instalasi kreatif.'
    },
    {
      id: 59,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya lebih menikmati tugas proyek yang memberikan kebebasan eksplorasi konsep kreatif daripada instruksi yang terlalu kaku.'
    },
    {
      id: 60,
      dimensi: 'kreatif',
      badgeClass: 'badge-kreatif',
      badgeText: 'Seni & Desain',
      text: 'Saya tertarik merancang identitas visual merek (seperti logo, kemasan produk, dan konsep branding visual yang konsisten).'
    }
  ];

  const likertOptions = [
    { value: 1, key: 'sts', label: 'Sangat Tidak Setuju', shortLabel: 'Sangat<br>Tidak Setuju', size: 'sz-lg' },
    { value: 2, key: 'ts',  label: 'Tidak Setuju',        shortLabel: 'Tidak<br>Setuju',        size: 'sz-md' },
    { value: 3, key: 'netral', label: 'Netral',           shortLabel: 'Netral',                size: 'sz-sm' },
    { value: 4, key: 's',   label: 'Setuju',              shortLabel: 'Setuju',                size: 'sz-md' },
    { value: 5, key: 'ss',  label: 'Sangat Setuju',       shortLabel: 'Sangat<br>Setuju',       size: 'sz-lg' }
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
  const btnFinish     = document.getElementById('btnAsesmenFinish');
  const hintText      = document.getElementById('asesmenHint');
  const completePanel = document.getElementById('asesmenCompletePanel');
  const recSection    = document.getElementById('recSection');
  const btnShowRec    = document.getElementById('btnShowRec');

  // ── Build step dots ─────────────────────────────────────────────────────
  function buildStepDots() {
    if (!stepDots) return;
    stepDots.innerHTML = '';
    questions.forEach((_, i) => {
      const dot = document.createElement('div');
      dot.className = 'asesmen-step-dot';
      dot.id = `dot-${i}`;
      dot.title = `Pertanyaan ${i + 1}`;
      dot.addEventListener('click', () => {
        goToQuestion(i, i > currentIndex ? 'next' : 'prev');
      });
      stepDots.appendChild(dot);
    });
  }

  // ── Render a question card ──────────────────────────────────────────────
  function renderCard(q) {
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

    const circlesRow = document.createElement('div');
    circlesRow.className = 'likert-circles-row';

    likertOptions.forEach(opt => {
      const optWrapper = document.createElement('label');
      optWrapper.className = `likert-option opt-${opt.key}`;
      optWrapper.title = opt.label;

      const radio = document.createElement('input');
      radio.type = 'radio';
      radio.name = `q${q.id}`;
      radio.value = opt.value;
      if (answers[q.id] === opt.value) optWrapper.classList.add('selected');

      radio.addEventListener('change', () => {
        card.querySelectorAll('.likert-option').forEach(el => el.classList.remove('selected'));
        optWrapper.classList.add('selected');
        answers[q.id] = opt.value;
        updateProgress();
        updateNavButtons();

        // Auto-advance setelah jeda sejenak yang halus
        if (currentIndex < questions.length - 1) {
          setTimeout(() => goToQuestion(currentIndex + 1, 'next'), 350);
        } else {
          updateNavButtons();
        }
      });

      const circle = document.createElement('span');
      circle.className = `likert-circle-btn opt-${opt.key} ${opt.size}`;

      const caption = document.createElement('span');
      caption.className = 'likert-caption';
      caption.innerHTML = opt.shortLabel;

      optWrapper.appendChild(radio);
      optWrapper.appendChild(circle);
      optWrapper.appendChild(caption);
      circlesRow.appendChild(optWrapper);
    });

    scaleArea.appendChild(circlesRow);

    card.appendChild(meta);
    card.appendChild(qtext);
    card.appendChild(scaleArea);

    return card;
  }

  // ── Show a question ─────────────────────────────────────────────────────
  function goToQuestion(index, direction) {
    if (index < 0 || index >= questions.length) return;

    const currentWrapper = document.getElementById('asesmenQuestionWrapper');
    if (!currentWrapper) return;

    // Bersihkan kartu sebelumnya secara langsung
    currentWrapper.innerHTML = '';

    currentIndex = index;
    const q = questions[currentIndex];
    const card = renderCard(q);
    card.classList.add('active');

    currentWrapper.appendChild(card);

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

    if (progressFill) progressFill.style.width = `${pct}%`;
    if (progressText) progressText.textContent = `${answered} / ${total} Pertanyaan`;
    if (progressBadge) progressBadge.textContent = `${pct}% Selesai`;
  }

  // ── Update nav buttons ──────────────────────────────────────────────────
  function updateNavButtons() {
    if (!btnPrev || !btnNext || !btnFinish) return;

    btnPrev.style.display = currentIndex === 0 ? 'none' : 'inline-flex';
    const allAnswered = Object.keys(answers).length === questions.length;
    const isLast = currentIndex === questions.length - 1;

    if (isLast) {
      btnNext.style.display = 'none';
      btnFinish.style.display = allAnswered ? 'inline-flex' : 'none';
    } else {
      btnNext.style.display = 'inline-flex';
      btnNext.disabled = answers[questions[currentIndex].id] === undefined;
      btnFinish.style.display = 'none';
    }

    if (hintText) {
      hintText.textContent = answers[questions[currentIndex].id] === undefined
        ? 'Pilih jawaban untuk lanjut ke nomor berikutnya.'
        : 'Jawaban tersimpan. Klik Lanjut atau nomor lain untuk berpindah.';
    }
  }

  // ── Finish assessment ───────────────────────────────────────────────────
  function finishAssessment() {
    if (!wrapper || !completePanel) return;

    const doFinish = () => {
      wrapper.style.display = 'none';
      const navRow = document.getElementById('asesmenNavRow');
      if (navRow) navRow.style.display = 'none';
      completePanel.classList.add('visible');
      updateStepDots();
    };

    if (window.showGlassLoading) {
      window.showGlassLoading('Menganalisis hasil tes psikometri AI...', 900, doFinish);
    } else {
      doFinish();
    }
  }

  // ── Show recommendations ────────────────────────────────────────────────
  function showRecommendations() {
    if (!completePanel || !recSection) return;

    const doShow = () => {
      completePanel.style.display = 'none';
      recSection.style.display = 'block';
      recSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    if (window.showGlassLoading) {
      window.showGlassLoading('Menyusun rekomendasi program studi terbaik...', 850, doShow);
    } else {
      doShow();
    }
  }

  // ── Init ────────────────────────────────────────────────────────────────
  function init() {
    buildStepDots();
    goToQuestion(0, 'next');

    if (btnPrev) btnPrev.addEventListener('click', () => goToQuestion(currentIndex - 1, 'prev'));
    if (btnNext) btnNext.addEventListener('click', () => goToQuestion(currentIndex + 1, 'next'));

    if (btnFinish) btnFinish.addEventListener('click', finishAssessment);
    if (btnShowRec) btnShowRec.addEventListener('click', showRecommendations);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
