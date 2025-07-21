<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>
            <!--header-end-->
            <!--warpper-->
            <div class="wrapper">
                <!--content-->
                <div class="content">
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                        <div class="breadcrumbs-list bl_flat">
                            <a href="#">Home</a> <span>Dashboard</span>
                            <div class="breadcrumbs-list_dec"><i class="fa-thin fa-arrow-up"></i></div>
                        </div>
                        <!--breadcrumbs-list end-->					
                        <!--main-content-->
                        <div class="main-content  ms_vir_height">
                            <!--boxed-container-->
                            <div class="boxed-container">
                                <div class="row">
                                    <!-- user-dasboard-menu_wrap -->	
                                    <div class="col-lg-3">
                                    <?php include ('includes/side-bar.php');?>

                                    </div>
                                    <!-- user-dasboard-menu_wrap end-->
                                    <!-- pricing-column -->	
                                    <div class="col-lg-9">
                                        <div class="dashboard-title">
                                            <div class="dashboard-title-item"><span>Your Dashboard</span></div>
                                            <!--Tariff Plan menu-->
                                            <!--<div class="tfp-det-container">-->
                                            <!--    <div class="db-date"><i class="fa-regular fa-calendar"></i><strong></strong></div>-->
                                            <!--    <div class="tfp-btn"><span>Your Tariff Plan : </span> <strong>Extended</strong></div>-->
                                            <!--    <div class="tfp-det">-->
                                            <!--        <p>You Are on <a href="#">Extended</a> . Use link bellow to view details or upgrade. </p>-->
                                            <!--        <a href="#" class="tfp-det-btn color-bg">View Details <i class="fa-solid fa-caret-right"></i></a>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--Tariff Plan menu end-->						
                                        </div>
                                        <div class="db-container">
                                            <div class="notification success-notif">
                                                <p>Your listing <a href="#">Family house in Brooklyn</a> has been approved!</p>
                                                <a class="notification-close" href="#"><i class="fal fa-times"></i></a>
                                            </div>
                                            <!-- dashboard facts -->
                                            <div class="db-single-facts-container">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <!-- inline-facts -->
                                                        <div class="db-single-facts-wrap">
                                                            <div class="db-single-facts">
                                                                <i class="fa-light fa-eye"></i>
                                                                <h6>Properties Views</h6>
                                                                <div class="milestone-counter">
                                                                    <div class="stats animaper">
                                                                        <div class="num" data-content="0" data-num="1054">0</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="stat-wave">
                                                                <svg viewbox="0 0 100 25">
                                                                    <path fill="#fff" d="M0 30 V12 Q30 17 55 7 T100 11 V30z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <!-- inline-facts end -->
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <!-- inline-facts  -->
                                                        <div class="db-single-facts-wrap">
                                                            <div class="db-single-facts">
                                                                <i class="fa-light fa-heart"></i>
                                                                <h6>Total Favourites</h6>
                                                                <div class="milestone-counter">
                                                                    <div class="stats animaper">
                                                                        <div class="num" data-content="0" data-num="557">0</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="stat-wave">
                                                                <svg viewbox="0 0 100 25">
                                                                    <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <!-- inline-facts end -->
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <!-- inline-facts  -->
                                                        <div class="db-single-facts-wrap">
                                                            <div class="db-single-facts">
                                                                <i class="fa-light fa-house-building"></i>
                                                                <h6>Total Properties </h6>
                                                                <div class="milestone-counter">
                                                                    <div class="stats animaper">
                                                                        <div class="num" data-content="0" data-num="16">0</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="stat-wave">
                                                                <svg viewbox="0 0 100 25">
                                                                    <path fill="#fff" d="M0 30 V12 Q30 12 55 5 T100 11 V30z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <!-- inline-facts end -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- dashboard facts end-->				
                                            <!--<div class="dasboard-content">-->
                                                <!-- chart-wrap-->
                                            <!--    <div class="chart-wrap">-->
                                            <!--        <div class="chart-header">-->
                                            <!--            <div class="dashboard-widget-title">Your weekly  Statistic</div>-->
                                            <!--            <div id="myChartLegend"></div>-->
                                            <!--        </div>-->
                                            <!--        <canvas id="canvas-chart"></canvas>-->
                                            <!--    </div>-->
                                                <!--chart-wrap end-->
                                            <!--</div>-->
                                            <div class="dasboard-content">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="dashboard-widget-title-single">Last Activites</div>
                                                        <div class="dashboard-list-box">
                                                            <!-- dashboard-list end-->
                                                            <div class="dashboard-list">
                                                                <div class="dashboard-message">
                                                                    <span class="close-dashboard-item"><i class="fa-regular fa-xmark"></i></span>
                                                                    <div class="main-dashboard-message-icon"><i class="fa-regular fa-check"></i></div>
                                                                    <div class="main-dashboard-message-text">
                                                                        <p>Your listing <a href="#">Urban Appartmes</a> has been approved! </p>
                                                                    </div>
                                                                    <div class="main-dashboard-message-time"><i class="fa-regular fa-calendar"></i> 28 may 2024</div>
                                                                </div>
                                                            </div>
                                                            <!-- dashboard-list end-->
                                                            <!-- dashboard-list end-->
                                                            <div class="dashboard-list">
                                                                <div class="dashboard-message">
                                                                    <span class="close-dashboard-item"><i class="fa-regular fa-xmark"></i></span>
                                                                    <div class="main-dashboard-message-icon"><i class="fa-light fa-house-building"></i></div>
                                                                    <div class="main-dashboard-message-text">
                                                                        <p> Someone Request a Showing  on <a href="#">Park Central</a> listing!</p>
                                                                    </div>
                                                                    <div class="main-dashboard-message-time"><i class="fa-regular fa-calendar"></i>  05 April 2024</div>
                                                                </div>
                                                            </div>
                                                            <!-- dashboard-list end-->
                                                            <!-- dashboard-list end-->
                                                            <div class="dashboard-list">
                                                                <div class="dashboard-message">
                                                                    <span class="close-dashboard-item"><i class="fa-regular fa-xmark"></i></span>
                                                                    <div class="main-dashboard-message-icon"><i class="fa-light fa-heart"></i></div>
                                                                    <div class="main-dashboard-message-text">
                                                                        <p><a href="#">Fider Mamby</a> bookmarked your <a href="#">Holiday Home</a> listing!</p>
                                                                    </div>
                                                                    <div class="main-dashboard-message-time"><i class="fa-regular fa-calendar"></i> 10 March 2024</div>
                                                                </div>
                                                            </div>
                                                            <!-- dashboard-list end-->
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="post-banner-widget">
                                                            <div class="bg-wrap fs-wrapper bg-parallax-wrap-gradien">
                                                                <div class="bg  " data-bg="images/all/10.jpg"></div>
                                                            </div>
                                                            <div class="post-banner-widget_content">
                                                                <h5>Participate in our loyalty program. Refer a friend and get a discount.</h5>
                                                                <a href="#">Read more</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- pricing-column end-->											
                                </div>
                                <div class="limit-box"></div>
                            </div>
                            <!--boxed-container end-->
                        </div>
                        <!--main-content end-->
                        <div class="to_top-btn-wrap">
                            <div class="to-top to-top_btn"><span>Back to top</span> <i class="fa-solid fa-arrow-up"></i></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;left:  -40px; transform: rotate(-90deg)"></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;right: -40px; transform: rotate(-180deg)"></div>
                        </div>
                    </div>
                    <!-- container end-->
                </div>
                <!--content  end-->
                <!--main-footer-->
                <div class="height-emulator"></div>
                <footer class="main-footer">
                    <div class="container">
                        <div class="footer-inner">
                            <div class="row">
                                <!-- footer-widget -->
                                <div class="col-lg-4">
                                    <div class="footer-widget">
                                        <div class="footer-widget-title">Get Our Application</div>
                                        <div class="footer-widget-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
                                            <div class="api-links-wrap">
                                                <a href="#" class="footer-widget-content-link"><span> On Apple Store</span><i class="fa-brands fa-apple"></i></a>
                                                <a href="#" class="footer-widget-content-link"><span> On Google PLay</span><i class="fa-brands fa-google-play"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer-widget  end-->
                                <!-- footer-widget -->
                                <div class="col-lg-2">
                                    <div class="footer-widget">
                                        <div class="footer-widget-title">Helpful links</div>
                                        <div class="footer-widget-content">
                                            <div class="footer-list footer-box  ">
                                                <ul>
                                                    <li><a href="#">Our last News</a></li>
                                                    <li><a href="#">Pricing Plans</a></li>
                                                    <li><a href="#">Contacts</a></li>
                                                    <li><a href="#">Help Center</a></li>
                                                    <li><a href="#">Privacy Policy</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer-widget  end-->
                                <!-- footer-widget -->
                                <div class="col-lg-2">
                                    <div class="footer-widget">
                                        <div class="footer-widget-title">Our Contacts</div>
                                        <div class="footer-widget-content">
                                            <div class="footer-list footer-box  ">
                                                <ul  class="footer-contacts  ">
                                                    <li><span>Mail :</span><a href="#" target="_blank">yourmail@domain.com</a></li>
                                                    <li> <span>Adress :</span><a href="#" target="_blank">USA 27TH Brooklyn NY</a></li>
                                                    <li><span>Phone :</span><a href="#">+2(111)123456789</a></li>
                                                </ul>
                                                <a href="contacts.html" class="footer-widget-content-link"><span>Get in Touch</span><i class="fa-solid fa-caret-right"></i></a>	
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer-widget  end-->								
                                <!-- footer-widget -->
                                <div class="col-lg-4">
                                    <div class="footer-widget">
                                        <div class="footer-widget-title">Subscribe</div>
                                        <div class="footer-widget-content">
                                            <p>Want to be notified when we launch a new template or an udpate. Just sign up and we'll send you a notification by email.</p>
                                            <form id="subscribe"   class="subscribe-item">
                                                <input class="enteremail" name="email" id="subscribe-email" placeholder="Your Email" spellcheck="false" type="text">
                                                <button type="submit" id="subscribe-button" class="subscribe-button"><span>Send</span> </button>
                                                <label for="subscribe-email" class="subscribe-message"></label>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer-widget  end-->
                            </div>
                            <!-- footer-widget-wrap end-->					
                        </div>
                        <div class="footer-bottom">
                            <a href="index.html" class="footer-home_link"><i class="fa-regular  fa-house"></i></a>		
                            <div class="copyright"> <span>&#169;Renstate 2024</span> . All rights reserved. </div>
                            <div class="footer-social">
                                <span class="footer-social-title">Follow Us</span>
                                <div class="footer-social-wrap">
                                    <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> 
                                    <a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a> 
                                    <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a> 
                                    <a href="#" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                                    <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>										 
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!--main-footer end-->
            </div>
            <!--warpper end-->
            <!--wish-list-wrap-->
            <div class="wish-list-wrap">
                <div class="wish-list-close clwl_btn"><i class="fa-regular fa-xmark"></i></div>
                <div class="wish-list_header">
                    <div class="wish-list-title">Your Wishlist <span>3</span></div>
                </div>
                <div class="wish-list-container">
                    <!--wish-list-item-->
                    <div class="wish-list-item fl-wrap">
                        <div class="wish-list-img"><a href="listing-single.html"><img src="images/all/thumbnails/1.jpg" alt=""></a>  
                        </div>
                        <div class="wish-list-descr">
                            <h4><a href="listing-single.html">Urban House</a></h4>
                            <div class="geodir-category-location fl-wrap"><a href="#"> 40 Journal Square  , NJ, USA</a></div>
                            <div class="wish-list-price"> $ 320,000</div>
                            <div class="clear-wishlist"><i class="fa-regular fa-trash-can"></i></div>
                        </div>
                    </div>
                    <!--wish-list-item end-->
                    <!--wish-list-item-->
                    <div class="wish-list-item fl-wrap">
                        <div class="wish-list-img"><a href="listing-single.html"><img src="images/all/thumbnails/2.jpg" alt=""></a>  
                        </div>
                        <div class="wish-list-descr">
                            <h4><a href="listing-single.html">Luxury Family Home</a></h4>
                            <div class="geodir-category-location fl-wrap"><a href="#">  40 Journal Square  , NJ, USA</a></div>
                            <div class="wish-list-price">  $ 1500 - per month</div>
                            <div class="clear-wishlist"><i class="fa-regular fa-trash-can"></i></div>
                        </div>
                    </div>
                    <!--wish-list-item end-->
                    <!--wish-list-item-->
                    <div class="wish-list-item fl-wrap">
                        <div class="wish-list-img"><a href="listing-single.html"><img src="images/all/thumbnails/3.jpg" alt=""></a>  
                        </div>
                        <div class="wish-list-descr">
                            <h4><a href="listing-single.html">Modern Apartment</a></h4>
                            <div class="geodir-category-location fl-wrap"><a href="#">  40 Journal Square  , NJ, USA</a></div>
                            <div class="wish-list-price"> $ 1,600,000</div>
                            <div class="clear-wishlist"><i class="fa-regular fa-trash-can"></i></div>
                        </div>
                    </div>
                    <!--wish-list-item end-->					
                </div>
                <div class="wish-list-footer">
                    <div class="clear_wishlist">  Clear Wishlist</div>
                </div>
            </div>
            <!--wish-list-wrap end-->
            <div class="mob-nav-overlay fs-wrapper"></div>
            <div class="body-overlay fs-wrapper wishlist-wrap-overlay clwl_btn"></div>
            <!-- progress-bar  -->
            <div class="progress-bar-wrap">
                <div class="progress-bar color-bg"></div>
            </div>
            <!-- progress-bar end -->			
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->   
        <script  src="js/jquery.min.js"></script>
        <script  src="js/plugins.js"></script>
        <script  src="js/scripts.js"></script>
        <script src="js/charts.js"></script>		
        <script  src="js/db-scripts.js"></script>
    </body>
</html>