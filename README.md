BACASAYA
========

Apa itu Persneling?
--------------------

Persneling adalah API for SLiMS (slims.web.id). Proyek hobi, sepertinya ga bakal serius. Tools ini saya buat untuk kebutuhan sederhana, memudahkan konversi data ke SLiMS. API ini masih sederhana, baru bisa input baru, belum bisa edit data. Cara penggunaanya sederhana, seperti dibawah ini:


```
<?php 
require "vendor/autoload.php";

$dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'dbusername', 'dbuserpassword');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

use Slims\Persneling\Bibliography\Collection as C;
$koleksi = new C;
$data = $koleksi->collection_load();
$data->title = 'PHP for librarian';
$data->sor = 'Hendro Wicaksono';
$data->gmd_name = 'Tesis';
$data->edition = '2nd ed.';
$data->isbn_issn = '123-456-789-0';
$data->publisher_name = 'Pustaka Erlangga';
$data->publish_year = '2016';
$data->collation = 'xii, 500 p. ill.';
$data->series_title = 'Seri cepat kaya melalui internet';
$data->call_number = '330.05 AWK i';
$data->source = 'source disini';
$data->place = 'Jakarta';
$data->classification = '330.05';
$data->notes = 'Disini adalah catatan alias notes.';
$data->spec_detail_info = 'spec_detail_info disini';
$data->uid = '1';
$data->authors[0]['name'] = 'Hendro Wicaksono';
$data->authors[1]['name'] = 'Dian Tirtha Kusuma';
$data->subjects[0]['name'] = 'Fisika';
$data->subjects[1]['name'] = 'Perpustakaan';
$data->items[0]['item_code'] = 'B000000001';
$data->items[0]['coll_type_name'] = 'AV';
$data->items[0]['site'] = 'Rak 1';
$data->items[1]['item_code'] = 'B000000002';
$data->items[1]['coll_type_name'] = 'AVR';
$data->items[1]['site'] = 'Rak 2';
$data->items[2]['item_code'] = 'B000000003';
$data->items[2]['coll_type_name'] = 'Tandon';
$data->items[2]['site'] = 'Rak 3';
$koleksi->collection_save($dbs, $data);
```
Done, data sudah masuk ke SLiMS. Silahkan mencoba.