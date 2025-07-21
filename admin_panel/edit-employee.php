<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch employee details based on ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Secure ID
    $query = "SELECT * FROM employee_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $employee = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Invalid request'); window.location.href='employee-list.php';</script>";
    exit;
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Employee</h2>
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
                        <form id="updateEmployeeForm">
                            <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Employee Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email Id</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($employee['phone_number']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($employee['address']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Role/Access Level</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="role" value="<?php echo htmlspecialchars($employee['role']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Work Assignment</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="work_assignment" value="<?php echo htmlspecialchars($employee['work_assignment']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Date of Hire</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="date_of_hire" value="<?php echo htmlspecialchars($employee['date_of_hire']); ?>">
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
        text: "You want to update this employee's details!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Update it!",
        cancelButtonText: "No, Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData(document.getElementById("updateEmployeeForm"));

            fetch("edit-employee-post-code.php", {
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
                        window.location.href = "employee-list.php";
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
