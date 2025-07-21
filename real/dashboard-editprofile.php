<?php
session_start();

// Show different headers based on login status
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}

include('includes/db.php'); // Assumes $conn is initialized here using mysqli

// Initialize default values
$username = "";
$name = "";
$phone = "";
$address = "";
$profileImage = "";
$socialLinks = [];

// Get username from session and fetch name
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT name, phone, address, profile_image, social_links FROM website_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($name, $phone, $address, $profileImage, $socialLinksString);
    $stmt->fetch();
    $stmt->close();
    
    // Convert comma-separated string to array
    $socialLinks = explode(",", $socialLinksString);
}

$conn->close();
?>
            <!--header-end-->
            <!--warpper-->
            <div class="wrapper">
                <!--content-->
                <div class="content">
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                        <div class="breadcrumbs-list bl_flat">
                            <a href="#">Home</a><a href="#">Dashboard</a><span>Edit Profile</span>
                            <!--<div class="breadcrumbs-list_dec"><i class="fa-thin fa-arrow-up"></i></div>-->
                        </div>
                        <!--breadcrumbs-list end-->					
                        <!--main-content-->
                        <div class="main-content  ms_vir_height">
                            <!--boxed-container-->
                            <div class="boxed-container">
                                <div class="row">
                                    <!-- user-dasboard-menu_wrap -->	
                                    <div class="col-lg-3">
                                    <?php include ('includes/side-bar.php');?>

                                    </div>
                                    <!-- user-dasboard-menu_wrap end-->
                                    <!-- pricing-column -->	
                                    <div class="col-lg-9">
                                        <div class="dashboard-title">
                                            <div class="dashboard-title-item"><span>Edit your profile</span></div>
                                        </div>
                                        <form id="editProfileForm" action="edit-profile-post-code.php" method="POST" enctype="multipart/form-data">
                                            <div class="db-container">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- Personal Info -->  
                                                        <div class="dasboard-content-item">
                                                            <div class="dashboard-widget-title-single">Personal Info</div>
                                                            <div class="custom-form">
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-light fa-user"></i>
                                                                    <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
                                                                </div>
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-light fa-phone"></i>
                                                                    <input type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($phone); ?>">
                                                                </div>
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-light fa-location-dot"></i>
                                                                    <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- Profile Photo -->
                                                        <div class="edit-profile-photo">
                                                            <div class="edit-profile-photo_cur">
                                                                <img id="profileImage" src="<?php echo !empty($profileImage) ? 'uploads/profile_image/' . htmlspecialchars($profileImage) : 'assets/default-avatar.png'; ?>" alt="Profile Image" style="max-width: 100px;">
                                                            </div>
                                                            <div class="change-photo-btn">
                                                                <div class="photoUpload">
                                                                    <span>Upload New Photo</span>
                                                                    <input type="file" class="upload" name="profile_image" id="imageUpload">
                                                                </div>  
                                                            </div>
                                                            <div class="abs_bg"></div>
                                                            <div class="remove_phav tolt" data-microtip-position="left" data-tooltip="Remove Photo">
                                                                <i class="fa-light fa-trash" id="removeImage"></i>
                                                            </div>
                                                        </div>
                                                        <script>
                                                        const imageInput = document.getElementById('imageUpload');
                                                        const profileImg = document.getElementById('profileImage');
                                                        const removeBtn = document.getElementById('removeImage');
                                                    
                                                        imageInput.addEventListener('change', function (e) {
                                                            const file = e.target.files[0];
                                                            if (file && file.type.startsWith('image/')) {
                                                                const reader = new FileReader();
                                                                reader.onload = function (e) {
                                                                    profileImg.src = e.target.result;
                                                                };
                                                                reader.readAsDataURL(file);
                                                            }
                                                        });
                                                    
                                                        removeBtn.addEventListener('click', function () {
                                                            profileImg.src = '';
                                                            imageInput.value = '';
                                                        });
                                                        </script>
                                                        <!-- Social Links -->
                                                        <div class="dasboard-content-item">
                                                            <div class="dashboard-widget-title-single">Your Socials Links</div>
                                                            <div class="custom-form">
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-brands fa-facebook-f"></i>
                                                                    <input type="text" name="facebook" placeholder="Facebook" value="<?php echo $socialLinks[0] ?? ''; ?>">
                                                                </div>
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-brands fa-instagram"></i>
                                                                    <input type="text" name="instagram" placeholder="Instagram" value="<?php echo $socialLinks[1] ?? ''; ?>">
                                                                </div>
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-brands fa-x-twitter"></i>
                                                                    <input type="text" name="twitter" placeholder="X-Twitter" value="<?php echo $socialLinks[2] ?? ''; ?>">
                                                                </div>
                                                                <div class="cs-intputwrap">
                                                                    <i class="fa-brands fa-youtube"></i>
                                                                    <input type="text" name="youtube" placeholder="Youtube" value="<?php echo $socialLinks[3] ?? ''; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <!-- Change Password -->
                                                <div class="dasboard-content-item" style="margin-top: 20px">
                                                    <div class="dashboard-widget-title-single">Change Password</div>
                                                    <div class="custom-form">
                                                        <div class="cs-intputwrap pass-input-wrap">
                                                            <i class="fa-light fa-envelope"></i>
                                                            <input type="email" name="email" placeholder="Enter Email" value="<?php echo htmlspecialchars($username); ?>" readonly>
                                                        </div>
                                                        <div class="cs-intputwrap pass-input-wrap">
                                                            <i class="fa-light fa-lock"></i>
                                                            <input type="password" name="new_password" class="pass-input" placeholder="New Password">
                                                            <div class="view-pass"></div>
                                                        </div>
                                                        <div class="cs-intputwrap pass-input-wrap">
                                                            <i class="fa-light fa-shield-check"></i>
                                                            <input type="password" name="confirm_password" class="pass-input" placeholder="Confirm New Password">
                                                            <div class="view-pass"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="commentssubmit" type="submit">Update</button>
                                            </div>
                                        </form>
                                        <!-- SweetAlert2 CDN -->
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                        <script>
                                        document.getElementById("editProfileForm").addEventListener("submit", function (e) {
                                            e.preventDefault();
                                        
                                            Swal.fire({
                                                title: "Are you sure?",
                                                text: "Do you want to update your profile?",
                                                icon: "question",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes, update it!"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    const form = e.target;
                                                    const formData = new FormData(form);
                                        
                                                    fetch("edit-profile-post-code.php", {
                                                        method: "POST",
                                                        body: formData
                                                    })
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        if (data.status === "success") {
                                                            Swal.fire({
                                                                title: "Success!",
                                                                text: data.message,
                                                                icon: "success"
                                                            }).then(() => {
                                                                location.reload(); // 🔁 Reload the page on OK click
                                                            });
                                                        } else {
                                                            Swal.fire("Error!", data.message, "error");
                                                        }
                                                    })
                                                    .catch(() => {
                                                        Swal.fire("Error!", "Something went wrong.", "error");
                                                    });
                                                }
                                            });
                                        });
                                        </script>
                                    </div>
                                    <!-- pricing-column end-->											
                                </div>
                                <div class="limit-box"></div>
                            </div>
                            <!--boxed-container end-->
                        </div>
                        <!--main-content end-->
                        <div class="to_top-btn-wrap">
                            <div class="to-top to-top_btn"><span>Back to top</span> <i class="fa-solid fa-arrow-up"></i></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;left:  -40px; transform: rotate(-90deg)"></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;right: -40px; transform: rotate(-180deg)"></div>
                        </div>
                    </div>
                    <!-- container end-->
                </div>
                <!--content  end-->
                <?php include ('includes/footer.php');?>