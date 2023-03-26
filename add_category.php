<?php
error_reporting(0);
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id))
{
    header('location:login.php');
};

if(isset($_POST['categories'])){
    $category = $_POST['category_name'];

    $select_category = mysqli_query($conn, "SELECT category_name FROM `category` WHERE category_name = '$category'") or die('query failed');

    if(mysqli_num_rows($select_category) > 0){
        $message[] = 'Category already added!';
    }else{
        $add_category = mysqli_query($conn,"INSERT INTO `category` (category_name) VALUES ('$category')") or die ('query failed');
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Lang</title>    
    <!-- website_icon  -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- bootstrap css file link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .btn{    
        padding: 6px;
        min-width: 100px;
    }    
    .add{
        background-color: purple;
        color:white;
        float: right;
        margin-top: 8px;
    }
    .cancel{
        background-color: red;
        color:white;
        float: left;
        margin-top: 8px;
    }
</style>
<body>

<section class="edit-product-form">

    <form action="" method="post" enctype="multipart/form-data">

        <input type="text" name="category_name" class="box"
        placeholder="Enter category" required>
        <input type="submit" value="Add" name="categories" class="btn add">
        <a href="admin_categories.php" class="btn cancel">Cancel</a>
    </form>

</section>

</body>
</html>
