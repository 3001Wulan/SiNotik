<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Notulensi</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/detailnotulennotulen.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script type="module" src="<?= base_url('assets/js/script.js') ?>"></script>
  <script type="module" src="https://unpkg.com/emoji-picker-element"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="light-mode">
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo">
      </div>
      <ul>
        <li>
          <a href="/pegawai/dashboard_notulen" class="<?= isset($current_page) && $current_page == 'dashboard' ? 'active dashboard' : 'inactive'; ?>">
            <img src="<?= base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
            Dashboard
          </a>
        </li>
        
        <li class="notulensi-menu">
          <a href="daftar-notulensi" class="active">
            <img src="<?= base_url('assets/images/notulensi.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
            Notulensi
          </a>
          <div class="dropdown-content">
            <a href="melihatnotulen" class="dropdown-item">
              <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
              <span>Daftar Notulensi</span>
            </a>
            <div class="dropdown-separator"></div>
            <a href="buatnotulen" class="dropdown-item">
              <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
              <span>Buat Notulensi</span>
            </a>
          </div>
        </li>
        
        <li>
          <a href="/pegawai/riwayatadmin" class="<?= $current_page == 'riwayat_notulensi' ? 'active riwayat-notulensi' : 'inactive'; ?>">
            <img src="<?= base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
            Riwayat Notulensi
          </a>
        </li>
      </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
      <div class="top-bar">
        <!-- Dark Mode Toggle -->
        <div class="toggle-dark-mode">
          <img id="toggleDarkMode" src="<?= base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
        </div>

        <!-- User Info -->
        <div class="user-info">
          <div class="user-text">
            <div class="user-name">
              <span><?= session()->get('nama') ?? 'Nama Tidak Ditemukan'; ?></span>
            </div>
            <div class="user-role">
              <span><?= session()->get('role') ? ucfirst(session()->get('role')) : 'Role Tidak Ditemukan'; ?></span>
            </div>
          </div>
          <div class="profile-wrapper">
            <img src="<?= base_url('assets/images/profiles/' . (session()->get('profil_foto') && file_exists(FCPATH . 'assets/images/profiles/' . session()->get('profil_foto')) ? session()->get('profil_foto') : 'default.png')) ?>" 
                 alt="User Photo" class="header-profile-img" id="profile-icon">
          </div>
        </div>

        <!-- Dropdown Menu -->
        <div class="dropdown-menu" id="dropdownMenu">
          <a href="<?= base_url('pegawai/profilpegawai') ?>" class="dropdown-item">
            <img src="<?= base_url('assets/images/User.png') ?>" alt="Profil" class="dropdown-icon">
            Profil
          </a>
          <a href="#" class="dropdown-item" id="logoutLink">
            <img src="<?= base_url('assets/images/icon_logout.png') ?>" alt="Logout" class="dropdown-icon">
            Logout
          </a>
        </div>
      </div>

      <!-- Popup Logout -->
      <div class="logout-popup-overlay" id="logoutPopupOverlay" style="display: none;">
        <div class="logout-popup">
          <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="logout-popup-image">
          <h3>Anda ingin logout?</h3>
          <div class="logout-popup-buttons">
            <button class="btn-logout-yes" id="confirmLogout">Ya</button>
            <button class="btn-logout-no" id="cancelLogout">Tidak</button>
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
                            <div><?= ($index + 1) . '. ' . esc($item) ?></div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="agenda-item">
                    <div class="agenda-title">Pembahasan</div>
                    <?php foreach ($agenda as $index => $agendaItem): ?>
                      <li>
                        <?= esc($agendaItem) ?> : <?= esc($agendaIsi[$index] ?? 'Tidak ada isi untuk agenda ini') ?>
                      </li>
                    <?php endforeach; ?>
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

      // PDF Download Functionality
      document.getElementById('downloadButton').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Get the content you want to include in the PDF
        const title = document.querySelector('.page-title h2').innerText;
        const agendaItems = document.querySelectorAll('.agenda-section .agenda-numbers div');
        const discussionItems = document.querySelectorAll('.agenda-section .agenda-item:last-child li');
        const documentationImage = document.querySelector('.documentation-images img').src;

        // Add kop
        doc.setFontSize(24);
        const kopText1 = 'Dinas Kominfo Sook Selatan';
        const kopText2 = `Tanggal: ${new Date().toLocaleDateString()}`;
        const kopText3 = 'Notulensi Rapat';

        // Calculate the width of the text to center it
        const pageWidth = doc.internal.pageSize.getWidth();
        const textWidth1 = doc.getTextWidth(kopText1);
        const textWidth2 = doc.getTextWidth(kopText2);
        const textWidth3 = doc.getTextWidth(kopText3);

        // Set the X position to center the text
        const x1 = (pageWidth - textWidth1) / 2;
        const x2 = (pageWidth - textWidth2) / 2;
        const x3 = (pageWidth - textWidth3) / 2;

        // Add the text to the PDF
        doc.text(kopText1, x1, 10);
        doc.setFontSize(12);
        doc.text(kopText2, x2, 20);
        doc.text(kopText3, x3, 30);
        doc.line(10, 35, 200, 35); // Garis pemisah

        // Add title
        doc.setFontSize(22);
        const titleWidth = doc.getTextWidth(title);
        const titleX = (pageWidth - titleWidth) / 2;
        doc.text(title, titleX, 40);

        // Add agenda items
        doc.setFontSize(16);
        doc.text('Agenda:', 10, 50);
        let y = 60;
        agendaItems.forEach((item, index) => {
          doc.text(`${index + 1}. ${item.innerText}`, 10, y);
          y += 10;
        });

        // Add discussion items
        doc.setFontSize(16);
        doc.text('Pembahasan:', 10, y);
        y += 10;
        discussionItems.forEach(item => {
          doc.text(item.innerText, 10, y);
          y += 10;
        });

        // Add documentation image if available
        if (documentationImage) {
          doc.addImage(documentationImage, 'JPEG', 10, y, 180, 160); // Adjust dimensions as needed
        }

        // Save the PDF
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