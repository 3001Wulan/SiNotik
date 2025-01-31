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
            <label for="judul" class="label-judul">Judul</label>
            <input type="text" id="judul" name="judul" class="input-judul" placeholder="">

            <label for="agenda" class="label-agenda">Agenda</label>
            <textarea id="agenda" name="agenda" class="textarea-agenda" placeholder=""></textarea>

            <label for="tanggal" class="label-tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="input-tanggal" min="2010-01-01" max="2030-12-31">

            <label for="partisipan" class="label-partisipan">Partisipan</label>
            <textarea id="partisipan" name="partisipan" class="textarea-partisipan" placeholder=""></textarea>
    </div>

    <div class="stat-box-2">
        <div class="textarea-container">
            <textarea id="pembahasan" name="pembahasan" class="textarea-pembahasan" placeholder=""></textarea>
            <button type="button" id="speech-btn" class="mic-button">
                <img src="<?= base_url('assets/images/microphone.png') ?>" alt="Voice" class="mic-icon">
            </button>
        </div>

        <label for="upload" class="upload-label">Upload Dokumentasi (<span>file maks 5 MB</span>)</label>
        <input type="file" id="upload" name="upload">

        <button type="submit">Simpan</button>
        </form>
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
</script>
</body>
</html>
