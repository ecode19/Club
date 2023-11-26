<?php
include '../includes/config.php';

// ... (session start and database connection)
session_start();
$username = $_SESSION['RegNo'];
// Get the username from the session
// Retrieve the username from the session
if ($_SESSION['usertype'] !== 'admin') {
    header('Location: unauthorized.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ICT Club</title>
    <!--links-->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="preloader.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <main>
        <div class="container">
            <form class="mx-5 mt-5" action="" method="POST" autocomplete="off">
                <?php
                ob_start();
                $ID = $_GET['updateID'];

                //fetching information basing on the ID to be displayed on the input fielf
                $update_info = "SELECT * FROM members WHERE member_id = $ID";
                $info_result = mysqli_query($conn, $update_info);
                $info_data =  mysqli_fetch_assoc($info_result);
                //accessing table informations
                $regNo = $info_data['RegNo'];
                $firstname = $info_data['firstname'];
                $lastname = $info_data['lastname'];
                $course = $info_data['course'];
                $category = $info_data['category'];
                $usertype = $info_data['usertype'];

                if (isset($_POST['update'])) {
                    // Variable declaration
                    $regNo = $_POST['regNo'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $course = $_POST['course'];
                    $category = $_POST['category'];
                    $usertype = $_POST['usertype'];

                    $update_query = "UPDATE `members` SET member_id = $ID, RegNo='$regNo', firstname='$firstname', lastname='$lastname',
                     course='$course', category='$category', usertype='$usertype'
                     WHERE member_id = $ID;";
                    $update_result = mysqli_query($conn, $update_query);
                    if ($update_result) {
                        $successMessage = 'Information updated Successfully';
                        echo '<div class="alert alert-success">'. $successMessage. '</div>';
                    }
                }

                ?>
                <h5 class="text-primary fs-3">Register new Member</h5>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="regNo">REGISTRATION NUMBER</label>
                        <input type="text" class="form-control" name="regNo" placeholder="T/DEG/2021/0000" readonly
                            value="<?php echo $regNo; ?>">
                        <?php if (isset($errors['regNo'])) { ?>
                        <span class="text-danger p-1"> <?php echo $errors['regNo']; ?></span>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter First Name"
                            value="<?php echo $firstname; ?>">
                        <?php if (isset($errors['firstname'])) { ?>
                        <span class="text-danger p-1"> <?php echo $errors['firstname']; ?></span>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Last Name">Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name"
                            value="<?php echo $lastname; ?>">
                        <?php if (isset($errors['lastname'])) { ?>
                        <span class="text-danger p-1"><?php echo $errors['lastname']; ?></span>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="GENDER">Course</label>
                        <select class="form-select" name="course">
                            <option selected><?php echo $course; ?></option>
                            <option value="BAGEN">BAGEN</option>
                            <option value="BScCS">BScCS</option>
                            <option value="Biology ICT">Biology ICT</option>
                            <option value="Chemistry ICT">Chemistry ICT</option>
                            <option value="Statistics ICT">Statistics ICT</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <label class="fw-bold" for="class">Category</label>
                        <select class="form-select" name="category">
                            <option selected><?php echo $category; ?></option>
                            <option value="Graphics Designing">Graphics Designing</option>
                            <option value="Programming">Programming</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Comp Maintenance">Comp Maintenance</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <label class="fw-bold" for="class">Assign Role</label>
                        <select class="form-select" name="usertype">
                            <option><?php echo $usertype; ?></option>
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="update" class="btn btn-warning mt-5">Update</button>
            </form>

        </div>
        </div>
        <script src="../bootstrap/js/bootstrap.bundle.js"></script>
        <script src="preloader.js"></script>
</body>

</html>