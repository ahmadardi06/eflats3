<?php
ini_set('display_errors', 1);
require __DIR__."/../vendor/autoload.php";

use Elasticsearch\ClientBuilder;

$hosts = [
	'elk.carsworld.co.id:9200'
];

$clientBuilder = ClientBuilder::create();
$clientBuilder->setHosts($hosts);

$client = $clientBuilder->build();

if(isset($_GET['keywords'])) {
  /**
  * this condition field keywords must be filled in
  * ex. indexmulti.php?keywords=home
  * field 'keywords' have value 'home'
  */
  $params = [
  	'index' => 'eflats',
    'type' => 'articles',
    'body' => [
      'query' => [
      	'bool' => [
      		'must' => [
            // this must be required field status is 2
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
    // this line for execute search the data
    $response = $client->search($params); 
    // response with format json
    echo json_encode($response);
  } catch (Exception $e) {
    echo $e->getMessage();
  }

} else {
  /**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
  $msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
  echo json_encode($msg);
}
