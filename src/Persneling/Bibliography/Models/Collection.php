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
    $is_new = TRUE;
    if ((!empty($col->biblio_id)) OR (isset($col->biblio_id))) {
      if ($this->collection_load($dbs, $col->biblio_id)) {
        #echo 'data sudah ada';die();
        $is_new = FALSE;
        $_biblio_id = $col->biblio_id;
      } else {
        #echo 'data belum ada';die();
        $is_new = TRUE;
        $_biblio_id = NULL;
      }
    } else {
      $is_new = TRUE;
      $_biblio_id = NULL;
    }
    $s_bib = 'REPLACE INTO biblio (
      biblio_id,
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
      \''.addslashes($_biblio_id).'\',
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
      if (is_null($col->authors)) {
        $author = new Author;
        $author->removeRelBiblioAuthor($dbs, $biblio_id);
      }
    } else {
      #$author->fgetAuthorIdByName($dbs, $v);
      $author = new Author;
      $author->removeRelBiblioAuthor($dbs, $biblio_id);
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
      if (is_null($col->subjects)) {
        $subject = new Subject;
        $subject->removeRelBiblioSubject($dbs, $biblio_id);
      }
    } else {
      $subject = new Subject;
      $subject->removeRelBiblioSubject($dbs, $biblio_id);
      foreach ($col->subjects as $k => $v) {
        $subject = new Subject;
        $subject_id = $subject->fgetSubjectIdByName($dbs, $v);
        $subject->createRelBiblioSubject($dbs, $biblio_id, $subject_id);
      }
    }
    if (empty($col->items)) {
      if (is_null($col->items)) {
        $item = new Item;
        $item->removeItemById($dbs, $biblio_id);
      }
    } else {
      $item = new Item;
      $item->removeItemById($dbs, $biblio_id);
      foreach ($col->items as $k => $v) {
        $item = new Item;
        $item_id = $item->fgetItemIdByItemcode($dbs, $v, $biblio_id);
      }
    }

  }

  public function collection_load($dbs, $cid)
  {
    $coll = FALSE;
    #$sBiblio = 'SELECT b.*, gmd.* ';
    #$sBiblio .= 'FROM biblio AS b, mst_gmd AS gmd ';
    #$sBiblio .= 'WHERE b.biblio_id=\''.$cid.'\' ';
    #$sBiblio .= 'AND b.gmd_id=gmd.gmd_id';

    $sBiblio = 'SELECT b.*,gmd.*,pub.*,lan.*, pla.*, fre.*, cot.*, met.*, cat.* ';
    $sBiblio .= 'FROM biblio AS b ';
    $sBiblio .= 'LEFT JOIN mst_gmd AS gmd ';
    $sBiblio .= 'ON b.gmd_id=gmd.gmd_id ';
    $sBiblio .= 'LEFT JOIN mst_publisher AS pub ';
    $sBiblio .= 'ON b.publisher_id=pub.publisher_id ';
    $sBiblio .= 'LEFT JOIN mst_language AS lan ';
    $sBiblio .= 'ON b.language_id=lan.language_id ';
    $sBiblio .= 'LEFT JOIN mst_place AS pla ';
    $sBiblio .= 'ON b.publish_place_id=pla.place_id ';
    $sBiblio .= 'LEFT JOIN mst_frequency AS fre ';
    $sBiblio .= 'ON b.frequency_id=fre.frequency_id ';
    $sBiblio .= 'LEFT JOIN mst_content_type AS cot ';
    $sBiblio .= 'ON b.content_type_id=cot.id ';
    $sBiblio .= 'LEFT JOIN mst_media_type AS met ';
    $sBiblio .= 'ON b.media_type_id=met.id ';
    $sBiblio .= 'LEFT JOIN mst_carrier_type AS cat ';
    $sBiblio .= 'ON b.carrier_type_id=cat.id ';
    $sBiblio .= 'WHERE b.biblio_id=\''.$cid.'\'';
    $qBiblio = $dbs->query($sBiblio);
    if ($qBiblio->rowCount() > 0) {
      $rBiblio = $qBiblio->fetch(\PDO::FETCH_ASSOC);
      $coll['biblio_id'] = $rBiblio['biblio_id'];
      $coll['title'] = $rBiblio['title'];
      $coll['sor'] = $rBiblio['sor'];
      $coll['gmd_name'] = $rBiblio['gmd_name'];
      $coll['edition'] = $rBiblio['edition'];
      $coll['isbn_issn'] = $rBiblio['isbn_issn'];
      $coll['publisher_name'] = $rBiblio['publisher_name'];
      $coll['publish_year'] = $rBiblio['publish_year'];
      $coll['collation'] = $rBiblio['collation'];
      $coll['series_title'] = $rBiblio['series_title'];
      $coll['call_number'] = $rBiblio['call_number'];
      $coll['source'] = $rBiblio['source'];
      $coll['place'] = $rBiblio['place_name'];
      $coll['classification'] = $rBiblio['classification'];
      $coll['notes'] = $rBiblio['notes'];
      $coll['spec_detail_info'] = $rBiblio['spec_detail_info'];
      $coll['uid'] = $rBiblio['uid'];
      ########### AUTHORS #############
      $coll['authors'] = NULL;
      #$sAuthor = 'SELECT b.biblio_id, ba.level, a.* ';
      #$sAuthor .= 'FROM biblio AS b, biblio_author AS ba, mst_author AS a ';
      #$sAuthor .= 'WHERE ';
      #$sAuthor .= 'b.biblio_id=ba.biblio_id ';
      #$sAuthor .= 'AND ba.author_id=a.author_id ';
      #$sAuthor .= 'AND b.biblio_id=\''.$cid.'\'';
      #$qAuthor = $dbs->query($sAuthor);
      #if ($qAuthor->rowCount() > 0) {
      #  $rAuthor = $qAuthor->fetchAll(\PDO::FETCH_ASSOC);
      #  foreach ($rAuthor as $key => $value) {
      #    $coll['authors'][$key]['name'] = $value['author_name'];
      #    $coll['authors'][$key]['authority_type'] = $value['authority_type'];
      #    $coll['authors'][$key]['authority_level'] = $value['level'];
      #  }
      #}
      $author = new Author;
      $coll['authors'] = $author->getAuthorsListByBiblioId($dbs, $rBiblio['biblio_id']);
      $subject = new Subject;
      $coll['subjects'] = $subject->getSubjectsListByBiblioId($dbs, $rBiblio['biblio_id']);
      $item = new Item;
      $coll['items'] = $item->getItemsListByBiblioId($dbs, $rBiblio['biblio_id']);


      ##################################








    }
    return $coll;

/**
$data->subjects[0]['name'] = 'Fisika';
$data->subjects[1]['name'] = 'Perpustakaan';
$data->items[0]['item_code'] = 'B000000001';
$data->items[0]['coll_type_name'] = 'AV';
$data->items[0]['site'] = 'Rak 1';
$data->items[1]['item_code'] = 'B000000002';
$data->items[1]['coll_type_name'] = 'AVR';
$data->items[1]['site'] = 'Rak 2';
$data->items[2]['item_code'] = 'B000000003';
$data->items[2]['coll_type_name'] = 'Tandon';
$data->items[2]['site'] = 'Rak 3';

$koleksi->collection_save($dbs, $data);
**/

  }



}
