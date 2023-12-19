<?php
// Connect to database and execute the query
include 'config.php';

// Execute the query
$result = mysqli_query($conn, "SELECT COUNT(*) as total_products FROM products WHERE type=69");

// Check if query was successful
if ($result) {
   $row = mysqli_fetch_assoc($result);
   // Get total count of products
   $total_products = $row['total_products'];
} else {
   // Handle query error
   $total_products = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pro-intro</title>
   <link rel="stylesheet" href="css/pro-intro.css">
</head>

<body>
   <section class="big-con-pro-intro">
      <nav class="header-title">
         <h3 href="">Anime</h3>
         <a href="category_products.php?type=69">view all <span class="amount-products-">(<?php echo $total_products; ?>)</span></a>
      </nav>

      <div class="container-intro">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type=69 ") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="box">
                  <a href="detail_book.php?id=<?= $fetch_products['id'] ?>" class="">
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

      <script src="./js/admin_script.js"></script>
   </section>
</body>

</html>