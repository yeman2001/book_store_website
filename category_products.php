<?php include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
}
?>
<html>

<head>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <br>


    <section class="products">
        <h1 class="title">books for you</h1>
        <div class="box-container">
            <?php
            $madm = 0;
            if (isset($_GET["type"])) $madm = $_GET["type"];
            $sql = "SELECT * FROM products WHERE 1 ";
            if ($madm != 0) {
                $sql .= " AND type = $madm ";
            }
            // $select_products = mysqli_query($conn, "SELECT * FROM `products` ") or die('query failed');
            // if (mysqli_num_rows($select_products) > 0) {
            //     while ($fetch_products = mysqli_fetch_assoc($select_products))
            $select_products = mysqli_query($conn, $sql);
            $n = mysqli_num_rows($select_products);
            $select_products = mysqli_query($conn, $sql);
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                <form action="" method="post" class="box" style="width:100%;   border-radius: 0px;">
                    <a href="detail_book.php?id=<?= $fetch_products['id'] ?>" class="">
                        <img src="./images/<?php echo $fetch_products['image']; ?> 
                        " alt="" class="image"></a><br>
                    <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                </form>
            <?php
            };
            ?>

        </div>
    </section>
    <?php include 'footer.php' ?>
    <script src="js/script.js"></script>
</body>

</html>