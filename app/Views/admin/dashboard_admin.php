<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Link ke file CSS terpisah -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_admin.css') ?>">
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="light-theme">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="logo-img">
        </div>
        <ul class="menu">
            <li class="menu-item active">
                <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard" class="menu-icon">
                <span class="menu-text">Dashboard</span>
            </li>
            <li class="menu-item">
                <img src="<?= base_url('assets/images/icon_data.png') ?>" alt="Data Pengguna" class="menu-icon">
                <span class="menu-text">Data Pengguna</span>
            </li>
            <li class="menu-item">
                <img src="<?= base_url('assets/images/icon_riwayat.png') ?>" alt="Riwayat Notulensi" class="menu-icon">
                <span class="menu-text">Riwayat Notulensi</span>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="brand-name"></div>
            <div class="theme-toggle">
                <img src="<?= base_url('assets/images/cahaya.png') ?>" alt="Theme Toggle" class="theme-icon">
            </div>
            <div class="profile-container">
                <div class="profile">
                    <img src="<?= base_url('assets/images/profile.jpg') ?>" alt="Profile Picture" class="profile-img">
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
                    <p>Jumlah: <?= $total_pegawai ?></p>
                </div>
            </div>

            <!-- Total Notulensi -->
            <div class="stat-box">
                <div class="stat-icon">
                    <img src="<?= base_url('assets/images/icon_notulensi.png') ?>" alt="Icon Notulensi">
                </div>
                <div class="stat-text">
                    <h3>Total Notulensi</h3>
                    <p>Jumlah: 120</p>
                </div>
            </div>

            <!-- Grafik Status Pegawai -->
            <div class="stat-box">
                <h3>Status Pegawai</h3>
                <canvas id="statusPegawaiChart"></canvas>
            </div>

            <!-- Grafik Kategori Notulensi Perbidang -->
            <div class="stat-box">
                <h3>Kategori Notulensi Perbidang</h3>
                <canvas id="kategoriNotulensiChart"></canvas>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Grafik dan Pengalihan Tema -->
    <script>
        // Data untuk grafik Status Pegawai per Bidang
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

        // Data untuk grafik Kategori Notulensi Perbidang
        var kategoriLabels = ['Bidang 1', 'Bidang 2'];
        var kategoriData = [40, 80];

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
