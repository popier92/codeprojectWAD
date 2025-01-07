<?php
// Include database connection
include '../asset/connect.php';

// Fetch products
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="amp.css">
    <title>Manage Products</title>
    <script>
        // Toggle visibility function
        function toggleVisibility(productId) {
            fetch('toggle_visibility.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const card = document.getElementById(`product-card-${productId}`);
                    card.style.opacity = data.is_visible ? '1' : '0.5';
                }
            });
        }
    </script>
</head>
<body>
    <!-- Top Section -->
    <div class="top-section">
        <div class="header">
            <img class="logo" src="../icon/logo.jpeg" alt="Logo">
            <div class="dashboard-welcome">
               <h1>Welcome To The Admin Manage Product Page</h1>
           </div>
            <a href="../adprofileedit.php">
                <img class="profile" src="../icon/profilerb.png" alt="Profile">
            </a>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="bottom-section">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
            <li><a href="../addashboard.php">Dashboard</a></li>
            <li><a href="amp.php" class="active">Manage Products</a></li>
            <li><a href="../monthly_sales.php" >Monthly Sales</a></li>
            <li><a href="../transacreport.php">Transaction Reports</a></li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="main-content">
            <div class="product-grid-wrapper">
                <!-- Title and Search Bar -->
                <div class="grid-header">
                    <h1>Manage Products</h1>
                    <input type="text" id="search-bar" placeholder="Search Products" onkeyup="filterProducts()">
                    <button id="search-button" onclick="performSearch()">Just Type</button>
                </div>

                <!-- Product Grid -->
                <div class="product-grid" id="product-grid">
                    <?php foreach ($products as $product): ?>
                    <div class="product-card" 
                         id="product-card-<?php echo $product['product_id']; ?>" 
                         style="opacity: <?php echo $product['is_visible'] ? '1' : '0.5'; ?>;">
                        <img src="../icon/delete.png" alt="Delete" class="delete" 
                             onclick="toggleVisibility(<?php echo $product['product_id']; ?>)">
                        <div class="image-placeholder">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                        <p>RM <?php echo number_format($product['price'], 2); ?></p>
                        <a href="../productedit.php?product_id=<?php echo $product['product_id']; ?>">
                            <img src="../icon/edit.png" alt="Edit" class="edit">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search filter for products
        function filterProducts() {
            const searchInput = document.getElementById('search-bar').value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                const productName = card.querySelector('h2').textContent.toLowerCase();
                if (productName.includes(searchInput)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

    
    function toggleVisibility(productId) {
        fetch('toggle_visibility.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id: productId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.getElementById(`product-card-${productId}`);
                card.style.opacity = data.is_visible ? '1' : '0.5';
                alert(data.is_visible 
                    ? "Now the product item is available" 
                    : "Now the product item is not available");
            } else {
                alert('Error toggling visibility. Please try again.');
            }
        })
        .catch(error => console.error('Error:', error));
    }


    </script>
</body>
</html>
