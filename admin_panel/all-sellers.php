<?php 
include('includes/header.php'); 
include('includes/db.php'); // Database connection
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Sellers</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-sellers.php"><i class="zmdi zmdi-plus"></i> Create Sellers</a></li>
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
                                        <th>Customer Name</th>
                                        <th>Phone number</th>
                                        <th>Email Id</th>
                                        <th>Address</th>
                                        <th>Buyer/Seller</th>
                                        <th>Customer From</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM sellers_table";
                                    $result = mysqli_query($conn, $query);
                                    $count = 1;
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $count . "</td>";
                                        echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['buyer_seller']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['customer_from']) . "</td>";
                                        echo "<td>
                                            <a href='edit-sellers.php?id=" . $row['id'] . "'><i class='material-icons' style='color:green'>border_color</i></a>
                                            <a href='#' class='delete-seller' data-id='" . $row['id'] . "'><i class='material-icons' style='color:red'>delete</i></a>
                                        </td>";
                                        echo "</tr>";
                                        $count++;
                                    }
                                    ?>
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
    document.querySelectorAll(".delete-seller").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const sellerId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this seller!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("delete-sellers.php?id=" + sellerId, {
                        method: "GET"
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            Swal.fire("Deleted!", data.message, "success").then(() => {
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
