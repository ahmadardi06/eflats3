<?php
/**
* this file serves to add properties to our favorites table
*/
session_start();
require 'db.php';

if(isset($_GET['item'])) {
	/**
  * this condition to handle method GET with field item must be filled in
  * first, check the data from customer and count it
  */
	$cekRow = $db->query("SELECT * FROM favorites WHERE customer_id = '".$_SESSION['userId']."' AND property_id = '".$_GET['item']."'")->num_rows;

	if($cekRow != 1) {
		// condition if not existing
		$query = $db->query("INSERT INTO favorites VALUES (null, '".$_SESSION['userId']."', '".$_GET['item']."', '".date('Y-m-d H:i:s')."')");

		// insert history log
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User Customer ".$_SESSION['userId']." Add Favorite ".$_GET['item']."')");

		// redirect 
		header('location: /'.$BASEAPP.'/index.php?message=Property has been added to favorites.');
	} else {
		// condition if property already favorites
		header('location: /'.$BASEAPP.'/index.php?message=Property already on favorite.');
	}

} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}
