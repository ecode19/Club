<?php
include '../includes/config.php';
// Handle announcement posting
if (isset($_POST['post_announcement'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $posted_at = date('Y-m-d H:i:s');

    //storing erro messages 
    $errors = array();
    if (empty($title)) {
        $errors ['title'] = "Please Insert Annoncement Title";
    }
    if (empty($content)) {
        $errors [''] = "Announcement Content Can't be empty";
    }

    $query = "INSERT INTO announcements (title, content, posted_at) 
          VALUES ('$title', '$content','$posted_at')";


    if (mysqli_query($conn, $query)) {
        echo "<p class='text-success'>Announcement posted successfully!</p>";
    } else {
        echo "<p class='text-danger'>Error posting announcement: " . mysqli_error($conn) . "</p>";
    }
    header("Location: post_announcement.php");

    mysqli_close($conn);
}
?>