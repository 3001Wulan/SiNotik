<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SINOTIK</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="SINOTIK Logo">
                <h1>SINOTIK</h1>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-message">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('login'); ?>" method="post">
                <?= csrf_field(); ?>

                <div class="input-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/User.png'); ?>" alt="User Icon"></span>
                        <input type="text" id="username" name="username" placeholder="Input username here" value="<?= old('username'); ?>" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <span class="icon"><img src="<?php echo base_url('assets/images/Lock.png'); ?>" alt="Lock Icon"></span>
                        <input type="password" id="password" name="password" placeholder="Input password here" required>
                        <!-- Eye Icon to toggle password visibility -->
                        <span id="toggle-password" class="eye-icon">
                            <img src="<?php echo base_url('assets/images/Lockmata.png'); ?>" alt="Eye Icon">
                        </span>
                    </div>
                </div>

                <div class="links">
                    <a href="<?php echo base_url('auth/forgot_password'); ?>">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="<?php echo base_url('register'); ?>">Register Here</a></p>
                </div>
            </form>
        </div>
    </div>

    <div id="forgot-password-popup" class="popup hidden">
        <div class="popup-content">
            <div class="popup-header">
                <img src="<?php echo base_url('assets/images/Info.png'); ?>" alt="Info Icon">
            </div>
            <p>Hubungi Admin untuk Reset Password!</p>
            <div class="contact-info">
                <p><span class="label">Whatsapp:</span> <span class="value">+628xxxxxxxxxx</span></p>
                <p><span class="label">Email:</span> <span class="value">admin@gmail.com</span></p>
            </div>
            <button id="close-popup" class="btn-close">OK</button>
        </div>
    </div>

    <script>
    document.querySelector('.links a').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('forgot-password-popup').classList.remove('hidden');
    });

    document.getElementById('close-popup').addEventListener('click', function () {
        document.getElementById('forgot-password-popup').classList.add('hidden');
    });

    // Toggle password visibility
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        
        // Toggle eye icon (for visibility)
        const eyeIcon = document.getElementById('toggle-password').querySelector('img');
        if (type === 'text') {
            eyeIcon.src = "<?php echo base_url('assets/images/Lockmata.png'); ?>"; // Update to 'eye-slash' icon when visible
        } else {
            eyeIcon.src = "<?php echo base_url('assets/images/Lockmata.png'); ?>"; // Update to regular 'eye' icon when hidden
        }
    });
    </script>
</body>
</html>
