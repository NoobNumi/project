<?php
error_reporting(0);
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id))
{
    header('location:login.php');
};

if(isset($_POST['update'])){
    $update_category_id = $_POST['update_category_id'];
    $update_category_name = $_POST['update_category_name'];
    $update = mysqli_query($conn, "UPDATE `category` SET category_name = '$update_category_name' WHERE category_id = '$update_category_id' ") or die('query failed');

    header('location:admin_categories.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update category</title>    
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

        <?php
            $update_category_id = $_GET['category_id'];
            $update_query = mysqli_query($conn, "SELECT * FROM `category` WHERE category_id = '$update_category_id'") or die ('query failed');
            if(mysqli_num_rows($update_query) > 0){
                while($fetch_category = mysqli_fetch_array($update_query)){
            
        ?> 
        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="update_category_id" value="<?php echo $fetch_category['category_id']; ?>">
            <input type="hidden" name="update_category_name" value="<?php echo $fetch_category['category_name']; ?>">
            <input type="text" name="update_category_name" value="<?php echo $fetch_category['category_name']; ?>" class="box" required placeholder="Enter product category">
            <input type="submit" value="update" name="update" class="btn add">  
            <a href="admin_categories.php" class="btn cancel">Cancel</a>

        </form>
        <?php
                }
            }else{
                echo "none";
            }
        ?>

    </section>

</body>
</html>
