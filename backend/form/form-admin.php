<?php
    require "../../helper/fungsi.php";
    require "../proses/koneksi.php";

    checkLogin();

    if($_GET){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
        $query = $con->query($sql);

        while($row = mysqli_fetch_array($query)){
            $nama = $row['nama'];
            $username = $row['username'];
            $password_old = $row['password'];
            $level = $row['level'];
        }
    }else{
        $id = '';
        $nama = '';
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
                                <h2 class="pageheader-title">Admin </h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" aria-current="page">Data</li>
                                            <li class="breadcrumb-item"><a href="<?= base_url ?>backend/admin.php" class="breadcrumb-link">Admin</a></li>
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
                                    <h1 class="display-5">Form Admin</h1>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url ?>backend/proses/<?= (!$_GET) ? 'store/store-admin.php' : 'update/update-admin.php' ?>" method="POST">
                                        <?= (!empty($id)) ? '
                                            <input type="hidden" name="id_admin" class="form-control" value="'.$id.'">
                                        ' : '' ?>

                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $nama ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" id="username" value="<?= $username ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            </div>

                                            <?= (!empty($password)) ? '
                                            <input type="hidden" name="old_password" class="form-control" value="'.$password.'">
                                        ' : '' ?>
                                        </div>
                                        <div class="form-group row">
                                            <label for="level" class="col-sm-2 col-form-label">Level</label>
                                            <div class="col-sm-10">
                                            <select name="level" id="level" class="form-control col-md-6" required>
                                                <option value="">Pilih</option>
                                                <option value="1" <?= ($level == '1') ? 'selected' : '' ?>>Admin</option>
                                                <option value="2" <?= ($level == '2') ? 'selected' : '' ?>>Kepala Bagian</option>
                                            </select>
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