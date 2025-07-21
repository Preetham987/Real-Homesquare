<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Property Add
                </h2>
            </div> 
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form id="projectForm" method="POST" action="property-add-post-code.php" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                            <label>Property Type</label>
                                <div class="form-group">
                                    <input type="text" name="property_type" class="form-control" placeholder="Ex: 3BKS Villa">
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label>Size</label>
                                <div class="form-group">
                                    <input type="text" name="size" class="form-control" placeholder="Ex: 4000 Sq.Ft">
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-4">Property Information</h6>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="radio inlineblock m-r-20">
                                    <input id="radio21" name="configurations" type="radio" value="For Sale">
                                    <label for="radio21">For Sale</label>
                                </div>
                                <div class="radio inlineblock m-r-20">
                                    <input id="radio22" name="configurations" type="radio" value="For Rent">
                                    <label for="radio22">For Rent</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control" placeholder="Price">
                                </div>
                            </div>                            
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="bedrooms" class="form-control" placeholder="Bedrooms">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="car_parking" class="form-control" placeholder="Car Parking">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="year_built" class="form-control" placeholder="Year Built">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea rows="4" name="property_address" class="form-control no-resize" placeholder="Property Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-4">Dimensions</h6>
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input type="text" name="dining_room" class="form-control" placeholder="Dining Room">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input type="text" name="kitchen" class="form-control" placeholder="Kitchen">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input type="text" name="living_room" class="form-control" placeholder="Living Room">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="master_bedroom" class="form-control" placeholder="Master Bedroom">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="bedroom2" class="form-control" placeholder="Bedroom 2">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="other_room" class="form-control" placeholder="Other Room">
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-4">General Amenities</h6>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity1" name="amenities[]" type="checkbox" value="Swimming pool">
                                    <label for="amenity1">Swimming pool</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity2" name="amenities[]" type="checkbox" value="Terrace">
                                    <label for="amenity2">Terrace</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity3" name="amenities[]" type="checkbox" value="Air conditioning">
                                    <label for="amenity3">Air conditioning</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity4" name="amenities[]" type="checkbox" value="Internet">
                                    <label for="amenity4">Internet</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity5" name="amenities[]" type="checkbox" value="Balcony">
                                    <label for="amenity5">Balcony</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity6" name="amenities[]" type="checkbox" value="Cable TV">
                                    <label for="amenity6">Cable TV</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity7" name="amenities[]" type="checkbox" value="Computer">
                                    <label for="amenity7">Computer</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity8" name="amenities[]" type="checkbox" value="Dishwasher">
                                    <label for="amenity8">Dishwasher</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity9" name="amenities[]" type="checkbox" value="Near Green Zone">
                                    <label for="amenity9">Near Green Zone</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity10" name="amenities[]" type="checkbox" value="Near Church">
                                    <label for="amenity10">Near Church</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity11" name="amenities[]" type="checkbox" value="Near Estate">
                                    <label for="amenity11">Near Estate</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input id="amenity12" name="amenities[]" type="checkbox" value="Coffee pot">
                                    <label for="amenity12">Coffee pot</label>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card" style="background-color: #eee;">
                                            <div class="header">
                                                <h2><strong>File Upload</strong> Drag & Drop OR With Click & Choose</h2>
                                            </div>
                                            <div class="body" style="background-color: #fff !important;">
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea rows="4" name="property_address2" class="form-control no-resize" placeholder="Property Address"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-round">Submit</button>
                                <button type="submit" class="btn btn-default btn-round btn-simple">Cancel</button>
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
document.getElementById("projectForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    fetch("property-add-post-code.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: "Success!",
                text: "Property added successfully",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.reload(); // Reload page or redirect
            });
        } else {
            Swal.fire({
                title: "Error!",
                text: "Failed to add property: " + data.error,
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: "Error!",
            text: "Something went wrong!",
            icon: "error",
            confirmButtonText: "OK"
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
