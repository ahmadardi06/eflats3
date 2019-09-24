<?php
/**
* this file serves for deactive customer account
*/
session_start();
require 'db.php';

if(isset($_GET['action'])) {
	/**
  * condition for deactive customer with update field active to 0
  */
	$db->query("UPDATE customer SET active = '0' WHERE customer_id = '".$_SESSION['userId']."'");
	
	// automatically logout
	session_destroy();

	// and redirect to index with message
	header('location: /'.$BASEAPP.'/index.php?message=Deactive your account.');
} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}