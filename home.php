<?php

include 'config.php';

session_start();

// $user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   // header('location:home.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/pro-intro.css">
   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

</head>

<body>

   <?php include 'header-no-login.php'; ?>
   <div>
      <div id="popup-banner">
         <h2>Welcome to our website!</h2>
         <p>Get 10% off your first purchase today.</p>
         <button>Shop now</button>
      </div>
      <div class="home">
         <video autoplay loop muted>
            <source src="./images/vdo/mov_bbb.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
         </video>
         <div class="content">
            <h1 style="color: white;">Open books , open world</h1>
            <h2>Read These Books & Start a New Life</h2>
            <br>
            <div>
               <a href="shop.php" class="option-btn"> about us</a>
            </div>
         </div>
      </div>
   </div>
   <div class="con-insert">

      <div class="banner">
         <div class="box-banner">
            <h2>ReadingRewards</h2>
            <p>ReadingRewards
               Join now to earn FREE BOOKS</p>
         </div>
         <div class="box-banner">
            <h2>ThriftBooks Deals</h2>
            <p>save up to 20% off any eligible item</p>
         </div>
         <div class="box-banner">
            <h2>Mobile App</h2>
            <p>Shop faster & earn bonus points</p>
         </div>
      </div>
   </div>
   <h1 class="title">latest products</h1>
   <section class="big-con-pro-intro">
      <nav class="header-title">
         <h3 href="">Anime</h3>
         <a href="login.php">view all <span class="amount-products-"></span></a>
      </nav>

      <div class="container-intro">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type=69 ") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="box">
                  <a href="login.php" class="">
                     <img src="./images/anime/<?php echo $fetch_products['image']; ?> " alt="" class="image">
                     <div class="box-title">
                        <h4> <?php echo $fetch_products['name']; ?></h4>
                        <br>
                        <p>author: <?php echo $fetch_products['writer']; ?></p>
                        <label class="">price: $<?php echo $fetch_products['price']; ?>/-</label>
                     </div>
                  </a>
               </div>
         <?php
            }
         };
         ?>
      </div>
      <br>
      <br>
      <hr>
      <hr>

      <nav class="header-title">
         <h3 href="">Novel</h3>
         <a href="login.php">view all <span class="amount-products-"></span></a>
      </nav>

      <div class="container-intro">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type=70 ") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="box">
                  <a href="login.php" class="">
                     <img src="./images/<?php echo $fetch_products['image']; ?> " alt="" class="image">
                     <div class="box-title">
                        <h4> <?php echo $fetch_products['name']; ?></h4>
                        <br>
                        <p>author: <?php echo $fetch_products['writer']; ?></p>
                        <label class="">price: $<?php echo $fetch_products['price']; ?>/-</label>
                     </div>
                  </a>
               </div>
         <?php
            }
         };
         ?>
      </div>



   </section>


   <section class="about">
      <div class="flex">
         <div class="image">
            <img src="images/schools-main-image@2x.webp" alt="">
         </div>
         <div class="content">
            <h3> For the Love of Reading</h3>
            <p> Selection</p>
            <p> We have more than 13 million titles to choose from,
               from the earliest board books to the all-time classics of literature.</p>
            <p> FREE Shipping & More</p>
            <p> When you've found the books you want we'll ship qualifying orders to your door for FREE in 100% recyclable packaging. If there is no demand for a book, we will donate it to charity, or we'll recycle it.</p>
            <a href="login.php" class="btn">read more</a>
         </div>
      </div>
   </section>
   <section class="home-contact">
      <div class="content">
         <h3>have any questions?</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
         <a href="login.php" class="white-btn">contact us</a>
      </div>
   </section>
   <section class="footer">

      <div class="box-container">

         <div class="box">
            <h3>quick links</h3>
            <a href="home.php">home</a>
            <a href="login.php">about</a>
            <a href="login.php">shop</a>
            <a href="login.php">contact</a>
         </div>

         <div class="box">
            <h3>extra links</h3>
            <a href="login.php">login</a>
            <a href="login.php">register</a>
            <a href="login.php">cart</a>
            <a href="login.php">orders</a>
         </div>

         <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
            <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
            <p> <i class="fas fa-envelope"></i> ynina292@gmail.com </p>
            <p> <i class="fas fa-map-marker-alt"></i> Laos,vientian </p>
         </div>

         <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>

         </div>

      </div>

      <p class="credit"> &copy; devalop @ <?php echo date('Y'); ?> by <span>Nalongsit k13_cntt</span> </p>

   </section>
   <!-- custom js file link  -->
   <script src="./js/script.js"></script>
   <script>
      function showPopup() {
         var popup = document.getElementById("popup-banner");
         popup.style.display = "block";
         setTimeout(function() {
            popup.style.display = "none";
         }, 5000);
      }

      window.onload = function() {
         showPopup();
      };
   </script>
</body>

</html>