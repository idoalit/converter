<?php
/**
 * ----------------------------------------------------------------------
 * @Author                : ido_alit
 * @Date                  : 2017-03-21 05:06:49
 * @Last Modified by      : ido_alit
 * @Last Modified time    : 2017-03-21 05:07:18
 * ----------------------------------------------------------------------
 */

require 'config.php';

$dbs = new PDO('mysql:host='.$config['db']['host'].'; dbname='.$config['db']['name'].'; charset=utf8', $config['db']['user'], $config['db']['pass']);
$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
