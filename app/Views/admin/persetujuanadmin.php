<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/persetujuanadmin.css') ?>">
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
                    <a href="dashboard_admin" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
                        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="data-pengguna" class="<?php echo ($current_page == 'data_pengguna') ? 'active data-pengguna' : 'inactive'; ?>">
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
                <li class="dropdown">
                <a href="#" class="active rapat">
                    <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Notulensi Icon" class="sidebar-icon">
                    <span>Rapat</span>
                </a>
                    <div class="dropdown-content">
                        <a href="melihatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Buat Jadwal Rapat</span>
                        </a>
                        
                        <a href="buatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/setuju.png') ?>" alt="Buat Notulensi Icon">
                            <span>Persetujuan Rapat</span>
                        </a>
                    </div>
                </li>
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
        <!-- Main Content -->
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
                <h1>Persetujuan Admin</h1>
                <!-- Content Area -->
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
                                <th>Lokasi</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($jadwal_rapat as $jadwal): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $jadwal['tanggal']; ?></td>
                                    <td><?= $jadwal['Bidang']; ?></td>
                                    <td><?= $jadwal['lokasi']; ?></td>
                                    <td data-meeting-id="<?= $jadwal['id']; ?>"><?= $jadwal['agenda']; ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-approve" onclick="showApprovalModal(this)">
                                                <img src="<?= base_url('assets/images/yes.png') ?>" alt="Approve">
                                            </button>
                                            <button class="btn-reject" onclick="showRejectionModal(this)">
                                                <img src="<?= base_url('assets/images/no.png') ?>" alt="Reject">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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

    <!-- Rejection Modal -->
    <div id="rejectionModal" class="modal">
        <div class="modal-content">
            <h2>Alasan Penolakan</h2>
            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan..."></textarea>
            <button onclick="submitRejection()">Kirim</button>
            <button onclick="closeRejectionModal()">Batal</button>
        </div>
    </div>

    <!-- Rejection Success Modal -->
    <div id="rejectionSuccessModal" class="modal">
        <div class="modal-content confirm-dialog">
            <div class="confirm-icon">
                <img src="<?= base_url('assets/images/Info.png') ?>" alt="" class="popup-image">
            </div>
            <div class="confirm-message">
                <div id="rejectionMessage"></div>
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal" class="modal">
        <div class="modal-content confirm-dialog">
            <div class="confirm-icon">
                <img src="<?= base_url('assets/images/Info.png') ?>" alt="" class="popup-image">
            </div>
            <div class="confirm-message">
                Setujui Rapat Ini?
            </div>
            <div class="confirm-buttons">
                <button onclick="approveMeeting()" class="btn-confirm">Iya</button>
                <button onclick="closeApprovalModal()" class="btn-cancel">Tidak</button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content confirm-dialog">
            <div class="confirm-icon">
                <img src="<?= base_url('assets/images/Info.png') ?>" alt="" class="popup-image">
            </div>
            <div class="confirm-message">
                Rapat Disetujui!!
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

    // Filter and Display Data function
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

    // Modal Functions
    window.showApprovalModal = function(button) {
        currentRow = button.closest('tr');
        document.getElementById('approvalModal').style.display = 'flex';
    };

    window.closeApprovalModal = function() {
        document.getElementById('approvalModal').style.display = 'none';
        currentRow = null;
    };

    window.approveMeeting = function() {
        if (currentRow) {
            const meetingId = currentRow.cells[4].dataset.meetingId;  // Ambil ID rapat dari data atribut
            closeApprovalModal();

            fetch('<?= base_url('admin/persetujuanadmin/approve_meeting') ?>/' + meetingId, {
                method: 'POST',  
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: meetingId }),  
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const successModal = document.getElementById('successModal');
                    successModal.style.display = 'flex';
                    setTimeout(() => {
                        successModal.style.display = 'none';
                    }, 2000);
                } else {
                    alert('Gagal menyetujui rapat.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    };

    window.showRejectionModal = function(button) {
        currentRow = button.closest('tr');
        document.getElementById('rejectionModal').style.display = 'flex';
    };

    window.closeRejectionModal = function() {
        document.getElementById('rejectionModal').style.display = 'none';
        document.getElementById('rejectionReason').value = '';
        currentRow = null;
    };

    window.submitRejection = function() {
        const reason = document.getElementById('rejectionReason').value;
        if (reason.trim() === '') {
            alert('Silakan masukkan alasan penolakan.');
            return;
        }
        
        if (currentRow) {
            const meetingId = currentRow.cells[4].dataset.meetingId;  // Ambil ID rapat dari data atribut
            closeRejectionModal();
            
            // Kirim alasan penolakan ke controller
            fetch('<?= base_url('admin/persetujuanadmin/reject_meeting') ?>/' + meetingId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ reason: reason }),  // Kirim alasan penolakan
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const rejectionMessage = document.getElementById('rejectionMessage');
                    rejectionMessage.textContent = `Rapat "${currentRow.cells[4].textContent}" ditolak dengan alasan: ${reason}`;
                    
                    // Tampilkan modal notifikasi
                    const rejectionSuccessModal = document.getElementById('rejectionSuccessModal');
                    rejectionSuccessModal.style.display = 'flex';
                    window.submitRejection = function() {
    const reason = document.getElementById('rejectionReason').value;
    if (reason.trim() === '') {
        alert('Silakan masukkan alasan penolakan.');
        return;
    }
    
    if (currentRow) {
        const meetingId = currentRow.cells[4].dataset.meetingId;  // Ambil ID rapat dari data atribut
        closeRejectionModal();
        
        // Kirim alasan penolakan ke controller
        fetch(`<?= base_url('admin/persetujuanadmin/reject_meeting/') ?>${meetingId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ alasan: reason }),  // Kirim alasan penolakan
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Rapat berhasil ditolak.');
                // Lakukan tindakan lain jika perlu, seperti memperbarui tampilan
            } else {
                alert('Gagal menolak rapat.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
};
                    // Tutup modal notifikasi setelah beberapa detik
                    setTimeout(() => {
                        rejectionSuccessModal.style.display = 'none';
                    }, 3000); // Modal akan tertutup setelah 3 detik
                } else {
                    alert('Gagal menolak rapat.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    };

    // Update bagian event listener untuk modal
    document.addEventListener('click', (e) => {
        if (!categorySelect.contains(e.target) && 
            !categoryPopup.contains(e.target) && 
            !categoryIcon.contains(e.target)) {
            categoryPopup.style.display = 'none';
        }
        
        if (e.target.classList.contains('modal')) {
            if (e.target.id === 'approvalModal') {
                closeApprovalModal();
            } else if (e.target.id === 'rejectionModal') {
                closeRejectionModal();
            } else if (e.target.id === 'rejectionSuccessModal') {
                e.target.style.display = 'none';
            }
        }
    });
    
    // Event listeners
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
    
    // Global click handler for closing popups
    document.addEventListener('click', (e) => {
        if (!categorySelect.contains(e.target) && 
            !categoryPopup.contains(e.target) && 
            !categoryIcon.contains(e.target)) {
            categoryPopup.style.display = 'none';
        }
        
        if (e.target.classList.contains('modal')) {
            if (e.target.id === 'approvalModal') {
                closeApprovalModal();
            } else if (e.target.id === 'rejectionModal') {
                closeRejectionModal();
            }
        }
    });

    // Profile Dropdown Toggle
profileContainer.addEventListener('click', (e) => {
        e.stopPropagation();
        profileDropdown.classList.toggle('show');
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
        if (logoutModal) {
            logoutModal.style.display = 'block';
            profileDropdown.classList.remove('show');
        }
    }

    window.closeLogoutModal = function() {
        if (logoutModal) {
            logoutModal.style.display = 'none';
        }
    }

    window.confirmLogout = function() {
        window.location.href = "<?= base_url('logout') ?>";
    }
    
    filterAndDisplayData();
});

</script>
</body>
</html>