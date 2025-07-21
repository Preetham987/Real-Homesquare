<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Rentstate - Real Estate Agency Template</title>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="css/plugins.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/db-style.css">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="loader-inner">
                <svg>
                    <defs>
                        <filter id="goo">
                            <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey" />
                            <fecomposite in="SourceGraphic" in2="gooey" operator="atop"/>
                        </filter>
                    </defs>
                </svg>
            </div>
        </div>
        <!--loader end-->
        <!--  main   -->
        <div id="main">
            <!--header-->
            <header class="main-header">
                <div class="container">
                    <div class="header-inner">
                        <a href="index.php" class="logo-holder"><img src="images/logo-1.png" alt="Homesquare" style="height: 40px; margin-top: -13px;"></a>
                        <!--  navigation --> 
                        
                        <!-- navigation  end -->						
                        <!-- nav-button-wrap-->
                        <div class="nav-button-wrap">
                            <div class="nav-button">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <!-- nav-button-wrap end-->						
                        <!-- header-search-wrap  -->	
                       
                        <!-- header-search-wrap  end -->	
                        <a href="add-listing.php" class="header-btn"><span>Add Your Propperty</span></a>
                        <!--<div class="wish_btn swl_btn tolt" data-microtip-position="bottom"  data-tooltip="Wishlist">-->
                        <!--    <div class="wish_btn-item"><i class="fa-thin fa-heart"></i><span class="wish_count">3</span></div>-->
                        <!--</div>-->
                            <style>
                                .header-user-menu {
                                    position: relative;
                                    display: inline-block;
                                }
                        
                                .user-avatar {
                                    width: 40px;
                                    height: 40px;
                                    border-radius: 50%;
                                    cursor: pointer;
                                }
                        
                                .dropdown-menu {
                                    display: none;
                                    position: absolute;
                                    right: 0;
                                    top: 50px;
                                    background-color: white;
                                    border: 1px solid #ccc;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    border-radius: 5px;
                                    padding: 10px;
                                    z-index: 999;
                                    width: 220px;
                                }
                        
                                .dropdown-menu a {
                                    display: block;
                                    padding: 8px 10px;
                                    text-decoration: none;
                                    color: #333;
                                    border-radius: 4px;
                                    text-align: left; /* ensures left-aligned text */
                                }
                        
                                .dropdown-menu a:hover {
                                    background-color: #f0f0f0;
                                }
                                .dropdown-menu a i {
                                    margin-right: 8px;
                                    color: #666;
                                    width: 20px;
                                    text-align: center;
                                }
                            </style>
                            <?php
                            session_start();
                            
                            $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
                            ?>
                        <div class="header-user-menu">
                            <div class="header-user-name">
                                <span>Hello , <strong><?php echo htmlspecialchars($name); ?></strong></span>
                                <img src="images/avatar/2.jpg" alt="User Image" class="user-avatar" id="dropdownToggle"> 
                            </div>
                                <div class="dropdown-menu" id="userDropdown">
                                    <a href="dashboard-editprofile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                                    <a href="add-listing.php"><i class="fas fa-plus-circle"></i> Add Listing</a>
                                    <a href="current-listings.php"><i class="fas fa-list"></i> Current Listings</a>
                                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                                </div>
                        </div>
                        <script>
                            const toggle = document.getElementById('dropdownToggle');
                            const menu = document.getElementById('userDropdown');
                        
                            toggle.addEventListener('click', function (e) {
                                e.stopPropagation();
                                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
                            });
                        
                            document.addEventListener('click', function (e) {
                                if (!toggle.contains(e.target)) {
                                    menu.style.display = 'none';
                                }
                            });
                        </script>
                    </div>
                </div>
            </header>
            <div class="body-overlay fs -wrapper search-form-overlay close-search-form"></div>