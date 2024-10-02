<?php
	require("connect.php");
	session_start();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Article Disease</title>
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
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }   
    </style>
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
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Health Detective</h1>
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
                        <a href="CheckDiseases.php" class="nav-item nav-link active">Article Diseases</a>
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


    <!-- Search Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Find Diseases/Symptoms</h5>
                <h1 class="display-5 mb-4">Know About Your Diseases </h1>
                <h5 class="fw-normal"></h5>
            </div>
            <form method="get" action="CheckDiseases.php">
            <div class="mx-auto" style="width: 100%; max-width: 600px;">
                <div class="input-group">
                    <input type="text" class="form-control border-primary w-50" name="query" placeholder="Search for a disease or symptom">
                    <button type="submit" class="btn btn-dark border-0 w-25">Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && $_SESSION['role']=='doctor' && $_SESSION['approved']==TRUE) { ?>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#newDiseaseModal" class="btn btn-primary mt-3 mx-5 px-xxl-4">Add</button>
                <a href="ViewDisease.php" class="btn btn-primary mt-3 mx-5 px-xxl-4">Uploaded Article</a>
                </div>
            </div>
        </div>
    <?php } else if (isset($_SESSION['isLogin']) && $_SESSION["isLogin"]===true && $_SESSION['role']=='admin' && $_SESSION['approved']==TRUE) { ?>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center">
                <a href="ViewDisease.php" class="btn btn-primary mt-3 mx-5 px-xxl-4">Uploaded Article</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Search End -->


    <!-- Modal Start -->
    <div class="modal fade" id="newDiseaseModal" tabindex="-1" aria-labelledby="newDiseaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDiseaseModalLabel">Insert New Disease</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  action="InsertDisease.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="disease-name" class="form-label">Disease Name</label>
                    <input type="text" class="form-control" id="disease-name" name="disease-name" required>
                </div>
                <div class="mb-3">
                    <label for="disease-description" class="form-label">Description</label>
                    <textarea class="form-control" id="disease-description" name="disease-description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="disease-symptoms" class="form-label">Symptoms</label>
                    <textarea class="form-control" id="disease-symptoms" name="disease-symptoms" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="disease-treatment" class="form-label">Treatment</label>
                    <textarea class="form-control" id="disease-treatment" name="disease-treatment" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="disease-image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="disease-image" name="disease-image">
                </div>
                <input type='hidden' id='userid' name="userid" value='<?php echo $_SESSION['userid'] ?>'>
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
                        $("#newDiseaseModal").modal("show");
                    });
                </script>';
        }
    ?>

    <?php
       
        if (isset($_GET['query'])) {
            echo '<div class="container mt-4 offset-3">';

            // Get the first letter of the searched disease or symptom
            $letter = strtoupper(substr($_GET['query'], 0, 1));
            $letters = array($letter);

            // Search for diseases that match the query
            $query = strtolower($_GET['query']);
            $sql = "SELECT * FROM diseases WHERE LOWER(disease_name) LIKE '%$query%' OR LOWER(symptoms) LIKE '%$query%' ORDER BY disease_name ASC";
            $result = $mysqli->query($sql);

            // Display the results
            $disease_alphabets = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $disease_name = $row["disease_name"];
                $symptoms = $row["symptoms"];

                // Get the first letter of the disease name
                $first_letter = strtoupper(substr($disease_name, 0, 1));
                if (!in_array($first_letter, $disease_alphabets)) {
                    // Display the alphabet header
                    echo '<div class="row">';
                    echo '<div class="col-md-12">';
                    echo '<h2 style="color: black;">' . $first_letter . '</h2>';
                    echo '</div>';
                    echo '</div>';

                    // Add the first letter to the array
                    $disease_alphabets[] = $first_letter;
                }

                // Highlight the matching words in the disease name and symptoms
                $disease_name = preg_replace('/(' . preg_quote($query, '/') . ')/i', '<span style="background-color: yellow">$1</span>', $disease_name);
                $symptoms = preg_replace('/(' . preg_quote($query, '/') . ')/i', '<span style="background-color: yellow">$1</span>', $symptoms);

                // Display the disease and its symptoms
                $disease_id = $row["disease_id"];
                $link = "Diseases.php?DiseaseId=" . $disease_id;
                echo '<ul class="list-unstyled">';
                echo '<li><a href="' . $link . '" style="font-family: Helvetica; color: black; font-weight: bold;">' . $disease_name . '</a></li>';
                if (!empty($symptoms)) {
                    echo '<ul>';
                    $symptoms = explode("\n", $symptoms);
                    foreach ($symptoms as $symptom) {
                        echo '<li style="color: black">' . $symptom . '</li>';
                    }
                    echo '</ul>';
                }
                echo '</ul>';
            }

            echo '</div>';
            }else{
                $letters = range('A', 'Z');

                // Split each letter into substrings of length 4
                $chunks = array_map(function($letter) {
                    return str_split($letter, 4);
                }, $letters);
                echo '<div class="container mt-4">';
                echo '<div class="row ">';
        
                foreach ($chunks as $chunk) {
                    // Split each chunk into rows of 4 elements each
                    $rows = array_chunk($chunk, 4);
                    
                    foreach ($rows as $row) {
                        echo '<div class="col-md-3">';
                        echo '<ul class="list-unstyled">';
        
                        foreach ($row as $letter) {
                            echo '<li><p class="h3 text-xl-left">'.$letter.'</p></li>';
                            $sql = "SELECT * FROM diseases WHERE disease_name LIKE '$letter%'";
                        $result = $mysqli->query($sql);
        
                        while($row = mysqli_fetch_assoc($result)) {
                            $disease_id = $row["disease_id"];
                            $link = "Diseases.php?DiseaseId=".$disease_id;
                            // echo '<li class="text-xl-left"><a href="' . $link . '" style="font-family: Helvetica; color: #848e9f;" >' . ($row["disease_name"]) . '</a></li>';
                             echo '<li class="text-xl-left"><a href="' . $link . '" style="font-family: Helvetica; color: black;" data-toggle="tooltip" data-placement="bottom" title="' . ($row["disease_name"]) . '">' . ($row["disease_name"]) . '</a></li>';
                            // echo '<li class="text-xl-left"><a href="' . $link . '" class="hover text-decoration-none text-dark" style="font-family: Helvetica;">' . ($row["disease_name"]) . '</a></li>';
                        }
                        }
        
                        echo '</ul>';
                        echo '</div>';
                    }
            }
            echo '</div>';
            echo '</div>';

        }
        

       
        
    ?>         
    <!-- Search Result End -->


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
    <script>
        $(document).ready(function() {
            // Show/hide new disease form when button is clicked
            <?php
                // Check for error parameter
                if(isset($_GET['error']) && $_GET['error'] == 'insert') {
                    // Output JavaScript to open modal on page load
                    echo '$("#newDiseaseModal").modal("show");';
                }
            ?>
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>
    
</body>
        
</html>