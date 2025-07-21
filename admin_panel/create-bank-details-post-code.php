<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $rate_of_interest = mysqli_real_escape_string($conn, $_POST['rate_of_interest']);
    $total_offers = mysqli_real_escape_string($conn, $_POST['total_offers']);

    $logo_dir = "uploads/logos/";
    $files_dir = "uploads/bank_documents/";

    if (!file_exists($logo_dir)) mkdir($logo_dir, 0777, true);
    if (!file_exists($files_dir)) mkdir($files_dir, 0777, true);

    $bank_logo = NULL;
    if (!empty($_FILES['bank_logo']['name'])) {
        $bank_logo_name = basename($_FILES['bank_logo']['name']);
        $bank_logo_path = $logo_dir . $bank_logo_name;
        $imageFileType = strtolower(pathinfo($bank_logo_path, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['bank_logo']['tmp_name'], $bank_logo_path)) {
                $bank_logo = $bank_logo_path;
            } else {
                echo json_encode(["status" => "error", "message" => "Error uploading the bank logo."]);
                exit();
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid logo file type."]);
            exit();
        }
    }

    $uploaded_file = NULL;
    if (!empty($_FILES['uploaded_file']['name'])) {
        $file_name = basename($_FILES['uploaded_file']['name']);
        $file_path = $files_dir . $file_name;
        if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
            $uploaded_file = $file_path;
        } else {
            echo json_encode(["status" => "error", "message" => "Error uploading the document."]);
            exit();
        }
    }

    $sql = "INSERT INTO bank_details_table (bank_logo, bank_name, rate_of_interest, total_offers, uploaded_file) 
            VALUES ('$bank_logo', '$bank_name', '$rate_of_interest', '$total_offers', " . ($uploaded_file ? "'$uploaded_file'" : "NULL") . ")";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Bank details added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database Error: " . mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>
