<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umpan Balik Pegawai</title>
    <link rel="stylesheet" href="assets/css/feedbackpegawai.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="assets/images/logo.png" alt="Logo">
        </div>
        <ul class="menu">
            <li><a href="dashboard.php" class="menu-item">
                <img src="assets/images/dashboard.png" alt="Dashboard" class="menu-icon">
                <span>Dasbor</span>
            </a></li>
            <li><a href="notulensi.php" class="menu-item">
                <img src="assets/images/notulensi.png" alt="Notulensi" class="menu-icon">
                <span>Notulensi</span>
            </a></li>
            <li><a href="riwayatnotulensi.php" class="menu-item">
                <img src="assets/images/riwayat.png" alt="Riwayat Notulensi" class="menu-icon">
                <span>Riwayat Notulensi</span>
            </a></li>
        </ul>
    </div>

    <div class="header">
        <div class="header-content">
            <div class="left-content">
                <div class="theme-toggle">
                    <img src="assets/images/moon.png" alt="Ubah Tema" id="theme-icon">
                </div>
            </div>
            <div class="right-content">
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">Jovanna Agatha</div>
                        <div class="user-role">Pegawai</div>
                    </div>
                    <div class="user-avatar">
                        <img src="assets/images/profile.jpg" alt="Profil">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <h2 class="page-title">Rapat Wajib</h2>
        
        <div class="feedback-container">
            <div class="feedback-content">
                <div class="content-wrapper">
                    <div class="agenda-section">
                        <div class="agenda-item main-agenda">
                            <div class="agenda-header">
                                <span class="agenda-title">Agenda:</span>
                                <div class="agenda-numbers">
                                    <div>1. Pembahasan Program Kerja</div>
                                    <div>2. Hal-hal Penting</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="agenda-item">
                            <div class="agenda-title">1. Pembahasan Program Kerja</div>
                            <ul class="agenda-list">
                                <li>Perkenalan peserta rapat</li>
                                <li>Jumlah yang dibahas pasti</li>
                                <li>Mereview kunjungan RSM sebelumnya/agenda dari kunjungan timur awal</li>
                                <li>Kendala kunjungan tidak terkoordinasi/tanggalan dari timur awal</li>
                                <li>Silang tidak digunakan, hanya untuk belajar/bimbingan jauh dari penghasilan</li>
                            </ul>
                        </div>
                        
                        <div class="agenda-item">
                            <div class="agenda-title">2. Hal-hal Penting</div>
                            <ul class="agenda-list">
                                <li>Evaluasi Realisasi Organisasi termasuk pada dan ulat yang belum terpenuhi</li>
                                <li>Kendala manajerial menjalankan kendaraan dan kendaraan timur awal</li>
                                <li>Silang tidak digunakan, hanya untuk pengembalian ulang dari penghasilan</li>
                                <li>Waktu bikin silang, biaya akan otomatis berubah dari penghasilan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="documentation-section">
                        <div class="documentation-images">
                            <img src="assets/images/meeting-photo.jpg" alt="Dokumentasi Rapat">
                        </div>
                        <a href="path/to/file.pdf" download="Dokumentasi_Rapat.pdf" class="download-button">Unduh</a>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="comment-title">Komentar</h3>
        <div class="comment-container">
            <div class="feedback-content">
                <div class="comment-section">
                    <div class="existing-comment">
                        <div class="comment-info">
                            <span>Alfiansyah</span>
                            <span>7 hari</span>
                        </div>
                        <div class="comment-text">
                            Gacor!!!
                        </div>
                    </div>
                    <div class="comment-input">
                        <textarea class="comment-box" placeholder="Tambahkan komentar" rows="1"></textarea>
                        <button class="submit-comment" title="Kirim komentar">
                            <i class="fas fa-paper-plane submit-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const themeIcon = document.getElementById('theme-icon');
        let isDarkMode = false;

        themeIcon.addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            document.body.classList.toggle('dark-mode');
            themeIcon.src = isDarkMode ? "assets/images/sun.png" : "assets/images/moon.png";
        });

        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                menuItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });
    </script>
</body>
</html>