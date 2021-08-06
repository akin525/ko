<?php include ("menu.php");
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>
					window.location = 'user/login.php';
				</script>";
}
$query="SELECT * FROM  users WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($result))
{
    $username=$row["username"];
    $name=$row["name"];
    $date=$row["date"];
    $email=$row["email"];
    $phone=$row["phone"];
}
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <!--                        <h4 class="font-weight-bold mb-0">--><?php //echo $name; ?><!--</h4>-->
                    </div>

                    <div>
                        <!--                        <button type="button" class="btn btn-primary btn-icon-text btn-rounded">-->
                        <!--                            <i class="ti-clipboard btn-icon-prepend"></i>Report-->
                        <!--                        </button>-->
                    </div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' ){

    $status="OK";
// Collect the data from post method of form submission //
    $name=mysqli_real_escape_string($connection,$_POST['name']);
//                            $contr=mysqli_real_escape_string($con,$_POST['country']);
    $phone=mysqli_real_escape_string($connection,$_POST['phone']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
//                            $gender=mysqli_real_escape_string($con,$_POST['gender']);
//                            $address=mysqli_real_escape_string($con,$_POST['address']);
//collection ends

    $query3=mysqli_query($connection,"update users set `name`='$name', phone='$phone',email='$email' where username = '".$_SESSION['username']."'");

    echo $message = "Profile Update Successfully";
    print "
				<script language='javascript'>
				 let message = 'Profile Update Successfully: ';
                                    alert(message);
window.location = 'dashboard.php';
</script>
";
}
?>

        <!-- Title & Breadcrumbs-->
        <div class="row page-breadcrumbs">
<!--            <div class="col-md-12 align-self-center">-->
                <!--                <h4 class="theme-cl">Profile</h4>-->
                <!--                <img src="images/profile/pic1.png" width="20" alt=""/>-->

            </div>
        </div>
        <form action="profile.php" method="POST">

            <?php if(isset($error) != NULL):?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
<!--            <div class="row">-->
<!--                <div class="card">-->
                    <div class="card-body">
            <div class="row">
                <div class="col-xl-12">
                    <h5 class="form-title">Basic Information</h5>
                </div>
                <div class="form-group col-xl-12">
                    <div class="media align-items-center mb-3">
                        <div class="media-body">
                            <h5 class="mb-0"><?php echo $name; ?></h5>
                            <!--                                            <p>Max file size is 20mb</p>-->
                            <!--                                            <div class="jstinput">	<a href="javascript:void(0);" class="avatar-view-btn browsephoto openfile">Browse</a>-->
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="row">
        <div class="form-group col-xl-6">
            <label class="mr-sm-2">Name</label>
            <input class="form-control" type="text" value="<?php echo $name; ?>" name="name" placeholder="" required>
        </div>
        <div class="form-group col-xl-6">
            <label class="mr-sm-2">Email</label>
            <input class="form-control" type="email" value="<?php echo $email; ?>" name="email" placeholder="" required>
        </div>
        <div class="form-group col-xl-6">
            <label class="mr-sm-2">Mobile Number</label>
            <input class="form-control no_only" type="text" value="<?php echo $phone; ?>" name="phone" placeholder="" required>
        </div>
        <div class="form-group col-xl-6">
            <label class="mr-sm-2">Username</label>
            <input type="text" class="form-control datepicker" type="text" name="dob" value="<?php echo $username; ?>"  readonly>
        </div>
        <!--    <div class="col-xl-12">-->
        <!--        <h5 class="form-title">Address</h5>-->
        <!--    </div>-->
        <!--    <div class="form-group col-xl-12">-->
        <!--        <label class="mr-sm-2">Address</label>-->
        <!--        <input type="text" class="form-control" name="address" value="">-->
        <!--    </div>-->
        <div class="form-group col-xl-12">
            <button name="form_submit" id="form_submit" class="btn btn-primary pl-5 pr-5" type="submit">Update</button>
        </div>
        </form>
                <button type="button" class="btn btn-outline-primary btn-rounded"><a href="password.php"> Change Password</a></button>
<!--                <button name="form_submit" id="form_submit" class="btn btn-primary pl-5 pr-5" type="button"><a href="password.php"> Change Password</a></button>-->

            </div>

 </div>
</div>
</div>
</div>
</div>

