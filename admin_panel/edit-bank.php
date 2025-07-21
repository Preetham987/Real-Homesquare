<?php
include('includes/header.php');
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM customer_bank_details WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>window.location.href = 'all-bank-details.php';</script>";
    exit;
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Bank Details</h2>
            </div>            
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Bank</strong> Information</h2>
                    </div>
                    <div class="body">
                        <form id="editBankForm">
                            <input type="hidden" id="bank_id" name="id" value="<?= $row['id']; ?>">

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Bank Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="bank_name" value="<?= htmlspecialchars($row['bank_name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Branch Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="branch_name" value="<?= htmlspecialchars($row['branch_name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>IFSC Code</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ifsc_code" value="<?= htmlspecialchars($row['ifsc_code']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Account Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="account_number" value="<?= htmlspecialchars($row['account_number']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Account Holder Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="account_holder_name" value="<?= htmlspecialchars($row['account_holder_name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Bank Address</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="bank_address" value="<?= htmlspecialchars($row['bank_address']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Contact Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contact_number" value="<?= htmlspecialchars($row['contact_number']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email Address</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email_address" value="<?= htmlspecialchars($row['email_address']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary btn-round" id="updateBankBtn">Update</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include SweetAlert & jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $("#updateBankBtn").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to update these details?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!"
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = $("#editBankForm").serialize(); // Serialize form data

                $.ajax({
                    url: "edit-bank-post-code.php",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        try {
                            let res = JSON.parse(response.trim());
                            if (res.status === "success") {
                                Swal.fire({
                                    title: "Updated!",
                                    text: res.message,
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    window.location.href = "all-bank-details.php";
                                });
                            } else {
                                Swal.fire("Error!", res.message || "Failed to update.", "error");
                            }
                        } catch (e) {
                            Swal.fire("Error!", "Invalid JSON response.", "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                });
            }
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
