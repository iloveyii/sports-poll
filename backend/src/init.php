<?php
require_once 'vendor/autoload.php';
require_once 'config/app.php';

use App\Models\Database;

$tableName = 'event';
$dropTable = "DROP TABLE IF EXISTS {$tableName}";
Database::connect()->exec($dropTable);

$sql = "CREATE table $tableName(
  id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  objectId CHAR( 10 ),
  awayName VARCHAR( 80 ) NOT NULL,
  homeName VARCHAR( 80 ) NOT NULL,
  name VARCHAR( 180 ) NOT NULL,
  groupName VARCHAR( 40 ) NOT NULL,
  sport VARCHAR( 40 ) NOT NULL,
  country VARCHAR( 40 ) NOT NULL,
  state VARCHAR( 40 ) NOT NULL,
  createdAt DATETIME NOT NULL);";

Database::connect()->exec($sql);
print ("Created table $tableName. " . PHP_EOL);

