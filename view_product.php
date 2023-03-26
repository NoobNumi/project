<?php

error_reporting(0);
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['add_to_cart'])){

   $p_id = $_POST['p_id'];
   $product_category = $_POST['product_category'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_size = $_POST['product_size'];
   $product_quantity = $_POST['product_quantity'];
   $product_stocks = $_POST['product_stocks'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE p_id = '$p_id' AND name = '$product_name' AND user_id = '$user_id'") or die('cart fetch failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, p_id, category_id, name, price, size, quantity, image, stocks) VALUES('$user_id', '$p_id', '$product_category)', '$product_name', '$product_price', '$product_size', '$product_quantity', '$product_image', '$product_stocks' )") or die('query failed');
      $message[] = 'Product added to cart!';
   }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product</title>

   <!-- website_icon  -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="../project/css/bootstrap.min.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


</head>
<style>

body{
   margin: 0;
   padding: 0;
   box-sizing: border-box;
}  
</style>
<body>
   
<?php include 'header.php'; ?>
   
   <div class="heading">
         <h3>our shop</h3>
         <p> <a href="home.php" style="text-decoration: none;">home</a> / product details </p>
      </div>
   
<section class="small-container single-product" >
      <div class="row" >
         <div class="col-2">
                  <?php  
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE p_id='$_GET[p_id]'") or die('failed');
                        if(mysqli_num_rows($select_products) > 0){
                           while($fetch_products = mysqli_fetch_array($select_products)){
                     
                        ?>
                     <form action="" method="post" class="box">
                              <img class="img-fluid" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" style="width: 100%;">
         
                     
         </div>  
         <div class="col-2">       
                        <h1><?php echo $fetch_products['name'];?></h1>
                        <h4>₱<?php echo $fetch_products['price']; ?></h4>
                        <p style="font-size: 2rem; margin-top: 1rem;">Stock: <span style="color: var(--purple); font-size: 2rem;"><?php echo $fetch_products['stocks'];?></span></p>

                        <!--Entering Product Size to Database-->
                        <?php
                              if($fetch_products['category_id'] == 3){
                        ?>
                              <select name="product_size" required>
                                 <option value="">Select Size</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                               </select>
                        <?php
                              }else{
                        ?>
                              <select name="product_size" required>
                                 <option value="">Select Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                               </select>
                        <?php
                              }
                        ?>
                        <input type="number" min="1" name="product_quantity" value="1" class="qty">
                        <?php
                           if($fetch_products['stocks'] <= 0){
                        ?>
                           <input type="submit" value="add to cart" name="add_to_cart" class="buy-btn" disabled style="opacity: .5; user-select: none; pointer-events: none;">
                        <?php
                           }else{
                        ?>      
                           <input type="submit" value="add to cart" name="add_to_cart" class="buy-btn">     
                        <?php
                           }
                        ?>
                              <nav>
                                 <div class="nav nav-tabs" id="nav-tab" role="tablist" style="padding-top: 24px; font-size: 18px; text-decoration:none; color: #BF40BF">
                                    <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" 
                                    data-toggle="description"
                                    data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Description</button>
                                    <button class="nav-link" id="nav-reviews-tab" data-bs-toggle="tab" data-bs-target="#nav-reviews" type="button" role="tab" aria-controls="nav-reviews" aria-selected="true">Reviews</button>
                                 </div>
                              </nav>
                              
                                 <div class="tab-content" id="nav-tabContent" style="padding-top: 24px; font-size: 15px;">
                                    
                                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav--tab">
                                       <p><?php echo $fetch_products['description']; ?></p>
                                    </div>
                                    <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
                                       <?php
                                             $select_review = mysqli_query($conn, "SELECT * FROM `ratings` WHERE p_id='$_GET[p_id]' ") or die('query failed');
                                             if(mysqli_num_rows($select_review) > 0){
                                             while($fetch_review = mysqli_fetch_array($select_review)){
                                       ?>
                                       <div class="review-container">
                                          <div class="comment_container">
                                                <img class ="img-fluid" src="images/person-icon.png" alt="" style="width: 25px;  height: 30px; float: left;">
                                                <h5 style="float: left;"><?php echo $fetch_review['name']; ?></h5>
                                                <div class="comment-review">
                                                   <p><?php echo $fetch_review['reviews']; ?></p>
                                                </div>
                                          </div> 
                                       </div>

                                       <?php
                                             }
                                       }
                                       ?>
                                       
                                    </div>
                                 </div> 
                        <input type="hidden" name="p_id" value="<?php echo $fetch_products['p_id']; ?>">
                        <input type="hidden" name="product_category" value="<?php echo $fetch_products['category_id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="hidden" name="product_stocks" value="<?php echo $fetch_products['stocks']; ?>">

                  </form>
               <?php
                  }
               }else{
                  echo '<p class="empty">No products added yet!</p>';
               }
               ?>
         </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>

<!-- Bootstrap js file link -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>