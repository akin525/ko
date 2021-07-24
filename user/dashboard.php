<?php include ("menu.php");

?>
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

?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <?php
                    $query="SELECT * FROM  mg";
                    $result = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_array($result)) {
                        $mo= $row["message"];
                    }
                    ?>
                    <marquee width="60%" direction="left" height="100px">
                        <h4><?php echo $mo; ?></h4>
                    </marquee>
                    <div>
                        <h4 class="font-weight-bold mb-0"><?php echo $name; ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Wallet Balance</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h4 class="mb-1">NGN.<?php echo number_format(intval($balance *1),2);?></h3>
                            <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>
                        <p class="mb-0 mt-2 text-danger">0.12% <span class="text-black ml-1"><small>(30 days)</small></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Total Wallet Deposit</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h4 class="mb-1">NGN.<?php echo number_format(intval($deposited *1),2);?></h4>
                            <i class="icon fa fa-bank green-cl font-30"></i>
                        </div>
<!--                        <p class="mb-0 mt-2 text-danger">0.47% <span class="text-black ml-1"><small>(30 days)</small></span></p>-->
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Successful Payments</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h4 class="mb-1">NGN.<?php echo number_format(intval($total *1),2);?></h4>
                            <i class="fa fa-cc-visa red-cl font-30"></i>
                        </div>
                        <p class="mb-0 mt-2 text-success">64.00%<span class="text-black ml-1"><small>(30 days)</small></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Failed Payments</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h4 class="mb-1">NGN.<?php echo number_format(intval($unpaid *1),2);?></h4>
                            <i class="icon fa fa-money yellow-cl font-30"></i>
                        </div>
                        <p class="mb-0 mt-2 text-success">23.00%<span class="text-black ml-1"><small>(30 days)</small></span></p>
                    </div>
                </div>

</div>
        </div>
<!--                    <div class="col-lg-6 grid-margin stretch-card">-->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Bills Payment</h4>
                                <p class="card-description">
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                        <th>Product Name</th>
                                        <th>Payment ID</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query="SELECT * FROM bill_payment where username = '".$_SESSION['username']."'";
                                        $result = mysqli_query($connection,$query);
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $status="$row[status]";
                                            if($status==1)
                                                $sta="Paid";
                                            if($status==1)
                                                $color="cl-success bg-success-light";
                                            if ($status==2)
                                                $sta="Declined";
                                            if($status==2)
                                                $color="danger";
                                            if ($status==0)
                                                $sta="Pending";
                                            if($status==0)
                                                $color="cl-danger bg-danger-light";
                                            ?>
                                            <tr>
                                                <td><a href="#"><?php echo "$row[product]"; ?></a></td>
                                                <td><i class="fa fa-lg"></i><?php echo "$row[transactionid]"; ?></td>
                                                <td><div class="label <?php echo $color; ?> ">NGN.<?php echo "$row[amount]"; ?></div></td>
                                                <td><?php echo "$row[timestamp]"; ?></td>
                                                <form action="invoice.php" method="post">
                                                    <input type="hidden" name="id" value="<?php echo "$row[id]"; ?>">
                                                    <td><button type="submit" class="badge btn-outline-primary btn-rounded"><i class="fa fa-print"></i> Print Invoice</button>
                                                </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



<