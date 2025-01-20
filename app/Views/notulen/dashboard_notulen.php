<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_notulen.css') ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="#" class="menu-item-link">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>

                <!-- Notulensi Dropdown -->
                <div class="menu-item dropdown">
                    <a href="#" class="menu-item-link">
                        <img src="<?= base_url('assets/images/notulensi.png') ?>" alt="Notulensi Icon">
                        <span>Notulensi</span>
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
                </div>

                <div class="separator"></div>
                <a href="#" class="menu-item-link">
                    <img src="<?= base_url('assets/images/riwayat.png') ?>" alt="Riwayat Notulensi Icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <!-- Theme Toggle -->
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/moon.png') ?>" alt="Toggle Theme" id="theme-icon">
                </div>

                <!-- User Profile -->
                <div class="user-info">
                    <div class="profile-picture">
                    <img src="<?= base_url('assets/images/profiles/' . $profile_picture) ?>" alt="Profile Picture" id="profile-pic">
                        <div class="dropdown-menu" id="profile-dropdown">
                            <div class="dropdown-item">
                            <a href="<?= base_url('notulen/profilnotulen') ?>" class="dropdown-item">
                                <img src="<?= base_url('assets/images/user.png') ?>" alt="Profil Icon">
                                Profil
                            </a>
                            </div>
                            <div class="dropdown-separator"></div>
                            <div class="dropdown-item" id="logout-btn">
                                <img src="<?= base_url('assets/images/icount_logout.png') ?>" alt="Logout Icon">
                                Logout
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Title -->
            <div class="dashboard-title">
                <h2>Dashboard</h2>
            </div>

            <!-- Stats Section -->
            <div class="stats">
                <div class="stat-box">
                    <div class="stat-text">
                        <h2>Total Pegawai</h2>
                        <p><?= $total_pegawai ?> Pegawai</p>
                    </div>
                    <div class="stat-icon">
                        <img src="<?= base_url('assets/images/icon_pegawai.png') ?>" alt="Icon Pegawai">
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-text">
                        <h2>Total Notulensi</h2>
                        <p><?= $total_notulensi ?> Data</p>
                    </div>
                    <div class="stat-icon">
                        <img src="<?= base_url('assets/images/icon_notulensi.png') ?>" alt="Icon Pegawai">
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-text">
                        <h2>Status Pegawai</h2>
                    </div>
                    <div class="stat-icon">
                        <canvas id="statusPegawaiChart"></canvas>
                    </div>
                </div>

                <div class="stat-notulensi">
                    <h2>Kategori Notulensi Perbidang</h2>
                    <canvas id="kategoriNotulensiChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div id="logout-modal" class="logout-modal">
        <div class="logout-modal-content">
            <span class="close-btn">&times;</span>
            <img src="<?= base_url('assets/images/Info.png') ?>" alt="Info Icon">
            <h2>Anda ingin logout?</h2>
            <button class="confirm-logout">Ya</button>
            <button class="cancel-logout">Tidak</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;

            // Load the theme based on local storage
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.src = '<?= base_url("assets/images/sun.png") ?>';
            } else {
                themeIcon.src = '<?= base_url("assets/images/moon.png") ?>';
            }

            themeIcon.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    themeIcon.src = '<?= base_url("assets/images/sun.png") ?>';
                    localStorage.setItem('theme', 'dark');
                } else {
                    themeIcon.src = '<?= base_url("assets/images/moon.png") ?>';
                    localStorage.setItem('theme', 'light');
                }
            });

            const profilePic = document.getElementById('profile-pic');
            const dropdownMenu = document.getElementById('profile-dropdown');

            profilePic.addEventListener('click', function () {
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            window.addEventListener('click', function (e) {
                if (!profilePic.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });

            const logoutBtn = document.getElementById('logout-btn');
            const logoutModal = document.getElementById('logout-modal');
            const closeBtn = document.querySelector('.close-btn');
            const cancelBtn = document.querySelector('.cancel-logout');
            const confirmBtn = document.querySelector('.confirm-logout');

            logoutBtn.onclick = function () {
                logoutModal.style.display = 'flex';
            };

            closeBtn.onclick = function () {
                logoutModal.style.display = 'none';
            };

            cancelBtn.onclick = function () {
                logoutModal.style.display = 'none';
            };

            confirmBtn.onclick = function () {
                window.location.href = '<?= base_url("home") ?>'; // Sesuaikan dengan URL beranda Anda
            };

            const bidangLabels = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'Bidang')); ?>;
            const bidangData = <?= json_encode(array_column($jumlah_pegawai_per_bidang, 'jumlah')); ?>;
            const kategoriLabels = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'Bidang')); ?>;
            const kategoriData = <?= json_encode(array_column($jumlah_notulensi_per_bidang, 'jumlah')); ?>;

            const sharedColors = bidangLabels.map(() => `#${Math.floor(Math.random()*16777215).toString(16)}`);

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
        });
    </script>
</body>
</html>
