<?php
// ... (session start, authentication, and database connection)
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminId = $_SESSION['admin_id']; // Assuming admin ID is stored in the session
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Insert the post into the database
    $sql = "INSERT INTO posts (admin_id, title, content, timestamp) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $adminId, $title, $content);
    
    if ($stmt->execute()) {
        echo "Post successfully added.";
    } else {
        echo "Error inserting post: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Post News</title>
    <!-- Add your CSS styles and other head content here -->
</head>
<body>
    <h1>Admin Panel - Post News</h1>

    <form method="post">
        <label for="title">Post Title:</label>
        <input type="text" name="title" required><br>
        
        <label for="content">Post Content:</label>
        <textarea name="content" required></textarea><br>
        
        <button type="submit">Submit Post</button>
    </form>
</body>
</html>
