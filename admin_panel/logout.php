<?php
session_start(); // Start the session

// Destroy the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Prevent page caching
header("Cache-Control: no-cache, no-store, must-revalidate");  // HTTP 1.1
header("Pragma: no-cache");  // HTTP 1.0
header("Expires: 0");  // Proxies

header("Location: sign-in.php");
exit();
?>
