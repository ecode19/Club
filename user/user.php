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
    // Accessing the image path
    $imagePath = $userDetails['image_path'];
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
        background-color: #2C3592;
    }

    .favcolor {
        color: #2C3592;
    }

    .col-12.col-md-10 .img-fluid {
        border: 3px solid #19c357;
    }

    .col-12.col-md-10.col-lg-6 .card {
        border: 2px solid #2C3592;
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
                        <div class="details text-light color">
                            <h6 class="mx-3 mt-3 fs-6 fw-bold">Club Member</h6>
                        </div>
                        <div class="card-tittle text-center">
                            <h6 class="mx-3 text-decoration-underline fs-6 fw-bold">Informations</h6>
                        </div>
                        <div class="card-body d-flex">
                            <img src="../img/logo.jpg" class="img-fluid rounded-circle mt-auto" alt="Profile Picture"
                                style="width: 130px; height:130px">
                            <div class="mx-auto">
                                <p><strong>RegNo:</strong> <?php echo $_SESSION['RegNo']; ?></p>
                                <p><strong>Full Name: </strong> <?php echo $firstname . " " . $lastname; ?></p>
                                <p><strong>Course:</strong> <?php echo $memberCourse; ?></p>
                                <p><strong>Category:</strong> <?php echo $category; ?></p>
                            </div>
                        </div>
                        <button type="submit" name="update" class="btn color fs-5"><a
                                href="./profile_update.php?updateID=" class="text-white text-decoration-none">Update
                                Profile</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 mt-5">
                    <!-- Your dashboard content goes here -->
                    <h2>Welcome, <small class="favcolor"><?php echo $lastname; ?></small> to your ICT Club Member
                        Dashboard</h2>
                    <p>Here you can access various features and functionalities related to your membership.</p>
                    <p>Feel free to explore and engage with the club activities!
                    <div> <strong>Payment Status:</strong> <span class="text-success fw-bold fs-4">
                            <?php echo $payment_status == 1 ? "Active" : "Inactive"; ?></span></div>
                    </p>
                    <!-- Display posts to users -->
                    <div class="posts">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="post">
                            <h2><?php echo $row['title']; ?></h2>
                            <p><?php echo $row['content']; ?></p>
                            <p><?php echo $row['timestamp']; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h5 class="fw-bold">Fellow <span class="favcolor"> <?php echo $category; ?></span> Member's
            </h5>
            <table class="table bg-info table-hover table-responsive table-bordered table-striped">
                <thead>
                    <tr class="text-dark fw-bold">
                        <td>S/N</td>
                        <td>REGISTRATION NUMBER</td>
                        <td>COURSE</td>
                    </tr>
                </thead>
                <?php
                    $query = "SELECT * FROM members WHERE category = '$category'";
                    $connect = mysqli_query($conn, $query);
                    $num = mysqli_num_rows($connect);
                    if ($num > 0) {
                        while ($data = mysqli_fetch_assoc($connect)) {
                            echo "
                <tr>
                <td>" . $data['member_id'] . "</td>
                <td>" . $data['RegNo'] . "</td>
                <td>" . $data['course'] . "</td>
                </tr>
                ";
                        }
                    }
                    ?>
            </table>
        </div>
    </section>
    <?php else : ?>
    <div class="container">
        <h3 class="mt-5 fw-bold">MWECAU ICT CLUB SYSTEM (MICS)</h3>
        <div class="alert alert-warning">
            Hi, <strong><?php echo  $firstname . " " . $lastname; ?></strong>
            <p class="text-danger fs-5 fw-bold">Your access is restricted due to unpaid status. Please contact the
                admin.</p>
            <p class="">We are Kindly request you to pay your membership Fee. <br>
                Make payment to this number <strong>0624861910</strong> and send payment receipt to
                the following E-mail <strong class="fst-italic">erickmanyasi5@gmail.com.</strong>
                <br> And your account will be activated within a minute.Or Contact Admin <strong>
                    0624861910 <br> THANK YOU.</strong>
            </p>
            <p class=" text-lg-center"><a href="../logout.php" class="btn btn-primary">Go to Login Page</a></p>
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