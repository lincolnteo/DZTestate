<?php
$con = mysqli_connect("localhost", "root", "", "DZT_DB");
if (!$con) {
    echo "Connection failed ", mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rentalPrice = isset($_POST["rentalPrice"]) ? $_POST["rentalPrice"] : "";
    $bedrooms = isset($_POST["bedrooms"]) ? $_POST["bedrooms"] : "";
    $tenancyLength = isset($_POST["tenancyLength"])
        ? $_POST["tenancyLength"]
        : "";

    if (empty($rentalPrice) && empty($bedrooms) && empty($tenancyLength)) {
        echo "No options were selected.";
    } elseif (empty($rentalPrice)) {
        echo "Please select a rental price.";
    } elseif (empty($bedrooms)) {
        echo "Please select the number of bedrooms.";
    } elseif (empty($tenancyLength)) {
        echo "Please select the tenancy length.";
    } else {
        echo "Selected Rental Price: " .
            htmlspecialchars($rentalPrice) .
            "<br>";
        echo "Selected Bedrooms: " . htmlspecialchars($bedrooms) . "<br>";
        echo "Selected Tenancy Length: " .
            htmlspecialchars($tenancyLength) .
            "<br>";
    }
}
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Home.css">
    <script src="Home.js" defer></script>
</head>
<body>
    <div class="parent">
        <div class="header">
            <img src="images/logo.png" alt="Logo" class="logo">
            <button class="burger-button" onclick="toggleDropdown()">☰</button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="Login.html">Login</a>
                <a href="Signup.html">Sign Up</a>
            </div>
        </div>
        <form action="Home.php" method="POST">
        <div class="div3"> 
            <h2>Search for Properties</h2>
            <br>
            <select id="rentalPrice" name="rentalPrice">
                <option value="">Rental Price</option>
                <option value="500">Up to €500</option>
                <option value="1000">Up to €1000</option>
                <option value="1500">Up to €1500</option>
                <option value="2000">Up to €2000</option>
            </select>
            <select id="bedrooms" name="bedrooms">
                <option value="">Bedrooms</option>
                <option value="1">1 Bedroom</option>
                <option value="2">2 Bedrooms</option>
                <option value="3">3 Bedrooms</option>
                <option value="4">4+ Bedrooms</option>
            </select>
            <select id="tenancyLength" name="tenancyLength">
                <option value="">Length of Tenancy</option>
                <option value="short">Short-term</option>
                <option value="long">Long-term</option>
            </select>
            <button class="search-button" type="submit">Search</button>
        </div>
    </form>
        <div class="div4"> 
            <h2>Property Listings</h2>
            <p>Explore our latest properties here.</p>
        </div>
        <div class="div5"> 
            <h2>Testimonials</h2>
            <p>See what our clients say about us.</p>
        </div>
        <div class="div6"> 
            <h2>Terms & Conditions</h2>
            <p>Contact us for more information.</p>
        </div>
        </div>
</body>
</html>
