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

    <title>EFlats</title>

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
  </head>
  <body>

    <?php include 'navigation.php'; ?>

    <div class="container">
        <div class="row">
            <h2 class="text-center">Set Your Password</h2>
            <br>
            <form action="/<?= $BASEAPP;?>/formforgot.php" method="post">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="input-group">
                        <input type="hidden" name="email" value="<?= $_GET['email'];?>">
                        <input type="password" name="password" placeholder="Enter password" class="form-control" /> 
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="submit" type="submit">Set Password</button>
                        </span>
                    </div>
                </div>
            </form>
            <!-- for handle method POST update new password from link update password -->
            <?php if(isset($_POST['submit'])) { ?>
                <?php
                    $password = md5($_POST['password']);
                    $email = $_POST['email'];
                    $db->query("UPDATE customer SET password = '".$password."' WHERE email = '".$email."'");
                    echo '
                        <p style="margin-top: 75px;" class="text-center">
                            New password has been set. Now you can login with new password.
                            <br>
                            <a href="/'.$BASEAPP.'/index.php">Go to Dashboard</a>
                        </p>
                    ';
                ?>
            <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
