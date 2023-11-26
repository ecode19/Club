<?php include '../includes/config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Active Members | MICs</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="preloader.css">

    <script src="../jquery/js/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="../jquery/css/dataTables.bootstrap5.min.css">
    <script src="../jquery/js/jquery.dataTables.min.js"></script>
    <script src="../jquery/js/dataTables.bootstrap5.min.js"></script>
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="../img/logo.jpg" />

</head>

<body>
    <?php include 'nav.php'; ?>
    <main>
        <div class="container mt-5">
            <h2>Active Members</h2>
            <hr>
            <table id="#memberTable" class="table table-primary table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>REGISTRATION NUMBER</th>
                        <th>FULLNAME</th>
                        <th>COURSE</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM members WHERE payment_status = 1";
                $result = $conn->query($sql);
                $totalMembers = $result->num_rows;
                while ($row = $result->fetch_assoc()) {
                    $memberId = $row['member_id'];
                    $regNo = $row['RegNo'];
                    $name = $row['firstname'] . ' ' . $row['lastname'];
                    $course = $row['course'];
                ?>
                <tr>
                    <td><?php echo $memberId; ?></td>
                    <td><?php echo $regNo; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $course; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
            <p class="fw-bold">Total Active Members: <?php echo $totalMembers; ?></p>

            <!-- Add a button to trigger the print functionality -->
            <button class="btn color" onclick="printActiveMembers()">Print</button>

            <script>
            function printActiveMembers() {
                window.print();
            }
            </script>

        </div>
    </main>
    <script>
    $(document).ready(function() {
        $('#memberTable').DataTable();
    });
    </script>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="preloader.js"></script>
</body>

</html>

<div class="card-body d-flex">
    <img src="" class="img-fluid w-25 rounded-circle" alt="Profile Picture">
    <div class="mx-auto">
        <p><?php echo $userDetails['firstname']; ?></p>
        <p><?php echo $userDetails['lastname']; ?></p>
        <!-- Other user details -->
    </div>
</div>