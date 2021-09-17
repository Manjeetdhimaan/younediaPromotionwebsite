<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'webdes57_prom');
    define('DB_PASSWORD', 'Prom99!!');
    define('DB_NAME', 'webdes57_prom');
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>