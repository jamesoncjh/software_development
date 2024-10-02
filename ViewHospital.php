<?php
	require("connect.php");
	session_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>View Hospital</title>
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
                            <a href="ManageUser.php?role=user" class="nav-item nav-link">User</a>
                        <?php }else{ ?>
                            <a href="Home.php" class="nav-item nav-link">Home</a>
                        <?php } ?>
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

    <?php
    if(isset($_GET['state'])){
        $state = $_GET['state'];
        $sql = "SELECT * FROM hospitals WHERE deleted = FALSE AND hospital_address LIKE '%$state' ORDER BY hospital_name";
    }else{
        $sql = "SELECT * FROM hospitals WHERE deleted = FALSE ORDER BY hospital_name";
    }
        // echo $sql;
       $result = $mysqli->query($sql);
    ?>
    <!-- Title Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <?php 
            if(isset($_GET['state'])){
                $state = $_GET['state'];
                echo '<h1 class="display-6 mb-4">'. $state . ' Hospital Details</h1>';
            }else{
                echo '<h1 class="display-6 mb-4">All Hospital Details</h1>';
            }
            ?>
            
                <h5 class="fw-normal"></h5>
            </div>
        </div>
    </div>
    <!-- Title End -->

    <table class="table mt-5" id="">
    <thead>
        <tr class="text-center">
        <th class="col-2"> Hospital Name </th> 
        <th class="col-2"> Hospital Address </th> 
        <th class="col-2"> Hospital Phone Number </th> 
        <th class="col-2"> Hospital Latitude </th> 
        <th class="col-1"> Hospital Longitude </th> 
        <th class="col-2"> Hospital Operating Time </th> 
        <th colspan="2" class="col-2"> Function </th> 
        </tr>
    </thead>
    <tbody>
        <!-- Generate the table rows for users -->
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr class="text-center">
            <td class="col-2"><?php echo $row['hospital_name']; ?></td>
            <td class="col-2"><?php echo $row['hospital_address']; ?></td>
            <td class="col-2"><?php echo $row['hospital_phone']; ?></td>
            <td class="col-2"><?php echo $row['hospital_lat']; ?></td>
            <td class="col-1"><?php echo $row['hospital_lng']; ?></td>
            <td class="col-2"><?php echo $row['hospital_operating']; ?></td>
            <td class="col-2"><a href="EditHospital.php?HospitalId=<?php echo $row['hospital_id']?>&state=<?php echo $state ?>" class="btn btn-success" name="edit">Edit</a></td>
            <td class="col-2"><a href="DeleteHospital.php?HospitalId=<?php echo $row['hospital_id']?>&state=<?php echo $state ?>" class="btn btn-danger" name="edit">Delete</a></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>



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