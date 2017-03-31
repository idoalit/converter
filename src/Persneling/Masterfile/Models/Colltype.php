<?php
namespace Slims\Persneling\Masterfile\Models;

class Colltype
{
  public $coll_type_id = NULL;
  public $coll_type_name = NULL;

  public function __construct()
  {
  }

  public function set_collTypeId($value)
  {
    $this->coll_type_id = $value;
  }

  public function set_collTypeName($value)
  {
    $this->coll_type_name = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_collTypeId()
  {
    return $this->coll_type_id;
  }

  public function get_collTypeName()
  {
    return $this->coll_type_name;
  }

  public function testing()
  {
    return TRUE;
  }

  public function countCollType($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_coll_type';
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

  public function showCollTypeList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_coll_type';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createCollType($dbs, $coll_type_name)
  {
    $coll_type_name = addslashes($coll_type_name);
    $is_exist = $this->countCollType($dbs, 'WHERE coll_type_name=\''.$coll_type_name.'\'');
    if (!$is_exist) {
      $s_scolltype = 'INSERT INTO mst_coll_type (coll_type_name) VALUES (\''.$coll_type_name.'\')';
      $q_scolltype = $dbs->query($s_scolltype);
      $coll_type_id = $dbs->lastInsertId();
      return $coll_type_id;
    } else {
      return FALSE;
    }
  }

  public function getCollTypeIdByName($dbs, $coll_type_name)
  {
    $coll_type_name = addslashes($coll_type_name);
    $sql = 'SELECT * FROM mst_coll_type WHERE coll_type_name=\''.$coll_type_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['coll_type_id'];
    }
  }

  public function fgetCollTypeIdByName($dbs, $coll_type_name)
  {
    $coll_type_name = addslashes($coll_type_name);
    $sql = 'SELECT * FROM mst_coll_type WHERE coll_type_name=\''.$coll_type_name.'\'';
    #die($sql);
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    #echo ($res['publisher_id']);
    #die();
    if (empty($res)) {
    #return FALSE;
    return $this->createCollType($dbs, $coll_type_name);
    } else {
      #die($res['publisher_id']);
      #echo($res['publisher_id']);
      #die('<hr />tesdah');
      return $res['coll_type_id'];
    }
  }


}
