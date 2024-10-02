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
                        <a href="Home.php" class="nav-item nav-link">Home</a>
                        <a href="CheckSymptoms.php" class="nav-item nav-link">Check Symptoms</a>
                        <a href="CheckDiseases.php" class="nav-item nav-link active">Check Diseases</a>
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
                        <a href="AboutUs.php" class="nav-item nav-link">About Us</a>
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

    
    <?php if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && $_SESSION['role']=='doctor' && $_SESSION['approved']==TRUE) { ?>
        <div class="container position-relative mt-2">
            <div class="d-flex justify-content-end">
                <button id="edit-btn" class="btn btn-primary me-2">EDIT</button>
                <button id="delete-btn" data-bs-toggle="modal" data-bs-target="#editDiseaseModal" class="btn btn-secondary me-2">DELETE</button>
            </div>
        </div>
    <?php } ?>

    <?php
       $disease_id = '';
       if(isset($_GET['DiseaseId'])){
            
            $disease_id = $_GET["DiseaseId"];
            // Retrieve the disease info from the database
            $sql = "SELECT * FROM diseases WHERE disease_id='$disease_id'";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_assoc($result);
            // $disease_id = $row['disease_id'];

        //    Display the disease info
            echo "<div class='container my-5'>";
            echo "<div class='row'>";
            echo "<div class='col-md-8 mx-auto'>";
            // echo "<img src='" . $row['image'] . "' class='card-img-top mx-auto d-block' alt='" . $result['name'] . "'>";
            echo " <img src='https://via.placeholder.com/900x400' alt='Disease Image' class='img-fluid rounded '>";
            echo "</div>";
            echo "</div>";

            echo "<div class='row my-5 mx-5'>";
            echo "<div class='col-md-6'>";
            echo "<h3 id='disease-name' class='mb-3'>" . $row['disease_name'] . "</h5>";
            echo "<input type='hidden' id='disease-id' value= '$disease_id'>";
            //$descriptions = preg_split('/\n\s*\n/',$row["description"]);
            echo '<div id="disease-description" contentEditable="false"  class="col-md-12">';
            // $descriptions = explode("\n",htmlspecialchars_decode($row["description"]));

            // Description
            // $delimiter = '.';
            // $descriptions = explode($delimiter, $row["description"]);
            $descriptions = htmlspecialchars($row['description']);
            $descriptions = nl2br($descriptions);
        
            // foreach ($descriptions as $description) {
                echo '<p class="mb-3">' . $descriptions . '</p>' ;
                // echo nl2br(str_replace('\r\n', ' <br>', htmlspecialchars($description))); 
            // }
            echo '</div>';
            echo '</div>';

           
            echo "<div class='col-md-6'>";
            echo "<h3 class='mb-3'> Symptoms </h3>"; 
            echo '<div id="disease-symptoms" contentEditable="false"  class="col-md-12">';
            // $symptoms = explode("\n",htmlspecialchars_decode($row["symptoms"]));

            $delimiter = '.';
            $symptoms = explode($delimiter, $row["symptoms"]);

            foreach ($symptoms as $symptom) {
                echo '<li class="mb-3">' . $symptom . '</li>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo "<div class='row mx-5'>";
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
            
            echo '<div class="row">';
            echo "<div class='col-md-8 mx-auto'>";
            echo "<h3 class='mb-3 text-sm-center'> Comments </h3>"; 
            $sql1 = "SELECT c.*, u.name FROM comments c JOIN users u ON c.user_id = u.user_id WHERE c.disease_id = $disease_id ORDER BY c.comment_timestamp DESC";
            $result1 = $mysqli->query($sql1);
            // echo $sql1;
            
            if(!$result1){
                echo "Error retrieving comments from database: " . mysqli_error($mysqli);;
            }else{
                if($result1->num_rows > 0){
                    while ($rows = mysqli_fetch_assoc($result1)) {
                        $comment = $rows['comment_content'];
                        $timestamp = $rows['comment_timestamp'];
                        $name = $rows['name'];
                        $comment_id = $rows['comment_id'];
                    
                        // Display the comment info using Bootstrap 5 classes
                        echo '<div class="card mb-3">
                        <div class="card-body">
                        <div class="row">
                            <div class="col">
                            <h5 class="card-title">' . $name . '</h5>
                            <p class="card-text">' . $comment . '</p>
                            <p class="card-text"><small class="text-muted">' . $timestamp . '</small></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <div class="card">
                                <div class="card-body">
                                <form method="POST" action="reply.php">
                                    <div class="mb-3">
                                    <label for="reply" class="form-label">Reply</label>
                                    <textarea class="form-control" id="reply" name="reply" rows="1" required></textarea>
                                    </div>
                                    <input type="hidden" name="comment_id" value="' . $comment_id . '">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>';
                    }
                }else{
                    echo "There is no comment";
                }    
            }
            

            if(isset($_SESSION['userid'])){
                $user_id = $_SESSION['userid'];
                $disease_id = $row["disease_id"];
                $disease_name = $row["disease_name"];
                echo '<form method="post" action="InsertComment.php">' ;
                echo '<input type="hidden" name="user_id" value="'. $user_id .'">';
                echo '<input type="hidden" name="disease_id" value="'. $disease_id .'">';
                echo '<input type="hidden" name="disease_name" value="'. $disease_name .'">';
                echo '<div class="mb-3">';
                echo '<label for="comment" class="form-label">Comment</label>';  
                echo '<textarea class="form-control" id="comment" name="comment" required></textarea>';  
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Submit</button>';
                echo '</form>';
            }else{
                echo '<p>Require login to leave a comment.</p>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
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
                    const marker = L.marker([latitude, longitude], {icon: currentLocationIcon}).addTo(map).bindPopup("You are here").openPopup();;
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

        // document.getElementById("edit-btn").addEventListener("click", function() {
        //     // Make the disease info fields editable
        //     document.getElementById("disease-description");
        //     document.getElementById("disease-symptoms");
        //     document.getElementById("disease-treatment");

        
        //     // Change the button text to "Save Changes"
        //     this.textContent = "Save Changes";

        //     // Add a "cancel" class to the button to allow canceling edits
        //     this.classList.add("cancel");

        //     if (this.classList.contains("cancel")) {
        //         // Cancel editing and reload the page
        //         location.reload();
        //     } else {
        //         // Save changes
        //         var nameEl = document.getElementById("disease-name");
        //         var descEl = document.getElementById("disease-description")=true;
        //         var symptomsEl = document.getElementById("disease-symptoms");
        //         var treatmentEl = document.getElementById("disease-treatment");
                
        //         $.post("save_changes.php", {
        //         disease_id: <?php echo $disease_id; ?>,
        //         disease_name: nameEl.innerHTML,
        //         disease_description: descEl.innerHTML,
        //         disease_symptoms: symptomsEl.innerHTML,
        //         disease_treatment: treatmentEl.innerHTML
        //         }, function(response) {
        //         // Handle the server response here
        //         console.log(response);

        //         // Make the disease info fields non-editable
        //         descEl.contentEditable = false;
        //         symptomsEl.contentEditable = false;
        //         treatmentEl.contentEditable = false;

        //         // Change the button text back to "Edit"
        //         document.getElementById("edit-button").textContent = "Edit";
        //         document.getElementById("edit-button").classList.remove("cancel");

        //         // Update the disease info fields with the new data
        //         descEl.innerHTML = response.description;
        //         symptomsEl.innerHTML = response.symptoms;
        //         treatmentEl.innerHTML = response.treatment;
        //         });
        //     }
        // });
        document.getElementById("edit-btn").addEventListener("click", function() {
            var descEl = document.getElementById("disease-description");
            var symptomsEl = document.getElementById("disease-symptoms");
            var treatmentEl = document.getElementById("disease-treatment");
            var idEl = document.getElementById("disease-id");

            // Toggle the contentEditable property of the elements
            descEl.contentEditable = (descEl.contentEditable == "true") ? "false" : "true";
            symptomsEl.contentEditable = (symptomsEl.contentEditable == "true") ? "false" : "true";
            treatmentEl.contentEditable = (treatmentEl.contentEditable == "true") ? "false" : "true";

            var button = document.getElementById("edit-btn");

            // Update the button text based on the current state
            if (button.innerHTML === "EDIT") {
                button.innerHTML = "SAVE";
            } else {
                button.innerHTML = "EDIT";

                // Send an AJAX request to the server to update the data
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'EditDisease.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Construct the data to send to the server
                if (idEl) {
                    var data = 'id=' + encodeURIComponent(idEl.value) + '&description=' + encodeURIComponent(descEl.innerHTML) +
                                        '&symptoms=' + encodeURIComponent(symptomsEl.innerHTML) +
                                        '&treatment=' + encodeURIComponent(treatmentEl.innerHTML);
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
            }
            });


    </script>
</body>

</html>