<?php
include('includes/header.php');
include('includes/db.php');

$query = "SELECT * FROM employee_table";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Employee List</h2>
            </div>            
            <div class="col-lg-7 col-md-7 col-sm-12 text-md-right">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="employee-add.php"><i class="zmdi zmdi-plus"></i> Add Employee</a>
                    </li>
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
                                        $status = ($row['status'] == 'Active') ? 'Active' : 'Inactive';
                                        $statusColor = ($status == 'Active') ? 'green' : 'red';
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
                                                <button class="status-btn" data-id="<?php echo $row['id']; ?>" onclick="toggleStatus(this, <?php echo $row['id']; ?>)" style="background-color: <?php echo $statusColor; ?>;">
                                                    <?php echo $status; ?>
                                                </button>
                                            </td>
                                            <td><?php echo date("d/m/Y", strtotime($row['date_of_hire'])); ?></td>
                                            <td>
                                                <a href="edit-employee.php?id=<?php echo $row['id']; ?>" style="display: inline-block;">
                                                    <i class="material-icons" style="color:green">border_color</i>
                                                </a>
                                                <a href="javascript:void(0);" class="delete-employee" data-id="<?php echo $row['id']; ?>" style="display: inline-block;">
                                                    <i class="material-icons" style="color:red">delete</i>
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
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-employee").forEach(function(button) {
        button.addEventListener("click", function() {
            const employeeId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this employee!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("delete-employee.php?id=" + employeeId, {
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

// Function to toggle status with AJAX
function toggleStatus(button, employeeId) {
    let newStatus = (button.innerText.trim() === "Active") ? "Inactive" : "Active";

    fetch("update-status.php", {
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
