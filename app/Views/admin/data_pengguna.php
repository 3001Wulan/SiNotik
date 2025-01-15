<?php
$current_page = 'data_pengguna'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datapengguna.css'); ?>">
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
                    <a href="dashboard_admin" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
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

            <!-- Page Title -->
            <div class="page-title">
                <h1>Data Pengguna</h1>
                <div class="button-container">
                    <button class="btn-add">
                        Tambah Data
                        <img src="<?php echo base_url('assets/images/plus.png'); ?>" alt="Tambah Icon" class="btn-icon">
                    </button>
                </div>
            </div>

            <!-- Table with User Data -->
            <div class="table-container">
                 <div class="search-container">
                    <!-- Show Entries -->
                    <div class="show-entries">
                        <label for="entries" class="show-label">Show</label>
                        <select id="entries" name="entries">
                            <option value="">Select</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <span class="entries-text">entries</span>
                    </div>
                    
                    <!-- Pencarian -->
                    <div class="search-box">
                        <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Search here" 
                        onkeyup="searchTable()"
                        >
                        <img src="<?php echo base_url('assets/images/search.png'); ?>" alt="Search Icon" class="search-icon">
                    </div>
                </div>

                <!-- Tabel Data Pengguna -->
                 <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Bidang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data pengguna diisi dari database -->
                    </tbody>
                </table>
                
                <!-- Pagination -->
                 <div class="pagination">
                    <button id="previousBtn" onclick="goToPreviousPage()">Previous</button>
                    <span id="pageNumber" class="page-number">1</span> <!-- Nomor Halaman -->
                    <button id="nextBtn" onclick="goToNextPage()">Next</button>
                </div>
            </div>
        </div>
    </div>

    <div id="deletePopup" class="popup" style="display: none;">
        <div class="popup-content">
            <img src="<?php echo base_url('assets/images/Info.png'); ?>" alt="Hapus Data Icon" class="popup-image">
            <p>Hapus Data Ini?</p>
        
            <div class="popup-buttons">
                <button id="confirmDelete" class="btn-popup btn-yes">Iya</button>
                <button id="cancelDelete" class="btn-popup btn-no">Tidak</button>
            </div>
        </div>
    </div>

    <script>
        // Data dummy untuk ilustrasi
        let totalData = [
            {photo: 'path/to/photo1.jpg', name: 'John Doe', nip: '12345', email: 'john@example.com', status: 'Active', department: 'IT'},
            {photo: 'path/to/photo2.jpg', name: 'Jane Smith', nip: '67890', email: 'jane@example.com', status: 'Inactive', department: 'HR'},
            {photo: 'path/to/photo3.jpg', name: 'Samuel Peterson', nip: '11223', email: 'samuel@example.com', status: 'Active', department: 'Finance'},
            {photo: 'path/to/photo4.jpg', name: 'Alice Johnson', nip: '44556', email: 'alice@example.com', status: 'Active', department: 'Marketing'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            {photo: 'path/to/photo5.jpg', name: 'Bob Brown', nip: '77889', email: 'bob@example.com', status: 'Inactive', department: 'Sales'},
            
        ];

        let filteredData = totalData; // Data yang difilter berdasarkan pencarian
        let currentPage = 1;
        let entriesPerPage = 10;

        // Update Table
        function updateTable() {
            const tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = ''; // Bersihkan tabel sebelumnya

            const startIndex = (currentPage - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;
            const dataToShow = filteredData.slice(startIndex, endIndex);

            dataToShow.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${startIndex + index + 1}</td>
                    <td><img src="${item.photo}" alt="Foto Profil" class="profile-pic"></td>
                    <td>${item.name}</td>
                    <td>${item.nip}</td>
                    <td>${item.email}</td>
                    <td>${item.status}</td>
                    <td>${item.department}</td>
                    <td>
                        <a href="#" class="btn-edit">
                        <img src="<?php echo base_url('assets/images/edit.png'); ?>" alt="Icon Edit" class="btn-icon">
                        </a>
                        
                        <a href="#" class="btn-delete">
                        <img src="<?php echo base_url('assets/images/hapus.png'); ?>" alt="Icon Hapus" class="btn-icon">
                        </a>
                    </td>`;
                tableBody.appendChild(row);
            });

            // Menampilkan atau menyembunyikan tombol Previous dan Next
            document.getElementById('previousBtn').style.display = currentPage > 1 ? 'inline-block' : 'none';
            document.getElementById('nextBtn').style.display = currentPage * entriesPerPage < filteredData.length ? 'inline-block' : 'none';

            // Update nomor halaman hanya angka
            document.getElementById('pageNumber').textContent = currentPage;
        }

        // Fungsi navigasi halaman
        function navigatePage(direction) {
            if (direction === 'prev' && currentPage > 1) {
                currentPage--;
            } else if (direction === 'next' && currentPage * entriesPerPage < filteredData.length) {
                currentPage++;
            }
            updateTable();
        }

        // Fungsi untuk menangani klik tombol Previous
        document.getElementById('previousBtn').onclick = function() {
            navigatePage('prev');
        };

        // Fungsi untuk menangani klik tombol Next
        document.getElementById('nextBtn').onclick = function() {
            navigatePage('next');
        };

        // Fungsi pencarian
        function searchTable() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            filteredData = totalData.filter(item => {
                return item.name.toLowerCase().includes(input) || item.email.toLowerCase().includes(input);
            });
            currentPage = 1; // Reset ke halaman pertama setelah pencarian
            updateTable();
        }

        // Fungsi untuk mengubah jumlah entri per halaman
        document.getElementById('entries').addEventListener('change', function () {
            entriesPerPage = parseInt(this.value);
            currentPage = 1; // Reset ke halaman pertama
            updateTable();
        });

        // Inisialisasi tabel
        window.onload = function() {
            updateTable();
        };

        // Ambil elemen tombol mode gelap
        const toggleDarkModeButton = document.getElementById('toggleDarkMode');
        const body = document.body;

        // Fungsi untuk toggle mode gelap
        toggleDarkModeButton.addEventListener('click', function() {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                toggleDarkModeButton.src = '<?php echo base_url("assets/images/sun.png"); ?>';  // Ganti dengan ikon matahari
            } else {
                toggleDarkModeButton.src = '<?php echo base_url("assets/images/moon.png"); ?>';  // Ganti dengan ikon bulan
            }
        });

        //Popup Hapus Data
        document.addEventListener('DOMContentLoaded', () => {
            const tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
            const deletePopup = document.getElementById('deletePopup');
            const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');

        let selectedRow = null;

        // Delegasikan event ke elemen tbody
        tableBody.addEventListener('click', (event) => {
            if (event.target.closest('.btn-delete')) {
                event.preventDefault();
                selectedRow = event.target.closest('tr'); // Simpan row yang akan dihapus
                deletePopup.style.display = 'flex'; // Tampilkan popup
            }
        });

        cancelDelete.addEventListener('click', () => {
            deletePopup.style.display = 'none'; // Sembunyikan popup
            selectedRow = null; // Reset row yang dipilih
        });

        confirmDelete.addEventListener('click', () => {
            if (selectedRow) {
                selectedRow.remove(); // Hapus row dari tabel
            }
            deletePopup.style.display = 'none'; // Sembunyikan popup
            selectedRow = null; // Reset row yang dipilih
        });
    });
    </script>
</body>
</html>
