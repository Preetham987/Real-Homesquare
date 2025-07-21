<?php
include('includes/header.php');
include('includes/db.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username']; // Get logged-in username

// Fetch user email from the database
$query = "SELECT email FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();
?>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Edit Profile</h2>
            </div> 
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form action="edit-profile-post-code.php" method="POST" id="updateProfileForm">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label>Username</label>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Email</label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>New Password</label>
                                    <div class="form-group">
                                        <input type="text" name="password" class="form-control" placeholder="Enter your New Password" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Confirm New Password</label>
                                    <div class="form-group">
                                        <input type="text" name="newpassword" class="form-control" placeholder="Enter New Password Again" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">                           
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-round">Update</button>
                                    <button type="reset" class="btn btn-default btn-round btn-simple" onclick="window.location.reload();">Cancel</button>
                                </div>
                            </div>
                        </form> <!-- End of form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fields = [
        { name: 'password', realValue: '', input: null, hiddenInput: null },
        { name: 'newpassword', realValue: '', input: null, hiddenInput: null }
    ];

    // Setup masking and hidden inputs
    fields.forEach(field => {
        field.input = document.querySelector(`input[name="${field.name}"]`);

        // Create hidden input
        field.hiddenInput = document.createElement("input");
        field.hiddenInput.type = "hidden";
        field.hiddenInput.name = field.name;

        // Remove name from visible input to prevent submitting * characters
        field.input.removeAttribute("name");
        field.input.parentNode.appendChild(field.hiddenInput);

        // Masking logic
        field.input.addEventListener("input", function (e) {
            let displayValue = e.target.value;
            let realValue = field.realValue;

            if (displayValue.length < realValue.length) {
                field.realValue = realValue.slice(0, displayValue.length);
            } else {
                let newChar = displayValue[displayValue.length - 1];
                field.realValue += newChar;
            }

            e.target.value = '*'.repeat(field.realValue.length);
        });
    });

    // Submit handler
    document.getElementById("updateProfileForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Always prevent default first

        const password1 = fields[0].realValue;
        const password2 = fields[1].realValue;

        if (password1 !== password2) {
            Swal.fire({
                title: "Passwords Do Not Match",
                text: "Please ensure both password fields are identical.",
                icon: "error",
                confirmButtonText: "OK"
            });
            return false;
        }

        // Proceed with confirmation popup
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to update your profile details?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Add real passwords to hidden inputs
                fields.forEach(field => {
                    field.hiddenInput.value = field.realValue;
                });

                // Submit via AJAX
                let formData = new FormData(this);
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "edit-profile-post-code.php", true);
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                xhr.onload = function () {
                    let response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Success!",
                            text: "Your profile has been updated successfully.",
                            icon: "success"
                        }).then(() => {
                            window.location.reload(); // Reflect changes
                        });
                    } else {
                        Swal.fire("Error!", response.message || "Something went wrong", "error");
                    }
                };

                xhr.send(formData);
            }
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
