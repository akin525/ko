<?php include"menubar.php";


$query = "SELECT * FROM settings";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result))
{
$main = $row["maintain"];
if ($main == 0){
?>

<div class="page-wrapper">
    <div style="padding:90px 15px 20px 15px">
        <h4 class="align-content-center text-center">Data Subscription</h4>
        <div class="card">
            <div class="card-body">
                <div class="box w3-card-4">

                    <h4 class="align-content-center text-center">Unable To Purchase Product</h4>
                    <h4 class="text-center">Contact Admin: 07020214814</h4>

                </div>
            </div>
        </div>
    </div>
</div>
    <?php

} else{
    print "<script language='javascript'>window.location = '../../index.php';</script>";


}
}
?>