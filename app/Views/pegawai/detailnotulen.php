<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Notulensi</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/detailnotulen.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
          <a href="dashboard_admin" class="<?php echo (isset($current_page) && $current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
            <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
            Dashboard
          </a>
        </li>
        <!-- Menu Notulensi dengan dropdown yang muncul saat hover -->
        <li class="notulensi-menu">
          <a href="daftar-notulensi" class="<?php echo ($current_page == '') ? 'active' : 'active'; ?>">
            <img src="<?php echo base_url('assets/images/notulensi.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
            Notulensi
          </a>
        <li>
          <a href="/pegawai/riwayatpegawai" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
            <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
            Riwayat Notulensi
          </a>
        </li>
        <li>
            <a href="#" class="inactive">
              <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
              Jadwal Rapat
            </a>
          </li>
          <li>
            <a href="#" class="inactive">
              <img src="<?php echo base_url('assets/images/distribusi.png'); ?>" alt="Distribusi Notulensi Icon" class="sidebar-icon">
              Distribusi Notulensi
            </a>
          </li>
          <li>
            <a href="#" class="inactive">
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
            <img src="<?= base_url('assets/images/profiles/' . (file_exists('assets/images/profiles/' . session()->get('profil_foto')) ? session()->get('profil_foto') : 'delvaut.png')) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
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
                                    <?php if (!empty($agenda)): ?>
                                        <?php foreach ($agenda as $index => $item): ?>
                                            <div>
                                                <?= preg_match('/^\d+\./', $item) ? esc($item) : ($index + 1) . '. ' . esc($item) ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item">
                            <div class="agenda-title">Pembahasan</div>
                            <?php foreach ($agenda as $index => $agendaItem): ?>
                                <li><strong><?= esc($agendaItem) ?>:</strong> <p><?= nl2br(esc($agendaIsi[$index])) ?></p></li>
                            <?php endforeach; ?>
                        </div>

                        <!-- Partisipan Section -->
                        <div class="agenda-item">
                            <div class="agenda-title">Partisipan</div>
                            <?php if (!empty($notulensi['partisipan']) && is_array($notulensi['partisipan'])): ?>
                                <div class="agenda-numbers">
                                    <?php foreach ($notulensi['partisipan'] as $index => $partisipan): ?>
                                        <div><?= ($index + 1) . '. ' . esc($partisipan) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php elseif (!empty($notulensi['partisipan'])): ?>
                                <p><?= esc($notulensi['partisipan']) ?></p>
                            <?php else: ?>
                                <p>Tidak ada partisipan yang terdaftar.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Partisipan Non Pegawai Section -->
                        <div class="agenda-item">
                            <div class="agenda-title">Partisipan Non Pegawai</div>
                            <?php if (!empty($notulensi['partisipan_non_pegawai']) && is_array($notulensi['partisipan_non_pegawai'])): ?>
                                <div class="agenda-numbers">
                                    <?php foreach ($notulensi['partisipan_non_pegawai'] as $index => $nonPegawai): ?>
                                        <div><?= ($index + 1) . '. ' . esc($nonPegawai) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php elseif (!empty($notulensi['partisipan_non_pegawai'])): ?>
                                <p><?= esc($notulensi['partisipan_non_pegawai']) ?></p>
                            <?php else: ?>
                                <p>Tidak ada partisipan non-pegawai yang terdaftar.</p>
                            <?php endif; ?>
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

           <!-- Input komentar baru -->
<div class="comment-input-container">
  <input type="hidden" id="notulensi_id" value="<?= esc($notulensi['notulensi_id']) ?>">
  <img src="https://via.placeholder.com/40" alt="Profile" class="comment-avatar">
  <textarea id="newComment" placeholder="Tulis komentar..."></textarea>
  <!-- Tombol Emoji -->
  <button type="button" id="emojiButton">😊</button>
  <!-- Pemilih Emoji -->
  <div id="emojiPicker" class="emoji-picker" style="display: none;">
    <span class="emoji" data-emoji="😊">😊</span>
    <span class="emoji" data-emoji="😂">😂</span>
    <span class="emoji" data-emoji="😍">😍</span>
    <span class="emoji" data-emoji="😢">😢</span>
    <span class="emoji" data-emoji="👍">👍</span>
    <span class="emoji" data-emoji="😎">😎</span>
    <span class="emoji" data-emoji="💡">💡</span>
  </div>
  <button id="submitComment">Kirim</button>
