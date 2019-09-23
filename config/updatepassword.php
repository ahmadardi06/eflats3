<?php
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	$password = md5($_POST['password']);

	if($_POST['level'] == 'admin') {
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_POST['level'] == 'customer') {
		$table = 'customer'; $fieldId = 'customer_id';
	}

	$query = $db->query("UPDATE ".$table." SET password = '".$password."' WHERE ".$fieldId." = '".$_POST['id']."'");
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_POST['id']." Update Password')");
	header('location: /eflats3/myprofile.php?message=update_password_success');
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}