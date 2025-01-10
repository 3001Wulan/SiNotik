<?php
$current_page = 'data_pengguna'; // Halaman yang sedang aktif
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/data_pengguna.css'); ?>">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <ul>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard_admin.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'data_pengguna') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/data_pengguna.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Data Pengguna
                    </a>
                </li>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
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

            <!-- Table with User Data -->
            <div class="table-container">
                <h1>Data Pengguna</h1>
                <button class="btn-add">Tambah Data</button>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data pengguna diisi dari database -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const toggleDarkMode = document.getElementById('toggleDarkMode');
        toggleDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            // Change image based on the mode
            if (document.body.classList.contains('dark-mode')) {
                toggleDarkMode.src = '<?php echo base_url('assets/images/sun.png'); ?>'; // Ganti dengan gambar mode terang
            } else {
                toggleDarkMode.src = '<?php echo base_url('assets/images/moon.png'); ?>'; // Ganti dengan gambar mode gelap
            }
        });
    </script>
</body>
</html>
