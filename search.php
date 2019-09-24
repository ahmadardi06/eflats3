<?php
session_start();
require 'config/db.php';

// this file serves for search the property
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
              <form method="GET" action="/<?= $BASEAPP;?>/search.php">
                <input type="hidden" name="keywords" value="<?= $_GET['keywords'];?>">
                <div class="form-group">
                  <label for="formControlRange">Sort By</label>
                  <select class="form-control" id="sortSearch" name="sortSearch">
                    <option value="price">Price</option>
                  </select>
                  <select style="margin-top: 10px;" class="form-control" id="sortType" name="sortType">
                    <option value="ASC">Lower to Higher</option>
                    <option value="DESC">Higher to Lower</option>
                  </select>
                </div>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
              </form>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <div>
                <input type="hidden" id="txt_keywords" name="keywords" value="<?= $_GET['keywords'];?>">
                <input type="hidden" id="statusLogin" name="statusLogin" value="<?= isset($_SESSION['level']) ? 'true': 'false';?>">
                <div class="form-group">
                  <label for="formControlRange">Price</label>
                  <input id="txt_price" type="number" value="0" name="price" class="form-control">
                </div>
                <div class="form-group">
                  <label for="formControlRange">Bedroom</label>
                  <input id="txt_bedroom" type="number" name="bedroom" class="form-control" value="0">
                </div>
                <div class="form-group">
                  <label for="formControlRange">Bathroom</label>
                  <input id="txt_bathroom" type="number" name="bathroom" class="form-control" value="0">
                </div>
                <div class="form-group">
                  <label for="email">Furnished</label>
                  <div class="form-check">
                    <input id="txt_furnished" class=" form-check-input" type="radio" name="furnished"  value="Yes" checked>
                    <label class="form-check-label" for="furnished">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input id="txt_furnished" class=" form-check-input" type="radio" name="furnished" value="No">
                    <label class="form-check-label" for="furnished">
                      No
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">Pet Friendly</label>
                  <div class="form-check">
                    <input id="txt_pet_friendly" class=" form-check-input" type="radio" name="pet_friendly" value="Yes" checked>
                    <label class="form-check-label" for="pet_friendly">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input id="txt_pet_friendly" class=" form-check-input" type="radio" name="pet_friendly" value="No">
                    <label class="form-check-label" for="pet_friendly">
                      No
                    </label>
                  </div>
                </div>
                <input id="btnApply" type="button" name="apply" value="apply" class="btn btn-primary">
              </div>
            </div>
          </div>
        </div>

        <?php
        $sql = "SELECT * FROM properties WHERE property_title LIKE '%".$_GET['keywords']."%'";
        if(isset($_GET['pet_friendly'])) $sql .= " AND pet_friendly = '".$_GET['pet_friendly']."'";
        if(isset($_GET['furnished'])) $sql .= " AND furnished = '".$_GET['furnished']."'";
        if(isset($_GET['bathroom']) && $_GET['bathroom'] != '0') $sql .= " AND bathroom = '".$_GET['bathroom']."'";
        if(isset($_GET['bedroom']) && $_GET['bathroom'] != '0') $sql .= " AND bedroom = '".$_GET['bedroom']."'";
        
        $sql .= " AND status = '2'";
        if(isset($_GET['sortSearch'])) $sql .= " ORDER BY ".$_GET['sortSearch'];
        if(isset($_GET['sortType'])) $sql .= " ".$_GET['sortType'];

        $query = $db->query($sql);
        $getNumRows = $query->num_rows;
        ?>

        <div class="col-sm-9">
          <h3><b id="searchResultCount">Results <?= $getNumRows;?></b></h3>
          <div class="panel panel-default">
            <div id="searchResult" class="panel-body">
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