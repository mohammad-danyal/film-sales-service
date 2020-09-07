<?php
session_start();
include("includes/header.php");
include("functions/functions.php");
include("includes/db.php");
$session_id = $_SESSION['customer_id'];
?>

<?php

// If the user has not logged in then it prevents them from being able to see the 'My Account' section.

if(!isset($_SESSION['customer_id'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

    ?>

    <div id="content">
        <div class="container">
            <div class="col-md-12">
            </div>

            <div class="col-md-3">

                <?php

                include("includes/profilemenu.php");

                ?>

            </div>

            <div class="col-md-9">

                <div class="box">

                    <?php

                    if (isset($_GET['my_orders'])) {
                        include("my_orders.php");
                    }

                    if (isset($_GET['edit_account'])) {
                        include("edit_account.php");
                    }

                    if (isset($_GET['change_pass'])) {
                        include("change_pass.php");
                    }

                    if (isset($_GET['delete_account'])) {
                        include("delete_account.php");
                    }

                    ?>

                </div>

            </div>

        </div>
    </div>

    <?php

    include("includes/footer.php");

}
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
