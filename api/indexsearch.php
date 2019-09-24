<?php
/**
* this file for trial
*/
require __DIR__."/../vendor/autoload.php";

use ElasticSearchClient\ElasticSearchClient;
use SearchElastic\Search;

if(isset($_POST['keyword'])) {
	$search = new Search();
	$search->setIndex("eflats");
	$search->setType("articles");
	$search->setSearchColumn("property_title");
	$result = $search->search($_POST['keyword']);

	echo json_encode($result);
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}