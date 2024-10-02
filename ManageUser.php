<?php
	require("connect.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage User</title>
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
                <a href="ManageUser.php?role=user" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Medinova</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <!-- <a href="ManageUser.php" class="nav-item nav-link active" id="user-link">User</a> -->
                        <a href="ManageUser.php?role=user" class="nav-item nav-link active" id="user-link">User</a>
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

    <!-- Table Start -->
    <!--  -->


    <?php
    // $sql_users = "SELECT user_id, username, email, name, gender, age, role, last_login FROM users WHERE role = 'user'";
    // $result_users = $mysqli->query($sql_users);

    // $sql_doctors = "SELECT u.user_id, u.username, u.email, u.name, u.gender, u.age, u.doctor_id, u.role, u.approved, h.hospital_name, h.hospital_address FROM users u INNER JOIN hospitals h ON u.hospital_id = h.hospital_id WHERE u.role = 'doctor'";
    // $result_doctors = $mysqli->query($sql_doctors);
    ?>

    <div class="col d-flex justify-content-center mt-3">
    <div class="btn-group mb-3" role="group" aria-label="User and Doctor">
    <!-- <a href="#" class="btn btn-outline-secondary active" onclick="toggleUsers()" id="users-button">Users</a>
    <a href="#" class="btn btn-outline-secondary" onclick="toggleDoctors()" id="doctors-button">Doctors</a> -->
    <a href="ManageUser.php?role=user" class="btn btn-outline-secondary <?php if ($_GET['role'] == 'user') { echo 'active'; } ?>" id="users-button">Users</a>
    <a href="ManageUser.php?role=doctor" class="btn btn-outline-secondary <?php if ($_GET['role'] == 'doctor') { echo 'active'; } ?>" id="doctors-button">Doctors</a>
    </div>
    </div>
    
    <?php 
        if(isset($_GET['role'])){
            $role = $_GET['role'];
            if($role == 'user'){
                $sql = "SELECT user_id, username, email, name, gender, age, role, last_login FROM users WHERE role = 'user'";
            }else{
                $sql = "SELECT u.user_id, u.username, u.email, u.name, u.gender, u.age, u.doctor_id, u.role, u.approved, h.hospital_name, h.hospital_address FROM users u INNER JOIN hospitals h ON u.hospital_id = h.hospital_id WHERE u.role = 'doctor'";
            }
            $result = $mysqli->query($sql);
        }

        if($role == 'user'){
    ?>
    <table class="table mt-5" id="users-table">
    <thead>
        <tr class="text-center">
        <th class="col-2"> Username </th> 
        <th class="col-2"> Email </th> 
        <th class="col-2"> Name </th> 
        <th class="col-2"> Gender </th> 
        <th class="col-1"> Age </th> 
        <th class="col-2"> Last Login </th> 
        <th colspan="2" class="col-2"> Function </th> 
        </tr>
    </thead>
    <tbody>
        <!-- Generate the table rows for users -->
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr class="text-center">
            <td class="col-2"><?php echo $row['username']; ?></td>
            <td class="col-2"><?php echo $row['email']; ?></td>
            <td class="col-2"><?php echo $row['name']; ?></td>
            <td class="col-2"><?php echo $row['gender']; ?></td>
            <td class="col-1"><?php echo $row['age']; ?></td>
            <td class="col-2"><?php echo $row['last_login']; ?></td>
            <td class="col-2"><a href="ViewUser.php?userid=<?php echo $row['user_id'] ?>&role=<?php echo $row['role'] ?>" class="btn btn-success" name="view">View</a></td>
            <td class="col-2"><a href="DeleteUser.php?userid=<?php echo $row['user_id'] ?>&role=<?php echo $row['role'] ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <?php 
        }
        if($role == 'doctor'){
    ?>


    <table class="table mt-5 " id="doctors-table">
    <thead>
        <tr class="text-center">
        <th class="col-1"> Username </th> 
        <th class="col-1"> Email </th> 
        <th class="col-1"> Name </th> 
        <th class="col-1"> Gender </th> 
        <th class="col-1"> Age </th> 
        <th class="col-1"> Hospital Name </th> 
        <th class="col-2"> Hospital Location </th>  
        <th colspan="2" class="col-2"> Function </th> 
        </tr>
    </thead>
    <tbody>
        <!-- Generate the table rows for doctors -->
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr class="text-center">
            <td class="col-1"><?php echo $row['username']; ?></td>
            <td class="col-1"><?php echo $row['email']; ?></td>
            <td class="col-1"><?php echo $row['name']; ?></td>
            <td class="col-1"><?php echo $row['gender']; ?></td>
            <td class="col-1"><?php echo $row['age']; ?></td>
            <td class="col-2"><?php echo $row['hospital_name']; ?></td>
            <td class="col-2"><?php echo $row['hospital_address']; ?></td>
            <?php if ($row['approved']==true) { ?>
            <td class="col-1"><a href="ViewUser.php?userid=<?php echo $row['user_id'] ?>&role=<?php echo $row['role'] ?>" class="btn btn-success" name="view">View</a></td>
            <?php } else { ?>
            <td class="col-1"><a href="ViewUser.php?userid=<?php echo $row['user_id'] ?>&role=<?php echo $row['role'] ?>" class="btn btn-success" name="approval">Approve</a></td>
            <?php } ?>
            <td class="col-1"><a href="DeleteUser.php?userid=<?php echo $row['user_id'] ?>&role=<?php echo $row['role'] ?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php } 
    }?>

    </tbody>
    </table>
     
    <!-- Table End -->

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

            // document.getElementById("user-link").href = "ManageUser.php?role=user";
            
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

            // document.getElementById("user-link").href = "ManageUser.php?role=doctor";
        }
    </script>
</body>

</html>