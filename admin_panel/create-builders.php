<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Builders</h2>
            </div>                        
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form id="createBuilderForm" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Builder Name</label>
                                    <div class="form-group">
                                        <input type="text" name="builder_name" class="form-control" placeholder="Ex: Shoba Builders" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Year Established</label>
                                    <div class="form-group">
                                        <input type="number" name="year_estd" class="form-control" placeholder="Ex: 2000" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Ongoing Projects</label>
                                    <div class="form-group">
                                        <input type="number" name="ongoing_projects" class="form-control" placeholder="Ex: 10" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Completed Projects</label>
                                    <div class="form-group">
                                        <input type="number" name="completed_projects" class="form-control" placeholder="Ex: 20" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="number" name="phone_number" class="form-control" placeholder="Ex: +91-9876543210" required>
                                    </div>
                                </div>                           
                                <div class="col-sm-4">
                                    <label>Email ID</label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Ex: contact@shoba.com" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Website Link</label>
                                    <div class="form-group">
                                        <input type="url" name="website_link" class="form-control" placeholder="Ex: www.shoba.com">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" placeholder="Ex: #328 Indira Gandhi Housing Colony, Arakere" required>
                                    </div>
                                </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Username</label>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Ex: abc123" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <div class="form-group">
                                        <input type="text" name="password" class="form-control" placeholder="Ex: abc@123" required>
                                    </div>
                                </div> 
                                 <div class="col-sm-4">
                                    <label>Confirm Password</label>
                                    <div class="form-group">
                                        <input type="text" name="confirm_password" class="form-control" placeholder="Ex: abc@123" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Builder Image</label>
                                    <div class="form-group">
                                        <input type="file" name="builder_image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <textarea rows="4" name="description" class="form-control no-resize" placeholder="Builder description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">                           
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Create Builder</button>
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
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("createBuilderForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent normal form submission

        let formData = new FormData(this); // Collect form data

        fetch("create-builders-post-code.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text()) // Get raw response as text
        .then(data => {
            console.log("Raw Response:", data); // Log response for debugging
            
            let jsonData;
            try {
                jsonData = JSON.parse(data); // Convert to JSON
            } catch (error) {
                throw new Error("Invalid JSON Response: " + data);
            }

            if (jsonData.status === "success") {
                Swal.fire({
                    title: "Success!",
                    text: jsonData.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "all-builders.php"; // Redirect
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: jsonData.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error); // Log fetch errors
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
