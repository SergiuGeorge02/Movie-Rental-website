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

$sql = "SELECT id, moviename, stock FROM movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $stockArray = array();
    while ($row = $result->fetch_assoc()) {
        $stockArray[$row['id']] = $row['stock'];
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store - MovieMatrix</title>
    <link rel="stylesheet" href="/styles/style.css" />
    <style>
        p{
            text-align:center;
        }
        .stock-msg{
            color:green;
        }
        .out-of-stock-msg{
            color:red;
        }
    </style>
    <script>
    function buyNow(movieId) {
        window.location.href = '/php/purchase.php?movie_id=' + movieId;
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
            <li><a href="/index.php">Home</a></li>
            <li><a class="nav-bar-opened" href="/store.php">Store</a></li>
            <li><a href="/about.php">About us</a></li>
            <li><a href="/account.php">Account</a></li>
            <li><a href="/cart.php">Cart</a></li>
            <li><a href="/php/logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="breadcrumb">
      <h1 class="breadcrumb-title">Store</h1>
    </div>

    <div class="kids-movies-section">
      <h1 class="section-title">Latest Kids Movies</h1>
      <div class="movie-section">
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt0055254/" class="movie-link"
          ><img
                  src="/assets/movies/copil1.jpg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">101 Dalmatians</p>
            <span class="itm-price">$7.99</span>
          </div>
          <?php if ($stockArray[1] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(1)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt0034492/" class="movie-link"
          ><img
                  src="/assets/movies/copil2.jpg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Bambi</p>
            <span class="itm-price">$7.99</span>
          </div>
          <?php if ($stockArray[2] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(2)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt0058331/" class="movie-link"
          ><img
                  src="/assets/movies/copil3.jpg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Mary Poppins</p>
            <span class="itm-price">$6.99</span>
          </div>
          <?php if ($stockArray[3] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(3)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt4566758/" class="movie-link"
          ><img
                  src="/assets/movies/copil4.jpg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Mulan</p>
            <span class="itm-price">$8.99</span>
          </div>
          <?php if ($stockArray[4] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(4)">Add to cart</button>
          </div>
        </div>
      </div>
      <div class="movie-section">
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt3328418/" class="movie-link"
          ><img
                  src="/assets/movies/copil5.jpeg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">SCOOBY- DOO</p>
            <span class="itm-price">$4.99</span>
          </div>
          <?php if ($stockArray[5] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(5)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt1599351/" class="movie-link"
          ><img
                  src="/assets/movies/copil6.jpeg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">SCOOBY- DOO 2</p>
            <span class="itm-price">$5.99</span>
          </div>
          <?php if ($stockArray[6] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(6)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt1192169/mediaviewer/rm4007290880/?ref_=tt_ov_i" class="movie-link"
          ><img
                  src="/assets/movies/copil7.jpg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Ben 10 Movie</p>
            <span class="itm-price">$9.99</span>
          </div>
          <?php if ($stockArray[7] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(7)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt0114709/" class="movie-link"
          ><img
                  src="/assets/movies/copil8.jpg"
                  alt="movie"
                  class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Toy Story</p>
            <span class="itm-price">$7.99</span>
          </div>
          <?php if ($stockArray[8] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(8)">Add to cart</button>
          </div>
        </div>
      </div>
    </div>
    <div class="kids-movies-section">
      <div class="movie-section">
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt1136617/?ref_=sr_t_6" class="movie-link"
          ><img src="/assets/movies/action1.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">The Killer</p>
            <span class="itm-price">$10.99</span>
          </div>
          <?php if ($stockArray[9] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(9)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt15354916/" class="movie-link"
          ><img src="/assets/movies/action2.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Jawan</p>
            <span class="itm-price">$9.99</span>
          </div>
          <?php if ($stockArray[10] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(10)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt12263384/?ref_=nv_sr_srsg_0_tt_8_nm_0_q_Extracti" class="movie-link"
          ><img src="/assets/movies/action3.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Extraction II</p>
            <span class="itm-price">$11.99</span>
          </div>
          <?php if ($stockArray[11] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(11)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt6708668/?ref_=nv_sr_srsg_0_tt_6_nm_2_q_black%2520crab" class="movie-link"
          ><img src="/assets/movies/action4.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Black Crab</p>
            <span class="itm-price">$10.99</span>
          </div>
          <?php if ($stockArray[12] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(12)">Add to cart</button>
          </div>
        </div>
      </div>
      <div class="movie-section">
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt18556326/?ref_=nv_sr_srsg_0_tt_8_nm_0_q_aware" class="movie-link"
          ><img src="/assets/movies/action5.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Awareness</p>
            <span class="itm-price">$8.99</span>
          </div>
          <?php if ($stockArray[13] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(13)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt6968614/?ref_=fn_al_tt_1" class="movie-link"
          ><img src="/assets/movies/action6.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">The Mother</p>
            <span class="itm-price">$5.99</span>
          </div>
          <?php if ($stockArray[14] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(14)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt0418279/mediaviewer/rm1758532608/?ref_=tt_ov_i" class="movie-link"
          ><img src="/assets/movies/action7.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Transformers</p>
            <span class="itm-price">$6.99</span>
          </div>
          <?php if ($stockArray[15] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(15)">Add to cart</button>
          </div>
        </div>
        <div class="product-container">
          <a href="https://www.imdb.com/title/tt7991608/?ref_=nv_sr_srsg_0_tt_8_nm_0_q_Red%2520Notice" class="movie-link"
          ><img src="/assets/movies/action8.jpg" alt="movie" class="movie-cover"
          /></a>
          <div class="item-details">
            <p class="item-name">Red Notice</p>
            <span class="itm-price">$12.99</span>
          </div>
          <?php if ($stockArray[16] > 0) : ?>
                    <p class="stock-msg">In Stock</p>
                <?php else : ?>
                    <p class="out-of-stock-msg">Out of Stock</p>
                <?php endif; ?>
          <div class="product-buy-now">
          <button class="buy-now-btn" onclick="buyNow(16)">Add to cart</button>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="footer-section">
      <h1 class="footer-logo">MovieMatrix</h1>
      <p class="credits">© Copyright MovieMatrix Entertainment 2023</p>
    </div>
  </body>
</html>

</body>
