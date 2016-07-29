<?php
namespace Slims\Bibliography\Models;

class Collection
{
  #public $is_newcoll = TRUE;
  #public $cid = NULL;
  #public $coll = array();

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public static function collection_save($dbs, $col)
  {
    $s_bib = 'INSERT INTO biblio (
      title,
      sor
    ) VALUES (
      \''.$col->title.'\',
        \''.$col->sor.'\'
    )

      ';

    $q_bib = $dbs->query($s_bib);
    $biblio_id = $dbs->lastInsertId();

  }

}
