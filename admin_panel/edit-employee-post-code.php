<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);
    $role = trim($_POST['role']);
    $work_assignment = trim($_POST['work_assignment']);
    $date_of_hire = trim($_POST['date_of_hire']);

    if (empty($name) || empty($email) || empty($phone_number) || empty($address) || empty($role) || empty($work_assignment) || empty($date_of_hire)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    $query = "UPDATE employee_table SET name=?, email=?, phone_number=?, address=?, role=?, work_assignment=?, date_of_hire=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssssi", $name, $email, $phone_number, $address, $role, $work_assignment, $date_of_hire, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Employee updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update employee."]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
