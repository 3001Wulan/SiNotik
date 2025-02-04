<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melihat Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/detailnotulen.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <ul>
                <li>
                    <a href="<?= base_url('notulen/dashboard_notulen'); ?>" class="<?= ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'notulensi') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/notulensi.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                    <ul class="dropdown-content">
                        <li>
                            <a href="daftar-notulensi.php" class="dropdown-item">
                                <img src="<?php echo base_url('assets/images/buat.png'); ?>" alt="Daftar Notulensi Icon">
                                Daftar Notulensi
                            </a>
                        </li>
                        <li>
                            <a href="buat-notulensi.php" class="dropdown-item">
                                <img src="<?php echo base_url('assets/images/edit.png'); ?>" alt="Buat Notulensi Icon">
                                Buat Notulensi
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="riwayat-notulensi.php" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayat.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
            </ul>
        </div>

        <!-- Area Konten -->
        <div class="content">
            <div class="top-bar">
                <!-- Mode -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <!-- Profil -->
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

            <!-- Judul Halaman -->
            <div class="page-title">
                <h2><?= esc($notulensi['judul']) ?></h2>
            </div>

            <!-- Konten Utama -->
            <div class="main-content">
                <div class="outer-blue-background">
                    <div class="left-blue"></div> <!-- Bagian kiri berwarna biru -->
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
                                                <?= esc($agendaItem) ?> 
                                                : <?= esc($agendaIsi[$index] ?? 'Tidak ada isi untuk agenda ini') ?>
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
                            </div>
                        </div>
                    </div>
                </div> <!-- Akhir Konten Utama -->

                <!-- Bagian Komentar dipindahkan ke bawah -->
                <div class="comment-section">
                    <button id="commentButton" class="comment-icon">
                        <i class="fas fa-comment"></i> Komentar
                    </button>
                </div>

                <!-- Pop-up untuk Komentar -->
                <div id="commentPopup" class="comment-popup" style="display: none;">
                    <div class="popup-content">
                        <span class="close-popup" id="closePopup">&times;</span>
                        <h3>Komentar</h3>
                        
                        <!-- Daftar komentar -->
                        <div id="commentList">
                            <!-- Contoh komentar -->
                            <div class="comment-item">
                                <img src="https://via.placeholder.com/40" alt="Profile" class="comment-avatar">
                                <div class="comment-body">
                                    <strong class="comment-name">John Doe</strong>
                                    <p class="comment-text">Ini adalah contoh komentar!</p>
                                </div>
                            </div>
                            
                            <div class="comment-item">
                                <img src="https://via.placeholder.com/40" alt="Profile" class="comment-avatar">
                                <div class="comment-body">
                                    <strong class="comment-name">Jane Smith</strong>
                                    <p class="comment-text">Terima kasih atas informasinya!</p>
                                </div>
                            </div>
                        </div>

                        <!-- Input komentar baru -->
                        <div class="comment-input-container">
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
                        </div>
                        <button id="submitComment">Kirim</button>
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
                if (commentText) {
                    const commentItem = document.createElement('div');
                    commentItem.classList.add('comment-item');
                    commentItem.innerHTML = `
                        <img src="https://via.placeholder.com/40" alt="Profile" class="comment-avatar">
                        <div class="comment-body">
                            <strong class="comment-name">Anda</strong>
                            <p class="comment-text">${commentText}</p>
                        </div>
                    `;
                    commentList.appendChild(commentItem);
                    newComment.value = ''; 
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
        });
    </script>
</body>
</html>