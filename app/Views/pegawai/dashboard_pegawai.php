<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_pegawai.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" class="logo-img">
            </div>
            <ul>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="melihatpegawai" class="<?php echo ($current_page == 'melihat_pegawai') ? 'active notulensi-pegawai ' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                </li>
                <li>
                    <a href="riwayatpegawai" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li>
                    <a href="jadwalrapat" class="inactive">
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
                <!-- Mode -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <div class="profile-container">
                    <div class="profile" id="profileButton">
                        <img src="<?= base_url('assets/images/profiles/' . (file_exists('assets/images/profiles/' . $profile_picture) ? $profile_picture : 'delvaut.png')) ?>" alt="Profile Picture" class="profile-img">
                    </div>

                    <div class="profile-info">
                        <span class="profile-name"><?= $user_name ?></span>
                        <span class="profile-role"><?= $user_role ?></span>
                    </div>

                    <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
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
            </div>

            <!-- Page Tittle -->
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>

        <!-- Statistics Section -->
        <div class="stats">
                <div class="stat-box">
                    <div class="stat-icon">
                        <img src="<?= base_url('assets/images/icon_pegawai.png') ?>" alt="Icon Pegawai">
                    </div>
                    <div class="stat-text">
                        <h3>TOTAL PEGAWAI</h3>
                        <p><?= $total_pegawai ?> Pegawai</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <img src="<?= base_url('assets/images/icon_notulensi.png') ?>" alt="Icon Notulensi">
                    </div>
                    <div class="stat-text">
                        <h3>TOTAL NOTULENSI</h3>
                        <p><?= $total_notulensi ?> Data</p>
                    </div>
                </div>

                <div class="stat-status">
                    <h3>STATUS PEGAWAI</h3>
                    <canvas id="statusPegawaiChart"></canvas>
                </div>

                <div class="stat-notulensi">
                    <h3>KATEGORI NOTULENSI PERBIDANG</h3>
                    <canvas id="kategoriNotulensiChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Popup Logout -->
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
    </div>

    <script>
        // Handle menu item navigation
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', () => {
                const link = item.getAttribute('data-link');
                if (link) {
                    window.location.href = link;
                }
            });
        });

        // Dropdown Menu
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileButton.addEventListener('click', () => {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', (event) => {
            if (!profileButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        // Popup Logout
        const logoutLink = document.getElementById('logoutLink');
        const popupOverlay = document.getElementById('popupOverlay');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        logoutLink.addEventListener('click', (event) => {
            event.preventDefault();
            popupOverlay.style.display = 'block';
        });

        cancelLogout.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
        });

        confirmLogout.addEventListener('click', () => {
            window.location.href = '<?= base_url('/') ?>';
        });

        // Chart.js Data (Dynamic)
        const bidangLabels = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'Bidang')); ?>;
        const bidangData = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'jumlah')); ?>;

        const kategoriLabels = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'Bidang')); ?>;
        const kategoriData = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'jumlah')); ?>;

        const sharedColors = bidangLabels.map(() => `#${Math.floor(Math.random()*16777215).toString(16)}`);

        // Pegawai Chart
        const ctxStatus = document.getElementById('statusPegawaiChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: bidangLabels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: bidangData,
                    backgroundColor: sharedColors,
                    borderColor: sharedColors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Jumlah Pegawai' }, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Notulensi Chart
        const ctxKategori = document.getElementById('kategoriNotulensiChart').getContext('2d');
        new Chart(ctxKategori, {
            type: 'bar',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    label: 'Jumlah Notulensi',
                    data: kategoriData,
                    backgroundColor: sharedColors,
                    borderColor: sharedColors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Jumlah Notulensi' }, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        toggleDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const darkModeEnabled = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);

        toggleDarkMode.src = darkModeEnabled ? 
            '<?php echo base_url('assets/images/sun.png'); ?>' : 
            '<?php echo base_url('assets/images/moon.png'); ?>';
        });

        window.addEventListener('DOMContentLoaded', () => {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                toggleDarkMode.src = '<?php echo base_url('assets/images/sun.png'); ?>';
            } else {
                toggleDarkMode.src = '<?php echo base_url('assets/images/moon.png'); ?>';
            }
        });
    </script>
</body>
</html>
