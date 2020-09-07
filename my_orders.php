<center>
    
    <h1> My Orders </h1>
    
    <p class="text-muted">
        
        If you have any questions, feel free to contact us</a>
        
    </p>
    
</center>


<hr>


<div class="table-responsive">
    
    <table class="table table-bordered table-hover">
        
        <thead>
            
            <tr>

                <th> Amount: </th>
                <th> Order Date:</th>
                
            </tr>
            
        </thead>

        <tbody>

        <?php

        // Retrieves payment id's for the customer's previous orders.
        $get_payment_id = "SELECT payid FROM fss_OnlinePayment WHERE custid= $session_id";
        $run_payment_id = mysqli_query($con,$get_payment_id);
        $row_payment_id = mysqli_fetch_array($row_payment_id);

        // Loops through these payments retrieving the date and amount for each other which is displayed on the page.
        while($r_payment_id = mysqli_fetch_array($run_payment_id)){

            $payment_id = $r_payment_id['payid'];

            $get_payment_details = "SELECT * FROM fss_Payment WHERE payid='$payment_id'";
            $run_payment_details = mysqli_query($con,$get_payment_details);
            $row_payment_details = mysqli_fetch_array($run_payment_details);

            $payment_amount = $row_payment_details['amount'];
            $payment_date = $row_payment_details['paydate'];

            ?>

            <tr>

                <th> £<?php echo $payment_amount; ?> </th>
                <td> <?php echo $payment_date; ?> </td>

            </tr>

        <?php } ?>

        </tbody>
        
    </table>
    
</div>
