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

    <title>Manage My Properties</title>

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
              Manage My Properties &nbsp;
              <a href="/<?= $BASEAPP;?>/addproperties.php" class="btn btn-success">Add</a>
              <a href="/<?= $BASEAPP;?>/myproperties.php" class="btn btn-primary pull-right">My Properties</a>
          </h4>
          <hr>
        </div>
      </div>
    
      <div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>TITLE</th>
              <th>PRICE</th>
              <th>SIZE</th>
              <th>OWNER PHONE</th>
              <th>OWNER EMAIL</th>
              <th>STATUS</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // list all properties
            $query = $db->query("SELECT * FROM properties WHERE author_id = '".$_SESSION['userId']."' ORDER BY id DESC");
            $getNumRows = $query->num_rows; $n = 0;
            while($rows = $query->fetch_assoc()) { $n++; ?>
              <tr>
                <td><?= $n;?></td>
                <td><?= $rows['property_title'];?></td>
                <td><?= $rows['price'];?></td>
                <td><?= $rows['size'];?></td>
                <td><?= $rows['owner_phone'];?></td>
                <td><?= $rows['owner_email'];?></td>
                <td><?= ($rows['status'] == '2') ? 'Publish' : 'Draft';?></td>
                <td>
                  <a href="/<?= $BASEAPP;?>/changecover.php?id=<?=$rows['id'];?>" class="btn btn-sm btn-info" title="Change Cover Images">cover</a> 
                  <a href="/<?= $BASEAPP;?>/addproperties.php?id=<?=$rows['id'];?>" class="btn btn-sm btn-primary" title="Change Informations">edit</a>
                  <a href="/<?= $BASEAPP;?>/config/processproperties.php?action=delete&id=<?=$rows['id'];?>" class="btn btn-sm btn-danger" title="Delete Property">delete</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>