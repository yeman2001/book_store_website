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
               <a href="logout.php" class="">login</a>
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
               <a href="home.php">home</a>
               <div class="dropdown">
                  <button class="dropbtn"> <a href="login.php">shop</a></button>
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
                     <div><a href="login.php"> education</a></div>
                  </div>
               </div>
               <a href="login.php">about</a>
               <a href="login.php">contact</a>
               <a href="login.php">orders</a>
            </nav>
            <div class="icons">
               <div id="menu-btn" class="fas fa-bars"></div>
               <a href="login.php" class="fas fa-search"></a>
               <div id="user-btn" class="fas fa-user"></div>
               <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` ") or die('query failed'); //WHERE user_id = '$user_id'

               ?>

               <a href="login.php">
                  <button type="button" class="  position-relative">
                     <i class="fas fa-shopping-cart"></i>
                     <span class="badges">
                        0
                        <span class="visually-hidden"></span>
                     </span>
                  </button></a>

            </div>
            <div class="user-box">

               <a href="logout.php" class="delete-btn">login</a>

            </div>
         </div>
      </div>
   </header>
   <script src="./js/script.js"></script>
</body>

</html>