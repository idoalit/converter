<?php 
require "vendor/autoload.php";

$dbs = new PDO('mysql:host=localhost; dbname=dev_slims7; charset=utf8mb4', 'root', 's0beautifulday');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


use Slims\Persneling\Masterfile\Models\Gmd as GMD;
 
$gmd = new GMD;
#var_dump();

#echo $gmd->countgmd($dbs, 'WHERE gmd_name=\'Text\'').'<hr />';
#echo '<pre>';
#$gmdlist = $gmd->showGmdList($dbs);

#print_r($gmdlist);
#echo '</pre>';
#if (!$gmdlist) {
#  echo 'wkwkwk';
#}
$gmd_id = $gmd->createGmd($dbs, 'Text');
#var_dump($gmd_id);
#die('ehem');
if ($gmd_id == FALSE) {
  echo 'sudah ada';
} else {
  echo 'Belum ada, tapi sudah ditambahkan dengan gmd_id: '.$gmd_id;
}

