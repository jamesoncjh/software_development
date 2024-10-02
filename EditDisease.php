<?php
    require("connect.php");

    $id = $_POST['id'];
    $description = $_POST['description'];
    $symptoms = $_POST['symptoms'];
    $treatment = $_POST['treatment'];
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $timestamp = date('Y-m-d H:i:s');

    $sql = "UPDATE diseases SET description='$description', symptoms='$symptoms', treatment='$treatment', upload_time='$timestamp' WHERE disease_id='$id'";
    echo $sql;
    $result = $mysqli->query($sql);
    if ($result === false) {
        echo $sql;
    } else {
        echo "Update successful!";
    }

?>  