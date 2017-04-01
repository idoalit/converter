<?php
namespace Slims\Persneling\Masterfile\Models;

class Place
{
  public $place_id = NULL;
  public $place_name = NULL;
  #public $coll = array();
  #public $place = array ();
  #protected $place_id = NULL;

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public function set_placeId($value)
  {
    $this->place_id = $value;
  }

  public function set_placeName($value)
  {
    $this->place_name = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_placeId()
  {
    return $this->place_id;
  }

  public function get_placeName()
  {
    return $this->place_name;
  }

  #public function set_placeId($data)
  #{
  #  $this->place_id = (integer) $data;
  #}

  #public function get_placeId()
  #{
  #  return $this->place_id;
  #}

  public function testing()
  {
    return TRUE;
  }

  public function countPlace($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_place';
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

  public function showPlaceList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_place';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createPlace($dbs, $place_name)
  {
    $place_name = addslashes($place_name);
    $is_exist = $this->countPlace($dbs, 'WHERE place_name=\''.$place_name.'\'');
    if (!$is_exist) {
      $s_splace = 'INSERT INTO mst_place (place_name) VALUES (\''.$place_name.'\')';
      $q_splace = $dbs->query($s_splace);
      $place_id = $dbs->lastInsertId();
      return $place_id;
    } else {
      return FALSE;
    }
  }

  public function getPlaceIdByName($dbs, $place_name)
  {
    $place_name = addslashes($place_name);
    $sql = 'SELECT * FROM mst_place WHERE place_name=\''.$place_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['place_id'];
    }
  }

  public function fgetPlaceIdByName($dbs, $place_name)
  {
    $place_name = addslashes($place_name);
    $sql = 'SELECT * FROM mst_place WHERE place_name=\''.$place_name.'\'';
    #die($sql);
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    #echo ($res['place_id']);
    #die();
    if (empty($res)) {
    #return FALSE;
    return $this->createPlace($dbs, $place_name);
    } else {
      #die($res['place_id']);
      #echo($res['place_id']);
      #die('<hr />tesdah');
      return $res['place_id'];
    }
  }


}
