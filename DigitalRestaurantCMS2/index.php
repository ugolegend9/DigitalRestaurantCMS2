<?php
include 'config.php';

// Fetch all categories with their food items
$categories = $mysqli->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Restaurant Menu</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <header class="header-bg">
    <div class="header">
      <h1 class="restaurant-name">Gourmet Delight</h1>
      <p class="tagline">A Taste of Elegance</p>
    </div>
  </header>

  <main class="menu">
    <?php while ($category = $categories->fetch_assoc()): ?>
      <!-- Appetizers Section -->
      <section class="menu-section">

        <h2><?php echo htmlspecialchars($category['name']); ?></h2>
        <?php

        $food_items_query = $mysqli->prepare("SELECT * FROM food_items WHERE category_id = ?");

        $food_items_query->bind_param("i", $category['id']);

        $food_items_query->execute();

        $food_items_result = $food_items_query->get_result();

        ?>
        <?php if ($food_items_result->num_rows > 0): ?>

          <div class="menu-items">
            <?php while ($food_item = $food_items_result->fetch_assoc()): ?>
              <div class="menu-item">
                <img src="<?php echo htmlspecialchars($food_item['image']); ?>" alt="<?php echo htmlspecialchars($food_item['name']); ?>">


                <div class="item-details">

                  <h3><?php echo htmlspecialchars($food_item['name']); ?></h3>
                  <p><?php echo htmlspecialchars($food_item['description']); ?></p>
                  <span class="price">$<?php echo number_format($food_item['price'], 2); ?></span>

                </div>

              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No items available in this category.</p>
          <?php endif; ?>



          <!-- <a href="view_cart.php">View Cart</a> -->
          <!--
        <div class="menu-item">
          <img src="appetizer2.jpg" alt="Stuffed Mushrooms">
          <div class="item-details">
            <h3>Stuffed Mushrooms</h3>
            <p>Crab-stuffed mushrooms with garlic and herbs.</p>
            <span class="price">$10</span>
          </div>
        </div>
      </div> -->
      </section>
      <?php $food_items_query->close(); ?>
    <?php endwhile; ?>

    <!-- Main Courses Section -->
    <!-- <section class="menu-section">
      <h2>Main Courses</h2>
      <div class="menu-items">
        <div class="menu-item">
          <img src="main1.jpg" alt="Grilled Salmon">
          <div class="item-details">
            <h3>Grilled Salmon</h3>
            <p>Served with asparagus and lemon butter sauce.</p>
            <span class="price">$20</span>
          </div>
        </div>
        <div class="menu-item">
          <img src="main2.jpg" alt="Ribeye Steak">
          <div class="item-details">
            <h3>Ribeye Steak</h3>
            <p>Juicy steak with garlic mashed potatoes.</p>
            <span class="price">$28</span>
          </div>
        </div>
      </div>
    </section> -->

    <!-- Desserts Section -->
    <!-- <section class="menu-section">
      <h2>Desserts</h2>
      <div class="menu-items">
        <div class="menu-item">
          <img src="dessert1.jpg" alt="Cheesecake">
          <div class="item-details">
            <h3>Cheesecake</h3>
            <p>Classic cheesecake with a berry topping.</p>
            <span class="price">$7</span>
          </div>
        </div>
        <div class="menu-item">
          <img src="dessert2.jpg" alt="Chocolate Lava Cake">
          <div class="item-details">
            <h3>Chocolate Lava Cake</h3>
            <p>Rich chocolate cake with molten center.</p>
            <span class="price">$9</span>
          </div>
        </div>
      </div>
    </section> -->
  </main>

</body>

</html>
<?php $categories->free(); ?>