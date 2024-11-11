<?php

// configure server files (like .htaccess for apache) to make this page active.

require_once "globals.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>404 | Quick Short</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="/public/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 m-2">
                <!-- Card -->
                <div class="card shadow m-2">
                    <div class="card-body text-center">
                        <div class="container mt-1" style="border-radius: 10px">
                            <img src="public/images/logo.png" width="35" height="35" class="m-2">
                            <h5 class="mb-4 Result"><b>404 Not found</b></h5>
                            <h6 class="mb-4 Result"><b>Looks like you tried to visit an non-existant page!</b></h6>
                            <h6 class="mb-4 Result"><b>Click the below button to go home or <a href="/index.php">click me!</a></b></h6>

                            <div class="col-10 text-center mx-auto">
                                <form method="post">

                                    <div class="row justify-content-center">
                                        <div class="m-3 col">
                                            <label class="form-label Result"><b>Click the button below to go home!</b></label>
                                            <input type="text" type="url" name="url" class="InputBox form-control" required>

                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Go Home</button>

                                </form>

                                <br>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>