<?php
/**
* this file for trial
*/
require __DIR__.'/../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$hosts = [
	'http://elk.carsworld.co.id:9200'
];

$client = ClientBuilder::create()->setHosts($hosts)->build();

$params = [
  'index' => 'eflats3'
];

// Create the index
$response = $client->indices()->create($params);