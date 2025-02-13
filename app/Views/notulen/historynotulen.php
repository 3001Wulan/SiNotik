<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/historynotulen.css') ?>">
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
                <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/datapengguna.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
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
                <a href="#" class="inactive">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
                <li class="dropdown">
                <a href="#" class="inactive">
                    <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                    <span>Jadwal Rapat</span>
                </a>
                </li>
                <li>
                    <a href="#" class="active distribusi-notulensi">
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
                            <div class="header">
                    <div class="theme-toggle">
                        <img src="<?= base_url('assets/images/bulan.png') ?>" alt="Moon" class="theme-icon moon-icon">
                        <img src="<?= base_url('assets/images/sun.png') ?>" alt="Sun" class="theme-icon sun-icon">
                    </div>
                    <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">Heni Yunida</div>
                        <div class="user-role">Admin</div>
                    </div>
                    <div class="profile-container">
                        <img src="<?= base_url('assets/images/profile.jpg') ?>" alt="Profile" class="profile-img">
                        <div class="profile-dropdown">
                            <a href="#" class="dropdown-item">
                            <img src="<?= base_url('assets/images/User.png') ?>" alt="Profil" class="dropdown-icon">
                                Profil
                            </a>
                            <div class="dropdown-separator"></div>
                            <a href="#" class="dropdown-item">
                            <img src="<?= base_url('assets/images/icon_logout.png') ?>" alt="Logout" class="dropdown-icon">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content1">
    <h1>Distribusi Notulensi</h1>
    <div class="content">
        <div class="filters">
            <div class="category-select-container">
                <div class="iinput-container">
                    <input type="text" class="category-select" placeholder="Kategori" readonly>
                    <div class="iicon-container">
                        <img src="<?= base_url('assets/images/down.png') ?>" alt="Dropdown Icon">
                    </div>
                </div>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search here...">
                <button type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="show-entries">
                <label for="entries">Show:</label>
                <select id="entries" name="entries">
                    <option value="2">2</option>
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
                        <th>Tanggal</th>
                        <th>Bidang</th>
                        <th>Topik</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
    <?php if (!empty($history_emails)): ?>
        <?php foreach ($history_emails as $index => $email): ?>
            <tr>
                <td><?= esc($index + 1) ?></td> <!-- No urut utama -->
                <td><?= esc($email['tanggal_dibuat']) ?></td> <!-- Tanggal dari tabel notulensi -->
                <td><?= esc($email['Bidang']) ?></td> <!-- Bidang dari tabel notulensi -->
                <td><?= esc($email['judul']) ?></td> <!-- Topik dari tabel notulensi -->

                <?php
    // Pastikan email berbentuk string biasa, hilangkan tanda [] dan ""
    $emailRaw = trim($email['email'], "[]"); // Hilangkan tanda []
    $emailRaw = str_replace('"', '', $emailRaw); // Hilangkan tanda kutip "
    
    $emails = explode(',', $emailRaw); // Pecah menjadi array

    $email_list = [];
    $name_list = [];

    foreach ($emails as $email_index => $single_email) {
        $single_email = trim($single_email);
        $name_part = explode('@', $single_email)[0];
        $name_part = preg_replace('/[0-9]+/', '', $name_part);
        $name_part = ucwords(str_replace(['.', '_'], ' ', $name_part));
        
        $name_list[] = (count($emails) > 1 ? ($email_index + 1) . '. ' : '') . $name_part;
        $email_list[] = (count($emails) > 1 ? ($email_index + 1) . '. ' : '') . $single_email;
    }
?>

<td><?= nl2br(esc(implode("\n", $name_list))) ?></td> <!-- Kolom Nama -->
<td><?= nl2br(esc(implode("\n", $email_list))) ?></td> <!-- Kolom Email -->

            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">Tidak ada data tersedia</td>
        </tr>
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

