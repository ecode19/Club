<?php
// ... (session start and database connection)
session_start();

include '../includes/config.php';

// Check if the user is logged in
if (!isset($_SESSION['RegNo'])) {
    header("Location: ../login.php");
    exit();
}
$username = $_SESSION['RegNo'];
// Get the username from the session
// Retrieve the username from the session
if ($_SESSION['usertype'] !== 'admin') {
    header('Location: unauthorized.php');
    exit();
}

// Retrieve payment status from the database based on the logged-in member
$sql = "SELECT payment_status FROM members WHERE RegNo = ''";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $paymentStatus = $row['payment_status'];
} else {
    // Handle database query error
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="../img/logo.jpg" />

    <script src="../jquery/js/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="../jquery/css/dataTables.bootstrap5.min.css">
    <script src="../jquery/js/jquery.dataTables.min.js"></script>
    <script src="../jquery/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="preloader.css">

    <title>Admin Panel</title>
</head>
<?php
// Handle form submission
if (isset($_POST['payment_update'])) {
    // Get the list of member IDs
    $memberIds = $_POST['member_ids'];
    foreach ($memberIds as $memberId) {
        // Check if the checkbox is checked
        $paymentStatus = isset($_POST['mark_paid'][$memberId]) ? 1 : 0;

        // Update the payment status in the database
        $sql = "UPDATE members SET payment_status = $paymentStatus WHERE member_id = $memberId";

        // Execute the query and check for errors
        if ($conn->query($sql) !== TRUE) {
            echo "Error updating record: " . $conn->error;
        } else {
            $successMessage = 'Payment Status Updated';
        }
    }
}
//fetching user admin data
$admin_data = "SELECT * FROM members WHERE RegNo = '$username' ";
$admin_query = mysqli_query($conn, $admin_data);
if (mysqli_num_rows($admin_query) > 0) {
    $admin_info = mysqli_fetch_assoc($admin_query);
    $adminName = $admin_info['lastname'] . ", " . $admin_info['firstname'];
    $payment_status = $admin_info['payment_status'];
}
// Query to get the total number of registered numbers
$sql_members = "SELECT COUNT(*) AS total_members FROM members";
$result_members = $conn->query($sql_members);
$total_members = 0;
if ($result_members->num_rows > 0) {
    $row_members = $result_members->fetch_assoc();
    $total_members = $row_members["total_members"];
}

//Query to get the total number Departments
$sql_departments = "SELECT COUNT(*) AS total_departments FROM departments";
$department_results = mysqli_query($conn, $sql_departments);
$total_departments = 0;
if (mysqli_num_rows($department_results) > 0) {
    $row_department = mysqli_fetch_assoc($department_results);
    $total_departments = $row_department["total_departments"];
}
//counting all active members
$sql_active = "SELECT * FROM members WHERE payment_status =1";
$result_active = $conn->query($sql_active);
$total_active = $result_active->num_rows;
?>

<!DOCTYPE html>
<html>

<body>
    <?php if ($payment_status == 1) : ?>
    <?php include 'nav.php'; ?>
    <main>
        <div class="container">
            <div class="dropdown text-end mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="teachers.php">Profile</a></li>
                    <li><a class="dropdown-item" href="#"><?php echo $adminName;  ?></a></li>
                    <hr>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="mt-3">
                </div>
                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fa fa-user-graduate text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-1 fw-bold"><?php echo $total_members; ?></div>
                                <h5>Registered Member</h5>
                                <hr>
                                <small><a href="member_list.php"
                                        class="text-decoration-none fs-5 text-dark">View</a></small>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fa fa-users text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-1 fw-bold"><?php echo $total_active; ?></div>
                                <h5>Active Members</h5>
                                <hr>
                                <small><a href="member_list.php"
                                        class="text-decoration-none fs-5 text-dark">View</a></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fas fa-university text-primary fa-2x" aria-hidden="true"></i>
                                <div class="fs-1 fw-bold"><?php echo $total_departments; ?></div>
                                <h5>Departments</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card text-light shadow hv">
                        <div class="card-body">
                            <div class="text-dark text-center">
                                <i class="fas fa-signal text-primary fa-2x" aria-hidden="true"></i>
                                <div class="text-danger fs-2 fw-bold light"><?php echo '345' ?></div>
                                <h5>Payments</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post">
                <a href="member_list.php" class="text-decoration-none fw-bold text-dark">Member list</a>
                <table id="memberTable" class="table table-primary table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>RegNo</th>
                            <th>FULLNAME</th>
                            <th>Payment Status</th>
                            <th>Mark as Paid</th>
                            <th>Usertype</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fetch member list from the database -->
                        <?php
                            $sql = "SELECT * FROM members";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                $memberId = $row['member_id'];
                                $regNo = $row['RegNo'];
                                $name = $row['firstname'] . ' ' . $row['lastname'];
                                $paymentStatus = $row['payment_status'];
                                $usertype = $row['usertype'];
                            ?>
                        <tr>
                            <td><?php echo $memberId; ?></td>
                            <td><?php echo $regNo; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $paymentStatus == 1 ? "Paid" : "Unpaid"; ?></td>
                            <td>
                                <input type="checkbox" name="mark_paid[<?php echo $memberId; ?>]" value="1"
                                    <?php echo $paymentStatus == 1 ? 'checked' : ''; ?>>
                            </td>
                            <td><?php echo $usertype; ?></td>
                            <input type="hidden" name="member_ids[]" value="<?php echo $memberId; ?>">
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if (isset($successMessage)) : ?>
                <div class="alert alert-success p-3">
                    <?php echo $successMessage; ?>
                </div>
                <?php endif; ?>
                <button type="submit" name="payment_update" class="btn color mb-3">Update Payment Status</button>
            </form>
        </div>
        <?php else : ?>
        <div class="container">
            <div class="container">
                <h3 class="mt-5 fw-bold">MWECAU ICT CLUB SYSTEM (MICS)</h3>
                <div class="alert alert-warning">
                    <strong><?php echo 'Hi,' . " " . $adminName;  ?> (Admin)</strong>
                    <p class="text-danger fs-5 fw-bold">Your access is restricted due to unpaid status. Please contact
                        the
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
        </div>
        <?php endif; ?>
    </main>
    <script>
    $(document).ready(function() {
        $('#memberTable').DataTable();
    });

    window.addEventListener('load', function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        loadingOverlay.style.display = 'none';
    });

    window.addEventListener('load', function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        loadingOverlay.style.display = 'none';
    });
    </script>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>