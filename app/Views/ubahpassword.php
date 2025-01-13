<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubahpassword - SINOTIK</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/ubahpassword.css') ?>"> <!-- Menghubungkan CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        
        <div class="left-section">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo SINOTIK">
            <h1>SINOTIK</h1>
        </div>

       
        <div class="right-section">
            <h2>Ubah Password</h2>

            
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="YOUR_FORM_ACTION" method="POST">
                <div class="form-group">
                    <label for="password">Password Sekarang</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="User Icon"></span>
                        <input type="password" id="password" name="password" placeholder="Input your password here">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Password Baru</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="User Icon"></span>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Input your password here">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="User Icon"></span>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password here">
                    </div>
                </div>

                
                <button type="button" class="btn" id="save-button">Save</button>
            </form>
        </div>
    </div>

    
    <div class="overlay" id="overlay"></div>

    
    <div class="popup" id="success-popup">
        <img src="<?= base_url('assets/images/Info.png') ?>" alt="Success Icon">
        <h3>Password Berhasil Diperbarui!</h3>
    </div>

    <script>
       
        document.getElementById('save-button').addEventListener('click', function(event) {
            event.preventDefault(); 

           
            const popup = document.getElementById('success-popup');
            const overlay = document.getElementById('overlay');
            popup.style.display = 'block';
            overlay.style.display = 'block';

           
            setTimeout(function() {
                popup.style.display = 'none';
                overlay.style.display = 'none';
            }, 2000);
        });
    </script>
</body>
</html>
