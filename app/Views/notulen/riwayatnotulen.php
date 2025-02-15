<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Notulensi</title>

    <!-- External CSS for the page -->
    <link rel="stylesheet" href="<?= base_url('assets/css/riwayatnotulen.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <div class="logo">
                <!-- Logo Image -->
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <!-- Sidebar Menu Links -->
            <ul>
                <li>
                    <a href="dashboard_notulen" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="<?php echo ($current_page == 'melihat_notulen') ? 'active notulensi-pegawai ' : 'inactive'; ?>">
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
                    <a href="jadwalrapatnotulen" class="inactive">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
                        Jadwal Rapat
                    </a>
                </li>
                <li>
                    <a href="historynotulen" class="inactive">
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

        <!-- Main Content Section -->
        <div class="content">
            <div class="top-bar">
                <!-- Dark Mode Toggle -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>
                
                <!-- User Info Section -->
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span><?php echo isset($pengguna['nama']) ? $pengguna['nama'] : 'Nama Tidak Ditemukan'; ?></span>
                        </div>                            
                        <div class="user-role">
                            <span><?php echo isset($pengguna['role']) ? ucfirst($pengguna['role']) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                        <img src="<?= base_url('assets/images/profiles/' . $pengguna['profil_foto']) ?>" alt="Profile" class="profile-img" id="profile-icon">
                    </div>

                    <!-- Profile Dropdown Menu -->
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
            <div class="logout-popup-overlay" id="logoutPopupOverlay" style="display: none;">
                <div class="logout-popup">
                    <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="logout-popup-image">
                    <h3>Anda ingin logout?</h3>
                    <div class="logout-popup-buttons">
                        <button class="btn-logout-yes" id="confirmLogout">Ya</button>
                        <button class="btn-logout-no" id="cancelLogout">Tidak</button>
                    </div>
                </div>
            </div>
           
            <!-- Page Title -->
            <div class="page-title">
                <h1>Riwayat Notulensi</h1>
            </div>

            <div class="riwayat-container">
                <!-- Filter Section -->
                <div class="filters">
                    <div class="date-range">
                        <div class="iinput-container">
                            <input type="text" class="datepicker1" placeholder="Tanggal Awal">
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/calender.png') ?>" alt="Tanggal Awal">
                            </div>
                        </div>
                        <div class="iinput-container">
                            <input type="text" class="datepicker" placeholder="Tanggal Akhir">
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/calender.png') ?>" alt="Tanggal Akhir">
                            </div>
                        </div>
                    </div>

                    <div class="category-select-container">
                        <div class="iinput-container">
                            <input type="text" class="category-select" placeholder="Kategori" readonly>
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/down.png') ?>" alt="Kategori Icon">
                            </div>
                        </div>
                    </div>

                    <div class="entries-select">
                        <label for="entries">Show</label>
                        <select id="entries">
                            <option value="" selected>Select</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <span>entries</span>
                    </div>

                    <div class="button-container filter-container">
                        <button class="filter-btn">
                            Filter
                            <div class="icon-containerr">
                                <img src="<?= base_url('assets/images/cari.png') ?>" alt="Filter Icon">
                            </div>
                        </button>
                    </div>

                    <div class="button-container pdf-container">
                        <button class="pdf-btn">
                            Cetak PDF
                            <div class="icon-container">
                                <img src="<?= base_url('assets/images/pdf.png') ?>" alt="PDF Icon">
                            </div>
                        </button>
                    </div>

                    <div class="search">
                        <div class="iinput-container">
                            <input type="text" placeholder="Search here..." class="search-input">
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/cari.png') ?>" alt="Search Icon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Bidang</th>
                                <th>Agenda</th>
                                <th>Notulen</th>
                                <th>Partisipan</th>
                                <th>Hasil Pembahasan </th>
                                <th>Dokumentasi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div id="deleteModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <div class="modal-icon">
                            <img src="<?= base_url('assets/images/Info.png') ?>" alt="Info Icon">
                        </div>
                        <h3 class="modal-title">Hapus Data Ini?</h3>
                        <div class="modal-buttons">
                            <button class="modal-btn confirm-btn" onclick="confirmDelete()">Iya</button>
                            <button class="modal-btn cancel-btn" onclick="closeModal()">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let notulenData = <?= json_encode($notulensi); ?>;
        let currentEntries = 5;
        let filteredData = [...notulenData];
        let deleteId = null;

        window.showDeleteModal = function (no) {
            deleteId = no;
            document.getElementById('deleteModal').style.display = 'flex';
        };

        window.closeModal = function () {
            document.getElementById('deleteModal').style.display = 'none';
            deleteId = null;
        };

        window.confirmDelete = function () {
            if (deleteId !== null) {
                fetch(`/RiwayatAdminController/delete/${deleteId}`, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        filteredData = filteredData.filter(item => item.notulensi_id !== deleteId);
                        updateTable();
                        closeModal();
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus data.');
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data.');
                });
            }
        };

        function updateTable() {
            const tbody = document.querySelector('.data-table tbody');
            tbody.innerHTML = '';
            filteredData.slice(0, currentEntries).forEach((data, index) => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${data.tanggal_dibuat}</td>
                    <td>${data.Bidang}</td>
                    <td>${data.judul}</td>
                    <td>${data.user_name}</td>
                    <td>${data.partisipan}</td> 
                    <td>${data.isi}</td>
                    <td>
                        <div style="width: 150px; height: 150px; overflow: hidden; border: 1px solid #ccc;">
                            <img src="<?= base_url('uploads/') ?>${data.foto_dokumentasi}" alt="Dokumentasi" class="doc-img">
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        updateTable();

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

        const startDateIcon = document.querySelector('.datepicker1').nextElementSibling;
        const endDateIcon = document.querySelector('.datepicker').nextElementSibling;
        initDatePicker(".datepicker1", startDateIcon);
        initDatePicker(".datepicker", endDateIcon);

        const categorySelect = document.querySelector('.category-select');
        const categoryIcon = categorySelect.nextElementSibling;
        const categories = ['APTIKA', 'IKP', 'Statistik & Persandian'];
        let categoryPopup = document.createElement('div');
        categoryPopup.className = 'category-popup';

        categories.forEach(category => {
            const option = document.createElement('div');
            option.className = 'category-option';
            option.textContent = category;
            option.onclick = function () {
                categorySelect.value = category;
                categoryPopup.style.display = 'none';
            };
            categoryPopup.appendChild(option);
        });

        document.body.appendChild(categoryPopup);

        categoryIcon.addEventListener('click', function (e) {
            const rect = categorySelect.getBoundingClientRect();
            categoryPopup.style.top = `${rect.bottom + window.scrollY}px`;
            categoryPopup.style.left = `${rect.left + window.scrollX}px`;
            categoryPopup.style.minWidth = `${rect.width}px`;
            categoryPopup.style.display = categoryPopup.style.display === 'block' ? 'none' : 'block';
            e.stopPropagation();
        });

        
        const searchInput = document.querySelector('.search-input');
        const searchIcon = document.querySelector('.search .iicon-container');

        searchIcon.addEventListener('click', function () {
            filterAndDisplayData();
        });

        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                filterAndDisplayData();
            }
        });

        const filterBtn = document.querySelector('.filter-btn');
        filterBtn.addEventListener('click', function () {
            const entriesSelect = document.getElementById('entries');
            currentEntries = parseInt(entriesSelect.value);
            filterAndDisplayData();
        });

        function filterAndDisplayData() {
            const startDate = document.querySelector('.datepicker1').value;
            const endDate = document.querySelector('.datepicker').value;
            const category = categorySelect.value.toLowerCase();
            const searchTerm = searchInput.value.toLowerCase().trim();

            filteredData = notulenData.filter(item => {
                const dateMatch = (!startDate || item.tanggal_dibuat >= startDate) &&
                    (!endDate || item.tanggal_dibuat <= endDate);

                const searchMatch = !searchTerm ||
                    Object.values(item).some(val => {
                        const strVal = String(val).toLowerCase();
                        return strVal.includes(searchTerm);
                    });

                const categoryMatch = !category ||
                    item.Bidang.toLowerCase().includes(category);

                return dateMatch && searchMatch && categoryMatch;
            });

            updateTable();
        }

        const { jsPDF } = window.jspdf;

        const pdfBtn = document.querySelector('.pdf-btn');
        pdfBtn.addEventListener('click', function () {
            const doc = new jsPDF();
            const table = document.querySelector('.data-table');
            const rows = table.querySelectorAll('tr');

            const headers = ['No', 'Tanggal', 'Bidang', 'Judul', 'Notulen', 'Partisipan','Isi', 'Dokumentasi'];
            const tableData = [];
            const imagePromises = [];

            rows.forEach((row, rowIndex) => {
                const cells = row.querySelectorAll('th, td');
                const rowData = Array.from(cells).map(cell => cell.textContent.trim());
                if (rowIndex > 0) { 
                    rowData.pop(); 
                    tableData.push(rowData);

                    const imgCell = row.cells[7]; 
                    const img = imgCell.querySelector('img');
                    if (img) {
                        console.log(`Image found in row ${rowIndex}, processing...`);

                        imagePromises.push(
                            getImageBase64(img)
                                .then(base64Img => {
                                    tableData[rowIndex - 1].push(base64Img); 
                                })
                                .catch(err => {
                                    console.error(`Error processing image in row ${rowIndex}:`, err);
                                    tableData[rowIndex - 1].push(''); 
                                })
                        );
                    } else {
                        console.log(`No image found in row ${rowIndex}`);
                        tableData[rowIndex - 1].push(''); 
                    }
                }
            });

            Promise.all(imagePromises).then(() => {
                console.log("All images processed, generating PDF...");

                doc.autoTable({
                    head: [headers],
                    body: tableData,
                    startY: 20,
                    margin: { top: 10, bottom: 10, left: 10, right: 10 },
                    theme: 'grid',
                    didDrawPage: function () {
                        doc.text('Riwayat Notulensi', 12, 15);
                    },
                    styles: {
                        overflow: 'linebreak',
                        fontSize: 10,
                        cellPadding: 5,
                    },
                    didDrawCell: function (data) {
                        console.log(`Processing row ${data.row.index}, column ${data.column.index}`);
                        if (data.column.index === 7 && data.row.index > 0) {
                            const imageBase64 = tableData[data.row.index][data.column.index + 1];
                            console.log(`Processing image for row ${data.row.index}:`, imageBase64);
                            if (imageBase64) {
                                const imgWidth = 25;
                                const imgHeight = 15;
                                const imgX = data.cell.x + data.cell.width / 2 - imgWidth / 2;
                                const imgY = data.cell.y + (data.cell.height - imgHeight) / 2;
                                console.log(`Menambahkan gambar ke PDF di posisi (${imgX}, ${imgY})`);
                                doc.addImage(imageBase64, 'PNG', data.cell.x + 1, data.cell.y + 1, imgWidth, imgHeight);

                            }else{
                                console.log(`Tidak ada gambar untuk baris ${data.row.index}`);

                            }
                        }
                    },
                });

                doc.save('data-notulen.pdf');
            }).catch(error => {
                console.error('Error processing images before generating PDF:', error);
            });
        });

        const getImageBase64 = (img) => {
            return new Promise((resolve, reject) => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const image = new Image();
                image.crossOrigin = 'anonymous'; 
                image.src = img.src;

                image.onload = () => {
                    canvas.width = image.width;
                    canvas.height = image.height;
                    ctx.drawImage(image, 0, 0);
                    const dataUrl = canvas.toDataURL('image/png');
                    console.log('Image converted to base64 successfully.');
                    resolve(dataUrl);
                };

                image.onerror = (err) => {
                    console.error("Error loading image:", err);
                    reject(err);
                };
            });
        };

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

        toggleDarkModeButton.addEventListener('click', function () {
    body.classList.toggle('dark-mode');
    console.log('Dark mode toggled: ', body.classList.contains('dark-mode'));  // Periksa kelas dark-mode
    toggleDarkModeButton.src = body.classList.contains('dark-mode')
        ? '<?= base_url("assets/images/sun.png"); ?>'
        : '<?= base_url("assets/images/moon.png"); ?>';
});

    });
    const logoutLink = document.getElementById('logoutLink');
    const logoutPopupOverlay = document.getElementById('logoutPopupOverlay'); 
    const confirmLogout = document.getElementById('confirmLogout'); 
    const cancelLogout = document.getElementById('cancelLogout'); 

    logoutLink.addEventListener('click', function (e) {
        e.preventDefault(); 
        logoutPopupOverlay.style.display = 'flex'; 
    });

    confirmLogout.addEventListener('click', function () {
        window.location.href = '<?= base_url("home") ?>'; 
        logoutPopupOverlay.style.display = 'none'; 
    });

    cancelLogout.addEventListener('click', function () {
        logoutPopupOverlay.style.display = 'none'; 
    });
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

</script>
</body>
</html>
