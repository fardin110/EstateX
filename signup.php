<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "estatex"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $email = $password = $nid = $contact = $dob = $street = $area = $city = "";
$username_err = $email_err = $password_err = $nid_err = $contact_err = $dob_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty(trim($_POST["nid"])) || !preg_match("/^\d{10}$/", trim($_POST["nid"]))) {
        $nid_err = "Please enter a valid NID (10 digits).";
    } else {
        $nid = trim($_POST["nid"]);
    }

    
    if (empty(trim($_POST["email"])) || !filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL) || !strpos(trim($_POST["email"]), '.com')) {
        $email_err = "Please enter a valid email.";
    } else {
        $email = trim($_POST["email"]);
    }

    
    if (empty(trim($_POST["password"])) || strlen(trim($_POST["password"])) < 6) {
        $password_err = "Please enter a password with at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

 
    if (empty(trim($_POST["contact"])) || !preg_match("/^\d{11}$/", trim($_POST["contact"]))) {
        $contact_err = "Please enter a valid contact number (11 digits).";
    } else {
        $contact = trim($_POST["contact"]);
    }

   
    if (empty(trim($_POST["dob"]))) {
        $dob_err = "Please enter your date of birth.";
    } else {
        $dob = trim($_POST["dob"]);
       
        $birthdate = new DateTime($dob);
        $today = new DateTime();
        $age = $birthdate->diff($today)->y;
        if ($age < 18) {
            $dob_err = "You must be at least 18 years old to sign up.";
        }
    }

 
    $username = trim($_POST["username"]);
    $street = trim($_POST["street"]);
    $area = trim($_POST["area"]);
    $city = trim($_POST["city"]);

    
    if (empty($nid_err) && empty($email_err) && empty($password_err) && empty($contact_err) && empty($dob_err)) {
        
        $sql = "INSERT INTO users (username, email, password, nid, contact, dob, street, area, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
     
        $stmt = $conn->prepare($sql);
        
        
        $stmt->bind_param("sssssssss", $username, $email, $hashed_password, $nid, $contact, $dob, $street, $area, $city);
        
        
        $stmt->execute();

        
        $stmt->close();

        
        $conn->close();

        
        echo "Registration successful!";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signupstyle.css">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
</head>
<body>
    <h1>Sign Up</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <label>NID</label>
            <input type="text" name="nid" value="<?php echo $nid; ?>">
            <span><?php echo $nid_err; ?></span>
        </div>
        <div>
            <label>Contact Number</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>">
            <span><?php echo $contact_err; ?></span>
        </div>
        <div>
            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo $dob; ?>">
            <span><?php echo $dob_err; ?></span>
        </div>
        <div>
            <label>Street</label>
            <input type="text" name="street" value="<?php echo $street; ?>">
        </div>
        <div>
            <label>Area</label>
            <input type="text" name="area" value="<?php echo $area; ?>">
        </div>
        <div>
            <label>City</label>
            <input type="text" name="city" value="<?php echo $city; ?>">
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>
</body>
</html>
