<?php
	require("connect.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signup</title>
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
                <a href="Home.php" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Health Detection</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=="doctor") { ?>
                            <a href="DoctorDashboard.php" class="nav-item nav-link">Dashboard</a>
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
                        <a href="AboutUs.php" class="nav-item nav-link">About Us</a>
                        <?php if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true) { ?>
                        <a href="Profile.php" class="nav-item nav-link">Profile</a>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                        <?php } else { ?>
                        <a href="Login.php" class="nav-item nav-link">Login</a>
                        <a href="Signup.php" class="nav-item nav-link active">Signup</a>
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
                <h1 class="display-4 mb-4">Signup Account</h1>
                <h5 class="fw-normal"></h5>
            </div>
        </div>
    </div>
    <!-- Title End -->

    <!-- Form Start-->
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="VerifySignup.php">
              <div class="mb-3">
                    <label for="role" class="form-label fw-bolder">User Role</label>
                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="user" value="user">
                                <label class="form-check-label" for="user">Normal User</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="doctor" value="doctor">
                                <label class="form-check-label" for="doctor">Doctor</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label fw-bolder">Username</label>
                  <input type="text" class="form-control" id="username" name="username" pattern="[A-Za-z0-9 ]+" required>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label fw-bolder">Name</label>
                  <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z ]+" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label fw-bolder">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="age" class="form-label fw-bolder">Age</label>
                  <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label fw-bolder">Gender</label>
                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="extra-column" style="display: none;">
                    <div class="mb-3">
                        <label for="doctorId" class="form-label fw-bolder">Doctor ID</label>
                        <input type="text" class="form-control" id="doctorid" name="doctorid" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="hospital">Hospital</label>
                        <select class="form-control" id="hospitalid" name="hospitalid">
                        <?php
                            // $sql = "SELECT * FROM hospitals ORDER BY hospital_name";
                            $sql = "SELECT * FROM hospitals WHERE deleted=0 ORDER BY hospital_name";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"{$row['hospital_id']}\">{$row['hospital_name']}</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-bolder">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="confirm-password" class="form-label fw-bolder">Confirm Password</label>
                  <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Signup</button>
              </form>
            </div>
            <div class="card-footer">
              <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Form End-->

     <!-- Footer Start -->
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
        var role = document.getElementsByName('role');
        var doctorid = document.getElementById('doctorid');

        role.forEach(function(radio){
            radio.addEventListener('change', function() {
                if (this.value === 'doctor') {
                    doctorid.removeAttribute('disabled');
                    
                    document.getElementById('extra-column').style.display = 'block';
                } else {
                    
                    doctorid.setAttribute('disabled', 'disabled');
                    document.getElementById('extra-column').style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>