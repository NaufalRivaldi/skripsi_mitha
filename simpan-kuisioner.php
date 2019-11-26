<?php
    include "backend/proses/koneksi.php";
    include "helper/fungsi.php";

    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $id_pertanyaan = $_POST['id_pertanyaan'];
    $nilai = $_POST['nilai'];
    $komen = $_POST['komentar'];

    // save user
    simpanUser($nama, $no_telp, $email);
    $id_user = idLastUser();

    // save nilai
    simpanNilai($id_user, $id_pertanyaan, $nilai);

    // save komen
    simpanKomen($id_user, $komen);
    
    // flash data
    setSession("success", "Terima kasih telah mengisi kuisioner kami.");
    header("Location: index.php");

    // fungsi tambahan
    function simpanUser($nama, $no_telp, $email){
        global $con;
        
        $sql = "INSERT INTO tb_user VALUES(
            '',
            '$nama',
            '$no_telp',
            '$email'
        )";

        $query = $con->query($sql);
    }

    function idLastUser(){
        global $con;
        $id_user = '';
        
        $sql = "SELECT id_user FROM tb_user ORDER BY id_user DESC LIMIT 1";
        $query = $con->query($sql);
        while($row = mysqli_fetch_array($query)){
            $id_user = $row['id_user'];
        }

        return $id_user;
    }

    function simpanNilai($id_user, $id_pertanyaan, $nilai){
        global $con;
        
        for($i = 0; $i < count($id_pertanyaan); $i++){
            $sql = "INSERT INTO tb_nilai VALUES(
                '',
                '$nilai[$i]',
                '$id_user',
                '$id_pertanyaan[$i]'
            )";
    
            $query = $con->query($sql);
        }
    }

    function simpanKomen($id_user, $komen){
        global $con;
        
        $sql = "INSERT INTO tb_komen VALUES(
            '',
            '$komen',
            '$id_user'
        )";

        $query = $con->query($sql);
    }
?>