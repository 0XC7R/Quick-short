<?php 

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php");
    exit();
}

require_once __DIR__ . "/../../globals.php";
require __DIR__ . "/../../utils/sql.php";


?>