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
                    </div>
                </div>

                <div class="links">
                    <a href="<?php echo base_url('auth/forgot_password'); ?>">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="<?php echo base_url('auth/register'); ?>">Register Here</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
