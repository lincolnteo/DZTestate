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
?>
