<?php
	require("connect.php");
	session_start();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hospital</title>
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
    <link href="css/find.css" rel="stylesheet">

    <!-- Template Map Stylesheet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    
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
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Find Hospital</h5>
                <?php 
                if(isset($_GET['state'])){
                    $state = $_GET['state'];
                    $title = "Find A Medical Institute in $state";
                } else {
                    // If the state parameter is not set, show the default page title
                    $title = "Find A Medical Institute";
                }
                ?>
                <h1 class="display-5 mb-4"><?php echo $title ?></h1>
                <h5 class="fw-normal"></h5>
            </div>
            <form method="GET" action="<?php echo isset($_GET['state']) ? 'Hospital.php?state=' . $_GET['state'] : 'Hospital.php'; ?>">
            <?php
                if(isset($_GET['state'])){
                    $state = $_GET['state'];
                    echo '<input type="hidden" name="state" value="'. $state .'">';
                } 
            ?>
            
            <div class="mx-auto" style="width: 100%; max-width: 600px;">
                <div class="input-group">
                    <input type="text" class="form-control border-primary w-50" name="name" placeholder="Search for a hospital">
                    <button type="submit" class="btn btn-dark border-0 w-25">Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && isset($_SESSION['role']) && $_SESSION['role']=='admin') { ?>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#newHospitalModal" class="btn btn-primary mt-3 px-xxl-4">ADD</button>
                <?php 
                 if(isset($_GET['state'])){
                    $state = urldecode($_GET['state']);
                    echo '<a href="ViewHospital.php?state='.$state.'"class="btn btn-secondary mt-3 px-xxl-4 ms-3">VIEW</a>';
                } else {
                    // If the state parameter is not set, show the default page title
                    echo '<a href="ViewHospital.php"class="btn btn-secondary mt-3 px-xxl-4 ms-3">VIEW</a>';
                }
                ?>
                
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Title End -->

    <!-- Modal Start -->
    <div class="modal fade" id="newHospitalModal" tabindex="-1" aria-labelledby="newHospitalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDiseaseModalLabel">Insert New Hospital</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  action="InsertHospital.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="hospital-name" class="form-label">Hospital Name</label>
                    <input type="text" class="form-control" id="hospital-name" name="hospital-name" placeholder="Example: Shah Alam Hospital" required>
                </div>
                <div class="mb-3">
                    <label for="hospital-address" class="form-label">Address</label>
                    <textarea class="form-control" id="hospital-address" name="hospital-address" placeholder="Example: Persiaran Kayangan, Seksyen 7, 40000 Shah Alam, Selangor" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="hospital-phone" class="form-label">Phone</label>
                    <textarea class="form-control" id="hospital-phone" name="hospital-phone" placeholder="Example: 0355263000" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="hospital-lat" class="form-label">Latitude</label>
                    <textarea class="form-control" id="hospital-lat" name="hospital-lat" placeholder="Example: 3.072193200492175" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="hospital-lng" class="form-label">Longitude</label>
                    <textarea class="form-control" id="hospital-lng" name="hospital-lng" placeholder="Example: 101.48991852682644" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="hospital-operating" class="form-label">Operating Time</label>
                    <textarea class="form-control" id="hospital-operating" name="hospital-operating" placeholder="Example: 24 hours (Monday - Sunday)" required></textarea>
                </div>
                <input type="hidden" name="state" value="<?php echo $state ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <?php
        // Check for error parameter
        if(isset($_GET['error']) && $_GET['error'] == 'insert') {
            // Output JavaScript to open modal on page load
            echo '<script>
                    $(document).ready(function() {
                        $("#newHospitalModal").modal("show");
                    });
                </script>';
        }
    ?>


    <!-- Filter List Result Start -->
    <div class="container">
        <div class="row mb-0 mt-0">
            <div class="col-md-7">
                <div id="map" style="width: 100%; height: 500px"></div>
            </div>
            <div class="col-md-4">
                <?php
                    // Retrieve hospital information from database
                    $state = '';

                    if(isset($_GET['state']) && isset($_GET['name'])){
                        $state = $_GET['state'];
                        $name = $_GET['name'];
                        $sql = "SELECT * FROM hospitals WHERE hospital_address LIKE '%$state' AND hospital_name LIKE '%$name%' AND deleted = FALSE ORDER BY hospital_name";
                        // echo $sql;
                    }
                    else if(isset($_GET['state'])){
                        $state = $_GET['state'];
                        $sql = "SELECT * FROM hospitals WHERE hospital_address LIKE '%$state'AND deleted = FALSE ORDER BY hospital_name";
                        // echo $sql;
                    }else if(isset($_GET['name'])){
                        $name = $_GET['name'];
                        $sql = "SELECT * FROM hospitals WHERE hospital_name LIKE '%$name%' AND deleted = FALSE ORDER BY hospital_name";
                        // echo $sql;
                    }else{
                        $sql = "SELECT * FROM hospitals ORDER BY hospital_name";
                    }

                
                    $result = $mysqli->query($sql);
                    $hospitals = array();
                    
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            $hospital = array(
                                'name' => $row["hospital_name"],
                                'address' => $row["hospital_address"],
                                'phone' => $row["hospital_phone"],
                                'operating' => $row["hospital_operating"],
                                'lat' => $row["hospital_lat"],
                                'lng' => $row["hospital_lng"]
                            );
                            
                            // Add hospital information to hospitals array
                            array_push($hospitals, $hospital);
                        }
                    }
                    // echo count($hospitals);
                    // Display hospital information in Bootstrap cards
                    echo '<div class="card mb-5 mt-3" style="width: 100%; height: 500px"> ';
                    echo '<div class="card-body overflow-auto">';
                    $last_index = count($hospitals) - 1;
                    foreach ($hospitals as $index => $hospital) {
                        $hospital_name = $hospital['name'];
                        if(isset($_GET['name'])){
                        
                            $name = $_GET['name'];
                            $hospital_name = preg_replace('/(' . preg_quote($name, '/') . ')/i', '<span style="background-color: yellow">$1</span>', $hospital['name']);
                        } 
                        echo '<h5 class="card-title">' . $hospital_name . '</h5>';
                        echo '<p class="card-text"> Address: ' . $hospital['address'] . '</p>';
                        echo '<p class="card-text"> Phone Number: ' .$hospital['phone'] . '</p>';
                        echo '<p class="card-text"> Operating Time: ' . $hospital['operating'] . '</p>';
                        echo '<div class="row"> <div class="col">';
                        echo '<button class="btn btn-primary" onclick="showHospitalLocation(' . $hospital['lat'] . ', ' .$hospital['lng'] . ",'" .$hospital['name'] . "'". ')">Show location</button>';
                        $link = 'https://www.google.com/maps/dir/?api=1&destination=' . $hospital['lat'] . ',' .  $hospital['lng'] ;
                        echo '</div> <div class="col">';
                        echo '<button class="btn btn-secondary" onclick="getDirections(\'' . $link . '\')">Get Directions</button>';
                        echo '</div> </div>';
                        if ($index !== $last_index) {
                            // Only print <hr> for previous records
                            echo "<hr>";
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                ?>
            </div>
        </div>
    </div>
    <!-- Filter List Result End-->
    

    <!-- Footer Start -->
    <?php if(!isset($_SESSION['role']) || (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'doctor')){ ?>
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
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- <script src="js/map.js"></script> -->

    <script>
        var map;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            console.log("Latitude: " + lat + ", Longitude: " + lon);

            map = L.map('map').setView([lat,lon], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);

            var currentLocationIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                tooltipAnchor: [16, -28],
                shadowSize: [41, 41]
            });
            L.marker([lat,lon], {icon: currentLocationIcon}).addTo(map).bindPopup("You are here").openPopup();
            // Add markers to map for each hospital location retrieved from database
            
            <?php
                $state = '';

                if(isset($_GET['state']) && isset($_GET['name'])){
                    $state = $_GET['state'];
                    $name = $_GET['name'];
                    // $sql = "SELECT * FROM hospitals WHERE hospital_address LIKE '%$state' AND hospital_name LIKE %$name%' ORDER BY hospital_name";
                    $sql = "SELECT * FROM hospitals WHERE hospital_address LIKE '%$state' AND hospital_name LIKE '%$name%' ORDER BY hospital_name";
                    // echo $sql;
                }
                else if(isset($_GET['state'])){
                    $state = $_GET['state'];
                    $sql = "SELECT * FROM hospitals WHERE hospital_address LIKE '%$state' ORDER BY hospital_name";
                }else if(isset($_GET['name'])){
                    $name = $_GET['name'];
                    $sql = "SELECT * FROM hospitals WHERE hospital_name LIKE '%$name%' ORDER BY hospital_name";
                }else{
                    $sql = "SELECT * FROM hospitals";
                }
                
                $result = $mysqli->query($sql);
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                var hospitalMarker = L.marker([<?php echo $row['hospital_lat']; ?>, <?php echo $row['hospital_lng']; ?>]).addTo(map);
                hospitalMarker.bindPopup("<?php echo $row['hospital_name']; ?>");
            <?php  
                }?>
        }

        function showHospitalLocation(lat, lon, name) {
            console.log(name);
            map.panTo([lat, lon]);
            map.setView([lat, lon], 13);
            var marker = L.marker([lat, lon]).addTo(map).bindPopup(name);
            marker.bindPopup(name).openPopup();
        }

        function getDirections(address){
            window.open(address);
        }
        
        $(document).ready(function() {
            // Show/hide new disease form when button is clicked
            <?php
                // Check for error parameter
                if(isset($_GET['error']) && $_GET['error'] == 'insert') {
                    // Output JavaScript to open modal on page load
                    echo '$("#newHospitalModal").modal("show");';
                }
            ?>
        });

        
    </script>
   
</body>

</html>