<?php
session_start();

include ('includes/db.php');


// 2. Get Data From Form
$name     = $_POST['name'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// 3. Validate Inputs
if (empty($name) || empty($username) || empty($password)) {
    die("Please fill all fields.");
}

// 4. Hash Password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// 5. Insert Into DB
$stmt = $conn->prepare("INSERT INTO website_users (name, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $username, $hashed_password);

if ($stmt->execute()) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();
} else {
    echo "Registration failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
