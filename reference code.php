<?php
// ... (session start and database connection)
session_start();

include '../includes/config.php';

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
    <title>Member Dashboard</title>
    <!-- Add your CSS styles and other head content here -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <h1>Welcome, <?php echo $firstname . ' ' . $lastname; ?></h1>
    <p>Username: <?php echo $username; ?></p>
    <p>Payment Status: <?php echo $paymentStatus == 1 ? "Active" : "Inactive"; ?></p>
    
    <?php if ($paymentStatus == 1): ?>
        <!-- Display member panel content -->
        <div>
            <!-- Your member panel content goes here -->
        </div>
    <?php else: ?>
        <p>Your access is restricted due to unpaid status. Please contact the admin.</p>
    <?php endif; ?>

</body>
</html>


<?php
// ... (session start and authentication for admin)

// Handle form submission
if (isset($_POST['payment_update'])) {
    // Get the list of member IDs
    $memberIds = $_POST['member_ids'];

    foreach ($memberIds as $memberId) {
        // Check if the checkbox is checked
        $paymentStatus = isset($_POST['mark_paid'][$memberId]) ? 1 : 0;

        // Update the payment status in the database
        $sql = "UPDATE members SET payment_status = $paymentStatus WHERE ID = $memberId";
        
        // Execute the query and check for errors
        if ($conn->query($sql) !== TRUE) {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <!-- Add your CSS styles and other head content here -->
</head>
<body>
    <h1>Admin Panel</h1>
    <a href="../logout.php" class="text-decoration-none fw-bold text-dark">Logout</a>
    <a href="member_list.php" class="text-decoration-none fw-bold text-dark">Member list</a>
    <form method="post">
        <table class="table table-primary table-hover table-striped table-bordered">
            <tr>
                <th>Member ID</th>
                <th>Name</th>
                <th>RegNo</th>
                <th>Payment Status</th>
                <th>Mark as Paid</th>
            </tr>
            <!-- Fetch member list from the database -->
            <?php
            $sql = "SELECT * FROM members";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $memberId = $row['ID'];
                $name = $row['firstname'] . ' ' . $row['lastname'];
                $regNo = $row['RegNo'];
                $paymentStatus = $row['payment_status'];
            ?>
            <tr>
                <td><?php echo $memberId; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $regNo; ?></td>
                <td><?php echo $paymentStatus == 1 ? "Paid" : "Unpaid"; ?></td>
                <td>
                    <input type="checkbox" name="mark_paid[<?php echo $memberId; ?>]" value="1"
                        <?php echo $paymentStatus == 1 ? 'checked' : ''; ?>>
                </td>
                <input type="hidden" name="member_ids[]" value="<?php echo $memberId; ?>">
            </tr>
            <?php } ?>
        </table>
        <button type="submit" name="payment_update" class="btn btn-success mb-3">Update Payment Status</button>
    </form>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
