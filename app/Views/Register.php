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

                <button type="submit" class="btn">Sign up</button>
            </form>
        </div>
    </div>
</body>
</html>
