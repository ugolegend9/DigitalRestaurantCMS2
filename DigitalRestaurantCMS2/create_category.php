<!-- create_category.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Category</title>
</head>
<body>
    <h1>Create a New Category</h1>
    <form action="save_category.php" method="post">
        <label>Category Name:</label><br>
        <input type="text" name="name" required><br><br>
        <button type="submit">Save Category</button>
    </form>
</body>
</html>
