
<?php
include("includes/header.php");
include("includes/db.php");
?>

<div id="content">
    <div class="container">
        <div class="col">
        </div>

        <div class="col">

            <div class="box">

                <div class="box-header">

                    <center>

                        <h1> Login </h1>

                    </center>

                </div>

                <form method="post" action="login.php">

                    <div class="form-group">

                        <label> Email </label>

                        <input name="c_email" type="email" class="form-control" required>

                    </div>

                    <div class="form-group">

                        <label> Password </label>

                        <input name="c_pass" type="password" class="form-control" required>

                    </div>

                    <div class="text-center">

                        <button name="login" value="Login" class="btn btn-primary">

                            <i class="fa fa-sign-in"></i> Login

                        </button>

                    </div>

                </form>

                <center>

                    <a href="register.php">

                        <h3> Don't have an account? Register here </h3>

                    </a>

                </center>

            </div>

        </div>

        <div class="col">


        </div>

    </div>
</div>


<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>

<?php

if(isset($_POST['login'])){

    $c_email = $_POST['c_email'];

    $c_pass = $_POST['c_pass'];

    // Retrieves the customers id from the inputted email address.
    $find_customer_id = "SELECT personid FROM fss_Person where personemail='$c_email'";
    $customer_id_result = mysqli_query($con,$find_customer_id);
    $customer_id_row = mysqli_fetch_array($customer_id_result);
    $person_id = $customer_id_row['personid'];

    $check_customer_id = mysqli_num_rows($customer_id_result);

    // Retrieves correct customer password.
    $find_customer_pass = "SELECT custpassword FROM fss_Customer WHERE custid ='$person_id'";
    $customer_pass_result = mysqli_query($con,$find_customer_pass);
    $customer_pass_row = mysqli_fetch_array($customer_pass_result);
    $customer_pass = $customer_pass_row['custpassword'];

    $check_customer_pass = mysqli_num_rows($customer_pass_result);

    $get_ip = getRealIpUser();

    // Retrieves users cart.
    $select_cart = "SELECT * FROM fss_Cart WHERE ip_add='$get_ip'";
    $run_cart = mysqli_query($con,$select_cart);
    $check_cart = mysqli_num_rows($run_cart);

    // If no password or customer id is found that matches the provided details then one of them must be incorrect.
    if($check_customer_pass==0 || $check_customer_id ==0){

        echo "<script>alert('Incorrect Email or Password')</script>";
        exit();

        }else {

        // If there is a password match proceeds to check the cart.
        if ($customer_pass == $c_pass) {

            if ($check_cart == 0) {

                $_SESSION['customer_id'] = $person_id;

                echo "<script>alert('You are Logged in')</script>";

                echo "<script>window.open('my_account.php?my_orders','_self')</script>";

            } else {

                $_SESSION['customer_id'] = $person_id;

                echo "<script>alert('You are Logged in')</script>";

                echo "<script>window.open('checkout.php','_self')</script>";
            }

        }else {

            echo "<script>alert('Incorrect Email or Password')</script>";
            exit();
        }


    }
}


function getRealIpUser(){

    switch(true){

        case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
        case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
        case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default : return $_SERVER['REMOTE_ADDR'];

    }
}

?>


