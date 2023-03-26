<?php

include 'config.php';

session_start();
error_reporting(0);

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $description = $_POST['description'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $category_id = $_POST['category_id'];
   $stocks = $_POST['stocks'];

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('select query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Product name already added!';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products` (name, price, description, image, category_id, stocks) VALUES('$name', '$price', '$description', '$image', '$category_id', '$stocks')") or die('insert query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'Image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Product added successfully!';
         }
      }else{
         $message[] = 'Product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE p_id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE p_id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_description = $_POST['update_description'];
   $update_price = $_POST['update_price'];
   $update_category_id = $_POST['update_category_id'];
   $update_stocks = $_POST['update_stocks'];
   
   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' , description = '$update_description' , stocks = '$update_stocks', category_id = '$update_category_id' WHERE p_id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];
 

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE p_id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <!-- website_icon  -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">shop products</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      
      <input type="text" name="name" class="box" placeholder="Enter product name" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter product price" required>
      <textarea name="description" class="box" placeholder="Enter product description" required></textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="number" min="0" name="stocks" class="box" placeholder="Stock" required>
      
      <?php
         $category_query =  "SELECT * FROM `category`";
         $results = mysqli_query($conn, $category_query);
      ?>
      <select class="box" name="category_id">
         <?php while($row1 = mysqli_fetch_array($results)):;?>
         <option value="<?php echo $row1['category_id'];?>"><?php echo $row1['category_name'];?></option>
         <?php endwhile;?> 
        
         
      </select>
     
      <input type="submit" value="add product" name="add_product" class="btn">
      
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <div class="zoom">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         </div>
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">₱<?php echo $fetch_products['price']; ?></div>
         <div class="stocks">Stock: <?php echo $fetch_products['stocks']; ?></div>
         <div class="description"><?php echo $fetch_products['description']; ?></div>
         <a href="admin_products.php?update=<?php echo $fetch_products['p_id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['p_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>

      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>
</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE p_id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['p_id']; ?>">
      <input type="hidden" name="update_category_id" value="<?php echo $fetch_update['category_id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter product name">
      <textarea name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="Enter product description"></textarea>
      <?php
            $query = "SELECT * FROM `category`";
            $results = mysqli_query($conn, $query);
            $options = "";

      ?>
      <select class="box" name="update_category_id">

         <?php while($row1 = mysqli_fetch_array($results)):;?>
         <option value="<?php echo $row1['category_id']?>"><?php echo $row1['category_name'];?></option>
         <?php endwhile;?> 
      </select>

      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter product price">
      <input type="number" name="update_stocks" value="<?php echo $fetch_update['stocks']; ?>" min="0" class="box" required placeholder="Stock">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
   
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>