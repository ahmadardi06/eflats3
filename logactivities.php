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

    <title>Log Activities</title>

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
              All Activities &nbsp;
          </h4>
          <hr>
        </div>
      </div>
    
      <div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>DATE TIME</th>
              <th>IP ADDRESS</th>
              <th>DETAIL</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // showing log all activities
            $query = $db->query("SELECT * FROM logs ORDER BY log_id DESC");
            $getNumRows = $query->num_rows; $n = 0;
            while($rows = $query->fetch_assoc()) { $n++; ?>
              <tr>
                <td><?= $n;?></td>
                <td><?= $rows['log_time'];?></td>
                <td><?= $rows['log_ip'];?></td>
                <td><?= $rows['log_details'];?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>