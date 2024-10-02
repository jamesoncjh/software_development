<?php
	require("connect.php");
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Delete Hospital</title>
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
                        <a href="ManageUser.php?role=user" class="nav-item nav-link">User</a>
                        <a href="CheckDiseases.php" class="nav-item nav-link">Article Diseases</a>
                        <div class="nav-item dropdown">
                            <a href="Hospital.php" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Hospital</a>
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
                <h1 class="display-6 mb-2">Hospital Information</h1>
                
                <h5 class="fw-normal"></h5>
            </div>
        </div>
    </div>
    <!-- Title End -->
    
    <?php if(isset($_GET['HospitalId']) && isset($_GET['state'])) {
        $state = $_GET['state']; 
        $hospitalId = $_GET['HospitalId'];
        $sql = "SELECT * FROM hospitals WHERE hospital_id = $hospitalId";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);
         
    ?>
    <div class="container-fluid pt-1 mb-5">
        <div class="row justify-content-center align-items-center">
            <!-- <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <img src="" class="img-thumbnail" />
                    </div>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4"><?php echo $row['hospital_name'] ?> Hospital Information</h4> <hr>
                        <form method="post">
                        <div class="mb-3">
                            <label for="hospital-name" class="form-label fw-bolder h5">Hospital Name</label>
                            <p class="my-3 fs-6"> <?php echo $row['hospital_name']; ?> </p>
                            <!-- <input type="text" class="form-control" id="hospital-name" name="hospital-name" value="<?php echo $row['hospital_name']; ?>"> -->
                        </div>
                        <div class="mb-3">
                            <label for="hospital-address" class="form-label fw-bolder h5">Address</label>
                            <!-- <input type="text" class="form-control" id="hospital-address" name="hospital-address" value="<?php echo $row['hospital_address']; ?>"> -->
                            <p class="my-3 fs-6"> <?php echo $row['hospital_address']; ?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="hospital-phone" class="form-label fw-bolder h5">Phone Number</label>
                            <!-- <input type="tel" class="form-control" id="hospital-phone" name="hospital-phone" value="<?php echo $row['hospital_phone']; ?>"> -->
                            <p class="my-3 fs-6"> <?php echo $row['hospital_phone']; ?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="hospital-lat" class="form-label fw-bolder h5">Latitude</label>
                            <!-- <input type="number" class="form-control" id="hospital-lat" name="hospital-lat" value="<?php echo $row['hospital_lat']; ?>"> -->
                            <p class="my-3 fs-6"> <?php echo $row['hospital_lat']; ?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="hospital-lng" class="form-label fw-bolder h5">Longitude</label>
                            <!-- <input type="number" class="form-control" id="hospital-lng" name="hospital-lng" value="<?php echo $row['hospital_lng']; ?>"> -->
                            <p class="my-3 fs-6"> <?php echo $row['hospital_lng']; ?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="hospital-operating" class="form-label fw-bolder h5">Operating Time</label>
                            <!-- <input type="text" class="form-control" id="hospital-operating" name="hospital-operating" value="<?php echo $row['hospital_operating']; ?>"> -->
                            <p class="my-3 fs-6"> <?php echo $row['hospital_operating']; ?> </p>
                        </div>                        
                        <form method="post" onsubmit="return confirm(\'Are you sure you want to delete this hospital?\')">
                            <input type="hidden" name="hospital-id" value="<?php echo $row['hospital_id']?>">
                            <input type="hidden" name="state" value="<?php echo $state ?>">
                            <!-- <?php echo $row['hospital_id']?> <?php echo $state?> -->
                            <button type="submit" name="delete_hospital" class="btn btn-danger">Yes</button>
                            <a href="ViewHospital.php?state=<?php echo $state ?>" type="button" class="btn btn-secondary">No</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <?php } ?>
                
    <?php     
        if(isset($_POST['update'])){
            $hospital_id = $_GET['HospitalId'];
            $sql = "SELECT * FROM hospitals WHERE hospital_id = '$hospital_id'";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_assoc($result);

            $hospitalName = $_POST['hospital-name'];
            $hospitalAddress = $_POST['hospital-address'];
            $hospitalPhone = $_POST['hospital-phone'];
            $hospitalLat = $_POST['hospital-lat'];
            $hospitalLng = $_POST['hospital-lng'];
            $hospitalOperating = $_POST['hospital-operating'];

            $sql = "SELECT * FROM hospitals WHERE hospital_name = '$hospitalName' AND hospital_id != '$hospital_id'";
            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result) > 0) {
                // Email already exists
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('This hospital name has been registered. Please try again.');
                window.location.href='EditHospital.php?HospitalId={$hospital_id}&state={$state}' ;
                </script>");
            }

            $sql = "SELECT * FROM hospitals WHERE hospital_address = '$hospitalAddress' AND hospital_id != '$hospital_id'";
            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result) > 0) {
                // Email already exists
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('This address has been used. Please try again.');
                window.location.href='EditHospital.php?HospitalId={$hospital_id}&state={$state}' ;
                </script>");
            }
            
            $sql = "SELECT * FROM hospitals WHERE hospital_lat = '$hospitalLat' AND hospital_lng = '$hospitalLng' AND hospital_id != '$hospital_id'";
            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result) > 0) {
                // Email already exists
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('This latitude and longitude has been used. Please try again.');
                window.location.href='EditHospital.php?HospitalId={$hospital_id}&state={$state}' ;
                </script>");
            }

            $sql = "UPDATE hospitals SET hospital_name = '$hospitalName', hospital_address = '$hospitalAddress', hospital_phone = '$hospitalPhone', hospital_lat = '$hospitalLat', hospital_lng = '$hospitalLng', hospital_operating = '$hospitalOperating' WHERE hospital_id = '$hospital_id'";
            if($mysqli->query($sql)){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Edit Sucessfully.');
                window.location.href='ViewHospital.php?state={$state}' ;
                </script>");
            }

        }

        if (isset($_POST['delete_hospital'])) {
            $hospital_id = $_POST['hospital-id'];
            $state = $_GET['state'];
            //echo $hospital_id;

            // Delete user comments
            //$sql = "DELETE FROM hospitals WHERE hospital_id = $hospital_id";
            $sql = "UPDATE hospitals SET deleted=1 WHERE hospital_id = $hospital_id";
            $result = $mysqli->query($sql);
        
        
            if($result){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Delete Sucessfully');
                window.location.href='ViewHospital.php?state={$state}';
                </script>");
            }else{
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Unable to Delete');
                window.location.href='DeleteHospital.php?HospitalId={$hospital_id}&state={$state}.php';
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
    <script src="js/main.js"></script>
</body>

</html>