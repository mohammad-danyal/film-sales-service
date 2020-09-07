<?php

include("includes/header.php");

?>

<div id="content">
    <div class="container">
        <div class="col-md-12">
        </div>

        <div class="col-md-3">
        </div>

        <div class="col-md-9">

            <?php

            // If the checkout has been requested but the user isn't logged in they are prompted to log in first.
            if(!isset($_SESSION['customer_id'])){

                echo "<script>window.open('login.php','_self')</script>";

            }else{

            $id = $_SESSION['customer_id'];

                // Ensures a card is stored for the user prior to making payment.

                $check_card = "SELECT * FROM fss_CardDetails where cardid='$id'";
                $check_card_result = mysqli_query($con,$check_card);
                $check_card_rows = mysqli_num_rows($check_card_result);

                if ($check_card_rows > 0) {
                    echo "<script>window.open('payment.php','_self')</script>";
                } else {
                    echo "<script>window.open('add_card_details.php','_self')</script>";
                }
            }

            ?>

        </div>

    </div>
</div>

<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>


</body>
</html>