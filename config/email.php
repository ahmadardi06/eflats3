<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

/**
* declare function for registration email
* params $to = email of receiver
* params $name = name of receiver
* params $subject = subject email
* params $body = body email
*/
function sendEmail($to, $name, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = 2;                    // Enable verbose debug output
        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                   // Enable SMTP authentication
        $mail->Username   = 'eflatsau@gmail.com';   // SMTP username
        $mail->Password   = 'P@ssw0rdeFlats';       // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                    // TCP port to connect to

        //Recipients
        $mail->setFrom('eflatsau@gmail.com', 'Mailer');
        $mail->addAddress($to, $name);               // Add a recipient

        // Content
        $mail->isHTML(true);                         // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}