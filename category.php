
      <div class="navbar" style="text-align: center; font-size:x-large;">
         <?php
         include 'config.php';
         
         $sql = "Select * From type ";
         $kq = mysqli_query($conn, $sql);
         if ($kq) {
            while ($dm = mysqli_fetch_object($kq)) {
         ?>
               <a href="category_products.php?id_b=<?php echo $dm->id_b ?>" style="margin:1rem"><?php echo $dm->book_type ?>  </a>
         <?php
            }
         }
         ?>
      </div>
  