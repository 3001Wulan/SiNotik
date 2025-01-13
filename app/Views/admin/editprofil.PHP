<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/editprofil.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-circle">
                <img src="<?= base_url('assets/images/logo copy.png') ?>" alt="Logo" class="logo-img">
            </div>
        </div>
        <ul class="menu">
            <li>
                <div class="menu-item">
                    <img src="assets/images/vector.png" alt="Dashboard" class="menu-icon">
                    <span>Dashboard</span>
                </div>
            </li>
            <li>
                <div class="menu-item">
                    <img src="assets/images/mdi_users.png" alt="Data Pengguna" class="menu-icon">
                    <span>Data Pengguna</span>
                </div>
            </li>
            <li>
                <div class="menu-item">
                    <img src="assets/images/riwayat.png" alt="Riwayat Notulensi" class="menu-icon">
                    <span>Riwayat Notulensi</span>
                </div>
            </li>
        </ul>
    </div>

    <!-- Add this in the header section -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/editprofil.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<!-- Add this in the header div -->
<div class="header">
    <div class="theme-toggle">
        <img src="<?= base_url('assets/images/modegelap.png') ?>" alt="Toggle Theme" id="theme-icon">  
    </div>
    <div class="user-info">
    </div>
</div>

<!-- Add this script at the bottom of your body tag -->
<script>
    const themeIcon = document.getElementById('theme-icon');
    themeIcon.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        if (document.body.classList.contains('dark-mode')) {
            themeIcon.src = "<?= base_url('assets/images/modegelap.png') ?>";
        } else {
            themeIcon.src = "<?= base_url('assets/images/modecerah.png') ?>";
        }
    });
</script>

    <!-- Rest of the HTML remains the same -->
    <div class="main-content">
        <!-- Header -->
        <header>
            <div class="user-info">
                <div class="user-text">
                    <div class="user-name">Heni Yunida</div>
                    <div class="user-role">Admin</div>
                </div>
                <div class="user-avatar"></div>
            </div>
        </header>

        <!-- Edit Profile Section -->
        <div class="profile-container">
            <h2>Edit Profil</h2>
            <div class="profile-content">
                <div class="left-section">
                    <div class="profile-image-box">
                        <div class="profile-image-container">
                            <div class="profile-image">
                                <img src="assets/images/default-avatar.png" alt="Profile" class="avatar-img">
                            </div>
                        </div>
                        <div class="upload-container">
                            <input type="file" id="upload" class="upload-input">
                        </div>
                    </div>
                    <button class="save-button">Simpan Perubahan</button>
                </div>

                <div class="profile-details-box">
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Nama</span>
                            <span class="field-value">Heni Yunida</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">NIP</span>
                            <span class="field-value">1234567890</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Jabatan</span>
                            <span class="field-value">Staff</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Alamat</span>
                            <span class="field-value">Solok Selatan</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Tanggal Lahir</span>
                            <span class="field-value">10/10/2004</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Email</span>
                            <span class="field-value">heni@gmail.com</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Password</span>
                            <span class="field-value">123</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Status</span>
                            <span class="field-value">Admin</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>