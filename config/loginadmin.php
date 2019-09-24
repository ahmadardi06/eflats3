<?php
/**
* file process for login with user admin 
*/

session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	/**
	*	handle method POST
	* get field username & password
	*/
	$username = $_POST['username'];

	// password hash with md5 hashing
	$password = md5($_POST['password']);

	// before we login we must be check username and password on table admin
	$query = $db->query("SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."'");

	// get num and data rows
	$getNumRow = $query->num_rows;
	$getFetchRow = $query->fetch_assoc();
	
	if($getNumRow == 1) {
		// insert record logs
		// condition username and password existing
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'Admin Login')");

		// set session level and userId
		$_SESSION['level'] = 'admin';
		$_SESSION['userId'] = $getFetchRow['admin_id'];
		
		// redirect to index.php
		header('location: /'.$BASEAPP.'/index.php');

	} else {
		// condition if username or password not found
		// auto redirect index.php with message
		header('location: /'.$BASEAPP.'/index.php?message=Username or password not found.');
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