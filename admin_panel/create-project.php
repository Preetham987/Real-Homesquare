<?php include('includes/header.php'); ?>
<?php
include 'includes/db.php'; // Include your database connection file

// Fetch builder names from builders_table
$builder_options = "";
$sql_builder = "SELECT builder_name FROM builders_table";
$result_builder = $conn->query($sql_builder);

if ($result_builder->num_rows > 0) {
    while ($row = $result_builder->fetch_assoc()) {
        $builder_name = htmlspecialchars($row['builder_name']); // Prevent XSS attacks
        $builder_options .= "<option value='$builder_name'>$builder_name</option>";
    }
}

// Fetch bank names from bank_details_table
$bank_options = "";
$sql_bank = "SELECT bank_name FROM bank_details_table";
$result_bank = $conn->query($sql_bank);

if ($result_bank->num_rows > 0) {
    while ($row = $result_bank->fetch_assoc()) {
        $bank_name = htmlspecialchars($row['bank_name']); // Prevent XSS attacks
        $bank_options .= "<option value='$bank_name'>$bank_name</option>";
    }
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Property Add
                    <!--<small>Welcome to Oreo</small>-->
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Property Information</strong></h2>
                    </div>
                    <div class="body">
                        <div class="card">
                            <form id="projectForm" method="POST" action="create-project-post-code.php" enctype="multipart/form-data">
                                <section>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6">
                                            <label>Builder Name</label>
                                            <select class="form-control show-tick" name="builder_name" required>
                                                <option value="">-- CHOOSE BUILDER --</option>
                                                <?php echo $builder_options; ?>
                                            </select>
                                        </div>
                                    <div class="col-sm-6">
                                        <label>Project Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="project_name" placeholder="PROJECT NAME" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Configurations: </label>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox1" name="configurations[]" type="checkbox" value="Studio Room">
                                            <label for="checkbox1">Studio Room</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox2" name="configurations[]" type="checkbox" value="1BHK">
                                            <label for="checkbox2">1BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox3" name="configurations[]" type="checkbox" value="1.5BHK">
                                            <label for="checkbox3">1.5BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox4" name="configurations[]" type="checkbox" value="2BHK">
                                            <label for="checkbox4">2BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox5" name="configurations[]" type="checkbox" value="2.5BHK">
                                            <label for="checkbox5">2.5BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox6" name="configurations[]" type="checkbox" value="3BHK">
                                            <label for="checkbox6">3BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox7" name="configurations[]" type="checkbox" value="3.5BHK">
                                            <label for="checkbox7">3.5BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox8" name="configurations[]" type="checkbox" value="4BHK">
                                            <label for="checkbox8">4BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox9" name="configurations[]" type="checkbox" value="4.5BHK">
                                            <label for="checkbox9">4.5BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox10" name="configurations[]" type="checkbox" value="5BHK">
                                            <label for="checkbox10">5BHK</label>
                                        </div>
                                        <div class="checkbox inlineblock m-r-20">
                                            <input id="checkbox11" name="configurations[]" type="checkbox" value="5+ BHK">
                                            <label for="checkbox11">5+ BHK</label>
                                        </div>
                                    </div><br>
                                    <div class="col-lg-4 col-md-6">
                                        <label>Project Type</label>
                                        <select class="form-control show-tick" name="project_type" required>
                                            <option value="">-- PROJECT TYPE --</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Apartment">Apartment</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label>Contruction Status</label>
                                        <select class="form-control show-tick" name="construction_status" required>
                                            <option value="">-- CONSTRUCTION STATUS --</option>
                                            <option value="Pre-Launch">Pre-Lounch</option>
                                            <option value="Under Construction">Under Construction</option>
                                            <option value="Ready to Move">Ready to Move</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Project Location</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="PROJECT LOCATION" name="project_location" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Number Of Units</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="NUMBER OF UNITS" name="no_of_units" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Project Link</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="project_link" placeholder="Enter your Project Link" />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Project Area</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="PROJECT AREA Ex: 2 Acr" name="project_area" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Project Size</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="project_size" placeholder="Enter your Project Size" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Project Launch</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="PROJECT LAUNCH" name="project_launch" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Possesion Starts</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="POSSESSION STARTS" name="possesion_start_date" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Min. Area SFT</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="MIN AREA (SFT)" name="min_area_sft" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Max. Area SFT</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="MAX AREA (SFT)" name="max_area_sft" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Min. Price</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="MIN PRICE" name="min_price" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Max. Price</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="MAX PRICE" name="max_price" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Rera ID</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="RERA ID" name="rera_id" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Conatact Email ID</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="CONTACT EMAIL ID" name="contact_email" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Contact Mobile</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="CONTACT MOBILE" name="contact_mobile" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Validity</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="VALIDITY" name="validity" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Add Banner Images</label>
                                        <div class="form-group">
                                            <label>Main Banner Image (720x405)</label>
                                            <input type="file" class="form-control" id="bannerImage" name="banner_image" accept="image/*"/><br>
                                            <label>Side Banner Image</label>
                                            <input type="file" class="form-control" id="sideImage" name="side_image[]" accept="image/*" multiple/>
                                            <small id="imageError" style="color: red; display: none;">Image must be exactly 720×405 pixels.</small>
                                        </div>
                                    </div>
                                    <script>
                                        const bannerInput = document.getElementById("bannerImage");
                                        const errorElement = document.getElementById("imageError");
                                    
                                        bannerInput.addEventListener("change", function () {
                                            const file = this.files[0];
                                            errorElement.style.display = "none";
                                    
                                            if (file) {
                                                const img = new Image();
                                                img.onload = function () {
                                                    if (img.width !== 720 || img.height !== 405) {
                                                        // Invalid size – reject upload
                                                        errorElement.style.display = "block";
                                                        bannerInput.value = ""; // Clear the file input
                                                    }
                                                };
                                                img.onerror = function () {
                                                    errorElement.textContent = "Invalid image file.";
                                                    errorElement.style.display = "block";
                                                    bannerInput.value = "";
                                                };
                                                img.src = URL.createObjectURL(file);
                                            }
                                        });
                                    </script>
                                </div>
                                <h6 class="mt-4">Project Overview</h6>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control no-resize" name="project_overview" placeholder="Property Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-round" onclick="showAddMoreButton()">Submit</button>
                            
                                    <button id="add-more-button" type="button" class="btn btn-secondary btn-round" style="display: none;" onclick="toggleProjectSection()">Add More</button>
                                </section>
                            </form>
                        </div>
                    </div>
                    <script>
                        let lastInsertedProjectId = null;

                        document.getElementById("projectForm").addEventListener("submit", function(event) {
                            event.preventDefault(); // Prevent default form submission

                            let formData = new FormData(this);

                            fetch("create-project-post-code.php", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) { 
                                    lastInsertedProjectId = data.last_id; // Store the last inserted ID
                                    console.log("Last inserted project ID:", lastInsertedProjectId);

                                    // Show success message with SweetAlert
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Project Created!',
                                        text: 'Your project has been successfully created.',
                                        timer: 1000, // 2 seconds
                                        showConfirmButton: false
                                    });

                                    // Show Add More button
                                    document.getElementById("add-more-button").style.display = "inline-block";
                                } else {
                                    console.error("Error:", data.error);
                                }
                            })
                            .catch(error => console.error("Error:", error));
                        });

                        function toggleProjectSection() {
                            if (lastInsertedProjectId) {
                                console.log("Using last inserted project ID:", lastInsertedProjectId);
                            } else {
                                console.warn("No project ID found. Please submit a project first.");
                            }
                        }
                    </script>
                    <div id="hidden-project-section" class="body" style="display: none;">
                        <form action="update-project-post-code.php" id="updateProjectForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="project_id" id="project_id" value="<?php echo $last_id; ?>">
                        
                        <h6 class="mt-4">CONFIGURATIONS</h6>
                        <div class="container-fluid mt-4">
                            <div id="form-container"></div>
                        </div>
                        
                        <!-- Add Initial Button Outside (optional) -->
                        <div class="text-center">
                            <!--<button type="button" class="btn btn-primary add-config-section">Add Configuration</button>-->
                        </div>

                        <script>
                        $(document).ready(function () {
                            let sectionIndex = 0;
                        
                            function createConfigSection(isDuplicate = false) {
                                const sectionId = sectionIndex++;
                                let removeButton = isDuplicate
                                    ? '<button type="button" class="btn btn-danger remove-config-section">Remove</button>'
                                    : '';
                        
                                return $(`
                                    <div class="form-section" data-section="${sectionId}">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <label>No. Of BHK</label>
                                                <input type="text" name="no_of_bhk[]" class="form-control" placeholder="NO. OF BHK:" />
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <label>Project Facing</label>
                                                <input type="text" name="project_facing[]" class="form-control" placeholder="PROJECT FACING:" />
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <label>Carpet Area SFT</label>
                                                <input type="number" name="carpet_area_sft[]" class="form-control" placeholder="CARPET AREA (SFT):" />
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <label>Price</label>
                                                <input type="number" name="price[]" class="form-control" placeholder="PRICE:" />
                                            </div>
                                        </div>
                        
                                        <div class="sft-floor-group-wrapper">
                                            ${createSftFloorGroup(sectionId, true)}
                                        </div>
                        
                                        <div class="text-center mb-2">
                                            <button type="button" class="btn btn-success add-sft-floor" data-section="${sectionId}">Add SFT + Plan</button>
                                        </div>
                        
                                        <div class="row mt-2">
                                            <div class="col-12 text-center">
                                                <button type="button" class="btn btn-primary add-config-section">Add</button>
                                                ${removeButton}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                `);
                            }
                        
                            function createSftFloorGroup(sectionId, isInitial = false) {
                                let removeBtnClass = isInitial ? "d-none" : "";
                                return `
                                    <div class="row sft-floor-group">
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label>SFT</label>
                                            <input type="number" name="saleable_area_sft_grouped[${sectionId}][]" class="form-control" placeholder="SALEABLE AREA (SFT):" />
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label>Floor Plan</label>
                                            <input type="file" name="project_images[${sectionId}][]" class="form-control" />
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 align-self-end">
                                            <button type="button" class="btn btn-danger remove-sft-floor ${removeBtnClass}">Remove</button>
                                        </div>
                                    </div>
                                `;
                            }
                        
                            $("#form-container").append(createConfigSection(false));
                        
                            $(document).on("click", ".add-config-section", function () {
                                $("#form-container").append(createConfigSection(true));
                            });
                        
                            $(document).on("click", ".remove-config-section", function () {
                                $(this).closest(".form-section").remove();
                            });
                        
                            $(document).on("click", ".add-sft-floor", function () {
                                const sectionId = $(this).data("section");
                                const $wrapper = $(this).closest(".form-section").find(".sft-floor-group-wrapper");
                                $wrapper.append(createSftFloorGroup(sectionId, false));
                            });
                        
                            $(document).on("click", ".remove-sft-floor", function () {
                                $(this).closest(".sft-floor-group").remove();
                            });
                        });
                        </script>

                        <h6 class="mt-4">General Amenities</h6>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox21" name="amenities[]" type="checkbox" value="Swimming pool" />
                                    <label for="checkbox21">Swimming pool</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox22" name="amenities[]" type="checkbox" value="Terrace" />
                                    <label for="checkbox22">Terrace</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox23" name="amenities[]" type="checkbox" value="Air conditioning"/>
                                    <label for="checkbox23">Air conditioning</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox24" name="amenities[]" type="checkbox" value="Internet" />
                                    <label for="checkbox24">Internet</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox25" name="amenities[]" type="checkbox" value="Balcony" />
                                    <label for="checkbox25">Balcony</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox26" name="amenities[]" type="checkbox" value="Cable TV" />
                                    <label for="checkbox26">Cable TV</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox27" name="amenities[]" type="checkbox" value="Computer" />
                                    <label for="checkbox27">Computer</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox28" name="amenities[]" type="checkbox" value="Dishwasher" />
                                    <label for="checkbox28">Dishwasher</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox29" name="amenities[]" type="checkbox" value="Near Green Zone" />
                                    <label for="checkbox29">Near Green Zone</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox30" name="amenities[]" type="checkbox" value="Near Chruch" />
                                    <label for="checkbox30">Near Church</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox31" name="amenities[]" type="checkbox" value="Near Estate" />
                                    <label for="checkbox31">Near Estate</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="checkbox32" name="amenities[]" type="checkbox" value="Coffee pot" />
                                    <label for="checkbox32">Coffee pot</label>
                                </div>
                            </div>
                        </div><br>
                        <h6 class="mt-4">BANKING INFORMATION</h6>
                        <div class="container-fluid mt-4">
                            <div id="bank-form-container">
                                <div class="bank-form-section">
                                    <div class="row">
                                        <!-- Bank Name Dropdown -->
                                        <div class="col-lg-4 col-md-6">
                                            <label>Bank Name</label>
                                            <select class="form-control selectpicker show-tick" name="bank_name[]" required>
                                                <option value="">-- CHOOSE BANK --</option>
                                                <?php echo $bank_options; ?>
                                            </select>
                                        </div>
                                        
                                        <!-- Bank Document Upload -->
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="bank-document" class="form-label">Upload Bank Documents</label>
                                                <input type="file" name="bank_document[]" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="row mt-2">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-primary add-bank-section">Add</button>
                                            <button type="button" class="btn btn-danger remove-bank-section d-none">Remove</button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
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
                                                '<select class="form-control show-tick" name="bank_name[]" required>' +
                                                    bankOptions +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="col-lg-3 col-md-4 col-sm-6">' +
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
                                <label>Property Address</label>
                                <div class="form-group">
                                    <textarea rows="4" name="property_address" class="form-control no-resize" placeholder="Enter your Property Address"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Property Address</label>
                                <div class="form-group">
                                    <textarea rows="4" name="property_address2" class="form-control no-resize" placeholder="Enter your Property Address"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Locality-1</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality1" class="form-control no-resize" placeholder="Enter Locality1"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Locality-2</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality2" class="form-control no-resize" placeholder="Enter Locality2"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Locality-3</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality3" class="form-control no-resize" placeholder="Enter Locality3"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Locality-4</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality4" class="form-control no-resize" placeholder="Enter Locality4"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Locality-5</label>
                                <div class="form-group">
                                    <textarea rows="4" name="locality5" class="form-control no-resize" placeholder="Enter Locality5"></textarea>
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
</section>
<script>
document.getElementById("bannerImage").addEventListener("change", function() {
    const file = this.files[0];
    const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if (file) {
        if (!allowedTypes.includes(file.type)) {
            document.getElementById("fileError").textContent = "Only JPG, PNG, GIF, or WEBP images are allowed.";
            this.value = "";
            return;
        }

        // Clear error message if valid
        document.getElementById("fileError").textContent = "";
    }
});
</script>
<script>
document.getElementById("updateProjectForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    // Retrieve lastInsertedProjectId if it's missing (fallback)
    if (typeof lastInsertedProjectId === "undefined" || !lastInsertedProjectId) {
        lastInsertedProjectId = localStorage.getItem("lastInsertedProjectId") || null;
    }

    // Ensure lastInsertedProjectId exists
    if (lastInsertedProjectId) {
        formData.append("lastInsertedProjectId", lastInsertedProjectId);
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Project ID Missing!',
            text: 'Please create a project first before updating.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Convert required fields to comma-separated values
    const fieldsToStoreAsArray = [
        "no_of_bhk[]",
        "project_facing[]",
        "saleable_area_sft[]",
        "carpet_area_sft[]",
        "price[]"
    ];

    fieldsToStoreAsArray.forEach(fieldName => {
        let values = Array.from(document.getElementsByName(fieldName))
                          .map(input => input.value.trim())
                          .filter(value => value !== ""); // Remove empty values

        formData.set(fieldName.replace("[]", ""), values.join(",")); // Convert array to comma-separated string
    });

    // Debugging: Check what is being sent
    console.log("Submitting Form Data:", [...formData.entries()]);
    console.log("Last Inserted Project ID:", lastInsertedProjectId);

    fetch("update-project-post-code.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Project updated successfully:", data.message);

            Swal.fire({
                icon: 'success',
                title: 'Project Updated!',
                text: 'Your project has been successfully updated.',
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload(); // Reload the page when "OK" is clicked
            });

        } else {
            console.error("Update failed:", data.error);
            Swal.fire({
                icon: 'error',
                title: 'Update Failed!',
                text: data.error || 'An unknown error occurred.',
                confirmButtonText: 'Try Again'
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error Occurred!',
            text: 'Something went wrong. Please try again.',
            confirmButtonText: 'OK'
        });
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

<script>
function showAddMoreButton() {
    // Display the "Add More" button when Submit is clicked
    const addMoreButton = document.getElementById('add-more-button');
    addMoreButton.style.display = 'block';
}

function toggleProjectSection() {
    // Toggle visibility of the hidden project section
    const projectSection = document.getElementById('hidden-project-section');
    projectSection.style.display = projectSection.style.display === 'none' ? 'block' : 'none';
}
</script>
<style>
    .intl-tel-input {
        position: relative;
        border-color: #e3e4e9;
        width: 100%;
    }
</style>
<?php include('includes/footer.php'); ?>
