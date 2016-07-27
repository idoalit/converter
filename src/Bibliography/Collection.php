<?php
namespace Slims\Bibliography;

class Collection
{
  public $coll = array();

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    echo 'Slims\Bibliography\Collection()';
  }

  protected function newCollection()
  {
    $this->setTitle();
  }

  protected function setTitle($title=NULL)
  {
    $this->coll['title'] = $title;
  }

  public function collection_load($cid = NULL)
  {
    if (is_null($cid)) {
      $this->newCollection();
      return $this->coll;
    }
  }

}
