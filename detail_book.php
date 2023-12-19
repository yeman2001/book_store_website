<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}




if (isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php'); // ถ้ายังไม่ได้ล็อกอินให้เด้งไปยังหน้า Login
        exit(); // หยุดการทำงานของ script ต่อไป
    }

    $user_id = $_SESSION['user_id'];
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



// if (isset($_POST['add_to_cart'])) {
//     $product = array(
//         'name' => $_POST['product_name'],
//         'price' => $_POST['product_price'],
//         'image' => $_POST['product_image'],
//         'quantity' => $_POST['product_quantity']
//     );

//     // if cart is already set
//     if (isset($_SESSION['cart'])) {
//         // Check if product is already in cart
//         $index = -1;
//         foreach ($_SESSION['cart'] as $key => $value) {
//             if ($value['name'] == $_POST['product_name']) {
//                 $index = $key;
//                 break;
//             }
//         }
//         if ($index == -1) {
//             // Product is not in cart, add it
//             $_SESSION['cart'][] = $product;
//         } else {
//             // Product is already in cart, update quantity
//             $_SESSION['cart'][$index]['quantity'] += $_POST['product_quantity'];
//         }
//     } else {
//         // Cart is not set, create it and add product
//         $_SESSION['cart'] = array();
//         $_SESSION['cart'][] = $product;
//     }

//     // Redirect back to product page
//     header('Location: product.php?id=' . $_GET['id']);
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="css/detail.css"> -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'header.php' ?>
    <section class="container-rv ">
        <div class="content-left">
            <?php
            $id = 0;
            if (isset($_GET["id"])) $id = $_GET["id"];
            $sql = "SELECT * FROM products WHERE 1 ";
            if ($id != 0) {
                $sql .= " AND id = $id ";
            }
            $kq = mysqli_query($conn, $sql);
            $sp = mysqli_fetch_assoc($kq);
            ?>
            <?php
            $kq = mysqli_query($conn, $sql);
            $n = mysqli_num_rows($kq);
            $kq = mysqli_query($conn, $sql);
            while ($fetch_product = mysqli_fetch_assoc($kq)) {
            ?>
                <form method="post" action="">
                    <div class="price">$<?php echo $fetch_product['price']; ?>/-</div><br>
                    <img src="./images/<?php echo $fetch_product['image']; ?>" alt="">
                    <input type="number" min="1" name="product_quantity" value="1" class="input"><br>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="btn-rv">
                        <input type="submit" value="Add to cart" name="add_to_cart" class="btn"><br>
                    </div>

        </div>
        <div class="content-right">
            <h1 class="name"><?php echo $fetch_product['name']; ?></h1>
            <div class="w3-panel w3-leftbar ">
                <p class="w3-md "><?php echo $fetch_product['summary']; ?> </p>
            </div>
            <div class="content-right-footer">
                <p class="">Author: <?php echo $fetch_product['writer']; ?> </p>
            </div>
        </div>
        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
        </form>
    <?php
            };
    ?>
    </section>

    <script src="js/script.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>