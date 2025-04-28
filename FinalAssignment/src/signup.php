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
        $res = $con->execute_query(
            "SELECT * FROM Landlords WHERE UserName = '$username'"
        );
        if ($res->num_rows != 0) {
            echo "Username already exists";
            exit();
        }

        $con->execute_query(
            "INSERT INTO Landlords (UserName, Password) VALUES ('$username', '$password')"
        );
    } else {
        $res = $con->execute_query(
            "SELECT * FROM Users WHERE UserName = '$username'"
        );
        if ($res->num_rows != 0) {
            echo "Username already exists";
            exit();
        }

        $con->execute_query(
            "INSERT INTO Users (UserName, Password) VALUES ('$username', '$password')"
        );
    }
}

?>
