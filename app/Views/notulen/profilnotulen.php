<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profilnotulen.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <ul>
                <li>
                    <a href="dashboard_notulen" class="inactive">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="<?php echo ($current_page == 'melihat_notulen') ? 'active notulensi-pegawai ' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                    <div class="dropdown-content">
                        <a href="melihatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        
                        <a href="buatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Buat Notulensi</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="riwayatnotulen" class="inactive">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
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

                <!-- Profile Info and Dropdown -->
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
                        <a href="<?= base_url('notulen/profilnotulen') ?>" class="dropdown-item">
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
                <h1>Profil</h1>
            </div>

            <!-- Profil Konten -->
            <div class="profile-container">
                <div class="profile-card">
                    <div class="avatar-container">
                        <!-- Menampilkan Foto Profil yang Ada -->
                        <?php if (isset($user_profile['profil_foto']) && $user_profile['profil_foto']): ?>
                            <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="Foto Profil" class="profile-img">
                        <?php else: ?>
                            <img src="<?= base_url('assets/images/delvaut.png') ?>" alt="Foto Profil" class="profile-img">
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Edit Profil -->
                    <form action="editprofilnotulen" method="POST">
                        <input type="hidden" name="nama" value="<?= isset($user_profile['nama']) ? $user_profile['nama'] : 'N/A' ?>">
                        <input type="hidden" name="nip" value="<?= isset($user_profile['nip']) ? $user_profile['nip'] : 'N/A' ?>">
                        <input type="hidden" name="jabatan" value="<?= isset($user_profile['jabatan']) ? $user_profile['jabatan'] : 'N/A' ?>">
                        <input type="hidden" name="alamat" value="<?= isset($user_profile['alamat']) ? $user_profile['alamat'] : 'N/A' ?>">
                        <input type="hidden" name="tanggal_lahir" value="<?= isset($user_profile['tanggal_lahir']) ? $user_profile['tanggal_lahir'] : 'N/A' ?>">
                        <input type="hidden" name="email" value="<?= isset($user_profile['email']) ? $user_profile['email'] : 'N/A' ?>">
                        <input type="hidden" name="password" value="<?= isset($user_profile['password']) ? $user_profile['password'] : 'N/A' ?>">
                        <input type="hidden" name="role" value="<?= isset($user_profile['role']) ? $user_profile['role'] : 'N/A' ?>">
                        <input type="hidden" name="profil_foto" value="<?= isset($user_profile['profil_foto']) ? $user_profile['profil_foto'] : 'default.jpg' ?>">
                        <button type="submit" class="edit-btn">Edit Profil</button>
                    </form>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <label>Nama</label>
                        <div class="value"><?= isset($user_profile['nama']) ? $user_profile['nama'] : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <label>NIP</label>
                        <div class="value"><?= isset($user_profile['nip']) ? $user_profile['nip'] : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <label>Jabatan</label>
                        <div class="value"><?= isset($user_profile['jabatan']) ? $user_profile['jabatan'] : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <label>Alamat</label>
                        <div class="value"><?= isset($user_profile['alamat']) ? $user_profile['alamat'] : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <label>Tanggal Lahir</label>
                        <div class="value"><?= isset($user_profile['tanggal_lahir']) ? $user_profile['tanggal_lahir'] : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <div class="value"><?= isset($user_profile['email']) ? $user_profile['email'] : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <label>Password</label>
                        <div class="value">
                            <?php 
                                // Menghitung panjang password dan menampilkan bintang
                                $passwordLength = isset($user_profile['password']) ? strlen($user_profile['password']) : 0;
                                echo str_repeat('*', $passwordLength);
                            ?>
                        </div>
                    </div>

                    <div class="detail-item">
                        <label>Status</label>
                        <div class="value"><?= isset($user_profile['role']) ? $user_profile['role'] : 'N/A' ?></div>
                    </div>
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
    const profileIcon = document.getElementById('profile-icon');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileIcon.addEventListener('click', (event) => {
        event.stopPropagation(); 
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', () => {
        dropdownMenu.classList.remove('show');
    });

    // JavaScript untuk Popup Logout
    const logoutLink = document.getElementById('logoutLink'); // Perbaikan ID
    const popupOverlay = document.getElementById('popupOverlay');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    // Menampilkan popup konfirmasi logout
    logoutLink.addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah link logout berfungsi langsung
        popupOverlay.style.display = 'block'; // Menampilkan popup overlay
    });

    // Menyelesaikan logout ketika tombol "Ya" diklik
    confirmLogout.addEventListener('click', () => {
        window.location.href = '/'; // Ganti dengan halaman logout atau proses logout
    });

    // Menyembunyikan popup ketika tombol "Tidak" diklik
    cancelLogout.addEventListener('click', () => {
        popupOverlay.style.display = 'none'; 
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
