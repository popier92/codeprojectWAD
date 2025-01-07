<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: index.php");
    exit();
}

include 'asset/connect.php';

try {
    // Fetch visible products and their categories
    $stmt = $pdo->prepare("
        SELECT p.product_id, p.name, p.price, p.image, c.name AS category_name
        FROM products p
        JOIN product_categories pc ON p.product_id = pc.product_id
        JOIN categories c ON pc.category_id = c.category_id
        WHERE p.is_visible = 1
        ORDER BY c.name, p.name
    ");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database query failed: " . $e->getMessage());
}

// Fetch distinct categories
$categories = [];
foreach ($products as $product) {
    if (!in_array($product['category_name'], $categories)) {
        $categories[] = $product['category_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cusdashboard.css">
    <title>Customer Main Page</title>
    <style>
        .categories {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .category-item {
            background-color: #f9f9f9;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .category-item:hover {
            background-color: #f4b0b0;
            color: white;
        }

        .dish-grid .dish-item {
            display: none;
        }

        #popular-dishes-title {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #no-results {
            display: none;
            text-align: center;
            font-weight: bold;
            color: #f00;
            margin-top: 20px;
        }

        .search-container {
    display: flex;
    align-items: center;

}

#search-bar {
    flex: 1;
    padding: 10px 120px;
    border: 1px solid #ccc;
    border-radius: 10px;
    outline: none;
}

#search-button {
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-icon {
    width: 24px;
    height: 24px;
}


    </style>
</head>
<body>
    <div class="container">
        <!-- Top Section -->
        <div class="top-section">         
            <img class="logo" src="icon/logo.jpeg" alt="Logo"> 
            <nav>
                <ul>
                    <li><a href="cusdashboard.php">Home</a></li>
                    <li><a href="Ourteam.php">Our Team</a></li>
                    <li><a href="cart/cart.php">Cart</a></li>
                    <li><a href="transaction.php">Transaction Details</a></li>
                    <li><a href="QnA.php">Help</a></li>
                </ul>
            </nav>

            <a href="cusprofileedit.php">
                <img class="profile" src="icon/profilerb.png" alt="Profile">
            </a>
        </div>

        <div class="section-spacing"></div>

        <!-- Bottom Section -->
        <div class="bottom-section">
            <div class="search-bar">
                <h2 class="welcome">Welcome to our store</h2>
                <div class="search-container">
               <input type="text" id="search-bar" placeholder="Search for dishes...">
                   <button id="search-button" onclick="searchDishes()">
                   <img src="icon/search.png" alt="Search Icon" class="search-icon">
                </button>
                 </div>

            </div>

            <!-- Categories Section -->
            <h2 class="categories-title">Categories</h2>
            <div class="categories">
                <?php foreach ($categories as $category): ?>
                    <div class="category-item" data-category="<?php echo htmlspecialchars($category); ?>">
                        <?php echo htmlspecialchars($category); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Popular Dishes Section -->
            <h2 id="popular-dishes-title">Popular Dishes</h2>
            <div id="no-results">No Results Found</div>
            <div class="dish-grid">
            <?php foreach ($products as $product): ?>
    <div class="dish-item" data-category="<?php echo htmlspecialchars($product['category_name']); ?>">
        <div class="image-placeholder">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <p><?php echo htmlspecialchars($product['name']); ?></p>
        <strong>RM <?php echo number_format($product['price'], 2); ?></strong>
        <button class="add-btn" onclick="addToCart(<?php echo htmlspecialchars($product['product_id']); ?>)">+</button>
    </div>
<?php endforeach; ?>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.category-item').forEach(category => {
            category.addEventListener('click', () => {
                const selectedCategory = category.getAttribute('data-category');
                const dishes = document.querySelectorAll('.dish-item');
                const title = document.getElementById('popular-dishes-title');
                const noResults = document.getElementById('no-results');
                let found = false;

                dishes.forEach(dish => {
                    if (dish.getAttribute('data-category') === selectedCategory) {
                        dish.style.display = 'block';
                        found = true;
                    } else {
                        dish.style.display = 'none';
                    }
                });

                if (found) {
                    title.textContent = selectedCategory;
                    noResults.style.display = 'none';
                } else {
                    noResults.style.display = 'block';
                }
            });
        });

        document.querySelector('.category-item').click();

        function searchDishes() {
            const query = document.getElementById("search-bar").value.toLowerCase();
            const dishes = document.querySelectorAll(".dish-item");
            const title = document.getElementById("popular-dishes-title");
            const noResults = document.getElementById("no-results");
            let found = false;

            dishes.forEach(dish => {
                const dishName = dish.querySelector("p").textContent.toLowerCase();
                if (dishName.includes(query)) {
                    dish.style.display = "block";
                    found = true;
                } else {
                    dish.style.display = "none";
                }
            });

            if (query.trim() === "") {
                title.textContent = "Popular Dishes";
                noResults.style.display = 'none';
                document.querySelector('.category-item').click();
            } else if (found) {
                title.textContent = "Search Results";
                noResults.style.display = 'none';
            } else {
                title.textContent = "Search Results";
                noResults.style.display = 'block';
            }
        }

        function addToCart(productId) {
            const userId = <?php echo $_SESSION['user_id']; ?>;

            fetch('asset/add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId, product_id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Product added to cart!");
                } else {
                    alert("Failed to add product to cart.");
                }
            })
            .catch(error => console.error("Error adding to cart:", error));
        }
    </script>
     <script src="javascript/render_cart_item.js"></script>
</body>
</html>
