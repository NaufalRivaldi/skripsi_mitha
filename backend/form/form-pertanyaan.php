<?php
    require "../../helper/fungsi.php";
    require "../proses/koneksi.php";

    checkLogin();

    if($_GET){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_pertanyaan WHERE id_pertanyaan = '$id'";
        $query = $con->query($sql);

        while($row = mysqli_fetch_array($query)){
            $pertanyaan = $row['pertanyaan'];
        }
    }else{
        $id = '';
        $pertanyaan = '';
        $username = '';
        $password_old = '';
        $level = '';
    }
?>


<!doctype html>
<html lang="en">
 
<head>
    <?php require "../header.php" ?>
</head>

<body>
    <!-- main wrapper -->
    <div class="dashboard-main-wrapper">

        <!-- navbar -->
        <?php require "../navbar.php" ?>
        <!-- end navbar -->

        <!-- left sidebar -->
        <?php require "../sidebar.php" ?>
        <!-- end left sidebar -->

        <!-- wrapper  -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- Page Header -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Pertanyaan </h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" aria-current="page">Data</li>
                                            <li class="breadcrumb-item"><a href="<?= base_url ?>backend/pertanyaan.php" class="breadcrumb-link">Pertanyaan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Form</li>
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
                                <div class="card-header">
                                    <h1 class="display-5">Form Pertanyaan</h1>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url ?>backend/proses/<?= (!$_GET) ? 'store/store-pertanyaan.php' : 'update/update-pertanyaan.php' ?>" method="POST">
                                        <?= (!empty($id)) ? '
                                            <input type="hidden" name="id_pertanyaan" class="form-control" value="'.$id.'">
                                        ' : '' ?>

                                        <div class="form-group row">
                                            <label for="pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="pertanyaan" class="form-control" id="pertanyaan" value="<?= $pertanyaan ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                            <input type="submit" name="btn" class="btn btn-primary btn-sm" value="Simpan">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <p class="text-danger">*Jika menambah pertanyaan, data penilaian akan di reset ulang.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- footer -->
            <?php require "../footer.php" ?>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <?php require "../js.php" ?>
</body>
 
</html>