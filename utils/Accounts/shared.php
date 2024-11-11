<?php 

// shared.php holds the functions that both admin and memebers can use. This allows you to have member/admin functions seperate from shared.

require_once __DIR__ . "";
require __DIR__ . "/../sql.php";


// get the authkey, find it in the database and then delete it preventing further use.
function logout($authKey): void {

}

?>