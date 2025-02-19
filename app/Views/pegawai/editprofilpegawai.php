<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/editprofilpegawai.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <ul>
                <li>
                    <a href="dashboard_pegawai" class="inactive">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="melihatpegawai" class="inactive">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                </li>
                <li>
                    <a href="riwayatpegawai" class="inactive">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li>
                    <a href="jadwalrapat" class="inactive">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
                        Jadwal Rapat
                    </a>
                </li>
                <li>
                    <a href="panduanpegawai" class="inactive">
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

                <!-- Profile Info and Dropdown -->
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name"><?= $nama ?? 'N/A' ?></div>
                        <div class="user-role"><?= $role ?? 'N/A' ?></div>
                    </div>

                    <div><img src="<?= base_url('assets/images/profiles/' . $profil_foto) ?>" alt="Foto Profil" class="user-avatar" id="profile-img"></div>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdownMenu">
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

            <div class="page-title">
                <h1>Edit Profil</h1>
            </div>

            <div class="profile-container">
                <div class="profile-image-box">
                    <form id="editProfileForm" action="" method="POST" enctype="multipart/form-data">
                    <div class="profile-image-container">
                        <div class="profile-image">
                            <img src="<?= base_url('assets/images/profiles/' . $profil_foto) ?>" alt="Foto Profil" id="profileImage">
                        </div>
                    </div>

                    <div class="upload-container">
                        <input type="file" name="profil_foto" id="upload" class="upload-input" accept="image/jpeg, image/png, image/gif">
                        <p id="errorMessage" style="color: red; font-size: 14px;"></p>
                    </div>
                </div>
                
                <div class="profile-details-box">
                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Nama</span>
                                <span class="field-value" id="namaSpan"><?= $nama ?? 'N/A' ?></span>
                                <input type="text" name="nama" value="<?= $nama ?? 'N/A' ?>" class="field-value-input" id="namaField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('namaField', 'namaSpan')"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">NIP</span>
                                <span class="field-value" id="nipSpan"><?= $nip ?? 'N/A' ?></span>
                                <input type="text" name="nip" value="<?= $nip ?? 'N/A' ?>" class="field-value-input" id="nipField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('nipField', 'nipSpan')"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Jabatan</span>
                                <span class="field-value" id="jabatanSpan"><?= $jabatan ?? 'N/A' ?></span>
                                <input type="text" name="jabatan" value="<?= $jabatan ?? 'N/A' ?>" class="field-value-input" id="jabatanField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('jabatanField', 'jabatanSpan')"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Alamat</span>
                                <span class="field-value" id="alamatSpan"><?= $alamat ?? 'N/A' ?></span>
                                <input type="text" name="alamat" value="<?= $alamat ?? 'N/A' ?>" class="field-value-input" id="alamatField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('alamatField', 'alamatSpan')"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Tanggal Lahir</span>
                                <span class="field-value" id="tanggalLahirSpan"><?= $tanggal_lahir ?? 'N/A' ?></span>
                                <input type="date" name="tanggal_lahir" value="<?= $tanggal_lahir ?? 'N/A' ?>" class="field-value-input" id="tanggalLahirField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('tanggalLahirField', 'tanggalLahirSpan')"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Email</span>
                                <span class="field-value" id="emailSpan"><?= $email ?? 'N/A' ?></span>
                                <input type="email" name="email" value="<?= $email ?? 'N/A' ?>" class="field-value-input" id="emailField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('emailField', 'emailSpan')"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Password</span>
                                <span class="field-value" id="passwordSpan"><?= !empty($password) ? str_repeat('*', strlen($password)) : '*****' ?></span>
                                <input type="password" name="password" value="<?= $password ?? 'N/A' ?>" class="field-value-input" id="passwordField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="redirectToEditPage()"></i>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Status</span>
                                <span class="field-value" id="statusSpan"><?= $role ?? 'N/A' ?></span>
                                <input type="text" name="role" value="<?= $role ?? 'N/A' ?>" class="field-value-input" id="roleField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('roleField', 'statusSpan')"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <button class="save-button" type="submit" form="editProfileForm">Simpan Perubahan</button> 
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
    //Perubahan Data
     function toggleEdit(fieldId, spanId) {
            var field = document.getElementById(fieldId);
            var span = document.getElementById(spanId);
            if (field.style.display === 'none') {
                field.style.display = 'block';
                span.style.display = 'none';
            } else {
                field.style.display = 'none';
                span.style.display = 'block';
            }
        }

        document.getElementById('upload').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    const maxSize = 5 * 1024 * 1024; 
    const errorMessage = document.getElementById('errorMessage');

    if (file) {
        if (!allowedTypes.includes(file.type)) {
            errorMessage.textContent = 'Format file tidak diizinkan. Hanya JPG, PNG, dan GIF yang diperbolehkan.';
            return;
        }

        if (file.size > maxSize) {
            errorMessage.textContent = 'Ukuran file terlalu besar. Maksimal 5MB.';
            return;
        }

        errorMessage.textContent = ''; 

        const reader = new FileReader();
        reader.onload = function (event) {
            const profileImage = document.getElementById('profileImage');
            profileImage.src = event.target.result; 
        };
        reader.readAsDataURL(file); 
    }
});


    toggleDarkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const darkModeEnabled = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', darkModeEnabled);

    toggleDarkMode.src = darkModeEnabled ? 
        '<?php echo base_url('assets/images/sun.png'); ?>' : 
        '<?php echo base_url('assets/images/moon.png'); ?>';
});

        const profileIcon = document.getElementById('profile-img');
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

        function redirectToEditPage() {
        window.location.href = 'ubahpassword';  
        }
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
