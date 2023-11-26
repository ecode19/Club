<?php
include '../includes/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];

    $eventInsert ="INSERT INTO events (event_name) VALUES ('$event_name')";
    $eventResult = mysqli_query($conn,$eventInsert);

    if ($eventResult) {
    header("Location: event_management.php");
    exit;
    }else {
        echo 'error inserting';
    }
   
}
?>
