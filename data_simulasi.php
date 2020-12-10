<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="img/nbc.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- font awsome -->
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />

  <link rel="stylesheet" href="css/gaya.css">

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/datatables.css">

  <title>DATA SIMULASI</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="img/nbc.png" alt="" width=50 height=50>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Naive Bayes</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="data_simulasi.php">Data Latih <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" style='margin-top:90px'>
    <div class="row">
      <div class="col-12 mt-5">
        <h2 class="tebal">List Data Latih</h2><br>
        <p class="desc">Berikut ini adalah data latih yang kami gunakan dalam membuat simulasi kemungkinan seseorang menderita TBC menggunakan metode naive bayes.</p><br>

        <table id="dataLatih" class="display pt-3 mb-3">
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Usia</th>
              <th rowspan="2">Jenis Kelamin</th>
              <th colspan="3" style="text-align: center;">Ciri-Ciri</th>
              <th rowspan="2">Status</th>
            </tr>
            <tr>
              <th>Keringat</th>
              <th>Batuk</th>
              <th>Kondisi Tubuh</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $data = 'dataTBC.json';
            $json = file_get_contents($data);
            $hasil = json_decode($json, true);

            $no = 1;
            foreach ($hasil as $hasil) {

              if ($hasil['TBC'] == 1) {
                $stt = "Positif TBC";
              } else {
                $stt = "Negatif TBC";
              }
            ?>

              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $hasil['Usia']; ?></td>
                <td><?php echo $hasil['Jenis Kelamin']; ?></td>
                <td><?php echo $hasil['Keringat']; ?></td>
                <td><?php echo $hasil['Batuk']; ?></td>
                <td><?php echo $hasil['Kondisi Tubuh']; ?></td>
                <td><?php
                    if ($stt == "Positif TBC") {
                      echo "<span class='badge badge-danger' style='padding:10px'>Positif TBC</span>";
                    } else {
                      echo "<span class='badge badge-success' style='padding:10px'>Negatif TBC</span>";
                    }
                    ?></td>
              </tr>

            <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- Footer -->
  <footer class="page-footer font-small abu1 mt-5">

    <!-- Footer Elements -->
    <div class="container">

      <!-- Grid row-->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-12 py-5">

          <div class="text-center">
            Naive Bayes TBC
          </div>
        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 abu2">© <?php echo date('Y'); ?> Copyright Bagus Abu Denny
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->


  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/datatables.js"></script>

  <!-- validasi -->
  <script>
    $(document).ready(function() {
      $('.toggle').click(function() {
        $('ul').toggleClass('active');
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#dataLatih').dataTable({
        "pageLength": 50
      });
    });
  </script>

</body>

</html>