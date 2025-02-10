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
    <a href="dashboard_pegawai" class="<?php echo ($current_page == 'dashboard') ? 'active dashboard' : 'inactive'; ?>">
        <img src="<?php echo base_url('assets/images/dashboard_admin.png'); ?>" alt="Dashboard Icon" class="sidebar-icon">
        Dashboard
    </a>
</li>
<li>
    <a href="melihatpegawai" class="<?php echo ($current_page == 'notulensi_notulen') ? 'active data-pengguna' : 'inactive'; ?>">
        <img src="<?php echo base_url('assets/images/codicon_book.png'); ?>" alt="Data Pengguna Icon" class="sidebar-icon">
        Notulensi
    </a>
</li>
<li>
    <a href="riwayatadmin" class="<?php echo ($current_page == 'riwayat_notulensi') ? 'active riwayat-notulensi' : 'inactive'; ?>">
        <img src="<?php echo base_url('assets/images/icon_riwayat.png'); ?>" alt="Riwayat Notulensi Icon" class="sidebar-icon">
        Riwayat Notulensi
    </a>
</li>
<li>
<a href="#" class="<?php echo ($current_page == 'jadwal_rapat') ? 'active jadwal rapat' : 'inactive'; ?>">
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
        
          <div class="dropdown-menu" id="profileDropdown">
              <a href="<?= base_url('profile') ?>">
                 <img src="<?= base_url('assets/images/Profil.png') ?>" alt="Profil" class="dropdown-icon"> Profil
                </a>
               <a href="#" id="logoutLink">
                 <img src="<?= base_url('assets/images/logout.png') ?>" alt="Logout" class="dropdown-icon"> Logout
                </a>
              </div>
          </div>
      </div>



            <div class="page-title">
                <h1>Jadwal Rapat</h1>
                <button class="btn-add" onclick="openPopup()">
        Buat Rapat
        <img src="assets/images/plus.png" alt="Tambah Icon" class="btn-icon">
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
    <td>Evaluasi Bulanan </td>
    <td>Statistik Dan Persandian</td>
    <td>06/01/2025</td>
    <td><span class="status ditolak">Ditolak</span></td>
</tr>
    </tbody>
</table>

    

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
  
    </script>
</body>
</html>
