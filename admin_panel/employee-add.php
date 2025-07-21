<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Employee</h2>
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
                        <form id="employeeForm">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Employee Name</label>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Ex: Mahi" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email Id</label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Ex: mahi@gmail.com" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" name="phone_number" class="form-control" placeholder="Ex: +91-0000000000" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" placeholder="Ex: #328 Indira Gandhi Housing Colony" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Role/Access Level</label>
                                    <div class="form-group">
                                        <input type="text" name="role" class="form-control" placeholder="Ex: Manager" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Work Assignment</label>
                                    <div class="form-group">
                                        <input type="text" name="work_assignment" class="form-control" placeholder="Ex: Lead Generation" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Date of Hire</label>
                                    <div class="form-group">
                                        <input type="date" name="date_of_hire" class="form-control" required>
                                    </div>
                                </div>
                            </div>                        
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Create</button>
                                    
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
    document.getElementById("employeeForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);

        fetch("employee-add-post-code.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Expect JSON response
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.reload(); // Reload page to clear form
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: data.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: "Error!",
                text: "Something went wrong. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
