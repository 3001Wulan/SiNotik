<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notulensi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/melihatpegawai.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        
    </style>
</head>
<body class="light-mode">
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            </div> 
            <div class="menu">
                <a href="#" class="menu-item">
                    <img src="<?= base_url('assets/images/dashboard.png') ?>" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>
                <div class="separator"></div>
                <a href="#" class="menu-item">
                    <img src="<?= base_url('assets/images/notulensi.png') ?>" alt="Data User Icon">
                    <span>Notulensi</span>
                </a>
                <div class="separator"></div>
                <a href="#" class="menu-item">
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
                                <td>IKP</td>
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
                                <td>IKP</td>
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
                                <td>Statistik & Persandian</td>
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
                                <td>Statistik & Persandian</td>
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
    const categorySelect = document.querySelector('.category-select');
    const searchInput = document.querySelector('.search-box input');
    const searchButton = document.querySelector('.search-box button');
    const tableRows = document.querySelectorAll('table tbody tr');
    const categories = ['APTIKA', 'IKP', 'Statistik & Persandian'];
    
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
            categorySelect.value = category;
            categoryPopup.style.display = 'none';
            filterAndDisplayData();
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

    // View Details Function
    window.viewDetails = function(button) {
        const row = button.closest('tr');
        const cells = row.getElementsByTagName('td');
        const data = {
            topik: cells[1].textContent,
            bidang: cells[2].textContent,
            tanggal: cells[3].textContent
        };
        
        // Here you can implement your view details logic
        console.log('Viewing details for:', data);
        // For example, redirect to a detail page:
        // window.location.href = `/notulensi/detail/${id}`;
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

        // Here you can implement the comment submission logic
        const data = {
            topik: currentRow.cells[1].textContent,
            bidang: currentRow.cells[2].textContent,
            tanggal: currentRow.cells[3].textContent,
            comment: commentText
        };
        
        console.log('Submitting comment:', data);
        // Add your AJAX call here to save the comment
        
        closeCommentModal();
    };

    // Search functionality
    searchButton.addEventListener('click', function() {
        filterAndDisplayData();
    });

    // Filter and Display Function
    function filterAndDisplayData() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value.toLowerCase();
        
        tableRows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            const topik = cells[1].textContent.toLowerCase();
            const bidang = cells[2].textContent.toLowerCase();
            
            const searchMatch = topik.includes(searchTerm) || bidang.includes(searchTerm);
            const categoryMatch = !selectedCategory || bidang.toLowerCase().includes(selectedCategory);
            
            row.style.display = searchMatch && categoryMatch ? '' : 'none';
        });

        // Reset to first page when filtering
        currentPage = 1;
        updateTable();
    }

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

    // Pagination
    const itemsPerPage = 5;
    let currentPage = 1;
    let totalPages = Math.ceil(tableRows.length / itemsPerPage);
    
    const prevButton = document.querySelector('.btn-prev');
    const nextButton = document.querySelector('.btn-next');
    const pageNumber = document.querySelector('.page-number');

    function updateTable() {
        const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        
        totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        
        visibleRows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Update pagination controls
        pageNumber.textContent = `${currentPage} of ${totalPages}`;
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;
    }

    // Pagination event listeners
    prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    });

    nextButton.addEventListener('click', function() {
        if (currentPage < totalPages) {
            currentPage++;
            updateTable();
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
    updateTable();
});
    </script>
</body>
</html>