<?php

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php");
    exit();
}


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
    <?php include(__DIR__ . '/navbar.php'); ?>

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

                                        $key = $_GET['Key']; // key from the server
                                        // gets the row data from this function. Think of it as a wrapper.
                                        $row = json_decode(fetchUrlFromKey($key), true);
                                        $url = $row["ResolvedURL"];

                                        if ($url === "Error") {
                                            echo "<label class=\"form-label\">There was an issue resolving your url from the given key. Please try again later.</label>";
                                        } else {
                                            echo "<input id=\"urlbox\" class=\"InputBox form-control\" type=\"text\" value=\"$url\"readonly onclick=\"CopyClip()\">";
                                        }

                                        echo "</div>";
                                        echo "<hr> <!-- Add devider makes it look nicer :) -->";
                                        echo "<div>";

                                        if ($url === "Error") {
                                            echo "Could not generate QR code due to an issue with resolving the url from the inputted key.";
                                        } else {
                                            $qrSvg = GenerateQR($url);
                                        }
                                        
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php include(__DIR__ . '/footer.php'); ?>
</body>

</html>