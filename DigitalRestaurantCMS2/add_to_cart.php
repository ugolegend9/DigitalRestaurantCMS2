<?php
include 'config.php';

$food_item_id = $_GET['id'];

// Check if the food item is already in the cart
$sql = "SELECT * FROM cart WHERE food_item_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $food_item_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_item = $result->fetch_assoc();

if ($cart_item) {
    // Update quantity if food item is already in the cart
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE food_item_id = ?";
    $update_stmt = $mysqli->prepare($sql);
    $update_stmt->bind_param("i", $food_item_id);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    // Insert new food item into the cart
    $sql = "INSERT INTO cart (food_item_id, quantity) VALUES (?, 1)";
    $insert_stmt = $mysqli->prepare($sql);
    $insert_stmt->bind_param("i", $food_item_id);
    $insert_stmt->execute();
    $insert_stmt->close();
}

header("Location: view_cart.php");
?>
