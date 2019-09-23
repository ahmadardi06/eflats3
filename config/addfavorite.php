<?php
session_start();
require 'db.php';

if(isset($_GET['item'])) {
	$cekRow = $db->query("SELECT * FROM favorites WHERE customer_id = '".$_SESSION['userId']."' AND property_id = '".$_GET['item']."'")->num_rows;
	if($cekRow != 1) {
		$query = $db->query("INSERT INTO favorites VALUES (null, '".$_SESSION['userId']."', '".$_GET['item']."', '".date('Y-m-d H:i:s')."')");
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User Customer ".$_SESSION['userId']." Add Favorite ".$_GET['item']."')");
		header('location: /'.$BASEAPP.'/index.php?message=add_favorite_success');
	} else {
		header('location: /'.$BASEAPP.'/index.php?message=already_favorite_success');
	}
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}