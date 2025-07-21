<?php
include('includes/db.php'); // Ensure you have a database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank_name = $_POST['bank_name'];
    $branch_name = $_POST['branch_name'];
    $ifsc_code = $_POST['ifsc_code'];
    $account_number = $_POST['account_number'];
    $account_holder_name = $_POST['account_holder_name'];
    $bank_address = $_POST['bank_address'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];

    // Check if account number or email already exists
    $checkQuery = "SELECT * FROM customer_bank_details WHERE account_number = ? OR email_address = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $account_number, $email_address);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Account number or email already exists!"]);
        exit;
    }

    // Insert into database
    $query = "INSERT INTO customer_bank_details (bank_name, branch_name, ifsc_code, account_number, account_holder_name, bank_address, contact_number, email_address) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $bank_name, $branch_name, $ifsc_code, $account_number, $account_holder_name, $bank_address, $contact_number, $email_address);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database insertion failed."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
