<?php
// require '/var/www/html/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
// require '/var/www/html/PHPMailer-master/PHPMailer-master/src/SMTP.php';
// require '/var/www/html/PHPMailer-master/PHPMailer-master/src/Exception.php';

require '../Third Party/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = new PHPMailer(true); // Declare $mail outside the function

function sendEmail($mail, $subject, $msg)
{
    try {
        //Server settings
        $mail->SMTPDebug = 0;  // Enable verbose debug output
        $mail->isSMTP();                                       // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                              // Enable SMTP authentication
        $mail->Username   = 'orders.designs1@gmail.com';       // SMTP username (your email address)
        $mail->Password   = 'dwsf buct qpqq qkka';             // SMTP password (your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption
        $mail->Port       = 587;                               // TCP port to connect to

        //Recipients
        $mail->setFrom('orders.designs1@gmail.com', 'Dental Designs'); // Set the sender's email
        $mail->addAddress('bravodent@bravodentdesigns.com', 'Bravodent Design'); // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $msg;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

