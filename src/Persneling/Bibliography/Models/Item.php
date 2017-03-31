<?php
namespace Slims\Persneling\Bibliography\Models;
use Slims\Persneling\Masterfile\Models\Colltype as Colltype;

class Item
{
  public $item_id = NULL;
  public $item_code = NULL;
  #public $coll = array();
  #public $author = array ();
  #protected $author_id = NULL;

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public function set_itemId($value)
  {
    $this->item_id = $value;
  }

  public function set_itemCode($value)
  {
    $this->item_code = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_itemId()
  {
    return $this->item_id;
  }

  public function get_itemCode()
  {
    return $this->item_code;
  }

  #public function set_authorId($data)
  #{
  #  $this->author_id = (integer) $data;
  #}

  #public function get_authorId()
  #{
  #  return $this->author_id;
  #}

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

#  public function countRelBiblioAuthor($dbs, $query = NULL)
#  {
#    $base = 'SELECT COUNT(*) FROM biblio_author';
#    $sql = $base.' '.$query;
#    $stm = $dbs->query($sql);
#    $res = $stm->fetch(\PDO::FETCH_ASSOC);
#    foreach ($res as $key => $value) {
#      $counter = $value;
#    }
#    if ($counter > 0) {
#      return $counter;
#    } else {
#      return FALSE;
#    }
#  }


  public function showItemList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM item';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  #public function createAuthor($dbs, $author_name)
  public function createItem($dbs, $item, $biblio_id)
  {

    $is_exist = $this->countItem($dbs, 'WHERE item_code=\''.$item['item_code'].'\'');
    if (!$is_exist) {


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


      #$s_sauthor = 'INSERT INTO mst_author (author_name) VALUES (\''.$author_name.'\')';
      #$s_sitem = 'INSERT INTO item (biblio_id, item_code) VALUES (\''.$biblio_id.'\', \''.$item['item_code'].'\')';
      $s_sitem = 'INSERT INTO item ';
      $s_sitem .= '(biblio_id, item_code, coll_type_id, site) ';
      $s_sitem .= 'VALUES ';
      $s_sitem .= '(\''.$biblio_id.'\', \''.$item['item_code'].'\',\''.$coll_type_id.'\',\''.$site.'\')';
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

  #public function fgetAuthorIdByName($dbs, $author_name)
  public function fgetItemIdByItemcode($dbs, $item=array(), $biblio_id)
  {
    if (!empty($item['item_code'])) {
      $sql = 'SELECT * FROM item WHERE item_code=\''.$item['item_code'].'\'';
      #die($sql);
      $stm = $dbs->query($sql);
      $res = $stm->fetch(\PDO::FETCH_ASSOC);
      #echo ($res['author_id']);
      #die();
      if (empty($res)) {
      #return FALSE;
      #return $this->createAuthor($dbs, $author_name);
      return $this->createItem($dbs, $item, $biblio_id);
      } else {
        #die($res['author_id']);
        #echo($res['author_id']);
        #die('<hr />tesdah');
        return $res['item_id'];
      }
    }
  }



}
