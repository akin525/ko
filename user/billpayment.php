<?php

include_once ("include/database.php");

// Inialize session
//session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>	window.location = 'index.php';</script>";
}

$product_type="";
$topay= intval(mysqli_real_escape_string($connection,$_GET["amount"]));
$refid= mysqli_real_escape_string($connection,$_GET["refid"]);
$product= mysqli_real_escape_string($connection,$_GET["product"]);
$productid=mysqli_real_escape_string($connection,$_GET['productid']);
$phone=mysqli_real_escape_string($connection,$_GET['number']);
$GLOBALS['recipient']=mysqli_real_escape_string($connection,$_GET['number']);
$GLOBALS['method']=mysqli_real_escape_string($connection,$_GET['method']);


$query="SELECT * FROM users where username = '".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($result))
{
    $payer="$row[username]";
}

$query="SELECT * FROM  products1 where  id = '$productid'";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($result)){
    $name="$row[name]";
    $title="$row[tittle]";
    $details="$row[details]";
    $dataplan="$row[dataplan]";
    $networkcode="$row[networkcode]";
    $product_type="$row[product_type]";
}

//echo $networkcode, $phone;

function pro($tran_stat, $product, $payer, $topay, $refid, $results, $con){
    $query="SELECT * FROM  wallet WHERE username='".$_SESSION['username']."'";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($result)){
        $balance="$row[balance]";
    }

//    $query=mysqli_query($con,"insert into bill_payment (status,product, username, amount, transactionid, paymentmethod, server_response) values ('$tran_stat','$product', '$payer', '$topay', '$refid', '". $GLOBALS['method']."', '$results')");

    if($tran_stat==0){
        $refund=$balance+$topay;
        $query=mysqli_query($connection,"update wallet set balance='".$refund."' where username='".$_SESSION['username']."'");
    }
    echo "<script language='javascript'> window.location='mcderror.php';</script>";
}

//start buying
if($product_type=="data"){
//    buy($networkcode, $product_type, $phone, $product, $payer, $topay, $refid, $con);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('service' => 'data','coded' => $networkcode,'phone' => $phone),
        CURLOPT_HTTPHEADER => array(
            'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
//    echo $response;

    $data=json_decode($response, true);
    $success=$data["success"];
    $tran=$data["ref"];
//return;
    if($success==1) {
        $query = mysqli_query($connection, "insert into bill_payment (product, username, amount, transactionid, paymentmethod,status) values ('$title', '$payer', '$topay', '$tran', 'Wallet Payment', '$success')");
        echo "<script language='javascript'> window.location='myinvoice.php';</script>";
    }
    if($success==0){
        $query=mysqli_query($connection,"update wallet set balance=balance+$topay where username='".$_SESSION['username']."'");
        echo "<script language='javascript'>
  let message = '$topay Refunded';
                                    alert(message);
// window.location='mcderror.php';</script>";
    }
}

elseif ($product_type=="airtime") {
//    buy($networkcode, $product_type, $phone, $product, $payer, $topay, $refid, $con);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('service' => 'airtime','coded' => $networkcode,'phone' => $phone,'amount' => $topay),

        CURLOPT_HTTPHEADER => array(
            'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
        )));

    $response = curl_exec($curl);

    curl_close($curl);
//    echo $response;
//    return;
    $data=json_decode($response, true);
    $success=$data["success"];
    $tran=$data["ref"];
    if($success==1) {
        $query = mysqli_query($connection, "insert into bill_payment (product, username, amount, transactionid, paymentmethod,status) values ('$title', '$payer', '$topay', '$tran', 'Wallet Payment', '$success')");
        echo "<script language='javascript'> window.location='myinvoice.php';</script>";
    }
    if($success==0){
        $query=mysqli_query($connection,"update wallet set balance=balance+$topay where username='".$_SESSION['username']."'");
        echo "<script language='javascript'>
  let message = '$topay Refunded';
                                    alert(message);
// window.location='mcderror.php';</script>";
    }
}
elseif ($product_type=="tv") {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('service' => 'tv','coded' => $networkcode,'phone' => $phone),
        CURLOPT_HTTPHEADER => array(
            'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
//    echo $response;
    $data=json_decode($response, true);
    $success=$data["success"];
    $m=$data["message"];
    $net=$data["ref"];
    if($success==1) {
        $query = mysqli_query($connection, "insert into bill_payment (product, username, amount, transactionid, paymentmethod,status) values ('$title', '$payer', '$topay', '$net', 'Wallet Payment', '$success')");
        echo "<script language='javascript'> 
let message = '$m';
                                    alert(message);
window.location='myinvoice.php';</script>";
    }
    if($success==0){
        $query=mysqli_query($connection,"update wallet set balance=balance+$topay where username='".$_SESSION['username']."'");
        echo "<script language='javascript'>
  let message = '$topay Refunded';
                                    alert(message);
 window.location='mcderror.php';</script>";
    }
}
elseif ($product_type=="nepa") {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('service' => 'electricity','coded' => $networkcode,'phone' => $phone, 'amount' => $topay),
        CURLOPT_HTTPHEADER => array(
            'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
//    echo $response;
    $data=json_decode($response, true);
    $success=$data["success"];
    $m=$data["message"];
    $net=$data["ref"];
    if($success==1) {
        $query = mysqli_query($connection, "insert into bill_payment (product, username, amount, transactionid, paymentmethod,status) values ('$title', '$payer', '$topay', '$net', 'Wallet Payment', '$success')");
        echo "<script language='javascript'> 
let message = '$m';
                                    alert(message);
window.location='myinvoice.php';</script>";
    }
    if($success==0){
        $query=mysqli_query($connection,"update wallet set balance=balance+$topay where username='".$_SESSION['username']."'");
        echo "<script language='javascript'>
  let message = '$topay Refunded';
                                    alert(message);
 window.location='mcderror.php';</script>";
    }
}



//function buy($networkcode, $product_type, $phone, $product, $payer, $topay, $refid, $con){
//    $url=$GLOBALS['server'].'coded=' . $networkcode . '&phone=' . $phone . '&amount='.$topay . '&service=' . $product_type . '&refid=' . $refid . '&payer=' . $payer . '&token=873ey3uidvr3274';
//
//    // Perform transaction/initialize on our server to buy
//    $results = file_get_contents($url);
//    $str_arr = explode (",", $results);
//
//
//    if ($str_arr[0]==1) {
//        $tran_stat="1";
//        if($product_type=="prepaid"){
//            $token=$str_arr[4];
//            $product=$product." with token => ".$token;
//        }
//        pro($tran_stat, $product, $payer, $topay, $refid, $results, $con);
//
//    }else {
//        $tran_stat="0";
//        pro($tran_stat, $product, $payer, $topay, $refid, $results, $con);
//    }
//
//}//end buying data

?>
