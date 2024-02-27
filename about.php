<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $logoutButton = '<a href="logout.php" class="logout"><b>Log Out</b></a>';
    $logo = '<a href="home.php"><h1>Estate<span>X</span></h1></a>';
} else {
    $logoutButton = '';
    $logo = '<a href="index.php"><h1>Estate<span>X</span></h1></a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EstateX</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <style>


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: serif;
    background-color: #f9f9f9;
}

header {
    background-color: #092635;
    color: #fff;
    display: flex; 
    justify-content: space-between;
    align-items: center; 
    padding: 20px; 
}

.logo a {
    text-decoration: none;
    color: #fff;
    font-size: 24px;
}

.logo span {
    color: #f9004d;
}

nav ul {
    list-style: none;
    display: flex;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 18px;
}

nav ul li a:hover {
    color: #f9004d;
}

.logout {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
}

.logout:hover {
    color: #e10069;
}

.about-section {
    background-color: #092635;
    color: #fff;
    padding: 80px 0;
    text-align: center;
}

.about-section h2 {
    font-size: 36px;
    margin-bottom: 20px;
}

.about-section p {
    font-size: 18px;
    margin-bottom: 30px;
}

.team-section {
    background-color: #f9f9e0;
    padding: 50px 0;
    text-align: center;
}

.team-section h2 {
    font-size: 36px;
    margin-bottom: 20px;
    color: #333;
}

.team-member {
    margin-bottom: 30px;
}

.team-member img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.team-member h3 {
    font-size: 24px;
    margin-top: 20px;
    color: #333;
}

.team-member p {
    font-size: 16px;
    color: #666;
}

.footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}
    </style>
</head>
<body>
    <header>
        <div class="logo">
        <?php echo $logo; ?>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="buypage.php">Properties</a></li>
                <li><a href="sellpage.php">Sell Property</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <a href="logout.php" class="logout"><b><?php echo $logoutButton; ?></b></a>
    </header>

    <div class="about-section">
        <div class="container">
            <h2>About EstateX</h2>
            <p>Welcome to EstateX, your trusted partner in real estate. We specialize in connecting buyers and sellers to achieve their property goals.</p>
            <p>Our mission is to provide exceptional service and ensure a seamless experience for our clients.</p>
        </div>
    </div>

    <div class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-member">
                <img src="Founder.png" alt="Team Member 1">
                <h3>Fardin Rahman</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="human figure.png" alt="Team Member 2">
                <h3>Dean Smith</h3>
                <p>Marketing Director</p>
            </div>
            <div class="team-member">
                <img src="human figure.png" alt="Team Member 3">
                <h3>John Doe</h3>
                <p>Lead Developer</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>&copy; 2022 EstateX. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
