<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Services</h2>
            </div>                     
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form id="serviceForm" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Service Name</label>
                                    <div class="form-group">
                                        <input type="text" name="service_name" class="form-control" placeholder="Ex: Home Loan" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <input type="text" name="description" class="form-control" placeholder="Ex: Description" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Service Link</label>
                                    <div class="form-group">
                                        <input type="text" name="service_link" class="form-control" placeholder="Enter your Service Link" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Service Image</label>
                                   <div class="form-group">
                                        <input type="file" name="service_image" class="form-control" id="serviceImage" accept="image/*" required>
                                        <small class="text-danger" id="fileError"></small>
                                    </div>
                                </div>
                            </div>                        
                            <div class="row clearfix">                           
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Add Service</button>
                                    
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
document.getElementById("serviceImage").addEventListener("change", function() {
    const file = this.files[0];
    const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if (file) {
        if (!allowedTypes.includes(file.type)) {
            document.getElementById("fileError").textContent = "Only JPG, PNG, GIF, or WEBP images are allowed.";
            this.value = "";
        } else {
            document.getElementById("fileError").textContent = "";
        }
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("serviceForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent normal form submission

        let formData = new FormData(this); // Collect form data

        fetch("create-services-post-code.php", {
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
