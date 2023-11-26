<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST["event_id"];
    $member_id = $_POST["member_id"];
    
    // Insert the attendance record into the database
    // Use appropriate SQL queries to insert data
    
    // Redirect back to the event details page
    header("Location: event_details.php?event_id=$event_id");
    exit;
}
?>
