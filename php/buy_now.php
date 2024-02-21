<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: /login.php");
    exit();
}

if (isset($_POST['buy_now'])) {
    $userEmail = $_SESSION['user_email'];

    $servername = "localhost";
    $port = "3306";
    $username = "root";
    $password = "sergiusql";
    $dbname = "moviematrix";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlCartItems = "SELECT movie, COUNT(*) as total_quantity FROM user_cart WHERE email = '$userEmail' GROUP BY movie";
    $resultCartItems = $conn->query($sqlCartItems);

    while ($row = $resultCartItems->fetch_assoc()) {
        $movieName = $row['movie'];
        $updateStockSql = "UPDATE movies SET stock = stock - 1 WHERE moviename = '$movieName' AND stock > 0";
        $conn->query($updateStockSql);
    }

    $clearCartSql = "DELETE FROM user_cart WHERE email = '$userEmail'";
    $conn->query($clearCartSql);

    header("Location: /cart.php");
    exit();
} else {
    echo "Invalid request";
}
?>
