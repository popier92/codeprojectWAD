<?php
session_start();
include 'asset/connect.php';

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$selectedItems = $_POST['selected_items'] ?? [];

// Check if any items were selected
if (empty($selectedItems)) {
    echo "<p>No items selected. <a href='cart/cart.php'>Go back to your cart</a>.</p>";
    exit();
}

// Fetch details of selected items from the cart
try {
    $placeholders = implode(',', array_fill(0, count($selectedItems), '?'));
    $stmt = $pdo->prepare("
        SELECT p.product_id, p.name, p.price, p.image, c.quantity
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ? AND c.product_id IN ($placeholders)
    ");
    $stmt->execute(array_merge([$user_id], $selectedItems));
    $itemsToCheckout = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            background-color: #ffe6e6;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(255, 148, 168, 0.9);
            margin: 20px auto;
            flex-wrap: wrap;
        }

        .checkout-section {
            display: flex;
            justify-content: space-between;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .left-panel, .right-panel {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .left-panel {
            width: 60%;
        }

        .right-panel {
            width: 35%;
            text-align: center;
        }

        .laksa-item {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .laksa-item img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            background-color: #ccc;
        }

        .payment-options button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #ff9999;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .payment-options button:hover {
            background-color: #ff4d4d;
        }

        .direct-cart {
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .direct-cart:hover {
            background-color: #fff;
        }

        .cancel-btn {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    background-color: #ccc;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.cancel-btn:hover {
    background-color: #aaa;
}

    </style>
</head>
<body>
    <header class="top-section">
        <a href="home.html">
            <img class="logo" src="../icon/logo.jpeg" alt="Hardie Laksa Logo">
        </a>
        <nav>
            <ul>
                <li><a href="cusdashboard.php">Home</a></li>
                <li><a href="team.html">Our Team</a></li>
                <li><a href="cart/cart.php">Cart</a></li>
                <li><a href="transactions.html">Transaction Details</a></li>
                <li><a href="help.html">Help</a></li>
            </ul>
        </nav>
        <a href="profile.html">
            <img class="profile" src="../icon/profile.png" alt="User Profile">
        </a>
    </header>

    <div class="checkout-title">Checkout</div>

    <div class="checkout-section">
        <div class="left-panel">
            <h2>Selected Products</h2>
            <div class="laksa-summary">
                <?php
                $total = 0;
                foreach ($itemsToCheckout as $item) {
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                    echo "
                        <div class='laksa-item'>
                            <img src='" . htmlspecialchars($item['image']) . "' alt='" . htmlspecialchars($item['name']) . "'>
                            <div>
                                <p><strong>" . htmlspecialchars($item['name']) . "</strong></p>
                                <p>Quantity: " . $item['quantity'] . "</p>
                                <p>Subtotal: RM " . number_format($itemTotal, 2) . "</p>
                            </div>
                        </div>
                    ";
                }
                ?>
            </div>
            <div class="total-price">
                <h3>Total Price</h3>
                <p>RM <?php echo number_format($total, 2); ?></p>
            </div>
        </div>

        <div class="right-panel">
            <h3>Payment Options</h3>
            <form id="checkout-form" action="receipt.php" method="POST">
                <div class="payment-options">
                    <button type="button" onclick="submitPaymentMethod('Online_Banking')">Online Banking</button>
                    <button type="button" onclick="submitPaymentMethod('Credit/Debit')">Credit/Debit</button>
                    <button type="button" onclick="submitPaymentMethod('Cash')">Cash</button>
                </div>
                <?php foreach ($itemsToCheckout as $item): ?>
                    <input type="hidden" name="selected_items[]" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                    <input type="hidden" name="quantities[<?php echo htmlspecialchars($item['product_id']); ?>]" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                <?php endforeach; ?>
                <input type="hidden" name="payment_method" id="payment-method" value="">
            </form>
            <button class="cancel-btn" onclick="window.location.href='cart/cart.php'">Cancel</button>
        </div>
    </div>

    <script>
        function submitPaymentMethod(method) {
            document.getElementById("payment-method").value = method;
            document.getElementById("checkout-form").submit();
        }
    </script>
</body>
</html>
