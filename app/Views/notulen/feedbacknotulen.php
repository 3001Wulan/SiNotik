<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umpan Balik Pegawai</title>
    <link rel="stylesheet" href="assets/css/feedbacknotulen.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="assets/images/logo.png" alt="Logo">
            </div>
            <div class="menu">
                <a href="dashboard.php" class="menu-item-link">
                    <img src="assets/images/dashboard.png" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <div class="menu-item dropdown">
                    <a href="#" class="menu-item-link">
                        <img src="assets/images/notulensi.png" alt="Notulensi Icon">
                        <span>Notulensi</span>
                    </a>
                    <div class="dropdown-content">
                        <a href="daftar-notulensi.php" class="dropdown-item">
                            <img src="assets/images/buat.png" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        <div class="dropdown-separator"></div>
                        <a href="buat-notulensi.php" class="dropdown-item">
                            <img src="assets/images/edit.png" alt="Buat Notulensi Icon">
                            <span>Buat Notulensi</span>
                        </a>
                    </div>
                </div>
                <div class="separator"></div>
                <a href="riwayat-notulensi.php" class="menu-item-link">
                    <img src="assets/images/riwayat.png" alt="Riwayat Notulensi Icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </div>
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
                            <div class="user-name">Sistri Mahira</div>
                            <div class="user-role">Notulen</div>
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
                                <div class="agenda-title">Pembahasan: 1. Pembahasan Program Kerja</div>
                                <ul class="agenda-list">
                                    <li>Program Utama: Pelatihan anggota baru (Materi) dan Seminar nasional (Mei)</li>
                                    <li>Kendala: Kurangnya SDM, keterbatasan anggaran, dan koordinasi tim divisi</li>
                                    <li>Solusi: Beirisi sukarsawan tingkatkan sponsorship, padakan rapat mingguan lintas divisi</li>
                                </ul>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-title">2. Hal-hal yang Dirasa Perlu</div>
                                <ul class="agenda-list">
                                    <li>Evaluasi Struktur Organisasi: Tambah posisi baru dan periksa tanggung jawab</li>
                                    <li>Inisiasi Tambahan: Workshop kewirausahaan dan kegiatan sosial</li>
                                    <li>Diskusi Pemerataan sub-divisi pengembangan dana dan penggalian alat</li>
                                </ul>
                            </div>
                        </div>
                        <div class="documentation-section">
                            <div class="documentation-images">
                                <img src="assets/images/meeting-photo.jpg" alt="Dokumentasi Rapat">
                            </div>
                            <button class="download-button">Unduh</button>
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
                                Gacorrr!!!
                            </div>
                        </div>
                        <div class="comment-input">
                            <input type="text" class="comment-box" placeholder="Tambahkan komentar">
                            <button class="submit-comment" title="Kirim komentar">
                                <i class="fas fa-paper-plane submit-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;
            
            // Check for saved theme preference
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.src = 'assets/images/sun.png';
            }

            themeIcon.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    themeIcon.src = 'assets/images/sun.png';
                    localStorage.setItem('theme', 'dark');
                } else {
                    themeIcon.src = 'assets/images/moon.png';
                    localStorage.setItem('theme', 'light');
                }
            });

            const menuItems = document.querySelectorAll('.menu-item-link');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    menuItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>