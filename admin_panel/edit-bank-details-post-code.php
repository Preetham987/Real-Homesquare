<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $bankName = mysqli_real_escape_string($conn, $_POST["bank_name"]);
    $rateOfInterest = floatval($_POST["rate_of_interest"]);
    $totalOffers = intval($_POST["total_offers"]);

    // Fetch existing details
    $query = "SELECT bank_logo, uploaded_file FROM bank_details_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $bankLogo = $row['bank_logo'];
    $uploadedFile = $row['uploaded_file'];

    // Handle new bank logo
    if (!empty($_FILES["bank_logo"]["name"])) {
        $targetDir = "uploads/logos/";
        $bankLogo = $targetDir . basename($_FILES["bank_logo"]["name"]);
        move_uploaded_file($_FILES["bank_logo"]["tmp_name"], $bankLogo);
    }

    // Handle new uploaded file
    if (!empty($_FILES["uploaded_file"]["name"])) {
        $targetDir = "uploads/bank_documents/";
        $uploadedFile = $targetDir . basename($_FILES["uploaded_file"]["name"]);
        move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $uploadedFile);
    }

    // Update database
    $updateQuery = "UPDATE bank_details_table SET bank_name = ?, rate_of_interest = ?, total_offers = ?, bank_logo = ?, uploaded_file = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "sddssi", $bankName, $rateOfInterest, $totalOffers, $bankLogo, $uploadedFile, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Bank details updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update bank details."]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
