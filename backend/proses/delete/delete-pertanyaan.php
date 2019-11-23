<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM tb_pertanyaan WHERE id_pertanyaan = '$id'";

    $query = $con->query($sql);
    
    if($query){
        // flash data
        setSession("success", "Delete pertanyaan berhasil");

        header("Location: ../../pertanyaan.php");
    }else{
        // flash data
        setSession("error", "Delete pertanyaan gagal!");

        header("Location: ../../pertanyaan.php");
    }
?>