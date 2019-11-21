<?php
    include "koneksi.php";
    include "../../helper/fungsi.php";

    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $sql = "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'";

    $query = $con->query($sql);

    // row
    $row = mysqli_num_rows($query);
    
    if($row > 0){
        // value
        while($row = mysqli_fetch_array($query)){
            $id = $row['id_admin'];
            $name = $row['nama'];
            $level = $row['level'];
        }

        // get session
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['level'] = $level;

        // flash data
        setSession("success", "Login Berhasil!");

        header("Location: ../dashboard.php");
    }else{
        // flash data
        setSession("error", "Login Gagal!");

        header("Location: ../index.php");
    }
?>