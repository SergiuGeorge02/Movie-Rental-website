<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: /login.php");
    exit();
}

$userEmail = $_SESSION['user_email'];

$servername = "localhost";
$port = "3306";
$username = "root";
$passwordDB = "sergiusql";
$dbname = "moviematrix";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];

    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);

    $hashedPassword = '';
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
        $hashedPassword = $userData['password'];
    }

    if (password_verify($oldPassword, $hashedPassword)) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $updateSql = "UPDATE users SET password = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ss", $newHashedPassword, $userEmail);

        if ($updateStmt->execute()) {
            $messages[] = "Password changed successfully!";
        } else {
            $messages[] = "Error updating password: " . $updateStmt->error;
        }

        $updateStmt->close();
    } else {
        $messages[] = "Invalid old password.";
    }

    $stmt->close();
}

$sql = "SELECT FirstName, LastName FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);

$userDetails = [];
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $userDetails = $result->fetch_assoc();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - MovieMatrix</title>
    <link rel="stylesheet" href="/styles/style.css">
    <style>
        .centered-content {
            text-align: center;
            margin: 0 auto;
        }
        .change-password {
            background-color: red; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            cursor: pointer;
        }

        .change-password:hover {
            background-color: darkred; 
        }
        .password-form{
            text-align: center;
            margin: 20px auto;
        }
        .password-form input[type="password"] {
             border: 1px solid #ff0000; 
             padding: 8px;
             margin: 5px;
        }
        .password-form p {
            color: #ff0000; 
        }
        h2{
            text-align:center;
        }
       
       .accountdisplay {
            text-align: center;
        }

        .user-details-table {
             width: 70%;
             margin: 20px auto;
             border-collapse: collapse;
        }

        .user-details-table td, .user-details-table th {
            border: 1px solid #ff0000;
            text-align: left;
            padding: 8px;
        }

        .user-details-table th {
            background-color: #f2f2f2;
        }

        .account {
            margin-top: 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
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
            <li><a class="nav-bar-opened" href="/account.php">Account</a></li>
            <li><a href="/cart.php">Cart</a></li>
            <li><a href="/logout.php">Log Out</a></li>
          </ul>
        </div>
    </div>
</div>
<div class="accountdisplay centered-content">
    <div class="account">
        <h1 class="title">Account Information</h1>

        <?php
        if (!empty($userDetails)) {
            echo '<table class="user-details-table">';
            echo '<tr><td><strong>First Name:</strong></td><td>' . ($userDetails['FirstName'] ?? '') . '</td></tr>';
            echo '<tr><td><strong>Last Name:</strong></td><td>' . ($userDetails['LastName'] ?? '') . '</td></tr>';
            echo '<tr><td><strong>Email:</strong></td><td>' . $userEmail . '</td></tr>';
            echo '</table>';
        } else {
            echo '<p>Error fetching user details.</p>';
        }
        ?>
        <br>
    </div>
</div>

<h2>Change you password</h2>
<br>
<div class="password-form" id="passwordForm">
        <form action="" method="post">
            <label for="oldPassword">Old Password:</label>
            <input type="password" id="oldPassword" name="oldPassword" required>
            <br>
            <br>
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <br>
            <br>
            <input class="change-password" type="submit" value="Submit">
        </form>
        <br>
        <?php
        
        foreach ($messages as $message) {
            echo '<p>' . $message . '</p>';
        }
        ?>
        <br>
    </div>
  </div>
</div>



<div class="footer-section">
    <h1 class="footer-logo">MovieMatrix</h1>
    <p class="credits">© Copyright MovieMatrix Entertainment 2023</p>
</div>
<script>
    function togglePasswordForm() {
        var passwordForm = document.getElementById("passwordForm");
        passwordForm.style.display = passwordForm.style.display === "none" ? "block" : "none";
    }
</script>
</body>
</html>