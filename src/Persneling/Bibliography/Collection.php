<?php
namespace Slims\Persneling\Bibliography;
use Slims\Persneling\Bibliography\Models\Collection as MC;

class Collection
{
  public $cid = NULL;
  public $coll = array();

  public function __construct()
  {
  }

  protected function set_cid($cid = NULL)
  {
    if (is_null($cid)) {
      $this->cid = NULL;
    } else {
      $this->cid = (int) $cid;
    }
  }

  protected function get_cid()
  {
    return $this->cid;
  }

  protected function set_newColl()
  {
    $this->set_title();
    $this->set_sor();
    $this->set_gmdName();
    $this->set_edition();
    $this->set_isbnIssn();
    $this->set_publisherName();
    $this->set_publishYear();
    $this->set_collation();
    $this->set_seriesTitle();
    $this->set_callNumber();
    $this->set_source();
    $this->set_place();
    $this->set_classification();
    $this->set_notes();
    $this->set_image();
    $this->set_specDetailInfo();
    $this->set_inputDate();
    $this->set_lastUpdate();
    $this->set_uid();
    $this->set_authors();
    $this->set_subjects();
    $this->set_items();
  }

  protected function get_newColl()
  {
    return (object) $this->coll;
  }

  protected function set_biblioId($biblio_id)
  {
    $this->coll['biblio_id'] = $biblio_id;
  }

  protected function set_title($title=NULL)
  {
    $this->coll['title'] = $title;
  }

  protected function set_sor($sor=NULL)
  {
    $this->coll['sor'] = $sor;
  }

  protected function set_gmdName($gmd_name=NULL)
  {
    $this->coll['gmd_name'] = $gmd_name;
  }

  protected function set_edition($edition=NULL)
  {
    $this->coll['edition'] = $edition;
  }

  protected function set_isbnIssn($isbn_issn=NULL)
  {
    $this->coll['isbn_issn'] = $isbn_issn;
  }

  protected function set_publisherName($publisher_name=NULL)
  {
    $this->coll['publisher_name'] = $publisher_name;
  }

  protected function set_publishYear($publish_year=NULL)
  {
    $this->coll['publish_year'] = $publish_year;
  }

  protected function set_collation($collation=NULL)
  {
    $this->coll['collation'] = $collation;
  }

  protected function set_seriesTitle($series_title=NULL)
  {
    $this->coll['series_title'] = $series_title;
  }

  protected function set_callNumber($call_number=NULL)
  {
    $this->coll['call_number'] = $call_number;
  }

  protected function set_source($source=NULL)
  {
    $this->coll['source'] = $source;
  }

  protected function set_place($place=NULL)
  {
    $this->coll['place'] = $place;
  }

  protected function set_classification($classification=NULL)
  {
    $this->coll['classification'] = $classification;
  }

  protected function set_notes($notes=NULL)
  {
    $this->coll['notes'] = $notes;
  }

  protected function set_image($image=NULL)
  {
    $this->coll['image'] = $image;
  }

  protected function set_specDetailInfo($spec_detail_info=NULL)
  {
    $this->coll['spec_detail_info'] = $spec_detail_info;
  }

  protected function set_inputDate($new=TRUE)
  {
    $this->coll['input_date'] = date("Y-m-d H:i:s");
  }

  protected function set_lastUpdate($new=TRUE)
  {
    $this->coll['last_update'] = date("Y-m-d H:i:s");
  }

  protected function set_uid($uid=1)
  {
    $this->coll['uid'] = $uid;
  }

  protected function set_authors($authors=array())
  {
    $this->coll['authors'] = $authors;
  }

  protected function set_subjects($subjects=array())
  {
    $this->coll['subjects'] = $subjects;
  }

  protected function set_items($items=array())
  {
    $this->coll['items'] = $items;
  }


  public function collection_load($dbs = NULL, $cid = NULL)
  {
    $this->set_cid($cid);
    if (is_null($this->get_cid())) {
      $this->set_newColl();
      return $this->get_newColl();
    } else {
      #echo 'Edit Buku';
      $mc = new MC;
      return $mc->collection_load($dbs, $cid);
    }
  }

  public function collection_save($dbs, $coll)
  {
    $mc = new MC;
    $mc->collection_save($dbs, $coll);
  }

  /**
  protected function set_collInfo($dbs, $cid)
  {
    $sBiblio = 'SELECT b.*, gmd.* ';
    $sBiblio .= 'FROM biblio AS b, mst_gmd AS gmd ';
    $sBiblio .= 'WHERE b.biblio_id=\''.$cid.'\' ';
    $sBiblio .= 'AND b.gmd_id=gmd.gmd_id';
    #$qBiblio = $dbs->query($sBiblio);
    $qBiblio = $dbs->query($sBiblio);
    $rBiblio = $qBiblio->fetch(\PDO::FETCH_ASSOC);
    $this->set_biblioId($rBiblio['biblio_id']);
    $this->set_title($rBiblio['title']);
    $this->set_sor($rBiblio['sor']);
    $this->set_gmdName($rBiblio['gmd_name']);
    #return $rBiblio;
    return $this->get_newColl();
  }
  **/

}
