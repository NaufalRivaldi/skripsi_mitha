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
                <img src="assets/images/logo-stikom.png" alt="logo-stikom" class="img-round" style="width:100px">
                <h1 class="display-5">KEPUASAN CUSTOMERS SERVICE<br>ITB STIKOM BALI</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem laudantium distinctio excepturi deserunt animi. Repellat, rerum mollitia provident animi eaque atque. Earum temporibus tempore ducimus, hic tempora excepturi ea officiis?</p>

                    <!-- form -->
                    <div class="card">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="nama" class="sr-only">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama" value="Nama" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="no_telp" class="sr-only">No Telp</label>
                                        <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No Telepon" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email" class="sr-only">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertanyaan</th>
                                            <th>😞</th>
                                            <th>☹️</th>
                                            <th>😀</th>
                                            <th>😆</th>
                                        </tr>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <?php require "footer.php"; ?>
</body>
</html>