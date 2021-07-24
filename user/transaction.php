<?php include_once("include/database.php");
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
    print "
<script language='javascript'>
    window.location = 'login.php';
</script>
";
}

//$topay= mysqli_real_escape_string($con,$_GET["amount"]);
$refid= mysqli_real_escape_string($connection,$_GET["reference"]);
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$refid",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_280c68e08f76233b476038f04d92896b4749eec3",
        "Cache-Control: no-cache",
    ),
));
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0)

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
$data=json_decode($response, true);
$amount=$data["data"]["amount"]/100;



$query="SELECT * FROM users where username ='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($result))
{
    $depositor="$row[username]";
    $email="$row[email]";
    $name="$row[name]";
}

$query="SELECT * FROM  wallet WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($result))
{
    $ubalance=$row["balance"];
}

$fwallet=$ubalance+$amount;





$query=mysqli_query($connection,"insert into deposit (status, username, amount, payment_ref,  iwallet, fwallet, date) values (1,'$depositor', '$amount', '$refid', '$ubalance', '$fwallet', CURRENT_TIMESTAMP)");
$result=mysqli_query($connection,"update wallet set balance=balance+$amount WHERE username='$depositor'");
$query="SELECT * FROM deposit where username ='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($result))
{
    $depositor=$row["amount"];
    $iwallet=$row["iwallet"];

}

$mail= "mcd@gmail.com";
$to = $email;
$from = $mail;
//$name = $_REQUEST['name'];
//$subject = $_REQUEST['subject'];
//$number = $_REQUEST['phone_no'];
//$cmessage = $_REQUEST['message'];

$headers = "From: $from";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$subject = "From EFE MOBILE MONEY.";

$logo = '<img src="public/images/logo/logo.png" alt="logo">';
$link = '#';

$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
$body .= "<table style='width: 100%;'>";
$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
$body .= "<p style='border:none;'><strong>Wallet Summary<strong>";
$body .= "<p style='border:none;'><strong>Name:</strong> {$name}</p>";
$body .='<table rules="all" style="border-color: #666;" cellpadding="10">';
$body .= "<tr><td><strong>Early Payments</strong> </td><td>: NGN {$amount}</td></tr>";
$body .= "<tr><td><strong>Matured Deposit</strong> </td><td>: NGN{$iwallet}</td></tr>";
$body .=  "<tr><td><strong>Released Deposit</strong> </td><td>: NGN{$fwallet}</td></tr>";
$body .= "</tr>";
// 	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
$body .= "</table>";
//$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
$body .= "</body></html>";

$send = mail($to, $subject, $body, $headers);
echo "<script language='javascript'>window.location = 'dashboard.php';</script>";
?>


