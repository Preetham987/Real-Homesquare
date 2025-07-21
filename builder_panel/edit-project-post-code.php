<?php
include('includes/db.php'); // Include your database connection

// Enable error reporting and log errors to a file
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt');
ini_set('display_errors', 0); // Hide errors from being displayed to users

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("POST request received: " . json_encode($_POST));

    $project_id = $_POST['id'] ?? null;
    if (!$project_id) {
        die(json_encode(["success" => false, "error" => "Project ID is required"]));
    }

    // Assign form data to variables
    $builder_name = $_POST['builder_name'] ?? '';
    $project_name = $_POST['project_name'] ?? '';
    $project_type = $_POST['project_type'] ?? '';
    $construction_status = $_POST['construction_status'] ?? '';
    $project_link = $_POST['project_link'] ?? '';
    $project_location = $_POST['project_location'] ?? '';
    $no_of_units = $_POST['no_of_units'] ?? '';
    $project_size = $_POST['project_size'] ?? '';
    $project_area = $_POST['project_area'] ?? '';
    $project_launch = $_POST['project_launch'] ?? null;
    $possession_start_date = $_POST['possession_start_date'] ?? null;
    $min_area_sft = $_POST['min_area_sft'] ?? 0;
    $max_area_sft = $_POST['max_area_sft'] ?? 0;
    $min_price = $_POST['min_price'] ?? '';
    $max_price = $_POST['max_price'] ?? '';
    $rera_id = $_POST['rera_id'] ?? '';
    $contact_email = $_POST['contact_email'] ?? '';
    $contact_mobile = $_POST['contact_mobile'] ?? '';
    $validity = $_POST['validity'] ?? '';
    $project_overview = $_POST['project_overview'] ?? '';

    $no_of_bhk = (!empty($_POST['no_of_bhk']) && is_array($_POST['no_of_bhk'])) 
        ? implode(", ", array_map('trim', $_POST['no_of_bhk'])) : null;

    $project_facing = (!empty($_POST['project_facing']) && is_array($_POST['project_facing'])) 
        ? implode(", ", array_map('trim', $_POST['project_facing'])) : null;

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
    
    if (isset($_POST['saleable_area_sft']) && is_array($_POST['saleable_area_sft'])) {
    $saleable_area_sft = process_area_array($_POST['saleable_area_sft']);
} else {
    $saleable_area_sft = null;
}

    $carpet_area_sft = (!empty($_POST['carpet_area_sft']) && is_array($_POST['carpet_area_sft'])) 
        ? implode(", ", array_map('trim', $_POST['carpet_area_sft'])) : null;

    $price = (!empty($_POST['price']) && is_array($_POST['price'])) 
        ? implode(", ", array_map('trim', $_POST['price'])) : null;

    $property_address = $_POST['property_address'] ?? null;
    $property_address2 = $_POST['property_address2'] ?? null;
    $locality1 = $_POST['locality1'] ?? null;
    $locality2 = $_POST['locality2'] ?? null;
    $locality3 = $_POST['locality3'] ?? null;
    $locality4 = $_POST['locality4'] ?? null;
    $locality5 = $_POST['locality5'] ?? null;

    $amenities = isset($_POST['amenities']) ? implode(", ", $_POST['amenities']) : null;
    $configurations = isset($_POST['configurations']) ? implode(", ", $_POST['configurations']) : null;

    // File Upload for Banner Image
    $banner_image = null;
    if (!empty($_FILES['banner_image']['name'])) {
        $target_dir = "uploads/project_images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $banner_image = $target_dir . basename($_FILES["banner_image"]["name"]);

        if (!move_uploaded_file($_FILES["banner_image"]["tmp_name"], $banner_image)) {
            error_log("Error moving banner image file: " . $_FILES["banner_image"]["name"]);
        }
    }
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$final_images = [];

foreach ($_POST['saleable_area_sft'] as $i => $rows) {
    foreach ($rows as $j => $area) {
        // Check for uploaded file
        if (isset($_FILES['project_images_new']['name'][$i][$j]) &&
            $_FILES['project_images_new']['error'][$i][$j] === UPLOAD_ERR_OK &&
            $_FILES['project_images_new']['size'][$i][$j] > 0
        ) {
            // Process the new uploaded image
            $tmp_name = $_FILES['project_images_new']['tmp_name'][$i][$j];
            $name = $_FILES['project_images_new']['name'][$i][$j];
            $new_path = "uploads/" . uniqid("img_") . "_" . basename($name);
            move_uploaded_file($tmp_name, $new_path);
            $final_images[$i][$j] = $new_path;
        } else {
            // Use existing image if no new file is uploaded
            $final_images[$i][$j] = $_POST['project_images_existing'][$i][$j] ?? '';
        }
    }
}

