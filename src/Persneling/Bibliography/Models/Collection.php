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

  public function collection_save($dbs, $col)
  {
    $gmd = new GMD;
    #echo $gmd->tereak();
    #echo $gmd->getGmdIdByName($dbs, "Multimedia");die();
    $_gmd_id = $gmd->fgetGmdIdByName($dbs, $col->gmd_name);
    #die($col->gmd_name);
  #  $gmd_id = $gmd->search_gmd($dbs, $col->gmd_name);
  #  echo $gmd_id;
  #  if (!$gmd_id) {
      #echo 'stop here!';
      #create_gmd($dbs, $gmd_name)      
  #    $gmd_id = $gmd->create_gmd($dbs, $col->gmd_name);
  #  }
  #  echo '<hr />'.$gmd_id;
    #$gmd_id = '34';
    #die('<hr />just turn around');
#    $s_bib = 'INSERT INTO biblio (
#      title,
#      gmd_id,
#      sor,
#      edition,
#      isbn_issn
#      ) VALUES (
#      \''.$col->title.'\',
#      \''.$gmd_id.'\',
#      \''.$col->sor.'\',
#      \''.$col->edition.'\',
#      \''.$col->isbn_issn.'\'
#      )
#    ';
    $s_bib = 'INSERT INTO biblio (
      title,
      gmd_id,
      sor,
      edition,
      isbn_issn,
      publish_year,
      collation,
      series_title,
      call_number,
      source,
      classification,
      notes,
      spec_detail_info,
      input_date,
      last_update,
      uid
      ) VALUES (
      \''.$col->title.'\',
      \''.$_gmd_id.'\',
      \''.$col->sor.'\',
      \''.$col->edition.'\',
      \''.$col->isbn_issn.'\',
      \''.$col->publish_year.'\',
      \''.$col->collation.'\',
      \''.$col->series_title.'\',
      \''.$col->call_number.'\',
      \''.$col->source.'\',
      \''.$col->classification.'\',
      \''.$col->notes.'\',
      \''.$col->spec_detail_info.'\',
      \''.$col->input_date.'\',
      \''.$col->last_update.'\',
      \''.$col->uid.'\'
      )
    ';

    $q_bib = $dbs->query($s_bib);
    $biblio_id = $dbs->lastInsertId();

  }

}
