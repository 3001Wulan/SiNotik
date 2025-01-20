<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/melihatnotulen2.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="light-mode">
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div>
            <div class="menu">
                <a href="#" class="menu-item-link">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <div class="dropdown"> <!-- Tambahkan wrapper dropdown -->
                <a href="#" class="menu-item-link">
                    <img src="<?= base_url('assets/images/notulensi.png') ?>" alt="Data User Icon">
                    <span>Notulensi</span>
                </a>
                <div class="dropdown-content">
                    <a href="#" class="dropdown-item">
                        <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                        <span>Daftar Notulensi</span>
                    </a>
                    <div class="dropdown-separator"></div>
                    <a href="#" class="dropdown-item">
                        <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                        <span>Buat Notulensi</span>
                    </a>
                </div>
            </div>
            <div class="separator"></div>
            <a href="#" class="menu-item-link">
                <img src="<?= base_url('assets/images/riwayat.png') ?>" alt="History Icon">
                <span>Riwayat Notulensi</span>
            </a>
        </div>  
        </div>

        <!-- Main Content -->
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

            <!-- Content Area -->
            <div class="content">
                <h1>APTIKA</h1>

                <div class="filters">
                    <!-- Show Entries Selection -->
                    <div class="entries-select-container">
                        <div class="iinput-container">
                            <span>Show</span>
                            <select class="entries-select">
                                <option value="2">2</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span>entries</span>
                        </div>
                    </div>

                     <!-- Search Box -->
                     <div class="search-box">
                        <input type="text" placeholder="Search here...">
                        <button type="button" id="search-button">
                            <i class="fas fa-search"></i>
                        </button>
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
                            <tr>
                                <td>1</td>
                                <td>Pembinaan Tugas</td>
                                <td>APTIKA</td>
                                <td>05/02/2025</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-detail" onclick="viewDetails(this)">Lihat</button>
                                        <button class="btn-comment" onclick="showCommentModal(this)">
                                            <img src="<?= base_url('assets/images/komen.png') ?>" alt="Comment">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Rapat bulanan</td>
                                <td>APTIKA</td>
                                <td>02/02/2025</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-detail" onclick="viewDetails(this)">Lihat</button>
                                        <button class="btn-comment" onclick="showCommentModal(this)">
                                            <img src="<?= base_url('assets/images/komen.png') ?>" alt="Comment">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Rapat rutin</td>
                                <td>APTIKA</td>
                                <td>02/02/2025</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-detail" onclick="viewDetails(this)">Lihat</button>
                                        <button class="btn-comment" onclick="showCommentModal(this)">
                                            <img src="<?= base_url('assets/images/komen.png') ?>" alt="Comment">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Rapat Tahunan</td>
                                <td>APTIKA</td>
                                <td>02/2/2025</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-detail" onclick="viewDetails(this)">Lihat</button>
                                        <button class="btn-comment" onclick="showCommentModal(this)">
                                            <img src="<?= base_url('assets/images/komen.png') ?>" alt="Comment">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Agenda Wajib</td>
                                <td>APTIKA</td>
                                <td>05/02/2025</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-detail" onclick="viewDetails(this)">Lihat</button>
                                        <button class="btn-comment" onclick="showCommentModal(this)">
                                            <img src="<?= base_url('assets/images/komen.png') ?>" alt="Comment">
                                        </button>
                                    </div>
                                </td>
                            </tr>
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

    <!-- Comment Modal -->
    <div id="commentModal" class="comment-modal">
        <div class="comment-modal-content">
            <div class="comment-header">
                <h2>Add Comment</h2>
                <button class="close-comment" onclick="closeCommentModal()">&times;</button>
            </div>
            <div class="comment-form">
                <textarea id="commentText" placeholder="Enter your comment..."></textarea>
                <button onclick="submitComment()">Submit</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize variables
        const body = document.body;
        const moonIcon = document.querySelector('.moon-icon');
        const sunIcon = document.querySelector('.sun-icon');
        const searchInput = document.querySelector('.search-box input');
        const searchButton = document.querySelector('#search-button');
        const tableRows = document.querySelectorAll('table tbody tr');
        const entriesSelect = document.querySelector('.entries-select');

        let itemsPerPage = parseInt(entriesSelect.value);
        let currentPage = 1;
        let filteredRows = Array.from(tableRows);

        // Search functionality
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase();

            // Filter rows based on search term
            filteredRows = Array.from(tableRows).filter(row => {
                const cells = row.getElementsByTagName('td');
                const topik = cells[1].textContent.toLowerCase();
                const bidang = cells[2].textContent.toLowerCase();
                return topik.includes(searchTerm) || bidang.includes(searchTerm);
            });

            currentPage = 1; // Reset to first page when searching
            updateTable();
        }

        // Add event listener for search button
        searchButton.addEventListener('click', performSearch);

        // Entries select handler
        entriesSelect.addEventListener('change', function() {
            itemsPerPage = parseInt(this.value);
            currentPage = 1; // Reset to first page
            updateTable();
        });

        function updateTable() {
            // Hide all rows first
            tableRows.forEach(row => row.style.display = 'none');

            // Calculate pagination
            const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            // Show only the rows for current page
            filteredRows.slice(start, end).forEach(row => {
                row.style.display = '';
            });

            // Update pagination controls
            const pageNumber = document.querySelector('.page-number');
            const prevButton = document.querySelector('.btn-prev');
            const nextButton = document.querySelector('.btn-next');

            pageNumber.textContent = `${currentPage} of ${totalPages || 1}`;
            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages || totalPages === 0;
        }

        // Pagination event listeners
        document.querySelector('.btn-prev').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        });

        document.querySelector('.btn-next').addEventListener('click', function() {
            const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                updateTable();
            }
        });

        // Initial table setup
        updateTable();

        // Theme toggle functionality
        function toggleTheme() {
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');
            moonIcon.style.display = body.classList.contains('dark-mode') ? 'none' : 'block';
            sunIcon.style.display = body.classList.contains('dark-mode') ? 'block' : 'none';
        }

        moonIcon.addEventListener('click', toggleTheme);
        sunIcon.addEventListener('click', toggleTheme);
    });

    // Comment modal functionality
    function showCommentModal(button) {
        document.getElementById('commentModal').style.display = 'flex';
    }

    function closeCommentModal() {
        document.getElementById('commentModal').style.display = 'none';
    }

    function submitComment() {
        const commentText = document.getElementById('commentText').value;
        alert(`Comment submitted: ${commentText}`);
        closeCommentModal();
    }
    </script>
</body>
</html>
 