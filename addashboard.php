<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: MainLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addashboard.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- Header Section -->
    <div class="top-section">
        <div class="header">
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
            <img class="profile" src="icon/profilerb.png" alt="Profile">
        </div>
    </div>

    <!-- Sidebar Section -->
    <div class="bottom-section">
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="#">Manage Products</a></li>
            <li><a href="#">Monthly Sales</a></li>
            <li><a href="#">Transaction Reports</a></li>
        </ul>
    </div>



<!-- Main Content Section -->
<div class="main-content">

        <h1>Dashboard</h1>
        <!-- Stats Section -->
        <div class="stats-container">
            <div class="stat-card">
                <h2>Pie Chart</h2>
                <div class="chart-placeholder">Pie Chart Placeholder</div>
                <p>Total Order</p>
            </div>
            <div class="stat-card">
                <h2>Pie Chart</h2>
                <div class="chart-placeholder">Pie Chart Placeholder</div>
                <p>Customer Growth</p>
            </div>
            <div class="stat-card">
                <h2>Pie Chart</h2>
                <div class="chart-placeholder">Pie Chart Placeholder</div>
                <p>Total Revenue</p>
            </div>
            <div class="stat-card">
                <h2>Total Orders</h2>
                <p>75</p>
            </div>
        </div> <!-- Closing stats-container -->
        
        <!-- Line Chart Section -->

        <h2 class="titleTR">Total Revenue</h2>
        <div class="Total-Revanue">Line Chart Placeholder</div>

    </div>
</div> <!-- Closing main-content -->

