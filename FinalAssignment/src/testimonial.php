<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["is_landlord"] !== "false") {
    echo "Only users can submit testimonials.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = htmlspecialchars($_POST["service_name"]);
    $date = htmlspecialchars($_POST["date"]);
    $comment = htmlspecialchars($_POST["comment"]);

    $con = mysqli_connect("localhost", "root", "", "DZT_DB");
    if (!$con) {
        echo "Connection failed: " . mysqli_connect_error();
        exit();
    }

    $username = $_SESSION["username"];
    $result = mysqli_query(
        $con,
        "SELECT ID FROM Users WHERE UserName = '$username'"
    );
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row["ID"];

        $stmt = $con->prepare(
            "INSERT INTO Testimonials (UserID, ServiceName, Date, Comment) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isss", $user_id, $service_name, $date, $comment);
        if ($stmt->execute()) {
            echo "Testimonial submitted successfully!";
        } else {
            echo "Error submitting testimonial: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "User not found.";
    }

    mysqli_close($con);
}
?>
