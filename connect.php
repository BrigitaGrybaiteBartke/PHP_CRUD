<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud";

    $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con) {
        die(mysqli_connect_error());
    } else {
        echo "Connected successfully!";
    }


?>
