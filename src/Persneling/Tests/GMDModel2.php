<?php
use Slims\Persneling\Masterfile\Models\Gmd as GMDModel;
#use PHPUnit\Framework\TestCase;
$dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'root', 's0beautifulday');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


class GmdTest extends PHPUnit_Framework_TestCase
{
  public $gmdmodel;

  public function setUp()
  {
    $this->gmdmodel = new GMDModel;
  }


  public function testShowGmdList ()
  {
    global $dbs;
    #$gmdmodel2 = new GMDModel;
    #$this->assertGreaterThan(0, $gmdmodel->countgmd($dbs));
    #$this->assertGreaterThan(0, $gmdmodel->countgmd($dbs, 'WHERE gmd_name=\'Text\''));
    $this->assertNotEmpty($this->gmdmodel->showGmdList($dbs));
  }

  public function testTesting ()
  {
    $gmdmodel = new GMDModel;
    $this->assertTrue($gmdmodel->testing());
  }


}
