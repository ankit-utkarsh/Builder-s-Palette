<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Texture' LIMIT 4");

$stmt->execute();

$texture = $stmt->get_result();