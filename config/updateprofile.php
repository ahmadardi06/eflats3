<?php
/**
* this file serves for update profile not update your password
* update information of your identity
*/
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	/**
	* conditions for handle method POST
	*/

	// get all field from form
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$extension = $_POST['extension'];
	$username = $_POST['username'];
	$phonenumber = $_POST['phonenumber'];
	$address = $_POST['address'];
	$email = $_POST['email'];

	// identify user level with define variable $table & $fieldId
	if($_POST['level'] == 'admin') {
		// condition user admin
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_POST['level'] == 'customer') {
		// condition user customer
		$table = 'customer'; $fieldId = 'customer_id';
	}

	// query for process update information user
	$query = $db->query("UPDATE ".$table." SET username = '".$username."', first_name = '".$firstname."', last_name = '".$lastname."', extension = '".$extension."', email = '".$email."', address = '".$address."', phonenumber = '".$phonenumber."' WHERE ".$fieldId." = '".$_POST['id']."'");

	// insert record logs
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_POST['id']." Updated')");

	// redirect to myprofile.php with message
	header('location: /'.$BASEAPP.'/myprofile.php?message=Update user information.');
	
} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}