<?php include "menu.php";
include_once ("include/database.php");

// Inialize session
//session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>	window.location = 'index.php';</script>";
}
//$productid=mysqli_real_escape_string($connection,$_GET['productid']);
//$number= mysqli_real_escape_string($connection,$_GET["number"]);
$networkcode= mysqli_real_escape_string($connection,$_POST["value"]);


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/list',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('service' => 'data', 'coded' => $networkcode),
    CURLOPT_HTTPHEADER => array(
        'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//$data=json_decode($response, true);
//$success=$data["success"];
//$success1=$data["message"];
////$tran=$data["data"]["name"];
//$tran1=$data["data"]["type"];
//$tran2=$data["data"]["name"];
//$tran3=$data["data"]["amount"];
//$tran4=$data["data"]["discount"];
//$tran5=$data["data"]["status"];


$data=json_decode($response, true);
$success=$data["success"];
$success1=$data["message"];
foreach($data['data'] as $plans){
//    echo $plans['name'];
//    echo $plans['code'];
}

?>
<!--<button type="submit" class="btn btn-outline-primary btn-rounded"><a href="previewproduct.php">Back To Previewproduct</a></button>-->

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <!--                                                <h4 class="font-weight-bold mb-0">--><?php //echo $name; ?><!--</h4>-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Avaliable Product</h4>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Network</th>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($success==1){
                                foreach($data['data'] as $plans){
                                ?>
                                <tr>
                                    <td><i class="fa fa-lg"></i><?php echo $plans['type']; ?></td>
                                    <td><i class="fa fa-lg"></i><?php echo $plans['name']; ?></td>
                                    <td><i class="fa fa-lg"></i><?php echo $plans['code']; ?></td>
                                    <td><?php echo $plans['amount']; ?></td>
                                    <td><?php echo $plans['discount']; ?></td>
                                    <?php
                                    if($plans['status']==1){
                                        $b="Active";
                                         $a=$b;
                                    }
                                    else{
                                        $b="Not Active";
                                    }
                                    ?>
                                    <td><?php echo $a; ?></td>
                                    <?php }
                                    }else{
                                    echo "No Available Mobile Data";
                                    }
                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>