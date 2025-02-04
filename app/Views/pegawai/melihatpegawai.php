<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/melihatpegawai.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/user-info.css') ?>"> <!-- Menyertakan file CSS terpisah -->
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
                    <a href="dashboard_pegawai" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="melihatpegawai" class="<?php echo ($current_page == 'melihat_pegawai') ? 'active notulensi-pegawai' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Notulensi
                    </a>
                </li>
                <li>
                    <a href="riwayatpegawai" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
            </ul>
        </div>

       <!-- Main Content Section -->
       <div class="main-content">
            <div class="top-bar">
                <!-- Dark Mode Toggle -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <!-- User Info Section -->
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

                    <!-- Profile Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="<?= base_url('admin/profiladmin') ?>" class="dropdown-item">
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

           <!-- Page Title -->
           <div class="page-title">
                <h1>Daftar Notulensi</h1>
            </div>
             
            <div class="content">
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
    const categories = ['APTIKA', 'IKP', 'Statistik & Persandian'];
    let itemsPerPage = 5;
    let currentPage = 1; // Initialize current page

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

    // Comment Modal Functions
    let currentRow = null;

    window.showCommentModal = function(button) {
        const modal = document.getElementById('commentModal');
        currentRow = button.closest('tr');
        modal.style.display = 'flex';
        document.getElementById('commentText').focus();
    };

    window.closeCommentModal = function() {
        const modal = document.getElementById('commentModal');
        modal.style.display = 'none';
        document.getElementById('commentText').value = '';
        currentRow = null;
    };

    window.submitComment = function() {
        const commentText = document.getElementById('commentText').value;
        if (commentText.trim() === '') {
            alert('Please enter a comment');
            return;
        }

        // Add your AJAX call here to save the comment
        const data = {
            topik: currentRow.cells[1].textContent,
            bidang: currentRow.cells[2].textContent,
            tanggal: currentRow.cells[3].textContent,
            comment: commentText
        };
        
        console.log('Submitting comment:', data);
        closeCommentModal();
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
            filterAndDisplayData(); // Panggil fungsi untuk memperbarui tampilan
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

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.className === 'comment-modal') {
            closeCommentModal();
        }
        if (!categoryPopup.contains(event.target) && !categorySelect.contains(event.target)) {
            categoryPopup.style.display = 'none';
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