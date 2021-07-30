<?php include ("include/database.php");
$query = "SELECT * FROM  users WHERE username='" . $_SESSION['username'] . "'";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($result)) {
    $username = "$row[username]";
    $name = $row["name"];
    $date = $row["date"];
    $email = $row["email"];
    $phone = $row["phone"];

}
$query="SELECT * FROM  wallet WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($result)) {
    $balance = $row["balance"];
    $account_name = $row["account_name"];
    $account_no = $row["account_no"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MCD User Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/logo.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
<!--            <a class="navbar-brand brand-logo mr-5" href="../index.html"><img src="images/logo.png" class="mr-2" alt="logo"/></a>-->

            <a class="navbar-brand brand-logo-mini" href="../index.html"><img src="images/logo.png" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="ti-view-list"></span>

            </button>
<!--            <ul class="navbar-nav mr-lg-2">-->
<!--                <li class="nav-item nav-search d-none d-lg-block">-->
<!--                    <div class="input-group">-->
<!--                        <div class="input-group-prepend hover-cursor" id="navbar-search-icon">-->
<!--                <span class="input-group-text" id="search">-->
<!--                  <i class="ti-search"></i>-->
<!--                </span>-->
<!---->
<!--                        </div>-->
<!--                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">-->
<!--                    </div>-->
<!---->
<!--                </li>-->
<!---->
<!--            </ul>-->


<!--            <ul class="navbar-nav navbar-nav-right">-->
<!--                <li class="nav-item dropdown mr-1">-->
<!--                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">-->
<!--                        <i class="ti-email mx-0"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item nav-profile dropdown">-->
<!--                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">-->
<!--                        <img src="images/faces/face28.jpg" alt="profile"/>-->
<!--                    </a>-->
<!--                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">-->
<!--                        <a class="dropdown-item">-->
<!--                            <i class="ti-settings text-primary">-->
<!--                            <a href="profile.php">-->
<!--                                Settings</a></i>-->
<!--                        </a>-->
<!--                        <a class="dropdown-item">-->
<!--                            <i class="ti-power-off text-primary"></i>-->
<!--                            <a href="logout.php">-->
<!--                                Logout</a>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="ti-view-list"></span>
            </button>
<!--        </div>-->
            <?php
                $query="SELECT * FROM  mg";
                $result = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($result)) {
                    $mo= $row["message"];
                }
                ?>
                <marquee class="font-weight-bold mb-0">
                    <h4><b><?php echo $mo; ?></b></h4>
                </marquee>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="ti-shield menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fundwallet.php">
                        <i class="ti-palette menu-icon"></i>
                        <span class="menu-title">Fund Wallet</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="air.php">
                        <i class="ti-view-list-alt menu-icon"></i>
                        <span class="menu-title">Check Available Airtime</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buyairtime.php">
                        <i class="ti-layout-list-post menu-icon"></i>
                        <span class="menu-title">Buy Airtime</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list.php">
                        <i class="ti-pie-chart menu-icon"></i>
                        <span class="menu-title">Check Available Network</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buydata.php">
                        <i class="ti-pie-chart menu-icon"></i>
                        <span class="menu-title">Buy Data</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tvlist.php">
                        <i class="ti-view-list-alt menu-icon"></i>
                        <span class="menu-title">Available Tv</span>
                    </a>
                <li class="nav-item">
                    <a class="nav-link" href="paytv.php">
                        <i class="ti-view-list-alt menu-icon"></i>
                        <span class="menu-title">Pay-Tv</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="eletricp.php">
                        <i class="ti-view-list-alt menu-icon"></i>
                        <span class="menu-title">Check Available Nepa Bills</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="eletric.php">
                        <i class="ti-view-list-alt menu-icon"></i>
                        <span class="menu-title">Nepa Bills</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myinvoice.php">
                        <i class="ti-star menu-icon"></i>
                        <span class="menu-title">My-Invoice</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="profile.php" >
                        <i class="ti-user menu-icon"></i>
                        <span class="menu-title">Profile</span>
<!--                        <i class="menu-arrow"></i>-->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="ti-write menu-icon"></i>
                        <span class="menu-title">Log-Out</span>
                    </a>
                </li>
            </ul>
        </nav>




        <!-- plugins:js -->
        <script src="vendors/base/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/template.js"></script>
        <script src="js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        <!-- End custom js for this page-->