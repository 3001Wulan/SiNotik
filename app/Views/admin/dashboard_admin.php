<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <title>Mode Gelap Terang</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_admin.css') ?>">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
        </div>
        <ul class="menu">
            <li class="active">
                <img src="assets/images/dashboard.png" alt="Dashboard" class="menu-icon"> Dashboard
            </li>
            <li>
                <img src="assets/images/icon_data.png" alt="Data Pengguna" class="menu-icon"> Data Pengguna
            </li>
            <li>
                <img src="assets/images/icon_riwayat.png" alt="Riwayat Notulensi" class="menu-icon"> Riwayat Notulensi
            </li>
        </ul>
    </div>
    
    <div class="main-content">
    <div class="top-bar">
        <div class="brand-name">
        </div>
        <div class="theme-toggle">
            <img src="assets/images/cahaya.png" alt="Theme Toggle" class="theme-icon">
        </div>
        <div class="profile-container">
    <div class="profile">
        <img src="path_to_your_image.jpg" alt="Profile Picture" class="profile-img">
    </div>
</div>


    </div>
    <div class="dashboard-title">
        <h2>Dashboard</h2> 
    </div>

        <div class="stats">
    <!-- Total Pegawai -->
    <div class="stat-box stat-pegawai">
        <div class="stat-text">
            <h2>Total Pegawai</h2>
           
        </div>
        <div class="stat-icon">
            <img src="assets/images/icon_pegawai.png" alt="Icon Pegawai">
        </div>
    </div>

    <!-- Total Notulensi -->
    <div class="stat-box stat-notulensi">
        <div class="stat-text">
            <h2>Total Notulensi</h2>
            
        </div>
        <div class="stat-icon">
        <img src="assets/images/icon_notulensi.png" alt="Icon Notulensi">
        </div>
    </div>

    <!-- Status Pegawai -->
    <div class="stat-box stat-status">
        <div class="stat-text">
            <h2>Status Pegawai</h2>

        </div>
    </div>

    <!-- Kategori Notulensi Perbidang -->
    <div class="stat-box stat-kategori">
        <div class="stat-text">
            <h2>Kategori Notulensi Perbidang</h2>
            
        </div>
    </div>
</div>



    </div>
</body>
</html>
