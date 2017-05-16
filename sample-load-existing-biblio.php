<?php 
require "vendor/autoload.php";

$dbs = new PDO('mysql:host=localhost; dbname=dbname; charset=utf8mb4', 'dbusername', 'dbpassword');
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

use Slims\Persneling\Bibliography\Collection as C;
 
$koleksi = new C;

$biblio_id = '1';
$data = $koleksi->collection_load($dbs, $biblio_id);

echo '<pre>';
var_dump($data);
echo '</pre>';

