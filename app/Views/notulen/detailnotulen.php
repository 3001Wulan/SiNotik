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
            <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon"> Dashboard
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="<?php echo ($current_page == 'melihat_notulen') ? 'active notulensi-pegawai' : 'active'; ?>">
            <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon"> Notulensi
          </a>
          <div class="dropdown-content">
            <a href="/notulen/melihatnotulen" class="dropdown-item">
              <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon"> <span>Daftar Notulensi</span>
            </a>
            <a href="/notulen/buatnotulen" class="dropdown-item">
              <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon"> <span>Buat Notulensi</span>
            </a>
          </div>
        </li>
        <li>
          <a href="/notulen/riwayatnotulen" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
            <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon"> Riwayat Notulensi
          </a>
        </li>
        <li>
          <a href="notulen/jadwalrapatnotulen" class="inactive">
            <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon"> Jadwal Rapat
          </a>
        </li>
        <li>
          <a href="/notulen/historynotulen" class="inactive">
            <img src="<?php echo base_url('assets/images/distribusi.png'); ?>" alt="Distribusi Notulensi Icon" class="sidebar-icon"> Distribusi Notulensi
          </a>
        </li>
        <li>
          <a href="/notulen/panduannotulen" class="inactive">
            <img src="<?php echo base_url('assets/images/panduanpengguna.png'); ?>" alt="Panduan Pengguna Icon" class="sidebar-icon"> Panduan Pengguna
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
          <div class="dropdown-menu" id="dropdownMenu">
            <a href="<?= base_url('admin/profiladmin') ?>" class="dropdown-item">
              <img src="<?= base_url('assets/images/User.png') ?>" alt="Profil" class="dropdown-icon"> Profil
            </a>
            <a href="#" class="dropdown-item" id="logoutLink">
              <img src="<?= base_url('assets/images/icon_logout.png') ?>" alt="Logout" class="dropdown-icon"> Logout
            </a>
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
          <div class="left-blue"></div>
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
                            <?php foreach ($agenda as $item): ?>
                              <li><?= esc(trim($item)) ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <!-- Partisipan -->
                  <div class="agenda-title">Partisipan</div>
                  <div class="agenda-partisipan">
                    <?php 
                    $partisipanList = !empty($notulensi['partisipan']) 
                        ? (is_array($notulensi['partisipan']) ? $notulensi['partisipan'] : array_map('trim', explode("\n", $notulensi['partisipan']))) 
                        : [];

                    if (!empty($partisipanList)): ?>
                      <ul style="list-style-type: none; padding-left: 0;">
                        <?php foreach ($partisipanList as $partisipan): ?>
                          <li><?= esc(trim($partisipan)) ?></li>
                        <?php endforeach; ?>
                      </ul>
                    <?php else: ?>
                      <p>Tidak ada partisipan yang terdaftar.</p>
                    <?php endif; ?>
                  </div>

                  <!-- Partisipan Non Pegawai -->
                  <div class="agenda-title">Partisipan Non Pegawai</div>
                  <div class="agenda-partisipannon">
                    <?php 
                    $nonPegawaiList = !empty($notulensi['partisipan_non_pegawai']) 
                        ? (is_array($notulensi['partisipan_non_pegawai']) ? $notulensi['partisipan_non_pegawai'] : array_map('trim', explode("\n", $notulensi['partisipan_non_pegawai']))) 
                        : [];

                    if (!empty($nonPegawaiList)): ?>
                      <ul style="list-style-type: none; padding-left: 0;">
                        <?php foreach ($nonPegawaiList as $nonPegawai): ?>
                          <li><?= esc(trim($nonPegawai)) ?></li>
                        <?php endforeach; ?>
                      </ul>
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
                      <img src="<?= base_url('uploads/' . esc($dokumentasi[0]['foto_dokumentasi'])) ?>" alt="Dokumentasi Foto" class="header-profile-img" id="profile-icon" onclick="openModal(this)">
                    <?php else: ?>
                      <img src="" alt="Dokumentasi Foto" class="header-profile-img" id="profile-icon">
                    <?php endif; ?>
                  </div>
                  <button class="download-button" id="downloadButton">Unduh</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="comment-section">
                  <button id="commentButton" class="comment-icon">
                    <i class="fas fa-comment"></i> 
                  </button>
      </div>
      

      <!-- Pop-up untuk Komentar -->
      <div id="commentPopup" class="comment-popup" style="display: none;">
        <div class="popup-content">
          <span class="close-popup" id="closePopup">&times;</span>
          <h3>Komentar</h3>
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
              <div id="emojiPicker" class="emoji-picker" style="display: none;"></div>
            </div>
            <button id="submitComment">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="popup-overlay" id="popupOverlay">
    <div class="popup">
      <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="popup-image">
      <h3>Anda ingin logout?</h3>
      <div class="popup-buttons">
        <button class="btn-yes" id="confirmLogout">Ya</button>
        <button class="btn-no" id="cancelLogout">Tidak</button>
      </div>
    </div>
  </div>

  <!-- Modal Popup -->
  <div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
  </div>

  <script>
    
    document.addEventListener('DOMContentLoaded', () => {
    const toggleDarkMode = document.getElementById('toggleDarkMode');
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        toggleDarkMode.src = '<?= base_url("assets/images/sun.png") ?>';
    } else {
        toggleDarkMode.src = '<?= base_url("assets/images/moon.png") ?>';
    }


    toggleDarkMode.addEventListener('click', () => {
        const darkModeEnabled = document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', darkModeEnabled);

        toggleDarkMode.src = darkModeEnabled ? 
            '<?= base_url("assets/images/sun.png") ?>' : 
            '<?= base_url("assets/images/moon.png") ?>';
    });

      const commentButton = document.getElementById('commentButton');
      const commentPopup = document.getElementById('commentPopup');
      const closePopup = document.getElementById('closePopup');
      const submitComment = document.getElementById('submitComment');
      const newComment = document.getElementById('newComment');
      const commentList = document.getElementById('commentList');
      const emojiButton = document.getElementById('emojiButton');

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
              newComment.value = ''; 
            } else {
              alert(data.message);
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

        const title = document.querySelector('.page-title h2')?.innerText || 'Judul Tidak Tersedia';
        const agendaItems = [...document.querySelectorAll('.agenda-numbers li')]
            .map(item => item.innerText.trim())
            .join('\n') || 'Tidak ada agenda.';
        const discussion = document.querySelector('.agenda-isi')?.innerText.trim() || 'Tidak ada pembahasan.';
        const participants = [...document.querySelectorAll('.agenda-partisipan li')]
            .map(item => item.innerText.trim())
            .join('\n') || 'Belum ada data partisipan.';
        const nonEmployeeParticipants = [...document.querySelectorAll('.agenda-partisipannon li')]
            .map(item => item.innerText.trim())
            .join('\n') || 'Tidak ada partisipan non pegawai.';
        const documentationImage = document.querySelector('.documentation-images img')?.src;

        const pageWidth = doc.internal.pageSize.getWidth();
        const leftMargin = 2.54, rightMargin = 2.54;
        const maxWidth = pageWidth - (leftMargin + rightMargin);
        let y = 3;
        const pageHeight = doc.internal.pageSize.height - 2.54;

        const checkPageOverflow = (extraSpace = 1) => {
            if (y + extraSpace > pageHeight) {
                doc.addPage();
                y = 3;
            }
        };

        const addJustifiedText = (text) => {
            doc.setFont("times", "normal");
            doc.setFontSize(12);
            const textLines = doc.splitTextToSize(text, maxWidth);
            textLines.forEach(line => {
                checkPageOverflow(0.5);
                doc.text(leftMargin, y, line, { align: "left" });
                y += 0.5;
            });
        };

        const addSectionTitle = (text) => {
            checkPageOverflow(1);
            doc.setFont("helvetica", "bold");
            doc.setFontSize(12);
            doc.text(leftMargin, y, text);
            y += 0.7;
        };

        const logoPath = '/assets/images/logo.png';
        const logoWidth = 3.5;
        const logoHeight = 3.5;

        fetch(logoPath)
            .then(response => response.blob())
            .then(blob => {
                const reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    const base64data = reader.result;

                    doc.addImage(base64data, 'PNG', leftMargin, 1, logoWidth, logoHeight);
                    doc.setFont("helvetica", "bold");
                    doc.setFontSize(16);
                    doc.text(pageWidth / 2, 2, 'Dinas Kominfo Sook Selatan', { align: "center" });
                    doc.setFontSize(11);
                    doc.text(pageWidth / 2, 3, `Tanggal: ${new Date().toLocaleDateString()}`, { align: "center" });
                    doc.setFontSize(14);
                    doc.text(pageWidth / 2, 4, 'Notulensi Rapat', { align: "center" });

                    y = 5.5;
                    doc.line(leftMargin, y, pageWidth - rightMargin, y);
                    y += 1.3;

                    doc.setFontSize(16);
                    doc.setFont("helvetica", "bold");
                    doc.text(pageWidth / 2, y, title, { align: "center" });
                    y += 1.5;

                    addSectionTitle('Agenda:');
                    addJustifiedText(agendaItems);

                    addSectionTitle('Partisipan Pegawai:');
                    addJustifiedText(participants);

                    addSectionTitle('Partisipan Non Pegawai:');
                    addJustifiedText(nonEmployeeParticipants);

                    addSectionTitle('Pembahasan:');
                    addJustifiedText(discussion);

                    if (documentationImage) {
                        checkPageOverflow(10);
                        addSectionTitle('Dokumentasi:');
                        const img = new Image();
                        img.src = documentationImage;
                        img.onload = function () {
                            let imgWidth, imgHeight;
                            if (img.width > img.height) {
                                imgWidth = 9;
                                imgHeight = 7;
                            } else {
                                imgWidth = 7;
                                imgHeight = 9;
                            }
                            doc.addImage(documentationImage, 'JPEG', leftMargin, y, imgWidth, imgHeight);
                            y += imgHeight + 1;
                            doc.save('notulensi.pdf');
                        };
                    } else {
                        doc.save('notulensi.pdf');
                    }
                };
            })
            .catch(error => console.error("Error loading logo:", error));
      });

      // Dropdown Menu
      const profileIcon = document.getElementById("profile-icon");
      const dropdownMenu = document.getElementById("dropdownMenu");
      const logoutLink = document.getElementById("logoutLink");
      const popupOverlay = document.getElementById("popupOverlay");
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
        popupOverlay.style.display = "flex";
      });

      cancelLogout.addEventListener("click", function () {
        popupOverlay.style.display = "none";
      });

      confirmLogout.addEventListener("click", function () {
        window.location.href = "<?= base_url('login') ?>";
      });
    });

    function openModal(imgElement) {
      var modal = document.getElementById("imageModal");
      var modalImg = document.getElementById("modalImage");
      modal.style.display = "block";
      modalImg.src = imgElement.src;
    }

    function closeModal() {
      document.getElementById("imageModal").style.display = "none";
    }
    
  </script>
</body>
</html>