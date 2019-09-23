<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'config/db.php';
require 'vendor/autoload.php';
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
        <div class="row">
            <h2 class="text-center">Forgot Your Password</h2>
            <br>
            <form action="/eflats3/forgotpassword.php" method="post">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Enter email" class="form-control" /> 
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="submit" type="submit">Send Link</button>
                        </span>
                    </div>
                </div>
            </form>
            <?php if(isset($_POST['submit'])) { ?>
                <?php
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                    $mail->isSMTP();                                            // Set mailer to use SMTP
                    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'RIGHTHERE';                     // SMTP username
                    $mail->Password   = 'RIGHTHERE';                               // SMTP password
                    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('RIGHTHERE', 'Mailer');
                    $mail->addAddress($_POST['email'], 'Customer');     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Link Update Password';
                    $mail->Body    = 'http://localhost/eflats3/api/api.php?action=updatepassword&email='.$_POST['email'];

                    $mail->send();

                    echo '
                        <p style="margin-top: 75px;" class="text-center">
                            Link has been sent. Check your email.
                            <br>
                            <a href="/eflats3/index.php">Go to Dashboard</a>
                        </p>
                    ';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                ?>
            <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
