<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Wallpapers' LIMIT 4");

$stmt->execute();

$Wallpapers = $stmt->get_result();