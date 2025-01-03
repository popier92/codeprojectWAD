<!DOCTYPE html>
<html lang="en">
<head>
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
     < class="main-content">
        <h1>Monthly Sales Report</h1>
        <div class="pie-chart">
            <!--Graph Placeholder (Insert your chart or visualization here)-->
            <div class="pie-chart-orders" style="max-width:180px;flex:0 0 180px;" >
                <svg viewBox="0 0 110 115" >
                    <path class="grey" d="M55,25 A40,40 0 1,1 54,25 A40,40 0 0,1 55,25" fill="none" stroke="rgba(0,0,0,.1)" stroke-width="20" stroke-linecap="butt"></path>
                    <path id="color" stroke="rgb(224, 60, 60)" stroke-dasharray="251" stroke-width="20" stroke-dashoffset="0" fill="none" class="color" d="M55,25 A40,40 0 1,1 54,25 A40,40 0 0,1 55,25" stroke-linecap="butt"></path>
                    <text x="55" y="66" text-anchor="middle" font-size="11" class="fwheadings">Total Orders</text>
                </svg>
            </div>
            <div class="pie-chart-orders" style="max-width:180px;flex:0 0 180px;" >
                <svg viewBox="0 0 110 115" >
                    <path class="grey" d="M55,25 A40,40 0 1,1 54,25 A40,40 0 0,1 55,25" fill="none" stroke="rgba(0,0,0,.1)" stroke-width="20" stroke-linecap="butt"></path>
                    <path id="color" stroke="rgb(224, 60, 60)" stroke-dasharray="250" stroke-width="20" stroke-dashoffset="100" fill="none" class="color" d="M55,25 A40,40 0 1,1 54,25" stroke-linecap="butt"></path>
                    <text x="55" y="66" text-anchor="middle" font-size="11" class="fwheadings">Total Orders</text>
                </svg>
            </div>
        </div>
        <div class="total-orders">

        </div>
     </div>
    </div>
</body>
</html>
