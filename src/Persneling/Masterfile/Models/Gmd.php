<?php
namespace Slims\Persneling\Masterfile\Models;

class Gmd
{
  public $gmd_id = NULL;
  public $gmd_name = NULL;
  #public $coll = array();
  #public $gmd = array ();
  #protected $gmd_id = NULL;

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public function set_gmdId($value)
  {
    $this->gmd_id = $value;
  }

  public function set_gmdName($value)
  {
    $this->gmd_name = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_gmdId()
  {
    return $this->gmd_id;
  }

  public function get_gmdName()
  {
    return $this->gmd_name;
  }

  #public function set_gmdId($data)
  #{
  #  $this->gmd_id = (integer) $data;
  #}

  #public function get_gmdId()
  #{
  #  return $this->gmd_id;
  #}

  public function testing()
  {
    return TRUE;
  }

  public function countGmd($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_gmd';
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

  public function showGmdList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_gmd';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createGmd($dbs, $gmd_name)
  {
    $is_exist = $this->countGmd($dbs, 'WHERE gmd_name=\''.$gmd_name.'\'');
    if (!$is_exist) {
      $s_sgmd = 'INSERT INTO mst_gmd (gmd_name) VALUES (\''.$gmd_name.'\')';
      $q_sgmd = $dbs->query($s_sgmd);
      $gmd_id = $dbs->lastInsertId();
      return $gmd_id;
    } else {
      return FALSE;
    }
  }

  public function getGmdIdByName($dbs, $gmd_name)
  {
    $sql = 'SELECT * FROM mst_gmd WHERE gmd_name=\''.$gmd_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['gmd_id'];
    }
  }

  public function fgetGmdIdByName($dbs, $gmd_name)
  {
    $sql = 'SELECT * FROM mst_gmd WHERE gmd_name=\''.$gmd_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      #return FALSE;
      return $this->createGmd($dbs, $gmd_name);
    } else {
      return $res['gmd_id'];
    }
  }


}
