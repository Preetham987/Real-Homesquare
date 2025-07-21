<?php
include 'includes/db.php'; // Database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging - Check incoming data
    file_put_contents('debug_log.txt', json_encode($_POST) . "\n", FILE_APPEND);

    $project_id = $_POST['lastInsertedProjectId'] ?? null;

    if (empty($project_id)) {
        die(json_encode(["success" => false, "error" => "Project ID is missing."]));
    }

    // Function to sanitize arrays and ensure they are comma-separated
    function sanitize_array($array) {
        if (!is_array($array)) {
            return trim($array); // Directly return the trimmed string if it's not an array
        }
        return implode(", ", array_map('trim', $array));
    }

    // Processing array fields
    $no_of_bhk = sanitize_array($_POST['no_of_bhk'] ?? []);
    $project_facing = sanitize_array($_POST['project_facing'] ?? []);
    
    function process_area_array($input_array) {
        $formatted_groups = [];
    
        foreach ($input_array as $group) {
            if (is_array($group)) {
                $formatted_groups[] = implode(", ", array_map('trim', $group));
            } else {
                $formatted_groups[] = trim($group);
            }
        }
    
        return implode(" / ", $formatted_groups);
    }
    
    $saleable_area_sft = isset($_POST['saleable_area_sft_grouped']) && is_array($_POST['saleable_area_sft_grouped'])
        ? process_area_array($_POST['saleable_area_sft_grouped'])
        : null;

    $carpet_area_sft = sanitize_array($_POST['carpet_area_sft'] ?? []);
    $price = sanitize_array($_POST['price'] ?? []);
    $bank_name = sanitize_array($_POST['bank_name'] ?? []);

    // Single value fields
    $property_address = $_POST['property_address'] ?? null;
    $property_address2 = $_POST['property_address2'] ?? null;
    $locality1 = $_POST['locality1'] ?? null;
    $locality2 = $_POST['locality2'] ?? null;
    $locality3 = $_POST['locality3'] ?? null;
    $locality4 = $_POST['locality4'] ?? null;
    $locality5 = $_POST['locality5'] ?? null;

    // Checkbox values
    $amenities = isset($_POST['amenities']) ? implode(", ", $_POST['amenities']) : null;

    // Handle multiple file uploads correctly
    $uploaded_files = [];
    if (!empty($_FILES['project_images']['name'][0])) {
        $target_dir = "uploads/";
    
        foreach ($_FILES['project_images']['name'] as $index => $images) {
            $grouped_files = [];  // Array to store grouped file paths
    
            foreach ($images as $key => $file_name) {
                $file_tmp = $_FILES['project_images']['tmp_name'][$index][$key];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_file_name = uniqid("img_", true) . "." . $file_extension;
                $target_file = $target_dir . $new_file_name;
    
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $grouped_files[] = $target_file;  // Store each uploaded file path
                }
            }
    
            // After grouping the files, join them with a slash
            if (!empty($grouped_files)) {
                $uploaded_files[] = implode(":", $grouped_files);
            }
        }
    }
    
    $project_images = !empty($uploaded_files) ? implode(",", $uploaded_files) : null;

    // Handle multiple file uploads correctly for bank documents
    $uploaded_bank_document = [];
    if (!empty($_FILES['bank_document']['name'][0])) {
        $target_dir = "uploads/bank_documents/";
        
        // Create the folder if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        foreach ($_FILES['bank_document']['name'] as $index => $file_name) {
            $file_tmp = $_FILES['bank_document']['tmp_name'][$index];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid("bank_", true) . "." . $file_extension;
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
                $uploaded_bank_document[] = $target_file;
            }
        }
    }

    // Prepare the fields to be inserted/updated in the database
    $project_images = !empty($uploaded_files) ? implode(",", $uploaded_files) : null;
    $bank_document = !empty($uploaded_bank_document) ? implode(",", $uploaded_bank_document) : null;

    // Prepare the SQL dynamically
    $fields_to_update = [];
    $values = [];

    $update_fields = [
        "project_images" => $project_images,
        "no_of_bhk" => $no_of_bhk,
        "project_facing" => $project_facing,
        "saleable_area_sft" => $saleable_area_sft,
        "carpet_area_sft" => $carpet_area_sft,
        "price" => $price,
        "amenities" => $amenities,
        "bank_name" => $bank_name,
        "bank_document" => $bank_document,
        "property_address" => $property_address,
        "property_address2" => $property_address2,
        "locality1" => $locality1,
        "locality2" => $locality2,
        "locality3" => $locality3,
        "locality4" => $locality4,
        "locality5" => $locality5
    ];

    foreach ($update_fields as $column => $value) {
        if ($value !== null) {
            $fields_to_update[] = "$column = ?";
            $values[] = $value;
        }
    }

    // If no data is available to update, return an error
    if (empty($fields_to_update)) {
        die(json_encode(["success" => false, "error" => "No data to update."]));
    }

    // Prepare SQL statement for updating the project
    $sql = "UPDATE builder_panel_projects_table SET " . implode(", ", $fields_to_update) . " WHERE id = ?";
    $values[] = $project_id;

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die(json_encode(["success" => false, "error" => $conn->error]));
    }

    $types = str_repeat("s", count($values) - 1) . "i"; // All are strings except project_id (integer)
    $stmt->bind_param($types, ...$values);

    // Execute the update query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Project details updated successfully."]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    // Clean up
    $stmt->close();
    $conn->close();
}
?>
