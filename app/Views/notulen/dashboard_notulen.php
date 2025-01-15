<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_notulen.css') ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="#" class="menu-item-link">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <div class="menu-item dropdown">
                    <a href="#" class="menu-item-link">
                        <img src="<?= base_url('assets/images/notulensi.png') ?>" alt="Data User Icon">
                        <span>Notulensi</span>
                    </a>
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        <div class="dropdown-separator"></div>
                        <a href="#" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Buat Notulensi</span>
                        </a>
                    </div>
                </div>
                <div class="separator"></div>
                <a href="#" class="menu-item-link">
                    <img src="<?= base_url('assets/images/riwayat.png') ?>" alt="Riwayat Notulensi Icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </div>
        </div>

        
        <div class="main-content">
            <div class="header">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/moon.png') ?>" alt="Toggle Theme" id="theme-icon">
                </div>

                <div class="user-info">
                    <div class="profile-picture">
                        <img src="<?= base_url('assets/images/default-avatar.png') ?>" alt="Profile Picture" id="profile-pic">
                        <div class="dropdown-menu" id="profile-dropdown">
                        <div class="dropdown-item">
                        <img src="<?= base_url('assets/images/profil.png') ?>" alt="Icon Notulensi">
  Profil
</div>
                            <div class="dropdown-separator"></div>
                            <div class="dropdown-item" id="logout-btn">
    <img src="<?= base_url('assets/images/Logout.png') ?>" alt="Logout">
    Logout
</div>


<div id="logout-modal" class="logout-modal">
    <div class="logout-modal-content">
        <span class="close-btn">&times;</span>
        <img src="<?= base_url('assets/images/Info.png') ?>" alt="Info">
        <h2>Anda ingin logout?</h2>
        <button class="confirm-logout">Ya</button>
        <button class="cancel-logout">Tidak</button>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-title">
                <h2>Dashboard</h2>
            </div>
            <div class="stats">
                <div class="stat-box">
                    <div class="stat-text">
                        <h2>Total Pegawai</h2>
                    </div>
                    <div class="stat-icon">
                        <img src="assets/images/icon_pegawai.png" alt="Icon Pegawai">
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-text">
                        <h2>Total Notulensi</h2>
                    </div>
                    <div class="stat-icon">
                        <img src="assets/images/icon_notulensi.png" alt="Icon Notulensi">
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-text">
                        <h2>Status Pegawai</h2>
                    </div>
                    <div class="stat-icon">
                    </div>
                </div>

                <div class="stat-notulensi">
                    <h2>Kategori Notulensi Perbidang</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;

         
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.src = '<?= base_url("assets/images/sun.png") ?>';
            } else {
                themeIcon.src = '<?= base_url("assets/images/moon.png") ?>';
            }

            themeIcon.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    themeIcon.src = '<?= base_url("assets/images/sun.png") ?>';
                    localStorage.setItem('theme', 'dark');
                } else {
                    themeIcon.src = '<?= base_url("assets/images/moon.png") ?>';
                    localStorage.setItem('theme', 'light');
                }
            });

           
            const profilePic = document.getElementById('profile-pic');
            const dropdownMenu = document.getElementById('profile-dropdown');

            profilePic.addEventListener('click', function () {
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

           
            window.addEventListener('click', function (e) {
                if (!profilePic.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.style.display = 'none';
                }
               
const logoutBtn = document.getElementById('logout-btn');
const logoutModal = document.getElementById('logout-modal');
const closeBtn = document.querySelector('.close-btn');
const cancelBtn = document.querySelector('.cancel-logout');
const confirmBtn = document.querySelector('.confirm-logout');


logoutBtn.onclick = function() {
    logoutModal.style.display = 'flex';
}


closeBtn.onclick = function() {
    logoutModal.style.display = 'none';
}

cancelBtn.onclick = function() {
    logoutModal.style.display = 'none';
}


confirmBtn.onclick = function() {
    window.location.href = 'logout.php'; 
}

            });
        });
    </script>
</body>
</html>
