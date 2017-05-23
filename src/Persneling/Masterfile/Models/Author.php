<?php
namespace Slims\Persneling\Masterfile\Models;

class Author
{
  public $author_id = NULL;
  public $author_name = NULL;

  public function __construct()
  {
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
  }

  public function get_authorId()
  {
    return $this->author_id;
  }

  public function get_authorName()
  {
    return $this->author_name;
  }

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


  public function createAuthor($dbs, $author)
  {
    if ( (empty($author['authority_type'])) OR (is_null($author['authority_type'])) ) {
      $authority_type = 'p';
    } elseif ( ($author['authority_type']==='p') OR ($author['authority_type']==='o') OR ($author['authority_type']==='c') ) {
      $authority_type = $author['authority_type'];
    } else {
      $authority_type = 'p';
    }
    $is_exist = $this->countAuthor($dbs, 'WHERE author_name=\''.addslashes($author['name']).'\' AND authority_type=\''.$authority_type.'\'');
    if (!$is_exist) {
      $s_sauthor = 'INSERT INTO mst_author (author_name, authority_type) VALUES (\''.addslashes($author['name']).'\',\''.$authority_type.'\')';
      $q_sauthor = $dbs->query($s_sauthor);
      $author_id = $dbs->lastInsertId();
      return $author_id;
    } else {
      return FALSE;
    }
  }

  public function getAuthorIdByName($dbs, $author_name)
  {
    $author_name = addslashes($author_name);
    $sql = 'SELECT * FROM mst_author WHERE author_name=\''.$author_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['author_id'];
    }
  }

  public function fgetAuthorIdByName($dbs, $author=array())
  {
    if (!empty($author['name'])) {
      if ( (empty($author['authority_type'])) OR (is_null($author['authority_type'])) ) {
        $authority_type = 'p';
      } elseif ( ($author['authority_type']==='p') OR ($author['authority_type']==='o') OR ($author['authority_type']==='c') ) {
        $authority_type = $author['authority_type'];
      } else {
        $authority_type = 'p';
      }
      $sql = 'SELECT * FROM mst_author WHERE author_name=\''.addslashes($author['name']).'\' AND authority_type=\''.$authority_type.'\'';
      $stm = $dbs->query($sql);
      $res = $stm->fetch(\PDO::FETCH_ASSOC);
      if (empty($res)) {
        return $this->createAuthor($dbs, $author);
      } else {
        return $res['author_id'];
      }
    }
  }

  public function createRelBiblioAuthor($dbs, $biblio_id, $author_id, $authority_level='1')
  {
    if (is_numeric($authority_level)) {
      if ($authority_level > 11) {
        $authority_level = '1';
      }
    } else {
      $authority_level = '1';
    }
    $is_exist = $this->countRelBiblioAuthor($dbs, 'WHERE biblio_id=\''.$biblio_id.'\' AND author_id=\''.$author_id.'\'');
    if (!$is_exist) {
      $s_sbiblioauthor = 'INSERT INTO biblio_author (biblio_id, author_id, level) VALUES (\''.$biblio_id.'\', \''.$author_id.'\',\''.$authority_level.'\')';
      $q_sbiblioauthor = $dbs->query($s_sbiblioauthor);
      $author_id = $dbs->lastInsertId();
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function removeRelBiblioAuthor($dbs, $biblio_id)
  {
    if (is_numeric($biblio_id)) {
      $s_rrba = 'DELETE FROM biblio_author WHERE biblio_id=\''.$biblio_id.'\'';
      #echo $s_rrba;die();
      $q_rrba = $dbs->query($s_rrba);
    }
  }

  public function getAuthorsListByBiblioId($dbs, $biblio_id)
  {
    $authors = array();
    $sAuthor = 'SELECT b.biblio_id, ba.level, a.* ';
    $sAuthor .= 'FROM biblio AS b, biblio_author AS ba, mst_author AS a ';
    $sAuthor .= 'WHERE ';
    $sAuthor .= 'b.biblio_id=ba.biblio_id ';
    $sAuthor .= 'AND ba.author_id=a.author_id ';
    $sAuthor .= 'AND b.biblio_id=\''.$biblio_id.'\'';
    $qAuthor = $dbs->query($sAuthor);
    if ($qAuthor->rowCount() > 0) {
      $rAuthor = $qAuthor->fetchAll(\PDO::FETCH_ASSOC);
      foreach ($rAuthor as $key => $value) {
        $authors[$key]['name'] = $value['author_name'];
        $authors[$key]['authority_type'] = $value['authority_type'];
        $authors[$key]['authority_level'] = $value['level'];
      }
    }
    return $authors;
  }

}
