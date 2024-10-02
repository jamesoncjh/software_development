<?php 
    $mysqli = new mysqli("localhost", "root", "", "healthcares");

    if($mysqli===false){
        die("Error: could not connect.".$mysqli->connect_error);
    }

?>