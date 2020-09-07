<div class="box">

    <?php
    include("includes/header.php");
    include("functions/functions.php");
    include("includes/db.php");
    $session_id = $_SESSION['customer_id'];
    ?>

    <?php

    // If the user has not logged in then it prevents them from being able to see the payment page.
    if(!isset($_SESSION['customer_id'])) {

        echo "<script>window.open('login.php','_self')</script>";
    } else {

    ?>

    <form action="payment.php" method="post" enctype="multipart/form-data">
        <div id="content">
            <div class="container">
                <div class="col-md-3">

                    <div id="order-summary" class="box">

                        <div class="box-header">

                            <h3>Order Summary</h3>

                        </div>

                        <div class="table-responsive">

                            <table class="table">

                                <tbody>

                                <?php

                                $ip_add = getRealIpUser();

                                $select_cart = "SELECT * FROM fss_Cart where ip_add='$ip_add'";
                                $run_cart = mysqli_query($con, $select_cart);
                                $total = 0;

                                // Loops through the cart retrieving all the products currently added.
                                while ($row_cart = mysqli_fetch_array($run_cart)) {

                                    $film_id = $row_cart['p_id'];
                                    $film_qty = $row_cart['qty'];

                                    $get_films = "SELECT * FROM fss_Film where filmid='$film_id'";
                                    $run_films = mysqli_query($con, $get_films);

                                    // Calculates individual film prices as well as accumulating an overall price.
                                    while ($row_products = mysqli_fetch_array($run_films)) {

                                        $film_title = $row_products['filmtitle'];
                                        $sub_total = 6.99 * $film_qty;
                                        $total += $sub_total;

                                        echo "
                    
                    <tr>

                        <td> $film_title </td>
                        <th> £$sub_total </th>

                    </tr>
";
                                    }
                                }
                                ?>


                                <tr class="total">

                                    <td> Total</td>
                                    <th> £<?php echo $total; ?> </th>

                                </tr>


                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="col-md-push-5">
                    <button type="submit" name="confirm" class="btn btn-primary">

                        Confirm <i class="fa fa-chevron-right"></i>

                    </button>
                </div>

            </div>
        </div>

    </form>

</div>

<?php

if (isset($_POST['confirm'])) {

    $ip_add = getRealIpUser();

    // Retrieves current date.
    $date = date("Y-m-d");

    // Retrieves shop id of a store with the film in stock.
    $select_shop_id = "SELECT shopid FROM fss_DVDStock WHERE filmid='$film_id' LIMIT 1";
    $run_shop_id = mysqli_query($con, $select_shop_id);
    $shop_id_row = mysqli_fetch_array($run_shop_id);
    $shop_id = $shop_id_row['shopid'];

    // Inserts the order into the fss_Payment table.
    $insert_customer_order = "INSERT INTO fss_Payment (amount,paydate,shopid,ptid) values ($total , '$date', $shop_id, 2)";
    $run_customer_order = mysqli_query($con, $insert_customer_order);

    $pay_id = mysqli_insert_id($con);

    // Inserts the order into the fss_OnlinePayment table.
    $insert_customer_payment = "INSERT INTO fss_OnlinePayment (payid,custid) values ($pay_id,$session_id)";
    $run_customer_payment = mysqli_query($con, $insert_customer_payment);

    $select_cart = "SELECT * FROM fss_Cart where ip_add='$ip_add'";
    $run_cart = mysqli_query($con, $select_cart);

    // Loops through the films and removes stock from the table accordingly.
    while ($row_cart = mysqli_fetch_array($run_cart)) {

        $film_id = $row_cart['p_id'];
        $film_qty = $row_cart['qty'];

        $get_films = "SELECT * FROM fss_Film where filmid='$film_id'";

        $run_films = mysqli_query($con, $get_films);

        while ($row_products = mysqli_fetch_array($run_films)) {

            $reduce_stock = "UPDATE fss_DVDStock SET stocklevel = stocklevel - $film_qty WHERE filmid = $film_id AND shopid = $shop_id";
            $run_reduce_stock = mysqli_query($con, $reduce_stock);

        }
    }

    $delete_cart = "DELETE FROM fss_Cart WHERE ip_add='$ip_add'";
    $run_delete_cart = mysqli_query($con, $delete_cart);

    echo "<script>alert('Order Confirmed!')</script>";
    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
}
?>

<?php

include("includes/footer.php");

}

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
