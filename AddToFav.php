<?php

    require("connect.php");
    // Start the session
    session_start();
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $timestamp = date('Y-m-d H:i:s');


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['diseaseId']) && isset($_SESSION['userid'])){
            $disease_id = $_POST['diseaseId'];
            $user_id = $_SESSION["userid"];
            
            $sql = "SELECT * FROM favorites WHERE user_id='$user_id' AND disease_id='$disease_id'";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                // The article is already in the user's favorites list
                echo "Article is already in favorites.";
            } else {
                // Add the article to the user's favorites list
                $sql = "INSERT INTO favorites (`user_id`, `disease_id`, `addTime`) VALUES ('$user_id', '$disease_id', '$timestamp')";
                if ($mysqli->query($sql) === TRUE) {
                    echo "Article added to favorites.";
                } else {
                    echo "Error adding article to favorites: " . $mysqli->error;
                }
            }
        }else {
            // echo "";
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Error: diseaseId parameter is not set.');
            window.location.href='login.php';
            </script>");
        }           
        
    }
?>
