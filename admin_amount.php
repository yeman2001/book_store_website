<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

// Assuming your Orders table has columns named amount and payment_status
$sql = "SELECT SUM(total_price) AS totalAmount FROM Orders WHERE payment_status = 'completed'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalAmount = $row['totalAmount'];
} else {
    // Handle the error if the query fails
    $totalAmount = "Error fetching total amount";
}


// Total amount for pending payments
$sqlPending = "SELECT SUM(total_price) AS totalPending FROM Orders WHERE payment_status = 'pending'";
$resultPending = mysqli_query($conn, $sqlPending);

if ($resultPending) {
    $rowPending = mysqli_fetch_assoc($resultPending);
    $totalPending = $rowPending['totalPending'];
} else {
    // Handle the error if the query fails
    $totalPending = "Error fetching total amount";
}

mysqli_close($conn);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="./css/admin_amount.css">
</head>

<body>
    <?php include "admin_header.php" ?>
    <section class="big-card-container ">
        <!-- Card Container -->
        <div class="card-container">
            <div class="amount"><?php echo $totalAmount; ?></div>
            <div class="additional-info">Total Amount (Completed Payments)</div>
        </div>
        <!-- Card Container for Pending Payments -->
        <div class="card-container">
            <div class="amount"><?php echo $totalPending; ?></div>
            <div class="additional-info">Total Amount (Pending Payments)</div>
        </div>
    </section>
</body>

</html>