<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: /login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - MovieMatrix</title>
    <link rel="stylesheet" href="/styles/style.css" />
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
            <li><a class="nav-bar-opened" href="/about.php">About us</a></li>
            <li><a href="/account.php">Account</a></li>
            <li><a href="/cart.php">Cart</a></li>
            <li><a href="/logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="breadcrumb">
      <h1 class="breadcrumb-title">About us</h1>
    </div>
    <div class="about-us-section">
      <h1 class="title">Who we are</h1>
      <div class="para">
        <p class="paragraph">

          Welcome to MovieMatrix, your ultimate destination for a cinematic experience like never before! Immerse yourself in a world of entertainment with our cutting-edge movie rental system that brings the silver screen to your fingertips.
        </p>

        <p class="paragraph">
          Discover a vast library of the latest blockbusters, timeless classics, and hidden gems across genres. MovieMatrix offers a user-friendly interface, making it easy to browse, search, and select the perfect film for any mood or occasion. Whether you're a fan of action, drama, comedy, or sci-fi, we have a diverse collection that caters to every taste.
        </p>
      </div>
    </div>
    <div class="footer-section">
      <h1 class="footer-logo">MovieMatrix</h1>
      <p class="credits">© Copyright MovieMatrix Entertainment 2023</p>
    </div>
  </body>
</html>
