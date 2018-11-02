<?php
require_once 'vendor/autoload.php';
require_once 'config/app.php';

use App\Models\Database;

/**
 * Create table event and import all data from json file
 */
$tableName = 'event';
$dropTable = "DROP TABLE IF EXISTS {$tableName}";
Database::connect()->exec($dropTable);

$sql = "CREATE TABLE $tableName(
  id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  objectId CHAR( 10 ),
  homeName VARCHAR( 80 ) NOT NULL,
  awayName VARCHAR( 80 ) NOT NULL,
  name VARCHAR( 180 ) NOT NULL,
  groupName VARCHAR( 40 ) NOT NULL,
  sport VARCHAR( 40 ) NOT NULL,
  country VARCHAR( 40 ) NOT NULL,
  state VARCHAR( 40 ) NOT NULL,
  createdAt DATETIME NOT NULL);";

Database::connect()->exec($sql);
print ("Created table $tableName. " . PHP_EOL);

// Import JSON data
$event = new \App\Models\Event();
$event->loadJsonFileToTable();
print ("Imported json file to table $tableName. " . PHP_EOL);

/**
 * Create table winner and insert some data
 */
$tableName = 'winner';
$dropTable = "DROP TABLE IF EXISTS {$tableName}";
Database::connect()->exec($dropTable);

$createTable = "CREATE TABLE $tableName(
  id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name CHAR( 10 ) );";
Database::connect()->exec($createTable);
print ("Created table $tableName. " . PHP_EOL);

$insertData = "INSERT INTO $tableName (name) VALUES('home'),('draw'),('away')";
Database::connect()->exec($insertData);
print ("Inserted data into table $tableName. " . PHP_EOL);

/**
 * Create table user and insert default user admin with pass admin
 */
$tableName = 'user';
$dropTable = "DROP TABLE IF EXISTS {$tableName}";
Database::connect()->exec($dropTable);

$createTable = "CREATE TABLE $tableName(
  id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username CHAR( 10 ), 
  password CHAR( 60 )
  );";
Database::connect()->exec($createTable);
print ("Created table $tableName. " . PHP_EOL);
$hash = password_hash('admin', PASSWORD_BCRYPT);
$insertData = "INSERT INTO $tableName (username, password) VALUES('admin', '{$hash}')";
Database::connect()->exec($insertData);
print ("Inserted data into table $tableName. " . PHP_EOL);

/**
 * Create table vote
 */
$tableName = 'vote';
$dropTable = "DROP TABLE IF EXISTS {$tableName}";
Database::connect()->exec($dropTable);

$createTable = "CREATE TABLE $tableName(
  id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  event_id INT( 11 ) UNSIGNED,
  user_id INT( 11 ) UNSIGNED,
  winner_id INT( 11 ) UNSIGNED,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
  );";
Database::connect()->exec($createTable);
print ("Created table $tableName. " . PHP_EOL);

$insertData = "INSERT INTO $tableName (event_id, user_id, winner_id) VALUES (1, 1, 1)";
if(! NO_DUMMY_DATA) {
    Database::connect()->exec($insertData);
    print ("Inserted 1 dummy row in table $tableName" . PHP_EOL);
}
