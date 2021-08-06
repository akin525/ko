
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
    <link rel="shortcut icon" href="images/favicon.png" />
</head>
<?php include ("include/database.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
// Collect the data from post method of form submission //
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
//    $password2 = mysqli_real_escape_string($connection, $_POST['password2']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
//$refer= mysqli_real_escape_string($con, $_POST['refer']);


    $status = "OK";
    $msg = "";

    if (!isset($username) or strlen($username) < 6) {
        $msg = $msg . "<h4>Username Should Contain Minimum 6 CHARACTERS.<br /></h4>";
        $status = "NOTOK";
    }

    if (!ctype_alnum($username)) {
        $msg = $msg . "<h4>Username Should Contain Alphanumeric Chars Only.<br /></h4>";
        $status = "NOTOK";
    }

    $remail = mysqli_query($connection, "SELECT COUNT(*) FROM users WHERE email = '$email'");
    $re = mysqli_fetch_row($remail);
    $nremail = $re[0];
    if ($nremail == 1) {
        $msg = $msg  .  "<h4>E-Mail Id Already Registered. Please try another one<br /></h4>";
        $status = "NOTOK";
    }

    if (strlen($password) < 8) {
        $msg = $msg . "<h4>Password Must Be More Than 8 CHARACTERS Length.<br /></h4>";
        $status = "NOTOK";
    }

    if (strlen($email) < 1) {
        $msg = $msg . "<h4>Please Enter Your Email Id.<br /></h4>";
        $status = "NOTOK";
    }

    $sql = "SELECT username FROM users WHERE username='{$username}'";
    $result = mysqli_query($connection,$sql) or die("Query unsuccessful") ;
    if (mysqli_num_rows($result) > 0) {
        $msg = $msg . "<h4>user id already Registered. please try another one<br /></h4>.";
        $status = "NOTOK";
    }
//The value of $ip at this point would look something like: "192.0.34.166"
//$ip = ip2long($ip);
//The $ip would now look something like: 1073732954
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    if ($status == "OK") {
//echo mysqli_query($con,"insert into `users`(`active`,`username`,`password`,`fname`,`email`,`ipaddress`,`mobile`,`country`) values(1,'$username','$passmd','$name','$email','$ip','$phone','$country')");
        mysqli_query($connection, "INSERT INTO `users` (`username`, `email` ,`password`, `name`, `phone`) VALUES ('$username', '$email', '$password', '$name', '$phone')");
        mysqli_query($connection,"insert INTO wallet (username,balance) values('$username',0)");
//mysqli_query($con,"INSERT INTO referal (`username`, `newuserid`, amount) value ('$refer', '$username', 100)");

        $to = $email;
        $from = "info@lelescoenterprise.com";
//    $name = $_REQUEST['name'];
//    $subject = $_REQUEST['subject'];
//    $number = $_REQUEST['phone_no'];
//    $cmessage = $_REQUEST['message'];

        $headers = "From: $from";
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $subject = "From EFE MOBILE MONEY.";

        $logo = '<img src="public/images/logo/logo.png" alt="logo">';
        $link = '#';

        $body = '<html><body>';
        $body .= '<h1>Thanks for Registration</h1>';
        $body .= '<h1>Users Detail:</h1>';
        $body .= '</body></html>';

        $body = '<html><body>';
        $body .= '<img src="public/images/logo/logo.png" alt="logo"/>';
        $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $body .= "<tr style='background: #eee;'><td><strong>Full-Name:</strong> </td><td>{$name}</td></tr>";
        $body .= "<tr><td><strong>Email:</strong> </td><td>{$email}</td></tr>";
        $body .= "<tr><td><strong>Your Password:</strong> </td><td>{$password}</td></tr>";
        $body .= "<tr><td><strong>Wallet Balance:</strong> </td><td>NGN 0.00</td></tr>";
        $body .= "</table>";
        $body .= "</body></html>";


        $send = mail($to, $subject, $body, $headers);
        $suss= "<div class='card'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Account Registration successful : </br></strong>A mail has been sent to $email containing your login details for record purpose. Check your spam folder if message is not found in your inbox. $password</div>";
        //printing error if found in validation
        print "
				<script language='javascript'>
				let message = 'Account Registration successful : A mail has been sent to $email containing your login details for record purpose. Check your spam folder if message is not found in your inbox. ';
                                    alert(message);
window.location = 'dashboard.php';
</script>
";
    }else{
        $errormsg= "<center><div class='card alert-danger'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='btn-icon-append'></i><h6 class='alert-danger'>Please Fix Below Errors : </br></h6>".$msg."</div></center>"; //printing error if found in validation
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
                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                       <p class="alert-danger"><?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status=="NOTOK"))
                        {
                            print $errormsg;

                        }
                        ?>

                        <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status=="OK"))
                        {
                            print $suss;

                        }
                        ?>
                       </p>
                    <br>
                    </br>
                        <p></p>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>"method="post">
                        <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-lg" id="exampleInputFullName" placeholder="FullName" required/>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required/>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" class="form-control form-control-lg" id="090000000" placeholder="number" required/>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required/>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        I agree to all Terms & Conditions
                                    </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Already have an account? <a href="user/login.php" class="text-primary">Login</a>
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