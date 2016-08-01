<?php
namespace Slims\Persneling\Bibliography\Models;
use Slims\Persneling\Masterfile\Models\Gmd as GMD;

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
    $gmd = new GMD;
    #echo $gmd->tereak();
    #die($col->gmd_name);
    $gmd_id = $gmd->search_gmd($dbs, $col->gmd_name);
    echo $gmd_id;
    if (!$gmd_id) {
      #echo 'stop here!';
      #create_gmd($dbs, $gmd_name)      
      $gmd_id = $gmd->create_gmd($dbs, $col->gmd_name);
    }
    echo '<hr />'.$gmd_id;
    #$gmd_id = '34';
    #die('<hr />just turn around');
    $s_bib = 'INSERT INTO biblio (
      title,
      gmd_id,
      sor,
      edition,
      isbn_issn
      ) VALUES (
      \''.$col->title.'\',
      \''.$gmd_id.'\',
      \''.$col->sor.'\',
      \''.$col->edition.'\',
      \''.$col->isbn_issn.'\'
      )
    ';

    $q_bib = $dbs->query($s_bib);
    $biblio_id = $dbs->lastInsertId();

  }

}