// Format the $final_images array into the desired string
$formatted_project_images = [];

foreach ($final_images as $group_index => $image_group) {
    // Filter out any empty strings to avoid unnecessary colons
    $filtered_images = array_filter($image_group);
    if (!empty($filtered_images)) {
        // Join images in the same group with a colon
        $formatted_project_images[] = implode(":", $filtered_images);
    }
}

// Join all groups with a comma
$project_images = implode(",", $formatted_project_images);

// Optional: Log the final string
error_log("Final project_images (formatted): $project_images");



    $bank_names = (!empty($_POST['bank_name']) && is_array($_POST['bank_name']))
        ? implode(", ", array_map('trim', $_POST['bank_name'])) : null;

    $final_bank_documents = [];

// Create upload directory if not exists
$target_dir = "uploads/bank_documents/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

// Loop through each bank form entry
foreach ($_POST['bank_name'] as $i => $bank_name) {
    $existing_path = $_POST['existing_bank_document'][$i] ?? null;
    $uploaded_path = null;

    // Check if a new file was uploaded for this index
    if (!empty($_FILES['bank_document']['name'][$i])) {
        $file_tmp = $_FILES['bank_document']['tmp_name'][$i];
        $file_name = basename($_FILES['bank_document']['name'][$i]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $uploaded_path = $target_file;
        } else {
            error_log("Error uploading bank document: " . $file_name);
        }
    }

    // Final decision: Use uploaded path or fallback to existing
    $final_bank_documents[] = $uploaded_path ?: $existing_path;
}

// Convert to string for DB insert
$bank_document_paths = !empty($final_bank_documents) ? implode(", ", $final_bank_documents) : null;

error_log("Bank docs (formatted): $bank_document_paths");

   
    // End of Bank Name and Document Section

    // Update query with prepared statement
    $sql = "UPDATE builder_panel_projects_table SET 
                builder_name = ?,
                project_name = ?,
                project_type = ?,
                construction_status = ?,
                project_link = ?,
                project_location = ?,
                configurations = ?,
                no_of_units = ?,
                project_size = ?,
                project_area = ?,
                project_launch = ?,
                possesion_start_date = ?,
                min_area_sft = ?,
                max_area_sft = ?,
                min_price = ?,
                max_price = ?,
                rera_id = ?,
                contact_email = ?,
                contact_mobile = ?,
                validity = ?,
                banner_image = COALESCE(?, banner_image),
                project_overview = ?,
                project_images = COALESCE(?, project_images),
                no_of_bhk = ?,
                project_facing = ?,
                saleable_area_sft = COALESCE(?, saleable_area_sft),
                carpet_area_sft = ?,
                price = ?,
                amenities = ?,
                property_address = ?,
                property_address2 = ?,
                locality1 = ?,
                locality2 = ?,
                locality3 = ?,
                locality4 = ?,
                locality5 = ?,
                bank_name = ?,
                bank_document = COALESCE(?, bank_document),
                updated_at = CURRENT_TIMESTAMP
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die(json_encode(["success" => false, "error" => "SQL Prepare Error: " . $conn->error]));
    }

    // Bind parameters
    if (!$stmt->bind_param(
        "ssssssssissssiidssssssssssssssssssssssi", 
        $builder_name, $project_name, $project_type, $construction_status,
        $project_link, $project_location, $configurations, $no_of_units, $project_size, $project_area,
        $project_launch, $possession_start_date, $min_area_sft, $max_area_sft,
        $min_price, $max_price, $rera_id, $contact_email, $contact_mobile,
        $validity, $banner_image, $project_overview, $project_images,
        $no_of_bhk, $project_facing, $saleable_area_sft, $carpet_area_sft,
        $price, $amenities, $property_address, $property_address2,
        $locality1, $locality2, $locality3, $locality4, $locality5,
        $bank_names, $bank_document_paths, $project_id
    )) {
        die(json_encode(["success" => false, "error" => "Bind Param Error: " . $stmt->error]));
    }

    // Execute
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Project updated successfully."]);
    } else {
        error_log("SQL Execution Error: " . $stmt->error);
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
