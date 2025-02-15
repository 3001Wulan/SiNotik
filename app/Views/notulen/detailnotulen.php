<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Notulensi</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/detailnotulennotulen.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script type="module" src="https://unpkg.com/emoji-picker-element"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="light-mode">
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
      </div>
      <ul>
        <li>
          <a href="/notulen/dashboard_notulen" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
            <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
            Dashboard
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="<?php echo ($current_page == 'melihat_notulen') ? 'active notulensi-pegawai' : 'inactive'; ?>">
            <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
            Notulensi
          </a>
          <div class="dropdown-content">
            <a href="/notulen/melihatnotulen" class="dropdown-item">
              <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
              <span>Daftar Notulensi</span>
            </a>
            <a href="/notulen/buatnotulen" class="dropdown-item">
              <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
              <span>Buat Notulensi</span>
            </a>
          </div>
        </li>
        <li>
          <a href="/notulen/riwayatnotulen" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
            <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
            Riwayat Notulensi
          </a>
        </li>
        <li>
          <a href="notulen/jadwalrapatnotulen" class="inactive">
            <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
            Jadwal Rapat
          </a>
        </li>
        <li>
          <a href="/notulen/historynotulen" class="inactive">
            <img src="<?php echo base_url('assets/images/distribusi.png'); ?>" alt="Distribusi Notulensi Icon" class="sidebar-icon">
            Distribusi Notulensi
          </a>
        </li>
        <li>
          <a href="/notulen/panduannotulen" class="inactive">
            <img src="<?php echo base_url('assets/images/panduanpengguna.png'); ?>" alt="Panduan Pengguna Icon" class="sidebar-icon">
            Panduan Pengguna
          </a>
        </li>
      </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
      <div class="top-bar">
        <!-- Dark Mode Toggle -->
        <div class="toggle-dark-mode">
          <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
        </div>

        <!-- User Info -->
        <div class="user-info">
          <div class="user-text">
            <div class="user-name">
              <span><?= session()->get('nama') ? session()->get('nama') : 'Nama Tidak Ditemukan'; ?></span>
            </div>
            <div class="user-role">
              <span><?= session()->get('role') ? ucfirst(session()->get('role')) : 'Role Tidak Ditemukan'; ?></span>
            </div>
          </div>
          <div>
            <img src="<?= base_url('assets/images/profiles/' . (file_exists('assets/images/profiles/' . session()->get('profil_foto')) ? session()->get('profil_foto') : 'delvaut.png')) ?>" alt="User  Photo" class="header-profile-img" id="profile-icon">
          </div>
        </div>
      </div>

      <!-- Page Title -->
      <div class="page-title">
        <h2><?= esc($notulensi['judul']) ?></h2>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <div class="outer-blue-background">
          <div class="left-blue"></div> <!-- Left blue section -->
          <div class="feedback-container">
            <div class="feedback-content">
              <div class="content-wrapper">
                <div class="agenda-section">
                  <div class="agenda-item main-agenda">
                    <div class="agenda-header">
                      <span class="agenda-title">Agenda:</span>
                      <div class="agenda-numbers">
                        <?php if (!empty($agenda) && is_array($agenda)): ?>
                          <ul style="list-style-type: none; padding-left: 0;">
                            <?php foreach ($agenda as $index => $item): ?>
                              <li><?= esc(trim($item)) ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <div class="agenda-title">Partisipan</div>
                  <div class="agenda-partisipan">
                    <?php if (!empty($notulensi['partisipan']) && is_array($notulensi['partisipan'])): ?>
                      <ul>
                        <?php foreach ($notulensi['partisipan'] as $index => $partisipan): ?>
                          <li><?= ($index + 1) . '. ' . esc($partisipan) ?></li>
                        <?php endforeach; ?>
                      </ul>
                    <?php elseif (!empty($notulensi['partisipan'])): ?>
                      <p><?= esc($notulensi['partisipan']) ?></p>
                    <?php else: ?>
                      <p>Tidak ada partisipan yang terdaftar.</p>
                    <?php endif; ?>
                  </div>

                  <div class="agenda-title">Partisipan Non Pegawai</div>
                  <div class="agenda-partisipannon">
                    <?php if (!empty($notulensi['partisipan_non_pegawai']) && is_array($notulensi['partisipan_non_pegawai'])): ?>
                      <ul>
                        <?php foreach ($notulensi['partisipan_non_pegawai'] as $index => $nonPegawai): ?>
                          <li><?= ($index + 1) . '. ' . esc($nonPegawai) ?></li>
                        <?php endforeach; ?>
                      </ul>
                    <?php elseif (!empty($notulensi['partisipan_non_pegawai'])): ?>
                      <p><?= esc($notulensi['partisipan_non_pegawai']) ?></p>
                    <?php else: ?>
                      <p>Tidak ada partisipan non-pegawai yang terdaftar.</p>
                    <?php endif; ?>
                  </div>

                  <div class="agenda-title">Pembahasan</div>
                  <div class="agenda-isi">
                    <p><?= nl2br($agendaIsi) ?></p>
                  </div>
                </div>

                <div class="documentation-section">
                  <div class="documentation-images">
                    <?php if (!empty($dokumentasi) && isset($dokumentasi[0]['foto_dokumentasi']) && $dokumentasi[0]['foto_dokumentasi']): ?>
                      <img src="<?= base_url('uploads/' . esc($dokumentasi[0]['foto_dokumentasi'])) ?>" alt="Dokumentasi Foto" class="header-profile-img" id="profile-icon">
                    <?php else: ?>
                      <img src="" alt="Dokumentasi Foto" class="header-profile-img" id="profile-icon">
                    <?php endif; ?>
                  </div>
                  <button class="download-button" id="downloadButton">Unduh</button>
                </div>

                <!-- Comment Section -->
                <div class="comment-section">
                  <button id="commentButton" class="comment-icon">
                    <i class="fas fa-comment"></i> 
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
       <!-- Pop-up untuk Komentar -->
  <div id="commentPopup" class="comment-popup" style="display: none;">
    <div class="popup-content">
      <span class="close-popup" id="closePopup">&times;</span>
      <h3>Komentar</h3>
      <!-- Daftar komentar -->
      <div id="commentList">
        <?php foreach ($feedbacks as $k): ?>
          <div class="comment-item">
            <img src="<?= base_url('assets/images/profiles/' . ($k['profil_foto'] ?: 'default.png')) ?>" alt="Profile" class="comment-avatar">
            <div class="comment-body">
              <strong class="comment-name"><?= esc($k['user_nama']) ?></strong>
              <p class="comment-text"><?= esc($k['isi']) ?></p>
              <small><?= date('d M Y, H:i', strtotime($k['tanggal_feedback'])) ?></small>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="comment-input-container">
    <input type="hidden" id="notulensi_id" value="<?= esc($notulensi['notulensi_id']) ?>">
    <div class="textarea-container">
        <textarea id="newComment" placeholder="Tulis komentar..."></textarea>
        <button type="button" id="emojiButton">😊</button>
    </div>
    <button id="submitComment">
        <i class="fas fa-paper-plane"></i>
    </button>
