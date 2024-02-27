<?php
session_start(); 


if (!isset($_SESSION["nid"])) {
    header("Location: login.php"); 
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "estatex");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$estate_id = $_GET['estate_id'];

$sql = "SELECT * FROM real_estate WHERE estate_id = $estate_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Real estate not found";
    exit();
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$buyer_nid = $_SESSION['nid'];


$sql_buyer = "SELECT username, contact FROM users WHERE nid = '$buyer_nid'";
$result_buyer = $conn->query($sql_buyer);

if ($result_buyer->num_rows > 0) {
    $buyer_row = $result_buyer->fetch_assoc();
    $buyer_name = $buyer_row['username'];
    $buyer_contact = $buyer_row['contact'];
} else {
   
    echo "Error: Buyer information not found";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $payment_method = $_POST['payment_method'];

    
    $trxid = generateRandomString(10);

    
    $datetime = date('Y-m-d H:i:s');


    $buyer_nid = $_SESSION['nid'];

    
    $sql = "INSERT INTO payment (trxid, datetime, estate_id, buyer_name, buyer_contact, buyer_nid, amount, payment_method) VALUES ('$trxid', '$datetime', '$estate_id', '$buyer_name', '$buyer_contact', '$buyer_nid', '{$row['price']}', '$payment_method')";
    if ($conn->query($sql) === TRUE) {
        
        $sql_delete = "DELETE FROM real_estate WHERE estate_id = $estate_id";
        $conn->query($sql_delete);

        
        header("Location: buypage.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$trxid = generateRandomString(10);
$datetime = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="paymentstyle.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="estate-details">
            <img src="image/<?php echo $row['image']; ?>" alt="Property Image">
            <p><b>Address:</b> <?php echo $row['City'] . ', ' . $row['Block'] . ', ' . $row['Street']; ?></p>
            <p><b>Area:</b> <?php echo $row['Area_Size']; ?> sqft</p>
            <p><b>Price:</b> <?php echo $row['price']; ?> BDT</p>
        </div>
        
        <form class="payment-method" action="" method="post">
            <div class="payment-buttons">
                <button type="button" class="payment-btn" name="payment_method" value="VISA"><img src="visa.png" alt="VISA"></button>
                <button type="button" class="payment-btn" name="payment_method" value="MasterCard"><img src="mastercard.png" alt="MasterCard"></button>
                <button type="button" class="payment-btn" name="payment_method" value="Nexuspay"><img src="nexuspay.png" alt="Nexuspay"></button>
                <button type="button" class="payment-btn" name="payment_method" value="Bkash"><img src="bkash.png" alt="Bkash"></button>
                <button type="button" class="payment-btn" name="payment_method" value="Bank Fund Transfer"><img src="bank.png" alt="Bank Fund Transfer"></button>
                
                <input type="hidden" name="payment_method" id="selected-payment-method">

            </div>
            <button type="button" id="pay-now-btn">Pay Now</button>
        </form>
    </div>

    <div id="password-popup" class="popup">
        <div class="popup-content">
            <h2>Confirm Payment</h2>
            <form id="password-form">
                <label for="password">Enter your password to confirm payment:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" id="confirm-password-btn">Submit</button>
            </form>
        </div>
    </div>

    <div id="receipt-popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Payment Receipt</h2>
        <p><b>Transaction ID:</b> <?php echo $trxid; ?></p>
        <p><b>Date & Time:</b> <?php echo $datetime; ?></p>
        <p><b>Estate ID:</b> <?php echo $estate_id; ?></p>
        <p><b>Buyer Name:</b> <?php echo $buyer_name; ?></p>
        <p><b>Contact:</b> <?php echo $buyer_contact; ?></p>
        <p><b>NID:</b> <?php echo $buyer_nid; ?></p>
        <p><b>Amount:</b> <?php echo $row['price']; ?> BDT</p>
        <p><b>Payment Method:</b> <span id="payment-method"></span></p>
        <button type="button" id="ok-btn">OK</button>
    </div>
</div>


    <script>
      
        var passwordModal = document.getElementById("password-popup");
        var receiptModal = document.getElementById("receipt-popup");

  
        var payNowBtn = document.getElementById("pay-now-btn");

        
        var passwordCloseBtn = document.getElementById("confirm-password-btn");
        var okBtn = document.getElementById("ok-btn");

        
        payNowBtn.onclick = function() {
            passwordModal.style.display = "block";
        }

       
        passwordCloseBtn.onclick = function(e) {
            e.preventDefault();
            var password = document.getElementById("password").value;
            
            if (password !== null && password !== '') {
                
                receiptModal.style.display = "block";
            }
        }

        
        window.onclick = function(event) {
            if (event.target == passwordModal) {
                passwordModal.style.display = "none";
            } else if (event.target == receiptModal) {
                receiptModal.style.display = "none";
            }
        }

var paymentButtons = document.querySelectorAll('.payment-btn');
paymentButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        paymentButtons.forEach(function(btn) {
            btn.classList.remove('selected');
        });
        this.classList.add('selected');
        document.getElementById('payment-method').innerText = this.value;
        
       
        document.getElementById('selected-payment-method').value = this.value;
    });
});
       
        okBtn.onclick = function() {
          
            document.querySelector('form.payment-method').submit();
        };
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
