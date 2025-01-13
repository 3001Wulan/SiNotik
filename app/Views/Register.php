<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SINOTIK</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Register.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo SINOTIK">
            <h1>SINOTIK</h1>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h2>Register</h2>
            
            <!-- Display validation errors -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/User.png'); ?>" alt="User Icon"></span>
                        <input type="text" id="username" name="username" placeholder="Input your username here" value="<?= old('username') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nip">NIP</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/User.png'); ?>" alt="User Icon"></span>
                        <input type="text" id="nip" name="nip" placeholder="Input your NIP here" value="<?= old('nip') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/User.png'); ?>" alt="User Icon"></span>
                        <input type="email" id="email" name="email" placeholder="Input your email here" value="<?= old('email') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bidang">Bidang</label>
                    <div class="custom-dropdown">
                        <button class="dropdown-button" type="button">
                            <span class="icon">
                                <img src="<?= base_url('assets/images/User.png') ?>" alt="Email Icon" class="icon-img">
                            </span>
                            <span class="text">Pilih Bidang</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item" data-value="APTIKA">APTIKA</li>
                            <li class="dropdown-item" data-value="IKP">IKP</li>
                            <li class="dropdown-item" data-value="Statistik">Statistik dan Persandian</li>
                        </ul>
                        <input type="hidden" name="bidang" id="bidang">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon"></span>
                        <input type="password" id="password" name="password" placeholder="Input your password here">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon"></span>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password here">
                    </div>
                </div>

                <button type="submit" class="btn" id="signup-button">Sign up</button>
            </form>
        </div>
    </div>

    <!-- Popup HTML -->
    <div class="popup" id="success-popup">
        <img src="<?= base_url('assets/images/Info.png') ?>" alt="Success Icon">
        <h3>Registrasi Berhasil!</h3>
    </div>

    <script>
        // Event listener untuk tombol Sign up
        document.getElementById('signup-button').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah submit form

            // Menampilkan popup
            const popup = document.getElementById('success-popup');
            popup.style.display = 'block';

            // Sembunyikan popup setelah 5 detik
            setTimeout(function() {
                popup.style.display = 'none';
            }, 1000);
        });

        // Interaktivitas Dropdown
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const hiddenInput = document.querySelector('#bidang');
    const textElement = dropdownButton.querySelector('.text'); // Ambil elemen teks di dalam tombol

    // Toggle menu dropdown saat tombol "Pilih Bidang" diklik
    dropdownButton.addEventListener('click', function (e) {
        e.stopPropagation(); // Mencegah event bubbling
        dropdownMenu.classList.toggle('show');
    });

    // Pilih opsi dropdown dan update teks tombol serta input tersembunyi
    dropdownItems.forEach(item => {
        item.addEventListener('click', function () {
            textElement.textContent = this.textContent; // Update teks tombol tanpa mengubah ikon
            hiddenInput.value = this.dataset.value; // Update nilai input tersembunyi
            dropdownMenu.classList.remove('show'); // Tutup dropdown setelah memilih
        });
    });

    // Tutup dropdown jika klik di luar area dropdown
    document.addEventListener('click', function (e) {
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
});

    </script>
</body>
</html>
