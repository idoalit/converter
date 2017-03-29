<?php
/**
 * ----------------------------------------------------------------------
 * @Author                : ido_alit
 * @Date                  : 2017-03-21 03:14:12
 * @Last Modified by      : ido_alit
 * @Last Modified time    : 2017-03-21 08:20:53
 * ----------------------------------------------------------------------
 */

class Konversi
{

  public static function getCsvFiles($base_path = '../csv/', $extension = '*csv')
  {
    $_return = FALSE;
    $files = glob($base_path . $extension);
    foreach ($files as $file) {
      $_return[] = str_replace($base_path, '', $file);
    }
    return $_return;
  }

  public static function getSampleData($file_path)
  {
    $row = 1;
    $_return = '';
    if (($handle = fopen($file_path, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
        $num = count($data);
        if ($row >= 2) {
          break;
        }
        $_return[] = $data;
        $row++;
      }
      fclose($handle);

      if (count($_return) == 1) {
        return $_return[0];
      } else {
        return $_return;
      }
    }

    return FALSE;
  }

  public static function getTables($obj_db)
  {
    $tables_q = $obj_db->query('SHOW TABLES');
    $tables = $tables_q->fetchAll(PDO::FETCH_COLUMN); 
    return $tables;
  }

  public static function getColumn($obj_db, $table)
  {
    $columns_q = $obj_db->query('SHOW COLUMNS FROM '. $table);
    $columns = $columns_q->fetchAll(PDO::FETCH_COLUMN);
    return $columns;
  }
}