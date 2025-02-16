<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Admin</title>
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
    
            <!-- Card Dashboard yang membungkus semua -->
            <div class="card dashboard-card" onclick="toggleDropdown(this)">
                <h2>
                    <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" class="card-icon">
                    Dashboard
                </h2>

                <!-- Grid Container untuk menampilkan penjelasan & gambar -->
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

            <!-- Card Data Pengguna -->
            <div class="card notulensi-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" class="card-icon">
                    Notulensi
                </h2>

                <!-- Grid Container -->
                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-notulensi-content">
                        <p class="intro-text">Halaman ini digunakan untuk mengelola informasi pengguna dalam sistem. Administrator dapat melihat, menambah, mengedit, dan menghapus data pengguna. Tabel Data Pengguna berisi <b>Foto Profil, Nama, NIP, Email, Status (Pegawai/Notulen)</b>, serta opsi <b>Edit</b> dan <b>Hapus</b>.</p>
                        <ul>
                            <li><b>Hapus Pengguna:</b> Untuk <b>menghapus data pengguna</b> dari sistem. Ketika ditekan <b>button hapus</b>, maka akan muncul <b>popup konfirmasi</b> apakah admin yakin ingin menghapus data tersebut.</li>
                            <li><b>Pencarian:</b> Mempermudah pencarian pengguna berdasarkan <b>nama, email</b>, dan <b>bidang</b>.</li>
                            <li><b>Show Entries:</b> Mempermudah pengguna dalam mengatur jumlah data yang ditampilkan dalam tabel, sehingga dapat memilih untuk menampilkan <b>5, 10, 15, atau 20</b> data pengguna dalam satu halaman.</li>
                        </ul>
                        <p class="section-tittle">Di halaman Data Pengguna terdapat 3 komponen utama:</p>

                        <!-- Card untuk 3 Komponen Utama -->
                        <div class="component-cards">
                            <div class="component-card" onclick="changeContent('daftar')">
                                <i class="fas fa-list"></i> Daftar Notulensi
                            </div>

                            <div class="component-card" onclick="changeContent('detail')">
                                <i class="fas fa-folder-open"></i> Detail Notulensi
                            </div>
                            <div class="component-card" onclick="changeContent('feedback')">
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

            <!-- Card Dashboard yang membungkus semua -->
            <div class="card riwayat-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" class="card-icon">
                    Riwayat Notulensi
                </h2>

                <!-- Grid Container untuk menampilkan penjelasan & gambar -->
                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-riwayat-content">
                        <p class="intro-text-riwayat">Halaman ini menyajikan daftar <b>riwayat notulensi</b> dari berbagai <b>rapat</b> yang telah dilaksanakan dalam bentuk <b>tabel</b>. Admin dapat menelusuri <b>riwayat notulensi</b> berdasarkan <b>tanggal, bidang</b>, atau <b>kategori bidang</b> untuk kemudahan pencarian. Selain itu, admin juga bisa <b>menghapus data notulensi</b> dari sistem.</p>
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

             <!-- Card Data Pengguna -->
             <div class="card rapat-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/rapat.png'); ?>" class="card-icon">
                    Jadwal Rapat
                </h2>

                <!-- Grid Container -->
                <div class="grid-container">
                    <!-- Card untuk Penjelasan -->
                    <div class="card-rapat-content" id="card-content">
                    <p class="intro-text-jadwal">Halaman ini digunakan untuk mengelola jadwal rapat. Terdapat dua bagian utama, yaitu <b>Buat Jadwal Rapat</b> untuk menambahkan rapat baru dengan detail seperti topik, agenda, tanggal, waktu, dan tempat, serta <b>Daftar Jadwal Rapat</b> yang menampilkan daftar rapat yang telah dijadwalkan beserta status dan detailnya.</p>
                        <p class="section-tittle">Ada 2 komponen utama:</p>
                        <!-- Card untuk 3 Komponen Utama -->
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

            <!-- Card Dashboard yang membungkus semua -->
            <div class="card profil-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/profil.png'); ?>" class="card-icon">
                    Profil
                </h2>

                <!-- Grid Container untuk menampilkan penjelasan & gambar -->
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

            <!-- Card Dashboard yang membungkus semua -->
            <div class="card edit-card" onclick="toggleDropdown(this, 'default')">
                <h2>
                    <img src="<?php echo base_url('assets/images/edit.png'); ?>" class="card-icon">
                    Edit Profil
                </h2>

                <!-- Grid Container untuk menampilkan penjelasan & gambar -->
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

                // Tutup semua dropdown lainnya sebelum membuka yang diklik
                document.querySelectorAll(".grid-container.show").forEach(container => {
                    if (container !== gridContainer) {
                        container.classList.remove("show");
                    }
                });

                // Jika dropdown yang diklik belum terbuka, buka dropdown
                if (!isCurrentlyOpen) {
                    gridContainer.classList.add("show");
                }

                // Mencegah event dari bubbling ke parent yang bisa menyebabkan penutupan langsung
                event.stopPropagation();
            });

            // Event untuk menutup dropdown saat cursor keluar dari card
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
                "daftar": baseURL + "assets/images/MAHIRA_.jpg",
                "detail": baseURL + "assets/images/HENI_.jpg",
                "feedback": baseURL + "assets/images/WULAN_.jpg"
            };

            let descriptions = {
                "daftar": `
                    <p style="margin-top: -5px; text-align: justify;">
                        Halaman <b>Tambah Pengguna</b> digunakan untuk menambahkan pengguna baru ke dalam sistem. Administrator dapat menginput data pengguna, 
                        mengunggah foto profil, serta mengatur password sebelum menyimpannya.
                    </p>

                    <p style="text-align: justify;"><b>Proses penambahan pengguna melibatkan beberapa langkah penting:</b></p>
                        <ul class="checklist">
                            <li><b>Pengisian Data:</b> Admin harus mengisi informasi penting seperti <b>Username, Nama Lengkap, NIP, Email, Status, Bidang, dan Jabatan.</b> 
                            Pastikan semua data dimasukkan dengan benar untuk menghindari kesalahan dalam sistem.</li>

                            <li><b>Upload Foto Profil:</b> Untuk setiap pengguna, admin dapat mengunggah foto profil dengan ukuran maksimal 5MB. 
                            Foto ini akan membantu dalam identifikasi pengguna dalam sistem.</li>
                
                            <li><b>Pengaturan Password:</b> Administrator harus menetapkan password untuk pengguna baru, serta mengonfirmasinya agar tidak terjadi kesalahan input. 
                            Password yang aman direkomendasikan untuk menghindari akses yang tidak sah.</li>
                
                            <li><b>Tombol Simpan Perubahan:</b> Tombol biru di bagian bawah digunakan untuk menyimpan data pengguna yang telah diinput ke dalam sistem.</li>
                        </ul>
                `,

                "detail": `
                    <p style="margin-top: 5px; text-align: justify;">
                        Halaman <b>Ubah Data Pengguna</b> digunakan untuk mengedit informasi pengguna yang sudah ada dalam sistem. 
                        Administrator dapat memperbarui data pengguna jika ada perubahan informasi.
                    </p>

                    <p style="text-align: justify;"><b>Langkah-langkah untuk mengedit data pengguna:</b></p>
                        <ul class="checklist">
                            <li><b>Memilih Pengguna:</b> Administrator memilih pengguna yang akan diedit dari daftar pengguna.</li>
                            <li><b>Memperbarui Data:</b> Administrator dapat memperbarui informasi seperti <b>Username, Nama Lengkap, NIP, Email, Status, Bidang, dan Jabatan.</b></li>
                            <li><b>Upload Foto Profil Baru:</b> Jika diperlukan, administrator bisa mengganti foto profil pengguna dengan ukuran maksimal 5MB.</li>
                            <li><b>Pengubahan Password:</b> Jika diperlukan, administrator bisa menetapkan password baru untuk pengguna.</li>
                            <li><b>Menyimpan Perubahan:</b> Setelah semua data diperbarui, administrator harus mengklik tombol <b>Simpan Perubahan</b> untuk memperbarui informasi pengguna di dalam sistem.</li>
                        </ul>
                `,
        
                "feedback": `
                    <p style="margin-top: 5px; text-align: justify;">Halaman <b>Detail Pengguna</b> menampilkan informasi lengkap tentang pengguna yang dipilih. 
                    Informasi yang ditampilkan mencakup <b>ID User, Username, Nama Lengkap, NIP, Email, Status, Bidang, dan Jabatan</b>. 
                    Selain itu, foto profil pengguna juga ditampilkan untuk memudahkan identifikasi.</p>
                `
            };

            // Ganti gambar dan konten sesuai pilihan
            if (images[component]) {
                image.src = images[component];
            }

            if (contentText) {
                contentText.innerHTML = descriptions[component];
            }

            // Pastikan dropdown tetap terbuka setelah mengganti konten
            let gridContainer = document.querySelector(".grid-container");
                if (gridContainer) {
                    gridContainer.classList.add("show");
                }

            // Reset tampilan ke Card Data Pengguna setelah 3 menit
            setTimeout(() => {
                resetToDefault();
            }, 2000); // 3 menit dalam milidetik
        }

        // Simpan tampilan awal Card Data Pengguna
        const defaultImageSrc = document.getElementById("component-image")?.src;
        const defaultContent = document.querySelector(".card-notulensi-content")?.innerHTML;

        function resetToDefault() {
            let image = document.getElementById("component-image");
            let contentText = document.querySelector(".card-notulensi-content");

            if (image) {
                image.src = defaultImageSrc; // Balik ke gambar awal
            }

            if (contentText) {
                contentText.innerHTML = defaultContent; // Balik ke teks awal
            }

            // Tutup semua dropdown kecuali yang ada di Card Data Pengguna
            document.querySelectorAll(".grid-container.show").forEach(container => {
                let parentCard = container.closest(".notulensi-card");
                    if (!parentCard) {
                        container.classList.remove("show"); // Hanya tutup dropdown di luar Card Data Pengguna
                    }
            });

            // Pastikan dropdown di Card Data Pengguna tetap terbuka
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
                        Admin dapat memasukkan detail penting seperti <b>topik rapat, agenda, tanggal, waktu, dan lokasi</b> agar rapat dapat terjadwal dengan jelas dan terorganisir.
                    </p>

                    <p style="text-align: justify;"><b>Langkah-langkah dalam membuat jadwal rapat:</b></p>
                        <ul class="checklist" style="text-align : justify; line-heigt : 1.5;">
                            <li><b>Pengisian Data Rapat:</b> Admin mengisi informasi rapat termasuk <b>topik, agenda, tanggal, waktu, dan lokasi</b>.</li>
                            <li><b>Tombol Simpan:</b> Setelah data diisi, admin dapat menekan tombol <b>Simpan</b> agar jadwal tersimpan dalam sistem.</li>
                        </ul>
                `,

                "jadwal": `
                    <p style="margin-top: 5px; text-align: justify;">  
                        Halaman <b>Persetujuan Rapat</b> digunakan untuk menampilkan dan mengelola permintaan persetujuan rapat yang diajukan oleh <b>pegawai</b> dan <b>notulen</b> dalam bentuk tabel.  
                        Admin dapat <b>menyetujui</b> atau <b>menolak</b> rapat berdasarkan keputusan <b>Kepala Bidang</b> masing-masing serta <b>Keputusan Kepala Dinas</b>.  
                    </p>

                    <p style="text-align: justify;"><b>Proses persetujuan rapat:</b></p>
                        <ul class="checklist" style="text-align : justify;">
                            <li><b>Meninjau Permintaan:</b> Admin melihat daftar permintaan rapat yang membutuhkan persetujuan.</li>
                            <li><b>Mengambil Keputusan:</b> Admin dapat memilih untuk <b>menyetujui</b> atau <b>menolak</b></li>
                            <li><b>Memberikan Alasan Penolakan Rapat:</b> Admin dapat menginputkan <b>alasan penolakan rapat</b> melalui <b>form dalam popup</b> yang muncul ketika <b>icon Tolak</b> ditekan.</li>
                        </ul>
                `
            };

            // Ganti gambar dan konten sesuai pilihan
            if (images[component]) {
                image.src = images[component];
            }

            if (contentText) {
                contentText.innerHTML = descriptions[component];
            }

            // Pastikan dropdown tetap terbuka setelah mengganti konten
            let gridContainer = document.querySelector(".grid-container");
                if (gridContainer) {
                    gridContainer.classList.add("show");
                }

                // Reset tampilan ke Card Rapat setelah 2 menit
                setTimeout(() => {
                    resetRapatToDefault();
                }, 2000); // 2 menit dalam milidetik
        }

        // Simpan tampilan awal Card Rapat
        const defaultRapatImageSrc = document.getElementById("rapat-image")?.src;
        const defaultRapatContent = document.querySelector(".card-rapat-content")?.innerHTML;

        function resetRapatToDefault() {
            let image = document.getElementById("rapat-image");
            let contentText = document.querySelector(".card-rapat-content");

                if (image) {
                    image.src = defaultRapatImageSrc; // Balik ke gambar awal
                }
                
                if (contentText) {
                    contentText.innerHTML = defaultRapatContent; // Balik ke teks awal
                }

            // Tutup semua dropdown kecuali yang ada di Card Rapat
            document.querySelectorAll(".grid-container.show").forEach(container => {
                let parentCard = container.closest(".rapat-card");
                if (!parentCard) {
                    container.classList.remove("show"); 
                }
            });

            // Pastikan dropdown di Card Rapat tetap terbuka
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

        // JavaScript untuk Dropdown Menu
        const profileIcon = document.getElementById('profile-icon');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggle dropdown menu saat foto profil diklik
        profileIcon.addEventListener('click', (event) => {
            event.stopPropagation(); // Mencegah event bubbling
            dropdownMenu.classList.toggle('show');
        });

        // Menyembunyikan dropdown menu jika klik di luar area dropdown
        window.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });

        // Popup Logout
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
