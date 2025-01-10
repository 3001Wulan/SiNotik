<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SINOTIK</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Register.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* CSS Popup */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            display: none; /* Popup tidak terlihat secara default */
            z-index: 1000;
        }
        .popup img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }
        .popup h3 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }
    </style>
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
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="User Icon"></span>
                        <input type="password" id="password" name="password" placeholder="Input your password here">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="User Icon"></span>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password here">
                    </div>
                </div>

                <button type="button" class="btn" id="signup-button">Sign up</button>
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

            // Sembunyikan popup setelah 5 detik dan redirect ke halaman login
            setTimeout(function() {
                popup.style.display = 'none';
                window.location.href = '<?= base_url("login") ?>'; // Ganti dengan URL login Anda
            }, 1000);
        });
    </script>
</body>
</html>
