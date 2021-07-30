<?php include ("menu.php");
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>
					window.location = 'login.php';
				</script>";
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
                </div>
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
                    </div>
                </div>
