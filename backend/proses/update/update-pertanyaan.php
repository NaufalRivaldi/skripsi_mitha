<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $id = $_POST['id_pertanyaan'];
    $pertanyaan = $_POST['pertanyaan'];

    $sql = "UPDATE tb_pertanyaan SET pertanyaan = '$pertanyaan' WHERE id_pertanyaan = '$id'";

    $query = $con->query($sql);
    
    if($query){
        // flash data
        setSession("success", "Update pertanyaan berhasil");

        header("Location: ../../pertanyaan.php");
    }else{
        // flash data
        setSession("error", "Update pertanyaan gagal!");

        header("Location: ../../form/form-pertanyaan.php?id=".$id);
    }
?>