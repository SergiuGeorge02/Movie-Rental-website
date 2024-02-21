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
    <link rel="stylesheet" href="/styles/style.css" />
    <title>MovieMatrix - Movie Renting Platform</title>
    <link rel="shortcut icon" href="/assets/favicon.jpg" type="image/x-icon" />
    <style>
       video {
            display: block;
            margin: 0 auto;
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
            <li><a class="nav-bar-opened" href="/index.php">Home</a></li>
            <li><a href="/store.php">Store</a></li>
            <li><a href="/about.php">About us</a></li>
            <li><a href="/account.php">Account</a></li>
            <li><a href="/cart.php">Cart</a></li>
            <li><a href="/logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="hero">
      <span class="hero-title">Best movie renting platform</span>
      <span class="hero-description"
        >MovieMatrix is your best choice for finding all greatest movies that are
        available for renting</span
      >
      <div class="popular-releases-section"></div>
      <div class="popular-movies-container">
        <div class="popular-movies">
          <div class="pop-m-1">
            <a class="movie-link" href="https://www.imdb.com/title/tt0111161/?ref_=chtmvm_t_1">
              <img
                class="movie-cover"
                src="/assets/movies/popular_movie1.jpg"
                alt="popular1"
            /></a>
            <a class="movie-link" href="https://www.imdb.com/title/tt0068646/?ref_=chtmvm_t_2">
              <img
                class="movie-cover"
                src="/assets/movies/popular_movie2.jpg"
                alt="popular2"
            /></a>
            <a class="movie-link" href="https://www.imdb.com/title/tt0816692/?ref_=chtmvm_t_4">
              <img
                class="movie-cover"
                src="/assets/movies/popular_movie3.jpg"
                alt="popular3"
            /></a>
          </div>
        </div>
      </div>
    </div>
    <div class="kids-movies-section">
      <h1 class="section-title">Latest Movie Trailer</h1>
      <video width="640" height="440" controls>
        <source src="/assets/trailer.mp4" type="video/mp4">
        Your browser does not support the video.
    </video>
    </div>
    <div class="footer-section">
      <h1 class="footer-logo">MovieMatrix</h1>
      <p class="credits">© Copyright MovieMatrix Entertainment 2023</p>
    </div>
  </body>
</html>
