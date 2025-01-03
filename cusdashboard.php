<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: MainLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cusdashboard.css">
    <title>Customer Main Page</title>
</head>
<body>
    <div class="container">
        <!-- Top Section -->
        <div class="top-section">         
                <img class="logo" src="icon/logo.jpeg" alt="Logo"> 
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Transaction Details</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>

            <a href ="profile.html">
                <img class = "profile" src="icon/profilerb.png" alt="Profile">
            </a>

        </div>

        <!-- Space Between Sections -->
        <div class="section-spacing"></div>
        <!-- Bottom Section -->
        <div class="bottom-section">
                <div class="search-bar">
                <h2 class="welcome">Welcome to our store</h2>
                <span class="search-icon">&#128269;</span>
                <input type="text" placeholder=>
            </div>

            <h2 class="categories-title">Categories</h2>
            <div class="categories">
                <div class="category-item">Laksa Biasa</div>
                <div class="category-item">Laksa Ayam</div>
                <div class="category-item">Laksa Meatball</div>
                <div class="category-item">Laksa Telur</div>
            </div>

            <h2 class="popular-dishes-title">Popular Dishes</h2>
            <div class="dish-grid">
                <div class="dish-item">
                    <div class="image-placeholder"></div>
                    <p>Laksa Biasa</p>
                    <strong>RM 5.59</strong>
                    <button class="add-btn">+</button>
                </div>
                <div class="dish-item">
                    <div class="image-placeholder"></div>
                    <p>Laksa Daging</p>
                    <strong>RM 5.59</strong>
                    <button class="add-btn">+</button>
                </div>
                <div class="dish-item">
                    <div class="image-placeholder"></div>
                    <p>Laksa Pattaya</p>
                    <strong>RM 5.59</strong>
                    <button class="add-btn">+</button>
                </div>
                <div class="dish-item">
                    <div class="image-placeholder"></div>
                    <p>Fish Burger</p>
                    <strong>RM 5.59</strong>
                    <button class="add-btn">+</button>
                </div>
                <div class="dish-item">
                    <div class="image-placeholder"></div>
                    <p>Japan Ramen</p>
                    <strong>RM 5.59</strong>
                    <button class="add-btn">+</button>
                </div>
                <div class="dish-item">
                    <div class="image-placeholder"></div>
                    <p>Fried Rice</p>
                    <strong>RM 5.59</strong>
                    <button class="add-btn">+</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
