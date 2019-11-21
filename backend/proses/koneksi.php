<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "skripsi_mitha";

    $con = mysqli_connect($server, $username, $password, $database);
    if(!$con){
        echo "Koneksi Gagal!";
    }
?>