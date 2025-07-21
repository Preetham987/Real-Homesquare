<?php
include('includes/header.php');
include('includes/db.php');

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];
    $query = "SELECT * FROM services_table WHERE id = $service_id";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);
} else {
    echo "<script>window.location.href='all-services.php';</script>"; // Redirect if no ID is provided
    exit();
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Service</h2>
            </div>            
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <!--<h2><strong>Basic</strong> Information <small>Update service details</small></h2>-->
                    </div>
                    <div class="body">
                        <form id="editServiceForm" enctype="multipart/form-data">
                            <input type="hidden" name="service_id" value="<?= $service['id']; ?>">

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Service Name</label>
                                    <div class="form-group">
                                        <input type="text" name="service_name" class="form-control" value="<?= htmlspecialchars($service['service_name']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($service['description']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Service Link</label>
                                    <div class="form-group">
                                        <input type="text" name="service_link" class="form-control" value="<?= htmlspecialchars($service['service_link']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <label>Service Image</label>
                                   <div class="form-group">
                                        <input type="file" name="service_image" class="form-control" id="serviceImage" accept="image/*">
                                        <small class="text-danger" id="fileError"></small>
                                        <img src="<?= $service['service_image']; ?>" style="width:100px; margin-top:10px;" id="previewImage">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
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
document.getElementById("serviceImage").addEventListener("change", function() {
    const file = this.files[0];
    const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if (file) {
        if (!allowedTypes.includes(file.type)) {
            document.getElementById("fileError").textContent = "Only JPG, PNG, GIF, or WEBP images are allowed.";
            this.value = "";
            return;
        }
        
        // Clear error message
        document.getElementById("fileError").textContent = "";

        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("previewImage").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("editServiceForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent normal form submission

        let formData = new FormData(this); // Collect form data

        fetch("edit-services-post-code.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    title: "Updated!",
                    text: data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "all-services.php"; // Redirect to services list
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
