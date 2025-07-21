<?php
include('includes/header.php');
include('includes/db.php');

// Fetch all bank details from the database
$query = "SELECT * FROM bank_details_table";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Bank Details</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="add-bank-details.php"><i class="zmdi zmdi-plus"></i> Add Bank Details</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table td_2 table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Branch Logo</th>
                                        <th>Bank Name</th>
                                        <th>Rate of Interest</th>
                                        <th>Total Offers</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td>
                                                <img src="<?php echo htmlspecialchars($row['bank_logo']); ?>" 
                                                    style="width:100px; height:50px;" alt="Bank Logo">
                                            </td>
                                            <td><?php echo htmlspecialchars($row['bank_name']); ?></td>
                                            <td><?php echo number_format($row['rate_of_interest'], 2); ?>%</td>
                                            <td><?php echo htmlspecialchars($row['total_offers']); ?> Offers</td>
                                            <td>
                                                <a href="edit-bank-details.php?id=<?php echo $row['id']; ?>" style="display: inline-block;">
                                                    <i class="material-icons" style="color:green">border_color</i>
                                                </a>
                                                <a href="javascript:void(0);" class="delete-bank" data-id="<?php echo $row['id']; ?>" style="display: inline-block;">
                                                    <i class="material-icons" style="color:red">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-bank").forEach(function(button) {
        button.addEventListener("click", function() {
            const bankId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "This action will permanently delete the bank details.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("delete-bank-details.php?id=" + bankId, {
                        method: "GET"
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            Swal.fire({
                                title: "Deleted!",
                                text: data.message,
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                location.reload();
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
});
</script>


<?php include('includes/footer.php'); ?>
