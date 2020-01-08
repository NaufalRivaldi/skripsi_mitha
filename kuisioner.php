<?php
    require "helper/fungsi.php";
    require "backend/proses/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "header.php" ?>
</head>
<body id="body-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 main">
                <img src="assets/images/logo-stikom.png" alt="logo-stikom" class="img-round mt-3" style="width:100px">
                <h1 class="display-5">PENILAIAN KEPUASAN PELANGGAN<br>ITB STIKOM BALI</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem laudantium distinctio excepturi deserunt animi. Repellat, rerum mollitia provident animi eaque atque. Earum temporibus tempore ducimus, hic tempora excepturi ea officiis?</p>

                    <!-- form -->
                    <div class="card">
                        <div class="card-header">
                            <form method="POST" action="simpan-kuisioner.php">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="font-weight-bold">Data Diri</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="nama" class="sr-only">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="no_telp" class="sr-only">No Telp</label>
                                        <input type="tel" name="no_telp" class="form-control" id="no_telp" placeholder="No Telepon" pattern="^\d{12}$" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email" class="sr-only">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertanyaan</th>
                                            <th colspan="4">
                                                <div class="row" style="margin:0; padding:0;">
                                                    <div class="col-3 text-right" style="margin:0; padding:0">
                                                        <span style="margin-right: -15px">
                                                            😞
                                                        </span>
                                                    </div>
                                                    <div class="col-3 text-right" style="margin:0; padding:0">
                                                        <span style="margin-right: -12px">
                                                            ☹️
                                                        </span>
                                                    </div>
                                                    <div class="col-3 text-right" style="margin:0; padding:0">
                                                        <span style="margin-right: -9px">
                                                            😀
                                                        </span>
                                                    </div>
                                                    <div class="col-3 text-right" style="margin:0; padding:0">
                                                        <span style="margin-right: -6px">
                                                            😆
                                                        </span>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $sql = "SELECT * FROM tb_pertanyaan";
                                            $query = $con->query($sql);

                                            if(!empty($query)){
                                                foreach($query as $row){
                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>
                                                        <?= $row['pertanyaan'] ?>
                                                        <input type="hidden" name="id_pertanyaan[]" value="<?= $row['id_pertanyaan'] ?>">
                                                    </td>
                                                    <td colspan="4">
                                                        <input type="range" name="nilai[]" class="custom-range" min="0" max="4" value="0" required>
                                                    </td>
                                                </tr>
                                        <?php
                                                }
                                            }
                                        ?>

                                        <!-- komen -->
                                        <tr>
                                            <td colspan="6">
                                                <textarea name="komentar" rows="5" class="form-control" placeholder="Komentar anda.."></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <input type="submit" value="Simpan" class="btn btn-primary">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- footer -->
                <div class="footer">
                    Copyright © 2019. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <?php require "footer.php"; ?>
</body>
</html>