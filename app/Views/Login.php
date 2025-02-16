<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiNotik - Home & Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

</head>
<body>
    <div class="container">
        <!-- Bagian kiri: Welcome -->
        <div class="welcome-section">
            <header>
                <nav>
                    <a href="<?php echo base_url('about'); ?>" class="about-link">About</a>
                </nav>
            </header>
            <h1>Welcome to SiNotik</h1>
            <p>
                Optimalkan pencatatan rapat dengan cepat dan akurat. SiNotik menghadirkan kemudahan <br>
                dalam dokumentasi dan pengelolaan hasil rapat, memastikan transparansi dan efisiensi <br>
                di setiap pertemuan.
            </p>
        </div>

        <div class="login-section">
            <div id="background-animation"></div> 
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
        particlesJS("background-animation", {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
                move: { enable: true, speed: 2, direction: "none", random: true, out_mode: "out" }
            }
        });
        document.querySelector('.links a').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('forgot-password-popup').classList.remove('hidden');
    });

    document.getElementById('close-popup').addEventListener('click', function () {
        document.getElementById('forgot-password-popup').classList.add('hidden');
    });
    </script>
</body>
</html>
