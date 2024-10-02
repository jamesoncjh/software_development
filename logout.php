<?php

session_start();
if($_SESSION['role'] == 'admin'){
    // if doctor, destroy session and redirect to doctor login page
    session_destroy();
    $isLogin=false;
    header('Location: AdminLogin.php');
    exit;
} else {
    // if admin, destroy session and redirect to admin login page
    session_destroy();
    $isLogin=false;
    header('Location: Login.php');
    exit;
}

?>