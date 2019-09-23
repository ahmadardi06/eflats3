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

    <title>Detail Properties</title>

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
              Detail Properties &nbsp;
              <a href="/eflats3/myproperties.php" class="btn btn-success">Back</a>
              <a href="/eflats3/manproperties.php" class="btn btn-primary pull-right">Manage Properties</a>
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
          <form enctype="multipart/form-data" class="form-horizontal" action="/eflats3/config/processproperties.php" method="post">
            <h5><b>Information Property</b></h5>
            <hr>
            <img src="/eflats3/img/<?=$get['main_image'];?>" class="img-thumbnail">
            <br><br>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Property Title: </label>
                <div class="col-sm-6">
                    <input type="hidden" name="id" value="<?=$get['id'];?>">
                    <input disabled value="<?=$get['property_title'];?>" name="property_title" type="text" class="form-control" placeholder="Enter Title" required>
                </div>
            </div>
            <?php if(!isset($_GET['id'])) { ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Property Main Photo: </label>
                <div class="col-sm-6">
                    <input name="main_image" type="file" class="form-control" required>
                </div>
            </div>
            <?php } ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Rent Per Week: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['price'];?>" name="price" type="text" class="form-control" placeholder="Enter Price" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Size Square Foot: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['size'];?>" name="size" type="text" class="form-control" placeholder="Enter Size" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Address: </label>
                <div class="col-sm-6">
                    <textarea disabled class="form-control" name="address" placeholder="Enter Address" required><?=$get['address'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Bedrooms: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['bedroom'];?>" name="bedroom" type="text" class="form-control" placeholder="Enter Bedrooms" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Bathrooms: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['bathroom'];?>" name="bathroom" type="text" class="form-control" placeholder="Enter Bathrooms" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Is Furnished: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['furnished'];?>" name="bathroom" type="text" class="form-control" placeholder="Enter Bathrooms" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Is Pet Firendly: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['pet_friendly'];?>" name="bathroom" type="text" class="form-control" placeholder="Enter Bathrooms" required>
                </div>
            </div>

            <br><br>
            <h5><b>Information Owner</b></h5>
            <hr>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Owner Name: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['owner_name'];?>" name="owner_name" type="text" class="form-control" placeholder="Enter Owner Name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Owner Email: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['owner_email'];?>" name="owner_email" type="text" class="form-control" placeholder="Enter Owner Email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Owner Phone: </label>
                <div class="col-sm-6">
                    <input disabled value="<?=$get['owner_phone'];?>" name="owner_phone" type="text" class="form-control" placeholder="Enter Owner Phone" required>
                </div>
            </div>

            <br><br>
            <h5><b>Description Property</b></h5>
            <hr>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Description: </label>
                <div class="col-sm-6">
                    <textarea disabled rows="6" class="form-control" name="description" placeholder="Enter Description" required><?=$get['description'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="/eflats3/addproperties.php?id=<?=$get['id'];?>" class="btn btn-success">Update Properties</a>
                    <a href="/eflats3/manproperties.php" class="btn btn-default">Back</a>
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