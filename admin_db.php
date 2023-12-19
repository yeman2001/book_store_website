<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyP0pXa7lauyIbbVdL/06F2Asd8BO0HLkD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/css.css">
    <!-- <link rel="stylesheet" href="./css/imfor.css"> -->

    <title>Admin Dashboard</title>

</head>

<body>


    <body>

        <input type="checkbox" class="toggle-btn" id="toggle-btn">
        <label for="toggle-btn" id="toggle-btn-label">&#9776; </label>

        <div id="sidebar">
            <h1>Admin Dashboard</h1>
            <ul>
                <li> <a href="admin_page.php">Dashboard</a></li>
                <li id="openUserModal"> <a>My profile</a></li>
                <li> <a href="admin_products.php">products</a></li>
                <li> <a href="admin_category.php">category</a></li>
                <li> <a href="admin_orders.php">orders</a></li>
                <li> <a href="admin_amount.php">amount</a></li>
                <li> <a href="admin_users.php">users</a></li>
                <li> <a href="admin_contacts.php">messages</a></li>
                <!-- Add more menu items as needed -->
            </ul>
        </div>

        <!-- <div id="content">
            our content goes here 
            <br>
            <h2>Welcome to the Admin Dashboard</h2>
            <p>This is a basic admin dashboard template.</p>
        </div> -->

        <!-- User Modal -->
        <div class="con-user">
            <div id="userModal">
                <span id="closeModal" onclick="closeUserModal()">&times;</span>
                <h1>User Information</h1>
                <br>
                <form id="userForm">
                    <div class="account-box">
                        <p style="font-size: medium;">username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                        <p style="font-size: medium;">email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                        <br>
                        <a href="logout.php" class="logout_btn" style="font-size: medium;">logout</a>
                    </div>
                </form>
            </div>
        </div>
        <script>
            const toggleBtn = document.getElementById('toggle-btn');
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const openUserModalBtn = document.getElementById('openUserModal');
            const userModal = document.getElementById('userModal');

            toggleBtn.addEventListener('change', () => {
                if (toggleBtn.checked) {
                    sidebar.style.marginLeft = '0';
                    content.style.marginLeft = '250px';
                } else {
                    sidebar.style.marginLeft = '-250px';
                    content.style.marginLeft = '0';
                }
            });

            // Open user modal when Users menu item is clicked
            openUserModalBtn.addEventListener('click', () => {
                userModal.style.display = 'block';
            });

            // Close user modal
            function closeUserModal() {
                userModal.style.display = 'none';
            }

            // Submit user form (replace this with your actual form submission logic)
        </script>

    </body>

</html>