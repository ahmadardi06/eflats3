<?php
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	if($_SESSION['level'] == 'admin') {
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_SESSION['level'] == 'customer') {
		$table = 'customer'; $fieldId = 'customer_id';
	}

	$title = $_POST['property_title'];
	$price = $_POST['price'];
	$size = $_POST['size'];
	$address = $_POST['address'];
	$bedroom = $_POST['bedroom'];
	$bathroom = $_POST['bathroom'];
	$furnished = $_POST['furnished'];
	$petFriendly = $_POST['pet_friendly'];
	$ownerName = $_POST['owner_name'];
	$ownerEmail = $_POST['owner_email'];
	$ownerPhone = $_POST['owner_phone'];
	$description = $_POST['description'];

	if ($_POST['id'] == '') {
		$replaceSpacePhoto = str_replace(' ', '-', $_FILES['main_image']['name']);
		$namePhoto = date('YmdHis').'-'.$replaceSpacePhoto;
		$mainPhoto = $_FILES['main_image']['tmp_name'];
		move_uploaded_file($mainPhoto, '../img/'.$namePhoto);

		$query = $db->query("INSERT INTO properties VALUES (null, '".$title."', '".$namePhoto."', '".$address."', '".$description."', '".$price."', '".$size."', '".$ownerName."', '".$ownerPhone."', '".$ownerEmail."', '".$bedroom."', '".$bathroom."', '".$furnished."', '".$petFriendly."', '".$_SESSION['userId']."', '".$table."', '0')");
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Create New Property')");
		header('location: /'.$BASEAPP.'/manproperties.php?message=add_new_properties');
	} else {
		$query = $db->query("UPDATE properties SET property_title = '".$title."', address = '".$address."', description = '".$description."', price = '".$price."', size = '".$size."', owner_name = '".$ownerName."', owner_phone = '".$ownerPhone."', owner_email = '".$ownerEmail."', bedroom = '".$bedroom."', bathroom = '".$bathroom."', furnished = '".$furnished."', pet_friendly = '".$petFriendly."' WHERE id = '".$_POST['id']."'");
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Update Property')");
		header('location: /'.$BASEAPP.'/manproperties.php?message=update_properties');
	}

} else {
	if(isset($_GET['action'])) {
		if($_GET['action'] == 'delete') {
			$getData = $db->query("SELECT main_image FROM properties WHERE id = '".$_GET['id']."'")->fetch_assoc();
			unlink('../img/'.$getData['main_image']);
			$query = $db->query("DELETE FROM properties WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/manproperties.php?message=delete_properties');
		} else if($_GET['action'] == 'publish') {
			$query = $db->query("UPDATE properties SET status = '2' WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/myproperties.php?message=publish_properties');
		} else if($_GET['action'] == 'unpublish') {
			$query = $db->query("UPDATE properties SET status = '0' WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/myproperties.php?message=unpublish_properties');
		} else if($_GET['action'] == 'active') {
			$query = $db->query("UPDATE customer SET active = '1' WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=active_customer');
		} else if($_GET['action'] == 'deactive') {
			$query = $db->query("UPDATE customer SET active = '0' WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=deactive_customer');
		} else if($_GET['action'] == 'deletecustomer') {
			$query = $db->query("DELETE customer WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=delete_customer');
		}
	} else  {
		$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
		echo json_encode($msg);
	}
}