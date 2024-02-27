<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>EstateX</title>
  <link rel="icon" href="favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
</head>
<?php session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

?>
<body>
  <div class="container">
    <nav>
      <div class="logo">
        <a href="./"><h1>Estate<span>X</h1></span></a>
      </div>
      <ul>
        <li><a href="./">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="buttons">
        <a href="login.php" class="login"><b>Log in</b></a>
        <a href="signup.php" class="btn">Sign Up</a>
      </div>
    </nav>
    <div class="content">
      <h2>One place  <br>to find your new destination</h2>
      <p>Discover your perfect property, sell with confidence, <br>and explore endless possibilities in the world of real estate.<br> Your journey starts here!</p>
    </div>
    <div class="link">
      <a href="signup.php" class="hire">Get Started</a>
    </div>
  </div>

  <footer class="footer">
    <p>&copy; 2022 EstateX.</p>
  </footer>
</body>
</html>