</div>


  </div>
  <div id="emojiPicker" class="emoji-picker" style="display: none;"></div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const themeIcon = document.getElementById('toggleDarkMode');
      const body = document.body;

      // Cek preferensi tema yang disimpan
      if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        themeIcon.src = '<?= base_url('assets/images/sun.png') ?>';
      }

      themeIcon.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
          themeIcon.src = '<?= base_url('assets/images/sun.png') ?>';
          localStorage.setItem('theme', 'dark');
        } else {
          themeIcon.src = '<?= base_url('assets/images/moon.png') ?>';
          localStorage.setItem('theme', 'light');
        }
      });
      
      // Pop-up Komentar
      const commentButton = document.getElementById('commentButton');
      const commentPopup = document.getElementById('commentPopup');
      const closePopup = document.getElementById('closePopup');
      const submitComment = document.getElementById('submitComment');
      const newComment = document.getElementById('newComment');
      const commentList = document.getElementById('commentList');
      const emojiButton = document.getElementById('emojiButton');

      commentButton.addEventListener('click', () => {
        commentPopup.style.display = 'flex'; // Menampilkan pop-up
      });

      closePopup.addEventListener('click', () => {
        commentPopup.style.display = 'none'; // Menyembunyikan pop-up
      });

      submitComment.addEventListener('click', () => {
        const commentText = newComment.value.trim();
        const notulensiId = document.getElementById('notulensi_id').value;

        if (commentText) {
          // Kirim permintaan AJAX untuk menyimpan komentar
          fetch('<?= base_url('lihatnotulen/saveFeedback') ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
              notulensi_id: notulensiId,
              isi: commentText
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              const commentItem = document.createElement('div');
              commentItem.classList.add('comment-item', 'user-comment'); 
              commentItem.innerHTML = `
                <div class="comment-body">
                  <strong class="comment-name">Anda</strong>
                  <p class="comment-text">${commentText}</p>
                </div>
              `;
              commentList.appendChild(commentItem);
              newComment.value = ''; // Kosongkan input
            } else {
              alert(data.message); // Tampilkan pesan kesalahan
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim komentar.');
          });
        }
      });

      emojiButton.addEventListener('click', () => {
  const pickerContainer = document.getElementById('emojiPicker');
  if (pickerContainer.style.display === 'none' || pickerContainer.style.display === '') {
    pickerContainer.style.display = 'block';
    // Jika belum ada elemen <emoji-picker>, buat dan tambahkan
    if (!pickerContainer.querySelector('emoji-picker')) {
      const emojiPicker = document.createElement('emoji-picker');
      pickerContainer.appendChild(emojiPicker);
      emojiPicker.addEventListener('emoji-click', event => {
        const emoji = event.detail.unicode;
        newComment.value += emoji;
      });
    }
  } else {
    pickerContainer.style.display = 'none';
  }
});

