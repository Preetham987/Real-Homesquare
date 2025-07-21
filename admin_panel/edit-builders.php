<?php
include('includes/header.php');
include('includes/db.php');

// Get builder ID from URL
if (isset($_GET['id'])) {
    $builder_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch builder data from database
    $query = "SELECT * FROM builders_table WHERE id = '$builder_id'";
    $result = mysqli_query($conn, $query);
    $builder = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Invalid request!'); window.location.href='all-builders.php';</script>";
    exit();
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Builder</h2>             
            </div>                      
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form id="editBuilderForm">
                            <input type="hidden" name="id" value="<?php echo $builder['id']; ?>">

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Builder Name</label>
                                    <div class="form-group">
                                        <input type="text" name="builder_name" class="form-control" value="<?php echo htmlspecialchars($builder['builder_name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Year Established</label>
                                    <div class="form-group">
                                        <input type="text" name="year_estd" class="form-control" value="<?php echo htmlspecialchars($builder['year_estd']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Ongoing Projects</label>
                                    <div class="form-group">
                                        <input type="text" name="ongoing_projects" class="form-control" value="<?php echo htmlspecialchars($builder['ongoing_projects']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Completed Projects</label>
                                    <div class="form-group">
                                        <input type="text" name="completed_projects" class="form-control" value="<?php echo htmlspecialchars($builder['completed_projects']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($builder['phone_number']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email ID</label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($builder['email']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Website Link</label>
                                    <div class="form-group">
                                        <input type="text" name="website_link" class="form-control" value="<?php echo htmlspecialchars($builder['website_link']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($builder['address']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Username</label>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($builder['username']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>New Password</label>
                                    <div class="form-group">
                                        <input type="text" name="password" class="form-control" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Confirm New Password</label>
                                    <div class="form-group">
                                        <input type="text" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <textarea rows="4" name="description" class="form-control no-resize"><?php echo htmlspecialchars($builder['description']); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">                          
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Update Builder</button>
                                    <a href="all-builders.php" class="btn btn-default btn-round btn-simple">Cancel</a>
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
document.addEventListener("DOMContentLoaded", function () {
    function maskInput(input) {
        let actualValue = "";

        input.addEventListener("input", function (event) {
            let enteredValue = event.data || ""; 

            if (event.inputType === "deleteContentBackward") {
                actualValue = actualValue.slice(0, -1);
            } else {
                actualValue += enteredValue;
            }

            this.value = "*".repeat(actualValue.length);
        });

        input.addEventListener("focus", function () {
            this.setSelectionRange(this.value.length, this.value.length);
        });

        input.addEventListener("blur", function () {
            this.value = "*".repeat(actualValue.length);
        });

        input.addEventListener("keydown", function (event) {
            if (event.key === "Backspace") {
                actualValue = actualValue.slice(0, -1);
            }
        });

        // Store actual value in hidden input
        let hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = input.name;
        input.removeAttribute("name"); // Remove name from visible input
        input.parentElement.appendChild(hiddenInput);

        input.addEventListener("input", function () {
            hiddenInput.value = actualValue;
        });
    }

    maskInput(document.querySelector('input[name="password"]'));
    maskInput(document.querySelector('input[name="confirm_password"]'));
});
</script>

<script>
document.getElementById("editBuilderForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    
    Swal.fire({
        title: "Are you sure?",
        text: "You want to update this builder's details!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("edit-builders-post-code.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Debugging: Check full response in console
                if (data.status === "success") {
                    Swal.fire("Updated!", data.message, "success").then(() => {
                        window.location.href = "all-builders.php";
                    });
                } else {
                    Swal.fire("Error!", data.message, "error");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error); // Log fetch errors
                Swal.fire("Error!", "Something went wrong.", "error");
            });
        }
    });
});
</script>

<?php include('includes/footer.php'); ?>
