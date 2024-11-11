<?php

define('IN_APP', true); // dont remove please. You will keep getting redirected to the 404 page otherwise ;)

require_once "globals.php";
require_once "./utils/sql.php"; // sql connection and handles
require "./utils/generate_qr_code.php";

require_once 'vendor/autoload.php';

$protocol = $_SERVER['AUTH_TYPE']; // -> http/https
$domain = $_SERVER['HTTP_HOST']; // if locally hosted or ip: 127.0.0.1 otherwise if its a domain: example.com

if (!isset($protocol)) {
    $protocol = 'http'; // automatically assume http if it cannot resolve the protocol used.
    error_log('Could not determine the protocol used for connection. Assuming HTTP.');
}

$fullUrl = $protocol . '://' . $domain; // http://domain.com

// connect to the database file we are using
$db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

//---------------------------------

function init($db): void
{

    if (!file_exists((string)$GLOBALS['DatabaseName'])) {
        error_log('The database: ' . $GLOBALS['DatabaseName'] . ' Does not exist. Please check permissions', 1);
        exit();
    }

    // create the ShortStorage table and store data for the shorted link data
    // create the UserStorage table and store user data
    // We also use IF NOT EXISTS so we dont delete literally everything from the db which wouldnt be too good.
    $db->exec('');
    $db->exec('CREATE TABLE IF NOT EXISTS ShortStorage (id INTEGER PRIMARY KEY, ResolvedURL TEXT, URLKey TEXT, ExpireTime DATETIME, BurnAfter Boolean, OwnerID TEXT, Locked Boolean, UnlockKey TEXT)');
}

init($db);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Quick Short</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="/public/css/main.css">

    <script src="/public/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <?php include(__DIR__ . '/components/navbar.php'); ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 m-2">
                    <!-- Card -->
                    <div class="card shadow m-2">
                        <div class="card-body text-center">
                            <div class="container mt-1" style="border-radius: 10px">
                                <img src="public/images/icon.png" width="35" height="35" class="m-2">
                                <h5 class="mb-4 Result"><b>Quick Short</b></h5>
                                <h6 class="mb-4 rainbow-text"><b>Shorten your URL's with ease.</b></h6>
                                <h6 class="mb-4 rainbow-text"><b>FOR FREE</b></h6>

                                <div class="col-10 text-center mx-auto">
                                    <div class="row justify-content-center">

                                        <div class="m-3 col">
                                            <label class="form-label Result"><b>Your URL:</b></label>
                                            <?php

                                            $url = $_POST['url'];
                                            $key = InsertNewKey($url);
                                            $target = $fullUrl . "/resolve.php?Key=" . $key;

                                            if ($key === "Error") {
                                                echo "<label class=\"form-label\">There was an issue shortening your url. Please try again later.</label>";
                                            } else {
                                                echo "<a href=\"$target\"><input class=\"InputBox form-control\" type=\"text\" value=\"$target\"readonly></a>";
                                            }

                                            echo "</div>";
                                            echo "<hr> <!-- Add devider makes it look nicer :) -->";
                                            echo "<div>";

                                            $url = $_POST['url'];
                                            $key = InsertNewKey($url);
                                            $qrSvg = GenerateQR($fullUrl . "/resolve.php?Key=" . $key);
                                            ?>
                                        </div>
                                    
                                    </div>

                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php else: ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 m-2">
                    <!-- Card -->
                    <div class="card shadow m-2">
                        <div class="card-body text-center">
                            <div class="container mt-1" style="border-radius: 10px">
                                <img src="public/images/icon.png" width="35" height="35" class="m-2">
                                <h5 class="mb-4 Result"><b>Quick Short</b></h5>
                                <h6 class="mb-4 rainbow-text"><b>Shorten your URL's with ease.</b></h6>
                                <h6 class="mb-4 rainbow-text"><b>FOR FREE</b></h6>

                                <div class="col-10 text-center mx-auto">
                                    <form method="post">

                                        <div class="row justify-content-center">
                                            <div class="m-3 col">
                                                <label class="form-label Result"><b>Your URL:</b></label>
                                                <input type="text" type="url" name="url" class="InputBox form-control" required>

                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Shorten!</button>

                                    </form>

                                    <br>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>

    <?php include(__DIR__ . '/components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>