<?php
	require("connect.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Delete User</title>
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
                <a href="ManageUser.php?role=user" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Health Detection</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="ManageUser.php?role=user" class="nav-item nav-link active">User</a>
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
        if(isset($_GET['role']) && isset($_GET['userid'])){
            $role = $_GET['role'];
            $user_id = $_GET['userid'];
            if($role=='user'){
                $sql = "SELECT * FROM users WHERE role = 'user'AND user_id = $user_id";
            }else if($role=='doctor'){
                $sql = "SELECT u.*, h.hospital_id, h.hospital_name, h.hospital_address FROM users u INNER JOIN hospitals h ON u.hospital_id = h.hospital_id WHERE u.role = 'doctor' AND user_id = $user_id";
            }
        }
        $result = $mysqli->query($sql);

        $roles = array(
            'user' => array('username', 'name', 'age', 'email', 'gender'),
            'doctor' => array('username', 'name', 'age', 'email', 'gender', 'doctor_id', 'hospital_name'),
        );

        if (!isset($roles[$role])) {
            echo 'Invalid user role.';
            return;
        }
        
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
            echo '<div class="container-fluid">';
            echo '<div class="d-flex justify-content-center">';
            echo '<div class="row my-4 col-10">';
            // Column for the profile image
            echo '<div class="col-md-6">';
            if ($row['profile_image']) {
                echo '<img src="' . $row['profile_image'] . '" class="img-thumbnail text-center" id="profile-img" style="width: 500px; height=250px;"/>';
            } else {
                echo '<img src="img/default-image.jpg" class="img-thumbnail" id="profile-img" style="width: 500px; height=450px;"/>';
            }
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
            echo '<div class="col-3">';
            echo '<form method="post" onsubmit="return confirm(\'Are you sure you want to delete this user?\')">';
            echo '<input type="hidden" name="userid" value="' . $row['user_id'] . '">';
            echo '<input type="hidden" name="role" value="' . $row['role'] . '">';
            echo '<button type="submit" name="delete_user" class="btn btn-danger">Yes</button>';
            echo '</form>';
            echo '</div>';
            echo '<div class="col-4">';
            echo '<a href="ManageUser.php?role='.$role.'" type="button" class="btn btn-secondary">No</a>';
            echo '</div>';
            echo '</div>';
            echo '</div';

            echo '</div>';
            echo '</div>';
        
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        if (isset($_POST['delete_user'])) {
            // Get the user ID from the URL parameter
            $user_id = $_GET['userid'];
            $role = $_GET['role'];
        
            // Delete user replies
            $sql = "DELETE FROM replies WHERE user_id = $user_id";
            $result1 = $mysqli->query($sql);
			
            // Delete user comments
            $sql = "DELETE FROM comments WHERE user_id = $user_id";
            $result2 = $mysqli->query($sql);

            //Delete user favorites
            $sql = "DELETE FROM favorites WHERE user_id = $user_id";
            $result3 = $mysqli->query($sql);

            if($role=='doctor'){
                $sql = "DELETE FROM diseases WHERE user_id = $user_id";
                $result4 = $mysqli->query($sql);
            }

             // Delete user information
             $sql = "DELETE FROM users WHERE user_id = $user_id";
             $result5 = $mysqli->query($sql);
        
            if($role == 'user'){
                if($result1 &&  $result2 &&  $result3 && $result5){
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Delete Sucessfully');
                    window.location.href='ManageUser.php?role={$role}';
                    </script>");
                }else{
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Unable to Delete');
                    window.location.href='DeleteUser.php?userid={$user_id}&role={$role}';
                    </script>");
                }
            }else{
                if($result1 &&  $result2 &&  $result3 && $result4){
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Delete Sucessfully');
                    window.location.href='ManageUser.php?role={$role}';
                    </script>");
                }else{
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Unable to Delete');
                    window.location.href='DeleteUser.php?userid={$user_id}&role={$role}';
                    </script>");
                }
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
    <script src="../js/main.js"></script>

    <!-- <script>
        function toggleUsers() {
            var usersTable = document.getElementById("users-table");
            var doctorsTable = document.getElementById("doctors-table");
            var usersButton = document.getElementById("users-button");
            var doctorsButton = document.getElementById("doctors-button");

            usersButton.classList.add("active");
            doctorsButton.classList.remove("active");

            // Hide the doctors table
            doctorsTable.style.display = "none";

            // Show the users table
            usersTable.style.display = "table";
        }

        function toggleDoctors() {
            var usersTable = document.getElementById("users-table");
            var doctorsTable = document.getElementById("doctors-table");
            var usersButton = document.getElementById("users-button");
            var doctorsButton = document.getElementById("doctors-button");

            usersButton.classList.remove("active");
            doctorsButton.classList.add("active");

            // Hide the users table
            usersTable.style.display = "none";

            // Show the doctors table
            doctorsTable.classList.remove("d-none");
            doctorsTable.style.display = "table";
        }
    </script> -->
</body>

</html>