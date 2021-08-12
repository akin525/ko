<?php include"menubar.php";


$query = "SELECT * FROM settings";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result))
{
$main = $row["maintain"];
if ($main == 0){


?>
<div class="page-wrapper">
<!--    <div class="card">-->
        <div class="card-body">
    <?php
include_once ("include/database.php");

// Inialize session
//session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>	window.location = 'index.php';</script>";
}
//$productid=mysqli_real_escape_string($connection,$_GET['productid']);
//$number= mysqli_real_escape_string($connection,$_GET["number"]);
//$networkcode= mysqli_real_escape_string($connection,$_POST["value"]);


//$curl = curl_init();
//
//curl_setopt_array($curl, array(
//    CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/list',
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_ENCODING => '',
//    CURLOPT_MAXREDIRS => 10,
//    CURLOPT_TIMEOUT => 0,
//    CURLOPT_FOLLOWLOCATION => true,
//    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//    CURLOPT_SSL_VERIFYHOST => 0,
//    CURLOPT_SSL_VERIFYPEER => 0,
//    CURLOPT_CUSTOMREQUEST => 'POST',
//    CURLOPT_POSTFIELDS => array('service' => 'data', 'coded' => $networkcode),
//    CURLOPT_HTTPHEADER => array(
//        'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
//    ),
//));
//
//$response = curl_exec($curl);
//
//curl_close($curl);
////echo $response;
////$data=json_decode($response, true);
////$success=$data["success"];
////$success1=$data["message"];
//////$tran=$data["data"]["name"];
////$tran1=$data["data"]["type"];
////$tran2=$data["data"]["name"];
////$tran3=$data["data"]["amount"];
////$tran4=$data["data"]["discount"];
////$tran5=$data["data"]["status"];
//
//
//$data=json_decode($response, true);
//$success=$data["success"];
//$success1=$data["message"];
//foreach($data['data'] as $plans){
////    echo $plans['name'];
////    echo $plans['code'];
//}

?>
<!--<button type="submit" class="btn btn-outline-primary btn-rounded"><a href="previewproduct.php">Back To Previewproduct</a></button>-->
    <div style="padding:90px 15px 20px 15px">
        <h4 class="align-content-center text-center">Preview Product</h4>
        <div class="card">
            <div class="card-body">
                <div class="box w3-card-4">
                        <div class="row">
                            <div class="col-sm-8">
                                <br>
                                <br>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row page-breadcrumbs">
                                            <div class="col-md-12 align-self-center">
                                                <!--                            --><?php
                                                //                            $query="SELECT * FROM products where `product_type`='data'";
                                                //                            $result = mysqli_query($connection,$query);
                                                //                            while($row = mysqli_fetch_array($result))
                                                //                            {
                                                //                                $networkcode=$row["ver"];
                                                //                            }
                                                //                            ?>
                                                <!--                            <center>-->
                                                <!--                                <button type="submit" class="btn btn-outline-primary btn-rounded"><a href="avdata.php?networkcode=--><?php //echo $networkcode;?><!--">Kindly Click here to know the Availaible Data Before Proceed</a></button>-->
                                                <!--                            </center>-->
                                                <h4 class="theme-cl">Product Detail</h4>
                                            </div>
                                        </div>
                </div>
                                    <?php

                                    $name=$title=$details=$amount="";

                                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']))
                                    {

                                        $id=mysqli_real_escape_string($connection,$_POST['id']);

                                        $query="SELECT * FROM  products1 where  id = '$id'";
                                        $result = mysqli_query($connection,$query);

                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $name="$row[name]";
                                            $title="$row[tittle]";
                                            $details="$row[details]";
                                            $amount="$row[amount]";
                                            $product_type="$row[product_type]";
                                            $networkcode=$row["product_type1"];
                                            $gk=$row["networkcode"];
                                        }
                                    }

                                    ?>

                                    <script>
                                        function showUser() {
                                            var str= document.getElementById("tvphone").value;

                                            if (str == "") {
                                                document.getElementById("vtv").innerHTML = "IUC cannot be empty";
                                                document.getElementById("btnd").removeAttribute("disabled");
                                                return;
                                            } else if (str.length<9) {
                                                document.getElementById("vtv").innerHTML = "IUC is too short";
                                                document.getElementById("btnd").removeAttribute("disabled");
                                                return;
                                            } else {
                                                document.getElementById("btnv").innerText="Verify....";
                                                var xmlhttp = new XMLHttpRequest();
                                                xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        document.getElementById("btnv").innerText="Verify";
                                                        if(this.responseText=="fail"){
                                                            document.getElementById("vtv").innerHTML = "Error validating IUC Number";
                                                            document.getElementById("btnd").setAttribute("disabled", "true");
                                                        }else{
                                                            document.getElementById("vtv").innerHTML = this.responseText;
                                                            document.getElementById("btnd").removeAttribute("disabled");
                                                        }
                                                    }
                                                };
                                                xmlhttp.open("GET","verifybill.php?number="+str+"&provider=<?php echo $name; ?>"+"&networkcode=<?php echo $networkcode; ?>",true);
                                                xmlhttp.send();
                                            }
                                        }
                                    </script>

                                    <script>
                                        function shoUser() {
                                            var str= document.getElementById("tvphone1").value;

                                            if (str == "") {
                                                document.getElementById("vtv1").innerHTML = "IUC cannot be empty";
                                                document.getElementById("btnd1").removeAttribute("disabled");
                                                return;
                                            } else if (str.length<9) {
                                                document.getElementById("vtv1").innerHTML = "IUC is too short";
                                                document.getElementById("btnd1").removeAttribute("disabled");
                                                return;
                                            } else {
                                                document.getElementById("btnv1").innerText="Verify....";
                                                var xmlhttp = new XMLHttpRequest();
                                                xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        document.getElementById("btnv1").innerText="Verify";
                                                        if(this.responseText=="fail"){
                                                            document.getElementById("vtv1").innerHTML = "Error validating IUC Number";
                                                            document.getElementById("btnd1").setAttribute("disabled", "true");
                                                        }else{
                                                            document.getElementById("vtv1").innerHTML = this.responseText;
                                                            document.getElementById("btnd1").removeAttribute("disabled");
                                                        }
                                                    }
                                                };
                                                xmlhttp.open("GET","verifybill1.php?number="+str+"&provider=<?php echo $name; ?>"+"&networkcode=<?php echo $gk; ?>",true);
                                                xmlhttp.send();
                                            }
                                        }
                                    </script>

                                    <?php

                                    ?>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 mb-4">
                                            <div class="box">
                                                <div class="box-body">

                                                    <h2 class="mb-0"><?php echo $name; ?></h2> <small><?php echo $title; ?></small>
                                                    <hr>

                                                    <div class="row">

                                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                                            <div class="white-box text-center"> <img src="images/auth/visa.png" class="img-responsive" alt=""> </div>
                                                            <div class="white-box text-center"> <img src="images/auth/mastercard.png" class="img-responsive" alt=""> </div>
                                                            <div class="white-box text-center"> <img src="images/auth/paypal.png" class="img-responsive" alt=""> </div>
                                                        </div>

                                                        <div class="col-lg-8 col-md-8 col-sm-6">

                                                            <h4 class="box-title m-t-40">Product description</h4>
                                                            <p><?php echo $details; ?></p>
                                                            <?php
                                                            if (!($product_type=="airtime" || $product_type=="nepa")) {
                                                                ?>
                                                                <h2><small class="text-success font-20"><?php echo "NGN"; ?> <?php echo $amount; ?></small></h2>
                                                            <?php } ?>

                                                            <form action="clearbill.php" method="post">
                                                                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $title; ?>">
                                                                <input type="hidden" name="productid" value="<?php echo $id; ?>">

                                                                <?php
                                                                if ($product_type=="airtime") {
                                                                    ?>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="number" placeholder="Enter Amount" maxlength="4" minlength="3" id="amount" name="amount" value="" autocomplete="on" size="20" min="100" max="4000" required="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="tel" placeholder="Enter recipient number" maxlength="11" minlength="11" id="phone" name="number" value="" autocomplete="on" size="20" required="">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-rounded btn-outline-info"> Continue </button>

                                                                <?php } else {
                                                                    ?>
                                                                    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                                                                <?php } ?>

                                                                <?php if ($product_type=="tv") { ?>
                                                                    <b class="text-success fa-bold" id="vtv"></b>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="tel" placeholder="Enter IUC number" maxlength="11" minlength="9" id="tvphone" name="number" value="" autocomplete="on" size="20" required="">
                                                                    </div>

                                                                    <button id="btnv" type="button" onclick="showUser()" class="btn btn-rounded btn-info"> Verify </button>
                                                                    <button id="btnd" type="submit" disabled class="btn btn-rounded btn-outline-info"> Continue </button>

                                                                <?php } else if ($product_type=="data"){ ?>

                                                                    <div class="form-group">
                                                                        <input class="form-control" type="tel" placeholder="Enter recipient number" maxlength="11" minlength="11" id="phone" name="number" value="" autocomplete="on" size="20" required="">
                                                                    </div>

                                                                    <button type="submit" class="btn btn-rounded btn-outline-info"> Continue </button>
                                                                <?php } ?>

                                                                <?php if ($product_type=="nepa") { ?>

                                                                    <div class="form-group">
                                                                        <input class="form-control" type="number" placeholder="Enter Amount" maxlength="8" minlength="1" id="amount" name="amount" value="" autocomplete="on" size="20" min="50" max="50000" required="">
                                                                    </div>
                                                                    <b class="text-success fa-bold" id="vtv1"></b>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="tel" placeholder="Enter Meter number" maxlength="11" minlength="9" id="tvphone1" name="number" value="" autocomplete="on" size="20" required="">
                                                                    </div>

                                                                    <button id="btnv1" type="button" onclick="shoUser()" class="btn btn-rounded btn-info"> Verify </button>
                                                                    <button id="btnd1" type="submit" disabled class="btn btn-rounded btn-outline-info"> Continue </button>

                                                                <?php } ?>
                                                            </form>
                                                            <br>

                                                            <h3 class="box-title mrg-top-30">Key Highlights</h3>

                                                            <ul class="list-icons">
                                                                <li><i class="fa fa-check text-success"></i> Secure Payment Gateways</li>
                                                                <li><i class="fa fa-check text-success"></i> Instant Activation</li>
                                                                <li><i class="fa fa-check text-success"></i> Efficient Performance</li>
                                                            </ul>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
<!--            <div class="col-sm-4 ">-->
<!--                <br>-->
<!--                <center> <h4>Codes for Data Balance: </h4></center>-->
<!--                <ul class="list-group">-->
<!--                    <li class="list-group-item list-group-item-success">MTN [SME]     *461*4#  </li>-->
<!--                    <li class="list-group-item list-group-item-primary">MTN [Gifting]     *131*4# or *460*260#  </li>-->
<!--                    <li class="list-group-item list-group-item-dark"> 9mobile [Gifting]   *228# </li>-->
<!--                    <li class="list-group-item list-group-item-danger"> Airtel   *140# </li>-->
<!--                    <li class="list-group-item list-group-item-success"> Glo  *127*0#. </li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>



        </form></div>
                            <?php

                            } else{
                                print "<script language='javascript'>window.location = '../index.php';</script>";


                            }
                            }
                            ?>
