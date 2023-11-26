<?php
include '../includes/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resource_name = $_POST["resource_name"];
    $description = $_POST["description"];
    $category = $_POST["category"];

    // Specify the target directory
    $target_directory = "resources/";

    // Get the original file name from the uploaded file
    $original_file_name = $_FILES["file"]["name"];

    // Construct the full path to save the file
    $file_path = $target_directory . $original_file_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        // File uploaded successfully
        // Insert resource details into the database
        $upload_date = date("Y-m-d H:i:s"); // Current date and time

        // SQL queries to insert data
        $sql = "INSERT INTO resources (resource_name, description, category, file_path, upload_date) VALUES ('$resource_name', '$description', '$category', '$file_path', '$upload_date')";

        $result = $conn->query($sql);

        if ($result) {
            // Redirect back
            header("Location: resource_repository.php");
            exit;
        } else {
            echo "Error inserting data into the database.";
        }
    } else {
        echo "Error uploading file.";
    }
}
