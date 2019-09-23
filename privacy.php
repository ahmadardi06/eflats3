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
    <link rel="icon" href="img/home.jpg">

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
    			<h4>Pivacy Policy</h4>
                <hr>
                <p>eFlats.com is a committed to protectng your privacy.</p>
                <br>
                
                <h4>What we collect</h4>
                <hr>
                <p>eFlats needs to collect personal information about you primarily to provide you with the Services, with access to the Website, and with other services related to its business. This personal information may include, but is not limited to, your name, telephone number, street address, email address and credit card details.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
