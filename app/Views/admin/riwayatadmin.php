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
                <a href="#" class="menu-item">
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
            // Sample data for demonstration
            let notulensData = [
                { no: 1, tanggal: '2024-12-06', bidang: 'IKP', judul: 'Rapat xyz', notulen: 'Heni Yunida', isi: 'xxxxx', dokumentasi: '/api/placeholder/50/50' },
                { no: 2, tanggal: '2024-12-12', bidang: 'APTIKA', judul: 'Rapat xyz', notulen: 'Wulandari', isi: 'xxxxx', dokumentasi: '/api/placeholder/50/50' },
                { no: 3, tanggal: '2024-12-21', bidang: 'Statistik & Persandian', judul: 'Rapat xyz', notulen: 'Cindy Arwinda', isi: 'xxxxx', dokumentasi: '/api/placeholder/50/50' },
                { no: 4, tanggal: '2024-12-27', bidang: 'Statistik & Persandian', judul: 'Rapat xyz', notulen: 'Intan Salma', isi: 'xxxxx', dokumentasi: '/api/placeholder/50/50' },
                { no: 5, tanggal: '2025-01-06', bidang: 'APTIKA', judul: 'Rapat xyz', notulen: 'Sistri Mahira', isi: 'xxxxx', dokumentasi: '/api/placeholder/50/50' }
            ];

            let currentEntries = 5; // Default entries value
            let filteredData = [...notulensData];

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
            let deleteId = null;
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
                        notulensData = notulensData.filter(item => item.no !== deleteId);
                        filteredData = filteredData.filter(item => item.no !== deleteId);
                        updateTable();
                        closeModal();
                    }
                };


            function deleteRecord(no) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    // Remove from notulensData
                    notulensData = notulensData.filter(item => item.no !== no);
                    // Update filtered data
                    filteredData = filteredData.filter(item => item.no !== no);
                    // Refresh the table
                    updateTable();
                }
            }

            // Make deleteRecord function globally accessible
            window.deleteRecord = deleteRecord;
            
            // Theme toggle functionality
            const themeToggle = document.querySelector('.theme-toggle');
            const body = document.body;
            
            themeToggle.addEventListener('click', function() {
                body.classList.toggle('light-mode');
                body.classList.toggle('dark-mode');
            });

            // Date picker initialization
            const initDatePicker = (selector, iconContainer) => {
                const picker = flatpickr(selector, {
                    dateFormat: "Y-m-d",
                    locale: "id",
                    allowInput: true,
                    clickOpens: false
                });

                iconContainer.addEventListener('click', () => {
                    picker.open();
                });
            };

            // Initialize date pickers
            const startDateIcon = document.querySelector('.datepicker1').nextElementSibling;
            const endDateIcon = document.querySelector('.datepicker').nextElementSibling;
            initDatePicker(".datepicker1", startDateIcon);
            initDatePicker(".datepicker", endDateIcon);

            // Category functionality
            const categorySelect = document.querySelector('.category-select');
            const categoryIcon = categorySelect.nextElementSibling;
            const categories = ['APTIKA', 'IKP', 'Statistik & Persandian'];
            let categoryPopup = document.createElement('div');
            categoryPopup.className = 'category-popup';
            
            categories.forEach(category => {
                const option = document.createElement('div');
                option.className = 'category-option';
                option.textContent = category;
                option.onclick = function() {
                    categorySelect.value = category;
                    categoryPopup.style.display = 'none';
                };
                categoryPopup.appendChild(option);
            });
            
            document.body.appendChild(categoryPopup);
            
            categoryIcon.addEventListener('click', function(e) {
                const rect = categorySelect.getBoundingClientRect();
                categoryPopup.style.top = `${rect.bottom + window.scrollY}px`;
                categoryPopup.style.left = `${rect.left + window.scrollX}px`;
                categoryPopup.style.minWidth = `${rect.width}px`;
                categoryPopup.style.display = categoryPopup.style.display === 'block' ? 'none' : 'block';
                e.stopPropagation();
            });

            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchIcon = document.querySelector('.search .iicon-container');

            searchIcon.addEventListener('click', function() {
                filterAndDisplayData();
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    filterAndDisplayData();
                }
            });

            // Filter button functionality
            const filterBtn = document.querySelector('.filter-btn');
            filterBtn.addEventListener('click', function() {
                const entriesSelect = document.getElementById('entries');
                currentEntries = parseInt(entriesSelect.value);
                filterAndDisplayData();
            });

            // PDF export functionality
            const pdfBtn = document.querySelector('.pdf-btn');
            pdfBtn.addEventListener('click', function() {
                generatePDF();
            });

            // Function to filter and display data
            function filterAndDisplayData() {
                const startDate = document.querySelector('.datepicker1').value;
                const endDate = document.querySelector('.datepicker').value;
                const category = categorySelect.value.toLowerCase();
                const searchTerm = searchInput.value.toLowerCase().trim();

                filteredData = notulensData.filter(item => {
                    const dateMatch = (!startDate || item.tanggal >= startDate) && 
                                    (!endDate || item.tanggal <= endDate);
                    
                    // Enhanced search functionality
                    const searchMatch = !searchTerm || 
                        Object.values(item).some(val => {
                            const strVal = String(val).toLowerCase();
                            return strVal.includes(searchTerm);
                        });
                    
                    const categoryMatch = !category || 
                        item.bidang.toLowerCase().includes(category);

                    return dateMatch && searchMatch && categoryMatch;
                });

                updateTable();
            }

            // Function to update table
            function updateTable() {
                const tbody = document.querySelector('.data-table tbody');
                tbody.innerHTML = '';

                if (filteredData.length === 0) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td colspan="8" style="text-align: center;">Tidak ada data yang ditampilkan</td>
                    `;
                    tbody.appendChild(row);
                    return;
                }

                filteredData.slice(0, currentEntries).forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.no}</td>
                        <td>${formatDate(item.tanggal)}</td>
                        <td>${item.bidang}</td>
                        <td>${item.judul}</td>
                        <td>${item.notulen}</td>
                        <td>${item.isi}</td>
                        <td><img src="${item.dokumentasi}" alt="dokumentasi" class="doc-image"></td>
                        <td>
                            <div class="delete-btn" onclick="showDeleteModal(${item.no})">
                                <img src="<?= base_url('assets/images/hapus.png') ?>" alt="Delete Icon">
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }

            // Function to format date
            function formatDate(dateStr) {
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            }

            // Function to generate PDF
            function generatePDF() {
                const docDefinition = {
                    content: [
                        { text: 'Riwayat Notulensi', style: 'header' },
                        {
                            table: {
                                headerRows: 1,
                                body: [
                                    ['No', 'Tanggal', 'Judul', 'Notulen', 'Isi'],
                                    ...filteredData.map(item => [
                                        item.no,
                                        formatDate(item.tanggal),
                                        item.judul,
                                        item.notulen,
                                        item.isi
                                    ])
                                ]
                            }
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 18,
                            bold: true,
                            margin: [0, 0, 0, 10]
                        }
                    }
                };

                console.log('Generating PDF with data:', docDefinition);
                alert('PDF generation triggered. Implementation needed with actual PDF library.');
            }

            // Close category popup when clicking outside
            document.addEventListener('click', function(e) {
                if (!categoryPopup.contains(e.target)) {
                    categoryPopup.style.display = 'none';
                }
            });

            // Initial table display with default 5 entries
            updateTable();
        });

        
    </script>
    
</body>
</html>