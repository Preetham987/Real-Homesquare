<?php
session_start();
include('includes/db.php'); // Make sure this includes the $conn connection

$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Default image if not found
$profileImagePath = 'images/avatar/default.jpg';

if (!empty($username)) {
    $query = "SELECT profile_image FROM website_users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($profileImageName);

    if ($stmt->fetch() && !empty($profileImageName)) {
        $profileImagePath = 'uploads/profile_image/' . htmlspecialchars($profileImageName);
    }

    $stmt->close();
    $conn->close();
}
?>
<div class="boxed-content btf_init">
    <div class="user-dasboard-menu_wrap">
        <div class="user-dasboard-menu_header-avatar">
            <img src="<?php echo $profileImagePath; ?>" alt="User Avatar" />
            <span>
                Welcome : <strong><?php echo htmlspecialchars($name); ?></strong>
            </span>
            <a href="dashboard-editprofile.php" class="usmha_edit tolt" data-microtip-position="left" data-tooltip="Edit Profile">
                <i class="fa-light fa-user-pen"></i>
            </a>
            <div class="db-menu_modile_btn"><strong>Menu</strong><i class="fa-regular fa-bars"></i></div>
        </div>
        <div class="user-dasboard-menu faq-nav">
            <ul>
                <li><a href="dashboard.php"> Dashboard</a></li>
                <li>
                    <a href="dashboard-requests.php"> Your Requests <span>6</span> </a>
                </li>
                <li><a href="add-listing.php"> Add New Propperty </a></li>
                <li><a href="current-listings.php"> Current Listings </a></li>
                <li><a href="dashboard-editprofile.php"> Edit profile</a></li>
            </ul>
            <a href="logout.php" class="hum_log-out_btn"><i class="fa-light fa-power-off"></i> Log Out </a>
        </div>
    </div>
</div>
