<?php
    require "../helper/fungsi.php";
    require "proses/koneksi.php";

    // dompdf
    require_once("dompdf/autoload.inc.php");
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    checkLogin();

    // function
    function showResponden($id_pertanyaan, $nilai){
        global $con;
        
        $sql = "SELECT * FROM tb_nilai WHERE id_pertanyaan = '$id_pertanyaan' AND nilai = '$nilai'";
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
        <h3>Responden</h3>
        <table border='1' style='width:100%'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                ";
                    $no = 1;
                    $sql = "SELECT * FROM tb_pertanyaan";
                    $query = $con->query($sql);
                    
                    if(isset($query)){
                        foreach($query as $row){
                            $res1 = showResponden($row['id_pertanyaan'], 1);
                            $res2 = showResponden($row['id_pertanyaan'], 2);
                            $res3 = showResponden($row['id_pertanyaan'], 3);
                            $res4 = showResponden($row['id_pertanyaan'], 1);

                            $total_res = $res1 + $res2 + $res3+ $res4;
                $html .= "
                <tr>
                    <td>".$no."</td>
                    <td>".$row['pertanyaan']."</td>
                    <td>".$res1."</td>
                    <td>".$res2."</td>
                    <td>".$res3."</td>
                    <td>".$res4."</td>
                    <td>".$total_res." Orang</td>
                </tr>
                ";
                        }
                    }
                $html .= "
            </tbody>
        </table>

        <hr>
        <!-- penilaian -->
        <h3>Hasil Penilaian</h3>
        <table border = '1' style='width:100%'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>Total</th>
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
                    <td>".$skor1."</td>
                    <td>".$skor2."</td>
                    <td>".$skor3."</td>
                    <td>".$skor4."</td>
                    <td>".$total_skor."</td>
                    <td>".$indeks."%</td>
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