<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<?php include ('includes/db.php');?>
<?php
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

$stmt = $conn->prepare("SELECT * FROM builder_panel_projects_table WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

if (!$project) {
    echo "Project not found.";
    exit();
}

$project_id = $project['id'];
// Fetching both columns
$bannerImageString = $project['banner_image']; // "uploads/img1.jpg,uploads/img2.jpg"
$projectImageString = $project['project_images']; 
// "uploads/img1.jpg:uploads/img2.jpg,uploads/img3.jpg:uploads/img4.jpg"

// Exploding banner images by comma
$bannerImages = array_filter(array_map('trim', explode(',', $bannerImageString)));

// First explode project_images by comma, then explode each piece by colon
$projectImages = [];
$commaChunks = explode(',', $projectImageString);
foreach ($commaChunks as $chunk) {
    $colonSplit = explode(':', $chunk);
    foreach ($colonSplit as $img) {
        $img = trim($img);
        if (!empty($img)) {
            $projectImages[] = $img;
        }
    }
}

// Merge all images into one array if needed
$allImages = array_merge($bannerImages, $projectImages);
?>
<style>
    .container {
    width: min(100% - 25px, 1350px);
    margin-inline: auto;
    position: relative;
    z-index: 5;
}
</style>

<div class="body-overlay fs-wrapper search-form-overlay close-search-form"></div>
<!--header-end-->
<!--warpper-->
<div class="wrapper">
    <div class="content">
        <div class="container">
            <div class="boxed-container">
                <div class="list-single-opt_header hsc_flat_bci">
                    <div id="Overview" class="hero-section_categories">
                        <p style="font-size: 12px;">
                            <span id="breadcrumb" style="float:left">Home / Bangalore North / Bangalore / Homesquare</span> 
                            <span id="last-updated" style="float:right">Last updated: Jan 9, 2025</span>
                        </p>
                
                        <br><br>
                        <p style="font-size: 20px;">
                            <span id="project-name" style="float:left"></span> 
                            <span id="price-range" style="float:right"></span>
                        </p>
                
                        <br>
                        <p style="font-size: 12px;color:blue">
                            <span style="float:left">By HOMESQUARE</span> 
                            <span style="float:right">EMI starts at ₹62.68 K <span class="p3">Including GST</span></span>
                        </p>
                
                        <br>
                        <p style="font-size: 12px;">
                            <span id="project-location" style="float:left"></span>
                            <?php if (!$is_logged_in): ?>
                                <!-- User is NOT logged in: Show modal trigger button -->
                                <div class="show-reg-form modal-open" style="margin-right: 0px; background: #000">
                                    <span style="color: white;">Contact Developer</span>
                                </div>
                            <?php else: ?>
                                <!-- User IS logged in: Show different styled button -->
                                <span style="float:right">
                                    <button id="contactBtn" class="button-1" onclick="submitLead()">Contact Developer</button>
                                    <div id="contactMsg" style="margin-top: 8px;"></div>
                                </span>
                            <?php endif; ?>
                            <script>
                            function submitLead() {
                                const project = window.location.pathname.split('/').filter(Boolean).pop();
                            
                                fetch('listing-single-post-code.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ project: project })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    const msgDiv = document.getElementById('contactMsg');
                            
                                    if (data.status === 'success') {
                                        document.getElementById('contactBtn').style.display = 'none';
                                        msgDiv.style.color = 'green';
                                        msgDiv.textContent = 'Contacted Developer';
                                    } else if (data.message.includes("already contacted")) {
                                        msgDiv.style.color = 'red';
                                        msgDiv.textContent = 'You have already contacted for this project.';
                                    } else {
                                        msgDiv.style.color = 'red';
                                        msgDiv.textContent = data.message;
                                    }
                                })
                                .catch(err => {
                                    const msgDiv = document.getElementById('contactMsg');
                                    msgDiv.style.color = 'red';
                                    msgDiv.textContent = 'Error submitting lead: ' + err.message;
                                });
                            }
                            </script>
                        </p>
                    </div>
                </div>
                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                $(document).ready(function () {
                    // Extract slug from URL path
                    let pathSegments = window.location.pathname.split("/").filter(segment => segment !== "");
                    let slug = pathSegments[pathSegments.length - 1]; // Assumes slug is the last part of the URL
                
                    if (slug) {
                        $.ajax({
                            url: "listing-single-fetch-code.php",
                            type: "GET",
                            data: { slug: slug },
                            dataType: "json",
                            success: function (response) {
                                console.log("Response:", response);
                
                                if (!response.error) {
                                    $("#project-name").text(response.project_name);
                                    $("#price-range").html(`${response.min_price} Cr - ${response.max_price} Cr`);
                                    $("#project-location").text(`${response.property_address}, ${response.property_address2}, ${response.project_location}`);
                                } else {
                                    $("#Overview").html(`<p>${response.error}</p>`);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX Error:", error);
                                console.log("Status:", status);
                                console.log("XHR Response:", xhr.responseText);
                                $("#Overview").html(`<p>Error fetching project details. ${xhr.responseText}</p>`);
                            }
                        });
                    } else {
                        $("#Overview").html("<p>Invalid Project Slug.</p>");
                    }
                });
                </script>

                <div class="row">
                    <div class="col-md-8">
                        <?php if (!empty($allImages[0])): ?>
                            <img src="../admin_panel/<?php echo htmlspecialchars($allImages[0]); ?>" style="width:100%" alt="Large Image" />
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">                        
                        <?php if (!empty($allImages[1])): ?>
                            <img src="../admin_panel/<?php echo htmlspecialchars($allImages[1]); ?>" style="width:100%" alt="Small Image 1" />
                        <?php endif; ?>
                        <p id="trigger-popup" style="text-align:center">View More Images</p>
                    </div>
                </div>
                
                <div id="image-popup" class="popup">
                    <div class="popup-content">
                        <span class="close">&times;</span>
                
                        <div class="carousel-container">
                            <div class="carousel">
                                <?php foreach ($allImages as $index => $imgPath): ?>
                                    <img src="../admin_panel/<?php echo htmlspecialchars($imgPath); ?>" alt="Image <?php echo $index + 1; ?>" />
                                <?php endforeach; ?>
                            </div>
                            <button class="prev-btn">&#10094;</button>
                            <button class="next-btn">&#10095;</button>
                        </div>
                    </div>
                </div>

                <script>
                    const popup = document.getElementById("image-popup");
                    const triggerPopup = document.getElementById("trigger-popup");
                    const closePopup = document.querySelector(".close");
                    const carousel = document.querySelector(".carousel");
                    const prevBtn = document.querySelector(".prev-btn");
                    const nextBtn = document.querySelector(".next-btn");

                    let currentIndex = 0;

                    triggerPopup.addEventListener("click", () => {
                        popup.style.display = "flex";
                    });

                    closePopup.addEventListener("click", () => {
                        popup.style.display = "none";
                    });

                    prevBtn.addEventListener("click", () => {
                        currentIndex = currentIndex > 0 ? currentIndex - 1 : 14;
                        updateCarousel();
                    });

                    nextBtn.addEventListener("click", () => {
                        currentIndex = currentIndex < 14 ? currentIndex + 1 : 0;
                        updateCarousel();
                    });

                    function updateCarousel() {
                        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                    }
                </script>
               
            </div>
        </div>
        <div class="container">
        <div class="four-sections">
                    <div class="section">
                        <h2>2, 3, 4 BHK Apartments</h2>
                        <p>Configurations</p>
                    </div>
                    <div class="section">
                        <h2>Dec, 2029</h2>
                        <p>Possession Starts</p>
                    </div>
                    <div class="section">
                        <h2>₹9.77 K/sq.ft</h2>
                        <p>Avg. Price</p>
                    </div>
                    <div class="section">
                        <h2>1285 - 2075 sq.ft.</h2>
                        <p>(Saleable Area)</p>
                    </div>
                </div>
                <div class="carousel-container">
                    <div class="carousel">
                        <a href="#Overview" class="carousel-link">Overview/Home</a>
                        <a href="#AroundThisProject" class="carousel-link">Around This Project</a>
                        <a href="#MoreAboutProject" class="carousel-link">More About Project</a>
                        <a href="#FloorPlan" class="carousel-link">Floor Plan</a>
                        <a href="#TourThisProject" class="carousel-link">Tour This Project</a>
                        <a href="#Amenities" class="carousel-link">Amenities</a>
                        <a href="#ContactSellers" class="carousel-link">Contact Sellers</a>
                        <a href="#Brochure" class="carousel-link">Brochure</a>
                        <a href="#Locality" class="carousel-link">Locality</a>
                    </div>
                </div>
                </div>
        <script>
            function updateDivClass() {
                const div = document.getElementById("dynamicDiv");
                if (window.innerWidth <= 768) {
                    div.className = "right-content"; // Change class for mobile view
                } else {
                    div.className = "hero-opt-btnns"; // Revert class for desktop view
                }
            }

            // Run on page load and when window resizes
            window.addEventListener("load", updateDivClass);
            window.addEventListener("resize", updateDivClass);
        </script>
        <!--single-carousle-container-->
        <!-- <div class="fw-carousel-container">
                        <div class="fw-carousel-wrap ">
                            <div class="fw-carousel     lightgallery">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide hov_zoom">
                                            <img src="images/all/10.jpg" alt="">
                                            <a href="images/all/10.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                            <div class="show-info">
                                                <span>info</span>
                                                <div class="tooltip-info">
                                                    <h5>Room Details</h5>
                                                    <p>Sed non nisi viverra, porttitor sem nec, vestibulum justo tortor ornare turpis faucibus</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide  hov_zoom">
                                            <img src="images/all/16.jpg" alt="">
                                            <a href="images/all/16.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                            <div class="show-info">
                                                <span>info</span>
                                                <div class="tooltip-info">
                                                    <h5>Room Details</h5>
                                                    <p>Sed non nisi viverra, porttitor sem nec, vestibulum justo tortor ornare turpis faucibus</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide  hov_zoom">
                                            <img src="images/all/3.jpg" alt="">
                                            <a href="images/all/3.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                            <div class="show-info">
                                                <span>info</span>
                                                <div class="tooltip-info">
                                                    <h5>Room Details</h5>
                                                    <p>Sed non nisi viverra, porttitor sem nec, vestibulum justo tortor ornare turpis faucibus</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide  hov_zoom">
                                            <img src="images/all/14.jpg" alt="">
                                            <a href="images/all/14.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                            <div class="show-info">
                                                <span>info</span>
                                                <div class="tooltip-info">
                                                    <h5>Room Details</h5>
                                                    <p>Sed non nisi viverra, porttitor sem nec, vestibulum justo tortor ornare turpis faucibus</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide  hov_zoom">
                                            <img src="images/all/20.jpg" alt="">
                                            <a href="images/all/20.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                            <div class="show-info">
                                                <span>info</span>
                                                <div class="tooltip-info">
                                                    <h5>Room Details</h5>
                                                    <p>Sed non nisi viverra, porttitor sem nec, vestibulum justo tortor ornare turpis faucibus</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fw-carousel-button-prev slider-button"><i class="fa-solid fa-caret-left"></i></div>
                        <div class="fw-carousel-button-next slider-button"><i class="fa-solid fa-caret-right"></i></div>
                        <div class="fwc-controls_wrap">
                            <div class="solid-pagination_btns fwc-pagination"></div>
                        </div>
                    </div> -->
        <!--single-carousle-container-->
        <div class="container">
            <div class="main-content">
                <div class="boxed-container">
                    <div class="row">
                        <div class="col-lg-8">
                            <!--boxed-container-->
                            <div class="scroll-content-wrap">
                                <!-- <div class="share-holder init-fix-column">
                                                <span class="share-title">  Share   </span>
                                                <div class="share-container  isShare"></div>
                                            </div> -->
                                <!-- <div class="list-single-opt_header hsc_flat_bci">
                                                <div class="hero-section_categories">
                                                    <a href="#">For Sale</a>
                                                   
                                                </div>
                                                <div class="hero-opt-btnns">
                                                    <a href="#" class="like-btn tolt" data-microtip-position="left"  data-tooltip="Add to Wishlist"><i class="fa-light fa-heart"></i></a>
                                                    <a href="#single_cf" class="custom-scroll-link tolt" data-microtip-position="left"  data-tooltip="Contact to View"><i class="fa-light fa-envelope"></i></a>
                                                </div>
                                            </div> -->
                                <!--boxed-content-->
                                <!-- <div class="boxed-content">
                                                <div class="boxed-content-item">
                                                    <div class="hero-section-title_container hsc_flat">
                                                        <div class="hero-section-title">
                                                            <h2>RRL Palacio</h2>
                                                            <h4><i class="fa-solid fa-location-dot"></i> <span>Sarjapur, Sarjapur Main Road, South Bangalore, Bangalore</span></h4>
                                                            <div class="property-single-header-price"><strong>Price:</strong> <span class="pshp_item"><span>₹</span>150.500 </span></div>
                                                        </div>
                                                        <div class="hero-section-opt">
                                                            <div class="property-single-header-date author_avatar_ps"> <a href="author-single.php">  <img   src="images/avatar/2.jpg"   alt="">   By  Shubram builder Pvt LTD</a></div>
                                                            <div class="hs-pv_wrap">
                                                                <div class="pv-item">
                                                                    <i class="fa-light fa-glasses"></i>
                                                                    <span> Viewed - <strong>335</strong></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                <!-- <div class="ps-facts-wrapper">
                                                <div class="ps-facts-item">
                                                    <h4>Bedroom</h4>
                                                    <h5>Four</h5>
                                                    <i class="fa-light fa-bed"></i>
                                                </div>
                                                <div class="ps-facts-item">
                                                    <h4>Bethroom</h4>
                                                    <h5>Two</h5>
                                                    <i class="fa-light fa-bath"></i>
                                                </div>
                                                <div class="ps-facts-item">
                                                    <h4>Area</h4>
                                                    <h5>365 ft</h5>
                                                    <i class="fa-light fa-chart-area"></i>
                                                </div>
                                                <div class="ps-facts-item">
                                                    <h4>Parking</h4>
                                                    <h5>Outdoor</h5>
                                                    <i class="fa-light fa-car"></i>
                                                </div>
                                            </div> -->
                                <!--ps-facts-wrapper end-->
                                <!--boxed-content-->
                                <div class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>About this Property</h3>
                                    </div>
                                    <div class="boxed-content-item">
                                        <!-- We'll inject project overview here dynamically -->
                                        <div id="projectOverview"></div>
                                
                                        <div class="pp-single-opt-wrap">
                                            <div class="pp-single-opt-links">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" download><i class="fa-light fa-file-pdf"></i> Download Brochure </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa-light fa-layer-group"></i> View Floor Plans</a>
                                                    </li>
                                                </ul>
                                                <a href="javascript:void(0);" class="pp-single-opt-link_silngle">Visit Website</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        // Get slug from URL
                                        const urlSegments = window.location.pathname.split('/');
                                        const slug = urlSegments[urlSegments.length - 1] || urlSegments[urlSegments.length - 2];
                                
                                        if (!slug) {
                                            console.error("No slug found in URL.");
                                            return;
                                        }
                                
                                        $.ajax({
                                            url: "listing-single-fetch-code.php",  // Your backend URL
                                            type: "GET",
                                            data: { slug: slug },
                                            dataType: "json",
                                            success: function (data) {
                                                if (data.error) {
                                                    console.error("Error from backend:", data.error);
                                                    return;
                                                }
                                
                                                if (data.project_overview) {
                                                    // Convert double line breaks into paragraphs
                                                    const paragraphs = data.project_overview
                                                        .split('\n\n')
                                                        .map(p => `<p>${p.trim()}</p>`)
                                                        .join('');
                                
                                                    $("#projectOverview").html(paragraphs);
                                                } else {
                                                    console.warn("project_overview not found in response.");
                                                }
                                            },
                                            error: function (xhr, status, error) {
                                                console.error("AJAX Error:", error);
                                                console.error("XHR Response:", xhr.responseText);
                                            }
                                        });
                                    });
                                </script>
                                <!--boxed-content end-->
                                    <div id="MoreAboutProject" class="boxed-content">
                                        <div class="boxed-content-title">
                                            <h3>More About Project</h3>
                                        </div>
                                        <div class="boxed-content-item">
                                            <div class="pp-single-opt">
                                                <div class="pp-single-features">
                                                    <ul>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fal fa-layer-group"></i> Project Area: <span id="project_area">Loading...</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fal fa-maximize"></i> Project Size: <span id="project_size">Loading...</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fal fa-money-bill-wave"></i> Avg. Price: <span id="avg_price">Loading...</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fal fa-dumbbell"></i> Configurations: <span id="configurations">Loading...</span> BHK</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fal fa-dumbbell"></i> Rera Id: <span id="rera_id">Loading...</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    $(document).ready(function () {
                                        // Extract slug from the URL path
                                        let pathSegments = window.location.pathname.split("/").filter(segment => segment !== "");
                                        let slug = pathSegments[pathSegments.length - 1]; // Assuming the slug is at the end of the URL
                                    
                                        if (slug) {
                                            console.log("Fetching data for Project Slug:", slug);
                                    
                                            $.ajax({
                                                url: "listing-single-fetch-code.php",
                                                type: "GET",
                                                data: { slug: slug },
                                                dataType: "json",
                                                success: function (data) {
                                                    if (data.error) {
                                                        console.error("Error:", data.error);
                                                        return;
                                                    }
                                    
                                                    console.log("Fetched Data:", data);
                                    
                                                    // Update the elements with the fetched data
                                                    $("#project_area").text(data.project_area || "N/A");
                                                    $("#project_size").text(data.project_size || "N/A");
                                                    $("#avg_price").text(data.max_price || "N/A");
                                                    $("#configurations").text(data.no_of_bhk || "N/A");
                                                    $("#rera_id").text(data.rera_id || "N/A");
                                                },
                                                error: function (xhr, status, error) {
                                                    console.error("AJAX Error:", error);
                                                    console.error("XHR Response:", xhr.responseText);
                                                }
                                            });
                                        } else {
                                            console.error("No Project Slug found in URL.");
                                        }
                                    });
                                    </script>
                                <!--boxed content end-->
                                <div id="FloorPlan" class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>Floor Plan</h3>
                                    </div>
                                    <div class="boxed-content-item">
                                        <div class="pp-single-opt">
                                            <div class="pp-single-features">
                                                <!-- Tabs -->
                                                <div id="dynamic-tab-wrapper">
                                                    <!-- All dynamic main + nested tabs will be appended here -->
                                                </div>
                                                <div id="image-display-area" style="margin-top: 20px; margin-bottom: 20px;">
                                                    
                                                </div>
                                                <script>
                                                    function showMainTab(index) {
                                                        const wrappers = document.querySelectorAll(".main-tab-wrapper");
                                                        wrappers.forEach((wrapper, i) => {
                                                            const nestedContent = wrapper.querySelector(".nested-tab-content");
                                                            const btn = wrapper.querySelector(".tab-button");
                                                    
                                                            if (i === index) {
                                                                btn.classList.add("active");
                                                                nestedContent.style.display = "block";
                                                            } else {
                                                                btn.classList.remove("active");
                                                                nestedContent.style.display = "none";
                                                            }
                                                        });
                                                    }
                                                    
                                                    function showNestedTab(index, bhk) {
                                                        const tabContents = document.querySelectorAll(`.nested-tab-content[data-type='${bhk}']`);
                                                        const imageDisplayArea = document.getElementById("image-display-area");
                                                    
                                                        tabContents.forEach(content => {
                                                            const nestedBtns = content.querySelectorAll(".nested-tab");
                                                            nestedBtns.forEach((btn, i) => {
                                                                btn.classList.toggle("active", i === index);
                                                            });
                                                        });
                                                    
                                                        const imagePath = (window.projectImagesMap?.[bhk]?.[index]) || "";
                                                        imageDisplayArea.innerHTML = imagePath
                                                            ? `<img src="../admin_panel/${imagePath}" alt="Image" style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);" />`
                                                            : `<p>No image found for this section.</p>`;
                                                    }
                                                    
                                                    document.addEventListener("DOMContentLoaded", function () {
                                                        // Get slug from the URL path
                                                        const pathSegments = window.location.pathname.split("/").filter(Boolean);
                                                        const slug = pathSegments[pathSegments.length - 1];
                                                    
                                                        if (!slug) {
                                                            console.error("No project slug in URL");
                                                            return;
                                                        }
                                                    
                                                        fetch(`listing-single-fetch-code.php?slug=${slug}`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                if (data.error) {
                                                                    console.error("Error from backend:", data.error);
                                                                    return;
                                                                }
                                                    
                                                                const bhks = data.no_of_bhk.split(',').map(val => val.trim());
                                                                const prices = data.price.split(',').map(val => val.trim());
                                                                const saleableAreas = data.saleable_area_sft
                                                                    .split('/')
                                                                    .map(group => group.split(',').map(area => area.trim()));
                                                                const projectType = data.project_type || "N/A";
                                                    
                                                                const imageSections = data.project_images.split(',');
                                                                window.projectImagesMap = {};
                                                    
                                                                bhks.forEach((bhk, i) => {
                                                                    const section = imageSections[i] || "";
                                                                    const imageList = section.split(':').map(img => img.trim());
                                                                    window.projectImagesMap[bhk] = imageList;
                                                                });
                                                    
                                                                const tabContent = document.getElementById("dynamic-tab-wrapper");
                                                                tabContent.innerHTML = "";
                                                    
                                                                for (let i = 0; i < bhks.length; i++) {
                                                                    const bhk = bhks[i];
                                                                    const price = prices[i] || "Price N/A";
                                                                    const areas = saleableAreas[i] || [];
                                                    
                                                                    const mainTabWrapper = document.createElement("div");
                                                                    mainTabWrapper.classList.add("main-tab-wrapper");
                                                    
                                                                    const mainBtn = document.createElement("button");
                                                                    mainBtn.classList.add("tab-button");
                                                                    if (i === 0) mainBtn.classList.add("active");
                                                                    mainBtn.setAttribute("onclick", `showMainTab(${i})`);
                                                                    mainBtn.innerHTML = `${bhk}BHK <br />${projectType}<br />${price}`;
                                                                    mainTabWrapper.appendChild(mainBtn);
                                                    
                                                                    const nestedTabContent = document.createElement("div");
                                                                    nestedTabContent.classList.add("nested-tab-content");
                                                                    nestedTabContent.setAttribute("data-type", bhk);
                                                                    nestedTabContent.style.display = i === 0 ? "block" : "none";
                                                    
                                                                    areas.forEach((area, j) => {
                                                                        const nestedBtn = document.createElement("button");
                                                                        nestedBtn.classList.add("nested-tab");
                                                                        if (j === 0) nestedBtn.classList.add("active");
                                                                        nestedBtn.setAttribute("onclick", `showNestedTab(${j}, '${bhk}')`);
                                                                        nestedBtn.innerHTML = `${area} sq.ft`;
                                                    
                                                                        nestedTabContent.appendChild(nestedBtn);
                                                                    });
                                                    
                                                                    mainTabWrapper.appendChild(nestedTabContent);
                                                                    tabContent.appendChild(mainTabWrapper);
                                                                }
                                                    
                                                                if (bhks.length > 0) {
                                                                    showNestedTab(0, bhks[0]);
                                                                }
                                                            })
                                                            .catch(error => console.error("Error fetching project data:", error));
                                                    });
                                                    </script>
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fal fa-rug"></i> Carpet Area: <span id="carpet_area">Loading...</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fal fa-dumbbell"></i> Rera ID: <span id="rera_id_value">Loading...</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fal fa-dumbbell"></i> Possession Status: <span id="possession_status">Loading...</span></a>
                                                    </li>
                                                </ul>
                                                <script>
                                                $(document).ready(function () {
                                                    // Extract slug from the end of the URL path
                                                    const urlSegments = window.location.pathname.split('/');
                                                    const slug = urlSegments[urlSegments.length - 1] || urlSegments[urlSegments.length - 2]; // Handles trailing slash
                                            
                                                    if (!slug) {
                                                        console.error("No slug found in URL.");
                                                        return;
                                                    }
                                            
                                                    $.ajax({
                                                        url: "listing-single-fetch-code.php",
                                                        type: "GET",
                                                        data: { slug: slug }, // Backend should now expect 'slug' instead of 'id'
                                                        dataType: "json",
                                                        success: function (data) {
                                                            if (data.error) {
                                                                console.error("Error from backend:", data.error);
                                                                return;
                                                            }
                                            
                                                            console.log("Fetched Data:", data);
                                            
                                                            const carpetArea = data.carpet_area_sft?.trim();
                                                            const reraId = data.rera_id?.trim();
                                                            const possessionDate = data.possesion_start_date?.trim();
                                            
                                                            $("#carpet_area").text(carpetArea ? `${carpetArea} sq.ft` : "N/A");
                                                            $("#rera_id_value").text(reraId || "N/A");
                                                            $("#possession_status").text(possessionDate ? formatDate(possessionDate) : "N/A");
                                                        },
                                                        error: function (xhr, status, error) {
                                                            console.error("AJAX Error:", error);
                                                            console.error("XHR Response:", xhr.responseText);
                                                        }
                                                    });
                                                });
                                            
                                                // Format the possession date as "Mon YYYY"
                                                function formatDate(dateString) {
                                                    const date = new Date(dateString);
                                                    if (isNaN(date)) return "Invalid Date";
                                            
                                                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                                                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                                    return `${monthNames[date.getMonth()]} ${date.getFullYear()}`;
                                                }
                                            </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function showImage(index) {
                                        const allImages = document.querySelectorAll(".tab-image");
                                        const allButtons = document.querySelectorAll(".tab-button");

                                        // Hide all images
                                        allImages.forEach((image) => {
                                            image.style.display = "none";
                                        });

                                        // Remove active class from all buttons
                                        allButtons.forEach((button) => {
                                            button.classList.remove("active");
                                        });

                                        // Show the selected image and highlight the corresponding button
                                        allImages[index].style.display = "block";
                                        allButtons[index].classList.add("active");
                                    }

                                    // Initially display the first image (Tab 1)
                                    document.addEventListener("DOMContentLoaded", function () {
                                        showImage(0);
                                    });
                                </script>
                                <div id="TourThisProject" class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>Photos & Videos: Tour this project virtually</h3>
                                    </div>
                                    <div class="boxed-content-item">
                                        <div class="pp-single-opt">
                                            <div class="pp-single-features">
                                                <!-- Images displayed horizontally -->
                                                <div class="image-container-1">
                                                    <?php foreach ($bannerImages as $index => $image): ?>
                                                        <?php $image = trim($image); // remove any extra space ?>
                                                        <img src="../admin_panel/<?php echo htmlspecialchars($image); ?>" 
                                                             alt="Image <?php echo $index + 1; ?>" 
                                                             class="project-image" 
                                                             <?php echo ($index === 3) ? 'id="triggerPopup"' : ''; ?> />
                                                    <?php endforeach; ?>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--boxed-content-->
                                <div id="Amenities" class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>Property Amenities</h3>
                                    </div>
                                    <div class="boxed-content-item">
                                        <div class="pp-single-opt">
                                            <div class="pp-single-features">
                                                <ul id="amenities_list">
                                                    <li>Loading amenities...</li>
                                                </ul>
                                                <script>
                                                    $(document).ready(function () {
                                                        // Extract slug from the end of the URL path
                                                        const urlSegments = window.location.pathname.split('/');
                                                        const slug = urlSegments[urlSegments.length - 1] || urlSegments[urlSegments.length - 2]; // Handles trailing slash
                                                
                                                        if (!slug) {
                                                            console.error("No slug found in URL.");
                                                            return;
                                                        }
                                                
                                                        $.ajax({
                                                            url: "listing-single-fetch-code.php",
                                                            type: "GET",
                                                            data: { slug: slug }, // Pass slug instead of ID
                                                            dataType: "json",
                                                            success: function (data) {
                                                                if (data.error) {
                                                                    console.error("Error from backend:", data.error);
                                                                    return;
                                                                }
                                                
                                                                console.log("Fetched Data:", data);
                                                
                                                                // Populate Amenities List
                                                                const amenitiesList = $("#amenities_list");
                                                                amenitiesList.empty(); // Clear existing items
                                                
                                                                if (data.amenities && data.amenities.length > 0) {
                                                                    data.amenities.forEach((amenity, index) => {
                                                                        const iconClass = getAmenityIcon(index); // Assign an icon
                                                                        amenitiesList.append(
                                                                            `<li><a href="javascript:void(0);"><i class="fal ${iconClass}"></i> ${amenity.trim()}</a></li>`
                                                                        );
                                                                    });
                                                                } else {
                                                                    amenitiesList.append("<li>No amenities available</li>");
                                                                }
                                                            },
                                                            error: function (xhr, status, error) {
                                                                console.error("AJAX Error:", error);
                                                                console.error("XHR Response:", xhr.responseText);
                                                            }
                                                        });
                                                    });
                                                
                                                    // Function to assign icons dynamically
                                                    function getAmenityIcon(index) {
                                                        const icons = [
                                                            "fa-dumbbell", "fa-wifi", "fa-parking", "fa-cloud",
                                                            "fa-swimmer", "fa-cctv", "fa-shield-alt", "fa-tree"
                                                        ];
                                                        return icons[index % icons.length]; // Loop through icons if more amenities than icons
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ContactSellers" class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>Contact Sellers</h3>
                                    </div>
                                    <div class="boxed-content-item">
                                        <div class="pp-single-opt">
                                            <div class="pp-single-features">
                                                <div class="property-contacts-item sh-links">
                                                    <div class="property-contacts_profile">
                                                        <a href="javascript:void(0);" class="property-contacts_profile_link">
                                                            <!-- Image and Name will be injected here -->
                                                            <img id="builderImage" src="" alt="Builder Image" />
                                                            <span id="builderName"></span>
                                                        </a>
                                                    </div>
                                                    <div class="property-contacts-links">
                                                        <a id="callBtn" href="javascript:void(0);" class="tolt pcl_btn" data-microtip-position="left" data-tooltip="Call">
                                                            <i class="fa-solid fa-phone"></i>
                                                        </a>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- JS script -->
                                <script>
                                    $(document).ready(function () {
                                        const urlSegments = window.location.pathname.split('/');
                                        const slug = urlSegments[urlSegments.length - 1] || urlSegments[urlSegments.length - 2];
                                
                                        if (!slug) {
                                            console.error("No slug found in URL.");
                                            return;
                                        }
                                
                                        $.ajax({
                                            url: "listing-single-fetch-code.php",
                                            type: "GET",
                                            data: { slug: slug },
                                            dataType: "json",
                                            success: function (data) {
                                                if (data.error) {
                                                    console.error("Error from backend:", data.error);
                                                    return;
                                                }
                                
                                                console.log("Fetched Data:", data);
                                
                                                // Update call button
                                                if (data.contact_mobile) {
                                                    $("#callBtn").attr("href", `tel:${data.contact_mobile}`);
                                                } else {
                                                    console.warn("contact_mobile not found in response.");
                                                }
                                
                                                // Update builder name
                                                if (data.builder_name) {
                                                    $("#builderName").text(`${data.builder_name}`);
                                                } else {
                                                    console.warn("builder_name not found in response.");
                                                }
                                
                                                // Update builder image
                                                if (data.banner_image) {
                                                    $("#builderImage").attr("src", data.banner_image);
                                                } else {
                                                    console.warn("banner_image not found in response.");
                                                }
                                            },
                                            error: function (xhr, status, error) {
                                                console.error("AJAX Error:", error);
                                                console.error("XHR Response:", xhr.responseText);
                                            }
                                        });
                                    });
                                </script>
                                <div id="Brochure" class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>Download Brochure</h3>
                                    </div>
                                    <div class="boxed-content-item">
                                        <div class="pp-single-opt-wrap">
                                            <div class="pp-single-opt-links">
                                                <ul>
                                                    <li>
                                                        <a href="#" download><i class="fa-light fa-file-pdf"></i> Download Brochure </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa-light fa-layer-group"></i> View Floor Plans</a>
                                                    </li>
                                                </ul>
                                                <a href="#" class="pp-single-opt-link_silngle">Visit Website</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="Locality" class="boxed-content">
                                    <!--boxed-content-title-->
                                    <div class="boxed-content-title">
                                        <h3>Locality</h3>
                                    </div>
                                    <!--boxed-content-title end-->
                                    <!--boxed-content-item-->
                                    <div class="boxed-content-item">
                                        <div class="row">
                                            <div class="col-lg-6">
                                              <div class="map-container mapC_vis2">
                                                <iframe
                                                  id="mapIframe"
                                                  width="100%"
                                                  height="450"
                                                  style="border: 0;"
                                                  allowfullscreen=""
                                                  loading="lazy"
                                                  referrerpolicy="no-referrer-when-downgrade"
                                                ></iframe>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="nerby-list-wrap">
                                                <div class="nerby-list-container">
                                                  <div class="nerby-list">
                                                    <span class="nerby-title">What's Nearby</span>
                                                    <div class="nerby-list-box">
                                                      <ul id="nearbyList">
                                                        <!-- Locality list will be inserted here -->
                                                      </ul>
                                                      <a href="#" class="commentssubmit commentssubmit_fw" style="margin-top: 10px;">Get Directions</a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            <script>
                                              // Function to extract the slug from the end of the URL path
                                              function getSlugFromURL() {
                                                const pathSegments = window.location.pathname.split('/');
                                                return pathSegments[pathSegments.length - 1] || pathSegments[pathSegments.length - 2]; // Handles trailing slash
                                              }
                                            
                                              const slug = getSlugFromURL();
                                            
                                              if (slug) {
                                                fetch(`listing-single-fetch-code.php?slug=${slug}`)
                                                  .then(response => response.json())
                                                  .then(data => {
                                                    // Render nearby localities
                                                    const nearbyList = document.getElementById('nearbyList');
                                                    const localities = [
                                                      data.locality1,
                                                      data.locality2,
                                                      data.locality3,
                                                      data.locality4,
                                                      data.locality5
                                                    ];
                                            
                                                    localities.forEach(loc => {
                                                      if (loc && loc.trim()) {
                                                        const li = document.createElement('li');
                                                        li.innerHTML = `<i class="fa-light fa-location-dot"></i> ${loc}`;
                                                        nearbyList.appendChild(li);
                                                      }
                                                    });
                                            
                                                    // Render Google Map
                                                    const location = encodeURIComponent(data.city || 'Pune'); // Dynamically use city if available
                                                    const apiKey = 'YOUR_VALID_API_KEY';
                                                    const mapIframe = document.getElementById('mapIframe');
                                                    mapIframe.src = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${location}`;
                                                  })
                                                  .catch(error => {
                                                    console.error('Error fetching project data:', error);
                                                  });
                                              } else {
                                                console.warn('Slug not found in URL.');
                                              }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!--boxed-content end-->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!--boxed-container-->
                            <div class="sb-container">
                                <!--boxed-content-->
                                <div class="boxed-content">
                                    <div class="boxed-content-title">
                                        <h3>Property Tags</h3>
                                    </div>
                                    <div class="boxed-content-item bc-item_smal_pad">
                                        <div class="tags-widget">
                                            <a href="#">Hotel</a>
                                            <a href="#">Hostel</a>
                                            <a href="#">Room</a>
                                            <a href="#">Spa</a>
                                            <a href="#">Restourant</a>
                                            <a href="#">Parking</a>
                                        </div>
                                    </div>
                                </div>
                                <!--boxed-content end-->
                                <!--boxed-content-->
                                <div class="fixed-form-wrap">
                                    <div class="fixed-form">
                                        <div class="boxed-content">
                                            <!--boxed-content-title-->
                                            <div class="boxed-content-title">
                                                <h3>Request a Showing</h3>
                                            </div>
                                            <!--boxed-content-title end-->
                                            <!--boxed-content-item-->
                                            <div class="boxed-content-item">
                                                <div class="property-contacts-wrap">
                                                    <div class="property-contacts-item sh-links">
                                                        <div class="property-contacts_profile">
                                                            <a href="" class="property-contacts_profile_link"> <img src="images/avatar/2.jpg" alt="" /> <span>Agent:</span>Girish </a>
                                                        </div>
                                                        <div class="property-contacts-links">
                                                            <a href="tel:8792541599" class="tolt pcl_btn" data-microtip-position="left" data-tooltip="Call"><i class="fa-solid fa-phone"></i></a>
                                                            <a href="#" class="show-messenger-links pcl_btn tolt" data-microtip-position="left" data-tooltip="Write Message"><i class="fa-solid fa-message-sms"></i></a>
                                                        </div>
                                                        <div class="messenger-links-container">
                                                            <!-- <a href="#" class="tolt" data-microtip-position="bottom"  data-tooltip="Viber"><i class="fa-brands fa-viber"></i></a> -->
                                                            <a href="https://api.whatsapp.com/send?phone=918792541599&text=&source=&data=" class="tolt" data-microtip-position="bottom" data-tooltip="Whatsapp">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                            </a>
                                                            <a href="#" class="tolt" data-microtip-position="bottom" data-tooltip="Telegram"><i class="fa-brands fa-telegram"></i></a>
                                                            <!-- <a href="#" class="tolt" data-microtip-position="bottom"  data-tooltip="Facebook Messenger"><i class="fa-brands fa-facebook-messenger"></i></a> -->
                                                        </div>
                                                    </div>
                                                    <div class="log-separator"><span>or</span></div>
                                                    <p>Use the form below to select a viewing time and date.</p>
                                                </div>
                                                <div class="custom-form" id="single_cf">
                                                    <form method="post" id="contact-property-form" name="contact-property-form" action="leads-post-code.php">
                                                        <div class="cs-intputwrap">
                                                            <i class="fa-light fa-user"></i>
                                                            <input name="name" type="text" placeholder="Your name" onClick="this.select()" value="" />
                                                        </div>
                                                        <div class="cs-intputwrap">
                                                            <i class="fa-light fa-phone-office"></i>
                                                            <input name="phone" type="text" placeholder="Your Phone" onClick="this.select()" value="" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-light fa-calendar"></i>
                                                                    <div class="date-container">
                                                                        <input type="text" placeholder="Date" id="res_date" name="datepicker-here" value="" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-light fa-calendar"></i>
                                                                    <select data-placeholder="Time" class="chosen-select on-radius no-search-select" name="time">
                                                                        <option>9 AM</option>
                                                                        <option>10 AM</option>
                                                                        <option>11 AM</option>
                                                                        <option>12 AM</option>
                                                                        <option>13 PM</option>
                                                                        <option>14 PM</option>
                                                                        <option>15 PM</option>
                                                                        <option>16 PM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="commentssubmit commentssubmit_fw">Send Request</button>
                                                    </form>
                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                    <script>
                                                      $('#contact-property-form').on('submit', function(e) {
                                                        e.preventDefault(); // Prevent default form submission
                                                    
                                                        const formData = $(this).serialize();
                                                    
                                                        $.ajax({
                                                          type: 'POST',
                                                          url: 'leads-post-code.php',
                                                          data: formData,
                                                          dataType: 'json',
                                                          success: function(response) {
                                                            if (response.status === 'success') {
                                                              Swal.fire({
                                                                title: 'Success!',
                                                                text: 'Your request has been submitted.',
                                                                icon: 'success',
                                                                confirmButtonText: 'OK'
                                                              });
                                                              $('#contact-property-form')[0].reset(); // Reset form
                                                            } else {
                                                              Swal.fire({
                                                                title: 'Error',
                                                                text: response.message || 'Submission failed.',
                                                                icon: 'error'
                                                              });
                                                            }
                                                          },
                                                          error: function() {
                                                            Swal.fire({
                                                              title: 'Error',
                                                              text: 'Something went wrong.',
                                                              icon: 'error'
                                                            });
                                                          }
                                                        });
                                                      });
                                                    </script>
                                                </div>
                                            </div>
                                            <!--boxed-content-item end-->
                                        </div>
                                    </div>
                                </div>
                                <!--boxed-content end-->
                            </div>
                        </div>
                    </div>
                    <div class="limit-box"></div>
                </div>
                <!--<div class="boxed-container">-->
                <!--    <div class="boxed-content-title bcst_ca">-->
                <!--        <h3>Similar Properties</h3>-->
                <!--    </div>-->
                <!--    <div class="single-carousel-wrap">-->
                <!--        <div class="single-carousel">-->
                <!--            <div class="swiper-container">-->
                <!--                <div class="swiper-wrapper">-->
                                    <!-- swiper-slide -->
                <!--                    <div class="swiper-slide">-->
                                        <!-- listing-item -->
                <!--                        <div class="listing-item">-->
                <!--                            <div class="geodir-category-listing">-->
                <!--                                <div class="geodir-category-img">-->
                <!--                                    <a href="listing-single.php" class="geodir-category-img_item">-->
                <!--                                        <div class="bg" data-bg="images/all/1.jpg"></div>-->
                <!--                                        <div class="overlay"></div>-->
                <!--                                    </a>-->
                <!--                                    <div class="geodir-category-location">-->
                <!--                                        <a href="#4" class="map-item tolt single-map-item" data-newlatitude="40.72956781" data-newlongitude="-73.99726866" data-microtip-position="top" data-tooltip="On the map">-->
                <!--                                            <i class="fas fa-map-marker-alt"></i> 40 Journal Square , Marathanlli, Bengalore-->
                <!--                                        </a>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-content">-->
                <!--                                    <h3><a href="listing-single.php">Contemporary Apartment</a></h3>-->
                <!--                                    <div class="geodir-category-content_price">₹ 1,600,000</div>-->
                                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p> -->
                <!--                                    <div class="geodir-category-content-details">-->
                <!--                                        <ul>-->
                <!--                                            <li><i class="fa-light fa-bed"></i><span>4</span></li>-->
                <!--                                            <li><i class="fa-light fa-bath"></i><span>1</span></li>-->
                <!--                                            <li><i class="fa-light fa-chart-area"></i><span>550 ft2</span></li>-->
                <!--                                        </ul>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-footer">-->
                <!--                                    <a href="" class="gcf-company"><img src="images/avatar/4.jpg" alt="" /><span>By Liza Rose</span></a>-->
                <!--                                    <a href="listing-single.php" class="gid_link"><span>View Details</span> <i class="fa-solid fa-caret-right"></i></a>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                                        <!-- listing-item end-->
                <!--                    </div>-->
                                    <!--swiper-slide end -->
                                    <!-- swiper-slide -->
                <!--                    <div class="swiper-slide">-->
                                        <!-- listing-item -->
                <!--                        <div class="listing-item">-->
                <!--                            <div class="geodir-category-listing">-->
                <!--                                <div class="geodir-category-img">-->
                <!--                                    <a href="listing-single.php" class="geodir-category-img_item">-->
                <!--                                        <div class="bg" data-bg="images/all/2.jpg"></div>-->
                <!--                                        <div class="overlay"></div>-->
                <!--                                    </a>-->
                <!--                                    <div class="geodir-category-location">-->
                <!--                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i> 40 Journal Square , NJ, USA</a>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-content">-->
                <!--                                    <h3><a href="listing-single.php">Gorgeous House For Sale</a></h3>-->
                <!--                                    <div class="geodir-category-content_price">₹ 500,000</div>-->
                <!--                                    <div class="geodir-category-content-details">-->
                <!--                                        <ul>-->
                <!--                                            <li><i class="fa-light fa-bed"></i><span>2</span></li>-->
                <!--                                            <li><i class="fa-light fa-bath"></i><span>2</span></li>-->
                <!--                                            <li><i class="fa-light fa-chart-area"></i><span>150 ft2</span></li>-->
                <!--                                        </ul>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-footer">-->
                <!--                                    <a href="" class="gcf-company"><img src="images/avatar/2.jpg" alt="" /><span>By Niko Furingee </span></a>-->
                <!--                                    <a href="listing-single.php" class="gid_link"><span>View Details</span> <i class="fa-solid fa-caret-right"></i></a>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                                        <!-- listing-item end-->
                <!--                    </div>-->
                                    <!--swiper-slide end -->
                                    <!-- swiper-slide -->
                <!--                    <div class="swiper-slide">-->
                                        <!-- listing-item -->
                <!--                        <div class="listing-item">-->
                <!--                            <div class="geodir-category-listing">-->
                <!--                                <div class="geodir-category-img">-->
                <!--                                    <a href="listing-single.php" class="geodir-category-img_item">-->
                <!--                                        <div class="bg" data-bg="images/all/8.jpg"></div>-->
                <!--                                        <div class="overlay"></div>-->
                <!--                                    </a>-->
                <!--                                    <div class="geodir-category-location">-->
                <!--                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i> 70 Bright St, Jersey City, NJ USA</a>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-content">-->
                <!--                                    <h3><a href="listing-single.php">Kayak Point House</a></h3>-->
                <!--                                    <div class="geodir-category-content_price">₹ 1500 / per month</div>-->
                <!--                                    <div class="geodir-category-content-details">-->
                <!--                                        <ul>-->
                <!--                                            <li><i class="fa-light fa-bed"></i><span>1</span></li>-->
                <!--                                            <li><i class="fa-light fa-bath"></i><span>1</span></li>-->
                <!--                                            <li><i class="fa-light fa-chart-area"></i><span>70 ft2</span></li>-->
                <!--                                        </ul>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-footer">-->
                <!--                                    <a href="" class="gcf-company"><img src="images/avatar/5.jpg" alt="" /><span>By Andy Sposty</span></a>-->
                <!--                                    <a href="listing-single.php" class="gid_link"><span>View Details</span> <i class="fa-solid fa-caret-right"></i></a>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                                        <!-- listing-item end-->
                <!--                    </div>-->
                                    <!--swiper-slide end -->
                                    <!-- swiper-slide -->
                <!--                    <div class="swiper-slide">-->
                                        <!-- listing-item -->
                <!--                        <div class="listing-item">-->
                <!--                            <div class="geodir-category-listing">-->
                <!--                                <div class="geodir-category-img">-->
                <!--                                    <a href="listing-single.php" class="geodir-category-img_item">-->
                <!--                                        <div class="bg" data-bg="images/all/4.jpg"></div>-->
                <!--                                        <div class="overlay"></div>-->
                <!--                                    </a>-->
                <!--                                    <div class="geodir-category-location">-->
                <!--                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i> W 85th St, New York, USA </a>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-content">-->
                <!--                                    <h3><a href="listing-single.php">Luxury Family Home</a></h3>-->
                <!--                                    <div class="geodir-category-content_price">₹ 450,000</div>-->
                <!--                                    <div class="geodir-category-content-details">-->
                <!--                                        <ul>-->
                <!--                                            <li><i class="fa-light fa-bed"></i><span>2</span></li>-->
                <!--                                            <li><i class="fa-light fa-bath"></i><span>1</span></li>-->
                <!--                                            <li><i class="fa-light fa-chart-area"></i><span>150 ft2</span></li>-->
                <!--                                        </ul>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="geodir-category-footer">-->
                <!--                                    <a href="" class="gcf-company"><img src="images/avatar/6.jpg" alt="" /><span>By Anna Lips</span></a>-->
                <!--                                    <a href="listing-single.php" class="gid_link"><span>View Details</span> <i class="fa-solid fa-caret-right"></i></a>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                                        <!-- listing-item end-->
                <!--                    </div>-->
                                    <!--swiper-slide end -->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="ss-carousel-pagination_wrap">-->
                <!--        <div class="solid-pagination_btns ss-carousel-pagination_init"></div>-->
                <!--    </div>-->
                <!--    <div class="ss-carousel-button-wrap">-->
                <!--        <div class="ss-carousel-button ss-carousel-button-prev"><i class="fas fa-caret-left"></i></div>-->
                <!--        <div class="ss-carousel-button ss-carousel-button-next"><i class="fas fa-caret-right"></i></div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <!--main-content end-->
            <div class="to_top-btn-wrap">
                <div class="to-top to-top_btn"><span>Back to top</span> <i class="fa-solid fa-arrow-up"></i></div>
                <div class="svg-corner svg-corner_white" style="top: 0; left: -40px; transform: rotate(-90deg);"></div>
                <div class="svg-corner svg-corner_white" style="top: 0; right: -40px; transform: rotate(-180deg);"></div>
            </div>
        </div>
        <!-- container end-->
    </div>
    <!--content  end-->
    <?php include ('includes/footer.php');?>
</div>