</div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
      const emojiPicker = document.getElementById('emojiPicker');

      commentButton.addEventListener('click', () => {
        commentPopup.style.display = 'flex';
      });

      closePopup.addEventListener('click', () => {
        commentPopup.style.display = 'none';
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
        emojiPicker.style.display = emojiPicker.style.display === 'none' || emojiPicker.style.display === '' ? 'block' : 'none';
      });

      emojiPicker.addEventListener('click', (event) => {
        if (event.target.classList.contains('emoji')) {
          const emoji = event.target.dataset.emoji;
          newComment.value += emoji; 
        }
      });

      document.getElementById('downloadButton').addEventListener('click', function() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF('p', 'mm', 'a4');

  const marginLeft = 20;
  const marginTop = 20;
  const pageWidth = doc.internal.pageSize.getWidth();
  const pageHeight = doc.internal.pageSize.getHeight();

  let y = marginTop;

  const checkPageSpace = (requiredHeight) => {
    if (y + requiredHeight > pageHeight - marginTop) {
      doc.addPage();
      y = marginTop;
    }
  };

  const title = document.querySelector('.page-title h2')?.innerText || 'Judul Tidak Tersedia';
  const agendaItems = document.querySelectorAll('.agenda-section .agenda-numbers div');
  const discussionItems = document.querySelectorAll('.agenda-section .agenda-item:last-child li');
  const documentationImage = document.querySelector('.documentation-images img')?.src;

  // Header
  doc.setFontSize(20);
  doc.setFont('helvetica', 'bold');
  doc.text('Dinas Kominfo Sook Selatan', pageWidth / 2, y, { align: 'center' });

  doc.setFontSize(12);
  y += 8;
  doc.text(`Tanggal: ${new Date().toLocaleDateString()}`, pageWidth / 2, y, { align: 'center' });

  y += 8;
  doc.setFontSize(16);
  doc.text('Notulensi Rapat', pageWidth / 2, y, { align: 'center' });

  // Garis pemisah
  y += 6;
  doc.line(marginLeft, y, pageWidth - marginLeft, y);
  y += 10;

  // Judul Notulensi di Tengah
  doc.setFontSize(14);
  doc.text(title, pageWidth / 2, y, { align: 'center' });
  y += 8;

  // Bagian Agenda
  doc.setFontSize(12);
  doc.setFont('helvetica', 'bold');
  doc.text('Agenda:', marginLeft, y);
  y += 6;
  doc.setFont('helvetica', 'normal');

  agendaItems.forEach((item, index) => {
    // Mengambil teks agenda
    const agendaText = item.textContent.trim();
    
    if (agendaText) {
      checkPageSpace(8);
      doc.text(`${agendaText}`, marginLeft, y, { maxWidth: pageWidth - 2 * marginLeft });
      y += 6;
    }
  });

  // Bagian Pembahasan
  y += 8;
  doc.setFont('helvetica', 'bold');
  doc.text('Pembahasan:', marginLeft, y);
  y += 6;
  doc.setFont('helvetica', 'normal');

  discussionItems.forEach((item, index) => {
    // Mengambil teks pembahasan
    const discussionText = item.textContent.trim();

    if (discussionText) {
      checkPageSpace(8);
      doc.text(`${discussionText}`, marginLeft, y, { maxWidth: pageWidth - 2 * marginLeft });
      y += 6;
    }
  });

  // Bagian Dokumentasi (jika ada gambar)
  if (documentationImage) {
    y += 8;
    doc.setFont('helvetica', 'bold');
    doc.text('Dokumentasi:', marginLeft, y);
    y += 6;

    // Load gambar untuk mengetahui ukurannya
    const img = new Image();
    img.src = documentationImage;
    img.onload = function () {
      let imgWidth = pageWidth * 0.3; // Maksimal 30% dari lebar halaman
      let imgHeight = (img.naturalHeight / img.naturalWidth) * imgWidth;

      // Jika gambar terlalu tinggi, sesuaikan agar tidak keluar halaman
      if (imgHeight > pageHeight - y - marginTop) {
        const scaleFactor = (pageHeight - y - marginTop) / imgHeight;
        imgWidth *= scaleFactor;
        imgHeight *= scaleFactor;
      }

      // Tambahkan gambar ke PDF di tepi kiri
      checkPageSpace(imgHeight);
      doc.addImage(documentationImage, 'JPEG', marginLeft, y, imgWidth, imgHeight);
      y += imgHeight + 6;

      // Simpan PDF setelah gambar selesai dimuat
      doc.save('notulensi.pdf');
    };
  } else {
    doc.save('notulensi.pdf');
  }
});

    });
  </script>
</body>
</html>