<?php

include("includes/header.php");
include("functions/functions.php")

?>
   
   <div id="content">
       <div class="container">
           <div class="col-md-12">
               
           </div>
           
           <div id="cart" class="col-md-9">
               
               <div class="box">
                   
                   <form action="cart.php" method="post" enctype="multipart/form-data">
                       
                       <h1>Shopping Cart</h1>

                       <?php

                       $ip_add = getRealIpUser();

                       $select_cart = "SELECT * FROM fss_Cart where ip_add='$ip_add'";

                       $run_cart = mysqli_query($con,$select_cart);

                       $count = mysqli_num_rows($run_cart);

                       ?>


                       <p class="text-muted">You currently have <?php echo $count; ?> item(s) in your cart</p>
                       
                       <div class="table-responsive">
                           
                           <table class="table">
                               
                               <thead>
                                   
                                   <tr>
                                       
                                       <th colspan="2">Product</th>
                                       <th>Sub-Total</th>
                                       <th>Delete</th>

                                   </tr>
                                   
                               </thead>
                               
                               <tbody>

                               <?php

                               $total = 0;

                               while($row_cart = mysqli_fetch_array($run_cart)){

                               $film_id = $row_cart['p_id'];

                               $film_qty = $row_cart['qty'];

                               $get_films = "SELECT * FROM fss_Film where filmid='$film_id'";

                               $run_films = mysqli_query($con,$get_films);

                               while($row_products = mysqli_fetch_array($run_films)){

                               $film_title = $row_products['filmtitle'];

                               $sub_total = 6.99*$film_qty;

                               $total += $sub_total;

                               ?>
                                   
                                   <tr>

                                       
                                       <td>

                                           <a href="details.php?film_id=<?php echo $film_id; ?>"> <?php echo $film_title; ?> </a>
                                           
                                       </td>
                                       
                                       <td>

                                           <?php echo $film_qty; ?>
                                           
                                       </td>


                                       <td>

                                           £<?php echo $sub_total; ?>

                                       </td>

                                       <td>

                                           <input type="checkbox" name="remove[]" value="<?php echo $film_id; ?>">
                                           
                                       </td>

                                       
                                   </tr>

                               <?php } } ?>
                                   
                               </tbody>

                               
                               <tfoot>
                                   
                                   <tr>
                                       
                                       <th colspan="5">Total</th>
                                       <th colspan="2">£<?php echo $total; ?></th>
                                       
                                   </tr>
                                   
                               </tfoot>
                               
                           </table>
                           
                       </div>
                       
                       <div class="box-footer">
                           
                           <div class="pull-left">
                               
                               <a href="index.php" class="btn btn-default">
                                   
                                   <i class="fa fa-chevron-left"></i> Continue Shopping
                                   
                               </a>
                               
                           </div>
                           
                           <div class="pull-right">
                               
                               <button type="submit" name="update" value="Update Cart" class="btn btn-default">
                                   
                                   <i class="fa fa-refresh"></i> Update Cart
                                   
                               </button>
                               
                               <a href="checkout.php" class="btn btn-primary">
                                   
                                   Proceed Checkout <i class="fa fa-chevron-right"></i>
                                   
                               </a>
                               
                           </div>
                           
                       </div>
                       
                   </form>
                   
               </div>


               <?php

               function update_cart(){

                   global $con;

                   if(isset($_POST['update'])){

                       foreach($_POST['remove'] as $remove_id){

                           $delete_product = "DELETE FROM fss_Cart where p_id='$remove_id'";

                           $run_delete = mysqli_query($con,$delete_product);

                           if($run_delete){

                               echo "<script>window.open('cart.php','_self')</script>";

                           }
                       }
                   }
               }
               echo @$up_cart = update_cart();
               ?>

           
       </div>
   </div>
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
