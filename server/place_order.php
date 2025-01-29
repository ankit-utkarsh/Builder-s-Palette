<?php

session_start();

include('connection.php');

// If user is not logged in, redirect to login page
if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Please login to place an order');
    exit;
} else {

    if (isset($_POST['place_order'])) {

        // Get user info and store it in the database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "not paid";
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Check if user_id is set
        $order_date = date("Y-m-d H:i:s");

        if (!$user_id) {
            // Handle the case where user_id is not set
            header('location: ../checkout.php?message=Please login to place an order');
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

        $stmt_status = $stmt->execute();

        if (!$stmt_status) {
            header('location: index.php');
            exit;
        }

        // Issue new order store order info in the database
        $order_id = $stmt->insert_id;

        // Get products from cart (from the session)
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            // Store each single item in order_items database
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

            $stmt1->execute();
        }

        // Remove everything from the cart --> delay until the payment is done
        //unset($_SESSION['cart']);

        // Inform user whether everything is fine or there is a problem
        header('location: ../payment.php?order_status=order placed successfully');
    }
}

?>