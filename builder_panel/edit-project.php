<?php
include('includes/header.php');
include('includes/db.php');

// Fetch username from session
if (!isset($_SESSION['username'])) {
    die("User not logged in"); // Handle cases where session is not set
}

$username = $_SESSION['username']; 

// Query to get builder names for the logged-in user
$sql = "SELECT builder_name FROM builders_table WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$builder_names = [];
while ($row = $result->fetch_assoc()) {
    $builder_names[] = $row['builder_name']; // Collect all builder names for the user
}

// Get project ID from URL
if (isset($_GET['id'])) {
    $project_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch project data from database
    $query = "SELECT * FROM builder_panel_projects_table WHERE id = '$project_id'";
    $project_result = mysqli_query($conn, $query);
    
    if ($project_result && mysqli_num_rows($project_result) > 0) {
        $project = mysqli_fetch_assoc($project_result);
    } else {
        echo "<script>alert('Project not found!'); window.location.href='all-projects.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='all-projects.php';</script>";
    exit;
}
// Process comma-separated bank names into an array
$selected_bank_names = [];

if (!empty($project['bank_name'])) {
    $selected_bank_names = array_map('trim', explode(',', $project['bank_name']));
}
if (!empty($project['bank_document'])) {
    $bank_documents = array_map('trim', explode(',', $project['bank_document']));
}

// Generate bank dropdown options
$bank_options = "";
$sql_bank = "SELECT bank_name FROM bank_details_table";
$result_bank = $conn->query($sql_bank);

if ($result_bank->num_rows > 0) {
    while ($row = $result_bank->fetch_assoc()) {
        $bank_name = htmlspecialchars($row['bank_name']);
        $selected = in_array($bank_name, $selected_bank_names) ? "selected" : ""; // orrect comparison
        $bank_options .= "<option value='$bank_name' $selected>$bank_name</option>";
    }
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>
                    Property Add
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <div class="card">
                    <form id="editProjectForm" method="POST" action="edit-project-post-code.php" enctype="multipart/form-data">
                    <section>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6">
                                        <label>Builder Name</label>
                                        <select class="form-control show-tick" name="builder_name" required>
                                            <?php 
                                            // Generate dropdown options dynamically based on fetched builder names
                                            foreach ($builder_names as $builder_name) {
                                                echo '<option value="' . htmlspecialchars($builder_name) . '" ' . (($project['builder_name'] == $builder_name) ? 'selected' : '') . '>' . htmlspecialchars($builder_name) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                        <div class="col-sm-6">
                                            <label>Project Name</label>
                                            <div class="form-group">
                                                    <input type="text" class="form-control" name="project_name" value="<?= htmlspecialchars($project['project_name']) ?>" required />
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Configurations: </label>
                                                <?php
                                                // Fetch configurations from the database
                                                $configurations_str = isset($project['configurations']) ? $project['configurations'] : '';
    
                                                // Debugging: Output fetched configurations
                                                echo "<!-- Debug: Fetched configurations: $configurations_str -->";
    
                                                // Convert the configurations string into an array
                                                $selected_configurations = (!empty($configurations_str)) ? array_map('trim', explode(",", $configurations_str)) : [];
    
                                                // Debugging: Output array for verification
                                                echo "<!-- Debug: Converted Configurations Array: " . json_encode($selected_configurations) . " -->";
    
                                                // Define the list of all available configurations
                                                $all_configurations = [
                                                    "Studio Room", "1BHK", "1.5BHK", "2BHK", "2.5BHK", "3BHK", 
                                                    "3.5BHK", "4BHK", "4.5BHK", "5BHK", "5+ BHK"
                                                ];
    
                                                foreach ($all_configurations as $index => $config):
                                                    // Check if the configuration exists in the fetched list
                                                    $checked = in_array($config, $selected_configurations) ? 'checked' : '';
    
                                                    // Debugging: Output checkbox status
                                                    echo "<!-- Debug: Checking '$config' - " . (in_array($config, $selected_configurations) ? 'Found' : 'Not Found') . " -->";
                                                ?>
                                                    <div class="checkbox inlineblock m-r-20">
                                                        <input id="checkbox<?= 21 + $index ?>" name="configurations[]" type="checkbox" value="<?= htmlspecialchars($config) ?>" <?= $checked ?> />
                                                        <label for="checkbox<?= 21 + $index ?>"><?= htmlspecialchars($config) ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label>Project Type</label>
                                            <select class="form-control show-tick" name="project_type" required>
                                                <option value="">-- PROJECT TYPE --</option>
                                                <option value="Villa" <?= ($project['project_type'] == "Villa") ? 'selected' : '' ?>>Villa</option>
                                                <option value="Apartment" <?= ($project['project_type'] == "Apartment") ? 'selected' : '' ?>>Apartment</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label>Construction Status</label>
                                            <select class="form-control show-tick" name="construction_status" required>
                                                <option value="">-- CONSTRUCTION STATUS --</option>
                                                <option value="Pre-Launch" <?= ($project['construction_status'] == "Pre-Launch") ? 'selected' : '' ?>>Pre-Launch</option>
                                                <option value="Under Construction" <?= ($project['construction_status'] == "Under Construction") ? 'selected' : '' ?>>Under Construction</option>
                                                <option value="Ready to Move" <?= ($project['construction_status'] == "Ready to Move") ? 'selected' : '' ?>>Ready to Move</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Project Location</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="project_location" value="<?= htmlspecialchars($project['project_location']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>No. of Units</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="no_of_units" value="<?= htmlspecialchars($project['no_of_units']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Project Link</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="project_link" value="<?= htmlspecialchars($project['project_link']) ?>" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <label>Project Size</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="project_size" value="<?= htmlspecialchars($project['project_size']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Project Area</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="project_area" value="<?= htmlspecialchars($project['project_area']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Project Launch</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control" name="project_launch" value="<?= htmlspecialchars($project['project_launch']) ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Possession Start</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control" name="possession_start_date" value="<?= htmlspecialchars($project['possesion_start_date']) ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Min. Area</label>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="min_area_sft" value="<?= htmlspecialchars($project['min_area_sft']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Max. Area</label>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="max_area_sft" value="<?= htmlspecialchars($project['max_area_sft']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Min. Price</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="min_price" value="<?= htmlspecialchars($project['min_price']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Max. Price</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="max_price" value="<?= htmlspecialchars($project['max_price']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Rera ID</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="rera_id" value="<?= htmlspecialchars($project['rera_id']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Contact Email</label>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="contact_email" value="<?= htmlspecialchars($project['contact_email']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Contact Mobile</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="contact_mobile" value="<?= htmlspecialchars($project['contact_mobile']) ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Validity</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="validity" value="<?= htmlspecialchars($project['validity']) ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Add Banner Image (1920*500)</label>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="banner_image" />

                                                <?php if (!empty($project['banner_image'])): ?>
                                                    <br>
                                                    <!-- Display Image -->
                                                    <img src="../admin_panel/<?= htmlspecialchars($project['banner_image']) ?>" 
                                                            alt="Banner Image" 
                                                            class="img-fluid rounded" 
                                                            style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">

                                                    <!-- Display File Name -->
                                                    <p class="mt-2 text-muted">
                                                        <?= basename(htmlspecialchars($project['banner_image'])) ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                            </div>
                                    </div>
                                    <h6 class="mt-4">Project Overview</h6>
                                    <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control no-resize" name="project_overview"><?= htmlspecialchars($project['project_overview']) ?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </section>
                                </div>
                                </div>
                                <div class="body">
                                <?php
                                // Grouped fields (saleable area and images)
                                $saleable_groups_raw = explode('/', $project['saleable_area_sft']);
                                $project_image_groups_raw = explode(',', $project['project_images']);
                            
                                // Convert each group into arrays
                                $saleable_area_sft = array_map(function ($group) {
                                    return array_map('trim', explode(',', $group));
                                }, $saleable_groups_raw);
                            
                                $project_images = array_map(function ($group) {
                                    return array_map('trim', explode(':', $group));
                                }, $project_image_groups_raw);
                            
                                // Normal flat fields
                                $no_of_bhk = array_map('trim', explode(',', $project['no_of_bhk']));
                                $project_facing = array_map('trim', explode(',', $project['project_facing']));
                                $carpet_area_sft = array_map('trim', explode(',', $project['carpet_area_sft']));
                                $price = array_map('trim', explode(',', $project['price']));
                            
                                $max_count = max(count($no_of_bhk), count($project_facing), count($carpet_area_sft), count($price), count($saleable_area_sft), count($project_images));
                                ?>
                            
                                <h6 class="mt-4">CONFIGURATIONS</h6>
                                <div id="config-sections">
                                    <?php for ($i = 0; $i < $max_count; $i++): ?>
                                        <div class="form-section" data-section="<?= $i ?>">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <label>No. of BHK</label>
                                                    <input type="text" name="no_of_bhk[]" class="form-control" value="<?= htmlspecialchars($no_of_bhk[$i] ?? '') ?>" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <label>Project Facing</label>
                                                    <input type="text" name="project_facing[]" class="form-control" value="<?= htmlspecialchars($project_facing[$i] ?? '') ?>" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <label>Carpet Area SFT</label>
                                                    <input type="text" name="carpet_area_sft[]" class="form-control" value="<?= htmlspecialchars($carpet_area_sft[$i] ?? '') ?>" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <label>Price</label>
                                                    <input type="text" name="price[]" class="form-control" value="<?= htmlspecialchars($price[$i] ?? '') ?>" />
                                                </div>
                                            </div>
                                        <div class="sft-floor-group-wrapper">
                                            <?php for ($j = 0; $j < count($saleable_area_sft[$i] ?? []); $j++): ?>
                                                <div class="row sft-floor-group">
                                                    <div class="col-lg-6 col-md-4 col-sm-6">
                                                        <label>SFT</label>
                                                        <input type="text" name="saleable_area_sft[<?= $i ?>][]" class="form-control" value="<?= htmlspecialchars($saleable_area_sft[$i][$j] ?? '') ?>" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-4 col-sm-6">
                                                        <label>Floor Plan</label>
                                                        <!-- File Input for New Image -->
                                                        <input type="file" name="project_images_new[<?= $i ?>][]" class="form-control single-upload" data-index="<?= $i ?>_<?= $j ?>" data-existing-image="<?= htmlspecialchars($project_images[$i][$j] ?? '') ?>" />
                                        
                                                        <!-- Hidden Input for Existing Image (Only Displayed if Present) -->
                                                        <?php if (!empty($project_images[$i][$j])): ?>
                                                            <input type="hidden" name="project_images_existing[<?= $i ?>][]" id="existing_image_<?= $i ?>_<?= $j ?>" value="<?= htmlspecialchars($project_images[$i][$j]) ?>" />
                                                            <div class="mt-2 preview-wrapper" id="preview_<?= $i ?>_<?= $j ?>">
                                                                <img src="../admin_panel/<?= htmlspecialchars($project_images[$i][$j]) ?>" alt="Project Image" class="img-fluid rounded" style="max-width: 100px; border: 1px solid #ccc; padding: 4px;" />
                                                                <p class="text-muted small"><?= basename($project_images[$i][$j]) ?></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                            <div class="text-center mb-2">
                                                <button type="button" class="btn btn-success add-sft-floor" data-section="<?= $i ?>">Add SFT + Plan</button>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-primary add-config-section">Add</button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            
                            <script>
                                $(document).ready(function () {
                                    let sectionIndex = <?= $max_count ?>;
                            
                                    // Function to create a new SFT + Plan group
                                  function createSftFloorGroup(sectionId) {
    return `
        <div class="row sft-floor-group">
            <div class="col-lg-6 col-md-4 col-sm-6">
                <label>SFT</label>
                <input type="text" name="saleable_area_sft[${sectionId}][]" class="form-control" placeholder="SFT" />
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6">
                <label>Floor Plan</label>
                <input type="file" name="project_images_new[${sectionId}][]" class="form-control single-upload" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <button type="button" class="btn btn-danger remove-sft-floor">Remove</button>
            </div>
        </div>
    `;
}

                            
                                    // Function to duplicate the entire section
                                    function createConfigSection() {
                                        const newSectionId = sectionIndex++;
                                        return `
                                            <div class="form-section" data-section="${newSectionId}">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <label>No. of BHK</label>
                                                        <input type="text" name="no_of_bhk[]" class="form-control" placeholder="No. of BHK" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <label>Project Facing</label>
                                                        <input type="text" name="project_facing[]" class="form-control" placeholder="Project Facing" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <label>Carpet Area SFT</label>
                                                        <input type="text" name="carpet_area_sft[]" class="form-control" placeholder="Carpet Area SFT" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <label>Price</label>
                                                        <input type="text" name="price[]" class="form-control" placeholder="Price" />
                                                    </div>
                                                </div>
                                                <div class="sft-floor-group-wrapper">
                                                    ${createSftFloorGroup(newSectionId)}
                                                </div>
                                                <div class="text-center mb-2">
                                                    <button type="button" class="btn btn-success add-sft-floor" data-section="${newSectionId}">Add SFT + Plan</button>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12 text-center">
                                                        <button type="button" class="btn btn-primary add-config-section">Add</button>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        `;
                                    }
                            
                                    // Add a new section
                                    $(document).on("click", ".add-config-section", function () {
                                        $("#config-sections").append(createConfigSection());
                                    });
                            
                                    // Add a new SFT + Plan group
                                    $(document).on("click", ".add-sft-floor", function () {
                                        const sectionId = $(this).data("section");
                                        const wrapper = $(this).closest(".form-section").find(".sft-floor-group-wrapper");
                                        wrapper.append(createSftFloorGroup(sectionId));
                                    });
                            
                                    // Remove SFT + Plan group
                                    $(document).on("click", ".remove-sft-floor", function () {
                                        $(this).closest(".sft-floor-group").remove();
                                    });
                                });
                            </script>

                        <h6 class="mt-4">General Amenities</h6>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php   
                                // Fetch amenities from the database
                                $amenities_str = isset($project['amenities']) ? $project['amenities'] : '';

                                // Debugging: Output fetched data
                                echo "<!-- Debug: Fetched amenities: $amenities_str -->";

                                // Convert the amenities string into an array
                                $selected_amenities = (!empty($amenities_str)) ? array_map('trim', explode(",", $amenities_str)) : [];

                                // Debugging: Output array for verification
                                echo "<!-- Debug: Converted Amenities Array: " . json_encode($selected_amenities) . " -->";

                                // Define the list of all available amenities
                                $all_amenities = [
                                    "Swimming pool", "Terrace", "Air conditioning", "Internet", "Balcony", "Cable TV",
                                    "Computer", "Dishwasher", "Near Green Zone", "Near Church", "Near Estate", "Coffee pot"
                                ];

                                foreach ($all_amenities as $index => $amenity):
                                    // Check if the amenity exists in the fetched list
                                    $checked = in_array($amenity, $selected_amenities) ? 'checked' : '';

                                    // Debugging: Output checkbox status
                                    echo "<!-- Debug: Checking '$amenity' - " . (in_array($amenity, $selected_amenities) ? 'Found' : 'Not Found') . " -->";
                                ?>
                                    <div class="checkbox inlineblock m-r-20">
                                        <input id="checkbox<?= 100 + $index ?>" name="amenities[]" type="checkbox" 
                                            value="<?= htmlspecialchars($amenity) ?>" <?= $checked ?> />
                                        <label for="checkbox<?= 100 + $index ?>"><?= htmlspecialchars($amenity) ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div><br>
                        <h6 class="mt-4">BANKING INFORMATION</h6>
<div class="container-fluid mt-4">
    <div id="bank-form-container">
        <?php foreach ($selected_bank_names as $index => $selected_bank): ?>
            <div class="bank-form-section">
                <div class="row">
                    <!-- Bank Name Dropdown -->
                    <div class="col-lg-4 col-md-6">
                        <label>Bank Name</label>
                        <select class="form-control selectpicker show-tick" name="bank_name[]" required>
                            <option value="">-- CHOOSE BANK --</option>
                            <?php
                            $sql_bank = "SELECT bank_name FROM bank_details_table";
                            $result_bank = $conn->query($sql_bank);
                            if ($result_bank->num_rows > 0) {
                                while ($row = $result_bank->fetch_assoc()) {
                                    $bank_name = htmlspecialchars($row['bank_name']);
                                    $selected = ($bank_name == $selected_bank) ? "selected" : "";
                                    echo "<option value='$bank_name' $selected>$bank_name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Bank Document Upload -->
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="form-group">
                            <label for="bank-document" class="form-label">Upload Bank Document</label>
                            <input type="file" name="bank_document[]" class="form-control" />

                            <?php if (!empty($bank_documents[$index])): ?>
                                <div class="mt-2">
                                    <?php
                                    $doc_path = htmlspecialchars($bank_documents[$index]);
                                    $ext = pathinfo($doc_path, PATHINFO_EXTENSION);
                                    ?>
                                    <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])): ?>
                                        <img src="../admin_panel/<?= $doc_path ?>" alt="Bank Document" class="img-fluid rounded" 
                                            style="max-width: 150px; border: 1px solid #ccc; padding: 4px;" />
                                        <p class="text-muted small"><?= basename($doc_path) ?></p>
                                        <input type="hidden" name="existing_bank_document[]" value="<?= htmlspecialchars($bank_documents[$index] ?? '') ?>">

                                    <?php else: ?>
                                        <a href="<?= $doc_path ?>" target="_blank"><?= basename($doc_path) ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($index === array_key_last($selected_bank_names)): ?>
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary add-bank-section">Add</button>
                        <button type="button" class="btn btn-danger remove-bank-section d-none">Remove</button>
                    </div>
                </div>
            <?php endif; ?>
                            <hr>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <script>
                $(document).ready(function () {
                    $(document).on("click", ".add-bank-section", function () {
                        // Get the bank options from the first dropdown
                        let bankOptions = $(".bank-form-section:first select[name='bank_name[]']").html();
            
                        // Create a fresh new bank form section
                        let newBankSection = $('<div class="bank-form-section">' +
                            '<div class="row">' +
                                '<div class="col-lg-4 col-md-6">' +
                                    '<label>Bank Name</label>' +
                                    '<select class="form-control selectpicker show-tick" name="bank_name[]" required>' +
                                        bankOptions +
                                    '</select>' +
                                '</div>' +
                                '<div class="col-lg-4 col-md-4 col-sm-6">' +
                                    '<div class="form-group">' +
                                        '<label class="form-label">Upload Bank Documents</label>' +
                                        '<input type="file" name="bank_document[]" class="form-control" />' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="row mt-2">' +
                                '<div class="col-12 text-center">' +
                                    '<button type="button" class="btn btn-primary add-bank-section">Add</button> ' +
                                    '<button type="button" class="btn btn-danger remove-bank-section">Remove</button>' +
                                '</div>' +
                            '</div>' +
                            '<hr>' +
                        '</div>');
            
                        // Append the new section to the container
                        $("#bank-form-container").append(newBankSection);
            
                        // Reinitialize selectpicker on the new select
                        $('.selectpicker').selectpicker('refresh');
                    });
            
                    // Remove section logic
                    $(document).on("click", ".remove-bank-section", function () {
                        $(this).closest(".bank-form-section").remove();
                    });
                });
            </script>
                        <h6 class="mt-4">LOCALITY</h6>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <label>Property Address 1</label>
                                <div class="form-group">
                                    <textarea rows="4" name="property_address" class="form-control no-resize"><?= htmlspecialchars($project['property_address']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Property Address 2</label>
                                <div class="form-group">
                                    <textarea rows="4" name="property_address2" class="form-control no-resize"><?= htmlspecialchars($project['property_address2']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Locality-1</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality1" class="form-control no-resize"><?= htmlspecialchars($project['locality1']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 <label>Locality-2</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality2" class="form-control no-resize"><?= htmlspecialchars($project['locality2']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 <label>Locality-3</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality3" class="form-control no-resize"><?= htmlspecialchars($project['locality3']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 <label>Locality-4</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality4" class="form-control no-resize"><?= htmlspecialchars($project['locality4']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 <label>Locality-5</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality5" class="form-control no-resize"><?= htmlspecialchars($project['locality5']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-round">Submit</button>
                                <button type="submit" class="btn btn-default btn-round btn-simple" onclick="window.location.reload();">Cancel</button>
                            </div>
                        </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Function to get the 'id' parameter from the URL
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

document.getElementById("editProjectForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

document.querySelectorAll('.single-upload').forEach(function(input) {
    const index = input.dataset.index;  // Get the index from the input's dataset
    const existingInput = document.getElementById('existing_image_' + index);  // Existing image hidden input

    // Get the selected file
    const file = input.files[0];

    if (file && file.size > 0) {
        // If a new file is selected, remove the existing hidden input if present
        if (existingInput) {
            existingInput.remove();
        }
    } else {
        // No file selected, make sure to keep the hidden input for the existing image
        if (!existingInput) {
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "project_images_existing[" + input.dataset.index.split("_")[0] + "][]";
            hiddenInput.id = 'existing_image_' + index;
            hiddenInput.value = input.getAttribute('data-existing-image');
            input.closest('.sft-floor-group').appendChild(hiddenInput);
        }

        // We do NOT set the file input value to anything here because that causes the error.
        // Instead, let the backend know the existing image should be used via the hidden input.
    }
});


    let formData = new FormData(this);
// Display the form data in the console for debugging
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }
    // Get 'id' from the URL
    let projectId = getQueryParam("id");
    if (!projectId) {
        Swal.fire("Error", "Project ID not found in URL!", "error");
        return;
    }

    formData.append("id", projectId); // Fix: Use "id" instead of "project_id"

    // Show confirmation alert before proceeding
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to update this project?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, update it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("edit-project-post-code.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: "Success!",
                        text: "Project updated successfully!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = 'all-projects.php'; // Redirect to all-projects.php
                    });
                } else {
                    Swal.fire("Error", "Failed to update project: " + (data.error || "Unknown error"), "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error", "An error occurred while updating the project.", "error");
            });
        }
    });
});

</script>
<script>
    // Table 1 Functions
    function create_tr_table1() {
        let table_body = document.getElementById("table_body_1");
        let first_tr = table_body.firstElementChild;
        let tr_clone = first_tr.cloneNode(true);

        table_body.append(tr_clone);
        clean_first_tr_table1(table_body.firstElementChild);
    }

    function clean_first_tr_table1(firstTr) {
        let children = firstTr.children;
        children = Array.isArray(children) ? children : Object.values(children);
        children.forEach((x) => {
            if (x !== firstTr.lastElementChild) {
                x.firstElementChild.value = "";
            }
        });
    }

    function remove_tr_table1(This) {
        if (This.closest("tbody").childElementCount == 1) {
            alert("You Don't have Permission to Delete This ?");
        } else {
            This.closest("tr").remove();
        }
    }

    // Table 2 Functions
    function create_tr_table2() {
        let table_body = document.getElementById("table_body_2");
        let first_tr = table_body.firstElementChild;
        let tr_clone = first_tr.cloneNode(true);

        table_body.append(tr_clone);
        clean_first_tr_table2(table_body.firstElementChild);
    }

    function clean_first_tr_table2(firstTr) {
        let children = firstTr.children;
        children = Array.isArray(children) ? children : Object.values(children);
        children.forEach((x) => {
            if (x !== firstTr.lastElementChild) {
                x.firstElementChild.value = "";
            }
        });
    }

    function remove_tr_table2(This) {
        if (This.closest("tbody").childElementCount == 1) {
            alert("You Don't have Permission to Delete This ?");
        } else {
            This.closest("tr").remove();
        }
    }

    // Table 3 Functions
    function create_tr_table3() {
        let table_body = document.getElementById("table_body_3");
        let first_tr = table_body.firstElementChild;
        let tr_clone = first_tr.cloneNode(true);

        table_body.append(tr_clone);
        clean_first_tr_table3(table_body.firstElementChild);
    }

    function clean_first_tr_table3(firstTr) {
        let children = firstTr.children;
        children = Array.isArray(children) ? children : Object.values(children);
        children.forEach((x) => {
            if (x !== firstTr.lastElementChild) {
                x.firstElementChild.value = "";
            }
        });
    }

    function remove_tr_table3(This) {
        if (This.closest("tbody").childElementCount == 1) {
            alert("You Don't have Permission to Delete This ?");
        } else {
            This.closest("tr").remove();
        }
    }
    // Table 4 Functions
    function create_tr_table4() {
        let table_body = document.getElementById("table_body_4");
        let first_tr = table_body.firstElementChild;
        let tr_clone = first_tr.cloneNode(true);

        table_body.append(tr_clone);
        clean_first_tr_table4(table_body.firstElementChild);
    }

    function clean_first_tr_table4(firstTr) {
        let children = firstTr.children;
        children = Array.isArray(children) ? children : Object.values(children);
        children.forEach((x) => {
            if (x !== firstTr.lastElementChild) {
                x.firstElementChild.value = "";
            }
        });
    }

    function remove_tr_table4(This) {
        if (This.closest("tbody").childElementCount == 1) {
            alert("You Don't have Permission to Delete This ?");
        } else {
            This.closest("tr").remove();
        }
    }

    // Table 5 Functions
    function create_tr_table5() {
        let table_body = document.getElementById("table_body_5");
        let first_tr = table_body.firstElementChild;
        let tr_clone = first_tr.cloneNode(true);

        table_body.append(tr_clone);
        clean_first_tr_table5(table_body.firstElementChild);
    }

    function clean_first_tr_table5(firstTr) {
        let children = firstTr.children;
        children = Array.isArray(children) ? children : Object.values(children);
        children.forEach((x) => {
            if (x !== firstTr.lastElementChild) {
                x.firstElementChild.value = "";
            }
        });
    }

    function remove_tr_table5(This) {
        if (This.closest("tbody").childElementCount == 1) {
            alert("You Don't have Permission to Delete This ?");
        } else {
            This.closest("tr").remove();
        }
    }

    // Add similar functions for Table 4 and Table 5
</script>

<style>
    .intl-tel-input {
        position: relative;
        border-color: #e3e4e9;
        width: 100%;
    }
</style>
<?php include('includes/footer.php'); ?>

