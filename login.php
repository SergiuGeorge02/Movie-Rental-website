<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $servername = "localhost";
    $port = "3306";
    $username = "root";
    $passwordDB = "sergiusql";
    $dbname = "moviematrix";

    $conn = new mysqli($servername, $username, $passwordDB, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $isValidCredentials = false;

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            $isValidCredentials = true;
            $_SESSION['user_email'] = $email;
            echo "Debug: " . $_SESSION['user_email'];
        }
    }

    $stmt->close();
    $conn->close();

    if ($isValidCredentials) {
        header("Location: /index.php");
        exit();
    } else {
        $errorMessage = "Incorrect email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - MovieMatrix</title>
    <link rel="stylesheet" href="/styles/style.css" />
    <script>
      function redirectToRegister() {
        window.location.href = 'register.html';
      }
    </script>
</head>
<body>

<div class="wrapper">
    <div class="header">
      <div class="header-content">
        <div class="logo">
          <h1>MovieMatrix</h1>
        </div>
        <ul class="nav-area">
          <li><a href="/register.html">Register</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="login">
    <h1 class="title">login</h1>
    <form action="login.php" method="post" class="login-form">
    <form action="login.php" method="post" class="login-form">
      <span class="form-label-email">Enter your account email here</span>
      <br class="form-fields" />
      <input type="text" class="form-input" name="email" />
      <br />
      <span class="form-label-password">Password</span>
      <br class="form-fields" />
      <input type="password" class="form-input" name="password" />
      <br />
        <button class="login-submit" type="submit">Login</button>
    </form>
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($errorMessage) && !empty($errorMessage)) {
        echo '<p class="error-message">' . $errorMessage . '</p>';
    }
    ?>
<br>
    <a class="registertext" href="register.html" style="text-align:center">Don't have an account yet?</a>
    <br>
    <br>
    <button class="register.button" type="submit" onclick="redirectToRegister()">Register</button>
    <div class="space"></div>
    <div class="footer-section">
      <h1 class="footer-logo">MovieMatrix</h1>
      <p class="credits">© Copyright MovieMatrix Entertainment 2023</p>
    </div>
  </div>
</body>
</html>
