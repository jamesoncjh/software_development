<?php
    require("connect.php");

    $hospitalName = $_POST['hospital-name'];
    $hospitalAddress = $_POST['hospital-address'];
    $hospitalPhone = $_POST['hospital-phone'];
    $hospitalLat = $_POST['hospital-lat'];
    $hospitalLng = $_POST['hospital-lng'];
    $hospitalOperating = $_POST['hospital-operating'];
    $state = $_POST['state'];

    $sql = "SELECT hospital_name FROM hospitals WHERE hospital_name = '$hospitalName' AND deleted=false";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('This hospital name has been repeated.');
        window.location.href='CheckDiseases.php?error=insert';
        </script>");
        // exit;
    }

    $sql = "SELECT hospital_address FROM hospitals WHERE hospital_address = '$hospitalAddress' deleted=false";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('This hospital address has been used.');
        window.location.href='CheckDiseases.php?error=insert';
        </script>");
        // exit;
    }

    $sql = "INSERT INTO hospitals (`hospital_name`, `hospital_address`, `hospital_phone`, `hospital_lat`, `hospital_lng`, `hospital_operating`) VALUES ('$hospitalName', '$hospitalAddress', '$hospitalPhone', '$hospitalLat', '$hospitalLng', '$hospitalOperating')";
    // echo $sql;

    if($mysqli->query($sql)){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('This hospital inserted sucessfully.');
        window.location.href='Hospital.php?state={$state}';
        </script>");
    }
        
?>