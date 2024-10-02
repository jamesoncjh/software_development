<?php
	require("connect.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
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
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+60 182512686</a>
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
                <h1 class="display-6 mb-4">User Profile</h1>
                <h5 class="fw-normal"></h5>
            </div>
        </div>
    </div>
    <!-- Title End -->

    <?php
        if(isset($_SESSION["userid"]) && isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && isset($_SESSION['role']) && isset($_SESSION['approved'])){
            $roles = array(
                'user' => array('username', 'name', 'age', 'email', 'gender'),
                'doctor' => array('username', 'name', 'age', 'email', 'gender', 'doctor_id', 'hospital_name'),
                'admin' => array('username', 'name', 'age', 'email', 'gender'),
            );
            $user_id = $_SESSION["userid"];
            $role = $_SESSION["role"];
            $approved = $_SESSION["approved"];
            if (!isset($roles[$role])) {
                echo 'Invalid user role.';
                return;
            }
            if($role=='user' || $role=='admin')
                $sql = "SELECT u.* FROM users u  WHERE u.user_id = $user_id";
            if($role=='doctor')
                $sql = "SELECT u.*, h.hospital_name FROM users u INNER JOIN hospitals h ON u.hospital_id = h.hospital_id WHERE u.user_id = $user_id";
            $result = $mysqli->query($sql);
            // echo $sql;
            
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
                    case "admin":
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
                        $hospitalSql = "SELECT hospital_name FROM hospitals WHERE hospital_id = $hospitalId AND deleted = FALSE";
                        $hospitalResult = $mysqli->query($hospitalSql);
                        if ($hospitalResult->num_rows > 0) {
                            $hospitalRow = $hospitalResult->fetch_assoc();
                            $currentWorkingHospital = $hospitalRow['hospital_name'];
                        }
                        // Format doctor id
                        //$doctorIdentityNumber = str_pad($row['doctor_id'], 6, '0', STR_PAD_LEFT);
                        $doctorIdentityNumber = $row['doctor_id'];
                        break;
                    default:
                        $labels = [];
                }
                // Display user's profile using Bootstrap 5
                echo '<div class="container-fluid">';
                echo '<div class="d-flex justify-content-center">';
                echo '<div class="row my-4 col-10">';
                // Column for the profile image
                echo '<div class="col-md-6">';
                if ($row['profile_image']) {
                    echo '<img src="' . $row['profile_image'] . '" class="img-thumbnail text-center" id="profile-img" style="width: 500px; height=50px;"/>';
                } else {
                    echo '<img src="img/default-image.jpg" class="img-thumbnail" id="profile-img" style="width: 500px; height=450px;"/>';
                }
                echo '<form method="post" enctype="multipart/form-data">';
                echo '<div class="mb-2 mt-3">';
                // echo '<label for="file" class="form-label">Upload Profile Image</label>';
                echo '<input type="file" class="form-control" id="file" name="file" style="width: 500px;" required>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-secondary" name="upload">Upload</button>';
                echo '</form>';
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
                echo '<div class="row">';
                echo '<input type="hidden" name="userid" value="' . $user_id . '">';
                echo '<div class="col-3">';
                echo '<a href="EditProfile.php?userid='.$user_id.'&role='.$role.'&action=edit"><button type="button" class="btn btn-secondary">Edit Profile</button></a>';
                echo '</div>';
                echo '<div class="col-4">';
                echo '<a href="EditProfile.php?userid='.$user_id.'&action=changep"><button type="button" class="btn btn-secondary">Change Password</button></a>';
                echo '</div>';
                if($_SESSION['role']=='user'){
                    echo '<div class="col-3">';
                    echo '<a href="FavArticle.php?userid='.$user_id.'"><button type="button" class="btn btn-primary">Favorite</button></a>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
           
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES['file']['name']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES['file']['tmp_name']);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('File is not an image.');
                    </script>");
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES['file']['size'] > 500000) {
                    echo "Sorry, your file is too large.";
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('File size is too big.');
                    </script>");
                    $uploadOk = 0;
                }
            
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                        </script>");
                    $uploadOk = 0;
                }
            
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                        $sql = "UPDATE users SET profile_image = '$target_file' WHERE user_id = $user_id";
                        $result = $mysqli->query($sql);
                        if ($result) {
                            // update the profile image on the page
                            echo "<script>";
                            echo "var img = document.getElementById('profile-img');";
                            echo "img.src = '$target_file';";
                            echo "</script>";
                        } else {
                            echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Error updating profile image.');
                            </script>");
                        }
                    }
                }
            }
        }
    ?>


    <!-- Footer Start -->
    <?php if(!isset($_SESSION['role']) || (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'doctor')){ ?>
     <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                    <p class="mb-4">Try find your disease or symptoms at here. Dont be shy to ask question.</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>No.1, Persiaran Bukit Utama, Bandar Utama, 47800 Petaling Jaya, Selangor</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>HealthDetection@outlook.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+60 182512686</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="Home.php"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="AboutUs.php"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="CheckDiseases.php"><i class="fa fa-angle-right me-2"></i>Check Diseases</a>
                        <a class="text-light mb-2" href="Hospital.php"><i class="fa fa-angle-right me-2"></i>Hospital</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="Home.php"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="AboutUs.php"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="CheckDiseases.php"><i class="fa fa-angle-right me-2"></i>Check Diseases</a>
                        <a class="text-light mb-2" href="Hospital.php"><i class="fa fa-angle-right me-2"></i>Hospital</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">FOLLOW US</h4>
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
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">Health Detection</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-primary" href="AboutUs.php">Health Detection</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <?php } ?>


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
    <script>
        $(document).ready(function() {
            // Listen for form submit event
            $('#profile-image-form').on('submit', function(e) {
                e.preventDefault();
                // Get form data
                var formData = new FormData(this);
                // Submit form data using AJAX
                $.ajax({
                url: 'Profile.php', // Change this to your upload script
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    // Update profile image
                    $('#profile-image-container img').attr('src', data.image_url);
                    // Show success message
                    alert('Profile image updated successfully!');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Show error message
                    alert('Error updating profile image: ' + errorThrown);
                }
                });
            });
        });
    </script>
</body>

</html>