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

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Welcome to admin">
<meta name="author" content="Welcome to admin">

<title>Home Square Admin Panel</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="assets//plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets//plugins/charts-c3/plugin.css" />
<link rel="stylesheet" href="assets//plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>

<link rel="stylesheet" href="assets//plugins/dropzone/dropzone.css">

<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">


<link rel="stylesheet" href="assets//plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets//plugins/bootstrap-select/css/bootstrap-select.css" />
<link rel="stylesheet" href="assets//plugins/jquery-steps/jquery.steps.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Sweetalert Popups -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="theme-purple">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <!-- <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.svg" width="48" height="48" alt="Oreo"></div>
        <p>Please wait...</p>        
    </div> -->
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
    <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <!-- <a class="navbar-brand" href="index.html"><img src="assets/images/logo.svg" width="30" alt="Oreo"><span class="m-l-10">Oreo</span></a> -->
            </div>
        </li>   
        <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
       
        <!-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
            <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
            <ul class="dropdown-menu pullDown">
                <li class="body">
                    <ul class="menu list-unstyled">
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60" src="assets/images/image-gallery/1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Sophia <span class="time">For Sale</span></span>
                                        <span class="message">Relaxing Apartment</span>                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60" src="assets/images/image-gallery/2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Sophia <span class="time">For Rent</span></span>
                                        <span class="message">Co-op Apartment in Bay Terrace</span>                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60" src="assets/images/image-gallery/3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Isabella <span class="time">For Rent</span></span>
                                        <span class="message">A must see Villa on Chicago Ave</span>                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60" src="assets/images/image-gallery/4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Alexander <span class="time">For Sale</span></span>
                                        <span class="message">5 Room Apartment Special Deal</span>                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object w60" src="assets/images/image-gallery/5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Grayson <span class="time">For Rent</span></span>
                                        <span class="message">Real House Luxury Villa</span>                                        
                                    </div>
                                </div>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li class="footer"> <a href="javascript:void(0);">View All</a> </li>
            </ul>
        </li>        
        <li class="hidden-sm-down">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
            </div>
        </li>         -->
        <li class="float-right">
            <a href="logout.php" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"> Logout</i></a>
        </li>
    </ul>
</nav>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dashboard"><i class="zmdi zmdi-home m-r-5"></i>Admin</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user"><i class="zmdi zmdi-account m-r-5"></i>Profile</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <!--<div class="image"><a href="javascript:void(0);"><img src="assets/images/profile_av.jpg" alt="User"></a></div>-->
                            <div class="detail">
                                <h4>Homesquare</h4>
                                <small>Admin</small>
                            </div>
                                                   
                        </div>
                    </li>
                    <!--<li class="header">MAIN</li>-->
                    <!-- <li class="active open"><a href="index.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>  -->
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-bookmark"></i><span>Home page</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-banners.php">Current Banners</a></li>
                            <li><a href="all-trending-projects.php">Trending Projects</a></li>
                            <!--<li><a href="create-banner.php">Create Banner Slider</a></li>-->
                            <!--<li><a href="deleted-banners.php">Deleted Banner</a></li>-->
                          
                           
                        </ul>
                    </li>  
                    <!--<li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>Trending projects</span></a>-->
                    <!--    <ul class="ml-menu">-->
                    <!--        <li><a href="all-trending-projects.php">All Trending projects</a></li>-->
                    <!--        <li><a href="create-trending-projects.php">Create Trending projects</a></li>-->
                    <!--        <li><a href="deleted-trending-projects.php">Deleted Trending projects</a></li>-->
                    <!--       </ul>-->
                    <!--</li>  -->
                    <!-- <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Builder gallery</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-builders-gallery.php">All Builder gallery</a></li>
                            <li><a href="create-builders-gallery.php">Create Builder gallery</a></li>
                            <li><a href="deleted-builders-gallery.php">Deleted Builder gallery</a></li>
                           </ul>
                    </li>   -->
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings"></i><span>Services</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-services.php">All Services</a></li>
                            <li><a href="create-services.php">Create Services</a></li>
                            <li><a href="deleted-services.php">Deleted Services</a></li>
                             
                        </ul>
                    </li>  

                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Builders</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-builders.php">All Builders</a></li>
                            <li><a href="create-builders.php">Create Builders</a></li>
                            <li><a href="deleted-builders.php">Deleted Builders</a></li>
                          
                           
                        </ul>
                    </li>  
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>Agents/broker/channel partner</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-agents.php">All Agents/broker/channel partner</a></li>
                            <li><a href="create-agents.php">Create Agents/broker/channel partner</a></li>
                            <li><a href="deleted-agents.php">Deleted Agents/broker/channel partner</a></li>
                          
                           
                        </ul>
                    </li>  
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>Customers</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-customers.php">All Customers</a></li>
                            <!-- <li><a href="create-customers.php">Create Customers</a></li> -->
                            <li><a href="all-buyers.php">All Buyer</a></li>
                            <li><a href="all-sellers.php">All Sellers</a></li>
                           
                          
                           
                        </ul>
                    </li>  
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Projects</span></a>
                        <ul class="ml-menu">
                            <li><a href="all-projects.php">All Projects</a></li>
                            <li><a href="create-project.php">Create Project</a></li>
                            <li><a href="expired-project.php">Expired Project</a></li>
                            <li><a href="deleted-projects.php">Deleted Projects</a></li>
                           
                        </ul>
                    </li>  
                          
                     <li><a href="leads-list.php" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Leads List</span></a></li>
                    <!--    <ul class="ml-menu">-->
                            
                    <!--        <li><a href="property-list.php">Property List</a></li>-->
                    <!--        <li><a href="property-add.php">Add Property</a></li>-->
                    <!--        <li><a href="active-property.php">Active Property</a></li>-->
                    <!--        <li><a href="in-active-property.php">In-active Property</a></li>-->
                    <!--        <li><a href="expride-property.php">Expride Property</a></li>-->
                    <!--        <li><a href="deleted-property.php">Deleted Property</a></li>-->
                    <!--    </ul>-->
                    <!--</li>-->

                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Employees</span></a>
                        <ul class="ml-menu">
                            
                            <li><a href="employee-list.php">All Employees</a></li>
                            <li><a href="employee-add.php">Add Employee</a></li>
                            <li><a href="active-employee.php">Active Employees</a></li>
                            <li><a href="in-active-employee.php">In-active Employees</a></li>
                            
                           
                        </ul>
                    </li>

