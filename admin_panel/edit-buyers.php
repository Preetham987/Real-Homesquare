<?php 
include('includes/header.php'); 
include('includes/db.php'); // Database connection

// Get buyer ID from URL
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM buyers_table WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $buyer = mysqli_fetch_assoc($result);
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Update Buyer</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <!--<h2><strong>Basic</strong> Information</h2>-->
                    </div>
                    <div class="body">
                        <form id="updateForm">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Buyer Name</label>
                                    <div class="form-group">
                                        <input type="text" name="customer_name" class="form-control" value="<?php echo htmlspecialchars($buyer['customer_name']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($buyer['phone_number']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email Id</label>
                                    <div class="form-group">
                                        <input type="email" name="email_id" class="form-control" value="<?php echo htmlspecialchars($buyer['email_id']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($buyer['address']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round update-button">Update Buyer</button>
                                   
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
    document.querySelector(".update-button").addEventListener("click", function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You want to update this buyer?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!"
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(document.getElementById("updateForm"));

                fetch("edit-buyers-post-code.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire("Updated!", data.message, "success").then(() => {
                            window.location.href = "all-buyers.php";
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
});
</script>

<?php include('includes/footer.php'); ?>
