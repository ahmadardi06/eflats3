<?php
/**
* this file serves to remove properties to our favorites table
*/
session_start();
require 'db.php';

if(isset($_GET['item'])) {
	/**
  * this condition to handle method GET with field item must be filled in
  */
	$cekRow = $db->query("DELETE FROM favorites WHERE customer_id = '".$_SESSION['userId']."' AND property_id = '".$_GET['item']."'");

	// redirect to myfavorites.php with message
	header('location: /'.$BASEAPP.'/myfavorites.php?message=Property has been removed from your favorites.');
} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}