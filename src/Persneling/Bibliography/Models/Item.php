<?php
namespace Slims\Persneling\Bibliography\Models;
use Slims\Persneling\Masterfile\Models\Colltype as Colltype;
use Slims\Persneling\Masterfile\Models\Supplier as Supplier;
use Slims\Persneling\Masterfile\Models\Location as Location;
use Slims\Persneling\Masterfile\Models\Itemstatus as Itemstatus;

class Item
{
  public $item_id = NULL;
  public $item_code = NULL;

  public function __construct()
  {
  }

  public function set_itemId($value)
  {
    $this->item_id = $value;
  }

  public function set_itemCode($value)
  {
    $this->item_code = $value;
  }


  public function get_itemId()
  {
    return $this->item_id;
  }

  public function get_itemCode()
  {
    return $this->item_code;
  }

  public function testing()
  {
    return TRUE;
  }

  public function countItem($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM item';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    foreach ($res as $key => $value) {
      $counter = $value;
    }
    if ($counter > 0) {
      return $counter;
    } else {
      return FALSE;
    }
  }


  public function showItemList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM item';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createItem($dbs, $item, $biblio_id)
  {

    $is_exist = $this->countItem($dbs, 'WHERE item_code=\''.$item['item_code'].'\'');
    if (!$is_exist) {

      $call_number = NULL;
      if (empty($item['call_number'])) {
        $call_number = NULL;
      } else {
        if (trim($item['call_number']) != '') {
          $call_number = addslashes($item['call_number']);
        } else {
          $call_number = NULL;
        }
      }

      $is_ctm_exist = FALSE;
      if (!empty($item['coll_type_name'])) {
        $is_ctm_exist = TRUE;
      }
      if (!is_null($item['coll_type_name'])) {
        $is_ctm_exist = TRUE;
      }
      if (trim($item['coll_type_name']) != '') {
        $is_ctm_exist = TRUE;
      }
      $coll_type_id = NULL;
      if ($is_ctm_exist) {
        $colltype = new Colltype;
        $coll_type_id = $colltype->fgetCollTypeIdByName($dbs, $item['coll_type_name']);
      }

      $inventory_code = NULL;
      if (empty($item['inventory_code'])) {
        $inventory_code = NULL;
      } else {
        if (trim($item['inventory_code']) != '') {
          $inventory_code = addslashes($item['inventory_code']);
        } else {
          $inventory_code = NULL;
        }
      }

      $received_date = NULL;
      if (empty($item['received_date'])) {
        $received_date = NULL;
      } else {
        if (trim($item['received_date']) != '') {
          $received_date = addslashes($item['received_date']);
        } else {
          $received_date = NULL;
        }
      }

      $is_supplier_exist = FALSE;
      if (!empty($item['supplier_name'])) {
        $is_supplier_exist = TRUE;
      }
      if (!is_null($item['supplier_name'])) {
        $is_supplier_exist = TRUE;
      }
      if (trim($item['supplier_name']) != '') {
        $is_supplier_exist = TRUE;
      }
      $supplier_id = NULL;
      if ($is_supplier_exist) {
        $supplier = new Supplier;
        $supplier_id = $supplier->fgetSupplierIdByName($dbs, $item['supplier_name']);
      }

      $order_no = NULL;
      if (empty($item['order_no'])) {
        $order_no = NULL;
      } else {
        if (trim($item['order_no']) != '') {
          $order_no = addslashes($item['order_no']);
        } else {
          $order_no = NULL;
        }
      }

      $is_location_exist = FALSE;
      if (!empty($item['location_name'])) {
        $is_location_exist = TRUE;
      }
      if (!is_null($item['location_name'])) {
        $is_location_exist = TRUE;
      }
      if (trim($item['location_name']) != '') {
        $is_location_exist = TRUE;
      }
      $location_id = NULL;
      if ($is_location_exist) {
        $location = new Location;
        $location_id = $location->fgetLocationIdByName($dbs, $item['location_name']);
      }

      $order_date = NULL;
      if (empty($item['order_date'])) {
        $order_date = NULL;
      } else {
        if (trim($item['order_date']) != '') {
          $order_date = addslashes($item['order_date']);
        } else {
          $order_date = NULL;
        }
      }

      $is_itemstatus_exist = FALSE;
      if (!empty($item['item_status'])) {
        $is_itemstatus_exist = TRUE;
      }
      if (!is_null($item['item_status'])) {
        $is_itemstatus_exist = TRUE;
      }
      if (trim($item['item_status']) != '') {
        $is_itemstatus_exist = TRUE;
      }
      $item_status_id = NULL;
      if ($is_itemstatus_exist) {
        $item_status = new Itemstatus;
        $item_status_id = $item_status->fgetItemStatusIdByName($dbs, $item['item_status']);
      }

      $site = NULL;
      if (empty($item['site'])) {
        $site = NULL;
      } else {
        if (trim($item['site']) != '') {
          $site = addslashes($item['site']);
        } else {
          $site = NULL;
        }
      }

      $source = 0;
      if (empty($item['source'])) {
        $source = 0;
      } else {
        if (trim($item['source']) != '') {
          if ($item['source'] == 'Buy') {
            $source = 1;
          } elseif($item['source'] == 'Prize') {
            $source = 2;
          }
        } else {
          $order_date = 0;
        }
      }

      $invoice = NULL;
      if (empty($item['invoice'])) {
        $invoice = NULL;
      } else {
        if (trim($item['invoice']) != '') {
          $invoice = addslashes($item['invoice']);
        } else {
          $invoice = NULL;
        }
      }

      $price = NULL;
      if (empty($item['price'])) {
        $price = NULL;
      } else {
        if (trim($item['price']) != '') {
          $price = addslashes($item['price']);
        } else {
          $price = NULL;
        }
      }

      $price_currency = NULL;
      if (empty($item['price_currency'])) {
        $price_currency = NULL;
      } else {
        if (trim($item['price_currency']) != '') {
          $price_currency = addslashes($item['price_currency']);
        } else {
          $price_currency = NULL;
        }
      }

      $invoice_date = NULL;
      if (empty($item['invoice_date'])) {
        $invoice_date = NULL;
      } else {
        if (trim($item['invoice_date']) != '') {
          $invoice_date = addslashes($item['invoice_date']);
        } else {
          $invoice_date = NULL;
        }
      }

      $input_date = NULL;
      if (empty($item['input_date'])) {
        $input_date = NULL;
      } else {
        if (trim($item['input_date']) != '') {
          $input_date = addslashes($item['input_date']);
        } else {
          $input_date = NULL;
        }
      }

      $last_update = NULL;
      if (empty($item['last_update'])) {
        $last_update = NULL;
      } else {
        if (trim($item['last_update']) != '') {
          $last_update = addslashes($item['last_update']);
        } else {
          $last_update = NULL;
        }
      }

      $uid = 1;
      if (empty($item['uid'])) {
        $uid = 1;
      } else {
        if (trim($item['uid']) != '') {
          $uid = addslashes($item['uid']);
        } else {
          $uid = 1;
        }
      }

      $s_sitem = 'REPLACE INTO item ';
      $s_sitem .= '(item_id, biblio_id, call_number, item_code, ';
      $s_sitem .= 'coll_type_id, inventory_code, received_date, ';
      $s_sitem .= 'supplier_id, order_no, location_id, order_date, ';
      $s_sitem .= 'item_status_id, site, source, invoice, price, ';
      $s_sitem .= 'price_currency, invoice_date, input_date, ';
      $s_sitem .= 'last_update, uid) ';
      $s_sitem .= 'VALUES ';
      $s_sitem .= '(NULL, \''.$biblio_id.'\', \''.$call_number.'\', \''.$item['item_code'].'\', ';
      $s_sitem .= '\''.$coll_type_id.'\', \''.$inventory_code.'\', \''.$received_date.'\', ';
      $s_sitem .= '\''.$supplier_id.'\', \''.$order_no.'\', \''.$location_id.'\', \''.$order_date.'\', ';
      $s_sitem .= ' \''.$item_status_id.'\', \''.$site.'\', \''.$source.'\', \''.$invoice.'\', \''.$price.'\', ';
      $s_sitem .= '\''.$price_currency.'\', \''.$invoice_date.'\', \''.$input_date.'\', ';
      $s_sitem .= '\''.$last_update.'\', \''.$uid.'\')';
      $q_sitem = $dbs->query($s_sitem);
      $item_id = $dbs->lastInsertId();
      return $item_id;
    } else {
      return FALSE;
    }
  }

  public function getItemIdByItemcode($dbs, $item_code)
  {
    $sql = 'SELECT * FROM item WHERE item_code=\''.$item_code.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['item_id'];
    }
  }

  public function fgetItemIdByItemcode($dbs, $item=array(), $biblio_id)
  {
    if (!empty($item['item_code'])) {
      $sql = 'SELECT * FROM item WHERE item_code=\''.$item['item_code'].'\'';
      $stm = $dbs->query($sql);
      $res = $stm->fetch(\PDO::FETCH_ASSOC);
      if (empty($res)) {
      return $this->createItem($dbs, $item, $biblio_id);
      } else {
        return $res['item_id'];
      }
    }
  }

  public function getItemsListByBiblioId($dbs, $biblio_id)
  {
    $items = array();
    $sItem = 'SELECT i.*, ct.* ';
    $sItem .= 'FROM item AS i, mst_coll_type AS ct ';
    $sItem .= 'WHERE ';
    $sItem .= 'biblio_id=\''.$biblio_id.'\' ';
    $sItem .= 'AND i.coll_type_id=ct.coll_type_id';

    $qItem = $dbs->query($sItem);
    if ($qItem->rowCount() > 0) {
      $rItem = $qItem->fetchAll(\PDO::FETCH_ASSOC);
      foreach ($rItem as $key => $value) {
        $items[$key]['item_code'] = $value['item_code'];
        $items[$key]['coll_type_name'] = $value['coll_type_name'];
        $items[$key]['site'] = $value['site'];
      }
    }
    return $items;
  }

  public function removeItemById($dbs, $biblio_id)
  {
    if (is_numeric($biblio_id)) {
      $s_rite = 'DELETE FROM item WHERE biblio_id=\''.$biblio_id.'\'';
      $q_rite = $dbs->query($s_rite);
    }
  }


}
