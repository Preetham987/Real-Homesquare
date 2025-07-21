<?php
include('includes/db.php'); // Include database connection
header("Content-Type: application/json"); // Set response type to JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $work_assignment = mysqli_real_escape_string($conn, $_POST['work_assignment']);
    $date_of_hire = mysqli_real_escape_string($conn, $_POST['date_of_hire']);

    // Check if email or phone number already exists
    $check_query = "SELECT * FROM employee_table WHERE email='$email' OR phone_number='$phone_number'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo json_encode(["status" => "error", "message" => "Email or Phone Number already exists."]);
        exit();
    }

    // Insert data into database
    $sql = "INSERT INTO employee_table (name, email, phone_number, address, role, work_assignment, date_of_hire) 
            VALUES ('$name', '$email', '$phone_number', '$address', '$role', '$work_assignment', '$date_of_hire')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Employee added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database Error: " . mysqli_error($conn)]);
    }
}
?>
