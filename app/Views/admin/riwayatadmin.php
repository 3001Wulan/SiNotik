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
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

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
                    <td>
                        <button class="delete-btn" onclick="showDeleteModal(${data.notulensi_id})">
                            <img src="<?= base_url('assets/images/hapus.png') ?>" alt="Hapus Icon">
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        updateTable();

        const themeToggle = document.querySelector('.theme-toggle');
            const body = document.body;
            
            themeToggle.addEventListener('click', function() {
                body.classList.toggle('light-mode');
                body.classList.toggle('dark-mode');
            });

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
    });
</script>
</body>
</html>
