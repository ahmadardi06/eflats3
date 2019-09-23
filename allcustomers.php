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

    <title>All Customers</title>

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
              All Customers &nbsp;
          </h4>
          <hr>
        </div>
      </div>
    
      <div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>USERNAME</th>
              <th>NAME</th>
              <th>EXTENSION</th>
              <th>EMAIL</th>
              <th>STATUS</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $db->query("SELECT * FROM customer ORDER BY customer_id DESC");
            $getNumRows = $query->num_rows; $n = 0;
            while($rows = $query->fetch_assoc()) { $n++; ?>
              <tr>
                <td><?= $n;?></td>
                <td><?= $rows['username'];?></td>
                <td><?= $rows['first_name'].' '.$rows['last_name'];?></td>
                <td><?= $rows['extension'];?></td>
                <td><?= $rows['email'];?></td>
                <td><?= ($rows['active'] == '1') ? 'Active' : 'Deactive';?></td>
                <td>
                  <?php if($rows['active'] == '1') { ?>
                    <a href="/<?= $BASEAPP;?>/config/processproperties.php?action=deactive&id=<?=$rows['customer_id'];?>" class="btn btn-sm btn-info">deactive</a>
                  <?php } else { ?>
                    <a href="/<?= $BASEAPP;?>/config/processproperties.php?action=active&id=<?=$rows['customer_id'];?>" class="btn btn-sm btn-info">active</a> 
                  <?php } ?>
                  <a href="/<?= $BASEAPP;?>/config/processproperties.php?action=deleteuser&id=<?=$rows['customer_id'];?>" class="btn btn-sm btn-danger">delete</a>
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