<?php
session_start();
require '../config/db.php';

if($_POST) {
	$name = $_POST['name'];
	$email = $_POST['email'];

	$checkRow = $db->query("SELECT * FROM customer WHERE email = '".$email."'");
	$getNumRow = $checkRow->num_rows;
	$getDataRow = $checkRow->fetch_assoc();
	if($getNumRow != 1) {
		$query = $db->query("INSERT INTO customer (username, email, first_name, active) VALUES ('".$email."', '".$email."', '".$name."', '1')");
		$_SESSION['level'] = 'customer';
		$_SESSION['userId'] = $db->insert_id;
		echo json_encode(array('status'=>200, 'message'=>'success', 'data'=>$query->insert_id));
	} else {
		$_SESSION['level'] = 'customer';
		$_SESSION['userId'] = $getDataRow['customer_id'];
		echo json_encode(array('status'=>200, 'message'=>'success'));
	}

} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}