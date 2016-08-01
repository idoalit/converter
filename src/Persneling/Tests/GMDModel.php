<?php
use Slims\Persneling\Masterfile\Models\Gmd as GMDModel;
#use PHPUnit\Framework\TestCase;
$dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'root', 's0beautifulday');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


class GmdTest extends PHPUnit_Framework_TestCase
{
  public function testCountgmd ()
  {
    global $dbs;
    $gmdmodel = new GMDModel;
    #$this->assertTrue($itungan->tambah());
    $this->assertEquals(32, $gmdmodel->countgmd($dbs));
  }

  public function testTesting ()
  {
    $gmdmodel = new GMDModel;
    $this->assertTrue($gmdmodel->testing());
  }


}
