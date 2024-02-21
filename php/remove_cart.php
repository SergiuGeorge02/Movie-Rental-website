<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: /login.php");
    exit();
}

if (isset($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];

    $servername = "localhost";
    $port = "3306";
    $username = "root";
    $password = "sergiusql";
    $dbname = "moviematrix";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlRemoveFromCart = "DELETE FROM user_cart WHERE email = ? AND movie = ?";
    $stmt = $conn->prepare($sqlRemoveFromCart);
    $stmt->bind_param("ss", $_SESSION['user_email'], $movieId);

    if ($stmt->execute()) {
        header("Location: /cart.php");
        exit();
    } else {
        echo "Error removing item from cart: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: /cart.php");
    exit();
}
?>
