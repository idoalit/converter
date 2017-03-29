<?php
/**
 * ----------------------------------------------------------------------
 * @Author                : ido_alit
 * @Date                  : 2017-03-21 03:44:28
 * @Last Modified by      : ido_alit
 * @Last Modified time    : 2017-03-21 03:48:55
 * ----------------------------------------------------------------------
 */

if (isset($_GET['sampledata'])) {
  echo json_encode('ini data ' . $_GET['sampledata']);
}