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
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <div class="user-info">
                    <span class="user-name"><?php echo isset($user_profile['nama']) ? $user_profile['nama'] : 'Nama Tidak Ditemukan'; ?></span>
                    <span class="user-role"><?php echo isset($user_profile['role']) ? ucfirst($user_profile['role']) : 'Role Tidak Ditemukan'; ?></span>
                    <img src="<?= base_url('assets/images/profiles/' . $user_profile['profil_foto']) ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                </div>
            </div>

            <div class="page-title">
                <h1>Data Pengguna</h1>
                <div class="button-container">
                    <button class="btn-add">
                        Tambah Data
                        <img src="<?php echo base_url('assets/images/plus.png'); ?>" alt="Tambah Icon" class="btn-icon">
                    </button>
                </div>
            </div>

            <div class="table-container">
                <div class="search-container">
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

                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search here" onkeyup="searchTable()">
                        <img src="<?php echo base_url('assets/images/search.png'); ?>" alt="Search Icon" class="search-icon">
                    </div>
                </div>

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
                                <tr data-user-id="<?= esc($user['user_id']) ?>">
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?php if (!empty($user['profil_foto'])): ?>
                                            <img src="/assets/images/profiles/<?= $user['profil_foto'] ?>" alt="User Photo" class="header-profile-img" id="profile-icon">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/images/default.png') ?>" alt="Foto Profil" class="profile-pic">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['nip']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['role']) ?></td>
                                    <td>
                                        <a href="#" class="btn-edit">
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

                <div class="pagination">
                    <button id="previousBtn" onclick="navigatePage('prev')">Previous</button>
                    <span id="pageNumber">1</span>
                    <button id="nextBtn" onclick="navigatePage('next')">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tableBody = document.querySelector('#dataTable tbody');
            const entriesDropdown = document.getElementById('entries');
            const previousBtn = document.getElementById('previousBtn');
            const nextBtn = document.getElementById('nextBtn');
            const pageNumber = document.getElementById('pageNumber');
            let currentPage = 1;
            let entriesPerPage = 10;

            let rows = Array.from(tableBody.querySelectorAll('tr'));
            
            const updateTable = () => {
                const start = (currentPage - 1) * entriesPerPage;
                const end = start + entriesPerPage;
                rows.forEach((row, index) => row.style.display = (index >= start && index < end) ? '' : 'none');

                const totalPages = Math.ceil(rows.length / entriesPerPage);
                previousBtn.style.display = currentPage > 1 ? '' : 'none';
                nextBtn.style.display = currentPage < totalPages ? '' : 'none';
                pageNumber.textContent = currentPage;
            };

            entriesDropdown.addEventListener('change', () => {
                entriesPerPage = parseInt(entriesDropdown.value) || 10;
                currentPage = 1;
                updateTable();
            });

            nextBtn.addEventListener('click', () => {
                currentPage++;
                updateTable();
            });

            previousBtn.addEventListener('click', () => {
                currentPage--;
                updateTable();
            });

            updateTable();
        });
    </script>
</body>

</html>
