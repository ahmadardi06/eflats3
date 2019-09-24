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

		$countFiles = $_FILES['main_image']['name'];
		$namaFile = "";
		for ($i=0; $i < count($countFiles); $i++) { 
			$replaceCommaPhoto = str_replace(',', '-', $countFiles[$i]);
			$replaceSpacePhoto = str_replace(' ', '-', $replaceCommaPhoto);
			$namePhoto = date('YmdHis').'-'.$replaceSpacePhoto;
			$mainPhoto = $_FILES['main_image']['tmp_name'][$i];
			move_uploaded_file($mainPhoto, '../img/'.$namePhoto);
			$namaFile .= $namePhoto.',';
		}
		$removeLastCharacter = substr_replace($namaFile ,"", -1);

		$query = $db->query("INSERT INTO properties VALUES (null, '".$title."', '".$removeLastCharacter."', '".$address."', '".$description."', '".$price."', '".$size."', '".$ownerName."', '".$ownerPhone."', '".$ownerEmail."', '".$bedroom."', '".$bathroom."', '".$furnished."', '".$petFriendly."', '".$_SESSION['userId']."', '".$table."', '0')");
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Create New Property')");
		header('location: /'.$BASEAPP.'/manproperties.php?message=Add property successfully.');
	} else {
		$query = $db->query("UPDATE properties SET property_title = '".$title."', address = '".$address."', description = '".$description."', price = '".$price."', size = '".$size."', owner_name = '".$ownerName."', owner_phone = '".$ownerPhone."', owner_email = '".$ownerEmail."', bedroom = '".$bedroom."', bathroom = '".$bathroom."', furnished = '".$furnished."', pet_friendly = '".$petFriendly."' WHERE id = '".$_POST['id']."'");
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Update Property')");
		header('location: /'.$BASEAPP.'/manproperties.php?message=Update property successfully.');
	}

} else {
	if(isset($_GET['action'])) {
		if($_GET['action'] == 'delete') {
			$getData = $db->query("SELECT main_image FROM properties WHERE id = '".$_GET['id']."'")->fetch_assoc();
			$expImage = explode(',', $getData['main_image']);
			for ($i=0; $i < count($expImage); $i++) { 
				unlink('../img/'.$expImage[$i]);
			}
			$query = $db->query("DELETE FROM properties WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/manproperties.php?message=Property has been deleted.');
		} else if($_GET['action'] == 'publish') {
			$query = $db->query("UPDATE properties SET status = '2' WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/myproperties.php?message=Property published.');
		} else if($_GET['action'] == 'unpublish') {
			$query = $db->query("UPDATE properties SET status = '0' WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/myproperties.php?message=Property unpublish.');
		} else if($_GET['action'] == 'active') {
			$query = $db->query("UPDATE customer SET active = '1' WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=Customer has been activated.');
		} else if($_GET['action'] == 'deactive') {
			$query = $db->query("UPDATE customer SET active = '0' WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=Customer deactivated.');
		} else if($_GET['action'] == 'deletecustomer') {
			$query = $db->query("DELETE customer WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=Customer has been deleted.');
		}
	} else  {
		$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
		echo json_encode($msg);
	}
}