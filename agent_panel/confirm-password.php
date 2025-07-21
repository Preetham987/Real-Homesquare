<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Welcome">
<meta name="author" content="Welcome">
    <meta name="description" content="Welcome">

    <title>Welcome</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
<div class="page-header">
    <div class="page-header-image" style="background-image:url(../assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="" action="#">
                    <div class="header">
                        <div class="logo-container">
                            <img src="../assets/images/logo.svg" alt="">
                        </div>
                        <h5>Enter Password</h5>
                        <span>Enter your Password below</span>
                    </div>
                    <div class="content">
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" placeholder="Enter Password">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" id="submitBtn" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">SUBMIT</button>
                        <h5><a href="forgot-password.php" class="link">Forgot Password</a></h5>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert for alerts -->
<script>
document.getElementById("submitBtn").addEventListener("click", function () {
    let password = document.getElementById("password").value;

    if (password === "") {
        Swal.fire("Error", "Please enter your password", "error");
        return;
    }

    let formData = new FormData();
    formData.append("password", password);

    fetch("check-password.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            Swal.fire({
                title: "Success",
                text: "Password verified!",
                icon: "success",
                timer: 1000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "edit-profile.php"; // Redirect to edit-profile.php
            });
        } else {
            Swal.fire("Error", data.message, "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire("Error", "Something went wrong", "error");
    });
});
</script>

</body>
</html>