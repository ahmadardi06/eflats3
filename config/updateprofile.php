<?php
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$extension = $_POST['extension'];
	$username = $_POST['username'];
	$phonenumber = $_POST['phonenumber'];
	$address = $_POST['address'];
	$email = $_POST['email'];

	if($_POST['level'] == 'admin') {
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_POST['level'] == 'customer') {
		$table = 'customer'; $fieldId = 'customer_id';
	}

	$query = $db->query("UPDATE ".$table." SET username = '".$username."', first_name = '".$firstname."', last_name = '".$lastname."', extension = '".$extension."', email = '".$email."', address = '".$address."', phonenumber = '".$phonenumber."' WHERE ".$fieldId." = '".$_POST['id']."'");
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_POST['id']." Updated')");
	header('location: /'.$BASEAPP.'/myprofile.php?message=update_user_success');
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}