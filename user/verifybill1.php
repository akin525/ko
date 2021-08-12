=<?php
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
$number= mysqli_real_escape_string($connection,$_GET["number"]);
$networkcode= mysqli_real_escape_string($connection,$_GET["networkcode"]);
$provider=substr(mysqli_real_escape_string($connection,$_GET["provider"]), 0,1);

$resellerURL='https://superadmin.mcd.5starcompany.com.ng/api/reseller/';

//echo $networkcode . " ". $number;
$curl = curl_init();

curl_setopt_array($curl, array(

    CURLOPT_URL => $resellerURL.'validate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('service' => 'electricity', 'coded' => $networkcode, 'phone' => $number),
    CURLOPT_HTTPHEADER => array(
        'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
    )
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$data=json_decode($response, true);
$success=$data["success"];
$tran=$data["data"];

// Perform transaction/initialize on our server to buy
if($tran==null){
    echo "Verify Successful, Unable to identify account name";
}
else{
    echo $tran;
}
return;
?>
