<?php
namespace Slims\Persneling\Masterfile\Models;

class Author
{
  public $author_id = NULL;
  public $author_name = NULL;
  #public $coll = array();
  #public $author = array ();
  #protected $author_id = NULL;

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public function set_authorId($value)
  {
    $this->author_id = $value;
  }

  public function set_authorName($value)
  {
    $this->author_name = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_authorId()
  {
    return $this->author_id;
  }

  public function get_authorName()
  {
    return $this->author_name;
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

  public function countAuthor($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_author';
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

  public function countRelBiblioAuthor($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM biblio_author';
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


  public function showAuthorList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_author';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  #public function createAuthor($dbs, $author_name)
  public function createAuthor($dbs, $author)
  {
    #$is_exist = $this->countAuthor($dbs, 'WHERE author_name=\''.$author_name.'\'');
    $is_exist = $this->countAuthor($dbs, 'WHERE author_name=\''.$author['name'].'\'');
    if (!$is_exist) {
      #$s_sauthor = 'INSERT INTO mst_author (author_name) VALUES (\''.$author_name.'\')';
      $s_sauthor = 'INSERT INTO mst_author (author_name) VALUES (\''.$author['name'].'\')';
      $q_sauthor = $dbs->query($s_sauthor);
      $author_id = $dbs->lastInsertId();
      return $author_id;
    } else {
      return FALSE;
    }
  }

  public function getAuthorIdByName($dbs, $author_name)
  {
    $sql = 'SELECT * FROM mst_author WHERE author_name=\''.$author_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['author_id'];
    }
  }

  #public function fgetAuthorIdByName($dbs, $author_name)
  public function fgetAuthorIdByName($dbs, $author=array())
  {
    if (!empty($author['name'])) {
      $sql = 'SELECT * FROM mst_author WHERE author_name=\''.$author['name'].'\'';
      #die($sql);
      $stm = $dbs->query($sql);
      $res = $stm->fetch(\PDO::FETCH_ASSOC);
      #echo ($res['author_id']);
      #die();
      if (empty($res)) {
      #return FALSE;
      #return $this->createAuthor($dbs, $author_name);
      return $this->createAuthor($dbs, $author);
      } else {
        #die($res['author_id']);
        #echo($res['author_id']);
        #die('<hr />tesdah');
        return $res['author_id'];
      }
    }
  }

  public function createRelBiblioAuthor($dbs, $biblio_id, $author_id)
  {
    $is_exist = $this->countRelBiblioAuthor($dbs, 'WHERE biblio_id=\''.$biblio_id.'\' AND author_id=\''.$author_id.'\'');
    if (!$is_exist) {
      $s_sbiblioauthor = 'INSERT INTO biblio_author (biblio_id, author_id) VALUES (\''.$biblio_id.'\', \''.$author_id.'\')';
      $q_sbiblioauthor = $dbs->query($s_sbiblioauthor);
      $author_id = $dbs->lastInsertId();
      #return $author_id;
      return TRUE;
    } else {
      return FALSE;
    }
  }


}
