<?php include "include/database.php";


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

        $subject = "From Lelescoenterprise.";

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
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div>
                <div class="text-center p-t-20 p-b-20">
                    <span class="db"><img src="assets/images/logo.png" alt="logo" /></span>
                </div>
                <!-- Form -->

                <?php
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
                    <div class="row p-b-30">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                                <input type="hidden" name="todo" value="post">
                            </div>
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" name="email" class="form-control form-control-lg" placeholder="Email Address" aria-label="email" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Full Name" aria-label="Full-Name" aria-describedby="basic-addon1" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input type="number" name="phone" class="form-control form-control-lg" placeholder="Phone number" aria-label="Phone" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20">
                                    <button class="btn btn-block btn-lg btn-info" type="submit">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20">
                                    <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i><a class="text-white" href="../index.php">Homepage</a></button>
                                    <button  class="btn btn-success float-right" type="button"><a href="login.php">Login</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>
</body>

</html>