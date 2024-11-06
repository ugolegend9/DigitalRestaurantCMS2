<?php
include 'config.php';

// Fetch all categories with their food items
$categories = $mysqli->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Menu</title>
</head>
<body>
    <h1>Restaurant Menu</h1>

    <?php while ($category = $categories->fetch_assoc()): ?>
        <h2><?php echo htmlspecialchars($category['name']); ?></h2>

        <?php
        $food_items_query = $mysqli->prepare("SELECT * FROM food_items WHERE category_id = ?");
        $food_items_query->bind_param("i", $category['id']);
        $food_items_query->execute();
        $food_items_result = $food_items_query->get_result();
        ?>

        <?php if ($food_items_result->num_rows > 0): ?>
            <?php while ($food_item = $food_items_result->fetch_assoc()): ?>
                <div>
                    <h3><?php echo htmlspecialchars($food_item['name']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($food_item['description'])); ?></p>
                    <p>Price: $<?php echo number_format($food_item['price'], 2); ?></p>
                    <a href="add_to_cart.php?id=<?php echo $food_item['id']; ?>">Add to Cart</a>
                </div>
                <hr>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No items available in this category.</p>
        <?php endif; ?>
        
        <?php $food_items_query->close(); ?>
    <?php endwhile; ?>
    <a href="view_cart.php">View Cart</a>
</body>
</html>
<?php $categories->free(); ?>
