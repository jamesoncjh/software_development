<?php
    require ("connect.php");

    $user_id = $_POST['user_id'];
    $disease_id = $_POST['disease_id'];
    $reply = $_POST['reply'];
    $comment_id = $_POST['comment_id'];

    // Insert the comment into the database with the current timestamp, user ID, article ID, and comment text
    $sql = "INSERT INTO replies (user_id, comment_id, reply_content, reply_timestamp) VALUES ('$user_id', '$comment_id', '$reply', NOW())";
    $result = $mysqli->query($sql);

        if (!$result) {
            echo "Error: " . mysqli_error($mysqli);
          } else {
            header ("Location: /SD/Diseases.php?DiseaseId=".urldecode($disease_id));
          }
    
?>