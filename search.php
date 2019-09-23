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

    <title>Search</title>

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
            Search Keywords: <?= $_GET['keywords'];?>
          </h4>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <h3><b>Filter</b></h3>
          <div class="panel panel-default">
            <div class="panel-body">
              <form action="/<?= $BASEAPP;?>/search.php" method="GET">
                <input type="hidden" name="keywords" value="<?= $_GET['keywords'];?>">
                <div class="form-group">
                  <label for="formControlRange">Range Price</label>
                  <input type="range" name="price" min="0" max="1000" class="form-control-range">
                </div>
                <div class="form-group">
                  <label for="formControlRange">Bedroom</label>
                  <input type="number" name="bedroom" class="form-control" value="0">
                </div>
                <div class="form-group">
                  <label for="formControlRange">Bathroom</label>
                  <input type="number" name="bathroom" class="form-control" value="0">
                </div>
                <div class="form-group">
                  <label for="email">Furnished</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="furnished" id="furnished" value="Yes" >
                    <label class="form-check-label" for="furnished">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="furnished" id="furnished" value="No">
                    <label class="form-check-label" for="furnished">
                      No
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">Pet Friendly</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="pet_friendly" id="pet_friendly" value="Yes">
                    <label class="form-check-label" for="pet_friendly">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="pet_friendly" id="pet_friendly" value="No">
                    <label class="form-check-label" for="pet_friendly">
                      No
                    </label>
                  </div>
                </div>
                <input type="submit" name="submit" value="apply" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>

        <?php
        $sql = "SELECT * FROM properties WHERE property_title LIKE '%".$_GET['keywords']."%'";
        if(isset($_GET['pet_friendly'])) $sql .= " AND pet_friendly = '".$_GET['pet_friendly']."'";
        if(isset($_GET['furnished'])) $sql .= " AND furnished = '".$_GET['furnished']."'";
        if(isset($_GET['bathroom']) && $_GET['bathroom'] != '0') $sql .= " AND bathroom = '".$_GET['bathroom']."'";
        if(isset($_GET['bedroom']) && $_GET['bathroom'] != '0') $sql .= " AND bedroom = '".$_GET['bedroom']."'";
        
        $sql .= " AND status = '2' ORDER BY id DESC";
        $query = $db->query($sql);
        $getNumRows = $query->num_rows;
        ?>

        <div class="col-sm-9">
          <h3><b>Results <?= $getNumRows;?></b></h3>
          <div class="panel panel-default">
            <div class="panel-body">
              <?php while($rows = $query->fetch_assoc()) { 
                $expImage = explode(',', $rows['main_image']);
                ?>
                <div class="col-sm-6 col-md-3">
                  <div class="thumbnail">
                    <img src="/<?= $BASEAPP;?>/img/<?= $expImage[0];?>" alt="Title">
                    <div class="caption">
                      <h3><?= $rows['property_title'];?></h3>
                      <p>
                        <b>Price : </b> <?= $rows['price'];?><br>
                        <b>Size : </b> <?= $rows['size'];?><br>
                        <b>Bedrooms : </b> <?= $rows['bedroom'];?><br>
                        <b>Bathrooms : </b> <?= $rows['bathroom'];?><br>
                        <b>Furnished : </b> <?= $rows['furnished'];?><br>
                        <b>Pet Friendly : </b> <?= $rows['pet_friendly'];?><br>
                        <b>Phone : </b> <?= $rows['owner_phone'];?><br>
                      </p>
                      <p>
                        <a href="/<?= $BASEAPP;?>/moreproperties.php?id=<?= $rows['id'];?>" class="btn btn-primary" role="button">More</a> 
                        <?php if(isset($_SESSION['userId'])) { ?>
                          <a href="/<?= $BASEAPP;?>/config/addfavorite.php?item=<?= $rows['id'];?>" class="btn btn-default" role="button">Favorite</a>
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
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>