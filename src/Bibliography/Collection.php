<?php
namespace Slims\Bibliography;

class Collection
{
  public $coll = array();

  public function __construct()
  {
    $this->coll['title'] = NULL;
    echo 'Slims\Bibliography\Collection()';
  }

  public function collection_load($cid = NULL)
  {
    if (is_null($cid)) {
      return $this->coll;
    }
  }

}
