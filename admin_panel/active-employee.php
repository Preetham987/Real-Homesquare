<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

<!-- Fetch only active employees -->
<?php
$query = "SELECT * FROM employee_table WHERE status = 'Active'";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Active Employee List</h2>
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
                                        <th>Employee Name</th>
                                        <th>Email Address</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Role/Access Level</th>
                                        <th>Work Assignment</th>
                                        <th>Status</th>
                                        <th>Date of Hire</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                                            <td><input type="text" class="form-control" value="<?php echo htmlspecialchars($row['work_assignment']); ?>"></td>
                                            <td>
                                                <button class="status-btn" data-id="<?php echo $row['id']; ?>" onclick="toggleStatus(this, <?php echo $row['id']; ?>)" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                                    Active
                                                </button>
                                            </td>
                                            <td><?php echo date("d/m/Y", strtotime($row['date_of_hire'])); ?></td>
                                            <td>
                                                <a href="employee-list.php" class="btn btn-primary" style="background-color: #007bff; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none;">
                                                    Manage
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
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
    fetch("toggle-status.php", {
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
