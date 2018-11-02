<?php
require_once 'vendor/autoload.php';
require_once 'config/app.php';

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
$user = new \App\Models\User();
$user->dropTable();
$user->createTable();
printf ("Created table %s. " . PHP_EOL, $user->tableName);
$attributes = ['username'=>'admin', 'password'=>'admin'];
$user->setAttributes($attributes)->create();
printf ("Inserted data into table %s. " . PHP_EOL, $user->tableName);
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


