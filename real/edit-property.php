<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>

<?php include('includes/db.php');
// 2. Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Prepare and execute SQL query
$sql = "SELECT * FROM user_project_table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();
$selectedCategory = $project['Category'] ?? '';
$selectedAreaType = $project['Area_type'] ?? '';
$selectedCity = $project['City'] ?? '';
$propertyDetails = $project['Property_details'] ?? '';
$amenitiesData = $project['Amenities'] ?? '';
$selectedAmenities = array_map('trim', explode(',', $amenitiesData));
$imageData = $project['project_images'] ?? '';
$images = array_map('trim', explode(',', $imageData));
$bgImageData = $project['background_images'] ?? '';
$bgImages = array_map('trim', explode(',', $bgImageData));
$brochureData = $project['plans_and_brochure'] ?? '';
$brochures = array_map('trim', explode(',', $brochureData));
$localityData = $project['Locality'] ?? ''; // Example: "Hospital: 2"
$selectedPlace = '';
$selectedDistance = '';

if (!empty($localityData)) {
    // Split into key and value
    $parts = explode(':', $localityData, 2);
    if (count($parts) === 2) {
        $selectedPlace = trim($parts[0]) . ':'; // Add the colon back
        $selectedDistance = trim($parts[1]);
    }
}

// Close statement and connection
$stmt->close();
$conn->close();
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
                            <a href="#">Home</a><a href="#">Dashboard</a><span>Edit Property</span>
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
                                            <div class="dashboard-title-item"><span>Edit Property</span></div>
                                        </div>
                                
                                            <div id="for-sale" class="tab-content active">
                                                <form id="editPropertyForm" method="POST" action="edit-property-post-code.php" enctype="multipart/form-data">
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
                                                                            <input type="text" name="main_title" placeholder="Main Title" value="<?php echo htmlspecialchars($project['Main_title'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-layer-group"></i>
                                                                            <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" name="category">
                                                                                <option value="All Categories" <?php echo ($selectedCategory === 'All Categories') ? 'selected' : ''; ?>>All Categories</option>
                                                                                <option value="House" <?php echo ($selectedCategory === 'House') ? 'selected' : ''; ?>>House</option>
                                                                                <option value="Apartment" <?php echo ($selectedCategory === 'Apartment') ? 'selected' : ''; ?>>Apartment</option>
                                                                                <option value="Villa" <?php echo ($selectedCategory === 'Villa') ? 'selected' : ''; ?>>Villa</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-money-bill"></i>
                                                                            <input type="text"   placeholder="Price" name="price" value="<?php echo htmlspecialchars($project['Price'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <input type="text"   placeholder="Keywords" name="keywords" value="<?php echo htmlspecialchars($project['Keywords'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->										
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-tags"></i>
                                                                            <select data-placeholder="Type" class="chosen-select on-radius no-search-select" name="area_type">
                                                                                <option value="" disabled <?php echo ($selectedAreaType == '') ? 'selected' : ''; ?>>Choose Type</option>
                                                                                <option value="Resedential" <?php echo ($selectedAreaType === 'Resedential') ? 'selected' : ''; ?>>Resedential</option>
                                                                                <option value="Plot" <?php echo ($selectedAreaType === 'Plot') ? 'selected' : ''; ?>>Plot</option>
                                                                                <option value="Commercial" <?php echo ($selectedAreaType === 'Commercial') ? 'selected' : ''; ?>>Commercial</option>
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
                                                                            <input type="text"   placeholder="Phone" name="phone" value="<?php echo htmlspecialchars($project['Phone'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-envelope"></i>
                                                                            <input type="text"   placeholder="E-mail" name="email" value="<?php echo htmlspecialchars($project['Email'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->	
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="city">
                                                                                <option value="All Cities" <?php echo ($selectedCity === 'All Cities') ? 'selected' : ''; ?>>All Cities</option>
                                                                                <option value="Bangalore" <?php echo ($selectedCity === 'Bangalore') ? 'selected' : ''; ?>>Bangalore</option>
                                                                                <option value="Belagavi" <?php echo ($selectedCity === 'Belagavi') ? 'selected' : ''; ?>>Belagavi</option>
                                                                                <option value="Hubli" <?php echo ($selectedCity === 'Hubli') ? 'selected' : ''; ?>>Hubli</option>
                                                                                <option value="Hyderabad" <?php echo ($selectedCity === 'Hyderabad') ? 'selected' : ''; ?>>Hyderabad</option>
                                                                                <option value="Delhi" <?php echo ($selectedCity === 'Delhi') ? 'selected' : ''; ?>>Delhi</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- listsearch-input-item end -->
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text" placeholder="Address line-1" name="address_line_1" value="<?php echo htmlspecialchars($project['Address_line_1'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-2" name="address_line_2" value="<?php echo htmlspecialchars($project['Address_line_2'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <!-- listsearch-input-item -->
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-address-card"></i>
                                                                            <input type="text"   placeholder="Address line-3" name="address_line_3" value="<?php echo htmlspecialchars($project['Address_line_3'] ?? '', ENT_QUOTES); ?>">
                                                                        </div>
                                                                        <!-- listsearch-input-item -->											
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="dashboard-widget-title-single">What's Nearby</div>
                                                                <div class="row">
                                                                    <!-- Locality Dropdown -->
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-city"></i>
                                                                            <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" name="locality">
                                                                                <option value="All Places" <?php echo ($selectedPlace === 'All Places') ? 'selected' : ''; ?>>All Places</option>
                                                                                <option value="School:" <?php echo ($selectedPlace === 'School:') ? 'selected' : ''; ?>>School:</option>
                                                                                <option value="Shopping Mall:" <?php echo ($selectedPlace === 'Shopping Mall:') ? 'selected' : ''; ?>>Shopping Mall:</option>
                                                                                <option value="Police Station:" <?php echo ($selectedPlace === 'Police Station:') ? 'selected' : ''; ?>>Police Station:</option>
                                                                                <option value="Hospital:" <?php echo ($selectedPlace === 'Hospital:') ? 'selected' : ''; ?>>Hospital:</option>
                                                                                <option value="Playschool:" <?php echo ($selectedPlace === 'Playschool:') ? 'selected' : ''; ?>>Playschool:</option>
                                                                                <option value="Parks:" <?php echo ($selectedPlace === 'Parks:') ? 'selected' : ''; ?>>Parks:</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <!-- Distance Input -->
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">
                                                                            <div class="price-range-wrap fl-wrap">                
                                                                                <label>Distance</label>
                                                                                <input type="text" class="price-range" data-min="0" data-max="5" data-step="0.1" value="<?php echo htmlspecialchars($selectedDistance); ?>" name="range">
                                                                            </div>
                                                                        </div>
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
                                                                    
                                                                        <!-- Existing Images -->
                                                                        <div class="row mb-3">
                                                                            <?php foreach ($images as $img): ?>
                                                                                <?php if (!empty($img)): ?>
                                                                                    <div class="col-4 mb-2">
                                                                                        <img src="<?php echo htmlspecialchars($img); ?>" alt="Project Image" style="width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    
                                                                        <!-- Upload New Images -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="project_images[]" multiple>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="sin-uidb">Background Image Gallery</div>
                                                                    
                                                                        <!-- Existing Background Images -->
                                                                        <div class="row mb-3">
                                                                            <?php foreach ($bgImages as $bg): ?>
                                                                                <?php if (!empty($bg)): ?>
                                                                                    <div class="col-4 mb-2">
                                                                                        <img src="<?php echo htmlspecialchars($bg); ?>" alt="Background Image" style="width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    
                                                                        <!-- Upload New Background Images -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" class="upload" name="background_images[]" multiple>
                                                                        </div>
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
                                                                                    <input type="text"   placeholder="Area:" name="area"  value="<?php echo htmlspecialchars($project['Area'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bed"></i>
                                                                                    <input type="text"   placeholder="Bedrooms:" name="bedrooms" value="<?php echo htmlspecialchars($project['Bedroom'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bath"></i>
                                                                                    <input type="text"   placeholder="Bathrooms:" name="bathrooms" value="<?php echo htmlspecialchars($project['Bathrooms'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-car"></i>
                                                                                    <input type="text"   placeholder="Parking:" name="parking" value="<?php echo htmlspecialchars($project['Parking'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-building"></i>
                                                                                    <input type="text"   placeholder="Age of Property: " name="age_of_property" value="<?php echo htmlspecialchars($project['Age_of_property'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-right"></i>
                                                                                    <input type="text" placeholder="Facing Direction: " name="facing_direction" value="<?php echo htmlspecialchars($project['Facing_direction'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!-- listsearch-input-item -->
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-bank"></i>
                                                                                    <input type="text" placeholder="Security Deposit: " name="security_deposit" value="<?php echo htmlspecialchars($project['Security_deposit'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                                <!-- listsearch-input-item -->												
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="cs-intputwrap">
                                                                                    <i class="fa-light fa-clock"></i>
                                                                                    <input type="text" placeholder="Minimum Lease Period" name="minimum_lease_period" value="<?php echo htmlspecialchars($project['Minimum_lease_period'] ?? '', ENT_QUOTES); ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="cs-intputwrap">				
                                                                            <textarea name="property_details" id="comments" cols="40" rows="3" placeholder="Property Details:"><?php echo htmlspecialchars($propertyDetails); ?></textarea>							
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="dashboard-widget-title-single">Amenities:</div>
                                                                        <ul class="filter-tags no-list-style ds-tg">
                                                                            <li>
                                                                                <input id="check-aaa5" type="checkbox" name="Amenities[]" value="Swimming pool" 
                                                                                    <?php echo in_array('Swimming pool', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-aaa5"> Swimming pool</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb5" type="checkbox" name="Amenities[]" value="Terrace" 
                                                                                    <?php echo in_array('Terrace', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-bb5">Terrace</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd5" type="checkbox" name="Amenities[]" value="Air conditioning" 
                                                                                    <?php echo in_array('Air conditioning', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-dd5"> Air conditioning</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc5" type="checkbox" name="Amenities[]" value="Internet" 
                                                                                    <?php echo in_array('Internet', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-cc5"> Internet</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff5" type="checkbox" name="Amenities[]" value="Balcony" 
                                                                                    <?php echo in_array('Balcony', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-ff5"> Balcony</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c4" type="checkbox" name="Amenities[]" value="Cable TV" 
                                                                                    <?php echo in_array('Cable TV', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-c4">Cable TV</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c18" type="checkbox" name="Amenities[]" value="Computer" 
                                                                                    <?php echo in_array('Computer', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-c18">Computer</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-bb53" type="checkbox" name="Amenities[]" value="Dishwasher" 
                                                                                    <?php echo in_array('Dishwasher', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-bb53">Dishwasher</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-dd54" type="checkbox" name="Amenities[]" value="Near Green Zone" 
                                                                                    <?php echo in_array('Near Green Zone', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-dd54"> Near Green Zone</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-cc555" type="checkbox" name="Amenities[]" value="Near Church" 
                                                                                    <?php echo in_array('Near Church', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-cc555"> Near Church</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-ff511" type="checkbox" name="Amenities[]" value="Near Estate" 
                                                                                    <?php echo in_array('Near Estate', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-ff511">Near Estate</label>
                                                                            </li>
                                                                            <li>
                                                                                <input id="check-c444" type="checkbox" name="Amenities[]" value="Coffee pot" 
                                                                                    <?php echo in_array('Coffee pot', $selectedAmenities) ? 'checked' : ''; ?>>
                                                                                <label for="check-c444">Coffee pot</label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="dashboard-widget-title-single">Upload Plans and Brochure:</div>
                                                                    
                                                                        <!-- Existing Brochures/Plans Preview -->
                                                                        <div class="row mb-3">
                                                                            <?php foreach ($brochures as $file): ?>
                                                                                <?php if (!empty($file)): ?>
                                                                                    <div class="col-12 mb-2">
                                                                                        <?php
                                                                                            $ext = pathinfo($file, PATHINFO_EXTENSION);
                                                                                            $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                                                        ?>
                                                                                        <?php if ($isImage): ?>
                                                                                            <img src="<?php echo htmlspecialchars($file); ?>" alt="Plan or Brochure" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                                                                                        <?php else: ?>
                                                                                            <a href="<?php echo htmlspecialchars($file); ?>" target="_blank"><?php echo basename($file); ?></a>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    
                                                                        <!-- Upload New Files -->
                                                                        <div class="fuzone">
                                                                            <div class="fu-text">
                                                                                <span><i class="fa-light fa-cloud-arrow-up"></i> Click here or drop files to upload</span>
                                                                                <div class="photoUpload-files fl-wrap"></div>
                                                                            </div>
                                                                            <input type="file" name="plans_and_brochure[]" class="upload" multiple>
                                                                        </div>
                                                                    </div>
            
                                                                    
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="commentssubmit" style="margin-top: 10px"><span>Edit Property</span></button>		
                                                        </div>
                                                        <!--dasboard-content-item end-->
                                                    </div>
                                                    <input type="hidden" name="property_id" id="property_id">
                                                </form>
                                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                <script>
                                                  // Get query param from URL
                                                  function getQueryParam(param) {
                                                    const urlParams = new URLSearchParams(window.location.search);
                                                    return urlParams.get(param);
                                                  }
                                                
                                                  document.addEventListener("DOMContentLoaded", function () {
                                                    // Set property_id hidden input
                                                    const propertyId = getQueryParam("id");
                                                    if (propertyId) {
                                                      document.getElementById("property_id").value = propertyId;
                                                    } else {
                                                      console.error("property_id is missing in the URL");
                                                    }
                                                
                                                    // Attach form submit event listener
                                                    const form = document.getElementById("editPropertyForm"); // replace with your form id
                                                    form.addEventListener("submit", function (e) {
                                                      e.preventDefault();
                                                
                                                      Swal.fire({
                                                        title: "Are you sure?",
                                                        text: "Do you want to update this property?",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes, update it!",
                                                        cancelButtonText: "Cancel",
                                                      }).then((result) => {
                                                        if (result.isConfirmed) {
                                                          // Prepare form data
                                                          const formData = new FormData(form);
                                                
                                                          fetch("edit-property-post-code.php", {
                                                            method: "POST",
                                                            body: formData,
                                                          })
                                                            .then((response) => response.json())
                                                            .then((data) => {
                                                              if (data.success) {
                                                                Swal.fire({
                                                                  title: "Success!",
                                                                  text: "Property updated successfully.",
                                                                  icon: "success",
                                                                  confirmButtonText: "OK",
                                                                }).then(() => {
                                                                  // Redirect to current-listings.php
                                                                  window.location.href = "current-listings.php";
                                                                });
                                                              } else {
                                                                Swal.fire({
                                                                  title: "Error!",
                                                                  text: data.error || "Something went wrong.",
                                                                  icon: "error",
                                                                });
                                                              }
                                                            })
                                                            .catch((error) => {
                                                              Swal.fire({
                                                                title: "Error!",
                                                                text: "Network error: " + error,
                                                                icon: "error",
                                                              });
                                                            });
                                                        }
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

                <?php include ('includes/footer.php');?>
