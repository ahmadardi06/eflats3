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

    <title>Change Main Covers</title>

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
              Change Main Covers &nbsp;
              <a href="/<?= $BASEAPP;?>/manproperties.php" class="btn btn-success">Back</a>
              <a href="/<?= $BASEAPP;?>/myproperties.php" class="btn btn-primary pull-right">My Properties</a>
            </h4>
          <hr>
        </div>
      </div>
    
      <div class="row">
        <div class="col-sm-12">
            <?php
            if(isset($_GET['id'])) {
                $get = $db->query("SELECT * FROM properties WHERE id = '".$_GET['id']."'")->fetch_assoc();
            } else {
                $get = array('id'=>'','property_title'=>'','price'=>'','size'=>'','address'=>'','bedroom'=>'','bathroom'=>'','furnished'=>'','pet_friendly'=>'','owner_name'=>'','owner_email'=>'','owner_phone'=>'','description'=>'');
            }
            ?>
          <form enctype="multipart/form-data" class="form-horizontal" action="/<?= $BASEAPP;?>/config/processchangecover.php" method="post">
            <h5><b>Information Property</b></h5>
            <hr>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Property Main Photo: </label>
                <div class="col-sm-6">
                    <input type="hidden" name="id" value="<?=$get['id'];?>">
                    <input type="hidden" name="level" value="<?=$_SESSION['level'];?>">
                    <input name="main_image[]" type="file" class="form-control" required multiple>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-success" >Save Property</button>
                    <a href="/<?= $BASEAPP;?>/manproperties.php" class="btn btn-default">Back</a>
                </div>
            </div>
          </form>
          </div>
        </div>
      </div>

    </div>

    <?php include 'footer.php'; ?>
</body>
</html>