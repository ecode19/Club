<?php include '../includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments | MICs</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="../img/logo.jpg" />

    <script src="../jquery/js/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="../jquery/css/dataTables.bootstrap5.min.css">
    <script src="../jquery/js/jquery.dataTables.min.js"></script>
    <script src="../jquery/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="preloader.css">
</head>

<body>
    <?php include 'userNav.php'; ?>
    <main>
        <div class="container mt-5">
            <?php
            // Retrieve resources from the database
            $sql = "SELECT * FROM resources";
            $result = $conn->query($sql);
            // Checking if there are rows in the result set
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='container justify-contents-center'";
                    echo "<div class='card mb-3'>";
                    echo "<h5 class='card-header bg-secondary text-light shadow'>Resource Name: " . $row["resource_name"] . "</h5>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'>" . $row["description"] . "</p>";
                    echo "<p class='card-text'><small class='text-muted'>Category: " . $row["category"] . " | Uploaded on " . $row["upload_date"] . "</small></p>";
                    echo "<a href='" . $row["file_path"] . "' class='btn btn-primary' target='_blank'>Download</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {

                echo '<div class="alert alert-secondary fw-bold fst-italic shadow">NO RESOURCES POSTED YET</div>';
            }
            ?>
        </div>
    </main>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>