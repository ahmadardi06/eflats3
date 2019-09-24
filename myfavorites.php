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

    <title>My Favorites</title>

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
    			<h4>
            My Favorites
          </h4>
          <hr>
        </div>
    </div>
    <div class="row">
        <?php
        // display my favorites from table favorites
        $query = $db->query("SELECT f.*, p.* FROM favorites f JOIN properties p ON p.id = f.property_id WHERE f.customer_id = '".$_SESSION['userId']."' ORDER BY f.id DESC");
        $getNumRows = $query->num_rows;
        while($rows = $query->fetch_assoc()) { ?>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <img src="/<?= $BASEAPP;?>/img/<?= $rows['main_image'];?>" alt="Title">
              <div class="caption">
                <h3><?= $rows['property_title'];?></h3>
                <p>
                  <b>Price : </b> <?= $rows['price'];?><br>
                  <b>Size : </b> <?= $rows['size'];?><br>
                  <b>Phone : </b> <?= $rows['owner_phone'];?><br>
                </p>
                <p>
                  <a href="/<?= $BASEAPP;?>/moreproperties.php?id=<?= $rows['id'];?>" class="btn btn-primary" role="button">More</a> 
                  <a href="/<?= $BASEAPP;?>/config/removefavorite.php?item=<?=$rows['property_id'];?>" class="btn btn-danger" role="button">Remove</a>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>