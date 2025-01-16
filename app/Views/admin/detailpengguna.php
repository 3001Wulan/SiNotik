<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/detailpengguna.css'); ?>">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>

            <ul>
                <li class="dashboard">
                    <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/dashboard_admin.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>

                <li class="active">
                    <a href="#" class="active">
                        <img src="<?php echo base_url('assets/images/data_pengguna.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Data Pengguna
                    </a>
                </li>

                <li class="riwayat-notulensi">
                    <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/riwayat_notulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="content">
            <div class="top-bar">
                <!-- Dark Mode Button -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <!-- User Profile -->
                <div class="user-info">
                    <span>Heni Yunida</span>
                    <span>Admin</span>
                    <img src="<?php echo base_url('assets/images/admin.png'); ?>" alt="Admin">
                </div>
            </div>

             <!-- Page Title -->
            <div class="page-title">
                <h1>Detail Pengguna</h1>
            </div>
            
            <!-- Profil Konten -->
            <div class="profile-container">
                <div class="profile-card">
                    <div class="avatar-container">
                    <!-- Menampilkan Foto Profil yang Ada -->
                        <img src="<?php echo base_url('assets/images/jungwon.png'); ?>" alt="Foto Profil" class="profile-img">
                    </div>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <label>ID User</label>
                        <div class="value">PGW-001</div>
                    </div>

                    <div class="detail-item">
                        <label>Username</label>
                        <div class="value">jungwon09</div>
                    </div>

                    <div class="detail-item">
                        <label>Nama Lengkap</label>
                        <div class="value">Yang Jungwon</div>
                    </div>

                    <div class="detail-item">
                        <label>NIP</label>
                        <div class="value">098765432123456789</div>
                    </div>

                    <div class="detail-item">
                        <label>Email</label>
                        <div class="value">jungwon@gmail.com</div>
                    </div>

                    <div class="detail-item">
                        <label>Status</label>
                        <div class="value">Pegawai</div>
                    </div>

                    <div class="detail-item">
                        <label>Bidang</label>
                        <div class="value">APTIKA</div>
                    </div>

                    <div class="detail-item">
                        <label>Jabatan</label>
                        <div class="value">Staff</div>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="back-button-container">
                <button class="back-button" onclick="window.history.back();">Kembali</button>
            </div>  
        </div>     
    </div>

    <script>
        // Toggle Dark Mode
        const toggleDarkModeButton = document.getElementById('toggleDarkMode');
        const body = document.body;

        toggleDarkModeButton.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            toggleDarkModeButton.src = body.classList.contains('dark-mode')
                ? '<?php echo base_url("assets/images/sun.png"); ?>'
                : '<?php echo base_url("assets/images/moon.png"); ?>';
        });
    </script>
</body>
</html>
