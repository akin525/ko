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

                    <?php
                    $query = "select * from users where username ='".$_SESSION['username']."' and allowpurchase=0";
                    $result = mysqli_query($connection,$query);
                    $count = mysqli_num_rows($result);

                    if($count == 1) { ?>
                        <script>window.location.replace("404.php");</script>
                    <?php } ?>
                    <div>
                        <!--                        <button type="button" class="btn btn-primary btn-icon-text btn-rounded">-->
                        <!--                            <i class="ti-clipboard btn-icon-prepend"></i>Report-->
                        <!--                        </button>-->
                    </div>
                </div>
            </div>
        </div>
        <?php
        $query = "select * from users where username ='".$_SESSION['username']."' and allowpurchase=0";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);

        if($count == 1) { ?>
            <script>window.location.replace("404.php");</script>
        <?php } ?>
        <!-- Title & Breadcrumbs-->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row page-breadcrumbs">
                        <div class="col-md-5 align-self-center">
                            <h4 class="theme-cl">Available Products</h4>
                        </div>
                        <div class="col-md-7 text-right">

                            <div class="btn-group mr-lg-2">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Short By
                                </button>
                                <div class="dropdown-menu pull-right animated flipInX">

                                </div>
                                <form action="avdata.php" method="post">
                                <div class="payment_gateway_wrapper payment_select_wrapper">
                                    <label>Select Mobile Network:</label>
                                    <select data-required="true" class="form-control" name="value" required>

                                        <option selected>choose Network</option>
                                        <option value="m">MTN</option>
                                        <option value="g">GLO</option>
                                        <option value="9">9MOBILE</option>
                                        <option value="a">AIRTEL</option>
                                    </select>
                                </div>
                                    <p></p>
                                                                <button type="submit" class="btn btn-outline-primary btn-rounded">Kindly Click here to know the Availaible Data Before Proceed</a></button>
                                </form>
                            </div>

                        </div>
                    </div>