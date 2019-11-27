<?php
    require "helper/fungsi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "header.php" ?>
</head>
<body id="body-main">
    <div class="container">
        <div class="wreapper">
            <div class="main">
                <img src="assets/images/logo-stikom.png" alt="logo-stikom" class="img-round"><br>
                <h1 class="display-5">PENILAIAN KEPUASAN PELANGGAN<br>ITB STIKOM BALI</h1>
                <!-- Flash data -->
                <?php (isset($_SESSION['flash'])) ? viewAlert() : '' ?>
                <!-- Flash data -->
                <a href="kuisioner.php" class="btn btn-outline-light btn-lg">MULAI</a>
            </div>
        </div>
    </div>

    <!-- js -->
    <?php require "footer.php"; ?>
</body>
</html>