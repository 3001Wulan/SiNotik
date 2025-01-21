<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SiNotik</title>
    <link rel="stylesheet" href="Assets/css/home.css">

</head>
<body>
    <header>
        <img id="logo" src="assets/images/logo.png" alt="SiNotik Logo">
        <nav>
            <a href="about" class="about-link">About</a>
        </nav>
    </header>

    <div class="container">
        <h1>Welcome to SiNotik</h1>
        <p>
            Optimalkan pencatatan rapat dengan cepat dan akurat. SiNotik menghadirkan kemudahan <br>
            dalam dokumentasi dan pengelolaan hasil rapat, memastikan transparansi dan efisiensi <br>
            di setiap pertemuan.
        </p>
        <a href="<?= base_url('login') ?>" class="login-btn">Login</a>
    </div>
</body>
</html>
