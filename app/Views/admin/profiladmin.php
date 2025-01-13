<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profiladmin.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="dashboard_admin" class="menu-item">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <a href="#" class="menu-item">
                    <img src="<?= base_url('assets/images/datauser.png') ?>" alt="Data User Icon">
                    <span>Data Pengguna</span>
                </a>
                <div class="separator"></div>
                <a href="#" class="menu-item">
                    <img src="<?= base_url('assets/images/riwayat.png') ?>" alt="History Icon">
                    <span>Riwayat Notulensi</span>
                </a>
            </div>
        </div>
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/modegelap.png') ?>" alt="Toggle Theme" id="theme-icon">  
                </div>
                <div class="user-info">
                </div>
            </div>
            <div class="profile-content">
                <h2>Profil</h2>
                
                <div class="profile-container">
                    <div class="profile-card">
                        <div class="avatar-container">
                            <?php if (isset($user_profile['profil_foto']) && $user_profile['profil_foto']): ?>
                                <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="Profile Picture" class="profile-img">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/delvaut.png') ?>" alt="Profile Picture">
                            <?php endif; ?>
                        </div>
                        <button class="edit-btn">Edit Profil</button>
                    </div>

                    <div class="profile-details">
                        <div class="detail-item">
                            <label>Nama</label>
                            <div class="value"><?= isset($user_profile['nama']) ? $user_profile['nama'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>NIP</label>
                            <div class="value"><?= isset($user_profile['nip']) ? $user_profile['nip'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Jabatan</label>
                            <div class="value"><?= isset($user_profile['jabatan']) ? $user_profile['jabatan'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Alamat</label>
                            <div class="value"><?= isset($user_profile['alamat']) ? $user_profile['alamat'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Tanggal Lahir</label>
                            <div class="value"><?= isset($user_profile['tanggal_lahir']) ? $user_profile['tanggal_lahir'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Email</label>
                            <div class="value"><?= isset($user_profile['email']) ? $user_profile['email'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Password</label>
                            <div class="value"><?= isset($user_profile['password']) ? $user_profile['password'] : 'N/A' ?></div>
                        </div>
                        <div class="detail-item">
                            <label>Status</label>
                            <div class="value"><?= isset($user_profile['role']) ? $user_profile['role'] : 'N/A' ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });

        const themeIcon = document.getElementById('theme-icon');
        themeIcon.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                themeIcon.src = "<?= base_url('assets/images/modegelap.png') ?>";
            } else {
                themeIcon.src = "<?= base_url('assets/images/modegelap.png') ?>";
            }
        });
    </script>
</body>
</html>
