<?php
namespace Slims\Persneling\Masterfile\Models;

class Location
{
  public $location_id = NULL;
  public $location_name = NULL;

  public function __construct()
  {
  }

  public function set_locationId($value)
  {
    $this->location_id = $value;
  }

  public function set_locationName($value)
  {
    $this->location_name = $value;
  }

  public function get_locationId()
  {
    return $this->location_id;
  }

  public function get_locationName()
  {
    return $this->location_name;
  }

  public function countLocation($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_location';
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

  public function showLocationList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_location';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createLocation($dbs, $location_name)
  {
    $location_name = addslashes($location_name);
    $is_exist = $this->countLocation($dbs, 'WHERE location_name=\''.$location_name.'\'');
    if (!$is_exist) {
      $location_id = rand(10,100);
      $s_slocation = 'INSERT INTO mst_location (location_id, location_name) VALUES (\''.$location_id.'\',\''.$location_name.'\')';
      $q_slocation = $dbs->query($s_slocation);
      return $location_id;
    } else {
      return FALSE;
    }
  }

  public function getLocationIdByName($dbs, $location_name)
  {
    $location_name = addslashes($location_name);
    $sql = 'SELECT * FROM mst_location WHERE location_name=\''.$location_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['location_id'];
    }
  }

  public function fgetLocationIdByName($dbs, $location_name)
  {
    $location_name = addslashes($location_name);
    $sql = 'SELECT * FROM mst_location WHERE location_name=\''.$location_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
    return $this->createLocation($dbs, $location_name);
    } else {
      return $res['location_id'];
    }
  }


}
