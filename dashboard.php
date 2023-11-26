<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['RegNo'])) {
  // User is not logged in, redirect to login page
  header("Location: dashboard.php");
  exit();
}

// Get the username from the session
$username = $_SESSION['RegNo'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome | Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $_SESSION['RegNo']; ?>!</h1>

  <p>This is your dashboard. You have successfully logged in.</p>

  <a href="logout.php">Logout</a>
</body>
</html>
