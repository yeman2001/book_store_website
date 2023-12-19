<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
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
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
   <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/big-column.css">


</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>our shop</h3>
      <p> <a href="home.php">home</a> / shop </p>
   </div>
   <section class="products">
      <h1 class="title">RECOMMEND FOR YOU</h1>
      <div class="con-insert-shop">
         <div class="banner">
            <div class="box-banner">
               <img src="./images/insert img/BOTM_oct.jpg" alt="">
            </div>
            <div class="box-banner">
               <img src="./images/insert img/ABR1_2022_440x344.jpg" alt="">
            </div>
            <div class="box-banner">
               <img src="./images/insert img/BOTYSF_Kids_BHP_Tile.jpg" alt="">
            </div>
            <div class="box-banner">
               <img src="./images/insert img/BOTYSF_BHP_Tile.jpg" alt="">
            </div>
         </div>
      </div>

      <?php include 'banner_new_books.php' ?>
      <?php include 'novel.php' ?>
      <?php include 'anime.php' ?>
      <?php include 'kids.php' ?>
      <?php include 'new_book_for_month.php' ?>

      <h1 class="recommend_for_you">All OF 2023</h1>
      <!-- <div class="header-title2">
         <h1>RECOMMEND FOR YOU</h1>
         <a href="all_products.php">
            <p>view all</p>
         </a>
      </div> -->
      <br>
      <div class="container-column">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 12") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="column">
                  <div class="column-l">
                     <a href="detail_book.php?id=<?= $fetch_products['id'] ?>" class="">
                        <img src="./images/<?php echo $fetch_products['image']; ?> " alt="img" class="image">
                     </a>
                  </div>
                  <div class="column-r">
                     <h2> <?php echo $fetch_products['name']; ?></h2>
                     <p>author: <?php echo $fetch_products['writer']; ?></p>
                     <div class="column-r-buttom">
                        <label class="price">price: $<?php echo $fetch_products['price']; ?>/-</label>
                        <!-- <img src="./images/my profile/icons8-shopping-bag.gif" alt=""> -->
                     </div>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>




      <? //php include 'card.php' 
      ?>

   </section>








   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>