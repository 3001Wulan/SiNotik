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
                <img src="/assets/images/moon.png" alt="Toggle Theme" id="theme-icon">
            </div>
            <div class="user-info">
                <div class="user-text">
                    <div class="user-name">Heni Yunida</div>
                    <div class="user-role">Notulen</div>
                </div>
                <div class="user-avatar"></div>
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
                                <img src="/assets/images/default-avatar.png" alt="Profile" class="avatar-img">
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
                            <span class="field-value">Notulen</span>
                        </div>
                        <i class="fas fa-edit edit-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const themeIcon = document.getElementById('theme-icon');
        let isDarkMode = false;

        themeIcon.addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            document.body.classList.toggle('dark-mode');
            
            if (isDarkMode) {
                themeIcon.src = "/assets/images/sun.png";
            } else {
                themeIcon.src = "/assets/images/moon.png";
            }
        });
    </script>
    <script>
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                menuItems.forEach(i => i.classList.remove('active'));

                item.classList.add('active');
            });
        });
    </script>
</body>
</html>
