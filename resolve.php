<?php

define("IN_APP", true);

require_once "globals.php";
require_once "./utils/sql.php"; // sql connection and handles
require "./utils/generate_qr_code.php";

require_once 'vendor/autoload.php';

if (!isset($_GET['Key'])) {
    http_response_code(404);
    die("{ error: \"No Key parse\", message: \"Please provide a Key.\"  }"); // mock api output.
} else {
    $key = $_GET["Key"];
}

// this will invoke the Reolve function from utils/sql.php
function fetchUrlFromKey(string $key): array | string
{
    $out = Resolve($key); // get the output of the Resolve function

    // since we json encoded our sql output we will instead check if it is equal to "Error" otherwise if not we assume it is row data.
    if ($out === "Error" || is_null($out) || !isset($out)) {
        $out = "Error";
    }

    return $out; // return either way
}

?>

<?php

// renders the html/php for the key page.
// We seperate it to keep the handler seperate from the designer that being the component page which is key.php.
// If you still dont understand then this page 'resolve' is the handler and the designer is the 'key' page as it stores all our html.
// Dont worry about any undefined functions inside of key.php as long as we define them in the file that include key.php it will be fine.
include __DIR__ . '/components/key.php';

?>