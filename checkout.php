<?php
error_reporting(0);
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){
   
   $p_id = $_POST['p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'house no. '. $_POST['house'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST
   ['province'].' - '. $_POST['zip_code']);
   $cart_products = mysqli_real_escape_string($conn, $_POST['cart_products']);
   $product_size = mysqli_real_escape_string($conn, $_POST['product_size']);
   $total_products = $_POST['total_products'];
   $product_photo = $_POST['product_photo'];
   $p_id = $_POST['p_id'];
   $placed_on = date('d-M-Y');

   $cart_total = 0;

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('cart select failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products = $cart_item['name'];
         $product_size = $cart_item['size'];
         $total_products = $cart_item['quantity'];
         $product_photo = $cart_item['image'];
         $p_id = $cart_item['p_id'];
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;

         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE p_id='$p_id'") or die('product stocks select failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
               $subtract_stock = ($fetch_products['stocks'] - $cart_item['quantity']);
               mysqli_query($conn, "UPDATE `products` SET stocks = '$subtract_stock' WHERE p_id = '$p_id'");
            }
         }
      }
   }
   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE p_id = '$p_id' AND name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND size = '$product_size' AND cart_products = '$cart_products' AND total_products = '$total_products' AND product_photo = '$product_photo' AND total_price = '$cart_total'") or die('order failed');

   if($cart_total == 0){
      $message[] = 'Your cart is empty!';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders` (user_id, p_id, name, number, email, method, address, size, cart_products, total_products, product_photo, total_price, placed_on) VALUES('$user_id', '$p_id', '$name', '$number', '$email', '$method', '$address', '$product_size', '$cart_products', '$total_products', '$product_photo', '$cart_total', '$placed_on')") or die('Insertion failed');
         $message[] = 'Order placed successfully!';

         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Delete failed');

         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE p_id='$p_id'") or die('Stocks failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
               mysqli_query($conn, "UPDATE `products` SET stocks - '$cart_item[quantity]' WHERE p_id = '$p_id'");
            }
         }
        
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- website_icon  -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('cart query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₱'.$fetch_cart['price'].' x '. $fetch_cart['quantity'] . ' ' .'size: '. $fetch_cart['size']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> GRAND TOTAL : <span>₱<?php echo $grand_total; ?></span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Full name :</span>
            <input type="text" name="name" required placeholder="Enter your name">
         </div>
         <div class="inputBox">
            <span>Cellphone number :</span>
            <input type="number" name="number" required placeholder="Enter your number">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="Enter your email">
         </div>
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="method">
               <option value="cash on delivery">Cash on delivery</option>
               <option value="credit card">Credit card</option>
               <option value="gcash">Gcash</option>
            </select>
         </div>
         <div class="inputBox">
            <span>House number :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. House no.">
         </div>
         <div class="inputBox">
            <span>Street :</span>
            <input type="text" name="street" required placeholder="e.g. Street name">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. Legazpi">
         </div>
         <div class="inputBox">
            <span>Province :</span>
            <input type="text" name="province" required placeholder="e.g. Albay">
         </div>
         <div class="inputBox">
            <span> ZIP code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
      <input type="hidden" name="p_id" value="<?php echo $fetch_products['p_id']; ?>">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>