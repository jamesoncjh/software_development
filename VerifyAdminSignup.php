<?php
    session_start();

    require ("connect.php");

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    // $role = $_POST['role'];
    
    
    $sql = "SELECT username FROM users";
    $flag=true;

    // echo $username, $name, $email, $password, $confirmPassword, $gender;
    $result = $mysqli->query($sql);
    //check duplicate username
    while($row = $result -> fetch_array(MYSQLI_NUM)){
        if($username==$row[0]){
            // echo "Sorry, the username already taken. Please try another username";
            // header("Location: AdminSignup.php?username=".$username);
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your username has been used. Please try another username');
            window.location.href='AdminSignup.php';
            </script>");
            $flag=false;
        }
    }

    //check password and confirm password
    if($password!=$confirmPassword){
        // echo "Password and Confirm Password does not match. Please try again.";
        // header("Location: AdminSignup.php?error=Password+Do+Not+Match&name=".$_POST['name']."&email=".$_POST['email']."&gender=".$_POST['gender']);
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Password and Confirm Password does not match. Please try again.');
            window.location.href='AdminSignup.php';
            </script>");
        $flag=false;
    }

    if($age<0 || $age>120){
        // echo "Enter a valid age. Please try again.";
        // header("Location: AdminSignup.php?error=Invalid+Age");
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your age is invalid. Please reenter again');
            window.location.href='AdminSignup.php';
            </script>");
        $flag=false;
    }

    if($flag==true){
        $sql = "INSERT INTO users(`username`, `email`, `password`, `name`, `gender`, `age`, `doctor_id`, `hospital_id`, `role`, `approved`) values ('$username', '$email','$password','$name', '$gender', '$age', NULL, NULL, 'admin', TRUE)";
        $mysqli->query($sql);
        header("Location: AdminLogin.php");
    }
    

?>