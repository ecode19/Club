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
    <?php include 'nav.php'; ?>
    <main>
        <div class="container">
            <form action="resources_upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resource_name">Resource Name:</label>
                    <input type="text" class="form-control" id="resource_name" name="resource_name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category">
                        <option value="presentation">Presentation</option>
                        <option value="document">Document</option>
                        <option value="tutorial">Tutorial</option>
                        <!-- Add more categories here -->
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="file">Upload File:</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload Resource</button>
            </form>
        </div>
    </main>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>