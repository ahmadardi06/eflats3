<?php
/**
* This file serves to check whether the password now 
* matches the password used. if it matches it will return true or false
*/

session_start();
require '../config/db.php';

if($_POST) {
	/**
	* this condition to handle method POST and get value with field name pass
	* password ecrypted with md5 hashing
	*/
	$pass = md5($_POST['pass']);
	$checkRow = $db->query("SELECT * FROM customer WHERE password = '".$pass."'")->num_rows;
	if($checkRow == 1) {
		// final response
		echo true;
	} else {
		// final response
		echo false;
	}
} else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}