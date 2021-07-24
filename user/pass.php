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

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']))
{
// Collect the data from post method of form submission //
    $email=mysqli_real_escape_string($connection,$_POST['email']);

    $query = "select * from users where email='$email'";
    $result = mysqli_query($connection,$query);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {

        $password=uniqid('m', true);

        $query=mysqli_query($connection,"update users set password='".md5($password)."'  where email='".$email."'");

        // More headers
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";
//        $to=$email;
//        $subject="Password Reset on ".$wname;
//        $message = "Hello! <br /><p>Your Password has been reset with the details below. <br /> <br /> Password: $password. </p>Thanks for trying us out. <br /> https://".$wlink;
//
//        mail($email,$subject,$message,$headers);

        $query="SELECT * FROM users where email = '".$_SESSION['login_user']."'";
        $result = mysqli_query($connection,$query);
        while($row = mysqli_fetch_array($result)) {


            $n = $row['name'];
            $email = $row['email'];
            $password = $row['password'];

        }
        $mail= "info@efemobilemoney.com";
        $to = $email;
        $from = $mail;
        $name = $n;
//$subject = $_REQUEST['subject'];
//$number = $_REQUEST['phone_no'];
//$cmessage = $_REQUEST['message'];

        $headers = "From: $from";
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $subject = "From EFE MOBILE MONEY.";

        $logo = '<img src=public/images/logo/logo.png alt=logo>';
        $link = '#';

        $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
        $body .= "<table style='width: 100%;'>";
        $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
        $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
        $body .= "<p style='border:none;'><strong>Thanks For Signing Up, This Are Your Details Below<strong>";
        $body .= "<p style='border:none;'><strong>Your Password has been reset with the details below.</strong>Password: {$password} </p>";
        $body .= "<p style='border:none;'><strong>Kindly Update Your Password after Log-in Your Profile</strong></p>";
//$body .= "<p style='border:none;'><strong>Password:</strong> {$password}</p>";
//$body .= "<p style='border:none;'><strong>Wallet Balance:</strong>#0.00</p>";
        $body .= "</tr>";
// 	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
        $body .= "<tr><td></td></tr>";
//$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
        $body .= "</tbody></table>";
        $body .= "</body></html>";

        $send = mail($to, $subject, $body, $headers);

        $msg= "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Pass       word Reset Successful : </br></strong>A mail has been sent to $email containing your login details.</div>";

    }else{
        $msg= "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Email not found in our system</div>"; //printing error if found in validation
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
                        <center>
                        <div class="brand-logo">
                            <img src="images/logo.png" alt="logo">
                        </div>
                        <h4>Forget Password</h4>
                        </center>
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            print $msg;
                        }
                        ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail" placeholder="email" required/>
                                <input type="hidden" name="todo" value="post">

                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset-Password</button>
                            </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="login.php" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Log-in</a>
                </div>