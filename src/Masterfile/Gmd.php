<?php
namespace Slims\Masterfile\Models;

class Gmd
{
  #public $is_newcoll = TRUE;
  #public $cid = NULL;
  #public $coll = array();

  public function __construct()
  {
    #$this->coll['title'] = NULL;
    #echo 'Slims\Bibliography\Collection()';
  }

  public static function show_gmdList($dbs)
  {
    $s_sgmd = 'SELECT * FROM mst_gmd';
    $q_sgmd = $dbs->query($s_bib);
    $r_sgmd = $q_sgmd->fetchAll(PDO::FETCH_ASSOC);

  }

}
