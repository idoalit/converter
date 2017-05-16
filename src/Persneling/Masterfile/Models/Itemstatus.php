<?php
namespace Slims\Persneling\Masterfile\Models;

class Itemstatus
{
  public $item_status_id = NULL;
  public $item_status_name = NULL;

  public function __construct()
  {
  }

  public function set_itemStatusId($value)
  {
    $this->item_status_id = $value;
  }

  public function set_itemStatusName($value)
  {
    $this->item_status_name = $value;
  }

  public function get_itemStatusId()
  {
    return $this->item_status_id;
  }

  public function get_itemStatusName()
  {
    return $this->item_status_name;
  }

  public function countItemStatus($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_item_status';
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

  public function showItemStatusList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_item_status';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createItemStatus($dbs, $item_status_name)
  {
    $item_status_name = addslashes($item_status_name);
    $is_exist = $this->countItemStatus($dbs, 'WHERE item_status_name=\''.$item_status_name.'\'');
    if (!$is_exist) {
      $item_status_id = rand(10,100);
      $s_sitemstatus = 'INSERT INTO mst_item_status (item_status_id, item_status_name) VALUES (\''.$item_status_id.'\',\''.$item_status_name.'\')';
      $q_sitemstatus = $dbs->query($s_sitemstatus);
      return $item_status_id;
    } else {
      return FALSE;
    }
  }

  public function getItemStatusIdByName($dbs, $item_status_name)
  {
    $item_status_name = addslashes($item_status_name);
    $sql = 'SELECT * FROM mst_item_status WHERE item_status_name=\''.$item_status_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['item_status_id'];
    }
  }

  public function fgetItemStatusIdByName($dbs, $item_status_name)
  {
    $item_status_name = addslashes($item_status_name);
    $sql = 'SELECT * FROM mst_item_status WHERE item_status_name=\''.$item_status_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
    return $this->createItemStatus($dbs, $item_status_name);
    } else {
      return $res['item_status_id'];
    }
  }


}
