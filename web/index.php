<?php
/**
 * ----------------------------------------------------------------------
 * @Author                : ido_alit
 * @Date                  : 2017-03-21 02:58:05
 * @Last Modified by      : ido_alit
 * @Last Modified time    : 2017-03-21 07:56:08
 * ----------------------------------------------------------------------
 */

require "../vendor/autoload.php";
require "../konversi.lib.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Konversi</title>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="page-header">
      <h1>Alat konversi <small>dari csv ke database SLiMS pakek persneling</small></h1>
    </div>
    <div class="row">
      <form action="action.php" id="s-form">
        <input type="hidden" name="konversikan" value="true">
        <div class="col-md-8">
          <div class="form-group">
            <label for="pilihfile">Pilih file yang akan dikonversi</label>
            <select name="file-csv" class="form-control" id="pilihfile">
              <option value="">-- pilih file --</option>
              <?php 
              $files = Konversi::getCsvFiles();
              foreach ($files as $file) {
                echo '<option value="'.$file.'">'.$file.'</option>';
              }
              ?>
            </select>
          </div>
          <div id="sampledata-wrap" class="hide">
            <h3>Sesuaikan field</h3>
            <div class="row">
              <div class="col-md-12" id="fields"></div>
            </div>
            <br>
            <button type="submit" id="hancurkan" class="btn btn-danger">Hancurkaaaannnnn........!!!</button>
          </div>
        </div>
      </form>
      <div class="col-md-4">
        <ul class="class="list-group"">
            <li class="list-group-item list-group-item-info">Siapkan database SLiMS kosong (tidak ada data buku tapi ada data tabel-tabel) buat menampung data hasil konversi.</li>
            <li class="list-group-item list-group-item-info">Lakukan konfigurasi database di file config.php</li>
            <li class="list-group-item list-group-item-info">Letakan file csv yang akan dikonversi ke dalam folder csv</li>
            <li class="list-group-item list-group-item-info">Pilih file yang akan dikonversi</li>
            <li class="list-group-item list-group-item-info">Sesuaikan setiap file dengan data yang ada pada database SLiMS</li>
            <li class="list-group-item list-group-item-danger">HANCURKAN!</li>
          </ul>
      </div>
    </div>
    <hr>
  </div>

  <!-- my sqcript -->
  <script type="text/javascript" src="js/myscript.js"></script>
</body>
</html>