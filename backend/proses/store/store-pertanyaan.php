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
        // delete all data
        $sql = "TRUNCATE TABLE tb_komen";
        $query = $con->query($sql);
        $sql = "TRUNCATE TABLE tb_nilai";
        $query = $con->query($sql);
        $sql = "TRUNCATE TABLE tb_user";
        $query = $con->query($sql);

        // flash data
        setSession("success", "Tambah pertanyaan berhasil");

        header("Location: ../../pertanyaan.php");
    }else{
        // flash data
        setSession("error", "Tambah pertanyaan gagal!");

        header("Location: ../../form/form-pertanyaan.php");
    }
?>