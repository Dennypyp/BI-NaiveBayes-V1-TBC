<?php
require_once 'autoload.php';

$obj = new Bayes();

// echo $obj->sumData()."<br>";
// echo $obj->sumTrue()."<br>";
// echo $obj->sumFalse()."<br>";
// echo $obj->probUsia(21,0)."<br>";

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = "Muda";
$a2 = "Pria";
$a3 = "Tak Berkeringat";
$a4 = "Tidak Batuk";
$a5 = "Normal";

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

echo "
======================================<br>
Usia : $a1<br>
Jenis Kelamin : $a2<br>
Keringat : $a3<br>
Batuk : $a4<br>
Kondisi : $a5<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan true : <br>
jumlah true : $jumTrue <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan false : <br>
jumlah false : $jumFalse <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pATrue : $jumTrue / $jumData<br>
Usia true : $Usia / $jumTrue <br>
kelamin true : $kelamin / $jumTrue <br>
Keringat true : $keringat / $jumTrue <br>
Batuk true : $batuk / $jumTrue <br>
Kondisi true : $kondisi / $jumTrue <br><br>
=======================================<br><br>
";

echo "
======================================<br>
pAFalse : $jumFalse / $jumData<br>
Usia false : $Usia2 / $jumFalse <br>
kelamin false : $kelamin2 / $jumFalse <br>
Keringat false : $keringat2 / $jumFalse <br>
Batuk false : $batuk2 / $jumFalse <br>
Kondisi false : $kondisi2 / $jumFalse <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi yes : $paT<br>
presentasi no : $paF<br>
=======================================<br><br>
";

if ($paT > $paF) {
  echo "
  ======================================<br>
  PRESENTASI YES LEBIH BESAR DARI PADA PRESENTASI NO<br>
  =======================================
  <br><br>";
} else if ($paF > $paT) {
  echo "
  ======================================<br>
  PRESENTASI NO LEBIH BESAR DARI PADA PRESENTASI YES<br>
  =======================================
  <br><br>";
}

// echo $obj->hasilTrue($jumTrue,$jumData,$Usia,$kelamin,$keringat,$batuk,$kondisi)."<br>";
// echo $obj->hasilFalse($jumTrue,$jumData,$Usia2,$kelamin2,$keringat2,$batuk2,$kondisi2)."<br><br>";

$result = $obj->perbandingan($paT, $paF);
echo " Status : $result[0] <br>Presentasi diterima sebanyak : " . round($result[1], 2) . " % <br>Presentasi diolak sebanyak : " . round($result[2], 2) . " % ";
