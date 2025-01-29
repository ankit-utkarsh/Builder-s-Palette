<?php

session_start();

if(isset($_POST['add_to_cart'])){ //if user clicked on add to cart button

if(isset($_SESSION['cart'])) {      // If user has already added a product to the cart
    $product_ids = array_column($_SESSION['cart'], 'product_id');
    if(!in_array($_POST['product_id'], $product_ids)) {
        // Generate a unique key for the new product
        $key = count($_SESSION['cart']);
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );
        // Add the product to the cart using the unique key
        $_SESSION['cart'][$key] = $product_array;
    } else {
        echo '<script>alert("Product is already added to the cart..!");</script>';
    }
} else {
    // If this is the first product in the cart
    $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image' => $_POST['product_image'],
        'product_quantity' => $_POST['product_quantity']
    );
    $_SESSION['cart'][0] = $product_array;
}

//calculate total
calculateTotalCart();

//remove product from the cart
}else if(isset($_POST['remove_product'])){
    
    $product_id = $_POST['remove_product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total
    calculateTotalCart();

}else if( isset($_POST['edit_quantity']) ){

        //we get ID and quantity of the product from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //we get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update the quantity(Old quantity -> New quantity)
    $product_array['product_quantity'] = $product_quantity;

    //update the product array in the session
    $_SESSION['cart'][$product_id] = $product_array;  

    //calculate total
    calculateTotalCart();

}else{
    // header('location: index.php');
}

function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $_total_quantity = $_total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['total_quantity'] = $_total_quantity;
}
?>

<?php include('layouts/header.php'); ?>

      <!--Cart-->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">My Cart</h2>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assests/imgs/<?php echo $value ['product_image']; ?>" alt="product" />
                        <div>
                            <p><?php echo $value ['product_name']; ?></p>
                            <small><span>Rs.</span><?php echo $value ['product_price']; ?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="remove_product_id" value="<?php echo $key; ?>"/>
                                <input type="submit" name="remove_product" class="remove-btn" value="Remove"/>
                             </form>


                        </div>
                    </div>
                </td>
                
                <td>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" />
                    <!-- <input type="submit" class="edit-btn" value="Edit" name="edit_quantity"/> -->
                </form>
                </td>
                
                <td>
                    <span>Rs</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>
            </tr>

            <?php } ?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                <!--    <td>Subtotal</td>
                    <td>Rs. 1250</td>
                </tr>   -->
                <tr>
                    <td>Total amount</td>
                    <td>Rs. <?php echo $_SESSION['total']; ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form method="POST" action="checkout.php">
            <input type="submit"class="checkout-btn" value="Checkout" name="checkout">

            </form>
        </div>
      </section>

<?php include('layouts/footer.php'); ?>
