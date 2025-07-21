<?php include('includes/header.php'); ?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Create Agent/Channel Partner             
            </div>                       
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form id="agentForm" action="create-agents-post-code.php" method="POST">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Agent Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="agent_name" placeholder="Ex: Shoba Builders" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Year Estd</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="year_estd" placeholder="Ex: Year Estd 2000" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone_number" placeholder="Ex: +91-000000000" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email Id</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email_id" placeholder="Ex: Mahi@gmail.com" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Website link</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="website_link" placeholder="Ex: www.shobha.com">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" placeholder="Ex: #328 Indira Gandhi Housing Colony Arakere" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Username</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" placeholder="Ex: abc123" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="password" placeholder="Ex: abc@123" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Confirm Password</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="confirm_password" placeholder="Ex: abc@123" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="description" placeholder="Project Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            <div class="row clearfix">                          
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Create Agent</button>
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
$(document).ready(function() {
    $("#agentForm").submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            type: "POST",
            url: "create-agents-post-code.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: response.message,
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "create-agents.php"; // Redirect or reload
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: response.message,
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Something went wrong. Please try again.",
                    confirmButtonText: "OK"
                });
            }
        });
    });
});
</script>


<?php include('includes/footer.php'); ?>
