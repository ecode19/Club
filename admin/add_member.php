<?php
include '../includes/config.php';
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
                  // Establish a connection to the database
                  $conn = mysqli_connect("localhost", "root", "", "ict_club");
                  if (isset($_POST['submit'])) {
                    // Variable declaration
                    $regNo = $_POST['regNo'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $course = $_POST['course'];
                    $category = $_POST['category'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirmPassword'];
                    $usertype = $_POST['usertype'];
                    // Performing Validation
                    $errors = array();
                    // Checking if registration number matches the required format
                    if (empty($regNo)) {
                      $errors['regNo'] = "Fill in Registration number";
                    } elseif (!preg_match("/^T\/DEG\/20\d{2}\/\d{4}$/", $regNo)) {
                      $errors['regNo'] = "Invalid registration number format. Please use T/DEG/YYYY/NNNN.";
                    }
                    if (empty($firstname)) {
                      $errors['firstname'] = "Please Enter First Name";
                    }
                    if (empty($firstname)) {
                      $errors['lastname'] = "Please Enter Last Name";
                    }
                    if (empty($course)) {
                      $errors['course'] = "Please Enter Last Name";
                    }
                    // Check if password matches the confirmation
                    if ($password !== $confirmPassword) {
                      $errors[] = "Password Mismatch.";
                    }

                    /* Check if the user is already registered
                    $query = "SELECT * FROM members WHERE regNo = '$regNo' AND firstname = '$firstname";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                      $errors[] = "User with this registration number is already registered.";
                    }
                    */

                    //checking if user already exit on the database
                    $query = "SELECT * FROM members WHERE RegNo ='$regNo' AND firstname = '$firstname'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                      $errors['regNo'] = " $regNo Already registered</span>";
                    }
                    // If there are no errors, proceed with registration
                    if (empty($errors)) {
                      // Hashing the password
                      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                      // Insert data into the database
                      $sql = "INSERT INTO members (regNo, firstname, lastname, course, category, password,usertype) VALUES ('$regNo', '$firstname', '$lastname', '$course', '$category', '$hashedPassword','$usertype')";
                      $result = mysqli_query($conn, $sql);
                      // Check if the query was successful
                      if ($result) {
                        echo '<div class="alert alert-success ">Registration Confirmed</div> <br>';
                      } else {
                        echo '<div class="alert alert-danger">Sorry, you are not registered</div> <br>';
                      }
                    }
                  }
                  ?>
                <h5 class="text-primary fs-3">Register new Member</h5>
                <div class="row">
                <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="regNo">REGISTRATION NUMBER</label>
                        <input type="text" class="form-control" name="regNo" placeholder="Enter First Name">
                        <?php if(isset($errors['regNo'])) { ?>
                            <span class="text-danger p-1"> <?php echo $errors['regNo'];?></span>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter First Name">
                        <?php if(isset($errors['firstname'])) { ?>
                            <span class="text-danger p-1"> <?php echo $errors['firstname'];?></span>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="Last Name">Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name">
                        <?php if (isset($errors['lastname'])) { ?>
                            <span class="text-danger p-1"><?php echo $errors['lastname'];?></span>
                       <?php } ?>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="GENDER">Course</label>
                        <select class="form-select" name="course">
                        <option selected>Select</option>
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
                        <option selected>Select</option>
                        <option value="Graphics Designing">Graphics Designing</option>
                        <option value="Programming">Programming</option>
                        <option value="Cyber Security">Cyber Security</option>
                        <option value="Comp Maintenance">Comp Maintenance</option>
                        <option value="Web Development">Web Development</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        <?php if(isset($errors['firstname'])) { ?>
                            <span class="text-danger p-1"> <?php echo $errors['firstname'];?></span>
                        <?php } ?>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="fw-bold" for="confirmPassword">CONFIRM PASSWORD</label>
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Re-type your password">
                        <?php if(isset($errors['firstname'])) { ?>
                            <span class="text-danger p-1"> <?php echo $errors['firs'];?></span>
                        <?php } ?>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <label class="fw-bold" for="class">Assign Role</label>
                        <select class="form-select" name="usertype">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-lg mt-5 fw-bold" style="background-color:#19c357">REGISTER</button>
            </form>
        </div>
        </div>
        <script src="../bootstrap/js/bootstrap.bundle.js"></script>
        <script src="preloader.js"></script>
</body>

</html>