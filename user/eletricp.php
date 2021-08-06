<?php include ("menu.php");
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>
					window.location = 'user/login.php';
				</script>";
}
?>
<?php


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
    CURLOPT_POSTFIELDS => array('service' => 'electricity'),
    CURLOPT_HTTPHEADER => array(
        'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$data=json_decode($response, true);
$success=$data["success"];
$success1=$data["message"];
foreach($data['data'] as $plans){
//    echo $plans['name'];
//    echo $plans['code'];

//    $i = $plans['id'];
//    $n = $plans['type'];
//    $t = $plans['name'];
//    $a = $plans['amount'];
//    $s = $plans['status'];
//    $d = $plans['name'];
//    $n = $plans['code'];


//foreach($data['data'] as $plans) {
//    $query = mysqli_query($connection, "INSERT INTO `products1` ( `name`, `tittle`, `details`, `amount`, `status`, `dataplan`, `networkcode`, `product_type`) values ('$t', '$t', '$t',  '0.00', '$s', '$d', '$n', 'nepa')");
//}
}
?>

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
                                                        <th>Name</th>
                                                        <th>Code</th>
<!--                                                        <th>Amount</th>-->
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
                                                        <td><i class="fa fa-lg"></i><?php echo $plans['name']; ?></td>
                                                        <td><i class="fa fa-lg"></i><?php echo $plans['code']; ?></td>
<!--                                                        <td>--><?php //echo $plans['amount']; ?><!--</td>-->
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
                                                        echo  "No Electricity Available";
                                                        }
                                                        ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
