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
        <!-- Sidebar Section -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <ul>
                <li>
                    <a href="dashboard_notulen" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="active notulensi">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                    <div class="dropdown-content">
                        <a href="melihatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        
                        <a href="buatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Buat Notulensi</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="riwayatnotulen" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li>
                    <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
                        Jadwal Rapat
                    </a>
                </li>
                <li>
                    <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/distribusi.png'); ?>" alt="Distribusi Notulensi Icon" class="sidebar-icon">
                        Distribusi Notulensi
                    </a>
                </li>
                <li>
                    <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/panduanpengguna.png'); ?>" alt="Panduan Pengguna Icon" class="sidebar-icon">
                        Panduan Pengguna
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/moon.png') ?>" alt="Toggle Theme" id="theme-icon">
                </div>

                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span><?= isset($nama) ? $nama : 'Nama Tidak Ditemukan'; ?></span>
                        </div>                            
                        <div class="user-role">
                            <span><?= isset($role) ? ucfirst($role) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                        <img src="<?= base_url('assets/images/profiles/' . ($profil_foto ? $profil_foto : 'default.png')) ?>" alt="Profile" class="profile-img" id="profile-icon">
                    </div>

                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="<?= base_url('notulen/profilnotulen') ?>" class="dropdown-item">
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
                <h1>Buat Notulensi</h1>
            </div>

            <div class="form-container">
                <div class="stat-box">
                    <form action="<?= base_url('notulen/simpan') ?>" method="POST" enctype="multipart/form-data">
                        <label for="judul" class="label-judul">Topik</label>
                        <input type="text" id="judul" name="judul" class="input-judul" placeholder="Input Topik">

                        <label for="agenda" class="label-agenda">Agenda</label>
                        <textarea id="agenda" name="agenda" class="textarea-agenda" placeholder="Input Agenda"></textarea>

                        <label for="tanggal" class="label-tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="input-tanggal" min="2010-01-01" max="2030-12-31">

                        <label for="partisipan" class="label-partisipan">Partisipan <span class="label-pegawai">(Pegawai)</span></label>
                        <textarea id="partisipan" name="partisipan" class="textarea-partisipan" placeholder="Input Partisipan"></textarea>

                        <label for="partisipan-2" class="label-partisipan-2">Partisipan <span class="label-non-pegawai">(Non-Pegawai)</span></label>
                        <textarea id="partisipan" name="partisipan" class="textarea-partisipan" placeholder="Input Partisipan"></textarea>

                        <label for="email" class="label-email">Email</label>
                        <textarea id="agenda" name="agenda" class="textarea-agenda" placeholder="Input Email"></textarea>
                    </form>
                </div>

                <div class="stat-box-2">
                    <div class="textarea-container">
                        <label for="pembahasan">Pembahasan</label>
                        <textarea id="pembahasan" name="pembahasan" class="textarea-pembahasan" placeholder=""></textarea>
                            <button type="button" id="speech-btn" class="mic-button">
                                <img src="<?= base_url('assets/images/microphone.png') ?>" alt="Voice" class="mic-icon">
                            </button>
                    </div>

                    <label for="upload" class="upload-label">Upload Dokumentasi <span>(file maks 5 MB)</span></label>
                    <br>
                    <label for="upload" class="custom-file-upload">📂 Pilih File</label>
                    <input type="file" id="upload" name="upload" accept="image/*">
    
                    <!-- Kotak Preview -->
                    <div class="preview-container" id="previewContainer">
                        <div class="image-box">
                            <img id="imagePreview" src="" alt="Preview Gambar">
                        </div>
                    </div>

                    <p class="error-message" id="errorMessage"></p>

                    <button type="submit" class="btn-save">
                        <img src="<?php echo base_url('assets/images/simpan.png'); ?>" alt="icon">
                        Simpan
                    </button>
                </div>
            </div>
        </div>

        <!-- Popup Logout -->
        <div class="popup-overlay" id="popupOverlay">
            <div class="popup">
                <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="popup-image">
                <h3>Anda ingin logout?</h3>
                <div class="popup-buttons">
                    <button class="btn-yes" id="confirmLogout">Ya</button>
                    <button class="btn-no" id="cancelLogout">Tidak</button>
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
            const isDark = body.classList.contains('dark-mode');
            themeIcon.src = isDark ? '<?= base_url("assets/images/sun.png") ?>' : '<?= base_url("assets/images/moon.png") ?>';
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });

        tinymce.init({
            selector: '#pembahasan',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code | speechToText',
            height: 300,
            setup: function (editor) {
                editor.ui.registry.addButton('speechToText', {
                    text: '',
                    tooltip: 'Gunakan suara untuk mengetik',
                    icon: 'microphone',
                    onAction: function () {
                        startSpeechToText(editor);
                    }
                });
            }
        });

        function startSpeechToText(editor) {
            if (!('webkitSpeechRecognition' in window)) {
                alert("Browser tidak mendukung Speech Recognition.");
                return;
            }

            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'id-ID';
            recognition.continuous = false;
            recognition.interimResults = false;
            
            recognition.start();

            recognition.onresult = function (event) {
                const text = event.results[0][0].transcript;
                editor.insertContent(text);
            };

            recognition.onerror = function (event) {
                console.error("Speech recognition error:", event.error);
                alert("Terjadi kesalahan saat mendengarkan.");
            };
        }

        document.getElementById('speech-btn').addEventListener('click', function () {
            startSpeechToText(tinymce.get('pembahasan'));
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const speechBtn = document.getElementById('speech-btn');
        const micIcon = speechBtn.querySelector('img');
        let recognition;
        let isListening = false;

        if ('webkitSpeechRecognition' in window) {
            recognition = new webkitSpeechRecognition();
            recognition.lang = 'id-ID';
            recognition.continuous = false;
            recognition.interimResults = false;

            recognition.onstart = function () {
                isListening = true;
                micIcon.src = '<?= base_url("assets/images/microphoneaktif.png") ?>';
                speechBtn.classList.add('listening');
            };

            recognition.onend = function () {
                isListening = false;
                micIcon.src = '<?= base_url("assets/images/microphone.png") ?>';
                speechBtn.classList.remove('listening');
            };

            recognition.onresult = function (event) {
                const text = event.results[0][0].transcript;
                tinymce.get('pembahasan').insertContent(text);
            };

            recognition.onerror = function (event) {
                alert("Terjadi kesalahan saat mendengarkan.");
                isListening = false;
                micIcon.src = '<?= base_url("assets/images/microphone.png") ?>';
                speechBtn.classList.remove('listening');
            };
        }

        speechBtn.addEventListener('click', function () {
            if (isListening) {
                recognition.stop();
            } else {
                recognition.start();
            }
        });
    });

    document.getElementById("upload").addEventListener("change", function(event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById("imagePreview");
    const errorMessage = document.getElementById("errorMessage");

    if (file) {
        if (file.size > 5 * 1024 * 1024) {  // Batas 5MB
            errorMessage.textContent = "File terlalu besar! Maksimal 5MB.";
            errorMessage.style.display = "block";
            imagePreview.style.display = "none"; // Sembunyikan gambar jika error
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";  // Tampilkan gambar setelah upload
            errorMessage.style.display = "none";
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = "none"; // Sembunyikan gambar jika tidak ada file
    }
});

const profileIcon = document.getElementById('profile-icon');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileIcon.addEventListener('click', (event) => {
        event.stopPropagation(); 
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', () => {
        dropdownMenu.classList.remove('show');
    });

    // JavaScript untuk Popup Logout
    const logoutLink = document.getElementById('logoutLink'); // Perbaikan ID
    const popupOverlay = document.getElementById('popupOverlay');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    // Menampilkan popup konfirmasi logout
    logoutLink.addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah link logout berfungsi langsung
        popupOverlay.style.display = 'block'; // Menampilkan popup overlay
    });

    // Menyelesaikan logout ketika tombol "Ya" diklik
    confirmLogout.addEventListener('click', () => {
        window.location.href = '/'; // Ganti dengan halaman logout atau proses logout
    });

    // Menyembunyikan popup ketika tombol "Tidak" diklik
    cancelLogout.addEventListener('click', () => {
        popupOverlay.style.display = 'none'; 
    });

    </script>
</body>
</html>
