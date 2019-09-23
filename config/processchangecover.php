<?php
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	if($_SESSION['level'] == 'admin') {
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_SESSION['level'] == 'customer') {
		$table = 'customer'; $fieldId = 'customer_id';
	}

	$getData = $db->query("SELECT main_image FROM properties WHERE id = '".$_POST['id']."'")->fetch_assoc();
	$expImage = explode(',', $getData['main_image']);
	for ($i=0; $i < count($expImage); $i++) { 
		unlink('../img/'.$expImage[$i]);
	}

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

	$query = $db->query("UPDATE properties SET main_image = '".$removeLastCharacter."' WHERE id = '".$_POST['id']."'");
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Update Property')");
		header('location: /'.$BASEAPP.'/manproperties.php?message=update_properties');
} else {
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}