<?php
/**
* this file for fetch all data in our database 
* and insert to elasticsearch server
*/
ini_set('display_errors', 1);
require __DIR__."/../vendor/autoload.php";

use SyncMySql\SyncMySql;
use SyncMySql\Connection\MySQLiConnection;

$sync = new SyncMySql();

// you may change this connection our mysql
$connection = new mysqli('localhost', 'root', '', 'eflats');

$sync->setIndex("eflats");
$sync->setType("articles");

$sync->setConnection(new MySQLiConnection());
$sync->setSqlQuery("SELECT * FROM properties");

//Now you don't need to pass the tablename'
$result = $sync->insertAllData($connection);

// echo json_encode($result);
