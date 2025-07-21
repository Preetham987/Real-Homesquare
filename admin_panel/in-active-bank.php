<?php include('includes/header.php'); ?>
<?php 
// Include database connection
include('includes/db.php');

// Fetch only Active bank details
$query = "SELECT * FROM customer_bank_details WHERE status = 'Inactive'";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Inactive Bank Details</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="add-bank-details.php"><i class="zmdi zmdi-plus"></i>Add Bank Details</a></li>
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
                                            $status = $row['status']; 
                                            $statusColor = ($status == 'Active') ? 'green' : 'red';

                                            echo '<td>
                                                <button class="status-btn" data-id="' . $row['id'] . '" onclick="toggleStatus(this, ' . $row['id'] . ')" style="background-color: ' . $statusColor . '; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                                    ' . $status . '
                                                </button>
                                                </td>';
                                          // Actions
                                            echo '<td>
                                                <a href="all-bank-details.php" class="btn btn-primary" style="background-color: #007bff; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none;">
                                                    Manage
                                                </a>
                                            </td>';
                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='11' class='text-center'>No active bank details found.</td></tr>";
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
function toggleStatus(button, employeeId) {
    fetch("toggle-bank-status.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + employeeId
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            // Reload the page to reflect the status change
            location.reload();
        } else {
            alert("Error updating status: " + data.message);
        }
    })
    .catch(error => {
        alert("Something went wrong! Please try again.");
    });
}
</script>

<?php include('includes/footer.php'); ?>
