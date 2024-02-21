<?php
$servername = "localhost";
$port = "3306"; 
$username = "root";
$password = "sergiusql";
$dbname = "moviematrix";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);


    $checkEmailQuery = "SELECT id FROM users WHERE email = '$email'";
    $emailResult = $conn->query($checkEmailQuery);

    if ($emailResult->num_rows > 0) {
  
        $errorMessage = "Email is already registered. Please use a different email.";
    } else {

        do {
            $id = mt_rand(100000, 999999); 
            $checkIdQuery = "SELECT id FROM users WHERE id = $id";
            $result = $conn->query($checkIdQuery);
        } while ($result->num_rows > 0);

        
        $moviesBought = 0;


        $sql = "INSERT INTO users (id, FirstName, LastName, email, password, moviesbought) VALUES ($id, '$firstName', '$lastName', '$email', '$password', $moviesBought)";

        if ($conn->query($sql) === TRUE) {
      
            header("Location: /login.php");
            exit(); 
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>