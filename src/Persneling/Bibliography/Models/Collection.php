<?php
namespace Slims\Persneling\Bibliography\Models;
use Slims\Persneling\Masterfile\Models\Gmd as GMD;
use Slims\Persneling\Masterfile\Models\Publisher as Publisher;
use Slims\Persneling\Masterfile\Models\Place as Place;
use Slims\Persneling\Masterfile\Models\Author as Author;
use Slims\Persneling\Masterfile\Models\Subject as Subject;
use Slims\Persneling\Bibliography\Models\Item as Item;

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
    $publisher = new Publisher;
    #die($col->publisher_name);
    $_publisher_id = $publisher->fgetPublisherIdByName($dbs, $col->publisher_name);
    $place = new Place;
    #die($col->publisher_name);
    $_place_id = $place->fgetPlaceIdByName($dbs, $col->place);
    #die($_publisher_id);
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
      publisher_id,
      publish_year,
      collation,
      series_title,
      call_number,
      source,
      publish_place_id,
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
      \''.$_publisher_id.'\',
      \''.$col->publish_year.'\',
      \''.$col->collation.'\',
      \''.$col->series_title.'\',
      \''.$col->call_number.'\',
      \''.$col->source.'\',
      \''.$_place_id.'\',
      \''.$col->classification.'\',
      \''.$col->notes.'\',
      \''.$col->spec_detail_info.'\',
      \''.$col->input_date.'\',
      \''.$col->last_update.'\',
      \''.$col->uid.'\'
      )
    ';
    #echo($s_bib);#die('hhh');
    $q_bib = $dbs->query($s_bib);
    $biblio_id = $dbs->lastInsertId();

    if (empty($col->authors)) {
      #echo '<hr />author kosong nih<hr />';
    } else {
      #echo '<hr />author ga kosong nih<hr />';
      foreach ($col->authors as $k => $v) {
        $author = new Author;
        $author_id = $author->fgetAuthorIdByName($dbs, $v);
        $author->createRelBiblioAuthor($dbs, $biblio_id, $author_id);
      }
    }
    if (empty($col->subjects)) {
      #echo '<hr />subject kosong nih<hr />';
    } else {
      #echo '<hr />subject ga kosong nih<hr />';
      foreach ($col->subjects as $k => $v) {
        $subject = new Subject;
        $subject_id = $subject->fgetSubjectIdByName($dbs, $v);
        $subject->createRelBiblioSubject($dbs, $biblio_id, $subject_id);
      }
    }
    if (empty($col->items)) {
      #echo '<hr />Item kosong nih<hr />';
    } else {
      #echo '<hr />Item ga kosong nih<hr />';
      foreach ($col->items as $k => $v) {
        $item = new Item;
        $item_id = $item->fgetItemIdByItemcode($dbs, $v, $biblio_id);
        #$item->createRelBiblioSubject($dbs, $biblio_id, $subject_id);
      }
    }

  }

}
