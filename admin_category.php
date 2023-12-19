<?php include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};



// Include the config file
include 'config.php';

// Check if the form is submitted
if (isset($_POST['add_category'])) {
    // Get the form data
    $book_type = $_POST['book_type'];
    $content = $_POST['content'];

    // Validate the form data

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "INSERT INTO type (book_type, content) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $book_type, $content);

    // Execute the SQL statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Category added successfully',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            location.href = 'categories.php';
        });
        </script>";
        header("Location: admin_category.php");
        exit();
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error adding category',
            text: '" . mysqli_error($conn) . "',
        });
        </script>";
    }

    // Close the statement
    // mysqli_stmt_close($stmt);
}
// Close the database connection
// mysqli_close($conn);

$messeng = '';
if (isset($_POST['update_category'])) {
    $book_type = $_POST['book_type'];
    $content = $_POST['content'];
    $id_b = $_POST['id_b'];
    //connect to database
    $conn = mysqli_connect("localhost", "root", "", "shop_db");
    //check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //update category
    $sql = "UPDATE type SET book_type='$book_type', content='$content' WHERE id_b='$id_b'";
    if (mysqli_query($conn, $sql)) {
        // header('location:admin_category.php');
        echo $messeng = "Category updated successfully";
    } else {
        echo "Error updating category: " . mysqli_error($conn);
    }
    //close connection
    mysqli_close($conn);
}





if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    //connect to database
    $conn = mysqli_connect("localhost", "root", "", "shop_db");
    //check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_query($conn, "DELETE FROM `type` WHERE id_b = '$delete_id'") or die('query failed');
    //close connection
    mysqli_close($conn);
    header('location:admin_category.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <?php include 'admin_header.php' ?>
    <br>
    <dive class="nav-tool">
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left: 3rem;">
            + add category
        </button>
        <a href="admin_search_category.php"><button type="button" class="btn " style="margin-left: 3rem;">
                <i class="fas fa-search" style="color: white;"></i> search category
            </button></a>
    </dive>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">add category</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="add-products">
                        <h1 class="title">category</h1>
                        <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" name="book_type"> Category Name:</label>
                                <input type="text" class="box" id="book_type" name="book_type" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" name="contact">Content:</label>
                                <textarea type="text" class="box" id="content" name="content"> </textarea>
                            </div>
                            <button type="submit" class="btn-category " name="add_category">Submit</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- table -->
    <?php
    // Connect to database and execute the query
    include 'config.php';

    // Execute the query
    $result = mysqli_query($conn, "SELECT COUNT(*) as total_products FROM type");

    // Check if query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // Get total count of products
        $total_products = $row['total_products'];
    } else {
        // Handle query error
        $total_products = 0;
    }
    ?>

    <div class="amount-products"> <button>All categery <span class="amount-products-">(<?php echo $total_products; ?>)</span></button></div>
    <div class="table table-responsive">
        <br>
        <table class="table table-hover table-striped  ">
            <br>
            <thead class="table table-head">
                <tr>
                    <th><label for="">#</label></th>
                    <th><label for="">id</label></th>
                    <th><label for="">name</label></th>
                    <th><label for="">description</label></th>
                    <th><label for="">action</label></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // include 'config.php';
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

                if (mysqli_num_rows($result) > 0) {
                    $sn = ($current_page - 1) * $records_per_page + 1;
                    while ($fetch_products = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><label for=""><?php echo $sn; ?></label></td>
                            <td><label for=""><?php echo $fetch_products['id_b']; ?> </label></td>
                            <td><label for=""><?php echo $fetch_products['book_type']; ?></label></td>
                            <td><label for=""><?php echo $fetch_products['content']; ?> </label></td>
                            <td>
                                <a href="admin_category.php?update=<?php echo $fetch_products['id_b']; ?>" class=" "><i class="fas fa-edit"></i></a>

                                <a href="admin_category.php?delete=<?php echo $fetch_products['id_b']; ?>" class="" onclick="return confirm('delete this product?');"><i class="fas fa-trash-alt"></i></a>

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
    <!--pagination-->

    <!-- table -->

    <!-- update peoducts-->
    <section class="edit-product-form ">

        <?php
        if (isset($_GET['update'])) {
            $id_b = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `type` WHERE id_b = '$id_b'") or die('query failed');
            if (mysqli_num_rows($update_query) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) {
        ?>
                    <div>
                        <!-- <button class="close-btn" style="margin-top: -43%;">X</button> -->
                        <form action="" method="post" enctype="multipart/form-data">
                            <h1>update category</h1>
                            <p class="messeng-successfully"><?php echo $messeng ?></p>
                            <br>
                            <input type="hidden" name="id_b" value="<?php echo $fetch_update['id_b']; ?>">
                            <input type="text" name="book_type" value="<?php echo $fetch_update['book_type']; ?>" class="box" required placeholder="update catagory">
                            <textarea type="text" name="content" value="content" class="box" required placeholder="update description"><?php echo $fetch_update['content']; ?></textarea>
                            <div class="d-flex ">
                                <input type="submit" value="update" name="update_category" class="btn w-100" style="background-color: green">
                            </div>
                        </form>
                        <button class="close-btn" style="width: 100%;height: 5rem">cancel</button>
                    </div>
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
            window.location.href = 'admin_category.php'; // redirect to admin_products.php
        });
    </script>
    <!-- update products-->
</body>

</html>