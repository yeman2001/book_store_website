<?php include 'config.php';
session_start();

// $user_id = $_SESSION['user_id']; 
if (!isset($user_id)) {
    // header('location:login.php');
}
?>
<html>

<head>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/big-column.css">
</head>

<body>
    <?php include 'header.php' ?>
    <br>


    <section class="products">
        <h1 class="title">all products</h1>
        <div class="header-title2">
            <h1>... </h1>
            <a href="all_products.php">
                <p>...</p>
            </a>
        </div>
        <br>
        <div class="container-column">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`  ") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="column">
                        <div class="column-l">
                            <a href="detail_book.php?id=<?= $fetch_products['id'] ?>" class=""> <img src="./images/<?php echo $fetch_products['image']; ?> " alt="" class="image" style="height:100%;   border-radius: 0px;"> </a>
                        </div>
                        <div class="column-r">
                            <h2><?php echo $fetch_products['name']; ?></h2>
                            <p><?php echo $fetch_products['writer']; ?></p>
                            <label class="price">$<?php echo $fetch_products['price']; ?>/-</label>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>

    </section>
    <?php include 'footer.php' ?>
    <script src="js/script.js"></script>
</body>

</html>