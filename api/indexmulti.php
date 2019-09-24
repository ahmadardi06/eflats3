<?php
require __DIR__."/../vendor/autoload.php";

use Elasticsearch\ClientBuilder;

$hosts = [
	'http://elk.carsworld.co.id:9200'
];

$client = ClientBuilder::create()->setHosts($hosts)->build();

if(isset($_GET['keywords'])) {
  
  $params = [
  	'index' => 'eflats',
    'type' => 'articles',
    'body' => [
      'query' => [
      	'bool' => [
      		'must' => [
            [ 'match' => [ 'status' => '2', ] ],
          ],
          'should' => [
      			[ 'match' => [ 'property_title' => $_GET['keywords'], ] ],
            [ 'match' => [ 'furnished' => $_GET['furnished'], ] ],
      			[ 'match' => [ 'pet_friendly' => $_GET['petFriendly'], ] ],
      			[ 'range' => [ 'price' => [ 'gte' => 0, 'lte' => $_GET['price'] + $_GET['price'] ] ] ],
      		],
      	],
      ],
    ],
  ];

  if($_GET['bedroom'] != 0) array_push($params['body']['query']['bool']['should'], ['range' => ['bedroom' => [ 'gte' => 0, 'lte' => $_GET['bedroom'] + $_GET['bedroom']]]]); 

  if($_GET['bathroom'] != 0) array_push($params['body']['query']['bool']['should'], ['range' => ['bathroom' => [ 'gte' => 0, 'lte' => $_GET['bathroom'] + $_GET['bathroom']]]]); 

  try {
    $response = $client->search($params); 
    echo json_encode($response);
  } catch (Exception $e) {
    echo $e->getMessage();
  }

} else {
  $msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
  echo json_encode($msg);
}
