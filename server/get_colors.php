<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='colors' LIMIT 4");

$stmt->execute();

$colors_products = $stmt->get_result();

?>