<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $pertanyaan = $_POST['pertanyaan'];
    $sql = "INSERT INTO tb_pertanyaan VALUES(
        '',
        '$pertanyaan'
    )";

    $query = $con->query($sql);
    
    if($query){
        // flash data
        setSession("success", "Tambah pertanyaan berhasil");

        header("Location: ../../pertanyaan.php");
    }else{
        // flash data
        setSession("error", "Tambah pertanyaan gagal!");

        header("Location: ../../form/form-pertanyaan.php");
    }
?>