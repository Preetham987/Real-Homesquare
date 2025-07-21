<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Add Bank Details</h2>
            </div>            
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <!--<h2><strong>Basic</strong> Information <small>Fill in the details below.</small></h2>-->
                    </div>
                    <div class="body">
                        <form id="bankDetailsForm">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Bank Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="bank_name" placeholder="Ex: State Bank of India" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Branch Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="branch_name" placeholder="Ex: Nariman Point" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>IFSC Code</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ifsc_code" placeholder="Ex: SBIN0001234" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Account Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="account_number" placeholder="Ex: 123456789012" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Account Holder Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="account_holder_name" placeholder="Ex: ABC Realtors Pvt Ltd" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Bank Address</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="bank_address" placeholder="Ex: 123 Marine Drive, Mumbai" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Contact Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contact_number" placeholder="Ex: 91-0000000" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email Address</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email_address" placeholder="Ex: branch.sbi@example.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Add Bank</button>
                                   
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
document.getElementById("bankDetailsForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent normal form submission

    let form = event.target;
    let formData = new FormData(form);

    fetch("add-bank-details-post-code.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.status === "success") {
            Swal.fire({
                title: "Success!",
                text: "Bank details added successfully.",
                icon: "success"
            }).then(() => {
                form.reset(); // Clear the form after success
            });
        } else {
            Swal.fire({
                title: "Error!",
                text: data.message || "Something went wrong.",
                icon: "error"
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
</script>

<?php include('includes/footer.php'); ?>
