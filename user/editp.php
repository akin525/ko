<?php require 'include/database.php';
require 'menubar.php';
$query="SELECT * FROM  users WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($result))
{
    $username=$row["username"];
    $name=$row["name"];
    $date=$row["date"];
    $email=$row["email"];
    $phone=$row["phone"];
    $cphoto=$row["photo"];
}

// Collect the data from post method of form submission //
if(isset($_POST['image'])) {
    $pix = mysqli_real_escape_string($con, $_POST['image']);

//collection ends
//collection ends

    $check = 1;
    if ($check == 1) {

        $status = "OK";
        $msg = "";
//validation starts
// if userid is less than 6 char then status is not ok

        $real = $_SESSION['username'];

    }

    if ($status == "OK") {
        $named = "$pix";
        $query = mysqli_query($con, "update users set  photo='$pix' where username = '" . $_SESSION['username'] . "'");


        $target_dir = "uploads/";
        $target_file = $target_dir . basename($named);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                echo $message = "Profile Update Successfully";
                print "
				<script language='javascript'>
				 let message = 'Image Update Successfully: ';
                                    alert(message);
window.location = 'profile.php';
</script>
";
            }

        }

    }
}
?>
<div class="page-wrapper">
    <div style="padding:90px 15px 20px 15px">
        <h4 class="align-content-center text-sm-center">Update Profile Picture</h4>
        <div class="card">
            <div class="card-body">
                <div class="box w3-card-4">

<form action="" method="post" enctype="multipart/form-data" >
    <div class="col-12">
        <div class="form-group">
            <label for="profilePhoto">Upload Profile Image</label>
            <input type="file" name="image" id="file" class="form-control" >
            <small id="fileHelp" class="form-text text-muted">Ensure your face is showing clearly on the uploaded picture.</small>
        </div>
    </div>
    <button type="submit" name="submit"  class="btn btn-primary btn-block" id="profileUpdateBtn">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="edit-profile-spinner"></span></button>
</form>
