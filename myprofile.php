<?php
session_start();
require 'config/db.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="dist/favicon.ico">

    <title>My Profile</title>

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
  </head>
  <body>
    <?php include 'navigation.php'; ?>

    <div class="container">
    	<div class="row">
    		<div class="col-sm-12">
    			<h4>My Profile</h4>
                <hr>
                <?php 
                $table = ''; $fieldId = '';
                if ($_SESSION['level'] == 'admin') {
                    $table = 'admin'; $fieldId = 'admin_id';
                } else {
                    $table = 'customer'; $fieldId = 'customer_id';
                }
                $get = $db->query("SELECT * FROM ".$table." WHERE ".$fieldId." = '".$_SESSION['userId']."'")->fetch_assoc();
                ?>
                <form class="form-horizontal" method="post" action="/eflats3/config/updateprofile.php">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Username: </label>
                        <div class="col-sm-6">
                            <input type="hidden" name="id" value="<?= $get[$fieldId];?>" />
                            <input type="hidden" name="level" value="<?= $_SESSION['level'];?>" />
                            <input required value="<?= $get['username'];?>" name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                    </div>
                    <?php if($table != 'admin') { ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">First Name: </label>
                            <div class="col-sm-6">
                                <input required value="<?= $get['first_name'];?>" name="firstname" type="text" class="form-control" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Last Name: </label>
                            <div class="col-sm-6">
                                <input required value="<?= $get['last_name'];?>" name="lastname" type="text" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Extension: </label>
                            <div class="col-sm-6">
                                <input required value="<?= $get['extension'];?>" name="extension" type="text" class="form-control" placeholder="Enter Extension">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Phone Number: </label>
                            <div class="col-sm-6">
                                <input required value="<?= $get['phonenumber'];?>" name="phonenumber" type="text" class="form-control" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email: </label>
                            <div class="col-sm-6">
                                <input required value="<?= $get['email'];?>" name="email" type="text" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Adress: </label>
                            <div class="col-sm-6">
                                <textarea required name="address" class="form-control" placeholder="Enter Address"><?= $get['address'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="submit" class="btn btn-success" >Save Profile</button>
                            </div>
                        </div>
                    <?php } ?>
                </form>

                <br>
                <h4>Update Password</h4>
                <hr>
                <form class="form-horizontal" method="post" action="/eflats3/config/updatepassword.php">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">New Password: </label>
                        <div class="col-sm-6">
                            <input type="hidden" name="id" value="<?= $get[$fieldId];?>" />
                            <input type="hidden" name="level" value="<?= $_SESSION['level'];?>" />
                            <input id="updatePassword" required value="" name="password" type="password" class="form-control" placeholder="Enter New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">First Name: </label>
                        <div class="col-sm-6">
                            <input id="updateConfirmPassword" required value="" name="confirmpassword" type="password" class="form-control" placeholder="Enter Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button id="btnUpdateRegister" type="submit" name="submit" class="btn btn-success" >Update Password</button>
                        </div>
                    </div>
                </form>
    		</div>
    	</div>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
