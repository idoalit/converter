<?php
namespace Slims\Persneling\Masterfile\Models;

class Publisher
{
  public $publisher_id = NULL;
  public $publisher_name = NULL;
  #public $coll = array();
  #public $publisher = array ();
  #protected $publisher_id = NULL;

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public function set_publisherId($value)
  {
    $this->publisher_id = $value;
  }

  public function set_publisherName($value)
  {
    $this->publisher_name = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_publisherId()
  {
    return $this->publisher_id;
  }

  public function get_publisherName()
  {
    return $this->publisher_name;
  }

  #public function set_publisherId($data)
  #{
  #  $this->publisher_id = (integer) $data;
  #}

  #public function get_publisherId()
  #{
  #  return $this->publisher_id;
  #}

  public function testing()
  {
    return TRUE;
  }

  public function countPublisher($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_publisher';
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

  public function showPublisherList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_publisher';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  public function createPublisher($dbs, $publisher_name)
  {
    $is_exist = $this->countPublisher($dbs, 'WHERE publisher_name=\''.$publisher_name.'\'');
    if (!$is_exist) {
      $s_spublisher = 'INSERT INTO mst_publisher (publisher_name) VALUES (\''.$publisher_name.'\')';
      $q_spublisher = $dbs->query($s_spublisher);
      $publisher_id = $dbs->lastInsertId();
      return $publisher_id;
    } else {
      return FALSE;
    }
  }

  public function getPublisherIdByName($dbs, $publisher_name)
  {
    $sql = 'SELECT * FROM mst_publisher WHERE publisher_name=\''.$publisher_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['publisher_id'];
    }
  }

  public function fgetPublisherIdByName($dbs, $publisher_name)
  {
    $sql = 'SELECT * FROM mst_publisher WHERE publisher_name=\''.$publisher_name.'\'';
    #die($sql);
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    #echo ($res['publisher_id']);
    #die();
    if (empty($res)) {
    #return FALSE;
    return $this->createPublisher($dbs, $publisher_name);
    } else {
      #die($res['publisher_id']);
      #echo($res['publisher_id']);
      #die('<hr />tesdah');
      return $res['publisher_id'];
    }
  }


}
