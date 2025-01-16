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

            <div class="page-title">
                <h1>Ubah Data Pengguna</h1>
            </div>
            
            <div class="forms-wrapper">
                <!-- Form (Kiri) -->
                <div class="forms-container">
                    <!-- Form Unggah Gambar -->
                    <form id="form-unggah-gambar" action="#" method="post" enctype="multipart/form-data">
                        <h2>Form Foto</h2>
                        <div class="upload-container">
                            <label for="photo" class="upload-label">Unggah Foto</label>
                            <span class="file-size-info">(ukuran file maksimal 5MB!)</span>
                        </div>
                        <input type="file" id="photo" name="photo" accept="image/*" required>
    
                        <!-- Kotak untuk Preview Gambar (tetap ada sebelum gambar diunggah) -->
                        <div id="preview-container">
                            <img id="previewImage" alt="Preview">
                        </div>
    
                        <p id="error-message" style="color: red; display: none;">Ukuran file tidak boleh lebih dari 5MB!</p>
                    </form>

                    <!-- Form Input Password -->
                    <form id="form-password" action="#" method="post">
                        <h2>Form Password</h2>
                        <label for="password">Password</label>
                        <div class="input-container">
                            <input type="password" id="password" name="password" placeholder="input password here" required>
                            <img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon" class="icon">
                        </div>

                        <label for="confirm-password">Confirm Password</label>
                        <div class="input-container">
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="input password here" required>
                            <img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon" class="icon">
                        </div>
                    </form>
                </div>

                <!-- Form (Kanan) -->
                <div class="form-container">
                    <form id="form-data-pengguna" action="#" method="post">
                        <h2>Form Pengguna</h2>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="input username here" required>

                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" placeholder="input full name here" required>

                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" placeholder="input NIP here" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="input email here" required>

                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" placeholder="input status here" required>

                        <label for="bidang">Bidang</label>
                        <input type="text" id="bidang" name="bidang" placeholder="input bidang here" required>

                        <label for="jabatan">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" placeholder="input jabatan here" required>
                    </form>
                </div>
            </div>

            <!-- Button Simpan Perubahan -->
            <div class="button-container">
                <button type="submit" id="simpan-perubahan" class="submit-btn">
                    Simpan Perubahan
                    <img src="<?php echo base_url('assets/images/simpan.png'); ?>" alt="Save Icon" class="save-icon">
                </button>
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

        // Image Preview and Validation
        const photoInput = document.getElementById('photo');
        const previewImage = document.getElementById('previewImage');
        const previewContainer = document.getElementById('preview-container');
        const errorMessage = document.getElementById('error-message');

        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                // Validasi ukuran file
                if (file.size > 5 * 1024 * 1024) { // Maksimal 5MB
                    errorMessage.style.display = 'block';
                    photoInput.value = ''; // Kosongkan input file
                    previewImage.style.display = 'none'; // Sembunyikan gambar preview
                } else {
                    errorMessage.style.display = 'none'; // Sembunyikan pesan error
                    const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Tampilkan gambar preview
                };

                reader.readAsDataURL(file); // Membaca file dan menampilkan sebagai gambar
                }
            }
        });

        // Password Validation
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm-password');

        document.getElementById('form-password').addEventListener('submit', function (e) {
            if (passwordField.value !== confirmPasswordField.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
            }
        });
    </script>
</body>
</html>
