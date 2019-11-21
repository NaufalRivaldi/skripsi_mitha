<?php
    require "../helper/fungsi.php";
    require "proses/koneksi.php";

    checkLogin();
?>


<!doctype html>
<html lang="en">
 
<head>
    <?php require "header.php" ?>
</head>

<body>
    <!-- main wrapper -->
    <div class="dashboard-main-wrapper">

        <!-- navbar -->
        <?php require "navbar.php" ?>
        <!-- end navbar -->

        <!-- left sidebar -->
        <?php require "sidebar.php" ?>
        <!-- end left sidebar -->

        <!-- wrapper  -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- Page Header -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Dashboard </h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                        </ol>
                                    </nav>
                                </div>

                                <!-- Flash data -->
                                <?php (isset($_SESSION['flash'])) ? viewAlert() : '' ?>

                                <!-- contohnya ni -->
                                <!-- <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard Template</li>
                                        </ol>
                                    </nav>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    Selamat datang di <?= strtoupper(app_name) ?> ITB STIKOM BALI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- footer -->
            <?php require "footer.php" ?>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <?php require "js.php" ?>
</body>
 
</html>