<div id="logoutModal" class="modal">
    <div class="modal-content">
    <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="popup-image">
        <h2>Anda ingin logout?</h2>
        <div class="modal-buttons">
            <button onclick="confirmLogout()" class="btn-confirm">Ya</button>
            <button onclick="closeLogoutModal()" class="btn-cancel">Tidak</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cache DOM elements
    const body = document.body;
    const moonIcon = document.querySelector('.moon-icon');
    const sunIcon = document.querySelector('.sun-icon');
    const categorySelect = document.querySelector('.category-select');
    const categoryIcon = document.querySelector('.iicon-container');
    const searchInput = document.querySelector('.search-box input');
    const entriesSelect = document.getElementById('entries');
    const tableBody = document.querySelector('table tbody');
    const tableRows = Array.from(tableBody.querySelectorAll('tr'));
    const prevButton = document.querySelector('.btn-prev');
    const nextButton = document.querySelector('.btn-next');
    const pageNumber = document.querySelector('.page-number');
    const profileContainer = document.querySelector('.profile-container');
    const profileDropdown = document.querySelector('.profile-dropdown');
    const logoutModal = document.getElementById('logoutModal');
    const logoutLink = document.querySelector('.dropdown-item img[alt="Logout"]').closest('.dropdown-item');

    // State variables
    let currentPage = 1;
    let itemsPerPage = parseInt(entriesSelect.value);
    let filteredRows = [...tableRows];
    let currentRow = null;
    
    // Profile dropdown toggle
    profileContainer.addEventListener('click', (e) => {
        e.stopPropagation();
        profileDropdown.classList.toggle('show');
    });

    // Close profile dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!profileContainer.contains(e.target)) {
            profileDropdown.classList.remove('show');
        }
    });
    
    // Category setup
    const categories = ['APTIKA', 'IKP', 'Statistik & Persandian'];
    const categoryPopup = document.createElement('div');
    categoryPopup.className = 'category-popup';
    
    categories.forEach(category => {
        const option = document.createElement('div');
        option.className = 'category-option';
        option.textContent = category;
        option.onclick = function(e) {
            e.stopPropagation();
            categorySelect.value = category;
            categoryPopup.style.display = 'none';
            filterAndDisplayData();
        };
        categoryPopup.appendChild(option);
    });

    document.body.appendChild(categoryPopup);
    
    // Category select click handler
    categorySelect.addEventListener('click', function(e) {
        e.stopPropagation();
        const rect = this.getBoundingClientRect();
        categoryPopup.style.top = `${rect.bottom}px`;
        categoryPopup.style.left = `${rect.left}px`;
        categoryPopup.style.width = `${rect.width}px`;
        categoryPopup.style.display = categoryPopup.style.display === 'block' ? 'none' : 'block';
    });

    // Filter and display data function
    function filterAndDisplayData() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categorySelect.value.toLowerCase().trim();

        filteredRows = tableRows.filter(row => {
            if (row.cells.length < 3) return false;
            
            const bidang = row.cells[2].textContent.toLowerCase().trim();
            const rowText = Array.from(row.cells)
                .map(cell => cell.textContent.toLowerCase().trim())
                .join(' ');
            
            const categoryMatch = !selectedCategory || bidang === selectedCategory;
            const searchMatch = !searchTerm || rowText.includes(searchTerm);
            
            return categoryMatch && searchMatch;
        });
        
        currentPage = 1;
        updatePagination();
        displayCurrentPage();
    }
    
    // Pagination functions
    function updatePagination() {
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage) || 1;
        currentPage = Math.min(currentPage, totalPages);
        
        pageNumber.textContent = `${currentPage} of ${totalPages}`;
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage >= totalPages;
    }
    
    function displayCurrentPage() {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        
        tableRows.forEach(row => row.style.display = 'none');
        
        filteredRows.slice(start, end).forEach((row, index) => {
            row.style.display = '';
            row.cells[0].textContent = start + index + 1;
        });
    }

    // Event listeners for search and pagination
    searchInput.addEventListener('input', filterAndDisplayData);
    
    entriesSelect.addEventListener('change', () => {
        itemsPerPage = parseInt(entriesSelect.value);
        currentPage = 1;
        filterAndDisplayData();
    });
    
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayCurrentPage();
            updatePagination();
        }
    });
    
    nextButton.addEventListener('click', () => {
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayCurrentPage();
            updatePagination();
        }
    });

    // Submenu handlers
    const menuWithSubmenu = document.querySelector('.menu-item-with-submenu');
    const submenuPopup = document.querySelector('.submenu-popup');

    if (menuWithSubmenu && submenuPopup) {
        menuWithSubmenu.addEventListener('mouseenter', function() {
            submenuPopup.style.display = 'block';
        });

        menuWithSubmenu.addEventListener('mouseleave', function() {
            submenuPopup.style.display = 'none';
        });
    }

    // Theme toggle
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
    
    // Logout functionality
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            showLogoutModal();
        });
    }

    // Modal functions
    window.showLogoutModal = function() {
        logoutModal.style.display = 'block';
        profileDropdown.classList.remove('show');
    }

    window.closeLogoutModal = function() {
        logoutModal.style.display = 'none';
    }

    window.confirmLogout = function() {
        window.location.href = "<?= base_url('logout') ?>";
    }

    // Global click handler for closing popups
    document.addEventListener('click', (e) => {
        if (!categorySelect.contains(e.target) && 
            !categoryPopup.contains(e.target) && 
            !categoryIcon.contains(e.target)) {
            categoryPopup.style.display = 'none';
        }
        
        if (e.target === logoutModal) {
            closeLogoutModal();
        }
    });
    
    // Initial display
    filterAndDisplayData();
});
</script>
</body>
</html>