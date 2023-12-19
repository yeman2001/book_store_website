<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <!-- custom admin css file link  -->

   <!-- <link rel="stylesheet" href="./css/css.css"> -->
   <link rel="stylesheet" href="css/admin_style.css">
   <!-- <link rel="stylesheet" href="css/imfor.css"> -->


</head>

<body>

   <?php include 'admin_header.php'; ?>

   <!-- admin dashboard section starts  -->

   <section class="dashboard" id="">
      <h1 class="title">dashboard</h1>
      <div class="box-container">
         <div class="box" style="background-color: yellow;">
            <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if (mysqli_num_rows($select_pending) > 0) {
               while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
            ?>
            <h3>$<?php echo $total_pendings; ?>/-</h3>
            <p>total pendings</p>
         </div>

         <div class="box" style="background-color: green;">
            <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if (mysqli_num_rows($select_completed) > 0) {
               while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
            ?>
            <h3>$<?php echo $total_completed; ?>/-</h3>
            <p>completed payments</p>
         </div>

         <div class="box" style="background-color: purple;">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?></h3>
            <p>order placed</p>
         </div>

         <div class="box" style="background-color:plum">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products; ?></h3>
            <p>products added</p>
         </div>

         <div class="box" style="background-color: red;">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?></h3>
            <p>normal users</p>
         </div>

         <div class="box" style="background-color: blue;">
            <?php
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins; ?></h3>
            <p>admin users</p>
         </div>

         <div class="box" style="background-color: orange">
            <?php
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><?php echo $number_of_account; ?></h3>
            <p>total accounts</p>
         </div>

         <div class="box" style="background-color: lightpink;">
            <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
            ?>
            <h3><?php echo $number_of_messages; ?></h3>
            <p>new messages</p>
         </div>

      </div>

   </section>

   <!-- admin dashboard section ends -->









   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>