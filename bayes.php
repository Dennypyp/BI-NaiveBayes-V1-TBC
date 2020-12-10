<?php
class Bayes
{
  private $pasien = "dataTBC.json";
  // private $jumTrue = 0;
  // private $jumFalse = 0;
  // private $jumData = 0;

  function __construct()
  {
  }

  /*================================================================
  FUNCTION SUM TRUE DAN FALSE
  =================================================================*/
  function sumTrue()
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['TBC'] == 1) {
        $t += 1;
      }
    }

    return $t;
  }

  function sumFalse()
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['TBC'] == 0) {
        $t += 1;
      }
    }
    return $t;
  }

  function sumData()
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);
    return count($hasil);
  }

  //=================================================================

  /*================================================================
  FUNCTION PROBABILITAS
  =================================================================*/
  function probUsia($usia, $status)
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['Usia'] == $usia && $hasil['TBC'] == $status) {
        $t += 1;
      } else if ($hasil['Usia'] == $usia && $hasil['TBC'] == $status) {
        $t += 1;
      }
    }
    return $t;
  }

  function probKelamin($kelamin, $status)
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['Jenis Kelamin'] == $kelamin && $hasil['TBC'] == $status) {
        $t += 1;
      } else if ($hasil['Jenis Kelamin'] == $kelamin && $hasil['TBC'] == $status) {
        $t += 1;
      }
    }
    return $t;
  }

  function probKeringat($keringat, $status)
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['Keringat'] == $keringat && $hasil['TBC'] == $status) {
        $t += 1;
      } else if ($hasil['Keringat'] == $keringat && $hasil['TBC'] == $status) {
        $t += 1;
      }
    }
    return $t;
  }

  function probBatuk($batuk, $status)
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['Batuk'] == $batuk && $hasil['TBC'] == $status) {
        $t += 1;
      } else if ($hasil['Batuk'] == $batuk && $hasil['TBC'] == $status) {
        $t += 1;
      }
    }
    return $t;
  }

  function probKondisi($kondisi, $status)
  {
    $data = file_get_contents($this->pasien);
    $hasil = json_decode($data, true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if ($hasil['Kondisi Tubuh'] == $kondisi && $hasil['TBC'] == $status) {
        $t += 1;
      } else if ($hasil['Kondisi Tubuh'] == $kondisi && $hasil['TBC'] == $status) {
        $t += 1;
      }
    }
    return $t;
  }
  //=================================================================

  /*=================================================================
  MARI BERHITUNG
  keterangan parameter :
  $sT   : jumlah data yang bernilai true ( sumTrue )
  $sF   : jumlah data yang bernilai false ( sumFalse )
  $sD   : jumlah data pada data latih ( sumData )
  $pU   : jumlah probabilitas usia ( probUsia )
  $pT   : jumlah probabilitas kelamin ( probKelamin )
  $pBB  : jumlah probabilitas Keringat ( probBB )
  $pK   : jumlah probabilitas Batuk ( probBatuk )
  $pP   : jumlah probabilitas Kondisi (probKondisi )
  ==================================================================*/

  function hasilTrue($sT = 0, $sD = 0, $pU = 0, $pT = 0, $pBB = 0, $pK = 0, $pP = 0)
  {
    $paTrue = $sT / $sD;
    $p1 = $pU / $sT;
    $p2 = $pT / $sT;
    $p3 = $pBB / $sT;
    $p4 = $pK / $sT;
    $p5 = $pP / $sT;
    $hsl = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function hasilFalse($sF = 0, $sD = 0, $pU = 0, $pT = 0, $pBB = 0, $pK = 0, $pP = 0)
  {
    $paFalse = $sF / $sD;
    $p1 = $pU / $sF;
    $p2 = $pT / $sF;
    $p3 = $pBB / $sF;
    $p4 = $pK / $sF;
    $p5 = $pP / $sF;
    $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function perbandingan($pATrue, $pAFalse)
  {
    if ($pATrue > $pAFalse) {
      $stt = "Positif TBC";
      $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
      $diterima = 100 - $hitung;
    } elseif ($pAFalse > $pATrue) {
      $stt = "Negatif TBC";
      $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
      $diterima = 100 - $hitung;
    }

    $hsl = array($stt, $hitung, $diterima);
    return $hsl;
  }
  //=================================================================
}
