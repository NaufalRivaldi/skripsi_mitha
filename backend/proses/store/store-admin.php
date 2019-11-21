<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $level = $_POST['level'];
    $sql = "INSERT INTO tb_admin VALUES(
        '',
        '$nama',
        '$username',
        '$password', 
        '$level'
    )";

    $query = $con->query($sql);
    
    if($query){
        // flash data
        setSession("success", "Tambah admin berhasil");

        header("Location: ../../admin.php");
    }else{
        // flash data
        setSession("error", "Tambah admin gagal!");

        header("Location: ../../form/form-admin.php");
    }
?>