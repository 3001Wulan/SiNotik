<?php 
$current_page = 'jadwalrapat'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Rapat</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jadwalrapat.css'); ?>">
    <link rel="stylesheet" href="styles/logout-popup.css">
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
                    <a href="dashboard_pegawai" class="<?php echo ($current_page == 'dashboard') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon"> Dashboard
                    </a>
                </li>
                <li>
                    <a href="melihatpegawai" class="<?php echo ($current_page == 'notulensi_notulen') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Notulensi Icon" class="sidebar-icon"> Notulensi
                    </a>
                </li>
                <li>
                    <a href="riwayatadmin" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/icon_riwayat.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon"> Riwayat Notulensi
                    </a>
                </li>
                <li>
                    <a href="#" class="<?php echo ($current_page == 'jadwalrapat') ? 'active' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon"> Jadwal Rapat
                    </a>
                    <li>
                    <a href="#" class="inactive">
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

        <!-- Content Area -->
        <div class="content">
            <div class="top-bar">
                <!-- Dark Mode Button -->
                <div class="toggle-dark-mode">
                    <img id="toggleDarkMode" src="<?php echo base_url('assets/images/moon.png'); ?>" alt="Dark Mode">
                </div>

                <div class="profile" onclick="toggleDropdown()">
                <img src="<?= base_url('assets/images/profiles/' . esc($user['profil_foto'])); ?>" alt="Profil" class="profile-img">
                    <div class="profile-info">
                        <span class="profile-name"><?= esc($user['nama']); ?></span>
                        <span class="profile-role"><?= esc($user['role']); ?></span>
                    </div>
                    <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
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
                <h1>Jadwal Rapat</h1>
                <button class="btn-add" onclick="openPopup()">
                    Buat Rapat
                    <img src="<?php echo base_url('assets/images/plus.png'); ?>" alt="Tambah Icon" class="btn-icon">
                </button>
            </div>

            <!-- Popup for Creating Meeting -->
            <div id="overlay" class="popup-overlay" onclick="closePopup()"></div>
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h2>Buat Rapat</h2>
                    <form id="agendaForm">

                       <label for="agenda">Topik:</label>
                        <input type="text" id="agenda" name="agenda" required>

                        <label for="agenda">Agenda:</label>
                        <input type="text" id="agenda" name="agenda" required>
                        
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" required>
                        
                        <label for="waktu">Waktu:</label>
                        <input type="time" id="waktu" name="waktu" required>
                        
                        <label for="lokasi">Lokasi:</label>
                        <input type="text" id="lokasi" name="lokasi" required>
                        
                        <button type="submit" id="simpan">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- Table for Meeting Schedule -->
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

                <div class="table-wrapper">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Topik</th>
                                <th>Bidang</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jadwal)) : ?>
                            <?php $no = 1; foreach ($jadwal as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($row['agenda']); ?></td>
                                    <td><?= esc($row['Bidang']); ?></td>
                                    <td><?= esc(date('d/m/Y', strtotime($row['tanggal']))); ?></td>
                                    <td>
                            <span class="status <?= strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                <?= esc($row['status']); ?>
                            </span>
                            <?php if (strtolower($row['status']) == 'ditolak') : ?>
                                <img src="<?php echo base_url('assets/images/bulb.png'); ?>" alt="Alasan Ditolak" class="status-icon" onclick="showReason('<?= esc($row['alasan']); ?>')">
                            <?php endif; ?>
                        </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data jadwal</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

                 <!-- Popup Logout -->
                 <div class="logout-overlay" id="logoutOverlay" style="display: none;"></div>
            <div class="logout-popup" id="logoutPopup" style="display: none;">
                <img src="<?= base_url('assets/images/logout_warning.png') ?>" alt="Logout Warning" class="logout-image">
                <h3>Anda ingin logout?</h3>
                <div class="logout-buttons">
                    <button class="btn-yes" id="confirmLogout">Ya</button>
                    <button class="btn-no" id="cancelLogout">Tidak</button>
                </div>
            </div>
        </div>
    </div>
            <!-- Popup for Reason -->
            <div id="reasonOverlay" class="popup-overlay" onclick="closeReasonPopup()"></div>
            <div id="reasonPopup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closeReasonPopup()">&times;</span>
                    <h2>Alasan Ditolak</h2>
                    <p id="reasonText"></p>
                </div>
            </div>

            <script>
                // Function to open the popup for creating a meeting
                function openPopup() {
                    document.getElementById("overlay").style.display = "block";
                    document.getElementById("popup").style.display = "block";
                }

                // Function to close the popup for creating a meeting
                function closePopup() {
                    document.getElementById("overlay").style.display = "none";
                    document.getElementById("popup").style.display = "none";
                }

                // Function to show the reason for rejection
                function showReason(reason) {
                    document.getElementById("reasonText").innerText = reason;
                    document.getElementById("reasonOverlay").style.display = "block";
                    document.getElementById("reasonPopup").style.display = "block";
                }

                // Function to close the reason popup
                function closeReasonPopup() {
                    document.getElementById("reasonOverlay").style.display = "none";
                    document.getElementById("reasonPopup").style.display = "none";
                }

                // Toggle dark mode
                const toggleDarkMode = document.getElementById('toggleDarkMode');
                toggleDarkMode.addEventListener('click', () => {
                    document.body.classList.toggle('dark-mode');
                    toggleDarkMode.src = document.body.classList.contains('dark-mode') 
                        ? '<?php echo base_url('assets/images/sun.png'); ?>' 
                        : '<?php echo base_url('assets/images/moon.png'); ?>';
                });

                // Search function for the table
                function searchTable() {
                    const input = document.getElementById('searchInput');
                    const filter = input.value.toUpperCase();
                    const table = document.getElementById('dataTable');
                    const tr = table.getElementsByTagName('tr');

                    for (let i = 1; i < tr.length; i++) {
                        const td = tr[i].getElementsByTagName('td');
                        let rowContainsSearchTerm = false;

                        for (let j = 0; j < td.length; j++) {
                            if (td[j] && td[j].innerText.toUpperCase().indexOf(filter) > -1) {
                                rowContainsSearchTerm = true;
                            }
                        }

                        tr[i].style.display = rowContainsSearchTerm ? "" : "none";
                    }
                }

                // Toggle dropdown menu
                function toggleDropdown() {
                    const dropdown = document.querySelector(".dropdown-menu");
                    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                }
 // Logout functionality
 document.addEventListener("DOMContentLoaded", function () {
            const logoutLink = document.getElementById("logoutLink");
            const logoutOverlay = document.getElementById("logoutOverlay");
            const logoutPopup = document.getElementById("logoutPopup");
            const cancelLogout = document.getElementById("cancelLogout");
            const confirmLogout = document.getElementById("confirmLogout");

            logoutLink.addEventListener("click", function (e) {
                e.preventDefault();
                logoutOverlay.style.display = "block";
                logoutPopup.style.display = "block";
            });

            function closeLogoutPopup() {
                logoutOverlay.style.display = "none";
                logoutPopup.style.display = "none";
            }

            cancelLogout.addEventListener("click", closeLogoutPopup);
            logoutOverlay.addEventListener("click", closeLogoutPopup);

            confirmLogout.addEventListener("click", function () {
                window.location.href = "<?= base_url('auth/logout') ?>"; 
            });
        });
                // Close dropdown if clicked outside
                document.addEventListener("click", function(event) {
                    const profile = document.querySelector(".profile");
                    if (!profile.contains(event.target)) {
                        document.querySelector(".dropdown-menu").style.display = "none";
                    }
                });

                document.getElementById('agendaForm').addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent form submission

                    const formData = new FormData(this);

                    fetch('<?= site_url('pegawai-jadwal/save') ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Gagal menyimpan data');
                        }
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan');
                        console.error(error);
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>