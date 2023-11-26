<?php include '../includes/config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Post Announcement | MICs</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="preloader.css">
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <main>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    // Get the announcement ID from the form
    $announcementId = $_POST['announcement_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM announcements WHERE id = $announcementId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Redirect back to the page with announcements
        echo 'deleted';
    } else {
        // Handle delete error
        echo "Error deleting announcement: " . mysqli_error($conn);
    }
}
?>
        <div class="container mt-5">
            <h3>Create New Announcement</h3>
            <form action="process.php" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control mt-3" id="title" name="title">
                    <?php if (isset($errors['title'])) { ?>
                        <span class="text-danger"><?php echo $errors['title'];?></span>
                  <?php  } ?>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control mt-3" id="content" name="content" rows="4"></textarea>
                </div>
                <button type="submit" class="btn color mt-3" name="post_announcement">Post Announcement</button>
            </form>
        </div>
    </div>
    <div class="container mt-5">
        <h4>Posted Announcements</h4>
        <?php 
        $query = "SELECT * FROM announcements";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='mb-3'>";
                echo "<div class='card mb-3'>";
                echo "<div class='card-header bg-primary'>" . $row['title'] . "</div>";
                echo "<div class='card-body'>";
                echo "<p class='card-text'>" . $row['content'] . "</p>";
                echo "<div class='mb-3'>";
                
                // Add the delete button and form
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='announcement_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='btn btn-danger' name='delete'>Delete</button>";
                echo "</form>";
                
                echo "<p class='card-text text-muted'>Posted on " . $row['posted_at'] . "</p>";
                echo "</div></div></div></div>";
            }
        } else {
            echo '<span class="text-primary fs-4 fst-italic">No Announcement Posted yet</span>';
        }
        ?>
    </div>
</main>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>