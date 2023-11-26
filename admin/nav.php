<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--links-->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap5.min.css">
    <style>
        :root {
            --offcanvas-width: 230px;
            --topNavbarHeight: 68px;
        }

        .sidebar-nav {
            width: var(--offcanvas-width);
        }

        @media (min-width: 992px) {
            .body {
                overflow: auto !important;
            }

            .offcanvas-backdrop {
                display: none;
            }

            main {
                margin-left: var(--offcanvas-width);
            }

            .sidebar-nav {
                transform: none;
                visibility: visible !important;
                top: var(--topNavbarHeight);
                height: 100%;
            }
        }

        button.f:hover {
            background-color: black;
            color: white;
        }

        .btn {
            color: white;
        }

        .color {
            background-color: #19c357;
        }

        .image-border {
            border: 2px solid #19c357;
        }

        .color2 {
            color: #19c357;
        }
    </style>
</head>

<body>
    <div id="loading-overlay">
        <img src="../img/logo.jpg" class="rounded-circle spinner image-border " alt="Loading" />
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background-color:#19c357;">
        <div class="container">
            <a href="dashboard.php" class="navbar-brand fw-bolder text-light fs-3">MWECAU ICT CLUB SYSTEM (MICs)</a>
            <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="">Menu</span>
            </button>
        </div>
    </nav>
    <!--offcanvas-->
    <section>
        <div class="offcanvas offcanvas-start text-light shadow-lg sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color:#19c357;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-muted" id="offcanvasExampleLabel"> <i class="fas fa-dashboard"></i>
                    Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="dropdown-divider"></div>
            <div class="offcanvas-body text-light">
                <div class="dropdown">
                    <button class="f btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-graduate"></i> Manage Member
                    </button>
                    <ul class="dropdown-menu" style="background-color: lightorange">
                        <li><a class="dropdown-item" href="./add_member.php">New Member</a></li>
                        <li><a class="dropdown-item" href="./member_list.php">Member List</a></li>
                        <li><a class="dropdown-item" href="./results.php"></a></li>
                    </ul>
                </div>

                <a href="post_event.php"><button class="f btn btn-dark mt-3"> Event Management</button></a>
                <a href="resource_repository.php"><button class="f btn btn-dark mt-3"><i class="fas fa-file-pdf"></i>
                        Resource
                        Repository</button></a>
                <a href="departments.php"><button class="f btn btn-dark mt-3"><i class="fas fa-users"></i>
                        Departments</button></a>
                <a href="post_announcement.php"><button class="f btn btn-dark mt-3"><i class="fas fa-paper-plane"></i>
                        Communication</button></a>
                <a href="active.php"><button class="f btn btn-dark mt-3"><i class="fas fa-dollar"></i> Financial
                        Tracking</button></a>
                <a href="event_details.php"><button class="f btn btn-dark mt-3"><i class="fas fa-feedback"></i> Feedback
                        & Support</button></a>
                <a href="display_resources.php"><button class="f btn btn-dark mt-3"> show resources</button></a>

            </div>
            <a href="../logout.php" class="text-decoration-none fw-bold text-light"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </div>
    </section>
    <section class="table">

    </section>
    <!--offcanvas-->
    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="bootstrap/js/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="bootstrap/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>