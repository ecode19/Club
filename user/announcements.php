<?php
session_start();
require_once '../includes/config.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Announcements</title>
  <?php include 'titles.php';?>
</head>

<body>
  <main>
  <?php include 'userNav.php';?>
    <div class="container mt-5">
      <h2>Announcements</h2>
      <hr>
      <?php

      if (isset($_POST['mark_read'])) {
        $announcementId = $_POST['announcement_id'];
        $userId = 1; // Replace with the actual user ID (assuming user ID 1 for demo)

        // Update the read_status column in the database for the selected announcement and user
        $updateQuery = "UPDATE announcements SET read_status = 1 WHERE id = $announcementId";
        mysqli_query($conn, $updateQuery);
      }

      $query = "SELECT * FROM announcements";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='mb-3'>";
          echo "<div class='card mb-3'>";
          echo "<div class='card-header'>" . $row['title'] . "</div>";
          echo "<div class='card-body'>";
          echo "<p class='card-text'>" . $row['content'] . "</p>";
          echo "<p class='card-text text-muted'>Posted on " . $row['posted_at'] . "</p>";

          // Retrieve the admin's username who posted the announcement
          $adminId = $row['posted_by'];
          $adminQuery = "SELECT lastname FROM members";
          $adminResult = mysqli_query($conn, $adminQuery);

          if ($adminResult && mysqli_num_rows($adminResult) > 0) {
            $adminRow = mysqli_fetch_assoc($adminResult);
            echo "<p class='card-text'>Posted by Admin: " . $adminRow['lastname'] . "</p>";
          } else {
            echo "<p class='card-text'>Posted by Admin: Unknown</p>";
          }

          $readStatusClass = $row['read_status'] == 1 ? 'text-success' : 'text-danger';
          echo "<p class='card-text {$readStatusClass}'>" . ($row['read_status'] == 1 ? 'Read' : 'Unread') . "</p>";

          echo "<form action='' method='post'>";
          echo "<input type='hidden' name='announcement_id' value='" . $row['id'] . "'>";
          echo "<button type='submit' class='btn btn-primary' name='mark_read'>Mark as Read</button>";
          echo "</form>";

          echo "</div></div>";
        }
      } else {
        echo "<p class='fst-italic fs-4'>No announcements posted yet.</p>";
      }

      mysqli_close($conn);
      ?>
    </div>
  </main>
  <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>