<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Notulen</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/buatnotulen.css') ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/kzhu1y29ebiqcpgqhegcnqpvqwp8c1wgqwxr311nobkkj4e2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="Dashboard_notulen" class="menu-item-link">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <div class="menu-item dropdown">
                    <a href="dashboard_notulen" class="dropdown-item">
                        <img src="<?= base_url('assets/images/notulensi.png') ?>" alt="Data User Icon">
                        <span>Notulensi</span>
                    </a>
                    <div class="dropdown-content">
                            <a href="melihatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        <div class="dropdown-separator"></div>
                        <a href="buatnotulen" class="dropdown-item">
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
                        <img src="<?= base_url('assets/images/profiles/' . ($profil_foto ? $profil_foto : 'delvaut.png')) ?>" alt="Profile Picture" id="profile-pic">
                        <div class="profile-info">
                            <p class="profile-name"><?= $nama ?></p> 
                            <p class="profile-role"><?= $role ?></p> 
                    </div>
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
                <h2>Buat Notulensi</h2>
            </div>

            <div class="form-container">
                <div class="stat-box">
                    <form action="<?= base_url('notulen/simpan') ?>" method="POST" enctype="multipart/form-data">
                        <label for="judul" class="label-judul">Judul</label><br>
                        <input type="text" id="judul" name="judul" class="input-judul" placeholder=""><br><br>

                        <label for="agenda" class="label-agenda">Agenda</label><br>
                        <textarea id="agenda" name="agenda" class="textarea-agenda" placeholder=""></textarea><br><br>

                        <label for="tanggal" class="label-tanggal">Tanggal</label><br>
                        <input type="date" id="tanggal" name="tanggal" class="input-tanggal" 
                               min="2010-01-01" max="2030-12-31"><br><br>

                        <label for="partisipan" class="label-partisipan">Partisipan</label><br>
                        <textarea id="partisipan" name="partisipan" class="textarea-partisipan" placeholder=""></textarea><br><br>
                </div>

                <div class="stat-box-2">
                        <label for="pembahasan" class="label-pembahasan">Pembahasan</label><br>
                        <textarea id="pembahasan" name="pembahasan" class="textarea-pembahasan" placeholder=""></textarea><br><br>

                        <label for="upload" class="upload-label">Upload Dokumentasi (<span>file maks 5 MB</span>)</label><br>
                        <input type="file" id="upload" name="upload"><br><br>

                        <button type="submit">Simpan</button>
                    </form>
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
            tinymce.init({
    selector: '#pembahasan',
    plugins: 'lists link image table code',
    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code',
    height: 300,
    images_upload_url: '/upload-image',  // URL server yang menerima file gambar
    automatic_uploads: true,  // Aktifkan pengunggahan otomatis
    images_upload_base_path: '/upload/', // Base path untuk gambar yang di-upload
    file_picker_types: 'image', // Menampilkan hanya opsi gambar saat memilih file
    file_picker_callback: function (callback, value, meta) {
        // Fungsi ini digunakan untuk memilih gambar dari perangkat
        var input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = function () {
            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                // Kirim gambar ke TinyMCE
                callback(e.target.result, { alt: file.name });
            };
            reader.readAsDataURL(file);
        };
        input.click();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Tema dan Dropdown Logic
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
                };

                closeBtn.onclick = function() {
                    logoutModal.style.display = 'none';
                };

                cancelBtn.onclick = function() {
                    logoutModal.style.display = 'none';
                };

                confirmBtn.onclick = function() {
                    window.location.href = 'logout.php'; 
                };
            });
        });
    </script>
</body>
</html>
