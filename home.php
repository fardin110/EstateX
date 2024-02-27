<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="favicon.png" type="image/x-icon">
  <title>EstateX</title>

  <link rel="stylesheet" href="style.css">
  <style>
    .container{
  background-image: url("image/sample5.png");
}
    </style>
</head>

<body>
  <div class="container">
    <nav>
      <div class="logo">
        <a href="#"><h1>Estate<span>X</h1></span></a>
      </div>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="buypage.php">Buy Property</a></li>
        <li><a href="sellpage.php">Sell Property</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="buttons">
        <a href="logout.php" class="btn"><b>Log Out</b></a>
       
      </div>
    </nav>
    <div class="content">
      <h2>One place  <br>to find your new destination</h2>
      <p>Discover your perfect property, sell with confidence, <br>and explore endless possibilities in the world of real estate. Your journey starts here!</p>
    </div>
    <div class="link">
      <a href="about.php" class="hire">Our Mission</a>
    </div>
  </div>

  <footer class="footer">
    <p>&copy; 2022 EstateX.</p>
  </footer>
</body>
</html>
