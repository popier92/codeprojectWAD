<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productedit.css">
    <title>Add Products</title>
</head>

<body>
    <script>
        function editOn() {
            document.getElementById("overlay").style.display = "block";
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
    <?php

    include 'asset/connect.php';
    
    ?>

    <div id="overlay">
        <div class="edit-overlaybox">


            <form class="edit_form" action>

                <label for="name">product name:</label><br>
                <input type="text" id="name" name="name"><br>

                <p>Click on the "Choose File" button to upload a image</p>
                <input type="file" id="myFile" name="filename">
                <div>
                    <label for="cost">product cost(RM):</label><br>
                    <input type="number" step="0.01" id="name" name="name"><br>
                </div>

                <input class="submit_btn" type="submit">
                <div class="cancel_button" onclick="off()">Cancel</div>
            </form>
        </div>
    </div>

    <!-- Navigation Section -->
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
        <a href="profile.html">
            <img class="profile" src="icon/profilerb.png" alt="Profile">
        </a>
    </div>

    <!-- Main Content Section -->
    <div class="main-content">
        <h1>Add Products</h1>

        <div class="product-card">
            <div class="image-placeholder"></div>
            <h2>Laksa Biasa</h2>
            <p>RM 5.59</p>
        </div>

        <a href="#" class="confirm-btn">CONFIRM</a>

        <!-- Back Icon -->
        <button class="back-icon" style="background: url(icon/pencil.png)" onclick="window.location='addashboard.php'">
            <img src="icon/back.png" alt="Back">
        </button>

        <!-- Edit Icon 
        <div >
            
        </div>-->
        <button class="edit-icon" style="background: url(icon/pencil.png)" onclick="editOn()">
            <img src="icon/pencil.png" alt="Edit">
        </button>
    </div>
</body>

</html>