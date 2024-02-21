<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>
    <link rel="stylesheet" href="/styles/style.css" />

    <style>
        p.warning {
            text-align: center;
            color: white;
            font-size: 18px; 
           
        }
    </style>
</head>

<body>
<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: /login.php");
    exit();
}

if (isset($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];
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
    $sqlCheckCart = "SELECT * FROM user_cart WHERE email = '$userEmail' AND movie = (SELECT moviename FROM movies WHERE id = $movieId)";
    $resultCheckCart = $conn->query($sqlCheckCart);

    if ($resultCheckCart->num_rows > 0) {
        echo "<p class='warning'>You have already added this movie to your cart. Redirecting to store...</p>";
        header("Refresh: 3; URL=/store.php"); 
        exit();
    }

    $sqlCheckStock = "SELECT stock FROM movies WHERE id = $movieId";
    $resultCheckStock = $conn->query($sqlCheckStock);

    if ($resultCheckStock->num_rows > 0) {
        $rowStock = $resultCheckStock->fetch_assoc();
        $movieStock = $rowStock['stock'];

        if ($movieStock > 0) {
            $sqlSelectMovie = "SELECT moviename FROM movies WHERE id = $movieId";
            $resultSelectMovie = $conn->query($sqlSelectMovie);

            if ($resultSelectMovie->num_rows > 0) {
                $row = $resultSelectMovie->fetch_assoc();
                $movieName = $row['moviename'];
                $randomId = mt_rand(1000, 9999);
                $sqlInsertPurchase = "INSERT INTO user_cart (id, email, movie) VALUES ('$randomId', '$userEmail', '$movieName')";

                if ($conn->query($sqlInsertPurchase) === TRUE) {
                    header("Location: /store.php");
                    exit();
                } else {
                    echo "<p>Warning: Unable to add to the cart. Redirecting to store...</p>";
                    header("Refresh: 3; URL=/store.php"); 
                    exit();
                }
            } else {
                echo "<p>Warning: Unable to add to the cart. Redirecting to store...</p>";
                header("Refresh: 3; URL=/store.php"); 
            }
        } else {
            echo "<p>Warning: Unable to add to the cart. Redirecting to store...</p>";
            header("Refresh: 3; URL=/store.php"); 
        }
    } else {
        echo "<p>Warning: Unable to add to the cart. Redirecting to store...</p>";
        header("Refresh: 3; URL=/store.php"); 
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
</body>

</html>
