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
    <title>Real Estate Listings</title>
    <link rel="stylesheet" href="buypagestyle.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <style>

        header {
            background: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0));
            color: #fff;
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 20px; 
        }

        .logo a {
            text-decoration: none;
            color: #000;
            font-size: 24px;
        }

        .logo span {
            color: #D80032;
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
        
        .btn{
            background: #000;
            color: #fff;
            border-radius: 6px;
            padding: 6px 20px;
            text-decoration: none;
            transition: 0.5s;
            font-size: 14px;
        }

        .btn:hover{
            background: transparent;
            border: 1px solid #fff;
            color: #d60000;
        }

        .city-filter-form select {
            font-family: serif;
            background-color: black;
            padding: 8px 22px;
            margin-left: 20px;
            font-size: 16px;
            border-radius: 6px;
            color: white;
        }

        .city-filter-form button {
            padding: 8px 20px;
            background-color: #f9004d;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-family: serif;
            font-size: 16px;
            cursor: pointer;
        }

        .city-filter-form button:hover {
            background-color: #d60000;
        }
        .buy-now-btn {
            font-family: serif;
            background-color: #f9004d;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 20px;
            margin-left: 50px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .buy-now-btn:hover {
            background-color: #d60000;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="home.php"><h1>Estate<span>X</span></h1></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="buypage.php">Buy Properties</a></li>
                <li><a href="sellpage.php">Sell Property</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <a href="logout.php" class="btn"><b>Log out</b></a>
    </header>
    <h1 class="heading">Enlisted Real Estates for Sale</h1>

    <form class="city-filter-form" action="" method="get">
        <select name="city" id="city-filter">
            <option value="" selected disabled>Select City</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Barisal">Barisal</option>
            <option value="Khulna">Khulna</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Rangpur">Rangpur</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <form class="filter-form" action="" method="get">
        <label for="filter-all">
            <input type="checkbox" name="filter-all" id="filter-all" value="all" <?php echo isset($_GET['filter-all']) && $_GET['filter-all'] == 'all' ? 'checked' : ''; ?>>
            All
        </label>
        <label for="filter-apartment">
            <input type="checkbox" name="filter" id="filter-apartment" value="apartment" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'apartment' ? 'checked' : ''; ?>>
            Apartment
        </label>
        <label for="filter-land">
            <input type="checkbox" name="filter" id="filter-land" value="land" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'land' ? 'checked' : ''; ?>>
            Land
        </label>
        <button type="submit">Filter</button>
    </form>


    <div class="container">
        <?php
  
        $conn = mysqli_connect("localhost", "root", "", "estatex");

   
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $logged_in_user_nid = isset($_SESSION["nid"]) ? $_SESSION["nid"] : null;

        $sql = "SELECT * FROM real_estate";
        if (isset($_GET['city']) && !empty($_GET['city'])) {
            $city = $_GET['city'];
            $sql .= " WHERE City = '$city'";
        }

        //  filter
        if (isset($_GET['filter'])) {
            if ($_GET['filter'] == 'apartment') {
                $sql .= " WHERE Apartment_flag = 1";
            } elseif ($_GET['filter'] == 'land') {
                $sql .= " WHERE Land_flag = 1";
            }
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
           
            while ($row = $result->fetch_assoc()) {
                echo '<div class="property-box">';
                echo '<img src="image/' . $row["image"] . '" alt="Property Image">';
                echo '<div class="property-info">';
                echo '<p><span class="location-marker">&#x1F4CD;</span>&nbsp;&nbsp;' . $row["City"] . ', ' . $row["Block"] . ', ' . $row["Street"] . '</p>';
                echo '<p><b>Area: </b>' . $row["Area_Size"] . ' sqft</p>';
                echo '<p><b>Price: </b>' . $row["price"] . ' BDT</p>';
                echo '<h5>  by ' . $row["seller_Name"] . '</h5>';

                // Check if the logged-in user is the seller
                if ($logged_in_user_nid !== $row["Seller_NID"]) {
                    echo '<a href="payment.php?estate_id=' . $row["estate_id"] . '">Buy Now</a>';
                } else {
                    echo '<button class="buy-now-btn" onclick="alert(\'You cannot buy your own property!\')">Buy Now</button>';
                }

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
