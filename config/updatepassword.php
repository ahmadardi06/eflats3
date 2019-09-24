<?php
/**
* this file serves for update password
*/
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	/**
	* this condition for handle method POST
	*/
	$password = md5($_POST['password']);

	// identify user level and define variable $table & $fieldId
	if($_POST['level'] == 'admin') {
		// condition user admin
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_POST['level'] == 'customer') {
		// condition user customer
		$table = 'customer'; $fieldId = 'customer_id';
	}

	// query for update password with ecnrypted with md5 hashing
	$query = $db->query("UPDATE ".$table." SET password = '".$password."' WHERE ".$fieldId." = '".$_POST['id']."'");

	// insert track logs
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_POST['id']." Update Password')");

	// redirect to myprofile.php with message
	header('location: /'.$BASEAPP.'/myprofile.php?message=Your password has been changed.');
	
} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}