<?php
session_start();

// Prevent page caching
header("Cache-Control: no-cache, no-store, must-revalidate");  // HTTP 1.1
header("Pragma: no-cache");  // HTTP 1.0
header("Expires: 0");  // Proxies

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}
?>
<?php
session_start();
include 'includes/db.php'; // Include your database connection file

// Fetch username from session
if (!isset($_SESSION['username'])) {
    die("User not logged in"); // Handle cases where session is not set
}

$username = $_SESSION['username']; 

// Query to get the builder_name for the logged-in user
$sql = "SELECT builder_name, address, email, phone_number FROM builders_table WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Fetch builder name (default to 'Unknown' if not found)
$builder_name = $row['builder_name'] ?? 'Unknown';
$address = $row['address'] ?? 'Unknown';
$email = $row['email'] ?? 'Unknown';
$phone_number = $row['phone_number'] ?? 'Unknown';

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Welcome to admin">
<meta name="author" content="Welcome to admin">

<title>Home Square Builder Panel</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css" />
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>

<link rel="stylesheet" href="assets/plugins/dropzone/dropzone.css">

<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">


<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<link rel="stylesheet" href="assets/plugins/jquery-steps/jquery.steps.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<!-- Sweetalert Popups -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="theme-purple">
<!-- Page Loader -->
<div class="page-loader-wrapper">

</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
    <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
            </div>
        </li>   
        <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
        <li class="float-right">
            <a href="logout.php" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"> Logout</i></a>
        </li>
    </ul>
</nav>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dashboard"><i class="zmdi zmdi-home m-r-5"></i>Builder</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user"><i class="zmdi zmdi-account m-r-5"></i>Profile</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <div class="image"><a href=""><img src="assets/images/profile_av.jpg" alt="User"></a></div>
                            <div class="detail">
                                <h4><?php echo htmlspecialchars($builder_name); ?></h4>
                                <small>Builder</small>
                            </div>                           
                        </div>
                    </li>
                    <li class="header">MAIN</li>
                     <li class="active open"><a href="index.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                     
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Projects</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-projects.php">All Projects</a></li>
                            <li><a href="create-project.php">Create Project</a></li>
                            <li><a href="deleted-projects.php">Deleted Projects</a></li>
                           
                        </ul>
                    </li>  
                          
                    <li><a href="leads-list.php" class="menu-toggle"><i class="zmdi zmdi-case-check"></i><span>Enquiries</span></a>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Packages</span></a>
                        <ul class="ml-menu">
                           
                            <li><a href="partner-ti-up-request.php">All Packages</a></li>
                            <li><a href="accepted-request.php">Update Packages</a></li>
                            <li><a href="rejected-request.php">New Packages</a></li> 
                            <li><a href="rejected-request.php">Expired Packages</a></li>                        
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-pane stretchLeft" id="user">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info m-b-20 p-b-15">
                            <div class="image"><a href=""><img src="assets/images/profile_av.jpg" alt="User"></a></div>
                            <div class="detail">
                                <h4><?php echo htmlspecialchars($builder_name); ?></h4>
                                <div class="info">
                                    <small>Builder</small>
                                    <a href="edit-profile.php" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                            <p class="text-muted"><?php echo htmlspecialchars($address); ?></p>
                        </div>
                    </li>
                    <li>
                        <small class="text-muted">Email address: </small>
                        <p><?php echo htmlspecialchars($email); ?></p>
                        <hr>
                        <small class="text-muted">Phone: </small>
                        <p>+91 <?php echo htmlspecialchars($phone_number); ?></p>
                        <hr>
                                               
                    </li>
                </ul>
            </div>
        </div>
    </div>    
</aside>

<style>
    .detail {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .info {
        display: flex;
        align-items: center;
        gap: 10px; /* Space between the text and icon */
    }

    .edit-btn {
        color: black; /* Black icon */
        text-decoration: none;
        font-size: 16px;
    }

    .edit-btn:hover {
        color: black; /* Keep it black on hover */
    }
</style>