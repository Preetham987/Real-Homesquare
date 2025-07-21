<?php include ('includes/db.php');?>
<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>

<!-- 
<div class="rectangle" id="rectangle2">
    <div class="ShowHide" id="Bar">
        <div id="right">
            <a href="#" onclick="Hide(Bar);">X</a>
        </div>
        <div id="left">
            <img src="img/adds/add2.png" style="width: 100%;" />
        </div>
    </div>
</div>

<div class="rectangle" id="rectangle3">
    <div class="ShowHide" id="Bar1">
        <div id="right">
            <a href="#" onclick="Hide(Bar1);">X</a>
        </div>
        <div id="left">
            <img src="img/adds/add3.png" style="width: 100%;" />
        </div>
    </div>
</div>

<div class="rectangle" id="rectangle4">
    <div class="ShowHide" id="Bar2">
        <div id="right">
            <a href="#" onclick="Hide(Bar2);">X</a>
        </div>
        <div id="left">
            <img src="img/adds/add1.png" style="width: 100%;" />
        </div>
    </div>
</div> -->

<script>
    function Hide(HideID) {
        HideID.style.display = "none";
    }
</script>

<!--header-end-->
<!--warpper-->
<div class="wrapper">
    <div class="content">
        <!--section-->
<div class="section hero-section home-hero-section">
    <div class="hero-section-wrap">
        <div class="hero-section-wrap-item">
            <div class="container" style="width: min(90% - 25px, 1700px);">
                <div class="hero-section-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-slider-wrapper">
                                <div class="hero-slider">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper" id="hero-slider-content">
                                            <!-- Data will be inserted dynamically here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            fetch("index-fetch-code.php")
                                .then(response => response.json())
                                .then(data => {
                                    console.log("Fetched Data:", data);
                        
                                    if (!data.projects || !Array.isArray(data.projects)) {
                                        console.error("Invalid data format:", data);
                                        return;
                                    }
                        
                                    const sliderContainer = document.getElementById("hero-slider-content");
                                    const bgWrapper = document.querySelector(".bg-wrap.bg-hero.bg-parallax-wrap-gradien.fs-wrapper .swiper-wrapper");
                        
                                    if (!sliderContainer || !bgWrapper) {
                                        console.error("Slider container or background wrapper not found");
                                        return;
                                    }
                        
                                    sliderContainer.innerHTML = "";
                                    bgWrapper.innerHTML = "";
                        
                                    data.projects.forEach((item) => {
                                        console.log("Processing project:", item);
                        
                                        const firstImage = item.banner_image.split(',')[0]; // Use only first image
                        
                                        // Hero slider content
                                        const slide = document.createElement("div");
                                        slide.classList.add("swiper-slide");
                                        slide.innerHTML = `
                                            <div class="hero-carousel_item" data-bg="">
                                                <div class="hero-section-title hs_align-title">
                                                    <h2>${item.project_name}</h2>
                                                </div>
                                            </div>
                                        `;
                                        sliderContainer.appendChild(slide);
                        
                                        // Background slider content
                                        const bgSlide = document.createElement("div");
                                        bgSlide.classList.add("swiper-slide");
                                        bgSlide.innerHTML = `
                                            <div class="ms-item_fs full-height fl-wrap">
                                                <div class="bg" data-bg="../admin_panel/${firstImage}"></div>
                                            </div>
                                        `;
                                        bgWrapper.appendChild(bgSlide);
                                    });
                        
                                    // Apply background images dynamically
                                    document.querySelectorAll("[data-bg]").forEach(bg => {
                                        let imgSrc = bg.getAttribute("data-bg");
                                        console.log("Applying background image:", imgSrc);
                                        if (imgSrc) {
                                            bg.style.backgroundImage = `url(${imgSrc})`;
                                        }
                                    });
                        
                                })
                                .catch(error => console.error("Error fetching project data:", error));
                        });
                        </script>
                        <div class="col-lg-12 mob-hid">
                            <div class="list-searh-input-wrap box_list-searh-input-wrap lws_column hero_home_search lsiw_dec">
                                <div class="custom-form">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="cs-intputwrap">
                                                <i class="fa-light fa-location-dot"></i>
                                                <input id="searchInput" type="text" placeholder="Search for locality, landmark, project, ..." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button onclick="handleSearch()" class="commentssubmit commentssubmit_fw">Search</button>
                                        </div>
                                        
                                        <script>
                                            function handleSearch() {
                                                const searchValue = document.getElementById('searchInput').value;
                                                localStorage.setItem('searchQuery', searchValue);
                                                window.location.href = 'listing.php';
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="hero-notifer"></div>
                        </div>
                    </div>
                </div>

                <div class="hs-scroll-down-wrap">
                    <div class="scroll-down-item">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                        <span>Scroll Down To Discover</span>
                    </div>
                    <div class="svg-corner svg-corner_white" style="bottom: 0; right: -39px; transform: rotate(90deg);"></div>
                    <div class="svg-corner svg-corner_white" style="bottom: 0; left: -39px;"></div>
                </div>
                <div class="sc-controls shc_controls2 slideshow-container-pag-init"></div>
            </div>

            <!-- Background Wrapper -->
            <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper">
                <div class="slideshow-container_wrap fl-wrap full-height">
                    <div class="swiper-container full-height">
                        <div class="swiper-wrapper">
                            <!-- Background images will be inserted dynamically here -->
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
        <!--section-end-->
        <!--container-->
        <div class="container">
            <!--main-content-->
            <div class="main-content ms_vir_height" id="sec1">
                <!--boxed-container-->
                <div class="boxed-container">
                    <div class="listing-grid_heroheader">
                        <h3>Trending Projects</h3>
                    </div>
                    <!-- listing-grid -->
                    <div class="listing-grid gisp">
                        <!-- The listings will be dynamically added here -->
                    </div>
                    <!-- listing-grid end-->
                    <a href="listing.php" class="commentssubmit csb-no-align">View All Properties <i class="fa-solid fa-caret-right"></i></a>
                </div>
                <!--boxed-container end-->
            </div>
            <!--main-content end-->
        </div>
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("index-fetch-code.php")
                .then(response => response.json())
                .then(data => {
                    let container = document.querySelector(".listing-grid");
                    container.innerHTML = "";
        
                    if (data.projects) {
                        data.projects.forEach(project => {
                            let firstImage = project.banner_image.split(',')[0]; // ✅ Get only the first image
        
                            let item = `
                                <div class="listing-grid-item">
                                    <div class="listing-item cat-comercial cat-sale">
                                        <div class="geodir-category-listing">
                                            <div class="geodir-category-img">
                                                <a href="${project.slug}" class="geodir-category-img_item">
                                                    <div class="bg" data-bg="../admin_panel/${firstImage}"></div>
                                                    <div class="overlay"></div>
                                                </a>
                                                <div class="geodir-category-location">
                                                    <a href="#" class="map-item tolt single-map-item">
                                                        <i class="fas fa-map-marker-alt"></i> ${project.property_address}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="geodir-category-content">
                                                <h3><a href="listing-single.php?id=${project.id}">${project.project_name}</a></h3>
                                                <div class="geodir-category-content_price">₹ ${project.price} Cr</div>
                                                <div class="geodir-category-content-details">
                                                    <ul>
                                                        <li><i class="fa-light fa-chart-area"></i><span>${project.saleable_area_sft} ft²</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            container.innerHTML += item;
                        });
                    }
        
                    // Apply background images dynamically
                    document.querySelectorAll(".bg").forEach(bg => {
                        let imgSrc = bg.getAttribute("data-bg");
                        if (imgSrc) {
                            bg.style.backgroundImage = `url(${imgSrc})`;
                        }
                    });
        
                })
                .catch(error => console.error("Error fetching projects:", error));
        });
        </script>
        <script>
                                function goToProject(id, slug) {
                                    const form = document.createElement('form');
                                    form.method = 'POST';
                                    form.action = 'listing-single.php';
                                
                                    const idInput = document.createElement('input');
                                    idInput.type = 'hidden';
                                    idInput.name = 'id';
                                    idInput.value = id;
                                
                                    const slugInput = document.createElement('input');
                                    slugInput.type = 'hidden';
                                    slugInput.name = 'slug';
                                    slugInput.value = slug;
                                
                                    form.appendChild(idInput);
                                    form.appendChild(slugInput);
                                    document.body.appendChild(form);
                                    form.submit();
                                }
                                </script>
        <!-- Content Start-->
        <div class="content-section">
    <div class="container">
        <div class="section-title">
            <h4>Prominent developers in Bengaluru</h4>
            <h2>Featured Developers</h2>
        </div>
    </div>
    <div class="testimonilas-carousel-wrap">
        <div class="testimonilas-carousel">
            <div class="swiper-container">
                <div class="swiper-wrapper" id="builders-list">
                    <!-- Builders will be inserted here dynamically -->
                </div>
            </div>
            <div class="tc-button tc-button-next"><i class="fas fa-caret-right"></i></div>
            <div class="tc-button tc-button-prev"><i class="fas fa-caret-left"></i></div>
        </div>
        <div class="fwc-controls_wrap">
            <div class="solid-pagination_btns tcs-pagination_init"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch("index-fetch-code.php")
        .then(response => response.json())
        .then(data => {
            let buildersList = document.getElementById("builders-list"); // Target the swiper wrapper
            buildersList.innerHTML = ""; // Clear existing content

            if (data.builders) {
                data.builders.forEach(builder => {
                    let builderSlide = document.createElement("div");
                    builderSlide.classList.add("swiper-slide");
                    builderSlide.innerHTML = `
                        <div class="testi-item">
                            <div class="testimonilas-text">
                                <div class="testi-header">
                                    <div class="row">
                                        <div class="col-md-8 col-12">
                                            <h3>${builder.builder_name} - ${builder.address}</h3>
                                            <p>${builder.year_estd} Year estd.</p>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="right">${builder.completed_projects} Projects</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    buildersList.appendChild(builderSlide);
                });

                // **Tell Swiper to update itself (DO NOT reinitialize)**
                if (window.swiper) {
                    window.swiper.update(); // Just update slides without reinitialization
                }
            } else {
                buildersList.innerHTML = "<p>No builders found.</p>"; // Display message if no data
            }
        })
        .catch(error => console.error("Error fetching builders:", error));
});
</script>

        <div class="dark-bg half-carousel-container">
