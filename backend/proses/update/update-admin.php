<?php
    include "../koneksi.php";
    include "../../../helper/fungsi.php";

    $id = $_POST['id_admin'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    
    if(isset($_POST['password'])){
        $password = sha1($_POST['password']);
    }else{
        $password = $_POST['old_password'];
    }

    $level = $_POST['level'];
    $sql = "UPDATE tb_admin SET nama = '$nama', username = '$username', password = '$password', level = '$level' WHERE id_admin = '$id'";

    $query = $con->query($sql);
    
    if($query){
        // flash data
        setSession("success", "Update admin berhasil");

        header("Location: ../../admin.php");
    }else{
        // flash data
        setSession("error", "Update admin gagal!");

        header("Location: ../../form/form-admin.php?id=".$id);
    }
?>