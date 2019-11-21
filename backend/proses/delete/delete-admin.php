<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM tb_admin WHERE id_admin = '$id'";

    $query = $con->query($sql);
    
    if($query){
        // flash data
        setSession("success", "Delete admin berhasil");

        header("Location: ../../admin.php");
    }else{
        // flash data
        setSession("error", "Delete admin gagal!");

        header("Location: ../../admin.php");
    }
?>