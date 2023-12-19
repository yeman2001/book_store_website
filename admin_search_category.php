<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};


// Check if the add product form is submitted
if (isset($_POST['add_product'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $writer = $_POST['writer'];
   $summary = $_POST['summary'];

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;
   $type = $_POST['type'];

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'product name already added';
   } else {
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, writer,summary, price, image,type) VALUES('$name','$writer', '$summary','$price', '$image','$type')") or die('query failed');

      if ($add_product_query) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      } else {
         $message[] = 'product could not be added!';
      }
   }
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_writer = $_POST['update_writer'];
   $update_summary = $_POST['update_summary'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price',summary='$update_summary',writer='$update_writer'WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/' . $update_image;
   $update_old_image = $_POST['update_old_image'];

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'image file size is too large';
      } else {
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/' . $update_old_image);
      }
   }

   header('location:admin_products.php');
}

$cn = mysqli_connect('localhost', 'root', '', 'shop_db');
if (!$cn) {
   die("Kết nối my sql không thành công , vui lòng kiểm tra lại server");
}
$sql = "SELECT * FROM type ";
$kq = mysqli_query($cn, $sql);
$n = mysqli_num_rows($kq);



?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>
   <br>
   <div class="tool-search">
      <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left: 3rem;">
         + add products
      </button>
      <div class="search-form">
         <form action="" method="post">
            <input type="text" name="search" placeholder="search products..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
         </form>
      </div>
      <!-- <div>hi</div> -->
      <!-- Button trigger modal -->

   </div>
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h3 class="modal-title" id="exampleModalLabel">add product</h3>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <section class="add-products">
                  <h1 class="title">shop products</h1>
                  <form action="" method="post" enctype="multipart/form-data">
                     <!-- <input type="text" name="id" class="box" placeholder="enter product id" required> -->
                     <input type="text" name="name" class="box" placeholder="enter product name" required>
                     <input type="text" name="writer" class="box" placeholder="enter writer" required>
                     <textarea type="text" name="summary" class="box" placeholder="enter summary" required></textarea>
                     <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
                     <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
                     <div class="category">
                        <label for="category" style="font-size: medium;margin-bottom :0.5rem"></label>

                        <div class="custom">
                           <div class="custom-select">
                              <select name="type" id="type" style="height: 50px; width:100%;background-color: var(--light-bg);">
                                 <?php
                                 while ($type = mysqli_fetch_object($kq)) {
                                    echo "<option value'$type->id_b'>$type->book_type</option>";
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn " data-bs-dismiss="modal" style="background-color: gray;">Close</button>
                        <input type="submit" value="add product" name="add_product" class="btn">
                     </div>
                  </form>
               </section>
            </div>
         </div>
      </div>
   </div>

   <!-- table -->

   <div class="table table-responsive">
      <br>
      <table class="table table-hover table-striped">
         <br>
         <thead class="table table-head ">
            <tr>
               <th><label for="" style="font-size: medium;">#</label></th>
               <th><label for="">Name</label></th>
               <th><label for="">price</label></th>

               <th><label for="">description</label></th>

               <th><label for="">action</label></th>
            </tr>
         </thead>
         <tbody>
            <?php
            include 'config.php';
            // Get total number of records
            $sql = "SELECT COUNT(*) as total FROM type";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_records = $row['total'];

            // Calculate number of pages
            $records_per_page = 10;
            $total_pages = ceil($total_records / $records_per_page);

            // Get current page number
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            // offset for SQL query
            $offset = ($current_page - 1) * $records_per_page;

            // Get products for current page
            $sql = "SELECT * FROM type LIMIT $offset, $records_per_page";
            $result = $conn->query($sql);

            if (isset($_POST['submit'])) {
               $search_item = $_POST['search'];
               $select_products = mysqli_query($conn, "SELECT * FROM `type` WHERE book_type LIKE '%{$search_item}%'") or die('query failed');
               if (mysqli_num_rows($select_products) > 0) {
                  $i = 1;
                  while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                     <tr>
                        <td><label for=""><?php echo $i; ?></label></td>
                        <td><label for=""><?php echo $fetch_products['id_b']; ?> </label></td>
                        <td><label for=""><?php echo $fetch_products['book_type']; ?></label></td>
                        <td><label for=""><?php echo $fetch_products['content'] ?></label></td>

                        <td>
                           <a href="admin_category.php?update=<?php echo $fetch_products['id_b']; ?>" class="option-btn">update</a>
                           <a href="admin_category.php?delete=<?php echo $fetch_products['id_b']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
                        </td>
                     </tr>
                  <?php
                     $i++;
                  }
               } else {
                  ?>
                  <tr>
                     <td colspan="7">No data found</td>
                  </tr>
            <?php
               }
            }
            ?>
         </tbody>
      </table>
   </div>
   <!-- pagination-->
   <div class="pagination">
      <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
         <?php if ($i == $current_page) : ?>
            <a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
         <?php else : ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
         <?php endif; ?>
      <?php endfor; ?>
   </div>
   <!--pagination-->

   <!-- table -->

   <!-- update peoducts-->
   <section class="edit-product-form ">

      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
               <button class="close-btn" style="margin-top: -43%;">X</button>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                  <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                  <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                  <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
                  <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
                  <textarea type="text" name="update_summary" value="<?php echo $fetch_update['summary'] ?>" class="box" require placeholder="enter summary"></textarea>
                  <input type="text" name="update_writer" value="<?php echo $fetch_update['writer'] ?>" class="box" require placeholder="enter writer">
                  <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                  <div class="d-flex ">
                     <input type="reset" value="cancel" id="close-update" class="option-btn " style="background-color: gray">
                     <input type="submit" value="update" name="update_product" class="btn w-100" style="background-color: green">
                  </div>
               </form>
      <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>
   </section>


   <!-- custom admin js file link  -->
   <script src=" js/admin_script.js"></script>
   <script>
      const closeBtn = document.querySelector('.close-btn');
      const editForm = document.querySelector('.edit-product-form');

      closeBtn.addEventListener('click', () => {
         editForm.style.display = 'none';
         window.location.href = 'admin_products.php'; // redirect to admin_products.php
      });
   </script>
   <!-- update products-->
</body>

</html>