<?php

include("includes/header.php");
include("includes/db.php");
include ("functions/functions.php");

?>

<?php

if(isset($_GET['film_id'])){

    $film_id = $_GET['film_id'];

    $get_film = "SELECT * FROM fss_Film WHERE filmid='$film_id'";

    $run_film = mysqli_query($con,$get_film);

    $row_film = mysqli_fetch_array($run_film);

    $film_title = $row_film['filmtitle'];

    $film_desc = $row_film['filmdescription'];

}

?>

   <div id="content">
       <div class="container">
           <div class="col-md-12">
           </div>
           
           <div class="col-md-3">
   

               
           </div>
           
           <div class="col-md-9">
               <div id="productMain" class="row">

                   
                   <div class="col-sm-6">
                       <div class="box">
                           <h1 class="text-center"> <?php echo $film_title; ?> </h1>

                           <?php

                           add_cart();

                           ?>
                           
                           <form action="details.php?add_cart=<?php echo $film_id; ?>" class="form-horizontal" method="post">
                               <div class="form-group">
                                   <label for="" class="col-md-5 control-label">Quantity</label>
                                   
                                   <div class="col-md-7">

                                          <select name="film_qty" id="" class="form-control">

                                              <?php

                                              $find_stock_amount = "SELECT SUM(stocklevel) FROM fss_DVDStock WHERE filmid = '$film_id'";
                                              $run_stock_amount = mysqli_query($con,$find_stock_amount);
                                              $stock_amount_row = mysqli_fetch_array($run_stock_amount);
                                              $stock = $stock_amount_row['SUM(stocklevel)'];

                                              for ($x = 0; $x <= $stock; $x++) {
                                                  echo "
                                                  <option> $x </option>
                                                  ";
                                              }

                                              ?>


                                           </select>
                                   
                                    </div>
                                   
                               </div>

                               <p class="price">£6.99</p>
                               
                               <p class="text-center buttons"><button class="btn btn-primary i fa fa-shopping-cart"> Add to cart</button></p>
                               
                           </form>

                       </div>

                       <div class="row" id="thumbs">



                       </div>

                   </div>
                   
                   
               </div>
               
               <div class="box" id="details">
                       
                       <h4>Film Description</h4>
                   
                   <p>

                       <?php echo $film_desc; ?>

                   </p>

                   
               </div>

   </div>
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
