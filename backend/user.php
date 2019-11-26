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
                                <h2 class="pageheader-title">Pengisi Kuisioner </h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" aria-current="page">Data</li>
                                            <li class="breadcrumb-item active" aria-current="page">Pengisi Kuisioner</li>
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
                                    <div class="table-responsive">
                                        <table class="table table-striped display">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>No Telp</th>
                                                    <th>Email</th>
                                                    <th>Komentar</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    $sql = "SELECT tb_user.id_user, tb_user.nama, tb_user.no_telp, tb_user.email, tb_komen.deskripsi FROM tb_user INNER JOIN tb_komen ON tb_user.id_user = tb_komen.id_user";
                                                    $query = $con->query($sql);
                                                    
                                                    if(isset($query)){
                                                        foreach($query as $row){
                                                ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row['nama']; ?></td>
                                                    <td><?= $row['no_telp']; ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><?= $row['deskripsi'] ?></td>
                                                    <td>
                                                        <?php if($_SESSION['level'] == '1'): ?>
                                                        <a href="proses/delete/delete-user.php?id=<?= $row['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data secara permanen?');" ><i class="fas fa-trash"></i></a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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