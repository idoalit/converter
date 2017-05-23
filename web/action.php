<?php
/**
 * ----------------------------------------------------------------------
 * @Author                : ido_alit
 * @Date                  : 2017-03-21 03:50:43
 * @Last Modified by      : ido_alit
 * @Last Modified time    : 2017-03-21 08:49:55
 * ----------------------------------------------------------------------
 */

require "../vendor/autoload.php";
require "../konversi.lib.php";
require "../koneksi.php";

use Slims\Persneling\Bibliography\Collection as C;

if (isset($_GET['sampledata'])) {
  $_return = array();
  $_return['sampledata'] = Konversi::getSampleData('../csv/' . $_GET['sampledata']);
  $_return['table'] = Konversi::getTables($dbs);
  echo json_encode($_return);
}

if (isset($_GET['kolom'])) {
  $_return = array();
  $_return['kolom'] = Konversi::getColumn($dbs, trim($_GET['kolom']));
  echo json_encode($_return);
}

if (isset($_POST['konversikan'])) {

  $file = '../csv/' . $_POST['file-csv'];

  $length = 1024;

  $n = 1;
  if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, $length, ",")) !== FALSE) {
      $authors = array();
      $subject = array();
      $items   = array();
      $num = count($data);
      $koleksi = new C;
      $imported_data = $koleksi->collection_load();

      $strData = NULL;
      foreach ($_POST as $key => $value) {
        $index = str_replace('sc-', '', $key);
        if (isset($data[$index])) {
          $strData = trim($data[$index]);
        }
        if ($value == 'title') {
          $imported_data->title = $strData;
        }
        if ($value == 'author_name') {
          $imported_data->sor = $strData;
          $authors[] = $strData;
        }
        if ($value == 'gmd_name') {
          $imported_data->gmd_name = $strData;
        }
        if ($value == 'edition') {
          $imported_data->edition = $strData;
        }
        if ($value == 'isbn_issn') {
          $imported_data->isbn_issn = $strData;
        }
        if ($value == 'publisher_name') {
          $imported_data->publisher_name = $strData;
        }
        if ($value == 'publish_year') {
          $imported_data->publish_year = $strData;
        }
        if ($value == 'collation') {
          $imported_data->collation = $strData;
        }
        if ($value == 'series_title') {
          $imported_data->series_title = $strData;
        }
        if ($value == 'call_number') {
          $imported_data->call_number = $strData;
        }
        if ($value == 'source') {
          $imported_data->source = $strData;
        }      if ($value == 'mst_place:place_name') {
          $imported_data->place = $strData;
        }
        if ($value == 'classification') {
          $imported_data->classification = $strData;
        }
        if ($value == 'notes') {
          $imported_data->notes = $strData;
        }
        if ($value == 'image') {
          $imported_data->image = $strData;
        }
        if ($value == 'spec_detail_info') {
          $imported_data->spec_detail_info = $strData;
        }
        if ($value == 'item_code') {
          $items[$n]['item_code'] = $strData;
        }
        if ($value == 'call_number') {
          $items[$n]['call_number'] = $strData;
        }
        if ($value == 'coll_type_name') {
          $items[$n]['coll_type_name'] = $strData;
        }
        if ($value == 'inventory_code') {
          $items[$n]['inventory_code'] = $strData;
        }
        if ($value == 'received_date') {
          $items[$n]['received_date'] = $strData;
        }
        if ($value == 'supplier_name') {
          $items[$n]['supplier_name'] = $strData;
        }
        if ($value == 'order_no') {
          $items[$n]['order_no'] = $strData;
        }
        if ($value == 'location_name') {
          $items[$n]['location_name'] = $strData;
        }
        if ($value == 'order_date') {
          $items[$n]['order_date'] = $strData;
        }
        if ($value == 'item_status') {
          $items[$n]['item_status'] = $strData;
        }
        if ($value == 'site') {
          $items[$n]['site'] = $strData;
        }
        if ($value == 'source') {
          $items[$n]['source'] = $strData;
        }
        if ($value == 'invoice') {
          $items[$n]['invoice'] = $strData;
        }
        if ($value == 'price') {
          $items[$n]['price'] = $strData;
        }
        if ($value == 'price_currency') {
          $items[$n]['price_currency'] = $strData;
        }
        if ($value == 'invoice_date') {
          $items[$n]['invoice_date'] = $strData;
        }
        if ($value == 'input_date') {
          $items[$n]['input_date'] = $strData;
        }
        if ($value == 'last_update') {
          $items[$n]['last_update'] = $strData;
        }
        if ($value == 'topic') {
          $subject[] = $strData;
        }
      }

      $imported_data->uid = '1';

      // authors
      if ( ( (!empty($authors)) OR (!is_null($authors)) ) AND ($authors != '') ) {
        foreach ($authors as $k => $v) {
          $imported_data->authors[$k]['name'] = trim($v);
          #$imported_data->authors[$k]['authority_type'] = 'p'; // 'p', 'o', 'c'
          #$imported_data->authors[$k]['authority_level'] = '1'; // '1', '2', '3' ... '10'
        }
      }

      // subject
      if ( ( (!empty($subject)) OR (!is_null($subject)) ) AND ($subject != '') ) {
        foreach ($subject as $k => $v) {
          $imported_data->subjects[$k]['name'] = trim($v);
        }
      }

      // items
      if ( ( (!empty($items)) OR (!is_null($items)) ) AND ($items != '') ) {
        foreach ($items as $k => $v) {
          $imported_data->items[$k]['item_code'] = isset($v['item_code']) ? trim($v['item_code']) : '';
          $imported_data->items[$k]['call_number'] = isset($v['call_number']) ? trim($v['call_number']) : '';
          $imported_data->items[$k]['coll_type_name'] = isset($v['coll_type_name']) ? trim($v['coll_type_name']) : '';
          $imported_data->items[$k]['inventory_code'] = isset($v['inventory_code']) ? trim($v['inventory_code']) : '';
          $imported_data->items[$k]['received_date'] = isset($v['received_date']) ? trim($v['received_date']) : '';
          $imported_data->items[$k]['supplier_name'] = isset($v['supplier_name']) ? trim($v['supplier_name']) : '';
          $imported_data->items[$k]['order_no'] = isset($v['order_no']) ? trim($v['order_no']) : '';
          $imported_data->items[$k]['location_name'] = isset($v['location_name']) ? trim($v['location_name']) : '';
          $imported_data->items[$k]['order_date'] = isset($v['order_date']) ? trim($v['order_date']) : '';
          $imported_data->items[$k]['item_status'] = isset($v['item_status']) ? trim($v['item_status']) : '';
          $imported_data->items[$k]['site'] = isset($v['site']) ? trim($v['site']) : '';
          $imported_data->items[$k]['source'] = isset($v['source']) ? trim($v['source']) : '';
          $imported_data->items[$k]['invoice'] = isset($v['invoice']) ? trim($v['invoice']) : '';
          $imported_data->items[$k]['price'] = isset($v['price']) ? trim($v['price']) : '';
          $imported_data->items[$k]['price_currency'] = isset($v['price_currency']) ? trim($v['price_currency']) : '';
          $imported_data->items[$k]['invoice_date'] = isset($v['invoice_date']) ? trim($v['invoice_date']) : '';
          $imported_data->items[$k]['input_date'] = isset($v['input_date']) ? trim($v['input_date']) : '';
          $imported_data->items[$k]['last_update'] = isset($v['last_update']) ? trim($v['last_update']) : '';
          $imported_data->items[$k]['uid'] = isset($v['uid']) ? trim($v['uid']) : '';
        }
      }

      if ($n === 1 || $imported_data->title === '') {
        $n++;
        continue;
      }

      $koleksi->collection_save($dbs, $imported_data);
      $n++;
    }

    fclose($handle);

    echo $n . ' data berhasil dikonversi. lanjut file yang lain mas.';
  } else {
    echo 'aduh, gak iso mbuka file: ' . $file;
  }
}
