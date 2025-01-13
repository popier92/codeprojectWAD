<?php
include 'asset/connect.php';

// Fetch product details based on the provided product_id
$product = null;
if (isset($_GET['product_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$_GET['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fetch categories
$categoriesStmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch selected categories for the product
$selectedCategories = [];
if ($product) {
    $categoriesForProductStmt = $pdo->prepare("SELECT category_id FROM product_categories WHERE product_id = ?");
    $categoriesForProductStmt->execute([$product['product_id']]);
    $selectedCategories = $categoriesForProductStmt->fetchAll(PDO::FETCH_COLUMN);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productedit.css">
    <title>Edit Product</title>
</head>

<body>
    <!-- Navigation Section -->
    <div class="header">
        <img class="logo" src="icon/logo.jpeg" alt="Logo">
        <div class="dashboard-welcome">
               <h1>Welcome To Product Edit Page</h1>
           </div>
        <a href="profile.html">
            <img class="profile" src="icon/profilerb.png" alt="Profile">
        </a>
    </div>



    <!-- Main Content Section -->
    <div class="main-content">
        <h1>Edit Product</h1>

        <?php if ($product): ?>
        <!-- Product Card -->
        <div class="product-card">
        <div class="image-placeholder">
    <img src="<?php echo (!empty($product['image']) && file_exists('../uploads/' . $product['image'])) 
        ? '../uploads/' . htmlspecialchars($product['image']) 
        : 'icon/placeholder.png'; ?>" alt="Product Image">
</div>
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p>RM <?php echo number_format($product['price'], 2); ?></p>
        </div>

        <!-- Form Section -->
        <form class="edit_form" action="amp/save_product.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

            <!-- Product Name Field -->
            <div>
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" 
                       value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>

            <!-- Product Price Field -->
            <div>
                <label for="price">Product Price (RM):</label>
                <input type="number" step="0.01" id="price" name="price" placeholder="Enter product price" 
                       value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>

            <!-- Product Image Field -->
            <div>
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <!-- Categories Selection -->
            <div>
                <label for="categories">Categories:</label>
                <select id="categories" name="categories[]" multiple>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['category_id']); ?>" 
                            <?php echo in_array($category['category_id'], $selectedCategories) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small>Hold Ctrl (Cmd on Mac) to select multiple categories.</small>
            </div>

            <!-- Action Buttons -->
            <div class="button-container">
                <button type="submit" class="submit_btn">Save Product</button>
                <a href="amp/amp.php" class="cancel_btn">Cancel</a>
            </div>
        </form>
        <?php else: ?>
        <p>Product not found or invalid product ID.</p>
        <?php endif; ?>
    </div>
</body>

</html>
