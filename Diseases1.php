<?php
	require("connect.php");
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MEDINOVA - Hospital Website Template</title>
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

     <!-- Template Map Stylesheet-->
     <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        
    </style>

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
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>info@example.com</a>
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
                        <?php }else{ ?>
                            <a href="Home.php" class="nav-item nav-link">Home</a>
                        <?php } ?>
                        <a href="CheckSymptoms.php" class="nav-item nav-link">Article Symptoms</a>
                        <a href="CheckDiseases.php" class="nav-item nav-link active">Article Diseases</a>
                        <div class="nav-item dropdown">
                            <a href="Hospital.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Hospital</a>
                            <div class="dropdown-menu m-0">
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
       $disease_id = '';
       if(isset($_GET['DiseaseId'])){
            
            $disease_id = $_GET["DiseaseId"];
            // Retrieve the disease info from the database
            $sql = "SELECT * FROM diseases WHERE disease_id='$disease_id'";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_assoc($result);

            //Display the disease info
            echo "<div class='container my-5'>";
            echo "<div class='row'>";
            echo "<div class='col-md-9 mx-auto'>";
            if ($row['disease_image']) {
                echo '<img src="' . $row['disease_image'] . '" class="img-thumbnail text-center" id="disease-img" style="width: 900px; height: 450px;"/>';
            } else {
                echo '<img src="img/default-image.jpg" class="img-thumbnail" id="disease-img" style="width: 500px; height=450px;"/>';
            }
            if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && $_SESSION['role']=='doctor' && $_SESSION['approved']==TRUE) {
            echo '<form method="post" enctype="multipart/form-data">';
            echo '<div class="mb-2 mt-3">';
            echo '<div class="row mx-auto">';
            echo '<div class="col-10">';
            echo '<input type="file" class="form-control" id="file" name="file" required>';
            echo '</div>';
            echo '<div class="col-2">';
            echo '<button type="submit" class="btn btn-dark" name="upload">Upload</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
            echo '<div class="container position-relative mt-2">';
            // if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && $_SESSION['role']=='doctor' && $_SESSION['approved']==TRUE) {
            echo '<div class="d-flex justify-content-center">';   
            echo '<button id="edit-btn" class="btn btn-primary me-2">EDIT</button>';
            echo '<button id="save-btn" class="btn btn-primary me-2 d-none">SAVE</button>';
            echo '<button id="cancel-btn" class="btn btn-primary me-2 d-none">CANCEL</button>';
            if ($_SESSION['role']=='admin'){
                echo '<form method="POST">';
                echo '<button id="approve-btn" class="btn btn-primary me-2" name="approve" data-disease-id="'.$disease_id.'">APPROVE</button>';
                echo '<button id="deny-btn" class="btn btn-primary me-2" name="deny" data-disease-id="'.$disease_id.'">DENY</button>';
                echo '</form>';
                if(isset($_POST['approve'])) {
                    $diseaseID = $_POST['approve'];
                    // echo "hello";
                    $sql = "UPDATE diseases SET approval = 'APPROVE' WHERE disease_id = $disease_id";
                    if($mysqli->query($sql)) {
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Approved.');
                        window.location.href='ApproveDisease.php';
                        </script>");
                    } 
                }
                if(isset($_POST['deny'])) {
                    $diseaseID = $_POST['deny'];
                    // echo "hello";
                    $sql = "UPDATE diseases SET approval = 'DENY' WHERE disease_id = $disease_id";
                    if($mysqli->query($sql)) {
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Denied.');
                        window.location.href='ApproveDisease.php';
                        </script>");
                    } 
                }
                
                
            }
            echo '<button id="delete-btn" data-bs-toggle="modal" data-bs-target="#editDiseaseModal" class="btn btn-secondary">DELETE</button>';
            echo '</div>';
            echo '</div>';
            }
            echo "</div>";
            echo "</div>";

            echo "<div class='row my-5 mx-5 col-12'>";
            echo "<div class='col-md-6'>";
            echo "<h3 id='disease-name' class='mb-3'>" . $row['disease_name'] . "</h5>";
            echo "<input type='hidden' id='disease-id' value= '$disease_id'>";
            // $descriptions = preg_split('/\n\s*\n/',$row["description"]);
            echo '<div id="disease-description" contentEditable="false" style="white-space: pre-wrap;" class="col-md-12">';
            $descriptions = explode("\n",htmlspecialchars_decode($row["description"]));
            foreach ($descriptions as $description) {
                echo '<p class="mb-3">' . $description . '</p>';
            }
            echo '</div>';
            echo '</div>';

           
            echo "<div class='col-md-5'>";
            echo "<h3 class='mb-3'> Symptoms </h3>"; 
            echo '<div id="disease-symptoms" contentEditable="false"  class="col-md-12">';
            $symptoms = explode("\n",htmlspecialchars_decode($row["symptoms"]));
            foreach ($symptoms as $symptom) {
                echo '<li class="mb-3">' . $symptom . '</li>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo "<div class='row my-5 mx-5 col-12'>";
            echo "<div class='col-md-6'>";
            echo "<h3 class='mb-3'> Treaments </h3>"; 
            echo '<div id="disease-treatment" contentEditable="false" class="col-md-12">';
            $treatments = explode("\n",htmlspecialchars_decode($row["treatment"]));
            foreach ($treatments as $treatment) {
                echo '<li class="mb-3">' . $treatment . '</li>';
            }
            echo '</div>';
            echo '</div>';
            
            echo '<div class="col-md-5 ms-4">';
            echo "<h4 class='mb-3'> Map </h4>"; 
            echo '<p>Want to find a medical institute? <a href="#" onclick="getLocationAndRedirect(event)">Click here</a></p>';
            echo '<div id="map" class="w-100 h-75 align-items-sm-center">';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            
            //Comment
            echo '<div class="container mt-5">';
            echo '<div class="row">';
            echo '<div class="col-md-9 mx-auto">';
            echo '<h3 class="mb-3 text-sm-center"> Comments </h3>'; 
            $sql1 = "SELECT c.*, u.name FROM comments c JOIN users u ON c.user_id = u.user_id WHERE c.disease_id = $disease_id ORDER BY c.comment_timestamp DESC";
            $result1 = $mysqli->query($sql1);
    
            if(!$result1){
                echo "Error retrieving comments from database: " . mysqli_error($mysqli);
            }else{
                if($result1->num_rows > 0){
                    while ($rows = mysqli_fetch_assoc($result1)) {
                        $comment = $rows['comment_content'];
                        $timestamp = $rows['comment_timestamp'];
                        $name = $rows['name'];
                        $comment_id = $rows['comment_id'];
                        // $user_id = $_SESSION['userid'];
                        // $disease_name = $row["disease_name"];
    
                        // Display the comment info
                        echo '<div class="card mb-3" id="comment-container">';
                        echo '<div class="card-body">';
                        echo '<div class="row">';
                        echo '<div class="col">';
                        echo '<h5 class="card-title">' . $name . '</h5>';
                        echo '<p class="card-text">' . $comment . '</p>';
                        echo '<p class="card-text"><small class="text-muted">' . $timestamp . '</small></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        // Display reply section
                        echo '<div class="row">';
                        echo '<div class="col">';
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h6 class="card-subtitle mb-2 text-muted">Replies</h6>';
                        $sql2 = "SELECT r.*, u.name, u.role FROM replies r JOIN users u ON r.user_id = u.user_id WHERE r.comment_id = $comment_id ORDER BY r.reply_timestamp ASC";
                        $result2 = $mysqli->query($sql2);
                        if($result2->num_rows > 0){
                            $count=1;
                            while($row = mysqli_fetch_assoc($result2)){
                                $reply = $row['reply_content'];
                                $timestamp = $row['reply_timestamp'];
                                $name = $row['name'];
                                $role = $row['role'];
                                echo '<div class="mb-3">';
                                echo '<p class="card-text">' . $reply . '</p>';
                                if($role=='doctor'){
                                     echo '<p class="card-text"><small class="text-muted">' . $timestamp . ' by ' . $name . ' <i class="fas fa-user-md"></i></small></p>';
                                }else{
                                     echo '<p class="card-text"><small class="text-muted">' . $timestamp . ' by ' . $name . '</small></p>';
                                }
                                echo '</div>';
                                if($count != $result2->num_rows){
                                    echo '<hr>';
                                }
                                $count++;
                            }
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        
                        // Display reply form
                        if(isset($_SESSION['userid'])){
                            $user_id = $_SESSION['userid'];
                            echo '<div class="justify-content-center">';
                            echo '<div class="row">';
                            echo '<div class="col">';
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<form method="POST" action="ReplyComment.php" id="reply-form">';
                            echo '<div class="mb-3">';
                            echo '<label for="reply" class="form-label">Reply</label>';
                            echo '<textarea class="form-control" id="reply" name="reply" rows="1" required></textarea>';
                            echo '</div>';
                            echo '<input type="hidden" name="comment_id" value="' . $comment_id . '">';
                            echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
                            echo '<input type="hidden" name="disease_id" value="' . $disease_id . '">';
                            echo '<input type="submit" class="btn btn-primary" value="Submit">';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "There are no comments yet.";
                }
                if(isset($_SESSION['userid'])){
                    $user_id = $_SESSION['userid'];
                    echo '<form method="post" action="InsertComment.php" id="comment-form">' ;
                    echo '<input type="hidden" name="user_id" value="'. $user_id .'">';
                    echo '<input type="hidden" name="disease_id" value="'. $disease_id .'">';
                    echo '<div class="mb-3">';
                    echo '<label for="comment" class="form-label">Comment</label>';  
                    echo '<textarea class="form-control" id="comment" name="comment" required></textarea>';  
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary">Submit</button>';
                    echo '</form>';
                }else{
                    echo '<p>Require login to leave a comment.</p>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

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
                        $sql = "UPDATE diseases SET disease_image = '$target_file' WHERE disease_id = $disease_id";
                        $result = $mysqli->query($sql);
                        if ($result) {
                            // update the profile image on the page
                            echo "<script>";
                            echo "var img = document.getElementById('disease-img');";
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
    <?php } ?>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script>

        if (!document.getElementById('map')._leaflet_id) {
            // Create a new Leaflet map centered on the user's current location
            const map = L.map('map');
            const latitude = 51.505;
            const longitude = -0.09;
            map.setView([latitude, longitude], 13); // Set initial view

            // Add a tile layer to the map using OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);

            // Get the user's current location and update the map
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    map.setView([latitude, longitude], 13);
                    var currentLocationIcon = L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        tooltipAnchor: [16, -28],
                        shadowSize: [41, 41]
                    });
                    const marker = L.marker([latitude, longitude], {icon: currentLocationIcon}).addTo(map).bindPopup("You are here").openPopup();
                }, function() {
                    alert("Could not get your current location.");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function getLocationAndRedirect(event) {
            event.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    // 2.7121505,101.9019531

                    // Make a request to a reverse geocoding API to get the state name
                    const api_url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`;
                    fetch(api_url)
                        .then(response => response.json())
                        .then(data => {
                            const state = data.address.state;
                            // const state_param = state.replace(/\s/g, '%20');
                            console.log('Current state: ', state);
                            if(state==undefined)
                                window.location.href = `Hospital.php?state=Kuala Lumpur`;
                            else
                                window.location.href = `Hospital.php?state=${encodeURIComponent(state)}`;
                        }).catch(error => console.error(error));
                });

            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        document.getElementById("edit-btn").addEventListener("click", function() {
            var descEl = document.getElementById("disease-description");
            var symptomsEl = document.getElementById("disease-symptoms");
            var treatmentEl = document.getElementById("disease-treatment");
            var saveBtn = document.getElementById("save-btn");
            var idEl = document.getElementById("disease-id");
            // var origDescHtml = descEl.innerHTML;
            // var origSymptomsHtml = symptomsEl.innerHTML;
            // var origTreatmentHtml = treatmentEl.innerHTML;

            // Toggle the contentEditable property of the elements
            descEl.contentEditable = (descEl.contentEditable == "true") ? "false" : "true";
            symptomsEl.contentEditable = (symptomsEl.contentEditable == "true") ? "false" : "true";
            treatmentEl.contentEditable = (treatmentEl.contentEditable == "true") ? "false" : "true";

            // Toggle the "Save" and "Cancel" button visibility
            saveBtn.classList.toggle("d-none");
            var cancelBtn = document.getElementById("cancel-btn");
            cancelBtn.classList.toggle("d-none");
            // document.getElementById("edit-btn").classList.toggle("d-none");

            // Add event listener to the "Save" button
            saveBtn.addEventListener("click", function() {
                // Get the updated HTML content from the editable div elements
                var descText = descEl.innerText;
                var symptomsText = symptomsEl.innerText;
                var treatmentText = treatmentEl.innerText;

                // Send an AJAX request to the server to update the data
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'EditDisease.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Construct the data to send to the server
                if (idEl) {
                    var data = 'id=' + encodeURIComponent(idEl.value) + '&description=' + encodeURIComponent(descText) +
                    '&symptoms=' + encodeURIComponent(symptomsText) +
                    '&treatment=' + encodeURIComponent(treatmentText);
                } else {
                    console.error("Element with ID 'my-hidden-id' not found");
                }

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the server here
                        console.log(xhr.responseText);
                    }
                };

                // Send the data to the server
                xhr.send(data);

                // Disable the editable div elements and hide the "Save" button
                descEl.contentEditable = "false";
                symptomsEl.contentEditable = "false";
                treatmentEl.contentEditable = "false";
                saveBtn.classList.add("d-none");
                cancelBtn.classList.add("d-none")
               

            });

            // Add event listener to the "Cancel" button
            cancelBtn.addEventListener("click", function() {
                // Get the original HTML content of the editable div elements
                if (idEl) {
                    $.ajax({
                        type: "GET",
                        url: "Diseases.php",
                        data: {DiseaseId: idEl.value},
                        success: function(response) {
                            // Replace the current content with the original content
                            var parser = new DOMParser();
                            var newDoc = parser.parseFromString(response, 'text/html');
                            var newDescEl = newDoc.getElementById("disease-description");
                            var newSymptomsEl = newDoc.getElementById("disease-symptoms");
                            var newTreatmentEl = newDoc.getElementById("disease-treatment");
                            descEl.innerHTML = newDescEl.innerHTML;
                            symptomsEl.innerHTML = newSymptomsEl.innerHTML;
                            treatmentEl.innerHTML = newTreatmentEl.innerHTML;
                            descEl.contentEditable = "false";
                            symptomsEl.contentEditable = "false";
                            treatmentEl.contentEditable = "false";
                            saveBtn.classList.add("d-none");
                            cancelBtn.classList.add("d-none");
                            document.getElementById("edit-btn").classList.remove("d-none");
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });
                } else {
                    console.error("Element with ID 'disease-id' not found");
                }
            });
        });


        

        $(document).ready(function() {
            // Handle submit event for comment form
            $("#comment-form").submit(function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Get form data and serialize it
                var formData = $(this).serialize();

                // Send AJAX request to server
                $.ajax({
                    type: "POST",
                    url: "InsertComment.php",
                    data: formData,
                    success: function(response) {
                        // Reload page to show new comment
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        alert("An error occurred while submitting the comment.");
                        console.log(xhr.responseText);
                    }
                });
            });

            // Handle submit event for reply form
            $(".reply-form").submit(function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Get form data and serialize it
                var formData = $(this).serialize();

                // Send AJAX request to server
                $.ajax({
                    type: "POST",
                    url: "ReplyComment.php",
                    data: formData,
                    success: function(response) {
                        // Reload page to show new reply
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        alert("An error occurred while submitting the reply.");
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        $(document).ready(function() {
            // Listen for form submit event
            $('#profile-image-form').on('submit', function(e) {
                e.preventDefault();
                // Get form data
                var formData = new FormData(this);
                // Submit form data using AJAX
                $.ajax({
                url: 'Diseases.php?DiseaseId='+ encodeURIComponent($_GET['DiseaseId']), // Change this to your upload script
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

        $(document).ready(function() {
            $('#approve-btn').click(function() {
                var diseaseId = $(this).data('disease-id');
                $.ajax({
                    url: 'Diseases.php?DiseaseId='+ encodeURIComponent(diseaseId),
                    type: 'POST',
                    data: {approve: true},
                    success: function(response) {
                    // Do something after the approval has been updated
                    }
                });
            });

            $('#deny-btn').click(function() {
                var diseaseId = $(this).data('disease-id');
                $.ajax({
                    url: 'Diseases.php?DiseaseId='+ encodeURIComponent(diseaseId),
                    type: 'POST',
                    data: {approve: false},
                    success: function(response) {
                    // Do something after the denial has been updated
                    }
                });
            });
        });
    </script>
</body>

</html>