<?php
    require("connect.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['diseaseId']) && isset($_SESSION['userid'])) {
            $disease_id = $_POST['diseaseId'];
            $user_id = $_SESSION["userid"];

            $sql = "SELECT * FROM favorites WHERE user_id='$user_id' AND disease_id='$disease_id'";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                // Remove the article from the user's favorites list
                $sql = "DELETE FROM favorites WHERE user_id='$user_id' AND disease_id='$disease_id'";
                if ($mysqli->query($sql) === TRUE) {
                    echo "Article removed from favorites.";
                } else {
                    echo "Error removing article from favorites: " . $mysqli->error;
                }
            } else {
                // The article is not in the user's favorites list
                echo "Article is not in favorites.";
            }
        } else {
            echo "Error: diseaseId parameter is not set.";
        }
    }

?>