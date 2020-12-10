<?php
require_once 'autoload.php';

$obj = new Bayes();

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = $_POST['Usia'];
$a2 = $_POST['kelamin'];
$a3 = $_POST['Keringat'];
$a4 = $_POST['Batuk'];
$a5 = $_POST['kondisi'];

//TRUE
$Usia = $obj->probUsia($a1, 1);
$kelamin = $obj->probKelamin($a2, 1);
$keringat = $obj->probKeringat($a3, 1);
$batuk = $obj->probBatuk($a4, 1);
$kondisi = $obj->probKondisi($a5, 1);

//FALSE
$Usia2 = $obj->probUsia($a1, 0);
$kelamin2 = $obj->probKelamin($a2, 0);
$keringat2 = $obj->probKeringat($a3, 0);
$batuk2 = $obj->probBatuk($a4, 0);
$kondisi2 = $obj->probKondisi($a5, 0);

//result
$paT = $obj->hasilTrue($jumTrue, $jumData, $Usia, $kelamin, $keringat, $batuk, $kondisi);
$paF = $obj->hasilFalse($jumTrue, $jumData, $Usia2, $kelamin2, $keringat2, $batuk2, $kondisi2);

if ($a2 == "Pria") {
  $a2 = "Pria";
} else if ($a2 == "Wanita") {
  $a2 = "Wanita";
}

echo "
<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
  <div class='container'>
    <h1 class='display-4 tebal'>Hasil Prediksi</h1>
    <p class='lead'>Berikut ini adalah hasil prediksi berdasarkan ciri pasien menggunakan metode naive bayes.</p>
  </div>
</div>
";

echo "
<div class='card' style='width: 25rem;'>
  <div class='card-header' style='background-color:#17a2b8;color:#fff'>
    <b>Informasi Pasien</b>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>Usia : &nbsp;&nbsp;<b>$a1</b></li>
    <li class='list-group-item'>Jenis Kelamin : &nbsp;&nbsp;<b>$a2</b></li>
    <li class='list-group-item'>Ciri Keringat : &nbsp;&nbsp;<b>$a3</b></li>
    <li class='list-group-item'>Ciri Batuk : &nbsp;&nbsp;<b>$a4</b></li>
    <li class='list-group-item'>Kondisi Tubuh : &nbsp;&nbsp;<b>$a5</b></li>
  </ul>
</div><br>
<hr>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th>Jumlah Positif</th>
    <th>Jumlah Negatif</th>
    <th>Jumlah Total Data</th>
  </tr>
  <tr>
    <td>$jumTrue</td>
    <td>$jumFalse</td>
    <td>$jumData</td>
  </tr>
</table>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th></th>
    <th>Positif</th>
    <th>Negatif</th>
  </tr>
  <tr>
    <td>pA</td>
    <td>$jumTrue / $jumData</td>
    <td>$jumFalse / $jumData</td>
  </tr>
  <tr>
    <td>Usia</td>
    <td>$Usia / $jumTrue</td>
    <td>$Usia2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>$kelamin / $jumTrue</td>
    <td>$kelamin2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Ciri Keringat</td>
    <td>$keringat / $jumTrue</td>
    <td>$keringat2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Ciri Batuk</td>
    <td>$batuk / $jumTrue</td>
    <td>$batuk2 / $jumFalse</td>
  </tr>
  <tr>
    <td>Kondisi Tubuh</td>
    <td>$kondisi / $jumTrue</td>
    <td>$kondisi2 / $jumFalse</td>
  </tr>
</table>
";

echo "<br>
  <table class='table table-bordered' style='font-size:18px;text-align:center;'>
    <tr style='background-color:#17a2b8;color:#fff'>
      <th>Presentasi Positif</th>
      <th>Presentasi Negatif</th>
    </tr>
    <tr>
      <td>$paT</td>
      <td>$paF</td>
    </tr>
  </table>
";

$result = $obj->perbandingan($paT, $paF);

if ($paT > $paF) {
  echo "<br>
  <h3 class='tebal'>PRESENTASI <span class='badge badge-danger' style='padding:10px'><b>POSITIF</b></span> LEBIH BESAR DARI PADA PRESENTASI NEGATIF</h3><br>";
  echo "<h4><br>Presentasi positif sebanyak : <b>" . round($result[1], 2) . " %</b> <br>Presentasi negatif sebanyak : <b>" . round($result[2], 2) . " % </b></h4>";
} else if ($paF > $paT) {
  echo "<br>
  <h3 class='tebal'>PRESENTASI <span class='badge badge-success' style='padding:10px'><b>NEGATIF</b></span> LEBIH BESAR DARI PADA PRESENTASI POSITIF</h3><br>";
  echo "<h4><br>Presentasi negatif sebanyak : <b>" . round($result[1], 2) . " %</b> <br>Presentasi positif sebanyak : <b>" . round($result[2], 2) . " % </b></h4>";
}


if ($result[0] == "Positif TBC") {
  echo "
  <div class='alert alert-danger mt-5' role='aler'>
    <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
    <p>Maaf, berdasarkan hasil prediksi , anda dinyatakan <b>Positif TBC!</b></p>
    <hr>
    <p class='mb-0'>- Silakan Merujuk ke Rumah Sakit Terdekat -</p>
  </div>";
} else {
  echo "
  <div class='alert alert-success mt-5' role='aler'>
  <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
  <p>Selamat ! berdasarkan hasil prediksi , anda dinyatakan <b>Negatif TBC!</p>
  <hr>
  <p class='mb-0'>- Semoga Selalu Sehat -</p>
  </div>";
}
