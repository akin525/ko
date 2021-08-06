<?php include "menu.php"; ?>
<div class="content-wrapper">
    <div class="container-fluid">

        <!-- Title & Breadcrumbs-->
        <div class="row page-breadcrumbs">
            <div class="col-md-12 align-self-center">
                <h4 class="theme-cl">Update Password</h4>
            </div>
        </div>
        <!-- Title & Breadcrumbs-->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <!-- col-md-6 -->
                        <div class="col-md-12 col-12">

                            <div class="form-group">
                                <div class="contact-thumb">
                                    <h1><i class="ti i-cl-4 ti-lock"></i></h1>
                                </div>
                            </div>




                            <div class="col-md-12">
                                <?php
                                $status = "OK";
                                $msg=$password ="";

                                if($_SERVER['REQUEST_METHOD'] == 'POST' )
                                {


// Collect the data from post method of form submission //
                                    $cpass=mysqli_real_escape_string($connection,$_POST['cpass']);
//                                    $cpass = md5($cpass);
                                    $ccpass=mysqli_real_escape_string($connection,$_POST['ccpass']);

                                    $password=mysqli_real_escape_string($connection,$_POST['password']);
//                                    $password = md5($password);

                                    $confirm_password=mysqli_real_escape_string($connection,$_POST['confirm_password']);
//                                    $confirm_password =('confirm_password');
//collection ends

                                    if($password!=""){

                                        if ( $ccpass!==$cpass){
                                            $msg=$msg."Current Password Is Wrong.<BR>";
                                            $status= "NOTOK";}

                                        if ( $password <> $confirm_password ){
                                            $msg=$msg."New Password And Confirm Password Are Not Matching.<BR>";
                                            $status= "NOTOK";}

                                        if ( strlen($password) < 8 ){
                                            $msg=$msg."Password Must Be More Than 8 Char Length.<BR>";
                                            $status= "NOTOK";}

//validation starts
// if userid is less than 6 char then status is not ok
                                    }

                                    if ($status=="OK")
                                    {
                                        $query=mysqli_query($connection,"update users set password='$password'  where username='".$_SESSION['username']."'");

                                        $errormsg= "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Your password has been updated</div>"; //printing error if found in validation

                                    }
                                    if ($status=="NOTOK"){

                                        $errormsg= "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-ban-circle'></i><strong>Please Fix The Errors Below : </br></strong>".$msg."</div>"; //printing error if found in validation

                                    }

                                }//end checking password empty

                                $query="SELECT * FROM  users WHERE username='".$_SESSION['username']."'";


                                $result = mysqli_query($connection,$query);
                                $i=0;
                                while($row = mysqli_fetch_array($result))
                                {

                                    $password="$row[password]";
                                    $email=$row["email"];
                                    $n="$row[name]";

                                }

                                $query="SELECT * FROM  users WHERE username='".$_SESSION['username']."'";
                                $result = mysqli_query($connection,$query);
                                $i=0;
                                while($row = mysqli_fetch_array($result)){

                                    $pass="$row[password]";
                                }


                                $mail= "info@lelescoenterprise.com.ng";
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
                                $body .= "<p style='border:none;'><strong>Password Update<strong>";
                                $body .= "<p style='border:none;'><strong>Your Password has been Change Successful. </strong> New Password: {$password} </p>";
                                //        $body .= "<p style='border:none;'><strong>Kindly Update Your Password after Log-in Your Profile</strong></p>";
                                //$body .= "<p style='border:none;'><strong>Password:</strong> {$password}</p>";
                                //$body .= "<p style='border:none;'><strong>Wallet Balance:</strong>#0.00</p>";
                                $body .= "</tr>";
                                // 	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
                                $body .= "<tr><td></td></tr>";
                                //$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
                                $body .= "</tbody></table>";
                                $body .= "</body></html>";

                                $send = mail($to, $subject, $body, $headers);
                                ?>

                                <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">

                                    <div class="row">


                                        <div class="col-md-12">
                                            <?php
                                            if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status!=""))
                                            {
                                                print $errormsg;
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label>Enter Current Password</label>
                                                <input type="password" class="form-control" id="email" name="cpass" placeholder="Current Password" />

                                                <input type="hidden" class="form-control" value="<?php echo $pass; ?>" id="email" name="ccpass" placeholder="Current Password" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Enter New Password</label>
                                                <input type="text" name="password" class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="text" name="confirm_password" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>

                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-rounded btn-outline-success btn-block">Update Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</div>  					<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "required";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("Password").innerHTML = "required";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "required";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "not same";
output = false;
}
return output;
}
</script>
            <!--  profile wrapper end -->
