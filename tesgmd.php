<?php 
require "vendor/autoload.php";

$dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'root', 's0beautifulday');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


use Slims\Persneling\Masterfile\Models\Gmd as GMD;
 
$gmd = new GMD;
#var_dump();

echo $gmd->count_gmd($dbs);