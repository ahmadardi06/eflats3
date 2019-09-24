<?php
/**
* this file serves for update covers main image
* support with multiple image
*/
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	/**
	* handle method POST
	* get field id
	*/

	// we defined variable $table and fieldId for identify user customer or admin
	if($_SESSION['level'] == 'admin') {
		// condition if level admin
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_SESSION['level'] == 'customer') {
		// condition if level customer
		$table = 'customer'; $fieldId = 'customer_id';
	}

	// before we update the main_image we must be remove file images
	// how to save image data by storing only the file names associated with commas
	$getData = $db->query("SELECT main_image FROM properties WHERE id = '".$_POST['id']."'")->fetch_assoc();
	
	// explode data main_image with separate with commas
	// so variable $expImage will be an array
	$expImage = explode(',', $getData['main_image']);
	
	// process remove file on directory img
	for ($i=0; $i < count($expImage); $i++) { 
		unlink('../img/'.$expImage[$i]);
	}

	// now we can process update main_image with new files
	// because it can upload lots of files then $_FILES is an array
	$countFiles = $_FILES['main_image']['name'];

	// define variable $namaFile with empty value
	$namaFile = "";

	// looping as many files as you upload
	for ($i=0; $i < count($countFiles); $i++) { 
		
		// first, we remove all character , and replace with -
		$replaceCommaPhoto = str_replace(',', '-', $countFiles[$i]);
		// second, we remove all character space and replace with -
		$replaceSpacePhoto = str_replace(' ', '-', $replaceCommaPhoto);

		// third, we rename file with format YearMonthDate-nameoriginalfile.extension
		$namePhoto = date('YmdHis').'-'.$replaceSpacePhoto;

		// process upload file
		$mainPhoto = $_FILES['main_image']['tmp_name'][$i];
		move_uploaded_file($mainPhoto, '../img/'.$namePhoto);

		// after success upload we store the name to variable $namaFile
		// so end values ex. img1.jpg,img2.jpg,img3.jpg,
		$namaFile .= $namePhoto.',';
	}

	// we remove last character on variable $namaFile 
	// ex. img1.jpg,img2.jpg,img3.jpg,
	// and final value is img1.jpg,img2.jpg,img3.jpg
	$removeLastCharacter = substr_replace($namaFile ,"", -1);

	// we update field main_image on table properties with 
	// final name file on variable $removeLastCharacter
	$query = $db->query("UPDATE properties SET main_image = '".$removeLastCharacter."' WHERE id = '".$_POST['id']."'");

	// insert record log	
	$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Update Property')");

	// redirect to manproperties.php	
	header('location: /'.$BASEAPP.'/manproperties.php?message=Property has been updated.');
} 
else {
	/**
  * this condition to redirect if you access directly you will get this response
  * method GET
  */
	$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
	echo json_encode($msg);
}