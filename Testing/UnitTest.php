<?php
require '../vendor/autoload.php';
require_once "User.php";

class UserTest extends PHPUnit_Framework_TestCase
{

  protected $user;

  protected function setUp() {
    $this->user = new User();
    #$this->user->setName("Tom");
  }

  protected function tearDown() {
    unset($this->user);
  }

  // test the talk method
  public function testTalk() {
    // make an instance of the user
    #$user = new User();
    // use assertEquals to ensure the greeting is what you
    $expected = "Hello world!";
    $actual = $this->user->talk();
    $this->assertEquals($expected, $actual);
  }

  public function testTalk2() {
    // make an instance of the user
    #$user = new User();
    // use assertEquals to ensure the greeting is what you
    $expected = "Hello world!";
    $actual = $this->user->talk();
    $this->assertEquals($expected, $actual);
  }


}

?>