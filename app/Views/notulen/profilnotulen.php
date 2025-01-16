<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profilnotulen.css') ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
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
                <!-- Modified Notulensi menu item with dropdown and icons -->
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

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/bulan.png') ?>" alt="Toggle Theme" id="theme-icon">
                </div>
                <div class="user-info">
                    <div class="profile-picture">
                        <img src="<?= base_url('assets/images/default-avatar.png') ?>" alt="Profile Picture">
                    </div>
                </div>
            </div>

           
            <!-- Profil Konten -->
            <div class="profile-content">
                <h2>Profil</h2>
                <div class="profile-container">
                    <div class="profile-card">
                        <div class="avatar-container">
                            <!-- Menampilkan Foto Profil yang Ada -->
                            <?php if (isset($user_profile['profil_foto']) && $user_profile['profil_foto']): ?>
                                <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="Foto Profil" class="profile-img">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/delvaut.png') ?>" alt="Foto Profil" class="profile-img">
                            <?php endif; ?>
                            
                        </div>
                        <!-- Tombol Edit Profil -->
                        <form action="editprofilnotulen" method="POST">
                            <input type="hidden" name="nama" value="<?= isset($user_profile['nama']) ? $user_profile['nama'] : 'N/A' ?>">
                            <input type="hidden" name="nip" value="<?= isset($user_profile['nip']) ? $user_profile['nip'] : 'N/A' ?>">
                            <input type="hidden" name="jabatan" value="<?= isset($user_profile['jabatan']) ? $user_profile['jabatan'] : 'N/A' ?>">
                            <input type="hidden" name="alamat" value="<?= isset($user_profile['alamat']) ? $user_profile['alamat'] : 'N/A' ?>">
                            <input type="hidden" name="tanggal_lahir" value="<?= isset($user_profile['tanggal_lahir']) ? $user_profile['tanggal_lahir'] : 'N/A' ?>">
                            <input type="hidden" name="email" value="<?= isset($user_profile['email']) ? $user_profile['email'] : 'N/A' ?>">
                            <input type="hidden" name="password" value="<?= isset($user_profile['password']) ? $user_profile['password'] : 'N/A' ?>">
                            <input type="hidden" name="role" value="<?= isset($user_profile['role']) ? $user_profile['role'] : 'N/A' ?>">
                            <input type="hidden" name="profil_foto" value="<?= isset($user_profile['profil_foto']) ? $user_profile['profil_foto'] : 'default.jpg' ?>">
                            <button type="submit" class="edit-btn">Edit Profil</button>
                        </form>
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
                        <div class="value">
                        <?php 
                            // Menghitung panjang password dan menampilkan bintang
                            $passwordLength = isset($user_profile['password']) ? strlen($user_profile['password']) : 0;
                            echo str_repeat('*', $passwordLength);
                        ?>
                        </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;

            themeIcon.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    themeIcon.src = '<?= base_url("assets/images/modegelap.png") ?>';
                } else {
                    themeIcon.src = '<?= base_url("assets/images/bulan.png") ?>';
                }
            });
        });
    </script>
</body>
</html>