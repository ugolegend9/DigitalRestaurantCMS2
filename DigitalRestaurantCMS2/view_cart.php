<?php
include 'config.php';

$sql = "SELECT cart.id, food_items.name, food_items.price, cart.quantity
        FROM cart
        JOIN food_items ON cart.food_item_id = food_items.id";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <a href="menu.php">Continue Shopping</a><br><br>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Food Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php $total = 0; ?>
            <?php while ($item = $result->fetch_assoc()): ?>
                <?php $item_total = $item['price'] * $item['quantity']; ?>
                <?php $total += $item_total; ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item_total, 2); ?></td>
                    <td><a href="remove_from_cart.php?id=<?php echo $item['id']; ?>">Remove</a></td>
                </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3">Total:</td>
                <td>$<?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
<?php $result->free(); ?>
