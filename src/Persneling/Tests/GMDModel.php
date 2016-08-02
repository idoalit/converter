<?php
use Slims\Persneling\Masterfile\Models\Gmd as GMDModel;

#$dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'root', 's0beautifulday');
#$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


class GmdTest extends PHPUnit_Framework_TestCase
{
  public $gmdmodel;
  public $dbs;

  public function setUp()
  {
    $this->gmdmodel = new GMDModel;
    $this->dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'root', 's0beautifulday');
    $this->dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  public function testCountGmd ()
  {
    $this->assertGreaterThan(0, $this->gmdmodel->countGmd($this->dbs));
    $this->assertGreaterThan(0, $this->gmdmodel->countGmd($this->dbs, 'WHERE gmd_name=\'Text\''));
    $this->assertFalse($this->gmdmodel->countGmd($this->dbs, 'WHERE gmd_name=\'xxxyyyzzz\''));
  }

  public function testShowGmdList ()
  {
    $this->assertNotEmpty($this->gmdmodel->showGmdList($this->dbs));
    $this->assertNotEmpty($this->gmdmodel->showGmdList($this->dbs, 'WHERE gmd_name=\'Text\''));
    $this->assertEmpty($this->gmdmodel->showGmdList($this->dbs, 'WHERE gmd_name=\'xxxyyyzzz\''));
  }

  public function testCreateGmd ()
  {
    $this->assertFalse($this->gmdmodel->createGmd($this->dbs, 'Text'));
    #$this->assertGreaterThan(0, $this->gmdmodel->createGmd($this->dbs, 'Disertasi'));
  }

  public function testTesting ()
  {
    $gmdmodel = new GMDModel;
    $this->assertTrue($gmdmodel->testing());
  }


}
