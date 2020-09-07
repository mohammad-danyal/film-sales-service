<h1 align="center"> Change Password </h1>


<form action="" method="post">

    <div class="form-group">

        <label> Enter Current Password: </label>

        <input type="password" name="old_pass" class="form-control" required>

    </div>

    <div class="form-group">

        <label> Enter New Password: </label>

        <input type="password" name="new_pass" class="form-control" required>

    </div>

    <div class="form-group">

        <label> Confirm New Password: </label>

        <input type="password" name="new_pass_again" class="form-control" required>

    </div>

    <div class="text-center">

        <button type="submit" name="submit" class="btn btn-primary">

            <i class="fa fa-user-md"></i> Update

        </button>

    </div>

</form>


<?php

if(isset($_POST['submit'])){

    $c_id = $_SESSION['customer_id'];
    $c_old_pass = $_POST['old_pass'];
    $c_new_pass = $_POST['new_pass'];
    $c_new_pass_again = $_POST['new_pass_again'];

    $sel_c_old_pass = "SELECT * FROM fss_Customer WHERE custpassword='$c_old_pass'";
    $run_c_old_pass = mysqli_query($con,$sel_c_old_pass);
    $check_c_old_pass = mysqli_fetch_array($run_c_old_pass);

    // If the password does not match with the one stored in the database, it must be incorrect.
    if($check_c_old_pass==0){

        echo "<script>alert('Your current password is incorrect!')</script>";

        // If the two newly entered password don't match it can't be accepted.

    } else if($c_new_pass!=$c_new_pass_again){

        echo "<script>alert('Your new passwords do not match!')</script>";

    } else {

        $update_c_pass = "UPDATE fss_Customer set custpassword='$c_new_pass' WHERE custid='$c_id'";

        $run_c_pass = mysqli_query($con, $update_c_pass);

        echo "<script>alert('Your password has been updated!')</script>";

        echo "<script>window.open('my_account.php?my_orders','_self')</script>";

        }

}

?>