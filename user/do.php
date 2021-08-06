$mail= "info@efemobilemoney.com";
$to = $email;
$from = $mail;
$name = $n;
//$subject = $_REQUEST['subject'];
//$number = $_REQUEST['phone_no'];
//$cmessage = $_REQUEST['message'];

$headers = "From: $from";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$subject = "From EFE MOBILE MONEY.";

$logo = '<img src=public/images/logo/logo.png alt=logo>';
$link = '#';

$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
$body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
            $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
            $body .= "<p style='border:none;'><strong>Password Update<strong>";
                        $body .= "<p style='border:none;'><strong>Your Password has been Change Successful. </strong> New Password: {$password} </p>";
            //        $body .= "<p style='border:none;'><strong>Kindly Update Your Password after Log-in Your Profile</strong></p>";
            //$body .= "<p style='border:none;'><strong>Password:</strong> {$password}</p>";
            //$body .= "<p style='border:none;'><strong>Wallet Balance:</strong>#0.00</p>";
            $body .= "</tr>";
    // 	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
    $body .= "<tr><td></td></tr>";
    //$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
$body .= "</body></html>";

$send = mail($to, $subject, $body, $headers);