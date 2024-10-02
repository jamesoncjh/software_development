<?php
    session_start();

    require ("connect.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    // echo $sql;
    $result = $mysqli->query($sql);

    if (mysqli_num_rows($result) == 0) {
        // No matching user found, redirect back to login page with error message
        // header("Location: login.php?error=invalid");
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Your email or password is incorrect.');
        window.location.href='login.php';
        </script>");

        exit();
    }else{
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
        $_SESSION['role'] = $role;
        $_SESSION['isLogin'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['email']= $row ['email'];
        $_SESSION['password']=$password;
        $_SESSION['userid']= $row ['user_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['approved']= $row['approved'];
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $timestamp = date('Y-m-d H:i:s');
        $user_id = $row['user_id'];
        $update_sql = "UPDATE users SET last_login = '$timestamp' WHERE user_id = $user_id";
        $mysqli->query($update_sql);
        if ($role == 'user') {
            header("Location: Home.php"); 
            
        } else if ($role == 'doctor') {
            header("Location: DoctorDashboard.php");
            
        }else if($role == 'admin'){
            header ("Location: ManageUser.php?role=user");
        }
    }


?>