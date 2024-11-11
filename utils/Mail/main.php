<?php 

require_once __DIR__ . '/../../globals.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . './settings.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';

global $Mailer; 
$Mailer = $mail; // set to mail from 'settings.php' that way we have our settings defined for us already :D

$Mailer->Encoding = 'base64'; // encoding

function sendMail(array $to , string $subject, string $message, array $headers, array $attachments, string $nonHTMLMessage): bool {
    global $Mailer; // define $Mailer inside function :)

    foreach ($to as $target) {
        $Mailer->addAddress($target); // sets user emails we target useful for bulk send
    }

    foreach ($headers as $key => $value) {
        $Mailer->addCustomHeader($key, $value); // sets headers
    }

    foreach (array_keys($attachments) as $key) {
        $Mailer->addAttachment($attachments[$key]);
    }

    if (isset($subject) && !empty($subject)) {
        $Mailer->Subject = $subject; // sets the subject
    } // we will use the default subject if one is not parsed

    if (isset($message) && !empty($message)) { 
        $Mailer->Body = $message;
    } else {
        throw new Exception('No message parsed in sendMail(). Please define the message to send.');
    }

    return false; // false = error
}

?>