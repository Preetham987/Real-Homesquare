<?php 
include('includes/header.php'); 
include('includes/db.php'); 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch bank details
    $query = "SELECT * FROM bank_details_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $bankLogo = $row['bank_logo'];
        $bankName = $row['bank_name'];
        $rateOfInterest = $row['rate_of_interest'];
        $totalOffers = $row['total_offers'];
        $uploadedFile = $row['uploaded_file'];
    } else {
        echo "<script>alert('Bank details not found'); window.location.href='bank-details.php';</script>";
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Invalid request'); window.location.href='bank-details.php';</script>";
    exit();
}

mysqli_close($conn);
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
                        <h2><strong>Basic</strong> Information</h2>
                    </div>
                    <div class="body">
                        <form id="bankForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Bank Logo</label>
                                    <div class="form-group">
                                        <input type="file" name="bank_logo" class="form-control">
                                        <img src="<?php echo $bankLogo; ?>" style="width:100px; margin-top:10px;">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Bank Name</label>
                                    <div class="form-group">
                                        <input type="text" name="bank_name" class="form-control" value="<?php echo htmlspecialchars($bankName); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Rate of Interest</label>
                                    <div class="form-group">
                                        <input type="number" step="0.01" name="rate_of_interest" class="form-control" value="<?php echo $rateOfInterest; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Total Offers</label>
                                    <div class="form-group">
                                        <input type="number" name="total_offers" class="form-control" value="<?php echo $totalOffers; ?>">
                                    </div>
                                </div>
                            </div>                      
                            <div class="row clearfix">                                                   
                                <div class="col-sm-12">
                                    <button type="button" id="updateBtn" class="btn btn-primary btn-round">Update</button>
                                   
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
document.getElementById("updateBtn").addEventListener("click", function() {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to update these bank details!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Update it!",
        cancelButtonText: "No, Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData(document.getElementById("bankForm"));

            fetch("edit-bank-details-post-code.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire({
                        title: "Updated!",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "bank-details.php";
                    });
                } else {
                    Swal.fire("Error!", data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error!", "Something went wrong.", "error");
            });
        }
    });
});
</script>

<?php include('includes/footer.php'); ?>
