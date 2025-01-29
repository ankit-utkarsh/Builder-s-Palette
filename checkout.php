<?php

session_start();

if( !empty ($_SESSION['cart'])){
  //'let user in

}else{
  //send user to index page
  header('Location: index.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builder's Pallete</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="assests/css/style.css"/>
    </head>
<body style="font-weight: 600;">

  <?php include('layouts/header.php'); ?>

    <!--Checkout-->
    
     <section class= "my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Checkout</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method = "POST" action="server/place_order.php">
                <p class="text-center" style="color:red">
                <?php if(isset($_GET['message'])){echo $_GET['message'];}?>
                <?php if(isset($_GET['message'])) { ?>
                  <a href="login.php" class ="btn btn-primary">Login</a>
                  <?php } ?>
              </p>
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Enter your name" required/>
                </div>

                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Enter your email" required/>
                </div>

                <div class="form-group checkout-small-element">
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="checout-phone" name="phone" placeholder="Phone" required/>
                </div>

                <div class="form-group checkout-small-element">
                    <label>City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required/>
                </div>

                <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required/>
                </div>

                <div class="form-group checkout-btn-container">
                  <p>Total amount: Rs. <?php echo $_SESSION['total']; ?></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order"value="Place Order"/>
                </div>

            </form>
        </div>

    </section>

    <?php include('layouts/footer.php'); ?>