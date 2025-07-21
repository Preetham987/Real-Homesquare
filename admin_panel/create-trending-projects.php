<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Trending Projects</h2>
            </div>            
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <!--<h2><strong>Basic</strong> Information <small>Fill in the details below...</small></h2>-->
                    </div>
                    <div class="body">
                        <form id="trendingProjectForm" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Project Name</label>
                                    <div class="form-group">
                                        <input type="text" name="project_name" class="form-control" placeholder="Ex: 40 Journal Square, Marathahalli, Bangalore" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Location</label>
                                    <div class="form-group">
                                        <input type="text" name="location" class="form-control" placeholder="Ex: RRL Builders And Developers Pvt Ltd" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Area/Size</label>
                                    <div class="form-group">
                                        <input type="text" name="area_size" class="form-control" placeholder="Ex: 3000 ft²" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Price</label>
                                    <div class="form-group">
                                        <input type="text" name="price" class="form-control" placeholder="Ex: 1.2cr" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Project Images (JPG, JPEG, PNG only)</label>
                                    <div class="form-group">
                                        <input type="file" name="project_image" id="projectImage" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                                    </div>
                                </div>
                            </div>                        
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Create</button>
                                   
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
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("trendingProjectForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent normal form submission

        let formData = new FormData(this); // Collect form data

        fetch("create-trending-projects-post-code.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.reload(); // Reload the page to clear the form
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: data.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: "Error!",
                text: "Something went wrong. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
