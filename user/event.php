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
      <h2>Club Events</h2>
      <hr>
      <?php

      $query = "SELECT * FROM events";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='mb-3'>";
          echo "<div class='card mb-3'>";
          echo "<div class='card-header'>" . $row['event_name'] . "</div>";
          echo "<div class='card-body'>";
          echo "<p class='card-text'>" . $row['event_date'] . "</p>";


          echo "</div></div></div></div>";
        }
      } else {
        echo "<p class='fst-italic fs-4'>No club event scheduled yet.</p>";
      }

      mysqli_close($conn);
      ?>
    </div>
  </main>
  <script src="./bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>