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
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    const link = item.getAttribute('data-link');
                    if (link) {
                        window.location.href = link;
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

        <div class="dashboard-title">
            <h2>Dashboard</h2>
        </div>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-icon">
                    <img src="<?= base_url('assets/images/icon_pegawai.png') ?>" alt="Icon Pegawai">
                </div>
                <div class="stat-text">
                    <h3>Total Pegawai</h3>
                    <p><?= $total_pegawai ?> Pegawai</p>
                </div>
            </div>

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

        const bidangLabels = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'Bidang')); ?>;
        const bidangData = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'jumlah')); ?>;

        const kategoriLabels = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'Bidang')); ?>;
        const kategoriData = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'jumlah')); ?>;

        const sharedColors = bidangLabels.map(() => `#${Math.floor(Math.random()*16777215).toString(16)}`);

        const ctxStatus = document.getElementById('statusPegawaiChart').getContext('2d');
        const statusPegawaiChart = new Chart(ctxStatus, {
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
                plugins: {
                    legend: {
                        labels: {
                            color: sharedColors
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Pegawai' },
                        grid: { display: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        const ctxKategori = document.getElementById('kategoriNotulensiChart').getContext('2d');
        const kategoriNotulensiChart = new Chart(ctxKategori, {
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
                plugins: {
                    legend: {
                        labels: {
                            color: sharedColors
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Notulensi' },
                        grid: { display: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>
