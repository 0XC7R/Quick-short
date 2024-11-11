<?php 

// we dont pre-define as if we do we cannot include it into any other pages resulting in a useless component page.
// It will read the "IN_APP" that is defined from the including script/includer which will already have "IN_APP" defined.

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php");
    exit();
}

?>

<!-- HTML HERE -->