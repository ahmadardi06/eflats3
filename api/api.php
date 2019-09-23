<?php

require '../config/db.php';

if(isset($_GET['table'])) {
	$temp = array();
	$sql = "SELECT * FROM ".$_GET['table'];
	$query = $db->query($sql);
	while($row = $query->fetch_assoc()) {
		$temp[] = $row;
	}
} else if(isset($_GET['action'])){
	if($_GET['action'] == 'activation') {
		$db->query("UPDATE customer SET active = '1' WHERE email = '".$_GET['email']."'");
		header('location: /eflats3/index.php?message=Link activation has been sent.');
	} else if ($_GET['action'] == 'updatepassword') {
		header('location: /eflats3/formforgot.php?email='.$_GET['email']);
	}
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}