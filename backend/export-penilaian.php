<?php
    require "../helper/fungsi.php";
    require "proses/koneksi.php";

    // dompdf
    require_once("dompdf/autoload.inc.php");
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    checkLogin();

    // variable
    $tgl_a = '';
    $tgl_b = '';
    $tanggal = date('F Y');
    if(!empty($_GET)){
        $tgl_a = $_GET['tgl_a'];
        $tgl_b = $_GET['tgl_b'];
        $tanggal = date('d F Y', strtotime($tgl_a)).' - '.date('d F Y', strtotime($tgl_b));
    }

    // function
    function showResponden($id_pertanyaan, $nilai){
        global $con;
        global $tgl_a;
        global $tgl_b;
        
        if(!empty($_GET)){
            $tgl_a = $_GET['tgl_a'];
            $tgl_b = $_GET['tgl_b'];
            $sql = "SELECT * FROM tb_nilai WHERE id_pertanyaan = '$id_pertanyaan' AND nilai = '$nilai' AND tgl_nilai >= '$tgl_a' AND tgl_nilai <= '$tgl_b'";
        }else{
            $sql = "SELECT * FROM tb_nilai WHERE id_pertanyaan = '$id_pertanyaan' AND nilai = '$nilai'";
        }
        $query = $con->query($sql);
        $row = mysqli_num_rows($query);

        return $row;
    }

    function skor($responden, $nilai){
        return $responden * $nilai;
    }

    function totalResponden($res1, $res2, $res3, $res4){
        return $res1 + $res2 + $res3 + $res4;
    }

    // status penilaian
    function status($persen){
        $text = '';
        if($persen <= 25){
            $text = 'Tidak Bagus';
        }else if($persen <= 50){
            $text = 'Kurang Bagus';
        }else if($persen <= 75){
            $text = 'Bagus';
        }else if($persen <= 100){
            $text = 'Sangat Bagus';
        }

        return $text;
    }

    $html = "
        <center>
            <img src='../assets/images/kop.jpg' alt='logo stikom' width='100%'>
            <hr>
            <h2>HASIL PENILAIAN KEPUASAN PELANGGAN</h2>
        </center>";
            if(!empty($_GET)){
                $html .= "<p>
                    Tanggal : ".$_GET['tgl_a']." s/d ".$_GET['tgl_b']."
                </p>";
            }

        $html .= "
        <hr>
        Periode : ".$tanggal."
        <!-- penilaian -->
        <h3>Nilai</h3>
        <table border = '1' style='width:100%'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Persentase</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                ";
                    $no = 1;
                    $sql = "SELECT * FROM tb_pertanyaan";
                    $query = $con->query($sql);
                    
                    if(isset($query)){
                        foreach($query as $row){
                            $skor1 = skor(showResponden($row['id_pertanyaan'], 1), 1);
                            $skor2 = skor(showResponden($row['id_pertanyaan'], 2), 2);
                            $skor3 = skor(showResponden($row['id_pertanyaan'], 3), 3);
                            $skor4 = skor(showResponden($row['id_pertanyaan'], 4), 4);

                            $total_skor = $skor1+$skor2+$skor3+$skor4;
                            // jumlah responden * skor tertinggi
                            $max = totalResponden(showResponden($row['id_pertanyaan'], 1), showResponden($row['id_pertanyaan'], 2), showResponden($row['id_pertanyaan'], 3), showResponden($row['id_pertanyaan'], 4)) * 4;
                            if(!empty($max)){
                                $indeks = ($total_skor / $max) * 100;
                            }else{
                                $indeks = 0;
                            }
                $html .= "
                <tr>
                    <td>".$no++."</td>
                    <td>".$row['pertanyaan']."</td>
                    <td>".round($indeks)."%</td>
                    <td>".status($indeks)."</td>
                </tr>
                ";
                        }
                    }
                $html .= "
            </tbody>
        </table>
    ";

    $dompdf->loadHtml($html);
    // Setting ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'potrait');
    // Rendering dari HTML Ke PDF
    $dompdf->render();
    // Melakukan output file Pdf
    $dompdf->stream('laporan_penilaian.pdf');
?>