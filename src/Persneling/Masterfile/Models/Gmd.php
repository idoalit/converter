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

  public function tereak()
  {
    #return 'EHLOOOO';
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

  public function search_gmd($dbs, $gmd_name)
  {
    $s_sgmd_c = 'SELECT COUNT(*) FROM mst_gmd WHERE gmd_name=\''.$gmd_name.'\'';
    $q_sgmd_c = $dbs->query($s_sgmd_c);
    #die($s_sgmd);
    $r_sgmd_c = $q_sgmd_c->fetch(\PDO::FETCH_ASSOC);
    #sprint_r ($r_sgmd_c);
    foreach ($r_sgmd_c as $key => $value) {
      echo $value.'<hr />';
      $c_sgmd_c = $value;
    }
    #die($c_sgmd_c);
    if ($c_sgmd_c > 0) {
      $s_sgmd = 'SELECT * FROM mst_gmd WHERE gmd_name=\''.$gmd_name.'\'';
      $q_sgmd = $dbs->query($s_sgmd);
      $r_sgmd = $q_sgmd->fetch(\PDO::FETCH_ASSOC);
      #print_r($r_sgmd);
      #die('lari kesini?');
      #$this->gmd_id = $r_sgmd['gmd_id'];
      $this->set_gmdId($r_sgmd['gmd_id']);
      #echo $this->get_gmdId();
      $this->set_gmdName($r_sgmd['gmd_name']);
      #echo $this->get_gmdName();
      #return $this->get_gmd();
      #die($this->gmd_id);
      return $this->get_gmdId();
    } else {
      return FALSE;
    }
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



}
