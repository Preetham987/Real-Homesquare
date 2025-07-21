<?php
include('includes/header.php');
include('includes/db.php');
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Customers</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="create-customers.php"><i class="zmdi zmdi-plus"></i> Create Customers</a></li>
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
                                    $query = "SELECT * FROM customers_table";
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result) > 0) {
                                        $count = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$count}</td>
                                                <td>{$row['customer_name']}</td>
                                                <td>{$row['phone_number']}</td>
                                                <td>{$row['email_id']}</td>
                                                <td>{$row['address']}</td>
                                                <td>{$row['buyer_seller']}</td>
                                                <td>{$row['customer_from']}</td>
                                                <td>
                                                    <a href='edit-customers.php?id={$row['id']}'><i class='material-icons' style='color:green'>border_color</i></a>
                                                    <button class='delete-customer' data-id='{$row['id']}' style='border:none;background:none;cursor:pointer;'>
                                                        <i class='material-icons' style='color:red'>delete</i>
                                                    </button>
                                                </td>
                                            </tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No customers found.</td></tr>";
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
    document.querySelectorAll(".delete-customer").forEach(function(button) {
        button.addEventListener("click", function() {
            const customerId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this customer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("delete-customers.php?id=" + customerId, {
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
