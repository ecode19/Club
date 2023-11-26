<?php
require_once '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member list | MICs</title>
    <!--links-->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="preloader.css">
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="../img/logo.jpg" />

    <script src="../jquery/js/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="../jquery/css/dataTables.bootstrap5.min.css">
    <script src="../jquery/js/jquery.dataTables.min.js"></script>
    <script src="../jquery/js/dataTables.bootstrap5.min.js"></script>

    <style>
        main {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <main>
        <div class="container">
            <h2 class="mt-5 fw-bold text-dark"> ICT CLUB REGISTERED MEMBERS</h2>
            <table id="memberTable" class="table table-primary table-hover table-striped table-bordered table-responsive">
                <thead>
                    <tr class="fw-bold">
                        <td>S/N</td>
                        <td>REGISTRATION NUMBER</td>
                        <td>FIRST NAME</td>
                        <td>LAST NAME</td>
                        <td>COURSE</td>
                        <td>DEPARTMENT</td>
                        <td>ACTION</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //code to delete from the database
                    if (isset($_GET['ID'])) {
                        $ID = $_GET['ID'];
                        $delete = "DELETE FROM `members` WHERE `member_id`= '$ID'";
                        $delete_result = mysqli_query($conn, $delete);
                    }
                    $sql = "SELECT * FROM members";
                    $query = $conn->query($sql);
                    $result = mysqli_num_rows($query);

                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "
                    <tr>
                    <td class='fw-bold'>" . $data['member_id'] . "</td>
                    <td>" . $data['RegNo'] . "</td>
                    <td>" . $data['firstname'] . "</td>
                    <td>" . $data['lastname'] . "</td>
                    <td>" . $data['course'] . "</td>
                    <td>" . $data['category'] . "</td>
                    <td>
                    <a href='member_update.php?updateID=" . $data['member_id'] . "' class='btn btn-warning mt-3'> <i class='fa fa-pencil'></i> </a>
                    <a href='member_list.php? ID=" . $data['member_id'] . "' class='btn btn-danger mt-3'> <i class='fa fa-remove'></i> </a>
                    </td>
                    </tr>                   
                    ";
                        }
                    }
                    ?>
                </tbody>
            </table>
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