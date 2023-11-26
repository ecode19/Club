<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | ICT Club</title>
  <!-- for title img -->
  <link rel="shortcut icon" type="image/icon" href="img/mwecau.png" />

  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .container input[type="text"],
    .form-container input[type="password"] {
      height: 50px;
      border-radius: 10px;
      padding: 25px;
      font-size: 16px;
      background: transparent;
      background-color: rgba(255, 255, 255, 0.7);
      outline: none;
    }

    #contactPage {
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .form {
      background: transparent;
      border: 2px solid rgba(255, 255, 255, .5);
      border-radius: 20px;
      backdrop-filter: blur (50px);
      box-shadow: 0 0 15px rgba(241, 249, 7, 0.9);
    }
  </style>
</head>

<body class="text-dark text-capitalize">
  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow" style="background-color: #19c357;">
    <div class="container">
      <a href="index.html" class="navbar-brand text-warning">
        <h3 class="fw-bold">Mwecau-ICT Club </h3> <span class="fs-6 mb-4 text-white fst-italic">"Inspire, Innovate,
          Integrate"</span>
      </a>
      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">HOME</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">ABOUT US</a></li>
          <li class="nav-item"><a href="services.php" class="nav-link">OUR PROJECTS </a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">CONTACT US</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--End Navbar-->
  <section id="register" class="Home">
    <div class="row">
      <div id="contac">
        <div class="container">
          <center>
            <div class="form col-lg-6 my-5">
              <fieldset>

                <form action="#" method="POST">
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
                      $sql = "INSERT INTO members (regNo, firstname, lastname, course, category, password) VALUES ('$regNo', '$firstname', '$lastname', '$course', '$category', '$hashedPassword')";
                      $result = mysqli_query($conn, $sql);
                      // Check if the query was successful
                      if ($result) {
                        echo '<div class="alert alert-success ">Registration Confirmed</div> <br>';
                        header("Location: login.php");
                      } else {
                        echo '<div class="alert alert-danger">Sorry, you are not registered</div> <br>';
                      }
                    }
                  }
                  ?>
                  <label for="name" class="fw-bold">REGISTRATION NUMBER</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <input type="text" name="regNo" class="form-control" placeholder="Eg: T/DEG/YYYY/NNNN" autocomplete="off">
                      <?php if (isset($errors['regNo'])) { ?>
                        <div class="alert alert-danger p-1"><?php echo $errors['regNo']; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <label for="name" class="fw-bold text-light">FIRST NAME</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <input type="text" name="firstname" class="form-control" placeholder="Enter First Name" autocomplete="off">
                      <?php if (isset($errors['firstname'])) { ?>
                        <div class="alert alert-danger p-1"><?php echo $errors['firstname']; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <label for="name" class="fw-bold">LAST NAME</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name" autocomplete="off">
                      <?php if (isset($errors['lastname'])) { ?>
                        <div class="alert alert-danger p-1"><?php echo $errors['firstname']; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <label for="name" class="fw-bold">COURSE</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="course">
                        <option selected>Select</option>
                        <option value="BAGEN">BAGEN</option>
                        <option value="BScCS">BScCS</option>
                        <option value="Biology ICT">Biology ICT</option>
                        <option value="Chemistry ICT">Chemistry ICT</option>
                        <option value="Statistics ICT">Statistics ICT</option>

                        <?php if (isset($errors['course'])) { ?>
                          <div class="alert alert-danger p-1"><?php echo $errors['course']; ?></div>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <label for="name" class="fw-bold form-label">SELECT CATEGORY</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="category">
                        <option selected>Select</option>
                        <option value="Graphics Designing">Graphics Designing</option>
                        <option value="Programming">Programming</option>
                        <option value="Cyber Security">Cyber Security</option>
                        <option value="Comp Maintenance">Comp Maintenance</option>
                        <option value="Web Development">Web Development</option>
                      </select>
                    </div>
                  </div>
                  <label for="password" class="fw-bold form-label">PASSWORD</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <input type="password" name="password" class="form-control" placeholder="Enter Password" autocomplete="off">
                    </div>
                  </div>
                  <label for="confirmPassword" class="fw-bold form-label">CONFIRM PASSWORD</label>
                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6 col-md-6 my-3">
                      <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" autocomplete="off">
                    </div>
                  </div>

                  <button type="submit" name="submit" class="btn btn-success my-2">Register</button>
                  <button class="btn btn-brand"><a href="login.php" class="text-decoration-none text-light">Already
                      Registered</a></button>
                </form>
              </fieldset>
            </div>
          </center>
        </div>
      </div>
    </div>
    <footer class="text-dark">
      <div class="container-fluid">
        <p class="text-center"> Copyright <i class="far fa-copyright text-warning"></i> 2023 Ecode Technologies</p>
      </div>
    </footer>
  </section>
  <!-- Chat Icon -->
  <section>
    <div id="chatIcon">
      <i class="fa fa-comments"></i>
    </div>
  </section>
  </div>
  <section>

  </section>
  <script src="js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>