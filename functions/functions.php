<?php 

global $db;

// Collects users IP details.
function getRealIpUser(){

    switch(true){

        case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
        case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
        case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default : return $_SERVER['REMOTE_ADDR'];

    }
}

// Creates a cart for the user.
function add_cart()
{
    global $db;

    if (isset($_GET['add_cart'])) {

        $ip_add = getRealIpUser();

        $p_id = $_GET['add_cart'];

        $film_qty = $_POST['film_qty'];

        $film_size = $_POST['film_size'];

        $check_film = "SELECT * FROM fss_Cart where ip_add='$ip_add' AND p_id='$p_id'";

        $run_check = mysqli_query($db, $check_film);

        $query = "INSERT INTO fss_Cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$film_qty')";

        $run_query = mysqli_query($db, $query);

        echo "<script>window.open('details.php?film_id=$p_id','_self')</script>";

    }



}

// Collects the different film ratings from the relevant table.
function getRatings() {

    global $db;

    $get_ratings = "SELECT * FROM fss_Rating";

    $run_ratings = mysqli_query($db,$get_ratings);

    while($row_ratings=mysqli_fetch_array($run_ratings)){

        $ratings_id = $row_ratings['ratid'];
        $ratings = $row_ratings['filmrating'];

        echo "

         <li>
            <a href='film_menu.php?rating=$ratings_id'> $ratings </a>
        </li>
        
        ";

    }

}

// Once a rating has been select it retrieves all the films available in that rating.
function getFilmRatingCategory(){

    global $db;

    if(isset($_GET['rating'])){

        $film_rating_id = $_GET['rating'];
        $get_rating_id ="SELECT * FROM fss_Film WHERE ratid='$film_rating_id' ORDER BY filmtitle";
        $run_film_rating = mysqli_query($db,$get_rating_id);
        $row_film_rating = mysqli_fetch_array($run_film_rating);

        $film_rating_title = $row_film_rating['filmtitle'];
        $film_rating_desc = $row_film_rating['filmdescription'];

        $count = mysqli_num_rows($run_film_rating);

        if($count==0){

            echo "
            
                <div class='box'>
                
                    <h1> No Product Found With This Film Rating </h1>
                
                </div>
            
            ";

        }else{

            while($row_products=mysqli_fetch_array($run_film_rating)){

                $film_id = $row_products['filmid'];

                $film_title = $row_products['filmtitle'];

                echo "
            
                <div class='col-md-4 col-sm-6 center-responsive'>
        
            <div class='product'>
            
                <a href='details.php?film_id=$film_id'>
                
                </a>
                
                <div class='text'>
                
                    <h3>
            
                        <a href='details.php?film_id=$film_id'>

                            $film_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        £6.99
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?film_id=$film_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?film_id=$film_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>
            
            </div>
        
        </div>
            
            ";
            }

        }

    }
}

// Counts the number of items in the cart.
function items(){

    global $db;

    $ip_add = getRealIpUser();

    $get_items = "SELECT * FROM fss_Cart where ip_add='$ip_add'";
    $run_items = mysqli_query($db,$get_items);

    $count_items = mysqli_num_rows($run_items);

    echo $count_items;
    }

?>
