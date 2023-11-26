<?php
require_once './includes/config.php';
session_start();
/*Set the session cookie path to '/'
ini_set('session.cookie_path', '/');


 Set the max age of the session cookie to 30 days
session_set_cookie_params(30 * 24 * 60 * 60);
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['RegNo']) && isset($_POST['password'])) {
        $RegNo = $_POST['RegNo'];
        $password = $_POST['password'];

        //array to store error messages 
        $errors = array();

        if (empty($RegNo)) {
            $errors['regNo'] = "Please Fill in Username";
        }
        if (empty($password)) {
            $errors['password'] = "Please Fill in Password";
        }
        //if no error proceed with login...
        if (empty($errors)) {
            $sql = "SELECT * FROM members WHERE RegNo = '" . mysqli_real_escape_string($conn, $RegNo) . "'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['RegNo'] = $row['RegNo'];
                $_SESSION['usertype'] = $row['usertype'];
                // Redirect to different pages based on user type
                if ($row['usertype'] === 'user') {
                    header('Location: ./user/user.php');
                } elseif ($row['usertype'] === 'admin') {
                    header('Location: ./admin/dashboard.php');
                } else {
                    echo '<div class="alert alert-danger mx-auto shadow-lg  p-1">Unknown user type</div>';
                }
                exit();
            } else {
                echo '<div class="alert alert-warning mx-auto shadow-lg p-1">Incorrect username or password</div>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login | ICT Club</title>

    <?php include 'links.php'; ?>
</head>

<body class="text-light">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow" style="background-color: #19c357;">
        <div class="container">
            <a href="index.html" class="navbar-brand text-warning">
                <h3 class="fw-bold">Mwecau-ICT Club </h3> <span class="fs-6 mb-4 text-white fst-italic">"Inspire,
                    Innovate,
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
    <section class="bg-dark">
        <div class="container">
            <div class="row g-0">
                <div class="col-md py-5 p-5 text-center" data-aos="fade-right" data-aos-duration="2000">
                    <img src="./img/logo.jpg" class="img-fluid image-border rounded-circle w-50 mt-5">
                </div>
                <div class="col-md py-lg-5 py-sm-0">
                    <form action="login.php" method="POST" autocomplete="off">
                        <p class="lead fw-normal mb-0 mx-5 fs-4 py-lg-5 py-md-5 py-sm-1 text-lg-start text-white">Sign
                            in</p>
                        <button type="button" class="btn btn-primary btn-floating mx-1 d-none">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-floating mx-1 d-none">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-floating mx-1 d-none">
                            <i class="fab fa-linkedin-in"></i>
                        </button>
                        <!--input for E-mail-->
                        <div class="form-outline mt-4 col-lg-9" data-aos="zoom-in-right">
                            <label class="form-label fs-5 text-warning" for=" RegNo">REGISTRATION NUMBER</label>
                            <input type="text" name="RegNo" placeholder="Enter valid Registration number" class="form-control">
                            <?php if (isset($errors['regNo'])) { ?>
                                <div class="text-danger p-1 fs-5"><?php echo $errors['regNo']; ?></div>
                            <?php } ?>
                        </div>
                        <!--input for password-->
                        <div class="form-outline mt-4 col-lg-9" data-aos="zoom-in-left">
                            <label class="form-label fs-5 text-warning" for="Email">PASSWORD</label>
                            <input type="password" name="password" placeholder="Type your password" class="form-control">
                            <?php if (isset($errors['password'])) { ?>
                                <span class="text-danger fs-5"><?php echo $errors['password']; ?></span>
                            <?php } ?>
                        </div>
                        <!--checkbox-->
                        <div class="form-check py-2">
                            <label class="form-check-label" for="checkbox">Remember me</label>
                            <input class="form-check-input" type="checkbox">
                            <a href="#" class="text-decoration-none mx-2 ">forgot password</a>
                        </div>
                        <!--Login button-->
                        <div class="pt-4">
                            <button type="submit" name="login" class="btn btn-primary btn-lg" data-aos="fade-right" data-aos-duration="1000">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account <a href="register.php" class="text-danger mx-2 text-decoration-none">Register</a></p>
                        </div>
                        <!--Sign in with-->
                        <div class="col-md py-5" data-aos="fade-up" data-aos-duration="2000">
                            <p>Or Sign in with</p>
                            <a href="https://www.facebook.com/YourFacebookURLHere" target="_blank" class="btn btn-primary">
                                <i class="fab fa-facebook-f btn-floating mx-1"></i>
                            </a>
                            <a href="https://www.google.com" target="_blank" class="btn btn-primary">
                                <i class="fab fa-google btn-floating mx-1"></i>
                            </a>
                            <a href="https://twitter.com/YourTwitterURLHere" target="_blank" class="btn btn-primary">
                                <i class="fab fa-twitter btn-floating mx-1"></i>
                            </a>
                        </div>
                        <div class="col-md py-5" data-aos="fade-up" data-aos-duration="2000">
                            <p>Or Sign in with</p>
                            <a href="https://www.facebook.com/YourFacebookURLHere" target="_blank" class="btn btn-primary">
                                <i class="fab fa-facebook-f btn-floating mx-1"></i>
                            </a>
                            <a href="https://www.google.com" target="_blank" class="btn btn-primary">
                                <i class="fab fa-google btn-floating mx-1"></i>
                            </a>
                            <a href="https://www.instagram.com/YourInstagramURLHere" target="_blank" class="btn btn-primary">
                                <i class="fab fa-instagram btn-floating mx-1"></i>
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="chat">
        <!-- Chat Icon -->
        <div id="chatIcon">
            <i class="fas fa-comments"></i>
        </div>
    </section>
    <!--copyright-->
    <div class="container text-dark">
        <p>&copy; <?php echo date('Y'); ?> ICT Club. All rights reserved.</p>
    </div>
    <!-- Scripts for aos  -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="aos-master/dist/aos.js"></script>
    <!--AOS file-->
    <!--bootstrap javascrip-->
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>