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

                <!-- Profil -->
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span><?php echo isset($user_profile['nama']) ? $user_profile['nama'] : 'Nama Tidak Ditemukan'; ?></span>
                        </div>
                        <div class="user-role">
                            <span><?php echo isset($user_profile['role']) ? ucfirst($user_profile['role']) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                        <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                    </div>
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdownMenu">
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

            <!-- Page Title -->
            <div class="page-title">
                <h1>Detail Pengguna</h1>
            </div>
            
            <!-- Profil Konten -->
            <div class="profile-container">
                <div class="profile-card">
                    <div class="avatar-container">
                    <!-- Menampilkan Foto Profil yang Ada -->
                    <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                    </div>
                </div>

                <div class="profile-details">
                    <!-- Menampilkan Data Dinamis -->
                    <div class="detail-item">
                        <label>ID User</label>
                        <div class="value"><?= isset($user_profile['user_id']) ? esc($user_profile['user_id']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>Username</label>
                        <div class="value"><?= isset($user_profile['username']) ? esc($user_profile['username']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>Nama Lengkap</label>
                        <div class="value"><?= isset($user_profile['name']) ? esc($user_profile['nama']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>NIP</label>
                        <div class="value"><?= isset($user_profile['nip']) ? esc($user_profile['nip']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>Email</label>
                        <div class="value"><?= isset($user_profile['email']) ? esc($user_profile['email']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>Status</label>
                        <div class="value"><?= isset($user_profile['role']) ? esc($user_profile['role']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>Bidang</label>
                        <div class="value"><?= isset($user_profile['Bidang']) ? esc($user_profile['Bidang']) : 'N/A' ?></div>
                    </div>

                    <div class="detail-item">
                        <label>Jabatan</label>
                        <div class="value"><?= isset($user_profile['Jabatan']) ? esc($user_profile['Jabatan']) : 'N/A' ?></div>
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

        // JavaScript untuk Dropdown Menu
        const profileIcon = document.getElementById('profile-icon');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggle dropdown menu saat foto profil diklik
        profileIcon.addEventListener('click', (event) => {
            event.stopPropagation(); // Mencegah event bubbling
            dropdownMenu.classList.toggle('show');
        });

        // Menyembunyikan dropdown menu jika klik di luar area dropdown
        window.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });
    </script>
</body>
</html>
