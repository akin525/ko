<?php include "menubar.php"; ?>
<?php
$result = mysqli_query($connection,"SELECT sum(amount) FROM  bill_payment where username = '".$_SESSION['username']."'");
$row = mysqli_fetch_row($result);
$total = $row[0];
?>
<?php
$result = mysqli_query($connection,"SELECT sum(amount) FROM  bill_payment where status=0 and username = '".$_SESSION['username']."'");
$row = mysqli_fetch_row($result);
$unpaid = $row[0];
?>
<?php
$result = mysqli_query($connection,"SELECT sum(amount) FROM  deposit where username = '".$_SESSION['username']."'");
$row = mysqli_fetch_row($result);
$deposited = $row[0];

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


$query = "SELECT * FROM settings";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result))
{
$main = $row["maintain"];
if ($main == 0){
?>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4>Welcome to Lelescoenterprise</h4>
                <h6></h6>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
<!--            <h4 class="card-title text-uppercase">Welcome Back</h4>-->
            <h6 class="card-text"><?php echo $name; ?></h6>
            <button class="btn-animated btn-outline-success"><a class="text-mask-light" href="../index.php"> Back To Homepage </a></button>
            <br>
            <p></p>
            <div class="card">
                <br>
                <h4 class="btn btn-success btn-sm">Kindly Click Here To Fund Your Wallet...<button class="btn-dark"><a class="text-white" href="fund.php"> Fund Wallet </a></button> </h3>
            </div>

        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-wallet"></i></h1>
                        <h6 class="text-white">Wallet Balance</h6>
                        <h6 class="text-white">NGN<?php echo number_format(intval($balance *1),2);?></h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-wallet"></i></h1>
                        <h6 class="text-white">Total Bills</h6>
                        <h6 class="text-white">NGN<?php echo number_format(intval($total *1),2);?></h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-wallet"></i></h1>
                        <h6 class="text-white">Total Deposite</h6>
                        <h6 class="text-white">NGN<?php echo number_format(intval($deposited *1),2);?></h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-wallet"></i></h1>
                        <h6 class="text-white">Total Fail</h6>
                        <h6 class="text-white">NGN<?php echo number_format(intval($unpaid *1),2);?></h6>
                    </div>
                </div>
            </div>
        </div>

        <center>
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-3">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="card-title text-uppercase text-muted mb-0">Notifications</h4>
                                            <h6>Update!! Update!! Update!! </h6>
                                            <!--                    <span class="h2 font-weight-bold mb-0">924</span>-->
                                        </div>
                                        <small target="_blank" class="btn btn-secondary success">
                                            <!--                    <div class="icon icon-shape bg-gradient-green text-white shadow">-->
                                            <!--                        <i class="ni ni-money-coins"></i>-->
                                            <!--                    </div>-->
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
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="card-title text-uppercase text-muted mb-0">FAQs:</h4>
                                            <h6> Please Check Homepage</h6>
                                        </div>
                                    </div>
                                    <a href="#" target="_blank" class="btn btn-secondary text-blue">
                                        <i class="fas fa-question"></i><h6>Frequently Asked Question's
                                        </h6> </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
<!--                            <div class="card card-stats">-->
                                <!-- Card body -->
<!--                                <div class="card-body">-->
<!--                                    <div class="row">-->
<!--                                        <div class="col">-->
<!--                                            <h4 class="card-title text-uppercase text-muted mb-0">Amazing Offer</h4>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <a href="#" target="_blank" class="btn btn-secondary text-blue">-->
<!---->
<!--                                        <h6> Best Offer For Mobile Data And Airtime </h6>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </center>
<!--        <div class="col-lg-6 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h4 class="card-title mb-0">Bills Payment</h4>-->
<!--                    <p class="card-description">-->
<!--                    </p>-->
<!--                    <div class="table-responsive">-->
<!--                        <table id="zero_config" class="table table-striped table-bordered">-->
<!--                        <thead>-->
<!--                            <tr>-->
<!--                                <th>Product Name</th>-->
<!--                                <th>Payment ID</th>-->
<!--                                <th>Price</th>-->
<!--                                <th>Date</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php
//                            $query="SELECT * FROM bill_payment where username = '".$_SESSION['username']."'";
//                            $result = mysqli_query($connection,$query);
//                            while($row = mysqli_fetch_array($result))
//                            {
//                                $status="$row[status]";
//                                if($status==1)
//                                    $sta="Paid";
//                                if($status==1)
//                                    $color="cl-success bg-success-light";
//                                if ($status==2)
//                                    $sta="Declined";
//                                if($status==2)
//                                    $color="danger";
//                                if ($status==0)
//                                    $sta="Pending";
//                                if($status==0)
//                                    $color="cl-danger bg-danger-light";
//                                ?>
<!--                                <tr>-->
<!--                                    <td><a href="#">--><?php //echo "$row[product]"; ?><!--</a></td>-->
<!--                                    <td><i class="fa fa-lg"></i>--><?php //echo "$row[transactionid]"; ?><!--</td>-->
<!--                                    <td><div class="label --><?php //echo $color; ?><!-- ">NGN.--><?php //echo "$row[amount]"; ?><!--</div></td>-->
<!--                                    <td>--><?php //echo "$row[timestamp]"; ?><!--</td>-->
<!--                                    <form action="invoice.php" method="post">-->
<!--                                        <input type="hidden" name="id" value="--><?php //echo "$row[id]"; ?><!--">-->
<!--                                        <td><button type="submit" class="badge btn-outline-primary btn-rounded"><i class="fa fa-print"></i> Print Invoice</button>-->
<!--                                    </form>-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deposit Transaction</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <tfoot>
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Username</th>
                        <th>Total Balance</th>
                        <th>Amount Before</th>
                        <th>Amount After</th>
                        <th>Payment_Ref</th>
                    </tr>
                    </thead>
                    </tfoot>
                    <?php
                    $query = "SELECT * FROM deposit WHERE username ='".$_SESSION['username']."'";
                    $result = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <!--                        <td>--><?php //echo $row["id"] ; ?><!--</td>-->
                            <td><?php echo $row["date"] ; ?></td>
                            <td><?php echo $row["username"] ; ?></td>
                            <td>NGN<?php echo $row["amount"] ; ?></td>
                            <td>NGN<?php echo $row["iwallet"] ; ?></td>
                            <td>NGN<?php echo $row["fwallet"] ; ?></td>
                            <td><?php echo $row ["payment_ref"] ; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

                        <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
                        <script>
                            /****************************************
                             *       Basic Table                   *
                             ****************************************/
                            $('#zero_config').DataTable();
                        </script>
                        <script>
    <?php

} else{
    print "<script language='javascript'>window.location = '../index.php';</script>";


}
}
?>