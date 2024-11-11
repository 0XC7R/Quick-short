<?php

define("LoggedIn", true);

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php");
    exit();
}

?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg Shadow">

    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="public/images/logo.png" width="30" height="24">
        </a>

        <a class="navbar-brand" href="index.php">Quick Short</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <?php if (!defined("LoggedIn")): 
                        // we change the navbar depending on how the users logged in state is.
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>

                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account Management
                            </a>
                            <ul class="dropdown-menu navbar-dark bg-dark">
                                <li><a class="dropdown-item Result" href="dashboard.php">Dashboard</a></li>
                                <li><a class="dropdown-item Result" href="dashboard.php?action=settings" settings">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="btn dropdown-item LogoutButton" href="logout.php">Logout</a></li>
                            </ul>
                        </li>

                    <?php endif; ?>
            </ul>
        </div>
</nav>