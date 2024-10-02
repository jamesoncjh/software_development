<?php
	require("connect.php");
	session_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>View User</title>
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
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>healthcare@outlook.com</a>
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
                <a href="Home.php" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Medinova</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=="doctor") { ?>
                            <a href="DoctorDashboard.php" class="nav-item nav-link">Dashboard</a>
                        <?php }else if (isset($_SESSION['role']) && $_SESSION['role']=="admin"){ ?>
                            <a href="ManageUser.php?role=user" class="nav-item nav-link active">User</a>
                        <?php }else{ ?>
                            <a href="Home.php" class="nav-item nav-link">Home</a>
                        <?php } ?>
                        <a href="CheckDiseases.php" class="nav-item nav-link">Article Diseases</a>
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
                        <a href="Profile.php" class="nav-item nav-link">Profile</a>
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
            <h1 class="display-6 mb-4"><?php echo (($_GET['role']) == 'user') ? 'User' : 'Doctor'; ?> Details</h1>
                <h5 class="fw-normal"></h5>
            </div>
        </div>
    </div>
    <!-- Title End -->

    <?php
    // Check if the view button was clicked
    if (isset($_GET['userid']) && isset($_GET['role'])) {
        // Get the user/doctor ID from the POST request
        $user_id = $_GET['userid'];
        $role = $_GET['role'];
        // $disease_id = $_GET['diseaseid'];
        // echo $disease_id;
        // echo $role;
        // echo $user_id;

        // Query the database to get the user/doctor information
        if($role=='user'){
            $sql = "SELECT u.* FROM users u WHERE u.user_id = $user_id";
            // echo $sql;
        }
        if($role=='doctor'){
            $sql = "SELECT u.*, h.hospital_name FROM users u INNER JOIN hospitals h ON u.hospital_id = h.hospital_id WHERE u.user_id = $user_id";
            // echo $sql;
        }
           
        $result = $mysqli->query($sql);

        // Check if the query was successful
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentWorkingHospital = "";
            $doctorIdentityNumber = "";
            // Set custom labels based on user role
            switch ($role) {
                case "user":
                    $labels = [
                        "username" => "Username",
                        "name" => "Name",
                        "age" => "Age",
                        "email" => "Email",
                        "gender" => "Gender"
                    ];
                    break;
                case "doctor":
                    $labels = [
                        "username" => "Username",
                        "name" => "Name",
                        "age" => "Age",
                        "email" => "Email",
                        "gender" => "Gender",
                        "doctor_id" => "Doctor Identity Number",
                        "hospital_id" => "Hospital ID"
                    ];
                    // Get hospital name
                    $hospitalId = $row['hospital_id'];
                    $hospitalSql = "SELECT hospital_name FROM hospitals WHERE hospital_id = $hospitalId";
                    $hospitalResult = $mysqli->query($hospitalSql);
                    if ($hospitalResult->num_rows > 0) {
                        $hospitalRow = $hospitalResult->fetch_assoc();
                        $currentWorkingHospital = $hospitalRow['hospital_name'];
                    }
                    // Format doctor id
                    $doctorIdentityNumber = str_pad($row['doctor_id'], 6, '0', STR_PAD_LEFT);
                    break;
                default:
                    $labels = [];
            }
            // Display user's profile using Bootstrap 5
            echo '<div class="d-flex justify-content-center">';
            echo '<div class="row my-4 ">';
            // Column for the profile image
            echo '<div class="col-6">';
            if ($row['profile_image']) {
                echo '<img src="' . $row['profile_image'] . '" class="img-thumbnail" style="width: 500px; height=450px;"/>';
            } else {
                echo '<img src="img/default-image.jpg" class="img-thumbnail" style="width: 500px; height=450px;"/>';
            }
            // echo '<form method="post" enctype="multipart/form-data">';
            // echo '<div class="mb-3">';
            // echo '<label for="file" class="form-label">Upload Profile Image</label>';
            // echo '<input type="file" class="form-control" id="file" name="file">';
            // echo '</div>';
            // echo '<button type="submit" class="btn btn-primary" name="upload">Upload</button>';
            // echo '</form>';
            echo '</div>';
        
            // Column for user information
            echo '<div class="col-6">';
            foreach ($labels as $key => $label) {
                if ($key === 'doctor_id') {
                    echo '<p class="my-4">' . $label . ': ' . $doctorIdentityNumber . '</p>';
                } elseif ($key === 'hospital_id') {
                    echo '<p class="my-4">Current Working Hospital: ' . $currentWorkingHospital . '</p>';
                } else {
                    echo '<p class="my-4">' . $label . ': ' . $row[$key] . '</p>';
                }
            }
            echo '<div class="mt-3">';
            if(isset($_GET['diseaseid']) ){
                $disease_id = $_GET['diseaseid'];
                echo '<a href="Diseases.php?DiseaseId='.$disease_id .'" class="btn btn-secondary">Back</a>';
            }
            else if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                if($row['approved']==FALSE){
                    echo '<form method="POST">';
                    echo '<button type="submit" name="approve" class="btn btn-primary">Approve</button>';
                    echo '<input type="hidden" name="userid" value="'.$user_id.'">';
                    // echo '<a href="#" class="btn btn-primary">Deny</a>';
                    echo '</form>';
                }
                echo '<a href="ManageUser.php?role='. $role .'" class="btn btn-secondary mt-3">Back</a>';
            }
            
            echo '</div>';
            echo '</div>';
           
        
            echo '</div>';
            echo '</div>';
        }
    }

    if(isset($_POST['approve'])){
        // get row id from hidden input field
        $user_id = $_POST['userid'];
        // perform database update
        $sql = "UPDATE users SET approved = TRUE WHERE user_id = $user_id";
        // execute the query
        if($mysqli->query($sql)){
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Update Sucessfully.');
            window.location.href='ManageUser.php?role={$role}';
            </script>");
        }else{
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Update Error.');
            window.location.href='ViewUser.php?userid={$user_id}';
            </script>");
        }
    }
    ?>



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
    <!-- <script src="js/main.js"></script> -->
</body>

</html>