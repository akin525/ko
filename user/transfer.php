<?php include ("menu.php");?>
<div class="content-wrapper">
    <div class="container-fluid">

        <!-- Title & Breadcrumbs-->
        <div class="row page-breadcrumbs">
            <div class="col-md-12 align-self-center">
                <h3 class="theme-cl">Bank Transfer Detail</h3>

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
                                    <h1><i class="fa i-cl-2 fa-credit-card"></i></h1>
                                </div>
                            </div>




                            <div class="col-md-12">
<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:404.php');
    exit;
}

include_once ("include/database.php");

// Inialize session
//session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>	window.location = 'index.php';</script>";
}
//$productid=mysqli_real_escape_string($connection,$_GET['productid']);
//$number= mysqli_real_escape_string($connection,$_GET["number"]);
//$networkcode= mysqli_real_escape_string($connection,$_GET["networkcode"]);
//$provider=mysqli_real_escape_string($connection,$_GET["amount"]);

?>
<?php $query="SELECT * FROM  paymentgateway where name='Bank Transfer' and status=1";


$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($result))
{
    $rave="$row[code]";
$bank="$row[bank_name]";
$acct=$row["account"];
$name=$row["account_name"];
//$jp=$provider;
//return;
}


?>
<div class="col-md-4 col-sm-6 mb-4">
    <div class="card">
        <div class="card-body">
        <div class="form-group">
        <div class="contact-info">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <h6>Bank Name:</h6>
            <b class="text-success fa-bold"><?php echo $bank; ?></b>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <h6>Bank Account No:</h6>
                    <b class="text-success fa-bold"><?php echo $acct; ?></b>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <h6>Account Name:</h6>
                    <b class="text-success fa-bold"><?php echo $name; ?></b>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
            <h6> With Amount </h6>
<!--                    <b class="text-success fa-bold">--><?php //echo $provider; ?><!--</b>-->

                </div>
            </div>


            <button type="button" class="btn btn-outline-primary btn-rounded">Kindly Contact Us After The Transfer For Reflection Of Transaction </a></button>

        </div>


    </div>
</div>
        <button type="button" class="btn btn-outline-primary btn-rounded"><a href="dashboard.php"> Back To Homepage </a></button>

    </div>
</div>
                            </div>