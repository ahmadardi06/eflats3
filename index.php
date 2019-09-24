<?php
ini_set('display_errors', 1);
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

    <title>EFlats</title>

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
  </head>
  <body>

    <?php include 'navigation.php'; ?>

    <div class="container">

      <div id="resultSearch">
        <div class="jumbotron">
          <h1>Flash Sales</h1>
          <p>
            Check this out our properties.
          </p>
        </div>
      </div>

      <hr>
      
      <div class="row">
        <h3 class="text-center">New Coming</h3><br>
        <?php
        // display the data default order by id descending
        $query = $db->query("SELECT * FROM properties WHERE status = '2' ORDER BY id DESC");
        $getNumRows = $query->num_rows;
        while($rows = $query->fetch_assoc()) { 
          // explode main_image value to an array
          $expImage = explode(',', $rows['main_image']);
          ?>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <!-- get first main_image -->
              <img src="/<?= $BASEAPP;?>/img/<?= $expImage[0];?>" alt="Title">
              <div class="caption">
                <h3><?= $rows['property_title'];?></h3>
                <p>
                  <b>Price : </b> <?= $rows['price'];?><br>
                  <b>Size : </b> <?= $rows['size'];?><br>
                  <b>Phone : </b> <?= $rows['owner_phone'];?><br>
                </p>
                <p>
                  <a href="/<?= $BASEAPP;?>/moreproperties.php?id=<?= $rows['id'];?>" class="btn btn-primary" role="button">More</a> 

                  <!-- if session userId is not empty so showing button favorites with link -->
                  <?php if(isset($_SESSION['userId'])) { ?>
                    <a href="/<?= $BASEAPP;?>/config/addfavorite.php?item=<?= $rows['id'];?>" class="btn btn-default" role="button">Favorite</a>
                  
                  <!-- else session userId is empty so showing button favorites with popup -->
                  <?php } else { ?>
                    <a href="#" data-toggle="modal" data-target="#myFirstLogin" class="btn btn-default" role="button">Favorite</a>
                  <?php } ?>

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
