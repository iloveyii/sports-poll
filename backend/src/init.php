<?php
require_once 'vendor/autoload.php';
require_once 'config/app.php';

use App\Models\Database;

/**
 * Create table event and import all data from json file
 */
$tableName = 'event';
$event = new \App\Models\Event();
$event->dropTable();
$event->createTable();
printf ("Created table %s. " . PHP_EOL, $event->tableName);
// Import JSON data
$event->loadJsonFileToTable();
printf ("Imported json file to table %s. " . PHP_EOL, $event->tableName);
echo PHP_EOL;

/**
 * Create table winner and insert some data
 */
$winner = new \App\Models\Winner();
$winner->dropTable();
$winner->createTable() ;
printf ("Created table %s. " . PHP_EOL, $winner->tableName);
$winner->setAttributes(['name'=>'HOME'])->create();
$winner->setAttributes(['name'=>'DRAW'])->create();
$winner->setAttributes(['name'=>'AWAY'])->create();
printf ("Inserted 3 rows into table %s. " . PHP_EOL, $winner->tableName);
echo PHP_EOL;

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
echo PHP_EOL;

/**
 * Create table vote
 */
$vote = new \App\Models\Vote();
$vote->dropTable();
$vote->createTable();
printf("Created table %s. " . PHP_EOL, $vote->tableName);
$attributes = ['event_id'=>1, 'user_id'=>1, 'winner_id'=>1];
$vote->setAttributes($attributes);
if(! NO_DUMMY_DATA) {
    $vote->create();
    printf("Inserted 1 dummy row in table %s. " . PHP_EOL, $vote->tableName);
}


