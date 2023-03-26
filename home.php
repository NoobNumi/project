<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- website_icon  -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="../project/css/bootstrap.min.css">
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>
<?php include 'carousel.php'; ?>

<div class="container-fluid">
    <div class="row flex-nowrap" style="display: -webkit-box;">
        <div class="col-auto px-0">
            <div id="sidebar" class="collapse collapse-horizontal">
                <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
               <!--Fetch data from categories table-->
                <?php 
                     
                     $select_category = mysqli_query($conn, "SELECT * FROM `category`") or die('query failed');
                     if(mysqli_num_rows($select_category) > 0){
                           while($fetch_category = mysqli_fetch_array($select_category)){
                  ?>
                    <a href="categories.php?category_id=<?php echo $fetch_category['category_id']; ?>" class="list-group-item border-end-0 d-inline-block text-truncate" style="font-size: 2rem;" data-bs-parent="#sidebar"><i></i> <span><?php echo $fetch_category['category_name']; ?></span> </a>
                    <input type="hidden" name="category_id" value="<?php echo $fetch_category['category_id']; ?>">
                  <?php
                     }
                  }
                  ?>
                </div>
            </div>
        </div>
        <main class="col ps-md-2 pt-2">
            <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none" style="font-size: 2.5rem; width: auto;"><i class="fas fa-th-list"></i> Categories </a>
            <section class="products" >

                  <h1 class="title">latest products</h1>
                  <div class="box-container" >

                     <?php  
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
                        if(mysqli_num_rows($select_products) > 0){
                           while($fetch_products = mysqli_fetch_array($select_products)){
                     
                     ?>
                  <form action="" method="post" class="box">
                           <div class="zoom">
                              <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                           </div>      
                           <div class="name">
                              <h1><?php echo $fetch_products['name'];?><a class ="view" href="view_product.php?p_id=<?php echo $fetch_products['p_id'];?>"></a></h1>
                           </div>
                           <div class="price">₱<?php echo $fetch_products['price']; ?></div>
                           <input type="hidden" name="p_id" value="<?php echo $fetch_products['p_id']; ?>">
                           <a class="view" href="view_product.php?p_id=<?php echo $fetch_products['p_id'];?>"></a>
                  </form>
                     <?php
                        }
                     }else{
                        echo '<p class="empty">No products added yet!</p>';
                     }
                     ?>
                  </div>

                  <div class="load-more" style="margin-top: 2rem; text-align:center">
                     <a href="shop.php" class="option-btn">load more</a>
                  </div>

               </section>

               <section class="about">

                  <div class="flex">

                     <div class="image">
                        <img src="images/author.jpg" style="width: 300px; height: 300px; "alt="">
                     </div>

                     <div class="content">
                        <h3>About us</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
                        <a href="about.php" class="btn">read more</a>
                     </div>

                  </div>

               </section>

               <section class="home-contact">

                  <div class="content">
                     <h3>Do have any questions?</h3>
                     <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
                     <a href="contact.php" class="white-btn">contact us</a>
                  </div>

               </section>
        
        
        
         </main>
    </div>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>

<!-- Bootstrap js file link -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>