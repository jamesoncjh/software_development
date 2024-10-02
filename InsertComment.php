<?php
    require ("connect.php");

    $user_id = $_POST['user_id'];
    $disease_id = $_POST['disease_id'];
    $comment = $_POST['comment'];

    // Insert the comment into the database with the current timestamp, user ID, article ID, and comment text
    $sql = "INSERT INTO comments (user_id, disease_id, comment_content, comment_timestamp) VALUES ('$user_id', '$disease_id', '$comment', NOW())";
    $result = $mysqli->query($sql);

        if (!$result) {
            echo "Error: " . mysqli_error($conn);
          } else {
            header ("Location: /SD/Diseases.php?DiseaseId=".urldecode($disease_id));
          }
    
?>