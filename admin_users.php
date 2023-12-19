<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <!-- <link rel="stylesheet" href="./css/css.css"> -->
</head>

<body>

   <?php include 'admin_header.php'; ?>











   <!-- table -->
   <?php
   // Connect to database and execute the query
   include 'config.php';

   // Execute the query
   $result = mysqli_query($conn, "SELECT COUNT(*) as total_users FROM users");

   // Check if query was successful
   if ($result) {
      $row = mysqli_fetch_assoc($result);
      // Get total count of products
      $total_users = $row['total_users'];
   } else {
      // Handle query error
      $total_users = 0;
   }
   ?>

   <div class="amount-products"> <button>All users <span class="amount-products-">(<?php echo $total_users; ?>)</span></button></div>
   <div class="table table-responsive">
      <br>
      <table class="table table-hover table-striped  ">
         <br>
         <thead class="table table-head">
            <tr>
               <th><label for="">#</label></th>
               <th><label for="">user id</label></th>
               <th><label for="">user name</label></th>
               <th> <label for="">email</label></th>
               <th> <label for="">user type</label></th>
               <!-- <th> <label for="">status</label></th> -->
               <th> <label for="">actions</label></th>
            </tr>
         </thead>
         <tbody>
            <?php
            // include 'config.php';
            // Get total number of records
            $sql = "SELECT COUNT(*) as total FROM users";
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
            $sql = "SELECT * FROM users LIMIT $offset, $records_per_page";
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) > 0) {
               $sn = ($current_page - 1) * $records_per_page + 1;
               while ($fetch_users = mysqli_fetch_assoc($result)) {
            ?>
                  <tr>
                     <td><label for=""><?php echo $sn; ?></label></td>
                     <td><label for=""><?php echo $fetch_users['id']; ?> </label></td>
                     <td><label for=""><?php echo $fetch_users['name']; ?></label></td>
                     <td><label for=""><?php echo $fetch_users['email']; ?> </label></td>
                     <td style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                          echo 'var(--orange)';
                                       } ?>">
                        <label for=""><?php echo $fetch_users['user_type']; ?> </label>
                     </td>
                     <!-- <td> <label for=""><?php //echo $fetch_users['status']; 
                                             ?></label></td> -->
                     <td>
                        <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class=""><i class="bi bi-trash"></i> </a>
                     </td>
                  </tr>
               <?php
                  $sn++;
               }
            } else {
               ?>
               <tr>
                  <td colspan="7">No data found</td>
               </tr>
            <?php
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









   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>