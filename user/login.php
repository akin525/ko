<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Dashboard</title>
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


<?php
include_once ("include/database.php");

$sql="SELECT maintain FROM  settings WHERE sno=0";
if ($result = mysqli_query($connection, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        $main= $row[0];
    }
    if($main==2 || $main==3)
    {
        print "<script language='javascript'>window.location = '404.php';</script>";
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']))
{


// Collect the data from post method of form submission //
    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $password=mysqli_real_escape_string($connection,$_POST['password']);
//    $password = md5($password);

    $query = "select * from users where username='$username' and password='$password'";
    $result = mysqli_query($connection,$query);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
        $result = mysqli_query($connection,$query);

        while($row = mysqli_fetch_array($result))
        {
            $status=$row['status'];
        }
        if($status ==0){
            $errormsg= "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>You have been banned from accessing this portal </br></strong></div>"; //printing error if found in validation
        }else{
            $_SESSION['username'] = $username;
            print "
                    <script language='javascript'>
//                    let message = 'Login Successful';
//                                    alert(message);
                        window.location = 'dashboard.php';
                    </script>
                    ";
        }
    }else {
        $errormsg= "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Incorrect login details </br></strong></div>"; //printing error if found in validation
    }

}

?>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="images/logo.png" alt="logo">
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <center><?php
                            if(!empty($errormsg))
                            {
                                print $errormsg;

                            }
                            ?>
                        </center>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                        <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg" id="exampleInputUsername" placeholder="Username" required/>
                            <input type="hidden" name="todo" value="post">

                        </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required/>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        Keep me signed in
                                    </label>
                                </div>
                                <a href="pass.php" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Don't have an account? <a href="usersignup.php" class="text-primary">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>



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