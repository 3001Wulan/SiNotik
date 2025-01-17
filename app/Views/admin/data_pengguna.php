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
                    <a href="riwayatadmin" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
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
                    <a href="<?php echo site_url('admin/tambahpengguna'); ?>" class="btn-add">
                        Tambah Data
                        <img src="<?php echo base_url('assets/images/plus.png'); ?>" alt="Tambah Icon" class="btn-icon">
                    </a>
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
                                            <img src="<?= base_url('assets/images/delvaut.png') ?>" alt="Foto Profil" class="profile-pic">
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

            let selectedRow = null;
            let currentPage = 1;
            let entriesPerPage = 10;
            let filteredData = Array.from(tableBody.getElementsByTagName('tr'));

            // Fungsi untuk memperbarui tabel
            function updateTable() {
                const startIndex = (currentPage - 1) * entriesPerPage;
                const endIndex = startIndex + entriesPerPage;

                filteredData.forEach((row, index) => {
                    row.style.display = index >= startIndex && index < endIndex ? '' : 'none';
                });

                document.getElementById('previousBtn').style.display = currentPage > 1 ? 'inline-block' : 'none';
                document.getElementById('nextBtn').style.display = currentPage * entriesPerPage < filteredData.length ? 'inline-block' : 'none';
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

            // Event perubahan pada dropdown entries
            entriesDropdown.addEventListener('change', (event) => {
                const selectedValue = parseInt(event.target.value, 10);
                if (!isNaN(selectedValue)) {
                    entriesPerPage = selectedValue;
                    currentPage = 1; // Reset ke halaman pertama
                    updateTable();
                }
            });

            // Event klik tombol hapus
            tableBody.addEventListener('click', (event) => {
                if (event.target.closest('.btn-delete')) {
                    event.preventDefault();
                    selectedRow = event.target.closest('tr');
                    deletePopup.style.display = 'flex';
                }
            });

            // Tombol batal hapus
            cancelDelete.addEventListener('click', () => {
                deletePopup.style.display = 'none';
                selectedRow = null;
            });

            // Tombol konfirmasi hapus
            confirmDelete.addEventListener('click', () => {
                if (selectedRow) {
                    const userId = selectedRow.dataset.userId; // Ambil ID pengguna
                    deleteUser(userId); // Kirim permintaan ke backend untuk menghapus data
                }
                deletePopup.style.display = 'none';
                selectedRow = null;
            });

            // Fungsi untuk menghapus data melalui AJAX
            function deleteUser(userId) {
                fetch('<?php echo site_url('DetailPenggunaController/hapusData'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user_id: userId }) // Kirim ID pengguna untuk dihapus
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        selectedRow.remove(); // Hapus baris dari tabel
                        filteredData = Array.from(tableBody.getElementsByTagName('tr')); // Perbarui data
                        updateTable();
                    } else {
                        alert('Terjadi kesalahan saat menghapus data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                });
            }

            // Inisialisasi tabel saat halaman dimuat
            updateTable();

            // Event klik untuk toggle dark mode
            const toggleDarkMode = document.getElementById('toggleDarkMode');
            toggleDarkMode.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                toggleDarkMode.src = document.body.classList.contains('dark-mode') ? 
                    '<?php echo base_url('assets/images/sun.png'); ?>' : 
                    '<?php echo base_url('assets/images/moon.png'); ?>';
            });
        });
    </script>
</body>

</html>
