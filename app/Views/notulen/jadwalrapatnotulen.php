<?php
$current_page = 'jadwalrapatnotulen'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Rapat Notulen</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jadwalrapatnotulensi.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/popup-logout.css') ?>">
    <script src="<?= base_url('assets/js/popup-logout.js') ?>"></script>

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
    <a href="#" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
        <img src="<?php echo base_url('assets/images/dashboard.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
        Dashboard
    </a>
</li>
<li>
    <a href="#" class="<?php echo ($current_page == 'notulensi_notulen') ? 'active data-pengguna' : 'inactive'; ?>">
        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
        Notulensi
          </a>
           </a>
                    <div class="dropdown-content">
                        <a href="melihatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/buat.png') ?>" alt="Daftar Notulensi Icon">
                            <span>Daftar Notulensi</span>
                        </a>
                        <div class="dropdown-separator"></div>
                        <a href="buatnotulen" class="dropdown-item">
                            <img src="<?= base_url('assets/images/edit.png') ?>" alt="Buat Notulensi Icon">
                            <span>Buat Notulensi</span>
                        </a>
                    </div>
                <li>
            </li>
<li>
    <a href="#" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
        <img src="<?php echo base_url('assets/images/icon_riwayat.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
        Riwayat Notulensi
    </a>
</li>
<li>
<a href="#" class="<?php echo ($current_page == 'jadwal_rapat') ? 'active' : ''; ?>">
    <img src="<?php echo base_url('assets/images/rapat.png'); ?>" alt="Jadwal Rapat Icon" class="sidebar-icon">
    Jadwal Rapat
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
              <img src="<?php echo base_url('assets/images/profil.png'); ?>" alt="Profil Icon" class="sidebar-icon">
              
      
           <div class="profile-info">
              <div class="profile-name">Unand</div>
              <div class="profile-role">Notulensi</div>
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
        <img src="<?php echo base_url('assets/images/plus.png'); ?>" alt="Plus Icon" class="plus-icon">
    </button>

<div id="overlay" class="popup-overlay" onclick="closePopup()"></div>
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>Buat Rapat</h2>
        <form>
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
                <tr>
                    <td>1</td>
                    <td>Pembagian Tugas</td>
                    <td>APTIKA</td>
                    <td>01/01/2025</td>
                    <td><span class="status disetujui">Disetujui</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Rapat Bulanan</td>
                    <td>APTIKA</td>
                    <td>02/01/2025</td>
                    <td><span class="status belum-disetujui">Belum Disetujui</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Rapat Rutin</td>
                    <td>IKP</td>
                    <td>03/01/2025</td>
                    <td><span class="status ditolak">Ditolak</span></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Rapat Tahunan</td>
                    <td>IKP</td>
                    <td>04/01/2025</td>
                    <td><span class="status disetujui">Disetujui</span></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Agenda Wajib</td>
                    <td>Statistik Dan Persandian</td>
                    <td>05/01/2025</td>
                    <td><span class="status belum-disetujui">Belum Disetujui</span></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Evaluasi Bulanan</td>
                    <td>Statistik Dan Persandian</td>
                    <td>06/01/2025</td>
                    <td><span class="status ditolak">Ditolak</span></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Evaluasi Kinerja</td>
                    <td>IKP</td>
                    <td>07/01/2025</td>
                    <td><span class="status disetujui">Disetujui</span></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Agenda Wajib</td>
                    <td>Statistik Dan Persandian</td>
                    <td>08/01/2025</td>
                    <td><span class="status belum-disetujui">Belum Disetujui</span></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Kegiatan</td>
                    <td>APTIKA</td>
                    <td>09/01/2025</td>
                    <td><span class="status ditolak">Ditolak</span></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Rapat Tahunan</td>
                    <td>IKP</td>
                    <td>10/01/2025</td>
                    <td><span class="status disetujui">Disetujui</span></td>
                </tr>
            </tbody>
        </table>
    </div>
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

    <script>
    
        // Fungsi untuk membuka popup
function openPopup() {
    document.getElementById("popup").style.display = "block";
}

// Fungsi untuk menutup popup
function closePopup() {
    document.getElementById("popup").style.display = "none";
}
        const toggleDarkMode = document.getElementById('toggleDarkMode');
        toggleDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            // Change image based on the mode
            if (document.body.classList.contains('dark-mode')) {
                toggleDarkMode.src = '<?php echo base_url('assets/images/sun.png'); ?>'; // Ganti dengan gambar mode terang
            } else {
                toggleDarkMode.src = '<?php echo base_url('assets/images/moon.png'); ?>'; // Ganti dengan gambar mode gelap
            }
        });
// Menampilkan popup dan overlay
function openPopup() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("popup").style.display = "block";
}
// Menutup popup dan overlay
function closePopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("popup").style.display = "none";
}
function searchTable() {
      var input = document.getElementById('searchInput');
      var filter = input.value.toUpperCase();
      var table = document.getElementById('dataTable');
      var tr = table.getElementsByTagName('tr');
      
      for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName('td');
        var rowContainsSearchTerm = false;
        
        for (var j = 0; j < td.length; j++) {
          if (td[j] && td[j].innerText.toUpperCase().indexOf(filter) > -1) {
            rowContainsSearchTerm = true;
          }
        }

        if (rowContainsSearchTerm) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
    function toggleDropdown() {
        const dropdown = document.querySelector(".dropdown-menu");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }
    // Menutup dropdown jika klik di luar
    document.addEventListener("click", function(event) {
        const profile = document.querySelector(".profile");
        if (!profile.contains(event.target)) {
            document.querySelector(".dropdown-menu").style.display = "none";
        }
    });
    document.getElementById("entries").addEventListener("change", function() {
    let selectedValue = parseInt(this.value); // Ambil jumlah data yang dipilih
    let table = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
    let rows = table.getElementsByTagName("tr");

    // Loop untuk menampilkan/sembunyikan baris tabel
    for (let i = 0; i < rows.length; i++) {
        if (i < selectedValue || isNaN(selectedValue)) {
            rows[i].style.display = ""; // Tampilkan baris
        } else {
            rows[i].style.display = "none"; // Sembunyikan baris
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.getElementById("logoutLink");
    const logoutOverlay = document.getElementById("logoutOverlay");
    const logoutPopup = document.getElementById("logoutPopup");
    const cancelLogout = document.getElementById("cancelLogout");
    const confirmLogout = document.getElementById("confirmLogout");

    // Ketika tombol "Logout" di dropdown diklik
    logoutLink.addEventListener("click", function (e) {
        e.preventDefault(); // Mencegah aksi default link
        logoutOverlay.style.display = "block"; // Tampilkan overlay
        logoutPopup.style.display = "block"; // Tampilkan popup
    });

    // Fungsi untuk menutup popup logout
    function closeLogoutPopup() {
        logoutOverlay.style.display = "none"; // Sembunyikan overlay
        logoutPopup.style.display = "none"; // Sembunyikan popup
    }

    // Klik tombol "Tidak" untuk menutup popup
    cancelLogout.addEventListener("click", closeLogoutPopup);

    // Klik di luar popup untuk menutupnya
    logoutOverlay.addEventListener("click", closeLogoutPopup);

    // Klik tombol "Ya" untuk logout
    confirmLogout.addEventListener("click", function () {
        window.location.href = "<?= base_url('auth/logout') ?>"; 
    });
});
</script>
</body>
</html>
