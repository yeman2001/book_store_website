<?php

include 'config.php';

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<style>
    body {
        background: #111;
        font-family: 'Open Sans', sans-serif;
    }

    .cta-background {
        background-size: cover;
        background-position: center center;
        bottom: 0;
        filter: blur(50px);
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        z-index: -1;
    }

    .container {
        padding: 10px;
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        align-items: flex-start;
        gap: 2rem;

        overflow-x: scroll;

        /* add some bottom padding to prevent the last row from being cut off */
    }

    .cta {
        background: #333;
        box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.2);
        width: 150px;
        height: 230px;
        position: relative;
        overflow: hidden;
    }

    .cta:hover img {

        top: 0;
        filter: brightness(30%);
    }

    .cta:hover .text {
        bottom: 0;
    }

    .cta img {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 150px;
        height: 230px;
        filter: brightness(90%);
        transition: 0.5s ease-in-out;
    }

    .cta .text {
        position: absolute;
        bottom: -100%;
        padding: 10px;
        transition: 0.5s ease-in-out;
    }

    .cta .text h2 {
        position: relative;
        display: inline-block;
        margin-bottom: 5px;
        font-weight: 300;
        color: #fff;
        text-shadow: 0 0 10px rgba(0, 0, 0, 30);
    }



    .cta .text p {
        font-weight: 300;
        color: #fff;
    }

    .header-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<body>


    <div class="container">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 12") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
                <a href="detail_book.php?id=<?= $fetch_products['id'] ?>">
                    <div class="cta">
                        <img src="./images/<?php echo $fetch_products['image']; ?>" class="cover-image" />
                        <div class="text">
                            <h2><?php echo $fetch_products['name']; ?></h2>
                            <p><?php echo $fetch_products['writer']; ?></p>
                            <p><?php echo $fetch_products['price']; ?>/-</p>
                        </div>
                    </div>
                </a>
        <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>
    <br>
    <div class="container">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 12") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
                <a href="detail_book.php?id=<?= $fetch_products['id'] ?>">
                    <div class="cta">
                        <img src="./images/<?php echo $fetch_products['image']; ?>" class="cover-image" />
                        <div class="text">
                            <h2><?php echo $fetch_products['name']; ?></h2>
                            <p><?php echo $fetch_products['writer']; ?></p>

                            <p><?php echo $fetch_products['price']; ?>/-</p>
                        </div>
                    </div>
                </a>
        <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>
    <br>
    <nav class="header-title">
        <h3 href="">Novel</h3>

        <a href="category_products.php?type=70">view all <span class="amount-products-"></span></a>
    </nav>
    <div class="container">


        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 12") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
                <a href="detail_book.php?id=<?= $fetch_products['id'] ?>">
                    <div class="cta">
                        <img src="./images/<?php echo $fetch_products['image']; ?>" class="cover-image" />
                        <div class="text">
                            <h2><?php echo $fetch_products['name']; ?></h2>
                            <p><?php echo $fetch_products['writer']; ?></p>
                            <p><?php echo $fetch_products['price']; ?>/-</p>
                        </div>
                    </div>
                </a>
        <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>
    <br>
    <div class="container">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 12") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
                <a href="detail_book.php?id=<?= $fetch_products['id'] ?>">
                    <div class="cta">
                        <img src="./images/<?php echo $fetch_products['image']; ?>" class="cover-image" />
                        <div class="text">
                            <h2><?php echo $fetch_products['name']; ?></h2>
                            <p><?php echo $fetch_products['writer']; ?></p>
                            <p><?php echo $fetch_products['price']; ?>/-</p>
                        </div>
                    </div>
                </a>
        <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>




</body>

</html>