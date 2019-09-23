<?php
require __DIR__."/../vendor/autoload.php";

use SyncMySql\SyncMySql;
use SyncMySql\Connection\MySQLiConnection;

$sync = new SyncMySql();
$connection = new mysqli('localhost', 'root', '', 'eflats');

$sync->setIndex("eflats");
$sync->setType("articles");

$sync->setConnection(new MySQLiConnection());
$sync->setSqlQuery("SELECT * FROM properties");
//Now you don't need to pass the tablename'
$result = $sync->insertAllData($connection);

echo '<pre>';
print_r($result);
echo '</pre>';