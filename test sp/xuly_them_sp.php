<?php
// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$database = "shop_db";
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$summary = mysqli_real_escape_string($conn, $_POST['summary']);
$type = mysqli_real_escape_string($conn, $_POST['type']);

// Upload the image file
$image = $_FILES['image']['name'];
$target_dir = "../images";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
} else {
  echo "Sorry, there was an error uploading your file.";
}

$sql = "INSERT INTO products (name, price, summary, type, image) VALUES ('$name', '$price', '$summary', '$type', '$image')";
if (mysqli_query($conn, $sql)) {
  echo "Record added successfully";
} else {
  echo "Error adding record: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
