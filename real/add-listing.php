<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>
<style>
    .custom-tabs {
        margin-bottom: 20px;
    }

    .tab-btn {
        padding: 25px 140px;
        margin-right: 10px;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
    }

    .tab-btn.active {
        background-color: #ddd;
        border-bottom: 2px solid #000;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }
</style>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

            <!--header-end-->
            <!--warpper-->
            <div class="wrapper">
                <!--content-->
                <div class="content">
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                        <div class="breadcrumbs-list bl_flat">
                            <a href="#">Home</a><a href="#">Dashboard</a><span>Add New Listing</span>
                            <!--<div class="breadcrumbs-list_dec"><i class="fa-thin fa-arrow-up"></i></div>-->
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
                                            <div class="dashboard-title-item"><span>Add Propperty</span></div>
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
                                        <!-- Tabs Navigation -->
                                        <div class="custom-tabs">
                                            <button class="tab-btn active" onclick="showTab('for-sale')">For Sale</button>
                                            <button class="tab-btn" onclick="showTab('for-rent')">For Rent</button>
                                            <button class="tab-btn" onclick="showTab('for-lease')">For Lease</button>
                                        </div>
                                            <div id="for-sale" class="tab-content active">
                                                <form id="projectForm" method="POST" action="add-listing-post-code-for-sale.php" enctype="multipart/form-data">
                                                    <div class="db-container">
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item">
                                                            <div class="dashboard-widget-title-single">Basic Informations</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-input-text"></i>
                                                                            <input type="text" name="main_title" placeholder="Main Title">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-layer-group"></i>
                                                                            <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" name="category">
                                                                                <option value="All Categories">All Categories</option>
                                                                                <option value="House">House</option>
                                                                                <option value="Apartment">Apartment</option>
                                                                                <option value="Villa">Villa</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-money-bill"></i>
                                                                            <input type="text"   placeholder="Price" name="price">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <input type="text"   placeholder="Keywords" name="keywords">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <select data-placeholder="Type" class="chosen-select on-radius no-search-select" name="area_type">
                                                                                <option value=""selected disabled>Choose Type</option>
                                                                                <option value="Resedential">Resedential</option>
                                                                                <option value="Plot">Plot</option>
                                                                                <option value="Commercial">Commercial</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single">Location / Contacts</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-phone-office"></i>
                                                                            <input type="text"   placeholder="Phone" name="phone">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-envelope"></i>
                                                                            <input type="text"   placeholder="E-mail" name="email">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="city">
                                                                                <option value="All Cities">All Cities</option>
                                                                                <option value="Bangalore">Bangalore</option>
                                                                                <option value="Belagavi">Belagavi</option>
                                                                                <option value="Hubli">Hubli</option>
                                                                                <option value="Hyderabad">Hyderabad</option>
                                                                                <option value="Delhi">Delhi</option>
                                                                               
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item end-->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text" placeholder="Address line-1" name="address_line_1">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-2" name="address_line_2">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-3" name="address_line_3">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="dashboard-widget-title-single">What's Nearby</div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="locality">
                                                                                <option value="All Places">All Places</option>
                                                                                <option value="School:">School:</option>
                                                                                <option value="Shopping Mall:">Shopping Mall: </option>
                                                                                <option value="Police Station:">Police Station: </option>
                                                                                <option value="Hospital:">Hospital: </option>
                                                                                <option value="Playschool:">Playschool: </option>
                                                                                <option value="Parks:">Parks: </option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <div class="price-range-wrap fl-wrap">                
                                                                                <label>Distance  </label>
                                                                                <input type="text" class="price-range" data-min="0" data-max="5" data-step="0.1" value="km" name="range">
                                                                            </div>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->										
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single"> Property Media</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Project Images</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="project_images" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Background Image Gallery</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="background_images" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->											
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single">Property Details</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-chart-area"></i>
                                                                                    <input type="text"   placeholder="Area:" name="area">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bed"></i>
                                                                                    <input type="text"   placeholder="Bedrooms:" name="bedrooms">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bath"></i>
                                                                                    <input type="text"   placeholder="Bathrooms:" name="bathrooms">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-car"></i>
                                                                                    <input type="text"   placeholder="Parking:" name="parking">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-building"></i>
                                                                                    <input type="text"   placeholder="Age of Property: " name="age_of_property">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-right"></i>
                                                                                    <input type="text" placeholder="Facing Direction: " name="facing_direction">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">				
                                                                            <textarea name="property_details" id="comments" cols="40" rows="3" placeholder="Property Details:"></textarea>							
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="dashboard-widget-title-single">Amenities:</div>
                                                                        <ul class="filter-tags no-list-style ds-tg">
                                                                            <li>
                                                                                <input id="check-aaa5" type="checkbox" name="Amenities[]" value="Swimming pool">
                                                                                <label for="check-aaa5"> Swimming pool</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb5" type="checkbox" name="Amenities[]" value="Terrace">
                                                                                <label for="check-bb5">Terrace</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd5" type="checkbox" name="Amenities[]" value="Air conditioning">
                                                                                <label for="check-dd5"> Air conditioning</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc5" type="checkbox" name="Amenities[]" value="Internet">
                                                                                <label for="check-cc5"> Internet</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff5" type="checkbox" name="Amenities[]" value="Balcony">
                                                                                <label for="check-ff5"> Balcony</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c4" type="checkbox" name="Amenities[]" value="Cable TV">
                                                                                <label for="check-c4">Cable TV</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c18" type="checkbox" name="Amenities[]" value="Computer">
                                                                                <label for="check-c18">Computer</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb53" type="checkbox" name="Amenities[]" value="Dishwasher">
                                                                                <label for="check-bb53">Dishwasher</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd54" type="checkbox" name="Amenities[]" value="Near Green Zone">
                                                                                <label for="check-dd54"> Near Green Zone</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc555" type="checkbox" name="Amenities[]" value="Near Church">
                                                                                <label for="check-cc555"> Near Church</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff511" type="checkbox" name="Amenities[]" value="Near Estate">
                                                                                <label for="check-ff511">Near Estate</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c444" type="checkbox" name="Amenities[]" value="Coffee pot">
                                                                                <label for="check-c444">Coffee pot</label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="dashboard-widget-title-single">Upload Plans and Brochure:</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" name="plans_and_brochure" class="upload" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->									
                                                                    </div>
            
                                                                    
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="commentssubmit" style="margin-top: 10px"><span>Create Property</span></button>		
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                    </div>
                                                </form>
                                                <script>
                                                document.querySelector("#projectForm").addEventListener("submit", function(event) {
                                                    event.preventDefault();
                                                
                                                    const formData = new FormData(this);
                                                
                                                    fetch("add-listing-post-code-for-sale.php", {
                                                        method: "POST",
                                                        body: formData
                                                    })
                                                    .then(response => response.text())
                                                    .then(text => {
                                                        try {
                                                            const data = JSON.parse(text);
                                                            if (data.success) {
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Listing Added!',
                                                                    text: 'Your listing has been successfully added.',
                                                                    confirmButtonText: 'OK'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        location.reload();
                                                                    }
                                                                });
                                                            } else {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Error',
                                                                    text: data.error || 'Something went wrong.',
                                                                    confirmButtonText: 'OK'
                                                                });
                                                            }
                                                        } catch (e) {
                                                            console.error("Invalid JSON from PHP:", text);
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Parse Error',
                                                                text: 'Check server response in console.',
                                                                confirmButtonText: 'OK'
                                                            });
                                                        }
                                                    })
                                                    .catch(err => {
                                                        console.error("Fetch error:", err);
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Network Error',
                                                            text: 'Could not reach the server.',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    });
                                                });
                                                </script>
                                            </div>
                                            <div id="for-rent" class="tab-content">
                                                <form id="projectForm-1" method="POST" action="add-listing-post-code-for-rent.php" enctype="multipart/form-data">
                                                    <div class="db-container">
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item">
                                                            <div class="dashboard-widget-title-single">Basic Informations</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-input-text"></i>
                                                                            <input type="text" name="main_title" placeholder="Main Title">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-layer-group"></i>
                                                                            <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" name="category">
                                                                                <option value="All Categories">All Categories</option>
                                                                                <option value="House">House</option>
                                                                                <option value="Apartment">Apartment</option>
                                                                                <option value="Villa">Villa</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-money-bill"></i>
                                                                            <input type="text"   placeholder="Price" name="price">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <input type="text"   placeholder="Keywords" name="keywords">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <select data-placeholder="Type" class="chosen-select on-radius no-search-select" name="area_type">
                                                                                <option value=""selected disabled>Choose Type</option>
                                                                                <option value="Resedential">Resedential</option>
                                                                                <option value="Plot">Plot</option>
                                                                                <option value="Commercial">Commercial</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single">Location / Contacts</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-phone-office"></i>
                                                                            <input type="text"   placeholder="Phone" name="phone">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-envelope"></i>
                                                                            <input type="text"   placeholder="E-mail" name="email">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="city">
                                                                                <option value="All Cities">All Cities</option>
                                                                                <option value="Bangalore">Bangalore</option>
                                                                                <option value="Belagavi">Belagavi</option>
                                                                                <option value="Hubli">Hubli</option>
                                                                                <option value="Hyderabad">Hyderabad</option>
                                                                                <option value="Delhi">Delhi</option>
                                                                               
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item end-->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text" placeholder="Address line-1" name="address_line_1">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-2" name="address_line_2">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-3" name="address_line_3">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="dashboard-widget-title-single">What's Nearby</div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="locality">
                                                                                <option value="All Places">All Places</option>
                                                                                <option value="School:">School:</option>
                                                                                <option value="Shopping Mall:">Shopping Mall: </option>
                                                                                <option value="Police Station:">Police Station: </option>
                                                                                <option value="Hospital:">Hospital: </option>
                                                                                <option value="Playschool:">Playschool: </option>
                                                                                <option value="Parks:">Parks: </option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <div class="price-range-wrap fl-wrap">                
                                                                                <label>Distance  </label>
                                                                                <input type="text" class="price-range" data-min="0" data-max="5" data-step="0.1" value="km" name="range">
                                                                            </div>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->										
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single"> Property Media</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Project Images</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="project_images" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Background Image Gallery</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="background_images" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->											
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single">Property Details</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-chart-area"></i>
                                                                                    <input type="text"   placeholder="Area:" name="area">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bed"></i>
                                                                                    <input type="text"   placeholder="Bedrooms:" name="bedrooms">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bath"></i>
                                                                                    <input type="text"   placeholder="Bathrooms:" name="bathrooms">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-car"></i>
                                                                                    <input type="text"   placeholder="Parking:" name="parking">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-building"></i>
                                                                                    <input type="text"   placeholder="Age of Property: " name="age_of_property">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-right"></i>
                                                                                    <input type="text" placeholder="Facing Direction: " name="facing_direction">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bank"></i>
                                                                                    <input type="text" placeholder="Security Deposit: " name="security_deposit">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-clock"></i>
                                                                                    <input type="text" placeholder="Minimum Lease Period" name="minimum_lease_period">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">				
                                                                            <textarea name="property_details" id="comments" cols="40" rows="3" placeholder="Property Details:"></textarea>							
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="dashboard-widget-title-single">Amenities:</div>
                                                                        <ul class="filter-tags no-list-style ds-tg">
                                                                            <li>
                                                                                <input id="check-aaa5" type="checkbox" name="Amenities[]" value="Swimming pool">
                                                                                <label for="check-aaa5"> Swimming pool</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb5" type="checkbox" name="Amenities[]" value="Terrace">
                                                                                <label for="check-bb5">Terrace</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd5" type="checkbox" name="Amenities[]" value="Air conditioning">
                                                                                <label for="check-dd5"> Air conditioning</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc5" type="checkbox" name="Amenities[]" value="Internet">
                                                                                <label for="check-cc5"> Internet</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff5" type="checkbox" name="Amenities[]" value="Balcony">
                                                                                <label for="check-ff5"> Balcony</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c4" type="checkbox" name="Amenities[]" value="Cable TV">
                                                                                <label for="check-c4">Cable TV</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c18" type="checkbox" name="Amenities[]" value="Computer">
                                                                                <label for="check-c18">Computer</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb53" type="checkbox" name="Amenities[]" value="Dishwasher">
                                                                                <label for="check-bb53">Dishwasher</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd54" type="checkbox" name="Amenities[]" value="Near Green Zone">
                                                                                <label for="check-dd54"> Near Green Zone</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc555" type="checkbox" name="Amenities[]" value="Near Church">
                                                                                <label for="check-cc555"> Near Church</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff511" type="checkbox" name="Amenities[]" value="Near Estate">
                                                                                <label for="check-ff511">Near Estate</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c444" type="checkbox" name="Amenities[]" value="Coffee pot">
                                                                                <label for="check-c444">Coffee pot</label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="dashboard-widget-title-single">Upload Plans and Brochure:</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" name="plans_and_brochure" class="upload" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->									
                                                                    </div>
            
                                                                    
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="commentssubmit" style="margin-top: 10px"><span>Create Property</span></button>		
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                    </div>
                                                </form>
                                                <script>
                                                document.querySelector("#projectForm-1").addEventListener("submit", function(event) {
                                                    event.preventDefault();
                                                
                                                    const formData = new FormData(this);
                                                
                                                    fetch("add-listing-post-code-for-rent.php", {
                                                        method: "POST",
                                                        body: formData
                                                    })
                                                    .then(response => response.text())
                                                    .then(text => {
                                                        try {
                                                            const data = JSON.parse(text);
                                                            if (data.success) {
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Listing Added!',
                                                                    text: 'Your listing has been successfully added.',
                                                                    confirmButtonText: 'OK'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        location.reload();
                                                                    }
                                                                });
                                                            } else {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Error',
                                                                    text: data.error || 'Something went wrong.',
                                                                    confirmButtonText: 'OK'
                                                                });
                                                            }
                                                        } catch (e) {
                                                            console.error("Invalid JSON from PHP:", text);
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Parse Error',
                                                                text: 'Check server response in console.',
                                                                confirmButtonText: 'OK'
                                                            });
                                                        }
                                                    })
                                                    .catch(err => {
                                                        console.error("Fetch error:", err);
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Network Error',
                                                            text: 'Could not reach the server.',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    });
                                                });
                                                </script>
                                            </div>
                                            <div id="for-lease" class="tab-content">
                                                <form id="projectForm-2" method="POST" action="add-listing-post-code-for-lease.php" enctype="multipart/form-data">
                                                    <div class="db-container">
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item">
                                                            <div class="dashboard-widget-title-single">Basic Informations</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-input-text"></i>
                                                                            <input type="text" name="main_title" placeholder="Main Title">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-layer-group"></i>
                                                                            <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" name="category">
                                                                                <option value="All Categories">All Categories</option>
                                                                                <option value="House">House</option>
                                                                                <option value="Apartment">Apartment</option>
                                                                                <option value="Villa">Villa</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-money-bill"></i>
                                                                            <input type="text"   placeholder="Price" name="price">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <input type="text"   placeholder="Keywords" name="keywords">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <select data-placeholder="Type" class="chosen-select on-radius no-search-select" name="area_type">
                                                                                <option value=""selected disabled>Choose Type</option>
                                                                                <option value="Resedential">Resedential</option>
                                                                                <option value="Plot">Plot</option>
                                                                                <option value="Commercial">Commercial</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single">Location / Contacts</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-phone-office"></i>
                                                                            <input type="text"   placeholder="Phone" name="phone">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-envelope"></i>
                                                                            <input type="text"   placeholder="E-mail" name="email">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="city">
                                                                                <option value="All Cities">All Cities</option>
                                                                                <option value="Bangalore">Bangalore</option>
                                                                                <option value="Belagavi">Belagavi</option>
                                                                                <option value="Hubli">Hubli</option>
                                                                                <option value="Hyderabad">Hyderabad</option>
                                                                                <option value="Delhi">Delhi</option>
                                                                               
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item end-->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text" placeholder="Address line-1" name="address_line_1">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-2" name="address_line_2">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-3" name="address_line_3">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="dashboard-widget-title-single">What's Nearby</div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="locality">
                                                                                <option value="All Places">All Places</option>
                                                                                <option value="School:">School:</option>
                                                                                <option value="Shopping Mall:">Shopping Mall: </option>
                                                                                <option value="Police Station:">Police Station: </option>
                                                                                <option value="Hospital:">Hospital: </option>
                                                                                <option value="Playschool:">Playschool: </option>
                                                                                <option value="Parks:">Parks: </option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <div class="price-range-wrap fl-wrap">                
                                                                                <label>Distance  </label>
                                                                                <input type="text" class="price-range" data-min="0" data-max="5" data-step="0.1" value="km" name="range">
                                                                            </div>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->										
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single"> Property Media</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Project Images</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="project_images" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Background Image Gallery</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="background_images" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--dasboard-content-item end-->											
                                                        <!--dasboard-content-item-->
                                                        <div class="dasboard-content-item" style="margin-top: 20px">
                                                            <div class="dashboard-widget-title-single">Property Details</div>
                                                            <div class="custom-form">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-chart-area"></i>
                                                                                    <input type="text"   placeholder="Area:" name="area">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bed"></i>
                                                                                    <input type="text"   placeholder="Bedrooms:" name="bedrooms">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bath"></i>
                                                                                    <input type="text"   placeholder="Bathrooms:" name="bathrooms">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-car"></i>
                                                                                    <input type="text"   placeholder="Parking:" name="parking">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-building"></i>
                                                                                    <input type="text"   placeholder="Age of Property: " name="age_of_property">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-right"></i>
                                                                                    <input type="text" placeholder="Facing Direction: " name="facing_direction">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-clock"></i>
                                                                                    <input type="text" placeholder="Minimum Lease Period" name="minimum_lease_period">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">				
                                                                            <textarea name="property_details" id="comments" cols="40" rows="3" placeholder="Property Details:"></textarea>							
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="dashboard-widget-title-single">Amenities:</div>
                                                                        <ul class="filter-tags no-list-style ds-tg">
                                                                            <li>
                                                                                <input id="check-aaa5" type="checkbox" name="Amenities[]" value="Swimming pool">
                                                                                <label for="check-aaa5"> Swimming pool</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb5" type="checkbox" name="Amenities[]" value="Terrace">
                                                                                <label for="check-bb5">Terrace</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd5" type="checkbox" name="Amenities[]" value="Air conditioning">
                                                                                <label for="check-dd5"> Air conditioning</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc5" type="checkbox" name="Amenities[]" value="Internet">
                                                                                <label for="check-cc5"> Internet</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff5" type="checkbox" name="Amenities[]" value="Balcony">
                                                                                <label for="check-ff5"> Balcony</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c4" type="checkbox" name="Amenities[]" value="Cable TV">
                                                                                <label for="check-c4">Cable TV</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c18" type="checkbox" name="Amenities[]" value="Computer">
                                                                                <label for="check-c18">Computer</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb53" type="checkbox" name="Amenities[]" value="Dishwasher">
                                                                                <label for="check-bb53">Dishwasher</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd54" type="checkbox" name="Amenities[]" value="Near Green Zone">
                                                                                <label for="check-dd54"> Near Green Zone</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc555" type="checkbox" name="Amenities[]" value="Near Church">
                                                                                <label for="check-cc555"> Near Church</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff511" type="checkbox" name="Amenities[]" value="Near Estate">
                                                                                <label for="check-ff511">Near Estate</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c444" type="checkbox" name="Amenities[]" value="Coffee pot">
                                                                                <label for="check-c444">Coffee pot</label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="dashboard-widget-title-single">Upload Plans and Brochure:</div>
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" name="plans_and_brochure" class="upload" multiple>
                                                                        </div>
                                                                        <!-- listsearch-input-item -->									
                                                                    </div>
            
                                                                    
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="commentssubmit" style="margin-top: 10px"><span>Create Property</span></button>		
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                    </div>
                                                </form>
                                                <script>
                                                document.querySelector("#projectForm-2").addEventListener("submit", function(event) {
                                                    event.preventDefault();
                                                
                                                    const formData = new FormData(this);
                                                
                                                    fetch("add-listing-post-code-for-lease.php", {
                                                        method: "POST",
                                                        body: formData
                                                    })
                                                    .then(response => response.text())
                                                    .then(text => {
                                                        try {
                                                            const data = JSON.parse(text);
                                                            if (data.success) {
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Listing Added!',
                                                                    text: 'Your listing has been successfully added.',
                                                                    confirmButtonText: 'OK'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        location.reload();
                                                                    }
                                                                });
                                                            } else {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Error',
                                                                    text: data.error || 'Something went wrong.',
                                                                    confirmButtonText: 'OK'
                                                                });
                                                            }
                                                        } catch (e) {
                                                            console.error("Invalid JSON from PHP:", text);
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Parse Error',
                                                                text: 'Check server response in console.',
                                                                confirmButtonText: 'OK'
                                                            });
                                                        }
                                                    })
                                                    .catch(err => {
                                                        console.error("Fetch error:", err);
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Network Error',
                                                            text: 'Could not reach the server.',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    });
                                                });
                                                </script>
                                            </div>
                                            <!-- Tab Switching Script -->
                                            <script>
                                                function showTab(tabId) {
                                                    // Remove active class from all tab buttons
                                                    const tabs = document.querySelectorAll('.tab-btn');
                                                    tabs.forEach(tab => tab.classList.remove('active'));
                                            
                                                    // Hide all content
                                                    const contents = document.querySelectorAll('.tab-content');
                                                    contents.forEach(content => content.classList.remove('active'));
                                            
                                                    // Activate selected tab and content
                                                    document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
                                                    document.getElementById(tabId).classList.add('active');
                                                }
                                            </script>
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
                
                <!-- SweetAlert2 JS -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <?php include ('includes/footer.php');?>
