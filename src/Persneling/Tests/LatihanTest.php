<?php
#namespace Slims\Persneling\Bibliography;
use Slims\Persneling\Bibliography\Latihan as Latihan;
#use PHPUnit\Framework\TestCase;

class LatihanTest extends PHPUnit_Framework_TestCase
{
  public function testTambah ()
  {
    $itungan = new Latihan;
    $this->assertTrue($itungan->tambah());
  }

}
