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
<?php
//Query to get the number total number of member who are under cyber security department
$sql_security = "SELECT COUNT(*) AS totalCyber FROM members WHERE category = 'cyber security'";
$cyberResult = mysqli_query($conn, $sql_security);
$totalCyber = 0;
if (mysqli_num_rows($cyberResult) > 0) {
    $row_Cyber = mysqli_fetch_assoc($cyberResult);
    $totalCyber = $row_Cyber["totalCyber"];
}
//Query to find total number of members under web development department
$sql_web = "SELECT COUNT(*) AS totalweb FROM members WHERE category = 'Web Development'";
$webResult = mysqli_query($conn, $sql_web);
$totalweb = 0;
if (mysqli_num_rows($webResult) > 0) {
    $row_web = mysqli_fetch_assoc($webResult);
    $totalweb = $row_web["totalweb"];
}
//total member in Computer Maintenance
$sqlcomp = "SELECT COUNT(*) AS totalcomp FROM members WHERE category = 'comp maintenance'";
$compresult = mysqli_query($conn, $sqlcomp);
$totalcomp = 0;
if (mysqli_num_rows($compresult) > 0) {
    $rowcomp = mysqli_fetch_assoc($compresult);
    $totalcomp = $rowcomp["totalcomp"];
}
//total member in graphics designing
$sql_graphics = "SELECT COUNT(*) AS total_graphics FROM members WHERE category = 'graphics designing'";
$graphics_results = mysqli_query($conn, $sql_graphics);
$total_graphics = 0;
if (mysqli_num_rows($graphics_results) > 0) {
    $row_graphics = mysqli_fetch_assoc($graphics_results);
    $total_graphics = $row_graphics['total_graphics'];
}
//selecting active members in graphics designing department
$activegraphics = "SELECT COUNT(*) AS graphics_total FROM members WHERE category = 'graphics designing' AND payment_status = 1";
$graphicsresult = mysqli_query($conn, $activegraphics);
$graphics_total = 0;
if (mysqli_num_rows($graphicsresult) > 0) {
    $row_graphicsactive = mysqli_fetch_assoc($graphicsresult);
    $graphics_total = $row_graphicsactive['graphics_total'];
}
//total members in programming department
$sql_programming = "SELECT COUNT(*) AS total_programming FROM members WHERE category = 'programming'";
$programming_result = mysqli_query($conn, $sql_programming);
$total_programming = 0;
if (mysqli_num_rows($programming_result) > 0) {
    $row_programming = mysqli_fetch_assoc($programming_result);
    $total_programming = $row_programming['total_programming'];
}
//selecting all active members in programming
$activepro = "SELECT COUNT(*) AS pro_total FROM members WHERE category = 'programming' AND payment_status = 1";
$proresult = mysqli_query($conn, $activepro);
$pro_total = 0;
if (mysqli_num_rows($proresult) > 0) {
    $row_proactive = mysqli_fetch_assoc($proresult);
    $pro_total = $row_proactive['pro_total'];
}

?>

<body>
    <?php include 'nav.php'; ?>
    <main>
        <div class="container mt-4">
            <h2>Departments</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-warning">
                        <div class="card-header">
                            <h5 class="text-primary">Cyber Security</h5>
                        </div>
                        <div class="card-body">
                            <?php echo $totalCyber; ?>
                            <p class="card-text">Protecting digital assets and data.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary">
                        <div class="card-header">
                            <h5 class="text-warning">Web Development</h5>
                        </div>
                        <div class="card-body">
                            <?php echo $totalweb; ?>
                            <p class="card-text">Creating and maintaining websites.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-light">
                        <div class="card-header">
                            <h5 class="card-title">Computer Maintenance</h5>
                        </div>
                        <div class="card-body">
                            <?php echo $totalcomp; ?>
                            <p class="card-text">Ensuring hardware and software functionality.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-secondary text-light">
                        <div class="card-header">
                            <h5 class="card-title">Graphic Design</h5>
                        </div>
                        <div class="card-body">
                            <?php echo '<h1 class="fw-bold"> Total: ' . $total_graphics . '</h1>' ?>
                            <?php echo '<h4 class="fw-bold fst-italic"> Total Active: ' . $graphics_total . '</h4>' ?>
                            <p class="card-text">Creating visual content and designs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-light">
                        <div class="card-header">
                            <h5 class="card-title">Programming</h5>
                        </div>
                        <div class="card-body">
                            <?php echo '<h1 class="fst-italic"> Total: ' . $total_programming . '</h1>' ?>
                            <?php echo '<h4 class="fw-bold fst-italic"> Total Active: ' . $pro_total . '</h4>' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>