<div class="city-carousel-wrap">
    <div class="half-carousel-title-wrap">
        <div class="half-carousel-title">
            <h2>Featured Developers</h2>
            <p>Prominent developers in Bengaluru</p>
        </div>
        <div class="abs_bg"></div>
    </div>

    <div class="city-carousel">
        <div class="swiper-container">
            <!-- Only ONE swiper-wrapper -->
            <div class="swiper-wrapper" id="builders-carousel-wrapper">
                <!-- Builder slides will be inserted here -->
            </div>
        </div>
        <div class="sc-controls city-pag-init"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.getJSON('index-fetch-code.php', function(data) {
        const builders = data.builders;
        const container = $('#builders-carousel-wrapper');

        builders.forEach(function(builder) {
            const slide = `
                <div class="swiper-slide">
                    <div class="city-carousel-item">
                        <div class="bg-wrap fs-wrapper">
                            <div class="bg" data-bg="../admin_panel/uploads/builder_images/${builder.builder_image}" data-swiper-parallax="10%"></div>
                            <div class="overlay"></div>
                        </div>
                        <div class="city-carousel-content">
                            <div class="hc-counter">${builder.completed_projects} Projects</div>
                            <h3><a href="listing.php">${builder.builder_name}</a></h3>
                            <p>${builder.description}</p>
                        </div>
                    </div>
                </div>
            `;
            container.append(slide);
        });

        // Initialize Swiper or update it if already initialized
        if (window.mySwiper) {
            window.mySwiper.update();
        } else {
            window.mySwiper = new Swiper('.swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.city-pag-init',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                parallax: true,
                breakpoints: {
                    768: { slidesPerView: 1 },
                    1024: { slidesPerView: 2 },
                    1280: { slidesPerView: 3 }
                }
            });
        }
    });
