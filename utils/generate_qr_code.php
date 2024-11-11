<?php

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php"); 
    exit();
}

require_once __DIR__ . '/../globals.php';
require_once 'vendor/autoload.php';

use chillerlan\QRCode\{QRCode, QROptions};

// please note you can edit the size of the qr code by looking for "scale" in the globals for the "QROptions" config.
function GenerateQR($data)
{
    $QRI = new QRCode($GLOBALS['QROptions']); // Create a new instance of QRCode

    print($QRI->render($data));

    return $QRI->render($data); 
    // You could add a file you want to render with it however it is not needed. 
    // You will need to define the path
}