document.getElementById('downloadButton').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ unit: 'cm', format: 'a4' });

    // Mengambil konten dari halaman
    const title = "Notulensi Rapat";
    const agendaItems = [...document.querySelectorAll('.agenda-numbers li')]
        .map((item, index) => `${index + 1}. ${item.innerText.trim()}`)
        .join('\n') || 'Tidak ada agenda.';
    const discussion = document.querySelector('.agenda-isi')?.innerText.trim() || 'Tidak ada pembahasan.';
    
    // Mengambil daftar partisipan pegawai dan non pegawai
    const participants = document.querySelector('.agenda-partisipan ')
        ? [...document.querySelectorAll('.agenda-partisipan ')]
            .map((item, index) => `${index + 1}. ${item.innerText.trim()}`)
            .join('\n')
        : 'Belum ada data partisipan.';

    const nonEmployeeParticipants = document.querySelector('.agenda-partisipannon ')
        ? [...document.querySelectorAll('.agenda-partisipannon ')]
            .map((item, index) => `${index + 1}. ${item.innerText.trim()}`)
            .join('\n')
        : 'Tidak ada partisipan non pegawai.';

    // Mengambil dokumentasi jika ada
    const documentationImage = document.querySelector('.documentation-images img')?.src;

    // Variabel ukuran halaman dan margin
    const pageWidth = doc.internal.pageSize.getWidth();
    const leftMargin = 2.54, rightMargin = 2.54;
    const maxWidth = pageWidth - (leftMargin + rightMargin);
    let y = 2.5; 
    const pageHeight = doc.internal.pageSize.height - 2.54; 

    // Fungsi untuk mengecek overflow halaman & tambah halaman baru jika perlu
    const checkPageOverflow = (extraSpace = 1) => {
        if (y + extraSpace > pageHeight) {
            doc.addPage();
            y = 3;
        }
    };

    // Fungsi untuk menambahkan teks biasa (rata kiri) dengan font Times New Roman ukuran 12
    const addNormalText = (text) => {
        checkPageOverflow(1);
        doc.setFont("times", "normal");
        doc.setFontSize(12);
        const textLines = doc.splitTextToSize(text, maxWidth);
        textLines.forEach(line => {
            doc.text(line, leftMargin, y);
            y += 0.5;
        });
    };

    // Fungsi untuk menambahkan teks justified (pembahasan) dengan font Times New Roman ukuran 12
    const addJustifiedText = (text) => {
        doc.setFont("times", "normal");
        doc.setFontSize(12);
        const textLines = doc.splitTextToSize(text, maxWidth);
        textLines.forEach((line, index) => {
            checkPageOverflow(0.5);
            let words = line.split(" ");

            if (words.length > 1 && index !== textLines.length - 1) {
                let totalSpacing = (maxWidth - doc.getTextWidth(line)) / (words.length - 1);
                let x = leftMargin;
                words.forEach(word => {
                    doc.text(word, x, y);
                    x += doc.getTextWidth(word) + totalSpacing;
                });
            } else {
                doc.text(line, leftMargin, y);
            }
            y += 0.5;
        });
    };

    // Header (Tetap Helvetica, Bold, Ukuran lebih besar)
    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.text('Dinas Kominfo Sook Selatan', pageWidth / 2, y, { align: "center" });
    doc.setFontSize(11);
    y += 1.2;
    doc.text(`Tanggal: ${new Date().toLocaleDateString()}`, pageWidth / 2, y, { align: "center" });
    doc.setFontSize(14);
    y += 1;
    doc.text('Notulensi Rapat', pageWidth / 2, y, { align: "center" });

    // Garis pemisah
    y += 1;
    doc.line(leftMargin, y, pageWidth - rightMargin, y);
    y += 1.3;

    // Menampilkan Judul Notulensi
    doc.setFontSize(16);
    doc.setFont("helvetica", "bold");
    doc.text(title, pageWidth / 2, y, { align: "center" });
    y += 1.5;

    // Fungsi untuk menambahkan judul per bagian (Font tetap bold)
    const addSectionTitle = (text) => {
        checkPageOverflow(1);
        doc.setFont("helvetica", "bold");
        doc.setFontSize(12);
        doc.text(text, leftMargin, y);
        y += 0.7;
    };

    // Menambahkan konten ke dalam PDF
    addSectionTitle('Agenda:');
    addNormalText(agendaItems);

    addSectionTitle('Partisipan Pegawai:');
    addNormalText(participants);

    addSectionTitle('Partisipan Non Pegawai:');
    addNormalText(nonEmployeeParticipants);

    addSectionTitle('Pembahasan:');
    addJustifiedText(discussion); 

    // Menambahkan gambar jika ada
    if (documentationImage) {
        checkPageOverflow(10);
        addSectionTitle('Dokumentasi:');
        const imgWidth = 7, imgHeight = 9;
        doc.addImage(documentationImage, 'JPEG', (pageWidth - imgWidth) / 2, y, imgWidth, imgHeight);
        y += imgHeight + 1;
    }

    // Simpan PDF
    doc.save('notulensi.pdf');
});

    });
    document.addEventListener("DOMContentLoaded", function () {
    const profileIcon = document.getElementById("profile-icon");
    const dropdownMenu = document.getElementById("dropdownMenu");
    const logoutLink = document.getElementById("logoutLink");
    const logoutPopupOverlay = document.getElementById("logoutPopupOverlay");
    const confirmLogout = document.getElementById("confirmLogout");
    const cancelLogout = document.getElementById("cancelLogout");

    profileIcon.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdownMenu.classList.toggle("show");
    });

    document.addEventListener("click", function (event) {
        if (!dropdownMenu.contains(event.target) && !profileIcon.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });

    logoutLink.addEventListener("click", function (event) {
        event.preventDefault();
        logoutPopupOverlay.style.display = "flex";
    });

    cancelLogout.addEventListener("click", function () {
        logoutPopupOverlay.style.display = "none";
    });

    confirmLogout.addEventListener("click", function () {
        window.location.href = "<?= base_url('/') ?>";
    });
});

    
  </script>
  
</body>
</html>