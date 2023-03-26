<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share" ">
            <a href="#" style="text-decoration: none;" class="fab fa-facebook-f"></a>
            <a href="#" style="text-decoration: none;" class="fab fa-instagram"></a>
            <a href="#" style="text-decoration: none;" class="fab fa-twitter"></a>
            <a href="#" style="text-decoration: none;" class="fab fa-telegram"></a>
         </div>
         <p><a style="text-decoration: none;" href="login.php">Login</a> | <a style="text-decoration: none;" href="register.php">Register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a class="logo" href="home.php" style="text-decoration: none;">
         <img src="images/main_logo.png" width="50" height="50" alt="main_logo">TREND ZONE
         </a>
         <nav class="navbar">
            <a style="text-decoration: none;" href="home.php">HOME</a>
            <a style="text-decoration: none;" href="about.php">ABOUT</a>
            <a style="text-decoration: none;" href="shop.php">SHOP</a>
            <a style="text-decoration: none;" href="contact.php">CONTACT</a>
            <a style="text-decoration: none;" href="orders.php">ORDERS</a>
         </nav>
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a style="text-decoration: none;" href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a style="text-decoration: none;" href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a style="text-decoration: none;" href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>