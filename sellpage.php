<!DOCTYPE html>
<html>
<head>
<script>
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    <title>Sell Property</title>
    <link rel = "stylesheet" type= "text/css" href="sellstyle.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">

</head>
<body>
<?php
if (isset($_POST['create'])){
    $user = $_POST['user'];
    $street = $_POST['street'];
    $block = $_POST['block'];
    $city = $_POST['city'];
    $type = $_POST['type'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $apt = $_POST['apt'];
    $floor = $_POST['floor'];

    $desc = $_POST['desc'];
    $inpFile = $_POST['inpFile'];


    $conn = mysqli_connect("localhost", "root", "", "estatex");

    session_start();
    $inputNID = $_SESSION["nid"];

    if ($type == "apartment"){
        $sql1 = "INSERT INTO real_estate (seller_name, price, Area_Size, City, Block, Street, Seller_NID, Apartment_flag, Floor_No, Apartment_No, description, image) 
            VALUES ('$user', '$price', '$area', '$city', '$block', '$street', '$inputNID', '1', '$floor', '$apt', '$desc', '$inpFile')";
    } elseif ($type == "plot") {
        $sql1 = "INSERT INTO real_estate (seller_name, price, Area_Size, City, Block, Street, Seller_NID, Land_flag, Floor_No, Apartment_No, description, image) 
            VALUES ('$user', '$price', '$area', '$city', '$block', '$street', '$inputNID', '1', '$floor', '$apt', '$desc', '$inpFile')";
    }

    if (mysqli_query($conn, $sql1)) {
        header('location: home.php');
        exit();
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>



    <div class = "sell">
        <h1>Enlist your Property</h1>
        <form action="#" method = "post">
            <p>Full Name</p>
            <input type = "text" name = "user" placeholder = "User name" required>
            <p>Address</p>
            <p>Street &nbsp
            <input type = "text" name = "street" placeholder = "Street" required></p>
            <p>Block &nbsp
            <input type = "text" name = "block" placeholder = "Block" required></p>
            <p>City &nbsp &nbsp
            <input type = "text" name = "city" placeholder = "City" required></p>
            <p> Type of Property &nbsp
            <select id = "type" name = "type" onchange= "changeStatus()">
                <option value = "category"> Select Category </option>
                <option value = "apartment"> Apartment </option>
                <option value = "plot"> Plot </option>
            </select>
            </p>
            <p>Area</p>
            <input type="text" inputmode="numeric" name = "area" placeholder = "Total Sqft" required>
            <p>Price</p>
            <input type="text" inputmode="numeric" name = "price" placeholder = "BDT" required>
            <div id = "apt">
            <p>Apartment #</p>
            <input type="text" id = "apt" name="apt" pattern="[a-zA-Z0-9]+" placeholder="Apartment Number">
            </div>
            <div id = "floor">
            <p>Floor #</p>
            <input type = "number" min = 1 id = "floor" name = "floor" placeholder = "Floor Number">
            </div>
            
            <p>Description of Image</p>
            <input type = "text" name = "desc" required>
            </p>
            <p> Upload Image</p>
            <input type="file" name="inpFile" id="inpFile">
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Image Preview" class="image-preview__image">
                <span class="image-preview__default-text">Image Preview</span>

            </div>
          
            <p>
            
            <input type="submit" name="create" value="Submit">
           
        </form>
    </div>

<script>
function changeStatus(){
    var status = document.getElementById("type");
    if(status.value == "plot"){
        document.getElementById("apt").style.visibility = "hidden";
        document.getElementById("floor").style.visibility = "hidden";
    }
    else{
        document.getElementById("apt").style.visibility = "visible";
        document.getElementById("floor").style.visibility = "visible";
    }
}
</script>
<script>
const inpFile = document.getElementById("inpFile");
const previewContainer = document.getElementById("imagePreview");
const previewImage = previewContainer.querySelector(".image-preview__image");
const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

inpFile.addEventListener("change", function(){
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener("load", function() {
            
            previewImage.setAttribute("src", this.result);
            
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText.style.display = null;
        previewImage.style.display = null;
        previewImage.setAttribute("src", "");
    }
});
</script>
</body>




</html>

