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
</head>

<body>
   <header class="header">
      <div class="flex">
         <a href="admin_page.php" class="logo">Admin<span>control</span></a>
         <nav class="navbar">
            <a href="admin_page.php">home</a>
            <a href="admin_products.php" id="productsLink" name="productsLink">products</a>
            <a href="admin_category.php" id="categoryLink" name="categoryLink">category</a>
            <a href="admin_orders.php">orders</a>
            <a href="admin_amount.php">amount</a>
            <a href="admin_users.php">users</a>
            <a href="admin_contacts.php">messages</a>
         </nav>
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>

            <div id="user-btn" class="fas fa-user"></div>
         </div>
         <div class="account-box">
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
            <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
         </div>
      </div>

   </header>


</body>

</html>