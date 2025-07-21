<?php
include('includes/header.php');
include('includes/db.php');

// Get agent ID from URL
if (isset($_GET['id'])) {
    $agent_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch agent data from database
    $query = "SELECT * FROM agents_table WHERE id = '$agent_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $agent = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Agent not found!'); window.location.href='all-agents.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='all-agents.php';</script>";
    exit;
}
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Agent/Channel Partner</h2>
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
                        <form id="editAgentForm" method="POST">
                            <input type="hidden" name="agent_id" value="<?= $agent['id'] ?>">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Agent Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="agent_name" value="<?= htmlspecialchars($agent['agent_name']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Year Established</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="year_estd" value="<?= htmlspecialchars($agent['year_estd']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone_number" value="<?= htmlspecialchars($agent['phone_number']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Email ID</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email_id" value="<?= htmlspecialchars($agent['email_id']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Website Link</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="website_link" value="<?= htmlspecialchars($agent['website_link']) ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($agent['address']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Username</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($agent['username']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>New Password</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="password" placeholder="Ex: abc@123" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Confirm New Password</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="confirm_password" placeholder="Ex: abc@123" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="description"><?= htmlspecialchars($agent['description']) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Update</button>
                                    <a href="all-agents.php" class="btn btn-default btn-round btn-simple">Cancel</a>
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
document.getElementById("editAgentForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    Swal.fire({
        title: "Are you sure?",
        text: "You want to update this agent's details!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("edit-agents-post-code.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Debugging: Check full response in console
                if (data.status === "success") {
                    Swal.fire("Updated!", data.message, "success").then(() => {
                        window.location.href = "all-agents.php";
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
