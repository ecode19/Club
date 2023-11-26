<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Attendance</title>
    <link rel="stylesheet" href="preloader.css">
    <?php include '../user/titles.php'; ?>
    <?php include 'nav.php'; ?>
    <?php include '../includes/config.php'; ?>
</head>

<body>
    <main>
        <div class="container mt-5">
            <h2 class="text-center">Event Details</h2>
            <h3>Event Name: Event 1</h3>
            <p>Event Date: August 20, 2023</p>
            <button class="btn btn-primary text-lg-end">Event Details</button>
            <form action="process_attendance.php" method="post">
                <input type="hidden" name="event_id" value="1"> <!-- Event ID -->
                <div class="form-group">
                    <label for="member_id">Member ID:</label>
                    <input type="text" class="form-control" id="member_id" name="member_id" required>
                </div>
                <button type="submit" class="btn color  mt-3">Mark Attendance</button>
            </form>
        </div>

        <?php

        // Retrieve event details from the database
        $sql = "SELECT * FROM events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='container mt-3'>";
                echo "<div class='card mb-3'>";
                echo "<div class='card-header bg-secondary'> Event ID " . $row['event_id'] . "</div>";
                echo "<div class='card-body'>Event Name: " . $row['event_name'] . "<br><br>";
                echo "Event Date: " . $row["event_date"] . "<br><br>";
            }
        } else {
            echo '<div class="alert alert-secondary fw-bold fst-italic">NO RESOURCES POSTED YET</div>';
        }
        ?>
    </main>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>