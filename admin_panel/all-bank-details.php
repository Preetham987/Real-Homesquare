<?php
include('includes/header.php');
include('includes/db.php');

// Fetch all customer bank details from the database
$query = "SELECT * FROM customer_bank_details";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">   
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>All Payments</h2>
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
                                        <th>Bank Name</th>
                                        <th>Branch Name</th>
                                        <th>IFSC Code</th>
                                        <th>Account Number</th>
                                        <th>Account Holder Name</th>
                                        <th>Bank Address</th>
                                        <th>Contact Number</th>
                                        <th>Email Address</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        $count = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $status = ($row['status'] == 'Active') ? 'Active' : 'Inactive';
                                            $statusColor = ($status == 'Active') ? 'green' : 'red';

                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . htmlspecialchars($row['bank_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['branch_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['ifsc_code']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['account_number']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['account_holder_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['bank_address']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email_address']) . "</td>";
                                            
                                            // Status button
                                            echo "<td>
                                                    <button class='status-btn' data-id='" . $row['id'] . "' onclick='toggleStatus(this, " . $row['id'] . ")' style='background-color: " . $statusColor . ";'>
                                                        " . $status . "
                                                    </button>
                                                </td>";

                                            echo "<td>
                                                    <a href='edit-bank.php?id=" . $row['id'] . "'><i class='material-icons' style='color:green'>border_color</i></a>
                                                    <a href='javascript:void(0);' onclick='deleteBank(" . $row['id'] . ")'><i class='material-icons' style='color:red'>delete</i></a>
                                                </td>";

                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='10' class='text-center'>No bank details found.</td></tr>";
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
function deleteBank(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "delete-bank.php",
                type: "POST",
                data: { id: id },
                success: function(response) {
                    console.log("Server Response:", response); // Debugging

                    try {
                        let res = JSON.parse(response.trim()); // Trim spaces & parse JSON
                        if (res.status === "success") {
                            Swal.fire({
                                title: "Deleted!",
                                text: res.message,
                                icon: "success",
                                confirmButtonText: "OK" // Custom OK button
                            }).then(() => {
                                window.location.href = "all-bank-details.php"; // Redirect after clicking OK
                            });
                        } else {
                            Swal.fire("Error!", res.message || "Failed to delete.", "error");
                        }
                    } catch (e) {
                        console.error("JSON Parse Error:", e, "Response:", response);
                        Swal.fire("Error!", "Invalid JSON response.", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire("Error!", "An unexpected error occurred.", "error");
                }
            });
        }
    });
}
// Function to toggle status with AJAX
function toggleStatus(button, employeeId) {
    let newStatus = (button.innerText.trim() === "Active") ? "Inactive" : "Active";

    fetch("update_bank_status.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + employeeId + "&status=" + newStatus
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            button.innerText = newStatus;
            button.style.backgroundColor = (newStatus === "Active") ? "green" : "red";
        } else {
            Swal.fire("Error!", data.message, "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire("Error!", "Something went wrong.", "error");
    });
}
</script>

<style>
.status-btn {
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    color: white;
    border-radius: 5px;
}
</style>
<?php include('includes/footer.php'); ?>
