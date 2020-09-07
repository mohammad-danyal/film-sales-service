<?php

include("includes/header.php");
include("includes/db.php");

?>

<div id="content">
    <div class="container">
        <div class="col>
           </div><!-- col-md-12 Finish -->
           
           <div class="col">


    </div>

    <div class="col">

        <div class="box">

            <div class="box-header">

                <center>

                    <h2> Register a new account </h2>

                </center>

                <form action="register.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">

                        <label>Forename</label>

                        <input type="text" class="form-control" name="c_fname" required>

                    </div>

                    <div class="form-group">

                        <label>Surname</label>

                        <input type="text" class="form-control" name="c_sname" required>

                    </div>

                    <div class="form-group">

                        <label>Street</label>

                        <input type="text" class="form-control" name="c_street" required pattern = "[a-zA-Z ]+$" required
                               oninvalid="setCustomValidity('Not a valid street name')"
                               onchange="try{setCustomValidity('')}catch(e){}" />>>>

                    </div>

                    <div class="form-group">

                        <label>City</label>

                        <input type="text" class="form-control" name="c_city" required pattern = "[a-zA-Z ]+$"
                        oninvalid="setCustomValidity('Not a valid city name')"
                        onchange="try{setCustomValidity('')}catch(e){}" />>

                    </div>

                    <div class="form-group">

                        <label>Postcode</label>

                        <input type="text" class="form-control" name="c_postcode" minlength="6" maxlength="8" required pattern="[a-zA-z0-9]+$" required
                               oninvalid="setCustomValidity('Not a valid postcode (no spaces allowed)')"
                               onchange="try{setCustomValidity('')}catch(e){}" />>>

                    </div>

                    <div class="form-group">

                        <label>Phone Number</label>

                        <input type="text" class="form-control" name="c_number" minlength="10" maxlength="11" required pattern="^[0-9]*$"
                               oninvalid="setCustomValidity('Not a valid phone number')"
                               onchange="try{setCustomValidity('')}catch(e){}" />>>>

                    </div>

                    <div class="form-group">

                        <label>Email Address</label>

                        <input type="text" class="form-control" name="c_email" required pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required
                               oninvalid="setCustomValidity('Not a valid email address')"
                               onchange="try{setCustomValidity('')}catch(e){}" />>>>

                    </div>

                    <div class="form-group">

                        <label>Choose Password</label>

                        <input type="password" class="form-control" name="c_pass" required>

                    </div>


                    <div class="text-center">

                        <button type="submit" name="register" class="btn btn-primary">

                            <i class="fa fa-user-md"></i> Register

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
</div>

<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>

<?php

if(isset($_POST['register'])){

    $c_fname = $_POST['c_fname'];

    $c_sname = $_POST['c_sname'];

    $c_street = $_POST['c_street'];

    $c_city = $_POST['c_city'];

    $c_postcode = $_POST['c_postcode'];

    $c_number = $_POST['c_number'];

    $c_email = $_POST['c_email'];

    $c_pass = $_POST['c_pass'];

    $c_ip = getRealIpUser();

    /// Updates fss_Person Table
    $insert_customer = "INSERT INTO fss_Person (personname,personphone,personemail) values ('$c_fname $c_sname','$c_number','$c_email')";
    $run_customer = mysqli_query($con,$insert_customer);

    // Retrieves the customers id to then update the fss_Customer table with
    $find_customer_id = "SELECT personid FROM fss_Person where personemail='$c_email'";
    $customer_id_result = mysqli_query($con,$find_customer_id);
    $customer_id_row = mysqli_fetch_array($customer_id_result);
    $person_id = $customer_id_row['personid'];

    $regdate = date("Y-m-d");

    $insert_customer_id = "INSERT INTO fss_Customer (custid,custregdate, custpassword) values ('$person_id','$regdate','$c_pass')";
    $run_customer_id = mysqli_query($con,$insert_customer_id);

    // Inserts address into fss_Address table and then update fss_CustomerAddress
    $insert_address_id = "INSERT INTO fss_Address (addstreet,addcity,addpostcode) values ('$c_street','$c_city','$c_postcode')";
    $address_id_result = mysqli_query($con,$insert_address_id);
    $address_id_row = mysqli_fetch_array($address_id_result);
    $address_id = mysqli_insert_id($con);

    $insert_address_id = "INSERT INTO fss_CustomerAddress (addid,custid) values ('$address_id','$person_id')";
    $run_address_id = mysqli_query($con,$insert_address_id);

    $sel_cart = "SELECT * FROM fss_Cart where ip_add='$c_ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    if($check_cart>0){

        /// If person who is registering has items in cart ///

        $_SESSION['customer_id']=$person_id;

        echo "<script>alert('You have been registered!')</script>";

        echo "<script>window.open('checkout.php','_self')</script>";

    }else{

        /// If there are no items in cart ///

        $_SESSION['customer_id']=$person_id;

        echo "<script>alert('You have been registered!')</script>";

        echo "<script>window.open('index.php','_self')</script>";

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


