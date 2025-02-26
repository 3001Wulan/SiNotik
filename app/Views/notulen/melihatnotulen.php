<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/melihatnotulen.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/user-info.css') ?>">
</head>
<body>
    <div class="container">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo">
            </div>
            <ul>
                <li>
                    <a href="dashboard_notulen" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="<?php echo ($current_page == 'melihat_notulen') ? 'active notulensi-pegawai ' : 'active'; ?>">
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
                    <a href="panduannotulen" class="inactive">
                        <img src="<?php echo base_url('assets/images/panduanpengguna.png'); ?>" alt="Panduan Pengguna Icon" class="sidebar-icon">
                        Panduan Pengguna
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="main-content">
            <div class="top-bar">
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?= base_url('assets/images/moon.png') ?>" alt="Toggle Dark Mode" style="cursor: pointer;">
                </div>

                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span><?php echo isset($user['nama']) ? $user['nama'] : 'Nama Tidak Ditemukan'; ?></span>
                        </div>                            
                        <div class="user-role">
                            <span><?php echo isset($user['role']) ? ucfirst($user['role']) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                        <img src="<?= base_url('assets/images/profiles/' . $user['profil_foto']) ?>" alt="Profile" class="profile-img" id="profile-icon">
                    </div>

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

            <div class="page-title">
                <h1>Daftar Notulensi</h1>
            </div>
             
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
                        <input type="text" placeholder="Search here">
                        <button type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <div class="show-entries">
                        <label for="entries">Show</label>
                        <select id="entries" name="entries">
                            <option value="9999">Select</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                             <!-- Opsi baru untuk menampilkan semua data -->
                        </select>
                        <span class="entries-text">entries</span>
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
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="btn-prev" disabled>Previous</button>
                    <span class="page-number">1</span>
                    <button class="btn-next">Next</button>
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
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const categorySelect = document.querySelector('.category-select');
    const searchInput = document.querySelector('.search-box input');
    const searchButton = document.querySelector('.search-box button');
    const tableRows = document.querySelectorAll('table tbody tr');
    const categories = ['APTIKA', 'IKP', 'Statistik & Persandian'];
    let itemsPerPage = 5;
    let currentPage = 1; 
    let totalPages = 0; 

    // Create category popup
    const categoryPopup = createCategoryPopup(categories);
    document.body.appendChild(categoryPopup);

    // Category popup toggle
    const categoryIcon = document.querySelector('.iicon-container');
    categoryIcon.addEventListener('click', function(e) {
        toggleCategoryPopup(categoryPopup, categorySelect, e);
    });

    // Event listeners
    searchInput.addEventListener('input', filterAndDisplayData);
    searchButton.addEventListener('click', filterAndDisplayData);
    document.getElementById('entries').addEventListener('change', handleEntriesChange);
    document.querySelector('.btn-prev').addEventListener('click', handlePrevPage);
    document.querySelector('.btn-next').addEventListener('click', handleNextPage);
    window.onclick = function(event) {
        if (!categoryPopup.contains(event.target) && !categorySelect.contains(event.target)) {
            categoryPopup.style.display = 'none';
        }
    };

    // Profile dropdown
    setupProfileDropdown();

    // Logout confirmation
    setupLogoutConfirmation();

    // Dark mode toggle
    setupDarkModeToggle();

    // Initial data display
    filterAndDisplayData();

    // Function Definitions
    function createCategoryPopup(categories) {
        const popup = document.createElement('div');
        popup.className = 'category-popup';

        categories.forEach(category => {
            const option = document.createElement('div');
            option.className = 'category-option';
            option.textContent = category;
            option.onclick = function() {
                categorySelect.value = category; 
                popup.style.display = 'none'; 
                filterAndDisplayData(); 
            };
            popup.appendChild(option);
        });

        return popup;
    }

    function toggleCategoryPopup(popup, select, event) {
        const rect = select.getBoundingClientRect();
        popup.style.top = `${rect.bottom + window.scrollY}px`;
        popup.style.left = `${rect.left + window.scrollX}px`;
        popup.style.minWidth = `${rect.width}px`;
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation();
    }

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

        totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        updateTable(visibleRows);
    }

    function updateTable(visibleRows) {
        tableRows.forEach(row => row.style.display = 'none');

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        visibleRows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? '' : 'none';
        });

        document.querySelector('.page-number').textContent = `${currentPage} of ${totalPages}`;
        document.querySelector('.btn-prev').disabled = currentPage === 1;
        document.querySelector('.btn-next').disabled = currentPage === totalPages || totalPages === 0;
    }

    function handleEntriesChange() {
        itemsPerPage = parseInt(this.value);
        if (itemsPerPage === 9999) {
            itemsPerPage = tableRows.length; 
        }
        filterAndDisplayData();
    }

    function handlePrevPage() {
        if (currentPage > 1) {
            currentPage--;
            filterAndDisplayData(); 
        }
    }

    function handleNextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            filterAndDisplayData(); 
        }
    }

    function setupProfileDropdown() {
        const profileIcon = document.getElementById('profile-icon');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileIcon.addEventListener('click', (event) => {
            event.stopPropagation(); 
            dropdownMenu.classList.toggle('show');
        });

        window.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });
    }

    function setupLogoutConfirmation() {
        const logoutLink = document.getElementById('logoutLink'); 
        const popupOverlay = document.getElementById('popupOverlay');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        logoutLink.addEventListener('click', (event) => {
            event.preventDefault(); 
            popupOverlay.style.display = 'block'; 
        });

        confirmLogout.addEventListener('click', () => {
            window.location.href = 'login'; 
        });

        cancelLogout.addEventListener('click', () => {
            popupOverlay.style.display = 'none'; 
        });
    }

    function setupDarkModeToggle() {
        const toggleDarkMode = document.getElementById('toggleDarkMode');
        const isDarkMode = localStorage.getItem('darkMode') === 'true';

        if (isDarkMode) {
            document.body.classList.add('dark-mode');
            toggleDarkMode.src = '<?= base_url("assets/images/sun.png") ?>';
        } else {
            toggleDarkMode.src = '<?= base_url("assets/images/moon.png") ?>';
        }

        toggleDarkMode.addEventListener('click', () => {
            const darkModeEnabled = document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', darkModeEnabled);

            toggleDarkMode.src = darkModeEnabled ? 
                '<?= base_url("assets/images/sun.png") ?>' : 
                '<?= base_url("assets/images/moon.png") ?>';
        });
    }

    window.viewDetails = function(button, notulensiId) {
        window.location.href = `<?= base_url('notulen/detailnotulen/') ?>${notulensiId}`;
    };
});
</script>

</body>
</html>