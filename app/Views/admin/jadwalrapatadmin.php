<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Jadwal Rapat</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/jadwalrapatadmin.css') ?>">
</head>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <ul>
                <li class="dashboard">
                    <a href="<?= base_url('dashboard_admin') ?>" class="inactive">
                        <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('data_pengguna') ?>" class="inactive">
                        <img src="<?= base_url('assets/images/datapengguna.png') ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Data Pengguna
                    </a>
                </li>
                <li class="riwayat-notulensi">
                    <a href="<?= base_url('riwayatadmin') ?>" class="inactive">
                        <img src="<?= base_url('assets/images/riwayatnotulensi.png') ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li class="rapat">
                    <a href="<?= base_url('jadwalrapatadmin') ?>" class="active">
                        <img src="<?= base_url('assets/images/rapat.png') ?>" alt="Rapat Icon" class="sidebar-icon">
                        Rapat
                    </a>
                    <div class="dropdown-menu-rapat">
                        <a href="<?= base_url('buat-jadwal') ?>" class="dropdown-item-rapat">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Jadwal Rapat Icon" class="dropdown-icon">
                            Buat Jadwal Rapat
                        </a>
                        <div class="dropdown-separator"></div>
                        <a href="<?= base_url('persetujuan-rapat') ?>" class="dropdown-item-rapat">
                            <img src="<?= base_url('assets/images/setuju.png') ?>" alt="Persetujuan Rapat Icon" class="dropdown-icon">
                            Persetujuan Rapat
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="content">
            <div class="top-bar">
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?= base_url('assets/images/moon.png') ?>" alt="Dark Mode">
                </div>
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span>Masya Allah</span>
                        </div>
                        <div class="user-role">
                            <span>Admin</span>
                        </div>
                    </div>
                    <img src="<?= base_url('assets/images/profiles/default.png') ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="<?= base_url('admin/jadwalrapatadmin') ?>" class="dropdown-item">
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
                <h1>Buat Jadwal Rapat</h1>
            </div>
            
            <form id="form-jadwal-rapat" action="<?= base_url('submit-jadwal') ?>" method="post">
                <div class="form-container">
                    <div class="form-group">
                        <label for="topik">Topik</label>
                        <input type="text" id="topik" name="topik" placeholder="Masukkan Topik rapat" required>
                    </div>
                    <div class="form-group">
                        <label for="agenda">Agenda</label>
                        <textarea id="agenda" name="agenda" placeholder="Masukkan agenda rapat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="time" id="waktu" name="waktu" required>
                    </div>   
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi rapat" required>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="submit-btn">
                            Simpan
                        </button>
                    </div>
                </div> 
            </form>
        </div>

        <!-- Popup Logout -->
        <div class="popup-overlay" id="popupOverlay">
            <div class="popup">
                <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="popup-img">
                <h3>Anda ingin logout?</h3>
                <div class="popup-buttons">
                    <button class="btn-yes" id="confirmLogout">Ya</button>
                    <button class="btn-no" id="cancelLogout">Tidak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleDarkMode').addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const darkModeEnabled = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);
            document.getElementById('toggleDarkMode').src = darkModeEnabled ? 'assets/images/sun.png' : 'assets/images/moon.png';
        });
        
        window.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
                document.getElementById('toggleDarkMode').src = 'assets/images/sun.png';
            }
        });
        
        document.getElementById('profile-icon').addEventListener('click', (event) => {
            event.stopPropagation();
            document.getElementById('dropdownMenu').classList.toggle('show');
        });
        
        window.addEventListener('click', () => {
            document.getElementById('dropdownMenu').classList.remove('show');
        });
        
        document.getElementById('logoutLink').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('popupOverlay').classList.add('active');
        });

        document.getElementById('cancelLogout').addEventListener('click', () => {
            document.getElementById('popupOverlay').classList.remove('active');
        });
        
        document.getElementById('confirmLogout').addEventListener('click', () => {
            window.location.href = '/';
        });
    </script>
</body>
</html>
