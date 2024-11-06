<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle the image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $imageName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . time() . "_" . $imageName;  // Add timestamp to avoid duplicate names
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $imagePath = $targetFilePath;  // Save the path for database entry
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    }

    // Insert food item into the database
    $sql = "INSERT INTO food_items (category_id, name, description, price, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issds", $category_id, $name, $description, $price, $imagePath);
    $stmt->execute();

    echo "Food item created successfully!";
    $stmt->close();
}
