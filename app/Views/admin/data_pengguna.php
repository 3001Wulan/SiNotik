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
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'data_pengguna') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/datapengguna.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
                        Data Pengguna
                    </a>
                </li>
                <li>
                    <a href="riwayatadmin" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/riwayatnotulensi.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
                        Riwayat Notulensi
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="content">
            <div class="top-bar">
                <!-- Mode -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <!-- Profil -->
                <div class="user-info">
                    <div class="user-text">
                        <div class="user-name">
                            <span><?php echo isset($user_profile['nama']) ? $user_profile['nama'] : 'Nama Tidak Ditemukan'; ?></span>
                        </div>
                        <div class="user-role">
                            <span><?php echo isset($user_profile['role']) ? ucfirst($user_profile['role']) : 'Role Tidak Ditemukan'; ?></span>
                        </div>
                    </div>
                    <div>
                        <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                    </div>
                    <!-- Dropdown Menu -->
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

            <!-- Page Tittle -->
            <div class="page-title">
                <h1>Data Pengguna</h1>

                <!-- Tambah Pengguna -->
                <div class="button-container">
                    <a href="<?php echo site_url('admin/tambahpengguna'); ?>" class="btn-add">
                        Tambah Data
                        <img src="<?php echo base_url('assets/images/plus.png'); ?>" alt="Tambah Icon" class="btn-icon">
                    </a>
                </div>
            </div>

            <!-- Tabel Pengguna -->
            <div class="table-container">
                <div class="search-container">
                    <!-- Entries Data -->
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

                    <!-- Search -->
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search here" onkeyup="searchTable()">
                        <img src="<?php echo base_url('assets/images/search.png'); ?>" alt="Search Icon" class="search-icon">
                    </div>
                </div>

                <!-- Data Pengguna -->
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Profil</th>
                            <th>Nama User</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $index => $user): ?>
                                <tr data-user-id="<?= esc($user['user_id']) ?>" class="clickable-row" data-href="<?= site_url('DetailPenggunaControllers/' . esc($user['user_id'])) ?>">
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?php if (!empty($user['profil_foto'])): ?>
                                            <img src="/assets/images/profiles/<?= $user['profil_foto'] ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/images/delvaut.png') ?>" alt="Foto Profil" class="profile-pic">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['nip']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['role']) ?></td>
                                    <td>
                                        <a href="ubahdatapengguna" class="btn-edit">
                                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Icon Edit" class="btn-icon">
                                        </a>
                                        <a href="#" class="btn-delete">
                                            <img src="<?= base_url('assets/images/hapus.png') ?>" alt="Icon Hapus" class="btn-icon">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">Data Pengguna Tidak Tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <button id="previousBtn" onclick="navigatePage('prev')">Previous</button>
                    <span id="pageNumber">1</span>
                    <button id="nextBtn" onclick="navigatePage('next')">Next</button>
                </div>

                <!-- Popup Hapus Data -->
                <div id="deletePopup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <img src="<?= base_url('assets/images/Info.png') ?>" alt="Hapus Data Icon" class="popup-image">
                        <p>Hapus Data Ini?</p>
                        <div class="popup-buttons">
                            <button id="confirmDelete" class="btn-popup btn-yes">Iya</button>
                            <button id="cancelDelete" class="btn-popup btn-no">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        const deletePopup = document.getElementById('deletePopup');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');
        const entriesDropdown = document.getElementById('entries');
        const searchInput = document.getElementById('searchInput');
        const previousBtn = document.getElementById('previousBtn');
        const nextBtn = document.getElementById('nextBtn');
        const pageNumber = document.getElementById('pageNumber');
        const toggleDarkMode = document.getElementById('toggleDarkMode');

        let selectedRow = null;
        let currentPage = 1;
        let entriesPerPage = 10; // Default entries per page
        let allData = Array.from(tableBody.getElementsByTagName('tr')); // Original data in the table
        let filteredData = [...allData]; // Filtered data for search or other actions

        // Function to update the table display
        function updateTable() {
            const startIndex = (currentPage - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;

            if (entriesPerPage === 0) {
                // Show all data when "Select" is chosen (entriesPerPage = 0)
                filteredData.forEach(row => row.style.display = '');
                previousBtn.style.display = 'none';
                nextBtn.style.display = 'none';
                pageNumber.textContent = 1; // Display page number as 1
            } else {
                allData.forEach(row => (row.style.display = 'none')); // Hide all rows first
                filteredData.slice(startIndex, endIndex).forEach(row => (row.style.display = '')); // Show only rows for current page

                // Show or hide navigation buttons
                previousBtn.style.display = currentPage > 1 ? 'inline-block' : 'none';
                nextBtn.style.display = currentPage * entriesPerPage < filteredData.length ? 'inline-block' : 'none';

                // Update the page number
                pageNumber.textContent = currentPage;
            }
        }

        // Function to navigate pages
        function navigatePage(direction) {
            if (direction === 'prev' && currentPage > 1) {
                currentPage--;
            } else if (direction === 'next' && currentPage * entriesPerPage < filteredData.length) {
                currentPage++;
            }
            updateTable();
        }

        // Function to search the table
        function searchTable() {
            const searchTerm = searchInput.value.toLowerCase().trim();

            if (!searchTerm) {
                filteredData = [...allData]; // Show all data if search is empty
            } else {
                filteredData = allData.filter(row => {
                    const cells = row.getElementsByTagName('td');
                    const nameCell = cells[2]; // "Nama User" column is usually at index 2
                    return nameCell && nameCell.textContent.toLowerCase().includes(searchTerm);
                });
            }

            currentPage = 1; // Reset to the first page after search
            updateTable();
        }

        // Function to delete user data
        function deleteUser(userId) {
            fetch('<?php echo site_url('DetailPenggunaController/hapusData'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    selectedRow.remove(); 
                    allData = Array.from(tableBody.getElementsByTagName('tr')); 
                    filteredData = [...allData]; 

                    if (currentPage > 1 && (currentPage - 1) * entriesPerPage >= filteredData.length) {
                        currentPage--;
                    }

                    updateTable();
                } else {
                    alert('Terjadi kesalahan saat menghapus data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.reload();
            });
        }

        // Event listener for row click
        tableBody.addEventListener('click', (event) => {
            const clickedRow = event.target.closest('tr');

            if (!clickedRow) return;

            // Delete button click
            if (event.target.closest('.btn-delete')) {
                event.preventDefault();
                selectedRow = clickedRow;
                deletePopup.style.display = 'flex';
                return;
            }

            // Clicking other rows (navigate to detail page)
            if (!event.target.closest('.btn-edit') && !event.target.closest('.btn-delete')) {
                window.location.href = clickedRow.dataset.href;
            }
        });

        // Cancel delete button
        cancelDelete.addEventListener('click', () => {
            deletePopup.style.display = 'none';
            selectedRow = null;
        });

        // Confirm delete button
        confirmDelete.addEventListener('click', () => {
            if (selectedRow) {
                const userId = selectedRow.dataset.userId;
                deleteUser(userId);
            }
            deletePopup.style.display = 'none';
            selectedRow = null;
        });

        // Change entries per page dropdown
        entriesDropdown.addEventListener('change', (event) => {
            const selectedValue = parseInt(event.target.value, 10);

            // If "Select" is chosen, set entriesPerPage to 0 (show all rows)
            if (selectedValue === 0) {
                entriesPerPage = 0; // Show all data
                filteredData = [...allData]; // All data is visible
            } else if (!isNaN(selectedValue)) {
                entriesPerPage = selectedValue; // Set entries per page
                currentPage = 1; // Reset to the first page
            }

            updateTable();
        });

        // Event listener for search input
        searchInput.addEventListener('input', searchTable);

        // Pagination buttons
        previousBtn.addEventListener('click', () => navigatePage('prev'));
        nextBtn.addEventListener('click', () => navigatePage('next'));

        // Toggle Dark Mode
        const toggleDarkModeButton = document.getElementById('toggleDarkMode');
        const body = document.body;

        toggleDarkModeButton.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            toggleDarkModeButton.src = body.classList.contains('dark-mode')
                ? '<?= base_url("assets/images/sun.png"); ?>'
                : '<?= base_url("assets/images/moon.png"); ?>';
        });

        // Initialize the table on page load
        updateTable();

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
    });
</script>

</body>

</html>
