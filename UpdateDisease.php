<?php
    require("connect.php");
        
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the new disease information from the form
        // $disease_id = $_GET['DiseaseId'];
        // $new_disease_name = $_POST['disease-name'];
        $disease_id = $_POST['disease_id'];
        $new_symptoms = $_POST['disease-symptoms'];
        $new_description = $_POST['disease-description'];
        $new_treatment = $_POST['disease-treatment'];
    
        // Update the disease information in the database
        $sql = "UPDATE diseases SET symptoms = '$new_symptoms', description = '$new_description', treatment = '$new_treatment', approval = 'PENDING' WHERE disease_id = $disease_id";
        echo $sql;
        // if($mysqli->query($sql)) {
        //     echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Disease updated successfully. It is now pending approval.');
        //     window.location.href='ApproveDisease.php';
        //     </script>");
        // } else {
        //     echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Failed to update disease. Please try again.');
        //     window.location.href='Diseases.php?DiseaseId=$disease_id';
        //     </script>");
        // }
    }
?>