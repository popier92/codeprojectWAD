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
    <!-- Header Section -->
    <div class="top-section">
        <div class="header">
            <img class="logo" src="icon/logo.jpeg" alt="Logo">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
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
                <li><a href="#">Manage Products</a></li>
                <li><a href="#" class="active">Monthly Sales</a></li>
                <li><a href="#">Transaction Reports</a></li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="main-content">
            <h1>Monthly Sales Report</h1>
            <div style="display : flex">
                <div class="pie-chart">
                    <!--Graph Placeholder (Insert your chart or visualization here)-->
                    <canvas id="order-chart" width="100" height="100" style="width: 200x;;max-width:200px"></canvas>
                    <canvas id="growth-chart" width="100" height="100" style="width: 200x;;max-width:200px"></canvas>
                    <canvas id="revenue-chart" width="100" height="100" style="width: 200x;;max-width:200px"></canvas>
                    <script>
                        var yValues = [26, 49, 60];
                        var barColors = [
                            "#b91d47",
                            "#f1bcbc"
                        ];
                        new Chart("order-chart",
                            {
                                type: "doughnut",
                                data:
                                {
                                    datasets: [{
                                        backgroundColor: ["#b91d47", "#f1bcbc"],
                                        data: [yValues[0], 100 - yValues[0]]
                                    }]
                                },
                                options:
                                {
                                    title: {
                                        display: true,
                                    }
                                }
                            });

                        new Chart("growth-chart",
                            {
                                type: "doughnut",
                                data:
                                {
                                    datasets: [{
                                        backgroundColor: ["#1de13a", "#a8d6b8"],
                                        data: [yValues[1], 100 - yValues[1]]
                                    }]
                                },
                                options:
                                {
                                    title: {
                                        display: true,
                                    }
                                }
                            });
                        new Chart("revenue-chart",
                            {
                                type: "doughnut",
                                data:
                                {
                                    datasets: [{
                                        backgroundColor: ["#2a8ae9", "#9bbee1"],
                                        data: [yValues[2], 100 - yValues[2]]
                                    }]
                                },
                                options:
                                {
                                    title: {
                                        display: true,
                                    }
                                }
                            });
                    </script>

                </div>

                <div class="total-orders">
                </div>
            </div>
            <h2>Total Revanue</h2>
            <div class="revenue-diagram">
                <canvas id="myChart" width="800" height="450" style="width:100%;max-width:600px"></canvas>

                <script>
                    const xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

                    new Chart("myChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                                data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                                borderColor: "red",
                                fill: false
                            }, {
                                data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                                borderColor: "green",
                                fill: false
                            }, {
                                data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                                borderColor: "blue",
                                fill: false
                            }]
                        },
                        options: {
                            legend: { display: false }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>