<!-- 
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-case-check"></i><span>Leads</span></a>
                        <ul class="ml-menu">
                            <li><a href="leads-list.php">All Leads</a></li>
                            <li><a href="website-leads.php">website Leads</a></li>
                            <li><a href="channel-partner-leads.php">Channale Partner/ Agent Leads</a></li>
                            <li><a href="deleted-leads.php">Deleted Leads</a></li>
                            
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-case-check"></i><span>Booster</span></a>
                        <ul class="ml-menu">
                        <li><a href="all-add-booster.php">All Add booster</a></li>
                        <li><a href="all-social-media-promotion.php">All Social Meadia Promotion</a></li>   
                            
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Promotions</span></a>
                        <ul class="ml-menu">
                            <li><a href="All-notification.php">All Notification</a></li>
                           
                                                 
                            
                        </ul>
                    </li> -->
                    <!-- <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Channel partners Offers</span></a>
                        <ul class="ml-menu">
                            <li><a href="partner-offers.php">Offer List </a></li>
                            <li><a href="create-offers.php">Create Offers</a></li>
                         
                          
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Partner Tie-Up Request</span></a>
                        <ul class="ml-menu">
                           
                            <li><a href="partner-ti-up-request.php">Partner Tie-Up Request</a></li>
                            <li><a href="accepted-request.php">Accepted Partners</a></li>
                            <li><a href="rejected-request.php">Rejected Partners</a></li>                        
                          
                        </ul>
                    </li> -->
                    <!-- <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Packages</span></a>
                        <ul class="ml-menu">
                           
                            <li><a href="partner-ti-up-request.php">All Packages</a></li>
                            <li><a href="">Create Packages</a></li>
                            <li><a href="">Active Packages</a></li> 
                            <li><a href="">Active Packages</a></li> 
                            <li><a href="">Deleted Packages</a></li>                        
                         </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city"></i><span>Payments</span></a>
                        <ul class="ml-menu">
                           
                            <li><a href="all-payments.php">All Payments</a></li>
                            <li><a href="received-payments.php">Received Payments</a></li>
                            <li><a href="pending-payments.php">Pending Payments</a></li> 
                            <li><a href="failed-payments.php">Failed/rejected</a></li> 
                            <li><a href="re-payments.php">Re-payment</a></li> 
                             
                        </ul>
                    </li> -->
                    <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-balance-wallet"></i><span>Banks</span></a>
                        <ul class="ml-menu">
                            <li><a href="bank-details.php">Bank Details</a></li>  
                            <li><a href="create-bank-details.php">Create Bank Details</a></li>  
                            <!--<li><a href="all-bank-details.php">All Client Bank details</a></li>-->
                            <!--<li><a href="add-bank-details.php">Add bank Details</a></li>-->
                            <!--<li><a href="active-bank-details.php">Active bank Details</a></li> -->
                            <!--<li><a href="in-active-bank.php">In-Active bank Details</a></li>-->
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
                            <!--<div class="image"><a href=""><img src="assets/images/profile_av.jpg" alt="User"></a></div>-->
                            <div class="detail">
                                <h4>Homesquare</h4>
                                <div class="info">
                                    <small>Admin</small>
                                    <a href="edit-profile.php" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                          
                            <!--<p class="text-muted">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>-->
                            <!--<div class="row">-->
                            <!--    <div class="col-4">-->
                            <!--        <h6 class="mb-1">852</h6>-->
                            <!--        <small>Deals</small>-->
                            <!--    </div>-->
                            <!--    <div class="col-4">-->
                            <!--        <h6 class="mb-1">13k</h6>-->
                            <!--        <small>Sales</small>-->
                            <!--    </div>-->
                            <!--    <div class="col-4">-->
                            <!--        <h6 class="mb-1">234</h6>-->
                            <!--        <small>Clients</small>-->
                            <!--    </div>                            -->
                            <!--</div>-->
                        </div>
                    </li>
                    <li>
                        <small class="text-muted">Email address: </small>
                        <p>mahi@gmail.com</p>
                        <hr>
                        <small class="text-muted">Phone: </small>
                        <p>+91-00000000000</p>
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