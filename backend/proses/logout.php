<?php
    include "koneksi.php";
    include "../../helper/fungsi.php";

    session_destroy();

    // flash data
    setSession("success", "Anda sudah logout dari sistem");

    header("Location: ../index.php");
?>