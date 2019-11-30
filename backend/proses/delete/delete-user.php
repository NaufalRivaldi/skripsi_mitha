<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM tb_user WHERE id_user = '$id'";
    $query = $con->query($sql);

    $sql = "DELETE FROM tb_komen WHERE id_user = '$id'";
    $query = $con->query($sql);

    $sql = "DELETE FROM tb_nilai WHERE id_user = '$id'";
    $query = $con->query($sql);

    
    if($query){
        // flash data
        setSession("success", "Delete user berhasil");

        header("Location: ../../user.php");
    }else{
        // flash data
        setSession("error", "Delete user gagal!");

        header("Location: ../../user.php");
    }
?>