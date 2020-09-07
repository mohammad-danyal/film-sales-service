<?php

include("includes/header.php");

?>

   <div id="content">
       <div class="container">
           <div class="col-md-12">
           </div>
           
           <div class="col-md-3">

   <?php

    include("includes/sidebar.php");

    ?>
               
           </div>
           
           <div class="col-md-9">

          <?php

               if(!isset($_GET['rating'])){
                   echo "
               <div class='box'>
                   <h1>Films</h1>
                   <p>
                       Choose a movie rating to see what movies are available!
                   </p>
               </div>

               ";
               }

               ?>


               <div class="row">

                   <?php


               if(!isset($_GET['rating'])){

                   $per_page= 6;
                   if(isset($_GET['page'])){
                       $page = $_GET['page'];
                       } else{
                           $page=1;
                       }
                       $start_from = ($page - 1) * $per_page;
                       $get_films = "SELECT * FROM fss_Film order by filmtitle $start_from,$per_page";

                       $run_products = mysqli_query($con,$get_films);

                       // Loops through the fss_Film table adding all the relevant films to the page.
                       while($row_products=mysqli_fetch_array($run_products)){

                           $film_id = $row_products['filmid'];

                           $film_title = $row_products['filmtitle'];

                           echo "
                                
                                    <div class='col-md-4 col-sm-6 center-responsive'>
                                    
                                        <div class='product'>
                                        
                                            <a href='details.php?film_id=$film_id'>
                                                <img class='img-responsive' src='images/logos/logo1.png'>                                
                                            </a>
                                            
                                            <div class='text'>
                                            
                                                <h3>
                                                
                                                    <a href='details.php?film_id=$film_id'> $film_title </a>
                                                
                                                </h3>
                                            
                                                <p class='price'>

                                                    6.99

                                                </p>

                                                <p class='buttons'>

                                                    <a class='btn btn-default' href='details.php?film_id=$film_id'>

                                                        View Details

                                                    </a>

                                                    <a class='btn btn-primary' href='details.php?film_id=$film_id'>

                                                        <i class='fa fa-shopping-cart'></i> Add To Cart

                                                    </a>

                                                </p>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>
                                
                                ";

                       }


               ?>


               </div>

               <center>
                   <ul class="pagination">


                       <?php

                       // Attempt at pagination.

                       $query = "SELECT * FROM fss_Film";

                       $result = mysqli_query($con,$query);

                       $total_records = mysqli_num_rows($result);

                       $total_pages = ceil($total_records / $per_page);

                       echo "

                            <li>
                                <a href='film_menu.php?page=1'> ".'First Page'." </a>
                            </li>
                        ";

                       for($i=1; $i<=$total_pages; $i++){
                       echo "
                            <li>
                                <a href='film_menu.php?page=".$i."'> ".$i." </a>
                            </li>
                        ";

                       };

                       echo "

                            <li>
                                <a href='film_menu.php?page=$total_pages'> ".'Last Page'." </a>
                            </li>

                        ";



                       }

                       ?>

                   </ul>
               </center>

            <?php

               getFilmRatingCategory();

             ?>

           </div>
           
       </div>
   </div>
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    
