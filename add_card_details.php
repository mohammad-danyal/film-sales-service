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

                    <h2> Enter Card Details </h2>

                </center>

                <form action="add_card_details.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">

                        <label>Card Number</label>

                        <input type="text" class="form-control" name="c_card_number" required>

                    </div>

                    <div class="form-group">

                        <label>Type</label>

                        <input type="text" class="form-control" name="c_card_type" required>

                    </div>

                    <div class="form-group">

                        <label>Expiry Date</label>

                        <input type="text" maxlength="5" class="form-control" name="c_card_expiry" required pattern="^(3[01]|[12][0-9]|0[1-9]):[0-9]{2}" placeholder='mm:yy'>

                    </div>

                    <div class="text-center">

                        <button type="submit" name="confirm" class="btn btn-primary">

                            <i class="fa fa-user-md"></i> Confirm

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

if(isset($_POST['confirm'])){

    $c_card_number = $_POST['c_card_number'];

    $c_card_type = $_POST['c_card_type'];

    $c_card_expiry = $_POST['c_card_expiry'];

    $c_ip = getRealIpUser();

    $id = $_SESSION['customer_id'];

    /// Updates fss_CardDetails
    $insert_card_details = "INSERT INTO fss_CardDetails (cardid, cno, ctype, cexpr) values ('$id','$c_card_number','$c_card_type','$c_card_expiry')";
    $run_insert_card_details = mysqli_query($con,$insert_card_details);

    // Retrieves cart.
    $sel_cart = "SELECT * FROM fss_Cart where ip_add='$c_ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    if($check_cart>0){

        /// If the user who is adding card details has items in their cart, they are redirected to the payment page once finished. ///

        echo "<script>alert('Card Details Added Successfully!')</script>";

        echo "<script>window.open('payment.php','_self')</script>";

    }else{

        /// If the user who is adding card details has an empty cart, they are redirected to the home page.  ///

        echo "<script>alert('Card Details Added Successfully!')</script>";

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


