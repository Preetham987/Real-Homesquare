<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Enter your Bank Details
                    <!--<small>Welcome to Oreo</small>-->
                </h2>
            </div>          
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form id="bankForm" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Choose Bank Logo</label>
                                    <div class="form-group">
                                        <input type="file" name="bank_logo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Choose Bank Name</label>
                                    <div class="form-group">
                                        <input type="text" name="bank_name" class="form-control" placeholder="Enter your Bank Name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Rate of Interest</label>
                                    <div class="form-group">
                                        <input type="number" step="0.01" name="rate_of_interest" class="form-control" placeholder="Enter your rate of interest">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Total Offers</label>
                                    <div class="form-group">
                                        <input type="number" name="total_offers" class="form-control" placeholder="Enter the number of offers">
                                    </div>
                                </div>
                            </div>                      
                            <div class="row clearfix">                                                   
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Submit</button>
                                   
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
    document.getElementById("bankForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData(this); // Collect form data

        fetch("create-bank-details-post-code.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "create-bank-details.php";
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
        .catch(error => console.error("Error:", error));
    });
});
</script>

<?php include('includes/footer.php'); ?>
