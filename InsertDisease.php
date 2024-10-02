<?php
    require("connect.php");
    session_start();

    $diseaseName = $_POST['disease-name'];
    $diseaseDesc = $_POST['disease-description'];
    $diseaseSym = $_POST['disease-symptoms'];
    $diseaseTreat = $_POST['disease-treatment'];
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $timestamp = date('Y-m-d H:i:s');
    $user_id = $_POST['userid'];
    $flag = true;

    $checkSql = "SELECT * FROM diseases WHERE disease_name = '$diseaseName'";
    $checkResult = $mysqli->query($checkSql);

    // echo $diseaseName ."<br>";
    // echo $diseaseDesc. "<br>";
    // echo $diseaseSym ."<br>";
    // echo $diseaseTreat . "<br>";

    if ($checkResult->num_rows > 0) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('This disease name has been repeated.');
        window.location.href='CheckDiseases.php?error=insert';
        </script>");
        $flag = false;
    }

    if($flag=true){
        $sql = "INSERT INTO diseases (disease_name, description, symptoms, treatment, upload_time, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $diseaseName, $diseaseDesc, $diseaseSym, $diseaseTreat, $timestamp, $user_id);
        if($stmt->execute()){
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('This disease inserted sucessfully.');
            window.location.href='CheckDiseases.php';
            </script>");
        }
    }
    
    
?>