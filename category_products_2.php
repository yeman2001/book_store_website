<?php include 'config.php';
session_start();

// $user_id = $_SESSION['user_id']; 
if (!isset($user_id)) {
    // header('location:login.php');
}
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
<html>

<head>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pro-intro.css">
</head>

<body>
    <?php include 'header.php' ?>
    <br>


    <section class="products">
        <h1 class="title">books for you</h1>
        <section class="big-con-pro-intro">
            <nav class="header-title">
                <a href="">Anime</a>
                <a href="category_products.php?type=69">view all <span class="amount-products-">(<?php echo $total_products; ?>)</span> >></a>
            </nav>
            <div class="container-intro">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE type=69 ") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                ?>
                        <form action="" method="post" class="box">
                            <a href="detail_book.php?id=<?= $fetch_products['id'] ?>" class="">
                                <img src="./images/<?php echo $fetch_products['image']; ?> " alt="" class="image"></a><br>

                        </form>
                <?php
                    }
                };
                ?>

            </div>
            <script src="./js/admin_script.js"></script>
            <script src=""></script>

        </section>
    </section>
    <?php include 'footer.php' ?>
    <script src="js/script.js"></script>
</body>

</html>