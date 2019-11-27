<?php
    require "../helper/fungsi.php";
    require "proses/koneksi.php";

    checkLogin();

    // variable
    $tgl_a = '';
    $tgl_b = '';
    if(!empty($_GET)){
        $tgl_a = $_GET['tgl_a'];
        $tgl_b = $_GET['tgl_b'];
    }

    // function
    function showResponden($id_pertanyaan, $nilai){
        global $con;
        global $tgl_a;
        global $tgl_b;
        
        if(!empty($_GET)){
            $tgl_a = $_GET['tgl_a'];
            $tgl_b = $_GET['tgl_b'];
            $sql = "SELECT * FROM tb_nilai WHERE id_pertanyaan = '$id_pertanyaan' AND nilai = '$nilai' AND tgl_nilai >= '$tgl_a' AND tgl_nilai <= '$tgl_b'";
        }else{
            $sql = "SELECT * FROM tb_nilai WHERE id_pertanyaan = '$id_pertanyaan' AND nilai = '$nilai'";
        }
        $query = $con->query($sql);
        $row = mysqli_num_rows($query);

        return $row;
    }

    function skor($responden, $nilai){
        return $responden * $nilai;
    }

    function totalResponden($res1, $res2, $res3, $res4){
        return $res1 + $res2 + $res3 + $res4;
    }

    // status penilaian
    function status($persen){
        $text = '';
        if($persen <= 25){
            $text = 'Tidak Bagus';
        }else if($persen <= 50){
            $text = 'Kurang Bagus';
        }else if($persen <= 75){
            $text = 'Bagus';
        }else if($persen <= 100){
            $text = 'Sangat Bagus';
        }

        return $text;
    }
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
                                <h2 class="pageheader-title">Penilaian</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" aria-current="page">Laporan</li>
                                            <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
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
                                    <a href="export-penilaian.php?<?= $_SERVER['QUERY_STRING']; ?>" class="btn btn-success"><i class="fas fa-print"></i> Print Data</a>
                                    <br><br>
                                    <form method="GET" action="penilaian.php">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Tanggal Laporan :</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="date" name="tgl_a" class="form-control tgl_a" value="<?= $tgl_a ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="tgl_b" class="form-control tgl_b" min="<?= $tgl_a ?>" value="<?= $tgl_b ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="submit" class="btn btn-primary btn-sm" value="Cari">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                            if(!empty($_GET)){
                                        ?>
                                            <p>
                                                Tanggal : <?= $_GET['tgl_a'] ?> s/d <?= $_GET['tgl_b'] ?>
                                            </p>
                                        <?php } ?>

                                        <!-- responden -->
                                        <h3>Responden</h3>
                                        <table class="table table-striped display">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pertanyaan</th>
                                                    <th>1 (😞)</th>
                                                    <th>2 (☹️)</th>
                                                    <th>3 (😀)</th>
                                                    <th>4 (😆)</th>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    $sql = "SELECT * FROM tb_pertanyaan";
                                                    $query = $con->query($sql);
                                                    
                                                    if(isset($query)){
                                                        foreach($query as $row){
                                                            $res1 = showResponden($row['id_pertanyaan'], 1);
                                                            $res2 = showResponden($row['id_pertanyaan'], 2);
                                                            $res3 = showResponden($row['id_pertanyaan'], 3);
                                                            $res4 = showResponden($row['id_pertanyaan'], 4);

                                                            $total_res = $res1 + $res2 + $res3+ $res4;
                                                ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row['pertanyaan']; ?></td>
                                                    <td><?= $res1; ?></td>
                                                    <td><?= $res2; ?></td>
                                                    <td><?= $res3; ?></td>
                                                    <td><?= $res4; ?></td>
                                                    <td><?= $total_res ?> Orang</td>
                                                </tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        
                                        <hr>
                                        <!-- penilaian -->
                                        <h3>Hasil Penilaian</h3>
                                        <table class="table table-striped display">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pertanyaan</th>
                                                    <th>1 (😞)</th>
                                                    <th>2 (☹️)</th>
                                                    <th>3 (😀)</th>
                                                    <th>4 (😆)</th>
                                                    <th>Total</th>
                                                    <th>Persentase</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    $sql = "SELECT * FROM tb_pertanyaan";
                                                    $query = $con->query($sql);
                                                    
                                                    if(isset($query)){
                                                        foreach($query as $row){
                                                            $skor1 = skor(showResponden($row['id_pertanyaan'], 1), 1);
                                                            $skor2 = skor(showResponden($row['id_pertanyaan'], 2), 2);
                                                            $skor3 = skor(showResponden($row['id_pertanyaan'], 3), 3);
                                                            $skor4 = skor(showResponden($row['id_pertanyaan'], 4), 4);

                                                            $total_skor = $skor1+$skor2+$skor3+$skor4;
                                                            // jumlah responden * skor tertinggi
                                                            $max = totalResponden(showResponden($row['id_pertanyaan'], 1), showResponden($row['id_pertanyaan'], 2), showResponden($row['id_pertanyaan'], 3), showResponden($row['id_pertanyaan'], 4)) * 4;
                                                            if(!empty($max)){
                                                                $indeks = ($total_skor / $max) * 100;
                                                            }else{
                                                                $indeks = 0;
                                                            }
                                                ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row['pertanyaan']; ?></td>
                                                    <td><?= $skor1; ?></td>
                                                    <td><?= $skor2; ?></td>
                                                    <td><?= $skor3; ?></td>
                                                    <td><?= $skor4; ?></td>
                                                    <td><?= $total_skor ?></td>
                                                    <td><?= round($indeks) ?>%</td>
                                                    <td><?= status($indeks) ?></td>
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