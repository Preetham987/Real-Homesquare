<?php
// db.php
$servername = "localhost";
$username = "xpnjceiy_homesqure";
$password = "BQRoYo=@DUF$";
$dbname = "xpnjceiy_homesqure";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
