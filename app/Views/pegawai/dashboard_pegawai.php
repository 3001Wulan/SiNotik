<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/popup_logout.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="light-theme">
    <div class="sidebar">
        <div class="logo">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="logo-img">
        </div>
        <ul class="menu">
    <li class="menu-item active" data-link="<?= base_url('admin/dashboard_admin') ?>">
        <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard" class="menu-icon">
        <span class="menu-text">Dashboard</span>
    </li>
    <li class="menu-item active" data-link="<?= base_url('admin/data_pengguna') ?>">
        <img src="<?= base_url('assets/images/codicon_book.png') ?>" alt="Data Pengguna" class="menu-icon">
        <span class="menu-text">Notulensi</span>
    </li>
    <li class="menu-item" data-link="<?= base_url('admin/riwayat_notulensi') ?>">
        <img src="<?= base_url('assets/images/icon_riwayat.png') ?>" alt="Riwayat Notulensi" class="menu-icon">
        <span class="menu-text">Riwayat Notulensi</span>
    </li>
</ul>

<script>
    // Mengambil semua elemen dengan class 'menu-item'
    const menuItems = document.querySelectorAll('.menu-item');

    // Menambahkan event listener pada setiap item menu
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            const link = item.getAttribute('data-link'); // Mengambil nilai dari atribut data-link
            if (link) {
                window.location.href = link; // Mengarahkan ke halaman tujuan
            }
        });
    });
</script>

    </div>

    <div class="main-content">

        <div class="top-bar">
            <div class="brand-name"></div>
            <div class="theme-toggle">
                <img src="<?= base_url('assets/images/cahaya.png') ?>" alt="Theme Toggle" class="theme-icon">
            </div>
            <div class="profile-container">
                <div class="profile" id="profileButton">
                    <img src="<?= base_url('assets/images/profiles/' . $profile_picture) ?>" alt="Profile Picture" class="profile-img">
                </div>
                <div class="profile-info">
                    <span class="profile-name"><?= $user_name ?></span>
                    <span class="profile-role"><?= $user_role ?></span>
                </div>
                <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                    <a href="<?= base_url('admin/profiladmin') ?>" class="dropdown-item">
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

        <!-- Dashboard Title -->
        <div class="dashboard-title">
            <h2>Dashboard</h2>
        </div>

        <!-- Statistics Section -->
        <div class="stats">
            <!-- Total Pegawai -->
            <div class="stat-box">
                <div class="stat-icon">
                    <img src="<?= base_url('assets/images/icon_pegawai.png') ?>" alt="Icon Pegawai">
                </div>
                <div class="stat-text">
                    <h3>Total Pegawai</h3>
                    <p><?= $total_pegawai ?> Pegawai</p>
                </div>
            </div>

            <!-- Total Notulensi -->
            <div class="stat-box">
                <div class="stat-icon">
                    <img src="<?= base_url('assets/images/icon_notulensi.png') ?>" alt="Icon Notulensi">
                </div>
                <div class="stat-text">
                    <h3>Total Notulensi</h3>
                    <p><?= $total_notulensi ?> Data</p>
                </div>
            </div>

            <div class="stat-status">
                <h3>Status Pegawai</h3>
                <canvas id="statusPegawaiChart"></canvas>
            </div>

            <div class="stat-notulensi">
                <h3>Kategori Notulensi Perbidang</h3>
                <canvas id="kategoriNotulensiChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Popup Logout -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup">
        <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="popup-image">
            <h3>Apakah Anda yakin ingin logout?</h3>
            <div class="popup-buttons">
                <button class="btn-yes" id="confirmLogout">Ya</button>
                <button class="btn-no" id="cancelLogout">Tidak</button>
            </div>
        </div>
    </div>

    <script>
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
            event.preventDefault(); // Mencegah tautan langsung dijalankan
            popupOverlay.style.display = 'block';
        });

        cancelLogout.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
        });

        confirmLogout.addEventListener('click', () => {
            window.location.href = '<?= base_url('/') ?>';
        });

        // Data dan Grafik Status Pegawai
        var bidangLabels = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'Bidang')); ?>;
        var bidangData = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'jumlah')); ?>;

        var ctxStatus = document.getElementById('statusPegawaiChart').getContext('2d');
        var statusPegawaiChart = new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: bidangLabels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: bidangData,
                    backgroundColor: '#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Pegawai' }
                    }
                }
            }
        });

        // Data dan Grafik Kategori Notulensi
        var kategoriLabels = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'Bidang')); ?>;
        var kategoriData = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'jumlah')); ?>;

        var ctxKategori = document.getElementById('kategoriNotulensiChart').getContext('2d');
        var kategoriNotulensiChart = new Chart(ctxKategori, {
            type: 'bar',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    label: 'Jumlah Notulensi',
                    data: kategoriData,
                    backgroundColor: '#2196F3',
                    borderColor: '#1976D2',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Notulensi' }
                    }
                }
            }
        });

        // JavaScript untuk pengalihan tema terang/gelap
        const themeToggle = document.querySelector('.theme-toggle');
        const body = document.body;

        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            body.classList.add(currentTheme);
        } else {
            body.classList.add('light-theme');
        }

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-theme');
            body.classList.toggle('light-theme');

            if (body.classList.contains('dark-theme')) {
                localStorage.setItem('theme', 'dark-theme');
            } else {
                localStorage.setItem('theme', 'light-theme');
            }
        });
    </script>
</body>
</html>
