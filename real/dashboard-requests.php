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

<!--content-->
<div class="content">
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                        <div class="breadcrumbs-list bl_flat">
                            <a href="#">Home</a><a href="#">Dashboard</a><span>Requests</span>
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
                                            <div class="dashboard-title-item"><span> Your  Requests <strong>6</strong> </span></div>
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
                                            <div class="dasboard-opt-header">
                                                <div class="dashboard-search-listing">
                                                    <input type="text" onclick="this.select()" placeholder="Search" value="">
                                                    <button type="submit"><i class="far fa-search"></i></button>
                                                </div>
                                                <div class="db-price-opt-container">
                                                    <!-- price-opt-->
                                                    <div class="db-price-opt">
                                                        <span class="price-opt-title">Sort   by:</span>
                                                        <div class="cs-intputwrap" style="margin-bottom: 0">
                                                            <i class="fa-light fa-arrow-down-small-big"></i>
                                                            <select data-placeholder="Popularity" class="chosen-select no-search-select">
                                                                <option>Lastes</option>
                                                                <option>Oldes</option>
                                                                <option>Name: A-Z</option>
                                                                <option>Name: Z-A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- price-opt end-->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- bookings-item -->
                                                <div class="col-lg-6">
                                                    <div class="bookings-item">
                                                        <div class="bookings-item-header">
                                                            <img src="images/all/thumbnails/2.jpg" alt="">
                                                            <h4>For <a href="listing-single.html" target="_blank">Gorgeous house for sale</a></h4>
                                                            <span class="new-bookmark">New</span>
                                                        </div>
                                                        <div class="bookings-item-content">
                                                            <ul>
                                                                <li>Name: <span>Andy Smith</span></li>
                                                                <li>Phone: <span>+7(123)987654</span></li>
                                                                <li>Date: <span>18.05.2024</span></li>
                                                                <li>Time: <span>12 AM</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="bookings-item-footer">
                                                            <span class="message-date"><i class="fa-regular fa-calendar"></i> 12 May 2024</span>
                                                            <ul>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Call"><i class="fa-regular fa-phone"></i></a></li>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Delete"><i class="fa-regular fa-trash-can"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- bookings-item end -->
                                                <!-- bookings-item -->
                                                <div class="col-lg-6">
                                                    <div class="bookings-item">
                                                        <div class="bookings-item-header">
                                                            <img src="images/all/thumbnails/1.jpg" alt="">
                                                            <h4>For <a href="listing-single.html" target="_blank">Luxury Family Home</a></h4>
                                                        </div>
                                                        <div class="bookings-item-content">
                                                            <ul>
                                                                <li>Name: <span>Adam Forser</span></li>
                                                                <li>Phone: <span>+7(123)987654</span></li>
                                                                <li>Date: <span>28.05.2024</span></li>
                                                                <li>Time: <span>06 AM</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="bookings-item-footer">
                                                            <span class="message-date"><i class="fa-regular fa-calendar"></i> 12 May 2024</span>
                                                            <ul>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Call"><i class="fa-regular fa-phone"></i></a></li>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Delete"><i class="fa-regular fa-trash-can"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- bookings-item end -->
                                                <!-- bookings-item -->
                                                <div class="col-lg-6">
                                                    <div class="bookings-item">
                                                        <div class="bookings-item-header">
                                                            <img src="images/all/thumbnails/3.jpg" alt="">
                                                            <h4>For <a href="listing-single.html" target="_blank">Kayak Point House</a></h4>
                                                        </div>
                                                        <div class="bookings-item-content">
                                                            <ul>
                                                                <li>Name: <span>Jessie Wilcox</span></li>
                                                                <li>Phone: <span>+7(123)987654</span></li>
                                                                <li>Date: <span>13.05.2024</span></li>
                                                                <li>Time: <span>10 AM</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="bookings-item-footer">
                                                            <span class="message-date"><i class="fa-regular fa-calendar"></i> 25 March 2024</span>
                                                            <ul>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Call"><i class="fa-regular fa-phone"></i></a></li>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Delete"><i class="fa-regular fa-trash-can"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- bookings-item end -->										
                                                <!-- bookings-item -->
                                                <div class="col-lg-6">
                                                    <div class="bookings-item">
                                                        <div class="bookings-item-header">
                                                            <img src="images/all/thumbnails/1.jpg" alt="">
                                                            <h4>For <a href="listing-single.html" target="_blank">Urban House</a></h4>
                                                            <span class="new-bookmark">New</span>
                                                        </div>
                                                        <div class="bookings-item-content">
                                                            <ul>
                                                                <li>Name: <span>Adam Forser</span></li>
                                                                <li>Phone: <span>+7(123)987654</span></li>
                                                                <li>Date: <span>28.03.2024</span></li>
                                                                <li>Time: <span>03 AM</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="bookings-item-footer">
                                                            <span class="message-date"><i class="fa-regular fa-calendar"></i> 12 march 2024</span>
                                                            <ul>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Call"><i class="fa-regular fa-phone"></i></a></li>
                                                                <li><a href="#" class="tolt" data-microtip-position="left" data-tooltip="Delete"><i class="fa-regular fa-trash-can"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- bookings-item end -->										
                                            </div>
                                        </div>
                                        <div class="pagination-wrap">
                                            <div class="pagination float-pagination">
                                                <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                                                <a href="#">1</a>
                                                <a href="#" class="current-page">2</a>
                                                <a href="#">3</a>
                                                <a href="#">4</a>
                                                <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                                            </div>
                                            <div class="load-more_btn"><i class="fa-solid fa-arrows-spin"></i>Load More</div>
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

<?php include ('includes/footer.php');?>
