<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/riwayatadmin.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="light-mode">
    <div class="container">
        <!-- Sidebar -->
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
                <a href="data_pengguna" class="menu-item">
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

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/bulan.png') ?>" alt="Moon" class="theme-icon moon-icon">
                    <img src="<?= base_url('assets/images/sun.png') ?>" alt="Sun" class="theme-icon sun-icon">
                </div>
                <div class="user-info">
                    <img src="<?= base_url('assets/images/profile.jpg') ?>" alt="Profile" class="profile-img">
                </div>
            </div>
           
            <div class="content">
                <h2>Riwayat Notulensi</h2>

                <div class="filters">
                    <!-- Date Range -->
                    <div class="date-range">
                        <div class="iinput-container">
                            <input type="text" class="datepicker1" placeholder="Tanggal Awal">
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/calender.png') ?>" alt="tanggal awal">
                            </div>
                        </div>
                        <div class="iinput-container">
                            <input type="text" class="datepicker" placeholder="Tanggal Akhir">
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/calender.png') ?>" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category -->
                    <div class="category-select-container">
                        <div class="iinput-container">
                            <input type="text" class="category-select" placeholder="Kategori" readonly>
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/down.png') ?>" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>

                    <!-- Show Entries -->
                    <div class="entries-select">
                        <label for="entries">Show</label>
                        <select id="entries">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>entries</span>
                    </div>
                    
                    <!-- Filter Button -->
                    <div class="button-container filter-container">
                        <button class="filter-btn">
                            Filter
                            <div class="icon-containerr">
                                <img src="<?= base_url('assets/images/cari.png') ?>" alt="Dashboard Icon">
                            </div>
                        </button>
                    </div>
                    
                    <!-- PDF Button -->
                    <div class="button-container pdf-container">
                        <button class="pdf-btn">
                            Cetak PDF
                            <div class="icon-container">
                                <img src="<?= base_url('assets/images/pdf.png') ?>" alt="Dashboard Icon">
                            </div>
                        </button>
                    </div>
                    
                    <!-- Search -->
                    <div class="search">
                        <div class="iinput-container">
                            <input type="text" placeholder="Search here..." class="search-input">
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/cari.png') ?>" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Bidang</th>
                            <th>Judul</th>
                            <th>Notulen</th>
                            <th>Isi</th>
                            <th>Dokumentasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table content will be dynamically populated -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data dari controller (pastikan server mengirim data dalam format JSON)
            let notulenData = <?= json_encode($notulensi); ?>;  // Data dari controller
            let currentEntries = 5; // Default entries value
            let filteredData = [...notulenData];

            let deleteId = null;
            
            // Tambahkan HTML untuk modal di dalam body
            const modalHtml = ` 
                <div id="deleteModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <div class="modal-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3 class="modal-title">Hapus Data Ini?</h3>
                        <div class="modal-buttons">
                            <button class="modal-btn confirm-btn" onclick="confirmDelete()">Iya</button>
                            <button class="modal-btn cancel-btn" onclick="closeModal()">Tidak</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            // Fungsi untuk menampilkan modal
            window.showDeleteModal = function(no) {
                deleteId = no;
                const modal = document.getElementById('deleteModal');
                modal.style.display = 'flex';
            };

            // Fungsi untuk menutup modal
            window.closeModal = function() {
                const modal = document.getElementById('deleteModal');
                modal.style.display = 'none';
                deleteId = null;
            };

            // Fungsi untuk mengkonfirmasi penghapusan
            window.confirmDelete = function() {
                if (deleteId !== null) {
                    filteredData = filteredData.filter(item => item.no !== deleteId);
                    updateTable();
                    closeModal();
                }
            };

            // Fungsi untuk mengupdate tabel
            function updateTable() {
                const tbody = document.querySelector('.data-table tbody');
                tbody.innerHTML = ''; // Clear existing rows

                filteredData.forEach((data, index) => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${data.tanggal_dibuat}</td>
                        <td>${data.Bidang}</td>
                        <td>${data.judul}</td>
                        <td>${data.notulen}</td>
                        <td>${data.isi}</td>
                        <td><img src="<?= base_url('assets/images/')?>${data.dokumentasi}" alt="Dokumentasi" class="doc-img"></td>
                        <td>
                            <button class="delete-btn" onclick="showDeleteModal(${data.no})">
                                <img src="<?= base_url('assets/images/hapus.png') ?>" alt="Hapus Icon">
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }

            updateTable(); // Memperbarui tabel setelah data diinisialisasi
        });
    </script>
</body>
</html>
