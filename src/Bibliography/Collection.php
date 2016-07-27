<?php
namespace Slims\Bibliography;

class Collection
{
  public $is_newcoll = TRUE;
  public $coll = array();

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  protected function newCollection()
  {
    $this->setTitle();
  }

  protected function setIs_newcoll($cid)
  {
    if (!is_null($cid)) {
      if (is_numeric($cid)) {
        $this->is_newcoll = FALSE;
      } else {
        $this->is_newcoll = TRUE;
      }
    } else {
      $this->is_newcoll = TRUE;
    }
  }

  protected function getIs_newcoll()
  {
    return $this->is_newcoll;
  }

  protected function setTitle($title=NULL)
  {
    $this->coll['title'] = $title;
  }

  public function collection_load($cid = NULL)
  {
    $this->setIs_newcoll($cid);
    #$this->setTitle($cid);
    $this->getIs_newcoll();
    if ($this->getIs_newcoll()) {
      echo 'Buku baru';
    } else {
      echo 'Edit Buku';
    }
  }

}
