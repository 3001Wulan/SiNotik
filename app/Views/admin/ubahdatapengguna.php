<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Pengguna</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ubahdatapengguna.css'); ?>">
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
                    <a href="<?= base_url('admin/dashboard_admin'); ?>" class="inactive">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="<?= base_url('admin/data_pengguna'); ?>" class="active">
                        <img src="<?php echo base_url('assets/images/datapengguna.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Data Pengguna
                    </a>
                </li>
                <li class="riwayat-notulensi">
                    <a href="<?= base_url('admin/riwayatadmin'); ?>" class="inactive">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li class="dropdown">
                <a href="#" class="<?php echo ($current_page ?? '') === 'melihat_pegawai'? 'active notulensi-pegawai ' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Rapat
                    </a>
                    <div class="dropdown-content">
                        <a href="melihatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Buat Jadwal Rapat</span>
                        </a>
                        
                        <a href="buatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Persetujuan Rapat</span>
                        </a>
                    </div>
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
                    <span><?= session()->get('nama') ? session()->get('nama') : 'Nama Tidak Ditemukan'; ?></span>
                </div>
                <div class="user-role">
                    <span><?= session()->get('role') ? ucfirst(session()->get('role')) : 'Role Tidak Ditemukan'; ?></span>
                </div>
            </div>
            <div>
                <img src="<?= base_url('assets/images/profiles/' . (file_exists('assets/images/profiles/' . session()->get('profil_foto')) ? session()->get('profil_foto') : 'delvaut.png')) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
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
    
           

    <div class="page-title">
    <h1>Ubah Data Pengguna</h1>
</div>

<div class="forms-wrapper">
    <!-- Form (Kiri) -->
    <div class="forms-container">
        <!-- Form Unggah Gambar -->
        <form id="form-unggah-gambar" action="<?= site_url('admin/ubahdatapengguna/'.$user['user_id'].'/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <h2>Form Foto</h2>
            <div class="upload-container">
                <label for="photo" class="upload-label">Unggah Foto</label>
                <span class="file-size-info">(ukuran file maksimal 5MB!)</span>
            </div>
            <input type="file" id="photo" name="photo" accept="image/*">

            <!-- Kotak untuk Preview Gambar -->
            <div id="preview-container">
                <img id="previewImage" alt="Preview" style="display:none;">
            </div>

            <p id="error-message" style="color: red; display: none;">Ukuran file tidak boleh lebih dari 5MB!</p>
        </form>

        <!-- Form Input Password -->
        <form id="form-password" action="<?= site_url('admin/ubahdatapengguna/'.$user['user_id'].'/update') ?>" method="post">
            <?= csrf_field() ?>
            <h2>Form Password</h2>
            <label for="password">Password</label>
            <div class="input-container">
                <input type="password" id="password" name="password" placeholder="input password here">
                <img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon" class="icon">
            </div>

            <label for="confirm-password">Confirm Password</label>
            <div class="input-container">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="input password here">
                <img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon" class="icon">
            </div>
        </form>
    </div>

    <!-- Form (Kanan) -->
    <div class="form-container">
        <form id="form-data-pengguna" action="<?= site_url('admin/ubahdatapengguna/'.$user['user_id'].'/update') ?>" method="post">
            <?= csrf_field() ?>
            <h2>Form Pengguna</h2>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= old('username', $user['username']) ?>" placeholder="input username here" required>

            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="<?= old('nama', $user['nama']) ?>" placeholder="input full name here" required>

            <label for="nip">NIP</label>
            <input type="text" id="nip" name="nip" value="<?= old('nip', $user['nip']) ?>" placeholder="input NIP here" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= old('email', $user['email']) ?>" placeholder="input email here" required>

            <label for="status">Status</label>
            <input type="text" id="status" name="status" value="<?= old('status', $user['role']) ?>" placeholder="input status here" required>

            <label for="bidang">Bidang</label>
            <input type="text" id="bidang" name="bidang" value="<?= old('bidang', $user['Bidang']) ?>" placeholder="input bidang here" required>

            <label for="jabatan">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" value="<?= old('jabatan', $user['jabatan']) ?>" placeholder="input jabatan here" required>
        </form>
    </div>
</div>

<!-- Button Simpan Perubahan -->
<div class="button-container">
    <button type="button" id="simpan-perubahan" class="submit-btn">
        Simpan Perubahan
        <img src="<?php echo base_url('assets/images/simpan.png'); ?>" alt="Save Icon" class="save-icon">
    </button>
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

<script>
    // Tunggu hingga DOM selesai dimuat
    window.addEventListener('DOMContentLoaded', () => {
        // Event listener untuk menyimpan perubahan
        document.getElementById('simpan-perubahan').addEventListener('click', function() {
            var formData = new FormData();
            var fileInput = document.getElementById('photo');
            
            // Menambahkan foto ke formData jika dipilih
            if (fileInput.files[0]) {
                formData.append('photo', fileInput.files[0]);
            }

            // Menambahkan data lainnya ke formData
            formData.append('password', document.getElementById('password').value);
            formData.append('confirm-password', document.getElementById('confirm-password').value);
            formData.append('username', document.getElementById('username').value);
            formData.append('nama', document.getElementById('nama').value);
            formData.append('nip', document.getElementById('nip').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('bidang', document.getElementById('bidang').value);
            formData.append('jabatan', document.getElementById('jabatan').value);

            // Membuat XMLHttpRequest dan mengirim form data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= site_url('admin/ubahdatapengguna/'.$user['user_id'].'/update') ?>', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.reload();
                } else {
                    alert('Gagal memperbarui data.');
                }
            };

            xhr.send(formData);
        });

        // Fitur pratinjau gambar dan validasi ukuran file
        const photoInput = document.getElementById('photo');
        const previewImage = document.getElementById('previewImage');
        const errorMessage = document.getElementById('error-message');

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                if (file.size > 5 * 1024 * 1024) { // Maksimal ukuran 5MB
                    errorMessage.style.display = 'block';
                    photoInput.value = ''; 
                    previewImage.style.display = 'none';
                } else {
                    errorMessage.style.display = 'none';
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            }
        });

        // Fitur toggle dark mode
        const toggleDarkMode = document.getElementById('toggleDarkMode');
        toggleDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const darkModeEnabled = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);

            toggleDarkMode.src = darkModeEnabled ? 
                '<?php echo base_url('assets/images/sun.png'); ?>' : 
                '<?php echo base_url('assets/images/moon.png'); ?>';
        });

        // Periksa preferensi dark mode saat halaman dimuat
        const isDarkMode = localStorage.getItem('darkMode') === 'true';
        if (isDarkMode) {
            document.body.classList.add('dark-mode');
            toggleDarkMode.src = '<?php echo base_url('assets/images/sun.png'); ?>';
        } else {
            toggleDarkMode.src = '<?php echo base_url('assets/images/moon.png'); ?>';
        }

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

        // Dropdown profile menu
        const profileIcon = document.getElementById('profile-icon');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileIcon.addEventListener('click', function() {
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        });
    });
</script>
</body>
</html>