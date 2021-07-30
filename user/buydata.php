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
                                <a href="#">Prices</a>
                                <a href="#">Ascending</a>
                                <a href="#">Descending</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Title & Breadcrumbs-->

                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status!=""))
                {
                    print $errormsg;
                }
                ?>

                <!-- All Product List -->
                <div class="row">

                    <?php

                    $query="SELECT * FROM products where `product_type`='data'";
                    $result = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_array($result))
                    {
                        $id="$row[id]";
                        ?>
                        <!--                        <link href="coinassets/css/bootstrap.css" rel="stylesheet">-->
                        <!--                        <link href="coinassets/css/font-awesome.css" rel="stylesheet">-->
                        <!--                        <link href="coinassets/css/gateway.css" rel="stylesheet">-->

                        <!-- Single Product -->
                        <div class="col-md-2 col-sm-3 mb-2 col-xs-2">
                            <div class="product-wrap">
                                <div class="product-box">
                                    <div class="product-thumb">

                                        <div class="product-pic">
                                            <div class="uc_pic_box"><br>
                                                <img src="images/auth/<?php echo "$row[logo]"; ?>" alt="Product logo"></br></div>
                                        </div>

                                        <div class="product-detailed">
                                            <span class="product-uc-price"><?php echo "$row[name]"; $id=$row["id"]; ?></span>

                                            <?php if($row["product_type"]=="data" || $row["product_type"]=="tv"){ ?>
                                                <span class="product-uc-price"><?php echo "NGN". "$row[amount]"; ?></span>
                                            <?php } else if($row["product_type"]=="prepaid"){ ?>
                                                <span class="product-uc-price">Prepaid</span>

                                            <?php } else{ ?>
                                                <span class="" style="font-style: italic;"><?php echo "$row[details]"; ?></span>

                                            <?php } ?>

                                            <form action="previewproduct.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <?php if($row["status"]==1){ ?>
                                                    <button type="submit" class="btn btn-outline-primary btn-rounded"><i class="fa fa-check"></i> Continue</button>
                                                <?php }else{ ?>
                                                    <button type="button" class="btn btn-danger btn-rounded"><i class="fa fa-times"></i> Not Available</button>
                                                <?php } ?>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- End All Product List -->
            </div>