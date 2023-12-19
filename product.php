<!-- <?php
        session_start();
        include 'config.php'; // include your database connection file

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM products WHERE id = $id";
            $result = mysqli_query($conn, $query);
            $fetch_product = mysqli_fetch_assoc($result);
        } else {
            header('Location: index.php');
            exit();
        }
        ?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $fetch_product['name']; ?></title>
</head>

<body>
    <table>
        <tr>
            <td rowspan="4"><img src="./images/<?php echo $fetch_product['image']; ?>" alt=""></td>
            <td>
                <h1><?php echo $fetch_product['name']; ?></h1>
            </td>
        </tr>
        <tr>
            <td>
                <p><?php echo $fetch_product['summary']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Author: <?php echo $fetch_product['writer']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <form method="post" action="">
                    <input type="number" min="1" name="product_quantity" value="1" class="input"><br>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="btn"><br>
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                </form>
            </td>
        </tr>
    </table>
</body>

</html> -->