<?php
session_start();
 //Check if the user is logged in and is a landlord
if (!isset($_SESSION["username"]) || !isset($_SESSION["is_landlord"]) || $_SESSION["is_landlord"] != 1) {
    echo "<script>
                 alert('Only landlords can create listings.');
                 window.location.href = 'LandlordLogined.php';
                 </script>";
        } else {
   exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $beds = htmlspecialchars($_POST["beds"]);
    $rental_months = htmlspecialchars($_POST["rental_months"]);
    $rental_price = htmlspecialchars($_POST["rental_price"]);

    $con = mysqli_connect("localhost", "root", "", "DZT_DB");
    if (!$con) {
        echo "Connection failed: " . mysqli_connect_error();
        exit();
    }

    $username = $_SESSION["username"];
    $result = mysqli_query(
        $con,
        "SELECT ID FROM Landlords WHERE UserName = '$username'"
    );
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $landlord_id = $row["ID"];

        $stmt = $con->prepare(
            "INSERT INTO Properties (LandlordID, Beds, RentalMonths, RentalPrice) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "iiss",
            $landlord_id,
            $beds,
            $rental_months,
            $rental_price
        );
        if ($stmt->execute()) {
            echo "<script>
                 alert('Property listing created successfully!');
                 window.location.href = 'LandlordLogined.php';
                 </script>";
        } else {
            echo "Error creating listing: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>
        alert('Landlord not found.');
        window.location.href = 'LandlordLogined.php';
        </script>";
    }

    mysqli_close($con);
}
?>
