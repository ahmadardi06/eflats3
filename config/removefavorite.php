<?php
session_start();
require 'db.php';

if(isset($_GET['item'])) {
	$cekRow = $db->query("DELETE FROM favorites WHERE customer_id = '".$_SESSION['userId']."' AND property_id = '".$_GET['item']."'");
	header('location: /'.$BASEAPP.'/myfavorites.php?message=remove_favorite_success');
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}