<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

// Function to count orders by payment status
function countOrdersByPaymentStatus($conn, $status)
{
   $count_query = mysqli_query($conn, "SELECT COUNT(*) AS count FROM `orders` WHERE payment_status = '$status'") or die('query failed');
   $count_result = mysqli_fetch_assoc($count_query);
   return $count_result['count'];
}

$pending_count = countOrdersByPaymentStatus($conn, 'pending');
$shopping_count = countOrdersByPaymentStatus($conn, 'shopping');
$completed_count = countOrdersByPaymentStatus($conn, 'completed');

if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');

   $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>

   </style>
</head>

<body>

   <?php include 'admin_header.php'; ?>
   <section class="orders">
      <h1 class="title">placed orders</h1>
      <!-- Count buttons for order status -->
      <div class="count-buttons">
         <button class="btn-pending">Pending (<?php echo $pending_count; ?>)</button>
         <!-- <button class="btn-shopping">Shopping (<?php echo $shopping_count; ?>)</button> -->
         <button class="btn-completed">Completed (<?php echo $completed_count; ?>)</button>
      </div>

      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY placed_on DESC") or die('query failed');
      if (mysqli_num_rows($select_orders) > 0) {
         while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
      ?>

            <div class="table-responsive tb-order">
               <table class="table  table-hover">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col"><span> id </th>
                        <th scope="col">placed on</th>
                        <th scope="col">name </th>
                        <th scope="col">number</th>
                        <th scope="col">email</th>
                        <th scope="col">address</th>
                        <th scope="col">total products </th>
                        <th scope="col">total price </th>
                        <th scope="col">payment method </th>
                        <th scope="col">action </th>
                     </tr>
                  </thead>
                  <tbody class="table-group-divider">
                     <?php
                     $i = 1;
                     while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                     ?>
                        <tr>
                           <th scope="row"><?php echo $i; ?></th>
                           <td><?php echo $fetch_orders['user_id']; ?></td>
                           <td><?php echo $fetch_orders['placed_on']; ?></td>
                           <td><?php echo $fetch_orders['name']; ?></td>
                           <td><?php echo $fetch_orders['number']; ?></td>
                           <td><?php echo $fetch_orders['email']; ?></td>
                           <td><?php echo $fetch_orders['address']; ?></td>
                           <td><?php echo $fetch_orders['total_products']; ?></td>
                           <td>$<?php echo $fetch_orders['total_price']; ?>/-</td>
                           <td><?php echo $fetch_orders['method']; ?></td>
                           <td>
                              <form action="" method="post" class="d-flex">
                                 <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                 <select name="update_payment" style="margin-top:1rem">
                                    <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                                    <option value="pending">pending</option>
                                    <option value="completed">completed</option>
                                    <!-- <option value="shopping">shoppingn</option> -->
                                 </select>
                                 <input type="submit" value="update" name="update_order" class="option-btn">
                                 <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>

                              </form>
                           </td>
                        </tr>
               <?php
                        $i++;
                     }
                  }
               }
               ?>
                  </tbody>
               </table>
            </div>



   </section>






   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
   <script>
      // Get count buttons
      const pendingBtn = document.querySelector('.btn-pending');
      const shoppingBtn = document.querySelector('.btn-shopping');
      const completedBtn = document.querySelector('.btn-completed');

      // Add click event listeners to count buttons
      pendingBtn.addEventListener('click', () => {
         window.location.href = 'admin_orders.php?payment_status=pending';
      });

      shoppingBtn.addEventListener('click', () => {
         window.location.href = 'admin_orders.php?payment_status=shopping';
      });

      completedBtn.addEventListener('click', () => {
         window.location.href = 'admin_orders.php?payment_status=completed';
      });
   </script>

</body>

</html>