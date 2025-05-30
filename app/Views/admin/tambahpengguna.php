<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/tambahpengguna.css'); ?>">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <ul>
                <li class="dashboard">
                    <a href="dashboard_admin" class="inactive">
                        <img src="<?= base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="data_pengguna" class="active">
                        <img src="<?= base_url('assets/images/datapengguna.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Data Pengguna
                    </a>
                </li>
                <li class="riwayat-notulensi">
                    <a href="riwayatadmin" class="inactive">
                        <img src="<?= base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="<?php echo ($current_page ?? '') === 'melihat_pegawai'? 'active notulensi-pegawai ' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Rapat
                    </a>
                    <div class="dropdown-content">
                        <a href="jadwalrapatadmin" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Buat Jadwal Rapat</span>
                        </a>
                        
                        <a href="persetujuanadmin" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Persetujuan Rapat</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="historyadmin" class="inactive">
                        <img src="<?php echo base_url('assets/images/distribusi.png'); ?>" alt="Distribusi Notulensi Icon" class="sidebar-icon">
                        Distribusi Notulensi
                    </a>
                </li>
                <li>
                    <a href="panduanadmin" class="inactive">
                        <img src="<?php echo base_url('assets/images/panduanpengguna.png'); ?>" alt="Panduan Pengguna Icon" class="sidebar-icon">
                        Panduan Pengguna
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="content">
            <div class="top-bar">
                <!-- Dark Mode Button -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?= base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <!-- Profil -->
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span><?php echo isset($user['nama']) ? $user['nama'] : 'Nama Tidak Ditemukan'; ?></span>
                        </div>
                        <div class="user-role">
                            <span><?php echo isset($user['role']) ? ucfirst($user['role']) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                    <img src="<?= base_url('assets/images/profiles/' . $user['profil_foto']) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
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

            <div class="page-title">
                <h1>Tambah Pengguna</h1>
            </div>
            
            <form id="form-data-pengguna" action="<?= base_url('tambah-pengguna/simpan'); ?>" method="post" enctype="multipart/form-data">
                <div class="forms-wrapper">
                    <!-- Form Data Pengguna (Kiri) -->
                    <div class="form-container">
                        <h2>Form Pengguna</h2>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Input username here" required>

                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" placeholder="Input full name here" required>

                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" placeholder="Input NIP here" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Input email here" required>

                        <label for="status">Status</label>
                        <div class="custom-dropdown" id="statusDropdown">
                            <div class="dropdown-selected" onclick="toggleDropdown('statusDropdown')">Pilih Status Pengguna</div>
                                <div class="dropdown-options">
                                    <div class="dropdown-option" onclick="selectOption('statusDropdown', 'Pegawai')">Pegawai</div>
                                    <div class="dropdown-option" onclick="selectOption('statusDropdown', 'Notulen')">Notulensi</div>
                                    <div class="dropdown-option" onclick="selectOption('statusDropdown', 'Admin')">Admin</div>
                                </div>
                            <input type="hidden" name="status" id="status" required>
                        </div>

                        <label for="bidang">Bidang</label>
                        <div class="custom-dropdown" id="bidangDropdown">
                            <div class="dropdown-selected" onclick="toggleDropdown('bidangDropdown')">Pilih Status Pengguna</div>
                                <div class="dropdown-options">
                                    <div class="dropdown-option" onclick="selectOption('bidangDropdown', 'Aptika')">APTIKA</div>
                                    <div class="dropdown-option" onclick="selectOption('bidangDropdown', 'Ikp')">IKP</div>
                                    <div class="dropdown-option" onclick="selectOption('bidangDropdown', 'Statistik')">Statistik dan Persandian</div>
                                </div>
                            <input type="hidden" name="bidang" id="bidang" required>
                        </div>

                        <label for="jabatan">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" placeholder="Input jabatan here" required>
                    </div>

                    <!-- Form Foto -->
                    <div class="form-foto forms-container">
                        <h2>Form Foto</h2>
                        <div class="upload-container">
                            <label for="photo" class="upload-label">Unggah Foto</label>
                            <span class="file-size-info">(Ukuran file maksimal 5MB!)</span>
                        </div>
                        <input type="file" id="photo" name="photo" accept="image/*" required>

                        <div id="preview-container">
                            <img id="previewImage" alt="Preview">
                        </div>
                        <p id="error-message" style="color: red; display: none;">Ukuran file tidak boleh lebih dari 5MB!</p>
                    </div>

                    <!-- Form Password -->
                    <div class="form-password forms-container">
                        <h2>Form Password</h2>
                        <label for="password">Password</label>
                            <div class="input-container">
                                <input type="password" id="password" name="password" placeholder="Input password here" required>
                                <img src="<?= base_url('assets/images/Lock.png'); ?>" alt="Lock Icon" class="icon">
                            </div>

                        <label for="confirm-password">Confirm Password</label>
                            <div class="input-container">
                                <input type="password" id="confirm-password" name="confirm-password" placeholder="Input password here" required>
                                <img src="<?= base_url('assets/images/Lock.png'); ?>" alt="Lock Icon" class="icon">
                            </div>
                    </div>
                </div>

                <!-- Button Simpan Perubahan -->
                <div class="button-container">
                    <button type="submit" id="simpan-perubahan" class="submit-btn">
                        Simpan Perubahan
                        <img src="<?= base_url('assets/images/simpan.png'); ?>" alt="Save Icon" class="save-icon">
                    </button>
                </div>
            </form>

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
    </div>
    
    <script>
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

        const photoInput = document.getElementById('photo');
        const previewImage = document.getElementById('previewImage');
        const previewContainer = document.getElementById('preview-container');
        const errorMessage = document.getElementById('error-message');

        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            
            if (!allowedTypes.includes(file.type)) {
                errorMessage.textContent = 'Hanya gambar dengan format JPG, PNG, GIF, atau WEBP yang diperbolehkan!';
                errorMessage.style.display = 'block';
                event.target.value = ''; 
                previewImage.style.display = 'none';
                return;
            }

            if (file.size > 5 * 1024 * 1024) { 
                errorMessage.textContent = 'Ukuran file terlalu besar! Maksimal 5MB.';
                errorMessage.style.display = 'block';
                event.target.value = ''; 
                previewImage.style.display = 'none';
                return;
            }

            errorMessage.style.display = 'none'; 
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block'; 
            };

            reader.readAsDataURL(file); 
        }
    });

        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm-password');

        document.getElementById('form-data-pengguna').addEventListener('submit', function (e) {
            if (passwordField.value !== confirmPasswordField.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
            }
        });

        const profileIcon = document.getElementById('profile-icon');
        const dropdownMenu = document.getElementById('dropdownMenu');
        profileIcon.addEventListener('click', (event) => {
            event.stopPropagation(); 
            dropdownMenu.classList.toggle('show');
        });

        window.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
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
            window.location.href = '<?= base_url('login') ?>';
        });

       // Fungsi untuk toggle (buka/tutup) dropdown saat DIKLIK
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('active');
        }

        // Fungsi untuk memilih opsi dalam dropdown
        function selectOption(dropdownId, value) {
            const dropdown = document.getElementById(dropdownId);
            const selected = dropdown.querySelector('.dropdown-selected');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');

            selected.textContent = value;
            selected.style.color = "#333"; 
            hiddenInput.value = value;

            dropdown.classList.remove('active');
        }

    // Tutup dropdown saat kursor keluar dari area dropdown
    document.querySelectorAll('.custom-dropdown').forEach(function(dropdown) {
        dropdown.addEventListener('mouseleave', function() {
            // Hanya tutup jika dropdown sedang AKTIF (terbuka)
            if (dropdown.classList.contains('active')) {
                dropdown.classList.remove('active');
            }
        });
    });
    </script>
</body>
</html>
