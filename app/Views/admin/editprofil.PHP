<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="/assets/css/editprofilpegawai.css">
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
                    <img src="/assets/images/datauser.png" alt="Data Pengguna" class="menu-icon">
                    <span>Data Pengguna</span>
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
                    <div class="user-name"><?= $nama ?? 'N/A' ?></div>
                    <div class="user-role"><?= $role ?? 'N/A' ?></div>
                </div>
                <div class="user-avatar">
                    <img src="<?= base_url('assets/images/profiles/' . ($profil_foto ?? 'default-avatar.png')) ?>" 
                    alt="User Avatar" class="avatar-img">
                </div>
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
                                <img src="<?= base_url('assets/images/profiles/' . ($profil_foto ?? 'default-avatar.png')) ?>" alt="Profile" class="avatar-img">
                            </div>
                        </div>
                        <div class="upload-container">
                            <input type="file" id="upload" class="upload-input">
                        </div>
                    </div>
                    <button class="save-button">Simpan Perubahan</button>
                </div>

                <div class="profile-details-box">
                    <!-- Field for Nama -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Nama</span>
                            <span id="nama-display" class="field-value"><?= $nama ?? 'N/A' ?></span>
                            <input type="text" id="nama-input" value="<?= $nama ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('nama-input', 'nama-display')"></i>
                    </div>

                    <!-- Field for NIP -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">NIP</span>
                            <span id="nip-display" class="field-value"><?= $nip ?? 'N/A' ?></span>
                            <input type="text" id="nip-input" value="<?= $nip ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('nip-input', 'nip-display')"></i>
                    </div>

                    <!-- Field for Jabatan -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Jabatan</span>
                            <span id="jabatan-display" class="field-value"><?= $jabatan ?? 'N/A' ?></span>
                            <input type="text" id="jabatan-input" value="<?= $jabatan ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('jabatan-input', 'jabatan-display')"></i>
                    </div>

                    <!-- Field for Alamat -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Alamat</span>
                            <span id="alamat-display" class="field-value"><?= $alamat ?? 'N/A' ?></span>
                            <input type="text" id="alamat-input" value="<?= $alamat ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('alamat-input', 'alamat-display')"></i>
                    </div>

                    <!-- Field for Tanggal Lahir -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Tanggal Lahir</span>
                            <span id="tanggal_lahir-display" class="field-value"><?= $tanggal_lahir ?? 'N/A' ?></span>
                            <input type="date" id="tanggal_lahir-input" value="<?= $tanggal_lahir ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('tanggal_lahir-input', 'tanggal_lahir-display')"></i>
                    </div>

                    <!-- Field for Email -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Email</span>
                            <span id="email-display" class="field-value"><?= $email ?? 'N/A' ?></span>
                            <input type="email" id="email-input" value="<?= $email ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('email-input', 'email-display')"></i>
                    </div>

                    <!-- Field for Password -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Password</span>
                            <span id="password-display" class="field-value">•••••••</span>
                            <input type="password" id="password-input" value="•••••••" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('password-input', 'password-display')"></i>
                    </div>

                    <!-- Field for Status -->
                    <div class="profile-field">
                        <div class="field-left">
                            <span class="field-label">Status</span>
                            <span id="status-display" class="field-value"><?= $role ?? 'N/A' ?></span>
                            <input type="text" id="status-input" value="<?= $role ?? 'N/A' ?>" class="field-input" style="display:none;">
                        </div>
                        <i class="fas fa-edit edit-icon" onclick="toggleEdit('status-input', 'status-display')"></i>
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

        function toggleEdit(fieldId, spanId) {
            var field = document.getElementById(fieldId);
            var span = document.getElementById(spanId);

            // Toggle between input and span visibility
            if (field.style.display === 'none') {
                field.style.display = 'block';
                span.style.display = 'none';
            } else {
                field.style.display = 'none';
                span.style.display = 'block';
            }
        }
    </script>
</body>
</html>
