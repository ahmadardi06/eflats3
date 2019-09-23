<?php
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$query = $db->query("SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."'");
	$getNumRow = $query->num_rows;
	$getFetchRow = $query->fetch_assoc();
	if($getNumRow == 1) {
		// record logs
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'Admin Login')");

		$_SESSION['level'] = 'admin';
		$_SESSION['userId'] = $getFetchRow['admin_id'];
		header('location: /eflats3/index.php');
	} else {
		header('location: /eflats3/index.php?message=Username or password not found.');
	}
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}