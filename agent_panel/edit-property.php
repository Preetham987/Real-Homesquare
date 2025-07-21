<?php 
include('includes/header.php');
include('includes/db.php');

// Get project ID from URL
if (isset($_GET['id'])) {
    $project_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch project data from database
    $query = "SELECT * FROM agent_panel_projects_table WHERE id = '$project_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $project = mysqli_fetch_assoc($result);
        $configuration = $project['configuration'];
    } else {
        echo "<script>alert('Project not found!'); window.location.href='all-projects.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='all-projects.php';</script>";
    exit;
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Property
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form id="editProjectForm" method="POST" action="edit-property-post-code.php" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                            <label>Property Type</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="property_type" value="<?= htmlspecialchars($project['property_type']) ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>Size</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="size" value="<?= htmlspecialchars($project['size']) ?>">
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-4">Property Information</h6>
                        <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="radio inlineblock m-r-20">
                                <input id="radio21" name="configuration" type="radio" value="For Sale" 
                                    <?php if ($configuration === "For Sale") echo 'checked'; ?>>
                                <label for="radio21">For Sale</label>
                            </div>
                            <div class="radio inlineblock m-r-20">
                                <input id="radio22" name="configuration" type="radio" value="For Rent" 
                                    <?php if ($configuration === "For Rent") echo 'checked'; ?>>
                                <label for="radio22">For Rent</label>
                            </div>
                        </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="price" value="<?= htmlspecialchars($project['price']) ?>">
                                </div>
                            </div>                            
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="bedrooms" value="<?= htmlspecialchars($project['bedrooms']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="car_parking" value="<?= htmlspecialchars($project['car_parking']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="year_built" value="<?= htmlspecialchars($project['year_built']) ?>">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea rows="4" class="form-control no-resize" name="property_address" placeholder="Property Address"><?= htmlspecialchars($project['property_address']) ?></textarea>
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-4">Dimensions</h6>
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="dining_room" value="<?= htmlspecialchars($project['dining_room']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="kitchen" value="<?= htmlspecialchars($project['kitchen']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="living_room" value="<?= htmlspecialchars($project['living_room']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="master_bedroom" value="<?= htmlspecialchars($project['master_bedroom']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="bedroom2" value="<?= htmlspecialchars($project['bedroom2']) ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="other_room" value="<?= htmlspecialchars($project['other_room']) ?>">
                                </div>
                            </div>
                        </div>
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
                        </div>
                        <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2><strong>PROJECT IMAGES</strong></h2>
                            </div>
                            <div class="container-fluid">
                                <!-- File Upload -->
                                <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card" style="background-color: #eee;">
                                        <div class="header">
                                            <h2><strong>File Upload</strong> Drag & Drop OR With Click & Choose</h2>
                                        </div>
                                        <div class="body" style="background-color: #fff !important;">
                                        <?php if (!empty($project['project_images'])): ?>
                                                <div class="text-center mb-3">
                                                    <!-- Display Image -->
                                                    <img src="<?= htmlspecialchars($project['project_images']) ?>" 
                                                        alt="Project Banner" 
                                                        class="img-fluid rounded" 
                                                        style="max-width: 300px; height: auto; border: 1px solid #ddd; padding: 5px;">

                                                    <!-- Display File Name -->
                                                    <p class="mt-2 text-muted">
                                                        <?= basename(htmlspecialchars($project['project_images'])) ?>
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="dz-message">
                                                <div class="drag-icon-cph"><i class="material-icons">touch_app</i></div>
                                                <h3>Drop files here or click to upload.</h3>
                                                <em>(Selected files are <strong>actually</strong> uploaded.)</em>
                                            </div>
                                            <div class="fallback">
                                                <input name="project_images[]" type="file" multiple />
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                             <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea rows="4" class="form-control no-resize" name="property_address2" placeholder="Property Address"><?= htmlspecialchars($project['property_address2']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-round">Update</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Function to get query parameters from the URL
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    let form = document.getElementById("editProjectForm");

    if (!form) {
        console.error("Error: Form with ID 'editProjectForm' not found.");
        return;
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);
        let projectId = getQueryParam("id");

        if (!projectId) {
            Swal.fire("Error", "Project ID not found in URL!", "error");
            return;
        }

        formData.append("id", projectId);

        // SweetAlert confirmation
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to update this project?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("edit-property-post-code.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json()) // Convert response to JSON
                .then(data => {
                    console.log("Server Response:", data); // Debugging

                    if (data.success) {
                        Swal.fire({
                            title: "Success!",
                            text: "Project updated successfully!",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "property-list.php";
                        });
                    } else {
                        Swal.fire("Error", "Failed to update project: " + (data.error || "Unknown error"), "error");
                    }
                })
                .catch(error => {
                    console.error("Fetch Error:", error);
                    Swal.fire("Error", "An error occurred while updating the project.", "error");
                });
            }
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
