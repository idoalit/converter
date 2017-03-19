<?php
namespace Slims\Persneling\Masterfile\Models;

class Subject
{
  public $subject_id = NULL;
  public $subject_name = NULL;
  #public $coll = array();
  #public $author = array ();
  #protected $author_id = NULL;

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public function set_subjectId($value)
  {
    $this->subject_id = $value;
  }

  public function set_subjectName($value)
  {
    $this->subject_name = $value;
  }

  public static function tereak()
  {
    return 'EHLOOOO';
    #die('hmmmm');
  }

  public function get_subjectId()
  {
    return $this->subject_id;
  }

  public function get_subjectName()
  {
    return $this->subject_name;
  }

  #public function set_subjectId($data)
  #{
  #  $this->subject_id = (integer) $data;
  #}

  #public function get_subjectId()
  #{
  #  return $this->subject_id;
  #}

  public function testing()
  {
    return TRUE;
  }

  public function countSubject($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM mst_topic';
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

  public function countRelBiblioSubject($dbs, $query = NULL)
  {
    $base = 'SELECT COUNT(*) FROM biblio_topic';
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


  public function showSubjectList($dbs, $query = NULL)
  {
    $base = 'SELECT * FROM mst_topic';
    $sql = $base.' '.$query;
    $stm = $dbs->query($sql);
    $res = $stm->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
  }


  #public function createSubject($dbs, $subject_name)
  public function createSubject($dbs, $subject)
  {
    #$is_exist = $this->countSubject($dbs, 'WHERE topic=\''.$subject_name.'\'');
    $is_exist = $this->countSubject($dbs, 'WHERE topic=\''.$subject['name'].'\'');
    if (!$is_exist) {
      #$s_ssubject = 'INSERT INTO mst_topic (topic) VALUES (\''.$subject_name.'\')';
      $s_ssubject = 'INSERT INTO mst_topic (topic) VALUES (\''.addslashes($subject['name']).'\')';
      $q_ssubject = $dbs->query($s_ssubject);
      $subject_id = $dbs->lastInsertId();
      return $subject_id;
    } else {
      return FALSE;
    }
  }

  public function getSubjectIdByName($dbs, $subject_name)
  {
    $sql = 'SELECT * FROM mst_topic WHERE topic=\''.$subject_name.'\'';
    $stm = $dbs->query($sql);
    $res = $stm->fetch(\PDO::FETCH_ASSOC);
    if (empty($res)) {
      return FALSE;
    } else {
      return $res['subject_id'];
    }
  }

  #public function fgetSubjectIdByName($dbs, $subject_name)
  public function fgetSubjectIdByName($dbs, $subject=array())
  {
    if (!empty($subject['name'])) {
      #$sql = 'SELECT * FROM mst_topic WHERE topic=\''.$subject_name.'\'';
      $sql = 'SELECT * FROM mst_topic WHERE topic=\''.$subject['name'].'\'';
      #die($sql);
      $stm = $dbs->query($sql);
      $res = $stm->fetch(\PDO::FETCH_ASSOC);
      #echo ($res['author_id']);
      #die();
      if (empty($res)) {
      #return FALSE;
      #return $this->createSubject($dbs, $subject_name);
      return $this->createSubject($dbs, $subject);
      } else {
        #die($res['subject_id']);
        #echo($res['subject_id']);
        #die('<hr />tesdah');
        return $res['topic_id'];
      }
    }
  }

  public function createRelBiblioSubject($dbs, $biblio_id, $subject_id)
  {
    $is_exist = $this->countRelBiblioSubject($dbs, 'WHERE biblio_id=\''.$biblio_id.'\' AND topic_id=\''.$subject_id.'\'');
    if (!$is_exist) {
      $s_sbibliosubject = 'INSERT INTO biblio_topic (biblio_id, topic_id) VALUES (\''.$biblio_id.'\', \''.$subject_id.'\')';
      $q_sbibliosubject = $dbs->query($s_sbibliosubject);
      $subject_id = $dbs->lastInsertId();
      #return $author_id;
      return TRUE;
    } else {
      return FALSE;
    }
  }


}
