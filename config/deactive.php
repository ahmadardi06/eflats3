<?php
session_start();
require 'db.php';

if(isset($_GET['action'])) {
	$db->query("UPDATE customer SET active = '0' WHERE customer_id = '".$_SESSION['userId']."'");
	session_destroy();
	header('location: /eflats3/index.php?message=deactive_user_success');
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}