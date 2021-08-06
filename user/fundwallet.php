<?php include ("menu.php");
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>
					window.location = 'login.php';
				</script>";
}
$query="SELECT * FROM  wallet WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);

//$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
while($row = mysqli_fetch_array($result))
{
    $balance=$row["balance"];
}

$query = "SELECT * FROM  users WHERE username='" . $_SESSION['username'] . "'";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($result)) {
    $username = "$row[username]";
    $name = $row["name"];
    $date = $row["date"];
    $email = $row["email"];
    $phone = $row["phone"];

}
$iwallet=0;
$fwallet=0;
$amount=0;

$query="SELECT * FROM  deposit WHERE username='" . $_SESSION['username'] . "'";
$result = mysqli_query($connection,$query);

//$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
while($row = mysqli_fetch_array($result))
{

    $iwallet=$row["iwallet"];
    $fwallet=$row["fwallet"];
    $amount=$row["amount"];
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
<!--                    <div class="col-xl-9 col-md-8">-->
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Wallet</h4>
                                        <div class="wallet-details">
                                            <span>Wallet Balance</span>
                                            <h3>NGN <?php echo number_format(intval($balance *1),2);?></h3>
                                            <div class="d-flex justify-content-between my-4">
<!--                                                <div>-->
<!--                                                    <p class="mb-1">Early Balance</p>-->
<!--                                                    <h4>NGN --><?php //echo number_format(intval($iwallet *1),2);?><!--</h4>-->
<!--                                                </div>-->
<!--                                                <div>-->
<!--                                                    <p class="mb-1">New Deposit</p>-->
<!--                                                    <h4>NGN --><?php //echo number_format(intval($amount *1),2);?><!--</h4>-->
<!--                                                </div>-->
                                            </div>
                                            <div class="wallet-progress-chart">
<!--                                                <div class="d-flex justify-content-between">-->
<!--                                <span>NGN --><?php //echo number_format(intval($iwallet *1),2);?>
<!--</span>-->
<!--                                                    <span>NGN --><?php //echo number_format(intval($amount *1),2);?>
<!--</span>-->
<!--                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Wallet</h4>
                                        <?php
                                        if($_SERVER['REQUEST_METHOD'] == 'POST')

                                            $amou=intval(mysqli_real_escape_string($connection,$_POST['amount']));
                                        {
                                        ?>
                                        <form id="paymentForm" action="transfer.php" method="post">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">

                                                        <label class="form-control">NGN</label>
                                                    </div>
                                                    <input type="number" maxlength="4" class="form-control" name="amount" id="amount" placeholder="00.00" required/>
                                                </div>

                                            </div>
                                            <input type="hidden"  id="email-address" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <p></p>
<!--                                    <p class="mb-3">OR</p>-->
<!--                                    <ul class="list-inline mb-0">-->
<!--                                        <li class="line-inline-item mb-0 d-inline-block">-->
<!--                                            <button type="submit" name="amount" value="500" onclick="payWithPaystack()"> 500</button>-->
<!--                                        </li>-->
<!--                                        <li class="line-inline-item mb-0 d-inline-block">-->
<!--                                            <a href="javascript:;" id="1000" type="submit">1000</a>-->
<!--                                        </li>-->
<!--                                        <li class="line-inline-item mb-0 d-inline-block">-->
<!--                                            <a href="javascript:;" id="1500" class="updatebtn">1500</a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
                                </div>
<!--                                <b class="text-success fa-bold" id="vtv1"></b>-->
                                <button class=" btn-block withdraw-btn" type="button" ><a href="transfer.php">Fund With Transfer</a></button>
                                <?php } ?>
                                <button class="btn btn-primary btn-block withdraw-btn" type="submit" onclick="payWithPaystack()"> Fund With Paystack</button>
                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<!--        <div class="row">-->
<!--            <div class="col-md-7 grid-margin stretch-card">-->
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Deposit History</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Username</th>
                                    <th>Total Balance</th>
                                    <th>Amount Before</th>
                                    <th>Amount After</th>
                                    <th>Payment_Ref</th>
                                </tr>
                                </thead>
                <?php
                $query = "SELECT * FROM deposit WHERE username ='".$_SESSION['username']."'";
                $result = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($result)) { ?>

                    <tr>
<!--                        <td>--><?php //echo $row["id"] ; ?><!--</td>-->
                        <td><?php echo $row["date"] ; ?></td>
                        <td><?php echo $row["username"] ; ?></td>
                        <td>NGN<?php echo $row["amount"] ; ?></td>
                        <td>NGN<?php echo $row["iwallet"] ; ?></td>
                        <td>NGN<?php echo $row["fwallet"] ; ?></td>
                        <td><?php echo $row ["payment_ref"] ; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                </table>
            </div>
        </div>
        <script>
            const paymentForm = document.getElementById('paymentForm');
            paymentForm.addEventListener("submit", payWithPaystack, false);
            function payWithPaystack(e) {
                e.preventDefault();
                let handler = PaystackPop.setup({
                    key: 'pk_test_17fd09d2f1b858a21859595153d9770573a7c996', // Replace with your public key
                    email: document.getElementById("email-address").value,
                    amount: document.getElementById("amount").value * 100,
                    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
// label: "Optional string that replaces customer email"
                    onClose: function(){
                        alert('Window closed.');
                    },
                    callback: function(response){
                        let message = 'Payment complete! Reference: ' + response.reference;
                        // alert(message);

                        window.location = 'transaction.php?reference='+response.reference;

                    }
                });
                handler.openIframe();
            }
        </script>