</script>
            <div class="city-carousel_controls">
                <div class="csc-button csc-button-prev"><i class="fas fa-caret-left"></i></div>
                <div class="csc-button csc-button-next"><i class="fas fa-caret-right"></i></div>
            </div>
        </div>
        <!--main-content-->
        <div class="main-content ms_vir_height">
            <!--container -->
            <div class="container">
                <div class="boxed-container">
                    <div class="boxed-content">
                        <div class="about-wrap boxed-content-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="about-title ab-hero">
                                        <h2>Why Choose Our Properties</h2>
                                        <h4>Check our services to find out more about us .</h4>
                                    </div>
                                    <div class="services-opions">
                                        <ul>
                                            <li>
                                                <i class="fal fa-headset"></i>
                                                <h4>24 Hours Support</h4>
                                                <p>We provide round-the-clock assistance to ensure your issues are resolved quickly and efficiently, anytime you need help.</p>
                                            </li>
                                            <li>
                                                <i class="fal fa-users-cog"></i>
                                                <h4>User Admin Panel</h4>
                                                <p>Easily manage user accounts, roles, and settings with a secure and intuitive admin interface built for efficiency.</p>
                                            </li>
                                            <li>
                                                <i class="fal fa-phone-laptop"></i>
                                                <h4>Mobile Friendly</h4>
                                                <p>Our platform is fully optimized for all devices, ensuring smooth performance and easy navigation on smartphones and tablets.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="about-img">
                                        <img src="images/all/15.jpg" class="respimg" alt="" />
                                        <div class="about-img-hotifer">
                                            <p>Buy, Rent or Sell any of your properties.</p>
                                            <h4>Mark Antony</h4>
                                            <h5>Homesquare CEO</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- clients-carousel-wrap-->
                    <div class="clients-carousel-wrap">
                        <div class="clients-carousel-title">Our Trusted Partners</div>
                        <div class="clients-carousel">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <!--client-item-->
                                    <div class="swiper-slide">
                                        <a href="#" class="client-item"><img src="images/clients/1.png" alt="" /></a>
                                    </div>
                                    <!--client-item end-->
                                    <!--client-item-->
                                    <div class="swiper-slide">
                                        <a href="#" class="client-item"><img src="images/clients/2.png" alt="" /></a>
                                    </div>
                                    <!--client-item end-->
                                    <!--client-item-->
                                    <div class="swiper-slide">
                                        <a href="#" class="client-item"><img src="images/clients/3.png" alt="" /></a>
                                    </div>
                                    <!--client-item end-->
                                    <!--client-item-->
                                    <div class="swiper-slide">
                                        <a href="#" class="client-item"><img src="images/clients/4.png" alt="" /></a>
                                    </div>
                                    <!--client-item end-->
                                    <!--client-item-->
                                    <div class="swiper-slide">
                                        <a href="#" class="client-item"><img src="images/clients/5.png" alt="" /></a>
                                    </div>
                                    <!--client-item end-->
                                </div>
                            </div>
                            <div class="cc-button cc-button-next"><i class="fal fa-angle-right"></i></div>
                            <div class="cc-button cc-button-prev"><i class="fal fa-angle-left"></i></div>
                        </div>
                    </div>
                    <!-- clients-carousel-wrap end-->
                </div>
            </div>
            <!--container end-->
            <div class="parallax-section-wrap">
                <div class="bg-wrap fs-wrapper" data-scrollax-parent="true">
                    <div class="bg" data-bg="images/bg/3.jpg" data-scrollax="properties: { translateY: '20%' }"></div>
                    <div class="overlay"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="parallax-section-content">
                                <h3>Our Services</h3>
                                <p>
                                    A real estate company typically offers services such as buying, selling, and renting residential and commercial properties.
                                    They also provide property management, market analysis, and assistance with legal and financial aspects of real estate transactions.
                                </p>
                                <a href="add-listing.php" class="commentssubmit csb_color" style="margin-top: 20px;">Add Your Propperty</a>
                            </div>
                        </div>
                        <?php 
                        // Fetch services from database
                        $sql = "SELECT service_name, description, service_image FROM services_table WHERE is_deleted = '0'";
                        $result = $conn->query($sql);
                        ?>
                        <div class="col-lg-8">
                            <div class="process-wrap">
                                <ul>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <li>
                                                <div class="process-item">
                                                    <span class="process-count"><?php echo sprintf("%02d", $count); ?> .</span>
                                                    <div class="process-item-icon">
                                                        <img src="https://rigvesoft.com/homesquare/real-estate-panels-2/admin_panel/<?php echo $row ['service_image']; ?>" alt="<?php echo $row['service_name']; ?>" style="width:50px; height:50px;">
                                                    </div>
                                                    <h4><?php echo htmlspecialchars($row['service_name']); ?></h4>
                                                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                                                </div>
                                                <?php if ($count < $result->num_rows) { ?>
                                                    <span class="pr-dec"></span>
                                                <?php } ?>
                                            </li>
                                            <?php
                                            $count++;
                                        }
                                    } else {
                                        echo "<p>No services available.</p>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--container-->
            <div class="container">
                <div class="api-wrap">
                    <div class="api-container">
                        <div class="api-img">
                            <img src="images/api.png" alt="" class="respimg" />
                        </div>
                        <div class="api-text">
                            <h3>Our App Available Now</h3>
                            <p>
                                In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu
                                mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.
                            </p>
                            <div class="api-text-links">
                                <a href="javascript:void(0);"><span> On Apple Store</span><i class="fa-brands fa-apple"></i></a>
                                <a href="javascript:void(0);"><span> On Google PLay</span><i class="fa-brands fa-google-play"></i></a>
                            </div>
                        </div>
                        <div class="api-wrap-bg" data-run="2">
                            <div class="api-wrap-bg-container">
                                <span class="api-bg-pin"></span><span class="api-bg-pin"></span>
                                <div class="abs_bg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="to_top-btn-wrap">
                    <div class="to-top to-top_btn"><span>Back to top</span> <i class="fa-solid fa-arrow-up"></i></div>
                    <div class="svg-corner svg-corner_white" style="top: 0; left: -40px; transform: rotate(-90deg);"></div>
                    <div class="svg-corner svg-corner_white" style="top: 0; right: -40px; transform: rotate(-180deg);"></div>
                </div>
            </div>
            <!--container end-->
        </div>
        <!--main-content end-->
    </div>
    <!--content  end-->
    <?php include ('includes/footer.php');?>
</div>
