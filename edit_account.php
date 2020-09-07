<?php

$session_id = $_SESSION['customer_id'];

$get_customer = "SELECT * FROM fss_Person WHERE personid='$session_id'";
$run_customer = mysqli_query($con,$get_customer);
$row_customer = mysqli_fetch_array($run_customer);

$customer_name = $row_customer['personname'];
$customer_phone = $row_customer['personphone'];
$customer_email = $row_customer['personemail'];

$get_address_id = "SELECT * FROM fss_CustomerAddress WHERE custid='$session_id'";
$run_address_id = mysqli_query($con,$get_address_id);
$row_address_id = mysqli_fetch_array($run_address_id);
$address_id = $row_address_id['addid'];

$get_address = "SELECT * FROM fss_Address WHERE addid='$address_id'";
$run_address = mysqli_query($con,$get_address);
$row_address = mysqli_fetch_array($run_address);

$customer_street = $row_address['addstreet'];
$customer_city = $row_address['addcity'];
$customer_postcode = $row_address['addpostcode'];

?>

    <h1 align="center"> Edit Your Account </h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">

            <label> Name: </label>

            <input type="text" name="c_name" class="form-control" value="<?php echo $customer_name; ?>" required>

        </div>

        <div class="form-group">

            <label> Street: </label>

            <input type="text" name="c_street" class="form-control" value="<?php echo $customer_street; ?>" required pattern = "[a-zA-Z ]+$" required
                   oninvalid="setCustomValidity('Not a valid street name')"
                   onchange="try{setCustomValidity('')}catch(e){}" />>>>

        </div>

        <div class="form-group">

            <label> City: </label>

            <input type="text" name="c_city" class="form-control" value="<?php echo $customer_city; ?>" required pattern = "[a-zA-Z ]+$"
                   oninvalid="setCustomValidity('Not a valid city name')"
                   onchange="try{setCustomValidity('')}catch(e){}" />>

        </div>

        <div class="form-group">

            <label> Postcode: </label>

            <input type="text" name="c_postcode" class="form-control" value="<?php echo $customer_postcode; ?>" minlength="6" maxlength="8" required pattern="[a-zA-z0-9]+$" required
                   oninvalid="setCustomValidity('Not a valid postcode (no spaces allowed)')"
                   onchange="try{setCustomValidity('')}catch(e){}" />>>

        </div>

        <div class="form-group">

            <label> Phone: </label>

            <input type="text" name="c_phone" class="form-control" value="<?php echo $customer_phone; ?>" minlength="10" maxlength="11" required pattern="^[0-9]*$"
                   oninvalid="setCustomValidity('Not a valid phone number')"
                   onchange="try{setCustomValidity('')}catch(e){}" />>>>

        </div>

        <div class="form-group">

            <label> Email: </label>

            <input type="text" name="c_email" class="form-control" value="<?php echo $customer_email; ?>"  required pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required
                   oninvalid="setCustomValidity('Not a valid email address')"
                   onchange="try{setCustomValidity('')}catch(e){}" />>>>

        </div>

        <div class="text-center">

            <button name="update" class="btn btn-primary">

                <i class="fa fa-user-md"></i> Update Now

            </button>

        </div>

    </form>

<?php

if(isset($_POST['update'])){

    $person_id = $session_id;
    $c_name = $_POST['c_name'];
    $c_phone = $_POST['c_phone'];
    $c_email = $_POST['c_email'];
    $c_street = $_POST['c_street'];
    $c_city = $_POST['c_city'];
    $c_postcode = $_POST['c_postcode'];

    // Updates person details in the fss_Person table.
    $update_customer = "UPDATE fss_Person SET personname='$c_name',personphone='$c_phone',personemail='$c_email' WHERE personid='$person_id' ";
    $run_customer = mysqli_query($con,$update_customer);

    // Retrieves address id to be used to find the relevant entry in the fss_CustomerAddress table.
    $select_add_id = "SELECT addid FROM fss_CustomerAddress WHERE custid='$person_id'";
    $run_add_id = mysqli_query($con, $select_add_id);
    $add_id_row = mysqli_fetch_array($run_add_id);
    $add_id = $add_id_row['addid'];

    // Updates person address details in the fss_CustomerAddress table.
    $update_customer_address = "UPDATE fss_Address SET addstreet='$c_street',addcity='$c_city',addpostcode='$c_postcode' WHERE addid='$add_id' ";
    $run_customer_address = mysqli_query($con,$update_customer_address);


    echo "<script>alert('Your account has been edited!')</script>";

    echo "<script>window.open('my_account.php?my_orders','_self')</script>";


}

?>