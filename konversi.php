<?php 
require "vendor/autoload.php";
$dbs = new PDO('mysql:host=localhost; dbname=dbname; charset=utf8mb4', 'dbusername', 'dbpassword');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
use Slims\Persneling\Bibliography\Collection as C;

if (($handle = fopen("contoh_data_konversi.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
    $num = count($data);
    echo '0 --> '.$data[0].'<br />';
    echo '1 --> '.$data[1].'<br />';
    echo '2 --> '.$data[2].'<br />';
    echo '3 --> '.$data[3].'<br />';
    echo '4 --> '.$data[4].'<br />';
    echo '5 --> '.$data[5].'<br />';
    echo '6 --> '.$data[6].'<br />';
    echo '7 --> '.$data[7].'<br />';
    echo '8 --> '.$data[8].'<br />';
    echo '9 --> '.$data[9].'<br />';
    echo '10 --> '.$data[10].'<br />';
    echo '11 --> '.$data[11].'<br />';
    echo '12 --> '.$data[12].'<br />';
    echo '13 --> '.$data[13].'<br />';
    echo '14 --> '.$data[14].'<br />';
    echo '15 --> '.$data[15].'<br />';
    echo '16 --> '.$data[16].'<br />';
    echo '<hr />';
    $koleksi = new C;
    $imported_data = $koleksi->collection_load();
    $imported_data->title = $data[0];
    $imported_data->sor = $data[14];
    $imported_data->gmd_name = $data[1];
    $imported_data->edition = $data[2];
    $imported_data->isbn_issn = $data[3];
    $imported_data->publisher_name = $data[4];
    $imported_data->publish_year = $data[5];
    $imported_data->collation = $data[6];
    $imported_data->series_title = $data[7];
    $imported_data->call_number = $data[8];
    $imported_data->source = NULL;
    $imported_data->place = $data[10];
    $imported_data->classification = $data[11];
    $imported_data->notes = $data[12];
    $imported_data->image = $data[13];
    $imported_data->spec_detail_info = NULL;
    $imported_data->uid = '1';

    $data[14] = trim($data[14]);
    if ( ( (!empty($data[14])) OR (!is_null($data[14])) ) AND ($data[14] != '') ) {
      $_authors = explode(';', $data[14]);
      foreach ($_authors as $k => $v) {
        $imported_data->authors[$k]['name'] = trim($v);
        #$imported_data->authors[$k]['authority_type'] = 'p'; // 'p', 'o', 'c'
        #$imported_data->authors[$k]['authority_level'] = '1'; // '1', '2', '3' ... '10'
      }
    }

    $data[15] = trim($data[15]);
    if ( ( (!empty($data[15])) OR (!is_null($data[15])) ) AND ($data[15] != '') ) {
      $_subjects = explode(';', $data[15]);
      foreach ($_subjects as $k => $v) {
        $imported_data->subjects[$k]['name'] = trim($v);
      }
    }

    $data[16] = trim($data[16]);
    if ( ( (!empty($data[16])) OR (!is_null($data[16])) ) AND ($data[16] != '') ) {
      $_items = explode(';', $data[16]);
      foreach ($_items as $k => $v) {
        $imported_data->items[$k]['item_code'] = trim($v);
      }
    }

    echo '<pre>';
    var_dump($imported_data);
    echo '</pre>';
    echo '<hr />';

    $koleksi->collection_save($dbs, $imported_data);

  }
  fclose($handle);
}
