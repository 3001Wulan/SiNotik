<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="/assets/css/editprofilnotulen.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <div class="logo-circle">
                <img src="/assets/images/logo.png" alt="Logo" class="logo-img">
            </div>
        </div>
        <ul class="menu">
            <li>
                <a href="/dashboard.php" class="menu-item"> 
                    <img src="/assets/images/dashboard.png" alt="Dashboard" class="menu-icon">
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/datapengguna.php" class="menu-item">
                    <img src="/assets/images/Notulensi.png" alt="Notulensi" class="menu-icon">
                    <span>Notulensi</span>
                </a>
            </li>
            <li>
                <a href="/riwayatnotulensi.php" class="menu-item">
                    <img src="/assets/images/riwayat.png" alt="Riwayat Notulensi" class="menu-icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="header">
        <div class="header-content">
            <div class="theme-toggle">
                <img src="<?= base_url('assets/images/moon.png'); ?>" alt="Toggle Theme" id="theme-icon" onclick="toggleTheme()">  
            </div>
            <div class="user-info">
                <div class="user-text">
                    <div class="user-name"><?= $nama ?? 'N/A' ?></div>
                    <div class="user-role"><?= $role ?? 'N/A' ?></div>
                </div>
                <img src="<?= base_url('assets/images/profiles/' . $profil_foto) ?>" alt="Foto Profil" class="user-avatar">
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="profile-container">
            <h2>Edit Profil</h2>
            <div class="profile-content">
                <div class="left-section">
                    <div class="profile-image-box">
                        <div class="profile-image-container">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/images/profiles/' . $profil_foto) ?>" alt="Foto Profil">
                            </div>
                        </div>
                        <div class="upload-container">
                            <input type="file" name="profil_foto" id="upload" class="upload-input">
                        </div>
                    </div>
                    <button class="save-button" type="submit" form="editProfileForm">Simpan Perubahan</button>
                </div>

                <div class="profile-details-box">
                    <form id="editProfileForm" action="" method="POST" enctype="multipart/form-data">
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

                        <!-- Password -->
                        <div class="profile-field">
                            <div class="field-left">
                                <span class="field-label">Password</span>
                                <span class="field-value" id="passwordSpan"><?= $password ?? 'N/A' ?></span>
                                <input type="password" name="password" value="<?= $password ?? 'N/A' ?>" class="field-value-input" id="passwordField" style="display:none;">
                            </div>
                            <div class="edit-icon">
                                <i class="fas fa-edit" onclick="toggleEdit('passwordField', 'passwordSpan')"></i>
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
        </div>
    </div>

    <script>
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

        // Function to toggle dark/light mode
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            body.classList.toggle('dark-mode');

            // Change the icon based on the theme
            if (body.classList.contains('dark-mode')) {
                themeIcon.src = "<?= base_url('assets/images/sun.png'); ?>"; // Light mode icon
            } else {
                themeIcon.src = "<?= base_url('assets/images/moon.png'); ?>"; // Dark mode icon
            }
        }
    </script>
</body>
</html>
