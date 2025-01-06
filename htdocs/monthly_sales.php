<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>sr = "javascript/monthly_sales.js"</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/monthly_sales.css">
    <title> Monthly Sales</title>
</head>

<body>

    <?php

    include 'asset/connect.php';
    $stmt = $pdo->prepare("SELECT id, Password, role FROM user_login WHERE Email = :email");
    ?>

    <!-- Header Section -->
    <div class="top-section">
        <div class="header">
            <img class="logo" src="icon/logo.jpeg" alt="Logo">
            <nav>
                <ul>
                    <li><a href="addashboard.php">Home</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Transaction Details</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
            <img class="profile" src="icon/profilerb.png" alt="Profile">
        </div>
    </div>

    <!-- Sidebar Section -->
    <div class="bottom-section">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="productedit.php">Manage Products</a></li>
                <li><a href="#" class="active">Monthly Sales</a></li>
                <li><a href="#">Transaction Reports</a></li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="main-content">
            <h1>Monthly Sales Report</h1>
            <div style="display : flex">
                <div class="chart">
                    <!--Graph Placeholder (Insert your chart or visualization here)-->
                    <canvas id="chart" width="900" height="400" style="width: 900x;;max-width:900px"></canvas>

                    <script>
                        var xValues = ["january", "febuary", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"];
                        var yValues = [55, 49, 44, 24, 15, 22, 33, 55, 77, 55, 33, 22];
                        var barColors = ["red", "green", "blue", "orange", "brown"];

                        new Chart("chart", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: "#9bbee1",
                                    data: yValues
                                }]
                            },
                            options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: "World Wine Production 2018"
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>