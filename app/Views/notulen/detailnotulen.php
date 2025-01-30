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
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="dashboard.php" class="menu-item-link">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <div class="menu-item dropdown">
                    <a href="#" class="menu-item-link">
                        <img src="<?= base_url('assets/images/notulensi.png') ?>" alt="Notulensi Icon">
                        <span>Notulensi</span>
                    </a>
                    <div class="dropdown-content">
                        <a href="daftar-notulensi.php" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        <div class="dropdown-separator"></div>
                        <a href="buat-notulensi.php" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Buat Notulensi</span>
                        </a>
                    </div>
                </div>
                <div class="separator"></div>
                <a href="riwayat-notulensi.php" class="menu-item-link">
                    <img src="<?= base_url('assets/images/riwayat.png') ?>" alt="Riwayat Notulensi Icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content">
                <div class="left-content">
                    <div class="theme-toggle">
                        <img src="<?= base_url('assets/images/moon.png') ?>" alt="Ubah Tema" id="theme-icon">
                    </div>
                </div>
                <div class="right-content">
                    <div class="user-info">
                        <div class="user-text">
                            <div class="user-name">Sistri Mahira</div>
                            <div class="user-role">Notulen</div>
                        </div>
                        <div class="user-avatar">
                            <img src="<?= base_url('assets/images/profile.jpg') ?>" alt="Profil">
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="main-content">
       <h2 class="page-title"><?= esc($notulensi['judul']) ?></h2>
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
                    <button class="download-button">Unduh</button>
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
