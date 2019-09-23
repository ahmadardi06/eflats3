<?php
session_start();
require 'db.php';
require 'email.php';

if(isset($_POST['submit'])) {
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$extension = $_POST['extension'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$query = $db->query("INSERT INTO customer VALUES (null, '".$username."', '".$firstname."', '".$lastname."', '".$extension."', '".$password."', '', '".$email."', '', '0')");
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'New Customer Created')");
	$body = 'http://localhost/eflats3/api/api.php?action=activation&email='.$email;
	sendEmail($email, $_POST['firstname'].' '.$_POST['lastname'], 'Link Activation', $body);
	header('location: /eflats3/index.php?message=new_user_success');
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}