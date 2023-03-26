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

   <div class="flex">

      <a href="admin_page.php" style="text-decoration:none" class="logo">Seller's<span>Corner</span></a>

      <nav class="navbar">
         <a style="text-decoration:none" href="admin_page.php">HOME</a>
         <a style="text-decoration:none" href="admin_products.php">PRODUCTS</a>
         <a style="text-decoration:none" href="admin_categories.php">CATEGORIES</a>
         <a style="text-decoration:none" href="admin_orders.php">ORDERS</a>
         <a style="text-decoration:none" href="admin_users.php">USERS</a>
         <a style="text-decoration:none" href="admin_contacts.php">MESSAGES</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>

   </div>

</header>