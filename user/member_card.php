<?php
require_once '../includes/config.php';
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['RegNo'])) {
    header("Location: ../login.php");
    exit();
}
// Get the username from the session
// Retrieve the username from the session
$username = $_SESSION['RegNo'];
// Query to retrieve user details
$sql = "SELECT * FROM members WHERE RegNo = '" . mysqli_real_escape_string($conn, $username) . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // User found in the database, fetch details
    $userDetails = mysqli_fetch_assoc($result);
    // Accessing the member's course
    $memberCourse = $userDetails['course'];
    $firstname = $userDetails['firstname'];
    $lastname = $userDetails['lastname'];
    $category = $userDetails['category'];
    $payment_status = $userDetails['payment_status'];
} else {
    // User not found in the database
    // Handle this case, e.g., redirect to login page or show an error message.
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Dashboard</title>
    <?php include 'titles.php'; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .color {
            color: #1b0922;
        }

        .col-12.col-md-10 .img-fluid {
            border: 3px solid #19c357;
        }

        .col-12.col-md-10.col-lg-6 .card {
            border: 2px solid #19c357;
            border-radius: 4px;
        }

        .col-12.col-md-12.col-lg-6 h5 {
            border-bottom: 2px solid #1b0922;
        }
    </style>
</head>

<body>
    <?php if ($payment_status == 1) : ?>
        <?php include 'userNav.php'; ?>
        <section class="mt-4 p-4 p-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-6">
                        <div class="card shadow-lg">
                            <div class="details bg-info">
                                <h6 class="mx-3 mt-3 fw-bold text-center" style="font-family: 'Times New Roman', Times, serif;">Mwecau ICT Club</h6>
                            </div>
                            <div class="card-tittle text-center">
                                <h6 class="mx-3 fs-6 fw-bold" style="font-family: 'Times New Roman', Times, serif;">Club Memmbership Card</h6>
                            </div>
                            <div class="card-body d-flex">
                                <div class="">
                                    <p><strong>RegNo:</strong> <?php echo $_SESSION['RegNo']; ?></p>
                                    <p><strong>Full Name: </strong> <?php echo $firstname . " " . $lastname; ?></p>
                                    <p><strong>Course:</strong> <?php echo $memberCourse; ?></p>
                                    <p><strong>Category:</strong> <?php echo $category; ?></p>
                                </div>
                                <div class="mx-auto">
                                    <img src="../img/logo.jpg" class="img-fluid rounded-circle mt-auto" alt="Profile Picture" style="width: 130px; height:130px">
                                </div>
                            </div>
                            <div class="bg-info w-100"><strong>Date Issued:</strong> <?php echo date('m:d:Y'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <div class="container">
            <h3 class="mt-5 fw-bold">MWECAU ICT CLUB SYSTEM (MICS)</h3>
            <div class="alert alert-warning">
                Hi, <strong><?php echo  $firstname . ", " . $lastname; ?></strong>
                <p class="text-danger fs-5 fw-bold">Your access to print membership Card is restricted due to unpaid status. Please contact the admin.</p>
                <p><a href="../logout.php" class="btn btn-primary btn-lg">Logout</a></p>
                </p>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <footer>
            <p>&copy; <?php echo date('Y'); ?> ICT Club. All rights reserved.</p>
        </footer>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>