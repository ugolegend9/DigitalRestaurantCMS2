<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();

    echo "Category created successfully!";
    $stmt->close();
}

