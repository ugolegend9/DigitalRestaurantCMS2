<!-- create_food_item.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Food Item</title>
</head>
<body>
    <h1>Create a New Food Item</h1>
    <form action="save_food_item.php" method="post" enctype="multipart/form-data">
        <label>Category:</label><br>
        <select name="category_id" required>
            <?php
            include 'config.php';
            $result = $mysqli->query("SELECT * FROM categories");
            while ($category = $result->fetch_assoc()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            $result->free();
            ?>
        </select><br><br>

        <label>Food Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br><br>

        <label>Image:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit">Save Food Item</button>
    </form>
</body>
</html>
