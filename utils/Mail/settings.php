<?php

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php"); 
    exit();
}

// copied from docs: https://github.com/PHPMailer/PHPMailer

require_once __DIR__ . '/../../globals.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . './settings.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'user@example.com';                     //SMTP username
$mail->Password   = 'secret';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

// set the From address the user will see after you send your mail
$mail->setFrom('mycompany@example.com', 'Buisness Name here', true); 

$mail->Priority = 1; // Email priority. Options: null (default), 1 = High, 3 = Normal, 5 = low. When null, the header is not set at all.

//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//$mail->addAttachment(__DIR__ . ''); // supply path to the attachment you want to add so /my/path/to/buisness.pdf
?>