<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>
            <!--warpper-->
            <div class="wrapper">
                <!--content-->
                <div class="content">
                    <!--section-->
                    <div class="section hero-section hero-section_sin">
                        <div class="hero-section-wrap">
                            <div class="hero-section-wrap-item">
                                <div class="container">
                                    <div class="hero-section-container">
                                        <div class="hero-section-title">
                                            <h2>Latest Properties</h2>
                                            <!-- <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h5> -->
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
                                    <div class="svg-corner svg-corner_white"  style="bottom:0;right: -39px; transform: rotate( 90deg)" ></div>
                                    <div class="svg-corner svg-corner_white"  style="bottom:0;left:  -39px;"></div>
                                </div>
                                <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                                    <div class="bg" data-bg="images/bg/12.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--section-end-->				
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                        <div class="breadcrumbs-list bl_flat">
                            <a href="index.php">Home</a><a href="javascript:voide(0);">Listings</a>
                            <!--<div class="breadcrumbs-list_dec"><i class="fa-thin fa-arrow-up"></i></div>-->
                        </div>
                        <!--breadcrumbs-list end-->
                        <!--main-content-->
                        <div class="main-content">
                            <!--boxed-container-->
                            <div class="boxed-container">
                                <div class="show-mob-filter"><i class="far fa-sliders-h"></i> Search Filters</div>
                                <!-- list-searh-input-wrap-->
                                <div class="list-searh-input-wrap box_list-searh-input-wrap lws_mobile lsw_mb-btn">
                                    <div class="close_mob-filter cmf"><i class="fa-regular fa-xmark"></i></div>
                                    <div class="list-searh-input-wrap-title_wrap">
                                        <div class="list-searh-input-wrap-title"><i class="far fa-sliders-h"></i><span>Search Filters</span></div>
                                        <div class="list-searh-input-radio_wrap">
                                            <div class="header-search-radio">
                                                <input class="hidden radio-label" type="radio" name="accept-offers2" id="sale-button2" checked="checked">
                                                <label class="button-label" for="sale-button2">Sale</label>
                                                <input class="hidden radio-label" type="radio" name="accept-offers2" id="rent-button2">
                                                <label class="button-label" for="rent-button2">Rent</label>							
                                                <input class="hidden radio-label" type="radio" name="accept-offers2" id="comm-button2">
                                                <label class="button-label" for="comm-button2">Commercial</label>								
                                            </div>
                                            <div class="reset-form reset-btn tolt" data-microtip-position="bottom"  data-tooltip="Reset Filters"><i class="fa-solid fa-arrows-rotate"></i></div>
                                        </div>
                                    </div>
                                    <div class="custom-form">
                                        <div class="row">
                                            <!-- listsearch-input-item -->
                                            <div class="col-lg-4">
                                                <div class="cs-intputwrap">
                                                    <i class="fa-light fa-location-dot"></i>
                                                    <input type="text" id="cityInput" placeholder="Enter Location or City or State" class="on-radius no-search-select" />
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item -->
                                            <!-- listsearch-input-item -->
                                            <div class="col-lg-4">
                                                <div class="cs-intputwrap">
                                                    <i class="fa-light fa-layer-group"></i>
                                                    <select id="categorySelect" data-placeholder="Categories" class="chosen-select on-radius no-search-select">
                                                        <option value="">All Categories</option>
                                                        <option value="Apartment">Apartment</option>
                                                        <option value="Villa">Villa</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <!-- listsearch-input-item -->								
                                            <!-- listsearch-input-item -->
                                            <div class="col-lg-4">
                                                <div class="cs-intputwrap">
                                                    <i class="fa-light fa-city"></i>
                                                    <select id="citySelect" data-placeholder="All Cities" class="chosen-select on-radius no-search-select">
                                                        <option value="">All Cities</option>
                                                        <!-- Options are populated dynamically -->
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item -->										
                                            <!-- listsearch-input-item -->
                                            <div class="col-lg-4">
                                                <div class="cs-intputwrap">
                                                    <div class="price-range-wrap fl-wrap">
                                                        <label>Price Range</label>
                                                        <div class="price-rage-item">
                                                            <!-- Price Range Input -->
                                                            <input type="text" class="price-range-double" id="priceSlider" data-min="100" data-max="100000" name="price-range1" data-step="1" value="1" data-prefix="Rs.">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item -->											
                                            <!-- listsearch-input-item -->
                                            <div class="col-lg-4">
                                                <div class="cs-intputwrap">
                                                    <div class="price-range-wrap fl-wrap">
                                                        <label>Area Sq/ft</label>
                                                        <div class="price-rage-item pr-nopad fl-wrap">
                                                            <input type="text" class="price-range-double" id="areaSlider" data-min="1" data-max="10000" data-step="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item -->										
                                            <!-- listsearch-input-item -->
                                            <div class="col-lg-2">
                                                <div class="hidden-listing_search_wrap">
                                                    <div class="more_search-btn">More Options <i class="fa-regular fa-plus"></i></div>
                                                    <div class="hidden-listing-filter">
                                                        <!-- quantity_wrap -->								
                                                        <div class="quantity_wrap">
                                                            <div class="quantity_wrap_title"><i class="fa-light fa-bed"></i><span>Bedrooms</span></div>
                                                            <div class="quantity">
                                                                <div class="quantity-item">
                                                                    <input type="button" value="-" class="minus">
                                                                    <input type="text" id="bhkInput" name="quantity" title="Qty" class="qty" data-min="0" data-max="6" data-step="1" value="0">
                                                                    <input type="button" value="+" class="plus">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- quantity_wrap end-->
                                                        <!-- quantity_wrap -->								
                                                        <!--<div class="quantity_wrap">-->
                                                        <!--    <div class="quantity_wrap_title"><i class="fa-light fa-bath"></i><span>Bathrooms</span></div>-->
                                                        <!--    <div class="quantity">-->
                                                        <!--        <div class="quantity-item">-->
                                                        <!--            <input type="button" value="-" class="minus">-->
                                                        <!--            <input type="text"    name="quantity"   title="Qty" class="qty" data-min="1" data-max="6" data-step="1" value="1">-->
                                                        <!--            <input type="button" value="+" class="plus">-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!-- quantity_wrap end-->										
                                                        <!-- hidden-listing-item -->
                                                        <div class="hidden-listing-item">
                                                            <div class="filter-tags-title">Amenities</div>
                                                            <div class=" filter-tags">
                                                                <ul class="no-list-style">
                                                                    <li>
                                                                        <input id="check-aa" type="checkbox" name="amenities[]" value="Swimming pool">
                                                                        <label for="check-aa">Swimming Pool</label>
                                                                    </li>
                                                                    <li>
                                                                        <input id="check-b" type="checkbox" name="amenities[]" value="Terrace">
                                                                        <label for="check-b">Terrace</label>
                                                                    </li>
                                                                    <li>
                                                                        <input id="check-c" type="checkbox" name="amenities[]" value="Air conditioning">
                                                                        <label for="check-c">Air conditioning</label>
                                                                    </li>
                                                                    <li>
                                                                        <input id="check-d" type="checkbox" name="amenities[]" value="Internet">
                                                                        <label for="check-d">Internet</label>
                                                                    </li>
                                                                    <li>
                                                                        <input id="check-d2" type="checkbox" name="amenities[]" value="Balcony">
                                                                        <label for="check-d2">Balcony</label> 
                                                                    </li>
                                                                    <li>
                                                                        <input id="check-d3" type="checkbox" name="amenities[]" value="Cable TV">
                                                                        <label for="check-d3">Cable TV</label> 
                                                                    </li>
                                                                    <li>   
                                                                        <input id="check-d4" type="checkbox" name="amenities[]" value="Computer">
                                                                        <label for="check-d4">Computer</label>
                                                                    </li>
                                                                    <li>   
                                                                        <input id="check-d5" type="checkbox" name="amenities[]" value="Dishwasher">
                                                                        <label for="check-d5">Dishwasher</label>
                                                                    </li>
                                                                    <li>   
                                                                        <input id="check-d6" type="checkbox" name="amenities[]" value="Near Green Zone">
                                                                        <label for="check-d6">Near Green Zone</label>
                                                                    </li>
                                                                    <li>   
                                                                        <input id="check-d7" type="checkbox" name="amenities[]" value="Near Church">
                                                                        <label for="check-d7">Near Church</label>
                                                                    </li>
                                                                    <li>   
                                                                        <input id="check-d8" type="checkbox" name="amenities[]" value="Near Estate">
                                                                        <label for="check-d8">Near Estate</label>
                                                                    </li>
                                                                    <li>   
                                                                        <input id="check-d9" type="checkbox" name="amenities[]" value="Coffee pot">
                                                                        <label for="check-d9">Coffee pot</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- hidden-listing-item end-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item -->									
                                            <!-- listsearch-input-item -->
                                           <div class="col-lg-2">
                                                <button id="searchBtn" class="commentssubmit commentssubmit_fw">Search</button>									
                                            </div>

                                            <!-- listsearch-input-item --> 		
                                        </div>
                                    </div>
                                </div>
                                <!-- list-searh-input-wrap end-->							
                                <div class="mob-filter-overlay cmf fs-wrapper"></div>
                                <!-- list-main-wrap-header-->
                                <div class="list-main-wrap-header box-list-header">
                                    <!-- list-main-wrap-title-->
                                    <div class="list-main-wrap-title">
                                        <h2>Results For : <span id="searchLocation">All Projects</span></h2>
                                    </div>
                                    <script>
                                        // Get search value from localStorage
                                        const searchQuery = localStorage.getItem('searchQuery');
                                    
                                        // If found, replace the default text
                                        if (searchQuery) {
                                            document.getElementById('searchLocation').textContent = searchQuery;
                                        }
                                    </script>
                                    <!-- list-main-wrap-title end-->
                                    <!-- list-main-wrap-opt-->
                                    <!--<div class="list-main-wrap-opt">-->
                                        <!-- price-opt-->
                                    <!--    <div class="price-opt">-->
                                    <!--        <span class="price-opt-title">Sort   by:</span>-->
                                    <!--        <div class="cs-intputwrap" style="margin-bottom: 0">-->
                                    <!--            <i class="fa-light fa-arrow-down-small-big"></i>-->
                                    <!--            <select data-placeholder="Popularity" class="chosen-select no-search-select" >-->
                                    <!--                <option>Popularity</option>-->
                                    <!--                <option>Latest</option>-->
                                    <!--                <option>Price: low to high</option>-->
                                    <!--                <option>Price: high to low</option>-->
                                    <!--            </select>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                        <!-- price-opt end-->
                                    <!--</div>-->
                                    <!-- list-main-wrap-opt end-->                    
                                </div>
                                <!-- list-main-wrap-header end-->								
                                <!--listing-item-container-->
                                <div class="main-content ms_vir_height" id="sec1">
                            <!--boxed-container-->
                            <div class="boxed-container">
                                <div class="listing-grid_heroheader">
                                    <h3>Top Projects</h3>
                                </div>
                                <!-- listing-grid-->
                                <div class="listing-grid gisp">
                                    <!-- Projects will be inserted here dynamically -->
                                </div>
                                <script>
                                function fetchProjects(url, postData = null, category = "sale") {
                                    const listingGrid = document.querySelector(".listing-grid");
                                    const viewMoreContainer = document.querySelector("#view-more-container") || document.createElement("div");
                                    viewMoreContainer.id = "view-more-container";
                                    viewMoreContainer.innerHTML = ""; // clear any previous content
                                
                                    const options = postData
                                        ? {
                                            method: "POST",
                                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                            body: postData
                                        }
                                        : {};
                                
                                    fetch(url, options)
                                        .then(response => response.json())
                                        .then(data => {
                                            listingGrid.innerHTML = "";
                                            viewMoreContainer.innerHTML = ""; // Clear the button if it existed
                                
                                            if (data.length === 0) {
                                                listingGrid.innerHTML = `
                                                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px 20px; border: 2px dashed #ccc; border-radius: 12px; background-color: #f9f9f9; margin-top: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                                                        <div style=" background-color: #fff; border-radius: 50%; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                            <i class="fas fa-building" style="font-size: 48px; color: #888;"></i>
                                                        </div>
                                                        <h2 style="margin-top: 25px; font-size: 28px; color: #333; font-weight: 600;">No Projects Found</h2>
                                                        <p style="margin-top: 10px; font-size: 16px; color: #666; text-align: center; max-width: 500px;">
                                                            We couldn’t find any projects matching your search. Try adjusting your filters or check back later.
                                                        </p>
                                                        <a
                                                            href="#"
                                                            onclick="fetchProjects('listing-fetch-code.php', null, 'sale'); return false;"
                                                            style="margin-top: 20px; padding: 10px 20px; background-color: #3498db; color: white; border-radius: 6px; text-decoration: none; font-weight: 500; transition: background-color 0.3s;"
                                                            onmouseover="this.style.backgroundColor='#2980b9'"
                                                            onmouseout="this.style.backgroundColor='#3498db'"
                                                        >
                                                            Back to Listings
                                                        </a>
                                                    </div>
                                                `;
                                                return;
                                            }
                                
                                            // Render first 6 projects
                                            const initialProjects = data.slice(0, 6);
                                            initialProjects.forEach(project => {
                                                listingGrid.innerHTML += generateProjectHTML(project);
                                            });
                                
                                            // Only show "View All Properties" button if category is 'sale'
                                            if (data.length > 6 && category === "sale") {
                                                const viewMoreBtn = document.createElement("a");
                                                viewMoreBtn.href = "#";
                                                viewMoreBtn.className = "commentssubmit csb-no-align";
                                                viewMoreBtn.innerHTML = 'View All Properties <i class="fa-solid fa-caret-right"></i>';
                                                viewMoreBtn.style.display = "inline-block";
                                                viewMoreBtn.style.marginTop = "20px";
                                
                                                viewMoreBtn.addEventListener("click", (e) => {
                                                    e.preventDefault();
                                                    const remainingProjects = data.slice(6);
                                                    remainingProjects.forEach(project => {
                                                        listingGrid.innerHTML += generateProjectHTML(project);
                                                    });
                                                    viewMoreBtn.remove(); // remove after expansion
                                                });
                                
                                                viewMoreContainer.appendChild(viewMoreBtn);
                                                listingGrid.parentNode.appendChild(viewMoreContainer);
                                            }
                                        })
                                        .catch(error => {
                                            listingGrid.innerHTML = "<p>Error fetching projects.</p>";
                                            console.error("Error:", error);
                                        });
                                }
                                
                                function generateProjectHTML(project) {
                                    const firstImage = project.banner_image.split(',')[0]; // Extract the first image only
                                
                                    return `
                                        <div class="listing-grid-item">
                                            <div class="listing-item cat-comercial cat-sale">
                                                <div class="geodir-category-listing">
                                                    <div class="geodir-category-img">
                                                        <a href="${project.slug}" class="geodir-category-img_item">
                                                            <div class="bg" style="background-image: url(../admin_panel/${firstImage});"></div>
                                                            <div class="overlay"></div>
                                                        </a>
                                                        <div class="geodir-category-location">
                                                            <a href="#" class="map-item tolt single-map-item">
                                                                <i class="fas fa-map-marker-alt"></i> ${project.project_location}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="geodir-category-content">
                                                        <h3><a href="listing-single.php?id=${project.id}">${project.project_name}</a></h3>
                                                        <div class="geodir-category-content_price">₹ ${project.min_price} - ₹ ${project.max_price}</div>
                                                        <div class="geodir-category-content-details">
                                                            <ul>
                                                                <li><i class="fas fa-bed"></i> BHK: <span>${project.no_of_bhk}</span></li>
                                                                <li><i class="fas fa-ruler-combined"></i> Area: <span>${project.project_area} ft²</span></li>
                                                                <li><i class="fas fa-building"></i> Type: <span>${project.project_type}</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }
                                
                                document.addEventListener("DOMContentLoaded", function () {
                                    // Initially load 'sale' category
                                    fetchProjects("listing-fetch-code.php", null, "sale");
                                
                                    const saleButton = document.getElementById("sale-button2");
                                    const rentButton = document.getElementById("rent-button2");
                                    const commButton = document.getElementById("comm-button2");
                                    const listingGrid = document.querySelector(".listing-grid");
                                
                                    rentButton.addEventListener("click", function () {
                                        listingGrid.innerHTML = "<p>No projects found.</p>";
                                        const viewMoreContainer = document.querySelector("#view-more-container");
                                        if (viewMoreContainer) viewMoreContainer.innerHTML = "";
                                    });
                                
                                    commButton.addEventListener("click", function () {
                                        listingGrid.innerHTML = "<p>No projects found.</p>";
                                        const viewMoreContainer = document.querySelector("#view-more-container");
                                        if (viewMoreContainer) viewMoreContainer.innerHTML = "";
                                    });
                                
                                    saleButton.addEventListener("click", function () {
                                        fetchProjects("listing-fetch-code.php", null, "sale");
                                    });
                                });

                                document.getElementById("searchBtn").addEventListener("click", function () {
                                    const selectedCategory = document.getElementById("categorySelect").value;
                                
                                    const areaSlider = $("#areaSlider").data("ionRangeSlider");
                                    const areaMin = areaSlider.result.from;
                                    const areaMax = areaSlider.result.to;
                                
                                    const priceSlider = $("#priceSlider").data("ionRangeSlider");
                                    const priceMin = priceSlider.result.from;
                                    const priceMax = priceSlider.result.to;
                                
                                    const locationInput = document.getElementById("cityInput").value.trim();  // added location
                                    
                                    const bhkValue = document.getElementById("bhkInput").value.trim();
                                    
                                    // If using jQuery
                                    let selectedAmenities = $("input[name='amenities[]']:checked").map(function() {
                                        return $(this).val();
                                    }).get();
                                    
                                    const selectedCity = document.getElementById("citySelect").value;
                                
                                    console.log("Selected Category:", selectedCategory);
                                    console.log("Area Min:", areaMin, "Area Max:", areaMax);
                                    console.log("Price Min:", priceMin, "Price Max:", priceMax);
                                    console.log("Location Input:", locationInput); // for debugging
                                    console.log("BHK Input:", bhkValue);
                                    console.log("Amenities Input", selectedAmenities);
                                
                                    let postData = "";
                                
                                    if (selectedCategory) {
                                        postData += "category=" + encodeURIComponent(selectedCategory) + "&";
                                    }
                                
                                    postData += "area_min=" + encodeURIComponent(areaMin) +
                                        "&area_max=" + encodeURIComponent(areaMax) +
                                        "&price_min=" + encodeURIComponent(priceMin) +
                                        "&price_max=" + encodeURIComponent(priceMax);
                                
                                    if (locationInput) {
                                        postData += "&location=" + encodeURIComponent(locationInput);  // append location to postData
                                    }
                                    
                                    if (bhkValue) {
                                        postData += "&bhk=" + encodeURIComponent(bhkValue);
                                    }
                                    
                                    if (selectedAmenities.length > 0) {
                                        selectedAmenities.forEach(function (amenity) {
                                            postData += "&amenities[]=" + encodeURIComponent(amenity);
                                        });
                                    }
                                    
                                    if (selectedCity) {
                                        postData += "&project_location=" + encodeURIComponent(selectedCity);
                                    }
                                
                                    console.log("Final Post Data:", postData);
                                
                                    fetchProjects("search.php", postData);
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
                                <!-- listing-grid end-->
                                <!--<a href="listing.php" class="commentssubmit csb-no-align">View All Properties <i class="fa-solid fa-caret-right"></i></a>-->
                            </div>
                            <!--boxed-container end-->
                        </div>
                                <!--listing-item-container end-->
                                <!--<div class="pagination-wrap">-->
                                <!--    <div class="pagination">-->
                                <!--        <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>-->
                                <!--        <a href="#" >1</a>-->
                                <!--        <a href="#" class="current-page">2</a>-->
                                <!--        <a href="#">3</a>-->
                                <!--        <a href="#">4</a>-->
                                <!--        <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>-->
                                <!--    </div>-->
                                <!--</div>-->
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
                <script src="js/custom-scripts.js"></script>

<?php include ('includes/footer.php');?>
