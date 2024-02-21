<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: /login.php");
    exit();
}

$servername = "localhost";
$port = "3306";
$username = "root";
$password = "sergiusql";
$dbname = "moviematrix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userEmail = $_SESSION['user_email'];

$sqlCartItems = "SELECT movie, COUNT(*) as total_quantity FROM user_cart WHERE email = '$userEmail' GROUP BY movie";
$resultCartItems = $conn->query($sqlCartItems);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    <link rel="stylesheet" href="/styles/style.css" />
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: red;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
        }

      .buynowbtn{
        background-color: red;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 18px;
        display: center;
      }
        p{
            text-align:center;
            font-size:20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-content">
                <div class="logo">
                    <h1>MovieMatrix</h1>
                </div>
                <ul class="nav-area">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/store.php">Store</a></li>
                    <li><a href="/about.php">About us</a></li>
                    <li><a href="/account.php">Account</a></li>
                    <li><a  class="nav-bar-opened" href="/cart.php">Cart</a></li>
                    <li><a href="/logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="breadcrumb">
        <h1 class="breadcrumb-title">User Cart</h1>
    </div>
    <br>

    <div class="cart-section">
        <?php if ($resultCartItems->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Movie</th>
                    <th>Total Quantity</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $resultCartItems->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['movie']; ?></td>
                        <td>
                            <form action="update_quantity.php" method="post">
                                <input type="hidden" name="movie_id" value="<?php echo $row['movie']; ?>">
                                <input class="quantity-input" type="number" name="quantity" value="<?php echo $row['total_quantity']; ?>" min="1">
                            </form>
                        </td>
                        <td><a href="/php/remove_cart.php?movie_id=<?php echo $row['movie']; ?>">Remove</a></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="3">
                        <form action="/php/buy_now.php" method="post">
                            <button type="submit" name="buy_now" class="buynowbtn">Buy Now</button>
                        </form>
                    </td>
                </tr>
            </table>
        <?php else : ?>
            <p>No items in the cart.</p>
        <?php endif; ?>
    </div>

            <br>
    <div class="footer-section">
        <h1 class="footer-logo">MovieMatrix</h1>
        <p class="credits">© Copyright MovieMatrix Entertainment 2023</p>
    </div>
</body>

</html>
