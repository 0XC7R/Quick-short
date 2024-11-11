<?php

require_once __DIR__ . "/../../globals.php";
require __DIR__ . "/../../utils/sql.php";

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 m-2">
            <!-- Card -->
            <div class="card shadow m-2">
                <div class="card-body text-center">
                    <div class="container mt-1" style="border-radius: 10px">
                        <img src="public/images/icon.png" width="35" height="35" class="m-2">
                        <h5 class="mb-4 Result"><b>Password Protected</b></h5>
                        <h6 class="mb-4 rainbow-text"><b>Enter your key to unlock</b></h6>

                        <div class="col-10 text-center mx-auto">
                            <form method="post">

                                <div class="row justify-content-center">
                                    <div class="m-3 col">
                                        <label class="form-label Result"><b>Password:</b></label>
                                        <input type="text" type="pass" name="pass" class="InputBox form-control" required>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-">Unlock!</button>

                            </form>

                            <br>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>