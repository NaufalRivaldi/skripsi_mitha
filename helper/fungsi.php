<?php
    session_start();
    define('app_name', 'Sistem Kepuasan Pelanggan');
    // define('base_url', 'http://localhost/skripsi-mitha/');
    define('base_url', 'http://localhost/skripsi_mitha/');

    // session flash
    function setSession($set, $text){
        $_SESSION['set'] = $set;
        $_SESSION['flash'] = $text;
    }

    function viewAlert(){
        $set = $_SESSION['set'];
        $text = $_SESSION['flash'];

        switch ($set) {
            case 'success':
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    '.$text.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
                break;
            
            case 'error':
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        '.$text.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                    break;

            default:
                # code...
                break;
        }

        unset($_SESSION['set']);
        unset($_SESSION['flash']);
    }

    // akun
    function checkLogin(){
        if(!isset($_SESSION['name']) || !isset($_SESSION['level'])){
            // flash data
            setSession("error", "Anda belum melakukan login!");

            header("Location: index.php");
        }
    }

    function checkGuess(){
        if(isset($_SESSION['name']) || isset($_SESSION['level'])){
            header("Location: dashboard.php");
        }
    }

    function setJabatan(){
        $level = $_SESSION['level'];

        switch ($level) {
            case '1':
                return "Admin";
                break;

            case '2':
                return "Kepala Bagian";
                break;
            
            default:
                # code...
                break;
        }
    }

    function setJabatanAdmin($level){
        switch ($level) {
            case '1':
                return "Admin";
                break;

            case '2':
                return "Kepala Bagian";
                break;
            
            default:
                # code...
                break;
        }
    }
?>