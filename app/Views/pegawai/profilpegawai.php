<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profilpegawai.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="dashboard_admin" class="menu-item">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <a href="data_pengguna" class="menu-item">
                    <img src="<?= base_url('assets/images/datauser.png') ?>" alt="Data User Icon">
                    <span>Data Pengguna</span>
                </a>
                <div class="separator"></div>
                <a href="#" class="menu-item">
                    <img src="<?= base_url('assets/images/riwayat.png') ?>" alt="History Icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </div>
        </div>
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/modegelap.png') ?>" alt="Toggle Theme" id="theme-icon">  
                </div>
                <div class="user-info">
                    <!-- Profile Info and Dropdown -->
                    <div class="profile-header">
                        <div class="header-user-details">
                            <span class="header-user-name"><?= isset($user_profile['nama']) ? $user_profile['nama'] : 'N/A' ?></span>
                            <span class="header-user-role"><?= isset($user_profile['role']) ? $user_profile['role'] : 'N/A' ?></span>
                        </div>
                        <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdown-menu">
                        <a href="profilpegawai" class="dropdown-item">
                            <img src="<?= base_url('assets/images/User.png') ?>" alt="Profil" class="dropdown-icon">
                            Profil
                        </a>
                        <a href="#" class="dropdown-item" id="logoutBtn">
                            <img src="<?= base_url('assets/images/icon_logout.png') ?>" alt="Logout" class="dropdown-icon">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Popup Overlay -->
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

            <!-- Profil Konten -->
            <div class="profile-content">
                <h2>Profil</h2>
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
                        <form action="editprofilpegawai" method="POST">
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
        </div>
    </div>

    <script>
        // JavaScript untuk Dropdown Menu
        const profileIcon = document.getElementById('profile-icon');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Menampilkan dropdown menu saat foto profil diklik
        profileIcon.addEventListener('click', () => {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Menyembunyikan dropdown menu jika klik di luar area dropdown
        window.addEventListener('click', (event) => {
            if (!profileIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        // Menangani pengaturan tema gelap
        const themeIcon = document.getElementById('theme-icon');
        themeIcon.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                themeIcon.src = "<?= base_url('assets/images/modegelap.png') ?>";
            } else {
                themeIcon.src = "<?= base_url('assets/images/modegelap.png') ?>";
            }
        });

        // JavaScript untuk Popup Logout
        const logoutBtn = document.getElementById('logoutBtn');
        const popupOverlay = document.getElementById('popupOverlay');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        // Menampilkan popup konfirmasi logout
        logoutBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Mencegah link logout berfungsi langsung
            popupOverlay.style.display = 'block'; // Menampilkan popup overlay
        });

        // Menyelesaikan logout ketika tombol "Ya" diklik
        confirmLogout.addEventListener('click', () => {
            window.location.href = '/'; // Ganti dengan halaman logout atau proses logout
        });

        // Menyembunyikan popup ketika tombol "Tidak" diklik
        cancelLogout.addEventListener('click', () => {
            popupOverlay.style.display = 'none'; // Menyembunyikan popup overlay
        });
    </script>
</body>
</html>
