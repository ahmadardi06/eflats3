<?php
/**
* this file serves for registration
*/
session_start();
require 'db.php';
require 'email.php';

if(isset($_POST['submit'])) {
	/**
	* condition for handle method POST
	*/
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	// $extension = $_POST['extension'];
	$extension = '0';
	$username = $_POST['username'];
	$password = md5($_POST['password']);


	// query for new record on table customer with active = '0'
	// active = '0' mean need confirmation email
	$query = $db->query("INSERT INTO customer (customer_id, username, first_name, last_name, extension, password, phonenumber, email, address, active) VALUES (null, '".$username."', '".$firstname."', '".$lastname."', '".$extension."', '".$password."', '', '".$email."', '', '0')");

	// insert logs activity
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'New Customer Created')");

	// we create body for email
	$body = $BASEURL.'/api/api.php?action=activation&email='.$email;

	// process send email with this function
	// this function on file email.php
	sendEmail($email, $_POST['firstname'].' '.$_POST['lastname'], 'Link Activation', $body);

	// redirect to index.php with messsage
	header('location: /'.$BASEAPP.'/index.php?message=Link acivation has been sent to your email. Please check your email.');

} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}