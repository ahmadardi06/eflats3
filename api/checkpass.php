<?php
session_start();
require '../config/db.php';

if($_POST) {
	$pass = md5($_POST['pass']);
	$checkRow = $db->query("SELECT * FROM customer WHERE password = '".$pass."'")->num_rows;
	if($checkRow == 1) {
		echo true;
	} else {
		echo false;
	}
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}