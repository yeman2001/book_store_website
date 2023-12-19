<?php

if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="css/style.css">
</head>


<body>
   <header class="header">
      <div class="header-1">
         <div class="flex">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <!-- <a href="?lang=en">English</a>
            <a href="?lang=th">ไทย</a> -->
            </div>
            <?php if (!isset($_SESSION['user_id'])) { ?>
               <p><a href="login.php"> <i class="fa-solid fa-right-to-bracket" style="color: white;"></i> </a><a href="login.php" style="color :white;">login </a> </p>
               <!-- Add this button to switch the language -->
            <?php } else { ?>
               <p>Hello : <span style="color:white;" id=navbar1_hello></span><?php echo $_SESSION['user_name']; ?></span></p>
            <?php } ?>
         </div>
      </div>
      <div class="header-2">
         <div class="flex">
            <h1 style="font-family: 'Homemade Apple', cursive; ">open book</h1>
            <!-- <a href="home.php" class="logo">
               <img src="./images/my_profile/logo-2-inverse-retina.webp" alt="logo-web " style="height: 25px; margin-top:5px" class="logo-web">
            </a> -->
            <nav class=" navbar">
               <a href="home_index.php">home</a>
               <div class="dropdown">
                  <button class="dropbtn"> <a href="shop.php">shop</a></button>
                  <div class="dropdown-content">
                     <?php
                     include 'config.php';
                     $sql = "Select * From type WHERE id_b <> 80";
                     $kq = mysqli_query($conn, $sql);
                     if ($kq) {
                        while ($dm = mysqli_fetch_object($kq)) {
                     ?>
                           <a href="category_products.php?type=<?php echo $dm->id_b ?>"><?php echo $dm->book_type ?> </a>
                     <?php
                        }
                     }
                     ?>
                     <div><a href="category_products_2.php"> education</a></div>
                  </div>
               </div>
               <a href="about.php">about</a>
               <a href="contact.php">contact</a>
               <a href="orders.php">orders</a>
            </nav>
            <div class="icons">
               <div id="menu-btn" class="fas fa-bars"></div>
               <a href="search_page.php" class="fas fa-search"></a>
               <div id="user-btn" class="fas fa-user"></div>
               <?php
               // $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` ") or die('query failed'); //WHERE user_id = '$user_id'
               // $cart_rows_number = mysqli_num_rows($select_cart_number);
               if (empty($user_id)) {
                  $cart_rows_number = mysqli_num_rows($select_cart_number);
               } else {
                  $cart_rows_number = mysqli_query($conn, "SELECT COUNT(*) FROM `cart` WHERE user_id = $user_id") or die('query failed');
                  $cart_rows_number = mysqli_fetch_array($cart_rows_number)[0];
               }
               ?>
               <!-- <a href="cart.php" class="cart-link">
                  <span style="color:var(--purple)"></span>
               </a> -->
               <a href="cart.php">
                  <button type="button" class="  position-relative">
                     <i class="fas fa-shopping-cart"></i>
                     <span class="badges">
                        <?php echo $cart_rows_number; ?>
                        <span class="visually-hidden"></span>
                     </span>
                  </button></a>

            </div>
            <div class="user-box">
               <?php if (!isset($_SESSION['user_id'])) { ?>
                  <p>No user</p>
                  <a href="logout.php" class="delete-btn">login</a>
               <?php } else { ?>
                  <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                  <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                  <a href="logout.php" class="delete-btn">logout</a>
               <?php } ?>
            </div>
         </div>
      </div>
   </header>
   <script src="./js/script.js"></script>
</body>

</html>