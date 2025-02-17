<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pegawai</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/panduanpegawai.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</head>
<body>
    <?php $current_page = $current_page ?? ''; ?>
    <div class="container">
       <!-- Sidebar -->
       <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" class="logo-img">
            </div>
            <ul>
                <li>
                    <a href="dashboard_pegawai" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="melihatpegawai" class="<?php echo ($current_page == 'melihat_pegawai') ? 'active notulensi-pegawai ' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                </li>
                <li>
                    <a href="riwayatpegawai" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li>
                    <a href="jadwalrapat" class="inactive">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
                        Jadwal Rapat
                    </a>
                </li>
                <li>
                    <a href="panduanpegawai" class="active">
                        <img src="<?php echo base_url('assets/images/panduanpengguna.png'); ?>" alt="Panduan Pengguna Icon" class="sidebar-icon">
                        Panduan Pengguna
                    </a>
                </li>
            </ul>
        </div>

        <div class="content">
            <div class="top-bar">
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>">
                </div>

                <!-- Profil -->
            <div class="user-info">
                <div class="user-text">
                    <div class="user-name">
                        <span><?= session()->get('nama') ? session()->get('nama') : 'Nama Tidak Ditemukan'; ?></span>
                        </div>
                        <div class="user-role">
                            <span><?= session()->get('role') ? ucfirst(session()->get('role')) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                        <img src="<?= base_url('assets/images/profiles/' . (file_exists('assets/images/profiles/' . session()->get('profil_foto')) ? session()->get('profil_foto') : 'delvaut.png')) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="<?= base_url('pegawai/profilpegawai') ?>" class="dropdown-item">
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

            <!-- Page Tittle -->
            <div class="page-title">
                    <h1>Panduan Pengguna</h1>
            </div>
    
            <!-- Card Dashboard -->
            <div class="card dashboard-card" onclick="toggleDropdown(this)">
                <h2>
                    <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" class="card-icon">
                    Dashboard
                </h2>

                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-content">
                        <p>Di halaman dashboard terdapat 4 komponen utama:</p>
                        <ul>
                            <li><b>Total Pegawai:</b> Menampilkan jumlah keseluruhan pegawai yang bekerja di <b>DISKMONINFO Solok Selatan</b>.</li>
                            <li><b>Total Notulensi:</b> Menampilkan total notulensi dari keseluruhan rapat yang dilaksanakan oleh semua bidang yang ada di <b>DISKOMINFO Solok Selatan</b>.</li>
                            <li><b>Statistik Pegawai per Bidang:</b> Menampilkan jumlah pegawai berdasarkan bidang.
                                <ul>
                                    <li><b>Bidang Aplikasi dan Informatika (APTIKA)</b></li>
                                    <li><b>Bidang Infomasi dan Komunikasi Publik (IKP)</b></li>
                                    <li><b>Bidang Statistik dan Persandian</b></li>
                                </ul>
                            </li>
                            <li><b>Statistik Notulensi per Bidang:</b> Menampilkan total notulensi berdasarkan bidang.</li>
                        </ul>
                    </div>

                    <!-- Card untuk Gambar -->
                    <div class="card-image">
                        <img src="<?php echo base_url('assets/images/CINDY_.jpg'); ?>" alt="screenshoot" class="screenshoot-dashboard">
                    </div>
                </div>
            </div>

            <!-- Card Notulensi -->
            <div class="card notulensi-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" class="card-icon">
                    Notulensi
                </h2>

                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-notulensi-content">
                        <p class="intro-text">Halaman ini digunakan untuk mengelola informasi notulensi. Pegawai dapat melihat data notulensi yang tampil dalam bentuk tabel. Tabel daftar notulensi ini berisi <b>Topik, Bidang, Tanggal dan Aksi</b>. Untuk Aksi itu, pegawai bisa melihat <b>detail</b> dari notulensi.</p>
                        <ul>
                            <li><b>Kategori:</b> Untuk <b>menampilkan data notulensi per bidang.</b> Untuk bidangnya ada 3 yaitu, <b>APTIKA, IKP, Statistik dan Persandian.</b></li>
                            <li><b>Pencarian:</b> Mempermudah pencarian pengguna berdasarkan <b>topik</b> dan <b>bidang</b>.</li>
                            <li><b>Show Entries:</b> Mempermudah pengguna dalam mengatur jumlah data yang ditampilkan dalam tabel, sehingga dapat memilih untuk menampilkan <b>5, 10, 15, atau 20</b> data pengguna dalam satu halaman.</li>
                        </ul>
                        <p class="section-tittle">Dihalaman ini terdapat 2 komponen utama:</p>

                        <!-- Card untuk Komponen Utama -->
                        <div class="component-cards-notulensi">
                            <div class="component-card-notulensi" onclick="changeContent('detail')">
                                <i class="fas fa-folder-open"></i> Detail Notulensi
                            </div>
                            <div class="component-card-notulensi" onclick="changeContent('feedback')">
                                <i class="fas fa-comment-alt"></i> Feedback
                            </div>
                        </div>
                    </div>

                    <!-- Card untuk Gambar -->
                    <div class="card-notulensi-image">
                        <img id="component-image" src="<?= base_url('assets/images/INTAN_.jpg') ?>" alt="Notulensi">
                    </div>
                </div>
            </div>

            <!-- Card Riwayat -->
            <div class="card riwayat-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" class="card-icon">
                    Riwayat Notulensi
                </h2>

                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-riwayat-content">
                        <p class="intro-text-riwayat">Halaman ini menyajikan daftar <b>riwayat notulensi</b> dari berbagai <b>rapat</b> yang telah dilaksanakan dalam bentuk <b>tabel</b>. Pegawai dapat menelusuri <b>riwayat notulensi</b> berdasarkan <b>tanggal, bidang</b>, atau <b>kategori bidang</b> untuk kemudahan pencarian.</p>
                        <p class="section-text">Di halaman ini terdapat beberapa fitur utama:</p>
                            <ul>
                                <li><b>Tabel Notulensi:</b> Berisi informasi lengkap seperti <b>Tanggal, Bidang, Agenda, Notulen, Partisipan, Hasil Pembahasan, dan Dokumentasi</b>.</li>
                                <li><b>Filter Data:</b> Memungkinkan admin untuk memfilter notulensi berdasarkan <b>tanggal awal, tanggal akhir</b>, dan <b>kategori</b>.</li>
                                <li><b>Pencarian Cepat:</b> Admin dapat mencari notulensi tertentu menggunakan kolom <b>search</b>.</li>
                                <li><b>Show Entries:</b> Mempermudah pengguna dalam mengatur jumlah data yang ditampilkan dalam tabel, sehingga dapat memilih untuk menampilkan <b>5, 10, 15, atau 20</b> data notulensi dalam satu halaman.</li>
                                <li><b>Export PDF:</b> Notulensi dapat dicetak dalam format <b>PDF</b> untuk keperluan dokumentasi dan arsip.</li>
                            </ul>
                    </div>

                    <!-- Card untuk Gambar -->
                    <div class="card-riwayat-image">
                        <img src="<?php echo base_url('assets/images/WULAN_.jpg'); ?>" alt="screenshoot" class="screenshoot-dashboard">
                    </div>
                </div>
            </div>

             <!-- Card Jadwal Rapat -->
             <div class="card rapat-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/rapat.png'); ?>" class="card-icon">
                    Jadwal Rapat
                </h2>

                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-rapat-content" id="card-content">
                    <p class="intro-text-jadwal">Halaman ini digunakan untuk mengelola jadwal rapat. Terdapat dua bagian utama, yaitu <b>Buat Jadwal Rapat</b> untuk menambahkan rapat baru dengan detail seperti topik, agenda, tanggal, waktu, dan tempat, serta <b>Daftar Jadwal Rapat</b> yang menampilkan daftar rapat yang telah dijadwalkan beserta status dan detailnya.</p>
                        <p class="section-tittle">Ada 2 komponen utama:</p>
                        
                        <!-- Card untuk Komponen Utama -->
                        <div class="component-cards-rapat">
                            <div class="component-card-rapat" onclick="changeRapatContent('buat')">
                                <i class="fas fa-calendar-plus"></i> Buat Jadwal Rapat
                            </div>
                            <div class="component-card-rapat" onclick="changeRapatContent('jadwal')">
                                <i class="fas fa-list"></i> Jadwal Rapat
                            </div>
                        </div>
                    </div>

                    <!-- Card untuk Gambar -->
                    <div class="card-rapat-image">
                        <img id="rapat-image" src="<?= base_url('assets/images/HENI_.jpg') ?>" alt="Rapat">
                    </div>
                </div>
            </div>

            <!-- Card Profil -->
            <div class="card profil-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/profil.png'); ?>" class="card-icon">
                    Profil
                </h2>

                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-profil-content">
                        <p class="intro-text-profil">Halaman ini merupakan halaman <b>Profil Pengguna</b> yang menampilkan informasi pribadi pengguna yang telah terdaftar dalam sistem. Pada halaman ini, pengguna dapat melihat data diri mereka, termasuk <b>nama, NIP, jabatan, alamat, tanggal lahir, email, password,</b> serta <b>status</b> pengguna dalam sistem.</p>
                        <p class="section-text-profil">Di halaman ini terdapat beberapa poin utama:</p>
                    <ul>
                        <li><b>Informasi Pengguna:</b> Menampilkan data profil pengguna secara rinci.</li>
                        <li><b>Edit Profil:</b> Tombol <b>Edit Profil</b> memungkinkan pengguna untuk memperbarui informasi pribadi mereka sesuai kebutuhan.</li>
                        <li><b>Status Pengguna:</b> Menunjukkan status pengguna dalam sistem, seperti <b>Admin,</b> <b>Pegawai,</b> atau <b>Notulen</b>.</li>
                    </ul>
                </div>
                    <!-- Card untuk Gambar -->
                    <div class="card-profil-image">
                        <img src="<?php echo base_url('assets/images/CINDY_.jpg'); ?>" alt="screenshoot" class="screenshoot-dashboard">
                    </div>
                </div>
            </div>

            <!-- Card Edit Prodil -->
            <div class="card edit-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/edit.png'); ?>" class="card-icon">
                    Edit Profil
                </h2>

                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-profil-content">
                        <p class="intro-text-profil">Halaman ini merupakan halaman <b>Edit Profil</b> yang memungkinkan pengguna untuk memperbarui informasi pribadi mereka dalam sistem. Pada halaman ini, pengguna dapat mengubah data seperti <b>nama, NIP, jabatan, alamat, tanggal lahir, email, password,</b> serta mengganti <b>foto profil</b>.</p>
                        <p class="section-text-profil">Di halaman ini terdapat beberapa fitur utama:</p>
                            <ul>
                                <li><b>Edit Data Profil:</b> Setiap informasi dapat diedit dengan menekan ikon <b>edit</b> yang tersedia di samping masing-masing field.</li>
                                <li><b>Upload Foto Profil:</b> Pengguna dapat mengganti foto profil mereka dengan memilih file gambar yang berukuran maksimal <b>5 MB</b>.</li>
                                <li><b>Simpan Perubahan:</b> Setelah melakukan perubahan, pengguna dapat menekan tombol <b>"Simpan Perubahan"</b> agar data yang telah diedit tersimpan dalam sistem.</li>
                            </ul>
                    </div>

                    <!-- Card untuk Gambar -->
                    <div class="card-edit-image">
                        <img src="<?php echo base_url('assets/images/INTAN_.jpg'); ?>" alt="screenshoot" class="screenshoot-dashboard">
                    </div>
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
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function (event) {
                let gridContainer = this.querySelector('.grid-container');

                    if (!gridContainer) return;

                let isCurrentlyOpen = gridContainer.classList.contains("show");

                document.querySelectorAll(".grid-container.show").forEach(container => {
                    if (container !== gridContainer) {
                        container.classList.remove("show");
                    }
                });

                if (!isCurrentlyOpen) {
                    gridContainer.classList.add("show");
                }

                event.stopPropagation();
            });

            card.addEventListener('mouseleave', function () {
                let gridContainer = this.querySelector('.grid-container');
                    if (gridContainer) {
                        gridContainer.classList.remove("show");
                    }
            });
        });

        function changeContent(component) {
            let image = document.getElementById("component-image");
            let contentText = document.querySelector(".card-notulensi-content");


            let baseURL = "<?= base_url(); ?>";
            let images = {
                "detail": baseURL + "assets/images/HENI_.jpg",
                "feedback": baseURL + "assets/images/WULAN_.jpg"
            };

            let descriptions = {
                "detail": `
                    <p style="margin-top: 20px; text-align: justify;">
                        Halaman <b>Detail Notulensi</b> digunakan untuk menampilkan informasi lengkap mengenai suatu notulensi rapat yang telah dibuat dalam sistem.
                         Pengguna dapat melihat agenda rapat, daftar partisipan, pembahasan, serta dokumentasi foto terkait.
                    </p>

                    <p style="text-align: justify;"><b>Fitur utama dalam halaman ini:</b></p>
                        <ul class="checklist">
                            <li><b>Agenda Rapat:</b> Menampilkan daftar agenda yang dibahas dalam rapat.</li>
                            <li><b>Partisipan:</b> Menunjukkan daftar pegawai dan non-pegawai yang berpartisipasi dalam rapat.</li>   
                            <li><b>Pembahasan:</b> Berisi ringkasan atau catatan dari hasil diskusi dalam rapat.</li>
                            <li><b>Dokumentasi Foto:</b> Jika tersedia, pengguna dapat melihat dan mengunduh dokumentasi foto rapat melalui tombol <b>Unduh</b>.</li>
                            <li><b>Unduh Notulensi:</b> Pengguna dapat mengunduh notulensi dalam format dokumen melalui tombol <b>Unduh</b> untuk keperluan arsip atau referensi.</li>
                            <li><b>Fitur Komentar:</b> Pengguna dapat memberikan komentar secara real-time untuk berdiskusi atau menambahkan informasi tambahan.</li>
                        </ul>
                `,
        
                "feedback": `
                    <p style="margin-top: -5px; text-align: justify;">
                        Halaman <b>Komentar Notulensi</b> memungkinkan pengguna untuk memberikan tanggapan, atau catatan tambahan terkait hasil rapat yang telah dicatat dalam sistem.
                        Fitur ini membantu komunikasi antar pengguna secara lebih interaktif.
                    </p>

                    <p style="text-align: justify;"><b>Fitur utama dalam halaman ini:</b></p>
                        <ul class="checklist">
                            <li><b>Kolom Input Komentar:</b> Pengguna dapat mengetikkan komentar dan mengirimkannya secara langsung. Fitur emoji juga tersedia untuk menambahkan ekspresi dalam pesan.</li>
                            <li><b>Riwayat Komentar:</b> Menampilkan daftar komentar dari berbagai pengguna, lengkap dengan informasi nama, waktu, dan isi komentar.</li>
                            <li><b>Interaksi Real-Time:</b> Komentar yang dikirim akan langsung muncul tanpa perlu memuat ulang halaman, mempermudah komunikasi.</li>
                        </ul>
                `
            };

            if (images[component]) {
                image.src = images[component];
            }

            if (contentText) {
                contentText.innerHTML = descriptions[component];
            }

            let gridContainer = document.querySelector(".grid-container");
                if (gridContainer) {
                    gridContainer.classList.add("show");
                }

            setTimeout(() => {
                resetToDefault();
            }, 20000); 
        }

        const defaultImageSrc = document.getElementById("component-image")?.src;
        const defaultContent = document.querySelector(".card-notulensi-content")?.innerHTML;

        function resetToDefault() {
            let image = document.getElementById("component-image");
            let contentText = document.querySelector(".card-notulensi-content");

            if (image) {
                image.src = defaultImageSrc; 
            }

            if (contentText) {
                contentText.innerHTML = defaultContent; 
            }

            document.querySelectorAll(".grid-container.show").forEach(container => {
                let parentCard = container.closest(".notulensi-card");
                    if (!parentCard) {
                        container.classList.remove("show"); 
                    }
            });

            let cardNotulensi = document.querySelector(".notulensi-card .grid-container");
                if (cardNotulensi && !cardNotulensi.classList.contains("show")) {
                    cardNotulensi.classList.add("show");
                }
        }

        function changeRapatContent(component) {
            let image = document.getElementById("rapat-image");
            let contentText = document.querySelector(".card-rapat-content");

            let baseURL = "<?= base_url(); ?>";
            let images = {
                "buat": baseURL + "assets/images/INTAN_.jpg",
                "jadwal": baseURL + "assets/images/CINDY_.jpg"
            };

            let descriptions = {
                "buat": `
                    <p style="margin-top: -5px; text-align: justify;"> 
                        Halaman <b>Buat Jadwal Rapat</b> digunakan untuk membuat dan mengatur jadwal rapat baru dalam sistem. 
                        Pengguna dapat memasukkan detail penting seperti <b>topik rapat, agenda, tanggal, waktu, dan lokasi</b> agar rapat dapat terjadwal dengan jelas dan terorganisir.
                    </p>

                    <p style="text-align: justify;"><b>Langkah-langkah dalam membuat jadwal rapat:</b></p>
                        <ul class="checklist" style="text-align : justify; line-heigt : 1.5;">
                            <li><b>Pengisian Data Rapat:</b> Pengguna mengisi informasi rapat termasuk <b>topik, agenda, tanggal, waktu, dan lokasi</b>.</li>
                            <li><b>Tombol Simpan:</b> Setelah data diisi, admin dapat menekan tombol <b>Simpan</b> agar jadwal tersimpan dalam sistem.</li>
                        </ul>
                `,

                "jadwal": `
                    <p style="margin-top: -5px; text-align: justify;">
                        Halaman <b>Jadwal Rapat</b> digunakan untuk menampilkan daftar jadwal rapat yang telah direncanakan dalam sistem.
                        Pengguna dapat melihat informasi rapat seperti topik, bidang terkait, tanggal pelaksanaan, serta status persetujuan.
                    </p>

                    <p style="text-align: justify;"><b>Fitur utama dalam halaman ini:</b></p>
                    <ul class="checklist">
                        <li><b>Daftar Jadwal Rapat:</b> Menampilkan informasi <b>Topik, Bidang, Tanggal, dan Status</b> apakah rapat telah disetujui, ditolak, atau masih menunggu persetujuan.</li>
                        <li><b>Indikator Status:</b> Rapat yang telah <b>disetujui</b> akan ditandai dengan warna hijau, <b>belum disetujui</b> berwarna abu-abu, dan <b>ditolak</b> berwarna merah.</li>
                        <li><b>Popup Alasan Penolakan:</b> Untuk rapat yang ditolak, terdapat ikon yang dapat diklik untuk menampilkan alasan penolakan.</li>
                        <li><b>Pencarian:</b> Pengguna dapat melakukan pencarian dan filter berdasarkan bidang dan topik untuk menemukan jadwal yang diinginkan.</li>
                        <li><b>Show Entries:</b> Mempermudah pengguna dalam mengatur jumlah data yang ditampilkan dalam tabel, sehingga dapat memilih untuk menampilkan <b>5, 10, 15, atau 20</b> data pengguna dalam satu halaman.</li>
                </ul>
                `
            };

            if (images[component]) {
                image.src = images[component];
            }

            if (contentText) {
                contentText.innerHTML = descriptions[component];
            }

            let gridContainer = document.querySelector(".grid-container");
                if (gridContainer) {
                    gridContainer.classList.add("show");
                }

                setTimeout(() => {
                    resetRapatToDefault();
                }, 20000); 
        }

        const defaultRapatImageSrc = document.getElementById("rapat-image")?.src;
        const defaultRapatContent = document.querySelector(".card-rapat-content")?.innerHTML;

        function resetRapatToDefault() {
            let image = document.getElementById("rapat-image");
            let contentText = document.querySelector(".card-rapat-content");

                if (image) {
                    image.src = defaultRapatImageSrc; 
                }
                
                if (contentText) {
                    contentText.innerHTML = defaultRapatContent; 
                }

            document.querySelectorAll(".grid-container.show").forEach(container => {
                let parentCard = container.closest(".rapat-card");
                if (!parentCard) {
                    container.classList.remove("show"); 
                }
            });

            let cardRapat = document.querySelector(".rapat-card .grid-container");
                if (cardRapat && !cardRapat.classList.contains("show")) {
                    cardRapat.classList.add("show");
            }
        }

        toggleDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const darkModeEnabled = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);

            toggleDarkMode.src = darkModeEnabled ? 
                '<?php echo base_url('assets/images/sun.png'); ?>' : 
                '<?php echo base_url('assets/images/moon.png'); ?>';
        });

        window.addEventListener('DOMContentLoaded', () => {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                toggleDarkMode.src = '<?php echo base_url('assets/images/sun.png'); ?>';
            } else {
                toggleDarkMode.src = '<?php echo base_url('assets/images/moon.png'); ?>';
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

        const logoutLink = document.getElementById('logoutLink');
        const popupOverlay = document.getElementById('popupOverlay');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        logoutLink.addEventListener('click', (event) => {
            event.preventDefault();
            popupOverlay.style.display = 'block';
        });

        cancelLogout.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
        });

        confirmLogout.addEventListener('click', () => {
            window.location.href = '<?= base_url('/') ?>';
        });
    </script>
</body>
</html>
