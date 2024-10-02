<?php
	require("connect.php");
	session_start();

    $user_id = $_SESSION['userid'];
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+012 345 6789</a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>HealthDetection@outlook.com</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <?php if((isset($_SESSION['isLogin'])) && $_SESSION['isLogin'] == TRUE){
                        if($_SESSION['role']=='user'){
                            echo '<a href="Home.php" class="navbar-brand">';
                        }else if($_SESSION['role']=='doctor'){
                            echo '<a href="DoctorDashboard.php" class="navbar-brand">';
                        }else{
                        echo'<a href="ManageUser.php?role=user" class="navbar-brand">';
                        }
                    }else{
                        echo'<a href="Home.php" class="navbar-brand">';
                    } 
                ?>
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Health Detection</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=="doctor") { ?>
                            <a href="DoctorDashboard.php" class="nav-item nav-link">Dashboard</a>
                        <?php }else if (isset($_SESSION['role']) && $_SESSION['role']=="admin"){ ?>
                            <a href="ManageUser.php?role=user" class="nav-item nav-link">User</a>
                        <?php }else{ ?>
                            <a href="Home.php" class="nav-item nav-link">Home</a>
                        <?php } ?>
                        <a href="CheckDiseases.php" class="nav-item nav-link">
                            <?php echo isset($_SESSION['role']) && $_SESSION['role'] == 'doctor' || $_SESSION['role'] == 'admin' ? "Article's Diseases" : 'Check Diseases'; ?>
                        </a>
                        <div class="nav-item dropdown">
                            <a href="Hospital.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Hospital</a>
                            <div class="dropdown-menu m-0">
                            <a class='dropdown-item' href='hospital.php'>All Hospitals</a>
                            <?php
                                $states = array('Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya');
                                foreach ($states as $state) {
                                    $state_param = str_replace(' ', '%20', $state);
                                    $link = "hospital.php?state=".($state_param);
                                    echo "<a class='dropdown-item' href='$link'>$state</a>";
                                }
                            ?>
                            </div>
                        </div>
                        <?php if(!isset($_SESSION['role']) || (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'doctor')){ ?>
                        <a href="AboutUs.php" class="nav-item nav-link">About Us</a>
                        <?php } ?>
                        <?php if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true) { ?>
                        <a href="Profile.php" class="nav-item nav-link active">Profile</a>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                        <?php } else { ?>
                        <a href="Login.php" class="nav-item nav-link">Login</a>
                        <a href="Signup.php" class="nav-item nav-link">Signup</a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    
    <!-- Title Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <!-- <h1 class="display-6 mb-4"></h1> -->
                <?php
                    if(isset($_GET['action']) && $_GET['action']=='edit') {
                        echo '<h1 class="display-6 mb-4">Edit Profile</h1>';
                      } else if(isset($_GET['action']) && $_GET['action']=='changep') {
                        echo '<h1 class="display-6 mb-4">Change Password</h1>';
                      } 
                ?>
                
                <h5 class="fw-normal"></h5>
            </div>
        </div>
    </div>
    <!-- Title End -->
    
    <?php if(isset($_GET['action']) && $_GET['action']=='edit') { ?>
    <div class="container-fluid pt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <!-- <img src="<?php echo $row['profile_image']; ?>" class="img-thumbnail" /> -->
                        <?php
                         if ($row['profile_image']) {
                            echo '<img src="' . $row['profile_image'] . '" class="img-thumbnail" id="profile-img"/>';
                        } else {
                            echo '<img src="img/default-image.jpg" class="img-thumbnail" id="profile-img"/>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Profile Information </h5>
                        <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $row['age']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">--Select Gender--</option>
                                <option value="male" <?php if($row['gender']=='male'){echo 'selected';} ?>>Male</option>
                                <option value="female" <?php if($row['gender']=='female'){echo 'selected';} ?>>Female</option>
                                <option value="other" <?php if($row['gender']=='other'){echo 'selected';} ?>>Other</option>
                            </select>
                        </div>
                        <?php if ( isset($_GET['role']) && $_GET['role'] == 'doctor') : ?>
                            <div class="mb-3">
                                <label for="doctorId" class="form-label fw-bolder">Doctor ID</label>
                                <input type="text" class="form-control" id="doctorid" name="doctorid" value="<?php echo $row['doctor_id']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="hospital">Hospital</label>
                                <select class="form-control" id="hospitalid" name="hospitalid">
                                    <?php
                                    $sql = "SELECT * FROM hospitals WHERE deleted = FALSE ORDER BY hospital_name";
                                    $result = $mysqli->query($sql);
                                    while ($hospital_row = $result->fetch_assoc()) {
                                        $selected = ($hospital_row['hospital_id'] == $row['hospital_id']) ? 'selected' : '';
                                        echo "<option value=\"{$hospital_row['hospital_id']}\" {$selected}>{$hospital_row['hospital_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" name="userid" value="<?php echo $_GET['userid']; ?>">
                        <input type="hidden" name="role" value="<?php echo $_GET['role']; ?>">
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <a href="Profile.php" class="btn btn-primary" name="back">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <?php } else { ?>
    <div class="container-fluid pt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                        </div>
                        <input type="hidden" name="userid" value="<?php echo $_GET['userid']; ?>">
                        <button type="submit" class="btn btn-primary" name="changep">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>       
    <?php } ?>     
                
    <?php     
        if(isset($_POST['update'])){
            $user_id = $_GET['userid'];
            $role = $_GET['role'];

            $username = $_POST['username'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $password = $_POST['password'];
            $doctor_id = $_POST['doctorid'];
            $hospital_id = $_POST['hospitalid'];


            $flag=true;

            $sql = "SELECT * FROM users WHERE email = '$email' AND user_id != '$user_id'";
            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result) > 0) {
                // Email already exists
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('This email has been registered. Please choose another email.');
                window.location.href='EditProfile.php?userid={$user_id}&role={$role}&action=edit' ;
                </script>");
                $flag=false;
            }

            $sql = "SELECT * FROM users WHERE username = '$username' AND user_id != '$user_id'";
            $result = $mysqli->query($sql);
            if(mysqli_num_rows($result) > 0){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('This username has been used. Please choose another username.');
                window.location.href='EditProfile.php?userid={$user_id}&role={$role}&action=edit' ;
                </script>");
                $flag=false;
            }

            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_assoc($result);
            if($password !== $row['password']){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Invalid Password.');
                window.location.href='EditProfile.php?userid={$user_id}&role={$role}&action=edit' ;
                </script>");
                $flag=false;

            }
            
            if($flag==true && $role=='user'){
                $sql = "UPDATE users SET username = '$username', name = '$name', email = '$email', age = '$age', gender = '$gender' WHERE user_id = '$user_id'";
                echo $sql;
            }
            if($flag==true && $role=='doctor'){
                    //$sql = "UPDATE users SET username = '$username', name = '$name', email = '$email', age = '$age', gender = '$gender', doctor_id = '$doctor_id', hospital_id = '$hospital_id' WHERE user_id = '$user_id'";
                $sql = "UPDATE users SET username = '$username', name = '$name', email = '$email', age = '$age', gender = '$gender', doctor_id = '$doctor_id', hospital_id = '$hospital_id' WHERE user_id = '$user_id'";
                echo $sql;
            }

            $result = $mysqli->query($sql);
             
            if($result){
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Update Profile Sucessfully');
                    window.location.href='Profile.php' ;
                    </script>");
            }        
               
        }

        if(isset($_POST['changep'])){
            $user_id = $_GET['userid'];
            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_assoc($result);
            $flag=true;

            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if($row['password'] != $oldPassword){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Invalid Old Password.');
                window.location.href='EditProfile.php?userid={$user_id}&action=changep' ;
                </script>");
                $flag=false;
            }

            if($newPassword != $confirmPassword){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('New Password and Confirm New Password is different.');
                window.location.href='EditProfile.php?userid={$user_id}&action=changep' ;
                </script>");
                $flag=false;
            }

            if($newPassword == $oldPassword){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Your new password is same with old password.');
                window.location.href='EditProfile.php?userid={$user_id}&action=changep' ;
                </script>");
                $flag=false;
            }

            if($flag==true){
                $sql = "UPDATE users SET password = '$newPassword' WHERE user_id = '$user_id'";
                $mysqli->query($sql);
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Change password sucessfully.');
                window.location.href='Profile.php' ;
                </script>");
            }
        }
        

    ?>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                    <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@example.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>