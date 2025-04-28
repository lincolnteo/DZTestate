<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $is_landlord = htmlspecialchars($_POST["is_landlord"]);

    $con = mysqli_connect("localhost", "root", "", "DZT_DB");
    if (!$con) {
        echo "Connection failed ", mysqli_connect_error();
    }

    if ($is_landlord == "true") {
        $result = mysqli_query(
            $con,
            "SELECT * FROM Landlors WHERE username = '$username' AND password = '$password'"
        );
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["is_landlord"] = "true";
            header("Location: landlord_dashboard.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        $result = mysqli_query(
            $con,
            "SELECT * FROM Users WHERE username = '$username' AND password = '$password'"
        );
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["is_landlord"] = "false";
            header("Location: tenant_dashboard.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    }
}

?>
