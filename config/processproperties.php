<?php
session_start();
require 'db.php';

if(isset($_POST['submit'])) {
	/**
  * this condition for handle method POST
  */

  // identify level user and define variable $table and $fieldId
	if($_SESSION['level'] == 'admin') {
		// condition level admin
		$table = 'admin'; $fieldId = 'admin_id';
	} else if ($_SESSION['level'] == 'customer') {
		// condition level customer
		$table = 'customer'; $fieldId = 'customer_id';
	}

	// get all field from form property
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
		// condition process for new insert data
		// cause field id is empty so mean is new property

		// now we can process insert main_image with new files
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

		// process for new insert records
		$query = $db->query("INSERT INTO properties VALUES (null, '".$title."', '".$removeLastCharacter."', '".$address."', '".$description."', '".$price."', '".$size."', '".$ownerName."', '".$ownerPhone."', '".$ownerEmail."', '".$bedroom."', '".$bathroom."', '".$furnished."', '".$petFriendly."', '".$_SESSION['userId']."', '".$table."', '0')");
		
		// insert record logs
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Create New Property')");
		
		// redirect to manproperties.php with message
		header('location: /'.$BASEAPP.'/manproperties.php?message=Add property successfully.');

	} 
	else {
		// condition process for new update data
		$query = $db->query("UPDATE properties SET property_title = '".$title."', address = '".$address."', description = '".$description."', price = '".$price."', size = '".$size."', owner_name = '".$ownerName."', owner_phone = '".$ownerPhone."', owner_email = '".$ownerEmail."', bedroom = '".$bedroom."', bathroom = '".$bathroom."', furnished = '".$furnished."', pet_friendly = '".$petFriendly."' WHERE id = '".$_POST['id']."'");
		
		// insert record logs
		$db->query("INSERT INTO logs VALUES(null, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', 'User ".$table." ID ".$_SESSION['userId']." Update Property')");

		// redirect to manproperties.php with message
		header('location: /'.$BASEAPP.'/manproperties.php?message=Update property successfully.');
	}

} else {
	
	// this condition for handle method GET
	if(isset($_GET['action'])) {

		if($_GET['action'] == 'delete') {
			// this action for delete property

			// before delete property we must be deleted file main_images too
			$getData = $db->query("SELECT main_image FROM properties WHERE id = '".$_GET['id']."'")->fetch_assoc();

			// explode data main_image with separate with commas
			// so variable $expImage will be an array
			$expImage = explode(',', $getData['main_image']);
			for ($i=0; $i < count($expImage); $i++) { 
				// process for delete the file
				unlink('../img/'.$expImage[$i]);
			}

			// query delete property from table
			$query = $db->query("DELETE FROM properties WHERE id = '".$_GET['id']."'");

			// redirect to manproperties.php
			header('location: /'.$BASEAPP.'/manproperties.php?message=Property has been deleted.');

		} 
		else if($_GET['action'] == 'publish') {
			// this action for publish property
			// update status to 2 
			// ex. processproperties.php?action=publish&id=123
			// query UPDATE properties SET status = '2' WHERE id = '123'
			$query = $db->query("UPDATE properties SET status = '2' WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/myproperties.php?message=Property published.');

		} 
		else if($_GET['action'] == 'unpublish') {
			// this action for upublish property
			// update status to 0 
			// ex. processproperties.php?action=unpublish&id=123
			// query UPDATE properties SET status = '0' WHERE id = '123'
			$query = $db->query("UPDATE properties SET status = '0' WHERE id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/myproperties.php?message=Property unpublish.');

		} 
		else if($_GET['action'] == 'active') {
			// this action for activate the customer
			// update active to 1
			// ex. processproperties.php?action=active&id=123
			// query UPDATE customer SET active = '1' WHERE customer_id = '123'
			$query = $db->query("UPDATE customer SET active = '1' WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=Customer has been activated.');

		} 
		else if($_GET['action'] == 'deactive') {
			// this action for deactivate the customer
			// update active to 0
			// ex. processproperties.php?action=deactive&id=123
			// query UPDATE customer SET active = '0' WHERE customer_id = '123'
			$query = $db->query("UPDATE customer SET active = '0' WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=Customer deactivated.');

		} 
		else if($_GET['action'] == 'deletecustomer') {
			// this action for delete the customer
			// delete record on table customer
			// ex. processproperties.php?action=deletecustomer&id=123
			// query DELETE FROM customer WHERE customer_id = '123'
			$query = $db->query("DELETE FROM customer WHERE customer_id = '".$_GET['id']."'");
			header('location: /'.$BASEAPP.'/allcustomers.php?message=Customer has been deleted.');

		}

	} 
	else  {
		/**
	  * this condition to redirect if you access directly you will get this response
	  * method GET
	  */
		$msg = array('status'=>200, 'message'=>'Not allowed to get this page.');
		echo json_encode($msg);
	}

}
