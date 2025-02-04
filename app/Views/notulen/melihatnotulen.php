<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/melihatnotulen.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body class="light-mode">
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <ul>
            <li>
                <a href="dashboard_admin" class="<?php echo (isset($current_page) && $current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                    <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                    Dashboard
                </a>
            </li>
            <li class="notulensi-menu">
            <a href="#" class="<?php echo ($current_page == 'data_pengguna') ? 'active' : 'inactive'; ?>">
                <img src="<?php echo base_url('assets/images/notulensi.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                Notulensi
                </a>
                <div class="popup-menu">
                <a href="daftar-notulensi" class="popup-item">
                    <img src="<?= base_url('assets/images/buat.png') ?>" alt="List Icon" class="sidebar-icon">
                    Daftar Notulensi
                </a>
                <a href="buat-notulensi" class="popup-item">
                    <img src="<?= base_url('assets/images/edit.png') ?>" alt="Create Icon" class="sidebar-icon">
                    Buat Notulensi
                </a>
            </div>
                </li>
                </li>
                <li>
                    <a href="riwayatadmin" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
            </ul>
        </div>
                   
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="theme-toggle">
                    <img src="<?= base_url('assets/images/bulan.png') ?>" alt="Moon" class="theme-icon moon-icon">
                    <img src="<?= base_url('assets/images/sun.png') ?>" alt="Sun" class="theme-icon sun-icon">
                </div>
                <div class="user-info">
                    <!-- User details with profile image and role -->
                    <div class="user-details">
                        <?php
                        // Cek apakah ada gambar profil, jika tidak, tampilkan gambar default
                            $profilePic = $user['profil_foto'] ? base_url('assets/images/profiles/' . $user['profil_foto']) : base_url('assets/images/profiles/delvaut.png');
                        ?>
                        <img src="<?= $profilePic ?>" alt="Profile" class="profile-img">
                        <div class="user-text">
                            <p class="user-name"><?= esc($user['nama']); ?></p>
                            <p class="user-role"><?= esc($user['role']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Area -->
            <div class="content">
                <h1>Daftar Notulensi</h1>

                <div class="filters">
                    <!-- Category Selection -->
                    <div class="category-select-container">
                        <div class="iinput-container">
                            <input type="text" class="category-select" placeholder="Kategori" readonly>
                            <div class="iicon-container">
                                <img src="<?= base_url('assets/images/down.png') ?>" alt="Dropdown Icon">
                            </div>
                        </div>
                    </div>

                    <!-- Search Box -->
                    <div class="search-box">
                        <input type="text" placeholder="Search here...">
                        <button type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <!-- Show Entries Dropdown -->
                    <div class="show-entries">
                        <label for="entries">Show:</label>
                        <select id="entries" name="entries">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <label for="entries">Entries</label>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Topik</th>
                                <th>Bidang</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($notulensi)): ?>
                                <tr>
                                    <td colspan="5">Tidak ada data notulensi tersedia.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($notulensi as $index => $notulen): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($notulen['judul']) ?></td>
                                        <td><?= esc($notulen['Bidang']) ?></td>
                                        <td><?= esc($notulen['tanggal_dibuat']) ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-detail" onclick="viewDetails(this, <?= esc($notulen['notulensi_id']) ?>)">Lihat</button>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="btn-prev">Previous</button>
                    <span class="page-number">1</span>
                    <button class="btn-next">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const moonIcon = document.querySelector('.moon-icon');
    const sunIcon = document.querySelector('.sun-icon');
    const categorySelect = document.querySelector('.category-select');
    const searchInput = document.querySelector('.search-box input');
    const searchButton = document.querySelector('.search-box button');
    const tableRows = document.querySelectorAll('table tbody tr');
    const categories = ['APTIKA', 'IKP', 'Statistik dan Persandian'];
    let itemsPerPage = 5;
    let currentPage = 1; // Initialize current page

    // Notulensi Menu Popup Handling
    const notulensiMenu = document.querySelector('.notulensi-menu');
    if (notulensiMenu) {
        notulensiMenu.addEventListener('mouseenter', function() {
            const popupMenu = this.querySelector('.popup-menu');
            if (popupMenu) {
                popupMenu.style.display = 'block';
            }
        });

        notulensiMenu.addEventListener('mouseleave', function() {
            const popupMenu = this.querySelector('.popup-menu');
            if (popupMenu) {
                popupMenu.style.display = 'none';
            }
        });
    }

    // Reset to light mode on page load
    localStorage.setItem('theme', 'light-mode');
    body.classList.remove('dark-mode');
    body.classList.add('light-mode');
    moonIcon.style.opacity = '1';
    sunIcon.style.opacity = '0';

    // Create category popup
    let categoryPopup = document.createElement('div');
    categoryPopup.className = 'category-popup';
    
    categories.forEach(category => {
        const option = document.createElement('div');
        option.className = 'category-option';
        option.textContent = category;
        option.onclick = function() {
            categorySelect.value = category; // Set the selected category to the select dropdown
            categoryPopup.style.display = 'none'; // Hide the popup after selection
            filterAndDisplayData(); // Filter and display data based on the selected category
        };
        categoryPopup.appendChild(option);
    });
    
    document.body.appendChild(categoryPopup);

    // Category popup toggle
    const categoryIcon = document.querySelector('.iicon-container');
    categoryIcon.addEventListener('click', function(e) {
        const rect = categorySelect.getBoundingClientRect();
        categoryPopup.style.top = `${rect.bottom + window.scrollY}px`;
        categoryPopup.style.left = `${rect.left + window.scrollX}px`;
        categoryPopup.style.minWidth = `${rect.width}px`;
        categoryPopup.style.display = categoryPopup.style.display === 'block' ? 'none' : 'block';
        e.stopPropagation();
    });

    function filterAndDisplayData() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categorySelect.value.toLowerCase().trim();

        const visibleRows = Array.from(tableRows).filter(row => {
            const cells = row.getElementsByTagName('td');
            const topik = cells[1].textContent.toLowerCase().trim();
            const bidang = cells[2].textContent.toLowerCase().trim();

            const searchMatch = topik.includes(searchTerm) || bidang.includes(searchTerm);
            const categoryMatch = selectedCategory === '' || bidang.toLowerCase() === selectedCategory;

            return searchMatch && categoryMatch;
        });

        // Debugging
        console.log('Visible Rows:', visibleRows);
        
        // Update pagination and display logic
        totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        // Reset to first page when filtering

        // Debugging
        console.log('Total Pages:', totalPages);
        console.log('Current Page:', currentPage);

        updateTable(visibleRows);
    }

    // Update table display based on visible rows
    function updateTable(visibleRows) {
        // Hide all rows first
        tableRows.forEach(row => row.style.display = 'none');

        // Show only the visible rows
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        visibleRows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? '' : 'none';
        });

        // Update pagination controls
        pageNumber.textContent = `${currentPage} of ${totalPages}`;
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;
    }

    // View Details Function
    window.viewDetails = function(button, notulensiId) {
        // Arahkan ke halaman detail notulensi
        window.location.href = `<?= base_url('notulensi/feedbacknotulen/') ?>${notulensiId}`;
    };

    // Show Entries dropdown change event
    document.getElementById('entries').addEventListener('change', function() {
        itemsPerPage = parseInt(this.value);
        filterAndDisplayData();
    });

    // Pagination
    let totalPages = Math.ceil(tableRows.length / itemsPerPage);
    
    const prevButton = document.querySelector('.btn-prev');
    const nextButton = document.querySelector('.btn-next');
    const pageNumber = document.querySelector('.page-number');

    // Pagination event listeners
    prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            filterAndDisplayData();
        }
    });

    nextButton.addEventListener('click', function() {
        if (currentPage < totalPages) {
            currentPage++;
            filterAndDisplayData();
        }
    });

    // Theme handling
    const themeToggle = document.querySelector('.theme-toggle');
    themeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        body.classList.toggle('light-mode');
        
        if (body.classList.contains('dark-mode')) {
            moonIcon.style.opacity = '0';
            sunIcon.style.opacity = '1';
            localStorage.setItem('theme', 'dark-mode');
        } else {
            moonIcon.style.opacity = '1';
            sunIcon.style.opacity = '0';
            localStorage.setItem('theme', 'light-mode');
        }
    });

    // Close modal and popups when clicking outside
    window.onclick = function(event) {
        // Close category popup
        if (!categoryPopup.contains(event.target) && !categorySelect.contains(event.target)) {
            categoryPopup.style.display = 'none';
        }
        // Close notulensi popup
        if (notulensiMenu && !notulensiMenu.contains(event.target)) {
            const popupMenu = notulensiMenu.querySelector('.popup-menu');
            if (popupMenu) {
                popupMenu.style.display = 'none';
            }
        }
    };

    // Initial table setup
    filterAndDisplayData();

    // Event listener for search input to trigger the filter
    searchInput.addEventListener('input', function() {
        filterAndDisplayData();
    });

    // Event listener for search button to trigger the filter
    searchButton.addEventListener('click', function() {
        filterAndDisplayData();
    });
});
</script>

</body>
</html>