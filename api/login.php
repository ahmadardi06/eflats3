<?php
session_start();
require '../config/db.php';

if($_POST) {
	/**
	* this condition for handle method POST
	* get field name and email
	*/
	$name = $_POST['name'];
	$email = $_POST['email'];

	$checkRow = $db->query("SELECT * FROM customer WHERE email = '".$email."'");

	// get count of rows
	$getNumRow = $checkRow->num_rows;

	// get data row
	$getDataRow = $checkRow->fetch_assoc();
	
	// first, check the data existing or not
	if($getNumRow != 1) {

		// condition not existing the query is insert to table
		$query = $db->query("INSERT INTO customer (username, email, first_name, active) VALUES ('".$email."', '".$email."', '".$name."', '1')");

		// set session for sign in with facebook
		$_SESSION['level'] = 'customer';
		$_SESSION['userId'] = $db->insert_id;

		// response with format json
		echo json_encode(array('status'=>200, 'message'=>'success', 'data'=>$query->insert_id));

	} else {
		// condition if have already so we can go straight sign in and set the session
		$_SESSION['level'] = 'customer';
		$_SESSION['userId'] = $getDataRow['customer_id'];

		// response with format json
		echo json_encode(array('status'=>200, 'message'=>'success'));
	}

} else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}