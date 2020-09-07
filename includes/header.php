<?php

session_start();

include("includes/db.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Film Sales Service</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<div id="top">

    <div class="container">

        <div class="col-md-6 offer">


        </div>

        <div class="col-md-6">

            <ul class="menu">

                <li>

                    <?php

                    if(!isset($_SESSION['customer_id'])){

                        echo"<a href='checkout.php'>My Account</a>";
                    }else{
                        echo"<a href='my_account.php?my_orders'>My Account</a>";
                    }

                    ?>
                </li>

                <li>
                    <a href="checkout.php">

                        <?php

                        if(!isset($_SESSION['customer_id'])){

                        echo "<a href='login.php'> Login </a>";

                        }else{

                        echo " <a href='logout.php'> Log Out </a> ";

                        }

                        ?>
                    </a>
                </li>

                <li>
                    <a href="customer_register.php">

                        <?php

                        if(!isset($_SESSION['customer_id'])){

                            echo " <a href='register.php'> Register </a> ";

                        }

                        ?>

                    </a>
                </li>

            </ul>

        </div>

    </div>

</div>

<div id="navbar" class="navbar navbar-default">

    <div class="container">

        <div class="navbar-header">

            <a href="index.php" class="navbar-brand home">

                <img src="images/logos/logo1.png" alt="Logo" class="hidden-xs">
                <img src="images/logos/logo1.png" alt="Logo Mobile" class="visible-xs">

            </a>

            <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">

                <span class="sr-only">Toggle Navigation</span>

                <i class="fa fa-align-justify"></i>

            </button>

        </div>

        <div class="navbar-collapse collapse" id="navigation">

            <div class="padding-nav">

                <ul class="nav navbar-nav left">

                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="film_menu.php">Films</a>
                    </li>

                </ul>

            </div>

            <a href="cart.php" class="btn navbar-btn btn-primary right">

                <i class="fa fa-shopping-cart"></i>

                <span> Your Cart</span>

            </a>


        </div>

    </div>

</div>
