<?php
require '../config/db.php';

if(isset($_GET['table'])) {
	/**
	* this condition to fetch data from table 
	* ex. api.php?table=customer
	* so the query is "SELECT * FROM customer"
	*/
	$temp = array();
	$sql = "SELECT * FROM ".$_GET['table'];
	$query = $db->query($sql);
	while($row = $query->fetch_assoc()) {
		$temp[] = $row;
	}
	echo json_encode($temp);
} 
else if(isset($_GET['action'])){
	/**
	* this condition to update the status of the customer to be active or value 1
	* ex. api.php?action=activation&email=user@email.com
	* the query is "UPDATE customer SET active = '1' WHERE email = 'user@email.com'"
	*/
	if($_GET['action'] == 'activation') {
		/**
		* this action for activation with update field active
		*/
		$db->query("UPDATE customer SET active = '1' WHERE email = '".$_GET['email']."'");
		header('location: /'.$BASEAPP.'/index.php?message=Link activation has been sent.');
	} 
	else if ($_GET['action'] == 'updatepassword') {
		/**
		* this action for redirect to form update password
		*/
		header('location: /'.$BASEAPP.'/formforgot.php?email='.$_GET['email']);
	}
} else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}