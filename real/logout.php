<?php
session_start();
session_unset();  // Clear session variables
session_destroy(); // Destroy session

// Optional: Clear cookies if used for auth
// setcookie("your_cookie_name", "", time() - 3600);

// Redirect to index.php
header("Location: index.php");
exit;
?>
