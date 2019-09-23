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
    <link rel="icon" href="dist/favicon.ico">

    <title>EFlats v.3</title>

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
  </head>
  <body>

    <?php include 'navigation.php'; ?>

    <div class="container">
      <?php if(isset($_GET['message'])) { ?>
        <div class="alert alert-info">
          <b>Warning!</b>
          <p><?php echo $_GET['message'];?></p>
        </div>
      <?php } ?>
      
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
        $query = $db->query("SELECT * FROM properties WHERE status = '2' ORDER BY id DESC");
        $getNumRows = $query->num_rows;
        while($rows = $query->fetch_assoc()) { ?>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <img src="/eflats3/img/<?= $rows['main_image'];?>" alt="Title">
              <div class="caption">
                <h3><?= $rows['property_title'];?></h3>
                <p>
                  <b>Price : </b> <?= $rows['price'];?><br>
                  <b>Size : </b> <?= $rows['size'];?><br>
                  <b>Phone : </b> <?= $rows['owner_phone'];?><br>
                </p>
                <p>
                  <a href="#" class="btn btn-primary" role="button">More</a> 
                  <?php if(isset($_SESSION['userId'])) { ?>
                    <a href="/eflats3/config/addfavorite.php?item=<?= $rows['id'];?>" class="btn btn-default" role="button">Favorite</a>
                  <?php } else { ?>
                    <a href="javascript:;" onclick="javascript: alert('You must be login first.');" class="btn btn-default" role="button">Favorite</a>
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
