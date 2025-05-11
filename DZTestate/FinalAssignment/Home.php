<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dzt_db";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$searchResults = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rentalPrice = isset($_POST["rentalPrice"]) ? $_POST["rentalPrice"] : "";
    $bedrooms = isset($_POST["bedrooms"]) ? $_POST["bedrooms"] : "";
    $tenancyLength = isset($_POST["tenancyLength"])
        ? $_POST["tenancyLength"]
        : "";

    if (empty($rentalPrice) && empty($bedrooms) && empty($tenancyLength)) {
        echo "No options were selected.";
    } else {
        $sql = "SELECT * FROM properties WHERE 1=1";

        if (!empty($rentalPrice)) {
            $sql .= " AND RentalPrice <= " . intval($rentalPrice);
        }
        if (!empty($bedrooms)) {
            $sql .= " AND Beds = " . intval($bedrooms);
        }
        if (!empty($tenancyLength)) {
            $sql .=
                " AND RentalMonths = '" .
                $con->real_escape_string($tenancyLength) .
                "'";
        }

        $sql .= " ORDER BY ID DESC";
        $searchResults = $con->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DZT Estate Agency</title>
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
                    <option value="short-term">Short-term</option>
                    <option value="long-term">Long-term</option>
                </select>
                <button class="search-button" type="submit">Search</button>
            </div>
        </form>
        <div class="div4">
            <h2>Property Listings</h2>
            <?php if (
                $_SERVER["REQUEST_METHOD"] == "POST" &&
                $searchResults != null
            ) {
                if ($searchResults->num_rows > 0) {
                    echo "<ul>";
                    while ($row = $searchResults->fetch_assoc()) {
                        echo "<li>";
                        echo "<strong>Property ID:</strong> " .
                            htmlspecialchars($row["ID"]) .
                            "<br>";
                        echo "<strong>Rental Price:</strong> €" .
                            htmlspecialchars($row["RentalPrice"]) .
                            "<br>";
                        echo "<strong>Bedrooms:</strong> " .
                            htmlspecialchars($row["Beds"]) .
                            "<br>";
                        echo "<strong>Tenancy Length:</strong> " .
                            htmlspecialchars($row["RentalMonths"]) .
                            "<br>";
                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No properties match your search criteria.</p>";
                }
            } else {
                $sql = "SELECT * FROM properties ORDER BY ID DESC";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<strong>Property ID:</strong> " .
                            htmlspecialchars($row["ID"]) .
                            "<br>";
                        echo "<strong>Rental Price:</strong> €" .
                            htmlspecialchars($row["RentalPrice"]) .
                            "<br>";
                        echo "<strong>Bedrooms:</strong> " .
                            htmlspecialchars($row["Beds"]) .
                            "<br>";
                        echo "<strong>Tenancy Length:</strong> " .
                            htmlspecialchars($row["RentalMonths"]) .
                            "<br>";
                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No properties available at the moment.</p>";
                }
            } ?>
        </div>
        <div class="div5">
            <h2>Testimonials</h2>
            <?php
            $sql = "SELECT * FROM testimonials ORDER BY Date DESC";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<strong>" .
                        htmlspecialchars($row["UserName"]) .
                        "</strong> on " .
                        htmlspecialchars($row["Date"]) .
                        "<br>";
                    echo "<em>Service:</em> " .
                        htmlspecialchars($row["ServiceName"]) .
                        "<br>";
                    echo "<p>" . htmlspecialchars($row["Comment"]) . "</p>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No testimonials available at the moment.</p>";
            }
            ?>
        </div>
        <div class="div6">
            <h2>Terms & Conditions</h2>
            <p>Contact us for more information.</p>
        </div>
    </div>
</body>
</html>
