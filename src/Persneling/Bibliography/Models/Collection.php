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

  public function __construct()
  {
  }

  public function collection_save($dbs, $col)
  {
    $gmd = new GMD;
    $_gmd_id = $gmd->fgetGmdIdByName($dbs, $col->gmd_name);
    $publisher = new Publisher;
    $_publisher_id = $publisher->fgetPublisherIdByName($dbs, $col->publisher_name);
    $place = new Place;
    $_place_id = $place->fgetPlaceIdByName($dbs, $col->place);
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
      image,
      spec_detail_info,
      input_date,
      last_update,
      uid
      ) VALUES (
      \''.addslashes($col->title).'\',
      \''.addslashes($_gmd_id).'\',
      \''.addslashes($col->sor).'\',
      \''.addslashes($col->edition).'\',
      \''.addslashes($col->isbn_issn).'\',
      \''.addslashes($_publisher_id).'\',
      \''.addslashes($col->publish_year).'\',
      \''.addslashes($col->collation).'\',
      \''.addslashes($col->series_title).'\',
      \''.addslashes($col->call_number).'\',
      \''.addslashes($col->source).'\',
      \''.addslashes($_place_id).'\',
      \''.addslashes($col->classification).'\',
      \''.addslashes($col->notes).'\',
      \''.addslashes($col->image).'\',
      \''.addslashes($col->spec_detail_info).'\',
      \''.addslashes($col->input_date).'\',
      \''.addslashes($col->last_update).'\',
      \''.addslashes($col->uid).'\'
      )
    ';
    $q_bib = $dbs->query($s_bib);
    $biblio_id = $dbs->lastInsertId();

    if (empty($col->authors)) {
    } else {
      foreach ($col->authors as $k => $v) {
        $author = new Author;
        $author_id = $author->fgetAuthorIdByName($dbs, $v);
        if ( (empty($v['authority_level'])) OR (is_null($v['authority_level'])) ) {
          $v['authority_level'] = '1';
        }
        $author->createRelBiblioAuthor($dbs, $biblio_id, $author_id, $v['authority_level']);
      }
    }
    if (empty($col->subjects)) {
    } else {
      foreach ($col->subjects as $k => $v) {
        $subject = new Subject;
        $subject_id = $subject->fgetSubjectIdByName($dbs, $v);
        $subject->createRelBiblioSubject($dbs, $biblio_id, $subject_id);
      }
    }
    if (empty($col->items)) {
    } else {
      foreach ($col->items as $k => $v) {
        $item = new Item;
        $item_id = $item->fgetItemIdByItemcode($dbs, $v, $biblio_id);
      }
    }

  }

}
