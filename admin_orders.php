<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

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

function getStatusColor($paymentStatus)
{
   switch ($paymentStatus) {
      case 'pending':
         return 'yellow';
      case 'cancel':
         return 'red';
      case 'completed':
         return 'green';
      default:
         return ''; // Default color if status is not recognized
   }
}

// Handle search functionality
if (isset($_POST['search_orders'])) {
   $searchTerm = $_POST['search'];
   $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE 
      user_id LIKE '%$searchTerm%' OR 
      name LIKE '%$searchTerm%' OR 
      number LIKE '%$searchTerm%' OR 
      email LIKE '%$searchTerm%' OR 
      address LIKE '%$searchTerm%' OR 
      total_products LIKE '%$searchTerm%' OR 
      total_price LIKE '%$searchTerm%' OR 
      method LIKE '%$searchTerm%' OR 
      payment_status LIKE '%$searchTerm%'
   ORDER BY
      CASE 
         WHEN payment_status = 'pending' THEN 1
         WHEN payment_status = 'completed' THEN 2
         WHEN payment_status = 'cancel' THEN 3
         ELSE 4
      END") or die('query failed');
} else {
   // Default query without search
   $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY
      CASE 
         WHEN payment_status = 'pending' THEN 1
         WHEN payment_status = 'completed' THEN 2
         WHEN payment_status = 'cancel' THEN 3
         ELSE 4
      END") or die('query failed');
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <!-- <link rel="stylesheet" href="./css/css.css"> -->
   <style>
      .box-container-table {
         overflow-x: auto;
      }

      table {
         border-collapse: collapse;
         width: 100%;
         /* Set the width to auto for content-based sizing */
         table-layout: auto;
         /* Let the table adjust its width based on content */
      }

      th,
      td {
         border-bottom: 1px solid whitesmoke;
         padding: 8px;
         text-align: left;
         font-size: medium;
         word-wrap: break-word;
         /* Allow long words to break and wrap */
      }

      th {
         background-color: #f2f2f2;
      }

      @media (max-width: 600px) {

         th,
         td {
            font-size: 12px;
            /* Adjust font size for small screens */
         }
      }

      .option-btn i,
      .delete-btn i {
         margin-right: 5px;
         color: #f2f2f2;
         /* Add space between the icon and text */
      }

      tr:nth-child(even) {
         background-color: gainsboro;
      }

      tr:hover {
         background-color: gainsboro;
      }

      th {
         background-color: var(--purple);
         color: #f2f2f2;
      }

      form {
         margin-bottom: 20px;
      }

      label {
         font-weight: bold;
         margin-right: 10px;
      }

      input[type="text"] {
         padding: 8px;
         margin-right: 10px;
         border: 1px solid #ccc;
         border-radius: 4px;
      }

      button {
         padding: 8px 12px;
         background-color: var(--purple);
         color: #fff;
         border: none;
         border-radius: 4px;
         cursor: pointer;
      }
   </style>

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="orders">

      <h1 class="title">placed orders</h1>

      <!-- Add search form -->
      <form method="post">
         <!-- <label for="search">Search:</label> -->
         <input type="text" name="search" id="search">
         <button type="submit" name="search_orders">Search</button>
      </form>

      <div class="box-container-table">
         <?php
         if (mysqli_num_rows($select_orders) > 0) {
         ?>
            <table>
               <thead>
                  <tr>
                     <th>#</th>
                     <th>User ID</th>
                     <th>Placed On</th>
                     <th>Name</th>
                     <th>Number</th>
                     <th>Email</th>
                     <th>Address</th>
                     <th>Total Products</th>
                     <th>Total Price</th>
                     <th>Payment Method</th>
                     <th>Payment Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <?php
               $counting = 1; // Initialize sequence number
               while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
               ?>
                  <tr>
                     <td><?php echo $counting++; ?></td>
                     <td><?php echo $fetch_orders['user_id']; ?></td>
                     <td><?php echo $fetch_orders['placed_on']; ?></td>
                     <td><?php echo $fetch_orders['name']; ?></td>
                     <td><?php echo $fetch_orders['number']; ?></td>
                     <td><?php echo $fetch_orders['email']; ?></td>
                     <td><?php echo $fetch_orders['address']; ?></td>
                     <td><?php echo $fetch_orders['total_products']; ?></td>
                     <td>$<?php echo $fetch_orders['total_price']; ?>/-</td>
                     <td><?php echo $fetch_orders['method']; ?></td>
                     <td style="background-color: <?php echo getStatusColor($fetch_orders['payment_status']); ?>;">
                        <?php echo $fetch_orders['payment_status']; ?>
                     </td>
                     <td>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                           <select name="update_payment">
                              <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                              <option value="pending">pending</option>
                              <option value="completed">completed</option>
                              <option value="cancel">cancel</option>
                           </select>
                           <button type="submit" name="update_order" class="option-btn">
                              <i class="fas fa-edit"></i>
                           </button>
                           <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">
                              <i class="fas fa-trash"></i>
                           </a>
                        </form>
                     </td>
                  </tr>
               <?php
               }
               ?>
            </table>
         <?php
         } else {
            echo '<p class="empty">No orders placed yet!</p>';
         }
         ?>
      </div>

   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>