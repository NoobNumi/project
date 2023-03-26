<?php
error_reporting(0);
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_POST['send_rating'])){
   $reviews = mysqli_real_escape_string($conn, $_POST['reviews']);
   $select_message = mysqli_query($conn, "SELECT * FROM `ratings` WHERE user_id = '$user_id'") or die('fetching failed');
   $order_name = $_POST['order_name'];
   $p_id = $_POST['p_id'];
   $name = $_POST['name'];

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'You already posted a review! You cannot review the product anymore';
   }else{
      mysqli_query($conn, "INSERT INTO `ratings`(user_id, p_id, name, order_name, reviews) VALUES('$user_id', '$p_id', '$name', '$order_name', '$reviews')") or die('insert review failed');
      $message[] = 'Review posted successfully!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Rate Product</title>

   <!-- website_icon  -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact" >

   <h1 class="title">How is our product?</h1>

      <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$_GET[id]'") or die('rating failed');
            if(mysqli_num_rows($select_products) > 0)
            {
                  while($fetch_products = mysqli_fetch_array($select_products))
                  {
                           
      ?>
            <form action="" method="post" class="box">
                  <img class="image" src="images/<?php echo $fetch_products['product_photo']; ?>">
               <div class="name">
                  <p style="font-size: 2rem"> Name : <span style="color: var(--purple); font-size: 2rem"><?php echo $fetch_products['cart_products']; ?></span></p>
                  <p style="font-size: 2rem"> Quantity : <span style="color: var(--purple); font-size: 2rem"><?php echo $fetch_products['total_products']; ?></span> pc/s</p>
                  <p style="font-size: 2rem"> Size : <span style="color: var(--purple); font-size: 2rem"><?php echo $fetch_products['size']; ?></span></p>
               </div>    
                  <textarea name="reviews" class="box" placeholder="Say something about our product!" id="send_rating"></textarea>
                  <input type="submit" value="send rating" name="send_rating" class="btn">
                  <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="p_id" value="<?php echo $fetch_products['p_id']; ?>">
                  <input type="hidden" name="order_name" value="<?php echo $fetch_products['cart_products']; ?>">

               </form>
      <?php
                     }
            }
      ?>
</section>
<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>

<!-- Bootstrap js file link -->
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>