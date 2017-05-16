<?php
namespace Slims\Persneling\Masterfile\Models;

class Supplier
{
  public $supplier_id = NULL;
  public $supplier_name = NULL;

  public function __construct()
  {
  }

  public function set_supplierId($value)
  {
    $this->supplier_id = $value;
  }

  public function set_supplierName($value)
  {
    $this->supplier_name = $value;
  }

  public function get_supplierId()
  {
    return $this->supplier_id;
  }

  public function get_supplierName()
  {
    return $this->supplier_name;
  }

  public function countSupplier($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_supplier';
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

  public function showSupplierList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_supplier';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createSupplier($dbs, $supplier_name)
  {
    $supplier_name = addslashes($supplier_name);
    $is_exist = $this->countSupplier($dbs, 'WHERE supplier_name=\''.$supplier_name.'\'');
    if (!$is_exist) {
      $s_ssupplier = 'INSERT INTO mst_supplier (supplier_name) VALUES (\''.$supplier_name.'\')';
      $q_ssupplier = $dbs->query($s_ssupplier);
      $supplier_id = $dbs->lastInsertId();
      return $supplier_id;
    } else {
      return FALSE;
    }
  }

  public function getSupplierIdByName($dbs, $supplier_name)
  {
    $supplier_name = addslashes($supplier_name);
    $sql = 'SELECT * FROM mst_supplier WHERE supplier_name=\''.$supplier_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['supplier_id'];
    }
  }

  public function fgetSupplierIdByName($dbs, $supplier_name)
  {
    $supplier_name = addslashes($supplier_name);
    $sql = 'SELECT * FROM mst_supplier WHERE supplier_name=\''.$supplier_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
    return $this->createSupplier($dbs, $supplier_name);
    } else {
      return $res['supplier_id'];
    }
  }


}
