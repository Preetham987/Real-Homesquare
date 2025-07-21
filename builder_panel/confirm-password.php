<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Welcome">
<meta name="author" content="Welcome">
    <meta name="description" content="Welcome">

    <title>Home Square Admin Panel</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets//plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
<div class="page-header">
    <div class="page-header-image" style="background-image:url(assets//images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="POST" action="check-password.php">
                    <input type="hidden" id="token" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
                    <div class="header">
                        <div class="logo-container">
                            <img src="assets//images/logo.svg" alt="">
                        </div>
                        <!--<h5>Enter Username or Password</h5>-->
                        <span>Enter your New Username and Password below</span>
                    </div>
                    <div class="content">
                        <div class="input-group">
                            <input type="text" id="username" class="form-control" placeholder="Enter New Username">
                        </div>
                        <div class="input-group">
                            <input type="text" id="password_masked" class="form-control" placeholder="Enter New Password" oninput="maskInput(this, 'password_real')">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                            <input type="hidden" id="password_real">
                        </div>
                        <div class="input-group">
                            <input type="text" id="newpassword_masked" class="form-control" placeholder="Confirm New Password" oninput="maskInput(this, 'newpassword_real')">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                            <input type="hidden" id="newpassword_real">
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" id="submitBtn" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">SUBMIT</button>
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
<script>
function maskInput(inputElement, hiddenInputId) {
    const realValue = inputElement.getAttribute("data-original-value") || "";
    const currentValue = inputElement.value;

    // Determine the real value by comparing lengths
    const updatedValue = currentValue.length < realValue.length
        ? realValue.substring(0, currentValue.length)
        : realValue + currentValue.slice(realValue.length).replace(/\*/g, "");

    // Update original-value and hidden field
    inputElement.setAttribute("data-original-value", updatedValue);
    document.getElementById(hiddenInputId).value = updatedValue;

    // Display asterisks
    inputElement.value = "*".repeat(updatedValue.length);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to get token from the URL
    function getTokenFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('token'); // Gets the token from the URL
    }

    document.getElementById("submitBtn").addEventListener("click", function () {
        const username = document.getElementById("username").value;
        const password = document.getElementById("password_real").value;
        const newpassword = document.getElementById("newpassword_real").value;
        const token = getTokenFromURL();
    
        const formData = new FormData();
        formData.append("username", username);
        formData.append("password", password);
        formData.append("newpassword", newpassword);
        formData.append("token", token);

        fetch("check-password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text()) // Change this to text for debugging
        .then(data => {
            console.log('Response:', data); // Log the raw response for debugging
            try {
                const jsonData = JSON.parse(data); // Manually parse JSON
                if (jsonData.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: jsonData.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "sign-in.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: jsonData.message
                    });
                }
            } catch (error) {
                console.error("JSON parsing error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.'
                });
            }
        })
        .catch((error) => {
            console.error("Fetch error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again.'
            });
        });
    });
</script>

</body>
</html>